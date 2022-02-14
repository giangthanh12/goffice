$(function () {
    "use strict";
    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");
    var buttons = [];
    if (funAdd == 1) {
        buttons.push({
            text: "Thêm mới",
            className: "add-new btn btn-" + 'primary' + " mt-50",
            init: function (api, node, config) {
                $(node).removeClass("btn-secondary");
            },
            action: function (e, dt, node, config) {
                actionMenu();
            }
        });
    }
    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/system/listObj",
            ordering: false,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "name" },
                { data: "value" },
                { data: "" },
            ],
            columnDefs: [
                {
                    targets: 0,
                    responsivePriority: 3,
                    visible: false,
                },
                {
                    // Actions
                    targets: 1,
                    width: 100
                },
                {
                    // Actions
                    targets: 2,
                    render: function (data, type, full, meta) {
                       
                        if (full['value'].indexOf('http:') == 0) {
                            if (full['id'] == 7) {
                               return '<img src="' + full['value'] + '" width="200px">';
                            }
                            else if (full['id'] == 8) {
                               return '<img src="' + full['value'] + '" width="70px">';
                            }
                        } else {
                            return full['value'];
                        }
                    },
                    width: 400
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        if (funEdit == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                            html += '<i class="fas fa-pencil-alt"></i>';
                            html += '</button> &nbsp;';
                        }
                        if (funDel == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="xoa(' + full['id'] + ')">';
                            html += '<i class="fas fa-trash-alt"></i>';
                            html += '</button>';
                        }
                        return html;
                    },
                    width: 100
                },
            ],
            // order: [[2, "desc"]],
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
                sLengthMenu: "Hiển thị _MENU_",
                search: "",
                searchPlaceholder: "Tìm kiếm...",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
                info: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
            },
            // Buttons with Dropdown
            buttons: buttons,
            initComplete: function () {
                // Adding role filter once table initialized

            },
        });

    }
    function actionMenu() {
        $("#updateinfo").modal('show');
        $(".modal-title").html('Thêm thông tin mới');
        $('#name').val('');
        $('#gia_tri').val('');
        url = baseHome + "/system/add";
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
                "gia-tri": {
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

function loaddata(id) {
    $("#updateinfo").modal('show');

    if(id == 7 || id == 8){
        $("#logo").removeClass('d-none');
        $("#gia_tri").addClass('d-none');
    }else{
        $("#logo").addClass('d-none');
        $("#gia_tri").removeClass('d-none');
    }
    
    $(".modal-title").html('Cập nhật thông tin');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/system/loadInfo",
        success: function (data) {
            $('#name').val(data.name);
            $('#gia_tri').val(data.value);

            url = baseHome + '/system/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}


function save() {
    $('#fm').validate({
        messages: {
            "name": {
                required: "Bạn chưa nhập tên thông tin!",
            },
            "gia_tri": {
                required: "Bạn chưa nhập giá trị!",
            }
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.msg);
                        $('#updateinfo').modal('hide');
                        $(".user-list-table").DataTable().ajax.reload(null, false);
                    } else
                        notify_error(data.msg);
                }
            });
            return false;
        }
    });
    $('#fm').submit();
}

function xoa(id) {
    Swal.fire({
        title: 'Xóa dữ liệu',
        text: "Bạn có chắc chắn muốn xóa!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Tôi đồng ý',
        cancelButtonText: "Hủy",
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: baseHome + "/system/del",
                type: 'post',
                dataType: "json",
                data: { id: id },
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.msg);
                        $(".user-list-table").DataTable().ajax.reload(null, false);
                    }
                    else
                        notify_error(data.msg);
                },
            });
        }
    });
}
