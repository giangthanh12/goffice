$(function () {
    return_combobox_multi('#staffId', baseHome + '/common/nhanvien', 'Lựa chọn nhân viên');

    "use strict";
            var basicPickr = $('.flatpickr-basic');
            if (basicPickr.length) {
                basicPickr.flatpickr({
                    dateFormat: "d/m/Y",
                    onReady: function (selectedDates, dateStr, instance) {
                        if (instance.isMobile) {
                            $(instance.mobileInput).attr("step", null);
                        }
                    }
                });
            }
    var dtUserTable = $(".user-list-table"),
        modal = $("#add-contract"),
        form = $("#dg");
    // Users List datatable
    var button = [];
    let i = 0;
    userFuns.forEach(function (item,index){
        if(item.type==1) {
            button[i] = {
                text: item.name,
                className: "add-new btn btn-primary mt-50",
                init: function (api, node, config) {
                    $(node).removeClass("btn-secondary");
                },
                action: function (e, dt, node, config) {
                    actionMenu(item.function);
                }
            };
            i++;
        }
    })
    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/document/list",
            ordering: true,
            columns: [
                // columns according to JSON
                {data: "name"},
                {data: "staffName"},
                {data: "Date"},
                {data: "linkToFile"},
                {data: ""},
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ')" >' +
                            '<span class="align-middle font-weight-bold" style="padding: 5px;">' + full["name"] + "</span></a>";
                    },
                    width: 200
                },
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return '<a href="'+ full["linkToFile"] +'">' + '<span class="align-middle font-weight-bold" style="padding: 5px;">' + full["linkToFile"] + "</span></a>";
                            
                    },
                },
               
                { 
                  targets: -1,
                  title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                  orderable: false,
                  render: function (data, type, full, meta) {
                      var html = '';
                        html += '<div d-flex justify-content-start style="width::150px;text-align:left">';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="del(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button></div>';
                      return html;
                  },
                  width: 100
              },
            ],
            // order: [[0, "desc"]],
            dom:
            '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
            '<"col-lg-12 col-xl-6" l>' +
            '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
            ">t" +
            '<"d-flex justify-content-between mx-2 row mb-1"' +
            '<"col-sm-12 col-md-6"i>' +
            '<"col-sm-12 col-md-6"p>' +
            ">",
            language: {
                sLengthMenu: "Show _MENU_",
                search: "Tìm kiếm",
                searchPlaceholder: "Từ khóa..",
                paginate: {
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            buttons: [{
                text: "Thêm mới",
                className: "add-new btn btn-primary mt-50",
                // attr: {
                //     "data-toggle": "modal",
                //     "data-target": "#modals-slide-in",
                // },
                init: function (api, node, config) {
                    $(node).removeClass("btn-secondary");
                },
                action: function (e, dt, node, config) {
                    actionMenu('add');
                }
            }],
            initComplete: function () {
               
            },
        });

    }
    function actionMenu(func){
        if(func=='add')
            showAdd();
    }
    // Check Validity
    function checkValidity(el) {
        if (el.validate().checkForm()) {
            submitBtn.attr("disabled", false);
        } else {
            submitBtn.attr("disabled", true);
        }
    }

    // Form Validation
    if (form.length) {
        form.validate({
            errorClass: "error",
            rules: {
                "name": {
                    required: true,
                },
                "staffId": {
                    required: true,
                },
                "timeDate": {
                    required: true,
                },
                "linkToFile": {
                    required: true,
                },  
            },
        });

        form.on("submit", function (e) {
            var isValid = form.valid();
            e.preventDefault();
            if (isValid) {
                modal.modal("hide");
            }
        });
    }

    // To initialize tooltip with body container
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
        container: "body",
    });
});

function showAdd() {
    $("#add-contract").modal('show');
    $(".modal-title").html('Thêm tài liệu mới');
    $('#staffId').val('').trigger('change');
    $('#name').val('');
    $('#dateTime').val('');
    $('#linkToFile').val('');
    $('#description').val('');
    var basicPickr = $('.flatpickr-basic');
    // Default
    if (basicPickr.length) {
        basicPickr.flatpickr({
            dateFormat: "d/m/Y",
            onReady: function (selectedDates, dateStr, instance) {
                if (instance.isMobile) {
                    $(instance.mobileInput).attr("step", null);
                }
            },
        });
    }
    url = baseHome + "/document/add";
}

function loaddata(id) {
    $('#add-contract').modal('show');
    $(".modal-title").html('Cập nhật thông tin tài liệu');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {id: id},
        url: baseHome + "/document/loaddata",
        success: function (data) {
            $('#name').val(data.name);
            $('#dateTime').val(data.Date);
            $('#staffId').val(data.staffId).trigger("change");
            $('#linkToFile').val(data.linkToFile);
            $('#description').val(data.description);
           
            url = baseHome + '/document/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function save() {
    var info = {};
    info.name = $("#name").val();
    info.dateTime = $("#dateTime").val();
    info.linkToFile = $("#linkToFile").val();
    info.staffId = $("#staffId").val();
    info.description = $("#description").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: url,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.message);
                $('#add-contract').modal('hide');
                $(".user-list-table").DataTable().ajax.reload(null, false);
            } else
                notify_error(data.message);
        },
        error: function () {
            notify_error('Cập nhật không thành công');
        }
    });
}

function xoa(id) {
    Swal.fire({
        title: 'Xóa dữ liệu',
        text: "Bạn có chắc chắn muốn xóa!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Tôi đồng ý',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: baseHome + "/document/del",
                type: 'post',
                dataType: "json",
                data: {id: id},
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.message);
                        $(".user-list-table").DataTable().ajax.reload(null, false);
                    } else
                        notify_error(data.message);
                },
            });
        }
    });
}
