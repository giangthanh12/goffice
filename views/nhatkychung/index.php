<link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/pages/app-user.css" />
<link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
<link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/plugins/forms/pickers/form-pickadate.css">
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <section class="app-user-list">
                <div class="card">
                    <div class="d-flex justify-content-between align-items-center mx-50 row pt-2 pb-2">
                        <div class="col-md-3 selectkh"></div>
                        <div class="col-md-3 selecttk"></div>
                        <div class="col-md-3 tungay">
                            <input id="ngaysinh" name="ngaysinh" type="text" class="form-control flatpickr-validation flatpickr" placeholder="22 Dec 2001" />
                        </div>
                        <div class="col-md-3 denngay"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Ngày</th>
                                    <th>Số chứng từ</th>
                                    <th>Diễn giải</th>
                                    <th>Tài khoản</th>
                                    <th>Khách hàng</th>
                                    <th>Nợ (thu)</th>
                                    <th>Có (chi)</th>
                                    <th>Đối ứng</th>
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
                                                    <a class="nav-link d-flex align-items-center" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
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
                                                    <form class="form-validate">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="username">Username</label>
                                                                    <input type="text" class="form-control" placeholder="Username" value="eleanor.aguilar" name="username" id="username" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" class="form-control" placeholder="Name" value="Eleanor Aguilar" name="name" id="name" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="email">E-mail</label>
                                                                    <input type="email" class="form-control" placeholder="Email" value="eleanor.aguilar@gmail.com" name="email" id="email" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="status">Status</label>
                                                                    <select class="form-control" id="status">
                                                                        <option>Active</option>
                                                                        <option>Blocked</option>
                                                                        <option>Deactivated</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="role">Role</label>
                                                                    <select class="form-control" id="role">
                                                                        <option>Admin</option>
                                                                        <option>User</option>
                                                                        <option>Staff</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="company">Company</label>
                                                                    <input type="text" class="form-control" value="WinDon Technologies Pvt Ltd" placeholder="Company name" id="company" />
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
                                                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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
                                                                    <input
                                                                        id="twitter-input"
                                                                        type="text"
                                                                        class="form-control"
                                                                        value="https://www.twitter.com/adoptionism744"
                                                                        placeholder="https://www.twitter.com/"
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
                                                                        id="facebook-input"
                                                                        type="text"
                                                                        class="form-control"
                                                                        value="https://www.facebook.com/adoptionism664"
                                                                        placeholder="https://www.facebook.com/"
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
                                                                        id="instagram-input"
                                                                        type="text"
                                                                        class="form-control"
                                                                        value="https://www.instagram.com/adopt-ionism744"
                                                                        placeholder="https://www.instagram.com/"
                                                                        aria-describedby="basic-addon5"
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 form-group">
                                                                <label for="github-input">Github</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon9">
                                                                            <i data-feather="github" class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input id="github-input" type="text" class="form-control" value="https://www.github.com/madop818" placeholder="https://www.github.com/" aria-describedby="basic-addon9" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 form-group">
                                                                <label for="codepen-input">Codepen</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon12">
                                                                            <i data-feather="codepen" class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input
                                                                        id="codepen-input"
                                                                        type="text"
                                                                        class="form-control"
                                                                        value="https://www.codepen.com/adoptism243"
                                                                        placeholder="https://www.codepen.com/"
                                                                        aria-describedby="basic-addon12"
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 form-group">
                                                                <label for="slack-input">Slack</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon11">
                                                                            <i data-feather="slack" class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input id="slack-input" type="text" class="form-control" value="@adoptionism744" placeholder="https://www.slack.com/" aria-describedby="basic-addon11" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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
<script src="<?=HOME?>/js/nhatkychung.js"></script>
<script src="<?=HOME?>/styles/app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
<script src="<?=HOME?>/styles/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="<?=HOME?>/styles/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="<?=HOME?>/styles/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
<script src="<?=HOME?>/styles/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
<script src="<?=HOME?>/styles/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
