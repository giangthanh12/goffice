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


    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/menu/list",
            ordering: false,
            columns: [
                { data: "name" },
                { data: "link" },
                { data: "icon" },
                { data: "type" },
                { data: "active" },
                { data: "" },
            ],
            columnDefs: [
              
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                      
                        return `<i class="${full['icon']}"></i>`;

                    },
                },
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        if(full['type']==1)
                        return `Platform`;
                        if(full['type']==2)
                            return `Plugin`;
                        if(full['type']==3)
                            return `Truy cập nhanh`;

                    },
                },
           
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="xoa(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
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
                sLengthMenu: "Show _MENU_",
                search: "Tìm kiếm",
                searchPlaceholder: "Tìm kiếm tại đây",
                paginate: {
                   
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            // Buttons with Dropdown// tạo một button thêm mới
            buttons: [
                {
                    text: "Thêm mới",
                    className: "add-new btn btn-primary mt-50",
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary"); 
                    },
                    action: function (e, dt, node, config) {
                        $("#updateinfo").modal('show');
                        $(".modal-title").html('Thêm menu mới');
                        // $('#nhan_vien').val('').change();
                        $('#name').val('');
                        $('#link').val('');
                        $('#icon').val('');
                        $('#sortOrder').val('');
                        $('#parentId').val('').change();
                        $('#tinh_trang').val('1').attr("disabled", true);
                        // $('#ghi_chu').val('');
                        url = baseHome + "/menu/add";
                    },
                },
               
            ],
           
            initComplete: function () {
            

            },
        });

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
                "user-fullname": {
                    required: true,
                },
                "user-name": {
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
    $(".modal-title").html('Cập nhật thông tin menu');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/menu/loaddata",
        success: function (data) {
            $('#name').val(data.name);
            $('#link').val(data.link);
            $('#icon').val(data.icon);
            $('#parentId').val(data.parentId).change();
            $('#sortOrder').val(data.sortOrder);
            $('#tinh_trang').val(data.active).change().attr("disabled", false);
            url = baseHome + '/menu/update?id=' + id;

         
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}
// dùng chung cho phần update và thêm
function savekh() {
    
    var info = {};
    info.name = $("#name").val();
    info.link = $("#link").val();
    info.icon = $("#icon").val();
    info.parentId = $("#parentId").val();
    info.active = $("#tinh_trang").val();
    info.sortOrder = $("#sortOrder").val();
    

    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: url,
        success: function (data) {
            return_combobox_multi('#parentId', baseHome + '/menu/combo', 'Lựa chọn cha cho menu');
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

function xoa(id) {
 alert(id);
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
                url: baseHome + "/menu/del",
                type: 'post',
                dataType: "json",
                data: { id: id },
                success: function (data) {
                    return_combobox_multi('#parentId', baseHome + '/menu/combo', 'Lựa chọn cha cho menu');
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

function changePB() {
    var opt = $("#phong_ban").val();
    return_combobox_multi('#vi_tri', baseHome + '/vitri/combo?phongban=' + opt, 'Lựa chọn vị trí');
    $('#vi_tri').val('').attr("disabled", false);
}
