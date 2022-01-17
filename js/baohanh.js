var url = '';

$(function () {


    var dtUserTable = $(".user-list-table"),
        
        modal = $("#updateinfo"),
        datePicker = $(".ngay_gio"),
        tai_san = $("#tai_san"),
        tai_san_th = $("#tai_san_th"),
        
        form = $("#dg");
       
     // datepicker init
    if (datePicker.length) {
        datePicker.flatpickr({
        });
    }


    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/taisanbaohanh/list",
            columns: [
                // columns according to JSON
                // { data: "" },
                { data: "ngay_gio" },
                { data: "name_taisan" },
                { data: "so_luong" },
                { data: "sl_lay" },
                { data: "ghi_chu" },
                { data: "" },
                { data: "" },
            ],
            columnDefs: [
                {

                },
                {
                    // User full name and username
                    targets: 1,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full["name_taisan"];
                            
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
                    targets: 5,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        
                            
                        // Creates full output for row
                        var $row_output =
                        '<a href="javascript:void(0)" onclick="loadlichsu(' + full["id"] + ')" data-toggle="modal" data-target="#lichsu"><span class="badge badge-pill badge-light-warning" text-capitalized="">Lịch sử BH</span></a> '
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
                        html += '<button type="button" class="btn btn-icon btn-outline-success waves-effect"  data-toggle="tooltip" data-original-title="Lấy bảo hành" onclick="loadthuhoi(' + full['id'] + ')">';
                        html += '<i class="far fa-hand-rock"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" data-toggle="modal" data-target="#updateinfo" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="xoa(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
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
                    text: "Thêm mới bảo hành",
                    className: "add-new btn btn-primary mt-50",
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                    },
                    action: function (e, dt, node, config) {
                        $("#updateinfo").modal('show');
                        $(".modal-title").html('Thêm mới');
                        
                        var dateObj = new Date();
                        var thang = dateObj.getMonth();
                        thang = thang > 9 ? thang : '0' + thang;
                        var ngay = dateObj.getDate();
                        ngay = ngay > 9 ? ngay : '0' + ngay;
                        var dateToUse = dateObj.getFullYear() + "-" + thang + "-" + ngay;
                        $('#ngay_gio').val(dateToUse);
                        $('#so_luong').val('1');
                        $('#id_ts').val('');
                       
                        $('#tai_san').val(0);
                        $('#tai_san').trigger("change");
                        $('#tinh_trang').val('1');
                        $('#btn_add').attr("disabled", true);
                        $("#tai_san").attr("disabled", false);
                       
                        $('#ghi_chu').val('');

                        url = baseHome + "/taisanbaohanh/add";
                    },
                },
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
                    .columns(1)
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
        url: baseHome + "/taisancapphat/taisan",
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
        url: baseHome + "/taisancapphat/taisan",
        success: function (data) {
            tai_san_th.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: tai_san_th.parent(),
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
    $(".modal-title").html('Sửa bảo hành');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/taisanbaohanh/loaddata",
        success: function (data) {
            $('#id').val(data.id);
            $('#id_ts').val(data.tai_san);
            $("#btn_add").attr("disabled", true);
            $("#tai_san").val(data.tai_san).trigger('change');
            $('#so_luong').val(data.so_luong);
            $('#ngay_gio').val(data.ngay_gio);
            $('#ghi_chu').val(data.ghi_chu);
 
            url = baseHome + '/taisanbaohanh/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function loadthuhoi(id) {	$("#thuhoi").modal('show');
    $(".modal-title").html('Lấy bảo hành');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/taisanbaohanh/loaddata",
        success: function (data) {
            $('#id_bh').val(data.id);
            $('#id_tsth').val(data.tai_san);
            $("#tai_san_th").attr("disabled", true);
            $("#tai_san_th").val(data.tai_san).trigger('change');

            var sl = data.so_luong;
            var sl_lay = data.sl_lay;
            $('#so_luong_th').val(sl - sl_lay);
           
            var dateObj = new Date();
            var thang = dateObj.getMonth();
            thang = thang > 9 ? thang : '0' + thang;
            var ngay = dateObj.getDate();
            ngay = ngay > 9 ? ngay : '0' + ngay;
            var dateToUse = dateObj.getFullYear() + "-" + thang + "-" + ngay;
            $('#ngay_gio_th').val(dateToUse);
            $('#ghi_chu_th').val('');
 
            url = baseHome + '/taisanbaohanh/thuhoi?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}







function savetk() {
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

function saveth() {
    var myform = new FormData($("#dg_th")[0]);
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
                $('#thuhoi').modal('hide');
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
                url: baseHome + "/taisanbaohanh/del",
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

function checkvali() {
    
    var tai_san = $("#tai_san").val();
    var so_luong = Number($("#so_luong").val());
    if(tai_san > 0){
        $.ajax({
            type: "POST",
            dataType: "json",
            data: { id: tai_san},
            url: baseHome + "/taisanbaohanh/get_sl",
            success: function (data) {
                var nummax = Number(data.so_luong);
                 if(tai_san > 0 && so_luong <= nummax && so_luong > 0) {
                    $("#btn_add").attr("disabled", false);
                }else{
                    $("#btn_add").attr("disabled", true);
                }
            },
            error: function () {
                notify_error('Lỗi truy xuất database');
            }
        });
    }
}

function checkvali_th() {
    var so_luong_th = Number($("#so_luong_th").val());
    var id_bh = $("#id_bh").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id_bh},
        url: baseHome + "/taisanbaohanh/get_slbh",
        success: function (data) {
            var nummax_bh = Number(data.so_luong);
            var nummax_lay = Number(data.sl_lay);
            var nummax_th = nummax_bh - nummax_lay;

            if(so_luong_th <= nummax_th && so_luong_th > 0) {
                
                $("#btn_add_th").attr("disabled", false);
            }else{
               
                $("#btn_add_th").attr("disabled", true);
            }
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
    
}




function loadlichsu(id){
    statusObj = {
        0: { title: "Lấy BH về", class: "badge-light-warning" },
        1: { title: "Mang đi BH", class: "badge-light-success" },
    };
    $(".modal-title").html('Lịch sử bảo hành');
    var list_baohanh = $(".list-baohanh");
    if(list_baohanh.length){
        list_baohanh.DataTable({
            ajax: baseHome + "/taisanbaohanh/list_lichsu?id=" + id,
            columns: [
                { data: "ngay_gio" },
                { data: "name_taisan" },
                { data: "so_luong" },
                { data: "ghi_chu" },
                { data: "status" },
            ],
            columnDefs: [
                {
                    // User Status
                    targets: -1,
                    render: function (data, type, full, meta) {
                        var $status = full["status"];
                        return '<span class="badge badge-pill ' + statusObj[$status].class + '" text-capitalized>' + statusObj[$status].title + "</span>";
                    },
                },
            ]
        });
    }


}

