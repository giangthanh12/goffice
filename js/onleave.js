"use strict";

$(function () {
  var
    flatPickr = $(".task-due-date"),
    newTaskModal = $(".sidebar-todo-modal"),
    newTaskForm = $("#form-modal-todo"),
    favoriteStar = $(".todo-item-favorite"),
    modalTitle = $(".modal-title"),
    addBtn = $(".add-todo-item"),
    addTaskBtn = $(".add-task button"),
    updateBtns = $(".update-btn"),
    taskDesc = $("#task-desc"),
    taskAssignSelect = $("#staffId"), // trong form
    taskTag = $("#task-tag"),
    overlay = $(".body-content-overlay"),
    menuToggle = $(".menu-toggle"),
    sidebarToggle = $(".sidebar-toggle"),
    sidebarLeft = $(".sidebar-left"),
    sidebarMenuList = $(".sidebar-menu-list"),
    todoFilter = $("#todo-search"),
    todoTaskListWrapper = $(".todo-task-list-wrapper"),
    listItemFilter = $(".list-group-filters"),
    noResults = $(".no-results");

  // list_to_do();
  // load_select(
  //   $("#level"),
  //   baseHome + "/project/getLevelProject",
  //   "Cấp độ dự án"
  // );
  // load_select(
  //   $("#status"),
  //   baseHome + "/project/getStatusProject",
  //   "Trạng thái dự án"
  // );

  // $("#level").change(function () {
  //   changeColorLevel();
  // });
  // $("#status").change(function () {
  //   changeColorStatus();
  // });
  // biến đổi màu cho select
  // function changeColorLevel() {
  //   var style = $("option:selected", levelProject).attr("style");
  //   $(levelProject).attr("style", `${style}`);
  // }
  // function changeColorStatus() {
  //   var style = $("option:selected", statusProject).attr("style");
  //   $(statusProject).attr("style", `${style}`);
  // }

  // if it is not touch device
  if (!$.app.menu.is_touch_device()) {
    if (sidebarMenuList.length > 0) {
      var sidebarListScrollbar = new PerfectScrollbar(sidebarMenuList[0], {
        theme: "dark",
      });
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
  // if (favoriteStar.length) {
  //   $(favoriteStar).on("click", function () {
  //     $(this).toggleClass("text-warning");
  //   });
  // }

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
      placeholder: "",
      theme: "snow",
    });
  }

  // On add new item button click, clear sidebar-right field fields
  if (addTaskBtn.length) {
    addTaskBtn.on("click", function (e) {
      $("#updateRequest").removeClass("d-none");
      $("#refuseRequest").addClass("d-none");
      $("#onLeave").addClass("d-none");
      sidebarLeft.removeClass("show");
      overlay.removeClass("show");
      newTaskModal.find(".new-todo-item-title").val("");
      var quill_editor = taskDesc.find(".ql-editor p");
      quill_editor.html("");
      $("#id").val(); // them du an mac dinh id = 0
      $("#task-due-date").val("DD-MM-YYYY");
      load_select2(
        taskAssignSelect,
        baseHome + "/onleave/getStaff",
        "Người làm đơn"
      );
      load_select2($("#staffId"), baseHome + "/onleave/getStaff", "");
      $("#staffId").val([]).change();
    });
  }
  // Add New ToDo List Item

  // To add new todo form
  if (newTaskForm.length) {
    newTaskForm.validate({
      ignore: ".ql-container *", // ? ignoring quill editor icon click, that was creating console error
      rules: {
        date: {
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
        var id = $("#id").val();
        var staffId = $("#staffId").val();
        var type = $("#type").val();
        var description = $("#task-desc").find(".ql-editor p").html();
        var date = $(".sidebar-todo-modal .task-due-date").val();
        var shift = $("#shift").val();
        var status = 1;

        $.ajax({
          type: "POST",
          dataType: "json",
          data: {
            id: id,
            staffId: staffId,
            type: type,
            description: description,
            shift: shift,
            date: date,
            status: status,
          },
          url: baseHome + "/onleave/update",
          success: function (data) {
            if (data.success == true) {
              notyfi_success(data.msg);
              $("#todo-task-list").load(
                window.location.href + " #todo-task-list"
              );
            } else {
              notify_error(data.msg);
              $("#form-modal-todo").trigger("reset");
              return false;
            }
          },
        });
      }

      $(newTaskModal).modal("hide");
      overlay.removeClass("show");


      todoTaskListWrapper.on("click", ".custom-checkbox", function (event) {
        event.stopPropagation();
      });

      // To open todo list item modal on click of item

      $(document).on(
        "click",
        ".todo-task-list-wrapper .todo-item",
        function (e) {
          var validator = $("#form-modal-todo").validate(); // reset form
          validator.resetForm();
          newTaskModal.modal("show");
          addBtn.removeClass("d-none");
          $("#refuseRequest").removeClass("d-none");
          $("#onLeave").removeClass("d-none");
          if ($(this).hasClass("completed")) {
            modalTitle.html(
              '<button type="button" class="btn btn-sm btn-outline-success complete-todo-item waves-effect waves-float waves-light" data-dismiss="modal">Completed</button>'
            );
          } else {
            modalTitle.html("Đơn xin nghỉ phép");
          }
          var id = $(this).data("id");
          $.ajax({
            type: "GET",
            dataType: "json",
            data: { id: id },
            url: baseHome + "/onleave/getitem",
            success: function (obj) {
              newTaskForm.find(".new-todo-item-title").val(obj.name);
              var quill_editor = $("#task-desc .ql-editor p");
              quill_editor.html(obj.description);
              $("#task-due-date").val(obj.date);
              $("#id").val(obj.id);
              $("#type").val(obj.type).change();
              load_select2(
                $("#staffId"),
                baseHome + "/onleave/getStaff",
                "Người làm đơn"
              );
              load_select2($("#staffId"), baseHome + "/onleave/getStaff", "");
              $("#staffId").val(obj.staffId).change();
              // console.log(obj.status);
              if (obj.status == 0 || obj.status == 2) {
                $("#updateRequest").addClass("d-none");
                $("#refuseRequest").addClass("d-none");
              } else if (obj.status == 1) {
                $("#updateRequest").removeClass("d-none");
                $("#refuseRequest").removeClass("d-none");
              }
              // Thêm phần hiện số ngày nghỉ tại đây
            },
          });
          // Task Tags
          if (taskTag.length) {
            taskTag.wrap('<div class="position-relative"></div>');
            taskTag.select2({
              placeholder: "Select tag",
            });
          }

          var staffId = $(".todo-title").data("staff");
          $.ajax({
            type: "GET",
            dataType: "json",
            data: { staffId: staffId },
            url: baseHome + "/onleave/getDayOnLeave",
            success: function (data) {
              $("input#onLeaveOwn").val(data.onLeaveOwn);
              $("input#onLeaveUsed").val(data.onLeaveUsed);
            },
          });
        },
      )
      // Todo Description Editor



      if (taskDesc.length) {
        var todoDescEditor = new Quill("#task-desc", {
          bounds: "#task-desc",
          modules: {
            formula: true,
            syntax: true,
            toolbar: ".desc-toolbar",
          },
          placeholder: "",
          theme: "snow",
        });
      }

      // On add new item button click, clear sidebar-right field fields
      if (addTaskBtn.length) {
        addTaskBtn.on("click", function (e) {
          addBtn.removeClass("d-none");
          updateBtns.addClass("d-none");
          $("#onLeave").addClass("d-none");
          // newTaskModal.modal('show');
          sidebarLeft.removeClass("show");
          overlay.removeClass("show");
          newTaskModal.find(".new-todo-item-title").val("");
          var quill_editor = taskDesc.find(".ql-editor p");
          quill_editor.html("");
          $("#id").val(0); // them du an mac dinh id = 0
          $("#task-due-date").val("DD-MM-YYYY");
          load_select2(
            taskAssignSelect,
            baseHome + "/onleave/getStaff",
            "Người làm đơn"
          );
          load_select2($("#staffId"), baseHome + "/onleave/getStaff", "");
          $("#staffId").val([]).change();
          if (funAdd == 1) {
            $("#updateProject").attr("style", "display:inline-block");
          }
        });
      }
      // Add New ToDo List Item

      // To add new todo form
      if (newTaskForm.length) {
        newTaskForm.validate({
          ignore: ".ql-container *", // ? ignoring quill editor icon click, that was creating console error
          rules: {
            date: {
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
            var id = $("#id").val();
            var staffId = $("#staffId").val();
            var type = $("#type").val();
            var description = $("#task-desc").find(".ql-editor p").html();
            var date = $(".sidebar-todo-modal .task-due-date").val();
            var shift = $("#shift").val();
            var status = 1;

            // var name = $("#name").val();
            // var managerId = $("#managerId").val();
            // var memberId = $("#staffId").val();
            // var process = $("#process").val();
            // var date = $(".sidebar-todo-modal .task-due-date").val();
            // var description = taskDesc.find(".ql-editor p").html();
            // var status = $("#status").val();
            // var level = $("#level").val();
            // var id = $("#id").val();

            $.ajax({
              type: "POST",
              dataType: "json",
              data: {
                id: id,
                staffId: staffId,
                type: type,
                description: description,
                shift: shift,
                date: date,
                status: status,
              },
              url: baseHome + "/onleave/update",
              success: function (data) {
                if (data.success == true) {
                  notyfi_success(data.msg);
                  $("#todo-task-list").load(
                    window.location.href + " #todo-task-list"
                  );
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

      $(document).on(
        "click",
        ".todo-task-list-wrapper .todo-item",
        function (e) {
          var validator = $("#form-modal-todo").validate(); // reset form
          validator.resetForm();
          newTaskModal.modal("show");
          addBtn.addClass("d-none");
          updateBtns.removeClass("d-none");
          $("#onLeave").removeClass("d-none");
          $("#updateProject").attr("style", "display:none");
          if (funEdit == 1) {
            $("#updateProject").attr("style", "display:inline-block");
          }
          if ($(this).hasClass("completed")) {
            modalTitle.html(
              '<button type="button" class="btn btn-sm btn-outline-success complete-todo-item waves-effect waves-float waves-light" data-dismiss="modal">Completed</button>'
            );
          } else {
            modalTitle.html("Đơn xin nghỉ phép");
          }
          var id = $(this).data("id");
          $.ajax({
            type: "GET",
            dataType: "json",
            data: { id: id },
            url: baseHome + "/onleave/getitem",
            success: function (obj) {
              newTaskForm.find(".new-todo-item-title").val(obj.name);
              var quill_editor = $("#task-desc .ql-editor p");
              quill_editor.html(obj.description);
              $("#task-due-date").val(obj.date);
              $("#id").val(obj.id);
              $("#type").val(obj.type).change();
              load_select2(
                $("#staffId"),
                baseHome + "/onleave/getStaff",
                "Người làm đơn"
              );
              load_select2($("#staffId"), baseHome + "/onleave/getStaff", "");
              $("#staffId").val(obj.staffId).change();
              // console.log(obj.status);
              if (obj.status == 0 || obj.status == 2) {
                $("#updateProject").attr("style", "display:none");
                $("#delProject").addClass("d-none");
              }
              // Thêm phần hiện số ngày nghỉ tại đây

            },
          });

          var staffId = $(".todo-title").data("staff");
          // console.log(staffId);
          $.ajax({
            type: "GET",
            dataType: "json",
            data: { staffId: staffId },
            url: baseHome + "/onleave/getDayOnLeave",
            success: function (data) {
              $("#onLeaveOwn").val(data.onLeaveOwn);
              $("#onLeaveUsed").val(data.onLeaveUsed);
            },
          });
        }
      );

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
  }


  // load nhân viên
  function load_select2(select2, url, place) {
    $.ajax({
      type: "GET",
      dataType: "json",
      async: false,
      url: url,
      success: function (data) {
        var html = "";
        if (place != "")
          html =
            '<option value="" disabled selected hidden>' + place + "</option>";
        data.forEach(function (element, index) {
          if (element.selected == true) var select = "selected";
          html += `<option data-img="${element.avatar}" ${select} value="${element.id}">${element.name}</option> `;
        });

        select2.html(html);
      },
    });
  }

  // function listStatus(status) {
  //     // $('#projectId').val(-1);
  //     // proId = -1;
  //     var taskStatus = status;
  //     loadTaskList(taskStatus);
  // }

  // function loadTaskList(status) {
  //     $("#todo-task-list").load(
  //         window.location.href +
  //         "?status=" +
  //         status +
  //         " #todo-task-list"
  //     );
  // }

  // function load_select(selectId, url, place) {
  //     $.ajax({
  //         type: "GET",
  //         dataType: "json",
  //         async: false,
  //         url: url,
  //         success: function (data) {
  //             var html =
  //                 '<option value="" disabled selected hidden>' + place + "</option>";
  //             data.forEach(function (element, index) {
  //                 html += `<option data-style="${element.color}"  value="${element.id}">${element.text}</option>`;
  //                 console.log(element.text);
  //             });

  //             selectId.html(html);
  //             //test

  //             if (selectId.length) {
  //                 function renderBullets(option) {
  //                     if (!option.id) {
  //                         return option.text;
  //                     }
  //                     var style = $(option.element).data("style");
  //                     var $bullet = `<span style="color:${style}; font-weight:600;">${option.text}</span>`;
  //                     return $bullet;
  //                 }

  //                 selectId.wrap('<div class="position-relative"></div>').select2({
  //                     placeholder: place,
  //                     // dropdownParent: selectCongSang.parent(),
  //                     templateResult: renderBullets,
  //                     templateSelection: renderBullets,
  //                     minimumResultsForSearch: -1,
  //                     escapeMarkup: function (es) {
  //                         return es;
  //                     },
  //                 });
  //             }
  //         },
  //     });
  // }

  // lấy dự án
  // function list_to_do() {
  //   $.ajax({
  //     type: "GET",
  //     dataType: "json",
  //     async: false,
  //     // data: { status: status },
  //     url: baseHome + "/onleave/getdata",
  //     success: function (data) {
  //         // var mailread = "";
  //         var html = "";
  //         var color = "";

  //         data.forEach(function (element, index) {
  //           if(element.status == "1") {
  //             element.status = "Đang chờ duyệt";
  //             color = "#7367F0";
  //           }
  //           else if(element.status == "2") {
  //             element.status = "Đã duyệt";
  //             color = "#28C76F";
  //           }
  //           else if (element.status == "0") {
  //             element.status = "Từ chối";
  //             color = "#FF4500";
  //           }
  //           var img = baseHome + "/users/gemstech/" + element.avatar;
  //           html +=
  //             '<li class="todo-item"><div class="todo-title-wrapper"><div class="todo-title-area">';
  //           html +=
  //             '<i data-feather="more-vertical" class="drag-icon"></i><div class="title-wrapper">';
  //           html +=
  //             '<img style="border-radius: 50%;" onerror=' +
  //             "this.src='https://velo.vn/goffice-test/layouts/useravatar.png'" +
  //             ' src="' +
  //             img +
  //             '" alt="" height="32" width="32" /><span class="todo-title" id="' +
  //             element.id +
  //             '">' +
  //             element.staffName +
  //             "</span>&nbsp;";
  //           html +=
  //             '</div></div><div class="todo-item-action"><div class="badge-wrapper mr-1">';
  //           html +=
  //             '<div class="badge" id="status" style="width: 120px; margin-right: 0.5rem; background-color: rgb(247, 244, 244);color: '+ color +''+
  //             '">' +
  //             element.status +
  //             "</div>";
  //           html += `<small style="width: 70px;" class="text-nowrap text-muted mr-1">${element.date}</small>`;

  //           html += "";
  //           html += "</div></li>";
  //         });
  //       $("#todo-task-list").html(html);
  //     },
  //   });
  // }

  // lọc cấp độ
  // function filter(classname) {
  //   let filter = [];
  //   $("." + classname + ":checked").each(function (index, input) {
  //     filter.push(input.getAttribute("data-value"));
  //   });
  //   return filter;
  // }
  // load list-group-labels
  // function load_level_project() {
  //   $.ajax({
  //     type: "GET",
  //     dataType: "json",
  //     async: false,
  //     url: baseHome + "/project/getLevelProject",
  //     success: function (data) {
  //       var html = "";
  //       data.forEach(function (element, index) {
  //         html += `<div class="custom-control  custom-checkbox mb-1">
  //                                 <input  type="checkbox" class="custom-control-input input-filter" id="${element.id}" data-value="${element.id}" checked="">
  //                                 <label style="font-weight:600;" class="custom-control-label" for="${element.id}">${element.text}</label>
  //                             </div>`;
  //       });

  //       $(".list-group-labels").html(html);
  //     },
  //   });
  // }
  // load_level_project();
  // end list-group-labels

  //list-group-filters
  // function load_status_project() {
  //   $.ajax({
  //     type: "GET",
  //     dataType: "json",
  //     async: false,
  //     url: baseHome + "/onleave/getStatusProject",
  //     success: function (data) {
  //       var html = "";
  //       data.forEach(function (element, index) {
  //         html += `<a onclick="filterStatus(this)" href="javascript:void(0)" data-status="${element.id}" class="list-group-item list-group-item-action status-project">
  //                <i style="color:${element.color}" data-feather="star" class="font-medium-3 mr-50"></i> <span style="color:${element.color}" class="align-middle">${element.text}</span>
  //                         </a>`;
  //       });
  //       $(".list-group-filters").html(html);
  //     },
  //   });
  // }
  // load_status_project();
  // var status;
  // function filterStatus(element) {
  //   status = element.getAttribute("data-status");
  //   filterProject(status);
  //   // list_to_do(status);
  // }

  // $(".input-filter").on("click", function () {
  //   filterProject(status);
  // });

  // filter status and level
  // function filterProject(status) {
  //   var filters = filter("input-filter");

  //   $.ajax({
  //     type: "GET",
  //     dataType: "json",
  //     async: false,
  //     data: { status: status, filters: filters },
  //     url: baseHome + "/onleave/filter",
  //     success: function (data) {
  //       var html = "";
  //       data.forEach(function (element, index) {
  //         var img = element.avatar
  //           ? baseHome + "/users/gemstech/" + element.avatar
  //           : baseHome + "/users/gemstech/uploads/useravatar.png";
  //         html +=
  //           '<li class="todo-item"><div class="todo-title-wrapper"><div class="todo-title-area">';
  //         html +=
  //           '<i data-feather="more-vertical" class="drag-icon"></i><div class="title-wrapper">';
  //         html +=
  //           '<img style="border-radius: 50%;" src="' +
  //           img +
  //           '" alt="" height="32" width="32" /><span class="todo-title" id="' +
  //           element.id +
  //           '">' +
  //           element.name +
  //           "</span>&nbsp;";
  //         html +=
  //           '</div></div><div class="todo-item-action"><div class="badge-wrapper mr-1">';
  //         html += `<div class="progress" style="height: 16px; width: 100px; margin-top: 5px; margin-right: 70px; font-size: 8px;">
  //                             <div class="progress-bar" role="progressbar" aria-valuenow="${element.process}" aria-valuemin="${element.process}" aria-valuemax="100" style="width: ${element.process}%; background:${element.colorStatus};">
  //                             ${element.process}%
  //                             </div>
  //                         </div>`;
  //         html +=
  //           '<div class="badge" style="width: 100px; margin-right: 0.5rem; background-color: rgb(247, 244, 244); color: ' +
  //           element.colorLevel +
  //           '">' +
  //           element.nameLevel +
  //           "</div>";
  //         html += `<small style="width: 70px;" class="text-nowrap text-muted mr-1">${element.deadline}</small>`;
  //         html += "";
  //         html += "</div></li>";
  //       });
  //       $("#todo-task-list").html(html);
  //     },
  //   });
  // }

  function del() {
    var id = $(".todo-item").data("id");
    Swal.fire({
      title: "Từ chối",
      text: "Bạn có chắc chắn muốn từ chối!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Tôi đồng ý",
      customClass: {
        confirmButton: "btn btn-primary",
        cancelButton: "btn btn-outline-danger ml-1",
      },
      buttonsStyling: false,
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          url: baseHome + "/onleave/del",
          type: "post",
          dataType: "json",
          data: { id: id },
          success: function (data) {
            if (data.success) {
              notyfi_success(data.msg);
              $("#todo-task-list").load(
                window.location.href + " #todo-task-list"
              );
            } else notify_error(data.msg);
          },
        });
      }
    })
  }
})
