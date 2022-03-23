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
            if (staffInfo.avatar != '')
                $('#avatar').attr('src', baseUrlFile + '/uploads/nhanvien/' + staffInfo.avatar);
            else
                $('#avatar').attr('src', baseHome + '/layouts/useravatar.png');
            $('#username').val(staffInfo.username);
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
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#avatar').attr('src', baseUrlFile + '/uploads/nhanvien/' + data.filename);
                $('#hungsua2').attr('src', baseUrlFile + '/uploads/nhanvien/' + data.filename);
            }
            else
                notify_error(data.msg);
        },
    });
}

// function xoaanh() {
//     $.ajax({
//         type: "post",
//         url: baseHome + "/accountsettings/xoaanh",
//         success: function (data) {
//             if (data.success) {
//                 notyfi_success(data.msg);
//                 $('#avatar').attr('src', baseHome + '/layouts/useravatar.png');
//                 $('#hungsua2').attr('src', baseHome + '/layouts/useravatar.png');
//             }
//             else{ 
//                 notify_error(data.msg);
//             }
           
//         },
//     });
// }


function save() {
    $('#change').validate({
        rules:{
            dien_thoai:{
                number: true,
                minlength: 10,
                maxlength: 10
            }
        },
        messages: {
            "dien_thoai": {
                number: "Yêu cầu nhập số!",
                minlength: "Yêu cầu nhập đủ 10 số",
                maxlength: "Yêu cầu nhập đủ 10 số"
            },
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                url:  baseHome + "/accountsettings/update",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.msg);
                    } else
                        notify_error(data.msg);
                }
            });
            return false;
        }
    });
    $('#change').submit();
}

function saveInfo() {
    $('#changeInfo').validate({
        rules:{
            cmnd:{
                number: true,
                minlength: 12,
                maxlength: 12
            }
        },
        messages: {
            "cmnd": {
                number: "Yêu cầu nhập số!",
                minlength: "Yêu cầu nhập đủ 12 số",
                maxlength: "Yêu cầu nhập đủ 12 số"
            },
        },
        submitHandler: function (form) {
            var formDataInfo = new FormData(form);
            $.ajax({
                url:  baseHome + "/accountsettings/updateInfo",
                type: 'POST',
                data: formDataInfo,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.msg);
                        // $('#dgAccesspoint').modal('hide');
                        // $(".user-list-table").DataTable().ajax.reload(null, false);
                    } else
                        notify_error(data.msg);
                }
            });
            return false;
        }
    });
    $('#changeInfo').submit();
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