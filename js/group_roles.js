var url = '';
$arrMenu = [];
$arrFunc = [];
$groupId = 0;
ketqua = [];
$(function () {

    "use strict";

    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        form = $("#dg");

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            ajax: baseHome + "/group_roles/list",
            ordering: false,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "name" },
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
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="getGroupRole(' + full["id"] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        // html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="setRoles(' + full["id"] + ')">';
                        // html += '<i class="fas fa-arrows-alt"></i>';
                        // html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="deleteGroupRole(' + full["id"] + ')">';
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
                        addGroupRole();
                        url = baseHome + "/group_roles/addGroupRole";
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
                info:"Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
                infoFiltered: "(lọc từ _MAX_ bản ghi)",
                sInfoEmpty : "Hiển thị 0 đến 0 của 0 bản ghi",                },
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
    // if (form.length) {
    //     form.validate({
    //         errorClass: "error",
    //         rules: {
    //             "name": {
    //                 required: true,
    //             },
               
    //         },
    //         message: {
    //             "name": {
    //                 required: "Yêu cầu nhập tên nhóm!",
    //             },
    //         }
    //     });

    //     form.on("submit", function (e) {
    //         var isValid = form.valid();
    //         e.preventDefault();
    //         if (isValid) {
    //             // modal.modal("hide");
    //             saveGroupRole()
    //         }
    //     });
    // }

    // To initialize tooltip with body container
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
        container: "body",
    });
});
var dataMenu;
function addGroupRole() {
    $(".modal-title").html('Thêm nhóm quyền mới');
    $('#name').val('');
    // show quyền 
    // alert('ok');
    $.ajax({
        type: "POST",
        dataType: "json",
        url: baseHome + "/group_roles/getMenusAdd",
        success: function (data) {
            dataMenu = data;
            console.log(data);
            $arrMenu = [];
            $arrFunc = [];
            $('#bodySetRoles_add').html('');
            $('#theadSetRoles_add').html('');
            $html = '';
            $thead = '';
            data.forEach(function (menu){
                $level = '';
                for($i=0;$i<menu.level;$i++)
                    $level += '---';
                $function = menu.functions;
                $html += '<tr>' +
                    '<td>'+$level+menu.name;
                    if(menu.level == 0) {
                        $html += '<div class="custom-control custom-checkbox">' +
                        '<input type="checkbox" class="custom-control-input" id="checkAll'+menu.id+'" onclick="checkAll('+menu.id+', this.checked, this)" />'+
                       '<label class="custom-control-label" for="checkAll'+menu.id+'">Chọn tất cả</label>' +
                        '</div>';
                    }
                $html += '</td>';
                $checkedMenu = '';
                $html+='<td>' +
                    '<div class="custom-control custom-checkbox">' +
                    '<input type="checkbox" class="custom-control-input menu_add_'+menu.cha+'"  id="menu_add'+menu.id+'" onclick="setMenuRole('+menu.id+',0,this.checked)" />' +
                    '<label class="custom-control-label" for="menu_add'+menu.id+'">Xem</label>' +
                    '</div>' +
                    '</td>';
                    $function.forEach(function (func){
                        $html+='<td>' +
                            '<div class="custom-control custom-checkbox">' +
                            '<input type="checkbox" class="custom-control-input function_add'+menu.id+'" data-idfunction="'+func.id+'"  id="function_add'+func.id+'" onclick="setFunctionRole('+func.id+',0,this.checked)" />' +
                            '<label class="custom-control-label" for="function_add'+func.id+'">'+func.name+'</label>' +
                            '</div>' +
                            '</td>';
                    })
                $html+='</tr>';
            })
            $('#bodySetRoles_add').html($html);
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}
function checkAllCheckbox() {
    let a = 0;
    $.each(dataMenu, function (index, menu) {
        if (menu.level == 0) {
            a = 0;
            ketqua = [];
            let dataMenuChild = dequy(dataMenu, menu.id);
            if (!$('#menu_add' + Number(menu.id))[0].checked) 
                a++;
            $.each(dataMenuChild, function (index, menu) {
                if (!$('#menu_add' + Number(menu))[0].checked)
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
function checkAll(cha,check,item) {
    ketqua = [];
    
    
    var dataMenuChild = dequy(dataMenu,cha)
    // có cha của hrm đi tìm các checkbox menu con
    if(check) {
        if(!$('#menu_add'+Number(cha))[0].checked) {
            $('#menu_add'+Number(cha)).prop('checked', true);  
            setMenuRole(cha,0,true)
        }
        
        $.each(dataMenuChild, function( index, menu ) { 
            
            if(!$('#menu_add'+Number(menu))[0].checked) {
                $('#menu_add'+Number(menu)).prop('checked', true);    
                setMenuRole(menu,0,true)
            }
           
            // $('#function_add'+menu).checked = true;
             $(".function_add"+Number(menu)).each(function() {
                 if(!this.checked) {
                    this.checked=true;
                    setFunctionRole(this.getAttribute('data-idfunction'),0,true);
                 }
                
            });  
        })
    }
    else {
        if($('#menu_add'+Number(cha))[0].checked) {
            $('#menu_add'+Number(cha)).prop('checked', false);  
            setMenuRole(cha,0,false)
        }
        $('#menu_add'+Number(cha)).prop('checked', false);  
        $.each(dataMenuChild, function( index, menu ) { 
            if($('#menu_add'+Number(menu))[0].checked) {
                setMenuRole(menu,0,false)
                $('#menu_add'+Number(menu)).prop('checked', false);  
            }
            // $('#function_add'+menu).checked = true;
             $(".function_add"+Number(menu)).each(function() {
                if(this.checked) {
                    this.checked=false;
                    setFunctionRole(this.getAttribute('data-idfunction'),0,false);
                 }
            });  
        })
    }
}

 function dequy(menus,parentid) {
   
    if (ketqua.length == 0) ketqua= [];
    $.each(menus, function( index, menu ) {
        if(menu.parentId == parentid) {
            ketqua.push(menu.id);
            dequy(menus,menu.id);
         }
      });
    return ketqua;
}

function getGroupRole(id) {
    $("#updateinfo").modal('show');
    $(".modal-title").html('Cập nhật thông tin nhóm quyền');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/group_roles/getGroupRole",
        success: function (data) {
            dataMenu = data.data2;
            $('#name').val(data.data.name);
            //load menu
            $arrMenu = [];
            $arrFunc = [];
            $('#bodySetRoles_add').html('');
            $('#theadSetRoles_add').html('');
            $html = '';
            $thead = '';
            data.data2.forEach(function (menu){
                $level = '';
                for($i=0;$i<menu.level;$i++)
                    $level += '---';
                $function = menu.functions;
                $html += '<tr>' +
                    '<td>'+$level+menu.name;
                    if(menu.level == 0) {
                        $html += '<div class="custom-control custom-checkbox">' +
                        '<input type="checkbox" class="custom-control-input" id="checkAll'+menu.id+'" onclick="checkAll('+menu.id+', this.checked, this)" />'+
                       '<label class="custom-control-label" for="checkAll'+menu.id+'">Chọn tất cả</label>' +
                        '</div>';
                    }
                    
                   $html += '</td>';
                $checkedMenu = '';
                if(menu.checked==1) {
                    $checkedMenu = 'checked';
                    $arrMenu.push(menu.id);
                }
                $html+='<td>' +
                    '<div class="custom-control custom-checkbox">' +
                    '<input type="checkbox" class="custom-control-input" '+$checkedMenu+' id="menu_add'+menu.id+'" onclick="setMenuRole('+menu.id+',0,this.checked)" />' +
                    '<label class="custom-control-label" for="menu_add'+menu.id+'">Xem</label>' +
                    '</div>' +
                    '</td>';
                    $function.forEach(function (func){
                        $checkedFunc = '';
                        if(func.checked==1) {
                            $checkedFunc = 'checked';
                            $arrFunc.push(func.id);
                        }
                        $html+='<td>' +
                            '<div class="custom-control custom-checkbox">' +
                            '<input type="checkbox" class="custom-control-input function_add'+menu.id+'" data-idfunction="'+func.id+'" '+$checkedFunc+' id="function_add'+func.id+'" onclick="setFunctionRole('+func.id+',0,this.checked)" />' +
                            '<label class="custom-control-label" for="function_add'+func.id+'">'+func.name+'</label>' +
                            '</div>' +
                            '</td>';
                    })
                $html+='</tr>';
            })
            $('#bodySetRoles_add').html($html);
            checkAllCheckbox();
            url = baseHome + '/group_roles/updateGroupRole?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function saveGroupRole() {
    // var info = {};
    // info.name = $("#name").val();
    $('#dg').validate({
        errorClass: "error",
        rules: {
            "name": {
                required: true,
            },
        },
        messages: {
            "name": {
                required: "Yêu cầu nhập tên nhóm!",
            },
        },
        submitHandler: function (form) {
    var formData = new FormData(form);
    formData.append('menus',$arrMenu);
    formData.append('functions',$arrFunc);
    $.ajax({
        type: "POST",
        dataType: "json",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false,
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
        // error: function () {
        //     if(data.msg)
        //         notyfi_success(data.msg);
        //     else
        //         notify_error('Cập nhật không thành công');
        // }
    });
}
});
$('#dg').submit();
}

function setRoles(id)
{
    $("#setroles").modal('show');
    $("#title-2").html('Phân quyền');
    $groupId = id;
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { groupId: id },
        url: baseHome + "/group_roles/getMenus",
        success: function (data) {
            $arrMenu = [];
            $arrFunc = [];
            $('#bodySetRoles').html('');
            $('#theadSetRoles').html('');
            $html = '';
            $thead = '';
            data.forEach(function (menu){
                console.log(menu);
                $level = '';
                for($i=0;$i<menu.level;$i++)
                    $level += '---';
                $function = menu.functions;
                $html += '<tr>' +
                    '<td>'+$level+menu.name+'</td>';
                $checkedMenu = '';
                if(menu.checked==1) {
                    $checkedMenu = 'checked';
                    console.log($checkedMenu);
                    $arrMenu.push(menu.id);
                }
                $html+='<td>' +
                    '<div class="custom-control custom-checkbox">' +
                    '<input type="checkbox" class="custom-control-input" '+$checkedMenu+' id="menu_'+menu.id+'" onclick="setMenuRole('+menu.id+','+id+',this.checked)" />' +
                    '<label class="custom-control-label" for="menu_'+menu.id+'">Xem</label>' +
                    '</div>' +
                    '</td>';
                    $function.forEach(function (func){
                        $checkedFunc = '';
                        if(func.checked==1) {
                            $checkedFunc = 'checked';
                            $arrFunc.push(func.id);
                        }
                        $html+='<td>' +
                            '<div class="custom-control custom-checkbox">' +
                            '<input type="checkbox" class="custom-control-input" '+$checkedFunc+' id="function_'+func.id+'" onclick="setFunctionRole('+func.id+','+id+',this.checked)" />' +
                            '<label class="custom-control-label" for="function_'+func.id+'">'+func.name+'</label>' +
                            '</div>' +
                            '</td>';
                    })
                $html+='</tr>';
            })
            $('#bodySetRoles').html($html);
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function deleteGroupRole(id) {
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
                url: baseHome + "/group_roles/deleteGroupRole",
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

function setFunctionRole(funcId,groupId,check){
    checkAllCheckbox();
    if(check){
        $arrFunc.push(funcId.toString());
    }else{
        var index = $arrFunc.indexOf(funcId.toString());
        if (index !== -1) {
            $arrFunc.splice(index, 1);
        }
    }
    // $.ajax({
    //     url: baseHome + "/group_roles/setFunctionRole",
    //     type: 'post',
    //     dataType: "json",
    //     data: { funcId:funcId,groupId:groupId,check:check},
    //     success: function (data) {
    //     },
    // });
}

function setMenuRole(menuId,groupId,check){
    checkAllCheckbox();
    if(check){
        $arrMenu.push(menuId.toString());
    }else{
        var index = $arrMenu.indexOf(menuId.toString());
        if (index !== -1) {
            $arrMenu.splice(index, 1);
        }
    }
    // $.ajax({
    //     url: baseHome + "/group_roles/setMenuRole",
    //     type: 'post',
    //     dataType: "json",
    //     data: { menuId:menuId,groupId:groupId,check:check},
    //     success: function (data) {
    //     },
    // });
}

function updateRoles(){
 
    $.ajax({
        url: baseHome + "/group_roles/updateRoles",
        type: 'post',
        dataType: "json",
        data: { menus:$arrMenu,groupId:$groupId,functions:$arrFunc},
        success: function (data) {
            if (data.code==200) {
                $("#setroles").modal('hide');
                notyfi_success(data.message);
                $(".user-list-table").DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.message);
        },
    });
}