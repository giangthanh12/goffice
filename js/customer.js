var url = '';
var dtDVTable = $("#dichvu-list-table");
var transactionTable = $("#transaction-list-table");
var khid = '';
$(function () {
    "use strict";
    return_combobox_multi('#staffId', baseHome + '/customer/getStaff', 'Chọn nhân viên chăm sóc');
    return_combobox_multi('#nationalId', baseHome + '/customer/getNational', 'Chọn quốc gia');
    return_combobox_multi('#staffId1', baseHome + '/customer/getStaff', 'Chọn nhân viên chăm sóc');
    return_combobox_multi('#staffId2', baseHome + '/customer/getStaff', 'Chọn nhân viên chăm sóc');
    return_combobox_multi('#nationalId1', baseHome + '/customer/getNational', 'Chọn quốc gia');
    return_combobox_multi('#provinceId', baseHome + '/customer/getProvince', 'Chọn tỉnh thành');
    return_combobox_multi('#provinceId1', baseHome + '/customer/getProvince', 'Chọn tỉnh thành');
    return_combobox_multi('#provinceId2', baseHome + '/customer/getProvince', 'Chọn tỉnh thành');
    $('#provinceId2').val('').change();
    $('#classify').select2({
        placeholder: 'Phân loại khách hàng',
        dropdownParent: $('#classify').parent(),
    });
    $('#type').select2({
        placeholder: 'Loại hình hoạt động',
        dropdownParent: $('#type').parent(),
    });

    $('#type2').select2({
        placeholder: 'Loại hình hoạt động',
        dropdownParent: $('#type2').parent(),
    });
  
    $('#type2').val('').change();

    $('#phutrach_import').val('').change();
    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");
    
    // Users List datatable
    if (dtUserTable.length) {
     var table =   dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/customer/list",
            autoWidth: false,
            ordering: false,
            columns: [
                { data: "fullName" },
                { data: "phoneNumber" },
                { data: "website" },
                { data: "email" },
                { data: "field"},
                { data: "classify"},
                { data: "type"},
                { data: "provinceId"},
                { data: "address"},
                { data: "" },
            ],
            columnDefs: [
              

                {
                    // User full name and username
                    targets: 0,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full["fullName"],
                            $uname = full["office"];
                        if ($name == '') {
                            $name = full["fullName"];
                        }
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="d-flex flex-column">' +
                            '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ')" data-toggle="modal" data-target="#updateinfo" class="user_name text-truncate"><span class="font-weight-bold">' +
                            $name +
                            "</span></a>" +
                            '' +
                          
                            "</small>" +
                            "</div>" +
                            "</div>";
                        return $row_output;
                    },
                },
                {
                    targets: 1,
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
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + full['website'] + "</div>";
                    },
                },
                {
                    targets: 4,
                    visible: false,
                },
                {
                    targets: 5,
                    visible: false,
                },
                {
                    targets: 6,
                    visible: false,
                },
                {
                    targets: 7,
                    visible: false,
                },
                {
                    targets: 8,
                    visible: false,
                },
                {
                    // Actions
                    targets: 9,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3  text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
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
                searchPlaceholder: "Tìm kiếm...",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            // Buttons with Dropdown
            buttons: [
                {
                    text: "Thêm mới",
                    className: "add-new  btn btn-primary mt-50",
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                    },
                    action: function (e, dt, node, config) {
                        $("#addinfo").modal('show');
                        $(".modal-title").html('Thêm khách hàng mới');
                        $('#fullName').val('');
                        // $('#taxCode').val('');
                        // $('#address').val('');
                        $('#phoneNumber').val('');
                        $('#email').val('');
                        $('#website').val('');
                        // $('#office').val('');
                        // $('#field').val('');
                        // $('#fieldDetail').val('');
                        $('#staffId').val('').change();
                        // $('#rank').val('').change();
                        // $('#bussinessName').val('');
                        // $('#bussinessAddress').val('');
                        // $('#bussinessPlace').val('');
                        // $('#representative').val('');
                        // $('#authorized').val('');
                        // $('#note').val('');
                        // $('#classify').val('').change();
                        // $('#type').val('').change();
                        $('#nationalId').val(237).change();
                        $('#provinceId').val('').change();
                        $('#status').val('1').attr("disabled", true);
                    },
                },
                {
                    text: "Nhập excel",
                    className: " btn  btn-primary mt-50",
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                    },
                    action: function (e, dt, node, config) {
                        nhapexcel();
                    },
                },
            ],

            initComplete: function () {
                // Adding role filter once table initialized
             var api =   this.api();
                 api.columns(5)
                    .every(function () {
                        var column = this;
                     
                        $("#classify2").select2({
                                placeholder: 'Phân loại khách hàng',
                                dropdownParent: $("#classify2").parent(),
                            });
                            $("#classify2").on("change", function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? "^" + val + "$" : "", true, false).draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                var $stt_output = "";
                                if (d == 1) {
                                    $stt_output = "Khách hàng";
                                } else if (d == 2) {
                                    $stt_output = "Đối tác";
                                }
                                if ($stt_output != '') {
                                    $("#classify2").append('<option value="' + d + '" class="text-capitalize">' + $stt_output + "</option>");
                                }
                            });
                           
                            $("#classify2").val('').change(); // sau khi thêm option mới thêm val('');
                    });
            },
        });

    }

    // lọc tỉnh

    $('#provinceId2').change(function() {
        table.column($(this).data('column'))
             .search($(this).val())
             .draw()
    })

    // lọc loại hình hoạt động

    $('#type2').change(function() {
        table.column($(this).data('column'))
             .search($(this).val())
             .draw()
    })

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
                "fullName": {
                    required: true,
                },
                // "taxCode": {
                //     required: true,
                // },
                // "address": {
                //     required: true,
                // },
                "phoneNumber": {
                    required: true,
                },
                "email": {
                    required: true,
                },
                "website": {
                    required: true,
                },
                // "staffId": {
                //     required: true,
                // },
                // "office": {
                //     required: true,
                // },
                // "field": {
                //     required: true,
                // },
                // "fieldDetail": {
                //     required: true,
                // },
                // "rank": {
                //     required: true,
                // },
                // "bussinessName": {
                //     required: true,
                // },
                // "bussinessAddress": {
                //     required: true,
                // },
                // "bussinessPlace": {
                //     required: true,
                // },
                // "representative": {
                //     required: true,
                // },
                // "authorized": {
                //     required: true,
                // },
                // "note": {
                //     required: true,
                // },
                // "classify": {
                //     required: true,
                // },
                // "type": {
                //     required: true,
                // },
                // "nationalId": {
                //     required: true,
                // },
                // "provinceId": {
                //     required: true,
                // },
                "status": {
                    required: true,
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
    //form validate edit
    if ($('#dg1').length) {
        $('#dg1').validate({
            errorClass: "error",
            rules: {
                "fullName1": {
                    required: true,
                },
                // "taxCode1": {
                //     required: true,
                // },
                // "address1": {
                //     required: true,
                // },
                "phoneNumber1": {
                    required: true,
                },
                "email1": {
                    required: true,
                },
                "website1": {
                    required: true,
                },
                // "staffId1": {
                //     required: true,
                // },
                // "office1": {
                //     required: true,
                // },
                // "field1": {
                //     required: true,
                // },
                // "fieldDetail1": {
                //     required: true,
                // },
                // "rank1": {
                //     required: true,
                // },
                // "bussinessName1": {
                //     required: true,
                // },
                // "bussinessAddress1": {
                //     required: true,
                // },
                // "bussinessPlace1": {
                //     required: true,
                // },
                // "representative1": {
                //     required: true,
                // },
                // "authorized1": {
                //     required: true,
                // },
                // "classify1": {
                //     required: true,
                // },
                // "type1": {
                //     required: true,
                // },
                // "nationalId1": {
                //     required: true,
                // },
                // "provinceId1": {
                //     required: true,
                // },
                // "status1": {
                //     required: true,
                // },
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




    // To initialize tooltip with body container
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
        container: "body",
    });
});

function loaddata(id) {
    khid = id;
    $("#updateinfo").modal('show');
    $('#information-tab').click();
    $(".modal-title").html('Cập nhật thông tin khách hàng');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/customer/loaddata",
        success: function (data) {
         console.log(data.fullName);
            $('#fullName1').val(data.fullName);
            $('#taxCode1').val(data.taxCode);
            $('#address1').val(data.address);
            $('#phoneNumber1').val(data.phoneNumber);
            $('#email1').val(data.email);
            $('#website1').val(data.website);
            $('#staffId1').val(data.staffid).change();
            $('#office1').val(data.office);
            $('#field1').val(data.field);
            $('#fieldDetail1').val(data.fieldDetail);
            $('#rank1').val(data.rank).change();
            $('#bussinessName1').val(data.businessName);
            $('#bussinessAddress1').val(data.businessAddress);
            $('#bussinessPlace1').val(data.businessPlace);
            $('#representative1').val(data.representative);
            $('#authorized1').val(data.authorized);
            $('#note1').val(data.note);
            $('#classify1').val(data.classify);
            $('#type1').val(data.type).change();
            $('#nationalId1').val(data.nationalId).change();
            $('#provinceId1').val(data.provinceId).change();
            $('#status1').val(data.status).attr("disabled", true);
            loaddichvu(id);
            loadTransaction(id);
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function loaddichvu(id) {

    if (dtDVTable.length) {
    
        dtDVTable.DataTable({
            ajax: baseHome + "/customer/loadContact?id=" + id,
            destroy: true,

            columns: [
                // columns according to JSON
                { data: "name" },
                { data: "phoneNumber" },
                { data: "email" },
                { data: "facebook" },
            ],
            columnDefs: [
            
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

//load transaction
function loadTransaction(id) {

    if (transactionTable.length) {
    
        transactionTable.DataTable({
            ajax: baseHome + "/customer/loadTransaction?id=" + id,
            destroy: true,

            columns: [
                // columns according to JSON
                { data: "date" },
                { data: "type" },
                { data: "asset" },
                { data: "description" },
            ],
            columnDefs: [
                {
                    // Actions
                    targets: 1,
                  
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                       if(full['type'] == 1) {
                          html =  `<div class="badge badge-pill badge-light-info">Đơn hàng</div>`;
                       }
                       else if (full['type'] == 2) {
                        html =  `<div class="badge badge-pill badge-light-primary">Hợp đồng</div>`;
                       }
                       else if(full['type'] == 3) {
                        html =   `<div class="badge badge-pill badge-light-success">Thanh toán</div>`;
                       }
                        return html;
                    },
                    width: 150
                },
                {
                    // Actions
                    targets: 2,
                    orderable: true,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(full['asset']);
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



function saveadd() {
    var info = {};
    info.fullName = $("#fullName").val();
    // info.taxCode = $("#taxCode").val();
    // info.address = $("#address").val();
    info.phoneNumber = $("#phoneNumber").val();
    info.email = $("#email").val();
    info.website = $("#website").val();
    info.staffId = $("#staffId").val();
    // info.office = $("#office").val();
    // info.field = $("#field").val();
    // info.fieldDetail = $("#fieldDetail").val();
    // info.rank = $("#rank").val();
    // info.bussinessName = $("#bussinessName").val();
    // info.bussinessAddress = $("#bussinessAddress").val();
    // info.bussinessPlace = $("#bussinessPlace").val();
    // info.representative = $("#representative").val();
    // info.authorized = $("#authorized").val();
    // info.note = $("#note").val();
    // info.classify = $("#classify").val();
    // info.type = $("#type").val();
    info.nationalId = $("#nationalId").val();
    info.provinceId = $("#provinceId").val();
    info.status = $("#status").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: baseHome + "/customer/add",
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

function saveedit() {
    var info = {};
    info.fullName = $("#fullName1").val();
    info.taxCode = $("#taxCode1").val();
    info.address = $("#address1").val();
    info.phoneNumber = $("#phoneNumber1").val();
    info.email = $("#email1").val();
    info.website = $("#website1").val();
    info.staffId = $("#staffId1").val();
    info.office = $("#office1").val();
    info.field = $("#field1").val();
    info.fieldDetail = $("#fieldDetail1").val();
    info.rank = $("#rank1").val();
    info.bussinessName = $("#bussinessName1").val();
    info.bussinessAddress = $("#bussinessAddress1").val();
    info.bussinessPlace = $("#bussinessPlace1").val();
    info.representative = $("#representative1").val();
    info.authorized = $("#authorized1").val();
    info.note = $("#note1").val();
    info.classify = $("#classify1").val();
    info.type = $("#type1").val();
    info.nationalId = $("#nationalId1").val();
    info.provinceId = $("#provinceId1").val();
    info.status = $("#status1").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: baseHome + '/customer/update?id=' + khid,
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

function del(id) {
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
                url: baseHome + "/customer/del",
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





///// ADD bao gia js


function loadbaogia(id) {
    $('#modal_baogia').modal('show');
    $(".modal-title").html('Tạo báo giá');
    $("#table_sp").empty();
    $("#viewfile").empty();
    var dateObj = new Date();
    var thang = dateObj.getMonth();
    thang = thang+1;
    thang = thang > 9 ? thang : '0' + thang;
    var ngay = dateObj.getDate();
    ngay = ngay > 9 ? ngay : '0' + ngay;
    var dateToUse = dateObj.getFullYear() + "-" + thang + "-" + ngay;
        
    $('#ngay').val(dateToUse);
    $('#tong_donhang').val('');
    $('#chiet_khau').val('');
    $('#thanh_toan').val('');
    $('#file_bg').val('');
    $('#khach_hang_bg').empty();
    $('#nhan_vien_bg').val(0);
    $('#nhan_vien_bg').trigger("change");
    $('#dich_vu').val(0);
    $('#dich_vu').trigger("change");
    $('#san_pham').val(0);
    $('#san_pham').trigger("change");
    $('.btn-add').attr("disabled", true);
    $('#ghi_chu_bg').val('');

    
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/baogia/load_id_kh",
        success: function (data) {
            $("#khach_hang_bg").val(data.id).trigger('change');
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });

    var nhan_vien = $('#nhan_vien_bg');

    var dich_vu = $('#dich_vu');
    var san_pham = $('#san_pham');
    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/baogia/nhanvien",
        success: function (data) {
            nhan_vien.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: nhan_vien.parent(),
            width: '100%',
            data: data
            });
        },
    });
    var khach_hang = $('#khach_hang_bg');
    $.ajax({ 
        type: "GET",
        dataType: "json",
        data:{id:id},
        async: false,
        url: baseHome + "/baogia/loaddata_kh",
        success: function (data) {
            khach_hang.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: khach_hang.parent(),
            width: '100%',
            data: data
            });
        },
    });

    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/baogia/dichvu",
        success: function (data) {
            dich_vu.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: dich_vu.parent(),
            width: '100%',
            data: data
            });
        },
    });

    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/baogia/sanpham",
        success: function (data) {
            san_pham.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: san_pham.parent(),
            width: '100%',
            data: data
            });
        },
    });

}


function load_dichvu(){
    var id = $('#dich_vu').val();
    var khach_hang = $('#khach_hang_bg').val();
    var nhan_vien = $('#nhan_vien_bg').val();
    if(khach_hang >0 && nhan_vien>0){
        $(".btn-add").attr("disabled", false);
    }else{
        $(".btn-add").attr("disabled", true);
    }
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id},
        url: baseHome + "/baogia/load_dichvu",
        success: function (data) {
            var stt = $('#stt').val();
            var i =  Number(stt) + 1;
            $('#stt').val(i);
            $('#table_sp').append('<tr id="arr'+i+'"><td>'+data.name+'</td><td><input type="text" id="don_gia'+i+'" onkeyup="load_tien('+i+')" name="don_gia[]" class="form-control input format_number" value="'+data.don_gia+'"></td><td><input type="hidden" name="id_sp[]" id="id_sp['+i+']" value="'+data.id+'"></input><input type="hidden" name="loai[]" id="loai['+i+']" value="0"></input><input type="text" onkeyup="load_tien('+i+')" name="so_luong[]" id="so_luong'+i+'" value="1" class="form-control input" ></td><td><input type="text" id="chiet_khau'+i+'" onkeyup="load_tien('+i+')" name="chiet_khau_tm[]" class="form-control input format_number" value="0"></td><td><select name="thue[]" id="thue'+i+'" class="thue'+i+' form-control" onchange="load_tien('+i+')"><option value="0">Không</option><option value="5">5%</option><option value="10">10%</option></select></td><td><input type="text" id="tien_thue'+i+'" name="tien_thue[]" onkeyup="load_tien('+i+')" value="'+data.thue_vat+'" class="form-control input format_number"></td><td><input type="date" id="ngay_s" name="ngay_s[]" class="form-control" placeholder="Ngày bắt đầu" ><input type="date" id="ngay_e" name="ngay_e[]" class="form-control" style="margin-top:4px" placeholder="Ngày kết thúc"> </td><td><input type="text" id="thanh_tien'+i+'" name="thanh_tien[]" class="form-control input  format_number" readonly></td><td><a  onclick="remove_tr('+i+');return false"><i class="fas fa-trash-alt"></i></a></td></tr>');
            
            $('#dich_vu').val(0);
            $('#dich_vu').trigger("change");
            $('#san_pham').val(0);
            $('#san_pham').trigger("change");
            $("#thue"+i).val(data.tax).trigger('change');
        },
        error: function () {
        }
    });
    
}

function load_sanpham(){
    var id = $('#san_pham').val();
    var khach_hang = $('#khach_hang_bg').val();
    var nhan_vien = $('#nhan_vien_bg').val();
    if(khach_hang >0 && nhan_vien>0){
        $(".btn-add").attr("disabled", false);
    }else{
        $(".btn-add").attr("disabled", true);
    }
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id},
        url: baseHome + "/baogia/load_sanpham",
        success: function (data) {
            var stt = $('#stt').val();
            var i =  Number(stt) + 1;
            $('#stt').val(i);

            $('#table_sp').append('<tr id="arr'+i+'"><td>'+data.name+'</td><td><input type="text" id="don_gia'+i+'" onkeyup="load_tien('+i+')" name="don_gia[]" class="form-control input format_number" value="'+data.don_gia+'"></td><td><input type="hidden" name="id_sp[]" id="id_sp['+i+']" value="'+data.id+'"></input><input type="hidden" name="loai[]" id="loai['+i+']" value="1"></input><input type="text" onkeyup="load_tien('+i+')" name="so_luong[]" id="so_luong'+i+'" value="1" class="form-control input" ></td><td><input type="text" id="chiet_khau'+i+'" onkeyup="load_tien('+i+')" name="chiet_khau_tm[]" class="form-control input format_number" value="0"></td><td><select name="thue[]" id="thue'+i+'" class="thue'+i+' form-control" onchange="load_tien('+i+')"><option value="0">Không</option><option value="5">5%</option><option value="10">10%</option></select></td><td><input type="text" id="tien_thue'+i+'" name="tien_thue[]" onkeyup="load_tien('+i+')" value="'+data.thue_vat+'" class="form-control input format_number"></td><td><input type="date" id="ngay_s" name="ngay_s[]" class="form-control" placeholder="Ngày bắt đầu" ><input type="date" id="ngay_e" name="ngay_e[]" class="form-control" style="margin-top:4px" placeholder="Ngày kết thúc"> </td><td><input type="text" id="thanh_tien'+i+'" name="thanh_tien[]" class="form-control input  format_number" readonly></td><td><a  onclick="remove_tr('+i+');return false"><i class="fas fa-trash-alt"></i></a></td></tr>');
            $('#dich_vu').val(0);
            $('#dich_vu').trigger("change");
            $('#san_pham').val(0);
            $('#san_pham').trigger("change");
            $("#thue"+i).val(data.tax).trigger('change');

        },
        error: function () {
        }
    });
    
}

function check_ghichu_csbg(){
    var ghichu = $('#ghi_chu_care').val();
    if(ghichu == ''){
        $(".btn-add").attr("disabled", true);
    }else{
        $(".btn-add").attr("disabled", false);
    }
}



function remove_tr(i){
    $("#arr"+i).remove();
    tong_thanh_toan();
}

function load_tien(i){
    var chiet_khau = $("#chiet_khau"+i).val();
    chiet_khau = chiet_khau.replace(/,/g,'');
    var tax = Number($("#thue"+i).val());
    var tien_dv = $("#don_gia"+i).val();
    tien_dv = tien_dv.replace(/,/g,'');
    var so_luong = Number($("#so_luong"+i).val());
    var tien_thue = $("#tien_thue"+i).val();
    tien_thue = tien_thue.replace(/,/g,'');

   
    if(tax == 0){
         tienthue = 0;
    }else{
         tienthue = (tien_dv-chiet_khau)*so_luong*tax/100;
    }
    thanhtien = (tien_dv*so_luong)+tienthue-chiet_khau;
    $("#chiet_khau"+i).val(formatCurrency(chiet_khau+''.replace(/[,VNĐ]/g,'')));
    $("#don_gia"+i).val(formatCurrency(tien_dv+''.replace(/[,VNĐ]/g,'')));
    $("#tien_thue"+i).val(formatCurrency(tienthue+''.replace(/[,VNĐ]/g,'')));
    $("#thanh_tien"+i).val(formatCurrency(thanhtien+''.replace(/[,VNĐ]/g,'')));

    tong_thanh_toan();
}

function tong_thanh_toan(){
    var thanhtien = 0;
    $("input[name='thanh_tien[]']")
    .map(function(){
       thanhtien+=Number($(this).val().replace(/,/g,'')); 
    });
    $('#tong_donhang').val(formatCurrency(thanhtien+''.replace(/[,VNĐ]/g,'')));

    var chiet_khau = $('#chiet_khau').val();
        chiet_khau = Number(chiet_khau.replace(/,/g,''));
    var thanh_toan = $('#thanh_toan').val();
    thanh_toan = Number(thanh_toan.replace(/,/g,''));
    thanh_toan = thanhtien - chiet_khau;
    $('#thanh_toan').val(formatCurrency(thanh_toan+''.replace(/[,VNĐ]/g,'')));

}



function check_form(){
    var khach_hang = $('#khach_hang_bg').val();
    var nhan_vien = $('#nhan_vien_bg').val();
    var thanh_toan = $('#thanh_toan').val();

    if(khach_hang >0 && nhan_vien>0 && thanh_toan != ""){
        $(".btn-add").attr("disabled", false);
    }else{
        $(".btn-add").attr("disabled", true);
    }

}

function savetk() {
    var myform = new FormData($("#dg_bg")[0]);
        $.ajax({
            type: "POST",
            dataType: "json",
            data: myform,
            url : baseHome + "/baogia/add_to_kh",
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.success) {
                    notyfi_success(data.msg);
                    window.location.href='baogia';
                }
                else
                    notify_error(data.msg);
            },
            error: function () {
                notify_error('Cập nhật không thành công');
            }
        });
}



