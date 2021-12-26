<!-- <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-kanban.css"> -->
<script src="<?= HOME ?>/js/hopdongld.js"></script>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <!-- list section start -->
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th>Tên hợp đồng</th>
                                    <th>Loại hợp đồng</th>
                                    <th>Nhân viên</th>
                                    <th>Phòng ban</th>
                                    <th>Chi nhánh</th>
                                    <th>Vị trí</th>
                                    <th>Tình trạng</th>
                                    <th></th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                                                    <div class="col-md-6 col-md-6 form-group">
                                                        <label for="nhan_vien">Nhân viên</label>
                                                        <select id="nhan_vien" class="select2 form-control" name="nhan_vien">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-md-6 form-group">
                                                        <label for="tinh_trang">Tình trạng</label>
                                                        <select id="tinh_trang" class="form-control" name="tinh_trang">
                                                            <option value="">Chọn tình trạng</option>
                                                            <option value="1">Đang thực hiện</option>
                                                            <option value="2">Đã kết thúc</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="name">Tên hợp đồng</label>
                                                        <input id="name" name="name" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="loai">Loại hợp đồng</label>
                                                        <select id="loai" class="form-control" name="loai">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="phong_ban">Phòng ban</label>
                                                        <select id="phong_ban" class="form-control" name="phong_ban" onchange="changePB()">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="vi_tri">Vị trí</label>
                                                        <select id="vi_tri" class="form-control" name="vi_tri">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="chi_nhanh">Chi nhánh</label>
                                                        <select id="chi_nhanh" class="form-control" name="chi_nhanh">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="ca">Ca</label>
                                                        <select id="ca" class="form-control" name="ca">
                                                            <option value="">Chọn ca làm</option>
                                                            <option value="1">Core team</option>
                                                            <option value="2">Hành chính</option>
                                                            <option value="3">Part chiều</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="luong_co_ban">Lương cơ bản</label>
                                                        <input id="luong_co_ban" type="text" class="form-control format_number" name="luong_co_ban" />
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="ty_le_luong">Tỉ lệ lương (%)</label>
                                                        <input id="ty_le_luong" type="text" class="form-control" name="ty_le_luong" />
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label for="luong_bao_hiem">Lương bảo hiểm</label>
                                                        <input id="luong_bao_hiem" type="text" class="form-control format_number" name="luong_bao_hiem" />
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label for="phu_cap">Phụ cấp</label>
                                                        <input id="phu_cap" type="text" class="form-control format_number" name="phu_cap" />
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label for="ngay_di_lam">Ngày đi làm</label>
                                                        <input type="text" id="ngay_di_lam" name="ngay_di_lam" class="form-control flatpickr-basic" placeholder="DD/MM/YYYY" />
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label for="ngay_ket_thuc">Ngày kết thúc</label>
                                                        <input type="text" id="ngay_ket_thuc" name="ngay_ket_thuc" class="form-control flatpickr-basic" placeholder="DD/MM/YYYY" />
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label for="ghi_chu">Ghi chú</label>
                                                        <textarea id="ghi_chu" name="ghi_chu" type="text" class="form-control " /></textarea>
                                                    </div>

                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="button" onclick="savekh()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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
