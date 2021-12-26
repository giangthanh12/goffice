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
                                    <!-- <th></th> -->
                                    <th>Thời gian</th>
                                    <th>Mã cấp phát</th>
                                    <th>Tài sản</th>
                                    <th>Số lượng</th>
                                    <th>Ghi chú</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>


                    <div class="modal modal-slide-in new-user-modal fade" id="updateinfo">

                        <div class="modal-dialog">

                            <form class="add-new-user modal-content pt-0" id="dg">
                                <input type="hidden" name="id_th" id="id_th">
                                <input type="hidden" name="id_cp" id="id_cp">
                                <input type="hidden" name="id_ts" id="id_ts">
                                <input type="hidden" name="sl_th_old" id="sl_th_old">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>

                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Sửa thu hôi</h5>
                                </div>

                                <div class="modal-body flex-grow-1">
                                    <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="fullname">Mã cấp phát</label>
                                            <select name="cap_phat" id="cap_phat" class="select2-data-array  form-control" ></select>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="dien_thoai">Tài sản</label>
                                            <select name="tai_san" id="tai_san" class="select2-data-array  form-control" ></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="hoten">Số lượng</label>
                                            <input id="so_luong" type="number" class="form-control" onkeyup="checkvali_th()" name="so_luong" min="1" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="hoten">Trả cọc</label>
                                            <input id="tra_coc" type="text" class="form-control format_number" name="tra_coc" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="hoten">Ngày thu hồi</label>
                                            <input id="ngay_gio" type="text" class="form-control ngay_gio" name="ngay_gio"  />
                                        </div>
                                        <div class="form-group">
                                            <label for="hoten">Ghi chú</label>
                                            <textarea id="ghi_chu" class="form-control" name="ghi_chu" onblur="checkvali_th()"></textarea>
                                        </div>

                                        <button type="button" id="btn_add" class="btn btn-primary mr-1 data-submit" onclick="saveth()">Lưu</button>

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
<script src="<?= HOME ?>/js/taisanthuhoi.js"></script>