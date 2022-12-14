var url = '';
$arrMenu = [];
$arrFunc = [];
$userId = 0;
ketqua = [];
$(function () {

    "use strict";

    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/common/listStaff",
        success: function (data) {
            $("#staffId").select2({
                data: data,
                dropdownParent: $("#staffId").parent(),
                language: {
                    noResults: function () {
                        return 'Không có kết quả';
                    }
                }, escapeMarkup: function (markup) {
                    return markup;
                }
            });
        },
    });

    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/common/listGroup",
        success: function (data) {
            $("#groupId").select2({
                data: data,
                dropdownParent: $("#groupId").parent(),
                language: {
                    noResults: function () {
                        return 'Không có kết quả';
                    }
                }, escapeMarkup: function (markup) {
                    return markup;
                }
            });
        },
    });
    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            ajax: baseHome + "/listusers/getAllData",
            ordering: false,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "username" },
                { data: "staffName" },
                { data: "groupName" },
                { data: "" },
            ],
            columnDefs: [
                {
                    targets: 0,
                    visible: false,
                },
                {
                    // Actions
                    targets: -1,
                    title: 'Thao tác',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="getData(' + full["id"] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Set roles" onclick="setRoles(' + full["id"] + ',' + full["groupId"] + ')">';
                        html += '<i class="fas fa-arrows-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="deleteUser(' + full["id"] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                        return html;
                    },
                    width: 180
                },
            ],
            dom:
                '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                ">t" +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                ">",
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
                        $("#staffId").val('').change();
                        $("#groupId").val('').change();
                        $(".modal-title").html('Thêm user mới');
                        $('#username').val('');
                        $('#password').val('');
                        $('#extNum').val('');
                        $('#sipPass').val('');
                        url = baseHome + "/listusers/add";
                    },
                },
            ],
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
                infoFiltered: "(lọc từ _MAX_ bản ghi)",
                sInfoEmpty: "Hiển thị 0 đến 0 của 0 bản ghi",
            },
            "oLanguage": {
                "sZeroRecords": "Không có bản ghi nào"
            },
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
                "user-fullname": {
                    required: true,
                },
                "user-name": {
                    required: true,
                },
                "user-email": {
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
var dataMenu;
function getData(id) {
    $("#updateinfo").modal('show');
    $(".modal-title").html('Sửa thông tin user');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/listusers/loadDataById",
        success: function (data) {
            $('#username').val(data.username);
            $('#staffId').val(data.staffId).change();
            $('#groupId').val(data.groupId).change();
            $('#extNum').val(data.extNum);
            $('#sipPass').val(data.sipPass);
            $('#password').val('');
            url = baseHome + '/listusers/update?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}
function save() {
    $('#fm').validate({
        errorClass: "error",
        rules: {
            "username": {
                required: true,
            },
            "groupId": {
                required: true,
            },

        },
        messages: {
            "username": {
                required: "Yêu cầu nhập tên đăng nhập!",
            },
            "groupId": {
                required: "Yêu cầu chọn nhóm",
            },


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
                    if (data.code == 200) {
                        notyfi_success(data.message);
                        $('#updateinfo').modal('hide');
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

function saveGroupRole() {
    var info = {};
    info.name = $("#name").val();
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
            if (data.msg)
                notyfi_success(data.msg);
            else
                notify_error('Cập nhật không thành công');
        }
    });
}

function setRoles(userId) {
    $("#setroles").modal('show');
    $("#title-2").html('Phân quyền');
    $arrFunc = [];
    $arrMenu = [];
    $userId = userId;
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { userId: userId },
        url: baseHome + "/listusers/getMenus",
        success: function (data) {
            dataMenu = data;
            $('#bodySetRoles').html('');
            $('#theadSetRoles').html('');
            $html = '';
            $thead = '';
            data.forEach(function (menu) {
                $level = '';
                for ($i = 0; $i < menu.level; $i++)
                    $level += '---';
                $function = menu.functions;
                $html += '<tr>' +
                    '<td>' + $level + menu.name;
                if (menu.level == 0) {
                    $html += '<div class="custom-control custom-checkbox">' +
                        '<input type="checkbox" class="custom-control-input" id="checkAll' + menu.id + '" onclick="checkAll(' + menu.id + ', this.checked, this)" />' +
                        '<label class="custom-control-label" for="checkAll' + menu.id + '">Chọn tất cả</label>' +
                        '</div>';
                    // check all checkbox selected items

                }
                $html += '</td>';
                $checkedMenu = '';
                $disableMenu = '';
                if (menu.checked == 1)
                    $checkedMenu = 'checked';
                if (menu.disable == 1)
                    $disableMenu = 'disabled';
                if (menu.checked == 1 && menu.disable != 1)
                    $arrMenu.push(menu.id);
                $html += '<td>' +
                    '<div class="custom-control custom-checkbox">' +
                    '<input type="checkbox" class="custom-control-input" ' + $checkedMenu + ' ' + $disableMenu + ' id="menu_' + menu.id + '" data-userId="' + userId + '" onclick="setMenuRole(' + menu.id + ',' + userId + ',this.checked)" />' +
                    '<label class="custom-control-label" for="menu_' + menu.id + '">View</label>' +
                    '</div>' +
                    '</td>';
                $function.forEach(function (func) {
                    $checkedFunc = '';
                    if (func.checked == 1)
                        $checkedFunc = 'checked';
                    $disabledFunc = '';
                    if (func.disable == 1)
                        $disabledFunc = 'disabled';
                    if (func.checked == 1 && func.disable != 1)
                        $arrFunc.push(func.id);
                    $html += '<td>' +
                        '<div class="custom-control custom-checkbox">' +
                        '<input type="checkbox" class="custom-control-input function_add' + menu.id + '" data-userId="' + userId + '" data-idfunction="' + func.id + '" ' + $checkedFunc + ' ' + $disabledFunc + ' id="function_' + func.id + '" onclick="setFunctionRole(' + func.id + ',' + userId + ',this.checked)" />' +
                        '<label class="custom-control-label" for="function_' + func.id + '">' + func.name + '</label>' +
                        '</div>' +
                        '</td>';
                })
                $html += '</tr>';

            })
            $('#bodySetRoles').html($html);
            console.log(checkAllCheckbox());
            // console.log($arrMenu);
            // console.log($arrFunc);
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}
//checkallselected


// checkall
function checkAllCheckbox() {
    let a = 0;
    $.each(dataMenu, function (index, menu) {
        if (menu.level == 0) {
            a = 0;
            ketqua = [];
            let dataMenuChild = dequy(dataMenu, menu.id);
            if (!$('#menu_' + Number(menu.id))[0].checked) 
                a++;
            $.each(dataMenuChild, function (index, menu) {
                if (!$('#menu_' + Number(menu))[0].checked)
                    a++;
                // $('#function_add'+menu).checked = true;
                $(".function_add" + Number(menu)).each(function () {
                    if (!this.checked)
                        a++;
                });
            })
            $('#checkAll' + Number(menu.id)).prop('checked', false);
            if(a==0) 
            $('#checkAll' + Number(menu.id)).prop('checked', true);
        }

    })
    return dataMenu;
}


function checkAll(cha, check, item) {
    ketqua = [];
    var dataMenuChild = dequy(dataMenu, cha)
    // có cha của hrm đi tìm các checkbox menu con
    if (check) {
        if (!$('#menu_' + Number(cha))[0].checked && !$('#menu_' + Number(cha))[0].disabled) {
            $('#menu_' + Number(cha)).prop('checked', true);
            setMenuRole(cha, $('#menu_' + Number(cha))[0].getAttribute('data-userId'), true)
        }

        $.each(dataMenuChild, function (index, menu) {

            if (!$('#menu_' + Number(menu))[0].checked && !$('#menu_' + Number(menu))[0].disabled) {
                console.log('ok');
                $('#menu_' + Number(menu)).prop('checked', true);
                setMenuRole(menu, $('#menu_' + Number(menu))[0].getAttribute('data-userId'), true);
            }
            // $('#function_add'+menu).checked = true;
            $(".function_add" + Number(menu)).each(function () {
                if (!this.checked && !this.disabled) {
                    this.checked = true;
                    setFunctionRole(this.getAttribute('data-userId'), 0, true);
                    setFunctionRole(this.getAttribute('data-idfunction'), this.getAttribute('data-userId'), true);
                }
            });
        })
        // console.log($('#menu_'+Number(cha))[0]);
    }
    else {
        if ($('#menu_' + Number(cha))[0].checked && !$('#menu_' + Number(cha))[0].disabled) {
            $('#menu_' + Number(cha)).prop('checked', false);
            setMenuRole(cha, $('#menu_' + Number(cha))[0].getAttribute('data-userId'), false)
        }
        $.each(dataMenuChild, function (index, menu) {
            if ($('#menu_' + Number(menu))[0].checked && !$('#menu_' + Number(menu))[0].disabled) {
                console.log('ok');
                $('#menu_' + Number(menu)).prop('checked', false);
                setMenuRole(menu, $('#menu_' + Number(menu))[0].getAttribute('data-userId'), false);
            }
            $(".function_add" + Number(menu)).each(function () {
                if (this.checked && !this.disabled) {
                    this.checked = false;
                    setFunctionRole(this.getAttribute('data-userId'), 0, false);
                    setFunctionRole(this.getAttribute('data-idfunction'), this.getAttribute('data-userId'), false);
                }
            });
        })
    }
}
function dequy(menus, parentid) {

    if (ketqua.length == 0) ketqua = [];
    $.each(menus, function (index, menu) {
        if (menu.parentId == parentid) {
            ketqua.push(menu.id);
            dequy(menus, menu.id);
        }
    });
    return ketqua;
}
function deleteUser(id) {
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
                url: baseHome + "/listusers/del",
                type: 'post',
                dataType: "json",
                data: { id: id },
                success: function (data) {
                    if (data.code == 200) {
                        notyfi_success(data.message);
                        $(".user-list-table").DataTable().ajax.reload(null, false);
                    }
                    else
                        notify_error(data.message);
                },
            });
        }
    });
}

function setFunctionRole(funcId, userId, check) {
    checkAllCheckbox();
    if (check) {
        $arrFunc.push(funcId.toString());
    } else {
        var index = $arrFunc.indexOf(funcId.toString());
        if (index !== -1) {
            $arrFunc.splice(index, 1);
        }
    }

    // $.ajax({
    //     url: baseHome + "/listusers/setFunctionRole",
    //     type: 'post',
    //     dataType: "json",
    //     data: { funcId:funcId,userId:userId,check:check},
    //     success: function (data) {
    //     },
    // });
}

function setMenuRole(menuId, userId, check) {
    checkAllCheckbox();
    if (check) {
        $arrMenu.push(menuId.toString());
    } else {
        var index = $arrMenu.indexOf(menuId.toString());
        if (index !== -1) {
            $arrMenu.splice(index, 1);
        }
    }
    // $.ajax({
    //     url: baseHome + "/listusers/setMenuRole",
    //     type: 'post',
    //     dataType: "json",
    //     data: { menuId:menuId,userId:userId,check:check},
    //     success: function (data) {
    //     },
    // });
}

function updateRoles() {
    // console.log($arrMenu);
    // console.log($arrFunc);
    $.ajax({
        url: baseHome + "/listusers/updateRoles",
        type: 'post',
        dataType: "json",
        data: { menus: $arrMenu, userId: $userId, functions: $arrFunc },
        success: function (data) {
            if (data.code == 200) {
                $("#setroles").modal('hide');
                notyfi_success(data.message);
                $(".user-list-table").DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.message);
        },
    });
}