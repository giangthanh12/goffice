<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        <!-- <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0" style="border-right: none;">Khách hàng sử dụng dịch vụ</h2>
                        </div>
                    </div>
                </div>
        </div> -->
        </div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <!-- users filter start -->
                <div class="card">
                    <div class="d-flex justify-content-between align-items-center mx-50 row pt-2 pb-2">
                        <div class="col-md-3 classify3">
                            <select id="classify3" data-column="5" class="select2 form-control" name="classify3">
                                <option value="0" selected>Tất cả</option>
                                <option value="1">Khách hàng tiềm năng</option>
                                <option value="2">Khách hàng đang dùng dịch vụ</option>
                                <option value="3">Khách hàng đã ngừng dịch vụ</option>
                            </select>
                        </div>
                        <div class="col-md-3 type2">
                            <select id="type2" data-column="6" class="select2 form-control" name="type2">
                                <option value="0" selected>Tất cả</option>
                                <option value="1">Cá nhân</option>
                                <option value="2">Tổ chức</option>
                                <!-- <option value="3">Dịch vụ</option> -->
                            </select>
                        </div>
                        <div class="col-md-3 provinceId2">
                            <select id="provinceId2" data-column="7" class="form-control" name="provinceId2">
                            </select>
                        </div>
                        <img src="<?= HOME ?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng quản lý toàn bộ thông tin đến khách hàng đã và đang mua sản phẩm/ sử dụng dịch vụ của doanh nghiệp " data-trigger="click">
                    </div>
                </div>
                <!-- users filter end -->
                <!-- list section start -->
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <!-- <th></th> -->
                                    <th>Tên khách hàng</th>
                                    <th>Điện thoại</th>
                                    <th>Website</th>
                                    <th>Email</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="addinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16"></h4>

                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" enctype="multipart/form-data" id="dg">
                                                <div class="row mt-1">
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="fullName">Tên khách hàng</label>
                                                            <input id="fullName" type="text" class="form-control" name="fullName" placeholder="Tên khách hàng" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="shortName_add">Tên ngắn</label>
                                                            <input id="shortName_add" type="text" class="form-control" name="shortName_add" placeholder="Tên ngắn" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="phoneNumber">Số điện thoại</label>
                                                            <input id="phoneNumber" type="text" data-id="phoneNumber" class="form-control phoneNumber" name="phoneNumber" placeholder="Số điện thoại" />
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input id="email" type="text" class="form-control" name="email" placeholder="Địa chỉ email" />
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="website">Website</label>
                                                            <input id="website" type="text" class="form-control" name="website" placeholder="Địa chỉ website" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="provinceId">Tỉnh thành phố</label>
                                                            <select id="provinceId" class="select2 form-control" name="provinceId">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="type">Loại</label>
                                                            <select id="type" class="select2 form-control" name="type">
                                                                <option value="1">Cá nhân</option>
                                                                <option value="2">Tổ chức</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="classify_add">Phân loại khách hàng</label>
                                                            <select id="classify_add" class="select2 form-control" name="classify_add">
                                                                <option value="1">Khách hàng</option>
                                                                <option value="2">Nhà cung cấp</option>
                                                                <option value="3">Cả hai</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="staffId">Nhân viên chăm sóc</label>
                                                            <select id="staffId" class="select2 form-control" name="staffId">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="status">Trạng thái</label>
                                                            <select id="status" class="select2 form-control" name="status">
                                                            <option value="1" selected>Khách hàng tiềm năng</option>
                                                            <option value="2">Khách hàng đang dùng dịch vụ</option>
                                                            <!-- <option value="3">Tạm dừng dùng dịch vụ</option> -->
                                                            <option value="3">Khách hàng đã ngừng dùng dịch vụ</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="submit" class="btn btn-primary btn-add-customer mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade text-left" id="updateinfo" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16">Cập nhật thông tin khách hàng</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="id" name="id" />
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="nav nav-pills" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center active" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                                        <i data-feather="info"></i><span class="d-none d-sm-block">Thông tin khách hàng</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item" id="tab2">
                                                    <a class="nav-link d-flex align-items-center" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                                        <i data-feather='clipboard'></i><span class="d-none d-sm-block">Thông tin liên lạc</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item" id="tab2">
                                                    <a class="nav-link d-flex align-items-center" id="account-tab" data-toggle="tab" href="#transaction" aria-controls="transaction" role="tab" aria-selected="true">
                                                        <i class="fa fa-money-bill-wave"></i><span class="d-none d-sm-block">Lịch sử giao dịch</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="information" aria-labelledby="information-tab" role="tabpanel">
                                                    <form class="form-validate" enctype="multipart/form-data" id="dg1">
                                                        <div class="row mt-1">
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="fullName1">Tên khách hàng</label>
                                                                    <input id="fullName1" type="text" class="form-control" name="fullName1" placeholder="Tên khách hàng" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="shortName">Tên ngắn</label>
                                                                    <input id="shortName" type="text" class="form-control" name="shortName" placeholder="Tên ngắn" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="type1">Loại hình hoạt động</label>
                                                                    <select id="type1" class="select2 form-control" name="type1" onchange="changeType()">
                                                                        <option value="1">Cá nhân</option>
                                                                        <option value="2">Tổ chức</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="taxCode1">Mã số thuế</label>
                                                                    <input id="taxCode1" name="taxCode1" type="text" class="form-control" placeholder="Mã số thuế" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="provinceId1">Tỉnh thành phố</label>
                                                                    <select id="provinceId1" class="select2 form-control" name="provinceId1">
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6" id="div-address">
                                                                <div class="form-group">
                                                                    <label for="address1">Địa chỉ cư trú</label>
                                                                    <input id="address1" type="text" class="form-control" name="address1" placeholder="Địa chỉ cư trú" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6" id="div-businessPlace">
                                                                <div class="form-group">
                                                                    <label for="businessPlace1">Địa chỉ văn phòng</label>
                                                                    <input id="businessPlace1" type="text" class="form-control" name="businessPlace1" placeholder="Địa chỉ văn phòng" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phoneNumber1">Số điện thoại</label>
                                                                    <input id="phoneNumber1" data-id="phoneNumber1" type="text" class="form-control phoneNumber" name="phoneNumber1" placeholder="Số điện thoại" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email1">Email</label>
                                                                    <input id="email1" type="text" class="form-control" name="email1" placeholder="Địa chỉ email" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6" id="div-businessAddress">
                                                                <div class="form-group">
                                                                    <label for="businessAddress1">Địa chỉ ĐKKD</label>
                                                                    <input id="businessAddress1" type="text" class="form-control" name="businessAddress1" placeholder="Địa chỉ đăng ký kinh doanh" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="website1">Website</label>
                                                                    <input id="website1" type="text" class="form-control" name="website1" placeholder="Địa chỉ website" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="field1">Lĩnh vực kinh doanh</label>
                                                                    <select class="form-control" name="field1" id="field1">
                                                                        <option value="1">Công nghệ thông tin</option>
                                                                        <option value="2">Chứng khoán đầu tư</option>
                                                                        <option value="3">Tài chính ngân hàng</option>
                                                                        <option value="4">Du lịch - khách hàng</option>
                                                                        <option value="5">Xây dựng - bất động sản</option>
                                                                        <option value="6">Sản xuất chế tạo</option>
                                                                        <option value="7">Dịch vụ ăn uống</option>
                                                                        <option value="8">Vận tải hành khách</option>
                                                                        <option value="9">Logistic</option>
                                                                        <option value="10">Khác</option>
                                                                    </select>
                                                                    <!-- <input id="field1" name="field1" type="text" class="form-control" placeholder="Lĩnh vực kinh doanh" /> -->
                                                                </div>
                                                            </div>

                                                            <!-- <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="type1">Loại hình hoạt động</label>
                                                                    <select id="type1" class="select2 form-control" name="type1">
                                                                        <option value="1">Sản xuất</option>
                                                                        <option value="2">Thương mại</option>
                                                                        <option value="3">Dịch vụ</option>
                                                                    </select>
                                                                </div>
                                                            </div> -->

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="classify1">Phân loại khách hàng</label>
                                                                    <select id="classify1" class=" form-control" name="classify1">
                                                                        <option value="1">Khách hàng</option>
                                                                        <option value="2">Nhà cung cấp</option>
                                                                        <option value="3">Cả hai</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="rank1">Hạng khách hàng</label>
                                                                    <select id="rank1" class="form-control" name="rank1">
                                                                        <option value="1">Bình thường</option>
                                                                        <option value="2">VIP</option>
                                                                    </select>
                                                                </div>
                                                            </div> -->
                                                            <!-- <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="bussinessName1">Tên doanh nghiệp của khách hàng</label>
                                                                    <input id="bussinessName1" name="bussinessName1" type="text" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="businessAddress1">Địa chỉ doanh nghiệp khách hàng</label>
                                                                    <input id="businessAddress1" type="text" class="form-control" name="businessAddress1" />
                                                                </div>
                                                            </div> -->

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="representative1">Người đại diện</label>
                                                                    <input id="representative1" type="text" class="form-control" name="representative1" placeholder="Người đại diện" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6" id="div-position">
                                                                <div class="form-group">
                                                                    <label for="position1">Vị trí người đại diện</label>
                                                                    <input id="position1" name="position1" type="text" class="form-control" placeholder="Vị trí người đại diện" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6" id="div-authorized">
                                                                <div class="form-group">
                                                                    <label for="authorized1">Người cấp phép</label>
                                                                    <input id="authorized1" type="text" class="form-control" name="authorized1" placeholder="Người cấp phép" />
                                                                </div>
                                                            </div>


                                                            <!-- <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nationalId1">Quốc gia</label>
                                                                    <select id="nationalId1" class="select2 form-control" name="nationalId1">
                                                                    </select>
                                                                </div>
                                                            </div> -->

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="staffId1">Nhân viên chăm sóc</label>
                                                                    <select id="staffId1" class="select2 form-control" name="staffId1">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="note1">Ghi chú</label>
                                                                    <input id="note1" type="text" class="form-control" name="note1" placeholder="Ghi chú" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="status1">Trạng thái</label>
                                                                    <select id="status1" class="select2 form-control" name="status1">
                                                                        <option value="1" selected>Khách hàng tiềm năng</option>
                                                                        <option value="2">Khách hàng đang dùng dịch vụ</option>
                                                                        <!-- <option value="3">Tạm dừng dùng dịch vụ</option> -->
                                                                        <option value="3">Khách hàng đã ngừng dùng dịch vụ</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                                <button type="submit" class="btn btn-update-customer btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                                <!-- thông tin liên lạc -->
                                                <div class="tab-pane" id="account" aria-labelledby="account-tab" role="tabpanel">
                                                    <div class="table-responsive border rounded mt-1">
                                                        <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                            <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                            <span class="align-middle">Chi tiết</span>
                                                            <button class="dt-button add-new-contact btn btn-primary mt-50" onclick="showFormContact()" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                                                <span>Thêm mới</span>
                                                            </button>
                                                        </h6>
                                                        <table class="table table-striped table-borderless" id="dichvu-list-table">
                                                            <thead class="thead-light ">
                                                                <tr>
                                                                    <th>Họ tên</th>
                                                                    <th>Chức danh</th>
                                                                    <th>Điện thoại</th>
                                                                    <th>Email</th>
                                                                    <th>Facebook</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- lịch sử giao dịch -->
                                                <div class="tab-pane" id="transaction" aria-labelledby="account-tab" role="tabpanel">
                                                    <div class="table-responsive border rounded mt-1">
                                                        <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                            <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                            <span class="align-middle">Chi tiết</span>
                                                            <button class="dt-button add-new-contact btn btn-primary mt-50" onclick="showFormTransaction()" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                                                <span>Thêm mới</span>
                                                            </button>
                                                        </h6>
                                                        <table class="table table-striped table-borderless" id="transaction-list-table">
                                                            <thead class="thead-light ">
                                                                <tr>
                                                                    <th>Thời gian giao dịch</th>
                                                                    <th>Tên hợp đồng</th>
                                                                    <th>Sản phẩm</th>
                                                                    <th>Loại giao dịch</th>
                                                                    <th>Số tiền</th>
                                                                    <th>Ghi chú</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
      <!-- showFormTransaction -->
      <div class="modal fade text-left" id="modalTransaction" style="z-index:1000000;"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title-transaction" id="myModalLabel16"></h4>
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" enctype="multipart/form-data" id="dgTransaction">
                                                
                                                <div class="row mt-1">
                                                    <div class="col-md-6 form-group">
                                                        <label for="nameTransaction">Tên hợp đồng</label>
                                                        <input id="nameTransaction" name="nameTransaction" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="productId">Sản phẩm</label>
                                                        <select id="productId" name="productId" class="form-control">

                                                        </select>
                                                        <!-- <input id="productId" name="productId" type="text" class="form-control" /> -->
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="asset">Số tiền giao dịch</label>
                                                        <input id="asset" name="asset" type="text" class="form-control format_number" />
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label for="dateTime">Thời gian giao dịch</label>
                                                        <input id="dateTime" name="dateTime" type="email" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="performedId">Nhân viên thực hiện</label>
                                                        <select id="performedId" name="performedId" class="form-control">

                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="typeTransaction">Loại giao dịch</label>
                                                        <select id="typeTransaction" name="typeTransaction" class="form-control">
                                                            <option value="1">Đơn hàng</option>
                                                            <option value="2">Hợp đồng</option>
                                                            <option value="3">Thanh toán</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label for="description">Mô tả</label>
                                                        <textarea name="description" class="form-control" id="description" cols="30" rows="5"></textarea>
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   

                    <!-- end showFormTransaction -->


                    <div class="modal fade text-left" id="updateinfoContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title-contact" id="myModalLabel16"></h4>
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" enctype="multipart/form-data" id="dgContact">
                                                <input type="hidden" name="idCustomerContact" id="idCustomerContact" value=''>
                                                <div class="row mt-1">
                                                    <div class="col-md-6 form-group">
                                                        <label for="nameContact">Tên liên lạc</label>
                                                        <input id="nameContact" name="nameContact" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="positionContact">Chức danh</label>
                                                        <select id="positionContact" name="positionContact" class="form-control">

                                                        </select>

                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="phoneNumberContact">Số điện thoại</label>
                                                        <input id="phoneNumberContact" name="phoneNumberContact" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="emailContact">Email</label>
                                                        <input id="emailContact" name="emailContact" type="email" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="facebook">Facebook(nếu có)</label>
                                                        <input id="facebook" name="facebook" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="zalo">Zalo(nếu có)</label>
                                                        <input id="zalo" name="zalo" type="text" class="form-control" />
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label for="noteContact">Chú thích</label>
                                                        <textarea name="noteContact" class="form-control" id="noteContact" cols="30" rows="5"></textarea>
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


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
                                            <a target="_blank" href="<?= URLFILE ?>/uploads/customer.xlsx" style="color: blue;">Tải xuống <i class="fas fa-download"></i></a>

                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="file">File upload</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file" name="file">
                                                <label class="custom-file-label" for="file">Chọn file</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="staffId2">Nhân viên chăm sóc</label>
                                            <select id="staffId2" class="select2 form-control" name="staffId2"></select>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-dismiss="modal" onclick="savenhap()">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--moda dbao gia -->

                    <div class="modal fade text-left" id="modal_baogia" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16"></h4>
                                </div>

                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="information" aria-labelledby="information-tab" role="tabpanel">
                                                    <!-- users edit Info form start -->
                                                    <form class="form-validate" enctype="multipart/form-data" id="dg_bg">
                                                        <input type="hidden" id="id_bg" name="id_bg" />

                                                        <div class="row mt-1">
                                                            <div class="col-12">
                                                                <h4 class="mb-1">
                                                                    <i data-feather="user" class="font-medium-4 mr-25"></i>
                                                                    <span class="align-middle">Thông tin</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="hoten">Thời gian</label>
                                                                    <input id="ngay" type="text" class="form-control ngay_gio" name="ngay" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-2">
                                                                <div class="form-group">
                                                                    <label for="hoten">Khách hàng</label>
                                                                    <select name="khach_hang_bg" id="khach_hang_bg" class="select2-data-array form-control" onchange="check_form();"></select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-2">
                                                                <div class="form-group">
                                                                    <label for="hoten">Nhân viên</label>
                                                                    <select name="nhan_vien_bg" id="nhan_vien_bg" class="select2-data-array form-control" onchange="check_form();"></select>
                                                                </div>
                                                            </div>


                                                            <div class="col-lg-3 col-md-2">
                                                                <div class="form-group">
                                                                    <label for="hoten">Tình trạng</label>
                                                                    <select name="tinh_trang_bg" id="tinh_trang_bg" class="form-control">
                                                                        <option value="1">Mới tạo</option>
                                                                        <option value="2">Đang chờ</option>
                                                                        <option value="3">Đã chốt</option>
                                                                        <option value="4">Hợp đồng</option>
                                                                        <option value="5">Hủy</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <h4 class="mb-1">
                                                                    <i data-feather="menu" class="font-medium-4 mr-25"></i>
                                                                    <span class="align-middle">Thông tin sản phẩm, dịch vụ</span>
                                                                </h4>
                                                            </div>

                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="tinh_trang">Chọn dịch vụ</label>
                                                                    <select name="dich_vu" id="dich_vu" class="select2-data-array form-control dich_vu" onchange="load_dichvu();"></select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="tinh_trang">Chọn sản phẩm</label>
                                                                    <select name="san_pham" id="san_pham" class="select2-data-array form-control" onchange="load_sanpham();"></select>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <input type="hidden" name="stt" id="stt" value="0">
                                                                <table class="table dataTable no-footer">
                                                                    <thead>
                                                                        <th> Tên dịch vụ, sản phẩm </th>
                                                                        <th> Giá bán </th>
                                                                        <th> Số lượng </th>
                                                                        <th> Chiết khấu </th>
                                                                        <th> Thuế VAT </th>
                                                                        <th> Tiền thuế </th>
                                                                        <th> Thời hạn </th>
                                                                        <th> Thành tiền </th>
                                                                        <th> </th>
                                                                    </thead>
                                                                    <tbody id="table_sp">

                                                                    </tbody>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td colspan="5"></td>
                                                                            <td colspan="1" class="text-right">Tổng đơn</td>
                                                                            <td colspan="2"><input type="text" class="form-control format_number" id="tong_donhang" readonly name="tong_donhang"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="5"></td>
                                                                            <td colspan="1" class="text-right">Chiết khấu</td>
                                                                            <td colspan="2"><input type="text" class="form-control format_number" value="0" id="chiet_khau" name="chiet_khau" onkeyup="tong_thanh_toan()"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="5"></td>
                                                                            <td colspan="1" class="text-right"><b>Tổng thanh toán</b></td>
                                                                            <td colspan="2"><input type="text" class="form-control format_number" readonly value="0" id="thanh_toan" name="thanh_toan"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>


                                                            <div class="col-12">
                                                                <h4 class="mb-1 mt-2">
                                                                    <i data-feather="menu" class="font-medium-4 mr-25"></i>
                                                                    <span class="align-middle">Thông tin thêm</span>
                                                                </h4>
                                                            </div>

                                                            <div class="col-lg-3 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="diachi">Files</label>
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="file" name="file">
                                                                        <label class="custom-file-label" for="file">Chọn file</label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <div id="viewfile"></div>
                                                                </div>
                                                            </div>


                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="ngaycap">Ghi chú</label>
                                                                    <textarea id="ghi_chu_bg" name="ghi_chu_bg" class="form-control"></textarea>
                                                                </div>
                                                            </div>



                                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                                <button type="button" onclick="savetk()" class="btn btn-add btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- users edit Info form ends -->
                                                </div>
                                                <!-- Social Tab ends -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!--end modal add/edit bao gia-->





                </div>
            </section>
        </div>
    </div>
</div>
<script>
    var funAdd = <?= $this->funAdd ?>,
        funImport = <?= $this->funImport ?>,
        funEdit = <?= $this->funEdit ?>,
        funDel = <?= $this->funDel ?>;
    console.log(funAdd, funImport, funEdit, funDel);
</script>
<script src="<?= HOME ?>/js/used_customer.js"></script>