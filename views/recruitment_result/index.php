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
                        <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng quản lý kết quả đạt được của từng chiến dịch tuyển dụng" data-trigger="click" >
                    </div>
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