$(function(){
    // var auth = check_token();
    // if(auth.responseJSON.success){

        return_combobox_multi('#classify', baseHome + '/phanloai/combo', 'Lựa chọn phân loại');
        // return_combobox_multi('#supplier', baseHome + '/tainguyen/combo', 'Lựa chọn nhà cung cấp');
        return_combobox_multi('#owner', baseHome + '/khachhang/combo', 'Lựa chọn chủ sở hữu');
        // let searchParams = new URLSearchParams(window.location.search);
        // var param = searchParams.get('id');
        var id = getParameterByName("id");
        load_form('#tainguyen-fm', baseHome + '/tainguyen/detail_resource?id='+id);
    // }else{
    //     setInterval(function(){
    //         notify_error(auth.responseJSON.msg);
    //         localStorage.removeItem('token');
    //         window.location.href = baseUrl + 'login';
    //     }, 2000);
    // }
    $(document).ready(function () {

        $("#toggle").click(function () {
            $("#toggle").toggleClass("fa-eye fa-eye-slash");
            if ($("#password").attr("type") == "password")
            {
                //Change type attribute
                $("#password").attr("type", "text");
            } else
            {
                //Change type attribute
               
                $("#password").attr("type", "password");
            }
        });
    
    });

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
                "ten_dang_nhap": {
                    email: true,
                }
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
                "ten_dang_nhap": {
                    email: "Yêu cầu nhập email!",
                }
        }  
        });
        $('#tainguyen-fm').on("submit", function (e) {
            var isValid = $('#tainguyen-fm').valid();
            e.preventDefault();
            if (isValid) {
                save_form_reject('#tainguyen-fm', baseHome + '/tainguyen/update', baseHome + '/tainguyen');
            }
        });
        }

});