var url = '';
$(function () {
    "use strict";

    var dtUserTable = $(".user-list-table"),
        form = $("#dg");

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/bieumau/list",
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "ngaycapnhat" },
                { data: "name" },
                { data: "classify" },
                { data: "nguoinhap" },
                { data: "" },
            ],
            columnDefs: [
                {
                    targets: 0,
                    responsivePriority: 4,
                    visible: false,
                },
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        var $status = full["classify"];
                        if ($status == 1) {
                            return "<span>Hợp đồng</span>";
                        } else if ($status == 2) {
                            return "<span>Báo giá</span>";
                        } else if ($status == 3) {
                            return "<span>Đề nghị tạm ứng</span>";
                        } else if ($status == 4) {
                            return "<span>Đề nghị thanh toán</span>";
                        } else if ($status == 5) {
                            return "<span>Yêu cầu tuyển dụng</span>";
                        } else {
                            return '';
                        }
                    },
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" >';
                        html += '<a href="' + full["filename"] + '" >';
                        html += '<i class="fas fa-download"></i>';
                        html += '</a>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="xoa(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                        return html;
                    },
                    width: 150
                    // render: function (data, type, full, meta) {
                    //     return (
                    //         '<div class="btn-group">' +
                    //         '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
                    //         feather.icons["more-vertical"].toSvg({ class: "font-small-4" }) +
                    //         "</a>" +
                    //         '<div class="dropdown-menu dropdown-menu-right">' +
                    //         '<a href="javascript:void(0)" class="dropdown-item" data-toggle="modal" data-target="#updateinfo" onclick="loaddata(' + full["id"] + ')">' +
                    //         feather.icons["file-text"].toSvg({ class: "font-small-4 mr-50" }) +
                    //         "Xem/sửa</a>" +
                    //         '<a href="' + full["filename"] + '" class="dropdown-item delete-record" >' +
                    //         feather.icons["download"].toSvg({ class: "font-small-4 mr-50" }) +
                    //         "Tải xuống</a>" +
                    //         '<a href="javascript:void(0)" class="dropdown-item delete-record" onclick="xoa(' + full["id"] + ')">' +
                    //         feather.icons["trash-2"].toSvg({ class: "font-small-4 mr-50" }) +
                    //         "Xóa</a></div>" +
                    //         "</div>" +
                    //         "</div>"
                    //     );
                    // },
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
            // language: {
            //     sLengthMenu: "Show _MENU_",
            //     search: "Search",
            //     searchPlaceholder: "11111111112..",
            // },
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
                        $(".modal-title").html('Thêm biểu mẫu mới');
                        $('#name').val('');
                        $('#phan_loai').val('').change();
                        $('.custom-file-label').html('Chọn file');
                        url = baseHome + "/bieumau/add";
                    },
                },
            ],
            // For responsive popup
            // responsive: {
            //     details: {
            //         display: $.fn.dataTable.Responsive.display.modal({
            //             header: function (row) {
            //                 var data = row.data();
            //                 return "Details of " + data["name"];
            //             },
            //         }),
            //         type: "column",
            //         renderer: $.fn.dataTable.Responsive.renderer.tableAll({
            //             tableClass: "table",
            //             columnDefs: [
            //                 {
            //                     targets: 8,
            //                     visible: false,
            //                 },
            //                 {
            //                     targets: 1,
            //                     visible: false,
            //                 },
            //             ],
            //         }),
            //     },
            // },
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            initComplete: function () {
                // Adding role filter once table initialized
                // this.api()
                //     .columns(3)
                //     .every(function () {
                //         var column = this;
                //         var select = $('<select id="bm_phanloai" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Tình trạng </option></select>')
                //             .appendTo(".bm_phanloai")
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
                //                     $stt_output = "Hợp đồng";
                //                 } else if (d == 2) {
                //                     $stt_output = "Báo giá";
                //                 } else if (d == 3) {
                //                     $stt_output = "Đề nghị tạm ứng";
                //                 } else if (d == 4) {
                //                     $stt_output = "Đề nghị thanh toán";
                //                 } else if (d == 5) {
                //                     $stt_output = "Yêu cầu tuyển dụng";
                //                 }
                //                 if ($stt_output != '') {
                //                     select.append('<option value="' + d + '" class="text-capitalize">' + $stt_output + "</option>");
                //                 }
                //             });
                //     });

            },
        });

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
                "name": {
                    required: true,
                },
                "phan_loai": {
                    required: true,
                }
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
    $("#updateinfo").modal('show');
    $(".modal-title").html('Cập nhật thông tin biểu mẫu');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/bieumau/loaddata",
        success: function (data) {
            $('#name').val(data.name);
            $('#phan_loai').val(data.classify).change();
            $('.custom-file-label').html('Chọn file');
            url = baseHome + '/bieumau/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function savebm() {
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
                url: baseHome + "/bieumau/del",
                type: 'post',
                dataType: "json",
                data: { id: id },
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
    });
}

function tai(url) {
    window.location.href = url;
}
