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
                                    <th>Tài sản</th>
                                    <th>SL bảo hành</th>
                                    <th>SL đã lấy</th>
                                    <th>Ghi chú</th>
                                    
                                    <th>Lịch sử BH</th>
                                    <th>...</th>

                                </tr>
                            </thead>
                        </table>
                    </div>


                    <div class="modal modal-slide-in new-user-modal fade" id="updateinfo">
                        <div class="modal-dialog">
                            <form class="add-new-user modal-content pt-0" id="dg">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="id_ts" id="id_ts">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>

                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Bảo hành</h5>
                                </div>

                                <div class="modal-body flex-grow-1">
                                    <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                       
                                        <div class="form-group">
                                            <label class="form-label" for="dien_thoai">Tài sản</label>
                                            <select name="tai_san" id="tai_san" class="select2-data-array  form-control" onchange="checkvali()"></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="hoten">Số lượng</label>
                                            <input id="so_luong" type="number" class="form-control" onkeyup="checkvali()" name="so_luong" min="1" />
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="hoten">Ngày gửi BH</label>
                                            <input id="ngay_gio" type="text" class="form-control ngay_gio" name="ngay_gio" />
                                        </div>
                                        <div class="form-group">
                                            <label for="hoten">Ghi chú</label>
                                            <textarea id="ghi_chu" class="form-control" name="ghi_chu"></textarea>
                                        </div>

                                        <button type="button" id="btn_add" class="btn btn-primary mr-1 data-submit" onclick="savetk()">Lưu</button>

                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                    </div>
                                    </div>

                                    

                                </div>

                            </form>
                        </div>

                    </div>


            <!--end modal-->
            <div class="modal modal-slide-in new-user-modal fade" id="thuhoi">

                        <div class="modal-dialog">

                            <form class="add-new-user modal-content pt-0" id="dg_th">
                                <input type="hidden" name="id_bh" id="id_bh">
                                <input type="hidden" name="id_tsth" id="id_tsth">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>

                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Lấy bảo hành</h5>
                                </div>

                                <div class="modal-body flex-grow-1">
                                    <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        

                                        <div class="form-group">
                                            <label class="form-label" for="dien_thoai">Tài sản</label>
                                            <select name="tai_san_th" id="tai_san_th" class="select2-data-array  form-control"></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="hoten">Số lượng</label>
                                            <input id="so_luong_th" type="number" class="form-control" onkeyup="checkvali_th()" name="so_luong_th" min="1" />
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="hoten">Thời gian</label>
                                            <input id="ngay_gio_th" type="text" class="form-control ngay_gio" name="ngay_gio_th" />
                                        </div>
                                        <div class="form-group">
                                            <label for="hoten">Ghi chú</label>
                                            <textarea id="ghi_chu_th" class="form-control" name="ghi_chu_th"></textarea>
                                        </div>

                                        <button type="button" id="btn_add_th" class="btn btn-primary mr-1 data-submit" onclick="saveth()">Lấy bảo hành</button>

                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                    </div>
                                    </div>

                                    

                                </div>

                            </form>
                        </div>

                    </div>
            <!--end modal-->
            <!-- modal LICH SU-->
            <div class="modal fade text-left" id="lichsu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
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
                                    <table class="list-baohanh table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Thời gian</th>
                                                    <th>Tài sản</th>
                                                    <th>Số lượng</th>
                                                    <th>Ghi chú</th>
                                                    <th>Tình trạng</th>
                                                </tr>
                                            </thead>
                                    </table>
                                    <button type="reset" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!--end modal LICH SU-->





                </div>
            </section>
        </div>
    </div>
</div>
<script src="<?= HOME ?>/js/baohanh.js"></script>