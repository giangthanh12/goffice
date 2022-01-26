var url = '';

$(function () {
    return_combobox_multi('#branchId', baseHome + '/interview_result/getBranch', 'Chi nhánh');
    return_combobox_multi('#departmentId', baseHome + '/interview_result/getDepartment', 'Phòng ban');
    return_combobox_multi('#position', baseHome + '/interview_result/getPosition', 'Vị trí');
    return_combobox_multi('#shiftId', baseHome + '/interview_result/getShift', 'Ca làm việc');
    return_combobox_multi('#workPlaceId', baseHome + '/interview_result/getworkPlace', 'Địa điểm làm việc');
    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        datePicker = $(".ngay_gio"),
        nhan_vien = $("#nhan_vien"),
        tai_san = $("#tai_san"),
        nhan_vien_th = $("#nhan_vien_th"),
        tai_san_th = $("#tai_san_th"),
        form = $("#dg");
       
     // datepicker init
    if (datePicker.length) {
        datePicker.flatpickr({
            dateFormat: 'd-m-Y',
            defaultDate: "today",
        });
    }
    $('#type').select2({
        placeholder: 'Hợp đồng'
    });

    // Users List datatable
    if (dtUserTable.length) {
        
        dtUserTable.DataTable({
            ordering: false,
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/interview_result/list",
            columns: [
                { data: "fullName" },
                { data: "gender" },
                { data: "dateTime" },
                { data: "title" },
                { data: "phoneNumber" },
                { data: "result" },
                { data: ""}
             
            ],
            columnDefs: [
               
           
                {
                    targets: 1,
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
                {
                    // User full name and username
                    targets: 5,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $status = full["result"];
                        var $row_output = '---';
                            if($status == 2) {
                                $row_output = `<div class="badge badge-success">Đạt</div>`;
                            }
                            else if($status == 3) {
                                $row_output = `<div class="badge badge-warning">Không đạt</div>`;
                            }
                            else if($status == 4) {
                                $row_output = `<div class="badge badge-danger">Từ chối</div>`;
                            }
                            else if($status == 5) {
                                $row_output = `<div class="badge badge-info">Ký hợp đồng</div>`;
                            }
                          
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
                        if(full['result'] == 2 ) {
                            if(funSign == 1) {
                                html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="checkqty('+ full['id']+ ',' + full['applicantId'] + ')">';
                                html += 'Ký hợp đồng';
                                html += '</button> &nbsp;';
                            }
                           
                        }
                        // if(full['result'] == 5 ) {
                        //     html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['applicantId'] + ')">';
                        //     html += 'Ký hợp đồng';
                        //     html += '</button> &nbsp;';
                        // }
                        return html;
                    },
                    // width: 150
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
            buttons: [],
           
        
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
                "type": {
                    required: true,
                },
                "basicSalary": {
                    required: true,

                },
                "insuranceSalary": {
                    required: true,
                },
                "salaryPercentage": {
                    required: true,
                    min:1,
                    max:100
                },
                "allowance": {
                    required: true,
                },
                "position": {
                    required: true,
                },
                "shiftId": {
                    required: true,
                },
                "workPlaceId": {
                    required: true,
                },
                "branchId": {
                    required: true,
                },
                "departmentId": {
                    required: true,
                },
            
            },
            messages: {
                "name": {
                    required: "Bạn chưa nhập tên hợp đồng",
                },
                "type": {
                    required: "Bạn chưa chọn loại hợp đồng",
                },
                "basicSalary": {
                    required: "Bạn chưa nhập lương cơ bản",
                },
                "allowance": {
                    required: "Bạn chưa nhập lương trợ cấp",
                },
         
                "salaryPercentage": {
                    required: "Bạn chưa nhập phần trăm lương",
                    min:"Yêu cầu nhập tối thiểu 1",
                    max:"Yêu cầu nhập tối đa 100"
                },
                "position": {
                    required: "Bạn chưa chọn vị trí",
                },
                "branchId": {
                    required: "Bạn chưa chọn chi nhánh",
                },
                "departmentId": {
                    required: "Bạn chưa chọn phòng ban",
                },
                "shiftId": {
                    required: "Bạn chưa nhập ca làm việc",
                },
                "workPlaceId": {
                    required: "Bạn chưa nhập địa chỉ làm việc",
                }
            },
        });

        form.on("submit", function (e) {
            var isValid = form.valid();
            e.preventDefault();
            if (isValid) {
                signContract();
            }
        });
    }

    // To initialize tooltip with body container
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
        container: "body",
    });
});

function loaddata(id,applicantId) {

    document.getElementById("dg").reset(); 
    if ($('.ngay_gio').length) {
        $('.ngay_gio').flatpickr({
            dateFormat: 'd-m-Y',
            defaultDate: "today",
        });
    }
    $('#updateinfo').modal('show');
    var validator = $( "#dg" ).validate(); // reset form
    validator.resetForm();
    $(".error").removeClass("error"); // loại bỏ validate
    $(".modal-title").html('Ký hợp đồng lao động');
    $('#branchId').val('').trigger('change');
    $('#departmentId').val('').trigger('change');
    $('#position').val('').trigger('change');
    $('#workPlaceId').val('').trigger('change');
    $('#shiftId').val('').trigger('change');
    $('#type').val('').trigger('change');
    url = baseHome + '/interview_result/signContract?id='+id+'&applicantId=' + applicantId;
}
function signContract() {
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
function tranferStaff(applicantId) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: baseHome + '/interview_result/tranferStaff',
        data: {applicantId:applicantId},
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
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
//check số lượng ứng viên trong chiến dịch

function checkqty(id,applicantId) {

    $.ajax({
        type: "POST",
        dataType: "json",
        url: baseHome + '/interview_result/checkQty',
        data: {id:id},
        success: function (data) {
            if (data.success) {
                loaddata(id,applicantId);
            }
        },
        error: function () {
            notify_error('Số lượng ứng viên đã đủ trong chiến dịch này');
        }
       
    });
 
}












