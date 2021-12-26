var url = '';
$(function () {


    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");
        statusObj = {
            0: { title: "Xoá", class: "badge-light-warning" },
            1: { title: "Hoạt động", class: "badge-light-success" },
            2: { title: "Tạm ngưng", class: "badge-light-warning" },
        };

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/bhxhlichsu/list",
            columns: [
                // columns according to JSON
                // { data: "" },
                { data: "ngay_gio" },
                { data: "nhan_vien" },
                { data: "ma_bhxh" },
                { data: "muc_dong" },
                { data: "nld_dong" },
                { data: "cty_dong" },
                { data: "so_tien" },
                { data: ".." },
            ],
            columnDefs: [
                {
                   
                },
                {
                    // User full name and username
                    targets: 1,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full["nhan_vien"];
                            
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="d-flex flex-column">' +
                            '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ')" data-toggle="modal" data-target="#updateinfo" class="user_name text-truncate"><span class="font-weight-bold">' +
                            $name +
                            "</span></a>" +
                            
                            "</div>" +
                            "</div>";
                        return $row_output;
                    },
                },
                

                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" data-toggle="modal" data-target="#updateinfo" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="xoa(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
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
                        $(".modal-title").html('Đóng BHXH');
                        $("#btn_add").attr("disabled", true);
                        $('#nhan_vien').val(0);
                        $('#nhan_vien').trigger("change");
                        $('#muc_dong').val('0');
                        $('#so_tien').val('0');
                        $('#ghi_chu').val('');
                        $('#tinh_trang').val('1');
                        var dateObj = new Date();
                        var thang = dateObj.getMonth();
                        thang = thang > 9 ? thang : '0' + thang;
                        var ngay = dateObj.getDate();
                        ngay = ngay > 9 ? ngay : '0' + ngay;
                        var dateToUse = dateObj.getFullYear() + "-" + thang + "-" + ngay;
                        $('#ngay_gio').val(dateToUse);

                        url = baseHome + "/bhxhlichsu/add";
                    },
                },
                {
                    text: "Tất cả NV",
                    className: "add-new btn btn-primary mt-50",
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                    },
                    action: function (e, dt, node, config) {
                        $("#dongbhall").modal('show');
                        $(".modal-title").html('Đóng BHXH tất cả nhân viên');
                        var dateObj = new Date();
                        var thang = dateObj.getMonth();
                        thang = thang > 9 ? thang : '0' + thang;
                        var ngay = dateObj.getDate();
                        ngay = ngay > 9 ? ngay : '0' + ngay;
                        var dateToUse = dateObj.getFullYear() + "-" + thang + "-" + ngay;
                        $('#ngay_gio_all').val(dateToUse);

                        url = baseHome + "/bhxhlichsu/addAll";
                    },
                },
            ],
 
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
                    .columns(0)
                    .every(function () {
                        var column = this;
                        var select = $('<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Thời gian </option></select>')
                            .appendTo(".fillter_ngaygio")
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

                this.api()
                    .columns(1)
                    .every(function () {
                        var column = this;
                        var select = $('<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Nhân viên </option></select>')
                            .appendTo(".fillter_nhanvien")
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

    
    var nhan_vien = $('#nhan_vien');
    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/bhxhlichsu/nhanvien",
        success: function (data) {
            nhan_vien.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: nhan_vien.parent(),
            width: '100%',
            data: data
            });
        },
    });





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
    $(".modal-title").html('Cập nhật thông tin BHXH');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/bhxhlichsu/loaddata",
        success: function (data) {
            $("#id").val(data.id);
            $("#nhan_vien").val(data.bhxh)
            $("#nhan_vien").val(data.bhxh).trigger('change');
            $("#muc_dong").val(data.muc_dong);
            $("#ngay_gio").val(data.ngay_gio);
            $("#ghi_chu").val(data.ghi_chu);
           
            url = baseHome + '/bhxhlichsu/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}





function savetk() {
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


function saveall() {
    var myform = new FormData($("#dg_all")[0]);
    Swal.fire({
        title: 'Xác nhận',
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
                type: "POST",
                dataType: "json",
                data: myform,
                url: url,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.msg);
                        $('#dongbhall').modal('hide');
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
    });
}

function xoa(id) {
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
                url: baseHome + "/bhxhlichsu/del",
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


function checkform(){
    var nhanvien = $('#nhan_vien').val();
    if(nhanvien > 0){
        $("#btn_add").attr("disabled", false);
        
        $.ajax({
            url: baseHome + "/bhxhlichsu/bhxh",
            type: 'post',
            dataType: "json",
            data: { id: nhanvien },
            success: function (data) {
                if (data.success) {
                    $("#muc_dong").val(formatCurrency(data.muc_dong.replace(/[,VNĐ]/g,'')));
                    var mucdong = data.muc_dong,
                    nld_dong = data.nld_dong,
                    so_tien = nld_dong * mucdong /100;
                    var tiencon_fm =  Math.ceil(so_tien);
                    $("#so_tien").val(formatCurrency((tiencon_fm + '').replace(/[,VNĐ]/g,'')));
                }
                else
                    notify_error(data.msg);
            },
        });

    }else{
        $('#muc_dong').val('0');
        $("#btn_add").attr("disabled", true);
    }
}

