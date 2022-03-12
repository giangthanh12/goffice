<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-user.css" />
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <!-- users filter start -->
                
                <!-- users filter end -->
                <!-- list section start -->
                <div class="card">
                    <div class="d-flex justify-content-between align-items-center mx-50 row pt-2">
                    <h2 class="content-header-title float-left mb-2" id="title_module">
                        Nhân sự <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Quản lý toàn bộ thông tin cá nhân của nhân sự trong doanh nghiệp" data-trigger="click" >
                    </h2>
                    </div>
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>

                                    <th>Họ tên</th>
                                    <th>Mã nhân viên</th>
                                    <th>Email</th>
                                    <th>Điện thoại</th>
                                    <th>Tình trạng</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- Modal to add new user starts-->
                    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
                        <div class="modal-dialog">
                            <form class="add-new-user modal-content pt-0" id="formAddStaff">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm nhân viên mới</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <label class="form-label" for="fullName">Tên nhân viên<span style="color:red;">*</span></label>
                                    <div class="form-group">
                                        <input type="text" id="fullName" name="fullName" class="form-control"
                                            placeholder="Tên nhân viên" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="phoneNumber">Điện thoại<span style="color:red;">*</span></label>
                                        <input type="text" id="phoneNumber" class="form-control dt-uname"
                                            placeholder="Số điện thoại" aria-label="jdoe1"
                                            aria-describedby="basic-icon-default-uname2" name="phoneNumber" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email<span style="color:red;">*</span></label>
                                        <input type="text" id="email" class="form-control dt-email"
                                            placeholder="Email cá nhân" aria-label="john.doe@example.com"
                                            aria-describedby="basic-icon-default-email2" name="email" />
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block mb-1">Giới tính</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" checked="checked" id="male" name="gender"
                                                class="custom-control-input" value="1" />
                                            <label class="custom-control-label" for="male">Nam</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="female" name="gender" class="custom-control-input"
                                                value="2" />
                                            <label class="custom-control-label" for="female">Nữ</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="other" name="gender" class="custom-control-input"
                                                value="3" />
                                            <label class="custom-control-label" for="other">Khác</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="birthday">Ngày sinh<span style="color:red;">*</span></label>
                                        <input id="birthday" placeholder="DD/MM/YYYY" name="birthday" type="text"
                                            class="form-control  flatpickr-basic" />
                                    </div>

                                    <div class="form-group mb-2">
                                        <label class="form-label" for="status">Trạng thái</label>
                                        <select id="status" class="form-control">
                                            <option value="1">Fresher</option>
                                            <option value="2">Thử việc</option>
                                            <option value="3">Chính thức</option>
                                            <option value="4">Cộng tác viên</option>
                                            <option value="5">Thời vụ</option>
                                            <option value="6">Tạm ngừng</option>
                                            <option value="7">Thôi việc</option>

                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-1 data-submit">Lưu</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal to edit user -->
                    <div class="modal fade" id="updateinfo"  aria-labelledby="myModalLabel16"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
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
                                                    <a class="nav-link d-flex align-items-center active"
                                                        id="information-tab" data-toggle="tab" href="#information"
                                                        aria-controls="information" role="tab" aria-selected="false">
                                                        <i data-feather="info"></i><span class="d-none d-sm-block">Thông
                                                            tin nhân sự</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center" id="account-tab"
                                                        data-toggle="tab" href="#account" aria-controls="account"
                                                        role="tab" aria-selected="true">
                                                        <i data-feather="user"></i><span class="d-none d-sm-block">Lịch
                                                            sử công tác</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center" id="social-tab"
                                                        data-toggle="tab" href="#social" aria-controls="social"
                                                        role="tab" aria-selected="false">
                                                        <i data-feather="share-2"></i><span
                                                            class="d-none d-sm-block">Mạng xã hội</span>
                                                    </a>
                                                </li>

                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="information"
                                                    aria-labelledby="information-tab" role="tabpanel">
                                                    <!-- users edit Info form start -->
                                                    <form class="form-validate" id="formInfoStaff"
                                                        enctype="multipart/form-data">
                                                        <div class="media mb-2 col-12">
                                                            <div class="col-lg-4 d-flex mt-1 px-0">
                                                                <img id="avatar" src="" alt="users avatar"
                                                                    onerror="this.src='<?=HOME?>/layouts/useravatar.png'"
                                                                    class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                                                    height="90" width="90" />
                                                                <div class="media-body col-lg-12 mt-50">
                                                                    <h4 id="nhanvien">No name</h4>
                                                                    <div class="d-flex mt-1 px-0">
                                                                        <label class="btn btn-primary mr-75 mb-0"
                                                                            for="hinhanh">
                                                                            <span class="d-none d-sm-block">Thay
                                                                                ảnh</span>
                                                                            <input class="form-control" type="file"
                                                                                id="hinhanh" name="hinhanh" hidden
                                                                                accept="image/png, image/jpeg, image/jpg"
                                                                                onchange="changeImage()" />
                                                                            <span class="d-block d-sm-none">
                                                                                <i class="mr-0" data-feather="edit"></i>
                                                                            </span>
                                                                        </label>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 d-flex mt-1 px-0">
                                                                <div class="form-group">
                                                                    <label class="d-block mb-1">Giới tính</label>
                                                                    <div
                                                                        class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="male1" name="gender1"
                                                                            class="custom-control-input" value="1" />
                                                                        <label class="custom-control-label"
                                                                            for="male1">Nam</label>
                                                                    </div>
                                                                    <div
                                                                        class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="female1" name="gender1"
                                                                            class="custom-control-input" value="2" />
                                                                        <label class="custom-control-label"
                                                                            for="female1">Nữ</label>
                                                                    </div>
                                                                    <div
                                                                        class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="other1" name="gender1"
                                                                            class="custom-control-input" value="3" />
                                                                        <label class="custom-control-label"
                                                                            for="other1">Khác</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3 d-flex mt-1 px-0">
                                                                <div class="form-group">
                                                                    <label class="d-block mb-1">Tình trạng hôn
                                                                        nhân</label>
                                                                    <div
                                                                        class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="married"
                                                                            name="maritalStatus"
                                                                            class="custom-control-input" value="1" />
                                                                        <label class="custom-control-label"
                                                                            for="married">Đã kết hôn</label>
                                                                    </div>
                                                                    <div
                                                                        class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="alone"
                                                                            name="maritalStatus"
                                                                            class="custom-control-input" value="3" />
                                                                        <label class="custom-control-label"
                                                                            for="alone">Độc
                                                                            thân</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-1">
                                                            <div class="col-12">
                                                                <h4 class="mb-1">
                                                                    <i data-feather="user"
                                                                        class="font-medium-4 mr-25"></i>
                                                                    <span class="align-middle">Thông tin cá nhân</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="staffCode">Mã nhân viên</label>
                                                                    <div class="row">
                                                                        <div class="col-lg-10 col-md-9">
                                                                            <input id="staffCode" type="text"
                                                                                class="form-control" name="staffCode" />
                                                                        </div>
                                                                        <div class="col-lg-2 col-md-3">
                                                                            <button type="button"
                                                                                class="btn btn-primary" id="createCode"
                                                                                onclick="createCodeStaff()">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name1">Họ và tên<span style="color:red;">*</span></label>
                                                                    <input id="name1" type="text" class="form-control"
                                                                        name="name1" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="birthday1">Ngày sinh</label>
                                                                    <input id="birthday1" name="birthday1" type="text"
                                                                        class="form-control flatpickr-basic" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phoneNumber1">Điện thoại<span style="color:red;">*</span></label>
                                                                    <input id="phoneNumber1" type="text"
                                                                        class="form-control" name="phoneNumber1" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email1">Email<span style="color:red;">*</span></label>
                                                                    <input id="email1" type="text" class="form-control"
                                                                        placeholder="Email cá nhân" name="email1" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="address">Địa chỉ khai sinh</label>
                                                                    <input id="address" type="text" class="form-control"
                                                                        name="address" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="residence">Địa chỉ cư trú</label>
                                                                    <input id="residence" type="text"
                                                                        class="form-control" name="residence" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="accesspoints">Điểm truy cập</label><img src="<?=HOME?>/layouts/tooltip.png" width="15px" id="current_ip" data-toggle="tooltip" data-placement="top" data-original-title="Tạo hướng dẫn ở đây" data-trigger="click" >
                                                                    <select class="select2 form-control" multiple="true"
                                                                        id="accesspoints" name="accesspoints[]"
                                                                        placeholder="Điểm truy cập">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <label class="form-label" for="status_update">Trạng
                                                                    thái</label>
                                                                <select id="status_update" name="status_update"
                                                                    class="form-control">
                                                                    <option value="1">Fresher</option>
                                                                    <option value="2">Thử việc</option>
                                                                    <option value="3">Chính thức</option>
                                                                    <option value="4">Cộng tác viên</option>
                                                                    <option value="5">Thời vụ</option>
                                                                    <option value="6">Tạm ngừng</option>
                                                                    <option value="7">Thôi việc</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-12">
                                                                <h4 class="mb-1 mt-2">
                                                                    <i data-feather="map-pin"
                                                                        class="font-medium-4 mr-25"></i>
                                                                    <span class="align-middle">Thông tin pháp lý</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="idCard">CMND/CCCD</label>
                                                                    <input id="idCard" type="text" class="form-control"
                                                                        name="idCard" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="idDate">Ngày cấp</label>
                                                                    <input id="idDate" name="idDate" type="text"
                                                                        class="form-control flatpickr-basic" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="idAddress">Nơi cấp</label>
                                                                    <select id="idAddress" name="idAddress"
                                                                        placeholder="Nơi cấp"
                                                                        class="select2 form-control"></select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="taxCode">Mã số thuế</label>
                                                                    <input id="taxCode" type="text" class="form-control"
                                                                        placeholder="Mã số thuế cá nhân"
                                                                        name="taxCode" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="vssId">Số BHXH</label>
                                                                    <input id="vssId" type="text" class="form-control"
                                                                        name="vssId" placeholder="Số bảo hiểm xã hội" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nationality">Quốc tịch</label>
                                                                    <select id="nationality" name="nationality"
                                                                        placeholder="Nơi cấp"
                                                                        class="select2 form-control"></select>

                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="description">Mô tả</label>
                                                                    <textarea id="description" cols="30"
                                                                        class="form-control" rows="5"
                                                                        placeholder="Mô tả bản thân"
                                                                        name="description"></textarea>
                                                                </div>
                                                            </div>


                                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                                <button type="submit" id="updateStaff"
                                                                    class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">
                                                                    Cập nhật
                                                                </button>
                                                                <button type="reset" class="btn btn-outline-secondary"
                                                                    data-dismiss="modal">Bỏ qua
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- users edit Info form ends -->
                                                </div>
                                                <!-- Account Tab starts -->
                                                <div class="tab-pane" id="account" aria-labelledby="account-tab"
                                                    role="tabpanel">
                                                    <div class="table-responsive border rounded mt-1">
                                                        <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                            <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                            <span class="align-middle">Chi tiết</span>
                                                            <?php if($this->funEdit == 1) { ?>
                                                            <button class="dt-button add-new-contact btn btn-primary mt-50" onclick="showFormContract()" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                                                <span>Thêm mới</span>
                                                            </button>
                                                            <?php } ?>
                                                        </h6>
                                                        <table class="table table-striped table-borderless"
                                                            id="record-list-table">
                                                            <thead class="thead-light ">
                                                                <tr>
                                                                    <th>Hợp đồng</th>
                                                                    <th>Phòng ban</th>
                                                                    <th>Lương</th>
                                                                    <th>Trợ cấp</th>
                                                                    <th>Ngày bắt đầu</th>
                                                                    <th>Ngày kết thúc</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- Social Tab starts -->
                                                <div class="tab-pane" id="social" aria-labelledby="social-tab"
                                                    role="tabpanel">
                                                    <!-- users edit social form start -->
                                                    <form class="form-validate" id="socailForm">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-6 form-group">
                                                                <label for="twitter-input">Twitter</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon3">
                                                                            <i data-feather="twitter"
                                                                                class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input id="twitter" name="twitter" type="text"
                                                                        class="form-control"
                                                                        aria-describedby="basic-addon3" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 form-group">
                                                                <label for="facebook-input">Facebook</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon4">
                                                                            <i data-feather="facebook"
                                                                                class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input id="facebook" name="facebook" type="text"
                                                                        class="form-control"
                                                                        aria-describedby="basic-addon4" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 form-group">
                                                                <label for="instagram-input">Instagram</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon5">
                                                                            <i data-feather="instagram"
                                                                                class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input id="instagram" name="instagram" type="text"
                                                                        class="form-control"
                                                                        aria-describedby="basic-addon5" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 form-group">
                                                                <label for="github-input">Zalo</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon9">
                                                                            <i data-feather="github"
                                                                                class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input id="zalo" name="zalo" type="text"
                                                                        class="form-control"
                                                                        aria-describedby="basic-addon9" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 form-group">
                                                                <label for="codepen-input">Wechat</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon12">
                                                                            <i data-feather="codepen"
                                                                                class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input id="wechat" name="wechat" type="text"
                                                                        class="form-control"
                                                                        aria-describedby="basic-addon12" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 form-group">
                                                                <label for="slack-input">LinkedIn</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon11">
                                                                            <i data-feather="slack"
                                                                                class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input id="linkein" name="linkein" type="text"
                                                                        class="form-control"
                                                                        aria-describedby="basic-addon11" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                                <!-- <button type="button"  id="add_nhanvien_info" onclick="add_nhanvien_info()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Thêm</button> -->
                                                                <button type="button" id="update_nhanvien_info"
                                                                    onclick="updateInfoStaff(); return false;"
                                                                    class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">
                                                                    Cập nhật
                                                                </button>
                                                                <button type="reset" class="btn btn-outline-secondary"
                                                                    data-dismiss="modal">Bỏ qua
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- users edit social form ends -->
                                                </div>
                                                <!-- Social Tab ends -->
                                            </div>
                                        </div>
                                        

                     <div class="modal fade text-left" id="add-contract" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">     
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title-contract" id="myModalLabel16"></h4>
                                    <button type="button" class="close" onclick=" $('#add-contract').modal('toggle');" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" enctype="multipart/form-data" id="formContract">
                                                <div class="row mt-1">
                                                    <input type="hidden" id="staffId" name="staffId" value="">
                                                    <div class="col-md-4 form-group">
                                                        <label for="nameContract">Tên hợp đồng</label>
                                                        <input id="nameContract" name="nameContract" type="text" class="form-control"  />
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="type">Loại hợp đồng</label>
                                                        <select id="type" class="form-control" name="type" >
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="departmentId">Phòng ban</label>
                                                        <select id="departmentId" class="form-control" name="departmentId" >
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="position">Vị trí</label>
                                                        <select id="position" class="form-control" name="position" >
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="branchId">Chi nhánh</label>
                                                        <select id="branchId" class="form-control" name="branchId" >
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="workPlaceId">Địa điểm làm việc</label>
                                                        <select id="workPlaceId" class="form-control" name="workPlaceId" >
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="shiftId">Phân ca</label>
                                                        <select id="shiftId" class="form-control" name="shiftId" >
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="basicSalary">Lương cơ bản</label>
                                                        <input id="basicSalary" type="text" class="form-control format_number" name="basicSalary" onkeyup="this.value=Comma(this.value)" />
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="salaryPercentage">Tỉ lệ lương (%)</label>
                                                        <input id="salaryPercentage" type="text" class="form-control" name="salaryPercentage" value="100" />
                                                    </div>

                                                    <div class="col-md-4 form-group">
                                                        <label for="allowance">Phụ cấp</label>
                                                        <input id="allowance" type="text" class="form-control format_number" name="allowance" onkeyup="this.value=Comma(this.value)" />
                                                    </div>

                                                    <div class="col-md-4 form-group">
                                                        <label for="startDate">Ngày bắt đầu</label>
                                                        <input type="text" id="startDate" name="startDate" class="form-control flatpickr-basic" placeholder="" />
                                                    </div>

                                                    <div class="col-md-4 form-group">
                                                        <label for="stopDate">Ngày kết thúc</label>
                                                        <input type="text" id="stopDate" name="stopDate" class="form-control flatpickr-basic" placeholder="" />
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="statusContract">Tình trạng</label>
                                                        <select id="statusContract" class="select2 form-control" name="statusContract">
                                                            <option value="1">Đang thực hiện</option>
                                                            <option value="2">Đã kết thúc</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="description">Ghi chú</label>
                                                        <input type="text" id="description" name="description" type="text" class="form-control " />
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="submit"  class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1" id="btnUpdate">Cập nhật</button>
                                                        
                                                        <button type="button" onclick=" $('#add-contract').modal('toggle');"  class="btn btn-outline-secondary" >Bỏ qua</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </section>
        </div>
    </div>
</div>
<script>
var funAdd = <?=$this->funAdd?>,
    funEdit = <?=$this->funEdit?>,
    funDel = <?=$this->funDel?>;
</script>
<script src="<?= HOME ?>/js/staff.js"></script>