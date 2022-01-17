Dropzone.autoDiscover = false;
var id = localStorage.getItem('cdid');
$(function () {
    
    return_combobox_multi('#nguoi_phu_trach', baseApi + '/common/nhanvien', 'Chọn nhân viên');
    $("#nguoi_phu_trach").val(baseUser).change();
    return_combobox_multi('#nguoi_theo_doi', baseApi + '/common/nhanvien', 'Chọn nhân viên');
    return_combobox_multi('#chi_nhanh', baseApi + '/chinhanh/combo', 'Chọn chi nhánh');
    return_combobox_multi('#phong_ban', baseApi + '/phongban/combo', 'Chọn phòng ban');
    return_combobox_multi('#trinh_do', baseApi + '/dexuattd/trinhdouv', 'Chọn trình độ');
    return_combobox_multi('#kinh_nghiem', baseApi + '/dexuattd/kinhnghiemuv', 'Chọn kinh nghiệm');
    $('#chi_nhanh').val('').change();
    $('#phong_ban').val('').change();
    $('#vi_tri').val('').attr("disabled", true);
    $('#trinh_do').val('').change();
    $('#kinh_nghiem').val('').change();

    'use strict';

    var singleFile = $('#dpz-single-file');
    var removeThumb = $('#dpz-remove-thumb');
    var basicPickr = $('.flatpickr-basic');

    // Default
    if (basicPickr.length) {
        basicPickr.flatpickr({
            readonly: false,
            dateFormat: "d/m/Y",
        });
    }
    // singleFile.dropzone({
    //     paramName: 'file', // The name that will be used to transfer the file
    //     maxFiles: 1
    // });

    removeThumb.dropzone({
        paramName: 'file', // The name that will be used to transfer the file
        maxFilesize: 1, // MB
        addRemoveLinks: true,
        dictRemoveFile: ' Trash'
    });

    var dexuattd = $('#dexuattd');
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseApi + "/dexuattd/combo",
        success: function (data) {
            data.forEach(function (val, index) {
                var opt = '<option data-vitri="' + val.vi_tri + '" data-hantuyen="' + val.han_tuyen + '"\
                 value="'+ val.id + '">' + val.name + '</option>';
                dexuattd.append(opt);
            });

            dexuattd.val('').change();

            if (dexuattd.length) {
                dexuattd.wrap("<div class='position-relative'></div>").select2({
                    placeholder: "Có thể chọn hoặc không",
                    escapeMarkup: function (es) {
                        return es;
                    },
                });
            }
        },
    });
    loaddata(id);
})

function loaddata(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseApi + "/chiendichtd/loaddata",
        success: function (data) {
            if(data.dexuattd == 0){
                $('#dexuattd').val('').change().attr('disabled',true);
                $('#name').val(data.name);
            } else {
                $('#dexuattd').val(data.dexuattd).change().attr('disabled',true);
                $('#name').val(data.name).attr('disabled',true);
            }
            listnpt = data.nguoi_phu_trach.split(',');
            $("#nguoi_phu_trach").val(listnpt).change();
            listntd = data.nguoi_theo_doi.split(',');
            $("#nguoi_theo_doi").val(listntd).change();
            $('#ngay_bat_dau').val(data.ngay_bat_dau);
            $('#ngay_ket_thuc').val(data.ngay_ket_thuc);
            $('#chi_phi_du_kien').val(data.chi_phi_du_kien);
            
            $('#chi_nhanh').val(data.chi_nhanh).change();
            $('#phong_ban').val(data.phong_ban).change();
            $('#vi_tri').val(data.vi_tri).change();
            $('#hinh_thuc_lam_viec').val(data.hinh_thuc_lam_viec).change();
            $('#so_luong').val(data.so_luong);
            $('#ung_tuyen').val(data.so_luong);
            $('#min_luong').val(data.min_luong);
            $('#max_luong').val(data.max_luong);
            if(data.han_tuyen != '00/00/0000'){
                $('#han_tuyen').val(data.han_tuyen);
            } else {
                $("#notime").prop("checked", true).change();
            }
            $('#ly_do').val(data.ly_do).change();
            $('#mo_ta').val(data.mo_ta);
            $('#gioi_tinh').val(data.gioi_tinh).change();
            $('#min_tuoi').val(data.min_tuoi);
            $('#max_tuoi').val(data.max_tuoi);
            $('#min_cao').val(data.min_cao);
            $('#max_cao').val(data.max_cao);
            $('#min_nang').val(data.min_nang);
            $('#max_nang').val(data.max_nang);
            $('#trinh_do').val(data.trinh_do).change();
            $('#kinh_nghiem').val(data.kinh_nghiem).change();
            $('#chuyen_nganh').val(data.chuyen_nganh);
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function changePB() {
    var opt = $("#phong_ban").val();
    return_combobox_multi('#vi_tri', baseApi + '/vitri/combo?phongban=' + opt, 'Lựa chọn vị trí');
    $('#vi_tri').val('').attr("disabled", false);
}

function saveedit() {
    var info = {};
    info.dexuattd = $("#dexuattd").val();
    info.name = $("#name").val();
    var nguoiphutrach = $("#nguoi_phu_trach").val();
    let listnpt = '';
    nguoiphutrach.forEach(function (item) {
        listnpt += item+',';
    });
    listnpt = listnpt.slice(0, -1);

    var nguoitheodoi = $("#nguoi_theo_doi").val();
    let listntd = '';
    nguoitheodoi.forEach(function (item) {
        listntd += item+',';
    });
    listntd = listntd.slice(0, -1);
    info.nguoi_phu_trach = listnpt;
    info.nguoi_theo_doi = listntd;

    info.ngay_bat_dau = $("#ngay_bat_dau").val();
    info.ngay_ket_thuc = $("#ngay_ket_thuc").val();
    info.chi_phi_du_kien = $("#chi_phi_du_kien").val();
    info.phong_ban = $("#phong_ban").val();
    info.chi_nhanh = $("#chi_nhanh").val();
    info.vi_tri = $("#vi_tri").val();
    info.hinh_thuc_lam_viec = $("#hinh_thuc_lam_viec").val();
    info.so_luong = $("#so_luong").val();
    info.min_luong = $("#min_luong").val();
    info.max_luong = $("#max_luong").val();
    if ($('#han_tuyen').is('[disabled!=disabled]'))
        info.han_tuyen = $("#han_tuyen").val();
    info.ly_do = $("#ly_do").val();
    info.min_tuoi = $("#min_tuoi").val();
    info.max_tuoi = $("#max_tuoi").val();
    info.gioi_tinh = $("#gioi_tinh").val();
    info.min_cao = $("#min_cao").val();
    info.max_cao = $("#max_cao").val();
    info.min_nang = $("#min_nang").val();
    info.max_nang = $("#max_nang").val();
    info.chuyen_nganh = $("#chuyen_nganh").val();
    info.trinh_do = $("#trinh_do").val();
    info.kinh_nghiem = $("#kinh_nghiem").val();
    info.mo_ta = $("#mo_ta").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: baseApi + '/chiendichtd/saveedit?id='+id,
        success: function (data) {
            if (data.success) {
                window.location.href = './chiendichtd';
            }
            else
                notify_error(data.msg);
        },
        error: function () {
            notify_error('Cập nhật không thành công');
        }
    });
}

function noTime() {
    if ($("#notime").is(':checked')) {
        $('#han_tuyen').attr("disabled", true);
    } else {
        $('#han_tuyen').attr("disabled", false);
    }
}
