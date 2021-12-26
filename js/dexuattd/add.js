Dropzone.autoDiscover = false;
$(function () {
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

    return_combobox_multi('#chi_nhanh', baseApi + '/chinhanh/combo', 'Chọn chi nhánh');
    return_combobox_multi('#phong_ban', baseApi + '/phongban/combo', 'Chọn phòng ban');
    return_combobox_multi('#trinh_do', baseApi + '/dexuattd/trinhdouv', 'Chọn trình độ');
    return_combobox_multi('#kinh_nghiem', baseApi + '/dexuattd/kinhnghiemuv', 'Chọn kinh nghiệm');
    $('#chi_nhanh').val('').change();
    $('#phong_ban').val('').change();
    $('#vi_tri').val('').attr("disabled", true);
    $('#trinh_do').val('').change();
    $('#kinh_nghiem').val('').change();

})

function changePB() {
    var opt = $("#phong_ban").val();
    return_combobox_multi('#vi_tri', baseApi + '/vitri/combo?phongban=' + opt, 'Lựa chọn vị trí');
    $('#vi_tri').val('').attr("disabled", false);
}

function saveadd() {
    // save_form_reject('#data-info', baseApi + '/dexuattd/saveadd', baseUrl + '/dexuattd');    
    var info = {};
    info.name = $("#name").val();
    info.chi_nhanh = $("#chi_nhanh").val();
    info.phong_ban = $("#phong_ban").val();
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
        url: baseApi + '/dexuattd/saveadd',
        success: function (data) {
            if (data.success) {
                window.location.href = './dexuattd';
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
