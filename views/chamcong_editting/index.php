<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-calendar.css">
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Full calendar start -->
            <section>
                <div class="app-calendar overflow-hidden border">
                    <div class="row no-gutters">
                        <!-- Sidebar -->
                        <div class="col app-calendar-sidebar flex-grow-0 overflow-hidden d-flex flex-column"
                             id="app-calendar-sidebar">
                            <div class="sidebar-wrapper">
                                <div class="card-body d-flex justify-content-center">
                                    <button class="btn btn-success btn-toggle-sidebar btn-block waves-effect waves-float waves-light" id="checkoutBtn">
                                        <span class="align-middle">Checkout</span>
                                    </button>
                                </div>
                                <div class="card-body d-flex justify-content-center">
                                    <select class="select2 select-label form-control w-100" id="selectNhanVien" name="selectNhanVien">
                                    </select>
                                </div>
                                <div class="card-body pb-0">
                                    <h5 class="section-label mb-1">
                                        <span class="align-middle">Lọc</span>
                                    </h5>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input select-all" id="select-all"
                                               checked="">
                                        <label class="custom-control-label" for="select-all">Tất cả</label>
                                    </div>
                                    <div class="calendar-events-filter">
                                        <div class="custom-control custom-control-info custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input input-filter" id="1"
                                                   data-value="1" checked="">
                                            <label class="custom-control-label" for="1">Đúng giờ</label>
                                        </div>
                                        <div class="custom-control custom-control-danger custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input input-filter" id="2"
                                                   data-value="2" checked="">
                                            <label class="custom-control-label" for="2">Đi muộn</label>
                                        </div>
                                        <div class="custom-control  custom-control-warning  custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input input-filter" id="3"
                                                   data-value="3" checked="">
                                            <label class="custom-control-label" for="3">Về sớm</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-auto">
                                <img src="<?= HOME ?>/styles/app-assets/images/pages/calendar-illustration.png"
                                     alt="Calendar illustration" class="img-fluid">
                            </div>
                        </div>
                        <!-- /Sidebar -->

                        <!-- Calendar -->
                        <div class="col position-relative">
                            <div class="card shadow-none border-0 mb-0 rounded-0">
                                <div class="card-body pb-0">
                                    <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-standard">
                                        <div class="fc-header-toolbar fc-toolbar ">
                                            <div class="fc-toolbar-chunk">
                                                <div class="fc-button-group">
                                                    <button class="fc-sidebarToggle-button fc-button fc-button-primary"
                                                            type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round" class="feather feather-menu ficon">
                                                            <line x1="3" y1="12" x2="21" y2="12"></line>
                                                            <line x1="3" y1="6" x2="21" y2="6"></line>
                                                            <line x1="3" y1="18" x2="21" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                    <button class="fc--button fc-button fc-button-primary"
                                                            type="button"></button>
                                                </div>
                                                <div class="fc-button-group">
                                                    <button class="fc-prev-button fc-button fc-button-primary"
                                                            type="button" aria-label="prev"><span
                                                                class="fc-icon fc-icon-chevron-left"></span></button>
                                                    <button class="fc-next-button fc-button fc-button-primary"
                                                            type="button" aria-label="next"><span
                                                                class="fc-icon fc-icon-chevron-right"></span></button>
                                                    <button class="fc--button fc-button fc-button-primary"
                                                            type="button"></button>
                                                </div>
                                                <h2 class="fc-toolbar-title">November 2021</h2></div>
                                            <div class="fc-toolbar-chunk"></div>
                                            <div class="fc-toolbar-chunk">
                                                <div class="fc-button-group">
                                                    <button class="fc-dayGridMonth-button fc-button fc-button-primary fc-button-active"
                                                            type="button">month
                                                    </button>
                                                    <button class="fc-timeGridWeek-button fc-button fc-button-primary"
                                                            type="button">week
                                                    </button>
                                                    <button class="fc-timeGridDay-button fc-button fc-button-primary"
                                                            type="button">day
                                                    </button>
                                                    <button class="fc-listMonth-button fc-button fc-button-primary"
                                                            type="button">list
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                <h5 class="modal-title">Sửa giờ checkin/checkout</h5>
                            </div>
                            <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                <form id="frmCong" class="event-form needs-validation" data-ajax="false" novalidate="novalidate">
                                    <div class="form-group">
                                        <label for="ngay" class="form-label">Ngày</label>
                                        <input type="text" class="form-control" id="ngay" name="ngay"
                                               placeholder="Ngày chấm công" required="true" readonly>
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="giovao" class="form-label">Giờ vào</label>
                                        <input type="text" class="form-control flatpickr-input" id="giovao"
                                               name="giovao" placeholder="Giờ vào">
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="giora" class="form-label">Giờ ra</label>
                                        <input type="text" class="form-control flatpickr-input" id="giora"
                                               name="giora" placeholder="Giờ ra" >
                                    </div>
<!--                                    <div class="form-group">-->
<!--                                        <label for="selectCongSang" class="form-label">Công sáng</label>-->
<!--                                        <select class="select2 select-label form-control w-100" id="selectCongSang" name="select-label">-->
<!--                                            <option data-label="" value="0" selected>Chưa tính công</option>-->
<!--                                            <option data-label="info" value="1">Đủ công</option>-->
<!--                                            <option data-label="success" value="2">Nghỉ phép</option>-->
<!--                                            <option data-label="warning" value="3">Công tác</option>-->
<!--                                            <option data-label="" value="4">Nghỉ lễ</option>-->
<!--                                            <option data-label="" value="5">Nghỉ tết</option>-->
<!--                                            <option data-label="warning" value="6">Nghỉ bù</option>-->
<!--                                            <option data-label="" value="7">Nghỉ khác có lương</option>-->
<!--                                            <option data-label="dark" value="8">Nghỉ không lương</option>-->
<!--                                            <option data-label="danger" value="9">Nghỉ ốm</option>-->
<!--                                            <option data-label="primary" value="10">Nghỉ không lý do</option>-->
<!--                                            <option data-label="danger" value="11">Đi muộn/về sớm</option>-->
<!--                                        </select>-->
<!--                                    </div>-->
<!--                                    <div class="form-group">-->
<!--                                        <label for="selectCongChieu" class="form-label">Công chiều</label>-->
<!--                                        <select class="select2 select-label form-control w-100" id="selectCongChieu" name="select-label">-->
<!--                                            <option data-label="" value="0" selected>Chưa tính công</option>-->
<!--                                            <option data-label="info" value="1">Đủ công</option>-->
<!--                                            <option data-label="success" value="2">Nghỉ phép</option>-->
<!--                                            <option data-label="warning" value="3">Công tác</option>-->
<!--                                            <option data-label="" value="4">Nghỉ lễ</option>-->
<!--                                            <option data-label="" value="5">Nghỉ tết</option>-->
<!--                                            <option data-label="warning" value="6">Nghỉ bù</option>-->
<!--                                            <option data-label="" value="7">Nghỉ khác có lương</option>-->
<!--                                            <option data-label="dark" value="8">Nghỉ không lương</option>-->
<!--                                            <option data-label="danger" value="9">Nghỉ ốm</option>-->
<!--                                            <option data-label="primary" value="10">Nghỉ không lý do</option>-->
<!--                                            <option data-label="danger" value="11">Đi muộn/về sớm</option>-->
<!--                                        </select>-->
<!--                                    </div>-->
                                    <div class="form-group">
                                        <label class="form-label">Ghi chú</label>
                                        <textarea name="ghichu" id="ghichu"
                                                  class="form-control"></textarea>
                                    </div>
                                    <div class="form-group d-flex">
<!--                                        <button type="submit"-->
<!--                                                class="btn btn-primary add-event-btn mr-1 waves-effect waves-float waves-light">-->
<!--                                            Add-->
<!--                                        </button>-->
                                        <button type="submit" id="updateEvent"
                                                class="btn btn-primary update-event-btn mr-1 waves-effect waves-float waves-light">
                                            Update
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary btn-cancel waves-effect"
                                                data-dismiss="modal">Cancel
                                        </button>
<!--                                        <button class="btn btn-outline-danger btn-delete-event d-none waves-effect">-->
<!--                                            Delete-->
<!--                                        </button>-->
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
<script src="<?= HOME ?>/styles/app-assets/vendors/js/calendar/fullcalendar.min.js"></script>
<script src="<?= HOME ?>/js/chamcong.js"></script>
<!--<script src="--><? //=HOME?><!--/styles/app-assets/js/scripts/pages/app-calendar.js"></script>-->