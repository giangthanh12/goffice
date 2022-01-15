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
            ajax: baseHome + "/asset_recall/list",
            columns: [
                { data: "ngay_gio" },
                { data: "name_cp" },
                { data: "name_taisan" },
                { data: "ghi_chu" },
                { data: "" },
            ],
            columnDefs: [
                {

                },
                {
                    // User full name and username
                    targets: 1,
                    render: function (data, type, full, meta) {
                        var $name = full["name_cp"];
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
                    targets: 3,
                    render: function (data, type, full, meta) {
                        var $note = full["ghi_chu"];
                        var $row_output = $note ? $note : `<div style="margin-left:20px;">---</div>`;
                        return $row_output;
                    },
                },

                


               
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                       userFuns.forEach(function (item){
                            if(item.function=='loaddata') {
                                    html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" data-toggle="modal" data-target="#updateinfo" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                                    html += '<i class="fas fa-pencil-alt"></i>';
                                    html += '</button> &nbsp;';
                                }
                                });

                        
                        userFuns.forEach(function (item){
                            if(item.function=='del') {
                                html += '<button type="button" class="btn btn-icon btn-outline-' + item.color + ' waves-effect"  title="'+item.name+'" onclick="' + item.function + '(' + full['id'] + ')">';
                                html += '<i class="' + item.icon + '"></i>';
                                html += '</button> &nbsp;';
                            }
                        });
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
               
            ],

            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            initComplete: function () {
                // Adding role filter once table initialized
                this.api()
                    .columns(2)
                    .every(function () {
                        var column = this;
                        var select = $('<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Tài sản </option></select>')
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
                modal.modal("hide");
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
    $('#btn_add').css('display','none');
    userFuns.forEach(function (item){
        if(item.function=='loaddata') {
         $('#btn_add').css('display','inline-block');
        }
    });

    $(".modal-title").html('Cập nhật thu hồi');
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
            $("#cap_phat").val(data.cap_phat).trigger('change');
        
            $('#tra_coc').val(formatCurrency(data.tra_coc.replace(/[,VNĐ]/g,'')));
            $('#ngay_gio').val(data.ngay_gio);
            $('#ghi_chu').val(data.ghi_chu);
            url = baseHome + '/asset_recall/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}



function saveth() {
    var myform = new FormData($("#dg")[0]);
    $.ajax({
        type: "POST",
        dataType: "json",
        data: myform,
        url: url,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#updateinfo').modal('hide');
                $(".user-list-table").DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
        error: function () {
            notify_error('Cập nhật không thành công');
        }
    });
}


function xoa(id) {
  
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
                url: baseHome + "/asset_recall/del",
                type: 'post',
                dataType: "json",
                data: { id: id },
                success: function (data) {
                    if (data.success) {
                        $('.modal').modal('hide');
                        notyfi_success(data.msg);
                        $(".user-list-table").DataTable().ajax.reload(null, false);
                    }
                    else
                        notify_error(data.msg);
                },
            });
        }
    });
}


//format_number so_tien
$('.format_number').on('input', function(e){        
    $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g,'')));
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



// function checkvali_th() {
//     var so_luong_th = Number($("#so_luong").val());
//     var sl_th_old = Number($("#sl_th_old").val());
//     var id_cp = $("#id_cp").val();
//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         data: { id: id_cp},
//         url: baseHome + "/asset_recall/get_slcp",
//         success: function (data) {
//             var sl_cp = Number(data.so_luong);
//             var nummax_th =sl_cp + sl_th_old;

//             if(so_luong_th <= nummax_th && so_luong_th > 0) {
//                 $("#btn_add").attr("disabled", false);
//             }else{
//                 $("#btn_add").attr("disabled", true);
//             }
//         },
//         error: function () {
//             notify_error('Lỗi truy xuất database');
//         }
//     });
    
// }

