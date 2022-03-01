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


    $('#departmentId').select2({   
              placeholder: "Lựa chọn phòng ban",           
              language: {
                    noResults: function() {
                        return '<a onclick="loadDepartment()"  href="javascript:void(0)">+Thêm mới</a>';
                      }
                    },escapeMarkup: function (markup) {
                         return markup;
                    }
              });
 


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
                    title: 'Thao tác',
                    visible: (funEdit != 1 && funDel != 1) ? false : true,
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
            buttons: buttons,
          
            initComplete: function () {
             

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

function showAdd() {
    var validator = $('#fm').validate(); // reset form
        validator.resetForm();
        $(".error").removeClass("error"); // loại bỏ validate
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
    var validator = $('#fm').validate(); // reset form
    validator.resetForm();
    $(".error").removeClass("error"); // loại bỏ validate
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
    var info = {};
    info.name = $("#name").val();
    info.basicSalary = $("#basicSalary").val();
    info.salaryPercentage = $("#salaryPercentage").val();
    info.insuranceSalary = $("#insuranceSalary").val();
    info.allowance = $("#allowance").val();
    info.startDate = $("#startDate").val();
    info.stopDate = $("#stopDate").val();
    info.staffId = $("#staffId").val();
    info.workPlaceId = $('#workPlaceId').val();
    info.shiftId = $('#shiftId').val();
    info.departmentId = $("#departmentId").val();
    info.position = $("#position").val();
    info.branchId = $("#branchId").val();
    info.type = $("#type").val();
    info.status = $("#status").val();
    info.description = $("#description").val();
            $.ajax({
                url: url,
                type: 'POST',
                data: info,
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
