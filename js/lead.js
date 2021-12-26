var dataid = 0;
var statusObj = [];
$(function () {
    "use strict";

    var basicPickr = $('.flatpickr-basic');
    basicPickr.prop('readonly', false);
    // Default
    if (basicPickr.length) {
        basicPickr.flatpickr({
            dateFormat: "d/m/Y",
            defaultDate: "",
            readonly: false
        });
    }

    return_combobox_multi('#nhanvien', baseHome + '/common/nhanvien', 'Chọn nhân viên');
    return_combobox_multi('#phanloai', baseHome + '/common/loaikh', 'Chọn loại khách hàng');
    return_combobox_multi('#phan_loai_import', baseHome + '/common/loaikh', 'Chọn loại khách hàng');
    return_combobox_multi('#phutrach', baseHome + '/common/nhanvien', 'Chọn nhân viên');
    return_combobox_multi('#tinhtrang', baseHome + '/common/tinhtrangdata', 'Chọn tình trạng data');
    return_combobox_multi('#phutrach_import', baseHome + '/common/nhanvien', 'Chọn nhân viên');

    $('#nhanvien').val('').change();
    $('#phutrach_import').val('').change();
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/common/tinhtrangdata",
        success: function (data) {
            statusObj = data;
        },
    });

    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");

    // Users List datatable
    if (dtUserTable.length) {
        var table = dtUserTable.DataTable({
            // ajax: assetPath + "lead/user-list.json", // JSON file to add data
            ajax: baseHome + "/lead/list",
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "autoWidth": false,
            "responsive": false,
            "fixedColumns": true,
            columns: [
                // columns according to JSON
                { data: "" },
                { data: "id" },
                { data: "ho_ten" },
                { data: "dien_thoai" },
                { data: "loaikh" },
                { data: "ngaychia" },
                { data: "nhanvien" },
                { data: "tinh_trang" },
                { data: "" },
            ],
            columnDefs: [
                {
                    // For Responsive
                    className: "control",
                    // responsivePriority: 2,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return "";
                    },
                },
                {
                    // For Checkboxes
                    targets: 1,
                    render: function (data, type, full, meta) {
                        var tinhtrang = full['tinh_trang'];
                        var html = '';
                        html += '<div class="custom-control custom-checkbox">';
                        if(tinhtrang == 9){
                            html += '<input class="custom-control-input dt-checkboxes" disabled type="checkbox" value="" id="checkbox' + data + '" />'
                        }else{
                            html += '<input class="custom-control-input dt-checkboxes" type="checkbox" value="" id="checkbox' + data + '" />';
                        }
                        html += '<label class="custom-control-label" for="checkbox' + data + '"></label></div>';
                        return html;
                        
                        
                    },
                    select: {
                        style: 'multi'
                    },
                    checkboxes: {
                        selectAllRender:
                            '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                    }
                },
                {
                    targets: 2,
                    width: '30%',
                    render: function (data, type, full, meta) {
                        var roleBadgeObj = {
                            Subscriber: feather.icons["user"].toSvg({ class: "font-medium-3 text-primary mr-50" }),
                            Author: feather.icons["settings"].toSvg({ class: "font-medium-3 text-warning mr-50" }),
                            Maintainer: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                            Editor: feather.icons["edit-2"].toSvg({ class: "font-medium-3 text-info mr-50" }),
                            Admin: feather.icons["slack"].toSvg({ class: "font-medium-3 text-danger mr-50" }),
                        };
                        return '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ')" >' +
                            '<span class="align-middle font-weight-bold">' + roleBadgeObj['Subscriber'] + full["ho_ten"] + "</span></a>";
                    },
                },
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return "<span class='text-truncate align-middle'>" + feather.icons["phone"].toSvg({ class: "font-medium-3 text-primary mr-50" }) + full["dien_thoai"] + "</span>";
                    },
                },
                {
                    targets: 7,
                    render: function (data, type, full, meta) {
                        var $status = full["tinh_trang"];
                        if ($status == 1) {
                            return '<span class="badge badge-success" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 2) {
                            return '<span class="badge badge-warning" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 3) {
                            return '<span class="" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 4) {
                            return '<span class="badge badge-secondary" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 5) {
                            return '<span class="badge badge-dark" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 6) {
                            return '<span class="badge badge-danger" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 7) {
                            return '<span class="" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 8) {
                            return '<span class="" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 9) {
                            return '<span class="badge badge-warning" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 10) {
                            return '<span class="badge badge-warning" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else {
                            return '';
                        }
                    },
                },
                {
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    render: function (data, type, full, meta) {
                        var tinhtrang = full['tinh_trang'];
                        var html = '';
                        html += '<div style="width:100px;text-align:right">';
                        if(tinhtrang != 9){
                            html += '<button type="button" class="btn btn-icon btn-outline-success waves-effect" data-toggle="tooltip" data-placement="top" data-original-title="Tạo báo giá" onclick="loadbaogia(' + full['id'] + ')">';
                            html += '<i class="fas fa-cart-plus"></i>';
                            html += '</button> &nbsp;';
                         }
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button></div>';
                        return html;
                    },
                    width: 100
                },
            ],
            displayLength: 30,
            lengthMenu: [10, 20, 30, 50, 70, 100],
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
            ],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            return "Chi tiết thông tin data";
                        },
                    }),

                    type: "column",
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: "table",
                        columnDefs: [
                            {
                                targets: 1,
                                visible: false,
                            },
                            {
                                targets: 8,
                                visible: false,
                            }
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

function search() {
    var nhanvien = $("#nhanvien").val();
    var tungay = $("#tungay").val();
    var denngay = $("#denngay").val();
    if (nhanvien != '' || tungay != '' || denngay != '') {
        var table = $(".user-list-table").DataTable();
        table.ajax.url(baseHome + "/lead/list?nhan_vien=" + nhanvien + "&tu_ngay=" + tungay + "&den_ngay=" + denngay).load();
        table.draw();
    }
}

function loaddata(id) {
    $('#updateinfo').modal('show');
    $('#tab-1').click();
    $("#modal-title2").html('Cập nhật thông tin data');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/lead/loaddata",
        success: function (result) {
            let data = result.data;
            let histories = result.histories;
            dataid = id;
            if(data.tinh_trang == 9){
                $('#hoten').val(data.ho_ten).attr("disabled", true);
                $('#dienthoai').val(data.dien_thoai).attr("disabled", true);
                $('#data_email').val(data.email).attr("disabled", true);
                $('#diachi').val(data.dia_chi).attr("disabled", true);
                $('#phanloai').val(data.phan_loai).change().attr("disabled", true);
                $('#phutrach').val(data.nhan_vien).change().attr("disabled", true);
                $('#tinhtrang').val(data.tinh_trang).change().attr("disabled", true);
                $('#ghichu').val(data.ghi_chu).attr("disabled", true);
                $('#listnhatky').html('');
                histories.map(history => {
                    return $('#listnhatky').append('<div class="media mb-1"><div class="avatar bg-light-success my-0 ml-0 mr-50"><img src="' + history.hinhanh + '" alt="Avatar" height="32" /></div><div class="media-body"><p class="mb-0"><span class="font-weight-bold">' + history.username + '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small class="text-muted">' + history.ngay_gio + '</small></p><p>' + history.ghi_chu + '</p></div></div>');
                });
                $('#btn-edit').addClass('d-none');
                $('#fm-add').addClass('d-none');
            } else {
                $('#hoten').val(data.ho_ten).attr("disabled", false);
                $('#dienthoai').val(data.dien_thoai).attr("disabled", false);
                $('#data_email').val(data.email).attr("disabled", false);
                $('#diachi').val(data.dia_chi).attr("disabled", false);
                $('#phanloai').val(data.phan_loai).change().attr("disabled", false);
                $('#phutrach').val(data.nhan_vien).change().attr("disabled", false);
                $('#tinhtrang').val(data.tinh_trang).change().attr("disabled", false);
                $('#ghichu').val(data.ghi_chu).attr("disabled", false);
                $('#listnhatky').html('');
                histories.map(history => {
                    return $('#listnhatky').append('<div class="media mb-1"><div class="avatar bg-light-success my-0 ml-0 mr-50"><img src="' + history.hinhanh + '" alt="Avatar" height="32" /></div><div class="media-body"><p class="mb-0"><span class="font-weight-bold">' + history.username + '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small class="text-muted">' + history.ngay_gio + '</small></p><p>' + history.ghi_chu + '</p></div></div>');
                });
                $('#btn-edit').removeClass('d-none');
                $('#fm-add').removeClass('d-none');
            }
           
            var chatUsersListWrapper = $('#listnhatky');
            var chatUserList = new PerfectScrollbar(chatUsersListWrapper[0]);
            url = baseHome + '/lead/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function saveedit() {
    var info = {};
    info.ho_ten = $("#hoten").val();
    info.dien_thoai = $("#dienthoai").val();
    info.dia_chi = $("#diachi").val();
    info.email = $("#data_email").val();
    info.phan_loai = $("#phanloai").val();
    info.ghi_chu = $("#ghichu").val();
    info.nhan_vien = $("#phutrach").val();
    info.tinh_trang = $("#tinhtrang").val();
    if (dataid > 0) {
        $.ajax({
            type: "POST",
            dataType: "json",
            data: info,
            url: baseHome + "/lead/update?id=" + dataid,
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

}

function savenhatky() {
    var info = {};
    info.iddata = dataid;
    info.ghi_chu = $("#noidung").val();
    if (dataid > 0) {
        $.ajax({
            type: "POST",
            dataType: "json",
            data: info,
            url: baseHome + "/lead/addnhatky",
            success: function (data) {
                if (data.success) {
                    notyfi_success(data.msg);
                    $('#addnhatky').modal('hide');
                    $('#listnhatky').prepend('<div class="media mb-1"><div class="avatar bg-light-success my-0 ml-0 mr-50"><img src="' + hinhanh + '" alt="Avatar" height="32" /></div><div class="media-body"><p class="mb-0"><span class="font-weight-bold">' + username + '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small class="text-muted">' + now + '</small></p><p>' + info.ghi_chu + '</p></div></div>');
                }
                else
                    notify_error(data.msg);
            },
            error: function () {
                notify_error('Cập nhật không thành công');
            }
        });
    }
}

function movetokh() {
    var table =  $(".user-list-table").DataTable();
    var rows = table.column(1).checkboxes.selected();
    var listlead = '';
    rows.each(function (item) {
        listlead+=item+',';
    })
    listlead = listlead.slice(0, -1);
  
    if (rows.length > 0) {
        $.ajax({
        type: "POST",
        dataType: "json",
        data: {data: listlead},
        url: baseHome + "/lead/movetokh",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $(".user-list-table").DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
        error: function () {
            notify_error('Cập nhật không thành công');
        }
    });
    } else {
        notify_error('Không có bản ghi nào được chọn');
    }
}

function nhapexcel() {
    $("#nhapexcel").modal('show');
    $("#modal-title5").html('Nhập data từ file excel');
}

function savenhap() {
    var myform = new FormData($("#fm-nhapexcel")[0]);
    $.ajax({
        type: "POST",
        dataType: "json",
        data: myform,
        url: baseHome + "/lead/nhapexcel",
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#nhapexcel').modal('hide');
                $(".user-list-table").DataTable().ajax.reload(null, false);
            } else
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
        url: baseHome + "/baogia/load_id_lead",
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
        url: baseHome + "/baogia/loaddata_lead",
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
            url : baseHome + "/baogia/add_to_lead",
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


