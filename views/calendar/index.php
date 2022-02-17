<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-calendar.css">
<style>
    .fc .fc-more-popover .fc-popover-body {
        max-height: 340px;
        overflow: auto
    }

    .fc .fc-daygrid-day.fc-day-today {
        min-height: 190px;
    }

    .fc-todayButton-button {
        border-radius: 0.358rem !important;
        margin-right: 0.25rem !important;
    }
</style>
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Full calendar start -->
            <section>
                <div class="app-calendar  border">
                    <div class="row no-gutters">
                        <!-- Sidebar -->
                        <div class="col app-calendar-sidebar flex-grow-0 overflow-hidden d-flex flex-column" id="app-calendar-sidebar">
                            <div class="sidebar-wrapper">
                                <div class="card-body d-flex justify-content-center">
                                    <button class="btn btn-success btn-toggle-sidebar btn-block waves-effect waves-float waves-light" onclick="loadAdd()">
                                        <span class="align-middle">Thêm sự kiện</span>
                                    </button>
                                    <!-- <button class="btn btn-primary btn-toggle-sidebar btn-block" data-toggle="modal" data-target="#add-new-sidebar">
                                        <span class="align-middle">Thêm sự kiện</span>
                                    </button> -->
                                </div>
                                <div class="card-body pb-0">
                                    <h5 class="section-label mb-1">
                                        <span class="align-middle">Lọc</span>
                                    </h5>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input select-all" id="select-all" checked />
                                        <label class="custom-control-label" for="select-all">Tất cả</label>
                                    </div>
                                    <div class="calendar-events-filter">
                                        <div class="custom-control custom-control-danger custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input input-filter" id="crm" data-value="1" checked />
                                            <label class="custom-control-label" for="crm">CRM</label>
                                        </div>
                                        <div class="custom-control custom-control-warning custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input input-filter" id="hrm" data-value="2" checked />
                                            <label class="custom-control-label" for="hrm">HRM</label>
                                        </div>
                                        <div class="custom-control custom-control-success custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input input-filter" id="todo" data-value="3" checked />
                                            <label class="custom-control-label" for="todo">TODO</label>
                                        </div>
                                        <div class="custom-control custom-control-info custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input input-filter" id="ticket" data-value="4" checked />
                                            <label class="custom-control-label" for="ticket">TICKET</label>
                                        </div>
                                        <div class="custom-control custom-control-secondary custom-checkbox">
                                            <input type="checkbox" class="custom-control-input input-filter" id="other" data-value="5" checked />
                                            <label class="custom-control-label" for="other">KHÁC</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-auto">
                                <img src="<?= HOME ?>/styles/app-assets/images/pages/calendar-illustration.png" alt="Calendar illustration" class="img-fluid" />
                            </div>
                        </div>
                        <!-- /Sidebar -->

                        <!-- Calendar -->
                        <div class="col position-relative">
                            <div class="card shadow-none border-0 mb-0 rounded-0">
                                <div class="card-body pb-0">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /Calendar -->
                        <div class="body-content-overlay"></div>
                    </div>
                </div>
                <!-- Calendar Add/Update/Delete event modal-->
                <div class="modal modal-slide-in event-sidebar fade" id="add-new-sidebar">
                    <div class="modal-dialog sidebar-lg">
                        <div class="modal-content p-0">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                            <div class="modal-header mb-1">
                                <h5 class="modal-title"></h5>
                            </div>
                            <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                <form class="event-form needs-validation" data-ajax="false" novalidate>
                                    <div class="form-group">
                                        <label for="title" class="form-label">Tiêu đề</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Event Title" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="select-label" class="form-label">Loại</label>
                                        <select class="select2 select-label form-control w-100" id="select-label" name="select-label">
                                            <option data-label="danger" value="1" selected>CRM</option>
                                            <option data-label="warning" value="2">HRM</option>
                                            <option data-label="success" value="3">TODO</option>
                                            <option data-label="info" value="4">TICKET</option>
                                            <option data-label="secondary" value="5">KHÁC</option>
                                        </select>
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="start-date" class="form-label">Ngày bắt đầu</label>
                                        <input type="text" class="form-control" id="start-date" name="start-date" placeholder="Ngày bắt đầu" onchange="changeStartDate()" />
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="end-date" class="form-label">Ngày kết thúc</label>
                                        <input type="text" class="form-control" id="end-date" name="end-date" placeholder="Ngày kết thúc" />
                                    </div>
                                    <!-- <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input allDay-switch" id="customSwitch3" />
                                            <label class="custom-control-label" for="customSwitch3">All Day</label>
                                        </div>
                                    </div> -->
                                    <!-- <div class="form-group">
                                        <label for="event-url" class="form-label">Event URL</label>
                                        <input type="url" class="form-control" id="event-url" placeholder="https://www.google.com" />
                                    </div>
                                    <div class="form-group select2-primary">
                                        <label for="event-guests" class="form-label">Add Guests</label>
                                        <select class="select2 select-add-guests form-control w-100" id="event-guests" multiple>
                                            <option data-avatar="1-small.png" value="Jane Foster">Jane Foster</option>
                                            <option data-avatar="3-small.png" value="Donna Frank">Donna Frank</option>
                                            <option data-avatar="5-small.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                                            <option data-avatar="7-small.png" value="Lori Spears">Lori Spears</option>
                                            <option data-avatar="9-small.png" value="Sandy Vega">Sandy Vega</option>
                                            <option data-avatar="11-small.png" value="Cheryl May">Cheryl May</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="event-location" class="form-label">Location</label>
                                        <input type="text" class="form-control" id="event-location" placeholder="Enter Location" />
                                    </div> -->

                                    <!-- <div class="form-group">
                                        <label class="form-label">Ghi chú</label>
                                        <textarea name="event-description-editor" id="event-description-editor" class="form-control" rows="5"></textarea>
                                    </div> -->
                                    <div class="form-group">
                                        <label class="form-label" for="event-description-editor">Ghi chú</label>
                                        <div id="event-description-editor" class="border-bottom-0"></div>
                                        <div class="d-flex justify-content-end desc-toolbar border-top-0">
                                            <span class="ql-formats mr-0">
                                                <button class="ql-bold"></button>
                                                <button class="ql-italic"></button>
                                                <button class="ql-underline"></button>
                                                <button class="ql-align"></button>
                                                <button class="ql-link"></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <button type="submit" class="btn btn-primary add-event-btn mr-1">Thêm</button>
                                        <button type="button" class="btn btn-outline-secondary btn-cancel" data-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-primary update-event-btn d-none mr-1">Cập nhật</button>
                                        <button class="btn btn-outline-danger btn-delete-event d-none">Xóa</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Calendar Add/Update/Delete event modal-->
            </section>
            <!-- Full calendar end -->

        </div>
    </div>
</div>

<script src="<?= HOME ?>/styles/app-assets/vendors/js/extensions/moment.min.js"></script>
<script src="<?= HOME ?>/styles/app-assets/vendors/js/calendar/fullcalendar.min.2.js"></script>
<script src="<?= HOME ?>/js/calendar.js"></script>