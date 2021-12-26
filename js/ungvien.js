var defaultDate = '';
var uvid = '';
var dtMemberTable = $("#member-list-table");
var dtHVTable = $("#hocvan-list-table");
var dtKNTable = $("#kinhnghiem-list-table");
$(function () {
    var basicPickr = $('.flatpickr-basic');
    // Default
    if (basicPickr.length) {
        basicPickr.flatpickr({
            defaultDate: defaultDate,
            dateFormat: "d/m/Y",
        });
    }

    "use strict";

    var dtUserTable = $(".user-list-table"),
        newUserSidebar = $(".new-user-modal"),
        newUserForm = $(".add-new-user");

    return_combobox_multi('#nguon', baseHome + '/nguonuv/combo', 'Chọn nguồn ứng viên');
    return_combobox_multi('#chiendich', baseHome + '/chiendich/combo', 'Chọn chiến dich');
    return_combobox_multi('#noisinh', baseHome + '/ungvien/thanhpho', 'Chọn nơi sinh');
    return_combobox_multi('#nguyenquan', baseHome + '/ungvien/thanhpho', 'Chọn nguyên quán');
    return_combobox_multi('#noicap', baseHome + '/ungvien/thanhpho', 'Chọn nơi cấp');

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            ajax: baseHome + "/ungvien/list",
            columns: [
                { data: "id" },
                { data: "ten_day_du" },
                { data: "gioi_tinh" },
                { data: "email" },
                { data: "dien_thoai" },
                { data: "ket_qua" },
                { data: "ghi_chu" },
                { data: "tinh_trang" },
                { data: "" },
            ],
            columnDefs: [
                {
                    className: "control",
                    orderable: false,
                    responsivePriority: 2,
                    targets: 0,
                },
                {
                    // User full name and username
                    targets: 1,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $id = full["id"];
                        var $name = full["ten_day_du"];
                        var $vitri = full["vi_tri"];
                        return '<div class="d-flex flex-column">' +
                            '<a href="javascript:void(0)" onclick="loaddata(' + $id + ')" data-toggle="modal" data-target="#updateinfo" class="user_name text-truncate"><span class="font-weight-bold">' +
                            $name +
                            "</span></a>" +
                            '<small class="emp_post text-muted">@' +
                            $vitri +
                            "</small>" +
                            "</div>";
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        var $status = full["gioi_tinh"];
                        if ($status == 1) {
                            return 'Nam';
                        } else if ($status == 2) {
                            return 'Nữ';
                        } else {
                            return '';
                        }
                    },
                },
                {
                    // User Status
                    targets: 7,
                    render: function (data, type, full, meta) {
                        var $status = full["tinh_trang"];
                        if ($status == 1) {
                            return 'Mới';
                        } else if ($status == 2) {
                            return 'CV đạt';
                        } else if ($status == 3) {
                            return 'CV không đạt';
                        } else if ($status == 4) {
                            return 'Hẹn phỏng vấn';
                        } else if ($status == 5) {
                            return 'Không liên lạc được';
                        } else if ($status == 6) {
                            return 'Đạt phỏng vấn';
                        } else if ($status == 7) {
                            return 'Không đạt phỏng vấn';
                        } else if ($status == 8) {
                            return 'Từ chối';
                        } else {
                            return '';
                        }
                    },
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-center text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="del(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                        return html;
                    },
                    width: 150
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
                searchPlaceholder: "Search..",
            },
            // Buttons with Dropdown
            buttons: [
                {
                    text: "Thêm mới",
                    className: "add-new btn btn-primary mt-50",
                    attr: {
                        "data-toggle": "modal",
                        "data-target": "#modals-slide-in",
                    },
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                    },
                    action: function (e, dt, node, config) {
                        $('#dg')[0].reset();
                        $('#ngay_sinh').flatpickr({
                            // monthSelectorType: "static",
                            altInput: true,
                            defaultDate: "",
                            altFormat: "j F, Y",
                            dateFormat: "d/m/Y",
                        })
                    }
                },
            ],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Details of " + data["name"];
                        },
                    }),
                    type: "column",
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: "table",
                        columnDefs: [
                            {
                                targets: 2,
                                visible: false,
                            },
                            {
                                targets: 3,
                                visible: false,
                            },
                        ],
                    }),
                },
            },
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
                    .columns(7)
                    .every(function () {
                        var column = this;
                        var select = $('<select id="uv_tinhtrang" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Tình trạng </option></select>')
                            .appendTo(".user_role")
                            .on("change", function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? "^" + val + "$" : "", true, false).draw();
                            });
                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                if (d == 1) {
                                    select.append('<option value="' + d + '" class="text-capitalize">Mới</option>');
                                } else if (d == 2) {
                                    select.append('<option value="' + d + '" class="text-capitalize">CV đạt</option>');
                                } else if (d == 3) {
                                    select.append('<option value="' + d + '" class="text-capitalize">CV không đạt</option>');
                                } else if (d == 4) {
                                    select.append('<option value="' + d + '" class="text-capitalize">Hẹn phỏng vấn</option>');
                                } else if (d == 5) {
                                    select.append('<option value="' + d + '" class="text-capitalize">Không liên lạc được</option>');
                                } else if (d == 6) {
                                    select.append('<option value="' + d + '" class="text-capitalize">Đạt phỏng vấn</option>');
                                } else if (d == 7) {
                                    select.append('<option value="' + d + '" class="text-capitalize">Không đạt phỏng vấn</option>');
                                } else if (d == 8) {
                                    select.append('<option value="' + d + '" class="text-capitalize">Từ chối</option>');
                                }
                            });
                    });
                // // Adding plan filter once table initialized
                // this.api()
                //     .columns(4)
                //     .every(function () {
                //         var column = this;
                //         var select = $('<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Phòng ban </option></select>')
                //             .appendTo(".user_plan")
                //             .on("change", function () {
                //                 var val = $.fn.dataTable.util.escapeRegex($(this).val());
                //                 column.search(val ? "^" + val + "$" : "", true, false).draw();
                //             });

                //         column
                //             .data()
                //             .unique()
                //             .sort()
                //             .each(function (d, j) {
                //                 select.append('<option value="' + d + '" class="text-capitalize">' + d + "</option>");
                //             });
                //     });
                // // Adding status filter once table initialized
                // this.api()
                //     .columns(5)
                //     .every(function () {
                //         var column = this;
                //         var select = $('<select id="FilterTransaction" class="form-control text-capitalize mb-md-0 mb-2xx"><option value=""> Hợp đồng lao động </option></select>')
                //             .appendTo(".user_status")
                //             .on("change", function () {
                //                 var val = $.fn.dataTable.util.escapeRegex($(this).val());
                //                 column.search(val ? "^" + val + "$" : "", true, false).draw();
                //             });

                //         column
                //             .data()
                //             .unique()
                //             .sort()
                //             .each(function (d, j) {
                //                 select.append('<option value="' + statusObj[d].title + '" class="text-capitalize">' + statusObj[d].title + "</option>");
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
    if (newUserForm.length) {
        newUserForm.validate({
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

        newUserForm.on("submit", function (e) {
            var isValid = newUserForm.valid();
            e.preventDefault();
            if (isValid) {
                newUserSidebar.modal("hide");
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
    uvid = id;
    $('#tab-1').click();
    $('#updateinfo').modal('show');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/ungvien/loaddata",
        success: function (data) {
           
            $('#ungvien').html(data.ten_day_du);
            $('#avatar').attr('src', data.hinh_anh);
            if (data.gioi_tinh == 1)
                $("#male").prop("checked", true).trigger("click");
            else if (data.gioi_tinh == 2)
                $("#female").prop("checked", true).trigger("click");

            if (data.tt_hon_nhan == 1)
                $("#tthn1").prop("checked", true).trigger("click");
            else if (data.tt_hon_nhan == 2)
                $("#tthn2").prop("checked", true).trigger("click");
            else if (data.tt_hon_nhan == 3)
                $("#tthn3").prop("checked", true).trigger("click");
            $('#hoten').val(data.ten_day_du);
            $('#quoctich').val(data.quoc_tich);
            $('#dantoc').val(data.dan_toc);
            $('#tongiao').val(data.ton_giao);
            if (data.ngay_sinh != '0000-00-00')
                defaultDate = data.ngay_sinh;
            else
                defaultDate = '';
            $('#ngaysinh').flatpickr({
                // monthSelectorType: "static",
                altInput: true,
                defaultDate: defaultDate,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
            });
            $('#noisinh option[value=' + data.noi_sinh + ']').attr('selected', 'selected');
            $("#noisinh").val(data.noi_sinh).change();
            $('#nguyenquan option[value=' + data.nguyen_quan + ']').attr('selected', 'selected');
            $("#nguyenquan").val(data.nguyen_quan).change();
            $('#luongchinhthuc').val(data.luong_chinh_thuc);
            $('#luongthuviec').val(data.luong_thu_viec);
            $('#ghichu').html(data.ghi_chu);
            $('#nguon option[value=' + data.nguon + ']').attr('selected', 'selected');
            $('#chiendich option[value=' + data.chien_dich + ']').attr('selected', 'selected');
            $("#chiendich").val(data.chien_dich).change();
            $('#cmnd').val(data.cmnd);
            if (data.ngay_cap != '0000-00-00')
                defaultDate = data.ngay_cap;
            else
                defaultDate = '';
            $('#ngaycap').flatpickr({
                // monthSelectorType: "static",
                altInput: true,
                defaultDate: defaultDate,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
            });
            $('#noicap option[value=' + data.noi_cap + ']').attr('selected', 'selected');
            $("#noicap").val(data.noi_cap).change();
            $('#thuongtru').val(data.thuong_tru);
            $('#choohiennay').val(data.cho_o_hien_nay);
            $('#dienthoai').val(data.dien_thoai);
            $('#e_mail').val(data.email);
            url = baseHome + "/ungvien/update?id=" + id;
            loadmembers(id);
            loadlisthv(id);
            loadlistkn(id);
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });

}

function updateinfo() {
    var info = {};
    info.gioi_tinh = $("input[type='radio'][name='gender']:checked").val();
    info.tt_hon_nhan = $("input[type='radio'][name='tthonnhan']:checked").val();
    info.ten_day_du = $("#hoten").val();
    info.quoc_tich = $("#quoctich").val();
    info.dan_toc = $("#dantoc").val();
    info.ton_giao = $("#tongiao").val();
    info.ngay_sinh = $("#ngaysinh").val();
    info.noi_sinh = $("#noisinh").val();
    info.nguyen_quan = $("#nguyenquan").val();
    info.luong_chinh_thuc = $("#luongchinhthuc").val();
    info.luong_thu_viec = $("#luongthuviec").val();
    info.ghi_chu = $("#ghichu").val();
    info.nguon = $("#nguon").val();
    info.chien_dich = $("#chiendich").val();
    info.cmnd = $("#cmnd").val();
    info.ngay_cap = $("#ngaycap").val();
    info.noi_cap = $("#noicap").val();
    info.thuong_tru = $("#thuongtru").val();
    info.cho_o_hien_nay = $("#choohiennay").val();
    info.dien_thoai = $("#dienthoai").val();
    info.email = $("#e_mail").val();
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

function thayanh() {
    var myform = new FormData($('#thongtin')[0]);
    myform.append('myid', uvid);
    $.ajax({
        url: baseHome + "/ungvien/thayanh",
        type: 'post',
        data: myform,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#avatar').attr('src', data.filename);
            }
            else
                notify_error(data.msg);
        },
    });
}

function saveadd() {
    var info = {};
    info.ten_day_du = $("#ten_day_du").val();
    info.gioi_tinh = $("input[type='radio'][name='gioi_tinh']:checked").val();
    info.ngay_sinh = $("#ngay_sinh").val();
    info.dien_thoai = $("#dien_thoai").val();
    info.email = $("#email").val();
    info.vi_tri = $("#vi_tri").val();
    info.ghi_chu = $("#ghi_chu").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: baseHome + "/ungvien/add",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#modals-slide-in').modal('hide');
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
    $.ajax({
        url: baseHome + "/ungvien/del",
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

// Thông tin gia đình
function loadmembers(id) {
    uvid = id;
    if (dtMemberTable.length) {
        dtMemberTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/ungvien/loadmembers?id=" + id,
            destroy: true,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "moi_quan_he" },
                { data: "ten_day_du" },
                { data: "nghe_nghiep" },
                { data: "dien_thoai" },
                { data: "" },
            ],
            columnDefs: [
                {
                    // For Responsive
                    targets: 0,
                    className: "control",
                    orderable: false,
                    responsivePriority: 2,
                    visible: false
                },
                {
                    // User full name and username
                    targets: 1,
                },
                {
                    targets: 2,
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-center text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loadmember(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="delmember(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                        return html;
                    },
                    width: 150
                },
            ],
            // dom:
            //     '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
            //     '<"col-lg-12 col-xl-6" l>' +
            //     '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
            //     ">t" +
            //     '<"d-flex justify-content-between mx-2 row mb-1"' +
            //     '<"col-sm-12 col-md-6"i>' +
            //     '<"col-sm-12 col-md-6"p>' +
            //     ">",
            language: {
                sLengthMenu: "Show _MENU_",
                search: "Search",
                searchPlaceholder: "Search..",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                }
            },

            // // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Details of " + data["name"];
                        },
                    }),
                    type: "column",
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: "table",
                        columnDefs: [
                            {
                                targets: 2,
                                visible: false,
                            },
                            {
                                targets: 3,
                                visible: false,
                            },
                        ],
                    }),
                },
            }
        });
        urltab2 = baseHome + "/ungvien/addmember?ung_vien=" + id;
    }
}

function loadmember(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/ungvien/loadmember",
        success: function (data) {
            $('#ttuv1').val(data.ten_day_du);
            if (data.ngay_sinh != '0000-00-00')
                defaultDate = data.ngay_sinh;
            else
                defaultDate = '';
            $('#ttuv2').flatpickr({
                // monthSelectorType: "static",
                altInput: true,
                defaultDate: defaultDate,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
            });
            $('#ttuv3').val(data.nghe_nghiep);
            $('#ttuv4').val(data.dien_thoai);
            $('#ttuv5').val(data.dia_chi);
            $('#ttuv6').val(data.moi_quan_he);
            urltab2 = baseHome + "/ungvien/updatemember?id=" + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function savemember() {
    var member = {};
    member.ten_day_du = $("#ttuv1").val();
    member.ngay_sinh = $("#ttuv2").val();
    member.nghe_nghiep = $("#ttuv3").val();
    member.dien_thoai = $("#ttuv4").val();
    member.dia_chi = $("#ttuv5").val();
    member.moi_quan_he = $("#ttuv6").val();
    $.ajax({
        url: urltab2,
        type: 'post',
        dataType: "json",
        data: member,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                dtMemberTable.DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
    });
}

function delmember(id){
    $.ajax({
        url: baseHome + "/ungvien/delmember",
        type: 'post',
        dataType: "json",
        data: { id: id },
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                dtMemberTable.DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
    });
}

function clearfmtab2() {
    urltab2 = baseHome + "/ungvien/addmember?ung_vien=" + uvid;
    $('#fm-tab2')[0].reset();
}

// Thông tin học vấn
function loadlisthv(id) {
    uvid = id;
    if (dtHVTable.length) {
        dtHVTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/ungvien/loadlisthv?id=" + id,
            destroy: true,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "ngay_bat_dau" },
                { data: "ngay_ket_thuc" },
                { data: "noi_dao_tao" },
                { data: "chuyen_nganh" },
                { data: "bang_cap" },
                { data: "" },
            ],
            columnDefs: [
                {
                    // For Responsive
                    targets: 0,
                    className: "control",
                    orderable: false,
                    responsivePriority: 2,
                    visible: false
                },
                {
                    // User full name and username
                    targets: 1,
                },
                {
                    targets: 2,
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-center text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loadhv(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="delhv(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                        return html;
                    },
                    width: 150
                },
            ],
            // dom:
            //     '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
            //     '<"col-lg-12 col-xl-6" l>' +
            //     '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
            //     ">t" +
            //     '<"d-flex justify-content-between mx-2 row mb-1"' +
            //     '<"col-sm-12 col-md-6"i>' +
            //     '<"col-sm-12 col-md-6"p>' +
            //     ">",
            language: {
                sLengthMenu: "Show _MENU_",
                search: "Search",
                searchPlaceholder: "Search..",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                }
            },

            // // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Details of " + data["name"];
                        },
                    }),
                    type: "column",
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: "table",
                        columnDefs: [
                            {
                                targets: 2,
                                visible: false,
                            },
                            {
                                targets: 3,
                                visible: false,
                            },
                        ],
                    }),
                },
            }
        });
        urltab3 = baseHome + "/ungvien/addhv?ung_vien=" + id;
    }
}

function loadhv(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/ungvien/loadhv",
        success: function (data) {
            if (data.ngay_bat_dau != '0000-00-00')
                defaultDate = data.ngay_bat_dau;
            else
                defaultDate = '';
            $('#hvuv1').flatpickr({
                // monthSelectorType: "static",
                altInput: true,
                defaultDate: defaultDate,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
            });
            if (data.ngay_ket_thuc != '0000-00-00')
                defaultDate = data.ngay_ket_thuc;
            else
                defaultDate = '';
            $('#hvuv2').flatpickr({
                // monthSelectorType: "static",
                altInput: true,
                defaultDate: defaultDate,
                // altFormat: "j F, Y",
                dateFormat: "d/m/Y",
            });
            $('#hvuv3').val(data.noi_dao_tao);
            $('#hvuv4').val(data.chuyen_nganh);
            $('#hvuv5').val(data.hinh_thuc);
            $('#hvuv6').val(data.bang_cap);
            urltab3 = baseHome + "/ungvien/updatehv?id=" + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function savehv() {
    var hv = {};
    hv.ngay_bat_dau = $("#hvuv1").val();
    hv.ngay_ket_thuc = $("#hvuv2").val();
    hv.noi_dao_tao = $("#hvuv3").val();
    hv.chuyen_nganh = $("#hvuv4").val();
    hv.hinh_thuc = $("#hvuv5").val();
    hv.bang_cap = $("#hvuv6").val();
    $.ajax({
        url: urltab3,
        type: 'post',
        dataType: "json",
        data: hv,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                dtHVTable.DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
    });
}

function delhv(id){
    $.ajax({
        url: baseHome + "/ungvien/delhv",
        type: 'post',
        dataType: "json",
        data: { id: id },
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                dtHVTable.DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
    });
}

function clearfmtab3() {
    urltab3 = baseHome + "/ungvien/addhv?ung_vien=" + uvid;
    $('#fm-tab3')[0].reset();
}

// Thông tin kinh nghiệm
function loadlistkn(id) {
    uvid = id;
    if (dtKNTable.length) {
        dtKNTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/ungvien/loadlistkn?id=" + id,
            destroy: true,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "ngay_bat_dau" },
                { data: "ngay_ket_thuc" },
                { data: "cong_ty" },
                { data: "vi_tri" },
                { data: "" },
            ],
            columnDefs: [
                {
                    // For Responsive
                    targets: 0,
                    className: "control",
                    orderable: false,
                    responsivePriority: 2,
                    visible: false
                },
                {
                    // User full name and username
                    targets: 1,
                },
                {
                    targets: 2,
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-center text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loadkn(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="delkn(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                        return html;
                    },
                    width: 150
                },
            ],
            // dom:
            //     '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
            //     '<"col-lg-12 col-xl-6" l>' +
            //     '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
            //     ">t" +
            //     '<"d-flex justify-content-between mx-2 row mb-1"' +
            //     '<"col-sm-12 col-md-6"i>' +
            //     '<"col-sm-12 col-md-6"p>' +
            //     ">",
            language: {
                sLengthMenu: "Show _MENU_",
                search: "Search",
                searchPlaceholder: "Search..",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                }
            },

            // // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Details of " + data["name"];
                        },
                    }),
                    type: "column",
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: "table",
                        columnDefs: [
                            {
                                targets: 2,
                                visible: false,
                            },
                            {
                                targets: 3,
                                visible: false,
                            },
                        ],
                    }),
                },
            }
        });
        urltab4 = baseHome + "/ungvien/addkn?ung_vien=" + id;
    }
}

function loadkn(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/ungvien/loadkn",
        success: function (data) {
            if (data.ngay_bat_dau != '0000-00-00')
                defaultDate = data.ngay_bat_dau;
            else
                defaultDate = '';
            $('#knuv1').flatpickr({
                // monthSelectorType: "static",
                altInput: true,
                defaultDate: defaultDate,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
            });
            if (data.ngay_ket_thuc != '0000-00-00')
                defaultDate = data.ngay_ket_thuc;
            else
                defaultDate = '';
            $('#knuv2').flatpickr({
                // monthSelectorType: "static",
                altInput: true,
                defaultDate: defaultDate,
                altFormat: "j F, Y",
                dateFormat: "d/m/Y",
            });
            $('#knuv3').val(data.cong_ty);
            $('#knuv4').val(data.vi_tri);
            $('#knuv5').val(data.nguoi_tham_chieu);
            $('#knuv6').val(data.dien_thoai);
            $('#knuv7').val(data.ghi_chu);
            $('#knuv8').val(data.du_an);
            urltab4 = baseHome + "/ungvien/updatekn?id=" + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function savekn() {
    var kn = {};
    kn.ngay_bat_dau = $("#knuv1").val();
    kn.ngay_ket_thuc = $("#knuv2").val();
    kn.cong_ty = $("#knuv3").val();
    kn.vi_tri = $("#knuv4").val();
    kn.nguoi_tham_chieu = $("#knuv5").val();
    kn.dien_thoai = $("#knuv6").val();
    kn.ghi_chu = $("#knuv7").val();
    kn.du_an = $("#knuv8").val();
    $.ajax({
        url: urltab4,
        type: 'post',
        dataType: "json",
        data: kn,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                dtKNTable.DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
    });
}

function delkn(id){
    $.ajax({
        url: baseHome + "/ungvien/delkn",
        type: 'post',
        dataType: "json",
        data: { id: id },
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                dtKNTable.DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
    });
}

function clearfmtab4() {
    urltab4 = baseHome + "/ungvien/addkn?ung_vien=" + uvid;
    $('#fm-tab4')[0].reset();
}