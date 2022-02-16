function save() {
    $('#fm').validate({
        messages: {
            "name": {
                required: "Bạn chưa nhập tên thông tin!",
            },
            "gia_tri": {
                required: "Bạn chưa nhập giá trị!",
            }
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                url: baseHome + '/system/update',
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.code == 200) {
                        notyfi_success(data.message);
                        $(".card-body").load(window.location.href + " .card-body" );
                    } else
                        notify_error(data.message);
                }
            });
            return false;
        }
    });
    $('#fm').submit();
}
