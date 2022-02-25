var url = '';
$(function () {
    "use strict";

    var dtUserTable = $(".user-list-table"),
        form = $("#fm");
    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/contracttype/list",
            columns: [
                // columns according to JSON
                {data: "id"},
                {data: "name"},
                {data: "note"},
                // {data: "departmentName"},
                // {data: "department"},
                {data: ""},
            ],
            columnDefs: [
                {
                    targets: 0,
                    responsivePriority: 4,
                    visible: false,
                },
                {
                    // Actions
                    targets: -1,
                    title: 'Thao tác',
                    orderable: false,
                    render: function (data, type, row, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + row['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="xoa(' + row['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
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
                    infoFiltered: "(lọc từ _MAX_ bản ghi)",
                    sInfoEmpty : "Hiển thị 0 đến 0 của 0 bản ghi", 
                },
                 "oLanguage": {
                        "sZeroRecords": "Không có bản ghi nào"
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
                        $("#dgAccesspoint").modal('show');
                        $(".modal-title").html('Thêm loại hợp đồng mới');
                        $('#name').val('');
                        $('#note').val('');
                        url = baseHome + "/contracttype/add";
                    },
                },
            ],
            initComplete: function () {
                // Adding role filter once table initialized

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

    // To initialize tooltip with body container
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
        container: "body",
    });
});

function loaddata(id) {
    $("#dgAccesspoint").modal('show');
    $(".modal-title").html('Cập nhật thông tin loại hợp đồng');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {id: id},
        url: baseHome + "/contracttype/loaddata",
        success: function (data) {
            $('#name').val(data.name);
            $('#note').val(data.note);
            url = baseHome + '/contracttype/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function save() {
    $('#fm').validate({
       
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.code==200) {
                        notyfi_success(data.message);
                        $('#dgAccesspoint').modal('hide');
                        $(".user-list-table").DataTable().ajax.reload(null, false);
                    } else
                        notify_error(data.message);
                }
            });
            return false;
        }
    });
    $('#fm').submit();
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
                url: baseHome + "/contracttype/del",
                type: 'post',
                dataType: "json",
                data: {id: id},
                success: function (data) {
                    if (data.code==200) {
                        notyfi_success(data.message);
                        $(".user-list-table").DataTable().ajax.reload(null, false);
                    } else
                        notify_error(data.message);
                },
            });
        }
    });
}
