
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0" id="title_module">
                        Thêm mới tài nguyên
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="multiple-column-form">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!--<h4 class="card-title">Multiple Column</h4>-->
                        </div>
                        <div class="card-body">
                            <form class="form" id="tainguyen-fm">
                                <input id="nguoi_tao" name="nguoi_tao" type="hidden" />
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Tên tài nguyên <span style="color:red">(*)</span></label>
                                            <input type="text" id="name" class="form-control" placeholder="Tên tài nguyên" name="name" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Chủ sở hữu</label>
                                            <select id="chu_so_huu" class="form-control" name="chu_so_huu">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Nhà cung cấp</label>
                                            <select id="nha_cung_cap" class="form-control" name="nha_cung_cap">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Phân loại</label>
                                            <select id="phan_loai" class="form-control" name="phan_loai">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Đường dẫn<span style="color:red;">*</span></label>
                                            <input type="text" id="link" class="form-control" name="link" placeholder="Link liên kết" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Tên đăng nhập</label>
                                            <input type="text" id="ten_dang_nhap" class="form-control" name="ten_dang_nhap" placeholder="Tên đăng nhập" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password-id-column">Mật khẩu</label>
                                            <input type="password" id="mat_khau" class="form-control" name="mat_khau" placeholder="Mật khẩu" />
                                            <span id="toggle" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password-id-column">Ghi chú</label>
                                            <input type="text" id="ghi_chu" class="form-control" name="ghi_chu" placeholder="Ghi chú" />
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary mr-1">Ghi dữ liệu</button>
                                        <button type="reset" class="btn btn-outline-danger" onclick="window.location.href='./tainguyen'">Hủy bỏ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<style>
    .field-icon {
  float: right;
  margin-right: 20px;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}
</style>
<script src="<?= HOME ?>/js/tainguyen/formadd.js"></script>