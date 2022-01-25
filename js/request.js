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
    defineId = $('#defineId');
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

    if (defineId.length) {
        function renderLabels(option) {
            if (!option.id) {
                return option.text;
            }
            var $badge = "<div class='badge badge-pill'> " + option.text + '</div>';

            return $badge;
        }

        defineId.each(function () {
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
    defineId.on('change', function () {
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
        sidebar.modal('show');
        $('#btnReject').addClass('d-none');
        $('#btnAccept').addClass('d-none');
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
        $('#processorLabel').addClass("d-none");
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
        success: function (data) {
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
            var $requestId = el.attr('data-eid');
            $('#processorLabel').removeClass('d-none');
            if (el.find('.kanban-item-avatar').length) {
                el.find('.kanban-item-avatar').on('click', function (e) {
                    e.stopPropagation();
                });
            }
            if (!$('.dropdown').hasClass('show') && openSidebar) {
                sidebar.modal('show');
                $('#btnReject').removeClass('d-none');
                $('#btnAccept').removeClass('d-none');
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
                url: baseHome + '/request/getStaffs?staffIds=' + el.attr('data-processors'),
                success: function (dataStaff) {
                    dataStaff.forEach(function (item) {
                        $('#processor').append(
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
                url: baseHome + '/request/getProperties?defineId=' + $defineId+'&requestId='+$requestId,
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
            $('#modalTitle').html("Chỉnh sửa yêu cầu");
            url = baseHome+'/request/editRequest?id='+$requestId;

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
            $(el).find('.item-dropdown, .item-dropdown .dropdown-menu.show').removeClass('show');
        }
    });

    // Render custom items
    $.each($('.kanban-item'), function () {
        var $this = $(this),
            $text = "<span class='kanban-text'>" + $this.attr('data-note') + '</span>';
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
        feather.icons['calendar'].toSvg({class: 'font-medium-1 align-middle mr-25'}) +
        "<span class='attachments align-middle'>" +
        dateTime +
        '</span>' +
        // "</span> <span class='align-middle'>" +
        // feather.icons['message-square'].toSvg({ class: 'font-medium-1 align-middle mr-25' }) +
        // '<span>' +
        // comments +
        '</span>' +
        '</span></div>' +
        "<ul class='avatar-group mb-0'>" +
        renderAvatar(assigned, true, 0, members, 28) +
        '</ul>' +
        '</div>'
    );
}

function save() {
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
                        $('#fmProperties').validate({
                            submitHandler: function (form) {
                                var formData = new FormData(form);
                                $.ajax({
                                    url: baseHome+'/request/saveProperties?defineId='+$defineId+'&requestId='+result.data.requestId,
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
                                            initKanban();
                                            $('.modal').modal('hide');
                                            notyfi_success(data.message);
                                        } else
                                            notify_error(data.message);
                                    }
                                });
                                return false;
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
}

