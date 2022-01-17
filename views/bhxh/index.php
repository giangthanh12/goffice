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
                                    <th>Mã BHXH</th>
                                    <th>Mức đóng</th>
                                    <th>Tỉnh thành</th>
                                    <th>Nơi đóng BHXH</th>
                                   
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16"></h4>
                                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button> -->
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" enctype="multipart/form-data" id="dg">
                                                <div class="row mt-1">
                                                <input type="hidden" name="id" id="id">
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Nhân viên</label>
                                                            <select name="nhan_vien" id="nhan_vien" class="select2-data-array  form-control" onchange="checkform();"></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="so_tk">Số BHXH</label>
                                                            <input id="ma_bhxh" type="text" class="form-control" name="ma_bhxh" onkeyup="checkform();" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Mức đóng BHXH</label>
                                                            <input id="muc_dong" type="text" class="form-control format_number" placeholder="10,000,000" name="muc_dong" onkeyup="checkform();" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Tỉnh thành</label>
                                                            <select name="thanh_pho" id="thanh_pho" class="select2-data-array  form-control"></select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <h4 class="mb-1"><span class="align-middle">Thông tin</span></h4>
                                                    </div>
                                                    <div class="col-lg-2 col-md-3">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Công ty hỗ trợ (%)</label>
                                                            <input id="cty_dong" type="text" onkeyup="checkform();" class="form-control format_number" name="cty_dong" placeholder="%" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-3">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Người lao động đóng (%)</label>
                                                            <input id="nld_dong" type="text" onkeyup="checkform();" class="form-control format_number" name="nld_dong" placeholder="%" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-3">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Thời gian tham gia</label>
                                                            <input id="ngay_gio" type="text" class="form-control ngay_gio" name="ngay_gio"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-12"></div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Đơn vị BHXH</label>
                                                            <input id="diadiem_dk" type="text" class="form-control" placeholder="BHXH quận..." name="diadiem_dk" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Đơn vị đăng ký khám chữa bệnh</label>
                                                            <input id="diadiem_dkkcb" type="text" class="form-control" name="diadiem_dkkcb" placeholder="Phòng khám..." />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Ghi chú</label>
                                                            <textarea id="ghi_chu"  class="form-control" name="ghi_chu"></textarea>
                                                        </div>
                                                    </div>

                            
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="button" id="btn_add" onclick="savetk()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


            <!--end modal-->
            <div class="modal modal-slide-in new-user-modal fade" id="thuhoi">

                        <div class="modal-dialog">

                            <form class="add-new-user modal-content pt-0" id="dg_bg">
                                <input type="hidden" name="id_bhxh" id="id_bhxh">
                                <input type="hidden" name="id_nhanvien" id="id_nhanvien">
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

                                        <button type="button" id="btn_add_bg" class="btn btn-primary mr-1 data-submit" onclick="savebg()">Báo giảm</button>

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
<script src="<?= HOME ?>/js/bhxh.js"></script>