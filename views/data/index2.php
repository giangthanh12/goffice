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
                        <div class="col-md-4 data_nguoinhap"></div>
                        <div class="col-md-4 data_nhanvien"></div>
                        <div class="col-md-4 data_tinhtrang"></div>
                    </div>
                    <!-- users filter end -->
                    <!-- list section start -->
                    <div class="card">
                        <div class="card-datatable table-responsive pt-0">
                            <table class="user-list-table table">
                                <thead class="thead-light">
                                    <tr>
                                        <th><input type="checkbox" id="check_all_students" data-to-table="tasks"></th>
                                        <th>Họ tên</th>
                                        <th>Công ty</th>
                                        <th>Điện thoại bàn</th>
                                        <th>Di động</th>
                                        <th>Giao cho</th>
                                        <th>...</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
            </section>
        </div>
    </div>
</div>
<script>
    let email = '<?php echo $_SESSION['user']['email'] ?>';
</script>
<script src="<?= HOME ?>/js/data/index.js"></script>