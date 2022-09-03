<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-calendar.css">
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Full calendar start -->
            <div class="d-flex justify-content-between align-items-center mx-50 row pt-2 pb-2">
            <h2 class="content-header-title float-left mb-0" id="title_module" style="border-right-width: 0px;">
                Lịch phỏng vấn    <img src="<?= HOME ?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng quản lý lịch tham gia phỏng vấn của các ứng viên" data-trigger="click">

                        </h2>
            </div>
            <section>
                <div class="app-calendar overflow-hidden border">
                    <div class="row no-gutters">
                        <!-- Sidebar -->
                        <div class="col app-calendar-sidebar flex-grow-0 overflow-hidden d-flex flex-column" id="app-calendar-sidebar">
                            <div class="sidebar-wrapper">
                                <div class="card-body d-flex justify-content-center">
                                    <?php if ($this->funAdd == 1) { ?>
                                        <button class="btn btn-primary btn-toggle-sidebar btn-block" onclick="loadAdd()">
                                            <span class="align-middle">Thêm lịch phỏng vấn</span>
                                        </button>
                                    <?php } ?>
                                </div>
                                <div class="card-body d-flex justify-content-center ">
                                    <select class="select2 select-label form-control " id="selectNhanVien" name="selectNhanVien">
                                    </select>
                                </div>
                                <div class="card-body pb-0">
                                    <h5 class="section-label mb-1">
                                        <span class="align-middle">Lọc</span>
                                    </h5>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input select-all" id="select-all" checked="">
                                        <label class="custom-control-label" for="select-all">Tất cả</label>
                                    </div>
                                    <div class="calendar-events-filter">
                                        <div class="custom-control  custom-control-warning  custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input input-filter" id="1" data-value="1" checked="">
                                            <label class="custom-control-label" for="1">Hẹn phỏng vấn</label>
                                        </div>
                                        <div class="custom-control custom-control-success custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input input-filter" id="2" data-value="2" checked="">
                                            <label class="custom-control-label" for="2">Đạt</label>
                                        </div>
                                        <div class="custom-control custom-control-danger custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input input-filter" id="3" data-value="3" checked="">
                                            <label class="custom-control-label" for="3">Không đạt</label>
                                        </div>
                                        <div class="custom-control custom-control-danger custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input input-filter" id="4" data-value="4" checked="">
                                            <label class="custom-control-label" for="4">Từ chối</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-auto">
                                <img src="<?= HOME ?>/styles/app-assets/images/pages/calendar-illustration.png" alt="Calendar illustration" class="img-fluid">
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
                                                    <button class="fc-sidebarToggle-button fc-button fc-button-primary" type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu ficon">
                                                            <line x1="3" y1="12" x2="21" y2="12"></line>
                                                            <line x1="3" y1="6" x2="21" y2="6"></line>
                                                            <line x1="3" y1="18" x2="21" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                    <button class="fc--button fc-button fc-button-primary" type="button"></button>
                                                </div>
                                                <div class="fc-button-group">
                                                    <button class="fc-prev-button fc-button fc-button-primary" type="button" aria-label="prev"><span class="fc-icon fc-icon-chevron-left"></span></button>
                                                    <button class="fc-next-button fc-button fc-button-primary" type="button" aria-label="next"><span class="fc-icon fc-icon-chevron-right"></span></button>
                                                    <button class="fc--button fc-button fc-button-primary" type="button"></button>
                                                </div>
                                                <h2 class="fc-toolbar-title">November 2021</h2>
                                            </div>
                                            <div class="fc-toolbar-chunk"></div>
                                            <div class="fc-toolbar-chunk">
                                                <div class="fc-button-group">
                                                    <button class="fc-dayGridMonth-button fc-button fc-button-primary fc-button-active" type="button">month
                                                    </button>
                                                    <button class="fc-timeGridWeek-button fc-button fc-button-primary" type="button">week
                                                    </button>
                                                    <button class="fc-timeGridDay-button fc-button fc-button-primary" type="button">day
                                                    </button>
                                                    <button class="fc-listMonth-button fc-button fc-button-primary" type="button">list
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
                                <h5 class="modal-title">Thêm lịch phỏng vấn cho ứng viên</h5>
                            </div>
                            <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                <form id="interviewForm" class="event-form needs-validation" data-ajax="false" novalidate="novalidate">
                                    <input type="hidden" name="idInterview" id="idInterview">
                                    <div class="form-group">
                                        <label for="campId" class="form-label">Chương trình tuyển dụng<span style="color:red;">*</span></label>
                                        <select name="campId" id="campId" class="form-control select2"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="canId" class="form-label">Ứng viên<span style="color:red;">*</span></label>
                                        <select name="canId" id="canId" class="form-control select2" ></select>
                                    </div>
                                    <div class="row" id="div-cv">
                                        <p class="form-label col-8">CV</p>
                                        <p class="form-label col-4"><a id="showFileCv" target="_blank" href="" style="color: blue;">Tải xuống <i class="fas fa-download"></i></a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="dateTime" class="form-label">Lịch phỏng vấn<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control flatpickr-basic" id="dateTime" name="dateTime" placeholder="DD-MM-YYYY" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="dateTime" class="form-label">Giờ phỏng vấn<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="timeInterview" name="timeInterview" required="true">
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="interviewerIds" class="form-label">Người phỏng vấn<span style="color:red;">*</span></label>
                                        <select name="interviewerIds[]" id="interviewerIds" required data-msg-required="Yêu cầu chọn người phỏng vấn" multiple="multiple" class="form-control select2"></select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="round" class="form-label">Vòng phỏng vấn</label>
                                        <input type="number" min="1" class="form-control" id="round" name="round"
                                                required="true" >
                                    </div> -->
                                    <div class="form-group" id="div-result">
                                        <label for="round" class="form-label">Kết quả phỏng vấn</label>
                                        <select required data-msg-required="Yêu cầu chọn trạng thái" class="select2 select-label form-control w-100" id="result" name="result" required>
                                            <option data-label="#FF9F43" value="1">Hẹn phỏng vấn</option>
                                            <option data-label="#28C76F" value="2">Đạt</option>
                                            <option data-label="#EA5455" value="3">Không đạt</option>
                                            <option data-label="#E83E8C" value="4">Từ chối</option>

                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="form-label">Ghi chú</label>
                                        <textarea name="note" id="note" class="form-control"></textarea>
                                    </div> -->
                                    <div class="form-group">
                                        <label class="form-label" for="note">Ghi chú</label>
                                        <div id="note" class="border-bottom-0"></div>
                                        <div class="d-flex justify-content-end desc-toolbar border-top-0">
                                            <span class="ql-formats mr-0">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-align"></button>
                                            <button class="ql-align" value="center"></button>
                                            <button class="ql-align" value="right"></button>
                                            <button class="ql-align" value="justify"></button>
                                            <button class="ql-link"></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <button type="submit" id="updateInterview" class="btn btn-primary add-event-btn mr-1 waves-effect waves-float waves-light">

                                        </button>

                                        <button id="btn_delete" class="btn btn-outline-danger btn-delete-event mr-1 d-none waves-effect">
                                            Xóa
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary btn-cancel waves-effect" data-dismiss="modal">Đóng
                                        </button>

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
<style>
    .position-relative {
        width: 100%;
    }
</style>
<script>
    var funAdd = <?= $this->funAdd ?>,
        funEdit = <?= $this->funEdit ?>,
        funDel = <?= $this->funDel ?>;
</script>
<script src="<?= HOME ?>/styles/app-assets/vendors/js/extensions/moment.min.js"></script>
<script src="<?= HOME ?>/styles/app-assets/vendors/js/calendar/fullcalendar.min.js"></script>
<script src="<?= HOME ?>/js/interview.js"></script>
<!--<script src="--><? //=HOME
                    ?>
<!--/styles/app-assets/js/scripts/pages/app-calendar.js"></script>-->