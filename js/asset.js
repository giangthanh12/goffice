var url = '';

$(function () {
    
    return_combobox_multi_add('#don_vi', baseHome + '/asset/don_vi', 'Đơn vị', 'loadUnitAsset');
    return_combobox_multi_add('#nhom_ts', baseHome + '/asset/nhomtaisan', 'Nhóm tài sản','loadGroupAsset');
    return_combobox_multi('#nhan_vien', baseHome + '/asset/getStaff', 'Nhân viên');



  
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
// $('#status').select2({
    
// });
var buttons = [];
if(funAdd == 1) {
    buttons.push({
        text: "Thêm mới",
        className: "add-new btn btn-" + 'primary' + " mt-50",
        init: function (api, node, config) {
            $(node).removeClass("btn-secondary");
        },
        action: function (e, dt, node, config) {
            actionMenu();
        }
    });
}


  // Define render label
  function renderTaskTag(option) {
    if (!option.id) {
        return option.text;
    }
    var $person =
        '<div class="media align-items-center">' +
        '<span class="bullet bullet-sm mr-50" style="margin-top:4px; background: ' + $(option.element).data("color") + '"></span>' +
        '<div class="media-body"><p style="margin-top:4px; color: ' + $(option.element).data("color") + '" class="mb-0">' +
        option.text +
        "</p></div></div>";

    return $person;
}

// Task Tags
if ($('#status').length) {
    $('#status').wrap('<div class="position-relative"></div>');
    $('#status').select2({
        placeholder: "Select tag",
        dropdownParent: $('#status').parent(),
        templateResult: renderTaskTag,
        templateSelection: renderTaskTag,
        escapeMarkup: function (es) {
            return es;
        },
    });
}



    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            ordering: false,
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/asset/listdata",
            columns: [
                // columns according to JSON
                { data: "code" },
                { data: "name" },
                { data: "name_nhomts" },
                { data: "tinh_trang" },
                // { data: "sl_honghoc" },
                // { data: "sl_mat" },
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
                    // User full name and username
                    targets: 3,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $status = full["tinh_trang"];
                        var $row_output = '---';
                            if($status == 1) {
                                $row_output = `<div class="badge badge-info">Khả dụng</div>`;
                            }
                            else if($status == 2) {
                                $row_output = `<div class="badge badge-primary">Đã cấp phát</div>`;
                            }
                            else if($status == 3) {
                                $row_output = `<div class="badge badge-warning">Đã hỏng</div>`;
                            }
                            else if ($status == 4)
                            $row_output = `<div class="badge badge-danger">Đã mất</div>`;
                        return $row_output;
                    },
                },
                {
                    // Actions
                    targets: -1,
                    title: "Thao tác",
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        
                        html += '<button type="button"  class="btn btn-icon btn-outline-success waves-effect" data-toggle="modal" data-target="#baohongmat" title="Báo hỏng mất" onclick="load_baohong(' + full['id'] + ')">';
                        html += '<i class="far fa-bell"></i>';
                        html += '</button> &nbsp;';
                        

                        if(full['tinh_trang'] == 2) { // thu hồi
                            if(funRecall==1) {
                            html += '<button type="button"  class="btn btn-icon btn-outline-info waves-effect" data-toggle="modal" data-target="#modalRecall" title="Thu hồi" onclick="loadRecall(' + full['id_capphat'] + ')">';
                            html += '<i class="fas fa-angle-left"></i>';
                            html += '</button> &nbsp;';
                                }
                        }
                        if (full['tinh_trang'] == 1) {
                                if(funIssue == 1) {
                                    html += '<button type="button"  class="btn btn-icon btn-outline-warning waves-effect" data-toggle="modal" data-target="#modalIssue" title="Cấp phát" onclick="loadIssue(' + full['id'] + ')">';
                                    html += '<i class="fas fa-angle-right"></i>';
                                    html += '</button> &nbsp;';
                                }
                        }
               
                            if(funEdit == 1) {
                                html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" data-toggle="modal" data-target="#updateinfo" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                                html += '<i class="fas fa-pencil-alt"></i>';
                                html += '</button> &nbsp;';
                            }
                       
            
                            if(funDel == 1) {
                                html += '<button type="button" class="btn btn-icon btn-outline-' + 'danger' + ' waves-effect"  title="Xóa" onclick="' + 'del' + '(' + full['id'] + ')">';
                                html += '<i class="' + 'fas fa-trash-alt' + '"></i>';
                                html += '</button> &nbsp;';
                            }
                 
                        
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
                    sInfoEmpty : "Hiển thị 0 đến 0 của 0 bản ghi",

                
                },
                "oLanguage": {
                    "sZeroRecords": "Không có bản ghi nào"
                  },
            // Buttons with Dropdown
            buttons: buttons,
       
            initComplete: function () {
                // Adding role filter once table initialized
                this.api()
                .columns(2)
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
    function actionMenu(){
       
        var validator = $("#dg").validate(); // reset form
        validator.resetForm();
        $(".error").removeClass("error"); // loại bỏ validate
        $("#addinfo").modal('show');
        $(".modal-title").html('Thêm tài sản mới');
        $('#name').val('');
        $('#don_vi').val('').change();
        $('#nhom_ts').val('').change();
        $('#so_tien').val('');
        $('#khau_hao').val('');
        $('#bao_hanh').val('');
        $('#code').val('');
        url = baseHome + "/asset/add";
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
                "code": {
                    required: true,
                },
                "name": {
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
               
                    number:true,
                    min:1
                },
                "bao_hanh": {
               
                    number:true,
                    min:1
                },
            },
            messages: {
                "code": {
                    required: "Bạn chưa nhập mã tài sản",
                },
                "name": {
                    required: "Bạn chưa nhập tên",
              
                },
                "don_vi": {
                    required: "Bạn chưa nhập đơn vị",
                },
                "so_tien": {
                    required: "Bạn chưa nhập số tiền",
                },
                "nhom_ts": {
                    required: "Bạn chưa chọn tài sản",
                },
                "khau_hao": {
               
                    number:"Yêu cầu nhập số",
                    min:"Giá trị tối thiểu là 1"
                },
                "bao_hanh": {
                    number:"Yêu cầu nhập số",
                    min:"Giá trị tối thiểu là 1"
                }
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



    // Form Validation
    if ($('#IssueForm').length) {
        $('#IssueForm').validate({
            errorClass: "error",
            rules: {
                "nhan_vien": {
                    required: true,
                },
                "asset_issue": {
                    required: true,
                },
                "dat_coc": {
                    required: true,
                },
            },
            messages: {
                "nhan_vien": {
                    required: "Bạn chưa chọn nhân viên",
                },
                "asset_issue": {
                    required: "Bạn chưa chọn tài sản",
                },
               
                "dat_coc": {
                    required: "Bạn chưa nhập tiền đặt cọc",
                },
             
            },
        });

        $('#IssueForm').on("submit", function (e) {
            var isValid = $('#IssueForm').valid();
            e.preventDefault();
            if (isValid) {
                saveIssue();
            }
        });
    }

// validate thông tin tài sản
    if (formInfoAsset.length) {
        formInfoAsset.validate({
            errorClass: "error",
            rules: {
                "name_add": {
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
                "code_add": {
                    required: true,
                },
                "khau_hao_add": {
                    number: true,
                    min:1,
                 
                },
                "sdt": {
                    number: true,
                    min:0,
                    minlength: 10,
                    maxlength: 10
                },
                "bao_hanh_add": {
                    number: true,
                    min:1,
                
                },
            },
            messages: {
                "name_add": {
                    required: "Bạn chưa nhập tên",
                },
                "don_vi_add": {
                    required: "Bạn chưa nhập đơn vị",
                },
               
                "so_tien_add": {
                    required: "Bạn chưa nhập tiền",
                },
                "nhom_ts_add": {
                    required: "Bạn chưa nhập nhóm tài sản",
                },
                "khau_hao_add": {
                    required: "Bạn chưa nhập số lượng tiêu hao",
                },
                "khau_hao_add": {
                    number: "Yêu cầu nhập số",
                    min:"Tối thiểu là 1",
              
                },
                "code_add": {
                    required: "Bạn chưa nhập mã tài sản",
                },
                "bao_hanh_add": {
                    number: "Yêu cầu nhập số",
                    min:"Tối thiểu là 1",
                    
                },
                "sdt": {
                    number: "Yêu cầu nhập số",
                    min:"Yêu cầu nhập số bắt đầu từ 0",
                    minlength: "Yêu cầu nhập đủ 10 số",
                    maxlength: "Yêu cầu nhập đủ 10 số"
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
    // validate group asset

     if ($('#formGroupAsset').length) {
        $('#formGroupAsset').validate({
            errorClass: "error",
            rules: {
                "nameGroupAsset": {
                    required: true,
                },
            },
            messages: {
                "nameGroupAsset": {
                    required: "Bạn chưa điền tên nhóm tài sản",
                },
            },
        });

        $('#formGroupAsset').on("submit", function (e) {
            var isValid = $('#formGroupAsset').valid();
            e.preventDefault();
            if (isValid) {
                addGroupAsset();
            }
        });
    }



    if ($('#formUnitAsset').length) {
        $('#formUnitAsset').validate({
            errorClass: "error",
            rules: {
                "nameUnitAsset": {
                    required: true,
                },
            },
            messages: {
                "nameUnitAsset": {
                    required: "Bạn chưa điền tên nhóm tài sản",
                },
            },
        });

        $('#formUnitAsset').on("submit", function (e) {
            var isValid = $('#formUnitAsset').valid();
            e.preventDefault();
            if (isValid) {
                addUnitAsset();
            }
        });
    }
  // end validate group asset


    // To initialize tooltip with body container
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
        container: "body",
    });
});
function loadGroupAsset() {
    $('#modalGroupAsset').modal('show');
    $('#titleGroupAsset').html('Thêm nhóm tài sản mới');
    $('#nameGroupAsset').val('');
    $('#descGroupAsset').val('');
}
function loadUnitAsset() {
    $('#modalUnitAsset').modal('show');
    $('#titleUnitAsset').html('Thêm đơn vị tài sản mới');
    $('#nameGroupAsset').val('');
    $('#descGroupAsset').val('');
}
function addGroupAsset() {
    var formData = new FormData($('#formGroupAsset')[0]);
    $.ajax({
        url: baseHome + "/asset/addGroupAsset",
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false,
        dataType: "json",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#modalGroupAsset').modal('hide');
                return_combobox_multi_add('#nhom_ts', baseHome + '/asset/nhomtaisan', 'Nhóm tài sản','loadGroupAsset');
               
            } else
                notify_error(data.msg);
        }
    });
}
function addUnitAsset() {
    var formData = new FormData($('#formUnitAsset')[0]);
    $.ajax({
        url: baseHome + "/asset/addUnitAsset",
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false,
        dataType: "json",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#modalUnitAsset').modal('hide');
                return_combobox_multi_add('#don_vi', baseHome + '/asset/don_vi', 'Đơn vị', 'loadUnitAsset');
               
            } else
                notify_error(data.msg);
        }
    });
}
function loaddata(id) {
   if(funEdit != 1) {
       $('#btn_update_asset').css('display','none');
   }
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
            // $('#so_luong_add').val(tai_san.so_luong);
            $('#khau_hao_add').val(tai_san.khau_hao);
            $('#bao_hanh_add').val(tai_san.bao_hanh);
            $("#so_tien_add").val(Comma(tai_san.so_tien));
            $('#ngay_gio_add').val(tai_san.ngay_gio);
            $('#code_add').val(tai_san.code);
            var taisan_info = result.taisan_info; 
            if(taisan_info.hinh_anh != null){
                $('#avatar').attr('src', taisan_info.hinh_anh);
            }else{
                 $('#avatar').attr('src', 'layouts/none_images.png');
            }
            $('#nha_cungcap').val(taisan_info.nha_cungcap);
            $('#dia_chi').val(taisan_info.dia_chi);
            $('#sdt').val(taisan_info.sdt);
            $('#ghi_chu').val(taisan_info.ghi_chu);
            // cập nhật trạng thái cho tài Sản
            $('#statusAsset').html(`
            <option data-color="#FF9F43" value="3">Báo hỏng</option>
            <option data-color="#EA5455" value="4">Báo mất</option>
            <option data-color="#00CFE8" value="1">Khả dụng</option>
            `)
            if(tai_san.tinh_trang == 2) {
                $('#statusAsset').html(`
                <option data-color="#FF9F43" value="3">Báo hỏng</option>
                <option data-color="#EA5455" value="4">Báo mất</option>
                <option data-color="#EA5455" value="2">Đã cấp phát</option>
                <option data-color="#00CFE8" value="1">Khả dụng</option>
                `)
            }
            $('#statusAsset').val(tai_san.tinh_trang).change();
            url = baseHome + '/asset/update?id=' + id;
            loadTableHisIssue(id);
            loadTableHisRecall(id);
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
        cancelButtonText: 'Hủy',
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
function loadIssue($id) {
  $('#idAsset').val($id);
    return_combobox_multi('#asset_issue', baseHome + '/asset/getAsset', 'Tài sản');
    var validator = $("#IssueForm").validate(); // reset form
        validator.resetForm();
        $(".error").removeClass("error"); // loại bỏ validate
        $('#nhan_vien').val('').change();
        $('#asset_issue').val($id).change();
        $('#asset_issue').attr('disabled',true);
        $('#dat_coc').val('');
        $('#descIssue').val('');
}
function saveIssue() {
    var myform = new FormData($("#IssueForm")[0]);
    $.ajax({
        type: "POST",
        dataType: "json",
        data: myform,
        url: baseHome + "/asset/saveIssue",
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#modalIssue').modal('hide');
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

function loadRecall(id) {
    return_combobox_multi('#tai_san_th', baseHome + '/asset/getAsset', 'Tài sản');
    return_combobox_multi('#nhan_vien_th', baseHome + '/asset/getStaff', 'Nhân viên');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/asset/getAssetIssue",
        success: function (data) {
            $('#id_cp').val(data.id);
            $('#id_ts').val(data.tai_san);
            $("#tai_san_th").attr("disabled", true);
            $("#tai_san_th").val(data.tai_san).change();
            $("#nhan_vien_th").attr("disabled", true);
            $("#nhan_vien_th").val(data.nhan_vien).change();
            $('#tra_coc_th').val(formatCurrency(data.dat_coc.replace(/[,VNĐ]/g,'')));
            datePicker.flatpickr({
                dateFormat: 'd-m-Y',
                defaultDate: "today",
            });
            $('#ghi_chu_th').val('');
      
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}
function saveth() {
    var myform = new FormData($("#dg_th")[0]);
    $.ajax({
        type: "POST",
        dataType: "json",
        data: myform,
        url: baseHome + "/asset/saveRecall",
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#modalRecall').modal('hide');
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
function createCodeAsset() {
$('#code').val('');
var codeAsset =  Math.floor(Math.random() * (9999999 - 1000000 + 1)) + 1000000;
$('#code').val(codeAsset);
}
// load issue
function loadTableHisIssue(id) {
    if ($(".asset-issue-list-table").length) {
        $(".asset-issue-list-table").DataTable({
            ajax: baseHome + "/asset/loadListHisIssue?id="+id,
            ordering: false,
            destroy: true,
            "autoWidth": false,
            columns: [
                // columns according to JSON
                { data: "ngay_gio" },
                { data: "code" },
                { data: "name" },
                { data: "nameAsset" },
                { data: "nameStaff" },
                { data: "dat_coc" },
                { data: "tinh_trang"}
                
            ],
            columnDefs: [
                {
                    // Actions
                    targets: 0,
                    orderable: false,
              
                },
                {
                    // Actions
                    targets: 1,
                    orderable: false,
                },
                {
                    // Actions
                    targets: 2,
                    orderable: false,
                    width:200
                },
                {
                    // Actions
                    targets: 3,
                    orderable: false,
               
                },
                {
                    // Actions
                    targets: 5,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(full['dat_coc']);
                        return html;
                    },
                   
                },
                {
                    // Actions
                    targets: 6,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var $status = full["tinh_trang"];
                        var $row_output = '---';
                            if($status == 1) {
                                $row_output = `<div class="badge badge-info">Đang sử dụng</div>`;
                            }
                            else if($status == 2) {
                                $row_output = `<div class="badge badge-warning">Đã thu hồi</div>`;
                            }
                          
                        return $row_output;
                    },
                   
                },
            ],
         
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
            },           
        });
    }
}

// load record
function loadTableHisRecall(id) {
    if ($("#asset-recall-list-table").length) {
        $("#asset-recall-list-table").DataTable({
            ajax: baseHome + "/asset/loadListHisRecall?id="+id,
            ordering: false,
            destroy: true,
            "autoWidth": false,
            columns: [
                // columns according to JSON
                { data: "ngay_gio" },
                { data: "code" },
                { data: "nameIssue" },
                { data: "nameAsset" },
                { data: "tra_coc" },
                { data: "ghi_chu" }
            ],
            columnDefs: [
                {
                    // Actions
                    targets: 0,
                    orderable: false,
              
                },
                {
                    // Actions
                    targets: 1,
                    orderable: false,
                },
                {
                    // Actions
                    targets: 3,
                    orderable: false,
                    width:200
                },
                {
                    // Actions
                    targets: 4,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(full['tra_coc']);
                        return html;
                    },
               
                },
                {
                    // Actions
                    targets: 5,
                    orderable: false,
                   
                   
                },
            ],
         
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
            },        
        });
    }
}


function alertBroken(){
    var myform = new FormData($("#formbaohong")[0]);
    $.ajax({
        url: baseHome + "/asset/alertBroken",
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


