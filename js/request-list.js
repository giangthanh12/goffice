/*=========================================================================================
    File Name: app-todo.js
    Description: app-todo
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

'use strict';
var  todoTaskList = $('.todo-task-list');
$(function () {
    var taskTitle,
        flatPickr = $('.task-due-date'),
        newTaskModal = $('.sidebar-todo-modal'),
        newTaskForm = $('#form-modal-todo'),
        favoriteStar = $('.todo-item-favorite'),
        modalTitle = $('.modal-title'),
        addBtn = $('.add-todo-item'),
        addTaskBtn = $('.add-task button'),
        updateTodoItem = $('.update-todo-item'),
        updateBtns = $('.update-btn'),
        taskDesc = $('#task-desc'),
        taskAssignSelect = $('#task-assigned'),
        taskTag = $('#task-tag'),
        overlay = $('.body-content-overlay'),
        menuToggle = $('.menu-toggle'),
        sidebarToggle = $('.sidebar-toggle'),
        sidebarLeft = $('.sidebar-left'),
        sidebarMenuList = $('.sidebar-menu-list'),
        todoFilter = $('#todo-search'),
        sortAsc = $('.sort-asc'),
        sortDesc = $('.sort-desc'),
        todoTaskListWrapper = $('.todo-task-list-wrapper'),
        listItemFilter = $('.list-group-filters'),
        noResults = $('.no-results'),
        checkboxId = 100,
        isRtl = $('html').attr('data-textdirection') === 'rtl';

    var assetPath = baseHome+'/styles/app-assets/';
    if ($('body').attr('data-framework') === 'laravel') {
        assetPath = $('body').attr('data-asset-path');
    }
    initRequest(0,0);

    // if it is not touch device
    if (!$.app.menu.is_touch_device()) {
        if (sidebarMenuList.length > 0) {
            var sidebarListScrollbar = new PerfectScrollbar(sidebarMenuList[0], {
                theme: 'dark'
            });
        }
        if (todoTaskListWrapper.length > 0) {
            var taskListScrollbar = new PerfectScrollbar(todoTaskListWrapper[0], {
                theme: 'dark'
            });
        }
    }
    // if it is a touch device
    else {
        sidebarMenuList.css('overflow', 'scroll');
        todoTaskListWrapper.css('overflow', 'scroll');
    }

    // Add class active on click of sidebar filters list
    if (listItemFilter.length) {
        listItemFilter.find('a').on('click', function () {
            if (listItemFilter.find('a').hasClass('active')) {
                listItemFilter.find('a').removeClass('active');
            }
            $(this).addClass('active');
        });
    }

    // Init D'n'D
    var dndContainer = document.getElementById('todo-task-list');
    if (typeof dndContainer !== undefined && dndContainer !== null) {
        dragula([dndContainer], {
            moves: function (el, container, handle) {
                return handle.classList.contains('drag-icon');
            }
        });
    }

    // Main menu toggle should hide app menu
    if (menuToggle.length) {
        menuToggle.on('click', function (e) {
            sidebarLeft.removeClass('show');
            overlay.removeClass('show');
        });
    }

    // Todo sidebar toggle
    if (sidebarToggle.length) {
        sidebarToggle.on('click', function (e) {
            e.stopPropagation();
            sidebarLeft.toggleClass('show');
            overlay.addClass('show');
        });
    }

    // On Overlay Click
    if (overlay.length) {
        overlay.on('click', function (e) {
            sidebarLeft.removeClass('show');
            overlay.removeClass('show');
            $(newTaskModal).modal('hide');
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
            $(option.element).data('img') +
            '" height="26" width="26" alt="' +
            option.text +
            '">' +
            '<div class="media-body"><p class="mb-0">' +
            option.text +
            '</p></div></div>';

        return $person;
    }

    // Task Assign Select2
    if (taskAssignSelect.length) {
        taskAssignSelect.wrap('<div class="position-relative"></div>');
        taskAssignSelect.select2({
            placeholder: 'Unassigned',
            dropdownParent: taskAssignSelect.parent(),
            templateResult: assignTask,
            templateSelection: assignTask,
            escapeMarkup: function (es) {
                return es;
            }
        });
    }

    // Task Tags
    if (taskTag.length) {
        taskTag.wrap('<div class="position-relative"></div>');
        taskTag.select2({
            placeholder: 'Select tag'
        });
    }

    // Favorite star click
    if (favoriteStar.length) {
        $(favoriteStar).on('click', function () {
            $(this).toggleClass('text-warning');
        });
    }

    // Flat Picker
    if (flatPickr.length) {
        flatPickr.flatpickr({
            dateFormat: 'Y-m-d',
            defaultDate: 'today',
            onReady: function (selectedDates, dateStr, instance) {
                if (instance.isMobile) {
                    $(instance.mobileInput).attr('step', null);
                }
            }
        });
    }

    // Todo Description Editor
    if (taskDesc.length) {
        var todoDescEditor = new Quill('#task-desc', {
            bounds: '#task-desc',
            modules: {
                formula: true,
                syntax: true,
                toolbar: '.desc-toolbar'
            },
            placeholder: 'Write Your Description',
            theme: 'snow'
        });
    }

    // On add new item button click, clear sidebar-right field fields
    if (addTaskBtn.length) {
        addTaskBtn.on('click', function (e) {
            addBtn.removeClass('d-none');
            updateBtns.addClass('d-none');
            modalTitle.text('Add Task');
            // newTaskModal.modal('show');
            sidebarLeft.removeClass('show');
            overlay.removeClass('show');
            newTaskModal.find('.new-todo-item-title').val('');
            var quill_editor = taskDesc.find('.ql-editor');
            quill_editor[0].innerHTML = '';
        });
    }

    // Add New ToDo List Item

    // To add new todo form
    if (newTaskForm.length) {
        newTaskForm.validate({
            ignore: '.ql-container *', // ? ignoring quill editor icon click, that was creating console error
            rules: {
                todoTitleAdd: {
                    required: true
                },
                'task-assigned': {
                    required: true
                },
                'task-due-date': {
                    required: true
                }
            }
        });

        newTaskForm.on('submit', function (e) {
            e.preventDefault();
            var isValid = newTaskForm.valid();
            if (isValid) {
                checkboxId++;
                var assignedTo = $('#task-assigned').val(),
                    todoBadge = '',
                    membersImg = {
                        'Phill Buffer': assetPath + 'images/portrait/small/avatar-s-3.jpg',
                        'Chandler Bing': assetPath + 'images/portrait/small/avatar-s-1.jpg',
                        'Ross Geller': assetPath + 'images/portrait/small/avatar-s-4.jpg',
                        'Monica Geller': assetPath + 'images/portrait/small/avatar-s-6.jpg',
                        'Joey Tribbiani': assetPath + 'images/portrait/small/avatar-s-2.jpg',
                        'Rachel Green': assetPath + 'images/portrait/small/avatar-s-11.jpg'
                    };

                var todoTitle = $('.sidebar-todo-modal .new-todo-item-title').val();
                var date = $('.sidebar-todo-modal .task-due-date').val(),
                    selectedDate = new Date(date),
                    month = new Intl.DateTimeFormat('en', { month: 'short' }).format(selectedDate),
                    day = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(selectedDate),
                    todoDate = month + ' ' + day;

                // Badge calculation loop
                var selected = $('.task-tag').val();
                var badgeColor = {
                    Team: 'primary',
                    Low: 'success',
                    Medium: 'warning',
                    High: 'danger',
                    Update: 'info'
                };
                $.each(selected, function (index, value) {
                    todoBadge += '<div class="badge badge-pill badge-light-' + badgeColor[value] + ' mr-50">' + value + '</div>';
                });
                // HTML Output
                if (todoTitle != '') {
                    $(todoTaskList).prepend(
                        '<li class="todo-item">' +
                        '<div class="todo-title-wrapper">' +
                        '<div class="todo-title-area">' +
                        feather.icons['more-vertical'].toSvg({ class: 'drag-icon' }) +
                        '<div class="title-wrapper">' +
                        '<div class="custom-control custom-checkbox">' +
                        '<input type="checkbox" class="custom-control-input" id="customCheck' +
                        checkboxId +
                        '" />' +
                        '<label class="custom-control-label" for="customCheck' +
                        checkboxId +
                        '"></label>' +
                        '</div>' +
                        '<span class="todo-title">' +
                        todoTitle +
                        '</span>' +
                        '</div>' +
                        '</div>' +
                        '<div class="todo-item-action">' +
                        '<div class="badge-wrapper mr-1">' +
                        todoBadge +
                        '</div>' +
                        '<small class="text-nowrap text-muted mr-1">' +
                        todoDate +
                        '</small>' +
                        '<div class="avatar">' +
                        '<img src="' +
                        membersImg[assignedTo] +
                        '" alt="' +
                        assignedTo +
                        '" height="28" width="28">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</li>'
                    );
                }
                toastr['success']('Data Saved', '💾 Task Action!', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });
                $(newTaskModal).modal('hide');
                overlay.removeClass('show');
            }
        });
    }

    // Task checkbox change
    todoTaskListWrapper.on('change', '.custom-checkbox', function (event) {
        var $this = $(this).find('input');
        if ($this.prop('checked')) {
            $this.closest('.todo-item').addClass('completed');
            toastr['success']('Task Completed', 'Congratulations!! 🎉', {
                closeButton: true,
                tapToDismiss: false,
                rtl: isRtl
            });
        } else {
            $this.closest('.todo-item').removeClass('completed');
        }
    });
    todoTaskListWrapper.on('click', '.custom-checkbox', function (event) {
        event.stopPropagation();
    });

    // To open todo list item modal on click of item
    $(document).on('click', '.todo-task-list-wrapper .todo-item', function (e) {
        newTaskModal.modal('show');
        addBtn.addClass('d-none');
        updateBtns.removeClass('d-none');
        if ($(this).hasClass('completed')) {
            modalTitle.html(
                '<button type="button" class="btn btn-sm btn-outline-success complete-todo-item waves-effect waves-float waves-light" data-dismiss="modal">Completed</button>'
            );
        } else {
            modalTitle.html(
                '<button type="button" class="btn btn-sm btn-outline-secondary complete-todo-item waves-effect waves-float waves-light" data-dismiss="modal">Mark Complete</button>'
            );
        }
        taskTag.val('').trigger('change');
        var quill_editor = $('#task-desc .ql-editor'); // ? Dummy data as not connected with API or anything else
        quill_editor[0].innerHTML =
            'Chocolate cake topping bonbon jujubes donut sweet wafer. Marzipan gingerbread powder brownie bear claw. Chocolate bonbon sesame snaps jelly caramels oat cake.';
        taskTitle = $(this).find('.todo-title');
        var $title = $(this).find('.todo-title').html();

        // apply all variable values to fields
        newTaskForm.find('.new-todo-item-title').val($title);
    });

    // Updating Data Values to Fields
    if (updateTodoItem.length) {
        updateTodoItem.on('click', function (e) {
            var isValid = newTaskForm.valid();
            e.preventDefault();
            if (isValid) {
                var $edit_title = newTaskForm.find('.new-todo-item-title').val();
                $(taskTitle).text($edit_title);

                toastr['success']('Data Saved', '💾 Task Action!', {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                });
                $(newTaskModal).modal('hide');
            }
        });
    }

    // Sort Ascending
    if (sortAsc.length) {
        sortAsc.on('click', function () {
            todoTaskListWrapper
                .find('li')
                .sort(function (a, b) {
                    return $(b).find('.todo-title').text().toUpperCase() < $(a).find('.todo-title').text().toUpperCase() ? 1 : -1;
                })
                .appendTo(todoTaskList);
        });
    }
    // Sort Descending
    if (sortDesc.length) {
        sortDesc.on('click', function () {
            todoTaskListWrapper
                .find('li')
                .sort(function (a, b) {
                    return $(b).find('.todo-title').text().toUpperCase() > $(a).find('.todo-title').text().toUpperCase() ? 1 : -1;
                })
                .appendTo(todoTaskList);
        });
    }

    // Filter task
    if (todoFilter.length) {
        todoFilter.on('keyup', function () {
            var value = $(this).val().toLowerCase();
            if (value !== '') {
                $('.todo-item').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
                var tbl_row = $('.todo-item:visible').length; //here tbl_test is table name

                //Check if table has row or not
                if (tbl_row == 0) {
                    if (!$(noResults).hasClass('show')) {
                        $(noResults).addClass('show');
                    }
                } else {
                    $(noResults).removeClass('show');
                }
            } else {
                // If filter box is empty
                $('.todo-item').show();
                if ($(noResults).hasClass('show')) {
                    $(noResults).removeClass('show');
                }
            }
        });
    }

    // For chat sidebar on small screen
    if ($(window).width() > 992) {
        if (overlay.hasClass('show')) {
            overlay.removeClass('show');
        }
    }
});

$(window).on('resize', function () {
    // remove show classes from sidebar and overlay if size is > 992
    if ($(window).width() > 992) {
        if ($('.body-content-overlay').hasClass('show')) {
            $('.sidebar-left').removeClass('show');
            $('.body-content-overlay').removeClass('show');
            $('.sidebar-todo-modal').modal('hide');
        }
    }
});

function initRequest(defineId,status){
    todoTaskList.empty();
    $.ajax({
        url: baseHome + "/request/getListRequests",
        type: 'post',
        dataType: "json",
        data:{defineId:defineId,status:status},
        success: function (data) {
            console.log(data);
            data.forEach(function (item){
                var html='<li class="todo-item" style="width: 100%">' +
                    '<div class="todo-title-wrapper">' +
                    '<div class="todo-title-area">' +
                    //'<i data-feather="more-vertical" class="drag-icon"></i>' +
                    '<div class="title-wrapper">' +
                    '<div class="custom-control custom-checkbox">' +
                    '<input type="checkbox" class="custom-control-input" id="customCheck'+item.id+'" />' +
                    '<label class="custom-control-label" for="customCheck'+item.id+'"></label>' +
                    '</div>' +
                    '<span class="todo-title">'+item.title+'</span>' +
                    '</div>' +
                    '</div>' +
                    '<div class="todo-item-action">' +
                    '<div class="badge-wrapper mr-1">';
                item.processors.forEach(function (process){
                    var $status='bg-primary'
                    if(process.status==2)
                        $status = 'bg-success';
                    else if(process.status==3)
                        $status = 'bg-danger';
                    html+= '<div class="badge badge-pill '+$status+' text-white" alt="'+process.staffName+'" title="'+process.staffName+'">'+process.stepName+'</div>';
                })
                html+='</div>' +
                    '<small class="text-nowrap text-muted mr-1">'+item.dateTimeCV+'</small>' +
                    '<div class="avatar">' +
                    '<img src="'+baseUrlFile+'/uploads/nhanvien/'+item.staffAvatar+'" ' +
                    'onerror="this.src=\''+baseHome+'/layouts/useravatar.png\'" alt="'+item.staffName+'" height="32" width="32" />' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</li>';

                todoTaskList.append(html);
            })
        },
    });
}

$('#btnUpdate').on('click', function () {
    $('#fmInfo').validate({
        messages: {
            "title": {
                required: "Bạn chưa nhập tiêu đề!",
            },
            "staffId": {
                required: "Bạn chưa chọn nhân viên yêu cầu!",
            },
            "dateTime": {
                required: "Bạn chưa nhập ngày tạo!",
            }
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            var $defineId = $('#defineId').val();
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                dataType: "json",
                success: function (result) {
                    if (result.code == 200) {
                        requestId = result.data.requestId;
                        $('#fmProperties').validate({
                            submitHandler: function (formPro) {
                                var formDataPro = new FormData(formPro);
                                $.ajax({
                                    url: baseHome + '/request/saveProperties?defineId=' + $defineId + '&requestId=' + requestId,
                                    type: 'POST',
                                    data: formDataPro,
                                    async: false,
                                    cache: false,
                                    contentType: false,
                                    enctype: 'multipart/form-data',
                                    processData: false,
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.code == 200) {
                                            initKanban();
                                            $('.modal').modal('hide');
                                            notyfi_success(result.message);
                                        } else
                                            notify_error(result.message);
                                    }
                                });
                            }
                        });
                        $('#fmProperties').submit();
                    } else
                        notify_error(result.message);
                }
            });
            return false;
        }
    });
    $('#fmInfo').submit();
})

$('#btnApprove').on('click', function () {
    Swal.fire({
        title: 'Duyệt đơn',
        html: '<span for="text-note" style="float: left">Vui lòng nhập phản hồi:</span>',
        icon: 'warning',
        input: 'textarea',
        inputAttributes: {
            autocapitalize: 'off',
            id: 'text-note'
        },
        showCancelButton: true,
        confirmButtonText: 'Tôi đồng ý',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false,
    }).then(function (result) {
        if (result.isConfirmed) {
            if (result.value != '') {
                var $defineId = slDefineId.val();
                $.ajax({
                    url: baseHome + "/request/approve",
                    type: 'post',
                    dataType: "json",
                    data: {requestId: requestId, stepId: stepId, defineId: $defineId,note:result.value},
                    success: function (data) {
                        if (data.code == 200) {
                            $('.modal').modal('hide');
                            notyfi_success(data.message);
                            initKanban();
                        } else
                            notify_error(data.message);
                    },
                });

            } else
                swal.fire({
                    title: 'Error',
                    text: "Bạn chưa nhập phản hồi!",
                    icon: 'error',
                });
        }

    });
})
$('#btnRefuse').on('click', function () {
    Swal.fire({
        title: 'Từ chối đơn',
        html: '<span for="text-note" style="float: left">Vui lòng nhập phản hồi:</span>',
        icon: 'warning',
        input: 'textarea',
        inputAttributes: {
            autocapitalize: 'off',
            id: 'text-note'
        },
        showCancelButton: true,
        confirmButtonText: 'Tôi đồng ý',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false,
    }).then(function (result) {
        if (result.isConfirmed) {
            if (result.value != '') {
                $.ajax({
                    url: baseHome + "/request/refuse",
                    type: 'post',
                    dataType: "json",
                    data: {requestId: requestId, stepId: stepId,note:result.value},
                    success: function (data) {
                        if (data.code == 200) {
                            $('.modal').modal('hide');
                            notyfi_success(data.message);
                            initKanban();
                        } else
                            notify_error(data.message);
                    },
                });
            } else
                swal.fire({
                    title: 'Error',
                    text: "Bạn chưa nhập phản hồi!",
                    icon: 'error',
                });
        }
    });
})

$('#btnDel').on('click', function () {
    Swal.fire({
        title: 'Xóa yêu cầu',
        text: "Bạn có chắc chắn muốn xóa yêu cầu này!",
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
            $.ajax({
                url: baseHome + "/request/del",
                type: 'post',
                dataType: "json",
                data: {requestId: requestId, stepId: stepId},
                success: function (data) {
                    if (data.code == 200) {
                        $('.modal').modal('hide');
                        notyfi_success(data.message);
                        initKanban();
                    } else
                        notify_error(data.message);
                },
            });
        }
    });
})
