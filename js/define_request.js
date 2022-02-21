var defineId = '';
var url1 = '';
var url2 = '';
var step = 0;
var arrStep = [];
var stepIds = [];
$(function () {
    return_combobox_multi('#tham_chieu', baseHome + '/common/nhanvien', 'Lựa chọn người tham chiếu');
    return_combobox_multi('#xu_ly', baseHome + '/common/nhanvien', 'Lựa chọn người xử lý');
    "use strict";
    var dtUserTable = $(".user-list-table"),
        modal = $("#add-contract"),
        form = $("#dg"),
        modalstep = $('#step');
    // Users List datatable
    var buttons = [];

    if (funAdd == 1) {
        buttons.push({
            text: "Thêm mới",
            className: "add-new btn btn-" + 'primary' + " mt-50",
            init: function (api, node, config) {
                $(node).removeClass("btn-secondary");
            },
            action: function (e, dt, node, config) {
                showAdd();
            }
        });
    }
   
    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/define_request/list",
            ordering: true,
            columns: [
                // columns according to JSON
                { data: "name" },
                { data: "" },
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return '<a href="javascript:void(0)" onclick="loaddata(' + full["id"] + ')" >' +
                            '<span class="align-middle font-weight-bold" style="padding: 5px;">' + full["name"] + "</span></a>";
                    },
                    width: 200
                },

                {
                    targets: -1,
                    title: 'Thao tác',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        if (funEdit == 1) {
                            html += '<div d-flex justify-content-start style="width::150px;text-align:left">';
                            html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                            html += '<i class="fas fa-pencil-alt"></i>';
                            html += '</button> &nbsp;';
                        }
                        if (funDel == 1) {
                            html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="xoa(' + full['id'] + ')">';
                            html += '<i class="fas fa-trash-alt"></i>';
                            html += '</button></div>';
                        }

                        return html;
                    },
                    width: 100
                },
            ],
            // order: [[0, "desc"]],
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
                    infoFiltered: "(lọc từ _MAX_ bản ghi)",
                    sInfoEmpty : "Hiển thị 0 đến 0 của 0 bản ghi",                },
                    "oLanguage": {
                        "sZeroRecords": "Không có bản ghi nào"
                    },
            buttons: buttons,
            initComplete: function () {
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

//object
var x1 = 0

function addobjectbutton1() {
    var sttobj1 = $('#sttobj1').val();
    var j = Number(sttobj1) + 1;

    $('#sttobj1').val(j);
    $('#listobject1').append('<div class="row form-group" id="objupdate-' + j + '"><div class="col col-md-3"><input type="hidden" name="Oid[]" value=""></div><div class="col-12 col-md-7"><input type="text" name="object1[]" placeholder="Đối tượng" class="form-control object"></div><button type="button" class="btn btn-icon btn-outline-danger waves-effect " onclick="remove1(' + j + ')"><i class="fas fa-trash-alt"></i></button></div>'
    );
}

function removeobj(i) {
    $('#obj-' + i).remove();
}

function remove1(x1) {
    $('#objupdate-' + x1).remove();
}
//steps
function showStepButton() {
    $('#stepList').append(
        '<div data-repeater-item class="step-item" id="arr-' + step + '">' +
        '<div class = "row d-flex align-items-end" >' +
        '<div class="col-md-1 col-12" style="padding-right:0 !important;">' +
        '<div class="form-group">' +
        '<label for="thu_tu">Thứ Tự</label>' +
        '<input id="n_thu_tu' + step + '" name="n_thu_tu' + step + '" type="number" class="form-control" placeholder="Thứ tự" />' +
        '</div></div>' +
        '<div class="col-md-3 col-12" style="padding-right:0 !important;">' +
        '<div class="form-group">' +
        '<label for="itemname">Bước thực hiện</label>' +
        '<input type="text" class="form-control" id="n_ten_buoc' + step + '" placeholder="Nhập bước thực hiện" name="n_ten_buoc' + step + '" />' +
        '</div>' +
        '</div>' +
        '<input type="hidden" name="stid[]" value="">' +
        '<div class="col-md-3 col-12" style="padding-right:0 !important;">' +
        '<div class="form-group">' +
        '<label for="tham_chieu">Người tham chiếu</label>' +
        '<select id="n_tham_chieu' + step + '" class="select2 form-control" name="n_tham_chieu' + step + '">' +
        '</select> </div> </div><div class="col-md-4 col-12" style="padding-right:0 !important;">' +
        '<div class="form-group">' +
        '<label for="xu_ly">Người xử lý</label>' +
        '<select id="n_xu_ly' + step + '" class="select2 form-control" multiple="multiple" name="n_xu_ly' + step + '[]">' +
        '</select>' +
        '</div>' +
        '</div>' +
        '<div class="col-md-1 col-12" style="padding-right:0 !important;">' +
        '<div class="form-group">' +
        '<button class="btn btn-icon btn-outline-danger waves-effect remove-step" onclick="removestep(' + step + ')" data-repeater-delete type="button">' +
        '<i class="fas fa-trash-alt"></i>' +
        '</button>' +
        '</div>' +
        '</div>' +
        '</div >' +
        '<hr />' +
        '</div > '
    );

    return_combobox_multi('#n_tham_chieu' + step, baseHome + '/common/nhanvien', 'Lựa chọn người tham chiếu');
    return_combobox_multi('#n_xu_ly' + step, baseHome + '/common/nhanvien', 'Lựa chọn người xử lý');

    arrStep.push(step);
    step++;

}

function removestep(i) {
    $('#arr-' + i).remove();
    var index = arrStep.indexOf(i);
    if (index !== -1) {
        arrStep.splice(index, 1);
    }

}

function removeStepById(id) {
    $('#arrId-' + id).remove();
    var index = stepIds.indexOf(id);
    if (index !== -1) {
        stepIds.splice(index, 1);
    }

}

function showAdd() {
    arrStep = [];
    $("#info-contract").modal('show');
    $(".modal-title").html('Thêm yêu cầu mới');
    $('#name1').val('');
    $('#object1').val('');
    $('#listobject1').empty();
    $('#n_ten_buoc').val([]);
    $('#n_thu_tu').val([]);
    $('#n_tham_chieu').val([]).trigger('change');
    $('#n_xu_ly').val([]).trigger('change');
    $('#stepList').empty();
    url = baseHome + "/define_request/add";
    urlstep = baseHome + "/define_request/addstep";
}


function loaddata(id) {
    if (funEdit == 1) {
        $('#btnStep,#addobject1,#btnUpdate,#btnUpdate2').removeClass('d-none');
    } else {
        $('#btnStep,#addobject1,#btnUpdate,#btnUpdate2').addClass('d-none');
    }
    step = 0;
    arrStep = [];
    stepIds = [];
    $('#info-contract').modal('show');
    $('#information-tab').click();
    $(".modal-title").html('Cập nhật thông tin yêu cầu');
    defineId = id;
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/define_request/loaddata",
        success: function (data) {
            $('#iddefine').val(data.data.id);
            $('#name1').val(data.data.name);
            $("#listobject1").empty();
            x = data.object.length;
            for (var j = 0; j < x; j++) {
                if(funEdit == 1) {
                    var buttonDel = '<button type="button" class="btn btn-icon btn-outline-danger waves-effect remove-button" onclick="remove1(' + j + ')"><i class="fas fa-trash-alt"></i></button>';
                }
                $("#listobject1").append(
                    '<div class="row form-group" id="objupdate-' + j + '"><div class="col col-md-3"></div><div class="col-12 col-md-7"><input type="text" name="object1[]" value="' +
                    data.object[j]["name"] +
                    '" placeholder="Yêu cầu" class="form-control object"><input type="hidden" name="Oid[]" value="' +
                    data.object[j]["id"] +
                    '" placeholder="Yêu cầu" class="form-control object"></div>'+buttonDel+'</div></div>'
                );
            }

            $("#stepList").empty();
            s = data.step.length;
            // step=s-1;
            for (var J = 0; J < s; J++) {
                var buttonDelStep = '<button class="btn btn-icon btn-outline-danger waves-effect remove-step" onclick="removeStepById(' + data.step[J]["id"] + ')" data-repeater-delete type="button">';
                $("#stepList").append(
                    '<div data-repeater-item class="step-item" id="arrId-' + data.step[J]["id"] + '">' +
                    '<div class = "row d-flex align-items-end" >' +
                    '<div class="col-md-1 col-12" style="padding-right:0 !important;">' +
                    '<div class="form-group">' +
                    '<label for="thu_tu">Thứ Tự</label>' +
                    '<input id="thu_tu' + data.step[J]["id"] + '" name="thu_tu' + data.step[J]["id"] + '" type="number" class="form-control" placeholder="Thứ tự" value="' + data.step[J]["sortorder"] + '"/>' +
                    '</div></div>' +
                    '<div class="col-md-3 col-12" style="padding-right:0 !important;">' +
                    '<div class="form-group">' +
                    '<label for="itemname">Bước thực hiện</label>' +
                    '<input type="text" class="form-control" id="ten_buoc' + data.step[J]["id"] + '" placeholder="Nhập bước thực hiện" name="ten_buoc' + data.step[J]["id"] + '" value="' + data.step[J]["name"] + '"/>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-3 col-12" style="padding-right:0 !important;">' +
                    '<div class="form-group">' +
                    '<label for="tham_chieu">Người tham chiếu</label>' +
                    '<select selected id="tham_chieu' + data.step[J]["id"] + '" class="select2 form-control" name="tham_chieu' + data.step[J]["id"] + '" >' +
                    '</select> </div> </div><div class="col-md-4 col-12" style="padding-right:0 !important;">' +
                    '<div class="form-group">' +
                    '<label for="xu_ly">Người xử lý</label>' +
                    '<select selected " id="xu_ly' + data.step[J]["id"] + '" class="select2 form-control" multiple="multiple" name="xu_ly' + data.step[J]["id"] + '[]">' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-1 col-12" style="padding-right:0 !important;">' +
                    '<div class="form-group">' +
                     +
                    '<i class="fas fa-trash-alt"></i>' +buttonDelStep+
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div >' +
                    '<hr />' +
                    '</div > '

                );
                return_combobox_multi('#tham_chieu' + data.step[J]["id"], baseHome + '/common/nhanvien', 'Lựa chọn người tham chiếu');
                return_combobox_multi('#xu_ly' + data.step[J]["id"], baseHome + '/common/nhanvien', 'Lựa chọn người xử lý');
                $('#tham_chieu' + data.step[J]["id"]).val(data.step[J]["reviewerId"]).trigger('change');
                var $xuly = data.step[J]["processors"].split(",");
                $('#xu_ly' + data.step[J]["id"]).val($xuly).trigger('change');
                stepIds.push(data.step[J]["id"]);

            }
            url = baseHome + "/define_request/update?id=" + defineId;
            urlstep = baseHome + "/define_request/updatestep?defineId=" + defineId;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}


function update() {
    var frmdefine = new FormData($("#frm-1")[0]);
    $.ajax({
        type: "POST",
        dataType: "json",
        data: frmdefine,
        url: url,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                var frmstep = new FormData($("#frm-2")[0]);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: frmstep,
                    url: urlstep + '&stepArr=' + JSON.stringify(arrStep) + '&stepIds=' + stepIds,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.success) {
                            notyfi_success(data.msg);
                            $('#info-contract').modal('hide');
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
        cancelButtonText: 'Hủy',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: baseHome + "/define_request/del",
                type: 'post',
                dataType: "json",
                data: { id: id },
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.message);
                        $(".user-list-table").DataTable().ajax.reload(null, false);
                    } else
                        notify_error(data.message);
                },
            });
        }
    });
}