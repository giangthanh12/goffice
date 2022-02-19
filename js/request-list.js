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
var url;
var $defineId = '';
console.log('ok');
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
            dateFormat: 'd/m/Y',
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
            // addBtn.removeClass('d-none');
            // updateBtns.addClass('d-none');
            // $('#btnApprove').removeClass('d-none');
            // $('#btnRefuse').removeClass('d-none');
            $('#btnUpdate').removeClass('d-none');
            $('#btnApprove').addClass('d-none');
            $('#btnRefuse').addClass('d-none');
            modalTitle.text('Tạo yêu cầu');
            // newTaskModal.modal('show');
            sidebarLeft.removeClass('show');
            overlay.removeClass('show');
            newTaskModal.find('.new-todo-item-title').val('');
            // var quill_editor = taskDesc.find('.ql-editor');
            // quill_editor[0].innerHTML = '';
            url = baseHome + '/request/addRequest';
            var $defineId = $('#defineId').val();
            $('#defineId').select2({
                placeholder: 'Yêu cầu',
            })
            $('#defineId').val('').change();
            $('#title').val('');
            $('#requestId').val('');
            $('#stepId').val('');
            $('#timelineComment').html('');
        });
    }
    $('#defineId').change(function() {
        var $defineId = $('#defineId').val();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            async: false,
            url: baseHome + '/request/getProperties?defineId=' + $defineId,
            success: function (data) {
                var html = '';
                data.forEach(function (item) {
                    html += '<div class="form-group">' +
                        '<label class="form-label" for="property_' + item.id + '">' + item.name + '</label>' +
                        '<input type="text" id="property_' + item.id + '" name="property_' + item.id + '" class="form-control" placeholder="' + item.name + '" />' +
                        '</div>'
                });
                $('#fmProperties').html(html);
            }
        });
    }) 
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
        var $status = $(this).find('.todo-statusRequest').html();
        newTaskModal.modal('show');
        $('#btnUpdate').addClass('d-none');
        $('#btnDel').addClass('d-none');
        taskTag.val('').trigger('change');
        // taskTitle = $(this).find('.todo-title');
        var $title = $(this).find('.todo-title').html();
        $('#title').val($title);
        var $defineId =  $(this).find('.todo-defineId').html();
        $('#defineId').val($defineId).change();
        $("#defineId").attr("disabled", true);
        var $staffId =  $(this).find('.todo-staffId').html();
        $('#staffId').val($staffId).change();
      var dateTimeRequest =  $(this).find('.datetimeRequest').html();
      $('#dateTime').val(dateTimeRequest);
        var $department =  $(this).find('.todo-departmnetId').html();
        $('#department').val($department).change();
        var $requestId = $(this).find('.todo-idRequest').html();
        $('#requestId').val($requestId);
        var $stepId = $(this).find('.todo-stepId').html();

        var statusStepFirst =  Number($(this).find('.todo-stepFirstStatus').html());
        $('#stepId').val($stepId);
        $('#btnApprove').removeClass('d-none');
        $('#btnRefuse').removeClass('d-none');
        if($status == 2 || $status == 3) {
        $('#btnApprove').addClass('d-none');
        $('#btnRefuse').addClass('d-none');
        }
        // người tạo mới có quyền sửa
        if(statusStepFirst == 1 & $staffId == baseUser) {
            $('#btnUpdate').removeClass('d-none');
            $('#btnDel').removeClass('d-none');
        }
        url = baseHome + '/request/editRequest?id=' + $requestId;
        // load comment form
        $.ajax({
            type: 'GET',
            dataType: 'json',
            async: false,
            url: baseHome + '/request/getComments?requestId=' + $requestId,
            success: function (dataComment) {
                console.log(dataComment);
                $('#timelineComment').html('');
                var html = '';
                dataComment.forEach(function (item) {
                   if(item.status==2)
                      var  colorStatus = 'success';
                    var      statusText='Người duyệt';
                    if(item.status==3)
                    var    colorStatus = 'danger';
                    var    statusText='Người từ chối';

                    html += `<li class="timeline-item">
                        <span class="timeline-point timeline-point-secondary timeline-point-${colorStatus} timeline-point-indicator"></span>
                        <div class="timeline-event">
                            <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                <h6>${item.stepName}</h6>
                            </div>
                            <p>${item.note}</p>
                            <div class="media align-items-center">
                                <div class="avatar">`;
                                html +=    '<img onerror='+"this.src='https://velo.vn/goffice-test/layouts/useravatar.png'"+' src="../../../app-assets/images/avatars/12-small.png" alt="avatar" height="38" width="38" />';
                               html+= `</div>
                                <div class="media-body ml-50">
                                    <h6 class="mb-0">${item.staffName}</h6>
                                    <span>${item.phoneNumber}</span>
                                </div>
                            </div>
                        </div>
                    </li>`;

                });
                $('#timelineComment').html(html);

            }
        });
       // var statusText = ''
                    // if(item.status==2)
                    //     statusText='Người duyệt';
                    // if(item.status==3)
                    //     statusText='Người từ chối';
                    // html+='<div class="media mb-1">' +
                    //     '<div class="avatar bg-light-success my-0 ml-0 mr-50">' +
                    //     renderAvatar(item.avatar, true, 0, item.staffName, 28)+
                    //     '</div>' +
                    //     '<div class="media-body">' +
                    //     '<p class="mb-0"><span class="font-weight-bold " style="color: red">'+item.stepName+'</span></p>' +
                    //     '<p class="mb-0">'+statusText+': <span class="font-weight-bold " style="color: blue">'+item.staffName+'</span>:&nbsp;'+item.note+'</p>' +
                    //     '</div>' +
                    //     '</div>';
      

        $.ajax({
            type: 'POST',
            dataType: 'json',
            async: false,
            url: baseHome + '/request/getDetailRequest?requestId=' + $requestId,
            success: function (data) {
                data.data.forEach(function(item) {
                    $('#property_'+item.objectId).val(item.value);
                })
           
            }
        });
      
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
var defineFilter = 0;
var statusFilter = 0;
function initRequest(defineId,status){
    todoTaskList.empty();
    $.ajax({
        url: baseHome + "/request/getListRequests",
        type: 'post',
        dataType: "json",
        data:{defineId:defineId,status:status},
        success: function (data) {
            data.forEach(function (item){
               var indexStep = item.processors.length-1;
               console.log(item['processors'][0])
                var html='<li class="todo-item" style="width: 100%">' +
                    '<div class="todo-title-wrapper">' +
                    '<div class="todo-title-area">' +
                    '<span class="todo-title">'+item.title+'</span>' +
                    '<span class="d-none todo-defineId">'+item.defineId+'</span>' +
                    '<span class="d-none todo-staffId">'+item.staffId+'</span>' +
                    '<span class="d-none todo-departmnetId">'+item.departmentId+'</span>' +
                    '<span class="d-none todo-idRequest">'+item.id+'</span>' +
                    '<span class="d-none todo-stepId">'+item['processors'][indexStep].stepId+'</span>' +
                    '<span class="d-none todo-stepFirstStatus">'+item['processors'][0].status+'</span>' +
                    '<span class="d-none todo-statusRequest">'+item.status+'</span>' +
                    '</div>' +
                    '</div>' +
                    '<div class="todo-item-action">' +
                    '<div class="badge-wrapper mr-1">';
                item.processors.forEach(function (process){
                    var $status='bg-primary'
                    if(process.status == 2)
                        $status = 'bg-success';
                    else if(process.status==3)
                        $status = 'bg-danger';
                    html+= '<div class="badge badge-pill '+$status+' text-white" alt="'+process.staffName+'" title="'+process.staffName+'">'+process.stepName+'</div>';
                })
                html+='</div>' +
                    '<small class="text-nowrap text-muted datetimeRequest mr-1">'+item.dateTimeCV+'</small>' +
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
            "defineId": {
                required: "Bạn chưa chọn yêu cầu!",
            },
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
            $.ajax({
                url: url,
                async: false,
                cache: false,
                enctype: 'multipart/form-data',
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
               dataType: "json",
                success: function (result) {
                   console.log(result);
                    if (result.code == 200) {
                      
                        var requestId = result.data.requestId;
                        var defineId = $('#defineId').val();
                        console.log(defineId);
                        console.log(requestId);
                        $('#fmProperties').validate({
                            submitHandler: function (formPro) {
                                var formDataPro = new FormData(formPro);
                                $.ajax({
                                    url: baseHome + '/request/saveProperties?defineId=' + defineId + '&requestId=' + requestId,
                                    type: 'POST',
                                    data: formDataPro,
                                    async: false,
                                    cache: false,
                                    contentType: false,
                                    // enctype: 'multipart/form-data',
                                    processData: false,
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.code == 200) {
                                            initRequest(0,0);
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
                var $defineId = $('#defineId').val();
                var requestId = $('#requestId').val();
                var stepId = $('#stepId').val();
                $.ajax({
                    url: baseHome + "/request/approve",
                    type: 'post',
                    dataType: "json",
                    data: {requestId: requestId, stepId: stepId, defineId: $defineId,note:result.value},
                    success: function (data) {
                        if (data.code == 200) {
                            $('.modal').modal('hide');
                            notyfi_success(data.message);
                            initRequest(0,0);
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
                var requestId = $('#requestId').val();
                var stepId = $('#stepId').val();
                $.ajax({
                    url: baseHome + "/request/refuse",
                    type: 'post',
                    dataType: "json",
                    data: {requestId: requestId, stepId: stepId,note:result.value},
                    success: function (data) {
                        if (data.code == 200) {
                            $('.modal').modal('hide');
                            notyfi_success(data.message);
                            initRequest(0,0);
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
            var requestId = $('#requestId').val();
            var stepId = $('#stepId').val();
            $.ajax({
                url: baseHome + "/request/del",
                type: 'post',
                dataType: "json",
                data: {requestId: requestId, stepId: stepId},
                success: function (data) {
                    if (data.code == 200) {
                        $('.modal').modal('hide');
                        notyfi_success(data.message);
                        initRequest(0,0);
                    } else
                        notify_error(data.message);
                },
            });
        }
    });
})

function chooseRequest(defineId) {
    defineFilter = defineId;
    initRequest(defineFilter,statusFilter);
    console.log(defineFilter,statusFilter);
}
function chooseStatus(status) {
    statusFilter = status;
    initRequest(defineFilter,statusFilter);
    console.log(defineFilter,statusFilter);
}
$(document).on('click','.chooseRequest-item',function() {
    console.log(this);
    var $chooseRequestItems = document.querySelectorAll('.chooseRequest-item');
    $chooseRequestItems.forEach(function(item) {
        if(item.classList.contains('colorDefine')) {
            item.classList.remove('colorDefine');
        }
    })
   $(this).addClass('colorDefine');
})