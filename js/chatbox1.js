var userLocal = JSON.parse(localStorage.getItem('nhanvien'));
window.intervalChat = new Object();
var userChat = 0;
$(function () {
    'use strict';
    //console.log(localStorage.getItem('userid'));
    $('.app-content').addClass('chat-application');
    return_combobox_multi('#list_users', baseApi + '/chatbox/combo?userid=' + userLocal.nhan_vien, 'Lựa chọn thành viên');
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
    var str_data_nhanvien = load_data(baseApi + '/chatbox/userinfo', 'token=' + localStorage.getItem('token') + '&id=' + userLocal.nhan_vien);
    var Obj_nhanvien = return_data(str_data_nhanvien.responseJSON.data);
    $('#fullname_chatbox').text(Obj_nhanvien.name);
    render_list_chat();
    clearInterval(window.intervalChat);
    window.interVallist = setInterval(function () {
        render_list_chat();
    }, 3000);

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
    // document.getElementById('chat_form').action=baseApi + '/chatbox/chat?userid=' + userLocal.nhan_vien;
    // document.getElementById('chat_form').method='post';
    // document.getElementById('chat_form').submit();
    var message = $('#msg_chat').val();
    var idenemy = $('#id_enemy').val();
    if (message.length > 0) {
        //alert(message);
        var html = '';
        var xhr = new XMLHttpRequest();
        var formData = new FormData($('#chat_form')[0]);
        $.ajax({
            url: baseApi + '/chatbox/chat?userid=' + userLocal.nhan_vien,  //server script to process data
            type: 'POST',
            xhr: function () {
                return xhr;
            },
            data: formData,
            datType: 'json',
            success: function (data) {
                if (data.success == true) {
                    $('#chat_code').val(data.code);
                    userChat = data.code;
                    html += '<div class="chat">';
                    html += '<div class="chat-avatar">';
                    html += '<span class="avatar box-shadow-1 cursor-pointer">';
                    html += '<img src="' + data.hinh_anh + '" lt="avatar" height="36" width="36" onerror="this.onerror=null; this.src=baseHome+\'/styles/default-avatar.jpg\'"/>';
                    html += '</span>';
                    html += '</div>';
                    html += '<div class="chat-body">';
                    html += '<div class="chat-content">';
                    html += '<p>' + message + '</p>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    $('#chat_content').append(html);
                    $('.user-chats').scrollTop($('.user-chats > .chats').height());
                } else {
                    notify_error(data.msg);
                    return false;
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
        $('#msg_chat').val('');
    } else {
        return false;
    }
}

// ham bat chat nhan vien
function enable_chat(idh, code, name_chat, avatar) {
    userChat = idh;
    var startArea = $('.start-chat-area'), activeChat = $('.active-chat');
    $('#msg_chat').val('');
    clearInterval(window.intervalChat);
    $('#name_chat').text(name_chat);
    if (avatar == '')
        avatar = baseHome + '/styles/default-avatar.jpg';
    $('#img_chat').attr('src', avatar);
    if ($('#list_contact').find('li').hasClass('active')) {
        $('#list_contact').find('li').removeClass('active');
        $('#list_chatbox').find('li').removeClass('active');
    }
    $('.item_chat_list_' + idh).addClass('active');
    if ($('#list_contact').find('li').hasClass('active')) {
        startArea.addClass('d-none');
        activeChat.removeClass('d-none');
        clearInterval(window.intervalChat);
        window.intervalChat = setInterval(function () {
            load_chat_content(idh, code);
        }, 3000);
    } else {
        startArea.removeClass('d-none');
        activeChat.addClass('d-none');
    }
    $('#id_enemy').val(idh);
    $('#chat_code').val(0);
    load_chat_content(idh, code);
}

// end ham bat chat nhan vien

// ham bat chat co san trong chat box
function enable_chated(idh, code, name_chat, avatar) {
    userChat = code;
    var startArea = $('.start-chat-area'), activeChat = $('.active-chat');
    $('#msg_chat').val('');
    $('#name_chat').text(name_chat);
    if (avatar == '')
        avatar = baseHome + '/styles/default-avatar.jpg';
    $('#img_chat').attr('src', avatar);
    clearInterval(intervalChat);
    if ($('#list_chatbox').find('li').hasClass('active')) {
        $('#list_chatbox').find('li').removeClass('active');
        $('#list_contact').find('li').removeClass('active');
    }
    $('.item_chated_list_' + code).addClass('active');
    if ($('#list_chatbox').find('li').hasClass('active')) {
        startArea.addClass('d-none');
        activeChat.removeClass('d-none');
        clearInterval(window.intervalChat);
        window.intervalChat = setInterval(function () {
            load_chat_content(idh, code);
        }, 3000);

    } else {
        startArea.removeClass('d-none');
        activeChat.addClass('d-none');
    }
    $('#chat_code').val(code);
    $('#id_enemy').val('');
    load_chat_content(idh, code);
}

// end ham bat chat co san trong chat box

// Ham load tin nhan chat
function load_chat_content(idh, code) {
    if (idh > 0)
        var chatgroup = 0;
    else
        var chatgroup = 1;
    var str_data_chat = load_data(baseApi + '/chatbox/list_content_chat_point?userid=' + userLocal.nhan_vien + '&idenemy=' + idh + '&code=' + code + '&chatgroup=' + chatgroup);
    var Objdata_chat = str_data_chat.responseJSON.data;
    var html = '';
    jQuery.map(Objdata_chat, function (n, i) {
        if (n.user_id == userLocal.nhan_vien) {
            var class_active = '';
        } else {
            var class_active = 'chat-left';
        }
        html += '<div class="chat ' + class_active + '">';
        html += '<div class="chat-avatar">';
        html += '<span class="avatar box-shadow-1 cursor-pointer">';
        html += '<img src="' + n.hinh_anh + '" lt="avatar" height="36" width="36" onerror="this.onerror=null; this.src=baseHome+\'/styles/default-avatar.jpg\'"/>';
        html += '</span>';
        html += '</div>';
        html += '<div class="chat-body">';
        html += '<div class="chat-content">';
        html += '<p>' + n.msg + '</p>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
    });
    $('#chat_content').html(html);
    $('.user-chats').scrollTop($('.user-chats > .chats').height());
}

// end load tin nhan chat

// ham load danh sach nhan vien
function render_list_chat() {
    //Chatbox
    var str_data_list_chat = load_data(baseApi + '/chatbox/list_chatbox?userid=' + userLocal.nhan_vien);
    var Objdata_chatbox = str_data_list_chat.responseJSON.data;
    var html1 = '', chatcode = $('#chat_code').val();
    let chatboxuser = [];
    jQuery.map(Objdata_chatbox, function (n, i) {
        if (chatboxuser.includes(n.nguoi_tao) == false)
            chatboxuser[chatboxuser.length] = n.nguoi_tao;
        if (n.chat_group == 0)
            chatboxuser[chatboxuser.length] = n.nhan_vien;
        let classActiveCode = '';
        if (userChat > 0 && userChat == n.code)
            classActiveCode = 'active';
        var avatar_chatbox = '';
        const d = new Date(n.create_at);
        if (n.chat_group == 0) {
            if (n.hinh_anh != '') {
                avatar_chatbox = n.hinh_anh;
            }
        }
        html1 += '<li class="item_chated_list_' + n.code + ' ' + classActiveCode + '" onclick="enable_chated(0, ' + n.code + ', \'' + n.group_name + '\',\'' + avatar_chatbox + '\')">';
        html1 += '<span class="avatar">';
        html1 += '<img src="' + avatar_chatbox + '" height="42" width="42" alt="Generic placeholder image" onerror="this.onerror=null; this.src=baseHome+\'/styles/default-avatar.jpg\'"/>';
        if (n.chat_group == 0) {
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
        if (n.chuadoc != 0 && n.chuadoc != null) {
            html1 += '<span class="badge badge-danger badge-pill float-right">' + n.chuadoc + '</span>';
        }
        html1 += '</div>';
        html1 += '</li>';
    });
    $('#list_chatbox').html(html1);
    //contact
    var str_data = load_data(baseApi + '/chatbox/list_contact?userid=' + userLocal.nhan_vien + '&listnv=' + chatboxuser);
    var Objdata = str_data.responseJSON.data;
    var html = '';
    jQuery.map(Objdata, function (n, i) {
        let classActive = '';
        if (userChat > 0 && userChat == n.id)
            classActive = 'active';
        var avatar_nv = '';
        if (n.hinh_anh != '') {
            avatar_nv = n.hinh_anh;
        }
        html += '<li class="item_chat_list_' + n.id + ' ' + classActive + '" onclick="enable_chat(' + n.id + ', 0,\'' + n.name + '\',\'' + avatar_nv + '\')">';
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
    $('.modal').modal('show');
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
            url: baseApi + '/chatbox/add_group?userid=' + userLocal.nhan_vien,  //server script to process data
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