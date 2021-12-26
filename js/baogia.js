var url = '';

$(function () {


    var dtUserTable = $(".user-list-table"),
        
        modal = $("#updateinfo"),
        form = $("#dg"),
        statusObj = {
            0: { title: "Xoá", class: "badge-light-warning" },
            1: { title: "Mới tạo", class: "badge-light-secondary" },
            2: { title: "Đang chờ", class: "badge-light-warning" },
            3: { title: "Đã chốt", class: "badge-light-info" },
            4: { title: "Hợp đồng", class: "badge-light-success" },
            5: { title: "Hủy", class: "badge-light-danger" },
        };

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/baogia/list",
            columns: [
                // columns according to JSON
                // { data: "" },
                { data: "ngay" },
                { data: "khach_hang" },
                { data: "nhan_vien" },
                { data: "noi_dung" },
                { data: "tien_sau_ck" },
                { data: "tinh_trang" },
                { data: ".." },
            ],
            columnDefs: [
                {

                },
                {
                    // User full name and username
                    targets: 1,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full["khach_hang"];
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="d-flex flex-column">' +
                            '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ')" data-toggle="modal" data-target="#updateinfo" class="user_name"><span class="font-weight-bold">' +
                            $name +
                            "</span></a>" +
                            
                            "</div>" +
                            "</div>";
                        return $row_output;
                    },
                },

                {
                    // User Status
                    targets: 5,
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

                        var tinhtrang = full['tinh_trang'];
                        var html = '';
						html += '<div style="width:200px;text-align:right;float: right;">';
                        if (tinhtrang != 4){
                            html += '<button type="button" class="btn btn-icon btn-outline-success waves-effect" data-toggle="tooltip"  data-placement="top" title="Tạo đơn hàng" onclick="loadbaogia(' + full['id'] + ')">';
                            html += '<i class="fas fa-cart-plus"></i>';
                            html += '</button> &nbsp;';
                        }
                        html += '<button type="button" class="btn btn-icon btn-outline-warning waves-effect" data-toggle="tooltip"  data-placement="top" title="Chăm sóc báo giá" onclick="chamsocbaogia(' + full['id'] + ')">';
                        html += '<i class="far fa-calendar-check"></i>';
                        html += '</button> &nbsp;';
                        
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" data-toggle="modal" data-target="#updateinfo" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="xoa(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button></div>';
                        return html;
                    },
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
                        $(".modal-title").html('Thêm mới');
                        $("#table_sp").empty();
                        $("#viewfile").empty();
                        var dateObj = new Date();
                        var thang = dateObj.getMonth();
                        thang =thang+1;
                        thang = thang > 9 ? thang : '0' + thang;
                        var ngay = dateObj.getDate();
                        ngay = ngay > 9 ? ngay : '0' + ngay;
                        var dateToUse = dateObj.getFullYear() + "-" + thang + "-" + ngay;
						 
                        $('#ngay').val(dateToUse);
                        $('#tong_donhang').val('');
                        $('#chiet_khau').val('');
                        $('#thanh_toan').val('');
                        $('#file').val('');
                        $('#tinh_trang').val(0);
                        $('#tinh_trang').trigger("change");
                        $('#khach_hang').val(0);
                        $('#khach_hang').trigger("change");
                        $('#nhan_vien').val(0);
                        $('#nhan_vien').trigger("change");
                        $('#dich_vu').val(0);
                        $('#dich_vu').trigger("change");
                        $('#san_pham').val(0);
                        $('#san_pham').trigger("change");
                        
                        $('.btn-add').attr("disabled", true);
                      
                       
                        $('#ghi_chu').val('');

                        url = baseHome + "/baogia/add";
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
                

                    
            },
        });

    }

 
    var nhan_vien = $('#nhan_vien');
    var khach_hang = $('#khach_hang');
    var dich_vu = $('#dich_vu');
    var san_pham = $('#san_pham');
    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/baogia/nhanvien",
        success: function (data) {
            nhan_vien.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: nhan_vien.parent(),
            width: '100%',
            data: data
            });
        },
    });

    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/baogia/khachhang",
        success: function (data) {
            khach_hang.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: khach_hang.parent(),
            width: '100%',
            data: data
            });
        },
    });

    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/baogia/dichvu",
        success: function (data) {
            dich_vu.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: dich_vu.parent(),
            width: '100%',
            data: data
            });
        },
    });

    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/baogia/sanpham",
        success: function (data) {
            san_pham.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: san_pham.parent(),
            width: '100%',
            data: data
            });
        },
    });

    var status_cskh = $('#status_cskh');
    $.ajax({ 
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/baogia/status_cskh",
        success: function (data) {
            status_cskh.wrap('<div class="position-relative"></div>').select2({
            dropdownAutoWidth: true,
            dropdownParent: status_cskh.parent(),
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
    $(".modal-title").html('Sửa báo giá');
    $("#table_sp").empty();
    $("#viewfile").empty();
    $(".custom-file-label").html('');

    $('#tong_donhang').val('0');
    $('#chiet_khau').val('0');
    $('#thanh_toan').val('0');

    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/baogia/loaddata",
        success: function (data) {
            var baogia = data.baogia;
            $("#id").val(baogia.id);
            $("#ngay").val(baogia.ngay);
            $("#khach_hang").val(baogia.khach_hang).trigger('change');
            $("#nhan_vien").val(baogia.nhan_vien).trigger('change');
            $("#tinh_trang").val(baogia.tinh_trang).trigger('change');
            $("#tong_donhang").val(baogia.tien_truoc_ck);
            $("#chiet_khau").val(baogia.chiet_khau);
            $("#thanh_toan").val(baogia.tien_sau_ck);
            $("#ghi_chu").val(baogia.noi_dung);
            $('#dich_vu').val(0);
            $('#dich_vu').trigger("change");
            $('#san_pham').val(0);
            $('#san_pham').trigger("change");

            var dv_child = data.baogiasub;
            for(let i=0;i< dv_child.length;i++){
                $('#stt').val(i);
                $('#table_sp').append('<tr id="arr'+i+'"><td>'+dv_child[i].name+'</td><td><input type="text" id="don_gia'+i+'" onkeyup="load_tien('+i+')" name="don_gia[]" class="form-control input format_number" value="'+dv_child[i].don_gia+'"></td><td><input type="hidden" name="id_sp[]" id="id_sp['+i+']" value="'+dv_child[i].dich_vu+'"></input><input type="hidden" name="loai[]" id="loai['+i+']" value="0"></input><input type="text" onkeyup="load_tien('+i+')" name="so_luong[]" id="so_luong'+i+'" value="1" class="form-control input" ></td><td><input type="text" id="chiet_khau'+i+'" onkeyup="load_tien('+i+')" name="chiet_khau_tm[]" class="form-control input format_number" value="'+dv_child[i].chiet_khau_tm+'"></td><td><select name="thue[]" id="thue'+i+'" class="thue'+i+' form-control" onchange="load_tien('+i+')"><option value="0">Không</option><option value="5">5%</option><option value="10">10%</option></select></td><td><input type="text" id="tien_thue'+i+'" name="tien_thue[]" onkeyup="load_tien('+i+')" value="'+dv_child[i].thue_vat+'" class="form-control input format_number"></td><td><input type="date" id="ngay_s" name="ngay_s[]" class="form-control" placeholder="Ngày bắt đầu" value="'+dv_child[i].tu_ngay+'"  ><input type="date" id="ngay_e" name="ngay_e[]" class="form-control" style="margin-top:4px" placeholder="Ngày kết thúc" value="'+dv_child[i].den_ngay+'"> </td><td><input type="text" id="thanh_tien'+i+'" name="thanh_tien[]" class="form-control input  format_number" value="'+dv_child[i].thanh_tien+'" readonly></td><td><a  onclick="remove_tr('+i+');return false"><i class="fas fa-trash-alt"></i></a></td></tr>');

                $("#thue"+i).val(dv_child[i].thue_vat).trigger('change');
               
            }
           
            var name_file = baogia.dinh_kem;
                name_file = name_file.split("/");
                name_file = name_file[name_file.length - 1];
            if(name_file !=""){
                $('#viewfile').append('<p><i class="fas fa-trash" aria-hidden="true" onclick="xoafile('+baogia.id+')"></i><a target="_blank" href="/goffice/users/gemstech/'+baogia.dinh_kem+'">'+name_file+'<i class="fas fa-download"></i></a></p>');
            }
            url = baseHome + '/baogia/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}








function savetk() {
    var myform = new FormData($("#dg")[0]);

    if (url == baseHome + '/donhang/add'){
        //di den link donhang
        $.ajax({
            type: "POST",
            dataType: "json",
            data: myform,
            url: url,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.success) {
                    window.location.href='donhang';
                }
                else
                    notify_error(data.msg);
            },
            error: function () {
                notify_error('Cập nhật không thành công');
            }
        });
    }
    else{
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
                url: baseHome + "/baogia/del",
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

function xoafile(id){
    Swal.fire({
        title: 'Xóa file đính kèm',
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
                type: "POST",
                dataType: "json",
                data: {id:id},
                url: baseHome + "/baogia/xoafile",
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.msg);
                        $("#viewfile").empty();
                    }
                    else
                        notify_error(data.msg);
                },
                error: function () {
                    notify_error('Cập nhật không thành công');
                }
            });
        }
    });
}


function load_dichvu(){
    var id = $('#dich_vu').val();
    var khach_hang = $('#khach_hang').val();
    var nhan_vien = $('#nhan_vien').val();
    if(khach_hang >0 && nhan_vien>0){
        $(".btn-add").attr("disabled", false);
    }else{
        $(".btn-add").attr("disabled", true);
    }
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id},
        url: baseHome + "/baogia/load_dichvu",
        success: function (data) {
            var stt = $('#stt').val();
            var i =  Number(stt) + 1;
            $('#stt').val(i);
            $('#table_sp').append('<tr id="arr'+i+'"><td>'+data.name+'</td><td><input type="text" id="don_gia'+i+'" onkeyup="load_tien('+i+')" name="don_gia[]" class="form-control input format_number" value="'+data.don_gia+'"></td><td><input type="hidden" name="id_sp[]" id="id_sp['+i+']" value="'+data.id+'"></input><input type="hidden" name="loai[]" id="loai['+i+']" value="0"></input><input type="text" onkeyup="load_tien('+i+')" name="so_luong[]" id="so_luong'+i+'" value="1" class="form-control input" ></td><td><input type="text" id="chiet_khau'+i+'" onkeyup="load_tien('+i+')" name="chiet_khau_tm[]" class="form-control input format_number" value="0"></td><td><select name="thue[]" id="thue'+i+'" class="thue'+i+' form-control" onchange="load_tien('+i+')"><option value="0">Không</option><option value="5">5%</option><option value="10">10%</option></select></td><td><input type="text" id="tien_thue'+i+'" name="tien_thue[]" onkeyup="load_tien('+i+')" value="'+data.thue_vat+'" class="form-control input format_number"></td><td><input type="date" id="ngay_s" name="ngay_s[]" class="form-control" placeholder="Ngày bắt đầu" ><input type="date" id="ngay_e" name="ngay_e[]" class="form-control" style="margin-top:4px" placeholder="Ngày kết thúc"> </td><td><input type="text" id="thanh_tien'+i+'" name="thanh_tien[]" class="form-control input  format_number" readonly></td><td><a  onclick="remove_tr('+i+');return false"><i class="fas fa-trash-alt"></i></a></td></tr>');
            
            $('#dich_vu').val(0);
            $('#dich_vu').trigger("change");
            $('#san_pham').val(0);
            $('#san_pham').trigger("change");
            $("#thue"+i).val(data.tax).trigger('change');
        },
        error: function () {
        }
    });
    
}

function load_sanpham(){
    var id = $('#san_pham').val();
    var khach_hang = $('#khach_hang').val();
    var nhan_vien = $('#nhan_vien').val();
    if(khach_hang >0 && nhan_vien>0){
        $(".btn-add").attr("disabled", false);
    }else{
        $(".btn-add").attr("disabled", true);
    }
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id},
        url: baseHome + "/baogia/load_sanpham",
        success: function (data) {
            var stt = $('#stt').val();
            var i =  Number(stt) + 1;
            $('#stt').val(i);

            $('#table_sp').append('<tr id="arr'+i+'"><td>'+data.name+'</td><td><input type="text" id="don_gia'+i+'" onkeyup="load_tien('+i+')" name="don_gia[]" class="form-control input format_number" value="'+data.don_gia+'"></td><td><input type="hidden" name="id_sp[]" id="id_sp['+i+']" value="'+data.id+'"></input><input type="hidden" name="loai[]" id="loai['+i+']" value="1"></input><input type="text" onkeyup="load_tien('+i+')" name="so_luong[]" id="so_luong'+i+'" value="1" class="form-control input" ></td><td><input type="text" id="chiet_khau'+i+'" onkeyup="load_tien('+i+')" name="chiet_khau_tm[]" class="form-control input format_number" value="0"></td><td><select name="thue[]" id="thue'+i+'" class="thue'+i+' form-control" onchange="load_tien('+i+')"><option value="0">Không</option><option value="5">5%</option><option value="10">10%</option></select></td><td><input type="text" id="tien_thue'+i+'" name="tien_thue[]" onkeyup="load_tien('+i+')" value="'+data.thue_vat+'" class="form-control input format_number"></td><td><input type="date" id="ngay_s" name="ngay_s[]" class="form-control" placeholder="Ngày bắt đầu" ><input type="date" id="ngay_e" name="ngay_e[]" class="form-control" style="margin-top:4px" placeholder="Ngày kết thúc"> </td><td><input type="text" id="thanh_tien'+i+'" name="thanh_tien[]" class="form-control input  format_number" readonly></td><td><a  onclick="remove_tr('+i+');return false"><i class="fas fa-trash-alt"></i></a></td></tr>');
            $('#dich_vu').val(0);
            $('#dich_vu').trigger("change");
            $('#san_pham').val(0);
            $('#san_pham').trigger("change");
            $("#thue"+i).val(data.tax).trigger('change');

        },
        error: function () {
        }
    });
    
}




function remove_tr(i){
    $("#arr"+i).remove();
    tong_thanh_toan();
}

function load_tien(i){
    var chiet_khau = $("#chiet_khau"+i).val();
    chiet_khau = chiet_khau.replace(/,/g,'');
    var tax = Number($("#thue"+i).val());
    var tien_dv = $("#don_gia"+i).val();
    tien_dv = tien_dv.replace(/,/g,'');
    var so_luong = Number($("#so_luong"+i).val());
    var tien_thue = $("#tien_thue"+i).val();
    tien_thue = tien_thue.replace(/,/g,'');

   
    if(tax == 0){
         tienthue = 0;
    }else{
         tienthue = (tien_dv-chiet_khau)*so_luong*tax/100;
    }
    thanhtien = (tien_dv*so_luong)+tienthue-chiet_khau;
    $("#chiet_khau"+i).val(formatCurrency(chiet_khau+''.replace(/[,VNĐ]/g,'')));
    $("#don_gia"+i).val(formatCurrency(tien_dv+''.replace(/[,VNĐ]/g,'')));
    $("#tien_thue"+i).val(formatCurrency(tienthue+''.replace(/[,VNĐ]/g,'')));
    $("#thanh_tien"+i).val(formatCurrency(thanhtien+''.replace(/[,VNĐ]/g,'')));

    tong_thanh_toan();
}

function tong_thanh_toan(){
    var thanhtien = 0;
    $("input[name='thanh_tien[]']")
    .map(function(){
       thanhtien+=Number($(this).val().replace(/,/g,'')); 
    });
    $('#tong_donhang').val(formatCurrency(thanhtien+''.replace(/[,VNĐ]/g,'')));

    var chiet_khau = $('#chiet_khau').val();
        chiet_khau = Number(chiet_khau.replace(/,/g,''));
    var thanh_toan = $('#thanh_toan').val();
    thanh_toan = Number(thanh_toan.replace(/,/g,''));
    thanh_toan = thanhtien - chiet_khau;
    $('#thanh_toan').val(formatCurrency(thanh_toan+''.replace(/[,VNĐ]/g,'')));

}



function check_form(){
    var khach_hang = $('#khach_hang').val();
    var nhan_vien = $('#nhan_vien').val();
    var thanh_toan = $('#thanh_toan').val();

    if(khach_hang >0 && nhan_vien>0 && thanh_toan != ""){
        $(".btn-add").attr("disabled", false);
    }else{
        $(".btn-add").attr("disabled", true);
    }

}



function chamsocbaogia(id){
    $('#chamsocbaogia').modal('show');
	$(".modal-title").html('Chăm sóc báo giá');
    $('#id_bg').val(id);
    $(".btn-add").attr("disabled", true);
    load_lichsuchamsoc(id);
}
function load_lichsuchamsoc(id){
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id},
        url: baseHome + "/baogia/lichsuchamsoc",
        success: function (data) {
            $('#listnhatky').html('');
            data.map(data => {
                return $('#listnhatky').append('<div class="media mb-1"><div class="avatar bg-light-success my-0 ml-0 mr-50"><img src="' + data.hinh_anh + '" alt="Avatar" height="32" /></div><div class="media-body"><p class="mb-0"><span class="font-weight-bold">' + data.nhan_vien + '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small class="text-muted">' + data.ngay_gio + '</small></p><span class="badge badge-pill badge-light-success" text-capitalized="">'+data.status+'</span><p>' + data.ghi_chu + '</p></div></div>');
            });

        },
        error: function () {
        }
    });
}

function add_chamsoc(){
    var id = $('#id_bg').val();
    var myform = new FormData($("#dg-chamsocbaogia")[0]);
    $.ajax({
        type: "POST",
        dataType: "json",
        data: myform,
        url: baseHome + "/baogia/add_chamsoc",
        contentType: false,
        processData: false,
        success: function (data) {
            $('#ghi_chu_care').val('');
            $(".btn-add").attr("disabled", true);
            load_lichsuchamsoc(id);
        },
        error: function () {
        }
    });
    
}
function check_ghichu_csbg(){
    var ghichu = $('#ghi_chu_care').val();
    if(ghichu == ''){
        $(".btn-add").attr("disabled", true);
    }else{
        $(".btn-add").attr("disabled", false);
    }
}









function loadbaogia(id) {
    $('#updateinfo').modal('show');
    $(".modal-title").html('Tạo đơn hàng');
    $("#table_sp").empty();
    $("#viewfile").empty();
    $(".custom-file-label").html('');
    $('#tong_donhang').val('0');
    $('#chiet_khau').val('0');
    $('#thanh_toan').val('0');

    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/baogia/loaddata",
        success: function (data) {
            var baogia = data.baogia;
            $("#id").val(baogia.id);
            $("#ngay").val(baogia.ngay);
            $("#khach_hang").val(baogia.khach_hang).trigger('change');
            $("#nhan_vien").val(baogia.nhan_vien).trigger('change');
            $("#tinh_trang").val(baogia.tinh_trang).trigger('change');
            $("#tong_donhang").val(baogia.tien_truoc_ck);
            $("#chiet_khau").val(baogia.chiet_khau);
            $("#thanh_toan").val(baogia.tien_sau_ck);
            $("#ghi_chu").val(baogia.noi_dung);
            $('#dich_vu').val(0);
            $('#dich_vu').trigger("change");
            $('#san_pham').val(0);
            $('#san_pham').trigger("change");

            var dv_child = data.baogiasub;
            for(let i=0;i< dv_child.length;i++){
                $('#stt').val(i);
                $('#table_sp').append('<tr id="arr'+i+'"><td>'+dv_child[i].name+'</td><td><input type="text" id="don_gia'+i+'" onkeyup="load_tien('+i+')" name="don_gia[]" class="form-control input format_number" value="'+dv_child[i].don_gia+'"></td><td><input type="hidden" name="id_sp[]" id="id_sp['+i+']" value="'+dv_child[i].dich_vu+'"></input><input type="hidden" name="loai[]" id="loai['+i+']" value="0"></input><input type="text" onkeyup="load_tien('+i+')" name="so_luong[]" id="so_luong'+i+'" value="1" class="form-control input" ></td><td><input type="text" id="chiet_khau'+i+'" onkeyup="load_tien('+i+')" name="chiet_khau_tm[]" class="form-control input format_number" value="'+dv_child[i].chiet_khau_tm+'"></td><td><select name="thue[]" id="thue'+i+'" class="thue'+i+' form-control" onchange="load_tien('+i+')"><option value="0">Không</option><option value="5">5%</option><option value="10">10%</option></select></td><td><input type="text" id="tien_thue'+i+'" name="tien_thue[]" onkeyup="load_tien('+i+')" value="'+dv_child[i].thue_vat+'" class="form-control input format_number"></td><td><input type="date" id="ngay_s" name="ngay_s[]" class="form-control" placeholder="Ngày bắt đầu" value="'+dv_child[i].tu_ngay+'"  ><input type="date" id="ngay_e" name="ngay_e[]" class="form-control" style="margin-top:4px" placeholder="Ngày kết thúc" value="'+dv_child[i].den_ngay+'"> </td><td><input type="text" id="thanh_tien'+i+'" name="thanh_tien[]" class="form-control input  format_number" value="'+dv_child[i].thanh_tien+'" readonly></td><td><a  onclick="remove_tr('+i+');return false"><i class="fas fa-trash-alt"></i></a></td></tr>');

                $("#thue"+i).val(dv_child[i].thue_vat).trigger('change');
               
            }
            var base_url = window.location.origin;
            var name_file = baogia.dinh_kem;
                name_file = name_file.split("/");
                name_file = name_file[name_file.length - 1];
            if(name_file !=""){
                $('#viewfile').append('<p><i class="fas fa-trash" aria-hidden="true" onclick="xoafile('+baogia.id+')"></i><a target="_blank" href="'+base_url+'/users/gemstech/'+baogia.dinh_kem+'">'+name_file+'<i class="fas fa-download"></i></a></p>');
            }
            url = baseHome + '/donhang/add';
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}






