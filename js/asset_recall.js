var url = '';

$(function () {


    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        datePicker = $(".ngay_gio"),
        tai_san = $("#tai_san"),
        cap_phat = $("#cap_phat"),
        form = $("#dg");
     // datepicker init
    if (datePicker.length) {
        datePicker.flatpickr({
        });
    }


    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            ordering: false,
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/asset_recall/listdata",
            columns: [
                { data: "ngay_gio_format" },
                { data:"nameIssue"},
                { data: "code" },
                { data: "name_taisan" },
                { data: "ghi_chu" },
            
            ],
            columnDefs: [
                {

                },
                {
                    // User full name and username
                    targets: 2,
                    render: function (data, type, full, meta) {
                        var $name = full["code"];
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="d-flex flex-column">' +
                            '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ')" data-toggle="modal" data-target="#updateinfo" class="user_name text-truncate"><span class="font-weight-bold">' +
                            $name +
                            "</span></a>" +
                            
                            "</div>" +
                            "</div>";
                        return $row_output;
                    },
                },

                {
                    // User full name and username
                    targets: 4,
                    render: function (data, type, full, meta) {
                        var $note = full["ghi_chu"];
                        var $row_output = $note ? $note : `<div style="margin-left:20px;">---</div>`;
                        return $row_output;
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
                    sLengthMenu: "Hi???n th??? _MENU_",
                    search: "",
                    searchPlaceholder: "T??m ki???m...",
                    paginate: {
                        // remove previous & next text from pagination
                        previous: "&nbsp;",
                        next: "&nbsp;",
                    },
                    info:"Hi???n th??? _START_ ?????n _END_ c???a _TOTAL_ b???n ghi",
                    infoFiltered: "(l???c t??? _MAX_ b???n ghi)",
                    sInfoEmpty : "Hi???n th??? 0 ?????n 0 c???a 0 b???n ghi",
                },
                "oLanguage": {
                    "sZeroRecords": "Kh??ng c?? b???n ghi n??o"
                  },
            // Buttons with Dropdown
            buttons: [
               
            ],

       
            initComplete: function () {
                // Adding role filter once table initialized
                this.api()
                    .columns(2)
                    .every(function () {
                        var column = this;
                        var select = $('<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> T??i s???n </option></select>')
                            .appendTo(".taisan_filter")
                            .on("change", function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? "^" + val + "$" : "", true, false).draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append('<option value="' + d + '" class="text-capitalize">' + d + "</option>");
                            });
                    });


            },
        });

    }


    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/asset_recall/taisan",
        success: function (data) {
            tai_san.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: tai_san.parent(),
            width: '100%',
            data: data
            });
        },
    });

    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/asset_recall/capphat",
        success: function (data) {
            cap_phat.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: cap_phat.parent(),
            width: '100%',
            data: data
            });
        },
    });




    // Check Validity
    function checkValidity(el) {
        if (el.validate().checkForm()) {
            submitBtn.attr("disabled", false);
        } else {
            submitBtn.attr("disabled", true);
        }
    }

   

    // To initialize tooltip with body container
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
        container: "body",
    });
});

function loaddata(id) {
    $('#btn_add').css('display','none');
    userFuns.forEach(function (item){
        if(item.function=='loaddata') {
         $('#btn_add').css('display','inline-block');
        }
    });

    $(".modal-title").html('Th??ng tin t??i s???n thu h???i');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/asset_recall/loaddata",
        success: function (data) {
            $('#id_th').val(data.id);
            $('#id_ts').val(data.tai_san);
            $('#id_cp').val(data.cap_phat);
            $('#sl_th_old').val(data.so_luong);
            $("#tai_san").attr("disabled", true);
            $("#cap_phat").attr("disabled", true);
            $("#tai_san").val(data.tai_san).trigger('change');
            $("#cap_phat").val(data.tai_san).trigger('change');
            $('#tra_coc').val(formatCurrency(data.tra_coc.replace(/[,VN??]/g,'')));
            $('#ngay_gio').val(data.ngay_gio);
            $('#ghi_chu').val(data.ghi_chu);
        },
        error: function () {
            notify_error('L???i truy xu???t database');
        }
    });
}







//format_number so_tien
$('.format_number').on('input', function(e){        
    $(this).val(formatCurrency(this.value.replace(/[,VN??]/g,'')));
  }).on('keypress',function(e){
    if(!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
  }).on('paste', function(e){    
    var cb = e.originalEvent.clipboardData || window.clipboardData;      
    if(!$.isNumeric(cb.getData('text'))) e.preventDefault();
  });
  function formatCurrency(number){
    var n = number.split('').reverse().join("");
    var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");    
    return  n2.split('').reverse().join('');
}


