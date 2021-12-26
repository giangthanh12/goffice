
$(function () {
    return_combobox_multi('#nhan_vien', baseHome + '/common/nhanvien', 'Lựa chọn nhân viên');
    return_combobox_multi('#loai', baseHome + '/loaihd/combo', 'Lựa chọn loại hợp đồng');
    return_combobox_multi('#phong_ban', baseHome + '/phongban/combo', 'Lựa chọn phòng ban');
    return_combobox_multi('#chi_nhanh', baseHome + '/chinhanh/combo', 'Lựa chọn chi nhánh');

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
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/hopdongld/list",
            ordering: false,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "name" },
                { data: "loaihd" },
                { data: "nhanvien" },
                { data: "phongban" },
                { data: "chinhanh" },
                { data: "vitri" },
                { data: "status" },
                { data: "type" },
                { data: "" },
            ],
            columnDefs: [
                {
                    targets: 0,
                    responsivePriority: 4,
                    visible: false,
                },
                {
                    targets: 1,
                    render: function (data, type, full, meta) {
                        return '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ')" >' +
                            '<span class="align-middle font-weight-bold">' + full["name"] + "</span></a>";
                    },
                    width: 200
                },
                {
                    targets: 2,
                },
                {
                    targets: 4,
                },
                {
                    targets: 7,
                    render: function (data, type, full, meta) {
                        var $status = full["tinh_trang"];

                        if ($status == 1) {
                            return "<span>Đang thực hiện</span>";
                        } else if ($status == 2) {
                            return "<span>Đã kết thúc</span>";
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
                        $(".modal-title").html('Thêm hợp đồng mới');
                        $('#nhan_vien').val('').change();
                        $('#name').val('');
                        $('#loai').val('').change();
                        $('#ca').val('').change();
                        $('#luong_co_ban').val('');
                        $('#ty_le_luong').val('');
                        $('#phu_cap').val('');
                        $('#luong_bao_hiem').val('');
                        $('#ngay_di_lam').val('');
                        $('#ngay_ket_thuc').val('');
                        $('#phong_ban').val('').change();
                        $('#vi_tri').val('').attr("disabled", true);
                        $('#loai').val('').change();
                        $('#chi_nhanh').val('').change();
                        $('#tinh_trang').val('1').attr("disabled", true);
                        $('#ghi_chu').val('');
                        url = baseHome + "/hopdongld/add";
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
            initComplete: function () {
                // Adding role filter once table initialized
                // this.api()
                //     .columns(8)
                //     .every(function () {
                //         var column = this;
                //         var select = $('<select id="kh_tinhtrang" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Loại hợp đồng </option></select>')
                //             .appendTo(".kh_tinhtrang")
                //             .on("change", function () {
                //                 var val = $.fn.dataTable.util.escapeRegex($(this).val());
                //                 column.search(val ? "^" + val + "$" : "", true, false).draw();
                //             });

                //         column
                //             .data()
                //             .unique()
                //             .sort()
                //             .each(function (d, j) {
                //                 var $stt_output = "";
                //                 if (d == 1) {
                //                     $stt_output = "Thực tập sinh";
                //                 } else if (d == 2) {
                //                     $stt_output = "Thử việc";
                //                 } else if (d == 3) {
                //                     $stt_output = "Chính thức";
                //                 } else if (d == 4) {
                //                     $stt_output = "Cộng tác viên";
                //                 } else if (d == 5) {
                //                     $stt_output = "Tạm ngừng";
                //                 }
                //                 if ($stt_output != '') {
                //                     select.append('<option value="' + d + '" class="text-capitalize">' + $stt_output + "</option>");
                //                 }
                //             });
                //     });

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
    $(".modal-title").html('Cập nhật thông tin hợp đồng');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/hopdongld/loaddata",
        success: function (data) {
            $('#name').val(data.name);
            $('#luong_co_ban').val(data.basicSalary);
            $('#ty_le_luong').val(data.salaryPercentage);
            $('#phu_cap').val(data.allowance);
            $('#luong_bao_hiem').val(data.insuranceSalary);
            $('#ngay_di_lam').val(data.startDate);
            $('#ngay_ket_thuc').val(data.severanceDate);
            $('#nhan_vien').val(data.staffId).change();
            $('#phong_ban').val(data.department).change();
            $('#vi_tri').val(data.position).change();
            $('#chi_nhanh').val(data.branch).change();
            $('#loai').val(data.type).change();
            $('#ca').val(data.shift).change();
            $('#tinh_trang').val(data.status).change().attr("disabled", false);
            $('#ghi_chu').val(data.description);

            url = baseHome + '/hopdongld/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function savekh() {
    var info = {};
    info.name = $("#name").val();
    info.luong_co_ban = $("#luong_co_ban").val();
    info.ty_le_luong = $("#ty_le_luong").val();
    info.luong_bao_hiem = $("#luong_bao_hiem").val();
    info.phu_cap = $("#phu_cap").val();
    info.ngay_di_lam = $("#ngay_di_lam").val();
    info.ngay_ket_thuc = $("#ngay_ket_thuc").val();
    info.nhan_vien = $("#nhan_vien").val();
    info.phong_ban = $("#phong_ban").val();
    info.vi_tri = $("#vi_tri").val();
    info.chi_nhanh = $("#chi_nhanh").val();
    info.loai = $("#loai").val();
    info.ca = $("#ca").val();
    info.tinh_trang = $("#tinh_trang").val();
    info.ghi_chu = $("#ghi_chu").val();
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
                url: baseHome + "/hopdongld/del",
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

function changePB() {
    var opt = $("#phong_ban").val();
    return_combobox_multi('#vi_tri', baseHome + '/vitri/combo?phongban=' + opt, 'Lựa chọn vị trí');
    $('#vi_tri').val('').attr("disabled", false);
}
