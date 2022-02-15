/*=========================================================================================
    File Name: app-email.js
    Description: Email Page js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

"use strict";

$(function () {
    // Register Quill Fonts
    var Font = Quill.import("formats/font");
    Font.whitelist = ["sofia", "slabo", "roboto", "inconsolata", "ubuntu"];
    Quill.register(Font, true);
    $('.custom-control-input').prop('checked', false);
    var compose = $(".compose-email"),
        composeModal = $("#compose-mail"),
        menuToggle = $(".menu-toggle"),
        sidebarToggle = $(".sidebar-toggle"),
        sidebarLeft = $(".sidebar-left"),
        sidebarMenuList = $(".sidebar-menu-list"),
        emailAppList = $(".email-app-list"),
        emailUserList = $(".email-user-list"),
        emailUserListInput = $(".email-user-list .custom-checkbox"),
        emailScrollArea = $(".email-scroll-area"),
        emailTo = $("#email-to"),
        emailCC = $("#emailCC"),
        emailBCC = $("#emailBCC"),
        toggleCC = $(".toggle-cc"),
        toggleBCC = $(".toggle-bcc"),
        wrapperCC = $(".cc-wrapper"),
        wrapperBCC = $(".bcc-wrapper"),
        emailDetails = $(".email-app-details"),
        listGroupMsg = $(".list-group-messages"),
        goBack = $(".go-back"),
        favoriteStar = $(".email-application .email-favorite"),
        userActions = $(".user-action"),
        mailDelete = $(".mail-delete"),
        mailUnread = $(".mail-unread"),
        emailSearch = $("#email-search"),
        editorEl = $("#message-editor .editor"),
        overlay = $(".body-content-overlay"),
        isRtl = $("html").attr("data-textdirection") === "rtl";

    var assetPath = "../../../app-assets/";

    if ($("body").attr("data-framework") === "laravel") {
        assetPath = $("body").attr("data-asset-path");
    }

    // Toggle BCC on mount
    if (wrapperBCC.length) {
        wrapperBCC.toggle();
    }

    // Toggle CC on mount
    if (wrapperCC) {
        wrapperCC.toggle();
    }

    // Toggle BCC input
    if (toggleBCC.length) {
        toggleBCC.on("click", function () {
            wrapperBCC.toggle();
        });
    }

    // Toggle CC input
    if (toggleCC.length) {
        toggleCC.on("click", function () {
            wrapperCC.toggle();
        });
    }

    // if it is not touch device
    if (!$.app.menu.is_touch_device()) {
        // Email left Sidebar
        if ($(sidebarMenuList).length > 0) {
            var sidebar_menu_list = new PerfectScrollbar(sidebarMenuList[0]);
        }

        // User list scroll
        if ($(emailUserList).length > 0) {
            var users_list = new PerfectScrollbar(emailUserList[0]);
        }

        // Email detail section
        if ($(emailScrollArea).length > 0) {
            var users_list = new PerfectScrollbar(emailScrollArea[0]);
        }
    }
    // if it is a touch device
    else {
        $(sidebarMenuList).css("overflow", "scroll");
        $(emailUserList).css("overflow", "scroll");
        $(emailScrollArea).css("overflow", "scroll");
    }

    // Email to user select
    function renderGuestAvatar(option) {
        if (!option.id) {
            return option.text;
        }
        var avatarImg = feather.icons["user"].toSvg({
            class: "mr-0",
        });
        if ($(option.element).data("avatar")) {
            avatarImg = "<img src='" + assetPath + "images/avatars/" + $(option.element).data("avatar") + "' alt='avatar' />";
        }

        var $avatar = "<div class='d-flex flex-wrap align-items-center'>" + "<div class='avatar avatar-sm my-0 mr-50'>" + "<span class='avatar-content'>" + avatarImg + "</span>" + "</div>" + option.text + "</div>";

        return $avatar;
    }
    if (emailTo.length) {
        emailTo.wrap('<div class="position-relative"></div>').select2({
            placeholder: "Select value",
            dropdownParent: emailTo.parent(),
            closeOnSelect: false,
            templateResult: renderGuestAvatar,
            templateSelection: renderGuestAvatar,
            tags: true,
            tokenSeparators: [",", " "],
            escapeMarkup: function (es) {
                return es;
            },
        });
    }

    if (emailCC.length) {
        emailCC.wrap('<div class="position-relative"></div>').select2({
            placeholder: "Select value",
            dropdownParent: emailCC.parent(),
            closeOnSelect: false,
            templateResult: renderGuestAvatar,
            templateSelection: renderGuestAvatar,
            tags: true,
            tokenSeparators: [",", " "],
            escapeMarkup: function (es) {
                return es;
            },
        });
    }

    if (emailBCC.length) {
        emailBCC.wrap('<div class="position-relative"></div>').select2({
            placeholder: "Select value",
            dropdownParent: emailBCC.parent(),
            closeOnSelect: false,
            templateResult: renderGuestAvatar,
            templateSelection: renderGuestAvatar,
            tags: true,
            tokenSeparators: [",", " "],
            escapeMarkup: function (es) {
                return es;
            },
        });
    }

    // compose email
    if (compose.length) {
        compose.on("click", function () {
            // showing rightSideBar
            overlay.removeClass("show");
            // hiding left sidebar
            sidebarLeft.removeClass("show");
            // all input forms
            $(".compose-form input").val("");
            emailTo.val([]).trigger("change");
            emailCC.val([]).trigger("change");
            emailBCC.val([]).trigger("change");
            wrapperCC.hide();
            wrapperBCC.hide();

            // quill editor content
            var quill_editor = $(".compose-form .ql-editor");
            quill_editor[0].innerHTML = "";
        });
    }

    // Main menu toggle should hide app menu
    if (menuToggle.length) {
        menuToggle.on("click", function (e) {
            sidebarLeft.removeClass("show");
            overlay.removeClass("show");
        });
    }

    // Email sidebar toggle
    if (sidebarToggle.length) {
        sidebarToggle.on("click", function (e) {
            e.stopPropagation();
            sidebarLeft.toggleClass("show");
            overlay.addClass("show");
        });
    }

    // Overlay Click
    if (overlay.length) {
        overlay.on("click", function (e) {
            sidebarLeft.removeClass("show");
            overlay.removeClass("show");
        });
    }

    // Email Right sidebar toggle
    // if (emailUserList.find("li").length) {
    //     emailUserList.find("li").on("click", function (e) {
    //         emailDetails.toggleClass("show");
    //     });
    // }

    // Add class active on click of sidebar list
    if (listGroupMsg.find("a").length) {
        listGroupMsg.find("a").on("click", function () {
            if (listGroupMsg.find("a").hasClass("active")) {
                listGroupMsg.find("a").removeClass("active");
            }
            $(this).addClass("active");
        });
    }

    // Email detail view back button click
    if (goBack.length) {
        goBack.on("click", function (e) {
            e.stopPropagation();
            emailDetails.removeClass("show");
        });
    }

    // Favorite star click
    if (favoriteStar.length) {
        favoriteStar.on("click", function (e) {
            $(this).find("svg").toggleClass("favorite");
            e.stopPropagation();
            // show toast only have favorite class
            if ($(this).find("svg").hasClass("favorite")) {
                toastr["success"]("Updated mail to favorite", "Favorite Mail ⭐️", {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl,
                });
            }
        });
    }

    // For app sidebar on small screen
    if ($(window).width() > 768) {
        if (overlay.hasClass("show")) {
            overlay.removeClass("show");
        }
    }

    // single checkbox select
    if (emailUserListInput.length) {
        emailUserListInput.on("click", function (e) {
            alert('ok');
            e.stopPropagation();
        });
        emailUserListInput.find("input").on("change", function (e) {
            e.stopPropagation();
            var $this = $(this);
            if ($this.is(":checked")) {
                $this.closest(".media").addClass("selected-row-bg");
            } else {
                $this.closest(".media").removeClass("selected-row-bg");
            }
        });
    }
    // Filter
    if (emailSearch.length) {
        emailSearch.on("keyup", function () {
            
            var value = $(this).val().toLowerCase();
            if (value !== "") {
                emailUserList.find(".email-media-list li").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
                var tbl_row = emailUserList.find(".email-media-list li:visible").length;

                //Check if table has row or not
                if (tbl_row == 0) {
                    emailUserList.find(".no-results").addClass("show");
                    emailUserList.animate({ scrollTop: "0" }, 500);
                } else {
                    if (emailUserList.find(".no-results").hasClass("show")) {
                        emailUserList.find(".no-results").removeClass("show");
                    }
                }
            } else {
                // If filter box is empty
                emailUserList.find(".email-media-list li").show();
                if (emailUserList.find(".no-results").hasClass("show")) {
                    emailUserList.find(".no-results").removeClass("show");
                }
            }
        });
    }

    // Email compose Editor
    if (editorEl.length) {
        var emailEditor = new Quill(editorEl[0], {
            bounds: "#message-editor .editor",
            modules: {
                formula: true,
                syntax: true,
                toolbar: ".compose-editor-toolbar",
            },
           // placeholder: "Message",
            theme: "snow",
        });
    }

    $("#file-input").change(function(e){
         var html = $('#listfile').html();
         var files = e.target.files;
         for(var i=0;i<files.length;i++){
            html += '<li>'+files[i].name+'<li>';
         }
         $('#listfile').html(html);
    });

    // On navbar search and bookmark Icon click, hide compose mail
    $(".nav-link-search, .bookmark-star").on("click", function () {
        composeModal.modal("hide");
    });

    $('#form-send').on("submit", function(e) {
        var emailTo = $('#email-to').val();
        if (emailTo.length>0) {
            var formData = new FormData(this);
            // var receiverName = JSON.stringify($("#email-to").val())
            // formData.append('receiverName', receiverName);
            // formData.append('tieude', $("#emailSubject").val());
            var quill_editor = $(".compose-form .ql-editor");
            formData.append('body', quill_editor[0].innerHTML);
            $.ajax({
                method: "POST",
                url: "inbox/sendMsg",
                data: formData,
                mimeType: "multipart/form-data",
                cache: false, // do not cache this request
                contentType: false, // prevent missing boundary string
                processData: false, // do not transform to query string
                dataType: "json",
            }).done(function(response) {
                if (response.success) {
                   
                    // var countSent = $('#countSent').html();
                    // countSent = countSent.slice(-2,-1);
                    // countSent = Number(countSent) + 1;
                    // $('#countSent').html(`Đã gửi (${countSent})`);
                    // var receiver = JSON.parse(response.data.receiverId);
                    // if (receiver.includes(baseUser)) {
                    //     getInboxNotSeen();
                    //     var countInbox = $('#countInbox').html();
                    //     countInbox = countInbox.slice(-2,-1);
                    //     countInbox = Number(countInbox) + 1;
                    //     $('#countInbox').html(`Hộp thư (${countInbox})`);
                    // }
                   
                    $("#listType").load(window.location.href + "?type=sent #listType");
                    notyfi_success(response.msg);
                    var data = {
                        type:'inbox',
                        action:'send',
                        receiverid: response.data.receiverId,
                        senderid:baseUser,
                        avatar:response.data.avatar,
                        title:response.data.title,
                        content:response.data.content,
                };
                    connection.send(JSON.stringify(data));
                    $('#compose-mail').modal('hide');
                }
                else notify_error(response.msg);
            });

        } else
            notify_error('Bạn chưa chọn người nhận tin');
        e.preventDefault(); // <- avoid reloading
    });

});

// function getInboxNotSeen() {
//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         url: baseHome + "/inbox/getInboxNotSeen",
//         success: function (data) {
//             if (data.success == true) {
//                 $('#inboxNotSee').html('');
//                 if(data.val > 0) {
//                     $('#inboxNotSee').html(data.val);
//                 }
//             } else {
//                 notify_error(data.msg);
               
//                 return false;
//             }
//         },
//     });
// }
// getInboxNotSeen();





connection.onmessage = function (message) {
    var data = JSON.parse(message.data);
    if (data.type == 'inbox') {
   
        var receiver = JSON.parse(data.receiverid);
        if (receiver.includes(baseUser)) {
      
        }
    } 
    
};






$(window).on("resize", function () {
    var sidebarLeft = $(".sidebar-left");
    // remove show classes from sidebar and overlay if size is > 992
    if ($(window).width() > 768) {
        if ($(".app-content .body-content-overlay").hasClass("show")) {
            sidebarLeft.removeClass("show");
            $(".app-content .body-content-overlay").removeClass("show");
        }
    }
});

function toggleEmail(id) {
var type = $('.media-type').html();
    $.post(
        "inbox/loadMsg", {id:id,type:type},
        function (data, status) {
            if (data.success) {
                $("#listType").load(window.location.href + " #listType");
                if($('.notification-items').find('.notification-item'+data.data['id']).length > 0 && type != 'sent') {
                 var $count =  Number($('#countNotifications').html());
                  $count -= 1;
                  if($count == 0) {
                    $('#countNotifications').remove();
                    $('#countNotifications1').html(`${$count} tin`);
                  } 
                  else {
                    $('#countNotifications').html($count);
                    $('#countNotifications1').html(`${$count} tin`);
                  }
                  $('.notification-item'+data.data['id']).remove();
                }
               

               $('#alertInbox'+data.data['id']).remove('.bullet-success');
                $('#msgId').val(data.data['id']);
                $('#msgSender').val(data.data['senderId']);
                $('#senderImg').attr('src', baseHome+'/users/gemstech/uploads/nhanvien/'+data.data['avatar']);
                $('#senderName').text(data.data['senderName']);
                $('#msgSubject').text(data.data['title']);
                $('#dateTime').text(data.data['dateTime']);
                $('#msgContent').html(data.data['content']);
                if (data.data['attachmentFile'].length>0) {
                    var files = data.data['attachmentFile'].split(",");
                    var attachedFiles = '<ul>';
                    files.forEach(function(item, index){
                        attachedFiles += '<li><a href="'+baseUrlFile+'/uploads/dinhkem/'+item+'" target="_blank">'+item+' </a></li>'
                    });
                    attachedFiles += '</ul>';
                    $('#attachedFiles').html(attachedFiles);
                }
                $(".email-app-details").toggleClass("show");
            } else {
                toastr["error"](data.msg, "Database error!", {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl,
                });
            }
        },
        "json"
    );
}

function listInbox() {
    $(".email-app-details").removeClass('show');
    $("#selectedType").val('inbox');
    $("#my-task-list").load(window.location.href + " #my-task-list");
    $("#delMsgButton").removeClass('d-none');
  var $a = $('.list-group-messages').find('.active');
$a[0].classList.remove('active');
   $('.item-filter1')[0].classList.add('active');
}

function listSent() {
    $("#selectedType").val('sent');
    $(".email-app-details").removeClass('show');
    $("#my-task-list").load(window.location.href + "?type=sent #my-task-list");
    $("#delMsgButton").removeClass('d-none');
    $('.list-group-item2').remove('.active');
    var $a = $('.list-group-messages').find('.active');
    $a[0].classList.remove('active');
       $('.item-filter2')[0].classList.add('active');
}

function listTrash() {
    $("#selectedType").val('trash');
    $(".email-app-details").removeClass('show');
    $("#my-task-list").load(window.location.href + "?type=trash #my-task-list");
    $("#delMsgButton").addClass('d-none');
    $('.list-group-item3').remove('.active');
    var $a = $('.list-group-messages').find('.active');
    $a[0].classList.remove('active');
       $('.item-filter3')[0].classList.add('active');
}

function deleteMsg() {
    if ($(".user-action").find(".custom-checkbox input:checked").length) {

        var type = $('#selectedType').val();
    
        var temp = $(".user-action").find(".custom-checkbox input:checked").closest(".media");
        var oChild = '';
        var i = 0;
        for(i = 0; i < temp.length; i++){
            if (oChild=='')
                oChild = temp[i].id;
            else
                oChild += ','+temp[i].id;
        }
    
        $.post(
            "inbox/deleteMsg", {ids:oChild, type:type},
            function (data, status) {
                if (data.success) {
                  
                    $(".user-action").find(".custom-checkbox input:checked").closest(".media").remove();
                    toastr["success"]("You have removed email.", "Mail Deleted!", {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl,
                    });
                    $("#listType").load(window.location.href + " #listType");
                    // getInboxNotSeen();
                } else {
                    toastr["error"](data.msg, "💾 Task Action!", {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl,
                    });
                }
            },
            "json"
        );
    } else {
        toastr["error"]("Chưa tick tin nhắn cần xóa.", "Vui lòng chọn!", {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl,
        });
        // $(".user-action")
    }
}

function removeMsg() {
    var id = $('#msgId').val();
    var type = $("#selectedType").val();
    $.post(
        "inbox/deleteMsg", {ids:id,type:type},
        function (data, status) {
            if (data.success) {
                $("#listType").load(window.location.href + " #listType");
                $(".email-app-details").removeClass('show');
                var seletedType = $('#selectedType').val();
                if (seletedType=='inbox')
                    $("#my-task-list").load(window.location.href + " #my-task-list");
                    
                else
                    $("#my-task-list").load(window.location.href + "?type=sent #my-task-list");
                    $("#listType").load(window.location.href + " #listType");

                    
            } else {
                toastr["error"](data.msg, "💾 Task Action!", {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl,
                });
            }
        },
        "json"
    );
}

function replyMsg() {
    var sender = $('#msgSender').val();
    var subject = $('#msgSubject').text() + ' [reply]';
    var content = '<br>--------------<br>'+ $('#msgContent').html();
    $('#email-to').val(sender).trigger("change");
    $('#emailSubject').val(subject);
    var quill_editor = $(".compose-form .ql-editor");
    quill_editor[0].innerHTML = content;
    $("#compose-mail").modal("show");
}

function forwardMsg() {
    var sender = $('#msgSender').val();
    var subject = $('#msgSubject').text() + ' [reply]';
    var content = '<br>--------------<br>'+ $('#msgContent').html();
    $('#email-to').val('').trigger("change");
    $('#emailSubject').val(subject);
    var quill_editor = $(".compose-form .ql-editor");
    quill_editor[0].innerHTML = content;
    $("#compose-mail").modal("show");
}

// function displayAttach() {
//     var fullPath = $('#file-input').val();
//     if (fullPath) {
//         var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
//         var filename = fullPath.substring(startIndex);
//         if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0)
//             filename = filename.substring(1);
//         $('#attachment').text(filename);
//     }
// }

// function sendMsg() {
//     var emailto = $('#email-to').val();
//     if (emailto.length>0) {
//         var fd = new FormData();
//         fd.append('emailto',emailto);
//         fd.append('subject',$('#emailSubject').val());
//         fd.append('body',$('#msgBody').html());
//         var files = $('#file-input')[0].files;
//         console.log(files);
//         if(files.length > 0 ){
//             fd.append('files',files);
//         }
//         $.ajax({
//            url: 'inbox/sendMsg',
//            type: 'post',
//            data: fd,
//            contentType: false,
//            processData: false,
//            dataType: "json",
//            success: function(response){
//               if(response.success){
//                  // $("#img").attr("src",response);
//                  // $(".preview img").show(); // Display image element
//               }else{
//                   toastr["error"](response.msg, "💾 Message not sent!", {
//                       closeButton: true,
//                       tapToDismiss: false,
//                       rtl: isRtl,
//                   });
//               }
//            },
//         });
//           //
//     } else {
//         toastr["error"]('Bạn chưa chọn người nhận thông báo', "💾 Message not sent!", {
//             closeButton: true,
//             tapToDismiss: false,
//             rtl: isRtl,
//         });
//     }
// }
