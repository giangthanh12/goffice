var url, boards,
    openSidebar = true,
    kanbanWrapper = $('.kanban-wrapper'),
    sidebar = $('.update-item-sidebar'),
    datePicker = $('#dateTime'),
    department = $('#department'),
    commentEditor = $('.comment-editor'),
    addNewForm = $('.add-new-board'),
    updateItemSidebar = $('.update-item-sidebar'),
    addNewButton = $('#addNewButon'),
    staffId = $('#staffId'),
    slDefineId = $('#defineId'),
    requestId = 0,
    stepId = 0;
   
$(function () {
    'use strict';

    var assetPath = 'styles/app-assets/';
    if ($('body').attr('data-framework') === 'laravel') {
        assetPath = $('body').attr('data-asset-path');
    }


    // Toggle add new input and actions
    //  addNewInput.toggle();

    // datepicker init
    if (datePicker.length) {
        datePicker.flatpickr({
            //monthSelectorType: 'static',
            // altInput: true,
            altFormat: 'd/m/Y',
            dateFormat: 'd/m/Y'
        });
    }

    // select2
    if (staffId.length) {
        function renderLabels(option) {
            if (!option.id) {
                return option.text;
            }
            var $badge = "<div class='badge badge-pill'> " + option.text + '</div>';

            return $badge;
        }

        staffId.each(function () {
            var $this = $(this);
            $this.wrap("<div class='position-relative'></div>").select2({
                placeholder: 'Chọn nhân viên',
                dropdownParent: $this.parent(),
                templateResult: renderLabels,
                templateSelection: renderLabels,
                escapeMarkup: function (es) {
                    return es;
                }
            });
        });
    }
    if (department.length) {
        function renderLabels(option) {
            if (!option.id) {
                return option.text;
            }
            var $badge = "<div class='badge badge-pill'> " + option.text + '</div>';

            return $badge;
        }

        department.each(function () {
            var $this = $(this);
            $this.wrap("<div class='position-relative'></div>").select2({
                placeholder: 'Chọn phòng ban',
                dropdownParent: $this.parent(),
                templateResult: renderLabels,
                templateSelection: renderLabels,
                escapeMarkup: function (es) {
                    return es;
                }
            });
        });
    }

    if (slDefineId.length) {
        function renderLabels(option) {
            if (!option.id) {
                return option.text;
            }
            var $badge = "<div class='badge badge-pill'> " + option.text + '</div>';

            return $badge;
        }

        slDefineId.each(function () {
            var $this = $(this);
            $this.wrap("<div class='position-relative'></div>").select2({
                placeholder: 'Chọn yêu cầu',
                dropdownParent: $this.parent(),
                templateResult: renderLabels,
                templateSelection: renderLabels,
                escapeMarkup: function (es) {
                    return es;
                }
            });
        });
    }
    slDefineId.on('change', function () {
        initKanban();
    });


    // Init kanban

    initKanban();

    if (kanbanWrapper.length) {
        new PerfectScrollbar(kanbanWrapper[0]);
    }

    // Render add new inline with boards
    $('.kanban-container').append(addNewForm);

    // Comment editor
    if (commentEditor.length) {
        new Quill('.comment-editor', {
            modules: {
                toolbar: '.comment-toolbar'
            },
            placeholder: 'Write a Comment... ',
            theme: 'snow'
        });
    }

    // Change add item button to flat button
    $.each($('.kanban-title-button'), function () {
        $(this).removeClass().addClass('kanban-title-button btn btn-flat-secondary btn-sm ml-50');
        Waves.init();
        Waves.attach("[class*='btn-flat-']");
    });

    // Makes kanban title editable
    $(document).on('mouseenter', '.kanban-title-board', function () {
        //  $(this).attr('contenteditable', 'true');
    });
    $(document).on('ready', '.kanban-title-board', function () {
         $(this).css('white-space', 'inherit');
    });
    // Appends delete icon with title
    // $.each($('.kanban-board-header'), function () {
    //     $(this).append(renderBoardDropdown());
    // });

    // Deletes Board
    $(document).on('click', '.delete-board', function () {
        var id = $(this).closest('.kanban-board').data('id');
        kanban.removeBoard(id);
    });

    // Delete task
    $(document).on('click', '.dropdown-item.delete-task', function () {
        openSidebar = true;
        var id = $(this).closest('.kanban-item').data('eid');
        kanban.removeElement(id);
    });

    // Open/Cancel add new input
    // $('.add-new-btn, .cancel-add-new').on('click', function () {
    //     addNewInput.toggle();
    // });

    // Add new board
    addNewForm.on('submit', function (e) {
        e.preventDefault();
        var $this = $(this),
            value = $this.find('.form-control').val(),
            id = value.replace(/\s+/g, '-').toLowerCase();
        kanban.addBoards([
            {
                id: id,
                title: value
            }
        ]);
        // Adds delete board option to new board & updates data-order
        $('.kanban-board:last-child').find('.kanban-board-header').append(renderBoardDropdown());

        // Remove current append new add new form
        //   addNewInput.val('').css('display', 'none');
        $('.kanban-container').append(addNewForm);

        // Update class & init waves
        $.each($('.kanban-title-button'), function () {
            $(this).removeClass().addClass('kanban-title-button btn btn-flat-secondary btn-sm ml-50');
            Waves.init();
            Waves.attach("[class*='btn-flat-']");
        });
    });


    // Re-init tooltip when modal opens(Bootstrap bug)
    sidebar.on('shown.bs.modal', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('.update-item-form').on('submit', function (e) {
        e.preventDefault();
        sidebar.modal('hide');
    });

    if (updateItemSidebar.length) {
        updateItemSidebar.on('hidden.bs.modal', function () {
            updateItemSidebar.find('.custom-file-label').empty();
        });
    }
    addNewButton.on("click", function () {
        $('#timelineComment').html('');
        sidebar.modal('show');
        $('#btnRefuse').addClass('d-none');
        $('#btnApprove').addClass('d-none');
        $('#refuserLabel').addClass('d-none');
        $('#processorLabel').addClass("d-none");
        if (funAdd == '1') {
            $('#btnUpdate').removeClass('d-none');
        } else {
            $('#btnUpdate').addClass('d-none');
        }
        $('#modalTitle').html("Tạo yêu cầu");
        $('#title').val('');
        $('#staffId').val(baseUser).trigger("change");
        $('#dateTime').val(dateNowDMY);
        $('#department').val(0).trigger("change");
        $('#fmProperties').empty();
        var $defineId = $('#defineId').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            async: false,
            url: baseHome + '/request/getProperties?defineId=' + $defineId,
            success: function (data) {
                var html = '';
                data.forEach(function (item) {
                    html += '<div class="form-group">' +
                        '<label class="form-label" for="property_' + item.id + '">' + item.name + '</label>' +
                        '<input type="text" id="property_' + item.id + '" name="property_' + item.id + '" class="form-control" placeholder="' + item.name + '" />' +
                        '</div>'
                });
                $('#fmProperties').html(html);
            }
        });
        url = baseHome + '/request/addRequest?defineId=' + $defineId;
    })
});

function initKanban() {
    $('.kanban-wrapper').empty();
    var $defineId = $('#defineId').val();
    // Get Data
    $.ajax({
        type: 'GET',
        dataType: 'json',
        async: false,
        url: baseHome + '/request/getAllRequests?defineId=' + $defineId,
        // url: baseHome + '/styles/app-assets/data/kanban.json',
        success: function (data) {
            console.log(data);
            boards = data;
        }
    });
    var kanban = new jKanban({
        element: '.kanban-wrapper',
        gutter: '15px',
        widthBoard: '250px',
        dragItems: false,
        boards: boards,
        dragBoards: false,
        addItemButton: false,
        itemAddOptions: {
            enabled: false, // add a button to board for easy item creation
            content: '+ Add New Item', // text or html content of the board button
            class: 'kanban-title-button btn btn-default btn-xs', // default class of the button
            footer: false // position the button on footer
        },
        click: function (el) {
            var el = $(el);
            requestId = el.attr('data-eid');
            stepId = el.attr('data-stepId');
            $('#modalTitle').html("Chỉnh sửa yêu cầu. Giai đoạn: "+el.attr('data-stepName'));
            var $creator = el.attr('data-staffId');
            var $status = el.attr('data-status');
            if ($status == '2') {
                $('#btnRefuse').addClass('d-none');
                $('#btnUpdate').addClass('d-none');
                $('#btnApprove').addClass('d-none');
                $('#btnDel').addClass('d-none');
                $('#processorLabel').removeClass('d-none');
                $('#refuserLabel').addClass('d-none');
            } else if ($status == '3') {
                $('#btnRefuse').addClass('d-none');
                $('#btnUpdate').addClass('d-none');
                $('#btnApprove').addClass('d-none');
                $('#btnDel').addClass('d-none');
                $('#processorLabel').removeClass('d-none');
                $('#refuserLabel').removeClass('d-none');
            } else {
                if ($creator == baseUser) {
                    if (funEdit == '1')
                        $('#btnUpdate').removeClass('d-none');
                    else
                        $('#btnUpdate').addClass('d-none');
                    if (funDel == '1')
                        $('#btnDel').removeClass('d-none');
                    else
                        $('#btnDel').addClass('d-none');

                } else {
                    $('#btnUpdate').addClass('d-none');
                    $('#btnDel').addClass('d-none');
                }
                var $processors = el.attr('data-process');
                $processors = $processors.split(",");
                var index = $processors.indexOf(baseUser);
                if (index > -1) {
                    if (funRefuse == '1')
                        $('#btnRefuse').removeClass('d-none');
                    else
                        $('#btnRefuse').addClass('d-none');
                    if (funApprove == '1')
                        $('#btnApprove').removeClass('d-none');
                    else
                        $('#btnApprove').addClass('d-none');
                } else {
                    $('#btnRefuse').addClass('d-none');
                    $('#btnApprove').addClass('d-none');
                }

                $('#processorLabel').addClass('d-none');
                $('#refuserLabel').addClass('d-none');
            }

            if (el.find('.kanban-item-avatar').length) {
                el.find('.kanban-item-avatar').on('click', function (e) {
                    e.stopPropagation();
                });
            }
            if (!$('.dropdown').hasClass('show') && openSidebar) {
                sidebar.modal('show');
            }
            sidebar.find('.update-item-form').on('submit', function (e) {
                e.preventDefault();
            });
            $('#title').val(el.attr('data-note'));
            datePicker.val(el.attr('data-dateTime'));
            department.val(el.attr('data-departmentid')).trigger('change');
            $('#staffId').val(el.attr('data-staffId')).trigger('change');
            $('#processor').empty();
            $.ajax({
                type: 'GET',
                dataType: 'json',
                async: false,
                url: baseHome + '/request/getProcessors?staffIds=' + el.attr('data-processors'),
                success: function (dataStaff) {
                    dataStaff.forEach(function (item) {
                        $('#processor').append(
                            renderAvatar(item.avatar, false, '50', item.name, 32)
                        );
                    })

                }
            });

            $('#refuser').empty();
            $.ajax({
                type: 'GET',
                dataType: 'json',
                async: false,
                url: baseHome + '/request/getProcessors?staffIds=' + el.attr('data-refusers'),
                success: function (dataStaff) {
                    dataStaff.forEach(function (item) {
                        $('#refuser').append(
                            renderAvatar(item.avatar, false, '50', item.name, 32)
                        );
                    })

                }
            });

            var $defineId = $('#defineId').val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                async: false,
                url: baseHome + '/request/getProperties?defineId=' + $defineId + '&requestId=' + requestId,
                success: function (data) {
                    var html = '';
                    data.forEach(function (item) {
                        html += '<div class="form-group">' +
                            '<label class="form-label" for="property_' + item.id + '">' + item.name + '</label>' +
                            '<input type="text" id="property_' + item.id + '" name="property_' + item.id
                            + '" class="form-control" value="' + item.value + '" placeholder="' + item.name + '" />' +
                            '</div>'
                    });
                    $('#fmProperties').html(html);
                }
            });

            $('#timelineComment').html();
            $.ajax({
                type: 'GET',
                dataType: 'json',
                async: false,
                url: baseHome + '/request/getComments?requestId=' + requestId,
                success: function (dataComment) {
                    console.log(dataComment);
                    $('#timelineComment').html('');
                    var html = '';
                    dataComment.forEach(function (item) {
                       if(item.status==2)
                          var  colorStatus = 'success';
                        var      statusText='Người duyệt';
                        if(item.status==3)
                        var    colorStatus = 'danger';
                        var    statusText='Người từ chối';
    
                        html += `<li class="timeline-item">
                            <span class="timeline-point timeline-point-secondary timeline-point-${colorStatus} timeline-point-indicator"></span>
                            <div class="timeline-event">
                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                    <h6>${item.stepName}</h6>
                                </div>
                                <p>${item.note}</p>
                                <div class="media align-items-center">
                                    <div class="avatar">`;
                                    html +=    '<img onerror='+"this.src='https://velo.vn/goffice-test/layouts/useravatar.png'"+' src="../../../app-assets/images/avatars/12-small.png" alt="avatar" height="38" width="38" />';
                                   html+= `</div>
                                    <div class="media-body ml-50">
                                        <h6 class="mb-0">${item.staffName}</h6>
                                        <span>${item.phoneNumber}</span>
                                    </div>
                                </div>
                            </div>
                        </li>`;

                    });
                    $('#timelineComment').html(html);

                }
            });
            url = baseHome + '/request/editRequest?id=' + requestId;

        },
        buttonClick: function (el, boardId) {
            var addNew = document.createElement('form');
            addNew.setAttribute('class', 'new-item-form');
            addNew.innerHTML =
                '<div class="form-group mb-1">' +
                '<textarea class="form-control add-new-item" rows="2" placeholder="Add Content" required></textarea>' +
                '</div>' +
                '<div class="form-group mb-2">' +
                '<button type="submit" class="btn btn-primary btn-sm mr-1">Add</button>' +
                '<button type="button" class="btn btn-outline-secondary btn-sm cancel-add-item">Cancel</button>' +
                '</div>';
            kanban.addForm(boardId, addNew);
            addNew.querySelector('textarea').focus();
            addNew.addEventListener('submit', function (e) {
                e.preventDefault();
                var currentBoard = $(".kanban-board[data-id='" + boardId + "']");
                kanban.addElement(boardId, {
                    title: "<span class='kanban-text'>" + e.target[0].value + '</span>',
                    id: boardId + '-' + currentBoard.find('.kanban-item').length + 1
                });

                currentBoard.find('.kanban-item:last-child .kanban-text').before(renderDropdown());
                addNew.remove();
            });
            $(document).on('click', '.cancel-add-item', function () {
                $(this).closest(addNew).toggle();
            });
        },
        dragEl: function (el, source) {
            return false;
            $(el).find('.item-dropdown, .item-dropdown .dropdown-menu.show').removeClass('show');
        }
    });

    // Render custom items
    $.each($('.kanban-item'), function () {
        var $this = $(this),
            $text = "<span class='kanban-text'>" + $this.attr('data-note') + '</span>';
        var status =  $this.attr('data-status');
       if(status==3){
           $this.removeClass("bg-primary");
           $this.removeClass("bg-success");
           $this.addClass("bg-danger");
       }else if(status==2){
           $this.removeClass("bg-danger");
           $this.removeClass("bg-primary");
           $this.addClass("bg-success");
       } else {
           $this.removeClass("bg-danger");
           $this.removeClass("bg-success");
           $this.addClass("bg-primary");
       }
        $this.addClass("text-white");


        if ($this.attr('data-badge') !== undefined && $this.attr('data-badge-title') !== undefined) {
            $this.html(renderHeader($this.attr('data-badge'), $this.attr('data-badge-title')) + $text);
        }
        if (
            $this.attr('data-comments') !== undefined ||
            $this.attr('data-staffAvatar') !== undefined ||
            $this.attr('data-staffName') !== undefined
        ) {
            $this.append(
                renderFooter(
                    $this.attr('data-dateTime'),
                    $this.attr('data-staffAvatar'),
                    $this.attr('data-staffName')
                )
            );
        }
        if ($this.attr('data-image') !== undefined) {
            $this.html(
                renderHeader($this.attr('data-badge'), $this.attr('data-badge-title')) +
                "<img class='img-fluid rounded mb-50' src='" +
                assetPath +
                'images/slider/' +
                $this.attr('data-staffavatar') +
                "' height='32'/>" +
                $text +
                renderFooter(
                    $this.attr('data-dateTime'),
                    $this.attr('data-staffAvatar'),
                    $this.attr('data-staffName')
                )
            );
        }
        $this.on('mouseenter', function () {
            $this.find('.item-dropdown, .item-dropdown .dropdown-menu.show').removeClass('show');
        });
    });
}

// Render board dropdown
function renderBoardDropdown() {
    return (
        "<div class='dropdown'>" +
        feather.icons['more-vertical'].toSvg({
            class: 'dropdown-toggle cursor-pointer font-medium-3 mr-0',
            id: 'board-dropdown',
            'data-toggle': 'dropdown',
            'aria-haspopup': 'true',
            'aria-expanded': 'false'
        }) +
        "<div class='dropdown-menu dropdown-menu-right' aria-labelledby='board-dropdown'>" +
        "<a class='dropdown-item delete-board' href='javascript:void(0)'> " +
        feather.icons['trash'].toSvg({class: 'font-medium-1 align-middle'}) +
        "<span class='align-middle ml-25'>Delete</span></a>" +
        "<a class='dropdown-item' href='javascript:void(0)'>" +
        feather.icons['edit'].toSvg({class: 'font-medium-1 align-middle'}) +
        "<span class='align-middle ml-25'>Rename</span></a>" +
        "<a class='dropdown-item' href='javascript:void(0)'>" +
        feather.icons['archive'].toSvg({class: 'font-medium-1 align-middle'}) +
        "<span class='align-middle ml-25'>Archive</span></a>" +
        '</div>' +
        '</div>'
    );
}

// Render item dropdown
function renderDropdown() {
    return '';
    return (
        "<div class='dropdown item-dropdown px-1'>" +
        feather.icons['more-vertical'].toSvg({
            class: 'dropdown-toggle cursor-pointer mr-0 font-medium-1',
            id: 'item-dropdown',
            ' data-toggle': 'dropdown',
            'aria-haspopup': 'true',
            'aria-expanded': 'false'
        }) +
        "<div class='dropdown-menu dropdown-menu-right' aria-labelledby='item-dropdown'>" +
        "<a class='dropdown-item' href='javascript:void(0)'>Copy task link</a>" +
        "<a class='dropdown-item' href='javascript:void(0)'>Xóa</a>" +
        "<a class='dropdown-item delete-task' href='javascript:void(0)'>Từ chối</a>" +
        '</div>' +
        '</div>'
    );
}

// Render header
function renderHeader(color, text) {
    return (
        "<div class='d-flex justify-content-between flex-wrap align-items-center mb-1'>" +
        "<div class='item-badges'> " +
        "<div class='badge badge-pill badge-light-" +
        color +
        "'> " +
        text +
        '</div>' +
        '</div>' +
        renderDropdown() +
        '</div>'
    );
}

// Render avatar
function renderAvatar(images, pullUp, margin, members, size) {
    var $transition = pullUp ? ' pull-up' : '',
        member = members !== undefined ? members.split(',') : '';

    return images !== undefined
        ? images
            .split(',')
            .map(function (img, index, arr) {
                var $margin = margin !== undefined && index !== arr.length - 1 ? ' mr-' + margin + '' : '';

                return (
                    "<li class='avatar kanban-item-avatar" +
                    ' ' +
                    $transition +
                    ' ' +
                    $margin +
                    "'" +
                    "data-toggle='tooltip' data-placement='top'" +
                    "title='" +
                    member[index] +
                    "'" +
                    '>' +
                    "<img src='" +
                    baseUrlFile + '/uploads/nhanvien/' +
                    img +
                    "' " +
                    'onerror="this.src=\'' + baseHome + '/layouts/useravatar.png\'"' +
                    "alt='Avatar' height='" +
                    size +
                    "'>" +
                    '</li>'
                );
            })
            .join(' ')
        : '';
}

// Render footer
function renderFooter(dateTime, assigned, members) {
    return (
        "<div class='d-flex justify-content-between align-items-center flex-wrap mt-1'>" +
        "<div> <span class='align-middle mr-50'>" +
        feather.icons['calendar'].toSvg({class: 'font-medium-1 align-middle mr-25 ',style:'stroke:white'}) +
        "<span class='attachments align-middle'>" +
        dateTime +
        '</span>' +
        // "</span> <span class='align-middle' >" +
        // feather.icons['message-square'].toSvg({class: 'font-medium-1 align-middle mr-25'}) +
        // '<span>' +
        '</span>' +
        '</span></div>' +
        "<ul class='avatar-group mb-0'>" +
        renderAvatar(assigned, true, 0, members, 28) +
        '</ul>' +
        '</div>'
    );
}

$('#btnUpdate').on('click', function () {
    $('#fmInfo').validate({
        messages: {
            "title": {
                required: "Bạn chưa nhập tiêu đề!",
            },
            "staffId": {
                required: "Bạn chưa chọn nhân viên yêu cầu!",
            },
            "dateTime": {
                required: "Bạn chưa nhập ngày tạo!",
            }
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            var $defineId = $('#defineId').val();
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
                success: function (result) {
                    if (result.code == 200) {
                        requestId = result.data.requestId;
                        $('#fmProperties').validate({
                            submitHandler: function (formPro) {
                                var formDataPro = new FormData(formPro);
                                $.ajax({
                                    url: baseHome + '/request/saveProperties?defineId=' + $defineId + '&requestId=' + requestId,
                                    type: 'POST',
                                    data: formDataPro,
                                    async: false,
                                    cache: false,
                                    contentType: false,
                                    enctype: 'multipart/form-data',
                                    processData: false,
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.code == 200) {
                                            initKanban();
                                            $('.modal').modal('hide');
                                            notyfi_success(result.message);
                                        } else
                                            notify_error(result.message);
                                    }
                                });
                            }
                        });
                        $('#fmProperties').submit();
                    } else
                        notify_error(result.message);
                }
            });
            return false;
        }
    });
    $('#fmInfo').submit();
})

$('#btnApprove').on('click', function () {
   Swal.fire({
        title: 'Duyệt đơn',
        html: '<span for="text-note" style="float: left">Vui lòng nhập phản hồi:</span>',
        icon: 'warning',
        input: 'textarea',
        inputAttributes: {
            autocapitalize: 'off',
            id: 'text-note'
        },
        showCancelButton: true,
        confirmButtonText: 'Tôi đồng ý',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false,
    }).then(function (result) {
        if (result.isConfirmed) {
            if (result.value != '') {
                var $defineId = slDefineId.val();
                $.ajax({
                    url: baseHome + "/request/approve",
                    type: 'post',
                    dataType: "json",
                    data: {requestId: requestId, stepId: stepId, defineId: $defineId,note:result.value},
                    success: function (data) {
                        if (data.code == 200) {
                            $('.modal').modal('hide');
                            notyfi_success(data.message);
                            initKanban();
                        } else
                            notify_error(data.message);
                    },
                });

            } else
                swal.fire({
                    title: 'Error',
                    text: "Bạn chưa nhập phản hồi!",
                    icon: 'error',
                });
        }

    });
})
$('#btnRefuse').on('click', function () {
    Swal.fire({
        title: 'Từ chối đơn',
        html: '<span for="text-note" style="float: left">Vui lòng nhập phản hồi:</span>',
        icon: 'warning',
        input: 'textarea',
        inputAttributes: {
            autocapitalize: 'off',
            id: 'text-note'
        },
        showCancelButton: true,
        confirmButtonText: 'Tôi đồng ý',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false,
    }).then(function (result) {
        if (result.isConfirmed) {
            if (result.value != '') {
                $.ajax({
                    url: baseHome + "/request/refuse",
                    type: 'post',
                    dataType: "json",
                    data: {requestId: requestId, stepId: stepId,note:result.value},
                    success: function (data) {
                        if (data.code == 200) {
                            $('.modal').modal('hide');
                            notyfi_success(data.message);
                            initKanban();
                        } else
                            notify_error(data.message);
                    },
                });
            } else
                swal.fire({
                    title: 'Error',
                    text: "Bạn chưa nhập phản hồi!",
                    icon: 'error',
                });
        }
    });
})

$('#btnDel').on('click', function () {
    Swal.fire({
        title: 'Xóa yêu cầu',
        text: "Bạn có chắc chắn muốn xóa yêu cầu này!",
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
                url: baseHome + "/request/del",
                type: 'post',
                dataType: "json",
                data: {requestId: requestId, stepId: stepId},
                success: function (data) {
                    if (data.code == 200) {
                        $('.modal').modal('hide');
                        notyfi_success(data.message);
                        initKanban();
                    } else
                        notify_error(data.message);
                },
            });
        }
    });
})

