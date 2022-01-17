<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Account Settings</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Trang chủ</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Pages</a>
                                </li>
                                <li class="breadcrumb-item active"> Account Settings
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- account setting page -->
            <section id="page-account-settings">
                <div class="row">
                    <!-- left menu section -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-column nav-left">
                            <!-- general -->
                            <li class="nav-item">
                                <a class="nav-link active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                    <i data-feather="user" class="font-medium-3 mr-1"></i>
                                    <span class="font-weight-bold">General</span>
                                </a>
                            </li>
                            <!-- change password -->
                            <li class="nav-item">
                                <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                    <i data-feather="lock" class="font-medium-3 mr-1"></i>
                                    <span class="font-weight-bold">Change Password</span>
                                </a>
                            </li>
                            <!-- information -->
                            <li class="nav-item">
                                <a class="nav-link" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                                    <i data-feather="info" class="font-medium-3 mr-1"></i>
                                    <span class="font-weight-bold">Information</span>
                                </a>
                            </li>
                            <!-- social -->
                            <li class="nav-item">
                                <a class="nav-link" id="account-pill-social" data-toggle="pill" href="#account-vertical-social" aria-expanded="false">
                                    <i data-feather="link" class="font-medium-3 mr-1"></i>
                                    <span class="font-weight-bold">Social</span>
                                </a>
                            </li>
                            <!-- notification -->
                            <li class="nav-item">
                                <a class="nav-link" id="account-pill-notifications" data-toggle="pill" href="#account-vertical-notifications" aria-expanded="false">
                                    <i data-feather="bell" class="font-medium-3 mr-1"></i>
                                    <span class="font-weight-bold">Notifications</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--/ left menu section -->

                    <!-- right content section -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- general tab -->
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                        <!-- header media -->
                                        <div class="media">
                                            <a href="javascript:void(0);" class="mr-25">
                                                <img src="<?= URLFILE ?>/uploads/nhanvien/<?=$_SESSION['user']['avatar']?>" onerror="this.src='<?= HOME ?>/layouts/useravatar.png'" id="avatar" class="rounded mr-50" alt="profile image" height="80" width="80" style="object-fit:cover" />
                                            </a>
                                            <!-- upload and reset button -->
                                            <div class="media-body mt-75 ml-1">
                                                <label for="hinhanh" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                                <button class="btn btn-sm btn-outline-secondary mb-75" onclick="xoaanh()">Reset</button>
                                                <form id="upload-avt">
                                                    <input type="file" id="hinhanh" name="hinhanh" hidden accept="image/*" onchange="thayanh()" />
                                                </form>
                                                <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                                            </div>
                                            <!--/ upload and reset button -->
                                        </div>
                                        <!--/ header media -->

                                        <!-- form -->
                                        <form class="validate-form mt-2">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="username">Tên đăng nhập</label>
                                                        <input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập" value="username" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="name">Họ và tên</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="email">E-mail</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="dien_thoai">Số điện thoại</label>
                                                        <input type="text" class="form-control" id="dien_thoai" name="dien_thoai" placeholder="Số điện thoại" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary mt-2 mr-1" onclick="save()">Save changes</button>
                                                    <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!--/ form -->
                                    </div>
                                    <!--/ general tab -->

                                    <!-- change password -->
                                    <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                        <!-- form -->
                                        <form class="validate-form">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="old-password">Mật khẩu hiện tại</label>
                                                        <div class="input-group form-password-toggle input-group-merge">
                                                            <input type="password" class="form-control" id="old-password" name="old-password" placeholder="Mật khẩu hiện tại" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text cursor-pointer">
                                                                    <i data-feather="eye"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="new-password">Mật khẩu mới</label>
                                                        <div class="input-group form-password-toggle input-group-merge">
                                                            <input type="password" id="new-password" name="new-password" class="form-control" placeholder="Mật khẩu mới" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text cursor-pointer">
                                                                    <i data-feather="eye"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="re-new-password">Nhập lại mật khẩu mới</label>
                                                        <div class="input-group form-password-toggle input-group-merge">
                                                            <input type="password" class="form-control" id="re-new-password" name="re-new-password" placeholder="Nhập lại mật khẩu mới" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary mr-1 mt-1" onclick="savepass()">Save changes</button>
                                                    <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!--/ form -->
                                    </div>
                                    <!--/ change password -->

                                    <!-- information -->
                                    <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                        <!-- form -->
                                        <form class="validate-form">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="ngay_sinh">Ngày sinh</label>
                                                        <input type="text" class="form-control flatpickr-basic" placeholder="Ngày sinh" id="ngay_sinh" name="ngay_sinh" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="cmnd">CMND/CCCD</label>
                                                        <input type="text" class="form-control flatpickr" placeholder="CMND/CCCD" id="cmnd" name="cmnd" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="ngay_cap">Ngày cấp</label>
                                                        <input type="text" class="form-control" name="ngay_cap" id="ngay_cap" placeholder="Ngày cấp" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="noi_cap">Nơi cấp</label>
                                                        <select id="noi_cap" name="noi_cap" class="select2-data-array form-control"></select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="que_quan">Quê quán</label>
                                                        <select id="que_quan" name="que_quan" class="select2-data-array form-control"></select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="dia_chi">Địa chỉ</label>
                                                        <input type="text" class="form-control" id="dia_chi" placeholder="Địa chỉ" name="dia_chi" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="ghi_chu">Giới thiệu</label>
                                                        <textarea class="form-control" name="ghi_chu" id="ghi_chu" rows="4" placeholder="Giới thiệu"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary mt-1 mr-1" onclick="save()">Save changes</button>
                                                    <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!--/ form -->
                                    </div>
                                    <!--/ information -->

                                    <!-- social -->
                                    <div class="tab-pane fade" id="account-vertical-social" role="tabpanel" aria-labelledby="account-pill-social" aria-expanded="false">
                                        <!-- form -->
                                        <form class="validate-form">
                                            <div class="row">
                                                <!-- social header -->
                                                <div class="col-12">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i data-feather="link" class="font-medium-3"></i>
                                                        <h4 class="mb-0 ml-75">Social Links</h4>
                                                    </div>
                                                </div>
                                                <!-- twitter link input -->
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="twitter">Twitter</label>
                                                        <input type="text" id="twitter" name="twitter" class="form-control" placeholder="Add link"/>
                                                    </div>
                                                </div>
                                                <!-- facebook link input -->
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="facebook">Facebook</label>
                                                        <input type="text" id="facebook" name="facebook" class="form-control" placeholder="Add link" />
                                                    </div>
                                                </div>
                                                <!-- instagram link input -->
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="instagram">Instagram</label>
                                                        <input type="text" id="instagram" name="instagram" class="form-control" placeholder="Add link" />
                                                    </div>
                                                </div>
                                                <!-- Quora link input -->
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="zalo">Zalo</label>
                                                        <input type="text" id="zalo" name="zalo" class="form-control" placeholder="Add link" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="wechat">Webchat</label>
                                                        <input type="text" id="wechat" name="wechat" class="form-control" placeholder="Add link" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="linkedin">Linkedin</label>
                                                        <input type="text" id="linkedin" name="linkedin" class="form-control" placeholder="Add link" />
                                                    </div>
                                                </div>

                                                <!-- divider -->
                                                <div class="col-12">
                                                    <hr class="my-2" />
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <!-- profile connection header -->
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i data-feather="user" class="font-medium-3"></i>
                                                        <h4 class="mb-0 ml-75">Profile Connections</h4>
                                                    </div>

                                                    <div class="row">
                                                        <!-- twitter user -->
                                                        <div class="col-6 col-md-3 text-center mb-1">
                                                            <p class="font-weight-bold">Your Twitter</p>
                                                            <div class="avatar mb-1">
                                                                <span class="avatar-content">
                                                                    <img src="<?= HOME ?>/styles/app-assets/images/avatars/11-small.png" alt="avatar img" width="40" height="40" />
                                                                </span>
                                                            </div>
                                                            <p class="mb-0">@johndoe</p>
                                                            <a href="javascript:void(0)">Disconnect</a>
                                                        </div>
                                                        <!-- facebook button -->
                                                        <div class="col-6 col-md-3 text-center mb-1">
                                                            <p class="font-weight-bold mb-2">Your Facebook</p>
                                                            <button class="btn btn-outline-primary">Connect</button>
                                                        </div>
                                                        <!-- google user -->
                                                        <div class="col-6 col-md-3 text-center mb-1">
                                                            <p class="font-weight-bold">Your Google</p>
                                                            <div class="avatar mb-1">
                                                                <span class="avatar-content">
                                                                    <img src="<?= HOME ?>/styles/app-assets/images/avatars/3-small.png" alt="avatar img" width="40" height="40" />
                                                                </span>
                                                            </div>
                                                            <p class="mb-0">@luraweber</p>
                                                            <a href="javascript:void(0)">Disconnect</a>
                                                        </div>
                                                        <!-- github button -->
                                                        <div class="col-6 col-md-3 text-center mb-2">
                                                            <p class="font-weight-bold mb-1">Your GitHub</p>
                                                            <button class="btn btn-outline-primary">Connect</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <!-- submit and cancel button -->
                                                    <button type="button" class="btn btn-primary mr-1 mt-1" onclick="savesocial()">Save changes</button>
                                                    <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!--/ form -->
                                    </div>
                                    <!--/ social -->

                                    <!-- notifications -->
                                    <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false">
                                        <div class="row">
                                            <h6 class="section-label mx-1 mb-2">Activity</h6>
                                            <div class="col-12 mb-2">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch1" />
                                                    <label class="custom-control-label" for="accountSwitch1">
                                                        Email me when someone comments onmy article
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch2" />
                                                    <label class="custom-control-label" for="accountSwitch2">
                                                        Email me when someone answers on my form
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="accountSwitch3" />
                                                    <label class="custom-control-label" for="accountSwitch3">Email me hen someone follows me</label>
                                                </div>
                                            </div>
                                            <h6 class="section-label mx-1 mt-2">Application</h6>
                                            <div class="col-12 mt-1 mb-2">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch4" />
                                                    <label class="custom-control-label" for="accountSwitch4">News and announcements</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch6" />
                                                    <label class="custom-control-label" for="accountSwitch6">Weekly product updates</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-75">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="accountSwitch5" />
                                                    <label class="custom-control-label" for="accountSwitch5">Weekly blog digest</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                                <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ notifications -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ right content section -->
                </div>
            </section>
            <!-- / account setting page -->

        </div>
    </div>
</div>
<script src="<?= HOME ?>/js/accountsettings.js"></script>