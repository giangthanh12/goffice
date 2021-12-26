var trinhdoObj = {};
var kinhnghiemObj = {};
var id = localStorage.getItem('dxid');
var tinhtrang = localStorage.getItem('tinhtrang');
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

    var basicPickr = $('.flatpickr-basic');

    if (basicPickr.length) {
        basicPickr.flatpickr({
            readonly: false,
            dateFormat: "d/m/Y",
        });
    }
});

function loaddata(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseApi + "/dexuattd/loaddetail",
        success: function (data) {
            $('#name').html(data.name);
            $('#vi_tri').html(data.vi_tri);
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
            $('#ung_tuyen').html(data.so_luong);
            $('#muc_luong').html(data.min_luong + ' VNĐ - ' + data.max_luong + ' VNĐ');
            $('#trung_tuyen').html(data.so_luong);
            $('#han_tuyen').html(data.han_tuyen);
            if (data.tinh_trang == 1) {
                $('#trang_thai').html('Chờ duyệt');
            } else if (data.tinh_trang == 2) {
                $('#trang_thai').html('Đã duyệt');
            } else if (data.tinh_trang == 3) {
                $('#trang_thai').html('Không duyệt');
            } else if (data.tinh_trang == 4) {
                $('#trang_thai').html('Hết hạn');
            } else if (data.tinh_trang == 5) {
                $('#trang_thai').html('Đang tuyển');
            }

            // else if (data.trang_thai == 3) {
            //     $('#trang_thai').html('Không được duyệt');
            // }
            if (data.ly_do == 1) {
                $('#ly_do').html('Tuyển mới');
            } else if (data.ly_do == 2) {
                $('#ly_do').html('Tuyển thay thế');
            } else if (data.ly_do == 3) {
                $('#ly_do').html('Khác');
            }
            if (data.chien_dich) {
                $('#chien_dich').html(data.chien_dich);
            }
            $('#mo_ta').html(data.mo_ta);
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

function edit_dxtd() {
    if (tinhtrang == 1) {
        window.location.href = './dexuattd/edit';
    }
}

function noTime() {
    if ($("#notime").is(':checked')) {
        $('#hantuyen').attr("disabled", true);
    } else {
        $('#hantuyen').attr("disabled", false);
    }
}

function duyet() {
    $('#duyetdx').modal('show');
}

function saveduyet() {
    var info = {};
    info.id = id;
    info.so_luong = $('#soluong').val();
    if ($('#hantuyen').is('[disabled!=disabled]'))
        info.han_tuyen = $('#hantuyen').val();
    info.min_luong = $('#minluong').val();
    info.max_luong = $('#maxluong').val();
    info.mo_ta = $('#mota').val();
    $.ajax({
        url: baseApi + "/dexuattd/duyet",
        type: 'post',
        dataType: "json",
        data: info,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
            }
            else
                notify_error(data.msg);
        },
    });
}

function hoanduyet() {
    Swal.fire({
        title: 'Hoàn duyệt',
        text: "Bạn có chắc chắn muốn hoàn duyệt không!",
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
                url: baseApi + "/dexuattd/hoanduyet",
                type: 'post',
                dataType: "json",
                data: { id: id },
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.msg);
                        loaddata(id);
                    }
                    else
                        notify_error(data.msg);
                },
            });
        }
    });
}

function noduyet() {
    $.ajax({
        url: baseApi + "/dexuattd/noduyet",
        type: 'post',
        dataType: "json",
        data: { id: id },
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                loaddata(id);
            }
            else
                notify_error(data.msg);
        },
    });
}

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
                url: baseApi + "/dexuattd/del",
                type: 'post',
                dataType: "json",
                data: { id: id },
                success: function (data) {
                    if (data.success) {
                        window.location.href = './dexuattd';
                    } else
                        notify_error(data.msg);
                },
            });
        }
    });
}