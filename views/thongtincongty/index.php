<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                
                <!-- users filter end -->
                <!-- list section start -->
                <form class="form-validate" enctype="multipart/form-data" id="thongtin">
                <div class="card pd-15">
                    <div class="row mt-1">
                        <div class="col-12">
                            <h4 class="mb-1"><span class="align-middle">Logo</span></h4>
                        </div>

                        <div class="col-lg-4 d-flex mb-1">
                            <img id="avatar" src="" alt="users avatar" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"  width="150" />
                            <div class="media-body col-lg-12 mt-50">
                                <div class="d-flex mt-1 px-0">
                                    <label class="btn btn-primary mr-75 mb-0" for="hinhanh">
                                        <span class="d-none d-sm-block">Thay ảnh</span>
                                        <input class="form-control" type="file" id="hinhanh" name="hinhanh" hidden accept="image/png, image/jpeg, image/jpg" onchange="thayanh()" />
                                        <span class="d-block d-sm-none">
                                            <i class="mr-0" data-feather="edit"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <h4 class="mb-1"><span class="align-middle">Thông tin công ty</span></h4>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="name">Tên công ty</label>
                                <input id="name" name="name" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="ten_giao_dich">Tên giao dịch</label>
                                <input id="ten_giao_dich" name="ten_giao_dich" type="text" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="ma_so_thue">Mã số thuế</label>
                                <input id="ma_so_thue" name="ma_so_thue" type="text" class="form-control" />
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="ma_so_dkkd">Mã số DKKD</label>
                                <input id="ma_so_dkkd" name="ma_so_dkkd" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="ngay_cap">Ngày cấp</label>
                                <input id="ngay_cap" name="ngay_cap" type="text" class="form-control flatpicker" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="noi_cap">Nơi cấp</label>
                                <input id="noi_cap" name="noi_cap" type="text" class="form-control" />
                            </div>
                        </div>

                        <div class="col-12">
                            <h4 class="mb-1"><span class="align-middle">Thông tin người đại diện</span></h4>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="nguoi_dai_dien">Họ và tên</label>
                                <input id="nguoi_dai_dien" name="nguoi_dai_dien" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="chuc_danh">Chức danh</label>
                                <input id="chuc_danh" name="chuc_danh" type="text" class="form-control" />
                            </div>
                        </div>

                        <div class="col-12">
                            <h4 class="mb-1"><span class="align-middle">Thông tin khác</span></h4>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="ngay_thanh_lap">Ngày thành lập</label>
                                <input id="ngay_thanh_lap" name="ngay_thanh_lap" type="text" class="form-control flatpicker" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="dia_chi">Địa chỉ</label>
                                <input id="dia_chi" name="dia_chi" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="dien_thoai">Số điện thoại</label>
                                <input id="dien_thoai" name="dien_thoai" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="fax">Fax</label>
                                <input id="fax" name="fax" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input id="website" name="website" type="text" class="form-control" />
                            </div>
                        </div>

                        <div class="col-12">
                        <button class="dt-button add-new btn btn-primary" onclick="savetk();"><span>Cập nhật</span></button>
                        </div>
                        
                    </div>

                

                </div>
                
                </form>
            </section>
        </div>
    </div>
</div>
<script src="<?= HOME ?>/js/thongtincongty.js"></script>