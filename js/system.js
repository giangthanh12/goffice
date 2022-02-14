$(function () {
    "use strict";
    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");
    var buttons = [];
    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/system/listObj",
            ordering: false,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "name" },
                { data: "value" },
                { data: "" },
            ],
            columnDefs: [
                {
                    targets: 0,
                    responsivePriority: 3,
                    visible: false,
                },
                {
                    // Actions
                    targets: 1,
                    width: 100
                },
                {
                    // Actions
                    targets: 2,
                    render: function (data, type, full, meta) {
                       
                        if (full['value'].indexOf('http:') == 0) {
                            if (full['id'] == 7) {
                               return '<img src="' + full['value'] + '" width="200px">';
                            }
                            else if (full['id'] == 8) {
                               return '<img src="' + full['value'] + '" width="70px">';
                            }
                        } else {
                            return full['value'];
                        }
                    },
                    width: 400
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        if (funEdit == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                            html += '<i class="fas fa-pencil-alt"></i>';
                            html += '</button> &nbsp;';
                        }
                        return html;
                    },
                    width: 100
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
                sLengthMenu: "Hiển thị _MENU_",
                search: "",
                searchPlaceholder: "Tìm kiếm...",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
                info: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
            },
            // Buttons with Dropdown
            buttons: buttons,
            initComplete: function () {
                // Adding role filter once table initialized

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
                "gia-tri": {
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
    $("#updateinfo").modal('show');

    if(id == 7 || id == 8){
        $("#logo").removeClass('d-none');
        $("#gia_tri").addClass('d-none');
    }else{
        $("#logo").addClass('d-none');
        $("#gia_tri").removeClass('d-none');
    }
    
    $(".modal-title").html('Cập nhật thông tin');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/system/loadInfo",
        success: function (data) {
            $('#name').val(data.name);
            $('#gia_tri').val(data.value);

            url = baseHome + '/system/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}


function save() {
    $('#fm').validate({
        messages: {
            "name": {
                required: "Bạn chưa nhập tên thông tin!",
            },
            "gia_tri": {
                required: "Bạn chưa nhập giá trị!",
            }
        },
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
                    if (data.success) {
                        notyfi_success(data.msg);
                        $('#updateinfo').modal('hide');
                        $(".user-list-table").DataTable().ajax.reload(null, false);
                    } else
                        notify_error(data.msg);
                }
            });
            return false;
        }
    });
    $('#fm').submit();
}
