$(function () {
  var dtUserTable = $(".user-list-table"),
    modal = $("#updateinfo"),
    addNewBtn = $(".add-new button"),
    form = $("#dg");
    name = $("#name");
    account = $("#account");
    type = $("#type");
    
    typeObj = {
      0: { title: "", class: "" },
      111 : { title: "Tiền mặt", class: "badge-light-warning" },
      112 : { title: "Ngân hàng", class: "badge-light-success" },
    };

    // classifyObj = {
    //   0: { title: "", class: "" },
    //   1: { title: "Thu", class: "badge-light-success" },
    //   2: { title: "Chi", class: "badge-light-warning" },
    // };



  // datepicker init
//   if (datePicker.length) {
//     datePicker.flatpickr({
//       enableTime: false,
//       dateFormat: "Y-m-d",
//     });
//   }

//   $.ajax({
//     // tải Khách hàng vào select1 customer
//     type: "GET",
//     dataType: "json",
//     async: false,
//     url: baseHome + "/acm/khachhang",
//     success: function (data) {
//       customer.wrap('<div class="position-relative"></div>').select2({
//         dropdownAutoWidth: true,
//         dropdownParent: customer.parent(),
//         width: "100%",
//         data: data,
//       });
//     },
//   });

//   $.ajax({
//     // tải Nhân viên vào select1 staff
//     type: "GET",
//     dataType: "json",
//     async: false,
//     url: baseHome + "/acm/nhanvien",
//     success: function (data) {
//       authorized.wrap('<div class="position-relative"></div>').select2({
//         dropdownAutoWidth: true,
//         dropdownParent: authorized.parent(),
//         width: "100%",
//         data: data,
//       });
//     },
//   });

//   // $.ajax({
//   //   // tải Khách hàng vào select1 customer
//   //   type: "GET",
//   //   dataType: "json",
//   //   async: false,
//   //   url: baseHome + "/acm/contract",
//   //   success: function (data) {
//   //     customer.wrap('<div class="position-relative"></div>').select2({
//   //       dropdownAutoWidth: true,
//   //       dropdownParent: contract.parent(),
//   //       width: "100%",
//   //       data: data,
//   //     });
//   //   },
//   // });

//   $.ajax({
//     // tải Khách hàng vào select1 account
//     type: "GET",
//     dataType: "json",
//     async: false,
//     url: baseHome + "/acm/taikhoan",
//     success: function (data) {
//       account.wrap('<div class="position-relative"></div>').select2({
//         dropdownAutoWidth: true,
//         dropdownParent: account.parent(),
//         width: "100%",
//         data: data,
//       });
//     },
//   });

//   $.ajax({
//     // tải Nhân viên vào select1 staff
//     type: "GET",
//     dataType: "json",
//     async: false,
//     url: baseHome + "/acm/nhanvien",
//     success: function (data) {
//       staff.wrap('<div class="position-relative"></div>').select2({
//         dropdownAutoWidth: true,
//         dropdownParent: staff.parent(),
//         width: "100%",
//         data: data,
//       });
//     },
//   });

//   $.ajax({
//     // tải Nhân viên vào select1 staff
//     type: "GET",
//     dataType: "json",
//     async: false,
//     url: baseHome + "/acm/hopdong",
//     success: function (data) {
//       contract.wrap('<div class="position-relative"></div>').select2({
//         dropdownAutoWidth: true,
//         dropdownParent: contract.parent(),
//         width: "100%",
//         data: data,
//       });
//     },
//   });

  // Users List datatable
  if (dtUserTable.length) {
    dtUserTable.DataTable({
      // ajax: assetPath + "data/user-list.json", // JSON file to add data
      ajax: baseHome + "/accnumber/list",
      ordering: false,
      columns: [
        // columns according to JSON
        // { data: "" },
        { data: "id" },
        { data: "name" },
        { data: "account" },
        { data: "type" },
        { data: "" },
      ],
      columnDefs: [
        {
          // For Responsive
          // className: "control",
          // orderable: false,
          // responsivePriority: 0,
          // targets: 0,
          // render: function (data, type, full, meta) {
          //     return "";
          // }
        },
        {
          // User full name and username
          targets: 3,
          render: function (data, type, full, meta) {
            var $type = full["type"].substr(0, 3);
            return (
              '<span class="badge badge-pill ' +
              typeObj[$type].class +
              '" text-capitalized>' +
              typeObj[$type].title +
              "</span>"
            );
          },
        },
        {
          // Actions
          targets: -1,
          title: feather.icons["database"].toSvg({
            class: "font-medium-3 text-success mr-50",
          }),
          orderable: false,
          render: function (data, type, full, meta) {
            var html = "";
            html +=
              '<div style="width: 80px;"><button type="button" class="btn btn-icon btn-outline-primary waves-effect" data-toggle="modal" data-target="#updateinfo" title="Chỉnh sửa" onclick="loaddata(' +
              full["id"] +
              ')">';
            html += '<i class="fas fa-pencil-alt"></i>';
            html += "</button> &nbsp;";
            html +=
              '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="xoa(' +
              full["id"] +
              ')">';
            html += '<i class="fas fa-trash-alt"></i>';
            html += "</button></div>";
            return html;
          },
        },
      ],
      // order: [[2, "desc"]],
      dom:
        '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
        '<"col-lg-12 col-xl-6" l>' +
        '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
        ">t" +
        '<"d-flex justify-content-between mx-2 row mb-1"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        ">",
      language: {
        sLengthMenu: "Show _MENU_",
        search: "Search",
        searchPlaceholder: "11111111112..",
      },
      // Buttons with Dropdown
      buttons: [
        {
          text: "Thêm mới",
          className: "add-new btn btn-primary mt-50",
          init: function (api, node, config) {
            $(node).removeClass("btn-secondary");
          },
          action: function (e, dt, node, config) {
            $("#updateinfo").modal("show");
            $(".modal-title").html("Thêm Tài khoản mới");
            // $("#btn_add").attr("disabled", true);
            $("#dg").trigger("reset");
            // url = baseHome + "/acm/add";
          },
        },
        // {
        //   text: "Chốt số dư",
        //   className: "update_sodu btn btn-primary mt-50",
        //   init: function (api, node, config) {
        //     $(node).removeClass("btn-secondary");
        //   },
        //   action: function (e, dt, node, config) {
        //     chot_so_du();
        //   },
        // },
      ],
      // For responsive popup
      // responsive: {
      //     details: {
      //         display: $.fn.dataTable.Responsive.display.modal({
      //             header: function (row) {
      //                 var data = row.data();
      //                 return "Details of " + data["name"];
      //             },
      //         }),
      //         type: "column",
      //         renderer: $.fn.dataTable.Responsive.renderer.tableAll({
      //             tableClass: "table",
      //             columnDefs: [
      //                 {
      //                     targets: 8,
      //                     visible: false,
      //                 },
      //                 {
      //                     targets: 1,
      //                     visible: false,
      //                 },
      //             ],
      //         }),
      //     },
      // },
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: "&nbsp;",
          next: "&nbsp;",
        },
      },
      initComplete: function () {
        // Adding plan filter once table initialized
        this.api()
          .columns(1)
          .every(function () {
            var column = this;
            var select = $(
              '<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Tài khoản </option></select>'
            )
              .appendTo(".taikhoan_filter")
              .on("change", function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? "^" + val + "$" : "", true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append(
                  '<option value="' +
                    d +
                    '" class="text-capitalize">' +
                    d +
                    "</option>"
                );
              });
          });
      },
    });
  }

  // // Check Validity
  // function checkValidity(el) {
  //   if (el.validate().checkForm()) {
  //     submitBtn.attr("disabled", false);
  //   } else {
  //     submitBtn.attr("disabled", true);
  //   }
  // }

  // // Form Validation
  if (addNewBtn.length) {
    addNewBtn.on("click", function (e) {
      
    });
  }
  if (form.length) {
      form.validate({
        ignore: ".ql-container *", // ? ignoring quill editor icon click, that was creating console error
        rules: {
          name: {
            required: true,
          },
          account: {
            required: true,
          },
          type: {
            required: true,
          },
        },
        messages: {
          name: {
            required: "Bạn chưa nhập tên tài khoản",
          },
          account: {
            required: "Bạn chưa nhập sô tài khoản",
          },
          type: {
            required: "Bạn chưa chọn loại tài khoản",
          },
        },
      });

      form.on("submit", function (e) {
          var isValid = form.valid();
          e.preventDefault();
          if (isValid) {
              var id = $("#id").val();
              var name = $("#name").val();
              var account = $("#account").val();
              var type = $("#type").val();
              var status = 1;

              
              $.ajax({
                type: "POST",
                dataType: "json",
                data: {
                  id: id,
                  name: name,
                  account: account,
                  type: type,
                  status: status,
                },
                url: baseHome + "/accnumber/update",
                success: function (data) {
                  if (data.success == true) {
                    notyfi_success(data.msg);
                    $(".user-list-table").DataTable().ajax.reload(null, false);
                    $("#dg").trigger("reset");
                  } else {
                    notify_error(data.msg);
                    $("#dg").trigger("reset");
                    return false;
                  }
                },
              });

              modal.modal("hide");
              // overlay.removeClass("show");
          }
      });
  }

  // To initialize tooltip with body container
  $("body").tooltip({
    selector: '[data-toggle="tooltip"]',
    container: "body",
  });
});

function loaddata(id) {
  $(".modal-title").html("Cập nhật thông tin tài khoản");
  $.ajax({
    type: "POST",
    dataType: "json",
    data: { id: id },
    url: baseHome + "/accnumber/loaddata",
    success: function (data) {
      $("#name").val(data.name);
      $("#account").val(data.account);
      $("#type").val(data.type);
      // url = baseHome + "/accnumber/update";
      console.log(data);
    },
    error: function () {
      notify_error("Lỗi truy xuất database");
    },
  });
}

// function saveacm() {
//     var info = {};
//     info.dateTime = $("#dateTime").val();
//     info.content = $("#content").val();
//     info.customer = $("#customer").val();
//     info.staff = $("#staff").val();
//     info.account = $("#account").val();
//     info.classify = $("#classify").val();
//     info.type = $("#type").val();
//     info.asset = $("#asset").val();
//     info.note = $("#note").val();

//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         data: info,
//         url: url,
//         success: function (data) {
//             if (data.success) {
//                 notyfi_success(data.msg);
//                 $('#updateinfo').modal('hide');
//                 $(".user-list-table").DataTable().ajax.reload(null, false);
//             }
//             else
//                 notify_error(data.msg);
//         },
//         error: function () {
//             notify_error('Cập nhật không thành công');
//         }
//     });
// }

function xoa(id) {
  Swal.fire({
    title: "Xóa bản ghi",
    text: "Bạn có chắc chắn muốn xóa!",
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
        url: baseHome + "/accnumber/del",
        type: "post",
        dataType: "json",
        data: { id: id },
        success: function (data) {
          if (data.success) {
            notyfi_success(data.msg);
            $(".user-list-table").DataTable().ajax.reload(null, false);
          } else notify_error(data.msg);
        },
      });
    }
  });
}
// function check_classify() {
//   var classify = $("#classify").val();
//   var taikhoan = $("#account").val();
//   if (taikhoan > 0 && classify != "") {
//     $("#btn_add").attr("disabled", false);
//   }
// }

//format_number asset
$("#asset")
  .on("input", function (e) {
    $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g, "")));
  })
  .on("keypress", function (e) {
    if (!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
  })
  .on("paste", function (e) {
    var cb = e.originalEvent.clipboardData || window.clipboardData;
    if (!$.isNumeric(cb.getData("text"))) e.preventDefault();
  });
function formatCurrency(number) {
  var n = number.split("").reverse().join("");
  var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");
  return n2.split("").reverse().join("");
}

// function chot_so_du() {
//   $.ajax({
//     type: "POST",
//     dataType: "json",
//     data: {},
//     url: baseHome + "/acm/chotsodu",
//     success: function (data) {
//       if (data.success) {
//         notyfi_success(data.msg);
//         $(".user-list-table").DataTable().ajax.reload(null, false);
//       } else notify_error(data.msg);
//     },
//     error: function () {
//       notify_error("Lỗi truy xuất database");
//     },
//   });
// }
