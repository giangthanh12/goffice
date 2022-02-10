<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-user.css"/>
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

                                <th>Họ tên</th>
                                <th>Mã nhân viên</th>
                                <th>Email</th>
                                <th>Điện thoại</th>
                                <th>Tình trạng</th>
                                <th>...</th>
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
                               
                                <!-- <div class="modal-body flex-grow-1">
                                    <label class="form-label" for="staffCode">Mã nhân viên</label>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <input 
                                                    type="text" 
                                                    id="staffCode" 
                                                    name="staffCode"  
                                                    class="form-control"
                                                    placeholder="Mã nhân viên"/>
                                            </div>
                                            <div class="col-sm-3">
                                                
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label class="form-label" for="phoneNumber">Điện thoại</label>
                                        <input type="text" id="phoneNumber" class="form-control dt-uname"
                                               placeholder="Số điện thoại" aria-label="jdoe1"
                                               aria-describedby="basic-icon-default-uname2" name="phoneNumber"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <input
                                                type="text"
                                                id="email"
                                                class="form-control dt-email"
                                                placeholder="Email cá nhân"
                                                aria-label="john.doe@example.com"
                                                aria-describedby="basic-icon-default-email2"
                                                name="email"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block mb-1">Giới tính</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" checked="checked" id="male" name="gender"
                                                   class="custom-control-input" value="1"/>
                                            <label class="custom-control-label" for="male">Nam</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="female" name="gender" class="custom-control-input"
                                                   value="2"/>
                                            <label class="custom-control-label" for="female">Nữ</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="other" name="gender" class="custom-control-input"
                                                   value="3"/>
                                            <label class="custom-control-label" for="other">Khác</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="birthday">Ngày sinh</label>
                                        <input id="birthday" placeholder="DD/MM/YYYY" name="birthday" type="text"
                                               class="form-control  flatpickr-basic"/>
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
                    <div class="modal fade text-left" id="updateinfo" role="dialog" aria-labelledby="myModalLabel16"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16">Cập nhật thông tin nhân sự</h4>
                                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button> -->
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="id" name="id"/>
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="nav nav-pills" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center active"
                                                       id="information-tab" data-toggle="tab" href="#information"
                                                       aria-controls="information" role="tab" aria-selected="false">
                                                        <i data-feather="info"></i><span class="d-none d-sm-block">Thông tin nhân sự</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center" id="account-tab"
                                                       data-toggle="tab" href="#account" aria-controls="account"
                                                       role="tab" aria-selected="true">
                                                        <i data-feather="user"></i><span class="d-none d-sm-block">Lịch sử công tác</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center" id="social-tab"
                                                       data-toggle="tab" href="#social" aria-controls="social"
                                                       role="tab" aria-selected="false">
                                                        <i data-feather="share-2"></i><span class="d-none d-sm-block">Mạng xã hội</span>
                                                    </a>
                                                </li>

                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="information"
                                                     aria-labelledby="information-tab" role="tabpanel">
                                                    <!-- users edit Info form start -->
                                                    <form class="form-validate" id="formInfoStaff" enctype="multipart/form-data"
                                                         >
                                                        <div class="media mb-2 col-12">
                                                            <div class="col-lg-4 d-flex mt-1 px-0">
                                                                <img id="avatar" src="" alt="users avatar" onerror="this.src='<?=HOME?>/layouts/useravatar.png'"
                                                                     class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                                                     height="90" width="90"/>
                                                                <div class="media-body col-lg-12 mt-50">
                                                                    <h4 id="nhanvien">No name</h4>
                                                                    <div class="d-flex mt-1 px-0">
                                                                        <label class="btn btn-primary mr-75 mb-0"
                                                                               for="hinhanh">
                                                                            <span class="d-none d-sm-block">Thay ảnh</span>
                                                                            <input class="form-control" type="file"
                                                                                   id="hinhanh" name="hinhanh" hidden
                                                                                   accept="image/png, image/jpeg, image/jpg"
                                                                                   onchange="changeImage()"/>
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
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="male1" name="gender1"
                                                                               class="custom-control-input" value="1"/>
                                                                        <label class="custom-control-label" for="male1">Nam</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="female1" name="gender1"
                                                                               class="custom-control-input" value="2"/>
                                                                        <label class="custom-control-label"
                                                                               for="female1">Nữ</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="other1" name="gender1"
                                                                               class="custom-control-input" value="3"/>
                                                                        <label class="custom-control-label"
                                                                               for="other1">Khác</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3 d-flex mt-1 px-0">
                                                                <div class="form-group">
                                                                    <label class="d-block mb-1">Tình trạng hôn
                                                                        nhân</label>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="married"
                                                                               name="maritalStatus"
                                                                               class="custom-control-input" value="1"/>
                                                                        <label class="custom-control-label"
                                                                               for="married">Đã kết hôn</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="alone"
                                                                               name="maritalStatus"
                                                                               class="custom-control-input" value="3"/>
                                                                        <label class="custom-control-label" for="alone">Độc
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
                                                            <input type="hidden" id="branchId" name="branchId">
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="code1">Mã nhân viên</label>
                                                                      <div class="row">
                                                                          <div class="col-lg-10 col-md-9">
                                                                          <input id="staffCode" type="text"
                                                                           class="form-control" name="code1"/>
                                                                      </div>
                                                                      <div class="col-lg-2 col-md-3">
                                                                            <button type="button" class="btn btn-primary" id="createCode" onclick="createCodeStaff()">+</button>      
                                                                      </div>
                                                                      </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name1">Họ và tên</label>
                                                                    <input id="name1" type="text" class="form-control"
                                                                           name="name1"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="birthday1">Ngày sinh</label>
                                                                    <input id="birthday1" name="birthday1" type="text"
                                                                           class="form-control flatpickr-basic"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phoneNumber1">Điện thoại</label>
                                                                    <input id="phoneNumber1" type="text"
                                                                           class="form-control" name="phoneNumber1"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email1">Email</label>
                                                                    <input id="email1" type="text" class="form-control"
                                                                           placeholder="Email cá nhân" name="email1"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="address">Địa chỉ khai sinh</label>
                                                                    <input id="address" type="text" class="form-control"
                                                                           name="address"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="residence">Địa chỉ cư trú</label>
                                                                    <input id="residence" type="text"
                                                                           class="form-control" name="residence"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="accesspoints">Điểm truy cập</label>
                                                                    <select class="select2 form-control" multiple="true"
                                                                            id="accesspoints"
                                                                            name="accesspoints[]"
                                                                            placeholder="Điểm truy cập">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <label class="form-label" for="status_update">Trạng thái</label>
                                                                <select id="status_update" name="status_update" class="form-control">
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
                                                                           name="idCard"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="idDate">Ngày cấp</label>
                                                                    <input id="idDate" name="idDate" type="text"
                                                                           class="form-control flatpickr-basic"/>
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
                                                                           name="taxCode"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="vssId">Số BHXH</label>
                                                                    <input id="vssId" type="text" class="form-control"
                                                                           name="vssId"
                                                                           placeholder="Số bảo hiểm xã hội"/>
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
                                                                           aria-describedby="basic-addon3"
                                                                    />
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
                                                                        <span class="input-group-text"
                                                                              id="basic-addon5">
                                                                            <i data-feather="instagram"
                                                                               class="font-medium-2"></i>
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
                                                                        <span class="input-group-text"
                                                                              id="basic-addon9">
                                                                            <i data-feather="github"
                                                                               class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input id="zalo" name="zalo" type="text"
                                                                           class="form-control"
                                                                           aria-describedby="basic-addon9"/>
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
                                                                        <span class="input-group-text"
                                                                              id="basic-addon11">
                                                                            <i data-feather="slack"
                                                                               class="font-medium-2"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input id="linkein" name="linkein" type="text"
                                                                           class="form-control"
                                                                           aria-describedby="basic-addon11"/>
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
