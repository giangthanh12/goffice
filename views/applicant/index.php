<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-user.css" />
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
            <div class="card">
                    <div class="d-flex  align-items-center mx-50 row pt-2 pb-2">
                        <div class="col-md-3">
                            <select id="filterApplicant" data-column="5" class="select2 form-control" name="filterApplicant">
                                <option value="1">Lọc theo thời gian</option>
                                <option value="2">Lọc theo tên từ a-z</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="position-filter" data-column="5" class="form-control" name="position-filter">
                            </select>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="d-flex justify-content-between align-items-center mx-50 row pt-2 pb-2">
                        <h2 class="content-header-title float-left mb-0" id="title_module" style="border-right-width: 0px;">
                            Ứng viên   <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng quản lý toàn bộ thông tin cá nhân của ứng viên tham gia ứng tuyển công tác tại doanh nghiệp" data-trigger="click" >
                        </h2>
                    </div>
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Họ tên</th>
                                    <th>Giới tính</th>
                                    <th>Email</th>
                                    <th>Điện thoại</th>
                                    <th>CV</th>
                                    <th></th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!--  -->
                    <!-- Button trigger modal -->
                    <!-- Modal -->
                    <div class="modal fade" id="modals-slide-in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modals-slide-in">Thêm ứng viên mới</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" enctype="multipart/form-data" id="dg">
                                                <div class="form-group">
                                                    <label for="fullName">Họ và tên<span style="color:red;">*</span></label>
                                                    <input type="text" class="form-control" id="fullName" name="fullName" />
                                                </div>

                                                <div class="form-group">
                                                    <label for="dob">Ngày sinh</label>
                                                    <input type="text" id="dob" name="dob" class="form-control flatpickr-basic" placeholder="DD-MM-YYYY" />
                                                </div>

                                                <div class="form-group">
                                                    <label class="d-block mb-1">Giới tính</label>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" checked id="male1" name="gender" class="custom-control-input" value="1" />
                                                        <label class="custom-control-label" for="male1">Nam</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="female1" name="gender" class="custom-control-input" value="2" />
                                                        <label class="custom-control-label" for="female1">Nữ</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="phoneNumber">Số điện thoại<span style="color:red;">*</span></label>
                                                    <input type="text" class="form-control phoneNumber" data-id="phoneNumber" id="phoneNumber" name="phoneNumber" />
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email<span style="color:red;">*</span></label>
                                                    <input type="text" class="form-control" id="email" name="email" />
                                                </div>

                                                <div class="form-group">
                                                    <label for="position">Vị trí</label>
                                                    <select name="position" id="position" class="form-control" ></select>
                                                </div>
                                               
                                                <div class="form-group">
                                                    <label class="form-label" for="fileadd">CV</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="fileadd" name="fileadd">
                                                        <label class="custom-file-label" for="fileadd">Chọn file</label>
                                                    </div>
                                                 
                                                </div>
                                                <div class="form-group">
                                                    <label for="note">Ghi chú</label>
                                                    <textarea id="note" name="note" class="form-control"></textarea>
                                                </div>
                                                <div class="d-flex flex-sm-row flex-column mt-2">
                                                    <button type="submit" class="btn btn-add-customer btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--  -->
                    <!-- Nhập excel  -->
                    <div class="modal fade text-left" id="nhapexcel" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modal-title1">Nhập khách hàng từ excel</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="fm-nhapexcel">
                                        <div class="form-group">
                                            <label class="form-label mr-4" for="file">Tải file mẫu</label>
                                            <a target="_blank" href="<?= URLFILE ?>/uploads/bieumau/danhsachungvien.xlsx" style="color: blue;">Tải xuống <i class="fas fa-download"></i></a>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="file">File upload</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="fileExcel" name="fileExcel">
                                                <label class="custom-file-label" for="fileExcel">Chọn file</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-dismiss="modal" onclick="savenhap()">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- kết thúc excel -->




                    <!-- Thêm chiến dịch theo ứng viên -->
                    <div class="modal modal-slide-in new-user-modal fade" id="modalCandidate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16">Thêm chiến dịch cho ứng viên</h4>
                                </div>
                                <div class="modal-body" style="margin:0;">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">

                                            <form class="form-validate" enctype="multipart/form-data" id="formCandidate">
                                               <input type="hidden" name="canId" id="canId" />
                                            <div class="row mt-1">
                                       
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="campId">Chiến dịch</label>
                                                            <select  id="campId" name="campId[]" multiple="multiple" class="form-control select2">
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="button" onclick="addRecruitment()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                    </div>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal to edit user -->
                    <div class="modal fade text-left" id="updateinfo" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16">Cập nhật thông tin ứng viên</h4>

                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="nav nav-pills" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center active" id="tab-1" data-toggle="tab" href="#tab1" aria-controls="information" role="tab" aria-selected="false">
                                                        <i data-feather="info"></i><span class="d-none d-sm-block">Thông tin chung</span>
                                                    </a>
                                                </li>
                                                <!-- <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center" id="tab-2" data-toggle="tab" href="#tab2" aria-controls="account" role="tab" aria-selected="true">
                                                        <i data-feather="user"></i><span class="d-none d-sm-block">Thông tin gia đình</span>
                                                    </a>
                                                </li> -->
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center" id="tab-3" data-toggle="tab" href="#tab3" aria-controls="social" role="tab" aria-selected="false">
                                                        <i data-feather="share-2"></i><span class="d-none d-sm-block">Trình độ học vấn</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center" id="tab-4" data-toggle="tab" href="#tab4" aria-controls="social" role="tab" aria-selected="false">
                                                        <i data-feather="share-2"></i><span class="d-none d-sm-block">Kinh nghiệm làm việc</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab1" aria-labelledby="tab1" role="tabpanel">
                                                    <!-- users edit Info form start -->
                                                    <form class="form-validate" enctype="multipart/form-data" id="thongtin">
                                                        <div class="media mb-2 col-12">
                                                            <div class="col-lg-4 d-flex mt-1 px-0">
                                                                <img id="avatar" onerror="this.src='<?=HOME?>/layouts/useravatar.png'" src="" alt="users avatar" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90" />
                                                                <div class="media-body col-lg-12 mt-50">
                                                                    <h4 id="ungvien">No name</h4>
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
                                                            <div class="col-lg-3 d-flex mt-1 px-0">
                                                                <div class="form-group">
                                                                    <label class="d-block mb-1">Giới tính</label>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" checked id="male2" name="gender1" class="custom-control-input" value="1" />
                                                                        <label class="custom-control-label" for="male2">Nam</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="female2" name="gender1" class="custom-control-input" value="2" />
                                                                        <label class="custom-control-label" for="female2">Nữ</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 d-flex mt-1 px-0">
                                                                <div class="form-group">
                                                                    <label class="d-block mb-1">Tình trạng hôn nhân</label>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="tthn1" name="tthonnhan" class="custom-control-input" value="1" />
                                                                        <label class="custom-control-label" for="tthn1">Đã có gia đình</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" id="tthn2" name="tthonnhan" class="custom-control-input" value="2" />
                                                                        <label class="custom-control-label" for="tthn2">Chưa có gia đình</label>
                                                                    </div>


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
                                                                    <input id="hoten" type="text" class="form-control" placeholder="Nhập họ và tên" name="hoten" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="quoctich">Quốc tịch</label>
                                                                    <input id="quoctich" type="text" class="form-control" placeholder="Quốc tịch" name="quoctich" />
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-lg-2 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="dantoc">Dân tộc</label>
                                                                    <input id="dantoc" type="text" class="form-control" placeholder="Dân tộc" name="dantoc" />
                                                                </div>
                                                            </div> -->

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ngaysinh">Ngày sinh</label>
                                                                    <input id="ngaysinh" name="ngaysinh" type="text" class="form-control flatpickr-basic" placeholder="13 May 2001" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="noisinh">Nơi sinh</label>
                                                                    <select id="noisinh" name="noisinh" class="select2-data-array form-control"></select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="residence">Nơi ở hiện tại</label>
                                                                    <select id="residence" name="residence" class="select2-data-array form-control"></select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="salary">Mức lương mong muốn</label>
                                                                    <input id="salary" type="text" class="form-control format_number" name="salary" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nguon">Nguồn ứng viên</label>
                                                                    <select id="nguon" name="nguon" class="select2 form-control">
                                                                        <option value="1">Mạng xã hội</option>
                                                                        <option value="2">Trang tuyển dụng</option>
                                                                        <option value="3">Được giới thiệu</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="introduce">Nguồn/người giới thiệu</label>
                                                                    <input id="introduce" type="text" class="form-control" name="introduce" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="position1">Vị trí ứng tuyển</label>
                                                                    <select name="position1" id="position1" class="form-control1" ></select>
                                                                </div>
                                                            </div>

                                                            <!-- <div class="col-lg-2 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="luongthuviec">Lương thử việc</label>
                                                                    <input id="luongthuviec" type="text" class="form-control" placeholder="Lương thử việc" name="luongthuviec" />
                                                                </div>
                                                            </div> -->
                                                            <div class="col-lg-8 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="note1">Giới thiệu bản thân</label>
                                                                    <textarea id="note1" class="form-control" placeholder="Giới thiệu bản thân" name="note1"></textarea>
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
                                                                    <label for="idNumber">CMND/CCCD/Hộ chiếu</label>
                                                                    <input id="idNumber" type="text" class="form-control" name="idNumber" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="idDate">Ngày cấp</label>
                                                                    <input id="idDate" name="idDate" type="text" class="form-control flatpickr-basic" placeholder="DD-MM-YYYY" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">

                                                                <div class="form-group">
                                                                    <label for="idPlace">Nơi cấp</label>
                                                                    <select id="idPlace" class="select2 form-control" name="idPlace"></select>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <h4 class="mb-1 mt-2">
                                                                    <i data-feather="map-pin" class="font-medium-4 mr-25"></i>
                                                                    <span class="align-middle">Thông tin liên hệ</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="address">Địa chỉ</label>
                                                                    <input id="address" name="address" type="text" class="form-control" placeholder="Chỗ ở hiện nay" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phoneNumber1">Điện thoại</label>
                                                                    <input id="phoneNumber1" data-id="phoneNumber1" type="text" class="form-control phoneNumber" name="phoneNumber1" placeholder="0989848886" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="e_mail">Email</label>
                                                                    <input id="e_mail" name="e_mail" type="text" class="form-control flatpickr-validation flatpickr" placeholder="info@gemstech.com.vn" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="file1">CV</label>
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="file1" name="file1">
                                                                        <label class="custom-file-label" for="file1">Chọn file</label>
                                                                    </div>
                                                                    <div id="viewfile">
                                                                        <a id="showFileCv" target="_blank" href="" style="color: blue;">Tải xuống <i class="fas fa-download"></i></a>
                                                                    </div>
                                                                    <input type="hidden" id="fileCv" name="fileCv" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                                <button type="submit" id="updateInfoApplicant" class="btn btn-update-customer btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- users edit Info form ends -->
                                                </div>

                                                <div class="tab-pane" id="tab2" aria-labelledby="tab2" role="tabpanel">
                                                    <form class="form-validate" id="fm-tab2">
                                                        <div class="row">
                                                            <div class="form-group col-md-4">
                                                                <label for="ttuv1">Họ và tên</label>
                                                                <input type="text" name="ttuv1" id="ttuv1" class="form-control" placeholder="Họ và tên" />
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="ttuv2">Ngày sinh</label>
                                                                <input type="text" id="ttuv2" name="ttuv2" class="form-control flatpickr-basic" placeholder="DD/MM/YYYY" />
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="ttuv3">Nghề nghiệp</label>
                                                                <input type="text" id="ttuv3" name="ttuv3" class="form-control" placeholder="Nghề nghiệp" />
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="ttuv4">Điện thoại</label>
                                                                <input type="text" id="ttuv4" name="ttuv4" class="form-control" placeholder="Điện thoại" />
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="ttuv5">Địa chỉ</label>
                                                                <input type="text" id="ttuv5" name="ttuv5" class="form-control" placeholder="Địa chỉ" />
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="ttuv6">Mối quan hệ</label>
                                                                <input type="text" id="ttuv6" name="ttuv6" class="form-control" placeholder="Mối quan hệ" />
                                                            </div>

                                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                                <button type="button" onclick="savemember()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                                <button type="button" onclick="clearfmtab2()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Làm mới</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="table-responsive border rounded mt-1">
                                                        <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                            <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                            <span class="align-middle">Chi tiết</span>
                                                        </h6>
                                                        <table class="table table-striped table-borderless" id="member-list-table">
                                                            <thead class="thead-light ">
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Mối quan hệ</th>
                                                                    <th>Họ tên</th>
                                                                    <th>Nghề nghiệp</th>
                                                                    <th>Điện thoại</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="tab3" aria-labelledby="tab3" role="tabpanel">
                                                    <form class="form-validate" id="fm-tab3">
                                                        <div class="row">
                                                            <div class="form-group col-md-4">
                                                                <label for="hvuv1">Từ ngày</label>
                                                                <input type="text" id="hvuv1" name="hvuv1" class="form-control flatpickr-basic" placeholder="DD-MM-YYY" />
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="hvuv2">Đến ngày</label>
                                                                <input type="text" id="hvuv2" name="hvuv2" class="form-control" placeholder="DD-MM-YYYY" />
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="hvuv3">Nơi đào tạo</label>
                                                                <input type="text" id="hvuv3" name="hvuv3" class="form-control" placeholder="Nơi đào tạo" />
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="hvuv4">Chuyên ngành</label>
                                                                <input type="text" id="hvuv4" name="hvuv4" class="form-control" placeholder="Chuyên ngành" />
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="hvuv5">Hình thức</label>
                                                                <input type="text" id="hvuv5" name="hvuv5" class="form-control" placeholder="Hình thức đào tạo" />
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="hvuv6">Bằng cấp</label>
                                                                <input type="text" id="hvuv6" name="hvuv6" class="form-control" placeholder="Bằng cấp" />
                                                            </div>

                                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                                <button type="submit" id="btn_edu" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                                <button type="button" onclick="clearfmtab3()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Làm mới</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="table-responsive border rounded mt-1">
                                                        <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                            <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                            <span class="align-middle">Chi tiết</span>
                                                        </h6>
                                                        <table class="table table-striped table-borderless" id="hocvan-list-table">
                                                            <thead class="thead-light ">
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Từ ngày</th>
                                                                    <th>Đến ngày</th>
                                                                    <th>Nơi đào tạo</th>
                                                                    <th>Chuyên ngành</th>
                                                                    <th>Bằng cấp</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="tab4" aria-labelledby="tab4" role="tabpanel">
                                                    <form class="form-validate" id="fm-tab4">
                                                        <div class="row">
                                                            <div class="form-group col-md-2">
                                                                <label for="knuv1">Từ ngày</label>
                                                                <input type="text" id="knuv1" name="knuv1" class="form-control flatpickr-basic" placeholder="DD-MM-YYYY" />
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label for="knuv2">Đến ngày</label>
                                                                <input type="text" id="knuv2" name="knuv2" class="form-control" placeholder="DD-MM-YYYY" />
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="knuv3">Công ty</label>
                                                                <input type="text" id="knuv3" name="knuv3" class="form-control" placeholder="Công ty" />
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="knuv4">Vị trí</label>
                                                                <input type="text" id="knuv4" name="knuv4" class="form-control" placeholder="Vị trí" />
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="knuv5">Người tham chiếu</label>
                                                                <input type="text" id="knuv5" name="knuv5" class="form-control" placeholder="Người tham chiếu" />
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="knuv6">Điện thoại</label>
                                                                <input type="text" id="knuv6" name="knuv6" class="form-control" />
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="knuv7">Ghi chú</label>
                                                                <input type="text" id="knuv7" name="knuv7" class="form-control" placeholder="Ghi chú" />
                                                            </div>
                                                            <div class="form-group col-md-8">
                                                                <label for="knuv8">Dự án</label>
                                                                <textarea id="knuv8" name="knuv8" rows="5" class="form-control" placeholder="Mô tả các dự án"></textarea>
                                                            </div>

                                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                                <button type="submit" id="btn_exp" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                                <button type="button" onclick="clearfmtab4()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Làm mới</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="table-responsive border rounded mt-1">
                                                        <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                            <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                            <span class="align-middle">Chi tiết</span>
                                                        </h6>
                                                        <table class="table table-striped table-borderless" id="kinhnghiem-list-table">
                                                            <thead class="thead-light ">
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Từ ngày</th>
                                                                    <th>Đến ngày</th>
                                                                    <th>Công ty</th>
                                                                    <th>Vị trí</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>

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

                </div>
            </section>
        </div>
    </div>
</div>
<script>
    var funAdd = <?= $this->funAdd ?>,
        funEdit = <?= $this->funEdit ?>,
        funDel = <?= $this->funDel ?>;
</script>
<script src="<?= HOME ?>/js/applicant.js"></script>