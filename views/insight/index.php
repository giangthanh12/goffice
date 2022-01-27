<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <!-- users filter start -->
                <div class="card">
                    <div class="d-flex justify-content-between align-items-center mx-50 row pt-2 pb-2">
                        <div class="col-md-4 insight_filter">
                            <select name="insight_select" id="insight_select"
                                class="form-control text-capitalize mb-md-0 mb-2">>
                                <option value="doanhthu">Báo cáo Doanh Thu</option>
                                <option value="chiphi">Báo cáo Chi phí</option>
                                <option value="tonkho">Báo cáo Hàng tồn kho</option>
                                <option value="dongtien">Báo cáo Dòng tiền</option>
                                <option value="donhang">Báo cáo Đơn hàng</option>
                                <option value="invoice">Báo cáo Dịch vụ tới hạn</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary formtype" id="table"><i
                                    class="fas fa-table"></i></button>
                            <button type="button" class="btn btn-primary formtype hidden" id="chart"><i
                                    class="fas fa-chart-bar"></i></button>
                        </div>
                    </div>
                </div>
                <!-- list section start -->
                <div class="card" id="acmTable"> 
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table" id="doanhthu">
                            <thead class="thead-light">
                                <tr>
                                    <!-- <th></th> -->
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
            </section>
        </div>
    </div>
</div>
<script src="<?= HOME ?>/js/insight.js"></script>
<script src="<?= HOME ?>/js/chart-chartjs.js"></script>
<script src="<?= HOME ?>/js/chart-chartjs.min.js"></script>