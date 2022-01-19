var url = '';

$(function () {
    return_combobox_multi('#branchId', baseHome + '/interview_result/getBranch', 'Phòng ban');
    return_combobox_multi('#departmentId', baseHome + '/interview_result/getDepartment', 'Chi nhánh');
    return_combobox_multi('#position', baseHome + '/interview_result/getPosition', 'Vị trí');
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


    // Users List datatable
    if (dtUserTable.length) {
        
        dtUserTable.DataTable({
            ordering: false,
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/interview_result/list",
            columns: [
                { data: "fullName" },
                { data: "gender" },
                { data: "email" },
                { data: "phoneNumber" },
                { data: "result" },
                { data: ""}
             
            ],
            columnDefs: [
               
                // {
                //     // User full name and username
                //     targets: 2,
                //     responsivePriority: 4,
                //     render: function (data, type, full, meta) {
                //         var $name = full["nameAsset"];
                //         // Creates full output for row
                //         var $row_output =
                //             '<div class="d-flex justify-content-left align-items-center">' +
                //             '<div class="d-flex flex-column">' +
                //             '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ')" data-toggle="modal" data-target="#updateinfo" class="user_name text-truncate"><span class="font-weight-bold">' +
                //             $name +
                //             "</span></a>" +
                            
                //             "</div>" +
                //             "</div>";
                //         return $row_output;
                //     },
                // },
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
                    targets: 4,
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
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-center text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        if(full['result'] == 2 ) {
                            html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata('+ full['id']+ ',' + full['applicantId'] + ')">';
                            html += 'Ký hợp đồng';
                            html += '</button> &nbsp;';
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
                },
                "allowance": {
                    required: true,
                },
                "position": {
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
                    required: "Bạn chưa nhập lương cơ bản",
                },
                "insuranceSalary": {
                    required: "Bạn chưa nhập lương phụ cấp",
                },
                "salaryPercentage": {
                    required: "Bạn chưa nhập phần trăm lương",
                },
                "position": {
                    required: "Bạn chưa chọn vị trí",
                },
                "branchId": {
                    required: "Bạn chưa chọn chi nhánh",
                },
                "departmentId": {
                    required: "Bạn chưa chọn phòng ban",
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
    if (datePicker.length) {
        datePicker.flatpickr({
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














