$(function () {
    "use strict";

    return_combobox_multi('#thang', baseHome + '/common/thang', 'Chọn nhân viên');
    return_combobox_multi('#nam', baseHome + '/common/nam', 'Chọn loại khách hàng');
    $('#thang').val(thang).change();
    $('#nam').val(nam).change();

    var column = $('#tb-bangchamcong');
    // var thang = $('#thang').val();
    // var nam = $('#nam').val();
    column.append('<th style="width:180px">Nhân viên</th>');
    column.append('<th>Ngày công</th>');
    column.append('<th>Công chuẩn</th>');
    for (var i = 1; i <= 31; i++) {
        if (i < 10) { i = '0' + i; }
        var dt = new Date(nam + '-' + thang + '-' + i);
        if (dt.getDay() == 0) {
            column.append('<th style="width:40px" class="text-center">CN</th>');
        } else if (dt.getDay() == 1) {
            column.append('<th style="width:40px">Thứ 2<br><div class="text-center">' + i +'</div></th>');
        } else if (dt.getDay() == 2) {
            column.append('<th style="width:40px">Thứ 3<br><div class="text-center">' + i +'</div></th>');
        } else if (dt.getDay() == 3) {
            column.append('<th style="width:40px">Thứ 4<br><div class="text-center">' + i +'</div></th>');
        } else if (dt.getDay() == 4) {
            column.append('<th style="width:40px">Thứ 5<br><div class="text-center">' + i +'</div></th>');
        } else if (dt.getDay() == 5) {
            column.append('<th style="width:40px">Thứ 6<br><div class="text-center">' + i +'</div></th>');
        } else {
            column.append('<th style="width:40px">Thứ 7<br><div class="text-center">' + i +'</div></th>');
        }
    }

    var dtUserTable = $(".user-list-table");

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            ajax: baseHome + "/bangchamcong/list?thang="+thang+"&nam="+nam,
            autoWidth: false,
            ordering: false,
            searching: false,
            paging: false,
            columns: [
                // columns according to JSON
                { data: "nhanvien" },
                { data: "ngay_cong" },
                { data: "cong_chuan" },
                { data: "ngay_01" },
                { data: "ngay_02" },
                { data: "ngay_03" },
                { data: "ngay_04" },
                { data: "ngay_05" },
                { data: "ngay_06" },
                { data: "ngay_07" },
                { data: "ngay_08" },
                { data: "ngay_09" },
                { data: "ngay_10" },
                { data: "ngay_11" },
                { data: "ngay_12" },
                { data: "ngay_13" },
                { data: "ngay_14" },
                { data: "ngay_15" },
                { data: "ngay_16" },
                { data: "ngay_17" },
                { data: "ngay_18" },
                { data: "ngay_19" },
                { data: "ngay_20" },
                { data: "ngay_21" },
                { data: "ngay_22" },
                { data: "ngay_23" },
                { data: "ngay_24" },
                { data: "ngay_25" },
                { data: "ngay_26" },
                { data: "ngay_27" },
                { data: "ngay_28" },
                { data: "ngay_29" },
                { data: "ngay_30" },
                { data: "ngay_31" },
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return (
                            '<div style="width:180px" >'+
                            data +
                            '</div>'
                        );
                    },
                },
                {
                    targets: [1,2],
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="text-center" >'+
                            data +
                            '</div>'
                        );
                    },
                },
                {
                    targets: [3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33],
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="text-center" style="width:45px" >'+
                            data +
                            '</div>'
                        );
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
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            // Buttons with Dropdown
            buttons: [
                // {
                //     text: "Lập bảng",
                //     className: "add-new btn btn-primary mt-50",
                //     init: function (api, node, config) {
                //         $(node).removeClass("btn-secondary");
                //     },
                //     action: function (e, dt, node, config) {
                //         add();
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
        table.ajax.url(baseHome + "/bangchamcong/list?thang=" + thang + "&nam=" + nam).load();
        table.draw();
    }
}

function add() {
    var thang = $('#thang').val();
    var nam = $('#nam').val();
    $.ajax({
        url: baseHome + "/bangchamcong/add",
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