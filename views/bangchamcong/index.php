<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <!-- list section start -->
                <div class="card">
                    <div class="d-flex align-items-center mx-50 row pt-2">
                        <div class="col-md-2 data_nhanvien form-group">
                            <label for="thang">Tháng</label>
                            <select id="thang" class="select2 form-control" name="thang"></select>
                        </div>

                        <div class="col-md-2 data_nhanvien form-group">
                            <label for="nam">Năm</label>
                            <select id="nam" class="select2 form-control" name="nam"></select>
                        </div>
                        <button type="button" class="btn btn-icon btn-outline-primary waves-effect" style="margin-top:10px" title="Tìm kiếm" onclick="search()">Tìm kiếm</button>
                    </div>
                    <div class="col-md-2 d-flex align-items-center mx-50 row">
                        <button type="button" class="dt-button add-new btn btn-primary mt-50" style="margin-top:10px" title="Lập bảng" onclick="add()">Lập bảng</button>
                    </div>
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr id="tb-bangchamcong">
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
    let thang = "<?= date('m') ?>";
    let nam = "<?= date('Y') ?>";
</script>
<script src="<?= HOME ?>/js/bangchamcong.js"></script>