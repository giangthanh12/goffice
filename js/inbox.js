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
       
        var avatarImg = "<img src='https://cdn1.iconfinder.com/data/icons/developer-set-2/512/multiple-512.png' alt='avatar' />";
        if ($(option.element).data("avatar") != '') {
            var imgUrl = baseHome + '/users/gemstech/uploads/nhanvien/';
            avatarImg = "<img onerror= this.src='https://velo.vn/goffice-test/layouts/useravatar.png' src='" + imgUrl + $(option.element).data("avatar") + "' alt='avatar' />";
        }
        
        var $avatar = "<div class='d-flex flex-wrap align-items-center'>" + "<div class='avatar avatar-sm my-0 mr-50'>" + "<span class='avatar-content'>" + avatarImg + "</span>" + "</div>" + option.text + "</div>";
        return $avatar;
    }
    if (emailTo.length) {
        emailTo.wrap('<div class="position-relative"></div>').select2({
            placeholder: "Người nhận",
            dropdownParent: emailTo.parent(),
            closeOnSelect: false,
            templateResult: renderGuestAvatar,
            templateSelection: renderGuestAvatar,
            // tags: true,
            // tokenSeparators: [",", " "],
            language: {
                noResults: function () {
                    return 'Không có kết quả!';
                }
            },
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
            $('#listfile').html('');
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

    // select all
    // $(document).on("click", ".email-app-list .selectAll input", function () {
    //     if ($(this).is(":checked")) {
    //         userActions.find(".custom-checkbox input").prop("checked", this.checked).closest(".media").addClass("selected-row-bg");
    //     } else {
    //         userActions.find(".custom-checkbox input").prop("checked", "").closest(".media").removeClass("selected-row-bg");
    //     }
    // });

    // Delete selected Mail from list
    // if (mailDelete.length) {
    //     mailDelete.on("click", function () {
    //         if (userActions.find(".custom-checkbox input:checked").length) {
    //             userActions.find(".custom-checkbox input:checked").closest(".media").remove();
    //             emailAppList.find(".selectAll input").prop("checked", false);
    //             toastr["error"]("You have removed email.", "Mail Deleted!", {
    //                 closeButton: true,
    //                 tapToDismiss: false,
    //                 rtl: isRtl,
    //             });
    //             userActions.find(".custom-checkbox input").prop("checked", "");
    //         }
    //     });
    // }

    // Mark mail unread
    // if (mailUnread.length) {
    //     mailUnread.on("click", function () {
    //         userActions.find(".custom-checkbox input:checked").closest(".media").removeClass("mail-read");
    //     });
    // }

    // Filter
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
        container: "body",
    });


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
        var html = '';
         $('#listfile').html('');
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
        var type = $('#selectedType').val();
      
        if (emailTo.length>0) {
            var formData = new FormData(this);
            // var receiverName = JSON.stringify($("#email-to").val())
            // formData.append('receiverName', receiverName);
            // formData.append('tieude', $("#emailSubject").val());
            var quill_editor = $(".compose-form .ql-editor");
            if($('#emailSubject').val() == '') {
                notify_error('Bạn chưa nhập chủ đề');
                e.preventDefault();
                return;
            }
            if(quill_editor[0].innerHTML == '<p><br></p>') {
                notify_error('Bạn chưa nhập nội dung gửi');
                e.preventDefault();
                return;
            }
           
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
                    getCount();
                    $("#my-task-list").load(window.location.href + "?type="+type+" #my-task-list");
              
                    toastr["success"](response.msg, {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl,
                    });
                    console.log(response.data.receiverId);
                    // $("#my-task-list").load(window.location.href + "?type=sent #my-task-list");
                    // var receiver = response.receiver;
                    // var data = {'type':'inbox','receiverid':receiver.toString()};
                    // connection.send(JSON.stringify(data));
                    if (response.data.receiverId.includes(baseUser)) {
                        response.data.receiverId.splice(response.data.receiverId.indexOf(baseUser),1);
                        console.log(response.data.receiverId);
                    }
                    var data = {
                        type:'inbox',
                        action:'send',
                        path:taxCode,
                        receiverid: response.data.receiverId,
                        senderid:baseUser,
                        inboxIds: response.data.inboxIds,
                        listInboxId:response.data.idInbox,
                        avatar:baseHome + '/users/gemstech/uploads/nhanvien/'+response.data.avatar,
                        nameSender:response.data.nameSender,
                        title:response.data.title,
                        content:response.data.content,
                        dateTime:response.data.dateTime,
                };
                connection.send(JSON.stringify(data));
                    $('#compose-mail').modal('hide');
                }
                else notify_error(response.msg);
            });

        } else
            notify_error('Bạn chưa chọn người nhận tin');
        event.preventDefault(); // <- avoid reloading
    });

});

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
getCount();
function getCount() {
        $.ajax({
        type: "POST",
        dataType: "json",
        url: baseHome + "/inbox/getCount",
        success: function (data) {
            // if (data.success == true) {
                // $('#inboxNotSee').html('');
                $('#countnotsee').css('display','inline-block');
                    $('#countInbox').html('Hộp thư ('+data.inbox+')');
                    $('#countSent').html('Đã gửi ('+data.sent+')');
                    $('#countTrash').html('Thùng rác ('+data.trash+')');
                    if(data.notseen == '') {
                        $('#countnotsee').css('display','none');
                    }
                    else {
                        $('#countnotsee').html(data.notseen);
                    }
                   
            // } else {
            //     notify_error(data.msg);
               
            //     return false;
            // }
        },
    });
}
// connection.onmessage = function (message) {
//     var data = JSON.parse(message.data);
//     if (data.type == 'inbox') {
   
//         var receiver = JSON.parse(data.receiverid);
//         if (receiver.includes(baseUser)) {
//             alert('ok');
//         }
//     } 
    
// };
function toggleEmail(id) {
    var type = $('#selectedType').val();
  
    $.post(
        "inbox/loadMsg", {id:id,type:type},
        function (data, status) {
            if (data.success) {
                getCount();
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

$(document).on('click', '.select2-results__option',function() {
    $('.select2-search__field').val('');
})

$(document).on('click', '.select2-selection__choice__remove',function() {
   $('#select2-email-to-results').css('display','none');
})


$(document).on('blur', '.select2-selection--multiple',function() {
    $('#select2-email-to-results').css('display','block');
 })


function listInbox() {
    $(".email-app-details").removeClass('show');
    $("#selectedType").val('inbox');
    $("#my-task-list").load(window.location.href + " #my-task-list");
    $("#delMsgButton").removeClass('d-none');
    var $a = $('.list-group-messages').find('.active');
$a[0].classList.remove('active');
   $('.item-filter1')[0].classList.add('active');
   $('#page').val(1);
   getCount();
}

function listSent() {
    $("#selectedType").val('sent');
    $(".email-app-details").removeClass('show');
    $("#my-task-list").load(window.location.href + "?type=sent #my-task-list");
    $("#delMsgButton").removeClass('d-none');
    var $a = $('.list-group-messages').find('.active');
    $a[0].classList.remove('active');
       $('.item-filter2')[0].classList.add('active');
       $('#page').val(1);
}

function listTrash() {
    $("#selectedType").val('trash');
    $(".email-app-details").removeClass('show');
    $("#my-task-list").load(window.location.href + "?type=trash #my-task-list");
    $("#delMsgButton").addClass('d-none');
    var $a = $('.list-group-messages').find('.active');
    $a[0].classList.remove('active');
       $('.item-filter3')[0].classList.add('active');
       $('#page').val(1);
}

function deleteMsg() {
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
   
    if ($(".user-action").find(".custom-checkbox input:checked").length) {
        if(type == 'trash') {
            Swal.fire({
                title: 'Xóa dữ liệu',
                text: "Bạn có chắc chắn muốn xóa!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Tôi đồng ý',
                cancelButtonText: 'Hủy',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.post(
                        "inbox/deleteMsg", {ids:oChild,type:type},
                        function (data, status) {
                            if (data.success) {
                                $("#my-task-list").load(window.location.href + "?type="+type+" #my-task-list");
                                getCount();
                                $(".user-action").find(".custom-checkbox input:checked").closest(".media").remove();
                               if(type != 'trash') {
                                toastr["success"]("Bạn đã chuyển thư vào thùng rác thành công", {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl,
                                });
                               }
                               else {
                                toastr["success"]("Bạn đã xóa thư thành công", {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl,
                                });
                               }
                                // $("#listType").load(window.location.href + " #listType");
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
            });
        } 
        else {
            $.post(
                "inbox/deleteMsg", {ids:oChild,type:type},
                function (data, status) {
                    if (data.success) {
                        $("#my-task-list").load(window.location.href + "?type="+type+" #my-task-list");
                        getCount();
                        $(".user-action").find(".custom-checkbox input:checked").closest(".media").remove();
                       if(type != 'trash') {
                        toastr["success"]("Bạn đã chuyển thư vào thùng rác thành công", {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl,
                        });
                       }
                       else {
                        toastr["success"]("Bạn đã xóa thư thành công", {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl,
                        });
                       }
                        // $("#listType").load(window.location.href + " #listType");
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
    var type = $('#selectedType').val();
  
    $.post(
        "inbox/deleteMsg", {ids:id,type:type},
        function (data, status) {
            if (data.success) {
                getCount();
                // $("#listType").load(window.location.href + " #listType");
                $(".email-app-details").removeClass('show');
                if(type != 'trash') {
                    toastr["success"]("Bạn đã chuyển thư vào thùng rác thành công", {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl,
                    });
                   }
                   else {
                    toastr["success"]("Bạn đã xóa thư thành công", {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl,
                    });
                   }
                var seletedType = $('#selectedType').val();
                if (seletedType=='inbox')
                    $("#my-task-list").load(window.location.href + " #my-task-list");
                else
                    $("#my-task-list").load(window.location.href + "?type=sent #my-task-list");
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

$('#my-task-list').scroll(function (e) {
    console.log($('#my-task-list')[0].scrollHeight);
    console.log($('#my-task-list')[0].offsetHeight);
   
   var page;
   var selectedType = $('#selectedType').val();
    // $('#chat_id').textbox({value: scroll.scrollTop + scroll.offsetHeight});
    if ($('#my-task-list')[0].scrollTop + $('#my-task-list')[0].offsetHeight >= $('#my-task-list')[0].scrollHeight) {
        page = $('#page').val();
        page++;
        $.ajax(
            {
                type: 'get',
                dataType: 'json',
                url: baseHome + '/inbox/getListInbox',
                data: {page: page, selectedType:selectedType},
                success: function (result) {
                    if(result.success) {
                        $('#page').val(page);
                        // console.log(result.data);
                        var $avatar;
                        var $new;
                        result.data.forEach(function(item,value) {
                                    $avatar = baseHome+'/users/gemstech/uploads/nhanvien/'+item.avatar;
                                    if (item.status == 1 && selectedType != 'sent')
                                        $new = 'bullet-success';
                                    else if (item.status == 2)
                                        $new = 'bullet-primary';
                                    else
                                        $new = '';
                            $('.email-media-list').append(`
                            <li class="media" onclick="toggleEmail(${item.id})" id="${item.id}">
                                        <div class="media-left pr-50">
                                            <div class="avatar">`+
                                                '<img onerror='+"this.src='https://velo.vn/goffice-test/layouts/useravatar.png'"+' src="'+$avatar+'" alt="avatar" />'+
                                            `</div>
                                            <div class="user-action">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck${item.id}" />
                                                    <label class="custom-control-label" for="customCheck${item.id}"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="mail-details">
                                                <div class="mail-items">
                                                    <h5 class="mb-25">${item.senderName}</h5>
                                                    <span class="text-truncate">${item.title}</span>
                                                </div>
                                                <div class="mail-meta-item">
                                                    <span id="alertInbox${item.id}" class="mr-50 bullet ${$new} bullet-sm"></span>
                                                    <span class="mail-date">${item.dateTime}</span>
                                                </div>
                                            </div>
                                            <div class="mail-message">
                                                ${item.subContent}
                                            </div>
                                        </div>
                                    </li>
                            `)
                        })
                    }
                }
            })
            // .always(function () {
            //     // Sau khi thực hiện xong ajax thì ẩn hidden và cho trạng thái gửi ajax = false
            //     $loadding.addClass('hidden');
            //     is_busy = false;
            // });
        return false;
    }
});