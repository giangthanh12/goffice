<style>
.select2-selection--multiple { max-height: 125px; overflow: auto }
</style>
<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-file-manager.css">
<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/file-uploaders/dropzone.min.css">
<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/plugins/forms/form-file-uploader.css">
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Thông tin data</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Data</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="collapsible">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card collapse-icon">
                            <div class="card-body">
                                <div class="collapse-default">
                                    <div class="card">
                                        <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                            <span class="lead collapse-title"> Thông tin chiến dịch </span>
                                        </div>
                                        <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="dexuattd">Đề xuất tuyển dụng</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <select id="dexuattd" class="form-control" name="dexuattd">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="name">Tên chiến dịch</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="name" class="form-control" name="name" placeholder="Tuyển nhân viên ...">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="nguoi_phu_trach">Người phụ trách</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <select id="nguoi_phu_trach" class="form-control js-example-basic-multiple" name="nguoi_phu_trach[]" multiple="multiple">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="nguoi_theo_doi">Người theo dõi</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <select id="nguoi_theo_doi" class="form-control js-example-basic-multiple" name="nguoi_theo_doi[]" multiple="multiple">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="ngay_bat_dau">Ngày bắt đầu</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="ngay_bat_dau" class="form-control flatpickr-basic" name="ngay_bat_dau" placeholder="DD/MM/YYYY">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="ngay_ket_thuc">Ngày kết thúc</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="ngay_ket_thuc" class="form-control flatpickr-basic" name="ngay_ket_thuc" placeholder="DD/MM/YYYY">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="chi_phi_du_kien">Chi phí dự kiến</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="chi_phi_du_kien" class="form-control format_number" name="chi_phi_du_kien" placeholder="Tổng chi phí">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingCollapse2" class="card-header collapse-header" data-toggle="collapse" role="button" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                            <span class="lead collapse-title"> Thông tin vị trí tuyển </span>
                                        </div>
                                        <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse show" aria-expanded="false">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="phong_ban">Phòng ban</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <select id="phong_ban" class="form-control" name="phong_ban" onchange="changePB()">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="chi_nhanh">Chi nhánh</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <select id="chi_nhanh" class="form-control" name="chi_nhanh">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="vi_tri">Vị trí</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <select id="vi_tri" class="form-control" name="vi_tri">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="hinh_thuc_lam_viec">Hình thức làm việc</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <select id="hinh_thuc_lam_viec" class="form-control" name="hinh_thuc_lam_viec">
                                                                    <option value="">Chọn hình thức làm việc</option>
                                                                    <option value="1">Core team</option>
                                                                    <option value="2">Hành chính</option>
                                                                    <option value="3">Part chiều</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="min_luong">Mức lương (từ)</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="min_luong" class="form-control format_number" name="min_luong" placeholder="Từ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="max_luong">Mức lương (đến)</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="max_luong" class="form-control format_number" name="max_luong" placeholder="Đến">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="so_luong">Số lượng</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="so_luong" class="form-control" name="so_luong" placeholder="Số lượng">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="ly_do">Lý do tuyển</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <select id="ly_do" class="form-control" name="ly_do">
                                                                    <option value="">Chọn lý do tuyển</option>
                                                                    <option value="1">Tuyển mới</option>
                                                                    <option value="2">Tuyển thay thế</option>
                                                                    <option value="3">Khác</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="han_tuyen">Hạn tuyển</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="han_tuyen" name="han_tuyen" class="form-control flatpickr-basic" placeholder="DD/MM/YYYY" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div class="col-6">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="notime" onchange="noTime()">
                                                            <label class="form-check-label" for="notime">Tuyển đến khi đủ</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingCollapse3" class="card-header collapse-header" data-toggle="collapse" role="button" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                            <span class="lead collapse-title"> Yêu cầu ứng viên </span>
                                        </div>
                                        <div id="collapse3" role="tabpanel" aria-labelledby="headingCollapse3" class="collapse show" aria-expanded="false">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="form-group row">
                                                            <div class="col-sm-2 col-form-label mr-1">
                                                                <label for="min_tuoi">Độ tuổi</label>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <input type="text" id="min_tuoi" class="form-control" name="min_tuoi" placeholder="Từ">
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <input type="text" id="max_tuoi" class="form-control" name="max_tuoi" placeholder="Đến">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group row">
                                                            <div class="col-sm-4 col-form-label">
                                                                <label for="gioi_tinh">Giới tính</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <select id="gioi_tinh" class="form-control" name="gioi_tinh">
                                                                    <option value="">Chọn</option>
                                                                    <option value="1">Nam</option>
                                                                    <option value="2">Nữ</option>
                                                                    <option value="3">Không yêu cầu</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="form-group row">
                                                            <div class="col-sm-2 col-form-label mr-1">
                                                                <label for="min_cao">Chiều cao</label>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <input type="text" id="min_cao" class="form-control" name="min_cao" placeholder="Từ">
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <input type="text" id="max_cao" class="form-control" name="max_cao" placeholder="Đến">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="form-group row">
                                                            <div class="col-sm-2 col-form-label mr-1">
                                                                <label for="min_nang">Cân nặng</label>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <input type="text" id="min_nang" class="form-control" name="min_nang" placeholder="Từ">
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <input type="text" id="max_nang" class="form-control" name="max_nang" placeholder="Đến">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="form-group row">
                                                            <div class="col-sm-2 col-form-label mr-1">
                                                                <label for="chuyen_nganh">Chuyên ngành</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="chuyen_nganh" class="form-control" name="chuyen_nganh" placeholder="Công nghệ thông tin">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="trinh_do">Trình độ</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <select id="trinh_do" class="form-control" name="trinh_do">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-1"></div>
                                                            <div class="col-sm-3 col-form-label">
                                                                <label for="kinh_nghiem">Kinh nghiệm</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <select id="kinh_nghiem" class="form-control" name="kinh_nghiem">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>

                                                    <div class="col-8">
                                                        <div class="form-group row">
                                                            <div class="col-sm-2 col-form-label mr-1">
                                                                <label for="mo_ta">Mô tả công việc</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <textarea class="form-control" name="mo_ta" id="mo_ta" rows="5" placeholder="Mô tả công việc"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>

                                                    <!-- <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-sm-2 col-form-label">
                                                                <label for="tinh_trang_lh">File đính kèm</label>
                                                            </div>
                                                            <div class="col-sm-10" style="margin-left: -47px;">
                                                                <form action="#" class="dropzone dropzone-area" id="dpz-remove-thumb">
                                                                    <div class="dz-message">Drop files here or click to upload.</div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                    <button type="button" onclick="saveedit()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
</div>
<script src="<?= HOME ?>/styles/app-assets/vendors/js/file-uploaders/dropzone.min.js"></script>
<script src="<?= HOME ?>/js/chiendichtd/edit.js"></script>