$(function () {
    // $('#')
    return_combobox_multi('#staffId', baseHome + '/common/listStaff', 'Lựa chọn nhân viên');
    return_combobox_multi('#type', baseHome + '/common/typeContracts', 'Lựa chọn loại hợp đồng');
    return_combobox_multi('#departmentId', baseHome + '/common/departments', 'Lựa chọn phòng ban');
    return_combobox_multi('#branchId', baseHome + '/common/branchs', 'Lựa chọn chi nhánh');
    return_combobox_multi('#position', baseHome + '/common/positions', 'Lựa chọn vị trí');
    return_combobox_multi('#shiftId', baseHome + '/common/shifts', 'Lựa chọn ca làm việc');
    return_combobox_multi('#workPlaceId', baseHome + '/common/workPlaces', 'Địa điểm làm việc');
    "use strict";

    var dtUserTable = $(".user-list-table"),
        modal = $("#add-contract"),
        form = $("#dg"), buttons = [];
    if (funAdd == 1)
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
    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/laborcontracts/list",
            ordering: true,
            columns: [
                // columns according to JSON
                {data: "id"},
                {data: "name"},
                {data: "typeName"},
                {data: "staffName"},
                {data: "status"},
                {data: "type"},
                {data: ""},
            ],
            columnDefs: [
                {
                    targets: 1,
                    render: function (data, type, full, meta) {
                        return '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ')" >' +
                            '<span class="align-middle font-weight-bold" style="padding: 5px;">' + full["name"] + "</span></a>";
                    },
                    width: 200
                },
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        var $status = full["status"];

                        if ($status == 1) {
                            return "<span>Đang thực hiện</span>";
                        } else if ($status == 2) {
                            return "<span>Đã kết thúc</span>";
                        } else {
                            return '';
                        }

                    },
                },
                {
                    targets: 0,
                    visible: false
                },
                {
                    targets: 5,
                    visible: false
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({class: "font-medium-3 text-success mr-50"}),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        if (funEdit == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                            html += '<i class="fas fa-pencil-alt"></i>';
                            html += '</button> &nbsp;';
                        }
                        if (funDel == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="xoa(' + full['id'] + ')">';
                            html += '<i class="fas fa-trash-alt"></i>';
                            html += '</button>';
                        }
                        return html;
                    },
                    width: 100
                },
            ],
            order: [[0, "desc"]],
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
                search: "Tìm kiếm",
                searchPlaceholder: "Từ khóa..",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            // Buttons with Dropdown
            buttons: buttons,
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
                // this.api()
                //     .columns(8)
                //     .every(function () {
                //         var column = this;
                //         var select = $('<select id="kh_tinhtrang" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Loại hợp đồng </option></select>')
                //             .appendTo(".kh_tinhtrang")
                //             .on("change", function () {
                //                 var val = $.fn.dataTable.util.escapeRegex($(this).val());
                //                 column.search(val ? "^" + val + "$" : "", true, false).draw();
                //             });

                //         column
                //             .data()
                //             .unique()
                //             .sort()
                //             .each(function (d, j) {
                //                 var $stt_output = "";
                //                 if (d == 1) {
                //                     $stt_output = "Thực tập sinh";
                //                 } else if (d == 2) {
                //                     $stt_output = "Thử việc";
                //                 } else if (d == 3) {
                //                     $stt_output = "Chính thức";
                //                 } else if (d == 4) {
                //                     $stt_output = "Cộng tác viên";
                //                 } else if (d == 5) {
                //                     $stt_output = "Tạm ngừng";
                //                 }
                //                 if ($stt_output != '') {
                //                     select.append('<option value="' + d + '" class="text-capitalize">' + $stt_output + "</option>");
                //                 }
                //             });
                //     });

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
                "name": {
                    required: true,
                },
                "staffId": {
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

function showAdd() {
    if (funAdd == 1)
        $('#btnUpdate').removeClass('d-none');
    else
        $('#btnUpdate').addClass('d-none');
    $("#add-contract").modal('show');
    $(".modal-title").html('Thêm hợp đồng mới');
    $('#staffId').val('').trigger('change');
    $('#name').val('');
    $('#basicSalary').val('');
    $('#allowance').val('');
    $('#insuranceSalary').val('');
    $('#startDate').val('');
    $('#stopDate').val('');
    $('#shiftId').val('').trigger('change');
    $('#departmentId').val('').trigger('change');
    $('#position').val('').trigger('change');
    $('#type').val('').trigger('change');
    $('#workPlaceId').val('').trigger('change');
    $('#branchId').val('').trigger('change');
    $('#status').val('1').trigger('change');
    $('#description').val('');
    var basicPickr = $('.flatpickr-basic');
    // Default
    if (basicPickr.length) {
        basicPickr.flatpickr({
            dateFormat: "d/m/Y",
            onReady: function (selectedDates, dateStr, instance) {
                if (instance.isMobile) {
                    $(instance.mobileInput).attr("step", null);
                }
            },
        });
    }
    url = baseHome + "/laborcontracts/add";
}

function loaddata(id) {
    $('#add-contract').modal('show');
    $(".modal-title").html('Cập nhật thông tin hợp đồng');
    if (funEdit == 1)
        $('#btnUpdate').removeClass('d-none');
    else
        $('#btnUpdate').addClass('d-none');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {id: id},
        url: baseHome + "/laborcontracts/loaddata",
        success: function (data) {
            // Default

            $('#name').val(data.name);
            $('#basicSalary').val(Comma(data.basicSalary));
            $('#salaryPercentage').val(data.salaryPercentage);
            $('#allowance').val(Comma(data.allowance));
            if (data.startDate != '0000-00-00' && data.startDate != '1970-01-01')
                $('#startDate').val(data.startDateCv);
            else
                $('#startDate').val('');
            if (data.stopDate != '0000-00-00' && data.stopDate != '1970-01-01')
                $('#stopDate').val(data.stopDateCv);
            else
                $('#stopDate').val('');
            $('#staffId').val(data.staffId).trigger("change");
            $('#departmentId').val(data.departmentId).trigger("change");
            $('#position').val(data.position).trigger("change");
            $('#branchId').val(data.branchId).trigger("change");
            $('#type').val(data.type).trigger("change");
            $('#status').val(data.status).trigger("change");
            $('#shiftId').val(data.shiftId).trigger("change");
            $('#workPlaceId').val(data.workPlaceId).trigger('change');
            $('#description').val(data.description);
            var basicPickr = $('.flatpickr-basic');
            if (basicPickr.length) {
                basicPickr.flatpickr({
                    dateFormat: "d/m/Y",
                    onReady: function (selectedDates, dateStr, instance) {
                      
                        console.log(instance);
                        if (instance.isMobile) {
                            $(instance.mobileInput).attr("step", null);
                        }
                    }
                });
            }
            url = baseHome + '/laborcontracts/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function save() {
    $('#fm').validate({
        messages: {
            "name": {
                required: "Bạn chưa nhập tên hợp đồng!",
            },
            "type": {
                required: "Bạn chưa chọn loại hợp đồng!",
            },
            "staffId": {
                required: "Bạn chưa chọn nhân viên!",
            },
            "departmentId": {
                required: "Bạn chưa chọn phòng ban!",
            },
            "position": {
                required: "Bạn chưa chọn vị tri!",
            },
            "branchId": {
                required: "Bạn chưa chọn chi nhánh!",
            },
            "shiftId": {
                required: "Bạn chưa chọn ca làm việc!",
            },
            "workPlaceId": {
                required: "Bạn chưa chọn địa điểm làm việc!",
            },
            "basicSalary": {
                required: "Bạn chưa nhập lương cơ bản!",
            },
            "salaryPercentage": {
                required: "Bạn chưa nhập tỷ lệ lương!",
            },
            "startDate": {
                required: "Bạn chưa ngày ký hợp đồng!",
            }
        },
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
                    if (data.code == 200) {
                        notyfi_success(data.message);
                        $('#add-contract').modal('hide');
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
        cancelButtonText: 'Hủy',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: baseHome + "/laborcontracts/del",
                type: 'post',
                dataType: "json",
                data: {id: id},
                success: function (data) {
                    if (data.code == 200) {
                        notyfi_success(data.message);
                        $(".user-list-table").DataTable().ajax.reload(null, false);
                    } else
                        notify_error(data.message);
                },
            });
        }
    });
}
