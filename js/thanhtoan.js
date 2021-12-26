var url = '';
$(function () {
    return_combobox_multi('#nhan_vien', baseHome + '/common/nhanvien', 'Lựa chọn nhân viên');

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
            ajax: baseHome + "/thanhtoan/list",
            ordering: false,
            columns: [
                { data: "id" },
                { data: "ngaygio" },
                { data: "nhanvien" },
                { data: "so_tien" },
                { data: "noi_dung" },
                { data: "tinhtrang" },
                { data: "nguoiduyet" },
                { data: "file" },
                { data: "nhan_vien" },
                { data: "tinh_trang" },
                { data: "" },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    responsivePriority: 4,
                    visible: false,
                },
                {
                    targets: 3,
                    visible: false,

                },
                {
                    targets: 7,
                    render: function (data, type, full, meta) {
                        if (data) {
                            return (
                                '<a href="' + data + '" class="pl-2" >' +
                                feather.icons["download"].toSvg({ class: "font-small-4 mr-50" }) +
                                "</a>"
                            );
                        } else {
                            return '';
                        }
                    },
                },
                {
                    targets: 8,
                    visible: false,
                },
                {
                    targets: 9,
                    visible: false,
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full["id"] + ',' + full["tinh_trang"] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Duyệt" onclick="duyet(' + full["id"] + ',' + full["tinh_trang"] + ')">';
                        html += '<i class="far fa-calendar-check"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-secondary waves-effect" title="Từ chối" onclick="tuchoi(' + full["id"] + ',' + full["tinh_trang"] + ')">';
                        html += '<i class="far fa-calendar-times"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="xoa(' + full["id"] + ',' + full["tinh_trang"] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                        return html;
                    },
                    width: 180
                    // render: function (data, type, full, meta) {
                    //     return (
                    //         '<div class="btn-group">' +
                    //         '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
                    //         feather.icons["more-vertical"].toSvg({ class: "font-small-4" }) +
                    //         "</a>" +
                    //         '<div class="dropdown-menu dropdown-menu-right">' +
                    //         '<a href="javascript:void(0)" class="dropdown-item" onclick="loaddata(' + full["id"] + ',' + full["tinh_trang"] + ')">' +
                    //         feather.icons["file-text"].toSvg({ class: "font-small-4 mr-50" }) +
                    //         "Xem/sửa</a>" +
                    //         '<a href="javascript:void(0)" class="dropdown-item delete-record" onclick="duyet(' + full["id"] + ',' + full["tinh_trang"] + ')">' +
                    //         feather.icons["check"].toSvg({ class: "font-small-4 mr-50" }) +
                    //         "Duyệt</a>" +
                    //         '<a href="javascript:void(0)" class="dropdown-item delete-record" onclick="tuchoi(' + full["id"] + ',' + full["tinh_trang"] + ')">' +
                    //         feather.icons["x"].toSvg({ class: "font-small-4 mr-50" }) +
                    //         "Từ chối</a>" +
                    //         '<a href="javascript:void(0)" class="dropdown-item delete-record" onclick="xoa(' + full["id"] + ',' + full["tinh_trang"] + ')">' +
                    //         feather.icons["trash-2"].toSvg({ class: "font-small-4 mr-50" }) +
                    //         "Xóa</a></div>" +
                    //         "</div>" +
                    //         "</div>"
                    //     );
                    // },
                },
            ],
            order: [[1, "desc"]],
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
                        $(".modal-title").html('Lập phiếu mới');
                        $('#ngay').flatpickr({
                            // monthSelectorType: "static",
                            altInput: true,
                            defaultDate: '',
                            altFormat: "d/m/Y",
                            dateFormat: "d/m/Y",
                        });
                        $('#so_tien').val('');
                        $('#noi_dung').val('');
                        $('#nhan_vien').val('').change();
                        $('.custom-file-label').html('Chọn file');
                        url = baseHome + "/thanhtoan/add";
                    },
                },
            ],
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

function loaddata(id, tinhtrang) {
    if (tinhtrang != 2) {
        $("#updateinfo").modal('show');
        $(".modal-title").html('Cập nhật thông tin phiếu');
        $.ajax({
            type: "POST",
            dataType: "json",
            data: { id: id },
            url: baseHome + "/thanhtoan/loaddata",
            success: function (data) {
                $('#tinh_trang').val(data.tinh_trang);
                // $('#ngay').val(data.ngay);
                $('#ngay').flatpickr({
                    // monthSelectorType: "static",
                    altInput: true,
                    defaultDate: data.ngay,
                    altFormat: "d/m/Y",
                    dateFormat: "d/m/Y",
                });
                $('#so_tien').val(data.so_tien);
                $('#noi_dung').val(data.noi_dung);
                $('#nhan_vien').val(data.nhan_vien).change();
                $('.custom-file-label').html('Chọn file');
                url = baseHome + '/thanhtoan/update?id=' + id;
            },
            error: function () {
                notify_error('Lỗi truy xuất database');
            }
        });
    } else {
        notify_error('Phiếu đã duyệt không thể sửa');
    }

}

function savetu() {
    var myform = new FormData($("#dg")[0]);

    $.ajax({
        type: "POST",
        dataType: "json",
        data: myform,
        url: url,
        contentType: false,
        processData: false,
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

function xoa(id, tinhtrang) {
    if (tinhtrang != 2) {
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
                    url: baseHome + "/thanhtoan/del",
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
    } else {
        notify_error('Phiếu đã duyệt không thể xóa');
    }
}

function duyet(id, tinhtrang) {
    if (tinhtrang != 2) {
        Swal.fire({
            title: 'Duyệt phiếu',
            text: "Bạn có chắc chắn muốn duyệt phiếu này!",
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
                    url: baseHome + "/thanhtoan/duyet",
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
    } else {
        notify_error('Phiếu đã duyệt không thể duyệt lại');
    }
}

function tuchoi(id, tinhtrang) {
    if (tinhtrang != 2) {
        Swal.fire({
            title: 'Từ chối',
            text: "Bạn có chắc chắn muốn từ chối!",
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
                    url: baseHome + "/thanhtoan/tuchoi",
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
    } else {
        notify_error('Phiếu đã duyệt không thể từ chối');
    }
}