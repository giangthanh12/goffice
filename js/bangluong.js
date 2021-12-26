var url = '';
$(function () {
    "use strict";

    return_combobox_multi('#thang', baseHome + '/common/thang', 'Chọn nhân viên');
    return_combobox_multi('#nam', baseHome + '/common/nam', 'Chọn loại khách hàng');
    $('#thang').val(thang).change();
    $('#nam').val(nam).change();

    var dtUserTable = $(".user-list-table");

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            ajax: baseHome + "/bangluong/list?thang=" + thang + "&nam=" + nam,
            autoWidth: false,
            ordering: false,
            fixedColumns: true,
            searching: false,
            paging: false,
            select: {
                style: 'single'
            },
            fixedHeader: true,
            scrollX: true,
            columns: [
                { data: "nhan_vien" },
                { data: "ngay_cong_chuan" },
                { data: "luong" },
                { data: "kpi" },
                { data: "luong_kpi" },
                { data: "cham_cong" },
                { data: "luong_tg" },
                { data: "phu_cap" },
                { data: "thuong_ds" },
                { data: "thuong_lt" },
                { data: "thuong_khac" },
                { data: "tong" },
                { data: "bao_hiem" },
                { data: "tam_ung" },
                { data: "thuc_linh" },
            ],
            columnDefs: [
                {
                    // User full name and username
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return (
                            '<div style="width:180px" >' +
                            data +
                            '</div>'
                        );
                    },
                    width: 150
                },
                {
                    targets: 1,

                },
                {
                    targets: 2,

                },
                {
                    targets: 4,

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
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            // Buttons with Dropdown
            buttons: [
                // {
                //     text: "Thêm mới",
                //     className: "add-new btn btn-primary mt-50",
                //     init: function (api, node, config) {
                //         $(node).removeClass("btn-secondary");
                //     },
                //     action: function (e, dt, node, config) {
                //         $("#addinfo").modal('show');
                //         $(".modal-title").html('Thêm khách hàng mới');
                //         $('#name').val('');
                //         $('#ten_day_du').val('');
                //         $('#dai_dien').val('');
                //         $('#dien_thoai').val('');
                //         $('#email').val('');
                //         $('#website').val('');
                //         $('#van_phong').val('');
                //         $('#dia_chi').val('');
                //         $('#ma_so').val('');
                //         $('#chuc_vu').val('');
                //         $('#linh_vuc').val('').change();
                //         $('#loai').val(0).change();
                //         $('#phu_trach').val('').change();
                //         $('#tinh_trang').val('1').attr("disabled", true);
                //         $('#phan_loai').val('1').attr("disabled", true);
                //         $('#ghi_chu').val('');
                //     },
                // },
            ],
            initComplete: function () {
                // Adding role filter once table initialized
                // this.api()
                //     .columns(4)
                //     .every(function () {
                //         var column = this;
                //         var select = $('<select id="kh_tinhtrang" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Tình trạng </option></select>')
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
                //                     $stt_output = "Khách hàng mới";
                //                 } else if (d == 2) {
                //                     $stt_output = "Đang sử dụng dịch vụ";
                //                 } else if (d == 4) {
                //                     $stt_output = "Đã dừng dùng dịch vụ";
                //                 }
                //                 if ($stt_output != '') {
                //                     select.append('<option value="' + d + '" class="text-capitalize">' + $stt_output + "</option>");
                //                 }
                //             });
                //     });

            },
        });

    }

});

function search() {
    var thang = $("#thang").val();
    var nam = $("#nam").val();
    if (thang != '' || nam != '') {
        var table = $(".user-list-table").DataTable();
        table.ajax.url(baseHome + "/bangluong/list?thang=" + thang + "&nam=" + nam).load();
        table.draw();
    }
}

function lapbang() {
    var thang = $('#thang').val();
    var nam = $('#nam').val();
    $.ajax({
        url: baseHome + "/bangluong/checkduyet",
        type: 'post',
        dataType: "json",
        data: { thang: thang, nam: nam },
        success: function (data) {
            if (data.code==200) {
                $.ajax({
                    url: baseHome + "/bangluong/lapbang",
                    type: 'post',
                    dataType: "json",
                    data: { thang: thang, nam: nam },
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
            else
                notify_error(data.message);
        },
    });
}

function update() {
    var table = $(".user-list-table").DataTable();
    var data = $.map(table.rows('.selected').data(), function (item) {
        return item
    });
    if(data.tinh_trang>0){
        return false;
        notify_error('Bảng lương đã duyệt không thể điều chỉnh');
    }
    if (data != '') {
        $('#modal-title').html('Điều chỉnh bảng lương');
        data = data[0];
        $('#updateinfo').modal('show');
        $('#nhan_vien').val(data.nhan_vien);
        $('#thuong_ds').val(data.thuong_ds);
        $('#thuong_lt').val(data.thuong_lt);
        $('#thuong_khac').val(data.thuong_khac);
        // $('#tam_ung').val(data.tam_ung);
        url = baseHome + '/bangluong/update?id=' + data.id;
    } else {
        notify_error('Không có bản ghi nào được chọn');
    }
}

function saveupdate() {
    var info = {};
    info.thuong_ds = $("#thuong_ds").val();
    info.thuong_lt = $("#thuong_lt").val();
    info.thuong_khac = $("#thuong_khac").val();
    // info.tam_ung = $("#tam_ung").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: url,
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

function duyet() {
    var thang = $('#thang').val();
    var nam = $('#nam').val();
    Swal.fire({
        title: 'Duyệt bảng lương',
        text: 'Bạn có chắc chắn muốn duyệt bảng lương tháng '+thang+'/'+nam,
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
                data: {thang: thang, nam: nam},
                url: baseHome+'/bangluong/duyet',
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
    });
}