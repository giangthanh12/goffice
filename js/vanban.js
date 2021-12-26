var url = '';
var folderid = 0;
Dropzone.autoDiscover = false;
$(function () {
    // var auth = check_token();
    // if(auth.responseJSON.success){
    'use strict';
    var viewToggle = $('.view-toggle'),
        viewContainer = $('.view-container');

    $('.app-content').addClass('file-manager-application');

    if (viewToggle.length) {
        viewToggle.find('input').on('change', function () {
            var input = $(this);
            viewContainer.each(function () {
                if (!$(this).hasClass('view-container-static')) {
                    if (input.is(':checked') && input.data('view') === 'list') {
                        $(this).addClass('list-view');
                    } else {
                        $(this).removeClass('list-view');
                    }
                }
            });
        });
    }

    //let searchParams = new URLSearchParams(window.location.search);
    var id = 0;
    var search = '';
    if (localStorage.getItem("action") == 1) {
        id = localStorage.getItem('folder');
        search = localStorage.getItem('search');
        localStorage.setItem("action", false);
    } else if (localStorage.getItem('folder')) {
        id = localStorage.getItem('folder');
        if (localStorage.getItem('folderold') == id) {
            localStorage.setItem('folderold', 0);
            localStorage.setItem('folder', 0);
            localStorage.setItem('search', '');
            id = 0;
        } else {
            localStorage.setItem('folderold', id);
        }
    }

    render_file_manager(id, search);
    var filesWrapper = $('.file-manager-main-content'),
        viewContainer = $('.view-container'),
        viewToggle = $('.view-toggle'),
        toggleDropdown = $('.toggle-dropdown'),
        fileContentBody = $('.file-manager-content-body');

    var filesWrapper = $('.file-manager-main-content'),
        toggleDropdown = $('.toggle-dropdown'),
        fileDropdown = $('.file-dropdown'),
        folderDropdown = $('.folder-dropdown');

    // Toggle Dropdown
    if (toggleDropdown.length) {
        $('#file .dropdown').on('click', function (e) {
            var $this = $(this);
            e.preventDefault();
            if (fileDropdown.length) {
                $('.view-container').find('.file-dropdown').remove();
                if ($this.closest('.dropdown').find('.dropdown-menu').length === 0) {
                    fileDropdown
                        .clone()
                        .appendTo($this.closest('.dropdown'))
                        .addClass('show')
                        .find('.dropdown-item')
                        .on('click', function () {
                            $(this).closest('.dropdown-menu').remove();
                        });
                }
            }
        });

        $('#folder .dropdown').on('click', function (e) {
            var $this = $(this);
            e.preventDefault();
            if (folderDropdown.length) {
                $('.view-container').find('.folder-dropdown').remove();
                if ($this.closest('.dropdown').find('.dropdown-menu').length === 0) {
                    folderDropdown
                        .clone()
                        .appendTo($this.closest('.dropdown'))
                        .addClass('show')
                        .find('.dropdown-item')
                        .on('click', function () {
                            $(this).closest('.dropdown-menu').remove();
                        });
                }
            }
        });

        $(document).on('click', function (e) {
            if (!$(e.target).hasClass('toggle-dropdown')) {
                filesWrapper.find('.file-dropdown').remove();
                filesWrapper.find('.folder-dropdown').remove();
            }
        });

        if (viewContainer.length) {
            $('.file, .folder').on('mouseleave', function () {
                $(this).find('.file-dropdown').remove();
                $(this).find('.folder-dropdown').remove();
            });
        }
        // $("#search").on('keyup', function (event) {
        //     if (event.keyCode === 13) {
        //         event.preventDefault();
        //         search();
        //     }
        // });
        $("#search").on('keypress', function (e) {
            if (e.which == 13) {
                var search = $('#search').val();
                localStorage.setItem('search', search);
                localStorage.setItem("action", 1);
                id = localStorage.getItem('folder');
                loadvb(id);
            }
        });
    }

    if ($(fileContentBody).length > 0) {
        var rightContentWrapper = new PerfectScrollbar(fileContentBody[0], {
            cancelable: true,
            wheelPropagation: false
        });
    }

    var multipleFiles = $('#dpz-multiple-files');
    multipleFiles.dropzone({
        paramName: 'file', // The name that will be used to transfer the file
        maxFilesize: 5, // MB
        clickable: true,
        success: function (file, response) {
            if (response.success) {
                notyfi_success(response.msg);
                localStorage.setItem("action", 1);
                id = localStorage.getItem('folder');
                loadvb(id);
            } else {
                notify_error(response.msg);
            }
        },
    });

    var html = '<li class="breadcrumb-item"><a href="./vanban">Home</a></li>';
    if (id > 0) {
        var folders = load_data(baseHome + '/vanban/getfolderparent?folder=' + id);
        var folders = folders.responseJSON;
        folders.map(item => {
            return html += '<li class="breadcrumb-item"><a onclick="loadvb(' + item.id + ')">' + item.name + '</a></li>';
        })
    }
    $('#breadcrumb-folder').html(html);
    // }else{
    //     setInterval(function(){
    //         notify_error(auth.responseJSON.msg);
    //         localStorage.removeItem('token');
    //         window.location.href = baseUrl + 'login';
    //     }, 2000);
    // }    
});

function render_file_manager(id, search) {
    $('#parentId').val(id);
    // var search = localStorage.getItem('search');
    $('#folder').html('');
    $('#file').html('');
    var str_data = load_data(baseHome + '/vanban/loadfolders?folder=' + id + '&search=' + search);
    var Objdata1 = str_data.responseJSON.data;
    var str_data = load_data(baseHome + '/vanban/loadfiles?folder=' + id + '&search=' + search);
    var Objdata2 = str_data.responseJSON.data;
    if (Objdata1.length == 0 && Objdata2.length == 0) {
        $('#folder').html('<p class="text-center w-100 p-3">The folder is empty.</p>');
    }
    //console.log(Objdata);

    if (Objdata1.length > 0) {
        var html1 = '<h6 class="files-section-title mt-25 mb-75">Folders</h6>';
        jQuery.map(Objdata1, function (n, i) {
            html1 += '<div class="card file-manager-item folder">';
            html1 += '<div class="custom-control custom-checkbox">';
            html1 += '<input type="checkbox" class="custom-control-input" id="customCheck' + i + '" onclick="select_folder(' + i + ')" />';
            html1 += '<label class="custom-control-label" for="customCheck' + i + '"></label>';
            html1 += '</div>';
            html1 += '<div class="card-img-top file-logo-wrapper">';
            html1 += '<div class="dropdown float-right" onclick="loadfolder(' + n.id + ')">';
            html1 += '<i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>';
            html1 += '</div>';
            html1 += '<div class="d-flex align-items-center justify-content-center w-100">';
            html1 += '<i data-feather="folder"></i>';
            html1 += '</div>';
            html1 += '</div>';
            html1 += '<div class="card-body">';
            html1 += '<div class="content-wrapper">';
            html1 += '<p class="card-text file-name mb-0" onclick="loadvb2(' + n.id + ')">' + n.name + '</p>';
            html1 += '<p class="card-text file-size mb-0"></p>';
            html1 += '<p class="card-text file-date">' + n.create_date + '</p>';
            html1 += '</div>';
            html1 += '<small class="file-accessed text-muted">Cập nhật gần nhất: ' + n.create_date + '</small>';
            html1 += '</div>';
            html1 += '</div>';
        });
        $('#folder').html(html1);
    }

    if (Objdata2.length > 0) {
        html2 = '<h6 class="files-section-title mt-25 mb-75">File</h6>';
        jQuery.map(Objdata2, function (n, i) {
            filename = n.filename;
            icon = 'unknown.png';
            if (filename) {
                type = filename.split('.');
                type = type[type.length - 1];
                if (type == 'jpg' || type == 'png') {
                    icon = 'jpg.png';
                } else if (type == 'doc' || type == 'docx') {
                    icon = 'doc.png';
                } else if (type == 'pdf') {
                    icon = 'pdf.png';
                } else if (type == 'txt') {
                    icon = 'txt.png';
                } else if (type == 'xls' || type == 'xlsx') {
                    icon = 'xls.png';
                }
            }

            html2 += '<div class="card file-manager-item file">';
            html2 += '<div class="custom-control custom-checkbox">';
            html2 += '<input type="checkbox" class="custom-control-input" id="customCheck' + i + '" />';
            html2 += '<label class="custom-control-label" for="customCheck' + i + '"></label>';
            html2 += '</div>';
            html2 += '<div class="card-img-top file-logo-wrapper " id="file">';
            html2 += '<div class="dropdown float-right" onclick="loadfile(' + n.id + ')">';
            html2 += '<i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>';
            html2 += '</div>';
            html2 += '<div class="d-flex align-items-center justify-content-center w-100">';
            html2 += '<img src="' + baseHome + '/styles/app-assets/images/icons/' + icon + '" alt="file-icon" height="35" />';
            html2 += '</div>';
            html2 += '</div>';
            html2 += '<div class="card-body">';
            html2 += '<div class="content-wrapper">';
            html2 += '<p class="card-text file-name mb-0">' + n.filename + '</p>';
            html2 += '<p class="card-text file-size mb-0">' + Math.round(n.size / 1000000) + 'mb</p>';
            html2 += '<p class="card-text file-date">' + n.ngay + '</p>';
            html2 += '</div>';
            html2 += '<small class="file-accessed text-muted">Cập nhật gần nhất: ' + n.ngay + '</small>';
            html2 += '</div>';
            html2 += '</div>';
        });
        $('#file').html(html2);

    }

}

function loadvb(id) {
    localStorage.setItem("folder", id);
    location.reload();
}

function loadvb2(id) {
    localStorage.setItem("search", '');
    localStorage.setItem("folder", id);
    location.reload();
}

function loadfolder(id) {
    $('.modal').modal('hide');
    $(".modal-title").html('Rename');
    folderid = id;
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/vanban/loadfolder",
        success: function (result) {
            $("#folder").val(id);
            $('#title_folder').val(result.name);
            url = baseHome + '/vanban/updatefolder?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function loadfile(id) {
    fileid = id;
    html = '';
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { id: id },
        url: baseHome + "/vanban/loadfile",
        success: function (result) {
            $(".modal-title").html(result.filename);
            icon = 'unknown.png';
            type = result.filename.split('.');
            type = type[type.length - 1];
            
            if (type == 'jpg' || type == 'png') {
                icon = 'jpg.png';
            } else if (type == 'doc' || type == 'docx') {
                icon = 'doc.png';
            } else if (type == 'pdf') {
                icon = 'pdf.png';
            } else if (type == 'txt') {
                icon = 'txt.png';
            } else if (type == 'xls'|| type == 'xlsx') {
                icon = 'xls.png';
            }

            $("#ngay").html(result.ngay);
            $("#nhanvien").html(result.nhanvien);
            $("#type").html(type);
            $('#size').html(Math.round(result.size / 1024) + 'kb');
            $("#icon").attr("src", baseHome + "/styles/app-assets/images/icons/" + icon);

            var folders = load_data(baseHome + '/vanban/getfolderparent?folder=' + result.folder);
            var folders = folders.responseJSON;
            folders.map(item => {
                return html += item.name + '>';
            })
            html = html.slice(0, -1);
            $("#location").html(html);
            linkdownload = baseUrlFile + '/uploads/vanban/' + result.link + result.filename;
            url = baseHome + '/vanban/updatefile?id=' + id;
        },
        error: function () {
            notify_error('Lỗi truy xuất database');
        }
    });
}

function addfolder() {
    $('#new-folder-modal').modal('show');
    $("#modal-title").html('Tên folder');
    $("#folder").val('');
    $('#title_folder').val('New folder');
    url = baseHome + "/vanban/addfolder";
}

function uploadfiles() {
    fid = localStorage.getItem('folder');
    if (fid > 0) {
        $('#uploadfiles').modal('show');
        $("#fid").val(fid);
    } else {
        notify_error('Bạn chưa chọn folder!');
    }
}

function select_folder(idh) {
    var value = $('#customCheck' + idh).is(':checked');
    if (value) {
        $('.select' + idh).addClass('selected');
    } else {
        $('.select' + idh).removeClass('selected');
    }
}

function savefolder() {
    var folder = $('#parentId').val();
    var required = $('input,textarea,select').filter('[required]:visible');
    var allRequired = true;
    required.each(function () {
        if ($(this).val() == '') {
            allRequired = false;
        }
    });
    if (allRequired) {
        var xhr = new XMLHttpRequest();
        var formData = new FormData($('#vanban-fm')[0]);
        $.ajax({
            url: url,  //server script to process data
            type: 'POST',
            xhr: function () {
                return xhr;
            },
            data: formData,
            datType: 'json',
            success: function (data) {
                if (data.success == true) {
                    notyfi_success(data.msg);
                    //window.location.href = url_reject;
                    localStorage.setItem("action", 1);
                    loadvb(folder);
                } else {
                    notify_error(data.msg);
                    return false;
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
        // save_form_reload_function('#vanban-fm', baseHome + '/vanban/add_folders', 'render_file_manager('+folder+')');    
    } else {
        notify_error('Bạn chưa điền đủ thông tin');
    }
}

function delfolder() {
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
                url: baseHome + "/vanban/delfolder",
                type: 'post',
                dataType: "json",
                data: { id: folderid },
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.msg);
                        localStorage.setItem("action", 1);
                        id = localStorage.getItem('folder');
                        loadvb(id);
                    }
                    else
                        notify_error(data.msg);
                },
            });
        }
    });
}

function delfile() {
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
                url: baseHome + "/vanban/delfile",
                type: 'post',
                dataType: "json",
                data: { id: fileid },
                success: function (data) {
                    if (data.success) {
                        notyfi_success(data.msg);
                        localStorage.setItem("action", 1);
                        id = localStorage.getItem('folder');
                        loadvb(id);
                    }
                    else
                        notify_error(data.msg);
                },
            });
        }
    });
}

function downloadfile() {
    window.location.href = linkdownload;
}
