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
                    <div class="d-flex justify-content-between align-items-center mx-50 row pt-2 pb-2">
                        <div class="col-md-4 kh_tinhtrang"></div>
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
                                    <th>Nhân viên</th>
                                    <th>Thời gian</th>
                                    <th>Lý do</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

            <!--end modal-->
            <div class="modal modal-slide-in new-user-modal fade" id="thuhoi">

                        <div class="modal-dialog">

                            <form class="add-new-user modal-content pt-0" id="dg_bg">
                                
                                <input type="hidden" name="id" id="id">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Báo giảm BHXH</h5>
                                </div>

                                <div class="modal-body flex-grow-1">
                                    <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                   
                                        <div class="form-group">
                                            <label for="name">Nhân viên</label>
                                            <select name="nhan_vien_bg" id="nhan_vien_bg" class="select2-data-array  form-control" disabled></select>
                                        </div>
                                                
                                        <div class="form-group">
                                            <label for="hoten">Thời gian</label>
                                            <input id="ngay_gio_bg" type="text" class="form-control ngay_gio" name="ngay_gio_bg" />
                                        </div>
                                        <div class="form-group">
                                            <label for="hoten">Lý do</label>
                                            <textarea id="ghi_chu_bg" class="form-control" name="ghi_chu_bg"></textarea>
                                        </div>

                                        <button type="button" id="btn_add_bg" class="btn btn-primary mr-1 data-submit" onclick="savebg()">Cập nhật</button>

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
<script src="<?= HOME ?>/js/bhxh-baogiam.js"></script>