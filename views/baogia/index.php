<link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/pages/app-baogia.css" />
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
                                    <th>Thời gian</th>
                                    <th>Khách hàng</th>
                                    <th>Nhân viên</th>
                                    <th>Nội dung</th>
                                    <th>Số tiền</th>
                                    <th>Tình trạng</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

            <!--end modal-->
            <div class="modal fade text-left" id="updateinfo" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel16"></h4>
        </div>

        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="information" aria-labelledby="information-tab" role="tabpanel">
                            <!-- users edit Info form start -->
                            <form class="form-validate" enctype="multipart/form-data" id="dg">
                                <input type="hidden" id="id" name="id" />
        
                                <div class="row mt-1">
                                    <div class="col-12">
                                        <h4 class="mb-1">
                                            <i data-feather="user" class="font-medium-4 mr-25"></i>
                                            <span class="align-middle">Thông tin</span>
                                        </h4>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="form-group">
                                            <label for="hoten">Thời gian</label>
                                            <input id="ngay" type="text" class="form-control ngay_gio" name="ngay" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-2">
                                        <div class="form-group">
                                            <label for="hoten">Khách hàng</label>
                                            <select name="khach_hang" id="khach_hang" class="select2-data-array form-control" onchange="check_form();"></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-2">
                                        <div class="form-group">
                                            <label for="hoten">Nhân viên</label>
                                            <select name="nhan_vien" id="nhan_vien" class="select2-data-array form-control" onchange="check_form();"></select>
                                        </div>
                                    </div>

                                   
                                    <div class="col-lg-3 col-md-2">
                                        <div class="form-group">
                                            <label for="hoten">Tình trạng</label>
                                            <select name="tinh_trang" id="tinh_trang" class="form-control">
                                                <option value="1">Mới tạo</option>
                                                <option value="2">Đang chờ</option>
                                                <option value="3">Đã chốt</option>
                                                <option value="4">Hợp đồng</option>
                                                <option value="5">Hủy</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <h4 class="mb-1">
                                            <i data-feather="menu" class="font-medium-4 mr-25"></i>
                                            <span class="align-middle">Thông tin sản phẩm, dịch vụ</span>
                                        </h4>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="tinh_trang">Chọn dịch vụ</label>
                                            <select name="dich_vu" id="dich_vu" class="select2-data-array form-control dich_vu"  onchange="load_dichvu();"></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="tinh_trang">Chọn sản phẩm</label>
                                            <select name="san_pham" id="san_pham" class="select2-data-array form-control" onchange="load_sanpham();"></select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <input type="hidden" name="stt" id="stt" value="0">
                                        <table  class="table dataTable no-footer">
                                            <thead>
                                                <th> Tên dịch vụ, sản phẩm </th>
                                                <th> Giá bán </th>
                                                <th> Số lượng </th>
                                                <th> Chiết khấu </th>
                                                <th> Thuế VAT </th>
                                                <th> Tiền thuế </th>
                                                <th> Thời hạn </th>
                                                <th> Thành tiền </th>
                                                <th>  </th>
                                            </thead>
                                            <tbody id="table_sp">
                                                
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td colspan="5"></td>
                                                    <td colspan="1" class="text-right">Tổng đơn</td>
                                                    <td colspan="2"><input type="text" class="form-control format_number" id="tong_donhang" readonly name="tong_donhang"></td>
                                                </tr> 
                                                <tr>
                                                    <td colspan="5"></td>
                                                    <td colspan="1" class="text-right">Chiết khấu</td>
                                                    <td colspan="2"><input type="text" class="form-control format_number" value="0" id="chiet_khau" name="chiet_khau" onkeyup="tong_thanh_toan()"></td>
                                                </tr> 
                                                <tr>
                                                    <td colspan="5"></td>
                                                    <td colspan="1" class="text-right"><b>Tổng thanh toán</b></td>
                                                    <td colspan="2"><input type="text" class="form-control format_number" readonly value="0" id="thanh_toan" name="thanh_toan"></td>
                                                </tr> 
                                            </tbody>
                                        </table>
                                    </div>

                                    
                                    <div class="col-12">
                                        <h4 class="mb-1 mt-2">
                                            <i data-feather="menu" class="font-medium-4 mr-25"></i>
                                            <span class="align-middle">Thông tin thêm</span>
                                        </h4>
                                    </div>
                                    
                                    <div class="col-lg-3 col-md-12">
                                        <div class="form-group">
                                            <label for="diachi">Files</label>
                                            <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="file" name="file">
                                                    <label class="custom-file-label" for="file">Chọn file</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <div id="viewfile"></div>
                                        </div>
                                    </div>
                                    

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="ngaycap">Ghi chú</label>
                                            <textarea id="ghi_chu" name="ghi_chu" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    

                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                        <button type="button" onclick="savetk()" class="btn btn-add btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                    </div>
                                </div>
                            </form>
                            <!-- users edit Info form ends -->
                        </div>
                        <!-- Social Tab ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>
            <!--end modal add/edit bao gia-->
			
			
			
			
			
		<!-- modal chamsocbaogia-->
            <div class="modal modal-slide-in fade text-left" id="chamsocbaogia" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">

<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content pt-0">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel16"></h4>
        </div>

        <div class="modal-body">
            <div class="card">
                <div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="information" aria-labelledby="information-tab" role="tabpanel">
                            <!-- users edit Info form start -->
                            <div id="listnhatky"></div>

                            <form class="form-validate" enctype="multipart/form-data" id="dg-chamsocbaogia">
                                <input type="hidden" id="id_bg" name="id_bg" />
                                <div class="mt-1" style="position:fixed;bottom:15px;width:100%;left:0">
                                    <div class="col-lg-12 col-md-2">
                                        <div class="form-group">
                                            <label for="hoten">Trạng thái</label>
                                            <select name="status_cskh" id="status_cskh" class="select2-data-array form-control"></select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <textarea id="ghi_chu_care" name="ghi_chu_care" class="form-control" placeholder="Ghi chú/kết quả" onkeyup="check_ghichu_csbg()"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-sm-row flex-column">
                                        <button type="button" onclick="add_chamsoc()" class="btn btn-add btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                    </div>
                                </div>
                            </form>
                            <!-- users edit Info form ends -->
                        </div>
                        <!-- Social Tab ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>
            <!--end modal chamsocbaogia-->




                </div>
            </section>
        </div>
    </div>
</div>
<script src="<?= HOME ?>/js/baogia.js"></script>