/*=========================================================================================
    File Name: app-chat.js
    Description: Chat app js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

'use strict';
$(function() {
    var newTaskForm = $("#form-modal-todo"),
        chatUsersListWrapper = $('.chat-application .chat-user-list-wrapper'),
        overlay = $('.body-content-overlay'),
        // profileSidebar = $('.chat-application .chat-profile-sidebar'),
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
        // closeIcon = $('.chat-application .close-icon'),
        // sidebarCloseIcon = $('.chat-application .sidebar-close-icon'),
        menuToggle = $('.chat-application .menu-toggle'),
        speechToText = $('.speech-to-text'),
        chatSearch = $('.chat-application #chat-search'),
        taskDesc = $("#task-desc"),
        flatPickr = $(".task-due-date");

    if (flatPickr.length) {
        flatPickr.flatpickr({
            dateFormat: "Y-m-d",
            defaultDate: "today",
            onReady: function(selectedDates, dateStr, instance) {
                if (instance.isMobile) {
                    $(instance.mobileInput).attr("step", null);
                }
            },
        });
    }

    if (taskDesc.length) {
        var todoDescEditor = new Quill("#task-desc", {
            bounds: "#task-desc",
            modules: {
                formula: true,
                syntax: true,
                toolbar: ".desc-toolbar",
            },
            placeholder: "Write Your Description",
            theme: "snow",
        });
    }

    // add takecare history
    if (newTaskForm.length) {
        newTaskForm.validate({
            ignore: ".ql-container *", // ? ignoring quill editor icon click, that was creating console error
            rules: {
                // todoTitleAdd: {
                //     required: true,
                // },
            },
        });

        newTaskForm.on("submit", function(e) {
            e.preventDefault();
            var isValid = newTaskForm.valid();
            if (isValid) {
                var comment = taskDesc.find(".ql-editor p").html();
                var id = $("#id").val();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: { id: id, comment: comment },
                    url: baseHome + "/lead_temp/insertTakeCareHistory",
                    success: function(data) {
                        if (data.success == true) {
                            notyfi_success(data.msg);
                            $('#new-takecare-modal').modal('hide');
                            // $("#history").load(window.location.href + "?id=" + id + " #history");
                            var html = '';
                            data.list.forEach(function(value, index) {
                                html += '<div class="row">';
                                html += '<div class="col-lg-3">';
                                html += '<p>' + value.dateTime + '</p>';
                                html += '</div>';
                                html += '<div class="col-lg-3">';
                                html += '<p>' + value.staffName + '</p>';
                                html += '</div>';
                                html += '<div class="col-lg-6">';
                                html += '<p>' + value.content + '</p>';
                                html += '</div>';
                                html += '</div>';
                            });
                            $('#history').html(html);
                        } else {
                            notify_error(data.msg);
                            return false;
                        }
                    },
                });
                // $(newTaskModal).modal("hide");
                overlay.removeClass("show");
            }
        });
    }

    // init ps if it is not touch device
    if (!$.app.menu.is_touch_device()) {
        // Chat user list
        if (chatUsersListWrapper.length > 0) {
            var chatUserList = new PerfectScrollbar(chatUsersListWrapper[0], {
                suppressScrollX: true
            });
        }

        // // Admin profile left
        // if (userProfileSidebar.find('.user-profile-sidebar-area').length > 0) {
        //   var userScrollArea = new PerfectScrollbar(userProfileSidebar.find('.user-profile-sidebar-area')[0]);
        // }

        // Chat area
        // if (userChats.length > 0) {
        //     var chatsUser = new PerfectScrollbar(userChats[0], {
        //         wheelPropagation: false
        //     });
        // }

        //   // User profile right area
        //   if (profileSidebarArea.length > 0) {
        //     var user_profile = new PerfectScrollbar(profileSidebarArea[0]);
        //   }
        // } else {
        //   chatUsersListWrapper.css('overflow', 'scroll');
        //   userProfileSidebar.find('.user-profile-sidebar-area').css('overflow', 'scroll');
        //   userChats.css('overflow', 'scroll');
        //   profileSidebarArea.css('overflow', 'scroll');

        // on user click sidebar close in touch devices
        $(chatsUserList)
            .find('li')
            .on('click', function() {
                $(sidebarContent).removeClass('show');
                $(overlay).removeClass('show');
            });
    }

    // // Chat Profile sidebar & overlay toggle
    // if (profileToggle.length) {
    //   profileToggle.on('click', function () {
    //     profileSidebar.addClass('show');
    //     overlay.addClass('show');
    //   });
    // }

    // // Update status by clicking on Radio
    // if (statusRadio.length) {
    //   statusRadio.on('change', function () {
    //     var $className = 'avatar-status-' + this.value,
    //       profileHeaderAvatar = $('.header-profile-sidebar .avatar span');
    //     profileHeaderAvatar.removeClass();
    //     profileToggle.find('.avatar span').removeClass();
    //     profileHeaderAvatar.addClass($className + ' avatar-status-lg');
    //     profileToggle.find('.avatar span').addClass($className);
    //   });
    // }

    // // On Profile close click
    // if (closeIcon.length) {
    //   closeIcon.on('click', function () {
    //     profileSidebar.removeClass('show');
    //     userProfileSidebar.removeClass('show');
    //     if (!sidebarContent.hasClass('show')) {
    //       overlay.removeClass('show');
    //     }
    //   });
    // }

    // // On sidebar close click
    // if (sidebarCloseIcon.length) {
    //   sidebarCloseIcon.on('click', function () {
    //     sidebarContent.removeClass('show');
    //     overlay.removeClass('show');
    //   });
    // }

    // User Profile sidebar toggle
    // if (userProfileToggle.length) {
    //   userProfileToggle.on('click', function () {
    //     userProfileSidebar.addClass('show');
    //     overlay.addClass('show');
    //   });
    // }

    // // On overlay click
    // if (overlay.length) {
    //   overlay.on('click', function () {
    //     sidebarContent.removeClass('show');
    //     overlay.removeClass('show');
    //     profileSidebar.removeClass('show');
    //     userProfileSidebar.removeClass('show');
    //   });
    // }

    // Add class active on click of Chat users list
    if (chatUsersListWrapper.find('ul li').length) {
        chatUsersListWrapper.find('ul li').on('click', function() {
            var $this = $(this),
                startArea = $('.start-chat-area'),
                activeChat = $('.active-chat');

            if (chatUsersListWrapper.find('ul li').hasClass('active')) {
                chatUsersListWrapper.find('ul li').removeClass('active');
            }

            $this.addClass('active');
            $this.find('.badge').remove();

            if (chatUsersListWrapper.find('ul li').hasClass('active')) {
                startArea.addClass('d-none');
                activeChat.removeClass('d-none');
            } else {
                startArea.removeClass('d-none');
                activeChat.addClass('d-none');
            }
        });
    }

    // // auto scroll to bottom of Chat area
    // chatsUserList.find('li').on('click', function () {
    //   userChats.animate({ scrollTop: userChats[0].scrollHeight }, 400);
    // });

    // // Main menu toggle should hide app menu
    // if (menuToggle.length) {
    //   menuToggle.on('click', function (e) {
    //     sidebarContent.removeClass('show');
    //     overlay.removeClass('show');
    //     profileSidebar.removeClass('show');
    //     userProfileSidebar.removeClass('show');
    //   });
    // }

    // // Chat sidebar toggle
    // if ($(window).width() < 991) {
    //   onClickFn();
    // }

    // Filter
    // if (chatSearch.length) {
    //   chatSearch.on('keyup', function () {
    //     var value = $(this).val().toLowerCase();
    //     if (value !== '') {
    //       // filter chat list
    //       chatList.find('li:not(.no-results)').filter(function () {
    //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    //       });
    //       // filter contact list
    //       contactList.find('li:not(.no-results)').filter(function () {
    //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    //       });
    //       var chat_tbl_row = chatList.find('li:not(.no-results):visible').length,
    //         contact_tbl_row = contactList.find('li:not(.no-results):visible').length;

    //       // check if chat row available
    //       if (chat_tbl_row == 0) {
    //         chatList.find('.no-results').addClass('show');
    //       } else {
    //         if (chatList.find('.no-results').hasClass('show')) {
    //           chatList.find('.no-results').removeClass('show');
    //         }
    //       }

    // // check if contact row available
    // if (contact_tbl_row == 0) {
    //   contactList.find('.no-results').addClass('show');
    // } else {
    //   if (contactList.find('.no-results').hasClass('show')) {
    //     contactList.find('.no-results').removeClass('show');
    //   }
    // }
    //     } else {
    //       // If filter box is empty
    //       chatsUserList.find('li').show();
    //       if (chatUsersListWrapper.find('.no-results').hasClass('show')) {
    //         chatUsersListWrapper.find('.no-results').removeClass('show');
    //       }
    //     }
    //   });
    // }

    // if (speechToText.length) {
    //   // Speech To Text
    //   var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
    //   if (SpeechRecognition !== undefined && SpeechRecognition !== null) {
    //     var recognition = new SpeechRecognition(),
    //       listening = false;
    //     speechToText.on('click', function () {
    //       var $this = $(this);
    //       recognition.onspeechstart = function () {
    //         listening = true;
    //       };
    //       if (listening === false) {
    //         recognition.start();
    //       }
    //       recognition.onerror = function (event) {
    //         listening = false;
    //       };
    //       recognition.onresult = function (event) {
    //         $this.closest('.form-send-message').find('.message').val(event.results[0][0].transcript);
    //       };
    //       recognition.onspeechend = function (event) {
    //         listening = false;
    //         recognition.stop();
    //       };
    //     });
    //   }
    // }
});

// // Window Resize
// $(window).on('resize', function () {
//   if ($(window).width() > 992) {
//     if ($('.chat-application .body-content-overlay').hasClass('show')) {
//       $('.app-content .sidebar-left').removeClass('show');
//       $('.chat-application .body-content-overlay').removeClass('show');
//     }
//   }

//   // Chat sidebar toggle
//   if ($(window).width() < 991) {
//     onClickFn();
//     if (
//       !$('.chat-application .chat-profile-sidebar').hasClass('show') ||
//       !$('.chat-application .sidebar-content').hasClass('show')
//     ) {
//       $('.sidebar-content').removeClass('show');
//       $('.body-content-overlay').removeClass('show');
//     }
//   }
// });

$(document).on('click', '.sidebar-toggle', function() {
    if ($(window).width() < 992) {
        onClickFn();
    }
});

// $('#list-lead').on('click', '.sidebar-list', function(e) {
//     $(this).addClass('list-active');
// });

$('#list-lead').on('click', '.sidebar-list', function() {
    $('#list-lead .sidebar-list.list-active').removeClass('list-active');
    $(this).addClass('list-active');
    let leadId = $(this).data("id");
    $('#id').val(leadId);
    let customerId = $(this).data("customer");
    $.ajax({
        url: baseHome + "/lead_temp/getCustomerById",
        type: 'post',
        dataType: "json",
        data: { id: customerId },
        success: function(data) {
            $('#fullName').html(data.fullName);
            $('#taxCode').html(data.taxCode);
            $('#address').html(data.address);
            if (data.type == 1)
                $('#type').html("Cá nhân");
            else if (data.type == 2)
                $('#type').html("Doanh nghiệp");
            else $('#type').html("...");
            $('#representative').html(data.representative);
            $('#phoneNumber').html(data.phoneNumber);
            $('#email').html(data.email);
            $('#dateTime').html(data.dateTime);
        },
    });
    let status = $(this).data("status");
    let html = status;
    if (status == 1) {
        html = '<button class="btn-statement-orange">Đang chăm sóc\
                </button>';
    }
    if (status == 2) {
        html = '<button class="btn-statement-blue">Đã gửi báo giá\
                </button>';
    };
    if (status == 3) {
        html = '<button class="btn-statement-green">Đã chốt đơn\
                </button>';
    };
    if (status == 4) {
        html = '<button class="btn-statement-red">Hủy\
                </button>';
    };
    $('#status').html(html);
    $('#leadName').html($(this).data("leadname"));
    $('#leadDes').html($(this).data("leaddes"));

    $.ajax({
        url: baseHome + "/lead_temp/getTakeCareHistory",
        type: 'post',
        dataType: "json",
        data: { id: leadId },
        success: function(data) {
            var html = '';
            data.forEach(function(value, index) {
                html += '<div class="row">';
                html += '<div class="col-lg-3">';
                html += '<p>' + value.dateTime + '</p>';
                html += '</div>';
                html += '<div class="col-lg-3">';
                html += '<p>' + value.staffName + '</p>';
                html += '</div>';
                html += '<div class="col-lg-6">';
                html += '<p>' + value.content + '</p>';
                html += '</div>';
                html += '</div>';
            });
            $('#history').html(html);
        },
    });
});

function showModalTakeCare() {
    $('#new-takecare-modal').modal('show');
}

function onClickFn() {
    var sidebarContent = $('.sidebar-content'),
        sidebarToggle = $('.sidebar-toggle'),
        overlay = $('.body-content-overlay');
    if (sidebarToggle.length) {
        sidebarContent.addClass('show');
        overlay.addClass('show');
    }
}

// // Add message to chat - function call on form submit
// function enterChat(source) {
//   var message = $('.message').val();
//   if (/\S/.test(message)) {
//     var html = '<div class="chat-content">' + '<p>' + message + '</p>' + '</div>';
//     $('.chat:last-child .chat-body').append(html);
//     $('.message').val('');
//     $('.user-chats').scrollTop($('.user-chats > .chats').height());
//   }
// }