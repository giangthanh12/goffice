/*=========================================================================================
    File Name: app-user-list.js
    Description: User List page
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent

==========================================================================================*/
$(function () {
    "use strict";

    var dtUserTable = $(".user-list-table"),
        newUserSidebar = $(".new-user-modal"),
        newUserForm = $(".add-new-user"),
        // selectArray = $('.select2-data-array'),
        quequan = $('#quequan'),
        noicap = $('#noicap'),
        statusObj = {
            1: { title: "Thực tập sinh", class: "badge-light-warning" },
            2: { title: "Thử việc", class: "badge-light-success" },
            3: { title: "Chính thức", class: "badge-light-secondary" },
        };
    var button = [];
    let i = 0;
    userFuns.forEach(function (item,index){
        if(item.type==1) {
            button[i] = {
                text: item.name,
                className: "add-new btn btn-" + item.color + " mt-50",
                // attr: {
                //     "data-toggle": "modal",
                //     "data-target": "#modals-slide-in",
                // },
                init: function (api, node, config) {
                    $(node).removeClass("btn-secondary");
                },
                action: function (e, dt, node, config) {
                    actionMenu(item.function);
                }
            };
            i++;
        }
    })


    $.ajax({ // tải thành phố vào select2 province
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/nhansu/province",
        success: function (data) {
            quequan.wrap('<div class="position-relative"></div>').select2({
                dropdownAutoWidth: true,
                dropdownParent: quequan.parent(),
                width: '100%',
                data: data
            });
            noicap.wrap('<div class="position-relative"></div>').select2({
                dropdownAutoWidth: true,
                dropdownParent: noicap.parent(),
                width: '100%',
                data: data
            });
        },
    });

    // var assetPath = "styles/app-assets/",
    // userView = "nhansu/view",
    // userEdit = "nhansu/edit";
    // if ($("body").attr("data-framework") === "laravel") {
    //     assetPath = $("body").attr("data-asset-path");
    //     userView = assetPath + "app/user/view";
    //     userEdit = assetPath + "app/user/edit";
    // }

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/nhansu/getData",
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "name" },
                { data: "email" },
                { data: "phoneNumber" },
                { data: "department" },
                { data: "status" },
                { data: "" },
            ],
            columnDefs: [
                {
                    // For Responsive
                    className: "control",
                    orderable: false,
                    responsivePriority: 2,
                    targets: 0,
                },

                {
                    // User full name and username
                    targets: 1,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full["name"],
                            $uname = full["department"],
                            $image = full["avatar"];
                        if ($image) {
                            // For Avatar image
                            var $output = '<img src="' + $image + '" alt="Avatar" height="32" width="32">';
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
                            '<small class="emp_post text-muted">@' +
                            $uname +
                            "</small>" +
                            "</div>" +
                            "</div>";
                        return $row_output;
                    },
                },
                {
                    // User Role
                    targets: 3,
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
                    // User Status
                    targets: 5,
                    render: function (data, type, full, meta) {
                        var $status = full["status"];
                        return '<span class="badge badge-pill ' + statusObj[$status].class + '" text-capitalized>' + statusObj[$status].title + "</span>";
                    },
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        userFuns.forEach(function (item){
                            if(item.type==2) {
                                html += '<button type="button" class="btn btn-icon btn-outline-' + item.color + ' waves-effect"  title="Chỉnh sửa" onclick="' + item.function + '(' + full['id'] + ')">';
                                html += '<i class="' + item.icon + '"></i>';
                                html += '</button> &nbsp;';
                            }
                        })
                        return html;
                        // return (
                        //     '<div class="btn-group">' +
                        //     '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
                        //     feather.icons["more-vertical"].toSvg({ class: "font-small-4" }) +
                        //     "</a>" +
                        //     '<div class="dropdown-menu dropdown-menu-right">' +
                        //     '<a href="javascript:void(0)" class="dropdown-item" data-toggle="modal" data-target="#updateinfo" onclick="loaddata('+full["id"]+')">' +
                        //     feather.icons["file-text"].toSvg({ class: "font-small-4 mr-50" }) +
                        //     "Xem/sửa</a>" +
                        //     '<a href="javascript:void(0)" class="dropdown-item" onclick="thoiviec('+full["id"]+')" >' +
                        //     feather.icons["archive"].toSvg({ class: "font-small-4 mr-50" }) +
                        //     "Thôi việc</a>" +
                        //     '<a href="javascript:void(0)" class="dropdown-item delete-record" onclick="xoa('+full["id"]+')">' +
                        //     feather.icons["trash-2"].toSvg({ class: "font-small-4 mr-50" }) +
                        //     "Xóa</a></div>" +
                        //     "</div>" +
                        //     "</div>"
                        // );
                        // '<a href="' +
                        // userEdit +
                        // '?id=' + full["id"] +
                        // '" class="dropdown-item">' +
                        // feather.icons["archive"].toSvg({ class: "font-small-4 mr-50" }) +
                        // "Cập nhật</a>" +
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
            buttons: [button],
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
                // Adding role filter once table initialized
                this.api()
                    .columns(3)
                    .every(function () {
                        var column = this;
                        var select = $('<select id="UserRole" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Chi nhánh </option></select>')
                            .appendTo(".user_role")
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
                // Adding plan filter once table initialized
                this.api()
                    .columns(4)
                    .every(function () {
                        var column = this;
                        var select = $('<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Phòng ban </option></select>')
                            .appendTo(".user_plan")
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
                // Adding status filter once table initialized
                this.api()
                    .columns(5)
                    .every(function () {
                        var column = this;
                        var select = $('<select id="FilterTransaction" class="form-control text-capitalize mb-md-0 mb-2xx"><option value=""> Hợp đồng lao động </option></select>')
                            .appendTo(".user_status")
                            .on("change", function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? "^" + val + "$" : "", true, false).draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append('<option value="' + statusObj[d].title + '" class="text-capitalize">' + statusObj[d].title + "</option>");
                            });
                    });
            },
        });
    }

    // Check Validity
    function actionMenu(func){
        alert(func);
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

        newUserForm.on("submit", function (e) {
            var isValid = newUserForm.valid();
            e.preventDefault();
            if (isValid) {
                newUserSidebar.modal("hide");
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
        url: baseHome + "/nhansu/loaddata",
        success: function (result) {
            var data = result.nhanvien;

            $('#nhanvien').html(data.name);
            $('#avatar').attr('src', data.hinh_anh);
            if (data.gender==1)
                $("#male").prop("checked", true).trigger("click");
            else
                $("#female").prop("checked", true).trigger("click");
            if (data.status==1)
                $("#hopdong1").prop("checked", true).trigger("click");
            else if (data.status==2)
                $("#hopdong2").prop("checked", true).trigger("click");
            else if (data.status==3)
                $("#hopdong3").prop("checked", true).trigger("click");
            else if (data.status==4)
                $("#hopdong4").prop("checked", true).trigger("click");
            $('#hoten').val(data.name);
            $('#ngaysinh').flatpickr({
                monthSelectorType: "static",
                altInput: true,
                defaultDate: data.birthDay,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
            });
            $('#dienthoai').val(data.phoneNumber);
            $('#email').val(data.email);
            $('#diachi').val(data.address);
            $('#quequan option[value='+data.province+']').attr('selected','selected');
            $("#quequan").val(data.province).change();
            $('#cmnd').val(data.idCard);
            $('#ngaycap').flatpickr({
                monthSelectorType: "static",
                altInput: true,
                defaultDate: data.idDate,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
            });
            $('#noicap option[value='+data.idAddress+']').attr('selected','selected');
            $("#noicap").val(data.idAddress).change();
            $('#masothue').val(data.taxCode);
            $('#bhxh').val(data.vssId);
            $('#thuongtru').val(data.nationality);
            $("#id").val(id);


            var account = result.account;
            if (account != 0){
                $('#form_account').css("display","block");
                $('#add_account').css("display","none");
                $('.btn_show_pass').css("display","block");
                $('.btn_hidden_pass').css("display","none");
                $('.show_pass').css("display","none");

                $('#edit_username').val(account.username);
                $('#id_user').val(account.id);
                $('#ext_num').val(account.extNum);
                $('#sip_pass').val(account.sipPass);

                $('#users_tinh_trang').attr("disabled", false);
                $('#users_tinh_trang').val(account.status);
                $('#nhom').attr("disabled", false);
                $('#nhom').val(account.department);

            }else{
                $('#form_account').css("display","none");
                $('#add_account').css("display","block");
            }

            var nhanvien_info = result.nhanvien_info;
            if (nhanvien_info != 0){
                $('#twitter').val(nhanvien_info.twitter);
                $('#facebook').val(nhanvien_info.facebook);
                $('#instagram').val(nhanvien_info.instagram);
                $('#zalo').val(nhanvien_info.zalo);
                $('#wechat').val(nhanvien_info.wechat);
                $('#linkein').val(nhanvien_info.linkein);
                $('#update_nhanvien_info').css("display","block");
                $('#add_nhanvien_info').css("display","none");
            }else{
                $('#update_nhanvien_info').css("display","none");
                $('#add_nhanvien_info').css("display","block");
            }



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
    info.status = $("input[type='radio'][name='hopdong']:checked").val();
    info.name = $("#hoten").val();
    info.birthDay = $("#ngaysinh").val();
    info.phoneNumber = $("#dienthoai").val();
    info.email = $("#email").val();
    info.address = $("#diachi").val();
    info.province = $("#quequan").val();
    info.idCard = $("#cmnd").val();
    info.idDate = $("#ngaycap").val();
    info.idAddress = $("#noicap").val();
    info.taxCode = $("#masothue").val();
    info.nationality = $("#thuongtru").val();
    info.vssId = $("#bhxh").val();

    $.ajax({
        type: "POST",
        dataType: "json",
        data: {data:info, id:id},
        url: baseHome + "/nhansu/updateinfo",
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

function thayanh(){
    var id = $("#id").val();
    var myform = new FormData($('#thongtin')[0]);
    myform.append('myid', id);
    $.ajax({
        url: baseHome + "/nhansu/thayanh",
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

function them() {
    var info = {};
    info.status = $("#tinh_trang").val();
    info.name = $("#fullname").val();
    info.phoneNumber = $("#dien_thoai").val();
    info.email = $("#user-email").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {data:info},
        url: baseHome + "/nhansu/them",
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

function xoa(id){
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
                url: baseHome + "/nhansu/xoa",
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

function thoiviec(id){

    Swal.fire({
        title: 'Thôi việc',
        text: "Bạn có chắc chắn!",
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
                url: baseHome + "/nhansu/thoiviec",
                type: 'post',
                dataType: "json",
                data: {id: id},
                success: function(data){
                    if (data.success) {
                        notyfi_success(data.msg);
                        $(".user-list-table").DataTable().ajax.reload( null, false );
                    }
                    else
                        notify_error(data.msg);
                },
            });
        }
    });

}


function show_pass(){
    $('.btn_show_pass').css("display","none");
    $('.btn_hidden_pass').css("display","block");
    $('.show_pass').css("display","block");
    $('#edit_password').attr("disabled",false);


}
function hidden_pass(){
    $('.btn_show_pass').css("display","block");
    $('.btn_hidden_pass').css("display","none");
    $('.show_pass').css("display","none");
    $('#edit_password').attr("disabled",true);
}

function check_username(){
    var username = $("#add_username").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {username:username,id:0},
        url: baseHome + "/nhansu/checkUsername",
        success: function (data) {
            if (data.success) {
                //    $('.note_status').html(data.msg);
                //   $('.note_status').css("color","green");
                $("#btn_add_users").attr("disabled", false);
            }
            else{
                $('.note_status').html(data.msg);
                $('.note_status').css("color","red");
                $("#btn_add_users").attr("disabled", true);

            }

        },
        error: function(){
            notify_error('Lỗi dữ liệu');
        }
    });
}

function check_username_edit(){
    var username = $("#edit_username").val();
    var id = $("#id_user").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {username:username, id:id},
        url: baseHome + "/nhansu/checkUsername",
        success: function (data) {
            if (data.success) {
                //   $('.note_status_edit').html(data.msg);
                //     $('.note_status_edit').css("color","green");
                $("#btn_edit_users").attr("disabled", false);
            }
            else{
                $('.note_status_edit').html(data.msg);
                $('.note_status_edit').css("color","red");
                $("#btn_edit_users").attr("disabled", true);

            }

        },
        error: function(){

        }
    });
}

function add_users() {
    var info = {};
    info.nhan_vien = $("#id").val();
    info.username = $("#add_username").val();
    info.password = $("#add_password").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {data:info},
        url: baseHome + "/nhansu/add_users",
        success: function (data) {
            if (data.success) {
                $('#form_account').css("display","block");
                $('#add_account').css("display","none");
                loaddata(info.nhan_vien);
                notyfi_success(data.msg);
            }
            else
                notify_error(data.msg);
        },
        error: function(){
            notify_error('Cập nhật không thành công');
        }
    });
}

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




function add_nhanvien_info1() {
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
        url: baseHome + "/nhansu/add_nhanvien_info",
        success: function (data) {
            if (data.success) {
                $('#update_nhanvien_info').css("display","block");
                $('#add_nhanvien_info').css("display","none");
                loaddata(info.nhanvien_id);
                notyfi_success(data.msg);
            }
            else
                notify_error(data.msg);
        },
        error: function(){
            notify_error('Cập nhật không thành công');
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

function thoiviec(id){
    alert(id);
}
