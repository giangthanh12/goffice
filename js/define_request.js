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
        form = $("#dg");
    modalstep = $('#step')
    // Users List datatable
    var button = [];
    let i = 0;
    userFuns.forEach(function (item, index) {
        if (item.type == 1) {
            button[i] = {
                text: item.name,
                className: "add-new btn btn-primary mt-50",
                init: function (api, node, config) {
                    $(node).removeClass("btn-secondary");
                },
                action: function (e, dt, node, config) {
                    actionMenu(item.function);
                }
            };
            i++;
        }
    })

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
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<div d-flex justify-content-start style="width::150px;text-align:left">';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" id="confirm-text" onclick="xoa(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button></div>';
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
                sLengthMenu: "Show _MENU_",
                search: "Tìm kiếm",
                searchPlaceholder: "Từ khóa..",
                paginate: {
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            buttons: [{
                text: "Thêm mới",
                className: "add-new btn btn-primary mt-50",

                init: function (api, node, config) {
                    $(node).removeClass("btn-secondary");
                },

                action: function (e, dt, node, config) {
                    actionMenu('add');
                }
            }],
            initComplete: function () {
            },
        });
    }
    function actionMenu(func) {
        if (func == 'add')
            showAdd();

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
var x = 0;
var x1 = 0

function addobjectbutton() {
    var sttobj = $('#sttobj').val();
    var i = Number(sttobj) + 1;

    $('#sttobj').val(i);
    $('#listobject').append('<div class="row form-group" id="obj-' + i + '"><div class="col col-md-3"></div><div class="col-12 col-md-7"><input type="text" name="object[]" placeholder="Yêu cầu" class="form-control object"></div><button type="button" class="btn btn-icon btn-outline-danger waves-effect " onclick="removeobj(' + i + ')"><i class="fas fa-trash-alt"></i></button></div>'
    );

}

function addobjectbutton1() {
    var sttobj1 = $('#sttobj1').val();
    var j = Number(sttobj1) + 1;

    $('#sttobj1').val(j);
    $('#listobject1').append('<div class="row form-group" id="objupdate-' + j + '"><div class="col col-md-3"><input type="hidden" name="Oid[]" value=""></div><div class="col-12 col-md-7"><input type="text" name="object1[]" placeholder="Yêu cầu" class="form-control object"></div><button type="button" class="btn btn-icon btn-outline-danger waves-effect " onclick="remove1(' + j + ')"><i class="fas fa-trash-alt"></i></button></div>'
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
        '<input id="n_thu_tu'+ step +'" name="n_thu_tu' + step + '" type="number" class="form-control" placeholder="Thứ tự" />' +
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
    $("#add-contract").modal('show');
    $(".modal-title").html('Thêm yêu cầu mới');
    $('#name').val('');
    $('#object').val('')
    $('#listobject').empty();
    url = baseHome + "/define_request/add";
}


function loaddata(id) {
    step =0;
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
                $("#listobject1").append(
                    '<div class="row form-group" id="objupdate-' + j + '"><div class="col col-md-3"></div><div class="col-12 col-md-7"><input type="text" name="object1[]" value="' +
                    data.object[j]["name"] +
                    '" placeholder="Yêu cầu" class="form-control object"><input type="hidden" name="Oid[]" value="' +
                    data.object[j]["id"] +
                    '" placeholder="Yêu cầu" class="form-control object"></div><button type="button" class="btn btn-icon btn-outline-danger waves-effect remove-button" onclick="remove1(' + j + ')"><i class="fas fa-trash-alt"></i></button></div></div>'
                );
            }

            $("#stepList").empty();
            s = data.step.length;
            // step=s-1;
            for (var J = 0; J < s; J++) {
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
                    '<button class="btn btn-icon btn-outline-danger waves-effect remove-step" onclick="removeStepById(' + data.step[J]["id"] + ')" data-repeater-delete type="button">' +
                    '<i class="fas fa-trash-alt"></i>' +
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
            url1 = baseHome + "/define_request/update?id=" + defineId;
            url2 = baseHome + "/define_request/updatestep?defineId=" + defineId;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}


// function loadstep(id) {
//     $("#insertinfostep").modal('show');
//     $(".modal-title-step").html('Thông tin bước thực hiện');
//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         data: { id: id },
//         url: baseHome + "/define_request/loadstep",
//         success: function (data) {
//             $('#step').val(data.step);
//             $('#ten_buoc').val(data.name);
//             $('#thu_tu').val(data.sortorder);
//             $('#tham_chieu').val(data.reviewerId).trigger("change");
//             $('#xu_ly').val(data.processors).trigger("change");

//             url = baseHome + '/define_request/updatestep?id=' + id;
//         },
//         error: function () {
//             notify_error('Lỗi truy xuất database');
//         }
//     });
// }

// function geturl() {
//     var id = $('#iddefine').val();
//     url = baseHome + '/define_request/update?id=' + id;
//     console.log(url);
// }

// function geturlstep() {
//     url = baseHome + '/define_request/updatestep';
//     console.log(url);
// }

function save() {
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
                $('#add-contract').modal('hide');
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

function update() {
    var frm1 = new FormData($("#frm-1")[0]);
    $.ajax({
        type: "POST",
        dataType: "json",
        data: frm1,
        url: url1,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                var frm2 = new FormData($("#frm-2")[0]);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: frm2,
                    url: url2+'&stepArr='+JSON.stringify(arrStep)+'&stepIds='+stepIds,
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
            } else
                notify_error(data.msg);
        },
        error: function () {
            notify_error('Cập nhật không thành công');
        }
    });
}

function savestp() {
    // var info = {};
    // info.stid = $("myformStep").val();
    // info.iddefine = $("iddefine").val();
    // info.ten_buoc = $("ten_buoc").val();
    // info.thu_tu = $("thu_tu").val();
    // info.tham_chieu = $("tham_chieu").val();
    // info.xu_ly = $("xu_ly").val();
    // console.log(info);
    var myformStep = new FormData($("#dgStep")[0]);
    $.ajax({
        type: "POST",
        dataType: "json",
        data: myformStep,
        url: url,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
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