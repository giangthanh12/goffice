
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0" id="title_module">
                        Cập nhật thông tin tài nguyên
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
                        </div>
                        <div class="card-body">
                            <form class="form" id="tainguyen-fm">
                                <input id="id" name="id" type="hidden" />
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Tên tài nguyên</label>
                                            <input type="text" id="name" class="form-control" placeholder="Tên tài nguyên" name="name" required="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Chủ sở hữu</label>
                                            <select id="owner" class="form-control" name="owner">
                                            <option value="">Lựa chọn chủ sở hữu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Nhà cung cấp</label>
                                            <select id="supplier" class="form-control" name="supplier">
                                            <option value="">Lựa chọn nhà cung cấp</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Phân loại</label>
                                            <select id="classify" class="form-control" name="classify">
                                            <option value="">Lựa chọn phân loại</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Đường dẫn</label>
                                            <input type="text" id="link" class="form-control" name="link" placeholder="Link liên kết" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Tên đăng nhập</label>
                                            <input type="email" id="username" class="form-control" name="username" placeholder="Tên đăng nhập" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Mật khẩu</label>
                                            <input type="password" id="password" class="form-control" name="password" placeholder="Mật khẩu" />
                                            <span id="toggle" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="note-id-column">Ghi chú</label>
                                            <input type="text" id="note" class="form-control" name="note" placeholder="Ghi chú" />
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-primary mr-1" onclick="save()">Ghi dữ liệu</button>
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

<script src="<?= HOME ?>/js/tainguyen/formedit.js"></script>
