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
       
         frmCong = $('#frmCong'),
         checkoutBtn = $('#checkoutBtn'),
         cancelBtn = $('.btn-cancel'),
         updateEventBtn = $('#updateEvent'),
         toggleSidebarBtn = $('.btn-toggle-sidebar'),
         // selectCong = $('#select-label'),
         selectCongSang = $('#selectCongSang'),
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
 

     function fetchEvents(info, successCallback) {
    
         nhanvien = selectNhanVien.val();
         $.ajax({
             type: "POST",
             dataType: "json",
             data: {nhanvienid: nhanvien, nam: nam, thang: thang},
             url: baseHome + '/chamcong/bangcongnv',
             success: function (data) {
                 events = [];
                 if (data.data) {
                     let i = 0;
                   
                      
                    
                     })
                 }
                 var calendars = selectedCalendars();
                 // We are reading event object from app-calendar-events.js file directly by including that file above app-calendar file.
                 // You should make an API call, look into above commented API call for reference
                 selectedEvents = events.filter(function (event) {
                     // console.log(event.extendedProps.calendar.toLowerCase());
                     return calendars.includes(event.extendedProps.calendar.toLowerCase());
                 });
                 // if (selectedEvents.length > 0) {
                 successCallback(selectedEvents);
                 // }
             },
             
         });
 
     }
 
     // Calendar plugins
     var calendar = new FullCalendar.Calendar(calendarEl, {
         initialView: 'dayGridMonth',
         events: fetchEvents,
         eventOrder : "id",
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
             if(calendarEvent._def.extendedProps.calendar>0) {
                 if (colorName) {
                     if (colorName == 'dark') {
                         return [
                             // Background Color
                             'bg-light-' + colorName,
                             'text-white',
                         ];
                     } else if (colorName != '') {
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
            if (baseUser == 11 || baseUser == 1 || baseUser == 27 || baseUser == 7)
             {
                 // if(baseUser==11 || user_nhan_vien==1 || user_nhan_vien==27)
                 //     eventClick(info);
                 // alert(JSON.stringify(info));
                 congid = 0;
                 var ngaycong = moment(info.date).format('YYYY-MM-DD');
              //   if(moment(ngaycong).unix()<=moment(date).unix()) {
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
                             notify_error('Lỗi truy xuất database');
                         }
                     });
               //  }
             }
         },
         eventClick: function (info) {
             if (baseUser == 11 || baseUser == 1 || baseUser == 27 || baseUser == 7)
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
                 'start-date': {required: 'Chọn ngày chấm công'}
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
     updateEventBtn.on('click', function () {
         if (frmCong.valid()) {
             var datacong = {
                 id: congid,
                 nhanvienid: selectNhanVien.val(),
                 ngay: $('#ngay').val(),
                 giovao: $('#giovao').val(),
                 giora: $('#giora').val(),
                 congsang: selectCongSang.val(),
                 congchieu: selectCongChieu.val(),
                 ghichu: ghichu.val()
             };
             $.ajax({
                 type: "POST",
                 dataType: "json",
                 data: datacong,
                 url: baseHome + '/chamcong/chamcongtay',
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
                     notify_error('Lỗi truy xuất database');
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
 