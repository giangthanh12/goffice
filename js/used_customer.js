var url = '';
var dtDVTable = $("#dichvu-list-table");
var transactionTable = $("#transaction-list-table");
var khid = '';
$(function () {
    "use strict";
    return_combobox_multi('#staffId', baseHome + '/used_customer/getStaff', 'Chọn nhân viên chăm sóc');
    return_combobox_multi('#nationalId', baseHome + '/used_customer/getNational', 'Chọn quốc gia');
    return_combobox_multi('#staffId1', baseHome + '/used_customer/getStaff', 'Chọn nhân viên chăm sóc');
    return_combobox_multi('#staffId2', baseHome + '/used_customer/getStaff', 'Chọn nhân viên chăm sóc');
    return_combobox_multi('#nationalId1', baseHome + '/used_customer/getNational', 'Chọn quốc gia');
    return_combobox_multi('#provinceId', baseHome + '/used_customer/getProvince', 'Chọn tỉnh thành');
    return_combobox_multi('#provinceId1', baseHome + '/used_customer/getProvince', 'Chọn tỉnh thành');
    // return_combobox_multi('#provinceId2', baseHome + '/used_customer/getProvince', 'Chọn tỉnh thành');
    load_select2($('#provinceId2'), baseHome + '/used_customer/getProvince', 'Chọn tỉnh thành');
    $('#provinceId2').val('').change();
    $('#classify').select2({
        placeholder: 'Phân loại khách hàng',
        dropdownParent: $('#classify').parent(),
    });
    $('#type').select2({
        placeholder: 'Loại hình hoạt động',
        dropdownParent: $('#type').parent(),
    });
    $('#type1').select2({
        placeholder: 'Loại hình hoạt động',
        dropdownParent: $('#type1').parent(),
    });
    $("#classify3").select2({
        placeholder: 'Phân loại khách hàng',
        dropdownParent: $("#classify3").parent(),
    });
    $("#classify3").val(1).change();
    $('#type2').select2({
        placeholder: 'Loại hình hoạt động',
        dropdownParent: $('#type2').parent(),
    });

    $('#type2').val('').change();

    $('#phutrach_import').val('').change();
    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");
    var buttons = [];
    if (funAdd == 1) {
        buttons.push({
            text: "Thêm mới",
            className: "add-new btn btn-" + 'primary' + " mt-50",
            init: function (api, node, config) {
                $(node).removeClass("btn-secondary");
            },
            action: function (e, dt, node, config) {
                actionMenu();
            }
        });
    }
    if (funImport == 1) {
        buttons.push({
            text: "Nhập excel",
            className: " btn  btn-primary mt-50",
            init: function (api, node, config) {
                $(node).removeClass("btn-secondary");
            },
            action: function (e, dt, node, config) {
                nhapexcel();
            },
        });
    }

    var visible = true;
    if (funEdit != 1 && funDel != 1) {
        visible = false;
    }
    // Users List datatable
    if (dtUserTable.length) {
        var table = dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/used_customer/list",
            autoWidth: false,
            ordering: false,
            columns: [
                { data: "fullName" },
                { data: "phoneNumber" },
                { data: "website" },
                { data: "email" },
                { data: "field" },
                { data: "status" },
                { data: "type" },
                { data: "provinceId" },
                { data: "address" },
                { data: "" },
            ],
            columnDefs: [
                {
                    // User full name and username
                    targets: 0,
                    // responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full["fullName"],
                            $uname = full["office"];
                        if ($name == '') {
                            $name = full["fullName"];
                        }
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
                    title: "Thao tác",
                    visible: visible,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<div d-flex justify-content-start style="width::150px;text-align:left">';
                        if (funEdit == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                            html += '<i class="fas fa-pencil-alt"></i>';
                            html += '</button> &nbsp;';
                        }
                        if (funDel == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="del(' + full['id'] + ')">';
                            html += '<i class="fas fa-trash-alt"></i>';
                            html += '</button>';
                        }
                        html += '</div>'
                        return html;
                    },
                    width: "15%"
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
                sInfoEmpty: "Hiển thị 0 đến 0 của 0 bản ghi",
            },
            "oLanguage": {
                "sZeroRecords": "Không có bản ghi nào"
            },
            // Buttons with Dropdown
            buttons: buttons,

        });

    }
    function actionMenu() {
        var validator = $("#dg").validate(); // reset form
        validator.resetForm();
        $(".error").removeClass("error"); // loại bỏ validate
        $('#fullName-error').css('display', 'none');
        $('#phoneNumber-error').css('display', 'none');
        $('#status-error').css('display', 'none');
        $("#addinfo").modal('show');
        $(".modal-title").html('Thêm khách hàng mới');
        $('#fullName').val('');
        $('#phoneNumber').val('');
        $('#email').val('');
        $('#shortName_add').val('');
        $('#website').val('');
        $('#staffId').val('').change();
        $('#nationalId').val(1);
        $('#provinceId').val('').change();
        $('#status').select2({
            placeholder: 'Trạng thái',
            dropdownParent: $('#status').parent(),
        });
        $('#status').val('').change();
    }

    // lọc tỉnh
    $('#provinceId2').change(function () {
        if ($(this).val() == 0) {
            table.column($(this).data('column'))
                .search('')
                .draw()
        }
        else {
            table.column($(this).data('column'))
                .search($(this).val())
                .draw()
        }
    })
    table.column(5)
    .search($('#classify3').val())
    .draw()
    // lọc phân loại
    $('#classify3').change(function () {
        if ($(this).val() == 0) {
            table.column($(this).data('column'))
                .search('')
                .draw()
        }
        else {
            table.column($(this).data('column'))
                .search($(this).val())
                .draw()
        }
    })

    // lọc loại hình hoạt động
    $('#type2').change(function () {

        if ($(this).val() == 0) {
            table.column($(this).data('column'))
                .search('')
                .draw()
        }
        else {
            table.column($(this).data('column'))
                .search($(this).val())
                .draw()
        }
    })
    // 

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
                "phoneNumber": {
                    required: true,
                    number: true,
                    min: 0,
                    minlength:10,
                    maxlength:10
                },
                "email": {
                    // required: true,
                    email: true
                },
                // "website": {
                //     required: true,
                // },
                "status": {
                    required: true,
                },

            },
            messages: {
                "fullName": {
                    required: "Bạn chưa nhập tên!",
                },
                "phoneNumber": {
                    required: "Bạn chưa nhập số điện thoại!",
                    number: "Yêu cầu nhập số điện thoại!",
                    min: "Yều cầu nhập bắt đầu từ 0!",
                    minlength:"Yêu cầu nhập số điện thoại 10 số!",
                    maxlength:"Yêu cầu nhập số điện thoại 10 số!"
                },
                "email": {
                    // required: "Bạn chưa nhập địa chỉ email!",
                    email: "Yêu cầu nhập đúng định dạng email!",
                },
                // "website": {
                //     required: "Bạn chưa nhập địa chỉ website của bạn",
                // },
                "status": {
                    required: "Bạn chưa cập nhật trạng thái!",
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
                "type1": {
                    required: true,
                },
                "taxCode1": {
                    number: true,
                },
                "phoneNumber1": {
                    required: true,
                    number: true,
                    min: 0,
                    minlength:10,
                    maxlength:10
                },
                "status1": {
                    required: true,
                },
            },
            messages: {
                // "shortName": {
                //     required: "Bạn chưa nhập tên ngắn!",
                // },
                "fullName1": {
                    required: "Bạn chưa nhập tên!",
                },
                "phoneNumber1": {
                    required: "Bạn chưa nhập số điện thoại!",
                    number: "Yêu cầu nhập số điện thoại!",
                    min: "Yều cầu nhập bắt đầu từ 0!",
                    minlength:"Yêu cầu nhập số điện thoại 10 số!",
                    maxlength:"Yêu cầu nhập số điện thoại 10 số!"
                },
                
                "taxCode1": {
                    number: "Yêu cầu nhập số!",
                },

                "status1": {
                    required: "Bạn chưa cập nhật trạng thái!",
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
    if ($('#dgContact').length) {
        $('#dgContact').validate({
            errorClass: "error",
            rules: {
                "phoneNumberContact": {
                    required: true,
                    number: true,
                    min: 0,
                    minlength:10,
                    maxlength:10
                },
                "nameContact": {
                    required: true,
                },
                "emailContact": {
                    email: true,
                },
                // "facebook": {
                //     required: true,
                // },
            },
            messages: {

                "phoneNumberContact": {
                    required: "Bạn chưa nhập số điện thoại!",
                    number: "Yêu cầu nhập số điện thoại!",
                    min: "Yều cầu nhập bắt đầu từ 0!",
                    minlength:"Yêu cầu nhập số điện thoại 10 số!",
                    maxlength:"Yêu cầu nhập số điện thoại 10 số!"
                },
                "nameContact": {
                    required: "Yêu cầu nhập tên liên lạc",
                },
                "emailContact": {
                    email: "Yêu cầu nhập địa chỉ email liên lạc",
                },
                // "facebook": {
                //     required: "Yêu cầu nhập địa chỉ facebook",
                // },

            },
        });

        $('#dgContact').on("submit", function (e) {
            var isValid = $('#dgContact').valid();
            e.preventDefault();
            if (isValid) {
                saveContact();
            }
        });
    }
    if ($('#dgTransaction').length) {
        $('#dgTransaction').validate({
            errorClass: "error",
            rules: {
                "nameTransaction": {
                    required: true,
                },
                "customerId": {
                    required: true,
                },
                "asset": {
                    required: true,
                },
                "dateTime": {
                    required: true,
                },
                "performedId": {
                    required: true,
                },
               
            },
            messages: {

                "nameTransaction": {
                    required: "Bạn chưa nhập tên hợp đồng",
                },
                "customerId": {
                    required: "Bạn chưa chọn khách hàng",
                },
                "asset": {
                    required: "Bạn chưa nhập tiền giao dịch",
                },
                "dateTime": {
                    required: "Bạn chưa nhập thời gian giao dịch",
                },
                "performedId": {
                    required: "Bạn chưa chọn nhân viên thực hiện",
                },
                "type": {
                    required: "Bạn chưa chọn loại giao dịch",
                },
            },
        });

        $('#dgTransaction').on("submit", function (e) {
            var isValid = $('#dgTransaction').valid();
            e.preventDefault();
            if (isValid) {
                saveTransaction();
            }
        });
    }
    // To initialize tooltip with body container
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
        container: "body",
    });
});

var urlContact = '';
var urlTransaction = '';
function showFormContact() {
    return_combobox_multi('#positionContact', baseHome + '/used_customer/getPosition', 'Chức danh');
    var validator = $("#dgContact").validate(); // reset form
    validator.resetForm();
    $(".error").removeClass("error"); // loại bỏ validate
    // $('#dgContact')[0].reset();
    $('#updateinfoContact').modal('show');
    $('.modal-title-contact').html('Thêm liên lạc cho khách hàng');
    urlContact = baseHome + "/contact/add";
}

function saveContact() {

    var info = {};
    info.name = $("#nameContact").val();
    info.customerId = $("#idCustomerContact").val();
    info.phoneNumber = $("#phoneNumberContact").val();
    info.email = $("#emailContact").val();
    info.facebook = $("#facebook").val();
    info.zalo = $("#zalo").val();
    info.note = $("#noteContact").val();
    info.position = $('#positionContact').val();

    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: urlContact,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#updateinfoContact').modal('hide');
                $("#dichvu-list-table").DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
        error: function () {
            notify_error('Cập nhật không thành công');
        }
    });
}

function loaddata(id) {
    if (funEdit != 1) {
        $('.btn-update-customer').css('display', 'none');
    }
    khid = id;
    var validator = $("#dg1").validate(); // reset form
        validator.resetForm();
        $(".error").removeClass("error"); // loại bỏ validate
      
    $("#updateinfo").modal('show');
    $('#information-tab').click();
    $(".modal-title").html('Cập nhật thông tin khách hàng');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/used_customer/loaddata",
        success: function (data) {
            $('#fullName1').val(data.fullName);
            $('#taxCode1').val(data.taxCode);
            $('#address1').val(data.address);
            $('#phoneNumber1').val(data.phoneNumber);
            $('#email1').val(data.email);
            $('#website1').val(data.website);
            $('#staffId1').val(data.staffId).change();
            $('#shortName').val(data.name);
            $('#field1').val(data.field);
            $('#rank1').val(data.rank).change();
            // $('#bussinessName1').val(data.businessName);
            $('#businessAddress1').val(data.businessAddress);
            $('#businessPlace1').val(data.businessPlace);
            $('#representative1').val(data.representative);
            $('#authorized1').val(data.authorized);
            $('#note1').val(data.note);
            $('#classify1').val(data.classify).change();
            $('#type1').val(data.type).change();
            // $('#nationalId1').val(data.nationalId).change();
            $('#position1').val(data.position).change();
            // $('#type1').val(data.type).change();
            $('#status1').val(data.status).change().attr('disabled', false);
            $('#idCustomerContact').val(id);
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
            ajax: baseHome + "/used_customer/loadContact?id=" + id,
            destroy: true,

            columns: [
                // columns according to JSON
                { data: "name" },
                { data: 'positionName' },
                { data: "phoneNumber" },
                { data: "email" },
                { data: "facebook" },
            ],
            columnDefs: [

            ],

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
        buttons: [],

        });
    }
}

//load transaction
function loadTransaction(id) {

    if (transactionTable.length) {

        transactionTable.DataTable({
            ajax: baseHome + "/used_customer/loadTransaction?id=" + id,
            destroy: true,

            columns: [
                // columns according to JSON
                { data: "date" },
                { data: "name" },
                { data: "productName"},
                { data: "type"},
                { data: "asset" },
                { data: "description" },
            ],
            columnDefs: [
                {
                    // Actions
                    targets: 3,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        if (full['type'] == 1) {
                            html = `<div class="badge badge-pill badge-light-info">Đơn hàng</div>`;
                        }
                        else if (full['type'] == 2) {
                            html = `<div class="badge badge-pill badge-light-primary">Hợp đồng</div>`;
                        }
                        else if (full['type'] == 3) {
                            html = `<div class="badge badge-pill badge-light-success">Thanh toán</div>`;
                        }
                        return html;
                    },
                    width: 150
                },
                {
                    // Actions
                    targets: 4,
                    orderable: true,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html = formatCurrency(full['asset'].replace(/[,VNĐ]/g,''));
                        return html;
                    },

                },
                {
                    // Actions
                    targets: -1,
                    title: 'Thao tác',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                            html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddataTransaction(' + full['id'] + ')">';
                            html += '<i class="fas fa-pencil-alt"></i>';
                            html += '</button> &nbsp;';
                            html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="delTransaction(' + full['id'] + ')">';
                            html += '<i class="fas fa-trash-alt"></i>';
                            html += '</button>';
                        return html;
                    },
                    width: 100
                },
            ],

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
        buttons: [],

           
        });
    }
}



function saveadd() {
    var info = {};
    info.fullName = $("#fullName").val();
    info.phoneNumber = $("#phoneNumber").val();
    info.email = $("#email").val();
    info.website = $("#website").val();
    info.staffId = $("#staffId").val();
    info.nationalId = $("#nationalId").val();
    info.provinceId = $("#provinceId").val();
    info.shortName = $("#shortName_add").val();
    info.classify = $("#classify_add").val();
    info.type = $("#type").val();
    info.status = $("#status").val();

    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: baseHome + "/used_customer/add",
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
    info.shortName = $('#shortName').val();
    info.phoneNumber = $("#phoneNumber1").val();
    info.email = $("#email1").val();
    info.website = $("#website1").val();
    info.staffId = $("#staffId1").val();
    // info.office = $("#office1").val();
    info.field = $("#field1").val();
    info.fieldDetail = $("#fieldDetail1").val();
    info.rank = $("#rank1").val();
    // info.bussinessName = $("#bussinessName1").val();
    info.businessAddress = $("#businessAddress1").val();
    info.businessPlace = $("#businessPlace1").val();
    info.representative = $("#representative1").val();
    info.authorized = $("#authorized1").val();
    info.note = $("#note1").val();
    info.classify = $("#classify1").val();
    info.type = $("#type1").val();
    // info.nationalId = $("#nationalId1").val();
    info.position = $("#position1").val();
    info.provinceId = $("#provinceId1").val();
    info.status = $("#status1").val();
  
    // console.log(khid);
    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: baseHome + '/used_customer/update?id=' + khid,
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
        cancelButtonText: 'Hủy',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: baseHome + "/used_customer/del",
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
        url: baseHome + "/used_customer/importExcel",
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
function showFormTransaction() {
    return_combobox_multi('#productId', baseHome + '/used_customer/getProduct', 'Sản phẩm');
    return_combobox_multi('#performedId', baseHome + '/used_customer/getStaff', 'Nhân viên thực hiện');
    $('#dgTransaction')[0].reset();
    var validator = $("#dgTransaction").validate(); // reset form
        validator.resetForm();
        $(".error").removeClass("error"); // loại bỏ validate
    $('#modalTransaction').modal('show');
    $('.modal-title-transaction').html('Thêm lịch sử giao dịch');
    $("#dateTime").flatpickr({
        enableTime: true,
        defaultDate: "today",
        dateFormat: "d-m-Y H:i",
        // allowInput:true,
        // monthSelectorType:"dropdown",
        // yearSelectorType:"dropdown",
    });
    urlTransaction = baseHome + "/used_customer/saveTransaction";
}
function saveTransaction() {
    var info = {};
    info.name = $("#nameTransaction").val();
    info.productId = $("#productId").val();
    info.customerId = $("#idCustomerContact").val();
    info.asset = $("#asset").val();
    info.dateTime = $("#dateTime").val();
    info.performedId = $("#performedId").val();
    info.type = $("#typeTransaction").val();
    info.description = $("#description").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url:urlTransaction,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#modalTransaction').modal('hide');
                $("#transaction-list-table").DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
        error: function () {
            notify_error('Cập nhật không thành công');
        }
    });
}
function loaddataTransaction(id) {
    return_combobox_multi('#productId', baseHome + '/used_customer/getProduct', 'Sản phẩm');
    return_combobox_multi('#performedId', baseHome + '/used_customer/getStaff', 'Nhân viên thực hiện');
 
    var validator = $("#dgTransaction").validate(); // reset form
    validator.resetForm();
    $(".error").removeClass("error"); // loại bỏ validate
    $('#modalTransaction').modal('show');
    $('.modal-title-transaction').html('Cập nhật lịch sử giao dịch');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/used_customer/loaddataTransaction",
        success: function (data) {
            // Default
            $('#nameTransaction').val(data.name);
            $('#asset').val(formatCurrency(data.asset.replace(/[,VNĐ]/g,'')));
            $('#productId').val(data.productId).trigger("change");
            $('#performedId').val(data.performerId).trigger("change");
            $('#typeTransaction').val(data.type).trigger("change");
            $('#description').val(data.description);
            $("#dateTime").flatpickr({
                enableTime: true,
                defaultDate: $('#dateTime').val(data.date),
                dateFormat: "d-m-Y H:i",
            });
            urlTransaction = baseHome + '/used_customer/saveTransaction?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}
function delTransaction(id) {
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
                url: baseHome + "/used_customer/delTransaction",
                type: 'post',
                dataType: "json",
                data: { id: id },
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.msg);
                        $("#transaction-list-table").DataTable().ajax.reload(null, false);
                    }
                    else
                        notify_error(data.msg);
                },
            });
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
            var html = '';
            if (place != '')
                html = '<option value="0" >Tất cả</option>';
            data.forEach(function (element, index) {
                if (element.selected == true)
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
$(document).on('blur', '.phoneNumber', function () {
    var id = $(this).data('id');
    var phone = $(this).val();
    var idCustomer = khid;
    if (id == 'phoneNumber') {
        idCustomer = 0;
    }

    if (phone != '' && phone.toString().length >= 10) {
        $.ajax({
            type: "POST",
            dataType: "json",
            data: { phone: phone, idCustomer: idCustomer },
            url: baseHome + "/used_customer/checkPhone",
            success: function (data) {
                if (data.success) {
                    notyfi_success(data.msg);
                    if (id == 'phoneNumber') {
                        $('.btn-add-customer').prop('disabled', false);
                    }
                    else {
                        $('.btn-update-customer').prop('disabled', false);
                    }
                }
                else {
                    if (id == 'phoneNumber') {
                        $('.btn-add-customer').prop('disabled', true);
                    }
                    else {
                        $('.btn-update-customer').prop('disabled', true);
                    }
                    notify_error(data.msg);
                }
            },
            error: function () {
                notify_error('Số điện thoại đã tồn tại');
            }
        });
    }
})

function changeType() {
    type = $('#type1').val();
    if (type == 1) {
        $('#div-businessPlace').addClass('d-none');
        $('#div-businessAddress').addClass('d-none');
        $('#div-authorized').addClass('d-none');
        $('#div-position').addClass('d-none');
    } else if (type == 2) {
        $('#div-businessPlace').removeClass('d-none');
        $('#div-businessAddress').removeClass('d-none');
        $('#div-authorized').removeClass('d-none');
        $('#div-position').removeClass('d-none');
        $('#div-address').addClass('d-none');

    }
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