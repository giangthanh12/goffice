/*=========================================================================================
    File Name: app-todo.js
    Description: app-todo
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

"use strict";

$(function () {
    var taskTitle,
        flatPickr = $(".task-due-date"),
        newTaskModal = $(".sidebar-todo-modal"),
        newTaskForm = $("#form-modal-todo"),
        favoriteStar = $(".todo-item-favorite"),
        modalTitle = $(".modal-title"),
        addBtn = $(".add-todo-item"),
        addTaskBtn = $(".add-task button"),
        updateTodoItem = $(".update-todo-item"),
        updateBtns = $(".update-btn"),
        taskDesc = $("#task-desc"),
        taskComm = $("#task-comm"),
        taskAssignSelect = $("#task-assigned"), // trong form
        nhanvien = $("#nhanvien"), // tìm kiếm left menu
        taskTag = $("#task-tag"),
        overlay = $(".body-content-overlay"),
        menuToggle = $(".menu-toggle"),
        sidebarToggle = $(".sidebar-toggle"),
        sidebarLeft = $(".sidebar-left"),
        sidebarMenuList = $(".sidebar-menu-list"),
        todoFilter = $("#todo-search"),
        sortAsc = $(".sort-asc"),
        sortDesc = $(".sort-desc"),
        todoTaskList = $(".todo-task-list"),
        todoTaskListWrapper = $(".todo-task-list-wrapper"),
        listItemFilter = $(".list-group-filters"),
        noResults = $(".no-results"),
        // checkboxId = 100,
        isRtl = $("html").attr("data-textdirection") === "rtl";

    var uid = 0;

    list_to_do(uid);
    load_select2(uid,nhanvien);

    // if it is not touch device
    if (!$.app.menu.is_touch_device()) {
        if (sidebarMenuList.length > 0) {
            var sidebarListScrollbar = new PerfectScrollbar(sidebarMenuList[0], {
                theme: "dark",
            });
        }
        if (todoTaskListWrapper.length > 0) {
            var taskListScrollbar = new PerfectScrollbar(todoTaskListWrapper[0], {
                theme: "dark",
            });
        }
    }
    // if it is a touch device
    else {
        sidebarMenuList.css("overflow", "scroll");
        todoTaskListWrapper.css("overflow", "scroll");
    }

    // Add class active on click of sidebar filters list
    if (listItemFilter.length) {
        listItemFilter.find("a").on("click", function () {
            if (listItemFilter.find("a").hasClass("active")) {
                listItemFilter.find("a").removeClass("active");
            }
            $(this).addClass("active");
        });
    }

    // Init D'n'D
    var dndContainer = document.getElementById("todo-task-list");
    if (typeof dndContainer !== undefined && dndContainer !== null) {
        dragula([dndContainer], {
            moves: function (el, container, handle) {
                return handle.classList.contains("drag-icon");
            },
        });
    }

    // Main menu toggle should hide app menu
    if (menuToggle.length) {
        menuToggle.on("click", function (e) {
            sidebarLeft.removeClass("show");
            overlay.removeClass("show");
        });
    }

    // Todo sidebar toggle
    if (sidebarToggle.length) {
        sidebarToggle.on("click", function (e) {
            e.stopPropagation();
            sidebarLeft.toggleClass("show");
            overlay.addClass("show");
        });
    }

    // On Overlay Click
    if (overlay.length) {
        overlay.on("click", function (e) {
            sidebarLeft.removeClass("show");
            overlay.removeClass("show");
            $(newTaskModal).modal("hide");
        });
    }

    // Assign task
    function assignTask(option) {
        if (!option.id) {
            return option.text;
        }
        var $person =
            '<div class="media align-items-center">' +
            '<img class="d-block rounded-circle mr-50" src="' +
            $(option.element).data("img") +
            '" height="26" width="26" alt="' +
            option.text +
            '">' +
            '<div class="media-body"><p class="mb-0">' +
            option.text +
            "</p></div></div>";

        return $person;
    }

    // Task Assign Select2
    if (taskAssignSelect.length) {
        taskAssignSelect.wrap('<div class="position-relative"></div>');
        taskAssignSelect.select2({
            placeholder: "Unassigned",
            dropdownParent: taskAssignSelect.parent(),
            templateResult: assignTask,
            templateSelection: assignTask,
            escapeMarkup: function (es) {
                return es;
            },
        });
    }

    if (nhanvien.length) {
        nhanvien.wrap('<div class="position-relative"></div>');
        nhanvien.select2({
            placeholder: "Unassigned",
            dropdownParent: nhanvien.parent(),
            templateResult: assignTask,
            templateSelection: assignTask,
            escapeMarkup: function (es) {
                return es;
            },
        });
        nhanvien.on("change", function (e) {
          uid = this.value
          list_to_do(uid);
        });
    }

    // Task Tags
    if (taskTag.length) {
        taskTag.wrap('<div class="position-relative"></div>');
        taskTag.select2({
            placeholder: "Select tag",
        });
    }

    // Favorite star click
    if (favoriteStar.length) {
        $(favoriteStar).on("click", function () {
            $(this).toggleClass("text-warning");
        });
    }

    // Flat Picker
    if (flatPickr.length) {
        flatPickr.flatpickr({
            dateFormat: "Y-m-d",
            defaultDate: "today",
            onReady: function (selectedDates, dateStr, instance) {
                if (instance.isMobile) {
                    $(instance.mobileInput).attr("step", null);
                }
            },
        });
    }

    // Todo Description Editor
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

    if (taskComm.length) {
        var todoDescEditor = new Quill("#task-comm", {
            bounds: "#task-comm",
            modules: {
                formula: true,
                syntax: true,
                toolbar: ".comm-toolbar",
            },
            placeholder: "Write Your Comment",
            theme: "snow",
        });
    }

    // On add new item button click, clear sidebar-right field fields
    if (addTaskBtn.length) {
        addTaskBtn.on("click", function (e) {
            addBtn.removeClass("d-none");
            updateBtns.addClass("d-none");
            modalTitle.text("Giao việc");
            // newTaskModal.modal('show');
            sidebarLeft.removeClass("show");
            overlay.removeClass("show");
            newTaskModal.find(".new-todo-item-title").val("");
            var quill_editor = taskDesc.find(".ql-editor p");
            quill_editor.html();
            $('#customRadio1').attr('checked','true');
            $('#id').val(0);
            load_select2(uid,taskAssignSelect);
        });
    }

    // Add New ToDo List Item

    // To add new todo form
    if (newTaskForm.length) {
        newTaskForm.validate({
            ignore: ".ql-container *", // ? ignoring quill editor icon click, that was creating console error
            rules: {
                todoTitleAdd: {
                    required: true,
                },
                "task-assigned": {
                    required: true,
                },
                "task-due-date": {
                    required: true,
                },
            },
        });

        newTaskForm.on("submit", function (e) {
            e.preventDefault();
            var isValid = newTaskForm.valid();
            if (isValid) {
                var assignedTo = $("#task-assigned").val();
                var todoTitle = $(".sidebar-todo-modal .new-todo-item-title").val();
                var date = $(".sidebar-todo-modal .task-due-date").val(),
                    selectedDate = new Date(date),
                    month = new Intl.DateTimeFormat("en", { month: "short" }).format(selectedDate),
                    day = new Intl.DateTimeFormat("en", { day: "2-digit" }).format(selectedDate),
                    todoDate = month + " " + day;
                var myRadio = $("input[name=customRadio]");
                var label = myRadio.filter(":checked").val();
                var file = $("#attachments").val();
                var comment = taskDesc.find(".ql-editor p").html();
                var id = $("#id").val();

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: { id: id, title: todoTitle, deadline: date, nhanvien: assignedTo, label: label, file: file, comment: comment },
                    url: baseHome + "/todo/update",
                    success: function (data) {
                        if (data.success == true) {
                            notyfi_success(data.msg);
                            list_to_do(uid);
                        } else {
                            notify_error(data.msg);
                            return false;
                        }
                    },
                });

                // HTML Output
                // if (todoTitle != "") {

                // }
                // toastr["success"]("Data Saved", "💾 Task Action!", {
                //     closeButton: true,
                //     tapToDismiss: false,
                //     rtl: isRtl,
                // });
                $(newTaskModal).modal("hide");
                overlay.removeClass("show");
            }
        });
    }

    // Task checkbox change
    todoTaskListWrapper.on("change", ".custom-checkbox", function (event) {
        var $this = $(this).find("input");
        if ($this.prop("checked")) {
            $this.closest(".todo-item").addClass("completed");
            // toastr["success"]("Task Completed", "xxxxxxCongratulations!! 🎉", {
            //     closeButton: true,
            //     tapToDismiss: false,
            //     rtl: isRtl,
            // });
        } else {
            $this.closest(".todo-item").removeClass("completed");
        }
        var id = $this.val();
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {id:id},
            url: baseHome + "/todo/completed",
            success: function (data) {
                if (data.success == true) {
                    // notyfi_success(data.msg);
                    list_to_do(uid);
                } else {
                    notify_error(data.msg);
                    return false;
                }
            },
        });
    });
    todoTaskListWrapper.on("click", ".custom-checkbox", function (event) {
        event.stopPropagation();
    });

    // To open todo list item modal on click of item
    $(document).on("click", ".todo-task-list-wrapper .todo-item .todo-title", function (e) {
        newTaskModal.modal("show");
        addBtn.addClass("d-none");
        updateBtns.removeClass("d-none");
        if ($(this).hasClass("completed")) {
            modalTitle.html('<button type="button" class="btn btn-sm btn-outline-success complete-todo-item waves-effect waves-float waves-light" data-dismiss="modal">Completed</button>');
        } else {
            // modalTitle.html('<button type="button" class="btn btn-sm btn-outline-secondary complete-todo-item waves-effect waves-float waves-light" data-dismiss="modal">Đã xong</button>');
            modalTitle.html('Chi tiết công việc');
        }
        var id = this.id;
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {id: id},
            url: baseHome + "/todo/getitem",
            success: function (obj) {
                newTaskForm.find(".new-todo-item-title").val(obj.title);
                // $("#task-assigned").val(obj.nhan_vien);
                // $('#task-assigned').select2().trigger('change');
                var quill_editor = $("#task-desc .ql-editor p");
                quill_editor.html(obj.description);
                $('#task-due-date').val(obj.deadline);
                $('#customRadio'+obj.label).attr('checked','true');
                $('#id').val(obj.id);
                load_select2(obj.assigneeId,taskAssignSelect);
            }
        });
    });

    // Updating Data Values to Fields
    if (updateTodoItem.length) {
        updateTodoItem.on("click", function (e) {
            var isValid = newTaskForm.valid();
            e.preventDefault();
            if (isValid) {
                var $edit_title = newTaskForm.find(".new-todo-item-title").val();
                $(taskTitle).text($edit_title);

                // toastr["success"]("Data Saved", "💾 Task Action!", {
                //     closeButton: true,
                //     tapToDismiss: false,
                //     rtl: isRtl,
                // });
                $(newTaskModal).modal("hide");
            }
        });
    }

    // Sort Ascending
    if (sortAsc.length) {
        sortAsc.on("click", function () {
            todoTaskListWrapper
                .find("li")
                .sort(function (a, b) {
                    return $(b).find(".todo-title").text().toUpperCase() < $(a).find(".todo-title").text().toUpperCase() ? 1 : -1;
                })
                .appendTo(todoTaskList);
        });
    }
    // Sort Descending
    if (sortDesc.length) {
        sortDesc.on("click", function () {
            todoTaskListWrapper
                .find("li")
                .sort(function (a, b) {
                    return $(b).find(".todo-title").text().toUpperCase() > $(a).find(".todo-title").text().toUpperCase() ? 1 : -1;
                })
                .appendTo(todoTaskList);
        });
    }

    // Filter task
    if (todoFilter.length) {
        todoFilter.on("keyup", function () {
            var value = $(this).val().toLowerCase();
            if (value !== "") {
                $(".todo-item").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
                var tbl_row = $(".todo-item:visible").length; //here tbl_test is table name

                //Check if table has row or not
                if (tbl_row == 0) {
                    if (!$(noResults).hasClass("show")) {
                        $(noResults).addClass("show");
                    }
                } else {
                    $(noResults).removeClass("show");
                }
            } else {
                // If filter box is empty
                $(".todo-item").show();
                if ($(noResults).hasClass("show")) {
                    $(noResults).removeClass("show");
                }
            }
        });
    }

    // For chat sidebar on small screen
    if ($(window).width() > 992) {
        if (overlay.hasClass("show")) {
            overlay.removeClass("show");
        }
    }
});

$(window).on("resize", function () {
    // remove show classes from sidebar and overlay if size is > 992
    if ($(window).width() > 992) {
        if ($(".body-content-overlay").hasClass("show")) {
            $(".sidebar-left").removeClass("show");
            $(".body-content-overlay").removeClass("show");
            $(".sidebar-todo-modal").modal("hide");
        }
    }
});

function load_select2(id,select2) {
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        data: {id:id},
        url: baseHome + "/todo/nhanvien",
        success: function (data) {
            var html = "";
            data.forEach(function (element, index) {
                html += '<option data-img="'+element.hinh_anh+'" value="'+element.id+'" ';
                if (element.selected==true)
                    html += 'selected'
                html += '>'+element.name+'</option>';
            });
            select2.html(html);
            // $("#nhanvien").html(html);
            // $("#task-assigned").html(html);
        },
    });
}

function list_to_do(id) { //load du lieu vao danh sach
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        data: {id:id},
        url: baseHome + "/todo/getdata?nhanvien="+id,
        success: function (data) {
            var mailread = "";
            var html = "";
            data.forEach(function (element, index) {
                html += '<li class="todo-item"><div class="todo-title-wrapper"><div class="todo-title-area">';
                html += '<i data-feather="more-vertical" class="drag-icon"></i><div class="title-wrapper">';
                html += '<div class="custom-control custom-checkbox"><input type="checkbox" ';
                if(element.status==4)
                    html += 'checked'
                html += ' class="custom-control-input" id="checkbox_' + element.id + '" value="' + element.id + '" />';
                html += '<label class="custom-control-label" for="checkbox_' + element.id + '"></label></div>';
                html += '<span class="todo-title" id="'+element.id+'">' + element.title + '</span>&nbsp;';
                html += '<a href="javascript:void(0)" onclick="comment('+element.id+')"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>('+element.comment+')</a>';
                html += '</div></div><div class="todo-item-action"><div class="badge-wrapper mr-1">';
                if (element.status!=4 && element.label==3)
                    html += '<div class="badge badge-pill badge-light-danger">Cần gấp</div>';
                else if (element.status!=4 && element.label==2)
                    html += '<div class="badge badge-pill badge-light-warning">Ưu tiên</div>';
                if (element.status==1)
                    html += '<div class="badge badge-pill badge-light-info">Kế hoạch</div>';
                else if (element.status==2)
                    html += '<div class="badge badge-pill badge-light-success">Đang làm</div>';
                else if (element.status==3)
                    html += '<div class="badge badge-pill badge-light-primary">Trễ deadline</div>';
                else if (element.status==4)
                    html += '<div class="badge badge-pill badge-light-success">Đã xong</div>';
                if (element.status==3)
                    html += '</div><small class="text-nowrap mr-1 text-danger">' + element.deadline + '</small><div class="avatar">';
                else
                    html += '</div><small class="text-nowrap mr-1 text-success">' + element.deadline + '</small><div class="avatar">';
                html += '<img src="' + element.avatar + '" alt="' + element.nguoigui + '" height="32" width="32" />';
                html += "</div></div></div></li>";
            });
            $("#todo-task-list").html(html);
        }
    });
}

function comment(id) {
    $('#comment-modal').modal('show');
    $('#task-comm .ql-editor')[0].innerHTML='';
    $('.modal-title').html('Comment công việc');
    // var quill_editor = taskComm.find(".ql-editor");
    // quill_editor[0].innerHTML = "";
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        data: {id:id},
        url: baseHome + "/todo/comment",
        success: function (data) {
            $('#list-comment').val(id);
            var html = "";
            data.forEach(function (element, index) {
                html += '<div class="media mb-1"><div class="avatar my-0 ml-0 mr-50"><img src="'+element.hinhanh+'" alt="Avatar" height="32" /></div>';
                html += '<div class="media-body"><p class="mb-0"><span class="font-weight-bold">'+element.nhanvien+' </span><small class="text-muted">'+element.dateTime+'</small></p>';
                html += '<small>'+element.content+'</small></div></div>';
            });
            $("#list-comment").html(html);
        },
    });
}

function xoa() {
    var id = $("#id").val();
    var uid = $("#nhanvien").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id:id},
        url: baseHome + "/todo/del",
        success: function (data) {
            if (data.success == true) {
                notyfi_success("Cập nhật thành công");
                list_to_do(uid);
            } else {
                notify_error(data.msg);
                return false;
            }
        },
    });
}

function adcomment() {
    var jid = $('#list-comment').val();
    var comment =   $('#task-comm .ql-editor p').html();
    var uid = $("#nhanvien").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {id:jid, comment:comment},
        url: baseHome + "/todo/addcomment",
        success: function (data) {
            if (data.success == true) {
                notyfi_success("Cập nhật thành công");
                list_to_do(uid);
                var receiver = data.receiver;
                if(receiver.length) {
                    var data = {'type':'todo','receiverid':receiver.toString()};
                    connection.send(JSON.stringify(data));
                }
            } else {
                notify_error(data.msg);
                return false;
            }
        },
    });
}
