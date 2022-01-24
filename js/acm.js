$(function () {


    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        khach_hang = $("#khach_hang"),
        nhan_vien = $("#nhan_vien"),
        tai_khoan = $("#tai_khoan"),
        datePicker = $("#ngay_gio"),
        form = $("#dg");
       
        loaiObj = {
            0: { title: "Thu", class: "badge-light-success" },
            1: { title: "Chi", class: "badge-light-warning" },
        };

        // datepicker init
        if (datePicker.length) {
            datePicker.flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d",
            });
        } 

        

        
        $.ajax({ // tải Khách hàng vào select1 khach_hang
            type: "GET",
            dataType: "json",
            async: false,
            url: baseHome + "/acm/khachhang",
            success: function (data) {
                khach_hang.wrap('<div class="position-relative"></div>').select2({
                dropdownAutoWidth: true,
                dropdownParent: khach_hang.parent(),
                width: '100%',
                data: data
                });
            },
        });

        $.ajax({ // tải Khách hàng vào select1 tai_khoan
            type: "GET",
            dataType: "json",
            async: false,
            url: baseHome + "/acm/taikhoan",
            success: function (data) {
                tai_khoan.wrap('<div class="position-relative"></div>').select2({
                dropdownAutoWidth: true,
                dropdownParent: tai_khoan.parent(),
                width: '100%',
                data: data
                });
            },
        });
        
        $.ajax({ // tải Nhân viên vào select1 nhan_vien
            type: "GET",
            dataType: "json",
            async: false,
            url: baseHome + "/acm/nhanvien",
            success: function (data) {
                nhan_vien.wrap('<div class="position-relative"></div>').select2({
                dropdownAutoWidth: true,
                dropdownParent: nhan_vien.parent(),
                width: '100%',
                data: data
                });
            },
        });

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/acm/list",
            "ordering": false,
            columns: [
                // columns according to JSON
                // { data: "" },
                { data: "ngay_gio_fomart" },
                { data: "name_tk" },
                { data: "dien_giai" },
                { data: "sotien_format" },
                { data: "sodu_format" },
                { data: "loai" },
                { data: "" },
            ],
            columnDefs: [
                {
                    // For Responsive
                    // className: "control",
                    // orderable: false,
                    // responsivePriority: 0,
                    // targets: 0,
                    // render: function (data, type, full, meta) {
                    //     return "";
                    // }
                },
                {
                    // User full name and username
                    targets: 1,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name_tk = full["name_tk"];
                            
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="d-flex flex-column">' +
                            '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ')" data-toggle="modal" data-target="#updateinfo" class="user_name text-truncate"><span class="font-weight-bold">' +
                            $name_tk +
                            "</span></a>" +
                            
                            "</div>" +
                            "</div>";
                        return $row_output;
                    },
                },
                {
                    // Loai Status
                    targets: 5,
                    render: function (data, type, full, meta) {
                        var $loai = full["loai"];
                        return '<span class="badge badge-pill ' + loaiObj[$loai].class + '" text-capitalized>' + loaiObj[$loai].title + "</span>";
                    },
                },

                


               
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<div style="width: 80px;"><button type="button" class="btn btn-icon btn-outline-primary waves-effect" data-toggle="modal" data-target="#updateinfo" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="xoa(' + full['id'] + ')">';
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
                searchPlaceholder: "11111111112..",
            },
            // Buttons with Dropdown
            buttons: [
                {
                    text: "Thêm mới",
                    className: "add-new btn btn-primary mt-50",
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                    },
                    action: function (e, dt, node, config) {
                        $("#updateinfo").modal('show');
                        $(".modal-title").html('Thêm thu chi mới');
                        $("#btn_add").attr("disabled", true);
                        $('#name').val('');
                        $('#dien_giai').val('');
                        $('#khach_hang').val(0);
                        $('#khach_hang').trigger("change");
                        $('#nhan_vien').val(0);
                        $('#nhan_vien').trigger("change");
                        $('#tai_khoan').val(0);
                        $('#tai_khoan').trigger("change");
                        $('#loai').val('');
                        $('#hach_toan').val('');
                        $('#so_tien').val('');
                        $('#ghi_chu').val('');
                        $('#tinh_trang').val('1');
                        var dateObj = new Date();
                        var phut = dateObj.getMinutes();
                        phut = phut > 9 ? phut : '0' + phut;

                        var gio = dateObj.getHours();
                        gio = gio > 9 ? gio : '0' + gio;

                        var giay = dateObj.getSeconds();
                        giay = giay > 9 ? giay : '0' + giay;

                        var thang = dateObj.getMonth();
                        thang = thang > 9 ? thang : '0' + thang;

                        var ngay = dateObj.getDate();
                        ngay = ngay > 9 ? ngay : '0' + ngay;
                        
                        var dateToUse = dateObj.getFullYear() + "-" + thang + "-" + ngay;
                        $('#ngay_gio').val(dateToUse);
                        url = baseHome + "/acm/add";
                    },
                },
                {
                    text: "Chốt số dư",
                    className: "update_sodu btn btn-primary mt-50",
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                    },
                    action: function (e, dt, node, config) {
                        chot_so_du();
                    },
                },
            ],
            // For responsive popup
            // responsive: {
            //     details: {
            //         display: $.fn.dataTable.Responsive.display.modal({
            //             header: function (row) {
            //                 var data = row.data();
            //                 return "Details of " + data["name"];
            //             },
            //         }),
            //         type: "column",
            //         renderer: $.fn.dataTable.Responsive.renderer.tableAll({
            //             tableClass: "table",
            //             columnDefs: [
            //                 {
            //                     targets: 8,
            //                     visible: false,
            //                 },
            //                 {
            //                     targets: 1,
            //                     visible: false,
            //                 },
            //             ],
            //         }),
            //     },
            // },
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            initComplete: function () {
                
                // Adding plan filter once table initialized
                this.api()
                    .columns(1)
                    .every(function () {
                        var column = this;
                        var select = $('<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Tài khoản </option></select>')
                            .appendTo(".taikhoan_filter")
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
    if (form.length) {
        form.validate({
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

        form.on("submit", function (e) {
            var isValid = form.valid();
            e.preventDefault();
            if (isValid) {
                modal.modal("hide");
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
    $(".modal-title").html('Cập nhật thông tin sổ tiền mặt');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/acm/loaddata",
        success: function (data) {
            $('#ngay_gio').val(data.ngay_gio);
            $('#dien_giai').val(data.dien_giai);
            $("#khach_hang").val(data.khach_hang).trigger('change');
            $("#tai_khoan").val(data.tai_khoan).trigger('change');
            $("#nhan_vien").val(data.nhan_vien).trigger('change');
            $('#loai').attr("disabled", false);
            $('#loai').val(data.loai);
            $('#hach_toan').val(data.hach_toan);
            $("#so_tien").val(formatCurrency(data.so_tien.replace(/[,VNĐ]/g,'')));
            $('#ghi_chu').val(data.ghi_chu);
            url = baseHome + '/acm/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function saveacm() {
    var info = {};
    info.ngay_gio = $("#ngay_gio").val();
    info.dien_giai = $("#dien_giai").val();
    info.khach_hang = $("#khach_hang").val();
    info.nhan_vien = $("#nhan_vien").val();
    info.tai_khoan = $("#tai_khoan").val();
    info.loai = $("#loai").val();
    info.hach_toan = $("#hach_toan").val();
    info.so_tien = $("#so_tien").val();
    info.ghi_chu = $("#ghi_chu").val();

    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: url,
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

function xoa(id) {
    $.ajax({
        url: baseHome + "/acm/del",
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
function check_loai() {
    var loai = $("#loai").val();
    var taikhoan = $("#tai_khoan").val();
    if(taikhoan > 0 && loai != ""){
        $("#btn_add").attr("disabled", false);
    }
}

//format_number so_tien
$('#so_tien').on('input', function(e){        
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


function chot_so_du() {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {},
        url: baseHome + "/acm/chotsodu",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $(".user-list-table").DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
            
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}









