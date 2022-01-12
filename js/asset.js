var url = '';

$(function () {
    return_combobox_multi('#don_vi', baseHome + '/asset/don_vi', 'Đơn vị');
    return_combobox_multi('#nhom_ts', baseHome + '/asset/nhomtaisan', 'Nhóm tài sản');
    
    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        nhom_ts = $("#nhom_ts"),
        don_vi = $("#don_vi"),
        don_vi_add = $("#don_vi_add"),
        nhom_ts_add = $("#nhom_ts_add"),
        datePicker = $(".flatpickr-basic"),
        form = $("#dg"),
        formInfoAsset = $("#thongtin_taisan"),
        statusObj = {
            0: { title: "Xoá", class: "badge-light-warning" },
            1: { title: "Hoạt động", class: "badge-light-success" },
            2: { title: "Tạm ngưng", class: "badge-light-warning" },
        };
        
 // datepicker init
 if (datePicker.length) {
    datePicker.flatpickr({

        dateFormat: 'd-m-Y',
        defaultDate: "today",
    });
} 
    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            ordering: false,
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/asset/list",
            columns: [
                // columns according to JSON
                // { data: "" },
                { data: "name" },
                { data: "name_nhomts" },
                { data: "so_luong" },
                { data: "sl_baohanh" },
                { data: "sl_honghoc" },
                { data: "sl_mat" },
                { data: "" },
            ],
            columnDefs: [
                {
             
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
                        html += '<button type="button"  class="btn btn-icon btn-outline-primary waves-effect" data-toggle="modal" data-target="#baohongmat" title="Báo hỏng mất" onclick="load_baohong(' + full['id'] + ')">';
                        html += 'Báo mất</i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" data-toggle="modal" data-target="#updateinfo" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="del(' + full['id'] + ')">';
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
                        $(".error").html('');// loại bỏ validate
                        $(".error").removeClass("error"); // loại bỏ validate
                        $('#name').val('');
                        $('#so_luong').val('');
                        $('#don_vi').val('').change();
                        $('#nhom_ts').val('').change();
                        $('#so_tien').val('');
                        $('#khau_hao').val('');
                        $('#bao_hanh').val('');
                        url = baseHome + "/asset/add";
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
                    var select = $('<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value="">Nhóm tài sản</option></select>')
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
                "name": {
                    required: true,
                },
                "so_luong": {
                    required: true,
                },
                "don_vi": {
                    required: true,
                },
                "so_tien": {
                    required: true,
                },
                "nhom_ts": {
                    required: true,
                },
                "khau_hao": {
                    required: true,
                },
                "bao_hanh": {
                    required: true,
                },
            },
        });

        form.on("submit", function (e) {
            var isValid = form.valid();
            e.preventDefault();
            if (isValid) {
                savetk();
            }
        });
    }


    if (formInfoAsset.length) {
        formInfoAsset.validate({
            errorClass: "error",
            rules: {
                "name_add": {
                    required: true,
                },
                "so_luong_add": {
                    required: true,
                },
                "don_vi_add": {
                    required: true,
                },
                "so_tien_add": {
                    required: true,
                },
                "nhom_ts_add": {
                    required: true,
                },
                "khau_hao_add": {
                    required: true,
                },
            },
        });
    
        formInfoAsset.on("submit", function (e) {
            var isValid = formInfoAsset.valid();
            e.preventDefault();
            if (isValid) {
                updateinfo();
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
    return_combobox_multi('#don_vi_add', baseHome + '/asset/don_vi', 'Đơn vị');
    return_combobox_multi('#nhom_ts_add', baseHome + '/asset/nhomtaisan', 'Nhóm tài sản');
    $(".modal-title").html('Cập nhật thông tin tài sản');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/asset/loaddata",
        success: function (result) {
            var tai_san = result.taisan;
            $('#id_taisan').val(tai_san.id);
            $('#tai_san').html(tai_san.name);
            $('#name_add').val(tai_san.name);
            $("#don_vi_add").val(tai_san.don_vi).change();
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
            
            url = baseHome + '/asset/update?id=' + id;
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

function del(id) {
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
                url: baseHome + "/asset/del",
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
        url: baseHome + "/asset/changeImage",
        type: 'post',
        data: myform,
        contentType: false,
        processData: false,
        success: function(data){
            data = JSON.parse(data); // chu y
            if (data.success) {
               notyfi_success(data.msg);
               $('#avatar').attr('src', data.filename);
            }
            else {
                notify_error(data.msg);
            }
               
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




function load_baohong(id){
    $('#id_baohong').val(id);
 
}

function baohong(){
    var myform = new FormData($("#formbaohong")[0]);
 
    $.ajax({
        url: baseHome + "/asset/baohong",
        type: 'post',
        data: myform,
        dataType: 'json',
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

