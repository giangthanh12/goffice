var url = '';
$(function () {

    "use strict";

    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            ajax: baseHome + "/group_roles/list",
            ordering: false,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "name" },
                { data: "" },
            ],
            columnDefs: [
                {
                    targets: 0,
                    visible: false,
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="getGroupRole(' + full["id"] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="setRoles(' + full["id"] + ')">';
                        html += '<i data-feather="settings"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="deleteGroupRole(' + full["id"] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                        return html;
                    },
                    width: 180
                },
            ],
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
                search: "Search",
                searchPlaceholder: "11111111112..",
            },
            // Buttons with Dropdown
            buttons: [
                {
                    text: "Thêm mới",
                    className: "add-new btn btn-primary mt-50",
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                    },
                    action: function (e, dt, node, config) {
                        $("#updateinfo").modal('show');
                        $(".modal-title").html('Thêm nhóm quyền mới');
                        $('#name').val('');
                        url = baseHome + "/group_roles/addGroupRole";
                    },
                },
            ],
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            initComplete: function () {
                // Adding role filter once table initialized
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

function getGroupRole(id) {
    $("#updateinfo").modal('show');
    $(".modal-title").html('Cập nhật thông tin nhóm quyền');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/group_roles/getGroupRole",
        success: function (data) {
            $('#name').val(data.name);
            url = baseHome + '/group_roles/updateGroupRole?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function saveGroupRole() {
    var info = {};
    info.name = $("#name").val();
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
            if(data.msg) 
                notyfi_success(data.msg);
            else
                notify_error('Cập nhật không thành công');
        }
    });
}

function setRoles(id)
{
    $("#setroles").modal('show');
    $("#title-2").html('Phân quyền');
    // $.ajax({
    //     type: "POST",
    //     dataType: "json",
    //     data: { id: id },
    //     url: baseHome + "/group_roles/getGroupRole",
    //     success: function (data) {
    //         $('#name').val(data.name);
    //         url = baseHome + '/group_roles/updateGroupRole?id=' + id;
    //     },
    //     error: function () {
    //         notify_error('Lỗi truy xuất database');
    //     }
    // });
}

function deleteGroupRole(id) {
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
                url: baseHome + "/group_roles/deleteGroupRole",
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