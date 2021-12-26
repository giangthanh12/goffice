<link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/pages/app-user.css" />
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
                        <div class="col-md-4 user_role"></div>
                        <div class="col-md-4 user_plan"></div>
                        <div class="col-md-4 user_status"></div>
                    </div>
                </div>
                <!-- users filter end -->
                <!-- list section start -->
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Điện thoại</th>
                                    <th>Phòng ban</th>
                                    <th>Hợp đồng</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- Modal to add new user starts-->
                    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
                        <div class="modal-dialog">
                            <form class="add-new-user modal-content pt-0">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm nhân viên mới</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="form-group">
                                        <label class="form-label" for="fullname">Họ tên</label>
                                        <input
                                            type="text"
                                            class="form-control dt-full-name"
                                            id="fullname"
                                            placeholder="Họ và tên đầy đủ"
                                            name="fullname"
                                            aria-label="John Doe"
                                            aria-describedby="basic-icon-default-fullname2"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="dien_thoai">Điện thoại</label>
                                        <input type="text" id="dien_thoai" class="form-control dt-uname" placeholder="Số điện thoại" aria-label="jdoe1" aria-describedby="basic-icon-default-uname2" name="user-name" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="user-email">Email</label>
                                        <input
                                            type="text"
                                            id="user-email"
                                            class="form-control dt-email"
                                            placeholder="Email cá nhân"
                                            aria-label="john.doe@example.com"
                                            aria-describedby="basic-icon-default-email2"
                                            name="user-email"
                                        />
                                        <small class="form-text text-muted"> Hòm thư cá nhân gmail </small>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="user-role">Chi nhánh</label>
                                        <select id="user-role" class="form-control">
                                            <option value="subscriber">Hà Nội</option>
                                            <option value="editor">TP HCM</option>
                                            <option value="maintainer">Đà Nẵng</option>
                                            <option value="author">Bắc Ninh</option>
                                            <option value="admin">Hải Phòng</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="user-plan">Phòng ban</label>
                                        <select id="user-plan" class="form-control">
                                            <option value="basic">Hành chính nhân sự</option>
                                            <option value="enterprise">Kinh doanh</option>
                                            <option value="company">Marketing</option>
                                            <option value="team">Kỹ thuật</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="tinh_trang">Hợp đồng</label>
                                        <select id="tinh_trang" class="form-control">
                                            <option value="1">Fresher</option>
                                            <option value="2">Thử việc</option>
                                            <option value="3">Chính thức</option>
                                            <option value="4">Cộng tác viên</option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-primary mr-1 data-submit" onclick="them()">Lưu</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal to edit user -->
                    <div class="modal fade text-left" id="updateinfo" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16">Cập nhật thông tin nhân sự</h4>
                                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button> -->
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="id" name="id" />
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="nav nav-pills" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center active" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                                        <i data-feather="info"></i><span class="d-none d-sm-block">Thông tin nhân sự</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center" id="account-tab" data-toggle="tab" href="#account"  aria-controls="account" role="tab" aria-selected="true">
                                                        <i data-feather="user"></i><span class="d-none d-sm-block">Account</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center" id="social-tab" data-toggle="tab" href="#social" aria-controls="social" role="tab" aria-selected="false">
                                                        <i data-feather="share-2"></i><span class="d-none d-sm-block">Social</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="information" aria-labelledby="information-tab" role="tabpanel">
                                                    <!-- users edit Info form start -->
                                                    <form class="form-validate" enctype="multipart/form-data" id="thongtin">
                                                        <div class="media mb-2 col-12">
                                                            <div class="col-lg-4 d-flex mt-1 px-0">
                                                                <img id="avatar" src="" alt="users avatar" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90" />
                                                                <div class="media-body col-lg-12 mt-50">
                                                                    <h4 id="nhanvien">No name</h4>
                                                                    <div class="d-flex mt-1 px-0">
                                                                        <label class="btn btn-primary mr-75 mb-0" for="hinhanh">
                                                                            <span class="d-none d-sm-block">Thay ảnh</span>
                                                                            <input class="form-control" type="file" id="hinhanh" name="hinhanh" hidden accept="image/png, image/jpeg, image/jpg" onchange="thayanh()" />
                                                                            <span class="d-block d-sm-none">
                                                                                <i class="mr-0" data-feather="edit"></i>
                                                                            </span>
                                                                        </label>
                                                                        <!-- <button class="btn btn-outline-secondary d-none d-sm-block">Remove</button> -->
                                                                        <!-- <button class="btn btn-outline-secondary d-block d-sm-none">
                                                                        <i class="mr-0" data-feather="trash-2"></i>
                                                                        </button> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 d-flex mt-1 px-0">
                                                                <div class="form-group">
                                                                    <label class="d-block mb-1">Giới tính</label>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="male" name="gender" class="custom-control-input" value="1" />
                                                                        <label class="custom-control-label" for="male">Nam</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="female" name="gender" class="custom-control-input" value="0" />
                                                                        <label class="custom-control-label" for="female">Nữ</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 d-flex mt-1 px-0">
                                                                <div class="form-group">
                                                                    <label class="d-block mb-1">Loại hợp đồng lao động</label>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="hopdong1" name="hopdong" class="custom-control-input" value="1" />
                                                                        <label class="custom-control-label" for="hopdong1">Fresher</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="hopdong2" name="hopdong" class="custom-control-input" value="2" />
                                                                        <label class="custom-control-label" for="hopdong2">Thử việc</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="hopdong3" name="hopdong" class="custom-control-input" value="3" />
                                                                        <label class="custom-control-label" for="hopdong3">Chính thức</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="hopdong4" name="hopdong" class="custom-control-input" value="4" />
                                                                        <label class="custom-control-label" for="hopdong4">Cộng tác viên</label>
                                                                    </div>
                                                                    <!-- <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input" id="hopdong1" oncke/>
                                                <label class="custom-control-label" for="email-cb">Fresher</label>
                                              </div>
                                              <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input" id="hopdong2" checked />
                                                <label class="custom-control-label" for="message">Thử việc</label>
                                              </div>
                                              <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input" id="hopdong3" />
                                                <label class="custom-control-label" for="phone">Chính thức</label>
                                              </div>
                                              <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input" id="hopdong4" />
                                                <label class="custom-control-label" for="phone">Cộng tác viên</label>
                                              </div> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-1">
                                                            <div class="col-12">
                                                                <h4 class="mb-1">
                                                                    <i data-feather="user" class="font-medium-4 mr-25"></i>
                                                                    <span class="align-middle">Thông tin cá nhân</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="hoten">Họ và tên</label>
                                                                    <input id="hoten" type="text" class="form-control" value="Trần Văn Hải" name="hoten" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ngaysinh">Ngày sinh</label>
                                                                    <input id="ngaysinh" name="ngaysinh" type="text" class="form-control flatpickr-validation flatpickr" placeholder="22 Dec 2001" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="dienthoai">Điện thoại</label>
                                                                    <input id="dienthoai" type="text" class="form-control" name="dienthoai" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input id="email" type="text" class="form-control" placeholder="Email cá nhân" name="email" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="diachi">Địa chỉ</label>
                                                                    <input id="diachi" type="text" class="form-control" placeholder="Chỗ ở hiện tại" name="diachi" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="quequan">Quê quán</label>
                                                                    <select name="quequan" id="quequan" class="select2-data-array form-control"></select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <h4 class="mb-1 mt-2">
                                                                    <i data-feather="map-pin" class="font-medium-4 mr-25"></i>
                                                                    <span class="align-middle">Thông tin pháp lý</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="cmnd">CMND/CCCD</label>
                                                                    <input id="cmnd" type="text" class="form-control" name="cmnd" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ngaycap">Ngày cấp</label>
                                                                    <input id="ngaycap" name="ngaycap" type="text" class="form-control flatpickr-validation flatpickr" placeholder="22 Dec 2001" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="noicap">Nơi cấp</label>
                                                                    <select id="noicap" name="noicap" class="select2-data-array form-control"></select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="masothue">Mã số thuế</label>
                                                                    <input id="masothue" type="text" class="form-control" placeholder="Mã số thuế cá nhân" name="masothue" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="bhxh">Số BHXH</label>
                                                                    <input id="bhxh" type="text" class="form-control" name="bhxh" placeholder="Số bảo hiểm xã hội" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="thuongtru">Địa chỉ thường trú</label>
                                                                    <input id="thuongtru" type="text" class="form-control" name="thuongtru" placeholder="Địa chỉ thường trú" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                                <button type="button" onclick="updateinfo()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- users edit Info form ends -->
                                                </div>
                                                <!-- Account Tab starts -->
                                                <div class="tab-pane" id="account" aria-labelledby="account-tab" role="tabpanel">
                                                    <!-- users edit media object start -->
                                                    <!-- users edit media object ends -->
                                                    <!-- users edit account form start -->
                                                    <form class="form-validate" id="add_account">
                                                        <div class="rows">
                                                        <div class="col-md-4">
                                                        <h3>Tạo tài khoản mới</h3>
                                                            <div class="form-group">
                                                                <label for="email">Username</label>
                                                                <input type="text" class="form-control" placeholder="Email" onchange="check_username();"  name="add_username" id="add_username" />
                                                                <p class="note_status"></p>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="rows">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="password">Mật khẩu</label>
                                                                <input type="password" class="form-control" placeholder="Nhập mật khẩu "  name="add_password" id="add_password" />
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="rows">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                            <button type="submit" id="btn_add_users" onclick="add_users();return false;" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-float waves-light">Tạo tài khoản</button>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <form class="form-validate" id="form_account">
                                                        <div class="row">
                                                                <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="email">E-mail</label>
                                                                    <input type="text" class="form-control" placeholder="Email" onchange="check_username_edit();"  name="edit_username" id="edit_username" />
                                                                    <p class="note_status_edit"></p>
                                                                    <input type="hidden"  name="id_user" id="id_user" />
                                                                </div>
                                                                </div>
                                                                <div class="col-md-4 show_pass">
                                                                    <div class="form-group">
                                                                        <label for="edit_password">Nhập mật khẩu mới</label>
                                                                        <input type="password" class="form-control" placeholder="Password" name="edit_password" id="edit_password" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 btn_show_pass">
                                                                    <div class="form-group">
                                                                    <button  class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-float waves-light" onclick="show_pass();return false">Đổi mật khẩu</button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 btn_hidden_pass">
                                                                    <div class="form-group">
                                                                    <button  class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-float waves-light" onclick="hidden_pass();return false">Đóng</button>
                                                                    </div>
                                                                </div>
                                                            <div class="clear"></div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="tinh_trang">Tình trạng</label>
                                                                    <select name="users_tinh_trang" id="users_tinh_trang" class="form-control">
                                                                        <option value="0">Tạm ngưng</option>
                                                                        <option value="1">Hoạt động</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="ext_num">Số máy nhánh</label>
                                                                    <input type="text" class="form-control" placeholder="Máy nhánh điện thoại" name="ext_num" id="ext_num" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="sip_pass">PIN</label>
                                                                    <input type="password" class="form-control" placeholder="Mật khẩu kết nối" id="sip_pass" name="sip_pass" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="table-responsive border rounded mt-1">
                                                                    <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                                        <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                                        <span class="align-middle">Permission</span>
                                                                    </h6>
                                                                    <table class="table table-striped table-borderless">
                                                                        <thead class="thead-light">
                                                                            <tr>
                                                                                <th>Module</th>
                                                                                <th>Read</th>
                                                                                <th>Write</th>
                                                                                <th>Create</th>
                                                                                <th>Delete</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Admin</td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="admin-read" checked />
                                                                                        <label class="custom-control-label" for="admin-read"></label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="admin-write" />
                                                                                        <label class="custom-control-label" for="admin-write"></label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="admin-create" />
                                                                                        <label class="custom-control-label" for="admin-create"></label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="admin-delete" />
                                                                                        <label class="custom-control-label" for="admin-delete"></label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Staff</td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="staff-read" />
                                                                                        <label class="custom-control-label" for="staff-read"></label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="staff-write" checked />
                                                                                        <label class="custom-control-label" for="staff-write"></label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="staff-create" />
                                                                                        <label class="custom-control-label" for="staff-create"></label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="staff-delete" />
                                                                                        <label class="custom-control-label" for="staff-delete"></label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Author</td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="author-read" checked />
                                                                                        <label class="custom-control-label" for="author-read"></label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="author-write" />
                                                                                        <label class="custom-control-label" for="author-write"></label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="author-create" checked />
                                                                                        <label class="custom-control-label" for="author-create"></label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="author-delete" />
                                                                                        <label class="custom-control-label" for="author-delete"></label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Contributor</td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="contributor-read" />
                                                                                        <label class="custom-control-label" for="contributor-read"></label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="contributor-write" />
                                                                                        <label class="custom-control-label" for="contributor-write"></label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="contributor-create" />
                                                                                        <label class="custom-control-label" for="contributor-create"></label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="contributor-delete" />
                                                                                        <label class="custom-control-label" for="contributor-delete"></label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>User</td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="user-read" />
                                                                                        <label class="custom-control-label" for="user-read"></label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="user-create" />
                                                                                        <label class="custom-control-label" for="user-create"></label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="user-write" />
                                                                                        <label class="custom-control-label" for="user-write"></label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="user-delete" checked />
                                                                                        <label class="custom-control-label" for="user-delete"></label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                                <button type="submit" id="btn_edit_users" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1" onclick="update_users(); return false;">Cập nhật</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- users edit account form ends -->
                                                </div>
                                                <!-- Account Tab ends -->
                                                <!-- Information Tab starts -->
                                                <!-- Information Tab ends -->
                                                <!-- Social Tab starts -->
                                                <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">
                                                    <!-- users edit social form start -->
                                                    <form class="form-validate">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-6 form-group">
                                                                <label for="twitter-input">Twitter</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon3">
                                                                            <i data-feather="twitter" class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input id="twitter" name="twitter" type="text" class="form-control"
                                                                        aria-describedby="basic-addon3"
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 form-group">
                                                                <label for="facebook-input">Facebook</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon4">
                                                                            <i data-feather="facebook" class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input
                                                                        id="facebook" name="facebook"
                                                                        type="text"
                                                                        class="form-control"
                                                                        aria-describedby="basic-addon4"
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 form-group">
                                                                <label for="instagram-input">Instagram</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon5">
                                                                            <i data-feather="instagram" class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input
                                                                        id="instagram" name="instagram"
                                                                        type="text"
                                                                        class="form-control"
                                                                        placeholder="Link"
                                                                        aria-describedby="basic-addon5"
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 form-group">
                                                                <label for="github-input">Zalo</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon9">
                                                                            <i data-feather="github" class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input id="zalo" name="zalo" type="text" class="form-control"  aria-describedby="basic-addon9" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 form-group">
                                                                <label for="codepen-input">Wechat</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon12">
                                                                            <i data-feather="codepen" class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input
                                                                        id="wechat" name="wechat"
                                                                        type="text"
                                                                        class="form-control"
                                                                        aria-describedby="basic-addon12"
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 form-group">
                                                                <label for="slack-input">LinkedIn</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon11">
                                                                            <i data-feather="slack" class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input id="linkein" name="linkein" type="text" class="form-control"  aria-describedby="basic-addon11" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                                <button type="button"  id="add_nhanvien_info" onclick="add_nhanvien_info1()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                                <button type="button"  id="update_nhanvien_info" onclick="update_nhanvien_info1(); return false;" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- users edit social form ends -->
                                                </div>
                                                <!-- Social Tab ends -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cập nhật</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Bỏ qua</button>
                          </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- <div class="modal fade text-left" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16">Extra Large Modal</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Cake cupcake sugar plum. Sesame snaps pudding cupcake candy canes icing cheesecake. Sweet roll
                                    pudding lollipop apple pie gummies dragée. Chocolate bar cookie caramels I love lollipop ice cream
                                    tiramisu lollipop sweet.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                    <!-- list section end -->
                    <!-- users list ends -->
                </div>
            </section>
        </div>
    </div>
</div>

<script src="<?=HOME?>/js/nhansu.js"></script>
