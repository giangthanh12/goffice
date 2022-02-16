<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0" style="border-right: none;">Kết quả chiến dịch
                            <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip"
                                data-toggle="tooltip" data-placement="right"
                                data-original-title="Là chức năng quản lý kết quả đạt được của từng chiến dịch tuyển dụng"
                                data-trigger="click"></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- users list start -->
        <section class="app-user-list">
            <!-- users filter start -->
            <div class="card">
            </div>
            <!-- users filter end -->
            <!-- list section start -->
            <div class="card">
                <div class="card-datatable table-responsive pt-0">
                    <table class="user-list-table table">
                        <thead class="thead-light">
                            <tr>
                                <th>Tên chiến dịch</th>
                                <th>Phòng ban</th>
                                <th>Vị trí</th>
                                <th>Kế hoạch tuyển dụng</th>
                                <th>Số phỏng vấn</th>
                                <th>Số đạt yêu cầu</th>
                                <th>Số nhận việc</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
</div>

<script src="<?= HOME ?>/js/recruitment_result.js"></script>