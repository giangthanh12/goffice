
$(function(){
    var chiase = $("#chiase");
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/common/nhanvien",
        success: function (data) {
            chiase.select2({
                data: data,
            });
        },
    });

    if (chiase.length) {
        chiase.each(function () {
            var $this = $(this);
            $this.wrap("<div class='position-relative'></div>").select2({
                placeholder: "Lựa chọn nhân viên",
                dropdownParent: $this.parent(),
                escapeMarkup: function (es) {
                    return es;
                },
            });
        });
    }
    'use strict';
    // var auth = check_token();
    // if(auth.responseJSON.success){
        render_table();
    // }else{
    //     setInterval(function(){
    //         notify_error(auth.responseJSON.msg);
    //         localStorage.removeItem('token');
    //         window.location.href = baseUrl + 'login';
    //     }, 100);
    // }
});
var buttons = [];
if(funAdd == 1) {
    buttons.push({
        text: "Thêm mới",
        className: "add-new btn btn-primary mt-50",
        init: function (api, node, config) {
            $(node).removeClass("btn-secondary");
        },
        action: function (e, dt, node, config) {
            add_tainguyen();
        },
    });
}
function render_table(){
    $('#list_tainguyen').DataTable({
        "processing": true,
        "serverSide": true,
        'serverMethod': 'post',
        ajax: baseHome + '/tainguyen/json?nhanvienid='+baseUser,
        columns: [
            { data: null },
            { data: 'name' },
            { data: 'chusohuu' },
            { data: 'phanloai' },
            { data: 'nhacungcap' },
            { data: 'nguoitao' },
            { data: 'id' }
        ],
        columnDefs: [
            {
                targets: 0,
                render: function(data, type, full, meta){
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                targets: 1,
                render: function(data, type, full, meta){
                    return '<a href="javascript:void(0)" class="user_name text-primary" onclick="detail('+full['id']+')"><span class="font-weight-bold">'+full['name']+'</span></a>'
                }
            },
            {
                targets: 6,
                render: function(data, type, full, meta){
                    var html = '';
                
                    if(baseUser == full['creatorId'] || baseUser == 1){
                    if(funShare == 1) {
                        html += '<button type="button" class="btn btn-icon btn-outline-success waves-effect" title="Chia sẻ" onclick="share_tainguyen('+full['id']+')">';
                        html += '<i class="fas fa-share-alt"></i>';
                        html += '</button> &nbsp;';
                    }
                    
                    if(funEdit == 1) {
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="edit_tainguyen('+full['id']+')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;'; 
                    }
                    
                    if(funDel == 1) {
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="del_tainguyen('+full['id']+')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                    }
                    
                    }
                      return html;
                    
                },
                width:150
            }
        ],
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
                },
            // Buttons with Dropdown
            buttons:buttons,
    });
}

function add_tainguyen(){
    window.location.href = './tainguyen/formadd';
}

function detail(idh){
    $('#exampleModalLabel').html('Chi tiết tài nguyên');
    $('#modals-slide-in').modal('show');
    var responseData = load_data(baseHome + '/tainguyen/detail_resource?id='+idh);
    responseData = JSON.parse(responseData.responseText);
    var Objdata = responseData.data[0];
    console.log(responseData);
    $('#tentainguyen').text(Objdata.name); $('#chusohuu').text(Objdata.chusohuu);
    $('#phanloai').text(Objdata.phanloai); $('#nhacungcap').text(Objdata.nhacungcap);
    $('#tendangnhap').text(Objdata.username); $('#matkhau').text(Objdata.password);
    $('#nguoitao').text(Objdata.nguoitao); $('#duongdan').text(Objdata.link);
    $('#ghichu').text(Objdata.note);
    //  $('#btn_edit').on('click', function(e){edit_tainguyen(idh)});
}

function edit_tainguyen(idh){
    window.location.href = './tainguyen/formedit?id='+idh;
}

function del_tainguyen(idh){
    // del_data_refresh_div(idh, baseHome + '/tainguyen/del', "Bạn có chắc chắn muốn xóa dữ liệu !", '#list_tainguyen');
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
                url: baseHome + "/tainguyen/del",
                type: 'post',
                dataType: "json",
                data: {id: idh},
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.message);
                        $("#list_tainguyen").DataTable().ajax.reload(null, false);
                    } else
                        notify_error(data.message);
                },
            });
        }
    });
}
   
function share_tainguyen(idh){
    
    // $nguoitao = $_REQUEST['nguoitao'];
    // if($nguoitao == $_SESSION['staffId']){
    $('#modal-title').html('Chia sẻ tài nguyên');
    $('#sharetainguyen').modal('show');
    $("#id").val(idh);
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: idh },
        url: baseHome + "/tainguyen/getnhanvien",
        success: function (result) {
            let val = '';
            val = result.split(',');
            $("#chiase").val(val).change();
           
        }
    })
    }
// }

function saveshare()
{
    var chiase = $("#chiase").val();
    var id = $("#id").val();
    console.log(chiase);
    let listnv = '';
    chiase.forEach(function (item) {
        listnv += item+',';
    });
    listnv = listnv.slice(0, -1);
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {id:id,nhanvien:listnv},
        url: baseHome + "/tainguyen/chiase",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#sharetainguyen').modal('hide');
                $(".list_tainguyen").DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
        error: function () {
            notify_error('Cập nhật không thành công');
        }
    });
}

$('#duongdan').on('click', function() {
 /* Get the text field */

 var copyText = document.getElementById("duongdan");

 /* Select the text field */
 copyText.select();
 copyText.setSelectionRange(0, 99999); /* For mobile devices */

 /* Copy the text inside the text field */
 navigator.clipboard.writeText(copyText.value);
 
 /* Alert the copied text */
 notyfi_success("Bạn đã copy đường dẫn thành công!");
})
