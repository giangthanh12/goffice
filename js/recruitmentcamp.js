var url = '';
var dtDVTable = $("#dichvu-list-table");
var transactionTable = $("#transaction-list-table");
var khid = '';
$(function () {
    "use strict";
    return_combobox_multi('#inChargeId', baseHome + '/recruitmentcamp/getStaff', 'Chọn nhân viên chăm sóc');
    return_combobox_multi('#followerId', baseHome + '/recruitmentcamp/getStaff', 'Nhân viên khác');
    return_combobox_multi('#department', baseHome + '/recruitmentcamp/getDepartment', 'Phòng ban');
    return_combobox_multi('#branch', baseHome + '/recruitmentcamp/getBranch', 'Chi nhánh');
    return_combobox_multi('#position', baseHome + '/recruitmentcamp/getPosition', 'Vị trí');
    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");
var   datePicker = $(".flatpickr-basic");
        if (datePicker.length) {
            datePicker.flatpickr({
                dateFormat: 'd-m-Y',
                defaultDate: "today",
            });
        }
    // Users List datatable
    if (dtUserTable.length) {
     var table =   dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/recruitmentcamp/list",
            autoWidth: false,
            ordering: false,
            columns: [
                { data: 'creator' },
                { data: 'title' },
                { data: 'position' },
                { data: 'department' },
                { data: 'startDate' },
                { data: 'stopDate' },
                { data: 'quantity' },
                { data: ""}
            ],
            columnDefs: [
                {
                   targets: 0,
                   width: "12.5%"

                },

                {
            
                    targets: 1,
                    // responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full["title"];
                        
                        // Creates full output for row
                        var $row_output =
                            '<div  class="text-wrap width-200">' +
                           
                            '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ')" data-toggle="modal" data-target="#updateinfo" class="user_name text-truncate"><span class="text-wrap width-200 font-weight-bold">' +
                            $name +
                            "</span></a>" +
                            '' +
                          
                            "</small>" +
                           
                            "</div>";
                        return $row_output;
                    },
                    width: "12.5%"
                   
                },
                {
                    targets: 2,
                    width: "12.5%"
 
                 },
                 {
                    targets: 3,
                    width: "12.5%"
 
                 },
                 {
                    targets: 4,
                    width: "12.5%"
 
                 },
                 {
                    targets: 5,
                    width: "12.5%"
 
                 },
                 {
                    targets: 6,
                    width: "5%"
 
                 },
              
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3  text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<div d-flex justify-content-start style="width::150px;text-align:left">';
                        html += '<button type="button"  class="btn btn-icon btn-outline-warning waves-effect" data-toggle="modal" data-target="#modalCandidate" title="Thêm ứng viên" onclick="loadCandidate(' + full['id'] + ')">';
                        html += '<i class="fas fa-plus"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="del(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button></div>';
                        return html;
                    },
                    width: "20%"
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
                },
            // Buttons with Dropdown
            buttons: [
                {
                    text: "Thêm mới",
                    className: "add-new  btn btn-primary mt-50",
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                    },
                    action: function (e, dt, node, config) {
                        $("#addinfo").modal('show');
                        $(".modal-title").html('Thêm chiến dịch tuyển dụng mới');
                        $('#title').val('');
                        $('#inChargeId').val('').change();
                        $('#followerId').val('').change();
                        $('#estimateCost').val('');
                        $('#department').val('').change();
                        $('#branch').val('').change();
                        $('#branch').val('').change();
                        $('#position').val('').change();
                        $('#minSalary').val('');
                        $('#maxSalary').val('');
                        $('#quantity').val('');
                        $('#minAge').val('');
                        $('#maxAge').val('');
                        $('#professional').val('');
                        $('#yearOfExperience').val('');
                        $('#status').val('1').attr("disabled", true);
                    },
                },
                // {
                //     text: "Nhập excel",
                //     className: " btn  btn-primary mt-50",
                //     init: function (api, node, config) {
                //         $(node).removeClass("btn-secondary");
                //     },
                //     action: function (e, dt, node, config) {
                //         nhapexcel();
                //     },
                // },
            ],

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

    // Form Validation add 
    if (form.length) {
        form.validate({
            errorClass: "error",
            rules: {
                "title": {
                    required: true,
                },
                "inChargeId": {
                    required: true,
                },
                "followerId": {
                    required: true,
                },
                "estimateCost": {
                    required: true,
                },
                "department": {
                    required: true,
                },
                "branch": {
                    required: true,
                },
                "position": {
                    required: true,
                },
            },
            messages: {
                "title": {
                    required: "Bạn chưa nhập tên chương trình",
                },
                "inChargeId": {
                    required: "Bạn chưa chọn người phụ trách",
                },
                "estimateCost": {
                    required: "Bạn chưa nhập chi phí ước tính",
                },
                "department": {
                    required: "Bạn chưa chọn phòng ban",
                },
                "branch": {
                    required: "Bạn chưa chọn chi nhánh",
                },
                "salaryPercentage": {
                    required: "Bạn chưa nhập phần trăm lương",
                },
                "position": {
                    required: "Bạn chưa chọn vị trí",
                },
               
            },
        });

        form.on("submit", function (e) {
            var isValid = form.valid();
            e.preventDefault();
            if (isValid) {
                saveadd();
            }
        });
    }
    //form validate edit
    if ($('#dg1').length) {
        $('#dg1').validate({
            errorClass: "error",
            rules: {
                "title1": {
                    required: true,
                },
                "inChargeId1": {
                    required: true,
                },
                "followerId1": {
                    required: true,
                },
                "estimateCost1": {
                    required: true,
                },
                "department1": {
                    required: true,
                },
                "branch1": {
                    required: true,
                },
                "position1": {
                    required: true,
                },
            },
        });

        $('#dg1').on("submit", function (e) {
            var isValid = $('#dg1').valid();
            e.preventDefault();
            if (isValid) {
                saveedit();
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
    return_combobox_multi('#inChargeId1', baseHome + '/recruitmentcamp/getStaff', 'Chọn nhân viên chăm sóc');
    return_combobox_multi('#followerId1', baseHome + '/recruitmentcamp/getStaff', 'Nhân viên khác');
    return_combobox_multi('#department1', baseHome + '/recruitmentcamp/getDepartment', 'Phòng ban');
    return_combobox_multi('#branch1', baseHome + '/recruitmentcamp/getBranch', 'Chi nhánh');
    return_combobox_multi('#position1', baseHome + '/recruitmentcamp/getPosition', 'Vị trí');
    khid = id;
    $("#updateinfo").modal('show');
    $('#information-tab').click();
    $(".modal-title").html('Cập nhật thông tin khách hàng');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/recruitmentcamp/loaddata",
        success: function (data) {
            var file = baseHome + '/users/gemstech/' +data.file;
            $('#title1').val(data.title);
            $('#inChargeId1').val(data.inChargeId).change();
            $('#followerId1').val(data.followerId.split(',')).change();
            $('#estimateCost1').val(formatCurrency(data.estimateCost.replace(/[,VNĐ]/g,'')));
            $('#startDate1').val(data.startDate);
            $('#endDate1').val(data.endDate);
            $('#department1').val(data.department).change();
            $('#branch1').val(data.branch).change();
            $('#position1').val(data.position).change();
            $('#workOn1').val(data.workOn);
            $('#minSalary1').val(formatCurrency(data.minSalary.replace(/[,VNĐ]/g,'')));
            $('#maxSalary1').val(formatCurrency(data.maxSalary.replace(/[,VNĐ]/g,'')));
            $('#quantity1').val(data.quantity);
            $('#minAge1').val(data.minAge);
            $('#maxAge1').val(data.maxAge);
            $('#educationLevel1').val(data.educationLevel);
            $('#professional1').val(data.professional);
            $('#yearOfExperience1').val(data.yearsOfExperience);
            $('#description1').val(data.description);
            $('#status1').val(data.status).attr("disabled", true);
            $('#viewfile').html(`<a target="_blank" href="${file}" style="color: blue;">Tải xuống <i class="fas fa-download"></i></a>`)
            loadListCandidate(id);
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}


function loadCandidate(id) {
    return_combobox_multi('#canId', baseHome + '/recruitmentcamp/getCandidate?id='+id, 'Ứng viên');
    $('#canId').val('').change();
    $('#camId').val(id);
}


//load transaction


function saveadd() {
    var formData = new FormData($("#dg")[0]); 
    $.ajax({
        type: "POST",
        dataType: "json",
        data: formData,
        url: baseHome + "/recruitmentcamp/add",
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('.modal').modal('hide');
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

function addCandidate() {
    var myform = new FormData($("#formCandidate")[0]);
    $.ajax({
        url: baseHome + "/recruitmentcamp/addCandidate",
        type: 'post',
        data: myform,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $("#modalCandidate").modal('hide');
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
function saveedit() {
    var formData = new FormData($("#dg1")[0]); 
    $.ajax({
        type: "POST",
        dataType: "json",
        data: formData,
        contentType: false,
        processData: false,
        url: baseHome + '/recruitmentcamp/update?id=' + khid,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('.modal').modal('hide');
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


function loadListCandidate(id) {


    if ($(".asset-candidate-list-table").length) {
        $(".asset-candidate-list-table").DataTable({
            ajax: baseHome + "/recruitmentcamp/loadListCandidate?id="+id,
            ordering: false,
            destroy: true,
            "autoWidth": false,
            columns: [
                // columns according to JSON
                { data: "fullName" },
                { data: "gender" },
                { data: "email" },
                { data: "phoneNumber" },
                { data: "status" },
                { data: ""}
        
            ],
            columnDefs: [
                // {
                //     // Actions
                //     targets: 0,
                //     orderable: false,
              
                // },
                {
                    // Actions
                    targets: 1,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var $status = full["gender"];
                        if ($status == 1) {
                            return 'Nam';
                        } else if ($status == 2) {
                            return 'Nữ';
                        } else {
                            return '';
                        }
                    },
                },
                // {
                //     // Actions
                //     targets: 2,
                //     orderable: false,
                //     width:200
                // },
                // {
                //     // Actions
                //     targets: 3,
                //     orderable: false,
               
                // },
                {
                    // Actions
                    targets: 4,
                    orderable: false,
                    render: function (data, type, full, meta) {
                      if(full['status'] == 1) {
                        $row_output = `<div class="badge badge-success">Đã vào làm</div>`;
                      }
                      else if (full['status'] == 2){
                        $row_output = `<div class="badge badge-warning">Chưa vào làm</div>`;
                      }
                      return $row_output;
                    },
                   
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-center text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="delCandidate(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                        return html;
                    },
                    width: 150
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
function delCandidate(id) {
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
                url: baseHome + "/recruitmentcamp/delCandidate",
                type: 'post',
                dataType: "json",
                data: { id: id },
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.msg);
                        $(".asset-candidate-list-table").DataTable().ajax.reload(null, false);
                    }
                    else
                        notify_error(data.msg);
                },
            });
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
                url: baseHome + "/recruitmentcamp/del",
                type: 'post',
                dataType: "json",
                data: { id: id },
                success: function (data) {
                    if (data.success) {
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

function nhapexcel() {
    $("#nhapexcel").modal('show');
    $("#modal-title1").html('Nhập khách hàng từ file excel');
}

function savenhap() {
    var myform = new FormData($("#fm-nhapexcel")[0]);
    $.ajax({
        type: "POST",
        dataType: "json",
        data: myform,
        url: baseHome + "/customer/importExcel",
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#nhapexcel').modal('hide');
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

function load_select2(select2, url, place) {
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: url,
        success: function (data) {
           var html ='';
            if(place != '')
            html = '<option value="0" >Tất cả</option>';
            data.forEach(function (element, index) {
                if (element.selected==true) 
                var select = 'selected';
                html += `<option data-img="${element.hinh_anh}" ${select} value="${element.id}">${element.text}</option> `;
            });
     
            select2.html(html);
            select2.wrap('<div class="position-relative"></div>').select2({
                placeholder: place,
                dropdownParent: select2.parent(),
              
            });
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