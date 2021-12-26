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
                    <div class="d-flex  align-items-center mx-50 row pt-2 pb-2">
                        <div class="col-md-2 fillter_ngaygio"></div>
                        <div class="col-md-2 fillter_nhanvien"></div>
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
                                    <th>Nhân viên</th>
                                    <th>Mã BHXH</th>
                                    <th>Mức đóng</th>
                                    <th>NLĐ đóng %</th>
                                    <th>Cty đóng %</th>
                                    <th>Số tiền</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal modal-slide-in fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
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
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">Nhân viên</label>
                                                            <select name="nhan_vien" id="nhan_vien" class="select2-data-array  form-control" onchange="checkform();"></select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Mức đóng BHXH</label>
                                                            <input id="muc_dong" type="text" class="form-control format_number" name="muc_dong" disabled />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Số tiền phải đóng</label>
                                                            <input id="so_tien" type="text" class="form-control format_number"  name="so_tien" disabled />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Thời gian</label>
                                                            <input id="ngay_gio" type="text" class="form-control ngay_gio" name="ngay_gio" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Ghi chú</label>
                                                            <textarea id="ghi_chu"  class="form-control"  onblur="checkform();" name="ghi_chu"></textarea>
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

                    <div class="modal modal-slide-in fade text-left" id="dongbhall" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
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
                                            <form class="form-validate" enctype="multipart/form-data" id="dg_all">
                                                <div class="row mt-1">
                                               
                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Đóng BHXH cho tất cả nhân viên trong công ty, ngoại trừ các nhân viên bị "Báo Giảm BHXH" </label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Thời gian</label>
                                                            <input id="ngay_gio_all" type="text" class="form-control ngay_gio" name="ngay_gio_all" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Ghi chú</label>
                                                            <textarea id="ghi_chu_all"  class="form-control" name="ghi_chu_all"></textarea>
                                                        </div>
                                                    </div>

                            
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="button" id="btn_add" onclick="saveall()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Xác nhận</button>
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






                </div>
            </section>
        </div>
    </div>
</div>
<script src="<?= HOME ?>/js/bhxh-lichsu.js"></script>