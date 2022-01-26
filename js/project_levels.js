





$(function () {


    return_combobox_multi('#parentId', baseHome + '/menu/combo', 'Lựa chọn cha cho menu');

    var basicPickr = $('.flatpickr-basic');
   
    // Default
    if (basicPickr.length) { // thư viện định dạng ngày tháng năm
        basicPickr.flatpickr({
            dateFormat: "d/m/Y",
        });
    }
    "use strict";

    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");
    // Users List datatable
    var button = [];
    let i = 0;
    userFuns.forEach(function (item,index){
        if(item.type==1) {
            button[i] = {
                text: item.name,
                className: "add-new btn btn-" + item.color + " mt-50",
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

    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/project_levels/list",
            ordering: false,
            columns: [
                { data: "name" },
                { data: "color" },
                {data: "status"},
                { data: "" },
            ],
            columnDefs: [
                {
                    targets: -4,
                    render: function (data, type, full, meta) {
                        return `<span style='font-weight: 600; color:${full['color']}'>${full['name']}</span>`
                    },
                },
              
                {
                    targets: -3,
                    render: function (data, type, full, meta) {
                        return `<div style="width:20px; height:20px; background:${full['color']}"></div>`
                    },
                },
                {
                    targets: -2,
                    render: function (data, type, full, meta) {
                      
                        if(full['status'] == 1) return 'Chưa kích hoạt';
                        return 'Đã kích hoạt'

                    },
                },
              
           
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        userFuns.forEach(function (item){
                            if(item.type==2) {
                                html += '<button type="button" class="btn btn-icon btn-outline-' + item.color + ' waves-effect"  title="'+item.name+'" onclick="' + item.function + '(' + full['id'] + ')">';
                                html += '<i class="' + item.icon + '"></i>';
                                html += '</button> &nbsp;';
                            }
                        })
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
                    info:"Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
                },
            // Buttons with Dropdown// tạo một button thêm mới
            buttons: [button],
        });

    }
    function actionMenu(func){
        if(func=='add')
            add();
    }
    function add(){
        $("#updateinfo").modal('show');
        $(".modal-title").html('Thêm cấp độ cho dự án');
        $('#name').val('');
        $('#color').val('');
        $('#status').val('2').attr("disabled", true);
        // $('#ghi_chu').val('');
        url = baseHome + "/project_levels/add";
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
                "color": {
                    required: true,
                },
                "user-email": {
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
  
    $('#updateinfo').modal('show');
    $(".modal-title").html('Cập nhật cấp độ cho dự án');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/project_levels/loaddata",
        success: function (data) {
            $('#name').val(data.name);
            $('#color').val(data.color);
            $('#status').val(data.status).change().attr("disabled", false);
            url = baseHome + '/project_levels/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}
// dùng chung cho phần update và thêm
function saveLevelProject() {
    
    var info = {};
    info.name = $("#name").val();
    info.color = $("#color").val();
    info.status = $("#status").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: url,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#updateinfo').modal('hide');
                $(".user-list-table").DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
        error: function () {
            notify_error('Cập nhật không thành công');
        }
    });
}

function del(id) {
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
                url: baseHome + "/project_levels/del",
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
