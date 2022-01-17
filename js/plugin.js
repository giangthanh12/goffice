$(function(){
    if(localStorage.getItem('token')){
        // get_info_account
        var Objdata = load_data(baseHome + '/auth/info_auth', 'token='+localStorage.getItem('token'));
        var Obj = return_data(Objdata.responseJSON.data);
        var str_data = load_data(baseHome + '/nhansu/info', 'token='+localStorage.getItem('token')+'&id='+Obj.nhan_vien);
        var Obj_nhanvien = return_data(str_data.responseJSON.data);
        $('#fullname').text(Obj_nhanvien.name);
        localStorage.setItem('nhanvienid', Obj_nhanvien.id);
        // load file srcipt tuong ung
        var value = window.location.pathname;
	       //console.log(value);
        var array = value.split("/"); //console.log(array);
        if(array.length === 5){
            if(array[4].length === 0){
                var html = '<script src="scripts/'+array[3]+'/index.js"></script>';
                $('#script').append(html);
            }else{
                var arr = array[4].split('.');
                var html = '<script src="scripts/'+array[3]+'/'+arr[0]+'.js"></script>';
                $('#script').append(html);
            }
        }else{
            return false;
        }
    }else{
        alert()
        //window.location.href = './login';
    }
});
