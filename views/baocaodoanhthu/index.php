
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
                <div class="card">
                    <div class="d-flex  align-items-center mx-50 row pt-2 pb-2">
                        <div class="col-md-3"><input type="text" placeholder="Thời gian từ" id="time_s" name="time_s" class="ngay_gio form-control"></div>
                        <div class="col-md-3"><input type="text" placeholder="đến" id="time_e" name="time_e" class="ngay_gio form-control"></div>
                        <div class="col-md-2"><button type="button" class="btn btn-primary" onclick="loc()">Lọc</button></div>
                        
                    </div>
                </div>

                <div class="">
                    <div class="card card-revenue-budget">
                        <div class="">
                            <div class="col-md-12 col-12 revenue-report-wrapper">
                                <div class="">
                                    <h4 class="col-md-12 col-12" id="title_thongke">Thống kê doanh thu</h4>
                                    <div class="col-md-12 col-12">
                                    <div class="row  mt-3">
                                        <div class="col-xl-3 col-sm-6 col-12">
                                        <div class="media">
                                            <div class="avatar bg-light-success mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0" id="doanh_so_all"></h4>
                                                <p class="card-text font-small-3 mb-0">Doanh số</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="media">
                                            <div class="avatar bg-light-primary mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="log-in" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0" id="thuc_thu_all"></h4>
                                                <p class="card-text font-small-3 mb-0">Thực thu</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="media">
                                            <div class="avatar bg-light-info mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="log-out" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0" id="chi_all"></h4>
                                                <p class="card-text font-small-3 mb-0">Chi</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                        <div class="media">
                                            <div class="avatar bg-light-danger mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="box" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0" id="so_no_all"></h4>
                                                <p class="card-text font-small-3 mb-0">Số nợ</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>


                                <div class=" mb-2  mt-3 ">
                                        <div class="d-flex align-items-center ml-2">
                                            <div class="d-flex align-items-center mr-2">
                                                <span class="bullet bullet-primary font-small-3 mr-50 cursor-pointer"></span>
                                                <span>Doanh thu</span>
                                            </div>
                                            <div class="d-flex align-items-center ml-75">
                                                <span class="bullet bullet-warning font-small-3 mr-50 cursor-pointer"></span>
                                                <span>Chi phí</span>
                                            </div>
                                            <div class="d-flex align-items-center ml-2">
                                                <span class="bullet bullet-success font-small-3 mr-50 cursor-pointer"></span>
                                                <span>Đơn vị tính - <b>Triệu</b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="revenue-report-chart"></div>
                                </div>
                            
                        </div>
                    </div>
                </div>






            <!-- users list start -->
            <section class="app-user-list">
               
                <!-- users filter end -->
                <!-- list section start -->
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <!-- <th></th> -->
                                    <th>Thời gian</th>
                                    <th>Nhân viên</th>
                                    <th>Diễn Giải</th>
                                    <th>Số tiền</th>
                                    <th>Số dư</th>
                                    <th>Loại</th>
                                    <th>Tài khoản</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
       
            </section>
        </div>
    </div>
</div>
<script src="<?=HOME?>/styles/app-assets/vendors/js/charts/apexcharts.min.js"></script>
<script src="<?= HOME ?>/js/baocaodoanhthu.js"></script>