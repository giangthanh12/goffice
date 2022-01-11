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
    return_combobox_multi('#departmentId', baseHome + '/staff/getDepartment', 'Phòng ban');
    return_combobox_multi('#shiftId', baseHome + '/staff/getShift', 'Ca làm');
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

    // $('#birthday').flatpickr({
    //     // monthSelectorType: "static",
    //     // altInput: true,
    //     // defaultDate: data.birthDay,
    //     altFormat: "j F, Y",
    //     dateFormat: "d/m/Y",
    // });
    // var button = [];
    // let i = 0;
    // userFuns.forEach(function (item,index){
    //     if(item.type==1) {
    //         button[i] = {
    //             text: item.name,
    //             className: "add-new btn btn-" + item.color + " mt-50",
    //             // attr: {
    //             //     "data-toggle": "modal",
    //             //     "data-target": "#modals-slide-in",
    //             // },
    //             init: function (api, node, config) {
    //                 $(node).removeClass("btn-secondary");
    //             },
    //             action: function (e, dt, node, config) {
    //                 actionMenu(item.function);
    //             }
    //         };
    //         i++;
    //     }
    // })


  

 

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
                    responsivePriority: 4,
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
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Details of " + data["name"];
                        },
                    }),
                    type: "column",
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: "table",
                        columnDefs: [
                            {
                                targets: 2,
                                visible: false,
                            },
                            {
                                targets: 3,
                                visible: false,
                            },
                        ],
                    }),
                },
            },
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
            loadRecord(id);

            // var account = result.account;
            // if (account != 0){
            //     $('#form_account').css("display","block");
            //     $('#add_account').css("display","none");
            //     $('.btn_show_pass').css("display","block");
            //     $('.btn_hidden_pass').css("display","none");
            //     $('.show_pass').css("display","none");

            //     $('#edit_username').val(account.username);
            //     $('#id_user').val(account.id);
            //     $('#ext_num').val(account.extNum);
            //     $('#sip_pass').val(account.sipPass);

            //     $('#users_tinh_trang').attr("disabled", false);
            //     $('#users_tinh_trang').val(account.status);
            //     $('#nhom').attr("disabled", false);
            //     $('#nhom').val(account.department);

            // }else{
            //     $('#form_account').css("display","none");
            //     $('#add_account').css("display","block");
            // }

            // var nhanvien_info = result.nhanvien_info;
            // if (nhanvien_info != 0){
            //     $('#twitter').val(nhanvien_info.twitter);
            //     $('#facebook').val(nhanvien_info.facebook);
            //     $('#instagram').val(nhanvien_info.instagram);
            //     $('#zalo').val(nhanvien_info.zalo);
            //     $('#wechat').val(nhanvien_info.wechat);
            //     $('#linkein').val(nhanvien_info.linkein);
            //     $('#update_nhanvien_info').css("display","block");
            //     $('#add_nhanvien_info').css("display","none");
            // }else{
            //     $('#update_nhanvien_info').css("display","none");
            //     $('#add_nhanvien_info').css("display","block");
            // }



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

// function thoiviec(id){

//     Swal.fire({
//         title: 'Thôi việc',
//         text: "Bạn có chắc chắn!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonText: 'Tôi đồng ý',
//         customClass: {
//             confirmButton: 'btn btn-primary',
//             cancelButton: 'btn btn-outline-danger ml-1'
//         },
//         buttonsStyling: false
//     }).then(function (result) {
//         if (result.value) {
//             $.ajax({
//                 url: baseHome + "/nhansu/thoiviec",
//                 type: 'post',
//                 dataType: "json",
//                 data: {id: id},
//                 success: function(data){
//                     if (data.success) {
//                         notyfi_success(data.msg);
//                         $(".user-list-table").DataTable().ajax.reload( null, false );
//                     }
//                     else
//                         notify_error(data.msg);
//                 },
//             });
//         }
//     });

// }


function update_users() {
    var info = {};
    info.nhan_vien = $("#id").val();
    info.id_user = $("#id_user").val();
    info.username = $("#edit_username").val();
    info.password = $("#edit_password").val();
    info.tinh_trang = $("#users_tinh_trang").val();
    info.ext_num = $("#ext_num").val();
    info.sip_pass = $("#sip_pass").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {data:info},
        url: baseHome + "/nhansu/update_users",
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






function update_nhanvien_info1() {
    var info = {};
    info.nhanvien_id = $("#id").val();
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
        url: baseHome + "/nhansu/update_nhanvien_info",
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
                // {
                //     // Actions
                //     targets: 1,
                  
                //     orderable: false,
                //     render: function (data, type, full, meta) {
                //         var html = '';
                //        if(full['type'] == 1) {
                //           html =  `<div class="badge badge-pill badge-light-info">Đơn hàng</div>`;
                //        }
                //        else if (full['type'] == 2) {
                //         html =  `<div class="badge badge-pill badge-light-primary">Hợp đồng</div>`;
                //        }
                //        else if(full['type'] == 3) {
                //         html =   `<div class="badge badge-pill badge-light-success">Thanh toán</div>`;
                //        }
                //         return html;
                //     },
                //     width: 150
                // },
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
            // dom:
            //     '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
            //     '<"col-lg-12 col-xl-6" l>' +
            //     '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
            //     ">t" +
            //     '<"d-flex justify-content-between mx-2 row mb-1"' +
            //     '<"col-sm-12 col-md-6"i>' +
            //     '<"col-sm-12 col-md-6"p>' +
            //     ">",
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

            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Details of " + data["name"];
                        },
                    }),
                    type: "column",
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: "table",
                        columnDefs: [
                            {
                                targets: 2,
                                visible: false,
                            },
                            {
                                targets: 3,
                                visible: false,
                            },
                        ],
                    }),
                },
            }
        });
    }
}