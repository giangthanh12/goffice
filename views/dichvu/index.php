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
                    <div class="d-flex align-items-center mx-50 row pt-2 pb-2">
                        <div class="col-md-3 fillter_phanloai"></div>
                        <div class="col-md-3 fillter_giahan"></div>
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
                                    <th>Dịch vụ</th>
                                    <th>Phân loại</th>
                                    <th>Đơn giá</th>
                                    <th>Thuế VAT</th>
                                    <th>Gia hạn</th>
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
                                    
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" enctype="multipart/form-data" id="dg">
                                                <div class="row mt-1">
                                                <input type="hidden" name="id" id="id">
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="so_tk">Tên dịch vụ</label>
                                                            <input id="name" type="text" class="form-control" name="name" onkeyup="checkform();" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Loại dịch vụ</label>
                                                            <select name="phan_loai" id="phan_loai" class="select2-data-array  form-control" onchange="checkform();"></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Nhà cung cấp</label>
                                                            <select name="nhacungcap" id="nhacungcap" class="select2-data-array  form-control" onchange="checkform();"></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Đơn vị</label>
                                                            <select name="don_vi_tinh" id="don_vi_tinh" class="select2-data-array  form-control" onchange="checkform();"></select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Giá nhập</label>
                                                            <input id="gia_von" type="text" class="form-control format_number" placeholder="8,000,000"  name="gia_von" />
                                                        </div>
                                                    </div>
            
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Giá bán</label>
                                                            <input id="don_gia" type="text" class="form-control format_number"  onkeyup="loadthue();" placeholder="10,000,000"  name="don_gia"  />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Thuế VAT</label>
                                                            <select name="tax" id="tax" class="form-control" onchange="loadthue();">
                                                                <option value="0">Không</option>
                                                                <option value="5">5%</option>
                                                                <option value="10">10%</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Tiền thuế</label>
                                                            <input id="thue_vat" type="text" class="form-control format_number" name="thue_vat"  />
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <h4 class="mb-1"><span class="align-middle">Thông tin</span></h4>
                                                    </div>

                                                    <div class="col-lg-2 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Số lượng</label>
                                                            <input id="so_luong" type="text" class="form-control format_number" name="so_luong" onkeyup="checkform();" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Hạn sử dụng</label>
                                                            <select name="gia_han" id="gia_han" class="form-control">
                                                                <option value="0">Không có HSD</option>
                                                                <option value="1">Có HSD</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label for="ngan_hang">Mô tả</label>
                                                            <textarea id="ghi_chu"  class="form-control " name="ghi_chu"></textarea>
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
<script src="<?= HOME ?>/js/dichvu.js"></script>