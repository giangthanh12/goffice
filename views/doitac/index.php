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
                                                        <button type="button" onclick="savedt()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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
<script src="<?= HOME ?>/js/doitac.js"></script>