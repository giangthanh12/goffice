/*=========================================================================================
    File Name: app-invoice-list.js
    Description: app-invoice-list Javascripts
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
   Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';

  var dtInvoiceTable = $('.invoice-list-table'),
    assetPath = baseHome+'/styles/app-assets/',
    invoicePreview = 'baogia/printQuote',
    invoiceAdd = 'baogia/add',
    invoiceEdit = 'baogia/edit';

  // datatable
  if (dtInvoiceTable.length) {
    var dtInvoice = dtInvoiceTable.DataTable({
      ajax: 'baogia/dataTable', // JSON file to add data
      autoWidth: false,
      ordering: false,
      columns: [
        { data: 'responsive_id' },
        { data: 'invoice_id' },
        { data: 'invoice_status' },
        { data: 'issued_date' },
        { data: 'client_name' },
        { data: 'total' },
        { data: 'balance' },
        { data: 'invoice_status' },
        { data: '' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          responsivePriority: 2,
          targets: 0
        },
        {
          // Invoice ID
          targets: 1,
          width: '46px',
          render: function (data, type, full, meta) {
            var $invoiceId = full['invoice_id'];
            // Creates full output for row
            var $rowOutput = '<a class="font-weight-bold" href="javascript:void(0)"> #' + $invoiceId + '</a>';
            return $rowOutput;
          }
        },
        {
          // Invoice status
          targets: 2,
          width: '42px',
          render: function (data, type, full, meta) {
            var $invoiceStatus = full['invoice_status'],
              $dueDate = full['due_date'],
              $balance = full['balance'],
              roleObj = {
                'M???i t???o': { class: 'bg-light-secondary', icon: 'info' },
                '???? g???i': { class: 'bg-light-success', icon: 'send' },
                '???? ch???t': { class: 'bg-light-primary', icon: 'check-circle' },
                'H???y': { class: 'bg-light-info', icon: 'arrow-down-circle' },
                // 'Past Due': { class: 'bg-light-danger', icon: 'save' },
                // 'Partial Payment': { class: 'bg-light-warning', icon: 'pie-chart' }
              };
            return (
              "<span data-toggle='tooltip' data-html='true' title='<span>" +
              $invoiceStatus +
              '<br> <span class="font-weight-bold">Balance:</span> ' +
              $balance +
              '<br> <span class="font-weight-bold">Due Date:</span> ' +
              moment($dueDate).format('DD-MM-YYYY') +
              "</span>'>" +
              '<div class="avatar avatar-status ' +
              roleObj[$invoiceStatus].class +
              '">' +
              '<span class="avatar-content">' +
              feather.icons[roleObj[$invoiceStatus].icon].toSvg({ class: 'avatar-icon' }) +
              '</span>' +
              '</div>' +
              '</span>'
            );
          }
        },
        {
          // Client name and Service
          targets: 3,
          responsivePriority: 4,
          width: '270px',
          render: function (data, type, full, meta) {
            var $name = full['client_name'],
              $email = full['email'],
              $image = full['avatar'],
              stateNum = Math.floor(Math.random() * 6),
              states = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'],
              $state = states[stateNum],
              $name = full['client_name'],
              $initials = $name.match(/\b\w/g) || [];
            $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
            if ($image) {
              // For Avatar image
              var $output =
                '<img  src="' + assetPath + 'images/avatars/' + $image + '" alt="Avatar" width="32" height="32">';
            } else {
              // For Avatar badge
              $output = '<div class="avatar-content">' + $initials + '</div>';
            }
            // Creates full output for row
            var colorClass = $image === '' ? ' bg-light-' + $state + ' ' : ' ';

            var $rowOutput =
              '<div class="d-flex justify-content-left align-items-center">' +
              '<div class="avatar-wrapper">' +
              '<div class="avatar' +
              colorClass +
              'mr-50">' +
              $output +
              '</div>' +
              '</div>' +
              '<div class="d-flex flex-column">' +
              '<h6 class="user-name text-truncate mb-0">' +
              $name +
              '</h6>' +
              '<small class="text-truncate text-muted">' +
              $email +
              '</small>' +
              '</div>' +
              '</div>';
            return $rowOutput;
          }
        },
        {
          // Total Invoice Amount
          targets: 4,
          width: '73px',
          render: function (data, type, full, meta) {
            var $total = full['total'];
            return '<span class="d-none">' + $total + '</span>' + $total;
          }
        },
        {
          // Due Date
          targets: 5,
          width: '130px',
          render: function (data, type, full, meta) {
            var $dueDate = new Date(full['due_date']);
            // Creates full output for row
            var $rowOutput =
              '<span class="d-none">' +
              moment($dueDate).format('YYYYMMDD') +
              '</span>' +
              moment($dueDate).format('DD-MM-YYYY');
            $dueDate;
            return $rowOutput;
          }
        },
        {
          // Client Balance/Status
          targets: 6,
          width: '98px',
          render: function (data, type, full, meta) {
            var $balance = full['balance'];
            if ($balance === 0) {
              var $badge_class = 'badge-light-success';
              return '<span class="badge badge-pill ' + $badge_class + '" text-capitalized> Paid </span>';
            } else {
              return '<span class="d-none">' + $balance + '</span>' + $balance;
            }
          }
        },
        {
          targets: 7,
          visible: false
        },
        {
          // Actions
          targets: -1,
          title: 'Thao t??c',
          width: '80px',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-flex align-items-center col-actions">' +
              '<span class="mr-1" id="sendMail" data-toggle="tooltip" onclick="sendMail('+full['invoice_id']+')" data-placement="top" title="G???i mail">' +
              feather.icons['send'].toSvg({ class: 'font-medium-2' }) +
              '</span>' +
              '<a class="mr-1" href="' +
              invoicePreview +
              '?id='+full['invoice_id']+'" data-toggle="tooltip" data-placement="top" title="Xem chi ti???t">' +
              feather.icons['eye'].toSvg({ class: 'font-medium-2' }) +
              '</a>' +
              '<div class="dropdown">' +
              '<a class="btn btn-sm btn-icon px-0" data-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-medium-2' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-right">' +
              '<a href="javascript:void(0);" class="dropdown-item">' +
              feather.icons['download'].toSvg({ class: 'font-small-4 mr-50' }) +
              'T???i</a>' +
              '<a onclick="edit(' + full['invoice_id'] + ',' + full['status'] + ')" href="javascript:void(0);" class="dropdown-item">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4 mr-50' }) +
              'S???a</a>' +
              '<a onclick="del(' + full['invoice_id'] + ')" href="javascript:void(0);" class="dropdown-item">' +
              feather.icons['trash'].toSvg({ class: 'font-small-4 mr-50' }) +
              'X??a</a>' +
              '<a href="javascript:void(0);" class="dropdown-item">' +
              feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) +
              'Sao</a>' +
              '</div>' +
              '</div>' +
              '</div>'
            );
          }
        }
      ],
      order: [[1, 'desc']],
      dom:
        '<"row d-flex justify-content-between align-items-center m-1"' +
        '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-right text-lg-left text-lg-right text-left "B>>' +
        '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pr-lg-1 p-0"f<"invoice_status ml-sm-2">>' +
        '>t' +
        '<"d-flex justify-content-between mx-2 row"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: "Hi???n th??? _MENU_",
        search: "",
        searchPlaceholder: "T??m ki???m...",
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        },
        info: "Hi???n th??? _START_ ?????n _END_ c???a _TOTAL_ b???n ghi",
        infoFiltered: "(l???c t??? _MAX_ b???n ghi)",
        "sInfoEmpty": "Hi???n th??? 0 ?????n 0 c???a 0 b???n ghi",
      },
      "oLanguage": {
        "sZeroRecords": "Kh??ng c?? b???n ghi n??o"
      },
      // Buttons with Dropdown
      buttons: [
        {
          text: 'B??o gi?? m???i',
          className: 'btn btn-primary btn-add-record ml-2',
          action: function (e, dt, button, config) {
            window.location = invoiceAdd;
          }
        }
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['client_name'];
            }
          }),
          type: 'column',
          renderer: $.fn.dataTable.Responsive.renderer.tableAll({
            tableClass: 'table',
            columnDefs: [
              {
                targets: 2,
                visible: false
              },
              {
                targets: 3,
                visible: false
              }
            ]
          })
        }
      },
      initComplete: function () {
        $(document).find('[data-toggle="tooltip"]').tooltip();
        // Adding role filter once table initialized
        this.api()
          .columns(7)
          .every(function () {
            var column = this;
            var select = $(
              '<select id="UserRole" class="form-control ml-50 text-capitalize"><option value=""> Theo t??nh tr???ng </option></select>'
            )
              .appendTo('.invoice_status')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
              });
          });
      },
      drawCallback: function () {
        $(document).find('[data-toggle="tooltip"]').tooltip();
      }
    });
  }

  $(document).on("change", "#selectEmail", function () {
      var email = $( "#selectEmail option:selected" ).text();
      var curValue = $('#emails').val();
      var newValue = '';
      if (curValue=='')
         newValue = email;
      else
         newValue = curValue + ';' + email;
      $('#emails').val(newValue);
  });

  $(document).on("click", "#btnSend", function () {
      var quoteId = $('#quoteId').val();
      var emailList = $('#emails').val();
      $.post("baogia/send", {id:quoteId,emailList:emailList},
          function (result, status) {
              if (result.success == true) {
                  console.log(result.msg)
                  toastr["success"](result.msg, "???? Task Action!", {
                      closeButton: true,
                      tapToDismiss: false,
                      rtl: isRtl,
                  });
                  $('#emailList').modal('hide');
              } else {
                  notify_error(result.msg);
                  return false;
              }
      },"json");
  });

});

function sendMail(id) {
    $('#emailList').modal('show');
    $('#emails').val('');
    $('#quoteId').val(id);
    $('#selectEmail').empty();
    $('#selectEmail').append($('<option>', {value:'', text:'Ch???n email'}));
    $.post("baogia/getEmails", {id:id},
        function (result, status) {
            result.forEach(function(item){
                $('#selectEmail').append($('<option>', {value:item.id, text:item.email}));
            });
    },"json");
}

function del(id) {
    Swal.fire({
        title: 'X??a d??? li???u',
        text: "B???n c?? ch???c ch???n mu???n x??a!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'T??i ?????ng ??',
        cancelButtonText: 'H???y',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: "baogia/del",
                type: 'post',
                dataType: "json",
                data: {id: id},
                success: function (data) {
                    if (data.success) {
                        $('.modal').modal('hide');
                        notyfi_success(data.msg);
                        $('.invoice-list-table').DataTable().ajax.reload(null, false);
                    } else
                        notify_error(data.msg);
                },
            });
        }
    });
}

function edit(id,status) {
    if (status==1) {
        window.location = 'baogia/edit?id='+id;
    } else {
        toastr["error"]('B???n ch??? ???????c ph??p s???a c??c b??o gi?? m???i t???o', "???? Task Action!", {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl,
        });
    }
}
