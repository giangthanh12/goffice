var defaultDate = '';
var uvid = '';
var dtMemberTable = $("#member-list-table");
var dtHVTable = $("#hocvan-list-table");
var dtKNTable = $("#kinhnghiem-list-table");
$(function () {
    var basicPickr = $('.flatpickr-basic');
    // Default
    if (basicPickr.length) {
        basicPickr.flatpickr({
            defaultDate: "today",
            dateFormat: "d-m-Y",
 
        });
    }

    "use strict";

    var dtUserTable = $(".user-list-table"),
        newUserSidebar = $(".new-user-modal"),
        newUserForm = $("#dg");

    // return_combobox_multi('#nguon', baseHome + '/nguonuv/combo', 'Chọn nguồn ứng viên');
    // return_combobox_multi('#chiendich', baseHome + '/chiendich/combo', 'Chọn chiến dich');
 

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            autoWidth: false,
            ajax: baseHome + "/applicant/list",
            columns: [
        
                { data: "fullName" },
                { data: "gender" },
                { data: "email" },
                { data: "phoneNumber" },
                { data: "cv" },
                { data: "" },
            ],
            columnDefs: [
     





                {
                    // User full name and username
                    targets: 0,
                
                    render: function (data, type, full, meta) {
                        var $name = full["fullName"],
                         
                            $image = full["image"];
                        if ($image) {
                            // For Avatar image
                            var $output = '<img onerror='+"this.src='https://velo.vn/goffice-test/layouts/useravatar.png'"+' src="' + $image + '" alt="Avatar" height="32" width="32">';
                            // var $output = '<img src="' + assetPath + "images/avatars/" + $image + '" alt="Avatar" height="32" width="32">';
                        } else {
                            // For Avatar badge
                            var stateNum = Math.floor(Math.random() * 6) + 1;
                            var states = ["success", "danger", "warning", "info", "dark", "primary", "secondary"];
                            var $state = states[stateNum],
                                $name = full["name"],
                                $initials = $name.match(/\b\w/g) || [];
                            $initials = (($initials.shift() || "") + ($initials.pop() || "")).toUpperCase();
                            $output = '<span class="avatar-content">' + $initials + "</span>";
                        }
                        var colorClass = $image === "" ? " bg-light-" + $state + " " : "";
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="avatar-wrapper">' +
                            '<div class="avatar ' +
                            colorClass +
                            ' mr-1">' +
                            $output +
                            "</div>" +
                            "</div>" +
                            '<div class="d-flex flex-column">' +
                            '<a href="javascript:void(0)" onclick="loaddata('+full["id"]+');" data-toggle="modal" data-target="#updateinfo" class="user_name text-truncate"><span class="font-weight-bold">' +
                            $name +
                            "</span></a>" +
                           
                            "</div>" +
                            "</div>";
                        return $row_output;
                    },
                },
                {
                    targets: 1,
                    render: function (data, type, full, meta) {
                        var $status = full["gender"];
                        if ($status == 1) {
                            return 'Nam';
                        } else if ($status == 2) {
                            return 'Nữ';
                        } else {
                            return '';
                        }
                    },
                },
                {
                    targets: 3,
                    orderable: false,
                },
                {
                    orderable: false,
                    targets: 4,
                    render: function (data, type, full, meta) {
                       var html = '';
                      
                       if(full['cv'] !== '') {
                        var urlfile = baseHome + '/users/gemstech/' +full['cv'];
                        html +=  `<div id="viewfile"><a target="_blank" href="${urlfile}" style="color: blue;">Tải xuống <i class="fas fa-download"></i></a> </div>`;
                    }
                    return html;
                    },
                    width:150
                },
                
                {
                    // Actions
                    targets: -1,
                    title: "Thao tác",
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loaddata(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="del(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                        return html;
                    },
                    width: 150
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
           
            // Buttons with Dropdown
            buttons: [
                {
                    text: "Thêm mới",
                    className: "add-new btn btn-primary mt-50",
                    attr: {
                        "data-toggle": "modal",
                        "data-target": "#modals-slide-in",
                    },
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                    },
                    action: function (e, dt, node, config) {
                        $('#dg')[0].reset();

                       
                    }
                },
           
            ],
            // For responsive popup
           
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
            },
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
    if (newUserForm.length) {
        newUserForm.validate({
            errorClass: "error",
            rules: {
                "fullName": {
                    required: true,
                },
                "dob": {
                    required: true,
                },
                "phoneNumber": {
                    required: true,
                    number:true,
                    min:0
                },
                "email": {
                    required: true,
                    email:true
                },
              
            },
            messages: {
                "fullName": {
                    required: "Bạn chưa nhập tên",
                },
                "dob": {
                    required: "Bạn chưa nhập ngày sinh",
                },
                "phoneNumber": {
                    required: "Bạn chưa nhập số điện thoại",
                    number:"Yêu cầu nhập số",
                    min:"Yêu cầu nhập số bắt đầu từ 0"
                },
                "email": {
                    required: "Bạn chưa nhập địa chỉ email",
                    email:"Yêu cầu nhập đúng định dạng email"
                },
            },
        });

        newUserForm.on("submit", function (e) {
            var isValid = newUserForm.valid();
            e.preventDefault();
            if (isValid) {
                saveadd();
            }
        });
    }
// validate info applicant
if ($('#thongtin').length) {
    $('#thongtin').validate({
        errorClass: "error",
        rules: {
            "hoten": {
                required: true,
            },
         
            "phoneNumber1": {
                required: true,
                number:true,
                min:0
            },
            "e_mail": {
                required: true,
                email:true
            },
            "idNumber": {
                number:true,
                min:0,
            },
          
        },
        messages: {
            "hoten": {
                required: "Bạn chưa nhập tên",
            },
         
            "phoneNumber1": {
                required: "Bạn chưa nhập số điện thoại",
                number:"Yêu cầu nhập số",
                min:"Yêu cầu nhập số bắt đầu từ 0"
            },
            "e_mail": {
                required: "Bạn chưa nhập địa chỉ email",
                email:"Yêu cầu nhập đúng định dạng email"
            },
            "idNumber": {
                number:"Yêu cầu nhập số",
                min:"Yêu cầu nhập số bắt đầu từ 0"
            },
          
        },
    });

    $('#thongtin').on("submit", function (e) {
        var isValid = $('#thongtin').valid();
        e.preventDefault();
        if (isValid) {
            updateinfo();
        }
    });
}
// validate info applicant
if ($('#fm-tab3').length) {
    $('#fm-tab3').validate({
        errorClass: "error",
        rules: {
   
            "hvuv3": {
                required: true,
            },
            "hvuv4": {
                required: true,
            },
            "hvuv5": {
                required: true,
            },
            "hvuv6": {
                required: true,
            },
          
        },
        messages: {
        
            "hvuv3": {
                required: "Bạn chưa nhập nơi đào tạo",
            },
            "hvuv4": {
                required: "Bạn chưa nhập chuyên ngành",
            },
            "hvuv5": {
                required: "Bạn chưa nhập hình thức đào tạo",
            },
            "hvuv6": {
                required: "Bạn chưa nhập bằng cấp",
            },
          
        },
    });

    $('#fm-tab3').on("submit", function (e) {
        var isValid = $('#fm-tab3').valid();
        e.preventDefault();
        if (isValid) {
            savehv();
        }
    });
}
// validate kinh nghiệm làm việc
// validate info applicant
if ($('#fm-tab4').length) {
    $('#fm-tab4').validate({
        errorClass: "error",
        rules: {
   
            "knuv3": {
                required: true,
            },
            "knuv4": {
                required: true,
            },
            "knuv5": {
                required: true,
            },
            "knuv6": {
                number: true,
                min:0,
            },
          
        },
        messages: {
        
            "knuv3": {
                required: "Bạn chưa nhập tên công ty",
            },
            "knuv4": {
                required: "Bạn chưa nhập tên công ty",
            },
            "knuv5": {
                required: "Bạn chưa nhập tên người tham chiếu",
            },
            "knuv6": {
        
                number:"Yêu cầu nhập số",
                min:"Yêu cầu nhập số bắt đầu từ 0"
            },
          
        },
    });

    $('#fm-tab4').on("submit", function (e) {
        var isValid = $('#fm-tab4').valid();
        e.preventDefault();
        if (isValid) {
            savekn();
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
    $('#fm-tab2')[0].reset();
    return_combobox_multi('#noisinh', baseHome + '/applicant/getProvince', 'Chọn nơi sinh');
    return_combobox_multi('#residence', baseHome + '/applicant/getProvince', 'Nơi ở hiện tại');
    return_combobox_multi('#idPlace', baseHome + '/applicant/getProvince', 'Chọn nơi cấp');
    uvid = id;
    // $('#tab-1').click();
    $('#updateinfo').modal('show');
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/applicant/loaddata",
        success: function (data) {
           
            $('#ungvien').html(data.fullName);
            $('#avatar').attr('src', data.image);
            if (data.gender == 1)
                $("#male2").prop("checked", true).trigger("click");
            else if (data.gender == 2)
                $("#female2").prop("checked", true).trigger("click");
            if (data.maritalStatus == 1)
                $("#tthn1").prop("checked", true).trigger("click");
            else if (data.maritalStatus == 2)
                $("#tthn2").prop("checked", true).trigger("click");
            $('#hoten').val(data.fullName);
            $('#quoctich').val(data.nationality);
            $('#nguon').val(data.source).change();
            $('#ngaysinh').val(data.dob);
            
            $("#noisinh").val(data.pob).trigger('change');
            $('#salary').val(formatCurrency(data.salary.replace(/[,VNĐ]/g,'')))
            if(data.salary == 0) $('#salary').val('');
            $("#residence").val(data.residence).trigger('change');
           
            $('#introduce').val(data.introduce);
            $('#position1').val(data.position);
            $('#note1').html(data.note);
            $("#idPlace").val(data.idPlace).trigger('change');
            $('#idNumber').val(data.idNumber);
            $('#address').val(data.address);
            $('#phoneNumber1').val(data.phoneNumber);
            if($('#idDate').length) {
                $('#idDate').flatpickr({
                    dateFormat: "d-m-Y",
                    defaultDate: "today",
                });
            }
           
            $('#idDate').val('');
            if(data.idDate != '') {
                $('#idDate').val(data.idDate);
            }

            $('#viewfile').html('');
            if(data.cv !== '') {
                var urlfile = baseHome + '/users/gemstech/' +data.cv;
                $('#viewfile').html(`<a target="_blank" href="${urlfile}" style="color: blue;">Tải xuống <i class="fas fa-download"></i></a>`)
            }
            $('#e_mail').val(data.email);
            url = baseHome + "/applicant/update?id=" + id;

            loadmembers(id);
            loadlisthv(id);
            loadlistkn(id);
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });

}


$(document).on('blur','.phoneNumber', function() {
   
    var id = $(this).data('id');
    var phone = $(this).val();
    var idApplicant = uvid;
  
    if(id == 'phoneNumber') {
     idCustomer = 0;
    }
     
     if(phone != '' && phone.toString().length >= 10 ) { 
         $.ajax({
             type: "POST",
             dataType: "json",
             data: {phone:phone, idApplicant:idApplicant},
             url: baseHome + "/applicant/checkPhone",
             success: function (data) {
                 if (data.success) {
                     notyfi_success(data.msg);
                     if(id == 'phoneNumber') {
                         $('.btn-add-customer').prop('disabled', false);
                     }
                     else {
                         $('.btn-update-customer').prop('disabled', false);
                     }
                 }
                 else {
                     if(id == 'phoneNumber') {
                         $('.btn-add-customer').prop('disabled', true);
                     }
                     else {
                         $('.btn-update-customer').prop('disabled', true);
                     }
                     notify_error(data.msg);
                 }
             },
             error: function(){
                 notify_error('Số điện thoại đã tồn tại');
             }
         });
     }
 })



function updateinfo() {
  
    var  formData = new FormData($("#thongtin")[0]); 
    $.ajax({
        type: "POST",
        dataType: "json",
        data: formData,
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

function thayanh() {
    var myform = new FormData($('#thongtin')[0]);
    myform.append('myid', uvid);
    $.ajax({
        url: baseHome + "/applicant/thayanh",
        type: 'post',
        data: myform,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#avatar').attr('src', data.filename);
                $(".user-list-table").DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
    });
}

function saveadd() {
    var info = {};
    info.fullName = $("#fullName").val();
    info.gender = $("input[type='radio'][name='gender']:checked").val();
    info.dob = $("#dob").val();
    info.phoneNumber = $("#phoneNumber").val();
    info.email = $("#email").val();
    info.position = $("#position").val();
    info.note = $("#note").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: info,
        url: baseHome + "/applicant/add",
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                $('#modals-slide-in').modal('hide');
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

function del(id) {
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
                url: baseHome + "/applicant/del",
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

// Thông tin gia đình
function loadmembers(id) {
    uvid = id;
    if (dtMemberTable.length) {
        dtMemberTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/applicant/loadmembers?id=" + id,
            destroy: true,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "moi_quan_he" },
                { data: "ten_day_du" },
                { data: "nghe_nghiep" },
                { data: "dien_thoai" },
                { data: "" },
            ],
            columnDefs: [
                {
                    // For Responsive
                    targets: 0,
                    className: "control",
                    orderable: false,
                    responsivePriority: 2,
                    visible: false
                },
                {
                    // User full name and username
                    targets: 1,
                },
                {
                    targets: 2,
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-center text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loadmember(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="delmember(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                        return html;
                    },
                    width: 150
                },
            ],
            // dom:
            //     '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
            //     '<"col-lg-12 col-xl-6" l>' +
            //     '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
            //     ">t" +
            //     '<"d-flex justify-content-between mx-2 row mb-1"' +
            //     '<"col-sm-12 col-md-6"i>' +
            //     '<"col-sm-12 col-md-6"p>' +
            //     ">",
            language: {
                sLengthMenu: "Show _MENU_",
                search: "Search",
                searchPlaceholder: "Search..",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                }
            },

            // // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Details of " + data["name"];
                        },
                    }),
                    type: "column",
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: "table",
                        columnDefs: [
                            {
                                targets: 2,
                                visible: false,
                            },
                            {
                                targets: 3,
                                visible: false,
                            },
                        ],
                    }),
                },
            }
        });
        urltab2 = baseHome + "/applicant/addmember?ung_vien=" + id;
    }
}

function loadmember(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/applicant/loadmember",
        success: function (data) {
            $('#ttuv1').val(data.ten_day_du);
            if (data.ngay_sinh != '0000-00-00')
                defaultDate = data.ngay_sinh;
            else
                defaultDate = '';
            $('#ttuv2').flatpickr({
                // monthSelectorType: "static",
                altInput: true,
                defaultDate: defaultDate,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
            });
            $('#ttuv3').val(data.nghe_nghiep);
            $('#ttuv4').val(data.dien_thoai);
            $('#ttuv5').val(data.dia_chi);
            $('#ttuv6').val(data.moi_quan_he);
            urltab2 = baseHome + "/applicant/updatemember?id=" + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function savemember() {
    var member = {};
    member.ten_day_du = $("#ttuv1").val();
    member.ngay_sinh = $("#ttuv2").val();
    member.nghe_nghiep = $("#ttuv3").val();
    member.dien_thoai = $("#ttuv4").val();
    member.dia_chi = $("#ttuv5").val();
    member.moi_quan_he = $("#ttuv6").val();
    $.ajax({
        url: urltab2,
        type: 'post',
        dataType: "json",
        data: member,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                dtMemberTable.DataTable().ajax.reload(null, false);
                $('#fm-tab2')[0].reset();
            }
            else
                notify_error(data.msg);
        },
    });
}

function delmember(id){
    $.ajax({
        url: baseHome + "/applicant/delmember",
        type: 'post',
        dataType: "json",
        data: { id: id },
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                dtMemberTable.DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
    });
}

function clearfmtab2() {
    urltab2 = baseHome + "/applicant/addmember?ung_vien=" + uvid;
    $('#fm-tab2')[0].reset();
}

// Thông tin học vấn
function loadlisthv(id) {
    uvid = id;
    if (dtHVTable.length) {
        dtHVTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/applicant/loadlisthv?id=" + id,
            destroy: true,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "ngay_bat_dau" },
                { data: "ngay_ket_thuc" },
                { data: "noi_dao_tao" },
                { data: "chuyen_nganh" },
                { data: "bang_cap" },
                { data: "" },
            ],
            columnDefs: [
                {
                    // For Responsive
                    targets: 0,
                    className: "control",
                    orderable: false,
                    responsivePriority: 2,
                    visible: false
                },
                {
                    // User full name and username
                    targets: 1,
                },
                {
                    targets: 2,
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-center text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loadhv(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="delhv(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                        return html;
                    },
                    width: 150
                },
            ],
            // dom:
            //     '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
            //     '<"col-lg-12 col-xl-6" l>' +
            //     '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
            //     ">t" +
            //     '<"d-flex justify-content-between mx-2 row mb-1"' +
            //     '<"col-sm-12 col-md-6"i>' +
            //     '<"col-sm-12 col-md-6"p>' +
            //     ">",
            language: {
                sLengthMenu: "Show _MENU_",
                search: "Search",
                searchPlaceholder: "Search..",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                }
            },

            // // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Details of " + data["name"];
                        },
                    }),
                    type: "column",
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: "table",
                        columnDefs: [
                            {
                                targets: 2,
                                visible: false,
                            },
                            {
                                targets: 3,
                                visible: false,
                            },
                        ],
                    }),
                },
            }
        });
        urltab3 = baseHome + "/applicant/addhv?ung_vien=" + id;
    }
}

function loadhv(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/applicant/loadhv",
        success: function (data) {
            if (data.ngay_bat_dau != '0000-00-00')
                defaultDate = data.ngay_bat_dau;
            else
                defaultDate = '';
            $('#hvuv1').flatpickr({
                // monthSelectorType: "static",
                altInput: true,
                defaultDate: defaultDate,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
            });
            if (data.ngay_ket_thuc != '0000-00-00')
                defaultDate = data.ngay_ket_thuc;
            else
                defaultDate = '';
            $('#hvuv2').flatpickr({
                // monthSelectorType: "static",
                altInput: true,
                defaultDate: defaultDate,
                // altFormat: "j F, Y",
                dateFormat: "d/m/Y",
            });
            $('#hvuv3').val(data.noi_dao_tao);
            $('#hvuv4').val(data.chuyen_nganh);
            $('#hvuv5').val(data.hinh_thuc);
            $('#hvuv6').val(data.bang_cap);
            urltab3 = baseHome + "/applicant/updatehv?id=" + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function savehv() {
    var hv = {};
    hv.ngay_bat_dau = $("#hvuv1").val();
    hv.ngay_ket_thuc = $("#hvuv2").val();
    hv.noi_dao_tao = $("#hvuv3").val();
    hv.chuyen_nganh = $("#hvuv4").val();
    hv.hinh_thuc = $("#hvuv5").val();
    hv.bang_cap = $("#hvuv6").val();
    $.ajax({
        url: urltab3,
        type: 'post',
        dataType: "json",
        data: hv,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                dtHVTable.DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);

                $('#fm-tab3')[0].reset();
        },
        
    });
}

function delhv(id){
    $.ajax({
        url: baseHome + "/applicant/delhv",
        type: 'post',
        dataType: "json",
        data: { id: id },
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                dtHVTable.DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
    });
}

function clearfmtab3() {
    urltab3 = baseHome + "/applicant/addhv?ung_vien=" + uvid;
    $('#fm-tab3')[0].reset();
}

// Thông tin kinh nghiệm
function loadlistkn(id) {
    uvid = id;
    if (dtKNTable.length) {
        dtKNTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/applicant/loadlistkn?id=" + id,
            destroy: true,
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "ngay_bat_dau" },
                { data: "ngay_ket_thuc" },
                { data: "cong_ty" },
                { data: "vi_tri" },
                { data: "" },
            ],
            columnDefs: [
                {
                    // For Responsive
                    targets: 0,
                    className: "control",
                    orderable: false,
                    responsivePriority: 2,
                    visible: false
                },
                {
                    // User full name and username
                    targets: 1,
                },
                {
                    targets: 2,
                },
                {
                    // Actions
                    targets: -1,
                    title: feather.icons["database"].toSvg({ class: "font-medium-3 text-center text-success mr-50" }),
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var html = '';
                        html += '<button type="button" class="btn btn-icon btn-outline-primary waves-effect" title="Chỉnh sửa" onclick="loadkn(' + full['id'] + ')">';
                        html += '<i class="fas fa-pencil-alt"></i>';
                        html += '</button> &nbsp;';
                        html += '<button type="button" class="btn btn-icon btn-outline-danger waves-effect" title="Xóa" onclick="delkn(' + full['id'] + ')">';
                        html += '<i class="fas fa-trash-alt"></i>';
                        html += '</button>';
                        return html;
                    },
                    width: 150
                },
            ],
            // dom:
            //     '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
            //     '<"col-lg-12 col-xl-6" l>' +
            //     '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
            //     ">t" +
            //     '<"d-flex justify-content-between mx-2 row mb-1"' +
            //     '<"col-sm-12 col-md-6"i>' +
            //     '<"col-sm-12 col-md-6"p>' +
            //     ">",
            language: {
                sLengthMenu: "Show _MENU_",
                search: "Search",
                searchPlaceholder: "Search..",
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                }
            },

            // // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Details of " + data["name"];
                        },
                    }),
                    type: "column",
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: "table",
                        columnDefs: [
                            {
                                targets: 2,
                                visible: false,
                            },
                            {
                                targets: 3,
                                visible: false,
                            },
                        ],
                    }),
                },
            }
        });
        urltab4 = baseHome + "/applicant/addkn?ung_vien=" + id;
    }
}

function loadkn(id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/applicant/loadkn",
        success: function (data) {
            if (data.ngay_bat_dau != '0000-00-00')
                defaultDate = data.ngay_bat_dau;
            else
                defaultDate = '';
            $('#knuv1').flatpickr({
                // monthSelectorType: "static",
                altInput: true,
                defaultDate: defaultDate,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
            });
            if (data.ngay_ket_thuc != '0000-00-00')
                defaultDate = data.ngay_ket_thuc;
            else
                defaultDate = '';
            $('#knuv2').flatpickr({
                // monthSelectorType: "static",
                altInput: true,
                defaultDate: defaultDate,
                altFormat: "j F, Y",
                dateFormat: "d/m/Y",
            });
            $('#knuv3').val(data.cong_ty);
            $('#knuv4').val(data.vi_tri);
            $('#knuv5').val(data.nguoi_tham_chieu);
            $('#knuv6').val(data.dien_thoai);
            $('#knuv7').val(data.ghi_chu);
            $('#knuv8').val(data.du_an);
            urltab4 = baseHome + "/applicant/updatekn?id=" + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function savekn() {
    var kn = {};
    kn.ngay_bat_dau = $("#knuv1").val();
    kn.ngay_ket_thuc = $("#knuv2").val();
    kn.cong_ty = $("#knuv3").val();
    kn.vi_tri = $("#knuv4").val();
    kn.nguoi_tham_chieu = $("#knuv5").val();
    kn.dien_thoai = $("#knuv6").val();
    kn.ghi_chu = $("#knuv7").val();
    kn.du_an = $("#knuv8").val();
    $.ajax({
        url: urltab4,
        type: 'post',
        dataType: "json",
        data: kn,
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                dtKNTable.DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
                $('#fm-tab4')[0].reset();
        },
        
    });
}

function delkn(id){
    $.ajax({
        url: baseHome + "/applicant/delkn",
        type: 'post',
        dataType: "json",
        data: { id: id },
        success: function (data) {
            if (data.success) {
                notyfi_success(data.msg);
                dtKNTable.DataTable().ajax.reload(null, false);
            }
            else
                notify_error(data.msg);
        },
    });
}

function clearfmtab4() {
    urltab4 = baseHome + "/applicant/addkn?ung_vien=" + uvid;
    $('#fm-tab4')[0].reset();
}
$('.format_number').on('input', function(e){        
    $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g,'')));
  }).on('keypress',function(e){
    if(!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
  }).on('paste', function(e){    
    var cb = e.originalEvent.clipboardData || window.clipboardData;      
    if(!$.isNumeric(cb.getData('text'))) e.preventDefault();
  });
  function formatCurrency(number){
    var n = number.split('').reverse().join("");
    var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");    
    return  n2.split('').reverse().join('');
}