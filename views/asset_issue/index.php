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
                        <div class="col-md-4 taisan_filter"></div>
                        <div class="col-md-4 nhanvien_filter"></div>
                    </div>
                </div>
                <!-- users filter end -->
                <!-- list section start -->
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Thời gian</th>
                                    <th>Mã cấp phát</th>
                                    <th>Mã tài sản</th>
                                    <th>Tài sản</th>
                                    <th>Nhân viên</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                        </table>
                    </div>


                    <div class="modal modal-slide-in new-user-modal fade" id="updateinfo">

                        <div class="modal-dialog">

                            <form class="add-new-user modal-content pt-0" id="dg">
                                <input type="hidden" name="id" id="id">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>

                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Cấp phát</h5>
                                </div>

                                <div class="modal-body flex-grow-1">
                                    <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="nhan_vien">Nhân viên</label>
                                            <select name="nhan_vien" id="nhan_vien" class="select2 form-control"></select>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="tai_san">Tài sản</label>
                                            <select name="tai_san" id="tai_san" class="select2 form-control" ></select>
                                        </div>
                                    </div>
                              
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="dat_coc">Đặt cọc</label>
                                            <input id="dat_coc" type="text" class="form-control format_number" name="dat_coc" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="ngay_gio">Ngày cấp</label>
                                            <input id="ngay_gio" type="text" class="form-control ngay_gio" name="ngay_gio" />
                                        </div>
                                        <div class="form-group">
                                            <label for="ghi_chu">Ghi chú</label>
                                            <textarea id="ghi_chu" class="form-control" name="ghi_chu"></textarea>
                                        </div>
                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script>
    var userFuns = JSON.parse('<?=json_encode($this->funs)?>');
    console.log(userFuns);
</script>
<script src="<?= HOME ?>/js/asset_issue.js"></script>