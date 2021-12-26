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
                    <?php
                    $nhanvien = $_SESSION['user']['staffId'];
                        if(in_array($nhanvien,[1,7,8,11,27])){
                    ?>
                    <div class=" d-flex align-items-center mx-50 row">
                        <button type="button" class="dt-button add-new btn btn-primary mt-50 ml-1" style="margin-top:10px" title="Lập bảng" onclick="lapbang()">Lập bảng lương</button>
                        <button type="button" class="dt-button add-new btn btn-primary mt-50 ml-1" style="margin-top:10px" title="Lập bảng" onclick="update()">Điều chỉnh</button>
                        <button type="button" class="dt-button add-new btn btn-primary mt-50 ml-1" style="margin-top:10px" title="Lập bảng" onclick="duyet()">Duyệt bảng lương</button>
                    </div>
                    <?php }?>
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
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

                    <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modal-title"></h4>
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" enctype="multipart/form-data" id="dg">
                                                <div class="form-group">
                                                    <label for="nhan_vien">Họ tên</label>
                                                    <input id="nhan_vien" type="text" class="form-control" name="nhan_vien" disabled />
                                                </div>

                                                <div class="form-group">
                                                    <label for="thuong_ds">Thưởng doanh số</label>
                                                    <input id="thuong_ds" type="text" class="form-control format_number" name="thuong_ds" />
                                                </div>

                                                <div class="form-group">
                                                    <label for="thuong_lt">Thưởng lễ tết</label>
                                                    <input id="thuong_lt" type="text" class="form-control format_number" name="thuong_lt" />
                                                </div>

                                                <div class="form-group">
                                                    <label for="thuong_khac">Thưởng khác</label>
                                                    <input id="thuong_khac" type="text" class="form-control format_number" name="thuong_khac" />
                                                </div>

                                                <!-- <div class="form-group">
                                                    <label for="tam_ung">Tạm ứng</label>
                                                    <input id="tam_ung" type="text" class="form-control" name="tam_ung" />
                                                </div> -->
                                                
                                                </div>
                                                <div class="d-flex flex-sm-row flex-column mt-2">
                                                    <button type="button" onclick="saveupdate()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<script src="<?= HOME ?>/js/bangluong.js"></script>