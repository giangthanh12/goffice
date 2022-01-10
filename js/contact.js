
$(function () {

    return_combobox_multi('#customerId', baseHome + '/contact/getCustomer', 'Lựa chọn khách hàng');

    var basicPickr = $('.flatpickr-basic');

    // Default
    if (basicPickr.length) {
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
            ajax: baseHome + "/contact/list",
            ordering: false,
            columns: [
                { data: "name" },
                { data: "phoneNumber" },
                { data: "email" },
                { data: "" },
            ],
            columnDefs: [
            
                {
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ')" >' +
                            '<span class="align-middle font-weight-bold">' + full["name"] + "</span></a>";
                    },
                    width: 200
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
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="del(' + full['id'] + ')">';
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
                search: "Search",
                searchPlaceholder: "11111111112..",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
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
                        $(".modal-title").html('Thêm liên lạc mới');
                        $('#name').val('');
                        $('#customerId').val('').change();
                        $('#phoneNumber').val('');
                        $('#email').val('');
                        $('#facebook').val('');
                        $('#zalo').val('');
                        $('#status').val(1).attr("disabled", true);
                        url = baseHome + "/contact/add";
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
                "name": {
                    required: true,
                },
                "customerId": {
                    required: true,
                },
                "phoneNumber": {
                    required: true,
                },
                "email": {
                    required: true,
                },
              
            },
        });

        form.on("submit", function (e) {
            var isValid = form.valid();
            e.preventDefault();
            if (isValid) {
                saveContact();
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
    $(".modal-title").html('Cập nhật thông tin liên lạc');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/contact/loaddata",
        success: function (data) {
            $('#name').val(data.name);
            $('#customerId').val(data.customerId).change();
            $('#phoneNumber').val(data.phoneNumber);
            $('#email').val(data.email);
            $('#facebook').val(data.facebook);
            $('#zalo').val(data.zalo);
            $('#status').val(data.status).change().attr("disabled", true);
            $('#note').val(data.note);
            url = baseHome + '/contact/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function saveContact() {
    var info = {};
    info.name = $("#name").val();
    info.customerId = $("#customerId").val();
    info.phoneNumber = $("#phoneNumber").val();
    info.email = $("#email").val();
    info.facebook = $("#facebook").val();
    info.zalo = $("#zalo").val();
    info.status = $("#status").val();
    info.note = $("#note").val();
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
                url: baseHome + "/contact/del",
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

