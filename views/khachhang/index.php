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
                        <div class="col-md-4 kh_tinhtrang"></div>
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
                                    <th>Tên khách hàng</th>
                                    <th>Điện thoại</th>
                                    <th>Website</th>
                                    <th>Email</th>
                                    <th>Tình trạng</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="addinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
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
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Tên viết tắt</label>
                                                            <input id="name" type="text" class="form-control" name="name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ten_day_du">Tên đầy đủ</label>
                                                            <input id="ten_day_du" name="ten_day_du" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="dai_dien">Người đại diện</label>
                                                            <input id="dai_dien" type="text" class="form-control" name="dai_dien" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="dien_thoai">Số điện thoại</label>
                                                            <input id="dien_thoai" type="text" class="form-control" name="dien_thoai" />
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input id="email" type="text" class="form-control" name="email" />
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="website">Website</label>
                                                            <input id="website" type="text" class="form-control" name="website" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="van_phong">Địa chỉ văn phòng</label>
                                                            <input id="van_phong" type="text" class="form-control" name="van_phong" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="dia_chi">Địa chỉ ĐKKD</label>
                                                            <input id="dia_chi" name="dia_chi" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="ma_so">Mã số thuế</label>
                                                            <input id="ma_so" name="ma_so" type="text" class="form-control" placeholder="Mã số thuế hoặc CMND" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="chuc_vu">Chức vụ</label>
                                                            <input id="chuc_vu" type="text" class="form-control" name="chuc_vu" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="linh_vuc">Lĩnh vực</label>
                                                            <select id="linh_vuc" class="select2 form-control" name="linh_vuc">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="loai">Loại</label>
                                                            <select id="loai" class=" form-control" name="loai">
                                                                <option value="0">Doanh nghiệp</option>
                                                                <option value="1">Cá nhân</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="phan_loai">Phân loại</label>
                                                            <select id="phan_loai" class=" form-control" name="phan_loai">
                                                                <option value="1">Khách hàng</option>
                                                                <option value="2">Nhà cung cấp</option>
                                                                <option value="3">Cả hai</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="tinh_trang">Tình trạng</label>
                                                            <select id="tinh_trang" class="form-control" name="tinh_trang">
                                                                <option value="1">Khách hàng mới</option>
                                                                <option value="2">Đang dùng DV</option>
                                                                <option value="3">Tạm dừng dùng dịch vụ</option>
                                                                <option value="4">Đã dừng dùng DV</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="phu_trach">Người phụ trách</label>
                                                            <select id="phu_trach" class="select2 form-control" name="phu_trach">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12">
                                                        <div class="form-group">
                                                            <label for="ghi_chu">Ghi chú</label>
                                                            <textarea id="ghi_chu" name="ghi_chu" type="text" class="form-control " /></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="button" onclick="saveadd()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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

                    <div class="modal fade text-left" id="updateinfo" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16">Cập nhật thông tin nhân sự</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="id" name="id" />
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="nav nav-pills" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center active" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                                        <i data-feather="info"></i><span class="d-none d-sm-block">Thông tin nhân sự</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item" id="tab2">
                                                    <a class="nav-link d-flex align-items-center" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                                        <i data-feather='clipboard'></i><span class="d-none d-sm-block">Dịch vụ đã sử dụng</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="information" aria-labelledby="information-tab" role="tabpanel">
                                                    <form class="form-validate" enctype="multipart/form-data" id="dg">
                                                        <div class="row mt-1">
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name_e">Tên viết tắt</label>
                                                                    <input id="name_e" type="text" class="form-control" name="name" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ten_day_du_e">Tên đầy đủ</label>
                                                                    <input id="ten_day_du_e" name="ten_day_du" type="text" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="dai_dien_e">Người đại diện</label>
                                                                    <input id="dai_dien_e" type="text" class="form-control" name="dai_dien" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="dien_thoai_e">Số điện thoại</label>
                                                                    <input id="dien_thoai_e" type="text" class="form-control" name="dien_thoai" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email_e">Email</label>
                                                                    <input id="email_e" type="text" class="form-control" name="email" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="website_e">Website</label>
                                                                    <input id="website_e" type="text" class="form-control" name="website" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="van_phong_e">Địa chỉ văn phòng</label>
                                                                    <input id="van_phong_e" type="text" class="form-control" name="van_phong" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="dia_chi_e">Địa chỉ ĐKKD</label>
                                                                    <input id="dia_chi_e" name="dia_chi" type="text" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ma_so_e">Mã số thuế</label>
                                                                    <input id="ma_so_e" name="ma_so" type="text" class="form-control" placeholder="Mã số thuế hoặc CMND" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="chuc_vu_e">Chức vụ</label>
                                                                    <input id="chuc_vu_e" type="text" class="form-control" name="chuc_vu" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="linh_vuc_e">Lĩnh vực</label>
                                                                    <select id="linh_vuc_e" class="select2 form-control" name="linh_vuc">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="loai_e">Loại</label>
                                                                    <select id="loai_e" class=" form-control" name="loai">
                                                                        <option value="0">Doanh nghiệp</option>
                                                                        <option value="1">Cá nhân</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phan_loai_e">Phân loại</label>
                                                                    <select id="phan_loai_e" class=" form-control" name="phan_loai">
                                                                        <option value="1">Khách hàng</option>
                                                                        <option value="2">Nhà cung cấp</option>
                                                                        <option value="3">Cả hai</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="tinh_trang_e">Tình trạng</label>
                                                                    <select id="tinh_trang_e" class="form-control" name="tinh_trang">
                                                                        <option value="1">Khách hàng mới</option>
                                                                        <option value="2">Đang dùng DV</option>
                                                                        <option value="3">Tạm dừng dùng dịch vụ</option>
                                                                        <option value="4">Đã dừng dùng DV</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phu_trach_e">Người phụ trách</label>
                                                                    <select id="phu_trach_e" class="select2 form-control" name="phu_trach">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="ghi_chu_e">Ghi chú</label>
                                                                    <textarea id="ghi_chu_e" name="ghi_chu" type="text" class="form-control " /></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                                <button type="button" onclick="saveedit()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane" id="account" aria-labelledby="account-tab" role="tabpanel">
                                                    <div class="table-responsive border rounded mt-1">
                                                        <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                            <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                            <span class="align-middle">Chi tiết</span>
                                                        </h6>
                                                        <table class="table table-striped table-borderless" id="dichvu-list-table">
                                                            <thead class="thead-light ">
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Dịch vụ</th>
                                                                    <th>Tên miền</th>
                                                                    <th>Từ ngày</th>
                                                                    <th>Đến ngày</th>
                                                                    <!-- <th></th> -->
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
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
                                    <h4 class="modal-title" id="modal-title1">Nhập khách hàng từ excel</h4>
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
<script src="<?= HOME ?>/js/khachhang.js"></script>