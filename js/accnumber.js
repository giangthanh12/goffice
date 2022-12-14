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
var buttons = [];
if(funAdd == 1) {
  buttons.push({
    text: "Thêm mới",
    className: "add-new btn btn-primary mt-50",
    init: function (api, node, config) {
      $(node).removeClass("btn-secondary");
    },
    action: function (e, dt, node, config) {
      actionMenu();
    },
  })
}
 
var visible = true;
if(funEdit!=1 && funDel!=1) {
    visible = false;
}
  // Users List datatable
  if (dtUserTable.length) {
    dtUserTable.DataTable({
      // ajax: assetPath + "data/user-list.json", // JSON file to add data
      ajax: baseHome + "/accnumber/list",
      ordering: false,
      columns: [
        // columns according to JSON
       
        { data: "id" },
        { data: "name" },
        { data: "account" },
        { data: "type" },
        { data: "" },
      ],
      columnDefs: [
        
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
          title: 'Thao tác',
          visible: visible,
          orderable: false,
          render: function (data, type, full, meta) {
            var html = "";
            html +='<div style="width: 80px;">';
            if(funEdit == 1) {
              html +=  '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" data-toggle="modal" data-target="#updateinfo" title="Chỉnh sửa" onclick="loaddata(' +
              full["id"] +
              ')">';
              html += '<i class="fas fa-pencil-alt"></i>';
              html += "</button> &nbsp;";
            }
           if(funDel == 1) {
            html +=
            '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="xoa(' +
            full["id"] +
            ')">';
            html += '<i class="fas fa-trash-alt"></i>';
            html += "</button>";
           }
            

            html += '</div>';
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
          sLengthMenu: "Hiển thị _MENU_",
          search: "",
          searchPlaceholder: "Tìm kiếm...",
          paginate: {
              // remove previous & next text from pagination
              previous: "&nbsp;",
              next: "&nbsp;",
          },
          info:"Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
          infoFiltered: "(lọc từ _MAX_ bản ghi)",
          sInfoEmpty : "Hiển thị 0 đến 0 của 0 bản ghi",        },  
          "oLanguage": {
            "sZeroRecords": "Không có bản ghi nào"
          },  
      // Buttons with Dropdown
      buttons: buttons,
     
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
function actionMenu() {
  var validator = $("#dg").validate(); // reset form
      validator.resetForm();
      $(".error").removeClass("error"); // loại bỏ validate
      $("#updateinfo").modal("show");
      $(".modal-title").html("Thêm Tài khoản mới");
      // $("#btn_add").attr("disabled", true);
      $("#dg").trigger("reset");
      $('#id').val('');
      // url = baseHome + "/acm/add";
}

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
            number: true,
            minlength: 8,
          },
          type: {
            required: true,
          },
        },
        messages: {
          name: {
            required: "Bạn chưa nhập tên tài khoản!",
          },
          account: {
            required: "Bạn chưa nhập sô tài khoản!",
            number: "Yêu cầu nhập số!",
            minlength: "Nhập ít nhất 8 số!"
          },
          type: {
            required: "Bạn chưa chọn loại tài khoản!",
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
      var validator = $("#dg").validate(); // reset form
      validator.resetForm();
      $(".error").removeClass("error"); // loại bỏ validate
      $("#name").val(data.name);
      $("#account").val(data.account);
      $("#type").val(data.type);
      $('#id').val(data.id);
      // url = baseHome + "/accnumber/update";
      
    },
    error: function () {
      notify_error("Lỗi truy xuất database");
    },
  });
}


function xoa(id) {
  Swal.fire({
    title: "Xóa bản ghi",
    text: "Bạn có chắc chắn muốn xóa!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Tôi đồng ý",
    cancelButtonText:"Hủy",
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

