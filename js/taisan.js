var url = '';

$(function () {


    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        nhom_ts = $("#nhom_ts"),
        don_vi = $("#don_vi"),
        don_vi_add = $("#don_vi_add"),
        nhom_ts_add = $("#nhom_ts_add"),
        datePicker = $(".ngay_gio"),
        form = $("#dg");
        statusObj = {
            0: { title: "Xoá", class: "badge-light-warning" },
            1: { title: "Hoạt động", class: "badge-light-success" },
            2: { title: "Tạm ngưng", class: "badge-light-warning" },
        };
        
 // datepicker init
 if (datePicker.length) {
    datePicker.flatpickr({
    });
} 
    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/taisan/list",
            columns: [
                // columns according to JSON
                // { data: "" },
                { data: "name" },
                { data: "name_nhomts" },
                { data: "so_luong" },
                { data: "sl_tonkho" },
                { data: "sl_baohanh" },
                { data: "sl_honghoc" },
                { data: "sl_mat" },
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
                    targets: 0,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full["name"];
                            
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
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" data-toggle="modal" data-target="#baohongmat" title="Báo hỏng mất" onclick="load_baohong(' + full['id'] + ')">';
                        html += 'Báo mất</i>';
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
                    text: "Thêm mới",
                    className: "add-new btn btn-primary mt-50",
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                    },
                    action: function (e, dt, node, config) {
                        $("#addinfo").modal('show');
                        $(".modal-title").html('Thêm tài sản mới');
                        $('#name').val('');
                        $('#so_luong').val('');
                        $('#don_vi').val('1');
                        $('#nhom_ts').val(0);
                        $('#nhom_ts').trigger("change");
                        $('#so_tien').val('0');
                        $('#khau_hao').val('');
                        $('#bao_hanh').val('');
                        $(".btn-add").attr("disabled", true);
                        var dateObj = new Date();
                        var thang = dateObj.getMonth();
                        thang = thang > 9 ? thang : '0' + thang;
                        var ngay = dateObj.getDate();
                        ngay = ngay > 9 ? ngay : '0' + ngay;
                        var dateToUse = dateObj.getFullYear() + "-" + thang + "-" + ngay;
                        $('#ngay_gio').val(dateToUse);
                        $('#tinh_trang').val('1');

                        url = baseHome + "/taisan/add";
                    },
                },
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
                // Adding role filter once table initialized
                
                this.api()
                .columns(0)
                .every(function () {
                    var column = this;
                    var select = $('<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Tài sản </option></select>')
                        .appendTo(".tai_san_fillter")
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

    $.ajax({ // tải Khách hàng vào select1 tai_khoan
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/taisan/nhomtaisan",
        success: function (data) {
            nhom_ts.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: nhom_ts.parent(),
            width: '100%',
            data: data
            });
        },
    });

    $.ajax({ // tải Khách hàng vào select1 tai_khoan
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/taisan/nhomtaisan",
        success: function (data) {
            nhom_ts_add.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: nhom_ts_add.parent(),
            width: '100%',
            data: data
            });
        },
    });

    $.ajax({ // tải Khách hàng vào select1 tai_khoan
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/taisan/nhomtaisan",
        success: function (data) {
            nhom_ts.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: nhom_ts.parent(),
            width: '100%',
            data: data
            });
        },
    });

    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/taisan/don_vi",
        success: function (data) {
            don_vi.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: don_vi.parent(),
            width: '100%',
            data: data
            });
        },
    });

    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/taisan/don_vi",
        success: function (data) {
            don_vi_add.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: don_vi_add.parent(),
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
    $(".modal-title").html('Cập nhật thông tin tài sản');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/taisan/loaddata",
        success: function (result) {

            var tai_san = result.taisan;
            $('#id_taisan').val(tai_san.id);
            $('#sl_tonkho').val(tai_san.sl_tonkho);
            $('#sl_old').val(tai_san.so_luong);
            $('#tai_san').html(tai_san.name);
            $('#show_ton_kho').html(tai_san.sl_tonkho);
            $('#name_add').val(tai_san.name);
            $('#don_vi_add option[value='+tai_san.don_vi+']').attr('selected','selected');
            $("#don_vi_add").val(tai_san.don_vi).change();
            $('#nhom_ts_add option[value='+tai_san.nhom_ts+']').attr('selected','selected');
            $("#nhom_ts_add").val(tai_san.nhom_ts).change();
            $('#so_luong_add').val(tai_san.so_luong);
            $('#khau_hao_add').val(tai_san.khau_hao);
            $('#bao_hanh_add').val(tai_san.bao_hanh);
            $("#so_tien_add").val(formatCurrency(tai_san.so_tien.replace(/[,VNĐ]/g,'')));
            $('#ngay_gio_add').val(tai_san.ngay_gio);

            var taisan_info = result.taisan_info; 
            $('#avatar').attr('src', taisan_info.hinh_anh);
            $('#nha_cungcap').val(taisan_info.nha_cungcap);
            $('#dia_chi').val(taisan_info.dia_chi);
            $('#sdt').val(taisan_info.sdt);
            $('#ghi_chu').val(taisan_info.ghi_chu);
            
            url = baseHome + '/taisan/update?id=' + id;
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
                $('#addinfo').modal('hide');
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

function updateinfo() {
    var myform = new FormData($("#thongtin_taisan")[0]);
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
                $('#addinfo').modal('hide');
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
                url: baseHome + "/taisan/del",
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

function thayanh(){
    var myform = new FormData($('#thongtin_taisan')[0]);
    $.ajax({
        url: baseHome + "/taisan/thayanh",
        type: 'post',
        data: myform,
        contentType: false,
        processData: false,
        success: function(data){
            if (data.success) {
               notyfi_success(data.msg);
               $('#avatar').attr('src', data.filename);
            }
            else
                notify_error(data.msg);
        },
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



function check_soluong() {
    var sl_tonkho = Number($("#sl_tonkho").val());
    var sl_old = Number($("#sl_old").val());
    var so_luong = Number($("#so_luong_add").val());
    var sl_cp = sl_old - sl_tonkho;
    if(so_luong < sl_cp){
        $(".btn-add").attr("disabled", true);
        notify_error('Số lượng đang nhỏ hơn số lượng cấp phát');
    }else{
        $(".btn-add").attr("disabled", false);
    }
}

function check_name() {
    var name = $("#name").val(),
    so_luong = $("#so_luong").val(),
    nhom = $("#nhom_ts").val();
    if(nhom > 0 && so_luong > 0 && name != ''){
        $(".btn-add").attr("disabled", false);
        
    }else{
       
        $(".btn-add").attr("disabled", true);
    }
}



function load_baohong(id){
    $('#id_baohong').val(id);
}

function baohong(){
    var myform = new FormData($("#formbaohong")[0]);
    $.ajax({
        url: baseHome + "/taisan/baohong",
        type: 'post',
        data: myform,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#baohongmat').modal('hide');
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

