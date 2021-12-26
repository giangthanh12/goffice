var isRtl = $('html').attr('data-textdirection') === 'rtl';
$(function (){
    var folder = '';
    if(localStorage.getItem("folder")!=null){
        folder = localStorage.getItem("folder");
        saveFolder(folder);
        $('#taxCode').val(folder);
        $('#taxCode').attr("readonly","readonly");
    }
    $('#taxCode').on('focusout',function (){
        folder=this.value;
        if(folder!="") {
            saveFolder(folder);
            localStorage.setItem("folder", folder);
            $('#taxCode').attr("readonly", "readonly");
        }else{
            $('#taxCode').focus();
        }
    })
    $('#login-form').on("submit",function (){
        login();
        return false;
    })
    $('#editTaxCode').on("click",function (){
        $('#taxCode').removeAttr("readonly");
        $('#taxCode').focus();
    })
});
function saveFolder(folder){
    $.ajax({
        url: baseHome + '/saveFolder',  //server script to process data
        type: 'POST',
        data: {folder:folder},
        dataType: 'json',
        success: function (data) {
            console.log(data);
        },
        processData: true
    });
}

function login() {
    var username = $('#username').val();
    var password = $('#password').val();
    if (username.length == 0 || password.length == 0) {
        notify_error("Bạn chưa điền đủ thông tin");
        return false;
    } else {
        var xhr = new XMLHttpRequest();
        var formData = new FormData($('#login-form')[0]);
        $.ajax({
            url: baseHome + '/auth/login',  //server script to process data
            type: 'POST',
            xhr: function () {
                return xhr;
            },
            data: formData,
            dataType: 'json',
            success: function (data) {
                if (data.code == 200) {
                    // notyfi_success('Dang nhap thanh cong');
                    $.ajax({
                        url: baseHome + '/chamcong/chamcong',  //server script to process data
                        type: 'POST',
                        xhr: function () {
                            return xhr;
                        },
                        datType: 'json',
                        success: function (result) {
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                   window.location.href = baseHome;
                } else {
                    notify_error(data.message);
                    return false;
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
}

$(function () {
    $(document).on("keyup", function (e) {
        if (e.which === 13 && ["toolbar", "toolbar1", "toolbar2", "toolbar3"].includes(e.target.parentElement.parentElement.id)) {
            timkiem();
        }
    });
})

function notify_error(msg_Text) {
    toastr['error'](msg_Text, 'Báo lỗi !', {
        closeButton: true,
        tapToDismiss: false,
        rtl: isRtl
    });
}

function notyfi_success(msg_Text) {
    toastr['success'](msg_Text, 'Thông báo !', {
        closeButton: true,
        tapToDismiss: false,
        rtl: isRtl
    });
}
