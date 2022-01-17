$(function () {
    return_combobox_multi('#que_quan', baseHome + '/common/thanhpho', 'Chọn quê quán');
    return_combobox_multi('#noi_cap', baseHome + '/common/thanhpho', 'Chọn nơi cấp');
    $('#que_quan').val('').change();
    $('#noi_cap').val('').change();

    var basicPickr = $('.flatpickr-basic');
    // Default
    if (basicPickr.length) {
        basicPickr.flatpickr({
            dateFormat: "",
        });
    }

    $.ajax({
        type: "POST",
        dataType: "json",
        url: baseHome + "/accountsettings/loaddata",
        success: function (data) {
            let staffInfo = data.staffInfo;

            let social = data.social
            if (staffInfo.avatar!='')
                $('#avatar').attr('src', baseUrlFile+'/uploads/nhanvien/'+staffInfo.avatar);
            else
                $('#avatar').attr('src', baseHome + '/layouts/useravatar.png');
            $('#username').val(staffInfo.email);
            $('#name').val(staffInfo.name);
            $('#email').val(staffInfo.email);
            $('#dien_thoai').val(staffInfo.phoneNumber);
            if (staffInfo.ngaysinh != '00/00/0000')
                defaultDate = staffInfo.ngaysinh;
            else
                defaultDate = '';
            $('#ngay_sinh').flatpickr({
                // monthSelectorType: "static",
                altInput: true,
                defaultDate: defaultDate,
                altFormat: "d/m/Y",
                dateFormat: "d/m/Y",
            });
            $('#cmnd').val(staffInfo.idCard);
            if (staffInfo.ngaycap != '00/00/0000')
                defaultDate = staffInfo.ngaycap;
            else
                defaultDate = '';
            $('#ngay_cap').flatpickr({
                // monthSelectorType: "static",
                altInput: true,
                defaultDate: defaultDate,
                altFormat: "d/m/Y",
                dateFormat: "d/m/Y",
            });
            $("#noi_cap").val(staffInfo.idAddress).change();
            $("#que_quan").val(staffInfo.province).change();
            $('#dia_chi').val(staffInfo.address);
            $('#ghi_chu').val(staffInfo.description);
            $("#twitter").val(social.twitter);
            $('#facebook').val(social.facebook);
            $('#zalo').val(social.zalo);
            $("#wechat").val(social.wechat);
            $('#instagram').val(social.instagram);
            $('#linkedin').val(social.linkedin);
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });

})

function thayanh() {
    var myform = new FormData($('#upload-avt')[0]);
    $.ajax({
        url: baseHome + "/accountsettings/thayanh",
        type: 'post',
        data: myform,
        contentType: false,
        processData: false,
        dataType:'json',
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#avatar').attr('src', baseUrlFile+'/uploads/nhanvien/'+data.filename);
                $('#hungsua2').attr('src', baseUrlFile+'/uploads/nhanvien/'+data.filename);
            }
            else
                notify_error(data.msg);
        },
    });
}

function xoaanh() {
    $.ajax({
        type: "post",
        url: baseHome + "/accountsettings/xoaanh",
        success: function (data) {
            if (data.success){
                $('#avatar').attr('src', baseHome + '/layouts/useravatar.png');
                $('#hungsua2').attr('src', baseHome + '/layouts/useravatar.png');
            }
        },
    });
}

function save() {
    var info = {};
    info.name = $("#name").val();
    info.email = $("#email").val();
    info.dien_thoai = $("#dien_thoai").val();
    info.ngay_sinh = $("#ngay_sinh").val();
    info.cmnd = $("#cmnd").val();
    info.ngay_cap = $("#ngay_cap").val();
    info.noi_cap = $("#noi_cap").val();
    info.que_quan = $("#que_quan").val();
    info.dia_chi = $("#dia_chi").val();
    info.ghi_chu = $("#ghi_chu").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: baseHome + "/accountsettings/update",
        success: function (data) {
            if (data.success) {
                $('#hungsua1').html(info.name);
                notyfi_success(data.msg);
            } else
                notify_error(data.msg);
        }
    });
}

function savesocial() {
    var info = {};
    info.twitter = $("#twitter").val();
    info.facebook = $("#facebook").val();
    info.zalo = $("#zalo").val();
    info.instagram = $("#instagram").val();
    info.wechat = $("#wechat").val();
    info.linkedin = $("#linkedin").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: baseHome + "/accountsettings/updatesocial",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
            } else
                notify_error(data.msg);
        }
    });
}

function savepass() {
    var info = {};
    info.oldpass = $("#old-password").val();
    info.newpass = $("#new-password").val();
    info.renewpass = $("#re-new-password").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: baseHome + "/accountsettings/changepass",
        success: function (data) {
            if (data.success) {
                logout();
            } else
                notify_error(data.msg);
        }
    });
}