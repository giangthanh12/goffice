/*=========================================================================================
    File Name: app-chat.js
    Description: Chat app js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

'use strict';
$(function () {
    $('#leadCustomer').select2({
        placeholder: 'Chọn khách hàng',
        dropdownParent: $('#leadCustomer').parent(),
    });
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
        leadDesc = $("#leadDesc"),
        leadDescUpdate = $("#leadDescUpdate"),
        flatPickr = $(".task-due-date");

    $('#fmLead').each(function () {
        var $this = $(this);
        $this.validate({
            rules: {
                leadName: {
                    required: true
                },
                leadCustomer: {
                    required: true,
                },
            },
            messages: {
                leadName: {
                    required: "Bạn chưa nhập tên cơ hội!"
                },
                leadCustomer: {
                    required: "Bạn chưa chọn khách hàng!"
                },
            }
        });
    });

    if (flatPickr.length) {
        flatPickr.flatpickr({
            dateFormat: "d-m-Y",
            // defaultDate: "today",
            onReady: function (selectedDates, dateStr, instance) {
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
            placeholder: "Nội dung chăm sóc",
            theme: "snow",
        });
    }

    if (leadDescUpdate.length) {
        var todoDescEditor = new Quill("#leadDescUpdate", {
            bounds: "#leadDescUpdate",
            modules: {
                formula: true,
                syntax: true,
                toolbar: ".desc-toolbar-3",
            },
            placeholder: "Mô tả",
            theme: "snow",
            value: "",
        });
    }

    if (leadDesc.length) {
        var todoDescEditor = new Quill("#leadDesc", {
            bounds: "#leadDesc",
            modules: {
                formula: true,
                syntax: true,
                toolbar: ".desc-toolbar-2",
            },
            placeholder: "Mô tả",
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

        newTaskForm.on("submit", function (e) {
            e.preventDefault();
            var isValid = newTaskForm.valid();
            if (isValid) {
                var comment = taskDesc.find(".ql-editor p").html();
                if (comment == '<br>') {
                    notify_error('Vui lòng nhập nội dung chăm sóc!');
                    return false;
                }

                var id = $("#id").val();
                var record = $("#linkRecord").val();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: { id: id, comment: comment ,record: record},
                    url: baseHome + "/lead_temp/insertTakeCareHistory",
                    success: function (data) {
                        if (data.success == true) {
                            notyfi_success(data.msg);
                            $('#new-takecare-modal').modal('hide');
                            var html = '';
                            data.list.forEach(function (value, index) {
                                html += '<div class="row">';
                                html += '<div class="col-lg-3">';
                                html += '<p>' + value.ngay_gio + '</p>';
                                html += '</div>';
                                html += '<div class="col-lg-3">';
                                html += '<p>' + value.staffName + '</p>';
                                html += '</div>';
                                html += '<div class="col-lg-3">';
                                html += '<p>' + value.content + '</p>';
                                html += '</div>';
                                html += '<div class="col-lg-3">';
                                html += '<p><textarea style="background:#E6E6E6;border:1px">' + value.linkToRecord + '</textarea></p>';
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
            .on('click', function () {
                $(sidebarContent).removeClass('show');
                $(overlay).removeClass('show');
            });
    }
    leadSearch()

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
    // if (chatUsersListWrapper.find('ul li').length) {
    //     chatUsersListWrapper.find('ul li').on('click', function() {
    //         var $this = $(this),
    //             startArea = $('.start-chat-area'),
    //             activeChat = $('.active-chat');

    //         if (chatUsersListWrapper.find('ul li').hasClass('active')) {
    //             chatUsersListWrapper.find('ul li').removeClass('active');
    //         }

    //         $this.addClass('active');
    //         $this.find('.badge').remove();

    //         if (chatUsersListWrapper.find('ul li').hasClass('active')) {
    //             startArea.addClass('d-none');
    //             activeChat.removeClass('d-none');
    //         } else {
    //             startArea.removeClass('d-none');
    //             activeChat.addClass('d-none');
    //         }
    //     });
    // }
    // add lead


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

$(document).on('blur', '#customerPhone', function () {
    var customerPhone = $(this).val();

    if (customerPhone != '' && customerPhone.toString().length >= 10) {
        $.ajax({
            type: "POST",
            dataType: "json",
            data: { customerPhone: customerPhone },
            url: baseHome + "/lead_temp/checkPhone",
            success: function (data) {
                if (data.success) {
                    // notyfi_success(data.msg);
                    $('#btn-add-lead').prop('disabled', false);
                } else {
                    $('#btn-add-lead').prop('disabled', true);
                    notify_error(data.msg);
                }
            }
        });
    } else {
        1
        $('#btn-add-lead').prop('disabled', true);
        notify_error('Số điện thoại không hợp lệ');
    }
})

function saveLead() {
    var isValid = $('#fmLead').valid();
    if (isValid) {
        // $('#fmLead').validate({
        //     submitHandler: function (form) {
        var formData = new FormData($('#fmLead')[[0]]);
        var comment = $('#leadDesc').find(".ql-editor p").html();
        if (comment == '<br>') {
            notify_error('Vui lòng nhập mô tả!');
            return false;
        }
        formData.append('leadDesc', comment)
        $.ajax({
            url: baseHome + "/lead_temp/insertLead",
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
                    leadSearch();
                    $('#new-lead-modal').modal('hide');
                } else
                    notify_error(data.message);
            }
        });
        return false;
    }
    // });
    // $('#fmLead').submit();
}

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

$(document).on('click', '.sidebar-toggle', function () {
    if ($(window).width() < 992) {
        onClickFn();
    }
});

// $('#list-lead').on('click', '.sidebar-list', function(e) {
//     $(this).addClass('list-active');
// });

var leftId = '';
// document.getElementById("list-lead").click();
jQuery('#list-lead').click();
$('#list-lead').on('click', '.sidebar-list', function () {
    let leadId = $(this).data("id");
    $('#list-lead .sidebar-list.list-active').removeClass('list-active');
    $(this).addClass('list-active');
    $('#id').val(leadId);
    let customerId = $(this).data("customer");
    if (leftId === customerId) return false;
    leftId = customerId;
    $.ajax({
        url: baseHome + "/lead_temp/getCustomerById",
        type: 'post',
        dataType: "json",
        data: { id: customerId },
        success: function (data) {
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
            // $('#dateTime').html(data.dateTime);
            $('#staffName').html(data.staffId);
            if (data.status == 1)
                $('#status').html('<button class="btn-statement-orange">Khách hàng mới</button>');
            else if (data.status == 2)
                $('#status').html('<button class="btn-statement-blue">Khách hàng tiềm năng</button>');
            else if (data.status == 3)
                $('#status').html('<button class="btn-statement-green">Khách hàng đang dùng dịch vụ</button>');
            else if (data.status == 4)
                $('#status').html('<button class="btn-statement-red">Khách hàng đã dùng dịch vụ</button>');
            else
                $('#status').html('<button class="btn-statement-yellow">Chưa rõ</button>');
        },
    });
    // let status = $(this).data("status");
    $('#leadName').html($(this).data("leadname"));
    $('#leadDes').html($(this).data("leaddes"));
    $.ajax({
        url: baseHome + "/lead_temp/getTakeCareHistory",
        type: 'post',
        dataType: "json",
        data: { id: leadId },
        success: function (data) {
            var html = '';
            data.forEach(function (value, index) {
                html += '<div class="row">';
                html += '<div class="col-lg-3">';
                html += '<p>' + value.ngay_gio + '</p>';
                html += '</div>';
                html += '<div class="col-lg-3">';
                html += '<p>' + value.staffName + '</p>';
                html += '</div>';
                html += '<div class="col-lg-3">';
                html += '<p>' + value.content + '</p>';
                html += '</div>';
                html += '<div class="col-lg-3">';
                html += '<p><textarea style="background:#E6E6E6;border:1px">' + value.linkToRecord + '</textarea></p>';
                html += '</div>';
                html += '</div>';
            });

            $('#history').html(html);

        },
    });
});

function showModalTakeCare() {
    if ($('.list-active').length > 0) {
        $('#name').val('');
        var quill_editor = $("#task-desc .ql-editor");
        quill_editor[0].innerHTML = '';
        $('#new-takecare-modal').modal('show');
    } else {
        notify_error('Chưa có cơ hội nào được chọn!');
    }
}

function showModalLead() {
    $('#leadName').val('');
    $('#leadCustomer').val('').change();
    var quill_editor = $("#leadDesc .ql-editor");
    quill_editor[0].innerHTML = '';
    $('#new-lead-modal').modal('show');
}



// function leadQuote() {
//     $('#add-quote').modal('show');
// }

function loadData(id) {
    $('#updateLead').modal('show');
    $("#modal-title2").html('Cập nhật thông tin cơ hội');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/lead_temp/loadData",
        success: function (data) {
            $('#leadIdUpdate').val(data.id);
            $('#leadNameUpdate').val(data.name);
            var leadDesc = data.description;
            var quill_editor = $("#leadDescUpdate .ql-editor");
            quill_editor[0].innerHTML = leadDesc;
            $('#leadCustomerUpdate').val(data.customerId).change();
            $('#opportunityUpdate').val(data.opportunity).change();
            $('#statusUpdate').val(data.status).change();
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function leadQuote() {
    if (leftId === '') return false;
    $('#add-quote').modal('show');
    $.ajax({
        url: baseHome + "/lead_temp/getCustomerById",
        type: 'post',
        dataType: "json",
        data: { id: leftId },
        success: function (data) {
            let yourDate = new Date()
            const offset = yourDate.getTimezoneOffset()
            yourDate = new Date(yourDate.getTime() - (offset * 60 * 1000))
            $('#staffQuote').val(data.staffName);
            $('#customerQuote').val(data.fullName);
            $('#dateQuote').val(yourDate.toISOString().split('T')[0]);
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}


function load_dichvu() {
    var id = $('#dich_vu').val();
    // var khach_hang = $('#khach_hang_bg').val();
    // var nhan_vien = $('#nhan_vien_bg').val();
    // if (khach_hang > 0 && nhan_vien > 0) {
    //     $(".btn-add").attr("disabled", false);
    // } else {
    //     $(".btn-add").attr("disabled", true);
    // }
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/lead_temp/load_dichvu",
        success: function (data) {
            var stt = $('#stt').val();
            var i = Number(stt) + 1;
            $('#stt').val(i);
            $('#table_sp').append('<tr id="arr' + i + '"><td>' + data.name + '</td><td><input type="text" id="don_gia' + i + '" onkeyup="load_tien(' + i + ')" name="don_gia[]" class="form-control input format_number" value="' + data.don_gia + '"></td><td><input type="hidden" name="id_sp[]" id="id_sp[' + i + ']" value="' + data.id + '"></input><input type="hidden" name="loai[]" id="loai[' + i + ']" value="0"></input><input type="text" onkeyup="load_tien(' + i + ')" name="so_luong[]" id="so_luong' + i + '" value="1" class="form-control input" ></td><td><input type="text" id="chiet_khau' + i + '" onkeyup="load_tien(' + i + ')" name="chiet_khau_tm[]" class="form-control input format_number" value="0"></td><td><select name="thue[]" id="thue' + i + '" class="thue' + i + ' form-control" onchange="load_tien(' + i + ')"><option value="0">Không</option><option value="5">5%</option><option value="10">10%</option></select></td><td><input type="text" id="tien_thue' + i + '" name="tien_thue[]" onkeyup="load_tien(' + i + ')" value="' + data.thue_vat + '" class="form-control input format_number"></td><td><input type="date" id="ngay_s" name="ngay_s[]" class="form-control" placeholder="Ngày bắt đầu" ><input type="date" id="ngay_e" name="ngay_e[]" class="form-control" style="margin-top:4px" placeholder="Ngày kết thúc"> </td><td><input type="text" id="thanh_tien' + i + '" name="thanh_tien[]" class="form-control input  format_number" readonly></td><td><a  onclick="remove_tr(' + i + ');return false"><i class="fas fa-trash-alt"></i></a></td></tr>');

            $('#dich_vu').val(0);
            $('#dich_vu').trigger("change");
            // $('#san_pham').val(0);
            // $('#san_pham').trigger("change");
            $("#thue" + i).val(data.tax).trigger('change');
        },
        error: function () { }
    });

}

function updateLead() {

    $('#fmEdit').validate({
        submitHandler: function (form) {

            var formData = new FormData(form);
            var comment = $('#leadDescUpdate').find(".ql-editor p").html();
            if (comment == '<br>') {
                notify_error('Vui lòng nhập mô tả!');
                return false;
            }
            formData.append('leadDescUpdate', comment)
            $.ajax({
                url: baseHome + "/lead_temp/updateLead",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.msg);
                        leadSearch();
                        $('#updateLead').modal('hide');
                    } else
                        notify_error(data.msg);
                }
            });
            return false;
        }
    });
    $('#fmEdit').submit();
}

function deleteLead(id) {
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
            $.ajax({
                url: baseHome + "/lead_temp/deleteLead",
                type: 'post',
                dataType: "json",
                data: { id: id },
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.msg);
                        leadSearch();
                    } else
                        notify_error(data.msg);
                },
            });
        }
    });
}

function leadSearch() {
    var info = {};
    info.fromDate = $('#fromDate').val();
    info.toDate = $('#toDate').val();
    $.ajax({
        url: baseHome + "/lead_temp/leadSearch",
        type: 'post',
        dataType: "json",
        data: info,
        success: function (data) {
            var html = '';
            data.forEach(function (value, index) {
                html += '<li data-id="' + value.id + '" data-dateTime ="' + value.dateTime + '" data-customer="' + value.customerId + '" data-status="' + value.status + '" data-leadname="' + value.name + '" data-leaddes="' + value.description + '" class="sidebar-list">';
                html += '<div class="chat-info flex-grow-1">';
                html += '<div class="customer-name">';
                html += '<label>' + value.name + '</label>';
                html += '</div>';
                html += '<div class="customer-info">';
                html += '<label>' + value.dateTime + '</label>';
                html += '</div>';
                html += '<div class="customer-info">';
                html += '<label>' + value.fullName + '</label>';
                html += '</div>';
                html += '<div class="customer-info">';
                html += '<label>' + value.description + '</label>';
                html += '</div>';
                html += '</div>';
                html += '<div class="chat-meta text-nowrap">';
                if(funEdit==1) {
                    html += '<div class="float-right dropdown">';
                    html += '<i class="bx bx-dots-vertical-rounded bx-md icon-dots"></i>';
                    html += '<div class="dropdown-content">';
                    html += '<span class="updateLead" onclick="loadData(' + value.id + ')">Cập nhật</span>';
                    html += '<span class="deleteLead" onclick="deleteLead(' + value.id + ')">Xóa</span>';
                    html += '</div>';
                    html += '</div>';
                }
                html += '<div class="btn-statement">';
                html += '<br>';
                if (value.status == 1) {
                    html += '<button class="btn-statement-orange">Đang chăm sóc</button>';
                }
                if (value.status == 2) {
                    html += '<button class="btn-statement-yellow">Đã báo giá</button>';
                }
                if (value.status == 3) {
                    html += '<button class="btn-statement-blue">Đã lên đơn hàng</button>';
                }
                if (value.status == 4) {
                    html += '<button class="btn-statement-green">Đã chốt</button>';
                }
                if (value.status == 5) {
                    html += '<button class="btn-statement-red">Hủy</button>';
                }
                html += ' </div>';
                html += '</div>';
                html += '</li>';
            });
            $('#list-lead').html(html);
            // var chatUsersListWrapper = $('.chat-application .chat-user-list-wrapper');
            // if (chatUsersListWrapper.find('ul li').length) {
            //     chatUsersListWrapper.find('ul li').on('click', function() {
            //         var $this = $(this),
            //             startArea = $('.start-chat-area'),
            //             activeChat = $('.active-chat');

            //         if (chatUsersListWrapper.find('ul li').hasClass('active')) {
            //             chatUsersListWrapper.find('ul li').removeClass('active');
            //         }

            //         $this.addClass('active');
            //         $this.find('.badge').remove();

            //         if (chatUsersListWrapper.find('ul li').hasClass('active')) {
            //             startArea.addClass('d-none');
            //             activeChat.removeClass('d-none');
            //         } else {
            //             startArea.removeClass('d-none');
            //             activeChat.addClass('d-none');
            //         }
            //     });
            // }
        },
        error: function () {
            notify_error("Định dạng dữ liệu không đúng");
            return;
        }
    });
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

function changeCustomer() {
    var opt = $("#leadCustomer").val();
    if (opt == -1) {
        $('#new-customer').removeClass('d-none');
    } else {
        $('#new-customer').addClass('d-none');
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

function changeStart() {
    var fromDate = $('#fromDate').val();
    if ($('#toDate').length) {
        $('#toDate').flatpickr({
            dateFormat: "d/m/Y",
            defaultDate: "",
            readonly: true,
            minDate: fromDate
        });
    }
}