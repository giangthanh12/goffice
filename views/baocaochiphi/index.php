<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="card">
                <div class="d-flex  align-items-center mx-50 row pt-2 pb-2">
                    <div class="col-md-3"><div class="staff_filter"></div></div>
                    <div class="col-md-6"><div class="customer_filter"></div></div>
                    <!-- <div class="col-md-3"><div class="year_filter"></div></div> -->
                    <!-- <div class="col-md-3"><button type="button" class="btn btn-primary" onclick="loc()">Lọc</button> -->
                    </div>
                    
                </div>
            </div>

            <div class="">
                <div class="card card-revenue-budget">
                    <div class="">
                        <div class="col-md-12 col-12 revenue-report-wrapper">
                            <div class="">
                                <h4 class="col-md-12 col-12" id="title_thongke">Thống kê chi phí</h4>
                                <div class="col-md-12 col-12">
                                    <div class="row  mt-3">
                                        <div class="col-xl-4 col-sm-6 col-12">
                                            <div class="media">
                                                <div class="avatar bg-light-success mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0" id="doanh_so_all"><?php echo $this->doanhso[0]["doanhThu"]; ?> VNĐ</h4>
                                                    <p class="card-text font-small-3 mb-0">Doanh số</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="media">
                                                <div class="avatar bg-light-primary mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="log-in" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0" id="thuc_thu_all"><?php echo $this->thucthu[0]["thucThu"]; ?> VNĐ</h4>
                                                    <p class="card-text font-small-3 mb-0">Thực thu</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="media">
                                                <div class="avatar bg-light-info mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="log-out" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0" id="chi_all"><?php echo $this->thucchi[0]["thucChi"]; ?> VNĐ</h4>
                                                    <p class="card-text font-small-3 mb-0">Thực chi</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                        <th>Ngày</th>
                                        <th>Đối tác/Nhà cung cấp</th>
                                        <th>Khoản chi</th>
                                        <th>Đơn hàng/Hợp đồng</th>
                                        <th>Nội dung</th>
                                        <th>Số tiền</th>
                                        <th>Ghi chú</th>
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
    <script src="<?= HOME ?>/js/baocaochiphi.js"></script>