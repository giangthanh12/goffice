<!-- <script src="<?= HOME ?>/js/tainguyen/formadd.js"></script> -->
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
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="homeIcon-tab" data-toggle="tab" href="#homeIcon" aria-controls="home" role="tab" aria-selected="true"><i data-feather="home"></i> Thông tin chung</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profileIcon-tab" data-toggle="tab" href="#profileIcon" aria-controls="profile" role="tab" aria-selected="false"><i data-feather="tool"></i> Yêu cầu ứng viên</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- <input type="hidden" id="id" name="id" /> -->
                        <div class="tab-pane active" id="homeIcon" aria-labelledby="homeIcon-tab" role="tabpanel">
                            <section id="basic-horizontal-layouts">
                                <!-- <form class="form form-horizontal" id="data-info"> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="name">Tên đề xuất</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="name" class="form-control" name="name" placeholder="Tuyển nhân viên ...">
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
                                                            <label for="han_tuyen">Hạn tuyển</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="han_tuyen" name="han_tuyen" class="form-control flatpickr-basic" placeholder="DD/MM/YYYY" />
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
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="notime" onchange="noTime()">
                                                        <label class="form-check-label" for="notime">Tuyển đến khi đủ</label>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                    <button type="button" onclick="saveadd()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- </form> -->
                            </section>
                        </div>
                        <div class="tab-pane" id="profileIcon" aria-labelledby="profileIcon-tab" role="tabpanel">
                            <section id="basic-horizontal-layouts">
                                <!-- <form class="form form-horizontal" id="data-info"> -->
                                <div class="card">
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
                                            <div class="col-4" >
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

                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                <button type="button" onclick="saveadd()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- </form> -->

                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= HOME ?>/styles/app-assets/vendors/js/file-uploaders/dropzone.min.js"></script>
<script src="<?= HOME ?>/js/dexuattd/add.js"></script>
