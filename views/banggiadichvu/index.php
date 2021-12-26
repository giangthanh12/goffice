<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <!-- users filter start -->
                <!-- <div class="card">
                    <div class="d-flex align-items-center mx-50 row pt-2 pb-2">
                        <div class="col-md-3 fillter_phanloai"></div>
                        <div class="col-md-3 fillter_giahan"></div>
                    </div>
                </div> -->
                <!-- users filter end -->
                <!-- list section start -->
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <!-- <th></th> -->
                                    <th>Dịch vụ</th>
                                    <th>Bắt đầu</th>
                                    <th>Kết thúc</th>
                                    <th>Đơn giá</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

            <!--end modal-->
            <div class="modal modal-slide-in new-user-modal fade" id="updateinfo">
                        <div class="modal-dialog">
                            <form class="add-new-user modal-content pt-0" id="dg">
                                <input type="hidden" name="id" id="id">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Báo giảm BHXH</h5>
                                </div>

                                <div class="modal-body flex-grow-1">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="name">Dịch vụ</label>
                                                <select name="dich_vu" id="dich_vu" class="select2-data-array  form-control" onchange="checkform();"></select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                    <label for="hoten">Bắt đầu</label>
                                                    <input id="ngay_gio_s" type="text" class="form-control ngay_gio" name="ngay_gio_s" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                    <label for="hoten">Kết thúc</label>
                                                    <input id="ngay_gio_e" type="text" class="form-control ngay_gio" name="ngay_gio_e" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                    <label for="hoten">Đơn giá áp dụng</label>
                                                    <input id="so_tien" type="text" class="form-control format_number" onblur="checkform();" name="so_tien" />
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="hoten">Ghi chú</label>
                                                <textarea id="ghi_chu" class="form-control" name="ghi_chu"></textarea>
                                            </div>

                                            <button type="button" id="btn_add" class="btn btn-primary mr-1 data-submit" onclick="savetk()">Áp dụng</button>
                                            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                        </div>
                                    </div>

                                    

                                </div>

                            </form>
                        </div>

                    </div>
            <!--end modal-->




                </div>
            </section>
        </div>
    </div>
</div>
<script src="<?= HOME ?>/js/banggiadichvu.js"></script>