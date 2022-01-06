

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
        updateBtns = $(".update-btn"),
        taskDesc = $("#task-desc"),
        taskAssignSelect = $("#managerId"), // trong form
        taskTag = $("#task-tag"),
        overlay = $(".body-content-overlay"),
        menuToggle = $(".menu-toggle"),
        sidebarToggle = $(".sidebar-toggle"),
        sidebarLeft = $(".sidebar-left"),
        sidebarMenuList = $(".sidebar-menu-list"),
        todoFilter = $("#todo-search"),
        todoTaskListWrapper = $(".todo-task-list-wrapper"),
        listItemFilter = $(".list-group-filters"),
        noResults = $(".no-results"),
        statusProject = $('#status'),
        levelProject = $('#level'),
        // checkboxId = 100,
        isRtl = $("html").attr("data-textdirection") === "rtl";
    list_to_do();
    load_select($('#level'), baseHome + '/project/getLevelProject','Cấp độ dự án');
    load_select($('#status'), baseHome + '/project/getStatusProject', 'Trạng thái dự án');
    
    
    $('#level').change(function() {
        changeColorLevel();
    })
    $('#status').change(function() {
        changeColorStatus();
    })
    // biến đổi màu cho select
     function changeColorLevel() {
        var style = $('option:selected', levelProject).attr('style');
        $(levelProject).attr('style', `${style}`);
     }
     function changeColorStatus() {
        var style = $('option:selected', statusProject).attr('style');
        $(statusProject).attr('style', `${style}`);
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
            dateFormat: "d-m-Y",
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
            placeholder: "Mô tả dự án",
            theme: "snow",
        });
    }


    // On add new item button click, clear sidebar-right field fields
    if (addTaskBtn.length) {
        addTaskBtn.on("click", function (e) {
            addBtn.removeClass("d-none");
            updateBtns.addClass("d-none");
            modalTitle.text("Thêm dự án");
            // newTaskModal.modal('show');
            sidebarLeft.removeClass("show");
            overlay.removeClass("show");
            newTaskModal.find(".new-todo-item-title").val("");
            var quill_editor = taskDesc.find(".ql-editor p");
            quill_editor.html('');
            $('#customRadio1').attr('checked','true');
            $('#process').val("");
            $('#id').val(0); // them du an mac dinh id = 0
            $('#task-due-date').val('DD-MM-YYYY');
            $('#level').val('').change();
            $('#status').val('').change();
            load_select2(taskAssignSelect, baseHome + "/project/getStaff",'Người quản lý dự án');
            load_select2($('#assigneeId'), baseHome + "/project/getStaff",'');
            $('#assigneeId').val([]).change();
            userFuns.forEach(function(item,value) {
            if (item.function == 'add') {
                $('#updateProject').attr('style','display:inline-block');
            }
        })
            
        });
    }
    // Add New ToDo List Item

    // To add new todo form
    if (newTaskForm.length) {
        newTaskForm.validate({
            ignore: ".ql-container *", // ? ignoring quill editor icon click, that was creating console error
            rules: {
                "name": {
                    required: true,
                },
                "process": {
                    required: true,
                },
                "status": {
                    required: true,
                },
                "level": {
                    required: true,
                },
                "managerId": {
                    required: true,
                },
                "assigneeId": {
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
                var name = $('#name').val();
                var managerId = $("#managerId").val();
                var assigneeId = $('#assigneeId').val();
                var process = $("#process").val();
                var date = $(".sidebar-todo-modal .task-due-date").val();
                var description = taskDesc.find(".ql-editor p").html();
                var status = $("#status").val();
                var level = $("#level").val();
                var id = $("#id").val();

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: { id: id, name: name, assigneeId:assigneeId, managerId: managerId, process: process, level: level, date: date, description: description, status:status },
                    url: baseHome + "/project/update",
                    success: function (data) {
                        if (data.success == true) {
                            notyfi_success(data.msg);
                            list_to_do();
                        } else {
                            notify_error(data.msg);
                            $("#form-modal-todo").trigger("reset");
                            return false;
                        }
                    },
                });

                $(newTaskModal).modal("hide");
                overlay.removeClass("show");
            }
        });
    }

   
    todoTaskListWrapper.on("click", ".custom-checkbox", function (event) {
        event.stopPropagation();
    });

    // To open todo list item modal on click of item

            $(document).on("click", ".todo-task-list-wrapper .todo-item .todo-title", function (e) {

                var validator = $( "#form-modal-todo" ).validate(); // reset form
                validator.resetForm();
                newTaskModal.modal("show");
                addBtn.addClass("d-none");
                updateBtns.removeClass("d-none");
                $('#updateProject').attr('style','display:none');
                 userFuns.forEach(function(item,value) {
                if (item.function == 'loaddata') {
                        $('#updateProject').attr('style','display:inline-block');
                    }
                })
                if ($(this).hasClass("completed")) {
                    modalTitle.html('<button type="button" class="btn btn-sm btn-outline-success complete-todo-item waves-effect waves-float waves-light" data-dismiss="modal">Completed</button>');
                } else {
                  
                    modalTitle.html('Chi tiết dự án');
                }
                var id = this.id;
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    data: {id: id},
                    url: baseHome + "/project/getitem",
                    success: function (obj) {
                        newTaskForm.find(".new-todo-item-title").val(obj.name);
                        var quill_editor = $("#task-desc .ql-editor p");
                        quill_editor.html(obj.description);
                        $('#task-due-date').val(obj.deadline);
                        $('#customRadio'+obj.level).attr('checked','true');
                        $('#id').val(obj.id);
                        $('#status').val(obj.status);
                        $('#level').val(obj.level);
                        $('#process').val(obj.process);
                        load_select2(taskAssignSelect, baseHome + "/project/getStaff",'Người quản lý dự án');
                        load_select2($('#assigneeId'), baseHome + "/project/getStaff",'');
                        $(taskAssignSelect).val(obj.managerId);
                        
                        $('#assigneeId').val(obj.assigneeId);
                        changeColorLevel();
                        changeColorStatus();
                    }
                });
            });
  
    

  
    // Tìm kiếm dự án
    if (todoFilter.length) {
        todoFilter.on("keyup", function () {
            var value = $(this).val().toLowerCase();
            if (value !== "") {
               
                $(".todo-item").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                 
                });
                var tbl_row = $(".todo-item:visible").length; 

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

// load nhân viên
function load_select2(select2, url, place) {
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: url,
        success: function (data) {
           var html ='';
            if(place != '')
            html = '<option value="" disabled selected hidden>'+place+'</option>';
            data.forEach(function (element, index) {
                if (element.selected==true) 
                var select = 'selected';
                html += `<option data-img="${element.hinh_anh}" ${select} value="${element.id}">${element.name}</option> `;
            });
     
            select2.html(html);
      
        },
    });
}

function load_select(selectId,url,place) {
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: url,
        success: function (data) {
            var html = '<option value="" disabled selected hidden>'+place+'</option>';
            data.forEach(function (element, index) {
                html += `<option style="color:${element.color}"  value="${element.id}"><li>${element.text}</li></option>`;
                console.log(element.text);
            });

            selectId.html(html);
        },
    });
}



// lấy dự án
function list_to_do(status = '') {
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        data: {status:status},
        url: baseHome + "/project/getdata",
        success: function (data) {
            var mailread = "";
            var html = "";
            data.forEach(function (element, index) {
                var img = element.avatar ? baseHome + '/users/gemstech/' +element.avatar : baseHome+ '/users/gemstech/uploads/useravatar.png';
                html += '<li class="todo-item"><div class="todo-title-wrapper"><div class="todo-title-area">';
                html += '<i data-feather="more-vertical" class="drag-icon"></i><div class="title-wrapper">';
                html += '<img style="border-radius: 50%;" src="'+  img + '" alt="" height="32" width="32" /><span class="todo-title" id="'+element.id+'">' + element.name + '</span>&nbsp;';
                html += '</div></div><div class="todo-item-action"><div class="badge-wrapper mr-1">';
                html+= `<div class="progress" style="height: 16px; width: 100px; margin-top: 5px; margin-right: 70px; font-size: 8px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="${element.process}" aria-valuemin="${element.process}" aria-valuemax="100" style="width: ${element.process}%; background:${element.colorStatus};">
                            ${element.process}%
                            </div>
                        </div>`;
                html += '<div class="badge" style="width: 100px; margin-right: 0.5rem; background-color: rgb(247, 244, 244); color: '+element.colorLevel+'">'+element.nameLevel+'</div>';
                html += `<small style="width: 70px;" class="text-nowrap text-muted mr-1">${element.deadline}</small>`;
             
                html += '';
                html += "</div></li>";
            });
            $("#todo-task-list").html(html);
        }
    });
}


// lọc cấp độ
function filter(classname) {
    let filter = [];
    $('.'+classname+':checked').each(function(index, input) {
     
        filter.push(input.getAttribute('data-value'));
    });
   return filter;
}
// load list-group-labels
    function load_level_project() {
        $.ajax({
            type: "GET",
            dataType: "json",
            async: false,
            url: baseHome + '/project/getLevelProject',
            success: function (data) {
                var html = "";
                data.forEach(function (element, index) {
                   html+= `<div class="custom-control  custom-checkbox mb-1">
                                <input  type="checkbox" class="custom-control-input input-filter" id="${element.id}" data-value="${element.id}" checked="">
                                <label style="font-weight:600;" class="custom-control-label" for="${element.id}">${element.text}</label>
                            </div>`
                });

                $('.list-group-labels').html(html);
          
            },
        });
    }
    load_level_project() 
// end list-group-labels

//list-group-filters
function load_status_project() {
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + '/project/getStatusProject',
        success: function (data) {
            var html = "";
            data.forEach(function (element, index) {
               html+= `<a onclick="filterStatus(this)" href="javascript:void(0)" data-status="${element.id}" class="list-group-item list-group-item-action status-project">
               <i style="color:${element.color}" data-feather="star" class="font-medium-3 mr-50"></i> <span style="color:${element.color}" class="align-middle">${element.text}</span>
                        </a>`
            });
            $('.list-group-filters').html(html);
        },
    });
}
load_status_project() 
function filterStatus(element) {
   var status = element.getAttribute('data-status');
   console.log(status);
    list_to_do(status);
}

$('.input-filter').on('click', function() {
 
    var filters = filter('input-filter');
    
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        data: {filters:filters},
        url: baseHome + "/project/filterLevel",
        success: function (data) {
            var mailread = "";
            var html = "";
            data.forEach(function (element, index) {
                var img = element.avatar ? baseHome + '/users/gemstech/' +element.avatar : baseHome+ '/users/gemstech/uploads/useravatar.png';
                html += '<li class="todo-item"><div class="todo-title-wrapper"><div class="todo-title-area">';
                html += '<i data-feather="more-vertical" class="drag-icon"></i><div class="title-wrapper">';
                html += '<img style="border-radius: 50%;" src="'+  img + '" alt="" height="32" width="32" /><span class="todo-title" id="'+element.id+'">' + element.name + '</span>&nbsp;';
                html += '</div></div><div class="todo-item-action"><div class="badge-wrapper mr-1">';
                html+= `<div class="progress" style="height: 16px; width: 100px; margin-top: 5px; margin-right: 70px; font-size: 8px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="${element.process}" aria-valuemin="${element.process}" aria-valuemax="100" style="width: ${element.process}%; background:${element.colorStatus};">
                            ${element.process}%
                            </div>
                        </div>`;
                html += '<div class="badge" style="width: 100px; margin-right: 0.5rem; background-color: rgb(247, 244, 244); color: '+element.colorLevel+'">'+element.nameLevel+'</div>';
                html += `<small style="width: 70px;" class="text-nowrap text-muted mr-1">${element.deadline}</small>`;
             
                html += '';
                html += "</div></li>";
            });
            $("#todo-task-list").html(html);
        }
    });
})

function del() {
    var id = $("#id").val();
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
            $.ajax({
                type: "POST",
                dataType: "json",
                data: { id:id},
                url: baseHome + "/project/del",
                success: function (data) {
                    if (data.success == true) {
                        notyfi_success("Cập nhật thành công");
                        list_to_do();
                    } else {
                        notify_error(data.msg);
                        return false;
                    }
                },
            });
        }
    });
}


