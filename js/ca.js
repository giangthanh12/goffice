var url = '';

$(function () {


    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");
    var  datePicker = $(".flatpicker");
    // datepicker init
        if (datePicker.length) {
            datePicker.flatpickr({
                enableTime: true,
                noCalendar: true,
                time_24hr: true,
                dateFormat: "H:i:S",
               
            });
        }

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/ca/listdata",
            columns: [
                // columns according to JSON
                // { data: "" },
                { data: "shift" },
                { data: "monIn" },
                { data: "tueIn" },
                { data: "wedIn" },
                { data: "thuIn" },
                { data: "friIn" },
                { data: "satIn" },
                { data: "sunIn" },
                { data: "lunStart" },
                { data: "lunInterval" },
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
                        var $name = full["shift"];
                            
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
                    targets: 1,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $row_output = full["monIn"] +"<br/>" + full["monOut"];
                        return $row_output;
                    },
                },

                {
                    targets: 2,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $row_output = full["tueIn"] +"<br/>" + full["tueOut"];
                        return $row_output;
                    },
                },

                {
                    targets: 3,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $row_output = full["wedIn"] +"<br/>" + full["wedOut"];
                        return $row_output;
                    },
                },
                {
                    targets: 4,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $row_output = full["thuIn"] +"<br/>" + full["thuOut"];
                        return $row_output;
                    },
                },
                {
                    targets: 5,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $row_output = full["friIn"] +"<br/>" + full["friOut"];
                        return $row_output;
                    },
                },
                {
                    targets: 6,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $row_output = full["satIn"] +"<br/>" + full["satOut"];
                        return $row_output;
                    },
                },
                {
                    targets: 7,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $row_output = full["sunIn"] +"<br/>" + full["sunOut"];
                        return $row_output;
                    },
                },
                {
                    targets: 9,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $row_output = full["lunInterval"] +"h";
                        return $row_output;
                    },
                },
               
                {
                    // Actions
                    targets: -1,
                    title: 'Thao tác',
                   
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
                    width:100 
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
                    "sInfoEmpty": "Hiển thị 0 đến 0 của 0 bản ghi",
             
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
                        $("#updateinfo").modal('show');
                        $(".modal-title").html('Thêm ca làm việc mới');
                        $('#ca').val('');
                        $('.flatpicker').val('');
                        url = baseHome + "/ca/add";
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
    $(".modal-title").html('Cập nhật thông tin giờ làm việc');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/ca/loaddata",
        success: function (data) {
            $('#ca').val(data.shift);
            $('#t2_in').val(data.monIn);
            $('#t2_out').val(data.monOut);
            $('#t3_in').val(data.tueIn);
            $('#t3_out').val(data.tueOut);
            $('#t4_in').val(data.wedIn);
            $('#t4_out').val(data.wedOut);
            $('#t5_in').val(data.thuIn);
            $('#t5_out').val(data.thuOut);
            $('#t6_in').val(data.friIn);
            $('#t6_out').val(data.friOut);
            $('#t7_in').val(data.satIn);
            $('#t7_out').val(data.satOut);
            $('#cn_in').val(data.sunIn);
            $('#cn_out').val(data.sunOut);
            $('#lunStart').val(data.lunStart);
            $('#lunInterval').val(data.lunInterval);
            
            
            url = baseHome + '/ca/update?id=' + id;
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
                url: baseHome + "/ca/del",
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

