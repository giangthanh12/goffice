<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="card">
                <div class="d-flex  align-items-center mx-50 row pt-2 pb-2">
                <h2 class="content-header-title float-left mb-0" id="title_module">
                        Doanh thu <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng ..." data-trigger="click" >
                    </h2>
                    <div class="col-md-3"><div class="staff_filter"></div></div>
                    <div class="col-md-6"><div class="customer_filter"></div></div>
                    <!-- <div class="col-md-3"><div class="year_filter"></div></div> -->
                    <!-- <div class="col-md-3"><button type="button" class="btn btn-primary" onclick="loc()">Lọc</button> -->
                    </div>
                    
                </div>
            </div>

            <div class="">
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
                                        <th>Khách hàng</th>
                                        <th>NV Sale</th>
                                        <th>Đơn hàng/Hợp đồng</th>
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
    <script src="<?= HOME ?>/js/baocaodoanhthu.js"></script>