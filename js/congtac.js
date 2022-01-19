var url = "";
$(function () {
  "use strict";
  return_combobox_multi('#branchId', baseHome + '/congtac/getBranch', 'Chọn Chi nhánh');
  return_combobox_multi('#departmentId', baseHome + '/congtac/getDepartment', 'Chọn Phòng ban');
  return_combobox_multi('#positionId', baseHome + '/congtac/getPosition', 'Chọn Vị trí');
  return_combobox_multi('#workplaceId', baseHome + '/congtac/getWorkplace', 'Chọn Địa điểm làm việc');

  
  var dtUserTable = $("#contract-table"),
    form = $("#dg"),
    flatPickr = $(".task-due-date"),
    workplaceId = $("#workplaceId"),
    positionId = $("#positionId"),
    branchId = $("#branchId"),
    departmentId = $("#departmentId"),
    startDate = $("#startDate"),
    stopDate = $("#stopDate"),
    basicSalary = $("#salary"),
    allowance = $("#allowance");
    
  //  departmentName = $("#departmentName");
    function assignTask(option) {
      if (!option.id) {
        return option.text;
      }
      var $person =
        '<div class="media align-items-center">' +
        "<img onerror=\"this.src='" +
        baseHome +
        '/layouts/useravatar.png\'" class="d-block rounded-circle mr-50" src="' +
        $(option.element).data("img") +
        '" height="26" width="26" alt="' +
        option.text +
        '">' +
        '<div class="media-body"><p class="mb-0">' +
        option.text +
        "</p></div></div>";

      return $person;
    }

    // Chọn nhân viên để hiển thị Công tác

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

  // $.ajax({
  //   type: "GET",
  //   dataType: "json",
  //   async: false,
  //   url: baseHome + "/common/listStaff",
  //   success: function (data) {
  //     $("#staffId").select2({
  //       data: data,
  //     });
  //   },
  // });

  // $.ajax({
  //   type: "GET",
  //   dataType: "json",
  //   async: false,
  //   url: baseHome + "/common/listGroup",
  //   success: function (data) {
  //     $("#groupId").select2({
  //       data: data,
  //     });
  //   },
  // });
  // Users List datatable
  if (dtUserTable.length) {
    dtUserTable.DataTable({
      ajax: baseHome + "/congtac/getAllData",
      dataType: "json",
      contentType: "json",
      columns: [
        // columns according to JSON
        { data: "id" },
        { data: "name" },
        { data: "staffName" },
        { data: "positionName" },
        { data: "departmentName" },
        { data: "branchName" },
      //  { data: "" },
      ],
      columnDefs: [
        {
          targets: 0,
          visible: false,
        },
      ],
      dom:
        '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
        '<"col-lg-12 col-xl-6" l>' +
        '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
        ">t" +
        '<"d-flex justify-content-between mx-2 row mb-1"' +
        '<"2 col-md-6"i>' +
        '<"2 col-md-6"p>' +
        ">",
      // Buttons with Dropdown
      buttons: [
        // {
        //   text: "Thêm mới",
        //   className: "add-new btn btn-primary mt-50 hidden",
        //   init: function (api, node, config) {
        //     $(node).removeClass("btn-secondary");
        //   },
        //   action: function (e, dt, node, config) {
        //     $("#updateinfo").modal("show");
        //     $("#staffId").val("").change();
        //     $("#groupId").val("").change();
        //     $(".modal-title").html("Thêm Hợp dồng mới");
        //     $("#username").val("");
        //     $("#password").val("");
        //     url = baseHome + "/listusers/add";
        //   },
        // },
      ],
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: "&nbsp;",
          next: "&nbsp;",
        },
        sLengthMenu: "Show _MENU_",
        search: "Search",
        searchPlaceholder: "Từ khóa ...",
      },
      initComplete: function () {
        // Adding role filter once table initialized
      },
    });
  }

  

  // Form Validation
  if (form.length) {
    form.validate({
      errorClass: "error",
      rules: {
        "user-fullname": {
          required: true,
        },
        "user-name": {
          required: true,
        },
        "user-email": {
          required: true,
        },
      },
    });

    form.on("submit", function (e) {
      var isValid = form.valid();
      e.preventDefault();
      if (isValid) {
        modal1.modal("hide");
      }
    });
  }

  // To initialize tooltip with body container
  $("body").tooltip({
    selector: '[data-toggle="tooltip"]',
    container: "body",
  });
});

// function getData(id) {
//   $("#updateinfo").modal("show");
//   $(".modal-title").html("Sửa thông tin user");
//   $.ajax({
//     type: "POST",
//     dataType: "json",
//     data: { id: id },
//     url: baseHome + "/listusers/loadDataById",
//     success: function (data) {
//       $("#username").val(data.username);
//       $("#staffId").val(data.staffId).change();
//       $("#groupId").val(data.groupId).change();
//       $("#password").val("");
//       url = baseHome + "/listusers/update?id=" + id;
//     },
//     error: function () {
//       notify_error("Lỗi truy xuất database");
//     },
//   });
// }
// function save() {
  // var info = {};
  // info.username = $("#username").val();
  // info.staffId = $("#staffId").val();
  // info.groupId = $("#groupId").val();
  // info.password = $("#password").val();
  // $.ajax({
  //     type: "POST",
  //     dataType: "json",
  //     data: info,
  //     url: url,
  //     success: function (data) {
  //         if (data.code==200) {
  //             notyfi_success(data.message);
  //             $('#updateinfo').modal('hide');
  //             $(".user-list-table").DataTable().ajax.reload(null, false);
  //         }
  //         else
  //             notify_error(data.message);
  //     },
  //     error: function () {
  //         notify_error('Cập nhật không thành công');
  //     }
  // });
//   $("#fm").validate({
//     submitHandler: function (form) {
//       var formData = new FormData(form);
//       $.ajax({
//         url: url,
//         type: "POST",
//         data: formData,
//         async: false,
//         cache: false,
//         contentType: false,
//         enctype: "multipart/form-data",
//         processData: false,
//         dataType: "json",
//         success: function (data) {
//           if (data.code == 200) {
//             notyfi_success(data.message);
//             $("#updateinfo").modal("hide");
//             $(".user-list-table").DataTable().ajax.reload(null, false);
//           } else notify_error(data.message);
//         },
//       });
//       return false;
//     },
//   });
//   $("#fm").submit();
// }

// function saveGroupRole() {
//   var info = {};
//   info.name = $("#name").val();
//   $.ajax({
//     type: "POST",
//     dataType: "json",
//     data: info,
//     url: url,
//     success: function (data) {
//       if (data.success) {
//         notyfi_success(data.msg);
//         $("#updateinfo").modal("hide");
//         $(".user-list-table").DataTable().ajax.reload(null, false);
//       } else notify_error(data.msg);
//     },
//     error: function () {
//       if (data.msg) notyfi_success(data.msg);
//       else notify_error("Cập nhật không thành công");
//     },
//   });
// }

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
        html += `<option data-img="${element.hinh_anh}" ${select} value="${element.id}">${element.name}</option> `;
      });

      select2.html(html);
    },
  });
}

function load_select(selectId, url, place) {
  $.ajax({
    type: "GET",
    dataType: "json",
    async: false,
    url: url,
    success: function (data) {
      var html =
        '<option value="" disabled selected hidden>' + place + "</option>";
      data.forEach(function (element, index) {
        html += `<option data-style="${element.color}"  value="${element.id}">${element.text}</option>`;
        console.log(element.text);
      });

      selectId.html(html);
      //test

      if (selectId.length) {
        function renderBullets(option) {
          if (!option.id) {
            return option.text;
          }
          var style = $(option.element).data("style");
          var $bullet = `<span style="color:${style}; font-weight:600;">${option.text}</span>`;
          return $bullet;
        }

        selectId.wrap('<div class="position-relative"></div>').select2({
          placeholder: place,
          // dropdownParent: selectCongSang.parent(),
          templateResult: renderBullets,
          templateSelection: renderBullets,
          minimumResultsForSearch: -1,
          escapeMarkup: function (es) {
            return es;
          },
        });
      }
    },
  });
}

function setJob(id) {
  $("#large1").modal("show");
  $("#myModalLabel8").html("Điều chuyển công tác");
  
  $.ajax({
    type: "POST",
    dataType: "json",
    data: { id: id },
    url: baseHome + "/congtac/getContract",
    success: function(data) {
      $("#id").val(data.id);
      $("#name").val(data.name);
      $("#type option[value=" + data.type + "]")
        .attr("selected", "selected")
        .change();
      $('#salary').val(data.basicSalary);
      $("#allowance").val(data.allowance);
      $("#insurance").val(data.insuranceSalary);
      $("#percentage").val(data.salaryPercentage);
      $("#staffId").val(data.staffId);
      $("#workplaceId").val(data.workplaceId).change();
      $("#branchId").val(data.branchId).change();
      $("#departmentId").val(data.departmentId).change();
      $("#positionId").val(data.positionId).change();
      $("#startDate").val(data.startDate);
      $("#stopDate").val(data.stopDate);
      $("#description").val(data.description);
    },
    error: function () {
      notify_error("Lỗi truy xuất database");
    },
  });
}

function update() {
  
  var id = $("#id").val();
    info = {};

  info.name = $("#name").val();
  info.type = $("#type").val();
  info.allowance = $("#allowance").val();
  info.basicSalary = $("#salary").val();
  info.insuranceSalary = $("#insurance").val();
  info.salaryPercentage = $("#percentage").val();
  info.staffId = $("#staffId").val();
  info.workplaceId = $("#workplaceId").val();
  info.branchId = $("#branchId").val();
  info.departmentId = $("#departmentId").val();
  info.positionId = $("#positionId").val();
  info.startDate = $("#startDate").val();
  info.stopDate = $("#stopDate").val();
  info.description = $("#description").val();
  // lấy dữ liệu đưa vào trong object info
  $.ajax({
    type: "POST",
    dataType: "json", // du lieu nhan ve json
    data: info, // dữ liệu gửi tới server
    url: baseHome + "/congtac/update?id=" + id, //update la method cuar class customer ( co param id cos the dung get de lay tren serve)
    success: function (data) {
      if (data.success) {
        notyfi_success(data.msg);
        $(".modal").modal("hide");
        $(".user-list-table").DataTable().ajax.reload(null, false);
      } else notify_error(data.msg);
    },
    error: function () {      
      notify_error("Cập nhật không thành công");
    },
  });
}
  

function deleteContract(id) {
  Swal.fire({
    title: "Quyết định thôi việc",
    text: "Bạn có chắc chắn muốn xóa hợp đồng!",
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
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/congtac/del",
        success: function (data) {
          $("#id").val(data.id);
          
          if (data.code == 200) {
            notyfi_success(data.message);
            $(".user-list-table").DataTable().ajax.reload(null, false);
          } else notify_error(data.message);
        },
      });
    }
  });
}

function getRecordHistory(id) {
  $("#large").modal("show");
  $("#myModalLabel17").html("Lịch sử công tác");

  $.ajax({
    type: "POST",
    dataType: "json",
    data: { id: id },
    url: baseHome + "/congtac/getRecordHistory",
    success: function(data) {
      $("#historyName").val(data.name);

      var html = "";
      html += '<div class="row">';
      html += '<div style="width: 12em;font-weight: 900;">';
      html += '<p>Tên hợp đồng</p>';
      html += '</div>';
      html += '<div style="width: 13em;font-weight: 900;">';
      html +=
        '<p>Thời gian làm việc</p>';
      html += "</div>";
      html += '<div style="width: 10em;font-weight: 900;">';
      html +=
        '<p class=" ">Vị trí công việc</p>';
      html += "</div>";
      html += '<div style="width: 10.5em;font-weight: 900;">';
      html += '<p>Chi nhánh</p>';
      html += "</div>";
      html += '<div style="width: 10em;font-weight: 900;">';
      html += '<p class=" ">Phòng ban</p>';
      html += "</div>";
      html += '<div style="width: 10.5em;font-weight: 900;">';
      html += '<p class=" ">Nơi làm việc</p>';
      html += "</div>";
      html += '<div style="width: 10em;font-weight: 900;">';
      html += '<p class=" ">Mức lương</p>';
      html += "</div>";
      html += '<div style="width: 10em;font-weight: 900;">';
      html += '<p class=" ">Phụ cấp</p>';
      html += "</div>";
      html += "</div>";
      data.forEach(function (value, index) {
        html += '<div class="row">';
        html += '<div style="width: 12em;">';
        html += '<p >' + value.name + '</p>';
        html += '</div>';
        html += '<div style="width: 13em;">';
        html += '<p >' + value.startDate + ' - ' + value.stopDate + '</p>';
        html += '</div>';
         html += '<div style="width: 10em;">';
        html += '<p >' + value.positionName + '</p>';
        html += '</div>';
        html += '<div style="width: 10.5em;">';
        html += '<p >' + value.branchName + '</p>';
        html += '</div>';
        html += '<div style="width: 10em;">';
        html += '<p >' + value.departmentName + '</p>';
        html += '</div>';
        html += '<div style="width: 10.5em;">';
        html += '<p >' + value.workplaceName + '</p>';
        html += '</div>';
        html += '<div style="width: 10em;">';
        html += '<p >' + value.salary + '</p>';
        html += '</div>';
        html += '<div style="width: 10em;">';
        html += '<p >' + value.allowance + '</p>';
        html += '</div>';
        html += '</div>';
      });
      $("#history").html(html);
    },
    error: function () {
      notify_error("Lỗi truy xuất database");
    },
  });
}

// function setFunctionRole(funcId, userId, check) {
//   $.ajax({
//     url: baseHome + "/listusers/setFunctionRole",
//     type: "post",
//     dataType: "json",
//     data: { funcId: funcId, userId: userId, check: check },
//     success: function (data) {},
//   });
// }

// function setMenuRole(menuId, userId, check) {
//   $.ajax({
//     url: baseHome + "/listusers/setMenuRole",
//     type: "post",
//     dataType: "json",
//     data: { menuId: menuId, userId: userId, check: check },
//     success: function (data) {},
//   });
// }
