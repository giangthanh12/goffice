/**
 * App Calendar
 */

/**
 * ! If both start and end dates are same Full calendar will nullify the end date value.
 * ! Full calendar will end the event on a day before at 12:00:00AM thus, event won't extend to the end date.
 * ! We are getting events from a separate file named app-calendar-events.js. You can add or remove events from there.
 **/
//    baseUser là id thằng user đăng nhập
'use-strict';
var date = new Date(), nhanvien = 0;
var nextDay = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
// prettier-ignore
var nextMonth = date.getMonth() === 11 ? new Date(date.getFullYear() + 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() + 1, 1);
// prettier-ignore
var prevMonth = date.getMonth() === 11 ? new Date(date.getFullYear() - 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() - 1, 1);

var nam = '', thang = '';

var events = []
var congid = 0;
// RTL Support
var direction = 'ltr',
    assetPath = baseHome + '/app-assets/';
if ($('html').data('textdirection') == 'rtl') {
    direction = 'rtl';
}

if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
}

$(document).on('click', '.fc-sidebarToggle-button', function (e) {
    $('.app-calendar-sidebar, .body-content-overlay').addClass('show');
});

$(document).on('click', '.body-content-overlay', function (e) {
    $('.app-calendar-sidebar, .body-content-overlay').removeClass('show');
});

document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar'),
        eventToUpdate,
        sidebar = $('.event-sidebar'),
        calendarsColor = {
            0: '',
            1: 'warning',
            2: 'success',
            3: 'danger',
            4: 'danger',
            8: 'dark',
            9: 'danger',
            10: 'primary',
            11: 'danger'
        },
        formInterview = $('#interviewForm'),
        checkoutBtn = $('#checkoutBtn'),
        cancelBtn = $('.btn-cancel'),
        updateEventBtn = $('#updateEvent'),
        toggleSidebarBtn = $('.btn-toggle-sidebar'),
        // selectCong = $('#select-label'),
        selectCongSang = $('#result'),
        selectNhanVien = $('#selectNhanVien'),
        selectCongChieu = $('#selectCongChieu'),
        ngay = $('#ngay'),
        giovao = $('#giovao'),
        giora = $('#giora'),
        ghichu = $('#ghichu'),
        // eventUrl = $('#event-url'),
        // eventGuests = $('#event-guests'),
        // eventLocation = $('#event-location'),
        // allDaySwitch = $('.allDay-switch'),
        selectAll = $('.select-all'),
        calEventFilter = $('.calendar-events-filter'),
        filterInput = $('.input-filter'),
        btnDeleteEvent = $('.btn-delete-event'),
        calendarEditor = $('#event-description-editor');

    // --------------------------------------------
    // On add new item, clear sidebar-right field fields
    // --------------------------------------------
    $('.add-event button').on('click', function (e) {
        // $('.event-sidebar').addClass('show');
        // $('.sidebar-left').removeClass('show');
        // $('.app-calendar .body-content-overlay').addClass('show');
    });
    // datepicker init
    if ($('.flatpickr-basic').length) {
        $('.flatpickr-basic').flatpickr({
            enableTime: true,
            dateFormat: "d-m-Y H:i",
        });
    }
    return_combobox_multi('#campId', baseHome + '/interview/getRecruitmentCamp', 'Chọn chiến dịch');
    return_combobox_multi('#interviewerIds', baseHome + '/interview/getStaff', 'Chọn người phỏng vấn');

    $('#campId').change(function () {
        var campId = $(this).val();
        $.ajax({
            type: "GET",
            dataType: "json",
            data: { campId: campId },
            async: false,
            url: baseHome + "/interview/getCandidate",
            success: function (data) {
                if (data.length > 0) {
                    $('#canId').select2({
                        data: data,
                    });
                }
                else {
                    $("#canId").empty(); // xóa value trong select2
                }
            },
        });
    })




    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/interview/getStaff",
        success: function (data) {
            selectNhanVien.select2({
                data: data,
                placeholder: "Nhân viên phỏng vấn",
                dropdownParent: selectNhanVien.parent(),
            });
        },
    });

    selectNhanVien.val('').trigger("change");

    // Label  select
    if (selectCongSang.length) {
        function renderBullets(option) {
            if (!option.id) {
                return option.text;
            }
            var color = $(option.element).data('label');
            var $bullet =

                `<span class="bullet bullet-sm mr-50" style="background:${color}"></span><span style="font-weight: 600; color:${color}">${option.text}</span>`;

            return $bullet;
        }
        selectCongSang.wrap('<div class="position-relative"></div>').select2({
            placeholder: 'Trạng thái',
            dropdownParent: selectCongSang.parent(),
            templateResult: renderBullets,
            templateSelection: renderBullets,
            minimumResultsForSearch: -1,
            escapeMarkup: function (es) {
                return es;
            }
        });
    }



    // End date picker
    if (giora.length) {
        var giora = giora.flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i:S",
            altFormat: "H:i:S",
            enableSeconds: true,
            time_24hr: true,
            onReady: function (selectedDates, dateStr, instance) {
                if (instance.isMobile) {
                    $(instance.mobileInput).attr('step', null);
                }
            }
        });
    }

    // Event click function
    function eventClick(info) {

        eventToUpdate = info.event;
        if (eventToUpdate.url) {
            info.jsEvent.preventDefault();
            window.open(eventToUpdate.url, '_blank');
        }
        sidebar.modal('show');

        //  congid = eventToUpdate.extendedProps.congid;

        $('#dateTime').val('');
        //  sidebar.find(selectCongSang).val(eventToUpdate.extendedProps.congsang).trigger('change');
        //  sidebar.find(selectCongChieu).val(eventToUpdate.extendedProps.congchieu).trigger('change');
        //  giovao.setDate(eventToUpdate.extendedProps.giovao, true, 'Y-m-d');
        //  giora.setDate(eventToUpdate.extendedProps.giora, true, 'Y-m-d');

        // ngày
        $('.flatpickr-basic').flatpickr({
            enableTime: true,
            dateFormat: "d-m-Y",
            defaultDate: eventToUpdate.extendedProps.dateTime
        });
        //Giờ
        $('#timeInterview').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            defaultDate: eventToUpdate.extendedProps.time
        });
        $('#idInterview').val(eventToUpdate.extendedProps.id);
        $('#campId').val(eventToUpdate.extendedProps.campId).change();
        $('#canId').val(eventToUpdate.extendedProps.applicantId).trigger('change');
        $('#dateTime').val(eventToUpdate.extendedProps.dateTime);
        $('#timeInterview').val(eventToUpdate.extendedProps.time)
        $('#interviewerIds').val(eventToUpdate.extendedProps.interviewerIds).trigger('change');
        $('#round').val(eventToUpdate.extendedProps.round);
        $('#result').val(eventToUpdate.extendedProps.result).trigger('change');
        $('#note').val(eventToUpdate.extendedProps.note);
    }
    // Modify sidebar toggler
    function modifyToggler() {
        $('.fc-sidebarToggle-button')
            .empty()
            .append(feather.icons['menu'].toSvg({ class: 'ficon' }));
    }
    // Selected Checkboxes
    function selectedCalendars() {
        var selected = [];
        $('.calendar-events-filter input:checked').each(function () {
            selected.push($(this).attr('data-value'));
        });
        return selected;
    }

    // --------------------------------------------------------------------------------------------------
    // AXIOS: fetchEvents
    // * This will be called by fullCalendar to fetch events. Also this can be used to refetch events.
    // --------------------------------------------------------------------------------------------------
    function fetchEvents(info, successCallback) {
        // Fetch Events from API endpoint reference
        /* $.ajax(
          {
            url: '../../../app-assets/data/app-calendar-events.js',
            type: 'GET',
            success: function (result) {
              // Get requested calendars as Array
              var calendars = selectedCalendars();
 
              return [result.events.filter(event => calendars.includes(event.extendedProps.calendar))];
            },
            error: function (error) {
              console.log(error);
            }
          }
        ); */
        nhanvien = selectNhanVien.val();

        $.ajax({
            type: "POST",
            dataType: "json",
            data: { nhanvien: nhanvien, nam: nam, thang: thang },
            url: baseHome + '/interview/getListInterview',
            success: function (data) {

                events = [];
                if (data.data) {
                    let i = 0;
                    data.data.forEach(function (item) {

                        let allday = false;
                        let arr = [];
                        arr = {
                            id: item.id,
                            title: item.fullName,
                            start: new Date(item.dateTime),
                            end: new Date(item.dateTime),
                            allDay: allday,
                            extendedProps: {
                                id: item.id,
                                campId: item.campId,
                                applicantId: item.applicantId,
                                interviewerIds: item.interviewerIds.split(','),
                                result: item.result,
                                note: item.note,
                                dateTime: item.date,
                                time: item.time
                            }
                        };
                        events.push(arr);
                        i++;
                    })
                }
                var calendars = selectedCalendars();
                // We are reading event object from app-calendar-events.js file directly by including that file above app-calendar file.
                // You should make an API call, look into above commented API call for reference



                selectedEvents = events.filter(function (event) {

                    return calendars.includes(event.extendedProps.result.toLowerCase());
                });


                successCallback(selectedEvents);

            },
            error: function () {
                notify_error('Lỗi truy xuất database');
            }
        });

    }

    // Calendar plugins
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: fetchEvents,
        eventOrder: "id",
        eventTimeFormat: { // like '14:30:00'
            hour: '2-digit',
            minute: '2-digit',
            //  second: '2-digit',
            hour12: false
        },
        //hiddenDays: [ 0 ],
        firstDay: 1,
        editable: false,
        dragScroll: true,
        dayMaxEvents: 2,
        eventResizableFromStart: true,
        customButtons: {
            sidebarToggle: {
                text: 'Sidebar'
            }
        },
        headerToolbar: {
            start: 'sidebarToggle, prev,next, title',
            // end: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            end: 'dayGridMonth,listMonth'
        },
        direction: direction,
        initialDate: new Date(),
        navLinks: true, // can click day/week names to navigate views
        customButtons: {
            prev: {
                text: 'Prev',
                click: function (e) {
                    let oldd = new Date(calendar.getDate());
                    let oldmonth = '' + (oldd.getMonth() + 1);
                    if (oldmonth.length == 1)
                        oldmonth = "0" + oldmonth;
                    let oldyear = oldd.getFullYear();
                    let olddate = oldyear + "-" + oldmonth;
                    calendar.prev();
                    let d = new Date(calendar.getDate());
                    thang = '' + (d.getMonth() + 1);
                    if (thang.length == 1)
                        thang = "0" + thang;
                    nam = d.getFullYear();
                    let newdate = nam + "-" + thang;
                    if (newdate != olddate)
                        calendar.refetchEvents();

                }
            },
            next: {
                text: 'Next',
                click: function () {
                    let oldd = new Date(calendar.getDate());
                    let oldmonth = '' + (oldd.getMonth() + 1);
                    if (oldmonth.length == 1)
                        oldmonth = "0" + oldmonth;
                    let oldyear = oldd.getFullYear();
                    let olddate = oldyear + "-" + oldmonth;
                    calendar.next();
                    let d = new Date(calendar.getDate());
                    thang = '' + (d.getMonth() + 1);
                    if (thang.length == 1)
                        thang = "0" + thang;
                    nam = d.getFullYear();
                    let newdate = nam + "-" + thang;
                    if (newdate != olddate)
                        calendar.refetchEvents();
                }
            },
        },
        eventClassNames: function ({ event: calendarEvent }) {

            const colorName = calendarsColor[calendarEvent._def.extendedProps.result]; // chỉnh màu

            if (calendarEvent._context.viewApi.type == 'dayGridMonth') {
                return [
                    // Background Color
                    'bg-light-' + colorName,
                    'text-white',
                    'd-inline-block',
                    'w-100'
                ];
            }
            else {
                return [
                    // Background Color
                    'bg-light-' + colorName,
                    'text-white',
                    'w-100'
                ];
            }
        },
        dateClick: function (info) {
            $('#updateInterview').css('display', 'inline-block');
            $('#updateInterview').html('Thêm');
            if (funAdd != 1) {
                $('#updateInterview').css('display', 'none');
            }

            // thêm dựa vào lịch
            btnDeleteEvent.addClass('d-none');
            $('#add-new-sidebar').modal('show');
            var date = moment(info.date).format('DD-MM-YYYY');
            //ngày
            $('.flatpickr-basic').flatpickr({
                enableTime: true,
                dateFormat: "d-m-Y",
                defaultDate: date
            });
            //giờ
            $('#timeInterview').flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                defaultDate: "12:00"
            });
            $('#dateTime').val(date);
            $('#idInterview').val('');
            $('#campId').val('').change();
            $('#canId').val('').change();
            $('#interviewerIds').val('').change();
            $('#interviewerIds').val('');
            $('#result').val('').change();
            $('#note').val('');

        },
        eventClick: function (info) {

            $('#updateInterview').css('display', 'inline-block');
            if (funEdit != 1) {
                $('#updateInterview').css('display', 'none');
            }
            if (funDel != 1) {
                btnDeleteEvent.addClass('d-none');
            }
            else {
                btnDeleteEvent.removeClass('d-none');
            }

            $('#updateInterview').html('Cập nhật');

            eventClick(info);
        },
        datesSet: function () {
            modifyToggler();
        },
        viewDidMount: function () {
            modifyToggler();
        }
    });

    // Render calendar
    calendar.render();
    // Modify sidebar toggler
    modifyToggler();
    // updateEventClass();

    selectNhanVien.on('select2:select', function (e) {
        //calendar.removeAllEvents();
        //  alert('ok');
        calendar.refetchEvents();
    });

    // Validate add new and update form
    if (formInterview.length) {
        formInterview.validate({
            submitHandler: function (form, event) {
                event.preventDefault();
                if (formInterview.valid()) {
                    sidebar.modal('hide');
                }
            },
            rules: {
                'campId': { required: true },
                'canId': { required: true },
            },
            messages: {
                'campId': { required: 'Yêu cầu chọn chiến dịch' },
                'canId': { required: 'Yêu cầu chọn ứng viên' },
            }

        });
    }

    // Sidebar Toggle Btn add interview calendar chú ý
    if (toggleSidebarBtn.length) {

        toggleSidebarBtn.on('click', function () {
            $('#updateInterview').html('Thêm');
            //ngày
            $('.flatpickr-basic').flatpickr({
                enableTime: true,
                dateFormat: "d-m-Y",
                defaultDate: "today"
            });
            //giờ
            $('#timeInterview').flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                defaultDate: "12:00"
            });
            btnDeleteEvent.addClass('d-none');
            cancelBtn.removeClass('d-none');
            $('#idInterview').val('');
            $('#campId').val('').change();
            $('#result').val('').change();
            $('#interviewerIds').val([]).change();
        });
    }

    // ------------------------------------------------
    // addEvent
    // ------------------------------------------------
    function addEvent(eventData) {
        calendar.addEvent(eventData);
        calendar.refetchEvents();
    }

    // ------------------------------------------------
    // updateEvent
    // ------------------------------------------------
    function updateEvent(eventData) {
        var propsToUpdate = ['id', 'title', 'url'];
        var extendedPropsToUpdate = ['calendar', 'guests', 'location', 'description'];

        updateEventInCalendar(eventData, propsToUpdate, extendedPropsToUpdate);
    }

    // ------------------------------------------------
    // removeEvent
    // ------------------------------------------------
    function removeEvent(eventId) {
        removeEventInCalendar(eventId);
    }

    // ------------------------------------------------
    // (UI) updateEventInCalendar
    // ------------------------------------------------
    const updateEventInCalendar = (updatedEventData, propsToUpdate, extendedPropsToUpdate) => {
        const existingEvent = calendar.getEventById(updatedEventData.id);

        // --- Set event properties except date related ----- //
        // ? Docs: https://fullcalendar.io/docs/Event-setProp
        // dateRelatedProps => ['start', 'end', 'allDay']
        // eslint-disable-next-line no-plusplus
        for (var index = 0; index < propsToUpdate.length; index++) {
            var propName = propsToUpdate[index];
            existingEvent.setProp(propName, updatedEventData[propName]);
        }

        // --- Set date related props ----- //
        // ? Docs: https://fullcalendar.io/docs/Event-setDates
        existingEvent.setDates(updatedEventData.start, updatedEventData.end, { allDay: updatedEventData.allDay });

        // --- Set event's extendedProps ----- //
        // ? Docs: https://fullcalendar.io/docs/Event-setExtendedProp
        // eslint-disable-next-line no-plusplus
        for (var index = 0; index < extendedPropsToUpdate.length; index++) {
            var propName = extendedPropsToUpdate[index];
            existingEvent.setExtendedProp(propName, updatedEventData.extendedProps[propName]);
        }
    };

    // ------------------------------------------------
    // (UI) removeEventInCalendar
    // ------------------------------------------------
    function removeEventInCalendar(eventId) {
        calendar.getEventById(eventId).remove();
    }

    // Add new event
    $(checkoutBtn).on('click', function () {
        $.ajax({
            type: "POST",
            dataType: "json",
            // data: {nhanvienid: baseUser, ip: user.ip},
            url: baseHome + '/chamcong/checkout',
            success: function (data) {
                selectNhanVien.val(baseUser).trigger("change");
                calendar.refetchEvents();
                notyfi_success(data.message);
            },
            error: function () {
                notify_error('Lỗi truy xuất database');
            }
        });
    });

    // Update công
    $('#updateInterview').on('click', function () {
        if (formInterview.valid()) {
            var data = {
                id: $('#idInterview').val(),
                campId: $('#campId').val(),
                canId: $('#canId').val(),
                dateTime: $('#dateTime').val() + ' ' + $('#timeInterview').val(),
                interviewerIds: $('#interviewerIds').val(),
                result: $('#result').val(),
                note: $('#note').val(),
            };
            $.ajax({
                type: "POST",
                dataType: "json",
                data: data,
                url: baseHome + '/interview/updateInterview',
                success: function (data) {
                    if (data.success) {
                        calendar.refetchEvents();
                        sidebar.modal('hide');
                        notyfi_success(data.msg);
                    } else {
                        notify_error(data.msg);
                    }
                },
                error: function () {
                    notify_error('Lỗi truy xuất database');
                }
            });
        }
        return false;
    });

    $('.btn-delete-event').click(function () {
        var idInterview = $('#idInterview').val();
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
                    url: baseHome + "/interview/del",
                    type: 'post',
                    dataType: "json",
                    data: { id: idInterview },
                    success: function (data) {
                        if (data.success) {
                            calendar.refetchEvents();
                            $('#add-new-sidebar').modal('hide');
                            notyfi_success(data.msg);
                        }
                        else
                            notify_error(data.msg);
                    },
                });
            }
        });
    })


    // Hide left sidebar if the right sidebar is open
    $('.btn-toggle-sidebar').on('click', function () {

        btnDeleteEvent.addClass('d-none');
        updateEventBtn.addClass('d-none');
        checkoutBtn.removeClass('d-none');
        $('.app-calendar-sidebar, .body-content-overlay').removeClass('show');
    });

    // Select all & filter functionality
    //  if (selectAll.length) {
    //      selectAll.on('change', function () {


    //          if ($this.prop('checked')) {
    //              calEventFilter.find('input').prop('checked', true);
    //          } else {
    //              calEventFilter.find('input').prop('checked', false);
    //          }
    //          calendar.refetchEvents();
    //      });
    //  }
    filterInput.on('change', function () {
        $('.input-filter:checked').length < calEventFilter.find('input').length
            ? selectAll.prop('checked', false)
            : selectAll.prop('checked', true);
        calendar.refetchEvents();
    });

});
