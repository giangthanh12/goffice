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
    return_combobox_multi('#esourceId', baseHome + '/common/datasource', 'Chọn nguồn data');
    return_combobox_multi('#sourceId', baseHome + '/common/datasource', 'Chọn nguồn data');
    return_combobox_multi('#sourceId_import', baseHome + '/common/datasource', '');
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
    var visible = true;
    if (funEdit != 1 && funDel != 1) {
        visible = false;
    }
    // Users List datatable
    if (dtUserTable.length) {
        var table = dtUserTable.DataTable({
            ajax: baseHome + "/data/list",
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "autoWidth": false,
            "fixedColumns": true,
            select: {
                style: 'multi'
            },

            columns: [
                // columns according to JSON
                // { data: "" },
                { data: "id" },
                { data: "name" },
                { data: "phoneNumber" },
                { data: "source" },
                { data: "assignmentDate" },
                { data: "staff" },
                { data: "status" },
                { data: "id" },
            ],
            columnDefs: [
                // {
                //     // For Responsive
                //     className: "control",
                //     // responsivePriority: 2,
                //     targets: 0,
                //     render: function (data, type, full, meta) {
                //         return "";
                //     },
                // },
                {
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta){
                        return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                    }
                 },
                {
                    targets: 1,
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
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return '<a class="text-truncate align-middle" onclick="call(\'' + full['phoneNumber'] + '\')">' + feather.icons["phone"].toSvg({ class: "font-medium-3 text-primary mr-50" }) + full["phoneNumber"] + '</a>';
                    },
                },
                {
                    targets: 6,
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
                    title: 'Thao tác',
                    visible: visible,
                    render: function (data, type, full, meta) {
                        var html = '<div style="text-align:right;width: 130px;">';

                        if (funCreateChange == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-warning waves-effect" data-toggle="tooltip" data-placement="top" data-original-title="Tạo cơ hội" onclick="addLead(' + full['id'] + ',' + full['status'] + ')">';
                            html += '<i class="fas fa-retweet"></i>';
                            html += '</button> &nbsp;';
                        }
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
                        html += '</div>';
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
            // Buttons with Dropdown
            buttons: [
            ],
            // For responsive popup
            //   responsive: {
            // details: {
            //     display: $.fn.dataTable.Responsive.display.modal({
            //         header: function (row) {
            //             return "Chi tiết thông tin data";
            //         },
            //     }),

            //     type: "column",
            //     renderer: $.fn.dataTable.Responsive.renderer.tableAll({
            //         tableClass: "table",
            //         columnDefs: [
            //             {
            //                 targets: 1,
            //                 visible: false,
            //             },
            //             {
            //                 targets: 8,
            //                 visible: false,
            //             }
            //         ],
            //     }),
            // },
            //  },
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
                sInfoEmpty: "Hiển thị 0 đến 0 của 0 bản ghi",
            },
            "oLanguage": {
                "sZeroRecords": "Không có bản ghi nào"
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
                    required: true,
                    minlength: 10,
                    maxlength: 10
                },
            },
            messages: {
                "name": {
                    required: "Bạn chưa nhập tên khách hàng!",
                },
                "phoneNumber": {
                    required: "Bạn chưa nhập số điện thoại!",
                    minlength: "yêu cầu nhập đủ 10 số",
                    maxlength: "yêu cầu nhập đủ 10 số"
                }
            },
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
                    required: true,
                    minlength: 10,
                    maxlength: 10
                },
                etaxCode:{
                    minlength: 10,
                    maxlength: 13
                }
            },
            messages: {
                "name": {
                    required: "Bạn chưa nhập tên khách hàng!",
                },
                "phoneNumber": {
                    required: "Bạn chưa nhập số điện thoại!",
                    minlength: "yêu cầu nhập đủ 10 số",
                    maxlength: "yêu cầu nhập đủ 10 số"
                },
                "etaxCode":{
                    minlength: "yêu cầu nhập tối thiểu 10 số",
                    maxlength: "yêu cầu nhập tối đa 13 số",
                }
            },
        });
    });

    $('#frm-report').each(function () {
        var $this = $(this);
        $this.validate({
            rules: {
                description: {
                    required: true
                }
            },
            messages: {
                description: {
                    required: "Yêu cầu nhập nội dung nhật ký!"
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
                leadName: {
                    required: true
                },
                opportunity: {
                    required: true
                }
            },
            messages: {
                leadName: {
                    required: "Yêu cầu nhập tên cơ hội!"
                },
               
            }
        });
    });

    // To initialize tooltip with body container
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
        container: "body",
    });
    $('#example-select-all').on('click', function(){
        // Get all rows with search applied
        var rows = table.rows({ 'search': 'applied' }).nodes();
        console.log(rows);
        // Check/uncheck checkboxes for all rows in the table
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
     });
     $(document).on('change', 'input[type="checkbox"]', function(){
        // If checkbox is not checked
        if(!this.checked){
           var el = $('#example-select-all').get(0);
           console.log(el);
           // If "Select all" control is checked and has 'indeterminate' property
           if(el && el.checked && ('indeterminate' in el)){
              // Set visual state of "Select all" control 
              // as 'indeterminate'
              el.checked = false;
           }
        }
     });
   

     //
     table.$('input[type="checkbox"]').each(function(){
        // If checkbox doesn't exist in DOM
        // if(!$.contains(document, this)){
        //    // If checkbox is checked
        //    if(this.checked){
        //       // Create a hidden element
        //       $(form).append(
        //          $('<input>')
        //             .attr('type', 'hidden')
        //             .attr('name', this.name)
        //             .val(this.value)
        //       );
        //    }
        // }
     });
});

function search() {
    // var nhanvien = $("#nhanvien").val();
    var tungay = $("#tungay").val();
    var denngay = $("#denngay").val();
    if (tungay != '' || denngay != '') {
        var table = $(".user-list-table").DataTable();
        table.ajax.url(baseHome + "/data/list?tu_ngay=" + tungay + "&den_ngay=" + denngay).load();
        table.draw();
    }
}

function showadd() {
    $("#addnew").modal('show');
    $("#modal-title1").html('Thêm data mới');
    $('#frm-add').validate().resetForm();
    $(".error").removeClass("error");
    $('#name').val('');
    $('#phoneNumber').val('');
    $('#address').val('');
    $('#email').val('');
    $('#sourceId').val('').change();
    $('#note').val('');
    url = baseHome + "/data/add";
}

function showcall() {
    $("#showcall").modal('show');
    $('#call_number').val('');
}

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
            if(data.type == 0) {
                $('#etype').select2({
                    placeholder: 'Lĩnh vực hoạt động'
                });
                $('#etype').val('').change();
            }
            $('#etype').val(data.type).change();
            $('#description').val('');
            $('#listnhatky').html('');
            datareports.map(history => {
                return $('#listnhatky').append('<div class="media mb-1"><div style="width: 50px;height: 50px;" class="avatar bg-light-success my-0 ml-0 mr-50"><img onerror='+"this.src='https://velo.vn/goffice-test/layouts/useravatar.png'"+' style="width: 50px;height: 50px;" src="' + history.hinhanh + '" alt="Avatar" height="32" /></div><div class="media-body"><p class="mb-0"><span class="font-weight-bold">' + history.username + '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small class="text-muted">' + history.dateTime + '</small></p><p>' + history.description + '</p></div></div>');
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

// var table = $(".user-list-table").DataTable();
// table.$('input[type="checkbox"]').each(function(item){
//     console.log(item);
//    // If checkbox doesn't exist in DOM
// });
chiadata();
function chiadata() {
    // var inputs = document.querySelectorAll('input[type="checkbox"]');
    // console.log(inputs);
// $().each(function(item){
//     console.log(item);
   // If checkbox doesn't exist in DOM
// });
    // $("#chiacho").val('').change();
    var table = $(".user-list-table").DataTable();
    var rows = table.column(0).checkboxes.selected();
    var listdata = '';
    rows.each(function (item) {
        listdata += item + ',';
    })
    console.log(listdata);
    // listdata = listdata.slice(0, -1);
    // console.log(listdata);
    // if (rows.length > 0) {
    //     $("#chiadata").modal('show');
    //     $("#modal-title4").html('Chia data');
    //     $("#data").val(listdata);
    // } else {
    //     notify_error('Không có bản ghi nào được chọn');
    // }
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
    $("#add-lead").modal('show');
    $('#descriptionLead').val();
    $('#opportunity').val(1).change();
    dataId = id;
}

function saveAddLead() {
    var isValid = $('#frm-add-lead').valid();
    if (isValid) {
        var info = {};
        info.leadName = $('#leadName').val();
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

function changeStart() {
    var startDate = $('#tungay').val();
    if ($('#denngay').length) {
        $('#denngay').flatpickr({
            dateFormat: "d/m/Y",
            defaultDate: "",
            readonly: true,
            minDate: startDate
        });
    }
}