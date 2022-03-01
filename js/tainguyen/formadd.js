
$(function(){
    // var auth = check_token();
    // if(auth.responseJSON.success){
        $(document).ready(function () {

            $("#toggle").click(function () {
                $("#toggle").toggleClass("fa-eye fa-eye-slash");
                if ($("#mat_khau").attr("type") == "password")
                {
                    //Change type attribute
                    $("#mat_khau").attr("type", "text");
                } else
                {
                    //Change type attribute
                   
                    $("#mat_khau").attr("type", "password");
                }
            });
        
        });

        return_combobox_multi('#phan_loai', baseHome + '/phanloai/combo', 'Lựa chọn phân loại');
        return_combobox_multi('#nha_cung_cap', baseHome + '/tainguyen/combo', 'Lựa chọn nhà cung cấp'); 
        return_combobox_multi('#chu_so_huu', baseHome + '/khachhang/combo', 'Lựa chọn chủ sở hữu'); 
        $('#nguoi_tao').val(baseUser.nhan_vien);
    // }else{
    //     setInterval(function(){
    //         notify_error(auth.responseJSON.msg);
    //         localStorage.removeItem('token');
    //         window.location.href = baseUrl + 'login';
    //     }, 2000);
    // }
    
    if($('#tainguyen-fm').length){
        $('#tainguyen-fm').validate({
            errorClass: "error",
            rules: {
                "name": {
                    required: true,
                },
                "link": {
                    required: true,
                },
                "username" :{
                    required: true,
                },
            },
            messages: {
                "name": {
                    required: "Yêu cầu nhập tên tài nguyên!",
                },
                "link": {
                    required: "Yêu cầu nhập link!",
                },
                "username" :{
                    required: "Yêu cầu nhập tên đăng nhập!",
                },
        }  
        });
        $('#tainguyen-fm').on("submit", function (e) {
            var isValid = $('#tainguyen-fm').valid();
            e.preventDefault();
            if (isValid) {
                save_form_reject('#tainguyen-fm', baseHome + '/tainguyen/add', baseHome + '/tainguyen');
            }
        });
        }
});