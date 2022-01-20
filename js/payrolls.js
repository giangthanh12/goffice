var url = '';
$(function () {
    "use strict";

    return_combobox_multi('#month', baseHome + '/common/thang', 'Chọn nhân viên');
    return_combobox_multi('#year', baseHome + '/common/nam', 'Chọn loại khách hàng');
    $('#month').val(month).change();
    $('#year').val(year).change();

    var dtUserTable = $(".user-list-table");
    var i = 0;
    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            ajax: baseHome + "/payrolls/list?month=" + month + "&year=" + year,
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
                {data: ""},
                {data: "staffName"},
                {data: "wokingDays"},
                {data: "basicSalary"},
                {data: "totalWorkDays"},
                {data: ""},
                {data: "allowance"},
                {data: "revenueBonus"},
                {data: "tetBonus"},
                {data: "otherBonus"},
                {data: ""},
                {data: "insurance"},
                {data: "advance"},
                {data: "totalSalary"}
            ],
            columnDefs: [
                {
                    // User full name and username
                    targets: 1,
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
                    // User full name and username
                    targets: [3, 6, 7, 8, 9, 11, 12],
                    render: function (data, type, full, meta) {
                        return (
                            '<div style="width:100px;text-align: right">' +
                            Comma(data) +
                            '</div>'
                        );
                    }
                },
                {
                    // User full name and username
                    targets: [2, 4],
                    render: function (data, type, full, meta) {
                        return (
                            '<div style="width:100px;text-align: center">' +
                            data +
                            '</div>'
                        );
                    }
                },
                {
                    // User full name and username
                    targets: 5,
                    render: function (data, type, full, meta) {
                        var $salary = ((full['basicSalary'] / full['wokingDays']) * full['totalWorkDays']).toFixed(0);
                        return (
                            '<div style="width:100px;text-align: right">' +
                            Comma($salary) +
                            '</div>'
                        );
                    }
                }, {
                    // User full name and username
                    targets: 10,
                    render: function (data, type, full, meta) {
                        var $salary = (full['basicSalary'] / full['wokingDays']) * full['totalWorkDays'];
                        var $provisionalSalary = parseFloat($salary) + parseFloat(full['allowance']) + parseFloat(full['revenueBonus']) + parseFloat(full['tetBonus']) + parseFloat(full['otherBonus']);
                        return (
                            '<div style="width:100px;text-align: right">' +
                            Comma($provisionalSalary.toFixed(0)) +
                            '</div>'
                        );
                    }
                }, {
                    // User full name and username
                    targets: 13,
                    render: function (data, type, full, meta) {
                        var $salary = (full['basicSalary'] / full['wokingDays']) * full['totalWorkDays'];
                        var $provisionalSalary = parseFloat($salary);
                        $provisionalSalary += parseFloat(full['allowance']);
                        $provisionalSalary += parseFloat(full['revenueBonus']);
                        $provisionalSalary += parseFloat(full['tetBonus']);
                        $provisionalSalary += parseFloat(full['otherBonus']);
                        var $totalSalary = $provisionalSalary;
                        $totalSalary -= parseFloat(full['insurance']);
                        $totalSalary -= parseFloat(full['insurance']);
                        return (
                            '<div style="width:100px;text-align: right">' +
                            Comma($totalSalary.toFixed(0)) +
                            '</div>'
                        );
                    }
                },
                {
                    targets: 0,
                    render: function (data, type, row, meta) {
                        var html = '';
                        if (row['status'] == 1) {
                            html +='<div style="width:85px;text-align: left">';
                            if(funCheck==1) {
                                html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Duyệt lương" onclick="checkPayRollById(' + row['id'] + ',\'' + row['staffName'] + '\')">';
                                html += '<i class="fas fa-check"></i>';
                                html += '</button> &nbsp;';
                            }
                            if(funEdit==1) {
                                html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + i + ')">';
                                html += '<i class="fas fa-pencil-alt"></i>';
                                html += '</button> &nbsp;';
                            }
                            html+='</div>'
                        }
                        i++;
                        return html;
                    }
                }
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
    var month = $("#month").val();
    var year = $("#year").val();
    if (month != '' || year != '') {
        var table = $(".user-list-table").DataTable();
        table.ajax.url(baseHome + "/payrolls/list?month=" + month + "&year=" + year).load();
        table.draw();
    }
}

function add() {
    var month = $('#month').val();
    var year = $('#year').val();
    $.ajax({
        url: baseHome + "/payrolls/addPayRolls",
        type: 'post',
        dataType: "json",
        data: {month: month, year: year},
        success: function (data) {
            if (data.code == 200) {
                notyfi_success(data.message);
                $(".user-list-table").DataTable().ajax.reload(null, false);
            } else
                notify_error(data.message);
        },
    });
}

function loaddata(i) {
   // alert(data);
    var table = $(".user-list-table").DataTable().data();
    var data = table[i];
    $('#modal-title').html('Điều chỉnh bảng lương');
    $('#updateinfo').modal('show');
    $('#staffName').val(data.staffName);
    $('#revenueBonus').val(Comma(data.revenueBonus));
    $('#tetBonus').val(Comma(data.tetBonus));
    $('#otherBonus').val(Comma(data.otherBonus));
    $('#insurance').val(Comma(data.insurance));
    $('#advance').val(Comma(data.advance));
    // $('#tam_ung').val(data.tam_ung);
    url = baseHome + '/payrolls/update?id=' + data.id;
}

function saveupdate() {
    $('#fm').validate({
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.code==200) {
                        notyfi_success(data.message);
                        $('#dgAccesspoint').modal('hide');
                        $(".user-list-table").DataTable().ajax.reload(null, false);
                    } else
                        notify_error(data.message);
                }
            });
            return false;
        }
    });
    $('#fm').submit();
}

function checkAll() {
    var month = $('#month').val();
    var year = $('#year').val();
    Swal.fire({
        title: 'Duyệt bảng lương',
        text: 'Bạn có chắc chắn muốn duyệt toàn bộ bảng lương tháng ' + month + '/' + year+'?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Tôi đồng ý',
        cancelButtonText:'Bỏ qua',
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
                data: {month: month, year: year},
                url: baseHome + '/payrolls/checkAll',
                success: function (data) {
                    if (data.code == 200) {
                        notyfi_success(data.message);
                        $('#updateinfo').modal('hide');
                        $(".user-list-table").DataTable().ajax.reload(null, false);
                    } else
                        notify_error(data.message);
                },
                error: function () {
                    notify_error('Cập nhật không thành công');
                }
            });
        }
    });
}
function checkPayRollById(id,staffName){
    var month = $('#month').val();
    var year = $('#year').val();
    Swal.fire({
        title: 'Duyệt bảng lương',
        text: 'Bạn có chắc chắn muốn duyệt bảng lương tháng ' + month + '/' + year +' của '+staffName+'?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Tôi đồng ý',
        cancelButtonText:'Bỏ qua',
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
                data: {id: id},
                url: baseHome + '/payrolls/checkPayRoll',
                success: function (data) {
                    if (data.code == 200) {
                        notyfi_success(data.message);
                        $('#updateinfo').modal('hide');
                        $(".user-list-table").DataTable().ajax.reload(null, false);
                    } else
                        notify_error(data.message);
                },
                error: function () {
                    notify_error('Cập nhật không thành công');
                }
            });
        }
    });
}