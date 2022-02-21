var url = '';

$(function () {

    
    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        datePicker = $(".ngay_gio"),
        nhan_vien = $("#nhan_vien"),
        tai_san = $("#tai_san"),
        nhan_vien_th = $("#nhan_vien_th"),
        tai_san_th = $("#tai_san_th"),
        form = $("#dg");
       
     // datepicker init
    if (datePicker.length) {
        datePicker.flatpickr({
            dateFormat: 'd-m-Y',
            defaultDate: "today",
        });
    }


    // Users List datatable
    if (dtUserTable.length) {
        
        dtUserTable.DataTable({
            ordering: false,
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/recruitment_result/list",
            columns: [
                { data: "title" },
                { data: "department" },
                { data: "position" },
                { data: "quantity" },
                { data: "countInterview" },
                { data: "countqualified" },
                { data: "countReceived" },
             
            ],
            columnDefs: [
               
                
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
                    "sInfoEmpty": "Hiển thị 0 đến 0 của 0 bản ghi",
             
                },
                "oLanguage": {
                    "sZeroRecords": "Không có bản ghi nào"
                  }, 
            // Buttons with Dropdown
            buttons: [],
           
        
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
                "nhan_vien": {
                    required: true,
                },
                "tai_san": {
                    required: true,
                },
                "dat_coc": {
                    required: true,
                },
            },
            message: {
                "nhan_vien": {
                    required: "Bạn chưa chọn nhân viên",
                },
                "tai_san": {
                    required: "Bạn chưa chọn nhân viên",
                },
                "dat_coc": {
                    required: "Bạn chưa nhập tiền đặt cọc",
            },
        }
        });

        form.on("submit", function (e) {
            var isValid = form.valid();
            e.preventDefault();
            if (isValid) {
                savetk();
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
    var validator = $( "#dg" ).validate(); // reset form
    validator.resetForm();
    $(".error").removeClass("error"); // loại bỏ validate
    $(".modal-title").html('Thông tin cấp phát tài sản');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/asset_issue/loaddata",
        success: function (data) {
            return_combobox_multi('#tai_san', baseHome + '/asset_issue/getAllAsset', 'Tài sản');
            $('#id').val(data.id);
            $("#tai_san").attr("disabled", true);
            $("#tai_san").val(data.tai_san).change();
            $("#nhan_vien").val(data.nhan_vien).trigger('change');
            $('#so_luong').val(data.so_luong);
            $('#dat_coc').val(formatCurrency(data.dat_coc.replace(/[,VNĐ]/g,'')));
            $('#ngay_gio').val(data.ngay_gio);
            $('#ghi_chu').val(data.ghi_chu);
 
            url = baseHome + '/asset_issue/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}














