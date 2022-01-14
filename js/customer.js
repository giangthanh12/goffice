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
    // return_combobox_multi('#provinceId2', baseHome + '/customer/getProvince', 'Chọn tỉnh thành');
    load_select2($('#provinceId2'), baseHome + '/customer/getProvince','Chọn tỉnh thành');
    $('#provinceId2').val('').change();
    $('#classify').select2({
        placeholder: 'Phân loại khách hàng',
        dropdownParent: $('#classify').parent(),
    });
    $('#type').select2({
        placeholder: 'Loại hình hoạt động',
        dropdownParent: $('#type').parent(),
    });
    $("#classify3").select2({
        placeholder: 'Phân loại khách hàng',
        dropdownParent: $("#classify3").parent(),
    });
    $("#classify3").val('').change();
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
            // autoWidth: true,
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
                    width:200
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
                        $('#phoneNumber').val('');
                        $('#email').val('');
                        $('#website').val('');
                        $('#staffId').val('').change();
                        $('#nationalId').val(1);
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

        });

    }

    // lọc tỉnh

    $('#provinceId2').change(function() {
             if($(this).val() == 0) {
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
   // lọc phân loại
    $('#classify3').change(function() {
        if($(this).val() == 0) {
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
    $('#type2').change(function() {
      
        if($(this).val() == 0) {
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
                },
                "email": {
                    required: true,
                },
                "website": {
                    required: true,
                },
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
                "phoneNumber1": {
                    required: true,
                },
                "email1": {
                    required: true,
                },
                "website1": {
                    required: true,
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
            $('#shortName').val(data.shortName);
            $('#field1').val(data.field);
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
    info.phoneNumber = $("#phoneNumber").val();
    info.email = $("#email").val();
    info.website = $("#website").val();
    info.staffId = $("#staffId").val();
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

function load_select2(select2, url, place) {
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: url,
        success: function (data) {
           var html ='';
            if(place != '')
            html = '<option value="0" >Tất cả</option>';
            data.forEach(function (element, index) {
                if (element.selected==true) 
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
