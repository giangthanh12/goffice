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
    var // taskTitle,
        url = '',
        deadLinePickr = $(".task-due-date"),
        newTaskModal = $(".sidebar-todo-modal"),
        newTaskForm = $("#form-modal-todo"),
        favoriteStar = $(".todo-item-favorite"),
        modalTitle = $(".modal-title"),
        addBtn = $(".add-todo-item"),
        addTaskBtn = $(".add-task button"),
        updateTodoItem = $(".update-todo-item"),
        updateBtns = $(".update-btn"),
        taskDesc = $("#task-desc"),
        taskAssignSelect = $("#task-assigned"),
        taskAssignList = $("#task-assigned-list"),
        onProject = $("#onProject"),
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
        checkboxId = 100,
        isRtl = $("html").attr("data-textdirection") === "rtl";

    var assetPath = baseHome + "/styles/app-assets/";
    if ($("body").attr("data-framework") === "laravel") {
        assetPath = $("body").attr("data-asset-path");
    }

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
            '<img onerror="this.src=\'' + baseHome + '/layouts/useravatar.png\'" class="d-block rounded-circle mr-50" src="' +
            $(option.element).data("img") +
            '" height="26" width="26" alt="' +
            option.text +
            '">' +
            '<div class="media-body"><p class="mb-0">' +
            option.text +
            "</p></div></div>";

        return $person;
    }

    // Chọn nhân viên để hiển thị công việc
    if (taskAssignList.length) {
        taskAssignList.wrap('<div class="position-relative" style="min-width:250px"></div>');
        taskAssignList.select2({
            placeholder: "Chọn nhân viên",
            dropdownParent: taskAssignList.parent(),
            templateResult: assignTask,
            templateSelection: assignTask,
            escapeMarkup: function (es) {
                return es;
            },
        });
        taskAssignList.val(staffId).trigger("change");
    }

    // Chọn dự án cho công việc
    if (onProject.length) {
        onProject.wrap('<div class="position-relative"></div>');
        onProject.select2({
            placeholder: "Unassigned",
        });
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

    // Define render label
    function renderTaskTag(option) {
        if (!option.id) {
            return option.text;
        }
        var $person =
            '<div class="media align-items-center">' +
            '<span class="bullet bullet-sm mr-50" style="background: ' + $(option.element).data("color") + '"></span>' +
            '<div class="media-body"><p class="mb-0">' +
            option.text +
            "</p></div></div>";

        return $person;
    }

    // Task Tags
    if (taskTag.length) {
        taskTag.wrap('<div class="position-relative"></div>');
        taskTag.select2({
            placeholder: "Select tag",
            dropdownParent: taskTag.parent(),
            templateResult: renderTaskTag,
            templateSelection: renderTaskTag,
            escapeMarkup: function (es) {
                return es;
            },
        });
    }

    // Favorite star click
    if (favoriteStar.length) {
        $(favoriteStar).on("click", function () {
            $(this).toggleClass("text-warning");
        });
    }

    // Flat Picker
    if (deadLinePickr.length) {
        deadLinePickr.flatpickr({
            dateFormat: "d/m/Y",
            defaultDate: "today",
            minDate:"today",
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

    // On add new item button click, clear sidebar-right field fields
    if (addTaskBtn.length) {
        addTaskBtn.on("click", function (e) {
            url = baseHome + '/todo/add';
            addBtn.removeClass("d-none");
            updateBtns.addClass("d-none");
            modalTitle.text("Add Task");
            // newTaskModal.modal('show');
            sidebarLeft.removeClass("show");
            overlay.removeClass("show");
            newTaskModal.find(".new-todo-item-title").val("");
            var quill_editor = taskDesc.find(".ql-editor");
            quill_editor[0].innerHTML = "";
            taskAssignSelect.val(staffId).trigger("change");
            taskTag.val("").trigger("change");
            onProject.val("0").trigger("change");
            deadLinePickr.val(today);
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
            messages: {
                todoTitleAdd: {
                    required: "Bạn chưa nhập tên công việc!",
                },
                "task-assigned": {
                    required: "Bạn chưa nhập người nhận công việc!",
                },
                "task-due-date": {
                    required: "Bạn chưa nhập tên thời hạn hoàn thành!",
                },
            },
        });

        newTaskForm.on("submit", function (e) {
            e.preventDefault();
            var isValid = newTaskForm.valid();
            if (isValid) {
                var taskId = 0;
                var newTitle = newTaskForm.find(".new-todo-item-title").val();
                var newAssignee = taskAssignSelect.val();
                var newDeadline = deadLinePickr.val();
                var newLabel = taskTag.val();
                var quill_editor = $("#task-desc .ql-editor");
                var newDescription = quill_editor[0].innerHTML;
                $.post(
                    url,
                    {
                        id: taskId,
                        newTitle: newTitle,
                        newAssignee: newAssignee,
                        newDeadline: newDeadline,
                        newLabel: newLabel,
                        newDescription: newDescription
                    },
                    function (data, status) {
                        if (data.code == 200) {
                            toastr["success"](data.message, "💾 Task Action!", {
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl,
                            });
                            $(newTaskModal).modal("hide");
                            var projectId = $('#projectId').val();
                            var assigneeId = taskAssignList.val();
                            proId = projectId;
                            staffId = assigneeId;
                            loadTaskList(proId, staffId, taskStatus, 'false');
                        } else {
                            toastr["error"](data.message, "💾 Task Action!", {
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl,
                            });
                        }
                    },
                    "json"
                );
                // checkboxId++;
                // var assignedTo = $("#task-assigned").val(),
                //     todoBadge = "",
                //     membersImg = {
                //         "Phill Buffer": assetPath + "images/portrait/small/avatar-s-3.jpg",
                //         "Chandler Bing": assetPath + "images/portrait/small/avatar-s-1.jpg",
                //         "Ross Geller": assetPath + "images/portrait/small/avatar-s-4.jpg",
                //         "Monica Geller": assetPath + "images/portrait/small/avatar-s-6.jpg",
                //         "Joey Tribbiani": assetPath + "images/portrait/small/avatar-s-2.jpg",
                //         "Rachel Green": assetPath + "images/portrait/small/avatar-s-11.jpg",
                //     };
                //
                // var todoTitle = $(".sidebar-todo-modal .new-todo-item-title").val();
                // var date = $(".sidebar-todo-modal .task-due-date").val(),
                //     selectedDate = new Date(date),
                //     month = new Intl.DateTimeFormat("en", { month: "short" }).format(selectedDate),
                //     day = new Intl.DateTimeFormat("en", { day: "2-digit" }).format(selectedDate),
                //     todoDate = month + " " + day;
                //
                // // Badge calculation loop
                // var selected = $(".task-tag").val();
                // var badgeColor = {
                //     Team: "primary",
                //     Low: "success",
                //     Medium: "warning",
                //     High: "danger",
                //     Update: "info",
                // };
                // $.each(selected, function (index, value) {
                //     todoBadge += '<div class="badge badge-pill badge-light-' + badgeColor[value] + ' mr-50">' + value + "</div>";
                // });
                // // HTML Output
                // if (todoTitle != "") {
                //     $(todoTaskList).prepend(
                //         '<li class="todo-item">' +
                //             '<div class="todo-title-wrapper">' +
                //             '<div class="todo-title-area">' +
                //             feather.icons["more-vertical"].toSvg({ class: "drag-icon" }) +
                //             '<div class="title-wrapper">' +
                //             '<div class="custom-control custom-checkbox">' +
                //             '<input type="checkbox" class="custom-control-input" id="customCheck' +
                //             checkboxId +
                //             '" />' +
                //             '<label class="custom-control-label" for="customCheck' +
                //             checkboxId +
                //             '"></label>' +
                //             "</div>" +
                //             '<span class="todo-title">' +
                //             todoTitle +
                //             "</span>" +
                //             "</div>" +
                //             "</div>" +
                //             '<div class="todo-item-action">' +
                //             '<div class="badge-wrapper mr-1">' +
                //             todoBadge +
                //             "</div>" +
                //             '<small class="text-nowrap text-muted mr-1">' +
                //             todoDate +
                //             "</small>" +
                //             '<div class="avatar">' +
                //             '<img src="' +
                //             membersImg[assignedTo] +
                //             '" alt="' +
                //             assignedTo +
                //             '" height="28" width="28">' +
                //             "</div>" +
                //             "</div>" +
                //             "</div>" +
                //             "</li>"
                //     );
                // }
                // toastr["success"]("Data Saved", "💾 Task Action!", {
                //     closeButton: true,
                //     tapToDismiss: false,
                //     rtl: isRtl,
                // });
                // $(newTaskModal).modal("hide");
                // overlay.removeClass("show");
            }
        });
    }

    // Task checkbox change
    todoTaskListWrapper.on("change", ".custom-checkbox", function (event) {
        var $this = $(this).find("input");
        var taskId = $this.attr("id").replace('customCheck', '');
        if ($this.prop("checked")) {
            $.post(
                "todo/checkOut", {id: taskId, status: 4},
                function (data, status) {
                    if (data.code == 200) {
                        toastr["success"]("Task Completed", "Congratulations!! 🎉", {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl,
                        });
                    } else {
                        toastr["error"](data.message, "💾 Task Action!", {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl,
                        });
                    }
                },
                "json"
            );
            // $this.closest(".todo-item").addClass("completed");
            // toastr["success"]("Task Completed", "Congratulations!! 🎉", {
            //     closeButton: true,
            //     tapToDismiss: false,
            //     rtl: isRtl,
            // });
        } else {
            // $this.closest(".todo-item").removeClass("completed");
            $.post(
                "todo/checkOut", {id: taskId, status: 2},
                function (data, status) {
                    if (data.code == 200) {
                        toastr["success"]("Task updated", "💾 Task Action", {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl,
                        });
                    } else {
                        toastr["error"](data.message, "💾 Task Action!", {
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
    todoTaskListWrapper.on("click", ".custom-checkbox", function (event) {
        event.stopPropagation();
    });

    // To open todo list item modal on click of item
    $(document).on("click", ".todo-task-list-wrapper .todo-item", function (e) {
        newTaskModal.modal("show");
        addBtn.addClass("d-none");
        updateBtns.removeClass("d-none");
        var taskId = $(this).find(".taskId").text();
        // if ($(this).hasClass("completed")) {
        //     modalTitle.html('<button type="button" class="btn btn-sm btn-outline-success complete-todo-item waves-effect waves-float waves-light" data-dismiss="modal">Completed</button>');
        // } else {

        // }
        // taskTitle = $(this).find('.todo-title');

        $("#taskId").val(taskId);
        var $title = $(this).find(".todo-title").html();
        var thisLabel = $(this).find(".badge-pill").attr("data-id");
        newTaskForm.find(".new-todo-item-title").val($title);
        var assigneeId = $(this).find(".avatar").attr("data-id");
        taskAssignSelect.val(assigneeId).trigger("change");
        var deadline = $(this).find(".text-nowrap").text();
        deadLinePickr.val(deadline);
        var thisLabel = $(this).find(".badge").attr("data-id");
        taskTag.val(thisLabel).trigger("change");
        var projectId = $(this).find(".taskProject").text();
        onProject.val(projectId).trigger("change");
        var desc = $(this).find(".taskDescription").html();
        var quill_editor = $("#task-desc .ql-editor");
        quill_editor[0].innerHTML = desc;
        var status = $(this).find(".taskStatus").html();
        if (status == 6) {
            url = '';
            modalTitle.empty();
            updateBtns.addClass("d-none");
        } else {
            if (funEdit == 1)
                modalTitle.html('<button type="button" onclick="markCompleted(' + taskId + ')"class="btn btn-sm btn-outline-secondary complete-todo-item waves-effect waves-float waves-light" data-dismiss="modal">Hoàn thành</button>');
            url = baseHome + '/todo/update';
            updateBtns.removeClass("d-none");
        }
    });

    // Updating Data Values to Fields
    if (updateTodoItem.length) {
        updateTodoItem.on("click", function (e) {
            var isValid = newTaskForm.valid();
            e.preventDefault();
            if (isValid) {
                var taskId = $("#taskId").val();
                var newTitle = newTaskForm.find(".new-todo-item-title").val();
                var newProject = onProject.val();
                var newAssignee = taskAssignSelect.val();
                var newDeadline = deadLinePickr.val();
                var newLabel = taskTag.val();
                var quill_editor = $("#task-desc .ql-editor");
                var newDescription = quill_editor[0].innerHTML;
                $.post(
                    "todo/update",
                    {
                        id: taskId,
                        newTitle: newTitle,
                        newProject: newProject,
                        newAssignee: newAssignee,
                        newDeadline: newDeadline,
                        newLabel: newLabel,
                        newDescription: newDescription
                    },
                    function (data, status) {
                        if (data.code == 200) {
                            toastr["success"](data.message, "💾 Task Action!", {
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl,
                            });
                            $(newTaskModal).modal("hide");
                            var projectId = $('#projectId').val();
                            var assigneeId = taskAssignList.val();
                            proId = projectId;
                            staffId = assigneeId;
                            loadTaskList(proId, staffId, taskStatus, 'false');
                        } else {
                            toastr["error"](data.message, "💾 Task Action!", {
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl,
                            });
                        }
                    },
                    "json"
                );
                // var $edit_title = newTaskForm.find('.new-todo-item-title').val();
                // $(taskTitle).text($edit_title);
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

function listTaskPro(project) {
    $('#projectId').val(project);
    proId = project;
    loadTaskList(proId, staffId, taskStatus, 'false');
}

function listMyTask() {
   // $('#projectId').val(-1);
    taskStatus='';
   // proId = -1;
    deadline='false';
    loadTaskList(proId, staffId, taskStatus, );
}

function listStatus(status) {
  //  $('#projectId').val(-1);
    //proId = -1;
    taskStatus = status;
    deadline='false';
    loadTaskList(proId, staffId, taskStatus, );
}

function listDeadline() {
  //  $('#projectId').val(-1);
  //  proId = -1;
    taskStatus='';
    deadline='true';
    loadTaskList(proId, staffId, taskStatus);
}

function listOtherTask(assigneeId) {
    if (assigneeId > 0) {
        staffId = assigneeId;
        $('#projectId').val(-1);
        proId=-1;
        loadTaskList(proId, staffId, taskStatus, 'false');
        getProject(assigneeId);
    }
}

function getProject(assigneeId) {
    $("#list_project").empty();
    $("#onProject").empty();
    $.post(
        "todo/getProject", {staffId: assigneeId},
        function (data, status) {
            console.log(data.data);
            var showPro = '<input type="hidden" id="projectId"/>' +
                '<a href="javascript:void(0)" onclick="listTaskPro(-1)" class="list-group-item list-group-item-action d-flex align-items-center">' +
                '<span class="bullet bullet-sm mr-1" style="background: #00ff00"></span>Toàn bộ</a>' +
                '<a href="javascript:void(0)" onclick="listTaskPro(0)" class="list-group-item list-group-item-action d-flex align-items-center">' +
                '<span class="bullet bullet-sm mr-1" style="background: #0c0c0c"></span>Công việc cá nhân</a>';
            var slPro = '<option value="0" selected>Công việc cá nhân</option>';
            data.data.forEach(function (item) {
                showPro += '<a href="javascript:void(0)" onclick="listTaskPro(' + item.id + ')" class="list-group-item list-group-item-action d-flex align-items-center">' +
                    '<span class="bullet bullet-sm mr-1" style="background: ' + item.color + '"></span>' + item.name + '</a>';
                slPro += '<option value="' + item.id + '">' + item.name + '</option>';
            });
            $("#list_project").append(showPro);
            $("#onProject").append(slPro);
        },
        "json"
    );
}

function loadTaskList(projectId, staffId, status) {
    $("#my-task-list").load(window.location.href + "?assignee=" + staffId + "&deadline="+deadline+"&status=" + status +"&project="+projectId+" #my-task-list");
}


function markCompleted(taskId) {
    $.post(
        "todo/checkOut", {id: taskId, status: 6},
        function (data, status) {
            if (data.code == 200) {
                toastr["success"]("Task completed", "Congratulations!! 🎉", {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl,
                });
                var projectId = $('#projectId').val();
                var assigneeId = $("#task-assigned-list").val();
                proId = projectId;
                staffId = assigneeId;
                loadTaskList(proId, staffId, taskStatus, 'false');
            } else {
                toastr["error"](data.message, "💾 Task Action!", {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl,
                });
            }
        },
        "json"
    );
}

function deleteTask() {
    var taskId = $("#taskId").val();
    Swal.fire({
        title: 'Xóa dữ liệu',
        text: "Bạn có chắc chắn muốn xóa!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Tôi đồng ý',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            $.post(
                "todo/del", {id: taskId, status: 0},
                function (data, status) {
                    if (data.code == 200) {
                        $('#new-task-modal').modal('hide');
                        toastr["success"]("Xóa task thành công", "💾 Task Action", {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl,
                        });
                        var projectId = $('#projectId').val();
                        var assigneeId = $("#task-assigned-list").val();
                        proId = projectId;
                        staffId = assigneeId;
                        loadTaskList(proId, staffId, taskStatus, 'false');
                    } else {
                        toastr["error"](data.message, "💾 Task Action!", {
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
