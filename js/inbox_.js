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
        commentEditor = $(".comment-editor"),
        nguoigui = $('#nguoigui'),
        statusObj = {
            1: { title: "Mới nhận", class: "badge-light-warning" },
            2: { title: "Chưa xem", class: "badge-light-success" },
            3: { title: "Đã xem", class: "badge-light-secondary" },
        };

    $.ajax({ // nhân viên vào select2 cho email to và CC, BCC
        type: "GET",
        dataType: "json",
        async: false,
        url: baseApi + "/inbox/nhanvien",
        success: function (data) {
            var html = '<option data-avatar="'+baseHome+'/layouts/allavatar.png" value="0">Tất cả</option>';
            data.forEach(function(item, index) {
                html += '<option data-avatar="'+item['hinh_anh']+'" value="'+item['id']+'">'+item['name']+'</option>';
            });
            $('#email-to').html(html);
            $('#emailCC').html(html);
            $('#emailBCC').html(html);
        }
    });

    $.ajax({ // tải dữ liệu chính
        type: "GET",
        dataType: "json",
        async: false,
        url: baseApi + "/inbox",
        success: function (data) {
          var mailread = '';
          var html='';
          data.forEach(function(element, index) {
                if (element.tinh_trang==1 || element.tinh_trang==1)
                    mailread = 'mail-read';
                else
                    mailread = '';
                html += '<li class="media mail-read"><div class="media-left pr-50"><div class="avatar">';
                html += '<img src="'+element.hinhanh+'" alt="avatar img holder" /></div>';
                html += '<div class="user-action"><div class="custom-control custom-checkbox">';
                html += '<input type="checkbox" class="custom-control-input" id="customCheck'+element.id+'" />';
                html += '<label class="custom-control-label" for="customCheck'+element.id+'"></label></div>';
                html += '<span class="email-favorite"><i data-feather="star"></i></span></div></div>';
                html += '<div class="media-body"><div class="mail-details"><div class="mail-items">';
                html += '<h5 class="mb-25">'+element.nguoigui+'</h5><span class="text-truncate">🎯 '+element.tieu_de+' </span>';
                html += '</div><div class="mail-meta-item"><span class="mr-50 bullet bullet-success bullet-sm"></span>';
                html += '<span class="mail-date">'+element.ngay_gio+'</span></div></div>';
                html += '<div class="mail-message"><p class="text-truncate mb-0">'+element.noidung+'</p></div></div></li>'
                // $("#email-list").append(html);
            });
            $("#email-list").html(html);
        }
    });

    // Datatable
    // if (dtUserTable.length) {
    //     dtUserTable.DataTable({
    //         ajax: baseApi + "/inbox",
    //         columns: [
    //             // columns according to JSON
    //             { data: "id" },
    //             { data: "nguoigui" },
    //             { data: "name" },
    //             { data: "ngay_gio" },
    //             { data: "tinh_trang" },
    //             { data: "" },
    //         ],
    //         columnDefs: [
    //             {
    //                 // For Responsive
    //                 className: "control",
    //                 orderable: false,
    //                 responsivePriority: 2,
    //                 targets: 0,
    //             },
    //             {
    //                 // User full name and username
    //                 targets: 1,
    //                 responsivePriority: 4,
    //                 render: function (data, type, full, meta) {
    //                     var $name = full["nguoigui"],
    //                         $uname = full["chinhanh"],
    //                         $image = full["hinhanh"];
    //                     if ($image) {
    //                         var $output = '<img src="' + $image + '" alt="Avatar" height="32" width="32">';
    //
    //                     } else {
    //                         // For Avatar badge
    //                         var stateNum = Math.floor(Math.random() * 6) + 1;
    //                         var states = ["success", "danger", "warning", "info", "dark", "primary", "secondary"];
    //                         var $state = states[stateNum],
    //                             $name = full["nguoigui"],
    //                             $initials = $name.match(/\b\w/g) || [];
    //                         $initials = (($initials.shift() || "") + ($initials.pop() || "")).toUpperCase();
    //                         $output = '<span class="avatar-content">' + $initials + "</span>";
    //                     }
    //                     var colorClass = $image === "" ? " bg-light-" + $state + " " : "";
    //                     // Creates full output for row
    //                     var $row_output =
    //                         '<div class="d-flex justify-content-left align-items-center">' +
    //                         '<div class="avatar-wrapper">' +
    //                         '<div class="avatar ' +
    //                         colorClass +
    //                         ' mr-1">' +
    //                         $output +
    //                         "</div>" +
    //                         "</div>" +
    //                         '<div class="d-flex flex-column">' +
    //                         '<a href="javascript:void(0)" onclick="loaddata('+full["id"]+')" data-toggle="modal" data-target="#updateinfo" class="user_name text-truncate"><span class="font-weight-bold">' +
    //                         $name +
    //                         "</span></a>" +
    //                         '<small class="emp_post text-muted">@' +
    //                         $uname +
    //                         "</small>" +
    //                         "</div>" +
    //                         "</div>";
    //                     return $row_output;
    //                 },
    //             },
    //
    //             {
    //                 targets: 4,
    //                 render: function (data, type, full, meta) {
    //                     var $status = full["tinh_trang"];
    //                     return '<span class="badge badge-pill ' + statusObj[$status].class + '" text-capitalized>' + statusObj[$status].title + "</span>";
    //                 },
    //             },
    //             {
    //                 // Actions
    //                 targets: -1,
    //                 title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
    //                 orderable: false,
    //                 render: function (data, type, full, meta) {
    //                     return (
    //                         '<div class="btn-group">' +
    //                         '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
    //                         feather.icons["more-vertical"].toSvg({ class: "font-small-4" }) +
    //                         "</a>" +
    //                         '<div class="dropdown-menu dropdown-menu-right">' +
    //                         '<a href="javascript:void(0)" class="dropdown-item" data-toggle="modal" data-target="#updateinfo" onclick="xem('+full["id"]+')">' +
    //                         feather.icons["file-text"].toSvg({ class: "font-small-4 mr-50" }) +
    //                         "Xem</a>" +
    //                         '<a href="javascript:void(0)" class="dropdown-item" onclick="traloi('+full["id"]+')" >' +
    //                         feather.icons["archive"].toSvg({ class: "font-small-4 mr-50" }) +
    //                         "Trả lời</a>" +
    //                         '<a href="javascript:void(0)" class="dropdown-item delete-record" onclick="chuyentiep('+full["id"]+')">' +
    //                         feather.icons["trash-2"].toSvg({ class: "font-small-4 mr-50" }) +
    //                         "Chuyển tiếp</a></div>" +
    //                         "</div>" +
    //                         "</div>"
    //                     );
    //                     // '<a href="' +
    //                     // userEdit +
    //                     // '?id=' + full["id"] +
    //                     // '" class="dropdown-item">' +
    //                     // feather.icons["archive"].toSvg({ class: "font-small-4 mr-50" }) +
    //                     // "Cập nhật</a>" +
    //                 },
    //             },
    //         ],
    //         // order: [[2, "desc"]],
    //         dom:
    //             '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
    //             '<"col-lg-12 col-xl-6" l>' +
    //             '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
    //             ">t" +
    //             '<"d-flex justify-content-between mx-2 row mb-1"' +
    //             '<"col-sm-12 col-md-6"i>' +
    //             '<"col-sm-12 col-md-6"p>' +
    //             ">",
    //         language: {
    //             sLengthMenu: "Show _MENU_",
    //             search: "Search",
    //             searchPlaceholder: "Search..",
    //         },
    //         // Buttons with Dropdown
    //         buttons: [
    //             {
    //                 text: "New Message",
    //                 className: "add-new btn btn-primary mt-50",
    //                 attr: {
    //                     "data-toggle": "modal",
    //                     "data-target": "#modals-slide-in",
    //                 },
    //                 init: function (api, node, config) {
    //                     $(node).removeClass("btn-secondary");
    //                 },
    //             },
    //         ],
    //         // For responsive popup
    //         responsive: {
    //             details: {
    //                 display: $.fn.dataTable.Responsive.display.modal({
    //                     header: function (row) {
    //                         var data = row.data();
    //                         return "Details of " + data["name"];
    //                     },
    //                 }),
    //                 type: "column",
    //                 renderer: $.fn.dataTable.Responsive.renderer.tableAll({
    //                     tableClass: "table",
    //                     columnDefs: [
    //                         {
    //                             targets: 2,
    //                             visible: false,
    //                         },
    //                         {
    //                             targets: 3,
    //                             visible: false,
    //                         },
    //                     ],
    //                 }),
    //             },
    //         },
    //         language: {
    //             paginate: {
    //                 // remove previous & next text from pagination
    //                 previous: "&nbsp;",
    //                 next: "&nbsp;",
    //             },
    //         },
    //         initComplete: function () {
    //             // Adding role filter once table initialized
    //             this.api()
    //                 .columns(3)
    //                 .every(function () {
    //                     var column = this;
    //                     var select = $('<select id="UserRole" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Chi nhánh </option></select>')
    //                         .appendTo(".user_role")
    //                         .on("change", function () {
    //                             var val = $.fn.dataTable.util.escapeRegex($(this).val());
    //                             column.search(val ? "^" + val + "$" : "", true, false).draw();
    //                         });
    //
    //                     column
    //                         .data()
    //                         .unique()
    //                         .sort()
    //                         .each(function (d, j) {
    //                             select.append('<option value="' + d + '" class="text-capitalize">' + d + "</option>");
    //                         });
    //                 });
    //             // Adding plan filter once table initialized
    //             this.api()
    //                 .columns(4)
    //                 .every(function () {
    //                     var column = this;
    //                     var select = $('<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Phòng ban </option></select>')
    //                         .appendTo(".user_plan")
    //                         .on("change", function () {
    //                             var val = $.fn.dataTable.util.escapeRegex($(this).val());
    //                             column.search(val ? "^" + val + "$" : "", true, false).draw();
    //                         });
    //
    //                     column
    //                         .data()
    //                         .unique()
    //                         .sort()
    //                         .each(function (d, j) {
    //                             select.append('<option value="' + d + '" class="text-capitalize">' + d + "</option>");
    //                         });
    //                 });
    //             // Adding status filter once table initialized
    //             // this.api()
    //             //     .columns(5)
    //             //     .every(function () {
    //             //         var column = this;
    //             //         var select = $('<select id="FilterTransaction" class="form-control text-capitalize mb-md-0 mb-2xx"><option value="">Đến ngày</option></select>')
    //             //             .appendTo(".user_status")
    //             //             .on("change", function () {
    //             //                 var val = $.fn.dataTable.util.escapeRegex($(this).val());
    //             //                 column.search(val ? "^" + val + "$" : "", true, false).draw();
    //             //             });
    //             //
    //             //         column
    //             //             .data()
    //             //             .unique()
    //             //             .sort()
    //             //             .each(function (d, j) {
    //             //                 select.append('<option value="' + statusObj[d].title + '" class="text-capitalize">' + statusObj[d].title + "</option>");
    //             //             });
    //             //     });
    //         },
    //     });
    // }

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

    if (commentEditor.length) {
        new Quill(".comment-editor", {
            modules: {
                toolbar: ".comment-toolbar",
            },
            placeholder: "Write a Comment... ",
            theme: "snow",
        });
    }

});

function loaddata(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseApi + "/nhansu/loaddata",
        success: function (data) {
            $('#nhanvien').html(data.name);
            $('#avatar').attr('src', data.hinh_anh);
            if (data.gioi_tinh==1)
               $("#male").prop("checked", true).trigger("click");
            else
               $("#female").prop("checked", true).trigger("click");
            if (data.tinh_trang==1)
               $("#hopdong1").prop("checked", true).trigger("click");
            else if (data.tinh_trang==2)
               $("#hopdong2").prop("checked", true).trigger("click");
            else if (data.tinh_trang==3)
               $("#hopdong3").prop("checked", true).trigger("click");
            else if (data.tinh_trang==4)
               $("#hopdong4").prop("checked", true).trigger("click");
            $('#hoten').val(data.name);
            $('#ngaysinh').flatpickr({
                monthSelectorType: "static",
                altInput: true,
                defaultDate: data.ngay_sinh,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
            });
            $('#dienthoai').val(data.dien_thoai);
            $('#email').val(data.email);
            $('#diachi').val(data.dia_chi);
            $('#quequan option[value='+data.que_quan+']').attr('selected','selected');
            $("#quequan").val(data.que_quan).change();
            $('#cmnd').val(data.cmnd);
            $('#ngaycap').flatpickr({
                monthSelectorType: "static",
                altInput: true,
                defaultDate: data.ngay_cap,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
            });
            $('#noicap option[value='+data.noi_cap+']').attr('selected','selected');
            $("#noicap").val(data.noi_cap).change();
            $('#masothue').val(data.ma_so_thue);
            $('#bhxh').val(data.bhxh);
            $('#thuongtru').val(data.thuong_tru);
            $("#id").val(id);
        },
        error: function(){
            notify_error('Lỗi truy xuất database');
        }
    });
}

function updateinfo() {
    var id = $("#id").val();
    var info = {};
    info.gioi_tinh = $("input[type='radio'][name='gender']:checked").val();
    info.tinh_trang = $("input[type='radio'][name='hopdong']:checked").val();
    info.name = $("#hoten").val();
    info.ngay_sinh = $("#ngaysinh").val();
    info.dien_thoai = $("#dienthoai").val();
    info.email = $("#email").val();
    info.dia_chi = $("#diachi").val();
    info.que_quan = $("#quequan").val();
    info.cmnd = $("#cmnd").val();
    info.ngay_cap = $("#ngaycap").val();
    info.noi_cap = $("#noicap").val();
    info.ma_so_thue = $("#masothue").val();
    info.thuong_tru = $("#thuongtru").val();
    info.bhxh = $("#bhxh").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {data:info, id:id},
        url: baseApi + "/nhansu/updateinfo",
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

// function send(){
    // var id = $("#id").val();
    // var myform = new FormData($('#thongtin')[0]);
    // myform.append('myid', id);
    // $.ajax({
    //     url: baseApi + "/nhansu/thayanh",
    //     type: 'post',
    //     data: myform,
    //     contentType: false,
    //     processData: false,
    //     success: function(data){
    //         if (data.success) {
    //            notyfi_success(data.msg);
    //            $('#avatar').attr('src', data.filename);
    //         }
    //         else
    //             notify_error(data.msg);
    //     },
    // });
// }

function send() {
    var quill_editor = $('.compose-form .ql-editor');
    var nguoinhan = $("#email-to").val();
    var info = {};
    info.tieu_de = $("#emailSubject").val();
    info.noi_dung = quill_editor[0].innerHTML;
    info.tinh_trang = 1;
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {data:info,nguoinhan:nguoinhan},
        url: baseApi + "/inbox/send",
        success: function (data) {
            if (data.success)
                notyfi_success(data.msg);
            else
                notify_error(data.msg);
        },
        error: function(){
            notify_error('Server error');
        }
    });
}

function xoa(id){
    $.ajax({
        url: baseApi + "/nhansu/xoa",
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
//
// function thoiviec(id){
//     $.ajax({
//         url: baseApi + "/nhansu/thoiviec",
//         type: 'post',
//         dataType: "json",
//         data: {id: id},
//         success: function(data){
//             if (data.success) {
//                notyfi_success(data.msg);
//                $(".user-list-table").DataTable().ajax.reload( null, false );
//             }
//             else
//                 notify_error(data.msg);
//         },
//     });
// }
