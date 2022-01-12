var dataId = 0;
var statusObj = [];
$(function () {
    "use strict";

    var basicPickr = $('.flatpickr-basic');
    basicPickr.prop('readonly', false);
    // Default
    if (basicPickr.length) {
        basicPickr.flatpickr({
            dateFormat: "d/m/Y",
            defaultDate: "",
            readonly: false
        });
    }

    return_combobox_multi('#estaffId', baseHome + '/common/nhanvien', 'Chọn nhân viên');
    return_combobox_multi('#esourceId', baseHome + '/common/datasource', 'Chọn loại khách hàng');
    return_combobox_multi('#sourceId', baseHome + '/common/datasource', 'Chọn loại khách hàng');
    return_combobox_multi('#sourceId_import', baseHome + '/common/datasource', 'Chọn loại khách hàng');
    return_combobox_multi('#phutrach', baseHome + '/common/nhanvien', 'Chọn nhân viên');
    return_combobox_multi('#chiacho', baseHome + '/common/nhanvien', 'Chọn nhân viên');
    return_combobox_multi('#estatus', baseHome + '/common/datastatus', 'Chọn tình trạng data');

    return_combobox_multi('#phutrach_import', baseHome + '/common/nhanvien', 'Chọn nhân viên');

    $('#nhanvien').val('').change();
    $('#phutrach_import').val('').change();
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/common/datastatus",
        success: function (data) {
            statusObj = data;
        },
    });

    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");

    // Users List datatable
    if (dtUserTable.length) {
        var table = dtUserTable.DataTable({
            ajax: baseHome + "/data/list",
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "autoWidth": false,
            "responsive": false,
            "fixedColumns": true,
            // select: {
            //     style: 'multi'
            // },

            columns: [
                // columns according to JSON
                { data: "" },
                { data: "id" },
                { data: "name" },
                { data: "phoneNumber" },
                { data: "source" },
                { data: "assignmentDate" },
                { data: "staff" },
                { data: "status" },
                { data: "" },
            ],
            columnDefs: [
                {
                    // For Responsive
                    className: "control",
                    // responsivePriority: 2,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return "";
                    },
                },
                {
                    // For Checkboxes
                    targets: 1,
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes" type="checkbox" value="" id="checkbox' +
                            data +
                            '" /><label class="custom-control-label" for="checkbox' +
                            data +
                            '"></label></div>'
                        );
                    },
                    select: {
                        style: 'multi'
                    },
                    checkboxes: {
                        selectAllRender:
                            '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                    }
                },
                {
                    targets: 2,
                    width: '30%',
                    render: function (data, type, full, meta) {
                        var roleBadgeObj = {
                            Subscriber: feather.icons["user"].toSvg({ class: "font-medium-3 text-primary mr-50" }),
                            Author: feather.icons["settings"].toSvg({ class: "font-medium-3 text-warning mr-50" }),
                            Maintainer: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                            Editor: feather.icons["edit-2"].toSvg({ class: "font-medium-3 text-info mr-50" }),
                            Admin: feather.icons["slack"].toSvg({ class: "font-medium-3 text-danger mr-50" }),
                        };
                        return '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ')" >' +
                            '<span class="align-middle font-weight-bold">' + roleBadgeObj['Subscriber'] + full["name"] + "</span></a>";
                    },
                },
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return "<span class='text-truncate align-middle'>" + feather.icons["phone"].toSvg({ class: "font-medium-3 text-primary mr-50" }) + full["phoneNumber"] + "</span>";
                    },
                },
                {
                    targets: 7,
                    render: function (data, type, full, meta) {
                        var $status = full["status"];
                        if ($status == 1) {
                            return '<span class="badge badge-success" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 2) {
                            return '<span class="badge badge-warning" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 3) {
                            return '<span class="" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 4) {
                            return '<span class="badge badge-secondary" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 5) {
                            return '<span class="badge badge-dark" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 6) {
                            return '<span class="badge badge-danger" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 7) {
                            return '<span class="" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 8) {
                            return '<span class="" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 9) {
                            return '<span class="badge badge-warning" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 10) {
                            return '<span class="badge badge-warning" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else if ($status == 11) {
                            return '<span class="badge badge-warning" text-capitalized>' + statusObj[$status - 1].text + "</span>";
                        } else {
                            return '';
                        }
                    },
                    width: 50
                },
                {
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    render: function (data, type, full, meta) {
                        var html = '<div style="text-align:right;width: 130px;">';
                        // html += '<button type="button" class="btn btn-icon btn-outline-success waves-effect"  title="Gọi" onclick="call(\'' + full['phoneNumber'] + '\')">';
                        // html += '<i class="fas fa-phone-alt"></i>';
                        // html += '</button> &nbsp;';
                        // html += '<button type="button" class="btn btn-icon btn-outline-warning waves-effect" data-toggle="tooltip" data-placement="top" data-original-title="Chuyển sang Lead" onclick="movelead_id(' + full['id'] + ')">';
                        // html += '<i class="fas fa-heart"></i>';
                        // html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-warning waves-effect" data-toggle="tooltip" data-placement="top" data-original-title="Tạo cơ hội" onclick="addLead(' + full['id'] + ',' + full['status'] + ')">';
                        html += '<i class="fas fa-retweet"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="xoa(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button></div>';
                        return html;
                    },
                    width: 150
                },
            ],
            displayLength: 30,
            lengthMenu: [10, 20, 30, 50, 70, 100],
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
            ],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            return "Chi tiết thông tin data";
                        },
                    }),

                    type: "column",
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: "table",
                        columnDefs: [
                            {
                                targets: 1,
                                visible: false,
                            },
                            {
                                targets: 8,
                                visible: false,
                            }
                        ],
                    }),
                },
            },
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
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

    // Form Validation

    $('#frm-add').each(function () {
        var $this = $(this);
        $this.validate({
            rules: {
                name: {
                    required: true
                },
                phoneNumber: {
                    required: true
                },
            }
        });
    });

    $('#frm-edit').each(function () {
        var $this = $(this);
        $this.validate({
            rules: {
                name: {
                    required: true
                },
                phoneNumber: {
                    required: true
                },
            }
        });
    });

    $('#frm-report').each(function () {
        var $this = $(this);
        $this.validate({
            rules: {
                description: {
                    required: true
                }
            }
        });
    });

    $('#frm-nhapexcel').each(function () {
        var $this = $(this);
        $this.validate({
            rules: {
                file: {
                    required: true
                }
            }
        });
    });

    $('#frm-add-lead').each(function () {
        var $this = $(this);
        $this.validate({
            rules: {
                nameLead: {
                    required: true
                },
                opportunity: {
                    required: true
                }
            }
        });
    });

    // To initialize tooltip with body container
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
        container: "body",
    });
});

function search() {
    var nhanvien = $("#nhanvien").val();
    var tungay = $("#tungay").val();
    var denngay = $("#denngay").val();
    if (nhanvien != '' || tungay != '' || denngay != '') {
        var table = $(".user-list-table").DataTable();
        table.ajax.url(baseHome + "/data/list?nhan_vien=" + nhanvien + "&tu_ngay=" + tungay + "&den_ngay=" + denngay).load();
        table.draw();
    }
}

function showadd() {
    $("#addnew").modal('show');
    $("#modal-title1").html('Thêm data mới');
    $('#name').val('');
    $('#phoneNumber').val('');
    $('#address').val('');
    $('#email').val('');
    $('#sourceId').val('').change();
    $('#note').val('');
    url = baseHome + "/data/add";
}

// function showcall() {
//     $("#showcall").modal('show');
//     $('#call_number').val('');
// }

function loaddata(id) {
    $('#updateinfo').modal('show');
    $('#tab-1').click();
    $("#modal-title2").html('Cập nhật thông tin data');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/data/loaddata",
        success: function (result) {
            let data = result.data;
            let datareports = result.datareports;
            dataId = id;
            $('#ename').val(data.name);
            $('#ephoneNumber').val(data.phoneNumber);
            $('#eemail').val(data.email);
            $('#eaddress').val(data.address);
            $('#esourceId').val(data.sourceId).change();
            $('#estaffId').val(data.staffId).change();
            $('#estatus').val(data.status).change();
            $('#enote').val(data.note);
            $('#econnectorName').val(data.connectorName);
            $('#etaxCode').val(data.taxCode);
            $('#etype').val(data.type);
            $('#description').val('');
            $('#listnhatky').html('');
            datareports.map(history => {
                return $('#listnhatky').append('<div class="media mb-1"><div class="avatar bg-light-success my-0 ml-0 mr-50"><img src="' + history.hinhanh + '" alt="Avatar" height="32" /></div><div class="media-body"><p class="mb-0"><span class="font-weight-bold">' + history.username + '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small class="text-muted">' + history.dateTime + '</small></p><p>' + history.description + '</p></div></div>');
            });
            var chatUsersListWrapper = $('#listnhatky');
            var chatUserList = new PerfectScrollbar(chatUsersListWrapper[0]);
            url = baseHome + '/data/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function saveadd() {
    var isValid = $('#frm-add').valid();
    if (isValid) {
        var info = {};
        info.name = $("#name").val();
        info.phoneNumber = $("#phoneNumber").val();
        info.address = $("#address").val();
        info.email = $("#email").val();
        info.sourceId = $("#sourceId").val();
        info.note = $("#note").val();
        $.ajax({
            type: "POST",
            dataType: "json",
            data: info,
            url: baseHome + "/data/add",
            success: function (data) {
                if (data.success) {
                    notyfi_success(data.msg);
                    $('#addnew').modal('hide');
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
}

function saveedit() {
    var isValid = $('#frm-edit').valid();
    if (isValid) {
        var info = {};
        info.ename = $("#ename").val();
        info.ephoneNumber = $("#ephoneNumber").val();
        info.eaddress = $("#eaddress").val();
        info.eemail = $("#eemail").val();
        info.esourceId = $("#esourceId").val();
        info.econnectorName = $("#econnectorName").val();
        info.etaxCode = $("#etaxCode").val();
        info.etype = $("#etype").val();
        info.enote = $("#enote").val();
        info.estaffId = $("#estaffId").val();
        info.estatus = $("#estatus").val();
        if (dataId > 0) {
            $.ajax({
                type: "POST",
                dataType: "json",
                data: info,
                url: baseHome + "/data/update?id=" + dataId,
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
    }
}

function savenhatky() {
    var isValid = $('#frm-report').valid();
    if (isValid) {
        var info = {};
        info.dataId = dataId;
        info.description = $("#description").val();
        if (dataId > 0) {
            $.ajax({
                type: "POST",
                dataType: "json",
                data: info,
                url: baseHome + "/data/addDataReport",
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.msg);
                        $('#description').val('');
                        $('#listnhatky').prepend('<div class="media mb-1"><div class="avatar bg-light-success my-0 ml-0 mr-50"><img src="' + hinhanh + '" alt="Avatar" height="32" /></div><div class="media-body"><p class="mb-0"><span class="font-weight-bold">' + username + '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small class="text-muted">' + now + '</small></p><p>' + info.description + '</p></div></div>');
                    }
                    else
                        notify_error(data.msg);
                },
                error: function () {
                    notify_error('Cập nhật không thành công');
                }
            });
        }
    }
}

function chiadata() {
    $("#chiacho").val('').change();
    var table = $(".user-list-table").DataTable();
    var rows = table.column(1).checkboxes.selected();
    var listdata = '';
    rows.each(function (item) {
        listdata += item + ',';
    })
    listdata = listdata.slice(0, -1);

    if (rows.length > 0) {
        $("#chiadata").modal('show');
        $("#modal-title4").html('Chia data');
        $("#data").val(listdata);
    } else {
        notify_error('Không có bản ghi nào được chọn');
    }
}

function savechia() {
    var chiacho = $("#chiacho").val();
    var data = $("#data").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { data: data, cstaffId: chiacho },
        url: baseHome + "/data/chiadata",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#chiadata').modal('hide');
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

// function movetolead() {
//     var table = $(".user-list-table").DataTable();
//     var rows = table.column(1).checkboxes.selected();
//     var listlead = '';
//     rows.each(function (item) {
//         listlead += item + ',';
//     })
//     listlead = listlead.slice(0, -1);

//     if (rows.length > 0) {
//         $.ajax({
//             type: "POST",
//             dataType: "json",
//             data: { data: listlead },
//             url: baseHome + "/data/movetolead",
//             success: function (data) {
//                 if (data.success) {
//                     notyfi_success(data.msg);
//                     $(".user-list-table").DataTable().ajax.reload(null, false);
//                 }
//                 else
//                     notify_error(data.msg);
//             },
//             error: function () {
//                 notify_error('Cập nhật không thành công');
//             }
//         });
//     } else {
//         notify_error('Không có bản ghi nào được chọn');
//     }
// }

// function movelead_id(id) {

//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         data: { id: id },
//         url: baseHome + "/data/movelead_id",
//         success: function (data) {
//             if (data.success) {
//                 notyfi_success(data.msg);
//                 $(".user-list-table").DataTable().ajax.reload(null, false);
//             }
//             else
//                 notify_error(data.msg);
//         },
//         error: function () {
//             notify_error('Cập nhật không thành công');
//         }
//     });

// }

function addLead(id, status) {
    if (status != 11) {
        $("#add-lead").modal('show');
        $('#descriptionLead').val();
        $('#opportunity').val(1).change();
        dataId = id;

    } else {
        notify_error('Data đã được chuyển sang khách hàng!');
    }
}

function saveAddLead() {
    var isValid = $('#frm-add-lead').valid();
    if (isValid) {
        var info = {};
        info.dataId = dataId;
        info.description = $('#descriptionLead').val();
        info.opportunity = $('#opportunity').val();
        $.ajax({
            url: baseHome + "/data/addLead",
            type: 'post',
            dataType: "json",
            data: info,
            success: function (data) {
                if (data.success) {
                    $("#add-lead").modal('hide');
                    notyfi_success(data.msg);
                    $(".user-list-table").DataTable().ajax.reload(null, false);
                }
                else
                    notify_error(data.msg);
            },
        });
    }
}

function nhapexcel() {
    $("#nhapexcel").modal('show');
    $("#modal-title5").html('Nhập data từ file excel');
    $("#file").val('');
    $("#frm-nhapexcel").reset();
}

function savenhap() {
    var isValid = $('#frm-nhapexcel').valid();
    if (isValid) {
        var myform = new FormData($("#frm-nhapexcel")[0]);
        $.ajax({
            type: "POST",
            dataType: "json",
            data: myform,
            url: baseHome + "/data/importData",
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.success) {
                    notyfi_success(data.msg);
                    $('#nhapexcel').modal('hide');
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
                url: baseHome + "/data/del",
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

function call(number) {
    // number = '0'+number;
    DialByLine('audio', '', number);
    // alert(number)
}
