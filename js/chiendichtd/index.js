
$(function () {
    localStorage.removeItem('cdid');
    localStorage.removeItem('tinhtrang');
    'use strict';
    render_table();
});

function render_table() {
    $('#list_chiendichtd').DataTable({
        "processing": true,
        "serverSide": true,
        'serverMethod': 'post',
        ajax: baseApi + '/chiendichtd/list',
        columns: [
            { data: 'nguoi_tao' },
            { data: 'ma_cd' },
            { data: 'name' },
            { data: 'tinh_trang' },
            { data: 'vi_tri' },
            { data: 'ngay_bat_dau' },
            { data: 'ngay_ket_thuc' },
            { data: 'so_luong' },
            { data: 'so_luong' },
            { data: 'so_luong' },
            { data: 'so_luong' }
        ],
        columnDefs: [
            {
                targets: 0,
                width: 180
            },
            {
                targets: 1,
                render: function (data, type, full, meta) {
                    return '<div class="d-flex flex-column">' +
                        '<a href="javascript:void(0)" onclick="detail(' + full["id"] + ',' + full["tinh_trang"] + ')" class="user_name text-truncate"><span class="font-weight-bold">' +
                        full["ma_cd"] +
                        "</span></a>" +
                        "</div>";
                }
            },
            {
                targets: 2,
                render: function (data, type, full, meta) {
                    return '<div class="d-flex flex-column">' +
                        '<a href="javascript:void(0)" onclick="detail(' + full["id"] + ',' + full["tinh_trang"] + ')" class="user_name text-truncate"><span class="font-weight-bold">' +
                        full["name"] +
                        "</span></a>" +
                        "</div>";
                }
            },
            {
                targets: 3,
                render: function (data, type, full, meta) {
                    var $status = full["tinh_trang"];
                    if ($status == 1) {
                        return 'Lên kế hoạch';
                    } else if ($status == 2) {
                        return 'Đang thực hiện';
                    } else if ($status == 2) {
                        return 'Hoàn thành';
                    } else if ($status == 3) {
                        return 'Quá hạn';
                    }
                }
            },
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
        // Buttons with Dropdown
        buttons: [
            {
                text: "Thêm mới",
                className: "add-new btn btn-primary mt-50",
                init: function (api, node, config) {
                    $(node).removeClass("btn-secondary");
                },
                action: function (e, dt, node, config) {
                    add_dxtd();
                },
            }
        ],
        language: {
            paginate: {
                // remove previous & next text from pagination
                previous: "&nbsp;",
                next: "&nbsp;",
            },
        },
    });
}

function add_dxtd() {
    window.location.href = './chiendichtd/add';
}

function detail(idh, tinhtrang) {
    localStorage.setItem('cdid', idh);
    localStorage.setItem('tinhtrang', tinhtrang);
    window.location.href = './chiendichtd/detail';
}

// function del_tainguyen(idh){
//     del_data_refresh_div(idh, baseApi + '/tainguyen/del', "Bạn có chắc chắn muốn xóa dữ liệu !", '#list_tainguyen');
// }

// function share_tainguyen(idh){
//     $('#modal-title').html('Chia sẻ tài nguyên');
//     $('#sharetainguyen').modal('show');
//     $("#id").val(idh);
//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         data: { id: idh },
//         url: baseApi + "/tainguyen/getnhanvien",
//         success: function (result) {
//             let val = '';
//             val = result.split(',');
//             $("#chiase").val(val).change();

//         }
//     })

// }

// function saveshare()
// {
//     var chiase = $("#chiase").val();
//     var id = $("#id").val();
//     console.log(chiase);
//     let listnv = '';
//     chiase.forEach(function (item) {
//         listnv += item+',';
//     });
//     listnv = listnv.slice(0, -1);
//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         data: {id:id,nhanvien:listnv},
//         url: baseApi + "/tainguyen/chiase",
//         success: function (data) {
//             if (data.success) {
//                 notyfi_success(data.msg);
//                 $('#sharetainguyen').modal('hide');
//                 $(".list_tainguyen").DataTable().ajax.reload(null, false);
//             }
//             else
//                 notify_error(data.msg);
//         },
//         error: function () {
//             notify_error('Cập nhật không thành công');
//         }
//     });
// }