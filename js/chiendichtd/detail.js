var trinhdoObj = {};
var kinhnghiemObj = {};
var id = localStorage.getItem('cdid');
var tinhtrang = localStorage.getItem('tinhtrang');
var nguonuv = '';
$(function () {
    loaddata(id);

    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseApi + "/dexuattd/trinhdouv",
        success: function (data) {
            trinhdoObj = data;
        },
    });
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseApi + "/dexuattd/kinhnghiemuv",
        success: function (data) {
            kinhnghiemObj = data;
        },
    });
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseApi + "/nguonuv/combo",
        success: function (data) {
            data.forEach(function (val, index) {
                var opt = '<option value="' + val.id + '">' + val.text + '</option>';
                nguonuv += opt;
                $('.nguonuv').append(opt);
            });
        },
    });

    var basicPickr = $('.flatpickr-basic');

    if (basicPickr.length) {
        basicPickr.flatpickr({
            readonly: false,
            dateFormat: "d/m/Y",
        });
    }

    $('#table_sp').on("click", ".remove-button", function (e) {
        e.preventDefault();
        $(this).parent().parent().remove();
        // x--;
        // showButton();
    })

    $('.chiphi').on("keyup",function (e) {
        console.log($(this).val());
    })

});
 
function loadchiphi(e){
    console.log($(e.target));
}

function loaddata(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseApi + "/chiendichtd/loaddetail",
        success: function (data) {
            $('#name').html(data.name);
            $('#thoi_gian').html(data.ngay_bat_dau + ' - ' + data.ngay_ket_thuc);
            $('#ung_tuyen').html(data.so_luong);
            $('#trung_tuyen').html(data.so_luong);
            $('#con_lai').html(data.so_luong);
            $('#vi_tri').html(data.vi_tri);
            $('#chi_phi_du_kien').html(data.chi_phi_du_kien);
            $('#chi_phi_thuc_te').html(data.chi_phi_thuc_te);
            $('#phong_ban').html(data.phong_ban);
            $('#chi_nhanh').html(data.chi_nhanh);
            if (data.hinh_thuc_lam_viec == 1) {
                $('#hinh_thuc').html('Core team');
            } else if (data.hinh_thuc_lam_viec == 2) {
                $('#hinh_thuc').html('Hành chính');
            } else if (data.hinh_thuc_lam_viec == 3) {
                $('#hinh_thuc').html('Part chiều');
            }
            $('#so_luong').html(data.so_luong);
            $('#muc_luong').html(data.min_luong + ' VNĐ - ' + data.max_luong + ' VNĐ');
            $('#han_tuyen').html(data.han_tuyen);
            if (data.tinh_trang == 1) {
                $('#trang_thai').html('Lên kế hoạch');
            } else if (data.tinh_trang == 2) {
                $('#trang_thai').html('Đang thực hiện');
            } else if (data.tinh_trang == 3) {
                $('#trang_thai').html('Hoàn thành');
            } else if (data.tinh_trang == 4) {
                $('#trang_thai').html('Quá hạn');
            }

            $('#mo_ta').html(data.mo_ta);
            $('#nguoi_phu_trach').html(data.nguoi_phu_trach);

            if (data.gioi_tinh == 1) {
                $('#gioi_tinh').html('Nam');
            } else if (data.gioi_tinh == 2) {
                $('#gioi_tinh').html('Nữ');
            } else if (data.gioi_tinh == 3) {
                $('#gioi_tinh').html('Không yêu cầu');
            }
            $('#do_tuoi').html('Từ ' + data.min_tuoi + ' đến ' + data.max_tuoi + ' tuổi');
            $('#chieu_cao').html('Từ ' + data.min_cao + ' đến ' + data.max_cao + ' cm');
            $('#can_nang').html('Từ ' + data.min_nang + ' đến ' + data.max_nang + ' kg');
            trinhdoObj.forEach(function (e) {
                if (e.id == data.trinh_do) {
                    $('#trinh_do').html(e.text);
                }
            })
            kinhnghiemObj.forEach(function (e) {
                if (e.id == data.kinh_nghiem) {
                    $('#kinh_nghiem').html(e.text);
                }
            })
            $('#chuyen_nganh').html(data.chuyen_nganh);
            // Modal
            $('#soluong').val(data.so_luong);

            if (data.han_tuyen != '00/00/0000') {
                $('#hantuyen').val(data.han_tuyen);
            } else {
                $("#notime").prop("checked", true).change();
            }
            $('#minluong').val(data.min_luong);
            $('#maxluong').val(data.max_luong);
            $('#mota').val(data.mo_ta);
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function edit_cdtd() {
    window.location.href = './chiendichtd/edit';
}

function noTime() {
    if ($("#notime").is(':checked')) {
        $('#hantuyen').attr("disabled", true);
    } else {
        $('#hantuyen').attr("disabled", false);
    }
}

function ngansach() {
    $('#ngansach').modal('show');
}

function addngansach() {
    $('#table_sp').append('<tr class="pt-1"><td class="pr-1"><select name="nguon_uv[]" class="form-control nguonuv" >' + nguonuv + '</select></td><td class="pr-1"><input type="text" name="tong_cv" class="form-control input format_number" value="0" readonly></td><td class="pr-1"><input type="text" name="chi_phi[]" class="form-control input format_number" value="" onkeyup="loadchiphi()"></td><td class="pr-1"><input type="text" name="binh_quan" class="form-control input format_number" value="0" readonly></td><td><i class="fas fa-trash-alt remove-button"></td></tr>');

}

// function duyet() {
//     $('#duyetdx').modal('show');
// }

// function saveduyet() {
//     var info = {};
//     info.id = id;
//     info.so_luong = $('#soluong').val();
//     if ($('#hantuyen').is('[disabled!=disabled]'))
//         info.han_tuyen = $('#hantuyen').val();
//     info.min_luong = $('#minluong').val();
//     info.max_luong = $('#maxluong').val();
//     info.mo_ta = $('#mota').val();
//     $.ajax({
//         url: baseApi + "/dexuattd/duyet",
//         type: 'post',
//         dataType: "json",
//         data: info,
//         success: function (data) {
//             if (data.success) {
//                 notyfi_success(data.msg);
//             }
//             else
//                 notify_error(data.msg);
//         },
//     });
// }

// function hoanduyet() {
//     Swal.fire({
//         title: 'Hoàn duyệt',
//         text: "Bạn có chắc chắn muốn hoàn duyệt không!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonText: 'Đồng ý',
//         customClass: {
//             confirmButton: 'btn btn-primary',
//             cancelButton: 'btn btn-outline-danger ml-1'
//         },
//         buttonsStyling: false
//     }).then(function (result) {
//         if (result.value) {
//             $.ajax({
//                 url: baseApi + "/dexuattd/hoanduyet",
//                 type: 'post',
//                 dataType: "json",
//                 data: { id: id },
//                 success: function (data) {
//                     if (data.success) {
//                         notyfi_success(data.msg);
//                         loaddata(id);
//                     }
//                     else
//                         notify_error(data.msg);
//                 },
//             });
//         }
//     });
// }

// function noduyet() {
//     $.ajax({
//         url: baseApi + "/dexuattd/noduyet",
//         type: 'post',
//         dataType: "json",
//         data: { id: id },
//         success: function (data) {
//             if (data.success) {
//                 notyfi_success(data.msg);
//                 loaddata(id);
//             }
//             else
//                 notify_error(data.msg);
//         },
//     });
// }

function del() {
    Swal.fire({
        title: 'Xóa dữ liệu',
        text: "Bạn có chắc chắn muốn xóa!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Đồng ý',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: baseApi + "/chiendichtd/del",
                type: 'post',
                dataType: "json",
                data: { id: id },
                success: function (data) {
                    if (data.success) {
                        window.location.href = './chiendichtd';
                    } else
                        notify_error(data.msg);
                },
            });
        }
    });
}