var url = '';
var dtDVTable = $("#dichvu-list-table");
var transactionTable = $("#transaction-list-table");
var khid = '';
$(function () {
    "use strict";
    return_combobox_multi('#branchIdLabor', baseHome + '/recruitmentcamp/getBranch', 'Chi nhánh');
    return_combobox_multi('#departmentIdLabor', baseHome + '/recruitmentcamp/getDepartment', 'Phòng ban');
    return_combobox_multi('#positionIdLabor', baseHome + '/recruitmentcamp/getPosition', 'Vị trí');
    return_combobox_multi('#shiftIdLabor', baseHome + '/recruitmentcamp/getShift', 'Ca làm việc');
    return_combobox_multi('#workPlaceIdLabor', baseHome + '/recruitmentcamp/getworkPlace', 'Địa điểm làm việc');

    return_combobox_multi('#inChargeId', baseHome + '/recruitmentcamp/getStaff', 'Chọn nhân viên chăm sóc');
    return_combobox_multi('#followerId', baseHome + '/recruitmentcamp/getStaff', 'Nhân viên khác');
    return_combobox_multi('#department', baseHome + '/recruitmentcamp/getDepartment', 'Phòng ban');
    return_combobox_multi('#branch', baseHome + '/recruitmentcamp/getBranch', 'Chi nhánh');
    return_combobox_multi('#position', baseHome + '/recruitmentcamp/getPosition', 'Vị trí');
    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");
    var form2 = $("#dg2");
var datePicker = $(".flatpickr-basic");
        if (datePicker.length) {
            datePicker.flatpickr({
                dateFormat: 'd-m-Y',
                defaultDate: "today",
                altFormat: "F j, Y",
            });
        }
        var buttons = [];
        if(funAdd == 1) {
            buttons.push(
                {
                    text: "Thêm mới",
                    className: "add-new btn btn-primary mt-50",
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                    },
                    action: function (e, dt, node, config) {
                        showAdd();
                    },
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
                    title: "Thao tác",
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<div d-flex justify-content-start style="width::150px;text-align:left">';
                       if(funAdd == 1) {
                        // html += '<button type="button"  class="btn btn-icon btn-outline-warning waves-effect" data-toggle="modal" data-target="#modalCandidate" title="Thêm ứng viên" onclick="loadCandidate(' + full['id'] + ')">';
                        // html += '<i class="fas fa-plus"></i>';
                        // html += '</button> &nbsp;';
                       }
                       
                       if(funEdit == 1) {
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                    }
                    if(funDel == 1) {
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="del(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                    }
                        html+= '</div>'
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
            buttons:buttons,

        });

    }
  
    $.validator.addMethod('le', function (value, element, param) {
        return this.optional(element) || value < $(param).val();
    }, 'Invalid value');
    $.validator.addMethod('leluong', function(value, element, param) {
       console.log($(param).val().replaceAll(',', ''));
       var val2 = $(param).val().replaceAll(',', '');
        return this.optional(element) || value.replaceAll(',', '') <= Number(val2);
    }, 'Lương tối thiểu bé hơn lương tối đa');

    // $.validator.addMethod('customNumber', function(value, element, param) {
    //     console.log(value);
    //      return this.optional(element) || value.replaceAll(',', '') > 0;
    //  }, 'Yêu cầu nhập số dương');
    function showAdd() {

        var validator = $("#dg").validate(); // reset form
        validator.resetForm();
        $(".error").removeClass("error"); // loại bỏ validate
        $("#addinfo").modal('show');
        var strStartDate = $('#startDate').val();
        var day = Number(strStartDate.slice(0,2));
        var month = Number(strStartDate.slice(3,5));
        var year = Number(strStartDate.slice(6,10));
       
        $('#endDate').flatpickr({
            dateFormat: 'd-m-Y',
            altFormat: "F j, Y",
            minDate: new Date(year,month,day).fp_incr(1),
            defaultDate: new Date(year,month,day).fp_incr(1),
        });
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
                "quantity": {
                    required: true,
                    number:true,
                    min:1
                },
                "minSalary": {
                    required:true,
                    leluong:"#maxSalary"
                },
                "maxSalary": {
                    required:true,
                },
                minAge: {
                    required:true,
                    number:true,
                    min:18,
                    le: '#maxAge'
                },
                "maxAge": {
                    required:true,
                    number:true,
                    max:40,
                },
                "yearOfExperience": {
                    number:true,
                    min:1
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
               
                "position": {
                    required: "Bạn chưa chọn vị trí",
                },
                "quantity": {
                    required:"Yêu cầu nhập số lượng tuyển dụng",
                    number:"Yêu cầu nhập số",
                    min:"Yêu cầu nhập số tối thiểu 1",
                
                },
                "minAge": {
                    required:"Yêu cầu nhập tuổi tối thiểu",
                    number:"Yêu cầu nhập số",
                    min:"Yêu cầu nhập số tối thiểu 18",
                    le:"Tuổi tối thiểu nhỏ hơn tuổi tối đa"
                },
                "maxAge": {
                    required:"Yêu cầu nhập tuổi tối đa",
                    number:"Yêu cầu nhập số",
                    max:"Yêu cầu độ tuổi tối đa 40"
                },
                "yearOfExperience": {
                    number:"Yêu cầu nhập số",
                    min:"Yêu cầu nhập số dương"
                },
                "minSalary": {
                    required:"Yêu cầu nhập lương tối thiểu",
                },
                "maxSalary": {
                    required:"Yêu cầu nhập lương tối đa",
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
    if (form2.length) {
        form2.validate({
            errorClass: "error",
            rules: {
                "nameLabor": {
                    required: true,
                },
                "typeLabor": {
                    required: true,
                },
                "basicSalaryLabor": {
                    required: true,

                },
                "insuranceSalaryLabor": {
                    required: true,
                },
                "salaryPercentageLabor": {
                    required: true,
                    min:1,
                    max:100
                },
                "allowanceLabor": {
                    required: true,
                },
                "positionIdLabor": {
                    required: true,
                },
                "shiftIdLabor": {
                    required: true,
                },
                "workPlaceIdLabor": {
                    required: true,
                },
                "branchIdLabor": {
                    required: true,
                },
                "departmentIdLabor": {
                    required: true,
                },
            
            },
            messages: {
                "nameLabor": {
                    required: "Bạn chưa nhập tên hợp đồng",
                },
                "typeLabor": {
                    required: "Bạn chưa chọn loại hợp đồng",
                },
                "basicSalaryLabor": {
                    required: "Bạn chưa nhập lương cơ bản",
                },
                "allowanceLabor": {
                    required: "Bạn chưa nhập lương trợ cấp",
                },
         
                "salaryPercentageLabor": {
                    required: "Bạn chưa nhập phần trăm lương",
                    min:"Yêu cầu nhập tối thiểu 1",
                    max:"Yêu cầu nhập tối đa 100"
                },
                "positionIdLabor": {
                    required: "Bạn chưa chọn vị trí",
                },
                "branchIdLabor": {
                    required: "Bạn chưa chọn chi nhánh",
                },
                "departmentIdLabor": {
                    required: "Bạn chưa chọn phòng ban",
                },
                "shiftIdLabor": {
                    required: "Bạn chưa nhập ca làm việc",
                },
                "workPlaceIdLabor": {
                    required: "Bạn chưa nhập địa chỉ làm việc",
                }
            },
        });

        form2.on("submit", function (e) {
            var isValid = form2.valid();
            e.preventDefault();
            if (isValid) {
                signContract();
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
                "quantity1": {
                    required:true,
                    number:true,
                    min:1
                },
                "minSalary1": {
                    required:true,
                    leluong:"#maxSalary1"
                },
                "maxSalary1": {
                    required:true,
                },
                "minAge1": {
                    required:true,
                    number:true,
                    min:18,
                    le: '#maxAge1'
                },
                "maxAge1": {
                    required:true,
                    number:true,
                    max:40,
                },
                "yearOfExperience1": {
                    number:true,
                    min:0
                },
            },
            messages: {
                "title": {
                    required: "Bạn chưa nhập tên chương trình",
                },
                "inChargeId1": {
                    required: "Bạn chưa chọn người phụ trách",
                },
              
                "estimateCost1": {
                    required: "Bạn chưa nhập chi phí ước tính",
                },
                "department1": {
                    required: "Bạn chưa chọn phòng ban",
                },
                "branch1": {
                    required: "Bạn chưa chọn chi nhánh",
                },
                "position1": {
                    required: "Bạn chưa chọn vị trí",
                },
                "quantity1": {
                    required:"Yêu cầu nhập số lượng tuyển dụng",
                    number:"Yêu cầu nhập số",
                    min:"Yêu cầu nhập số tối thiểu 1"
                },
                "minAge1": {
                    required:"Yêu cầu nhập tuổi tối thiểu",
                    number:"Yêu cầu nhập số",
                    min:"Yêu cầu nhập số tối thiểu 18",
                    le:"Tuổi tối thiểu nhỏ hơn tuổi tối đa"
                },
                "maxAge1": {
                    required:"Yêu cầu nhập tuổi tối đa",
                    number:"Yêu cầu nhập số",
                    max:"Yêu cầu độ tuổi tối đa 40"
                },
                "yearOfExperience1": {
                    number:"Yêu cầu nhập số",
                    min:"Yêu cầu nhập số dương"
                },
                "minSalary1": {
                    required:"Yêu cầu nhập lương tối thiểu",
                },
                "maxSalary1": {
                    required:"Yêu cầu nhập lương tối đa",
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

    //validate interview
    if ($('#interviewForm').length) {
        $('#interviewForm').validate({
            errorClass: "error",
        });

        $('#interviewForm').on("submit", function (e) {
            var isValid = $('#interviewForm').valid();
            e.preventDefault();
            if (isValid) {
               saveCalendar();
            }
        });
    }

 

    // To initialize tooltip with body container
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
        container: "body",
    });
    
});

$('#startDate').change(function() {
    $('#endDate').val('');
    

    var strStartDate = $('#startDate').val();
    var day = Number(strStartDate.slice(0,2));
    var month = Number(strStartDate.slice(3,5));
    var year = Number(strStartDate.slice(6,10));
    console.log(new Date());
    $('#endDate').flatpickr({
        dateFormat: 'd-m-Y',
        altFormat: "F j, Y",
        minDate: new Date(year,month,day).fp_incr(1),
    });
})
$('#startDate1').change(function() {
    $('#endDate1').val('');
    var strStartDate = $('#startDate1').val();
    var day = Number(strStartDate.slice(0,2));
    var month = Number(strStartDate.slice(3,5));
    var year = Number(strStartDate.slice(6,10));
    $('#endDate1').flatpickr({
        dateFormat: 'd-m-Y',
        altFormat: "F j, Y",
        minDate: new Date(year,month,day).fp_incr(1),
    });
})
function loaddata(id) {
    return_combobox_multi('#inChargeId1', baseHome + '/recruitmentcamp/getStaff', 'Chọn nhân viên chăm sóc');
    return_combobox_multi('#followerId1', baseHome + '/recruitmentcamp/getStaff', 'Nhân viên khác');
    return_combobox_multi('#department1', baseHome + '/recruitmentcamp/getDepartment', 'Phòng ban');
    return_combobox_multi('#branch1', baseHome + '/recruitmentcamp/getBranch', 'Chi nhánh');
    return_combobox_multi('#position1', baseHome + '/recruitmentcamp/getPosition', 'Vị trí');
    khid = id;
    $("#updateinfo").modal('show');
    $('#information-tab').click();
    $(".modal-title").html('Cập nhật thông tin chiến dịch');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/recruitmentcamp/loaddata",
        success: function (data) {
            $('#title1').val(data.title);
            $('#inChargeId1').val(data.inChargeId).change();
            $('#followerId1').val(data.followerId.split(',')).change();
            $('#estimateCost1').val(data.estimateCost);
            $('#startDate1').val(data.startDate);
            $('#endDate1').val(data.endDate);
            $('#department1').val(data.department).change();
            $('#branch1').val(data.branch).change();
            $('#position1').val(data.position).change();
            $('#workOn1').val(data.workOn);
            $('#minSalary1').val(data.minSalary);
            $('#maxSalary1').val(data.maxSalary);
            $('#quantity1').val(data.quantity);
            if(data.quantity == 0) 
            $('#quantity1').val('');
            $('#minAge1').val(data.minAge);
            if(data.minAge == 0) 
            $('#minAge1').val('');
            $('#maxAge1').val(data.maxAge);
            $('#educationLevel1').val(data.educationLevel);
            $('#professional1').val(data.professional);
            $('#yearOfExperience1').val(data.yearsOfExperience);
            $('#description1').val(data.description);
            $('#viewfile').html('');
            if(data.file != '') {
                var file = baseHome + '/users/gemstech/' +data.file;
                $('#viewfile').html(`<a target="_blank" href="${file}" style="color: blue;">Tải xuống <i class="fas fa-download"></i></a>`)
            }
            loadListCandidate(id);
            loadInterviewResult(id);
            loadRecruimentResult(id);
            $('#campId').val(id);
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}


function loadCandidate(id) {
    return_combobox_multi('#canId', baseHome + '/recruitmentcamp/getCandidate?id='+id, 'Ứng viên');
    $('#canId').val('').change();
    $('#camId').val();
}

function saveCalendar() {

    var data = {
      
        campId: $('#campId').val(),
        canId: $('#applicantId').val(),
        dateTime: $('#dateTime').val() + ' ' + $('#timeInterview').val(),
        interviewerIds: $('#interviewerIds').val(),
        result: $('#result').val(),
        note: $('#noteCalendar').val(),
    };
    $.ajax({
        type: "POST",
        dataType: "json",
        data: data,
        url: baseHome + '/recruitmentcamp/addCalendar',
        success: function (data) {
            if (data.success) {
                $('#add-new-calendar').modal('hide');
                notyfi_success(data.msg);
            } else {
                notify_error(data.msg);
            }
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
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
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: "fullName" },
                { data: "gender" },
                { data: "email" },
                { data: "phoneNumber" },
                { data: "cv" },
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
                {
                    orderable: false,
                    targets: 4,
                    render: function (data, type, full, meta) {
                       var html = '';
                      
                       if(full['cv'] !== '') {
                        var urlfile = baseUrlFile + '/uploads/ungvien/' +full['cv'];
                        html +=  `<div id="viewfile"><a target="_blank" href="${urlfile}" style="color: blue;">Tải xuống <i class="fas fa-download"></i></a> </div>`;
                    }
                    return html;
                    },
                    width:150
                },
                {
                    // Actions
                    targets: 5,
                    orderable: false,
                    render: function (data, type, full, meta) {
                      if(full['status'] == 2) {
                        $row_output = `<div class="badge badge-success">Đã vào làm</div>`;
                      }
                      else if (full['status'] == 1){
                        $row_output = `<div class="badge badge-warning">Chưa vào làm</div>`;
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
                        if(full['status'] == 1) {
                        // html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Thay đổi trạng thái" onclick="changeSt(' + full['id'] + ')">';
                        // html += '<i class="fas fa-arrow-right"></i>';
                        // html += '</button>&nbsp;';

                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Thêm lịch phỏng vấn" onclick="addCalendar(' + full['canId'] + ')">';
                        html += '<i class="fas fa-calendar"></i>';
                        html += '</button>&nbsp;';

                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="delCandidate(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                        }
                        return html;
                    },
                    width: 150
                },
            ],
            buttons: [],
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
                    info: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
                    infoFiltered: "(lọc từ _MAX_ bản ghi)",
                    "sInfoEmpty": "Hiển thị 0 đến 0 của 0 bản ghi",
             
                },
                "oLanguage": {
                    "sZeroRecords": "Không có bản ghi nào"
                  },    
        });
    }
}

function loadInterviewResult(id){
    if ($('#interview-result-table').length) {
        
        $('#interview-result-table').DataTable({
            ordering: false,
            destroy: true,
            autoWidth: false,
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/recruitmentcamp/loadInterviewResult?id="+id,
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
                                html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="checkqty('+ full['id']+ ',' + full['applicantId'] +','+ full['campId'] + ')">';
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
                    info: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
                    infoFiltered: "(lọc từ _MAX_ bản ghi)",
                    "sInfoEmpty": "Hiển thị 0 đến 0 của 0 bản ghi",
             
                },
                "oLanguage": {
                    "sZeroRecords": "Không có bản ghi nào"
                  }, 
            // Buttons with Dropdown
            buttons: [],
           
        
        });
    
    }
}

function loadRecruimentResult(id){
    if ($('#recruiment-result-table').length) {
        
        $('#recruiment-result-table').DataTable({
            ordering: false,
            destroy: true,
            autoWidth: false,
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/recruitmentcamp/loadRecruimentResult?id="+id,
            columns: [
                { data: "quantity" },
                { data: "countInterview" },
                { data: "countqualified" },
                { data: "countReceived" },
             
            ],
            // columnDefs: [
               
           
                
               
               
            // ],
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
                    info: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
                    infoFiltered: "(lọc từ _MAX_ bản ghi)",
                    "sInfoEmpty": "Hiển thị 0 đến 0 của 0 bản ghi",
             
                },
                "oLanguage": {
                    "sZeroRecords": "Không có bản ghi nào"
                  }, 
            // Buttons with Dropdown
            buttons: [],
           
        
        });
    
    }
}


function addCalendar(id) {
 
  $('#applicantId').val(id);
    return_combobox_multi('#interviewerIds', baseHome + '/interview/getStaff', 'Chọn người phỏng vấn');
  $('#add-new-calendar').modal('show');
  $('.modal-title-calendar').html('Thêm lịch phỏng vấn cho ứng viên')
  $('#timeInterview').flatpickr({
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    defaultDate: "12:00"
});
 //ngày
 $('#dateTime').flatpickr({
    enableTime: true,
    dateFormat: "d-m-Y",
    defaultDate: "today",
    minDate: "today"
});
}

function changeSt(id) {
    $.ajax({
        url: baseHome + "/recruitmentcamp/changeSt",
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
        cancelButtonText: 'Hủy',
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

function load(id,applicantId) {

    document.getElementById("dg2").reset(); 
    if ($('.ngay_gio').length) {
        $('.ngay_gio').flatpickr({
            dateFormat: 'd-m-Y',
            defaultDate: "today",
        });
    }
    $('#updateinfo2').modal('show');
    var validator = $( "#dg2" ).validate(); // reset form
    validator.resetForm();
    $(".error").removeClass("error"); // loại bỏ validate
    $(".modal-title").html('Ký hợp đồng lao động');
    $('#branchIdLabor').val('').trigger('change');
    $('#departmentIdLabor').val('').trigger('change');
    $('#positionIdLabor').val('').trigger('change');
    $('#workPlaceIdLabor').val('').trigger('change');
    $('#shiftIdLabor').val('').trigger('change');
    $('#typeLabor').val('').trigger('change');
    url = baseHome + '/recruitmentcamp/signContract?id='+id+'&applicantId=' + applicantId;
}

function signContract() {
    var myform = new FormData($("#dg2")[0]);
    
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
                $('#updateinfo2').modal('hide');
                $('.interview-result-table').DataTable().ajax.reload(null, false);
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
        url: baseHome + '/recruitmentcamp/tranferStaff',
        data: {applicantId:applicantId},
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('.interview-result-table').DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
        error: function () {
            notify_error('Cập nhật không thành công');
        }
    });
}


// $('.format_number').on('input', function(e){        
//     $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g,'')));
//   }).on('keypress',function(e){
//     if(!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
//   }).on('paste', function(e){    
//     var cb = e.originalEvent.clipboardData || window.clipboardData;      
//     if(!$.isNumeric(cb.getData('text'))) e.preventDefault();
//   });
//   function formatCurrency(number){
//     var n = number.split('').reverse().join("");
//     var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");    
//     return  n2.split('').reverse().join('');
// }
//check số lượng ứng viên trong chiến dịch

function checkqty(id,applicantId,campId) {

    $.ajax({
        type: "POST",
        dataType: "json",
        url: baseHome + '/recruitmentcamp/checkQty',
        data: {id:campId},
        success: function (data) {
            if (data.success) {
                load(id,applicantId);
            }
        },
        error: function () {
            notify_error('Số lượng ứng viên đã đủ trong chiến dịch này');
        }
       
    });
 
}
