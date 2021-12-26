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

    $.ajax({ // Count unread email
        type: "GET",
        dataType: "text",
        async: false,
        url: baseHome + "/inbox/unread",
        success: function (data) {
            $(".message-item-count").html(data);
        },
    });

    $.ajax({ // nhân viên vào select2 cho email to và CC, BCC
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/inbox/nhanvien",
        success: function (data) {
            var html = '<option data-avatar="' + baseHome + '/layouts/allavatar.png" value="0">Tất cả</option>';
            data.forEach(function (item, index) {
                html += '<option data-avatar="' + item["avata"] + '" value="' + item["id"] + '">' + item["name"] + "</option>";
            });
            $("#email-to").html(html);
            $("#emailCC").html(html);
            $("#emailBCC").html(html);
        },
    });

    list('inbox');

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


    $("#file-input").change(function(e){
         var html = $('#listfile').html();
         var files = e.target.files;
         for(var i=0;i<files.length;i++){
            html += '<li>'+files[i].name+'<li>';
         }
         $('#listfile').html(html);
    });
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
            avatarImg = "<img src='" + $(option.element).data("avatar") + "' alt='avatar' />";
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
            $('#listfile').html('')
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
    if (emailUserList.find("li").length) {
        emailUserList.find("li").on("click", function (e) {
            $.ajax({
                type: "GET",
                dataType: "json",
                async: false,
                data: { id: this.id },
                url: baseHome + "/inbox/get_detail",
                success: function (data) {
                    $("#nguoigui").text(data.senderName);
                    $("#avatar").attr("src", data.avatar);
                    $("#noidung").text(data.date);
                    $("#noidung").html(data.content);
                    $("#myid").attr('value',data.id);
                },
            });
            emailDetails.toggleClass("show");
        });
    }

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
    $(document).on("click", ".email-app-list .selectAll input", function () {
        if ($(this).is(":checked")) {
            userActions.find(".custom-checkbox input").prop("checked", this.checked).closest(".media").addClass("selected-row-bg");
        } else {
            userActions.find(".custom-checkbox input").prop("checked", "").closest(".media").removeClass("selected-row-bg");
        }
    });

    // Delete selected Mail from list
    if (mailDelete.length) {
        mailDelete.on("click", function () {
            if (userActions.find(".custom-checkbox input:checked").length) {
                var checkboxes = $('.checkboxes:checkbox:checked');
                var ids = '';
                for (var checkbox of checkboxes) {
                    if (ids=='')
                        ids = checkbox.value;
                    else
                        ids = ids+','+checkbox.value;
                }
                $.ajax({
                    url: baseHome + "/inbox/xoa",
                    type: "post",
                    dataType: "json",
                    data: { ids: ids },
                    success: function (data) {
                        if (data.success) {
                            notyfi_success(data.msg);
                            // userActions.find(".custom-checkbox input:checked").closest(".media").remove();
                            // emailAppList.find(".selectAll input").prop("checked", false);
                            // // toastr["error"]("You have removed email.", "Mail Deleted!", {
                            // //     closeButton: true,
                            // //     tapToDismiss: false,
                            // //     rtl: isRtl,
                            // // });
                            // userActions.find(".custom-checkbox input").prop("checked", "");
                            var boz = $('#boz').val();
                            list(boz);
                        } else
                            notify_error(data.msg);
                    },
                });
            } else {
                notyfi_success("Bạn chưa tick checkbox nào");
            }
        });
    }

    // Mark mail unread
    if (mailUnread.length) {
        // mailUnread.on("click", function () {
        //     userActions.find(".custom-checkbox input:checked").closest(".media").removeClass("mail-read");
        // });
        mailUnread.on("click", function () {
            if (userActions.find(".custom-checkbox input:checked").length) {
                var checkboxes = $('.checkboxes:checkbox:checked');
                var ids = '';
                for (var checkbox of checkboxes) {
                    if (ids=='')
                        ids = checkbox.value;
                    else
                        ids = ids+','+checkbox.value;
                }
                $.ajax({
                    url: baseHome + "/inbox/markunread",
                    type: "post",
                    dataType: "json",
                    data: { ids: ids },
                    success: function (data) {
                        if (data.success) {
                            notyfi_success(data.msg);
                            // userActions.find(".custom-checkbox input:checked").closest(".media").remove();
                            // emailAppList.find(".selectAll input").prop("checked", false);
                            // userActions.find(".custom-checkbox input").prop("checked", "");
                            var boz = $('#boz').val();
                            list(boz);
                        } else
                            notify_error(data.msg);
                    },
                });
            } else {
                notyfi_success("Bạn chưa tick checkbox nào");
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
            placeholder: "Message",
            theme: "snow",
        });
    }

    // On navbar search and bookmark Icon click, hide compose mail
    $(".nav-link-search, .bookmark-star").on("click", function () {
        composeModal.modal("hide");
    });

    $('#form-send').on("submit", function(e) {
        var formData = new FormData(this);
        var receiverName = JSON.stringify($("#email-to").val())
        formData.append('receiverName', receiverName);
        formData.append('tieude', $("#emailSubject").val());
        var quill_editor = $(".compose-form .ql-editor");
        formData.append('subContent', quill_editor[0].innerHTML);
        $.ajax({
            method: "POST",
            url: baseHome + "/inbox/send",
            data: formData,
            mimeType: "multipart/form-data",
            cache: false, // do not cache this request
            contentType: false, // prevent missing boundary string
            processData: false, // do not transform to query string
            dataType: "json",
        }).done(function(response) {
            if (response.success) {
                notyfi_success(response.msg);
                var receiver = response.receiver;
                var data = {'type':'inbox','receiverid':receiver.toString()};
                connection.send(JSON.stringify(data));
                $('#compose-mail').modal('hide');
            }
            else notify_error(response.msg);
        });
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

function list(type) {
    $.ajax({ // tải dữ liệu chính
        type: "GET",
        dataType: "json",
        async: false,
        data: {type:type},
        url: baseHome + "/inbox/getdata",
        success: function (data) {
            var html = "";
            data.forEach(function (element, index) {
                html += '<li class="media" id="' + element.id + '"><div class="media-left pr-50"><div class="avatar">';
                html += '<img src="' + element.avatar + '" alt="avatar img holder" /></div>';
                html += '<div class="user-action"><div class="custom-control custom-checkbox">';
                html += '<input type="checkbox" class="custom-control-input checkboxes" id="x' + element.id + '" value="'+element.id+'" />';
                html += '<label class="custom-control-label" for="x' + element.id + '"></label></div>';
                html += '<span class="email-favorite"><i data-feather="star"></i></span></div></div>';
                html += '<div class="media-body"><div class="mail-details"><div class="mail-items">';
                html += '<h5 class="mb-25">' + element.senderName + '</h5><span class="text-truncate">🎯 ' + element.title + " </span>";
                html += '</div><div class="mail-meta-item">';
                if (element.status == 1)
                    html += '<span class="mr-50 bullet bullet-success bullet-sm"></span>';
                if (element.status == 2)
                    html += '<span class="mr-50 bullet bullet-danger bullet-sm"></span>';
                html += '<span class="mail-date">' + element.dateTime + "</span></div></div>";
                html += '<div class="mail-message"><p class="text-truncate mb-0">' + element.subContent + "</p></div></div></li>";
                // $("#email-list").append(html);
            });
            $("#email-list").html(html);
        },
    });
    $('#boz').val(type);
}

// function send() {
//     var quill_editor = $(".compose-form .ql-editor");
//     var receiverName = $("#email-to").val();
//     // var data = new FormData($('#form-send'));
//     // var info = {};
//     // info.title = $("#emailSubject").val();
//     // info.noi_dung = quill_editor[0].innerHTML;
//     // info.status = 1;
//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         // data: { data: data, receiverName: receiverName},
//         data: new FormData($('#form-send')),
//         mimeType: "multipart/form-data",
//         contentType: false,
//         cache:false,
//         processData:false,
//         url: baseHome + "/inbox/send",
//         success: function (xdata) {
//             if (xdata.success) {
//                 notyfi_success(xdata.msg);
//                 // var receiver = data.receiver;
//                 // var data = {'type':'inbox','receiverid':receiver.toString()};
//                 // connection.send(JSON.stringify(data));
//             }
//             else notify_error(xdata.msg);
//         },
//         error: function () {
//             notify_error("Server error");
//         },
//     });
// }

function xoa() {
    document.getElementById("myCheck").click();
    var id = $('#myid').attr('value');
    $.ajax({
        url: baseHome + "/inbox/xoa",
        type: "post",
        dataType: "json",
        data: { ids: id },
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $("#"+id).remove();
            } else
                notify_error(data.msg);
        },
    });
}
