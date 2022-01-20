<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- Row grouping -->
            <section id="row-grouping-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="d-flex align-items-center mx-50 row pt-2">
                                <div class="col-md-3 data_nhanvien form-group">
                                    <label for="thang">Tháng</label>
                                    <select id="thang" class="select2 form-control" name="thang"></select>
                                </div>

                                <div class="col-md-3 data_nhanvien form-group">
                                    <label for="nam">Năm</label>
                                    <select id="nam" class="select2 form-control" name="nam"></select>
                                </div>
                                <button type="button" class="btn btn-icon btn-outline-primary waves-effect" style="margin-top:10px" title="Tìm kiếm" onclick="search()">Tìm kiếm</button>
                            </div>
                            <div class=" d-flex align-items-center mx-50 row">
                                <button type="button" class="dt-button add-new btn btn-primary mt-50" style="margin-top:10px" title="Lập bảng" onclick="add()">Lập bảng lương</button>
                                <button type="button" class="dt-button add-new btn btn-primary mt-50 ml-1" style="margin-top:10px" title="Lập bảng" onclick="add()">Điều chỉnh</button>
                                <button type="button" class="dt-button add-new btn btn-primary mt-50 ml-1" style="margin-top:10px" title="Lập bảng" onclick="add()">Duyệt bảng lương</button>
                            </div>
                            <div class="card-datatable">
                                <table class="datatables-basic table " id="tableBasic">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Nhân viên</th>
                                            <th>Công chuẩn</th>
                                            <th>Lương HĐ</th>
                                            <th>KPI(%)</th>
                                            <th>Lương TT</th>
                                            <th>Ngày công</th>
                                            <th>Lương t/g</th>
                                            <th>Phụ cấp</th>
                                            <th>Thưởng DS</th>
                                            <th>Thưởng lễ tết</th>
                                            <th>Thưởng khác</th>
                                            <th>Tổng cộng</th>
                                            <th>Bảo hiểm</th>
                                            <th>Tạm ứng</th>
                                            <th>Thực lĩnh</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- Modal to add new record -->

                        </div>
                    </div>
                </div>
            </section>
            <!--/ Row grouping -->
        </div>
    </div>
</div>
<script>
    let thang = "<?= date('m') ?>";
    let nam = "<?= date('Y') ?>";
</script>
<script src="<?= HOME ?>/styles/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
<script src="<?= HOME ?>/js/bangluong.js"></script>