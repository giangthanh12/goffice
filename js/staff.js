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
 
    "use strict";
    
    var dtUserTable = $(".user-list-table"),
        newUserSidebar = $(".new-user-modal"),
        newUserForm = $(".add-new-user"),
  
        // selectArray = $('.select2-data-array'),

        statusObj = {
            1: { title: "Thực tập sinh", class: "badge-light-warning" },
            2: { title: "Thử việc", class: "badge-light-success" },
            3: { title: "Chính thức", class: "badge-light-secondary" },
        };
        var basicPickr = $('.flatpickr-basic');
        // Default
        if (basicPickr.length) {
            basicPickr.flatpickr({
                dateFormat: "d/m/Y",
            });
        }


    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            ajax: baseHome + "/staff/getData",
            ordering: false, // bỏ sắp xếp mặc định
           
            columns: [
                // columns according to JSON
                { data: "name" },
                { data: "email" },
                { data: "phoneNumber" },
                { data: "" },
            ],
            columnDefs: [
             

                {
                    // User full name and username
                    targets: 0,
                
                    render: function (data, type, full, meta) {
                        var $name = full["name"],
                         
                            $image = full["avatar"];
                        if ($image) {
                            // For Avatar image
                            var $output = '<img onerror='+"this.src='https://velo.vn/goffice-test/layouts/useravatar.png'"+' src="' + $image + '" alt="Avatar" height="32" width="32">';
                            // var $output = '<img src="' + assetPath + "images/avatars/" + $image + '" alt="Avatar" height="32" width="32">';
                        } else {
                            // For Avatar badge
                            var stateNum = Math.floor(Math.random() * 6) + 1;
                            var states = ["success", "danger", "warning", "info", "dark", "primary", "secondary"];
                            var $state = states[stateNum],
                                $name = full["name"],
                                $initials = $name.match(/\b\w/g) || [];
                            $initials = (($initials.shift() || "") + ($initials.pop() || "")).toUpperCase();
                            $output = '<span class="avatar-content">' + $initials + "</span>";
                        }
                        var colorClass = $image === "" ? " bg-light-" + $state + " " : "";
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="avatar-wrapper">' +
                            '<div class="avatar ' +
                            colorClass +
                            ' mr-1">' +
                            $output +
                            "</div>" +
                            "</div>" +
                            '<div class="d-flex flex-column">' +
                            '<a href="javascript:void(0)" onclick="loaddata('+full["id"]+');" data-toggle="modal" data-target="#updateinfo" class="user_name text-truncate"><span class="font-weight-bold">' +
                            $name +
                            "</span></a>" +
                           
                            "</div>" +
                            "</div>";
                        return $row_output;
                    },
                },
                {
                    // User Role
                    targets: 2,
                    render: function (data, type, full, meta) {
                        var $role = full["phoneNumber"];
                        var roleBadgeObj = {
                            Subscriber: feather.icons["user"].toSvg({ class: "font-medium-3 text-primary mr-50" }),
                            Author: feather.icons["settings"].toSvg({ class: "font-medium-3 text-warning mr-50" }),
                            Maintainer: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                            Editor: feather.icons["edit-2"].toSvg({ class: "font-medium-3 text-info mr-50" }),
                            Admin: feather.icons["slack"].toSvg({ class: "font-medium-3 text-danger mr-50" }),
                        };
                        return "<span class='text-truncate align-middle'>" + roleBadgeObj['Subscriber'] + $role + "</span>";
                    },
                },
             
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
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
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="del(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button></div>';
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
                searchPlaceholder: "Search..",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            // Buttons with Dropdown
            buttons: [{
                text: "Thêm mới",
                className: "add-new btn btn-primary mt-50",
                // attr: {
                //     "data-toggle": "modal",
                //     "data-target": "#modals-slide-in",
                // },
                init: function (api, node, config) {
                    $(node).removeClass("btn-secondary");
                },
                action: function (e, dt, node, config) {
                    actionMenu('add');
                }
            }],
            // For responsive popup
            
            initComplete: function () {
               
            },
        });
    }

    // Check Validity
    function actionMenu(func){
        if(func=='add')
            add();
    }
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
                "name": {
                    required: true,
                },
                "email": {
                    required: true,
                },
                "birthday": {
                    required: true,
                },
                "phoneNumber": {
                    required: true,
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

    // To initialize tooltip with body container
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
        container: "body",
    });
});

function loaddata(id) {
    $('#updateinfo').modal('show');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/staff/loaddata",
        success: function (result) {
            var data = result.nhanvien;
      
            $('#nhanvien').html(data.name);
            $('#avatar').attr('src', data.avatar);
            //gender
            if (data.gender==1)
                $("#male1").prop("checked", true);
            else if(data.gender==2)
                $("#female1").prop("checked", true);
            else
            $("#other1").prop("checked", true);
            //maritalStatus
            if (data.maritalStatus==1)
            $("#married").prop("checked", true);
            else if(data.maritalStatus==2)
            $("#alone").prop("checked", true);
            $('#name1').val(data.name);
            $('#birthday1').val(data.birthDay);
            $('#phoneNumber1').val(data.phoneNumber);
            $('#email1').val(data.email);
            $('#address').val(data.address);
            $('#residence').val(data.residence);
            $('#idCard').val(data.residence);
            $('#idDate').val(data.idDate);
            if(data.idDate == "00/00/0000") {
                $('#idDate').val('').attr('placeholder', 'DD/MM/YYYY');
            }
            $('#taxCode').val(data.taxCode);
            $('#idAddress').val(data.idAddress);
            $('#vssId').val(data.vssId);
            $('#nationality').val(data.nationality);
            $("#description").val(data.description);
            $("#id").val(id);
            var staffInfo = result.staff_info;
            if (staffInfo != 0){
                $('#twitter').val(staffInfo.twitter);
                $('#facebook').val(staffInfo.facebook);
                $('#instagram').val(staffInfo.instagram);
                $('#zalo').val(staffInfo.zalo);
                $('#wechat').val(staffInfo.wechat);
                $('#linkein').val(staffInfo.linkein);
            }else{
                $('#socailForm').trigger("reset");
            }


            loadRecord(id);
        },
        error: function(){
            notify_error('Lỗi truy xuất database');
        }
    });
}

function updateinfo() {
    var id = $("#id").val();
    var info = {};
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
    info.nationality = $("#nationality").val();
    info.vssId = $("#vssId").val();
    info.description = $("#description").val();
  
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {data:info, id:id},
        url: baseHome + "/staff/updateinfo",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#updateinfo').modal('hide');
                $(".user-list-table").DataTable().ajax.reload( null, false );
            }
            else
                notify_error(data.msg);
        },
        error: function(){
            notify_error('Cập nhật không thành công');
        }
    });
}

function changeImage(){
    var id = $("#id").val();
    var myform = new FormData($('#thongtin')[0]);
    myform.append('myid', id);
    $.ajax({
        url: baseHome + "/staff/changeImage",
        method: 'post',
        data: myform,
        contentType: false,
        processData: false,
        success: function(data){
            data = JSON.parse(data);
            if (data.success) {
                notyfi_success(data.msg);
                $('#avatar').attr('src', data.filename);
            }
            else
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
        data: {data:info},
        url: baseHome + "/staff/updateInfoStaff",
        success: function(data) {
            if (data.success) {
              //  loaddata(info.nhan_vien);
                notyfi_success(data.msg);
            }
            else{
                notify_error(data.msg);
            }
        },
        error: function(){
            notify_error('Cập nhật user không thành công');
        }
    });
}


function addStaff() {
    var info = {};
    
    info.name = $("#name").val();
    info.phoneNumber = $("#phoneNumber").val();
    info.birthday = $("#birthday").val();
    info.email = $("#email").val();
    info.status = $("#status").val();
    info.gender = $("input[type='radio'][name='gender']:checked").val();
   
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {data:info},
        url: baseHome + "/staff/add",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#modals-slide-in').modal('hide');
                $(".user-list-table").DataTable().ajax.reload( null, false );
            }
            else
                notify_error(data.msg);
        },
        error: function(){
            notify_error('Cập nhật không thành công');
        }
    });
}

function del(id){
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
                url: baseHome + "/staff/del",
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


function add(){
    $('#modals-slide-in').modal('show');
    $("#name").val('');
    $('#phoneNumber').val('');
    $('#email').val('');
    $('#birthday').val('');
    $("input[type='radio'][name='gender']:checked").val();
    $('#status').val(1).attr("disabled", true);
}
// load record
function loadRecord(id) {

    if ($("#record-list-table").length) {
    
        $("#record-list-table").DataTable({
            ajax: baseHome + "/staff/loadRecord?id=" + id,
            destroy: true,
            columns: [
                // columns according to JSON
                { data: "nameContract" },
                { data: "department" },
                { data: "salary" },
                { data: "allowance" },
                { data: "startDate" },
                { data: "stopDate" },
            ],
            columnDefs: [
           
                {
                    // Actions
                    targets: 2,
                    orderable: true,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(full['salary']);
                        return html;
                    },
                 
                },

                {
                    // Actions
                    targets: 3,
                    orderable: true,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(full['allowance']);
                        return html;
                    },
                 
                },
            ],
        
            language: {
                sLengthMenu: "Show _MENU_",
                search: "Search",
                searchPlaceholder: "Search..",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                }
            },           
        });
    }
}