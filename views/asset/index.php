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
                        <div class="col-md-4 tai_san_fillter"></div>
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
                                    <th>Tên tài sản</th>
                                    <th>Nhóm</th>
                                    <th>SL nhập</th>
                                    <th>SL bảo hành</th>
                                    <th>SL hỏng</th>
                                    <th>SL mất</th>
                                    <th class="text-center">...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="modal modal-slide-in new-user-modal fade" id="addinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16"></h4>
                                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button> -->
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" enctype="multipart/form-data" id="dg">
                                                <div class="row mt-1">
                                                    
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="name">Tên tài sản</label>
                                                            <input id="name" name="name" type="text" class="form-control" onblur="check_name();" />
                                                        </div>
                                                    </div>

                                                   
                                                    <div class="col-lg-6 col-md-3">
                                                        <div class="form-group">
                                                            <label for="so_luong">Số lượng</label>
                                                            <input id="so_luong" type="number" min="1" class="form-control" name="so_luong" onblur="check_name();" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-3">
                                                        <div class="form-group">
                                                            <label for="don_vi">Đơn vị</label>
                                                            <select name="don_vi" id="don_vi" class="select2 form-control"></select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label for="nhom_ts">Nhóm</label>
                                                            <select name="nhom_ts" id="nhom_ts" class="select2 form-control " ></select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="so_tien">Số tiền 1 đơn vị</label>
                                                            <input id="so_tien" type="text" class="form-control format_number"  name="so_tien" />
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="khau_hao">Khấu hao (tháng)</label>
                                                            <input id="khau_hao" type="number" class="form-control" min = "0"  name="khau_hao" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="ngay_gio">Ngày nhập</label>
                                                            <input id="ngay_gio"  name="ngay_gio" type="text" class="form-control flatpickr-basic"  />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="bao_hanh">Bảo hành (tháng)</label>
                                                            <input id="bao_hanh" type="number" class="form-control"  min= "0" name="bao_hanh" />
                                                        </div>
                                                    </div>

                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="submit"  class="btn btn-add btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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

                    <!--DIV updateinfo MOdal-->
                    <div class="modal fade text-left" id="updateinfo" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">

<div class="modal-dialog modal-dialog-centered modal-xl" role="document">

    <div class="modal-content">

        <div class="modal-header">

            <h4 class="modal-title" id="myModalLabel16">Cập nhật thông tin tài sản</h4>

        </div>

        <div class="modal-body">

            

            <div class="card">

                <div class="card-body">

                    <ul class="nav nav-pills" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center active" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                <i data-feather="info"></i><span class="d-none d-sm-block">Thông tin tài sản</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane active" id="information" aria-labelledby="information-tab" role="tabpanel">

                            <!-- users edit Info form start -->

                            <form class="form-validate" enctype="multipart/form-data" id="thongtin_taisan">
                                <input type="hidden" id="id_taisan" name="id_taisan" />
                               
                                <input type="hidden" id="sl_old" name="sl_old" />
                                <div class="media mb-2 col-12">

                                    <div class="col-lg-4 d-flex mt-1 px-0">

                                        <img id="avatar" src="" alt="Ảnh tài sản" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90" width="90" />

                                        <div class="media-body col-lg-12 mt-50">

                                            <h4 id="tai_san">No name</h4>

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

                        
                                </div>



                                <div class="row mt-1">

                                    <div class="col-12">

                                        <h4 class="mb-1">

                                            <i data-feather="user" class="font-medium-4 mr-25"></i>

                                            <span class="align-middle">Thông tin</span>

                                        </h4>

                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label for="hoten">Tên tài sản</label>
                                            <input id="name_add" type="text" class="form-control" name="name_add" />
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="form-group">
                                            <label for="hoten">Số lượng</label>
                                            <input id="so_luong_add" type="number" onblur="check_soluong();" class="form-control" min="1" name="so_luong_add" />
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3">
                                        <div class="form-group">
                                            <label for="don_vi_add">Đơn vị</label>
                                            <select name="don_vi_add" id="don_vi_add" class="select2 form-control"></select>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-12">
                                        <div class="form-group">
                                            <label for="nhom_ts_add">Nhóm</label>
                                            <select name="nhom_ts_add" id="nhom_ts_add" class="select2 form-control"></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="form-group">
                                            <label for="so_tien_add">Số tiền 1 đơn vị</label>
                                            <input id="so_tien_add" type="text" class="form-control format_number" name="so_tien_add" />
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="form-group">
                                            <label for="khau_hao_add">Khấu hao (tháng)</label>
                                            <input id="khau_hao_add" type="text" class="form-control" min="0" name="khau_hao_add" />
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="form-group">
                                            <label for="hoten">Bảo hành (tháng)</label>
                                            <input id="bao_hanh_add" type="text" class="form-control" min="0" name="bao_hanh_add" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">

                                    <h4 class="mb-1 mt-2">

                                        <i data-feather="menu" class="font-medium-4 mr-25"></i>

                                        <span class="align-middle">Thông tin thêm</span>

                                    </h4>

                                    </div>
                                    
                                    <div class="col-lg-3 col-md-6">
                                        <div class="form-group">
                                            <label for="diachi">Nhà cung cấp</label>
                                            <input id="nha_cungcap" type="text" class="form-control"  name="nha_cungcap" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="form-group">
                                            <label for="diachi">Địa chỉ mua hàng</label>
                                            <input id="dia_chi" type="text" class="form-control"  name="dia_chi" />
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6">
                                        <div class="form-group">
                                            <label for="cmnd">SĐT nhà cung cấp</label>
                                            <input id="sdt" type="text" class="form-control" name="sdt" />
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6">
                                        <div class="form-group">
                                            <label for="ngaycap">Ngày nhập hàng</label>
                                            <input id="ngay_gio_add" name="ngay_gio_add" type="text" class="form-control flatpickr-basic " />
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="ngaycap">Ghi chú</label>
                                            <textarea id="ghi_chu" name="ghi_chu" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    

                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">

                                        <button type="submit"  class="btn  btn-add btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>

                                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>

                                    </div>

                                </div>

                            </form>

                            <!-- users edit Info form ends -->

                        </div>

                        <!-- Account Tab starts -->

                        <div class="tab-pane" id="account" aria-labelledby="account-tab" role="tabpanel">

                            
                                <h3>Tạo tài khoản mới</h3>

                           

                        </div>

                        <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">

                            <!-- users edit social form start -->
                            <h3>Tạo tài khoản mới 2</h3>

                        </div>

                        <!-- Social Tab ends -->

                    </div>

                </div>

            </div>

        </div>



    </div>

</div>

</div>
                    <!--END DIV updateinfo MOdal-->


                    <!---modal BÁO MẤT HỎNG-->
                    <div class="modal modal-slide-in new-user-modal fade" id="baohongmat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16">Báo hỏng, mất tài sản</h4>
                                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button> -->
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" enctype="multipart/form-data" id="formbaohong">
                                                <div class="row mt-1">
                                                    <input type="hidden" name="sl_mat_hientai" id="sl_mat_hientai">
                                                    <input type="hidden" name="id_baohong" id="id_baohong">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="name">Tình trạng</label>
                                                            <select name="status" id="status" class="form-control">
                                                                <option value="0">Báo hỏng</option>
                                                                <option value="1">Báo mất</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-3">
                                                        <div class="form-group">
                                                            <label for="so_luong_hong">Số lượng</label>
                                                            <input id="so_luong_hong" type="number" min="1" class="form-control" name="so_luong_hong"  />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="button" onclick="baohong()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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
                    <!---END modal BÁO MẤT HỎNG-->


                </div>
            </section>
        </div>
    </div>
</div>
<script src="<?= HOME ?>/js/asset.js"></script>