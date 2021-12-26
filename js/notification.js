window.onload = function () {
    if (!("Notification" in window))
        alert("This browser does not support desktop notification");
    else if (Notification.permission === "granted")
        notifyMe();
    else if (Notification.permission !== "denied")
        Notification.requestPermission().then(function (permission) {
            if (permission === "granted")
                notifyMe();
        });
    setInterval(notifyMe, 60000);
};

function notifyMe() {
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/inbox/checkmail",
        success: function (data) {
            if (data['tieu_de'].length) {
                var noticeOptions = { body: data['tieu_de'], icon: data['hinhanh'] };
                var notification = new Notification("Bạn có tin nhắn mới", noticeOptions);
                notification.onclick = function (event) {
                    $("#mess_avatar").attr("src",data['hinhanh']);
                    $('#mess_sender').text(data['nguoigui']);
                    $('#mess_subject').text(data['tieu_de']);
                    $('#mess_body').html(data['noi_dung']);
                    $('#readmsg').attr('value',data['id']);
                    $('#mail-date').text(data['ngay_gio']);
                    $('#xemchitiet').attr('href',data['link']);
                    $('#readmsg').modal('show');
                    $.ajax({
                            url: baseHome + "/inbox/update",
                            type: 'post',
                            dataType: "json",
                            data: {id: data['id']},
                    });
                };
            }
        }
    });
}

// function notifyMe() {
//     // Let's check if the browser supports notifications
//     if (!("Notification" in window)) {
//         alert("This browser does not support desktop notification");
//     }
//     // Let's check whether notification permissions have already been granted
//     else if (Notification.permission === "granted") {
//         // If it's okay let's create a notification
//         var noticeOptions = { body: "Bạn có tin nhắn mới...", icon: "https://gemstech.com.vn/uploads/home/logo-2.png" };
//         var notification = new Notification("Chào Hải", noticeOptions);
//         notification.onclick = function (event) {
//             window.open("https://www.w3schools.com", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=200,width=400,height=400");
//         };
//     }
//     // Otherwise, we need to ask the user for permission
//     else if (Notification.permission !== "denied") {
//         Notification.requestPermission().then(function (permission) {
//             // If the user accepts, let's create a notification
//             if (permission === "granted") {
//               var noticeOptions = { body: "Bạn có tin nhắn mới...", icon: "https://gemstech.com.vn/uploads/home/logo-2.png" };
//               var notification = new Notification("Chào Hải", noticeOptions);
//               notification.onclick = function (event) {alert()};
//             }
//         });
//     }
// }
