var url = '';
var dtDVTable = $("#dichvu-list-table");
var khid = '';
$(function () {
    "use strict";

    return_combobox_multi('#linh_vuc', baseHome + '/common/linhvuc', 'Chọn lĩnh vực');
    return_combobox_multi('#linh_vuc_e', baseHome + '/common/linhvuc', 'Chọn lĩnh vực');
    return_combobox_multi('#phu_trach', baseHome + '/common/nhanvien', 'Chọn nhân viên');
    return_combobox_multi('#phu_trach_e', baseHome + '/common/nhanvien', 'Chọn nhân viên');
    return_combobox_multi('#phan_loai_import', baseHome + '/common/loaikh', 'Chọn loại khách hàng');
    return_combobox_multi('#phutrach_import', baseHome + '/common/nhanvien', 'Chọn nhân viên');
    $('#phutrach_import').val('').change();
    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/khachhang/list",
            autoWidth: false,
            ordering: false,
            columns: [
                // columns according to JSON
                // { data: "" },
                { data: "name" },
                { data: "phoneNumber" },
                { data: "website" },
                { data: "email" },
                { data: "status" },
                { data: "" },
            ],
            columnDefs: [

                {
                    // User full name and username
                    targets: 0,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full["name"],
                            $uname = full["office"];
                        if ($name == '') {
                            $name = full["fullName"];
                        }
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
                        var $role = full["phoneNumber"];
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
                        var html = '';
                        html += '<div style="width:150px;text-align:right">';
                        html += '<button type="button" class="btn btn-icon btn-outline-success waves-effect" data-toggle="tooltip" data-placement="top" data-original-title="Tạo báo giá" onclick="loadbaogia(' + full['id'] + ')">';
                        html += '<i class="fas fa-cart-plus"></i>';
                        html += '</button> &nbsp;';

                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="xoa(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button></div>';
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
                        $("#addinfo").modal('show');
                        $(".modal-title").html('Thêm khách hàng mới');
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
                        $('#linh_vuc').val('').change();
                        $('#loai').val(0).change();
                        $('#phu_trach').val('').change();
                        $('#tinh_trang').val('1').attr("disabled", true);
                        $('#phan_loai').val('1').attr("disabled", true);
                        $('#ghi_chu').val('');
                    },
                },
                {
                    text: "Nhập excel",
                    className: " btn btn-primary mt-50",
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                    },
                    action: function (e, dt, node, config) {
                        nhapexcel();
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
                                if ($stt_output != '') {
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
    khid = id;
    $("#updateinfo").modal('show');
    $('#information-tab').click();
    $(".modal-title").html('Cập nhật thông tin khách hàng');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/khachhang/loaddata",
        success: function (data) {
            $('#name_e').val(data.name);
            $('#ten_day_du_e').val(data.fullName);
            $('#dai_dien_e').val(data.representative);
            $('#dien_thoai_e').val(data.phoneNumber);
            $('#email_e').val(data.email);
            $('#website_e').val(data.website);
            $('#van_phong_e').val(data.office);
            $('#dia_chi_e').val(data.address);
            $('#ma_so_e').val(data.taxCode);
            $('#chuc_vu_e').val(data.position);
            $('#linh_vuc_e').val(data.field).change();
            $('#phu_trach_e').val(data.staffInCharge).change();
            $('#loai_e option[value=' + data.type + ']').attr('selected', 'selected').change();
            $('#tinh_trang_e').attr("disabled", false);
            $('#tinh_trang_e').val(data.status);
            $('#phan_loai_e').attr("disabled", false);
            $('#phan_loai_e').val(data.classify);
            $('#ghi_chu_e').val(data.note);
            //loaddichvu(id);
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function loaddichvu(id) {
    if (dtDVTable.length) {
        dtDVTable.DataTable({
            ajax: baseHome + "/khachhang/loaddichvu?id=" + id,
            destroy: true,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "dich_vu" },
                { data: "ten_mien" },
                { data: "ngay_bd" },
                { data: "ngay_kt" },
                // { data: "" },
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
    }
}

function saveadd() {
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
        url: baseHome + "/khachhang/add",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('.modal').modal('hide');
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

function saveedit() {
    var info = {};
    info.name = $("#name_e").val();
    info.ma_so = $("#ma_so_e").val();
    info.ten_day_du = $("#ten_day_du_e").val();
    info.dia_chi = $("#dia_chi_e").val();
    info.dien_thoai = $("#dien_thoai_e").val();
    info.website = $("#website_e").val();
    info.email = $("#email_e").val();
    info.van_phong = $("#van_phong_e").val();
    info.dai_dien = $("#dai_dien_e").val();
    info.chuc_vu = $("#chuc_vu_e").val();
    info.loai = $("#loai_e").val();
    info.linh_vuc = $("#linh_vuc_e").val();
    info.ghi_chu = $("#ghi_chu_e").val();
    info.nhan_vien = $("#nhan_vien_e").val();
    info.phu_trach = $("#phu_trach_e").val();
    info.tinh_trang = $("#tinh_trang_e").val();
    info.phan_loai = $("#phan_loai_e").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: baseHome + '/khachhang/update?id=' + khid,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('.modal').modal('hide');
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
                url: baseHome + "/khachhang/del",
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

function nhapexcel() {
    $("#nhapexcel").modal('show');
    $("#modal-title1").html('Nhập khách hàng từ file excel');
}

function savenhap() {
    var myform = new FormData($("#fm-nhapexcel")[0]);
    $.ajax({
        type: "POST",
        dataType: "json",
        data: myform,
        url: baseHome + "/customer/importExcel",
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#nhapexcel').modal('hide');
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





///// ADD bao gia js


function loadbaogia(id) {
    $('#modal_baogia').modal('show');
    $(".modal-title").html('Tạo báo giá');
    $("#table_sp").empty();
    $("#viewfile").empty();
    var dateObj = new Date();
    var thang = dateObj.getMonth();
    thang = thang+1;
    thang = thang > 9 ? thang : '0' + thang;
    var ngay = dateObj.getDate();
    ngay = ngay > 9 ? ngay : '0' + ngay;
    var dateToUse = dateObj.getFullYear() + "-" + thang + "-" + ngay;
        
    $('#ngay').val(dateToUse);
    $('#tong_donhang').val('');
    $('#chiet_khau').val('');
    $('#thanh_toan').val('');
    $('#file_bg').val('');
    $('#khach_hang_bg').empty();
    $('#nhan_vien_bg').val(0);
    $('#nhan_vien_bg').trigger("change");
    $('#dich_vu').val(0);
    $('#dich_vu').trigger("change");
    $('#san_pham').val(0);
    $('#san_pham').trigger("change");
    $('.btn-add').attr("disabled", true);
    $('#ghi_chu_bg').val('');

    
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/baogia/load_id_kh",
        success: function (data) {
            $("#khach_hang_bg").val(data.id).trigger('change');
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });

    var nhan_vien = $('#nhan_vien_bg');

    var dich_vu = $('#dich_vu');
    var san_pham = $('#san_pham');
    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/baogia/nhanvien",
        success: function (data) {
            nhan_vien.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: nhan_vien.parent(),
            width: '100%',
            data: data
            });
        },
    });
    var khach_hang = $('#khach_hang_bg');
    $.ajax({ 
        type: "GET",
        dataType: "json",
        data:{id:id},
        async: false,
        url: baseHome + "/baogia/loaddata_kh",
        success: function (data) {
            khach_hang.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: khach_hang.parent(),
            width: '100%',
            data: data
            });
        },
    });

    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/baogia/dichvu",
        success: function (data) {
            dich_vu.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: dich_vu.parent(),
            width: '100%',
            data: data
            });
        },
    });

    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/baogia/sanpham",
        success: function (data) {
            san_pham.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: san_pham.parent(),
            width: '100%',
            data: data
            });
        },
    });

}


function load_dichvu(){
    var id = $('#dich_vu').val();
    var khach_hang = $('#khach_hang_bg').val();
    var nhan_vien = $('#nhan_vien_bg').val();
    if(khach_hang >0 && nhan_vien>0){
        $(".btn-add").attr("disabled", false);
    }else{
        $(".btn-add").attr("disabled", true);
    }
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id},
        url: baseHome + "/baogia/load_dichvu",
        success: function (data) {
            var stt = $('#stt').val();
            var i =  Number(stt) + 1;
            $('#stt').val(i);
            $('#table_sp').append('<tr id="arr'+i+'"><td>'+data.name+'</td><td><input type="text" id="don_gia'+i+'" onkeyup="load_tien('+i+')" name="don_gia[]" class="form-control input format_number" value="'+data.don_gia+'"></td><td><input type="hidden" name="id_sp[]" id="id_sp['+i+']" value="'+data.id+'"></input><input type="hidden" name="loai[]" id="loai['+i+']" value="0"></input><input type="text" onkeyup="load_tien('+i+')" name="so_luong[]" id="so_luong'+i+'" value="1" class="form-control input" ></td><td><input type="text" id="chiet_khau'+i+'" onkeyup="load_tien('+i+')" name="chiet_khau_tm[]" class="form-control input format_number" value="0"></td><td><select name="thue[]" id="thue'+i+'" class="thue'+i+' form-control" onchange="load_tien('+i+')"><option value="0">Không</option><option value="5">5%</option><option value="10">10%</option></select></td><td><input type="text" id="tien_thue'+i+'" name="tien_thue[]" onkeyup="load_tien('+i+')" value="'+data.thue_vat+'" class="form-control input format_number"></td><td><input type="date" id="ngay_s" name="ngay_s[]" class="form-control" placeholder="Ngày bắt đầu" ><input type="date" id="ngay_e" name="ngay_e[]" class="form-control" style="margin-top:4px" placeholder="Ngày kết thúc"> </td><td><input type="text" id="thanh_tien'+i+'" name="thanh_tien[]" class="form-control input  format_number" readonly></td><td><a  onclick="remove_tr('+i+');return false"><i class="fas fa-trash-alt"></i></a></td></tr>');
            
            $('#dich_vu').val(0);
            $('#dich_vu').trigger("change");
            $('#san_pham').val(0);
            $('#san_pham').trigger("change");
            $("#thue"+i).val(data.tax).trigger('change');
        },
        error: function () {
        }
    });
    
}

function load_sanpham(){
    var id = $('#san_pham').val();
    var khach_hang = $('#khach_hang_bg').val();
    var nhan_vien = $('#nhan_vien_bg').val();
    if(khach_hang >0 && nhan_vien>0){
        $(".btn-add").attr("disabled", false);
    }else{
        $(".btn-add").attr("disabled", true);
    }
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id},
        url: baseHome + "/baogia/load_sanpham",
        success: function (data) {
            var stt = $('#stt').val();
            var i =  Number(stt) + 1;
            $('#stt').val(i);

            $('#table_sp').append('<tr id="arr'+i+'"><td>'+data.name+'</td><td><input type="text" id="don_gia'+i+'" onkeyup="load_tien('+i+')" name="don_gia[]" class="form-control input format_number" value="'+data.don_gia+'"></td><td><input type="hidden" name="id_sp[]" id="id_sp['+i+']" value="'+data.id+'"></input><input type="hidden" name="loai[]" id="loai['+i+']" value="1"></input><input type="text" onkeyup="load_tien('+i+')" name="so_luong[]" id="so_luong'+i+'" value="1" class="form-control input" ></td><td><input type="text" id="chiet_khau'+i+'" onkeyup="load_tien('+i+')" name="chiet_khau_tm[]" class="form-control input format_number" value="0"></td><td><select name="thue[]" id="thue'+i+'" class="thue'+i+' form-control" onchange="load_tien('+i+')"><option value="0">Không</option><option value="5">5%</option><option value="10">10%</option></select></td><td><input type="text" id="tien_thue'+i+'" name="tien_thue[]" onkeyup="load_tien('+i+')" value="'+data.thue_vat+'" class="form-control input format_number"></td><td><input type="date" id="ngay_s" name="ngay_s[]" class="form-control" placeholder="Ngày bắt đầu" ><input type="date" id="ngay_e" name="ngay_e[]" class="form-control" style="margin-top:4px" placeholder="Ngày kết thúc"> </td><td><input type="text" id="thanh_tien'+i+'" name="thanh_tien[]" class="form-control input  format_number" readonly></td><td><a  onclick="remove_tr('+i+');return false"><i class="fas fa-trash-alt"></i></a></td></tr>');
            $('#dich_vu').val(0);
            $('#dich_vu').trigger("change");
            $('#san_pham').val(0);
            $('#san_pham').trigger("change");
            $("#thue"+i).val(data.tax).trigger('change');

        },
        error: function () {
        }
    });
    
}

function check_ghichu_csbg(){
    var ghichu = $('#ghi_chu_care').val();
    if(ghichu == ''){
        $(".btn-add").attr("disabled", true);
    }else{
        $(".btn-add").attr("disabled", false);
    }
}



function remove_tr(i){
    $("#arr"+i).remove();
    tong_thanh_toan();
}

function load_tien(i){
    var chiet_khau = $("#chiet_khau"+i).val();
    chiet_khau = chiet_khau.replace(/,/g,'');
    var tax = Number($("#thue"+i).val());
    var tien_dv = $("#don_gia"+i).val();
    tien_dv = tien_dv.replace(/,/g,'');
    var so_luong = Number($("#so_luong"+i).val());
    var tien_thue = $("#tien_thue"+i).val();
    tien_thue = tien_thue.replace(/,/g,'');

   
    if(tax == 0){
         tienthue = 0;
    }else{
         tienthue = (tien_dv-chiet_khau)*so_luong*tax/100;
    }
    thanhtien = (tien_dv*so_luong)+tienthue-chiet_khau;
    $("#chiet_khau"+i).val(formatCurrency(chiet_khau+''.replace(/[,VNĐ]/g,'')));
    $("#don_gia"+i).val(formatCurrency(tien_dv+''.replace(/[,VNĐ]/g,'')));
    $("#tien_thue"+i).val(formatCurrency(tienthue+''.replace(/[,VNĐ]/g,'')));
    $("#thanh_tien"+i).val(formatCurrency(thanhtien+''.replace(/[,VNĐ]/g,'')));

    tong_thanh_toan();
}

function tong_thanh_toan(){
    var thanhtien = 0;
    $("input[name='thanh_tien[]']")
    .map(function(){
       thanhtien+=Number($(this).val().replace(/,/g,'')); 
    });
    $('#tong_donhang').val(formatCurrency(thanhtien+''.replace(/[,VNĐ]/g,'')));

    var chiet_khau = $('#chiet_khau').val();
        chiet_khau = Number(chiet_khau.replace(/,/g,''));
    var thanh_toan = $('#thanh_toan').val();
    thanh_toan = Number(thanh_toan.replace(/,/g,''));
    thanh_toan = thanhtien - chiet_khau;
    $('#thanh_toan').val(formatCurrency(thanh_toan+''.replace(/[,VNĐ]/g,'')));

}



function check_form(){
    var khach_hang = $('#khach_hang_bg').val();
    var nhan_vien = $('#nhan_vien_bg').val();
    var thanh_toan = $('#thanh_toan').val();

    if(khach_hang >0 && nhan_vien>0 && thanh_toan != ""){
        $(".btn-add").attr("disabled", false);
    }else{
        $(".btn-add").attr("disabled", true);
    }

}

function savetk() {
    var myform = new FormData($("#dg_bg")[0]);
        $.ajax({
            type: "POST",
            dataType: "json",
            data: myform,
            url : baseHome + "/baogia/add_to_kh",
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.success) {
                    notyfi_success(data.msg);
                    window.location.href='baogia';
                }
                else
                    notify_error(data.msg);
            },
            error: function () {
                notify_error('Cập nhật không thành công');
            }
        });
}



