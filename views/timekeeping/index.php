<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-calendar.css">
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="row">
                <!-- <div class="col-lg-2 card-body d-flex justify-content-center">
                    <button class="btn btn-success btn-toggle-sidebar btn-block waves-effect waves-float waves-light" id="checkoutBtn">
                        <span class="align-middle">Checkout</span>
                    </button>
                </div> -->
                <div class="col-lg-3 card-body">
                    <select class="select2 select-label form-control " id="selectStaff" name="selectStaff">
                    </select>
                </div>
            </div>
            <!-- Full calendar start -->
            <section>
                <div class="app-calendar overflow-hidden border">

                    <div class="row no-gutters">
                        <!-- Sidebar -->

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
                                <h5 class="modal-title">Cập nhật</h5>
                            </div>
                            <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                <form id="frmCong" class="event-form needs-validation" data-ajax="false" novalidate="novalidate">
                                    <div class="form-group">
                                        <label for="date" class="form-label">Ngày</label>
                                        <input type="text" class="form-control" id="date" name="date"
                                               placeholder="Ngày chấm công" required="true" readonly>
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="checkInTime" class="form-label">Giờ vào</label>
                                        <input type="text" class="form-control flatpickr-input" id="checkInTime"
                                               name="checkInTime" placeholder="Giờ vào">
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="checkOutTime" class="form-label">Giờ ra</label>
                                        <input type="text" class="form-control flatpickr-input" id="checkOutTime"
                                               name="checkOutTime" placeholder="Giờ ra" >
                                    </div>
                                    <div class="form-group d-flex">
                                        <!--                                        <button type="submit"-->
                                        <!--                                                class="btn btn-primary add-event-btn mr-1 waves-effect waves-float waves-light">-->
                                        <!--                                            Add-->
                                        <!--                                        </button>-->
                                        <button type="submit" id="updateEvent"
                                                class="btn btn-primary update-event-btn mr-1 waves-effect waves-float waves-light">
                                            Cập nhật
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary btn-cancel waves-effect"
                                                data-dismiss="modal">Hủy
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
<script>
    var funAdd = <?=$this->funAdd?>,
        funEdit = <?=$this->funEdit?>;
</script>
<script src="<?= HOME ?>/styles/app-assets/vendors/js/extensions/moment.min.js"></script>
<script src="<?= HOME ?>/styles/app-assets/vendors/js/calendar/fullcalendar.min.js"></script>
<script src="<?= HOME ?>/js/timekeeping.js"></script>
<!--<script src="--><? //=HOME?><!--/styles/app-assets/js/scripts/pages/app-calendar.js"></script>-->