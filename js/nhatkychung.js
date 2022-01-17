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

      $.ajax({ // tải thành phố vào select2 thanhpho
          type: "GET",
          dataType: "json",
          async: false,
          url: baseHome + "/nhansu/thanhpho",
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
            ajax: baseHome + "/nhatkychung/getData",
            ordering: false,
            columns: [
                // columns according to JSON
                { data: "ngay" },
                { data: "chung_tu" },
                { data: "dien_giai" },
                { data: "taikhoan" },
                { data: "khachhang" },
                { data: "no" },
                { data: "co" },
                { data: "doi_ung" },
                { data: "tinh_trang" },
            ],
            columnDefs: [
                // {
                //     // For Responsive
                //     className: "control",
                //     orderable: false,
                //     responsivePriority: 2,
                //     targets: 0,
                // },
                {
                    // User full name and username
                    targets: 2,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full["dien_giai"];
                        var $row_output =
                            '<a href="javascript:void(0)" onclick="loaddata('+full["id"]+')" data-toggle="modal" data-target="#updateinfo"><span class="font-weight-bold">' +
                            $name;
                        return $row_output;
                    },
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="btn-group">' +
                            '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
                            feather.icons["more-vertical"].toSvg({ class: "font-small-4" }) +
                            "</a>" +
                            '<div class="dropdown-menu dropdown-menu-right">' +
                            '<a href="javascript:void(0)" class="dropdown-item" data-toggle="modal" data-target="#updateinfo" onclick="loaddata('+full["id"]+')">' +
                            feather.icons["file-text"].toSvg({ class: "font-small-4 mr-50" }) +
                            "Cập nhật</a>" +
                            '<a href="javascript:void(0)" class="dropdown-item" onclick="thoiviec('+full["id"]+')" >' +
                            feather.icons["archive"].toSvg({ class: "font-small-4 mr-50" }) +
                            "Chứng từ</a>" +
                            '<a href="javascript:void(0)" class="dropdown-item delete-record" onclick="xoa('+full["id"]+')">' +
                            feather.icons["trash-2"].toSvg({ class: "font-small-4 mr-50" }) +
                            "Xóa</a></div>" +
                            "</div>" +
                            "</div>"
                        );
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
            },
            // Buttons with Dropdown
            buttons: [
                {
                    text: "Thêm mới",
                    className: "add-new btn btn-primary mt-50",
                    attr: {
                        "data-toggle": "modal",
                        "data-target": "#modals-slide-in",
                    },
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                    },
                },
            ],
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
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            initComplete: function () {
                // Adding role filter once table initialized
                this.api()
                    .columns(4)
                    .every(function () {
                        var column = this;
                        var select = $('<select id="khachhang" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Khách hàng </option></select>')
                            .appendTo(".selectkh")
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
                    .columns(3)
                    .every(function () {
                        var column = this;
                        var select = $('<select id="taikhoan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Tài khoản </option></select>')
                            .appendTo(".selecttk")
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
});

function loaddata(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/nhansu/loaddata",
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
        type: 'post',
        data: myform,
        contentType: false,
        processData: false,
        success: function(data){
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
    info.tinh_trang = $("#tinh_trang").val();
    info.name = $("#fullname").val();
    info.dien_thoai = $("#dien_thoai").val();
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
    $.ajax({
        url: baseHome + "/nhansu/xoa",
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

function thoiviec(id){
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
