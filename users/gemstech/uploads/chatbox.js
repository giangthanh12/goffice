"use strict";
window.userReceiveId = 0;
window.first = 0;
window.last = 0;
window.skipped_once = false;
window.loading = false;
window.IntervalListChat = new Object();
window.IntervalMes = new Object();

function onClickFn() {
    var s = $(".sidebar-content"), e = $(".sidebar-toggle"), a = $(".body-content-overlay");
    e.length && (s.addClass("show"), a.addClass("show"))
}

function CallMessenger() {
    var s = $(".chat-application .chat-user-list-wrapper"), e = $(".body-content-overlay"),
        a = $(".chat-application .chat-profile-sidebar"), o = $(".chat-application .profile-sidebar-area"),
        n = $(".chat-application .sidebar-profile-toggle"), t = $(".chat-application .user-profile-toggle"),
        l = $(".user-profile-sidebar"), i = $(".chat-application .user-status input:radio[name=userStatus]"),
        r = $(".user-chats"), c = $(".chat-users-list"), h = $(".chat-list"), d = $(".contact-list"),
        f = $(".sidebar-content"), v = $(".chat-application .close-icon"),
        u = $(".chat-application .sidebar-close-icon"), w = $(".chat-application .menu-toggle"),
        p = $(".speech-to-text"), C = $(".chat-application #chat-search");
    if ($.app.menu.is_touch_device()) s.css("overflow", "scroll"), l.find(".user-profile-sidebar-area").css("overflow", "scroll"), r.css("overflow", "scroll"), o.css("overflow", "scroll"), $(c).find("li").on("click", (function () {
        $(f).removeClass("show"), $(e).removeClass("show")
    })); else {
        if (s.length > 0) new PerfectScrollbar(s[0]);
        if (l.find(".user-profile-sidebar-area").length > 0) new PerfectScrollbar(l.find(".user-profile-sidebar-area")[0]);
        if (r.length > 0) new PerfectScrollbar(r[0], {wheelPropagation: !1});
        if (o.length > 0) new PerfectScrollbar(o[0])
    }
    if (n.length && n.on("click", (function () {
        a.addClass("show"), e.addClass("show")
    })), i.length && i.on("change", (function () {
        var s = "avatar-status-" + this.value, e = $(".header-profile-sidebar .avatar span");
        e.removeClass(), n.find(".avatar span").removeClass(), e.addClass(s + " avatar-status-lg"), n.find(".avatar span").addClass(s)
    })), v.length && v.on("click", (function () {
        a.removeClass("show"), l.removeClass("show"), f.hasClass("show") || e.removeClass("show")
    })), u.length && u.on("click", (function () {
        f.removeClass("show"), e.removeClass("show")
    })), t.length && t.on("click", (function () {
        l.addClass("show"), e.addClass("show")
    })), e.length && e.on("click", (function () {
        f.removeClass("show"), e.removeClass("show"), a.removeClass("show"), l.removeClass("show")
    })), s.find("ul li").length && s.find("ul li").on("click", (function () {
        var e = $(this), a = $(".start-chat-area"), o = $(".active-chat");
        s.find("ul li").hasClass("active") && s.find("ul li").removeClass("active"), e.addClass("active"), e.find(".badge").remove(), s.find("ul li").hasClass("active") ? (a.addClass("d-none"), o.removeClass("d-none")) : (a.removeClass("d-none"), o.addClass("d-none"))
    })), c.find("li").on("click", (function () {
        window.userReceiveId = $(this).attr('value');
        clearInterval(window.IntervalListChat);
        clearInterval(window.IntervalMes);
        $('#boxchat').scrollTop(5);
        window.first = 0;
        window.last = 0;
        window.skipped_once = false;
        window.loading = false;
        getMessenger();
        // r.animate({scrollTop: r[0].scrollHeight}, 400);
    })), w.length && w.on("click", (function (s) {
        f.removeClass("show"), e.removeClass("show"), a.removeClass("show"), l.removeClass("show")
    })), $(window).width() < 991 && onClickFn(), C.length && C.on("keyup", (function () {
        var e = $(this).val().toLowerCase();
        clearInterval(window.IntervalListChat);
        if ("" !== e) {
            h.find("li:not(.no-results)").filter((function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(e) > -1)
            })), d.find("li:not(.no-results)").filter((function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(e) > -1)
            }));
            var a = h.find("li:not(.no-results):visible").length, o = d.find("li:not(.no-results):visible").length;
            0 == a ? h.find(".no-results").addClass("show") : h.find(".no-results").hasClass("show") && h.find(".no-results").removeClass("show"), 0 == o ? d.find(".no-results").addClass("show") : d.find(".no-results").hasClass("show") && d.find(".no-results").removeClass("show")
        } else {
            c.find("li").show(), s.find(".no-results").hasClass("show") && s.find(".no-results").removeClass("show");
            LoadListChat();
        }
    })), p.length) {
        var g = g || webkitSpeechRecognition;
        if (null != g) {
            var m = new g, b = !1;
            p.on("click", (function () {
                var s = $(this);
                m.onspeechstart = function () {
                    b = !0
                }, !1 === b && m.start(), m.onerror = function (s) {
                    b = !1
                }, m.onresult = function (e) {
                    s.closest(".form-send-message").find(".message").val(e.results[0][0].transcript)
                }, m.onspeechend = function (s) {
                    b = !1, m.stop()
                }
            }))
        }
    }
}

$(window).on("resize", (function () {
    $(window).width() > 992 && $(".chat-application .body-content-overlay").hasClass("show") && ($(".app-content .sidebar-left").removeClass("show"), $(".chat-application .body-content-overlay").removeClass("show")), $(window).width() < 991 && (onClickFn(), $(".chat-application .chat-profile-sidebar").hasClass("show") && $(".chat-application .sidebar-content").hasClass("show") || ($(".sidebar-content").removeClass("show"), $(".body-content-overlay").removeClass("show")))
})), $(document).on("click", ".sidebar-toggle", (function () {
    $(window).width() < 992 && onClickFn()
}));
var frm = $('#fmSendChat');
frm.submit(function (ev) {
    $.ajax({
        type: frm.attr('method'),
        url: baseUrl + 'chatbox/addMessenger?userReceiveId=' + window.userReceiveId,
        data: frm.serialize(),
        success: function (data) {
            $("#Contact_" + window.userReceiveId).remove();
        }
    });
    document.getElementById('messenger').value = '';
    document.getElementById('messenger').focus();
    ev.preventDefault();
});

function getMessenger(check=0) {
    if(check==0) {
        document.getElementById('chatdiv').innerHTML = '';
    }
    document.getElementById('messenger').value = '';
    document.getElementById('messenger').focus();
    $.get(baseUrl + "chatbox/loaduser?userReceiveId=" + window.userReceiveId, function (data) {
        document.getElementById('userProfile').innerHTML = '';
        $('#userProfile').append(data)
    });

    function wrapText(elementID, openTag, closeTag) {
        var textArea = $('#' + elementID);
        var len = textArea.val().length;
        var start = textArea[0].selectionStart;
        var end = textArea[0].selectionEnd;
        var selectedText = textArea.val().substring(start, end);
        var replacement = openTag + selectedText + closeTag;
        textArea.val(textArea.val().substring(0, start) + replacement + textArea.val().substring(end, len));
    }

    var skrol = document.getElementById("boxchat");

//JSON MESSAGE LOADER START
    function jsonloader() {
        var ajax_url = baseUrl + "chatbox/loadmessages?userReceiveId=" + window.userReceiveId + "&newest=" + window.last;
        if (window.loading == false) {
            window.loading = true;
            $.get(ajax_url, function (data) {
                //  $("#boxchat").append(data);
                data = JSON.parse(data);
                data = data['data'];
                $.each(data, function (i, single) {
                    var poruke = "";
                    var class_chat = "";
                    var hinhanh = baseUrl + 'template/images/default_avatar.png';
                    if (single.user_id !== window.userReceiveId) {
                        class_chat = "";
                        if (single.senderImg !== '')
                            hinhanh = single.senderImg;
                    } else {
                        if (single.receiverImg !== '')
                            hinhanh = single.receiverImg;
                        class_chat = "chat-left";
                    }
                    poruke = '<div class="chat ' + class_chat + '" id="textchat_' + single.msg_id + '">';
                    poruke += '<div class="chat-avatar">';
                    poruke += '<span class="avatar box-shadow-1 avatar-border">';
                    poruke += '<img src="' + hinhanh + '" alt="avatar" height="36" width="36" />';
                    poruke += '</span>';
                    poruke += '</div>';
                    poruke += '<div class="chat-body">';
                    poruke += '<div class="chat-content">';
                    poruke += '<p>' + single.message + '</p>';
                    poruke += '</div>';
                    poruke += '</div>';
                    poruke += '</div>';
                    if ($("#textchat_" + single.msg_id).length == 0) {
                        $("#chatdiv").append(poruke);
                    }
                    skrol.scrollTop = skrol.scrollHeight - skrol.clientHeight;
                    if (window.skipped_once == true) {
                        if (single.user_id === window.userReceiveId) {
                            document.getElementById('bgAudio').play();
                        }
                    }
                    //
                    window.last = single.msg_id;
                    if (window.first == 0) {
                        window.first = window.last
                    }
                    //
                });
                window.skipped_once = true;
            }).always(function () {
                window.loading = false;
            });
        }
    };
    jsonloader();

    window.IntervalMes = setInterval(function () {
        jsonloader();
    }, 700);
//JSON MESSAGE LOADER END


//HISTORY LOADER START
    function historyloader() {
        var ajax_url = baseUrl + "chatbox/loadmessages?userReceiveId=" + window.userReceiveId + "&first=" + window.first;
        $.get(ajax_url, function (data) {
            window.priprema = "";
            data = JSON.parse(data);
            data = data['data'];
            if (data.length > 0) {
                $.each(data, function (i, hsingle) {
                    var poruke = "";
                    var class_chat = "";
                    var hinhanh = baseUrl + 'template/images/default_avatar.png';
                    if (hsingle.user_id != window.userReceiveId) {
                        class_chat = "";
                        if (hsingle.senderImg != '')
                            hinhanh = hsingle.senderImg;
                    } else {
                        class_chat = "chat-left";
                        if (hsingle.receiverImg != '')
                            hinhanh = hsingle.receiverImg;
                    }
                    poruke = '<div class="chat ' + class_chat + '" id="textchat_' + hsingle.msg_id + '">';
                    poruke += '<div class="chat-avatar">';
                    poruke += '<span class="avatar box-shadow-1 avatar-border">';
                    poruke += '<img src="' + hinhanh + '" alt="avatar" height="36" width="36" />';
                    poruke += '</span>';
                    poruke += '</div>';
                    poruke += '<div class="chat-body">';
                    poruke += '<div class="chat-content">';
                    poruke += '<p>' + hsingle.message + '</p>';
                    poruke += '</div>';
                    poruke += '</div>';
                    poruke += '</div>';

                    if ($("#textchat_" + hsingle.msg_id).length == 0) {
                        window.priprema = window.priprema + poruke;
                    }

                    if (parseInt(hsingle.msg_id, 10) < parseInt(window.first, 10)) {
                        window.first = hsingle.msg_id
                    }
                });

                $("#chatdiv").prepend(window.priprema);
            }
        });
    };

//HISTORY LOADER STOP
    $('#boxchat').scroll(function (vazanklik) {
        vazanklik.stopPropagation();
        vazanklik.preventDefault();
        if ($('#boxchat').scrollTop() == 0) {
            setTimeout(function () {
                historyloader();
                $('#boxchat').scrollTop(200);
            }, 1000);
        }
    });

    // jQuery(document).ready(function () {
    //     jQuery('#emoticons').hide();
    //     jQuery('#hideshow').on('click', function (event) {
    //         jQuery('#emoticons').toggle();
    //     });
    // });
    //
    // $('#emoticons a').click(function () {
    //     var smiley = $(this).attr('title');
    //     ins2pos(smiley, 'message');
    // });

    // function ins2pos(str, id) {
    //     var TextArea = document.getElementById(id);
    //     var val = TextArea.value;
    //     var before = val.substring(0, TextArea.selectionStart);
    //     var after = val.substring(TextArea.selectionEnd, val.length);
    //
    //     TextArea.value = before + str + after;
    //     setCursor(TextArea, before.length + str.length);
    // }

    // function setCursor(elem, pos) {
    //     if (elem.setSelectionRange) {
    //         elem.focus();
    //         elem.setSelectionRange(pos, pos);
    //     } else if (elem.createTextRange) {
    //         var range = elem.createTextRange();
    //         range.collapse(true);
    //         range.moveEnd('character', pos);
    //         range.moveStart('character', pos);
    //         range.select();
    //     }
    // }

// //mute unmute
//     var audio = document.getElementById('bgAudio');
//
//     $(document).ready(function () {
//         $('#mutez').click(function () {
//             if ($('audio').attr('muted') == undefined) {
//                 $('audio').attr('muted', '');
//                 audio.muted = true;
//                 $('#mutez').val('Unmute')
//             } else {
//                 $('audio').removeAttr('muted');
//                 audio.muted = false;
//                 $('#mutez').val('Mute')
//             }
//         });
//     });

    window.IntervalListChat = setInterval(function () {
        LoadListChat();
    }, 1000);
}

function LoadListChat() {
    $.get(baseUrl + "chatbox/listUsersChats?userReceiveId=" + window.userReceiveId, function (data) {
        document.getElementById('ListsItemChat').innerHTML = '';
        var str = "";
        var key = 0;
        data = JSON.parse(data);
        $.each(data, function (i, item) {
            key++;
            str += '<li value="' + item.id + '" ' + item.isactive + '>';
            str += '<span class="avatar">';
            str += '<img src="' + item.hinh_anh + '"height="42" width="42" alt="' + item.name + ' image"/>';
            str += '<span class="avatar-status-' + item.online + '"></span></span>';
            str += '<div class="chat-info flex-grow-1">';
            str += '<h5 class="mb-0">' + item.name + '</h5>';
            str += '<p class="card-text text-truncate">';
            str += item.lastmessenger;
            str += '</p>';
            str += '</div>';
            str += '<div class="chat-meta text-nowrap">';
            str += '<small class="float-right mb-25 chat-time">' + item.lastHour + '</small>';
            if (item.totalUnread > 0)
                str += '<span class="badge badge-danger badge-pill float-right">' + item.totalUnread + '</span>';
            str += '</div>';
            str += '</li>';
        });
        var show = (key == 0) ? "show" : "";
        str += '<li class="no-results ' + show + '">';
        str += '<h6 class="mb-0">No Chats Found</h6>';
        str += '</li>';
        $('#ListsItemChat').append(str);
        var str1 = document.getElementById('ListContacts').innerHTML;
        document.getElementById('ListContacts').innerHTML = '';
        $('#ListContacts').append(str1);
        CallMessenger();
    });
}
LoadListChat();
window.IntervalListChat = setInterval(function () {
    LoadListChat();
}, 1000);
document.addEventListener( 'visibilitychange' , function() {
    var updateOnline = new Object();
    if (document.hidden) {
        updateOnline = setInterval(function () {
            $.get(baseUrl + "chatbox/listUsersChats?userReceiveId=" + window.userReceiveId+'&updateOnline=1', function (data) {
            });
        }, 2000);
        clearInterval(window.IntervalListChat);
        clearInterval(window.IntervalMes);
    } else {
        clearInterval(updateOnline);
        getMessenger(1);
        LoadListChat();
    }
}, false );