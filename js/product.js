
$(function () {
    return_combobox_multi('#customerId', baseHome + '/transaction/getCustomer', 'Lựa chọn khách hàng');
    return_combobox_multi('#performerId', baseHome + '/transaction/getStaff', 'Nhân viên thực hiện');
    
    var basicPickr = $('.flatpickr-basic');
    $('#type').select2({
        placeholder: 'Loại hợp đồng',
        dropdownParent: $('#type').parent(),
    });
    // Default
    if (basicPickr.length) {
        basicPickr.flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
    }
    if ($("#task-desc").length) {
        var todoDescEditor = new Quill("#task-desc", {
            bounds: "#task-desc",
            modules: {
                formula: true,
                syntax: true,
                toolbar: ".desc-toolbar",
            },
            placeholder: "Mô tả dự án",
            theme: "snow",
        });
    }
    "use strict";
    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");
        quill_editor = $("#task-desc .ql-editor p");
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
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/product/list",
            ordering: false,
            columns: [
                // columns according to JSON
                { data: "name" },
                { data: "supplier" },
                { data: "vat" },
                { data: "price" },
                { data: "" },
            ],
            columnDefs: [
                { 
                    targets:0,
                    render: function(data,type,full,meta) {
                        var $row_output =
                       
                        '<div class="d-flex flex-column">' +
                        '<a href="javascript:void(0)" onclick="loaddata('+full["id"]+');" data-toggle="modal" data-target="#updateinfo" class="user_name text-truncate"><span class="font-weight-bold">' +
                        full['name'] +
                        "</span></a>" +
                       
                        "</div>";
                        return $row_output;
                    }
                },
                {
                    // Actions
                    targets: 2,
                    orderable: true,
                    render: function (data, type, full, meta) {
                        var html = full['vat']+'%';
                       return html;
                    },
                 
                },
                {
                    // Actions
                    targets: 3,
                    orderable: true,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(full['price']);
                        return html;
                    },
                 
                },
                {
                    // Actions
                    targets: -1,
                    title: "Thao tác",
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        if(funEdit == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                            html += '<i class="fas fa-pencil-alt"></i>';
                            html += '</button> &nbsp;';
                        }
                        

                        if(funDel == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="del(' + full['id'] + ')">';
                            html += '<i class="fas fa-trash-alt"></i>';
                            html += '</button>';
                        }
                        return html;
                    },
                    width: 100
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
                    info:"Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
                },
            // Buttons with Dropdown
            buttons: buttons,
            
            initComplete: function () {
               

            },
        });

    }


    function showAdd() {
        $('#dg')[0].reset();
        $('#btn_product').css('display','inline-block');                
        $("#updateinfo").modal('show');
        $('#btn_product').html('Thêm');
        $('.modal-title').html('Thêm sản phẩm mới');
        url = baseHome + "/product/add";
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
                "name": {
                    required: true,
                },
                "type": {
                    required: true,
                },
                "supplier": {
                    required: true,
                },
                "unit": {
                    required: true,
                },
                "vat": {
                    required: true,
                    number:true,
                    min:1,
                    max:100
                },
                "price": {
                    required: true,
                },
            },
            messages: {
                "name": {
                    required: "Bạn chưa nhập tên dịch vụ",
                },
                "type": {
                    required: "Bạn chưa nhập loại sản phẩm",
                },
                "supplier": {
                    required: "Bạn chưa nhập tên nhà cung cấp",
                },
                "unit": {
                    required: "Bạn chưa nhập đơn vị tính",
                },
                "vat": {
                    required: "Bạn chưa nhập thuế",
                    number:"Yêu cầu nhập số",
                    min:"Giá trị tối thiểu 1",
                    max:"Giá trị tối đa 100"
                },
                "price": {
                    required: "Bạn chưa nhập giá thành",
                   
                },
            },
        });

        $('#dg').on("submit", function (e) {
            e.preventDefault();
            var isValid = form.valid();
            if (isValid) {
                savekh();
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
        $('#btn_product').css('display','none');
    }
    else {
        $('#btn_product').css('display','inline-block');
        $('#btn_product').html("Cập nhật");
    }
    $('#updateinfo').modal('show');
    $(".modal-title").html('Cập nhật sản phẩm');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/product/loaddata",
        success: function (data) {
            $('#name').val(data.name);
            $('#supplier').val(data.supplier);
            $('#unit').val(data.unit);
            $('#type').val(data.type);
            $('#price').val(formatCurrency(data.price.replace(/[,VNĐ]/g,'')));
            $('#vat').val(data.vat)
            url = baseHome + '/product/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function savekh() {
    var myform = new FormData($("#dg")[0]);
    $.ajax({
        type: "POST",
        dataType: "json",
        data: myform,
        url: url,
        contentType: false,
        processData: false,
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
                url: baseHome + "/product/del",
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