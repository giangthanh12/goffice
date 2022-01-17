var url = '';

$(function () {

    var linhvuc = $("#linh_vuc"),
        nhanvien = $("#phu_trach");

    "use strict";

    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/common/linhvuc",
        success: function (data) {
            $("#linh_vuc").select2({
                data: data,
            });
        },
    });

    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/common/nhanvien",
        success: function (data) {
            $("#phu_trach").select2({
                data: data,
            });
        },
    });

    // select2
    if (linhvuc.length) {

        linhvuc.each(function () {
            var $this = $(this);
            $this.wrap("<div class='position-relative'></div>").select2({
                placeholder: "Chọn lĩnh vực",
                dropdownParent: $this.parent(),
                escapeMarkup: function (es) {
                    return es;
                },
            });
        });

        nhanvien.each(function () {
            var $this = $(this);
            $this.wrap("<div class='position-relative'></div>").select2({
                placeholder: "Chọn nhân viên",
                dropdownParent: $this.parent(),
                escapeMarkup: function (es) {
                    return es;
                },
            });
        });
    }

    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/doitac/list",
            columns: [
                // columns according to JSON
                // { data: "" },
                { data: "name" },
                { data: "dien_thoai" },
                { data: "website" },
                { data: "email" },
                { data: "tinh_trang" },
                { data: "" },
            ],
            columnDefs: [
                {
                    // For Responsive
                    // className: "control",
                    // orderable: false,
                    // responsivePriority: 0,
                    // targets: 0,
                    // render: function (data, type, full, meta) {
                    //     return "";
                    // }
                },
                {
                    // User full name and username
                    targets: 0,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full["name"],
                            $uname = full["van_phong"];

                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="d-flex flex-column">' +
                            '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ')" data-toggle="modal" data-target="#updateinfo" class="user_name text-truncate"><span class="font-weight-bold">' +
                            $name +
                            "</span></a>" +
                            '<small class="emp_post text-muted">@' +
                            $uname +
                            "</small>" +
                            "</div>" +
                            "</div>";
                        return $row_output;
                    },
                },
                {
                    targets: 1,
                    render: function (data, type, full, meta) {
                        var $role = full["dien_thoai"];
                        var roleBadgeObj = {
                            Subscriber: feather.icons["user"].toSvg({ class: "font-medium-3 text-primary mr-50" }),
                            Author: feather.icons["settings"].toSvg({ class: "font-medium-3 text-warning mr-50" }),
                            Maintainer: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                            Editor: feather.icons["edit-2"].toSvg({ class: "font-medium-3 text-info mr-50" }),
                            Admin: feather.icons["slack"].toSvg({ class: "font-medium-3 text-danger mr-50" }),
                        };
                        return "<span class='text-truncate align-middle'>" + roleBadgeObj['Subscriber'] + $role + "</span>";
                    },
                },
                {
                    targets: 4,
                    visible: false,
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="btn-group">' +
                            '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
                            feather.icons["more-vertical"].toSvg({ class: "font-small-4" }) +
                            "</a>" +
                            '<div class="dropdown-menu dropdown-menu-right">' +
                            '<a href="javascript:void(0)" class="dropdown-item" data-toggle="modal" data-target="#updateinfo" onclick="loaddata(' + full["id"] + ')">' +
                            feather.icons["file-text"].toSvg({ class: "font-small-4 mr-50" }) +
                            "Xem/sửa</a>" +
                            '<a href="javascript:void(0)" class="dropdown-item delete-record" onclick="xoa(' + full["id"] + ')">' +
                            feather.icons["trash-2"].toSvg({ class: "font-small-4 mr-50" }) +
                            "Xóa</a></div>" +
                            "</div>" +
                            "</div>"
                        );
                    },
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
                        $(".modal-title").html('Thêm nhà cung cấp mới');
                        $('#name').val('');
                        $('#ten_day_du').val('');
                        $('#dai_dien').val('');
                        $('#dien_thoai').val('');
                        $('#email').val('');
                        $('#website').val('');
                        $('#van_phong').val('');
                        $('#dia_chi').val('');
                        $('#ma_so').val('');
                        $('#chuc_vu').val('');
                        $('#linh_vuc option[value=""]');
                        $('#loai option[value=""]');
                        $('#phu_trach option[value=""]');
                        $('#tinh_trang').attr("disabled", true);
                        $('#tinh_trang').val('1');
                        $('#phan_loai').val('');
                        $('#ghi_chu').val('');
                        url = baseHome + "/doitac/add";
                    },
                },
            ],
            // For responsive popup
            // responsive: {
            //     details: {
            //         display: $.fn.dataTable.Responsive.display.modal({
            //             header: function (row) {
            //                 var data = row.data();
            //                 return "Details of " + data["name"];
            //             },
            //         }),
            //         type: "column",
            //         renderer: $.fn.dataTable.Responsive.renderer.tableAll({
            //             tableClass: "table",
            //             columnDefs: [
            //                 {
            //                     targets: 8,
            //                     visible: false,
            //                 },
            //                 {
            //                     targets: 1,
            //                     visible: false,
            //                 },
            //             ],
            //         }),
            //     },
            // },
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            initComplete: function () {
                // Adding role filter once table initialized
                this.api()
                    .columns(4)
                    .every(function () {
                        var column = this;
                        var select = $('<select id="kh_tinhtrang" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Tình trạng </option></select>')
                            .appendTo(".kh_tinhtrang")
                            .on("change", function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? "^" + val + "$" : "", true, false).draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                var $stt_output = "";
                                if (d == 1) {
                                    $stt_output = "Khách hàng mới";
                                } else if (d == 2) {
                                    $stt_output = "Đang sử dụng dịch vụ";
                                } else if (d == 4) {
                                    $stt_output = "Đã dừng dùng dịch vụ";
                                } 
                                if($stt_output != ''){
                                    select.append('<option value="' + d + '" class="text-capitalize">' + $stt_output + "</option>");
                                }
                            });
                    });

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
    $(".modal-title").html('Cập nhật thông tin nhà cung cấp');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/doitac/loaddata",
        success: function (data) {
            $('#name').val(data.name);
            $('#ten_day_du').val(data.ten_day_du);
            $('#dai_dien').val(data.dai_dien);
            $('#dien_thoai').val(data.dien_thoai);
            $('#email').val(data.email);
            $('#website').val(data.website);
            $('#van_phong').val(data.van_phong);
            $('#dia_chi').val(data.dia_chi);
            $('#ma_so').val(data.ma_so);
            $('#chuc_vu').val(data.chuc_vu);
            $('#linh_vuc option[value=' + data.linh_vuc + ']').attr('selected', 'selected');
            $('#loai option[value=' + data.loai + ']').attr('selected', 'selected');
            $('#phu_trach option[value=' + data.phu_trach + ']').attr('selected', 'selected');
            $('#tinh_trang').attr("disabled", false);
            $('#tinh_trang').val(data.tinh_trang);
            $('#phan_loai').val(data.phan_loai);
            $('#ghi_chu').val(data.ghi_chu);
            url = baseHome + '/doitac/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function savedt() {
    var info = {};
    info.name = $("#name").val();
    info.ma_so = $("#ma_so").val();
    info.ten_day_du = $("#ten_day_du").val();
    info.dia_chi = $("#dia_chi").val();
    info.dien_thoai = $("#dien_thoai").val();
    info.website = $("#website").val();
    info.email = $("#email").val();
    info.van_phong = $("#van_phong").val();
    info.dai_dien = $("#dai_dien").val();
    info.chuc_vu = $("#chuc_vu").val();
    info.loai = $("#loai").val();
    info.linh_vuc = $("#linh_vuc").val();
    info.ghi_chu = $("#ghi_chu").val();
    info.nhan_vien = $("#nhan_vien").val();
    info.phu_trach = $("#phu_trach").val();
    info.tinh_trang = $("#tinh_trang").val();
    info.phan_loai = $("#phan_loai").val();
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

function xoa(id) {
    $.ajax({
        url: baseHome + "/doitac/del",
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

