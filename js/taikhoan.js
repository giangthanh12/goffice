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
            ajax: baseHome + "/taikhoan/list",
            columns: [
                // columns according to JSON
                // { data: "" },
                { data: "name" },
                { data: "so_tk" },
                { data: "ngan_hang" },
                { data: "tinh_trang" },
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
                    targets: 0,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full["name"];
                            
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
                    // User Status
                    targets: 3,
                    render: function (data, type, full, meta) {
                        var $status = full["tinh_trang"];
                        return '<span class="badge badge-pill ' + statusObj[$status].class + '" text-capitalized>' + statusObj[$status].title + "</span>";
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
                        $(".modal-title").html('Thêm tài khoản ngân hàng mới');
                        $('#name').val('');
                        $('#so_tk').val('');
                        $('#ngan_hang').val('');
                        $('#tinh_trang').val('1');

                        url = baseHome + "/taikhoan/add";
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
    $(".modal-title").html('Cập nhật thông tin tài khoản ngân hàng');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/taikhoan/loaddata",
        success: function (data) {
            $('#name').val(data.name);
            $('#so_tk').val(data.so_tk);
            $('#ngan_hang').val(data.ngan_hang);
            $('#tinh_trang').attr("disabled", false);
            $('#tinh_trang').val(data.tinh_trang);
            
            url = baseHome + '/taikhoan/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function savetk() {
    var info = {};
    info.name = $("#name").val();
    info.so_tk = $("#so_tk").val();
    info.ngan_hang = $("#ngan_hang").val();
    info.tinh_trang = $("#tinh_trang").val();

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
                url: baseHome + "/taikhoan/del",
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

