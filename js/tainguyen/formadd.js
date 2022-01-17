
$(function(){
    // var auth = check_token();
    // if(auth.responseJSON.success){
        return_combobox_multi('#phan_loai', baseHome + '/phanloai/combo', 'Lựa chọn phân loại');
        return_combobox_multi('#nha_cung_cap', baseHome + '/common/nhacungcap', 'Lựa chọn nhà cung cấp'); 
        return_combobox_multi('#chu_so_huu', baseHome + '/khachhang/combo', 'Lựa chọn chủ sở hữu'); 
        $('#nguoi_tao').val(user.nhan_vien);
    // }else{
    //     setInterval(function(){
    //         notify_error(auth.responseJSON.msg);
    //         localStorage.removeItem('token');
    //         window.location.href = baseUrl + 'login';
    //     }, 2000);
    // }
});

function save(){
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function(){
        if($(this).val() == ''){
            allRequired = false;
        }
    });
    if(allRequired){
        save_form_reject('#tainguyen-fm', baseHome + '/tainguyen/add', baseHome + '/tainguyen');
    }else{
        notify_error('Bạn chưa điền đủ thông tin');
    }
}