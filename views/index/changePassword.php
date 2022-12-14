<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <base href="<?= HOME ?>/" />
    <title>G-OFFICE Văn phòng điện tử của bạn</title>
    <link rel="apple-touch-icon" href="<?= HOME ?>/layouts/favicon.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= HOME ?>/layouts/favicon.png">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/page-auth.css">
    <script src="<?= HOME ?>/styles/app-assets/vendors/js/vendors.min.js"></script>
    <script src="<?= HOME ?>/styles/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="<?= HOME ?>/styles/app-assets/js/core/app.js"></script>
    <script>
        let baseHome = '<?= HOME ?>';
    </script>
    <script src="<?= HOME ?>/js/login.js"></script>
</head>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v2">
                    <div class="auth-inner row m-0">
                        <a class="brand-logo" href="">
                            <img src="<?= HOME ?>/layouts/g-office-logo.png" height="40" alt="logo">
                            <!-- <h2 class="brand-text text-primary ml-1">G-OFFICE</h2> -->
                        </a>
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                                <img class="img-fluid" src="<?= HOME ?>/styles/app-assets/images/pages/login-v2.svg" alt="Login V2" />
                            </div>
                        </div>
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title font-weight-bold mb-1">Welcome to G-Office</h2>
                                <p class="card-text mb-2">Thay đổi mật khẩu</p>
                                <form class="auth-login-form mt-2" id="change-password-form" method="POST">
                                    <input class="form-control" type="hidden" value="<?= $_REQUEST['activeCode'] ?>" name="activeCode" aria-describedby="activeCode" autofocus="" tabindex="1" />
                                    <div class="form-group d-none">
                                        <label class="form-label" for="login-email">Mã doanh nghiệp</label>
                                        <div class="input-group mb-2">
                                            <input class="form-control" type="text" value="<?= $_REQUEST['taxCode'] ?>" name="taxCode" aria-describedby="taxCode" autofocus="" tabindex="1" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="login-password">Mật khẩu mới</label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="newPass" type="password" name="newPass" placeholder="Mật khẩu mới" aria-describedby="password" tabindex="2" />
                                            <div class="input-group-append">
                                                <span class="input-group-text cursor-pointer">
                                                    <i data-feather="eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="login-password">Xác nhận mật khẩu</label>
                                            <a href="<?= HOME ?>/login"><small>Đăng nhập?</small></a>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="confirmPass" type="password" name="confirmPass" placeholder="Xác nhận mật khẩu" aria-describedby="password" tabindex="2" />
                                            <div class="input-group-append">
                                                <span class="input-group-text cursor-pointer">
                                                    <i data-feather="eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" tabindex="4" type="submit">
                                        Cập nhật
                                    </button>
                                </form>
                                <p class="text-center mt-1">
                                    <span>Hotline: </span>
                                    <a href="tel:0346788118"><span>&nbsp;034 678 8118</span></a>
                                </p>
                                <div class="divider my-1">
                                    <div class="divider-text">or</div>
                                </div>
                                <p class="text-center mt-1">
                                    <span>Email: </span>
                                    <a href="mailto:info@gemstech.com.vn"><span>&nbsp;info@gemstech.com.vn</span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>