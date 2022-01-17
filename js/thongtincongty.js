$(function () {
var url = '';
var  datePicker = $(".flatpicker");
window.onload = function()
{
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: 0 },
        url: baseHome + "/thongtincongty/loaddata",
        success: function (data) {
            $('#avatar').attr('src', data.logo);
            $('#name').val(data.name);
            $('#ten_giao_dich').val(data.ten_giao_dich);
            $('#ma_so_thue').val(data.ma_so_thue);
            $('#ngay_thanh_lap').val(data.ngay_thanh_lap);
            $('#ma_so_dkkd').val(data.ma_so_dkkd);
            $('#ngay_cap').val(data.ngay_cap);
            $('#noi_cap').val(data.noi_cap);
            $('#nguoi_dai_dien').val(data.nguoi_dai_dien);
            $('#chuc_danh').val(data.chuc_danh);
            $('#dia_chi').val(data.dia_chi);
            $('#dien_thoai').val(data.dien_thoai);
            $('#fax').val(data.fax);
            $('#email').val(data.email);
            $('#website').val(data.website);
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
};

// datepicker init
if (datePicker.length) {
    datePicker.flatpickr({
        
    });
}

    

});

function savetk() {
    var info = {};
    info.name = $("#name").val();
    info.ten_giao_dich = $("#ten_giao_dich").val();
    info.ma_so_thue = $("#ma_so_thue").val();
    info.ngay_thanh_lap = $("#ngay_thanh_lap").val();
    info.ma_so_dkkd = $("#ma_so_dkkd").val();
    info.ngay_cap = $("#ngay_cap").val();
    info.noi_cap = $("#noi_cap").val();
    info.nguoi_dai_dien = $("#nguoi_dai_dien").val();
    info.chuc_danh = $("#chuc_danh").val();
    info.dia_chi = $("#dia_chi").val();
    info.dien_thoai = $("#dien_thoai").val();
    info.fax = $("#fax").val();
    info.email = $("#email").val();
    info.website = $("#website").val();

    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: baseHome + "/thongtincongty/update",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
            }
            else
                notify_error(data.msg);
        },
        error: function () {
            notify_error('Cập nhật không thành công');
        }
    });
}


function thayanh(){
    var id = $("#id").val();
    var myform = new FormData($('#thongtin')[0]);
    myform.append('myid', id);
    $.ajax({
        url: baseHome + "/thongtincongty/thayanh",
        type: 'post',
        data: myform,
        contentType: false,
        processData: false,
        success: function(data){
            if (data.success) {
               notyfi_success(data.msg);
               $('#avatar').attr('src', data.filename);
            }
            else
                notify_error(data.msg);
        },
    });
}
