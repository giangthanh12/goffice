<?php
if(isset($_REQUEST['id'])){?>
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
                <div class="card-header">
                    <h4 class="card-title">Tab with icon</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="homeIcon-tab" data-toggle="tab" href="#homeIcon" aria-controls="home" role="tab" aria-selected="true"><i data-feather="home"></i> Chi tiết</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profileIcon-tab" data-toggle="tab" href="#profileIcon" aria-controls="profile" role="tab" aria-selected="false"><i data-feather="tool"></i> Nhật ký</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="aboutIcon-tab" data-toggle="tab" href="#aboutIcon" aria-controls="about" role="tab" aria-selected="false"><i data-feather="user"></i> Bình luận</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <input type="hidden" id="id" name="id" />
                        <div class="tab-pane active" id="homeIcon" aria-labelledby="homeIcon-tab" role="tabpanel">
                            <section id="basic-horizontal-layouts">
                                <form class="form form-horizontal" id="data-info">

                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Thông tin chung</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="ho_ten">Họ và tên</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="ho_ten" class="form-control" name="ho_ten">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="loai_kh">Loại KH</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <select id="loai_kh" class="select2 form-control" name="loai_kh">
                                                                <option value="">Chọn một giá trị</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="dien_thoai_ban">Điện thoại bàn</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="number" id="dien_thoai_ban" class="form-control" name="dien_thoai_ban">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="phan_loai">Phân loại</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <select id="phan_loai" class="select2 form-control" name="phan_loai">
                                                                <option value="">Chọn một giá trị</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="di_dong">Di động</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="number" id="di_dong" class="form-control" name="di_dong">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="mang">Mảng</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <select id="mang" class="select2 form-control" name="mang">
                                                                <option value="">Chọn một giá trị</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="email">Email</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="email" class="form-control" name="email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="tinh_trang_lh">Tình trạng liên hệ</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <select id="tinh_trang_lh" class="select2 form-control" name="tinh_trang_lh">
                                                                <option value="">Chọn một giá trị</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="chien_dich">Chiến dịch</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <select id="chien_dich" class="select2 form-control" name="chien_dich">
                                                                <option value="">Chọn một giá trị</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Thông tin công ty</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="cong_ty">Công ty</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="cong_ty" class="form-control" name="cong_ty">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="website">Website</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="website" class="form-control" name="website">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Thông tin địa chỉ</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="dia_chi">Địa chỉ</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="dia_chi" class="form-control" name="dia_chi">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="quan_huyen">Quận/huyện</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="quan_huyen" class="form-control" name="quan_huyen">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="tinh_tp">Tỉnh/TP</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="tinh_tp" class="form-control" name="tinh_tp">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="vung_mien">Vùng/miền</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="vung_mien" class="form-control" name="vung_mien">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Thông tin mô tả</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="tinh_trang">Tình trạng</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <select id="tinh_trang" class="select2 form-control" name="tinh_trang">
                                                                <option value="">Chọn một giá trị</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label for="giao_cho">Giao cho</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <select id="giao_cho" class="select2 form-control" name="giao_cho">
                                                                <option value="">Chọn một giá trị</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-1 col-form-label mr-4">
                                                            <label for="mo_ta">Mô tả</label>
                                                        </div>
                                                        <div class="col-sm-10 ">
                                                            <textarea id="mo_ta" class="form-control" name="mo_ta"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3 d-flex align-items-center justify-content-center">
                                                <button type="button" class="btn btn-primary mr-1 waves-effect waves-float waves-light" onclick="saveupdate()">Cập nhật</button>
                                                <button type="reset" class="btn btn-outline-secondary waves-effect" onclick="window.location.href = baseUrl + 'data'">Quay lại</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </section>
                        </div>
                        <div class="tab-pane" id="profileIcon" aria-labelledby="profileIcon-tab" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="timeline">
                                        <li class="timeline-item">
                                            <span class="timeline-point timeline-point-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                            </span>
                                            <div class="timeline-event">
                                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                    <h6>Financial Report</h6>
                                                    <span class="timeline-event-time">2 hours ago</span>
                                                </div>
                                                <p class="mb-50">Click the button below to read financial reports</p>
                                            </div>
                                        </li>
                                        <!-- <li class="timeline-item">
                                            <span class="timeline-point timeline-point-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                            </span>
                                            <div class="timeline-event">
                                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                    <h6>Client Meeting</h6>
                                                    <span class="timeline-event-time">45 min ago</span>
                                                </div>
                                                <p>Project meeting with john @10:15am.</p>
                                            </div>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="aboutIcon" aria-labelledby="aboutIcon-tab" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start mb-1">
                                        <div class="avatar mt-25 mr-50">
                                            <img src="../../../app-assets/images/portrait/small/avatar-s-3.jpg" alt="Avatar" height="34" width="34">
                                        </div>
                                        <div class="profile-user-info w-100">
                                            <div class="d-flex align-content-center justify-content-between">
                                                <h6 class="mb-0">Kitty Allanson</h6>
                                                <a href="javascript:void(0)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart text-body font-medium-3">
                                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                    </svg>
                                                    <span class="align-middle text-muted">34</span>
                                                </a>
                                            </div>
                                            <small>Easy &amp; smart fuzzy search🕵🏻 functionality which enables users to search quickly.</small>
                                        </div>
                                    </div>
                                    <fieldset class="form-label-group mb-75">
                                        <textarea class="form-control" id="label-textarea3" rows="3" placeholder="Add Comment"></textarea>
                                        <label for="label-textarea3">Add Comment</label>
                                    </fieldset>
                                    <button type="button" class="btn btn-sm btn-primary waves-effect waves-float waves-light">Post Comment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
let dataid = "<?= $_REQUEST['id'] ?>";
</script>
<script src="<?= HOME ?>/js/data/index.js"></script>
<script src="<?= HOME ?>/js/data/update.js"></script>
<?php
}
?>
