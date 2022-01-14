var url = '';

$(function () {
    return_combobox_multi('#nhan_vien', baseHome + '/asset_issue/getStaff', 'Nhân viên');
    
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

    var button = [];
    let i = 0;
    userFuns.forEach(function (item,index){
        if(item.type==1) {
            button[i] = {
                text: item.name,
                className: "add-new btn btn-" + item.color + " mt-50",
                init: function (api, node, config) {
                    $(node).removeClass("btn-secondary");
                },
                action: function (e, dt, node, config) {
                    actionMenu(item.function);
                }
            };
            i++;
        }
    })

    // Users List datatable
    if (dtUserTable.length) {
        
        dtUserTable.DataTable({
            ordering: false,
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/asset_issue/list",
            columns: [
                { data: "ngay_gio" },
                { data: "name" },
                { data: "nameAsset" },
                { data: "nameStaff" },
                { data: "tinh_trang" },
                { data: "" },
            ],
            columnDefs: [
               
                {
                    // User full name and username
                    targets: 2,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full["nameAsset"];
                            
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
                    // User full name and username
                    targets: 4,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $status = full["tinh_trang"];
                        var $row_output = '---';
                            if($status == 1) {
                                $row_output = `<div class="badge badge-info">Đang sử dụng</div>`;
                            }
                            else if($status == 2) {
                                $row_output = `<div class="badge badge-warning">Đã thu hồi</div>`;
                            }
                          
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
                        html += '<div class="width-200">'

                        if(full['tinh_trang'] != 2) {
                            userFuns.forEach(function (item){
                                if(item.function=='loadRecallAsset') {
                            html += '<button type="button" class="btn btn-icon btn-outline-warning waves-effect" data-toggle="modal" data-target="#thuhoi" title="Thu hồi" onclick="loadRecallAsset(' + full["id"] + ')">';
                            html += 'Thu hồi';
                            html += '</button> &nbsp;';
                            }
                        });
                        }
                        
                        userFuns.forEach(function (item){
                            if(item.function=='loaddata') {
                                    html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" data-toggle="modal" data-target="#updateinfo" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                                    html += '<i class="fas fa-pencil-alt"></i>';
                                    html += '</button> &nbsp;';
                                }
                                });

                        
                        userFuns.forEach(function (item){
                            if(item.function=='del') {
                                html += '<button type="button" class="btn btn-icon btn-outline-' + item.color + ' waves-effect"  title="'+item.name+'" onclick="' + item.function + '(' + full['id'] + ')">';
                                html += '<i class="' + item.icon + '"></i>';
                                html += '</button> &nbsp;';
                            }
                        });
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
            buttons: [button],
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
        
        });

    }

    function actionMenu(func){
        if(func=='add') {
            $("#btn_add").css("display", "inline-block");
            add();
        }
            
    }
    function add(){
      
        $("#tai_san").attr("disabled", false);
        return_combobox_multi('#tai_san', baseHome + '/asset_issue/getAsset', 'Tài sản');
        var validator = $( "#dg" ).validate(); // reset form
        validator.resetForm();
        $(".error").removeClass("error"); // loại bỏ validate
        $("#updateinfo").modal('show');
        $(".modal-title").html('Thêm mới tài sản cấp phát cho nhân viên');
        $('#id_ts').val('');
        $('#nhan_vien').val('').change();
        $('#tai_san').val('').change();
        $('#dat_coc').val('');
        $('#ghi_chu').val('');
        url = baseHome + "/asset_issue/add";
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
    $("#btn_add").css("display", "none");
    userFuns.forEach(function (item){
        if(item.function == 'loaddata') { 
            $("#btn_add").css("display", "inline-block");
        }
    });
    
    var validator = $( "#dg" ).validate(); // reset form
    validator.resetForm();
    $(".error").removeClass("error"); // loại bỏ validate
    $(".modal-title").html('Cập nhật cấp phát tài sản');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/asset_issue/loaddata",
        success: function (data) {
            return_combobox_multi('#tai_san', baseHome + '/asset_issue/getAllAsset', 'Tài sản');
            $('#id').val(data.id);
            $("#tai_san").attr("disabled", true);
            $("#tai_san").val(data.tai_san);
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

function loadRecallAsset(id) {
    return_combobox_multi('#tai_san_th', baseHome + '/asset_issue/getAllAsset', 'Tài sản');
    return_combobox_multi('#nhan_vien_th', baseHome + '/asset_issue/getStaff', 'Nhân viên');
    $(".modal-title").html('Thu hồi tài sản');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/asset_issue/loaddata",
        success: function (data) {
            $('#id_cp').val(data.id);
            $('#id_tsth').val(data.tai_san);
            $("#tai_san_th").attr("disabled", true);
            $("#tai_san_th").val(data.tai_san).trigger('change');
            $("#nhan_vien_th").attr("disabled", true);
            $("#nhan_vien_th").val(data.nhan_vien).trigger('change');
            $('#tra_coc').val(formatCurrency(data.dat_coc.replace(/[,VNĐ]/g,'')));
            $('#ghi_chu_th').val('');
            url = baseHome + '/asset_issue/recoverAsset?id=' + id;
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

function saveth() {
    var myform = new FormData($("#dg_th")[0]);
    console.log(url);
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
                $('#thuhoi').modal('hide');
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


function del(id) {
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
                url: baseHome + "/asset_issue/del",
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


//format_number so_tien
$('.format_number').on('input', function(e){        
    $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g,'')));
  }).on('keypress',function(e){
    if(!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
  }).on('paste', function(e){    
    var cb = e.originalEvent.clipboardData || window.clipboardData;      
    if(!$.isNumeric(cb.getData('text'))) e.preventDefault();
  });
  function formatCurrency(number){
    var n = number.split('').reverse().join("");
    var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");    
    return  n2.split('').reverse().join('');
}

// function checkvali() {
//     var nhan_vien = $("#nhan_vien").val();
//     var tai_san = $("#tai_san").val();
//     var so_luong = Number($("#so_luong").val());
//     if(tai_san > 0){
//         $.ajax({
//             type: "POST",
//             dataType: "json",
//             data: { id: tai_san},
//             url: baseHome + "/taisancapphat/get_sltonkho",
//             success: function (data) {
//                 var nummax = Number(data.sl_tonkho);
//                  if(nhan_vien > 0 && tai_san > 0 && so_luong <= nummax && so_luong > 0) {
//                     $("#btn_add").attr("disabled", false);
//                 }else{
//                     $("#btn_add").attr("disabled", true);
//                 }
//             },
//             error: function () {
//                 notify_error('Lỗi truy xuất database');
//             }
//         });
//     }
// }

// function checkvali_th() {
//     var so_luong_th = Number($("#so_luong_th").val());
//     var id_cp = $("#id_cp").val();
//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         data: { id: id_cp},
//         url: baseHome + "/taisancapphat/get_slcp",
//         success: function (data) {
//             var nummax_th = Number(data.so_luong);
//             if(so_luong_th <= nummax_th && so_luong_th > 0) {
                
//                 $("#btn_add_th").attr("disabled", false);
//             }else{
               
//                 $("#btn_add_th").attr("disabled", true);
//             }
//         },
//         error: function () {
//             notify_error('Lỗi truy xuất database');
//         }
//     });
    
// }

