/**
 * App Calendar
 */

/**
 * ! If both start and end dates are same Full calendar will nullify the end date value.
 * ! Full calendar will end the event on a day before at 12:00:00AM thus, event won't extend to the end date.
 * ! We are getting events from a separate file named app-calendar-events.js. You can add or remove events from there.
 **/

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
            1: 'info',
            2: 'danger',
            3: 'warning'
        },
        frmCong = $('#frmCong'),
        checkoutBtn = $('#checkoutBtn'),
        cancelBtn = $('.btn-cancel'),
        updateEventBtn = $('#updateEvent'),
        toggleSidebarBtn = $('.btn-toggle-sidebar'),
        // selectCong = $('#select-label'),
        // selectCongSang = $('#selectCongSang'),
        selectNhanVien = $('#selectNhanVien'),
        // selectCongChieu = $('#selectCongChieu'),
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
    $.ajax({
        type: "GET",
        dataType: "json",
        async: false,
        url: baseHome + "/common/nhanvien",
        success: function (data) {
            selectNhanVien.select2({
                data: data,
            });
        },
    });
    selectNhanVien.val(user.nhan_vien).trigger("change");

    // Label  select
    // if (selectCongSang.length) {
    //     function renderBullets(option) {
    //         if (!option.id) {
    //             return option.text;
    //         }
    //         var $bullet =
    //             "<span class='bullet bullet-" +
    //             $(option.element).data('label') +
    //             " bullet-sm mr-50'> " +
    //             '</span>' +
    //             option.text;
    //
    //         return $bullet;
    //     }
    //
    //     selectCongSang.wrap('<div class="position-relative"></div>').select2({
    //         placeholder: 'Select value',
    //         dropdownParent: selectCongSang.parent(),
    //         templateResult: renderBullets,
    //         templateSelection: renderBullets,
    //         minimumResultsForSearch: -1,
    //         escapeMarkup: function (es) {
    //             return es;
    //         }
    //     });
    // }
    //
    // if (selectCongChieu.length) {
    //     function renderBullets(option) {
    //         if (!option.id) {
    //             return option.text;
    //         }
    //         var $bullet =
    //             "<span class='bullet bullet-" +
    //             $(option.element).data('label') +
    //             " bullet-sm mr-50'> " +
    //             '</span>' +
    //             option.text;
    //
    //         return $bullet;
    //     }
    //
    //     selectCongChieu.wrap('<div class="position-relative"></div>').select2({
    //         placeholder: 'Select value',
    //         dropdownParent: selectCongChieu.parent(),
    //         templateResult: renderBullets,
    //         templateSelection: renderBullets,
    //         minimumResultsForSearch: -1,
    //         escapeMarkup: function (es) {
    //             return es;
    //         }
    //     });
    // }

    // Guests select
    // if (eventGuests.length) {
    //     function renderGuestAvatar(option) {
    //         if (!option.id) {
    //             return option.text;
    //         }
    //
    //         var $avatar =
    //             "<div class='d-flex flex-wrap align-items-center'>" +
    //             "<div class='avatar avatar-sm my-0 mr-50'>" +
    //             "<span class='avatar-content'>" +
    //             "<img src='" +
    //             assetPath +
    //             'images/avatars/' +
    //             $(option.element).data('avatar') +
    //             "' alt='avatar' />" +
    //             '</span>' +
    //             '</div>' +
    //             option.text +
    //             '</div>';
    //
    //         return $avatar;
    //     }
    //
    //     eventGuests.wrap('<div class="position-relative"></div>').select2({
    //         placeholder: 'Select value',
    //         dropdownParent: eventGuests.parent(),
    //         closeOnSelect: false,
    //         templateResult: renderGuestAvatar,
    //         templateSelection: renderGuestAvatar,
    //         escapeMarkup: function (es) {
    //             return es;
    //         }
    //     });
    // }
    if (ngay.length) {
        var ngay = ngay.flatpickr({
            enableTime: false,
            altFormat: 'Y-m-d',
            dateFormat: "Y-m-d",
            time_24hr: true,
            onReady: function (selectedDates, dateStr, instance) {
                if (instance.isMobile) {
                    $(instance.mobileInput).attr('step', null);
                }
            }
        });
    }

    // Start date picker
    if (giovao.length) {
        var giovao = giovao.flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i:S",
            altFormat: "H:i:S",
            time_24hr: true,
            enableSeconds: true,
            onReady: function (selectedDates, dateStr, instance) {
                if (instance.isMobile) {
                    $(instance.mobileInput).attr('step', null);
                }
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
        //  cancelBtn.addClass('d-none');
        // updateEventBtn.removeClass('d-none');
        // btnDeleteEvent.removeClass('d-none');
        ngay.setDate(eventToUpdate.start, true, 'Y-m-d');
        congid = eventToUpdate.extendedProps.congid;
        giovao.setDate(eventToUpdate.extendedProps.giovao, true, 'Y-m-d');
        giora.setDate(eventToUpdate.extendedProps.giora, true, 'Y-m-d');
        // eventToUpdate.allDay === true ? allDaySwitch.prop('checked', true) : allDaySwitch.prop('checked', false);
        // eventToUpdate.end !== null
        //     ? end.setDate(eventToUpdate.end, true, 'Y-m-d')
        //     : end.setDate(eventToUpdate.start, true, 'Y-m-d');
      //  sidebar.find(selectCongSang).val(eventToUpdate.extendedProps.congsang).trigger('change');
       // sidebar.find(selectCongChieu).val(eventToUpdate.extendedProps.congchieu).trigger('change');
        // eventToUpdate.extendedProps.guests !== undefined
        //     ? eventGuests.val(eventToUpdate.extendedProps.guests).trigger('change')
        //     : null;
        // eventToUpdate.extendedProps.guests !== undefined
        //     ? calendarEditor.val(eventToUpdate.extendedProps.description)
        //     : null;
        //
        // //  Delete Event
        // btnDeleteEvent.on('click', function () {
        //     eventToUpdate.remove();
        //     // removeEvent(eventToUpdate.id);
        //     sidebar.modal('hide');
        //     $('.event-sidebar').removeClass('show');
        //     $('.app-calendar .body-content-overlay').removeClass('show');
        // });
    }

    // Modify sidebar toggler
    function modifyToggler() {
        $('.fc-sidebarToggle-button')
            .empty()
            .append(feather.icons['menu'].toSvg({class: 'ficon'}));
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
            data: {nhanvienid: nhanvien, nam: nam, thang: thang},
            url: baseHome + '/chamcong/bangcongnv',
            success: function (data) {
                events = [];
                if (data.data) {
                    data.data.forEach(function (item) {
                        let title = "In";
                        let arr = [];
                        if (item.gio_vao != '00:00:00' && item.checkin > 0) {
                            arr = {
                                id: item.id,
                                title: title,
                                start: new Date(item.ngay + ' ' + item.gio_vao),
                                end: new Date(item.ngay + ' ' + item.gio_vao),
                                allDay: false,
                                extendedProps: {
                                    congid: item.id,
                                    calendar: item.checkin,
                                    giovao: new Date(item.ngay + ' ' + item.gio_vao),
                                    giora: new Date(item.ngay + ' ' + item.gio_ra)
                                }
                            };
                            events.push(arr);
                        }
                        title = "Out";
                        if (item.gio_ra != '00:00:00' && item.checkout > 0) {
                            arr = {
                                id: item.id,
                                title: title,
                                start: new Date(item.ngay + ' ' + item.gio_ra),
                                end: new Date(item.ngay + ' ' + item.gio_ra),
                                allDay: false,
                                extendedProps: {
                                    congid: item.id,
                                    giovao: new Date(item.ngay + ' ' + item.gio_vao),
                                    giora: new Date(item.ngay + ' ' + item.gio_ra),
                                    calendar: item.checkout
                                }
                            };
                            events.push(arr);
                        }
                    })
                }
                var calendars = selectedCalendars();
                // We are reading event object from app-calendar-events.js file directly by including that file above app-calendar file.
                // You should make an API call, look into above commented API call for reference
                selectedEvents = events.filter(function (event) {
                    // console.log(event.extendedProps.calendar.toLowerCase());
                    return calendars.includes(JSON.stringify(event.extendedProps.calendar));
                });
                // if (selectedEvents.length > 0) {
                successCallback(selectedEvents);
                // }
            },
            error: function () {
                notify_error('L???i truy xu???t database');
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
            second: '2-digit',
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
        eventClassNames: function ({event: calendarEvent}) {
            const colorName = calendarsColor[calendarEvent._def.extendedProps.calendar];
            if (calendarEvent._def.extendedProps.calendar > 0) {
                if (colorName && colorName != '') {
                    if (colorName == 'dark') {
                        return [
                            // Background Color
                            'bg-light-' + colorName,
                            'text-white',
                        ];
                    } else {
                        return [
                            // Background Color
                            'bg-light-' + colorName
                        ];
                    }
                } else {
                    return [
                        // Background Color
                        'bg-light-primary',
                        'text-white',
                    ];
                }
            }
        },
        dateClick: function (info) {
            // if (user.nhan_vien == 11 || user.nhan_vien == 1 || user.nhan_vien == 27)
            {
                // if(user.nhan_vien==11 || user_nhan_vien==1 || user_nhan_vien==27)
                //     eventClick(info);
                // alert(JSON.stringify(info));
                return false;
                congid = 0;
                var ngaycong = moment(info.date).format('YYYY-MM-DD');
                if (moment(ngaycong).unix() <= moment(date).unix()) {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        data: {ngay: ngaycong, nhanvienid: selectNhanVien.val()},
                        url: baseHome + '/chamcong/checkdate',
                        success: function (data) {
                            if (data.code == '200') {
                                // resetValues();
                                sidebar.modal('show');
                                // checkoutBtn.removeClass('d-none');
                                // updateEventBtn.addClass('d-none');
                                // btnDeleteEvent.addClass('d-none');
                                ngay.setDate(ngaycong)
                                // eventClick(info);
                            }
                        },
                        error: function () {
                            notify_error('L???i truy xu???t database');
                        }
                    });
                }
            }
        },
        eventClick: function (info) {
            // if (user.nhan_vien == 11 || user.nhan_vien == 1 || user.nhan_vien == 27)
            //return false;
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
        calendar.refetchEvents();
    });

    // Validate add new and update form
    if (frmCong.length) {
        frmCong.validate({
            submitHandler: function (form, event) {
                event.preventDefault();
                if (frmCong.valid()) {
                    sidebar.modal('hide');
                }
            },
            rules: {
                'ngay': {required: true},
            },
            messages: {
                'start-date': {required: 'Ch???n ng??y ch???m c??ng'}
            }

        });
    }

    // Sidebar Toggle Btn
    if (toggleSidebarBtn.length) {
        toggleSidebarBtn.on('click', function () {
            cancelBtn.removeClass('d-none');
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
        existingEvent.setDates(updatedEventData.start, updatedEventData.end, {allDay: updatedEventData.allDay});

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
            data: {nhanvienid: user.nhan_vien, ip: user.ip},
            url: baseHome + '/chamcong/checkout',
            success: function (data) {
                selectNhanVien.val(user.nhan_vien).trigger("change");
                calendar.refetchEvents();
                notyfi_success(data.msg);
            },
            error: function () {
                notify_error('L???i truy xu???t database');
            }
        });
    });

    // Update c??ng
    updateEventBtn.on('click', function () {
        if (frmCong.valid()) {
            var datacong = {
                id: congid,
                nhanvienid: selectNhanVien.val(),
                ngay: $('#ngay').val(),
                giovao: $('#giovao').val(),
                giora: $('#giora').val(),
           //     congsang: selectCongSang.val(),
              //  congchieu: selectCongChieu.val(),
                ghichu: ghichu.val()
            };
            $.ajax({
                type: "POST",
                dataType: "json",
                data: datacong,
                url: baseHome + '/chamcong/suagio',
                success: function (data) {
                    if (data.code == '200') {
                        calendar.refetchEvents();
                        sidebar.modal('hide');
                        notyfi_success(data.msg);
                    } else {
                        notify_error(data.msg);
                    }

                },
                error: function () {
                    notify_error('L???i truy xu???t database');
                }
            });
        }
        return false;
    });

    // Reset sidebar input values
    function resetValues() {
        giovao.setDate();
        giora.setDate();
        ngay.setDate();
        selectCongSang.val('').trigger('change');
        selectCongChieu.val('').trigger('change');
        calendarEditor.val('');
    }

    // When modal hides reset input values
    sidebar.on('hidden.bs.modal', function () {
        resetValues();
    });

    // Hide left sidebar if the right sidebar is open
    $('.btn-toggle-sidebar').on('click', function () {
        btnDeleteEvent.addClass('d-none');
        updateEventBtn.addClass('d-none');
        checkoutBtn.removeClass('d-none');
        $('.app-calendar-sidebar, .body-content-overlay').removeClass('show');
    });

    // Select all & filter functionality
    if (selectAll.length) {
        selectAll.on('change', function () {
            var $this = $(this);

            if ($this.prop('checked')) {
                calEventFilter.find('input').prop('checked', true);
            } else {
                calEventFilter.find('input').prop('checked', false);
            }
            calendar.refetchEvents();
        });
    }

    if (filterInput.length) {
        filterInput.on('change', function () {
            $('.input-filter:checked').length < calEventFilter.find('input').length
                ? selectAll.prop('checked', false)
                : selectAll.prop('checked', true);
            calendar.refetchEvents();
        });
    }
});
