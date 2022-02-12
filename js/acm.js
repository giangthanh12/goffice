$(function () {
    return_combobox_multi('#authorized',baseHome + "/acm/nhanvien", 'Nhân viên');
    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        customer = $("#customer"),
        staff = $("#staff"),
        addNewBtn = $(".add-new button"),
        authorized = $("#authorized"),
        account = $("#account"),
        datePicker = $("#dateTime"),
        form = $("#dg");

    typeObj = {
        0: {title: ""},
        1: {title: "Doanh thu"},
        2: {title: "Chi phí"},
        3: {title: "Nội bộ"},
    };

    actionObj = {
        0: {title: "", class: ""},
        1: {title: "Thu", class: "badge-light-success"},
        2: {title: "Chi", class: "badge-light-warning"},
        3: {title: "Khác", class: ""}
    };

    var buttons = [];
    if(funAdd == 1) {
        buttons.push({
            text: "Thêm thu",
            className: "add-new btn btn-primary mt-50",
            init: function (api, node, config) {
                $(node).removeClass("btn-secondary");
            },
            action: function (e, dt, node, config) {
             actionMenuCollect();
            },
        },
        {
            text: "Thêm chi",
            className: "add-new btn btn-primary mt-50",
            init: function (api, node, config) {
                $(node).removeClass("btn-secondary");
            },
            action: function (e, dt, node, config) {
             actionMenuPay();
            },
        });
    }
   
    // datepicker init
    if (datePicker.length) {
        datePicker.flatpickr({
            enableTime: false,
            dateFormat: "d-m-Y",
        });
    }

    $.ajax({
        // tải Khách hàng vào select1 customer
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/acm/khachhang",
        success: function (data) {
            customer.wrap('<div class="position-relative"></div>').select2({
                dropdownAutoWidth: true,
                dropdownParent: customer.parent(),
                width: "100%",
                data: data,
            });
        },
    });

  

    $.ajax({
        // tải Khách hàng vào select1 account
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/acm/taikhoan",
        success: function (data) {
            account.wrap('<div class="position-relative"></div>').select2({
                placeholder: 'Chọn tài khoản',
                dropdownAutoWidth: true,
                dropdownParent: account.parent(),
                width: "100%",
                data: data,
            });
        },
    });

    $.ajax({
        // tải Nhân viên vào select1 staff
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/acm/nhanvien",
        success: function (data) {
            staff.wrap('<div class="position-relative"></div>').select2({
                placeholder:'Nhân viên',
                dropdownAutoWidth: true,
                dropdownParent: staff.parent(),
                width: "100%",
                data: data,
            });
        },
    });

    $.ajax({
        // tải Nhân viên vào select1 staff
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/acm/hopdong",
        success: function (data) {
            contract.wrap('<div class="position-relative"></div>').select2({
                dropdownAutoWidth: true,
                dropdownParent: contract.parent(),
                width: "100%",
                data: data,
            });
        },
    });
    $.ajax({
        // tải Nhân viên vào select1 staff
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/acm/getClassify",
        success: function (data) {
            $('#classify').wrap('<div class="position-relative"></div>').select2({
                placeholder: "Phân loại",
                dropdownAutoWidth: true,
                dropdownParent: $('#classify').parent(),
                width: "100%",
                data: data,
            });
        },
    });

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/acm/list",
            ordering: false,
            // drawCallback: function () {
            //     var api = this.api();
             
            //     var  total = api
            //     .column( 3 )
            //     .data()
            //     .reduce( function (a, b) {
            //         return Number(a)   + Number(b);
            //     }, 0 );
                
            //     $('.taikhoan_sodu1').html(
            //         '<b>SDTK:'+Comma(total)+' đ</b>'
            //     );
            //     $('#sodutaikhoan').val(total);
            //   },
            columns: [
                // columns according to JSON
                // { data: "" },
                {data: "dateTimeNew"},
                {data: "accName"},
                {data: "content"},
                {data: "asset"},
                {data: "action"},
                {data: "type"},
                {data: "asset"},
           
                {data: ""},
            ],
            columnDefs: [
                {
                    // classify Status
                    targets: 6,
                    visible: false,
                },
                {
                    // User full name and username
                    targets: 5,
                    render: function (data, type, full, meta) {
                        var $type = full["type"];
                        // console.log(typeObj);
                        return (
                            '<span text-capitalized>' +
                            typeObj[$type].title +
                            '</span>'
                        );
                    },
                },
              
                {
                    // classify Status
                    targets: 4,
                    render: function (data, type, full, meta) {
                        var $action = full["action"];
                        return (
                            '<span class="badge badge-pill ' +
                            actionObj[$action].class +
                            '" text-capitalized>' +
                            actionObj[$action].title +
                            "</span>"
                        );
                    },
                },
                {
                    // classify Status
                    targets:3,
                    render: function (data, type, full, meta) {
                     
                        return Comma(full['asset'])
                    },
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({
                        class: "font-medium-3 text-success mr-50",
                    }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = "";
                        html +='<div style="width: 80px;">';
                        if(funEdit == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" data-toggle="modal" data-target="#updateinfo" title="Chỉnh sửa" onclick="loaddata(' +
                            full["id"] +
                            ')">';
                            html += '<i class="fas fa-pencil-alt"></i>';
                            html += "</button> &nbsp;";
                        }
                        if(funDel == 1) {
                            html +=
                            '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="xoa(' +
                            full["id"] +
                            ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += "</button>";
                        }
                       

                        
                        html += '</div>';
                        return html;
                    },
                },
            ],
            // order: [[6, "desc"]],
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
                // Adding plan filter once table initialized
                this.api()
                    .columns(1)
                    .every(function () {
                        var column = this;
                        var select = $(
                            '<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Tài khoản </option></select>'
                        )
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
                                select.append(
                                    '<option value="' +
                                    d +
                                    '" class="text-capitalize">' +
                                    d +
                                    "</option>"
                                );
                            });
                    });
            },
        });
    }

   function actionMenuPay() {
    var validator = $("#dg").validate(); // reset form
    validator.resetForm();
    $(".error").removeClass("error"); // loại bỏ validate
    $("#updateinfo").modal("show");
    $(".modal-title").html("Thêm chi mới");
    // $("#btn_add").attr("disabled", true);
    $("#dg").trigger("reset");
    // url = baseHome + "/acm/add";
    $('#account').val('').change();
    $('#classify').val('').change();
    $('#authorized').val('').change();
    
    $('#id').val('');
    $('#action').val(2);
    $('#type').html(`<option value="2">Chi phí</option>
    `);
   }

   function actionMenuCollect() {
       
    var validator = $("#dg").validate(); // reset form
    validator.resetForm();
    $(".error").removeClass("error"); // loại bỏ validate
    $("#updateinfo").modal("show");
    $(".modal-title").html("Thêm thu mới");
    // $("#btn_add").attr("disabled", true);
    $("#dg").trigger("reset");
    // url = baseHome + "/acm/add";
    $('#account').val('').change();
    $('#classify').val('').change();
    $('#id').val('');
    $('#action').val(1);
    $('#type').html('');
    $('#authorized').val('').change();
    $('#type').html(`<option value="1">Doanh thu</option>
    <option value="3">Nội bộ</option>`);
   }
    // // Form Validation
    if (addNewBtn.length) {
        addNewBtn.on("click", function (e) {

        });
    }
    if (form.length) {
        form.validate({
            ignore: ".ql-container *", // ? ignoring quill editor icon click, that was creating console error
            rules: {
                dateTime: {
                    required: true,
                },
                content: {
                    required: true,
                },
                customer: {
                    required: true,
                },
                authorized: {
                    required: true,
                },
                account: {
                    required: true,
                },
                type: {
                    required: true,
                },
                classify: {
                    required: true,
                },
                asset: {
                    required: true,
                },
            },
            messages: {
                dateTime: {
                    required: "Bạn chưa chọn ngày thực hiện",
                },
                content: {
                    required: "Bạn chưa nhập thông tin",
                },
                customer: {
                    required: "Bạn chưa chọn khách hàng",
                },
                authorized: {
                    required: "Bạn chưa chọn nhân viên",
                },
                account: {
                    required: "Bạn chưa chọn tài khoản giao dịch",
                },
                type: {
                    required: "Bạn chưa chọn loại giao dịch",
                },
                classify: {
                    required: "Bạn chưa chọn hình thức hạch toán",
                },
                asset: {
                    required: "Bạn chưa nhập số tiền giao dịch",
                },
            },
        });

        form.on("submit", function (e) {
            var isValid = form.valid();
            e.preventDefault();
            if (isValid) {
                var id = $("#id").val();
                var dateTime = $("#dateTime").val();
                var content = $("#content").val();
                var customer = $("#customer").val();
                var account = $("#account").val();
                var classify = $("#classify").val();
                var type = $("#type").val();
                var asset = $("#asset").val();
                var authorized = $("#authorized").val();
                var contract = $("#contract").val();
                var note = $("#note").val();
                var action = $('#action').val();
                var status = 1;
               
           
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id,
                        dateTime: dateTime,
                        content: content,
                        customer: customer,
                        account: account,
                        classify: classify,
                        type: type,
                        asset: asset,
                        authorized: authorized,
                        contract: contract,
                        note: note,
                        status: status,
                        action:action
                    },
                    url: baseHome + "/acm/update",
                    success: function (data) {
                        if (data.success == true) {
                            notyfi_success(data.msg);
                            $(".user-list-table").DataTable().ajax.reload(null, false);
                            showAccountBalance();
                            modal.modal("hide");
                        } else {
                            notify_error(data.msg);
                            return false;
                        }
                    },
                });
                // overlay.removeClass("show");
            }
        });
    }

    // To initialize tooltip with body container
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
        container: "body",
    });
});

function showAccountBalance() {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: baseHome + "/acm/totalAccountBalance",
        success: function (data) {
            $('#showAccountBalance').html('');
            var html = '';
           data.forEach(function(item) {
               html+= `<b>Số dư ${item.text}: ${Comma(item.sodu)}</b>`;
           })
           $('#showAccountBalance').html(html);
        },
        error: function () {
            notify_error("Lỗi truy xuất database");
        },
    });
}
showAccountBalance()

function loaddata(id) {
    $(".modal-title").html("Cập nhật thông tin sổ tiền mặt");
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {id: id},
        url: baseHome + "/acm/loaddata",
        success: function (data) {
            if(data.action == 1) {
                $('#type').html('');
                $('#type').html(`<option value="1">Doanh thu</option>
                <option value="3">Nội bộ</option>`);
            }
            else if (data.action == 2) {
                $('#type').html('');
                $('#type').html(`
                <option value="2">Chi Phí</option>`);
            }
            var validator = $("#dg").validate(); // reset form
            validator.resetForm();
            $(".error").removeClass("error"); // loại bỏ validate
            $("#dateTime").val(data.dateTime);
            $("#content").val(data.content);
            $("#customer").val(data.customerId).trigger("change");
            $("#account").val(data.accnumber).trigger("change");
            $('#action').val(data.action);
            $("#classify").val(data.classify).change();
            $("#authorized").val(data.authorized).change();
            $("#type").val(data.type);
            $("#asset").val(formatCurrency(data.asset.replace(/[,VNĐ]/g, "")));
            $("#note").val(data.note);
            $('#id').val(data.id);
            url = baseHome + "/acm/update";
         
        },
        error: function () {
            notify_error("Lỗi truy xuất database");
        },
    });
}


// }

function xoa(id) {
    Swal.fire({
        title: "Xóa bản ghi",
        text: "Bạn có chắc chắn muốn xóa!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Tôi đồng ý",
        cancelButtonText: "Hủy",
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-outline-danger ml-1",
        },
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: baseHome + "/acm/del",
                type: "post",
                dataType: "json",
                data: {id: id},
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.msg);
                        showAccountBalance();
                        $(".user-list-table").DataTable().ajax.reload(null, false);
                    } else notify_error(data.msg);
                },
            });
        }
    });
}


//format_number asset
$("#asset")
    .on("input", function (e) {
        $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g, "")));
    })
    .on("keypress", function (e) {
        if (!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
    })
    .on("paste", function (e) {
        var cb = e.originalEvent.clipboardData || window.clipboardData;
        if (!$.isNumeric(cb.getData("text"))) e.preventDefault();
    });

function formatCurrency(number) {
    var n = number.split("").reverse().join("");
    var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");
    return n2.split("").reverse().join("");
}


