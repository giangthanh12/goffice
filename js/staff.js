/*=========================================================================================
    File Name: app-user-list.js
    Description: User List page
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent

==========================================================================================*/
$(function () {
    return_combobox_multi('#idAddress', baseHome + '/staff/getProvince', 'Nơi cấp');
    return_combobox_multi('#nationality', baseHome + '/staff/getNational', 'Quốc gia');
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/staff/accessPoints",
        success: function (data) {
            $("#accesspoints").select2({
                data: data
            });
        },
    });
    "use strict";

    var dtUserTable = $(".user-list-table"),
        newUserSidebar = $(".new-user-modal"),
        newUserForm = $(".add-new-user"),

        // selectArray = $('.select2-data-array'),

        statusObj = {
            1: {title: "Thực tập sinh", class: "badge-light-warning"},
            2: {title: "Thử việc", class: "badge-light-success"},
            3: {title: "Chính thức", class: "badge-light-secondary"},
        };
    var basicPickr = $('.flatpickr-basic');
    // Default
    if (basicPickr.length) {
        basicPickr.flatpickr({
            dateFormat: "d/m/Y",
            defaultDate:"today"
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
        dtUserTable.DataTable({
            ajax: baseHome + "/staff/getData",
            ordering: false, // bỏ sắp xếp mặc định

            columns: [
                // columns according to JSON
                {data: "name"},
                {data: "staffCode"},
                {data: "email"},
                {data: "phoneNumber"},
                {data: "status"},
                {data: ""},
            ],
            columnDefs: [


                {
                    // User full name and username
                    targets: 0,

                    render: function (data, type, full, meta) {
                        var $name = full["name"], $image = baseHome + '/layouts/useravatar.png';
                        if (full["avatar"] != '')
                            $image = baseUrlFile + '/uploads/nhanvien/' + full["avatar"];
                        var $output = '<img onerror=' + "this.src=\''+baseHome+'/layouts/useravatar.png'" + ' src="' + $image + '" alt="Avatar" height="32" width="32">';
                        // if ($image) {
                        // For Avatar image

                        // var $output = '<img src="' + assetPath + "images/avatars/" + $image + '" alt="Avatar" height="32" width="32">';
                        // } else {
                        // For Avatar badge
                        // var stateNum = Math.floor(Math.random() * 6) + 1;
                        // var states = ["success", "danger", "warning", "info", "dark", "primary", "secondary"];
                        // var $state = states[stateNum],
                        //     $name = full["name"],
                        //     $initials = $name.match(/\b\w/g) || [];
                        // $initials = (($initials.shift() || "") + ($initials.pop() || "")).toUpperCase();
                        // $output = '<span class="avatar-content">' + $initials + "</span>";
                        // }
                        // var colorClass = $image === "" ? " bg-light-" + $state + " " : "";
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="avatar-wrapper">' +
                            '<div class="avatar ' +
                            '' +
                            ' mr-1">' +
                            $output +
                            "</div>" +
                            "</div>" +
                            '<div class="d-flex flex-column">' +
                            '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ');" data-toggle="modal" data-target="#updateinfo" class="user_name text-truncate"><span class="font-weight-bold">' +
                            $name +
                            "</span></a>" +

                            "</div>" +
                            "</div>";
                        return $row_output;
                    },
                },
                {
                    // User Role
                    targets: 3,
                    render: function (data, type, full, meta) {
                        var $phone = full["phoneNumber"];
                        if ($phone != '') {
                            var roleBadgeObj = {
                                Phone: feather.icons["phone"].toSvg({class: "font-medium-3 text-primary mr-50"}),
                            };
                            return "<span class='text-truncate align-middle'>" + roleBadgeObj['Phone'] + $phone + "</span>";
                        } else
                            return "";
                    },
                },
                {
                    // User Role
                    targets: 2,
                    render: function (data, type, full, meta) {
                        var $email = full["email"];
                        if ($email != '') {
                            return "<span class='text-truncate align-middle'>" + feather.icons["mail"].toSvg({class: "font-medium-3 text-primary mr-50"}) + $email + "</span>";
                        } else
                            return "";
                    },
                },
                {
                    // Staff Status
                    targets: 4,
                    render: function (data, type, full, meta) {
                        var $status = full["status"];
                        var $text = '';
                        switch ($status) {
                            case '1':
                                $text = "Thực tập sinh";
                                break;
                            case '2':
                                $text = "Thử việc";
                                break;
                            case '3':
                                $text = "Chính thức";
                                break;
                            case '4':
                                $text = "Cộng tác viên";
                                break;
                            case '5':
                                $text = "Thời vụ";
                                break;
                            case '6':
                                $text = "Tạm ngừng";
                                break;
                            case '7':
                                $text = "Thôi việc";
                                break;
                            default:
                                $text = "";
                                break;
                        }
                        return "<span class='text-truncate align-middle'>" + $text + "</span>";
                    },
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({class: "font-medium-3 text-success mr-50"}),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        // userFuns.forEach(function (item){
                        //     if(item.type==2) {
                        //         html += '<button type="button" class="btn btn-icon btn-outline-' + item.color + ' waves-effect"  title="Chỉnh sửa" onclick="' + item.function + '(' + full['id'] + ')">';
                        //         html += '<i class="' + item.icon + '"></i>';
                        //         html += '</button> &nbsp;';
                        //     }
                        // })
                        html += '<div d-flex justify-content-start style="width::150px;text-align:left">';
                        if(funEdit == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                            html += '<i class="fas fa-pencil-alt"></i>';
                            html += '</button> &nbsp;';
                        }
                        if (funDel == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="del(' + full['id'] + ')">';
                            html += '<i class="fas fa-trash-alt"></i>';
                            html += '</button>';
                        }
                        html+= '</div>';
                       
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
                info: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
            },
            // Buttons with Dropdown
            buttons: buttons,
            // For responsive popup

            initComplete: function () {

            },
        });
    }

function showAdd() {
    $('#modals-slide-in').modal('show');
    $("#name").val('');
    $("#code").val('');
    $('#phoneNumber').val('');
    $('#email').val('');
    $('#birthday').val('');
    $("input[type='radio'][name='gender']:checked").val();
    $('#status').val(1);
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
    if (newUserForm.length) {
        newUserForm.validate({
          errorClass: "error",
          rules: {
            staffCode: {
              required: true,
            },
            name: {
              required: true,
            },
            email: {
              required: true,
              email: true,
            },
            birthday: {
              required: true,
            },
            phoneNumber: {
              required: true,
              number: true,
              min: 0,
            },
          },
          messages: {
            staffCode: {
              required: "Bạn chưa nhập mã nhân viên",
            },
            name: {
              required: "Bạn chưa nhập họ tên!",
            },
            email: {
              required: "Bạn chưa nhập email!",
              email: "Yêu cầu nhập email!",
            },
            birthday: {
              required: "Bạn chưa nhập ngày sinh!",
            },
            phoneNumber: {
              required: "Bạn chưa nhập số điện thoại!",
              number: "Yêu cầu nhập số!",
              min: "Yêu cầu nhập số bắt đầu từ 0!",
            },
          },
        });

        newUserForm.on("submit", function (e) {
            var isValid = newUserForm.valid();
            e.preventDefault();
            if (isValid) {
                // newUserSidebar.modal("hide");
                addStaff();
            }
        });
    }


// Form Validation
    if ($('#formInfoStaff').length) {
        $('#formInfoStaff').validate({
            errorClass: "error",
            rules: {
                "name1": {
                    required: true,
                },
                "email1": {
                    required: true,
                    email: true,
                },
                "birthday": {
                    required: true,
                },
                "phoneNumber1": {
                    required: true,
                    number: true,
                    min: 0
                },
                "vssId": {
                    number: true,
                    min: 0
                },
                "taxCode": {
                    number: true,
                    min: 0
                },
                "idCard": {
                    number: true,
                    min: 0
                },
            },
            messages: {
                "name1": {
                    required: "Bạn chưa nhập tên!",
                },
                "email1": {
                    required: "Bạn chưa nhập email!",
                    email: "Yêu cầu nhập email!"
                },
                "birthday": {
                    required: "Bạn chưa nhập ngày sinh!",
                },
                "phoneNumber1": {
                    required: "Bạn chưa nhập số điện thoại!",
                    number: "Yêu cầu nhập số!",
                    min: "Yêu cầu nhập số bắt đầu từ 0!",
                },
                "vssId": {
                    number: "Yêu cầu nhập số!",
                    min: "Yêu cầu nhập số bắt đầu từ 0!",
                },
                "taxCode": {
                    number: "Yêu cầu nhập số!",
                    min: "Yêu cầu nhập số bắt đầu từ 0!",
                },
                "idCard": {
                    number: "Yêu cầu nhập số",
                    min: "Yêu cầu nhập số bắt đầu từ 0!",
                },
            },
        });

        $('#formInfoStaff').on("submit", function (e) {
            var isValid = $('#formInfoStaff').valid();
            e.preventDefault();
            if (isValid) {
                updateinfo();
            }
        });
    }



    if ($('#formContract').length) {
        $('#formContract').validate({
            errorClass: "error",
            rules: {
                "nameContract": {
                    required: true,
                },
                "type": {
                    required: true,
                },
              
                "staffId": {
                    required: true,
                },
                "departmentId": {
                    required: true,
                },
                "position": {
                    required: true,
                },
                "branchId": {
                    required: true,
                },
              
                "workPlaceId": {
                    required: true,
                },
                "shiftId": {
                    required: true,
                },
                "basicSalary": {
                    required: true,
                },
                "salaryPercentage": {
                    required: true,
                },
              
                "allowance": {
                    required: true,
                },
                "startDate": {
                    required: true,
                },
              
                "stopDate": {
                    required: true,
                },
               
            },
            messages: {
                "nameContract": {
                    required: "Bạn chưa nhập tên hợp đồng ",
                },
                "basicSalary": {
                    required: "Bạn chưa nhập lương cơ bản",
                },
                "allowance": {
                    required: "Bạn chưa nhập phụ cấp",
                },
                "salaryPercentage": {
                    required: "Bạn chưa nhập % lương",
                },
                "startDate": {
                    required: "Bạn chưa nhập ngày bắt đầu",
                },
              
                "stopDate": {
                    required: "Bạn chưa nhập ngày kết thúc",
                },
            },
           
        });
    
        $('#formContract').on("submit", function (e) {
            var isValid = $('#formContract').valid();
            e.preventDefault();
            if (isValid) {
                saveContract();
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
    if(funEdit != 1) {
        $('#updateStaff').css('display', 'none');
        $('#update_nhanvien_info').css('display','none');
    }
    $('#updateinfo').modal('show');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {id: id},
        url: baseHome + "/staff/loaddata",
        success: function (result) {
          var data = result.nhanvien;

          $("#nhanvien").html(data.name);
          if (data.avatar != "")
            var $avatar = baseUrlFile + "/uploads/nhanvien/" + data.avatar;
          else var $avatar = baseHome + "/layouts/useravatar.png";
          $("#avatar").attr("src", $avatar);
          //gender
          if (data.gender == 1) $("#male1").prop("checked", true);
          else if (data.gender == 2) $("#female1").prop("checked", true);
          else $("#other1").prop("checked", true);
          //maritalStatus
          if (data.maritalStatus == 1) $("#married").prop("checked", true);
          else if (data.maritalStatus == 2) $("#alone").prop("checked", true);
          $("#name1").val(data.name);
          if(data.staffCode != '') {
            $("#staffCode").attr("disabled","disabled");
            $("#staffCode").parent().removeClass("col-lg-10 col-md-9");
            $("#staffCode").parent().addClass("col-lg-12 col-md-12");
            $("#createCode").parent().removeClass("col-lg-2 col-md-3");
            $("#createCode").parent().css("display","none");
            $("#staffCode").val(data.staffCode);
          } else {
              $("#staffCode").attr("disabled", "none");
              $("#staffCode").parent().addClass("col-lg-10 col-md-9");
              $("#staffCode").parent().removeClass("col-lg-12 col-md-12");
              $("#createCode").parent().css("display", "inline-block");
              $("#createCode").parent().addClass("col-lg-2 col-md-3");
              
              $("#staffCode").val(data.staffCode);
          }
          $("#staffCode").val(data.staffCode);
          $("#branchId").val(data.branchId);
          $("#birthday1").val(data.birthDay);
          $("#phoneNumber1").val(data.phoneNumber);
          $("#email1").val(data.email);
          $("#address").val(data.address);
          $("#residence").val(data.residence);
          $("#idCard").val(data.idCard);
          $("#idDate").val(data.idDate);
          $("#status_update").val(data.status);
          if (data.idDate == "00/00/0000") {
            $("#idDate").val("").attr("placeholder", "DD/MM/YYYY");
          }
          $("#taxCode").val(data.taxCode);
          $("#idAddress").val(data.idAddress);
          $("#vssId").val(data.vssId);
          $("#nationality").val(data.nationality);
          $("#description").val(data.description);
          $("#id").val(id);
          $("#branchId").val(data.branchId);
          var accessPoints = data.accesspoints.split(",");
          $("#accesspoints").val(accessPoints).trigger("change");
          var staffInfo = result.staff_info;
          if (staffInfo != 0) {
            $("#twitter").val(staffInfo.twitter);
            $("#facebook").val(staffInfo.facebook);
            $("#instagram").val(staffInfo.instagram);
            $("#zalo").val(staffInfo.zalo);
            $("#wechat").val(staffInfo.wechat);
            $("#linkein").val(staffInfo.linkein);
          } else {
            $("#socailForm").trigger("reset");
          }
// load hợp đồng lao động nhân viên
          $('#staffId').val(id);
          loadRecord(id);
        //   return_combobox_multi('#staffId', baseHome + '/common/listStaff', 'Lựa chọn nhân viên');
          return_combobox_multi('#type', baseHome + '/common/typeContracts', 'Lựa chọn loại hợp đồng');
          return_combobox_multi('#departmentId', baseHome + '/common/departments', 'Lựa chọn phòng ban');
          return_combobox_multi('#branchId', baseHome + '/common/branchs', 'Lựa chọn chi nhánh');
          return_combobox_multi('#position', baseHome + '/common/positions', 'Lựa chọn vị trí');
          return_combobox_multi('#shiftId', baseHome + '/common/shifts', 'Lựa chọn ca làm việc');
          return_combobox_multi('#workPlaceId', baseHome + '/common/workPlaces', 'Địa điểm làm việc');
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}
function createCodeAsset() {
    $('#code').val('');
    var codeAsset =  Math.floor(Math.random() * (99999999 - 10000000 + 1)) + 10000000;
    $('#code').val(codeAsset);
    }
function updateinfo() {
    var id = $("#id").val();
    var info = {};
    info.staffCode = $("#staffCode").val();
    info.gender = $("input[type='radio'][name='gender']:checked").val();
    info.maritalStatus = $("input[type='radio'][name='maritalStatus']:checked").val();
    info.name = $("#name1").val();
    info.birthDay = $("#birthday1").val();
    info.phoneNumber = $("#phoneNumber1").val();
    info.email = $("#email1").val();
    info.address = $("#address").val();
    info.residence = $("#residence").val();
    info.idCard = $("#idCard").val();
    info.idDate = $("#idDate").val();
    info.idAddress = $("#idAddress").val();
    info.taxCode = $("#taxCode").val();
    info.nationalId = $("#nationality").val();
    info.vssId = $("#vssId").val();
    info.description = $("#description").val();
    info.accesspoints = $("#accesspoints").val();
    info.status = $('#status_update').val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {data: info, id: id},
        url: baseHome + "/staff/updateinfo",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#updateinfo').modal('hide');
                $(".user-list-table").DataTable().ajax.reload(null, false);
            } else
                notify_error(data.msg);
        },
        error: function () {
            notify_error('Cập nhật không thành công');
        }
    });
}

function changeImage() {
    var id = $("#id").val();
    var myform = new FormData($('#formInfoStaff')[0]);
    myform.append('myid', id);
    $.ajax({
        url: baseHome + "/staff/changeImage",
        method: 'post',
        data: myform,
        contentType: false,
        processData: false,
        success: function (data) {
            data = JSON.parse(data);
            if (data.success) {
                notyfi_success(data.msg);
                $('#avatar').attr('src', data.filename);
                $(".user-list-table").DataTable().ajax.reload(null, false);
            } else
                notify_error(data.msg);
        },
    });
}


function updateInfoStaff() {
    var info = {};
    info.staffId = $("#id").val();
    info.twitter = $("#twitter").val();
    info.facebook = $("#facebook").val();
    info.instagram = $("#instagram").val();
    info.zalo = $("#zalo").val();
    info.wechat = $("#wechat").val();
    info.linkein = $("#linkein").val();

    $.ajax({
        type: "POST",
        dataType: "json",
        data: {data: info},
        url: baseHome + "/staff/updateInfoStaff",
        success: function (data) {
            if (data.success) {
                //  loaddata(info.nhan_vien);
                notyfi_success(data.msg);
            } else {
                notify_error(data.msg);
            }
        },
        error: function () {
            notify_error('Cập nhật user không thành công');
        }
    });
}


function addStaff() {
    var info = {};
    info.staffCode = $("#staffCode").val();
    info.name = $("#name").val();
    info.phoneNumber = $("#phoneNumber").val();
    info.birthday = $("#birthday").val();
    info.email = $("#email").val();
    info.status = $("#status").val();
    info.gender = $("input[type='radio'][name='gender']:checked").val();
    info.code = $("#code").val();
    console.log(info);

    $.ajax({
        type: "POST",
        dataType: "json",
        data: {data: info},
        url: baseHome + "/staff/add",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#modals-slide-in').modal('hide');
                $(".user-list-table").DataTable().ajax.reload(null, false);
            } else
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
                url: baseHome + "/staff/del",
                type: 'post',
                dataType: "json",
                data: {id: id},
                success: function (data) {
                    if (data.success) {
                        $('.modal').modal('hide');
                        notyfi_success(data.msg);
                        $(".user-list-table").DataTable().ajax.reload(null, false);
                    } else
                        notify_error(data.msg);
                },
            });
        }
    });
}



function delContract(id) {
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
                url: baseHome + "/staff/delContract",
                type: 'post',
                dataType: "json",
                data: {id: id},
                success: function (data) {
                    if (data.success) {
                      
                        notyfi_success(data.msg);
                        $('#add-contract').modal('hide');
                        $("#record-list-table").DataTable().ajax.reload(null, false);
                    } else
                        notify_error(data.msg);
                },
            });
        }
    });
}

var urlContract = '';
function showFormContract() {
    $('#formContract')[0].reset();
    $('#add-contract').modal('show');
    var validator = $("#formContract").validate(); // reset form
        validator.resetForm();
        $(".error").removeClass("error"); // loại bỏ validate
    
     
    $('.modal-title-contract').html('Thêm hợp đồng cho nhân viên');
    urlContract = baseHome + "/staff/addContract";
}


// load record
function loadRecord(id) {

    if ($("#record-list-table").length) {

        $("#record-list-table").DataTable({
            ajax: baseHome + "/staff/loadRecord?id=" + id,
            destroy: true,
            ordering: false,
            columns: [
                // columns according to JSON
                {data: "name"},
                {data: "department"},
                {data: "basicSalary"},
                {data: "allowance"},
                {data: "startDate"},
                {data: "stopDate"},
                {data: ""},
            ],
            columnDefs: [

                {
                    // Actions
                    targets: 2,
                    orderable: true,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(full['basicSalary']);
                        return html;
                    },

                },

                {
                    // Actions
                    targets: 3,
                    orderable: true,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(full['allowance']);
                        return html;
                    },

                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({class: "font-medium-3 text-success mr-50"}),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        if (funEdit == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddataContract(' + full['id'] + ')">';
                            html += '<i class="fas fa-pencil-alt"></i>';
                            html += '</button> &nbsp;';
                        }
                        if (funDel == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="delContract(' + full['id'] + ')">';
                            html += '<i class="fas fa-trash-alt"></i>';
                            html += '</button>';
                        }
                        return html;
                    },
                    width: 100
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
                info: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
            },
           
        });
    }
}

function loaddataContract(id) {
    $('#add-contract').modal('show');
    $('.modal-title-contract').html('Cập nhật hợp đồng cho nhân viên');
   

    if (funEdit == 1)
        $('#btnUpdate').removeClass('d-none');
    else
        $('#btnUpdate').addClass('d-none');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {id: id},
        url: baseHome + "/staff/loaddataContract",
        success: function (data) {
            // Default

            $('#nameContract').val(data.name);
            $('#basicSalary').val(Comma(data.basicSalary));
            $('#salaryPercentage').val(data.salaryPercentage);
            $('#allowance').val(Comma(data.allowance));
            $('#startDate').val(data.startDateCv);
            $('#stopDate').val(data.stopDateCv);
            $('#staffId').val(data.staffId).trigger("change");
            $('#departmentId').val(data.departmentId).trigger("change");
            $('#position').val(data.position).trigger("change");
            $('#branchId').val(data.branchId).trigger("change");
            $('#type').val(data.type).trigger("change");
            $('#statusContract').val(data.status).trigger("change");
            $('#shiftId').val(data.shiftId).trigger("change");
            $('#workPlaceId').val(data.workPlaceId).trigger('change');
            $('#description').val(data.description);
            var basicPickr = $('.flatpickr-basic');
            if (basicPickr.length) {
                basicPickr.flatpickr({
                    dateFormat: "d/m/Y",
                    onReady: function (selectedDates, dateStr, instance) {
                      
                        console.log(instance);
                        if (instance.isMobile) {
                            $(instance.mobileInput).attr("step", null);
                        }
                    }
                });
            }
            urlContract = baseHome + '/staff/updateContract?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}


// load record
function saveContract() {
   
  
    var formData = new FormData($('#formContract')[0]);
    $.ajax({
        url: urlContract,
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (data) {
            if (data.code == 200) {
                notyfi_success(data.message);
                $('#add-contract').modal('hide');
                $("#record-list-table").DataTable().ajax.reload(null, false);
            } else
                notify_error(data.message);
        }
    });
    return false;
}


function createCodeStaff() {
  var id = $("#branchId").val();
  if (id == '') {
      alert("Chưa có thông tin về chi nhánh làm việc")
  }
  else if(id < 10) id = "0"+id;
  var codeRandom = Math.floor(Math.random() * (9999 - 1000 + 1)) + 1000;
  if (codeRandom < 1000) codeRandom = "0" + codeRandom;
  else if (codeRandom < 100) codeRandom = "00" + codeRandom;
  else if (codeRandom < 10) codeRandom = "000" + codeRandom;

  let staffCode = id+''+codeRandom;
  $("#staffCode").val(staffCode);
}