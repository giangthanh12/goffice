var url = '';
$(function () {

    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");
    var   giahan = {
            0: { title: "Không HSD", class: "badge-light-warning" },
            1: { title: "Có HSD", class: "badge-light-success" },
        };

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/dichvu/list",
            columns: [
                // columns according to JSON
                // { data: "" },
                { data: "name" },
                { data: "phan_loai" },
                { data: "don_gia" },
                { data: "thue_vat" },
                { data: "gia_han" },
                { data: ".." },
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
                    targets: 0,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full["name"];
                            
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex  align-items-center">' +
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
                        html += '<div style="width:80px"><button type="button" class="btn btn-icon btn-outline-primary waves-effect" data-toggle="modal" data-target="#updateinfo" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="xoa(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button></div>';
                        return html;
                    },
                },

                {
                    // Actions
                    targets: -2,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var $status = full["gia_han"];
                        return '<span class="badge badge-pill ' + giahan[$status].class + '" text-capitalized>' + giahan[$status].title + "</span>";
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
                        $(".modal-title").html('Thêm dịch vụ mới');
                        $("#btn_add").attr("disabled", true);
                        $('#name').val('');
                        $('#phan_loai').val(0);
                        $('#phan_loai').trigger("change");
                        $('#nhacungcap').val(0);
                        $('#nhacungcap').trigger("change");
                        $('#don_vi_tinh').val(0);
                        $('#don_vi_tinh').trigger("change");
                        $('#don_gia').val('');
                        $('#thue_vat').val('');
                        $('#gia_von').val('');
                        $('#so_luong').val('0');
                        $('#gia_han').val('0');
                        $('#ghi_chu').val('');
                        $('#tinh_trang').val('1');
                        url = baseHome + "/dichvu/add";
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
                    .columns(1)
                    .every(function () {
                        var column = this;
                        var select = $('<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Phân loại </option></select>')
                            .appendTo(".fillter_phanloai")
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

    var phan_loai = $('#phan_loai');
    var nhacungcap = $('#nhacungcap');
    var don_vi_tinh = $('#don_vi_tinh');

    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/dichvu/phanloai",
        success: function (data) {
            phan_loai.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: phan_loai.parent(),
            width: '100%',
            data: data
            });
        },
    });
    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/dichvu/nhacungcap",
        success: function (data) {
            nhacungcap.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: nhacungcap.parent(),
            width: '100%',
            data: data
            });
        },
    });
    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/dichvu/don_vi_tinh",
        success: function (data) {
            don_vi_tinh.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: don_vi_tinh.parent(),
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
        url: baseHome + "/dichvu/loaddata",
        success: function (data) {
            $("#id").val(data.id);
            $("#name").val(data.name);
            $("#phan_loai").val(data.phan_loai).trigger('change');
            $("#nhacungcap").val(data.nhacungcap).trigger('change');
            $("#don_vi_tinh").val(data.don_vi_tinh).trigger('change');
            $("#gia_von").val(formatCurrency(data.gia_von.replace(/[,VNĐ]/g,'')));
            $("#don_gia").val(formatCurrency(data.don_gia.replace(/[,VNĐ]/g,'')));
            $("#thue_vat").val(formatCurrency(data.thue_vat.replace(/[,VNĐ]/g,'')));
            $("#tax").val(data.tax).trigger('change');
            $("#gia_han").val(data.gia_han).trigger('gia_han');
            $("#so_luong").val(data.so_luong);
            $("#ghi_chu").val(data.ghi_chu);
            url = baseHome + '/dichvu/update?id=' + id;
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
                url: baseHome + "/dichvu/del",
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
    var name = $('#name').val();
    if(name != ""){
        $("#btn_add").attr("disabled", false);
    }else{
        $("#btn_add").attr("disabled", true);
    }
}
function loadthue(){
    var thue = Number($("#tax").val());
    var don_gia = $("#don_gia").val();
    var don_gia_fm =   parseFloat(don_gia.replace(/,/g, ''));
    var thuevat = thue * don_gia_fm / 100;
    var thuevat_fm =  Math.ceil(thuevat);
    $("#thue_vat").val(formatCurrency((thuevat_fm+"").replace(/[,VNĐ]/g,'')));
}


