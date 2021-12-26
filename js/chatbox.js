var userLocal = JSON.parse(localStorage.getItem('nhanvien'));
window.intervalChat = new Object();
var ChatActive = 0;
var chatboxid = 0;
var receiverid = 0;
var olduser = 0;
var olddate = 0;
var page = 1;
var skrol = document.getElementById("boxchat");

$(function () {
    'use strict';
    //console.log(localStorage.getItem('userid'));
    $('.app-content').addClass('chat-application');
    $('#user_avatar').attr("src", userLocal.hinhanh);
    $('#user_avatar_profile').attr("src", userLocal.hinhanh);
    return_combobox_multi('#list_users', baseHome + '/chatbox/combo?userid=' + baseUser, 'Lựa chọn thành viên');
    var chatUsersListWrapper = $('.chat-application .chat-user-list-wrapper'),
        overlay = $('.body-content-overlay'),
        profileSidebar = $('.chat-application .chat-profile-sidebar'),
        profileSidebarArea = $('.chat-application .profile-sidebar-area'),
        profileToggle = $('.chat-application .sidebar-profile-toggle'),
        userProfileToggle = $('.chat-application .user-profile-toggle'),
        userProfileSidebar = $('.user-profile-sidebar'),
        statusRadio = $('.chat-application .user-status input:radio[name=userStatus]'),
        userChats = $('.user-chats'),
        chatsUserList = $('.chat-users-list'),
        chatList = $('.chat-list'),
        contactList = $('.contact-list'),
        sidebarContent = $('.sidebar-content'),
        closeIcon = $('.chat-application .close-icon'),
        sidebarCloseIcon = $('.chat-application .sidebar-close-icon'),
        menuToggle = $('.chat-application .menu-toggle'),
        speechToText = $('.speech-to-text'),
        chatSearch = $('.chat-application #chat-search');

    // init ps if it is not touch device
    if (!$.app.menu.is_touch_device()) {
        // Chat user list
        if (chatUsersListWrapper.length > 0) {
            var chatUserList = new PerfectScrollbar(chatUsersListWrapper[0]);
        }

        // Admin profile left
        if (userProfileSidebar.find('.user-profile-sidebar-area').length > 0) {
            var userScrollArea = new PerfectScrollbar(userProfileSidebar.find('.user-profile-sidebar-area')[0]);
        }

        // Chat area
        if (userChats.length > 0) {
            var chatsUser = new PerfectScrollbar(userChats[0], {
                wheelPropagation: false
            });
        }

        // User profile right area
        if (profileSidebarArea.length > 0) {
            var user_profile = new PerfectScrollbar(profileSidebarArea[0]);
        }
    } else {
        chatUsersListWrapper.css('overflow', 'scroll');
        userProfileSidebar.find('.user-profile-sidebar-area').css('overflow', 'scroll');
        userChats.css('overflow', 'scroll');
        profileSidebarArea.css('overflow', 'scroll');

        // on user click sidebar close in touch devices
        $(chatsUserList)
            .find('li')
            .on('click', function () {
                $(sidebarContent).removeClass('show');
                $(overlay).removeClass('show');
            });
    }

    // Chat Profile sidebar & overlay toggle
    if (profileToggle.length) {
        profileToggle.on('click', function () {
            profileSidebar.addClass('show');
            overlay.addClass('show');
        });
    }

    // Update status by clicking on Radio
    if (statusRadio.length) {
        statusRadio.on('change', function () {
            var $className = 'avatar-status-' + this.value,
                profileHeaderAvatar = $('.header-profile-sidebar .avatar span');
            profileHeaderAvatar.removeClass();
            profileToggle.find('.avatar span').removeClass();
            profileHeaderAvatar.addClass($className + ' avatar-status-lg');
            profileToggle.find('.avatar span').addClass($className);
        });
    }

    // On Profile close click
    if (closeIcon.length) {
        closeIcon.on('click', function () {
            profileSidebar.removeClass('show');
            userProfileSidebar.removeClass('show');
            if (!sidebarContent.hasClass('show')) {
                overlay.removeClass('show');
            }
        });
    }

    // On sidebar close click
    if (sidebarCloseIcon.length) {
        sidebarCloseIcon.on('click', function () {
            sidebarContent.removeClass('show');
            overlay.removeClass('show');
        });
    }

    // User Profile sidebar toggle
    if (userProfileToggle.length) {
        userProfileToggle.on('click', function () {
            userProfileSidebar.addClass('show');
            overlay.addClass('show');
        });
    }

    // On overlay click
    if (overlay.length) {
        overlay.on('click', function () {
            sidebarContent.removeClass('show');
            overlay.removeClass('show');
            profileSidebar.removeClass('show');
            userProfileSidebar.removeClass('show');
        });
    }

    // Main menu toggle should hide app menu
    if (menuToggle.length) {
        menuToggle.on('click', function (e) {
            sidebarContent.removeClass('show');
            overlay.removeClass('show');
            profileSidebar.removeClass('show');
            userProfileSidebar.removeClass('show');
        });
    }

    // Chat sidebar toggle
    if ($(window).width() < 991) {
        onClickFn();
    }

    // Filter
    if (chatSearch.length) {
        chatSearch.on('keyup', function () {
            var value = $(this).val().toLowerCase();
            if (value !== '') {
                chatList.find('li:not(.no-results)').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });

                contactList.find('li:not(.no-results)').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });

                var chat_tbl_row = chatList.find('li:not(.no-results):visible').length,
                    contact_tbl_row = contactList.find('li:not(.no-results):visible').length;

                if (chat_tbl_row == 0) {
                    chatList.find('.no-results').addClass('show');
                } else {
                    if (chatList.find('.no-results').hasClass('show')) {
                        chatList.find('.no-results').removeClass('show');
                    }
                }

                if (contact_tbl_row == 0) {
                    contactList.find('.no-results').addClass('show');
                } else {
                    if (contactList.find('.no-results').hasClass('show')) {
                        contactList.find('.no-results').removeClass('show');
                    }
                }
            } else {
                chatsUserList.find('li').show();
                if (chatUsersListWrapper.find('.no-results').hasClass('show')) {
                    chatUsersListWrapper.find('.no-results').removeClass('show');
                }
            }
        });
    }
    var str_data_nhanvien = load_data(baseHome + '/chatbox/userinfo', 'id=' + baseUser);
    str_data_nhanvien = JSON.parse(str_data_nhanvien.responseText);
    var Obj_nhanvien = str_data_nhanvien.data;
    $('#fullname_chatbox').text(Obj_nhanvien.name);
    render_list_chat();
    $('#boxchat').scroll(function (vazanklik) {
        if (page > 0) {
            vazanklik.stopPropagation();
            vazanklik.preventDefault();
            if ($('#boxchat').scrollTop() == 0) {
                setTimeout(function () {
                    page++;
                    historyloader();
                    $('#boxchat').scrollTop(100);
                }, 500);
            }
        }
    });
    // $('#msg_chat').on("keyup",function (val){
    //     var data = {
    //         type: 'chatbox',
    //         action:'writing',
    //         tennv: userLocal.hoten
    //     }
    //     connection.send(JSON.stringify(data));
    // })

});

// Window Resize
$(window).on('resize', function () {
    if ($(window).width() > 992) {
        if ($('.chat-application .body-content-overlay').hasClass('show')) {
            $('.app-content .sidebar-left').removeClass('show');
            $('.chat-application .body-content-overlay').removeClass('show');
        }
    }

    // Chat sidebar toggle
    if ($(window).width() < 991) {
        onClickFn();
        if (
            !$('.chat-application .chat-profile-sidebar').hasClass('show') ||
            !$('.chat-application .sidebar-content').hasClass('show')
        ) {
            $('.sidebar-content').removeClass('show');
            $('.body-content-overlay').removeClass('show');
        }
    }
});

$(document).on('click', '.sidebar-toggle', function () {
    if ($(window).width() < 992) {
        onClickFn();
    }
});

function onClickFn() {
    var sidebarContent = $('.sidebar-content'),
        sidebarToggle = $('.sidebar-toggle'),
        overlay = $('.body-content-overlay');
    if (sidebarToggle.length) {
        sidebarContent.addClass('show');
        overlay.addClass('show');
    }
}

// Add message to chat - function call on form submit
function enterChat() {
    // document.getElementById('chat_form').action=baseHome + '/chatbox/chat?userid=' + baseUser;
    // document.getElementById('chat_form').method='post';
    // document.getElementById('chat_form').submit();
    var message = $('#msg_chat').val();
    if (message.length > 0) {
        var data = {
            token: userLocal.token,
            chatboxid: chatboxid,
            receiverid: receiverid,
            senderid: baseUser,
            message: message
        };
        $.ajax({
            type: "POST",
            dataType: "json",
            data: data,
            url: baseHome + '/chatbox/chat',
            success: function (result) {
                // if (data.success) {
                if (result.success) {
                    ChatActive = result.chatboxid;
                    chatboxid = result.chatboxid;
                    data = {
                        type: 'chatbox',
                        action: 'send',
                        chatboxid: result.chatboxid,
                        receiverid: result.receiverid,
                        senderid: baseUser,
                        message: message,
                        hinhanh: userLocal.hinhanh,
                        tennv: userLocal.hoten
                    }
                    connection.send(JSON.stringify(data));
                }

                //   }
                //         else
                //   notify_error(data.msg);
            },
            error: function () {
                notify_error('Cập nhật không thành công');
            }
        });
        $('#msg_chat').val('');
    } else {
        return false;
    }
}

// ham bat chat nhan vien
function enable_chat(receiver, chatbox, name_chat, avatar) {
    ChatActive = receiver;
    page = 1;
    var startArea = $('.start-chat-area'), activeChat = $('.active-chat');
    $('#msg_chat').val('');
    $('#name_chat').text(name_chat);
    if (avatar == '')
        avatar = baseHome + '/styles/default-avatar.jpg';
    $('#img_chat').attr('src', avatar);
    //   if ($('#list_contact').find('li').hasClass('active')) {
    $('#list_contact').find('li').removeClass('active');
    $('#list_chatbox').find('li').removeClass('active');
    //  }
    $('.item_chat_list_u' + receiver).addClass('active');
    if ($('#list_contact').find('li').hasClass('active')) {
        startArea.addClass('d-none');
        activeChat.removeClass('d-none');
        // clearInterval(window.intervalChat);
        // window.intervalChat = setInterval(function () {
        //     load_chat_content(idh, code);
        // }, 3000);
    } else {
        startArea.removeClass('d-none');
        activeChat.addClass('d-none');
    }
    receiverid = receiver;
    chatboxid = 0;
    load_chat_content(receiverid, chatboxid);
    reciverInfo();
}

// end ham bat chat nhan vien

// ham bat chat co san trong chat box
function enable_chated(receiver, chatid, name_chat, avatar, sender) {
    ChatActive = chatid;
    page = 1;
    var startArea = $('.start-chat-area'), activeChat = $('.active-chat');
    $('#msg_chat').val('');
    $('#name_chat').text(name_chat);
    if (avatar == '')
        avatar = baseHome + '/styles/default-avatar.jpg';
    $('#img_chat').attr('src', avatar);
    // if ($('#list_chatbox').find('li').hasClass('active')) {
    $('#list_chatbox').find('li').removeClass('active');
    $('#list_contact').find('li').removeClass('active');
    //  }
    $('.item_chated_list_' + chatid).addClass('active');
    if ($('#list_chatbox').find('li').hasClass('active')) {
        startArea.addClass('d-none');
        activeChat.removeClass('d-none');
        // clearInterval(window.intervalChat);
        // window.intervalChat = setInterval(function () {
        //     load_chat_content(idh, code);
        // }, 3000);
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {receiverid: baseUser, chatboxid: chatid},
            url: baseHome + '/chatbox/readall',
            success: function (result) {
                $('#unread_' + chatid).html('');
            },
            error: function () {
                notify_error('Cập nhật không thành công');
            }
        });
        load_chat_content(receiver, chatid);
    } else {
        startArea.removeClass('d-none');
        activeChat.addClass('d-none');
    }
    chatboxid = chatid;
    receiverid = receiver;
    reciverInfo();
}

function reciverInfo(){
    $('.sidebar-content').removeClass('show');
    $('.body-content-overlay').removeClass('show');
    var receiverInfo = load_data(baseHome + '/chatbox/getReceiverInfo?nhanvien=' + receiverid);
    receiverInfo = JSON.parse(receiverInfo.responseText);
    if(receiverInfo.code=='200') {
        let data = receiverInfo.data;
        $('#user_avatar_receiver').attr('src', data.hinh_anh);
        $('#user-post').html(data.phongban);
        $('#user-about').html(data.ghi_chu);
        $('#user-email').html(data.email);
        $('#user-phone').html(data.dien_thoai);
        $('#chat-user-name').html(data.name);
        $('#modal-create-group').on("click",function (e){
            $('#group_modal').modal('show');
        });
    }
}

// end ham bat chat co san trong chat box

// Ham load tin nhan chat
function load_chat_content(receiver, chatid) {
    if (receiver > 0)
        var type = 0;
    else
        var type = 1;
    olddate = 0;
    olduser = 0;
    $("#chat_content").empty();
    var str_data_chat = load_data(baseHome + '/chatbox/list_content_chat_point?chatboxid=' + chatid + '&page=' + page);
    str_data_chat = JSON.parse(str_data_chat.responseText);
    var Objdata_chat = str_data_chat.data;
    var html = '';
    var index = 0;
    jQuery.map(Objdata_chat, function (n, i) {
        index++;
        //  console.log(n);
        if (n.sender_id == baseUser) {
            var class_active = '';
        } else {
            var class_active = 'chat-left';
        }
        if (parseInt(n.time - olddate) > 1800) {
            html += '<div class="divider">';
            html += '<div class="divider-text">------------------------- ' + n.datetime + ' -------------------------</div>';
            html += '</div>';
        }
        html += '<div class="chat ' + class_active + '" id="textchat_' + n.id + '">';
        html += '<div class="chat-avatar">';
        olddate = n.time;
        if (olduser != n.sender_id) {
            html += '<span class="avatar box-shadow-1 cursor-pointer">';
            html += '<img src="' + n.hinhanh + '" lt="avatar" height="36" width="36" onerror="this.onerror=null; this.src=baseHome+\'/styles/default-avatar.jpg\'"/>';
            html += '</span>';
        } else {
            html += '<span class="avatar box-shadow-1 cursor-pointer" style="padding-left:36px;">';
            html += '</span>';
        }
        html += '</div>';
        html += '<div class="chat-body">';
        html += '<div class="chat-content">';
        html += '<p>' + n.message + '</p>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        olduser = n.sender_id;
    });
    if (index < 15) {
        page = 0;
    }
    if (index <= 7) {
        $('#boxchat').empty();
        $('#boxchat').html('<div class="chats" id="chat_content"></div>');
    }
    $("#chat_content").append(html);
    $('.user-chats').scrollTop($('.user-chats > .chats').height());
}

// end load tin nhan chat

// ham load danh sach nhan vien
function render_list_chat(activeid = '') {
    //Chatbox
    var str_data_list_chat = load_data(baseHome + '/chatbox/list_chatbox?userid=' + baseUser);
    str_data_list_chat = JSON.parse(str_data_list_chat.responseText);
    var Objdata_chatbox = str_data_list_chat.data;
    var html1 = '';
    let chatboxuser = [];
    jQuery.map(Objdata_chatbox, function (n, i) {
        if (chatboxuser.includes(n.sender_id) == false)
            chatboxuser[chatboxuser.length] = n.sender_id;
        if (n.type == 0)
            chatboxuser[chatboxuser.length] = n.receiver_id;
        let classactiveid = '';
        if (ChatActive > 0 && ChatActive == n.id)
            classactiveid = 'active';
        var avatar_chatbox = '';
        const d = new Date(n.lastdate);
        if (n.type == 0) {
            if (n.hinh_anh != '') {
                avatar_chatbox = n.hinh_anh;
            }
        }
        let senderId = n.sender_id;
        if (senderId == baseUser)
            senderId = n.receiver_id;
        html1 += '<li class="item_chated_list_' + n.id + ' ' + classactiveid + '" onclick="enable_chated(' + senderId + ', ' + n.id + ', \'' + n.group_name + '\',\'' + avatar_chatbox + '\',' + n.receiver_id + ')">';
        html1 += '<span class="avatar">';
        html1 += '<img src="' + avatar_chatbox + '" height="42" width="42" alt="Generic placeholder image" onerror="this.onerror=null; this.src=baseHome+\'/styles/default-avatar.jpg\'"/>';
        if (n.type == 0) {
            if (n.online != '' && n.online != null) {
                html1 += '<span class="avatar-status-online"></span>';
            } else {
                html1 += '<span class="avatar-status-offline"></span>';
            }
        } else {
            html1 += '';
        }
        html1 += '</span>';
        html1 += '<div class="chat-info flex-grow-1">';
        html1 += '<h5 class="mb-0">' + n.group_name + '</h5>';
        html1 += '<p class="card-text text-truncate">';
        html1 += n.tin_nhan_cuoi;
        html1 += '</p>';
        html1 += '</div>';
        html1 += '<div class="chat-meta text-nowrap">'
        html1 += '<small class="float-right mb-25 chat-time">' + d.getHours() + ':' + d.getMinutes() + '</small>';
        if (activeid != '' && activeid == ChatActive) {
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {receiverid: baseUser, chatboxid: activeid},
                url: baseHome + '/chatbox/readall',
                success: function (result) {
                },
                error: function () {
                    notify_error('Cập nhật không thành công');
                }
            });
        } //else if (n.chuadoc != 0 && n.chuadoc != null) {
        if (n.chuadoc == 0 || n.chuadoc == null)
            n.chuadoc = '';
            html1 += '<span class="badge badge-danger badge-pill float-right" id="unread_' + activeid + '">' + n.chuadoc + '</span>';
     //   }
        html1 += '</div>';
        html1 += '</li>';
    });
    $('#list_chatbox').html(html1);
    //contact
    var str_data = load_data(baseHome + '/chatbox/list_contact?userid=' + baseUser + '&listnv=' + chatboxuser);
    str_data = JSON.parse(str_data.responseText);
    var Objdata = str_data.data;
    var html = '';
    jQuery.map(Objdata, function (n, i) {
        let classActive = '';
        if (ChatActive > 0 && ChatActive == n.id)
            classActive = 'active';
        var avatar_nv = '';
        if (n.hinh_anh != '') {
            avatar_nv = n.hinh_anh;
        }
        html += '<li class="item_chat_list_u' + n.id + ' ' + classActive + '" onclick="enable_chat(' + n.id + ', 0,\'' + n.name + '\',\'' + avatar_nv + '\')">';
        html += '<span class="avatar">';
        html += '<img src="' + avatar_nv + '" height="42" width="42" onerror="this.onerror=null; this.src=baseHome+\'/styles/default-avatar.jpg\'" alt="Generic placeholder image" />';
        if (n.online != '' && n.online != null) {
            html += '<span class="avatar-status-online"></span>';
        } else {
            html += '<span class="avatar-status-offline"></span>';
        }
        html += '</span>';
        html += '<div class="chat-info">';
        html += '<h5 class="mb-0">' + n.name + '</h5>';
        html += '</div>';
        html += '</li>';
    });
    $('#list_contact').html(html);
}

// end ham load danh sach nhan vien

function create_group() {
    $('#group_modal').modal('show');
    $('.chat-profile-sidebar').removeClass('show');
}

function save_group() {
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function () {
        if ($(this).val() == '') {
            allRequired = false;
        }
    });
    if (allRequired) {
        var xhr = new XMLHttpRequest();
        var formData = new FormData($('#fm-group-chat')[0]);
        $.ajax({
            url: baseHome + '/chatbox/add_group?userid=' + baseUser,  //server script to process data
            type: 'POST',
            xhr: function () {
                return xhr;
            },
            data: formData,
            datType: 'json',
            success: function (data) {
                if (data.success == true) {
                    $('.modal').modal('hide');
                    window.onload = function (a) {
                        render_list_chat();
                        load_chat_content();
                    };
                } else {
                    notify_error(data.msg);
                    return false;
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    } else {
        notify_error('Bạn chưa điền đủ thông tin');
    }
}

/*document.addEventListener( 'visibilitychange' , function() {
    if(document.visibilityState === 'visible') {
        render_list_chat();
    }else{
        clearInterval(window.intervalChat);
        clearInterval(window.interVallist);
    }
}, false );*/

function historyloader() {
    window.priprema = "";
    if (receiverid > 0)
        var type = 0;
    else
        var type = 1;
    var str_data_chat = load_data(baseHome + '/chatbox/list_content_chat_point?chatboxid=' + chatboxid + '&page=' + page);
    str_data_chat = JSON.parse(str_data_chat.responseText);
    var Objdata_chat = str_data_chat.data;
    var html = '';
    var index = 0;
    jQuery.map(Objdata_chat, function (n, i) {
        //  console.log(n);
        index++;
        if (n.sender_id == baseUser) {
            var class_active = '';
        } else {
            var class_active = 'chat-left';
        }
        if (parseInt(n.time - olddate) > 1800) {
            html += '<div class="divider">';
            html += '<div class="divider-text">------------------------- ' + n.datetime + ' -------------------------</div>';
            html += '</div>';
        }
        html += '<div class="chat ' + class_active + '" id="textchat_"+n.id>';
        html += '<div class="chat-avatar">';
        olddate = n.time;
        if (olduser != n.sender_id) {
            html += '<span class="avatar box-shadow-1 cursor-pointer">';
            html += '<img src="' + n.hinhanh + '" lt="avatar" height="36" width="36" onerror="this.onerror=null; this.src=baseHome+\'/styles/default-avatar.jpg\'"/>';
            html += '</span>';
        } else {
            html += '<span class="avatar box-shadow-1 cursor-pointer" style="padding-left:36px;">';
            html += '</span>';
        }
        html += '</div>';
        html += '<div class="chat-body">';
        html += '<div class="chat-content">';
        html += '<p>' + n.message + '</p>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        olduser = n.sender_id;
    });
    if (index < 15) {
        page = 0;
    }
    $('#chat_content').prepend(html);
    //  $('.user-chats').scrollTop($('.user-chats > .chats').height());
}
function actionchat(data) {
    var html = "";
    if (data.type == 'chatbox') {
        if(data.action=='send') {
            if (data.chatboxid == ChatActive) {
                if (data.senderid == baseUser) {
                    var class_active = '';
                } else {
                    var class_active = 'chat-left';
                }
                html += '<div class="chat ' + class_active + '">';
                html += '<div class="chat-avatar">';
                if (olduser != data.senderid) {
                    html += '<span class="avatar box-shadow-1 cursor-pointer">';
                    html += '<img src="' + data.hinhanh + '" lt="avatar" height="36" width="36" onerror="this.onerror=null; this.src=baseHome+\'/styles/default-avatar.jpg\'"/>';
                    html += '</span>';
                } else {
                    html += '<span class="avatar box-shadow-1 cursor-pointer" style="padding-left:36px;">';
                    html += '</span>';
                }
                html += '</div>';
                html += '<div class="chat-body">';
                html += '<div class="chat-content">';
                html += '<p>' + data.message + '</p>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                $('#chat_content').append(html);
                $('.user-chats').scrollTop($('.user-chats > .chats').height());
                olduser = data.senderid;
            }
            render_list_chat(data.chatboxid);
        }
    }
}