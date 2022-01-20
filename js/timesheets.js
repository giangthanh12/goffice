$(function () {
    "use strict";

    return_combobox_multi('#month', baseHome + '/common/thang', 'Chọn nhân viên');
    return_combobox_multi('#year', baseHome + '/common/nam', 'Chọn loại khách hàng');
    $('#month').val(month).change();
    $('#year').val(year).change();

    var column = $('#tb-timesheets');
    // var month = $('#month').val();
    // var year = $('#year').val();
    column.append('<th style="width:180px">Nhân viên</th>');
    column.append('<th style="width:40px;text-align: center">Ngày công</th>');
    column.append('<th style="width:40px;text-align: center">Công chuẩn</th>');
    for (var i = 1; i <= 31; i++) {
        if (i < 10) { i = '0' + i; }
        var dt = new Date(year + '-' + month + '-' + i);
        if (dt.getDay() == 0) {
            column.append('<th style="width:40px;text-align: center" class="text-center">CN<br><div class="text-center">' + i +'</div></th>');
        } else if (dt.getDay() == 1) {
            column.append('<th style="width:40px;text-align: center">T2<br><div class="text-center">' + i +'</div></th>');
        } else if (dt.getDay() == 2) {
            column.append('<th style="width:40px;text-align: center">T3<br><div class="text-center">' + i +'</div></th>');
        } else if (dt.getDay() == 3) {
            column.append('<th style="width:40px;text-align: center">T4<br><div class="text-center">' + i +'</div></th>');
        } else if (dt.getDay() == 4) {
            column.append('<th style="width:40px;text-align: center">T5<br><div class="text-center">' + i +'</div></th>');
        } else if (dt.getDay() == 5) {
            column.append('<th style="width:40px;text-align: center">T6<br><div class="text-center">' + i +'</div></th>');
        } else {
            column.append('<th style="width:40px;text-align: center">T7<br><div class="text-center">' + i +'</div></th>');
        }
    }

    var dtUserTable = $(".user-list-table");

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            ajax: baseHome + "/timesheets/list?month="+month+"&year="+year,
            autoWidth: false,
            ordering: false,
            searching: false,
            paging: false,
            columns: [
                // columns according to JSON
                { data: "staffName" },
                { data: "workMonth" },
                { data: "totalWorkDate" },
                { data: "date_01" },
                { data: "date_02" },
                { data: "date_03" },
                { data: "date_04" },
                { data: "date_05" },
                { data: "date_06" },
                { data: "date_07" },
                { data: "date_08" },
                { data: "date_09" },
                { data: "date_10" },
                { data: "date_11" },
                { data: "date_12" },
                { data: "date_13" },
                { data: "date_14" },
                { data: "date_15" },
                { data: "date_16" },
                { data: "date_17" },
                { data: "date_18" },
                { data: "date_19" },
                { data: "date_20" },
                { data: "date_21" },
                { data: "date_22" },
                { data: "date_23" },
                { data: "date_24" },
                { data: "date_25" },
                { data: "date_26" },
                { data: "date_27" },
                { data: "date_28" },
                { data: "date_29" },
                { data: "date_30" },
                { data: "date_31" },
            ],
            columnDefs: [
                {
                    // User full name and username
                    targets: 0,
                    render: function (data, type, full, meta) {
                        var $name = full["staffName"],

                            $image = baseUrlFile+'/uploads/nhanvien/'+full["avatar"];
                        if ($image) {
                            // For Avatar image
                            var $output = '<img onerror=' + "this.src=''+baseHome+'/layouts/useravatar.png'" + ' src="' + $image + '" alt="Avatar" height="32" width="32">';
                            // var $output = '<img src="' + assetPath + "images/avatars/" + $image + '" alt="Avatar" height="32" width="32">';
                        } else {
                            // For Avatar badge
                            var stateNum = Math.floor(Math.random() * 6) + 1;
                            var states = ["success", "danger", "warning", "info", "dark", "primary", "secondary"];
                            var $state = states[stateNum],
                                $name = full["staffName"],
                                $initials = $name.match(/\b\w/g) || [];
                            $initials = (($initials.shift() || "") + ($initials.pop() || "")).toUpperCase();
                            $output = '<span class="avatar-content">' + $initials + "</span>";
                        }
                        var colorClass = $image === "" ? " bg-light-" + $state + " " : "";
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center" style="width: 220px;">' +
                            '<div class="avatar-wrapper">' +
                            '<div class="avatar ' +
                            colorClass +
                            ' mr-1">' +
                            $output +
                            "</div>" +
                            "</div>" +
                            '<div class="d-flex flex-column">' +
                            '<span class="font-weight-bold">' +
                            $name +
                            "</span>" +

                            "</div>" +
                            "</div>";
                        return $row_output;
                    },
                },
                {
                    targets: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33],
                    render: function (data, type, full, meta) {
                        var $color = '';
                        if(data==1){
                            $color='color:blue;font-weight:bold;';
                        }else if(data==0.5)
                            $color='color:red;';
                        return (
                            '<div class="text-center" style="width:45px;font-weight:bold; '+$color+'" >'+
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
    var month = $("#month").val();
    var year = $("#year").val();
    var column = $('#tb-timesheets');
    column.empty();
    // var month = $('#month').val();
    // var year = $('#year').val();
    column.append('<th style="width:180px">Nhân viên</th>');
    column.append('<th>Ngày công</th>');
    column.append('<th>Công chuẩn</th>');
    for (var i = 1; i <= 31; i++) {
        if (i < 10) { i = '0' + i; }
        var dt = new Date(year + '-' + month + '-' + i);
        if (dt.getDay() == 0) {
            column.append('<th style="width:40px" class="text-center">CN<br><div class="text-center">' + i +'</div></th>');
        } else if (dt.getDay() == 1) {
            column.append('<th style="width:40px">T2<br><div class="text-center">' + i +'</div></th>');
        } else if (dt.getDay() == 2) {
            column.append('<th style="width:40px">T3<br><div class="text-center">' + i +'</div></th>');
        } else if (dt.getDay() == 3) {
            column.append('<th style="width:40px">T4<br><div class="text-center">' + i +'</div></th>');
        } else if (dt.getDay() == 4) {
            column.append('<th style="width:40px">T5<br><div class="text-center">' + i +'</div></th>');
        } else if (dt.getDay() == 5) {
            column.append('<th style="width:40px">T6<br><div class="text-center">' + i +'</div></th>');
        } else {
            column.append('<th style="width:40px">T7<br><div class="text-center">' + i +'</div></th>');
        }
    }
    if (month != '' || year != '') {
        var table = $(".user-list-table").DataTable();
        table.ajax.url(baseHome + "/timesheets/list?month=" + month + "&year=" + year).load();
        table.draw();
    }
}

function add() {
    var month = $('#month').val();
    var year = $('#year').val();
    $.ajax({
        url: baseHome + "/timesheets/add",
        type: 'post',
        dataType: "json",
        data: { month: month, year: year },
        success: function (data) {
            if (data.code==200) {
                notyfi_success(data.message);
                $(".user-list-table").DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.message);
        },
    });
}

function update() {
    // alert(data);
    $('#modal-title').html('Chấm công cho nhân viên');
    $('#updateinfo').modal('show');
    if ($('.work-due-date').length) {
        $('.work-due-date').flatpickr({
            dateFormat: "d/m/Y",
            defaultDate: "today",
            allowInput:true,
            onReady: function (selectedDates, dateStr, instance) {
                if (instance.isMobile) {
                    $(instance.mobileInput).attr("step", null);
                }
            },
        });
    }
    // $('#staffName').val(data.staffName);
    // $('#revenueBonus').val(Comma(data.revenueBonus));
    // $('#tetBonus').val(Comma(data.tetBonus));
    // $('#otherBonus').val(Comma(data.otherBonus));
    // $('#insurance').val(Comma(data.insurance));
    // $('#advance').val(Comma(data.advance));
    // $('#tam_ung').val(data.tam_ung);
    url = baseHome + '/payrolls/update';
}