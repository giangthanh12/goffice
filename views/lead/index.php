<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2>Lead</h2>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <!-- users filter start -->
                <div class="card">
                    <div class="d-flex align-items-center mx-50 row pt-2 pb-2">
                        <div class="col-md-3 data_nhanvien form-group hidden">
                            <label for="nhanvien">Phụ trách</label>
                            <select id="nhanvien" name="nhanvien" class="form-control">
                            </select>
                        </div>

                        <div class="col-md-3 data_nhanvien form-group">
                            <label for="tungay">Từ ngày</label>
                            <input type="text" id="tungay" name="tungay" class="form-control flatpickr-basic" placeholder="DD/MM/YYYY" />
                        </div>

                        <div class="col-md-3 data_nhanvien form-group">
                            <label for="denngay">Đến ngày</label>
                            <input type="text" id="denngay" name="denngay" class="form-control flatpickr-basic" placeholder="DD/MM/YYYY" />
                        </div>
                        <button type="button" class="btn btn-icon btn-outline-primary waves-effect" style="margin-top:10px" title="Tìm kiếm" onclick="search()">Tìm kiếm</button>
                    </div>
                    <!-- users filter end -->
                    <!-- list section start -->
                    <div class="card">
                        <div class="card-header border-bottom p-1">
                            <div class="head-label">
                                <!-- <h6 class="mb-0">DataTable with Buttons</h6> -->
                            </div>
                            <div class="dt-buttons ml-1 text-right">
                                <button class="dt-button btn btn-primary mt-50" onclick="movetokh()" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                    <span>Chuyển sang khách hàng</span>
                                </button>
                                
                                <button class="dt-button btn btn-primary mt-50" onclick="nhapexcel()" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                    <span>Nhập excel</span>
                                </button>
                            </div>
                        </div>

                        <div class="card-datatable table-responsive pt-0">
                            <table class="user-list-table table">
                                <thead class="thead-light">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Họ tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Phân loại</th>
                                        <th>Ngày chia</th>
                                        <th>Phụ trách</th>
                                        <th>Tình trạng</th>
                                        <th>...</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="modal modal-slide-in update-item-sidebar fade" id="updateinfo">
                            <div class="modal-dialog sidebar-lg">
                                <div class="modal-content p-0">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                    <div class="modal-header mb-1">
                                        <h5 class="modal-title">Thông tin data</h5>
                                    </div>
                                    <div class="modal-body flex-grow-1">
                                        <ul class="nav nav-tabs tabs-line">
                                            <li class="nav-item">
                                                <a class="nav-link nav-link-update active" data-toggle="tab" href="#tab-update" id="tab-1">
                                                    <i data-feather="edit"></i>
                                                    <span class="align-middle">Cập nhật</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" >
                                                <a class="nav-link nav-link-activity" data-toggle="tab" href="#tab-activity">
                                                    <i data-feather='file-text'></i>
                                                    <span class="align-middle">Nhật ký data</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content mt-2">
                                            <div class="tab-pane tab-pane-update fade show active" id="tab-update" role="tabpanel">
                                                <form class="update-item-form">
                                                    <div class="form-group">
                                                        <label for="hoten">Khách hàng</label>
                                                        <input id="hoten" type="text" class="form-control" name="hoten" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dienthoai">Điện thoại</label>
                                                        <input id="dienthoai" name="dienthoai" type="text" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="data_email">Email</label>
                                                        <input id="data_email" type="text" class="form-control" name="data_email" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="diachi">Địa chỉ</label>
                                                        <input id="diachi" type="text" class="form-control" name="diachi" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phanloai">Loại khách hàng</label>
                                                        <select id="phanloai" class="select2 form-control phan-loai" name="phanloai"></select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phutrach">Phụ trách</label>
                                                        <select id="phutrach" class="select2 form-control" name="phutrach"></select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ghichu">Ghi chú</label>
                                                        <textarea id="ghichu" name="ghichu" rows="3" class="form-control"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tinhtrang">Tình trạng</label>
                                                        <select id="tinhtrang" class="select2 form-control" name="tinhtrang"></select>
                                                    </div>
                                                    <div class="d-flex flex-wrap mb-2" >
                                                        <button type="button" id="btn-edit" onclick="saveedit()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                        <button type="reset" class="btn btn-outline-secondary mr-sm-1" data-dismiss="modal">Bỏ qua</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane tab-pane-activity pb-1 fade" id="tab-activity" role="tabpanel">
                                                
                                                <form id="fm-add">
                                                    <label>Nội dung</label>
                                                    <div class="form-group">
                                                        <textarea type="text" class="form-control" name="noidung" id="noidung" ></textarea>
                                                    </div>
                                                    <div class="d-flex flex-wrap mb-2">
                                                    <button type="button" onclick="savenhatky()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Thêm nhật ký</button>
                                                    </div>
                                                </form>
                                                <div id="listnhatky" style="position: relative;height: 450px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade text-left" id="nhapexcel" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modal-title5">Nhập data từ excel</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="fm-nhapexcel">
                                        <div class="form-group">
                                                <label class="form-label mr-4" for="file">Tải file mẫu</label>
                                                <a target="_blank" href="<?= URLFILE ?>/uploads/data.xlsx" style="color: blue;">Tải xuống <i class="fas fa-download"></i></a>

                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="file">File upload</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="file" name="file">
                                                    <label class="custom-file-label" for="file">Chọn file</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                        <label for="phutrach">Phụ trách (để trống nếu chọn chính mình)</label>
                                                        <select id="phutrach_import" class="select2 form-control" name="phutrach_import"></select>
                                            </div>

                                            <div class="form-group">
                                                <label for="phan_loai_import">Nguồn khách hàng</label>
                                                <select id="phan_loai_import" class="select2 form-control phan-loai" name="phan_loai_import">
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-dismiss="modal" onclick="savenhap()">Xác nhận</button>
                                    </div>
                                </div>
                            </div>
                        </div>

<!--moda dbao gia -->

                        <div class="modal fade text-left" id="modal_baogia" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">

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
                            <form class="form-validate" enctype="multipart/form-data" id="dg_bg">
                                <input type="hidden" id="id_bg" name="id_bg" />
        
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
                                            <select name="khach_hang_bg" id="khach_hang_bg" class="select2-data-array form-control" onchange="check_form();"></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-2">
                                        <div class="form-group">
                                            <label for="hoten">Nhân viên</label>
                                            <select name="nhan_vien_bg" id="nhan_vien_bg" class="select2-data-array form-control" onchange="check_form();"></select>
                                        </div>
                                    </div>

                                   
                                    <div class="col-lg-3 col-md-2">
                                        <div class="form-group">
                                            <label for="hoten">Tình trạng</label>
                                            <select name="tinh_trang_bg" id="tinh_trang_bg" class="form-control">
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
                                            <textarea id="ghi_chu_bg" name="ghi_chu_bg" class="form-control"></textarea>
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











                    </div>
            </section>
        </div>
    </div>
</div>
<script>
    let username = '<?php echo $_SESSION['user']['hoten'] ?>';
    let hinhanh = '<?php echo $_SESSION['user']['hinhanh'] ?>';
</script>
<script src="<?= HOME ?>/js/lead.js"></script>