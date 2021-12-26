var isRtl = $('html').attr('data-textdirection') === 'rtl';

function getParameterByName(name, url) { // lay tham so qua URL
   if (!url)
        url = window.location.href;
   name = name.replace(/[\[\]]/g, "\\$&");
   var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
   results = regex.exec(url);
   if (!results) return null;
   if (!results[2]) return '';
   return decodeURIComponent(results[2].replace(/\+/g, " "));
}

$(function(){
    if (!("Notification" in window))
        alert("This browser does not support desktop notification");
    else if (Notification.permission !== "denied")
        Notification.requestPermission().then(function (permission) {
            if (permission === "granted")
                return true;
            else
                return false;
        });
    else {
        return true;
    }
    // if(localStorage.getItem('token')){
        // notify_error(localStorage.getItem('token'));
        // // get_info_account
        // var Objdata = load_data(baseApi + '/auth/info_auth', 'token='+localStorage.getItem('token'));
        // var Obj = return_data(Objdata.responseJSON.data);
        // var str_data = load_data(baseApi + '/nhansu/info', 'token='+localStorage.getItem('token')+'&id='+Obj.nhan_vien);
        // var Obj_nhanvien = return_data(str_data.responseJSON.data);
        // $('#fullname').text(Obj_nhanvien.name);
        // localStorage.setItem('nhanvienid', Obj_nhanvien.id);
        // // load file srcipt tuong ung
        // var value = window.location.pathname;
	      //  //console.log(value);
        // var array = value.split("/"); //console.log(array);
        // if(array.length === 5){
        //     if(array[4].length === 0){
        //         var html = '<script src="scripts/'+array[3]+'/index.js"></script>';
        //         $('#script').append(html);
        //     }else{
        //         var arr = array[4].split('.');
        //         var html = '<script src="scripts/'+array[3]+'/'+arr[0]+'.js"></script>';
        //         $('#script').append(html);
        //     }
        // }else{
        //     return false;
        // }
    // }else{
    //     alert()
        //window.location.href = './login';
    // }
});

function notifyMe() {
    // if (receiver.includes(baseUser)) {
        var title = 'Bạn có thông báo mới';
        var link = baseUrl + '/inbox';
        var body ='xxx';
        var avatar = 'http://localhost/goffice/layouts/g-office-logo.png';
        var noticeOptions = { body: body, icon: avatar };
        var notification = new Notification(title, noticeOptions);
        notification.onclick = function (event) {
            window.open(link,"_self");
        };
    // } else {
        // alert('x');
    // }

    // $.ajax({
    //     type: "GET",
    //     dataType: "json",
    //     async: false,
    //     url: baseApi + "/inbox/checkmail",
    //     success: function (data) {
    //         if (data['tieu_de'].length) {
    //             var noticeOptions = { body: data['tieu_de'], icon: data['hinhanh'] };
    //             var notification = new Notification("Bạn có tin nhắn mới", noticeOptions);
    //             notification.onclick = function (event) {
    //                 $("#mess_avatar").attr("src",data['hinhanh']);
    //                 $('#mess_sender').text(data['nguoigui']);
    //                 $('#mess_subject').text(data['tieu_de']);
    //                 $('#mess_body').html(data['noi_dung']);
    //                 $('#readmsg').attr('value',data['id']);
    //                 $('#mail-date').text(data['ngay_gio']);
    //                 $('#xemchitiet').attr('href',data['link']);
    //                 $('#readmsg').modal('show');
    //                 $.ajax({
    //                         url: baseApi + "/inbox/update",
    //                         type: 'post',
    //                         dataType: "json",
    //                         data: {id: data['id']},
    //                 });
    //             };
    //         }
    //     }
    // });
}

function chatMe() {
      $.ajax({
          type: "GET",
          dataType: "json",
          async: false,
          url: baseApi + "/chatbox/checkmessage",
          success: function (data) {
              if (data.code=='200') {
                  var title = 'Bạn có tin nhắn mới';
                  var link = baseUrl + '/chatbox';
                  var noticeOptions = { body: data['message'], icon: data['hinhanh'] };
                  var notification = new Notification(title, noticeOptions);
                  notification.onclick = function (event) {
                      window.open(link,"_self");
                  };
              }
          }
      });
}

function notify_error(msg_Text){
    toastr['error'](msg_Text, 'Báo lỗi !', {
        closeButton: true,
        tapToDismiss: false,
        rtl: isRtl
    });
}

function notyfi_success(msg_Text){
    toastr['success'](msg_Text, 'Thông báo !', {
        closeButton: true,
        tapToDismiss: false,
        rtl: isRtl
    });
}

function logout(){
    $.ajax({
        url: baseApi + '/auth/logout',  //server script to process data
        type: 'POST',
        success: function(data){
            if(data.success == true){
                notyfi_success(data.msg);
                localStorage.clear();
                window.location.href = baseUrl;
            }else{
                notify_error(data.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
    // $.ajax({
    //     type: "POST",
    //     url: baseApi + '/auth/logout',
    //     // data: 'data_str', // serializes the form's elements.
    //     // datType: 'json',
    //     // async: false,
    //     success: function(data){
    //         localStorage.clear();
    //         window.location.href = baseUrl;
    //         // if(data.success == true){
    //         //     // notyfi_success('Dang nhap thanh cong');
    //         //     localStorage.setItem('token', data.token);
    //         //     window.location.href = baseUrl;
    //         // }else{
    //         //     notify_error(data.msg);
    //         //     return false;
    //         // }
    //     },
    //     error: function(){
    //         notify_error('Lỗi khi đăng xuấtxxxxxxxxxxxxx');
    //     }
    // });
    // var auth = check_token();
    // if(auth.responseJSON.success){
    //     localStorage.clear();
    //     window.location.href = baseUrl + 'login';
    // }else{
    //     setInterval(function(){
    //         notify_error(auth.responseJSON.msg);
    //         localStorage.clear();
    //         window.location.href = baseUrl + 'login';
    //     }, 2000);
    // }
}

// function check_token(){
//     if(localStorage.getItem('token')){
//         var data_str = "token="+localStorage.getItem('token');
//         return $.ajax({
//             type: "POST",
//             url: baseApi + '/auth/check_token',
//             data: data_str, // serializes the form's elements.
//             datType: 'json',
//             async: false,
//             error: function(){
//                 notify_error('Lỗi load dữ liệu');
//             }
//         });
//     }else{
//         window.location.href = baseUrl + 'login';
//     }
// }

function save_form(id_form, url_post){
    var xhr = new XMLHttpRequest();
    var formData = new FormData($(id_form)[0]);
    $.ajax({
        url: url_post,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        datType: 'json',
        success: function(data){
            if(data.success == true){
                notyfi_success(data.msg);
                location.reload(true);
            }else{
                notify_error(data.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function save_form_reject(id_form, url_post, url_reject){
    var xhr = new XMLHttpRequest();
    var formData = new FormData($(id_form)[0]);
    $.ajax({
        url: url_post,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        datType: 'json',
        success: function(data){
            if(data.success == true){
                notify_error(data.msg);
                window.location.href = url_reject;
            }else{
                notify_error(data.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function save_form_reload_function(id_form, url_post, re_function){
    var xhr = new XMLHttpRequest();
    var formData = new FormData($(id_form)[0]);
    $.ajax({
        url: url_post,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        datType: 'json',
        success: function(data){
            if(data.success == true){
                // notyfi_error(data.msg);
                //window.location.href = url_reject;
                re_function;
            }else{
                notyfi_error(data.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function save_form_refresh_div(id_form, url_post, id_div, url_refresh, id_modal){
    var xhr = new XMLHttpRequest();
    var formData = new FormData($(id_form)[0]);
    $.ajax({
        url: url_post,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        datType: 'json',
        success: function(data){
            if(data.success == true){
                notyfi_success(data.msg);
                $(id_modal).modal('hide');
                $(id_div).load(url_refresh);
            }else{
                notyfi_error(data.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function save_form_refresh_div_no_modal(id_form, url_post, id_div, url_refresh){
    var xhr = new XMLHttpRequest();
    var formData = new FormData($(id_form)[0]);
    $.ajax({
        url: url_post,  //server script to process data
        type: 'POST',
        xhr: function() {
            return xhr;
        },
        data: formData,
        datType: 'json',
        success: function(data){
            if(data.success == true){
                reset_form(id_form);
                $(id_div).load(url_refresh);
            }else{
                notyfi_error(data.msg);
                return false;
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function del_data(id_index, url_data){
    var r = confirm("Bạn có chắc chán muốn xóa dữ liệu!");
    if (r == true) {
        var data_str = "id="+id_index;
        $.ajax({
            type: "POST",
            url: url_data,
            data: data_str, // serializes the form's elements.
            datType: 'json',
            success: function(data){
                if(data.success == true){
                    location.reload(true);
                }else{
                    notyfi_error(data.msg);
                    return false;
                }
            }
        });
    }
}

function del_data_refresh_div(id_index, url_data, thongbao, id_div){
    var r = confirm(thongbao);
    if (r == true) {
        var data_str = "id="+id_index;
        $.ajax({
            type: "POST",
            url: url_data,
            data: data_str, // serializes the form's elements.
            datType: 'json',
            success: function(data){
                if(data.success == true){
                    notyfi_success(data.msg);
                    //$(id_div).load(url_refresh);
                    var table = $(id_div).DataTable();
                    table.ajax.reload();
                }else{
                    notyfi_error(data.msg);
                    return false;
                }
            }
        });
    }
}

function update_status(data_str, url_data, id_div, url_refresh, notify){
    var r = confirm(notify);
    if (r == true) {
        $.ajax({
            type: "POST",
            url: url_data,
            data: data_str, // serializes the form's elements.
            datType: 'json',
            success: function(data){
                if(data.success == true){
                    notyfi_success(data.msg);
                    $(id_div).load(url_refresh);
                }else{
                    notyfi_error(data.msg);
                    return false;
                }
            }
        });
    }
}

function load_data(url_data, data_str){
    return $.ajax({
        type: "POST",
        url: url_data,
        data: data_str, // serializes the form's elements.
        datType: 'json',
        async: false,
        error: function(){
            notify_error('Lỗi load dữ liệu');
        }
    });
}

function return_data(ObjData){
    let obj = ObjData.find(o => o);
    return obj;
}

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function reset_form(id_form){
    $(id_form)[0].reset();
}

function check_image_ext(text){
    if(text != ''){
        if(text.match(/jpg.*/) || text.match(/jpeg.*/) || text.match(/png.*/) || text.match(/gif.*/)){
            return true;
        }else{
            return false;
        }
    }else{
        return true;
    }
}

function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function formatCurrency(input, blur) {
    var input_val = input.val();
    if (input_val === "") { return; }
    var original_len = input_val.length;
    var caret_pos = input.prop("selectionStart");
    if (input_val.indexOf(".") >= 0) {
        var decimal_pos = input_val.indexOf(".");
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);
        left_side = formatNumber(left_side);
        right_side = formatNumber(right_side);
        if (blur === "blur") {
            right_side += "00";
        }
        right_side = right_side.substring(0, 2);
        input_val = left_side + "." + right_side;
    } else {
        input_val = formatNumber(input_val);
        input_val = input_val;
        if (blur === "blur") {
            input_val += "";
        }
    }
    input.val(input_val);
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

function return_combobox(id_input, url_data, place){
    $(id_input).select2({
        placeholder: place,
        method: 'post',
        ajax:{
            url: url_data,
            processResults: function (data) {
                return {
                  results: data
                };
            }
        }
    });
}
function return_combobox_multi(id_input, url_data, place){
    var str_data = load_data(url_data);
    var Objdata = str_data.responseJSON;
    var html = '';
    jQuery.map(Objdata, function(n, i){
        html += '<option value="'+n.id+'">'+n.text+'</option>';
    });
    $(id_input).select2({
        placeholder: place,
        dropdownParent: $(id_input).parent(),
    });
    $(id_input).html(html);
}

function load_form(id_form, url_data){
    var str_data = load_data(url_data);
    var Objdata = str_data.responseJSON.data;
    const String_data = Objdata.find(o => o);
    for(const[key, value] of Object.entries(String_data)){
        console.log(key+'-'+value);
        $(id_form + ' #' + `${key}`).val(`${value}`);
    }
}
