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
                                    <th>Mã sản phẩm</th>
                                    <th>Tên tài sản</th>
                                    <th>Nhóm</th>
                                    <th>Trạng thái</th>
                                    <th></th>
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
                                                        <label for="step" class="form-control-label">Mã tài sản</label>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-9">
                                                                    <input type="text" id="code" name="code"  class="form-control">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <button type="button" class="btn btn-primary" id="createCode" onclick="createCodeAsset()">+</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="name">Tên tài sản</label>
                                                            <input id="name" name="name" type="text" class="form-control" onblur="check_name();" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label for="don_vi">Đơn vị</label>
                                                            <select name="don_vi" id="don_vi" class="select2 form-control"></select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label for="nhom_ts">Nhóm</label>
                                                            <select name="nhom_ts" id="nhom_ts" class="select2 form-control "></select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="so_tien">Số tiền 1 đơn vị</label>
                                                            <input id="so_tien" type="text" class="form-control format_number" name="so_tien" />
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="khau_hao">Tiêu hao</label>
                                                            <input id="khau_hao" type="text" class="form-control" min="0" name="khau_hao" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="ngay_gio">Ngày nhập</label>
                                                            <input id="ngay_gio" name="ngay_gio" type="text" class="form-control flatpickr-basic" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="bao_hanh">Bảo hành (tháng)</label>
                                                            <input id="bao_hanh" type="text" class="form-control" min="0" name="bao_hanh" />
                                                        </div>
                                                    </div>

                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">


                                                        <button type="submit" class="btn btn-add btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Thêm mới</button>

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
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center " id="hisIssue-tab" data-toggle="tab" href="#hisIssue" aria-controls="hisIssue" role="tab" aria-selected="false">
                                                        <i data-feather="info"></i><span class="d-none d-sm-block">Lịch sử cấp phát</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center " id="hisIssue-tab" data-toggle="tab" href="#hisRecall" aria-controls="hisRecall" role="tab" aria-selected="false">
                                                        <i data-feather="info"></i><span class="d-none d-sm-block">Lịch sử thu hồi</span>
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
                                                                    <label for="code_add">Mã tài sản</label>
                                                                    <input id="code_add" type="text" class="form-control"  name="code_add" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2">
                                                                <div class="form-group">
                                                                    <label for="so_luong_add">Số lượng</label>
                                                                    <input id="so_luong_add" type="number" class="form-control" disabled name="so_luong_add" />
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
                                                                    <label for="khau_hao_add">Tiêu hao</label>
                                                                    <input id="khau_hao_add" type="text" class="form-control" name="khau_hao_add" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2">
                                                                <div class="form-group">
                                                                    <label for="bao_hanh_add">Bảo hành (tháng)</label>
                                                                    <input id="bao_hanh_add" type="text" class="form-control" name="bao_hanh_add" />
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
                                                                    <input id="nha_cungcap" type="text" class="form-control" name="nha_cungcap" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="diachi">Địa chỉ mua hàng</label>
                                                                    <input id="dia_chi" type="text" class="form-control" name="dia_chi" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="sdt">SĐT nhà cung cấp</label>
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
                                                             
                                                                    <button type="submit" id="btn_update_asset" class="btn  btn-add btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                              
                                                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                            </div>

                                                        </div>

                                                    </form>

                                                    <!-- users edit Info form ends -->

                                                </div>

                                                <!-- Account Tab starts -->

                                                <div class="tab-pane card" id="hisIssue" width="100%" aria-labelledby="hisIssue-tab" role="tabpanel">
                                                    <div class="table-responsive border rounded mt-1">
                                                        <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                            <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                            <span class="align-middle">Chi tiết</span>
                                                        </h6>

                                                        <table class="table asset-issue-list-table" id="asset-issue-list-table">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Thời gian</th>
                                                                    <th>Mã sản phẩm</th>
                                                                    <th>Mã cấp phát</th>
                                                                    <th>Tài sản</th>
                                                                    <th>Nhân viên</th>
                                                                    <th>Tiền cọc</th>
                                                                    <th>Tình trạng</th>
                                                                </tr>
                                                            </thead>
                                                        </table>

                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="hisRecall" aria-labelledby="hisRecall-tab" role="tabpanel">
                                                    <div class="table-responsive border rounded mt-1">
                                                        <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                            <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                            <span class="align-middle">Chi tiết</span>
                                                        </h6>

                                                        <table class="table" id="asset-recall-list-table">
                                                            <thead class="thead-light ">
                                                                <tr>
                                                                    <th>Thời gian</th>
                                                                    <th>Mã sản phẩm</th>
                                                                    <th>Mã cấp phát</th> 
                                                                    <th>Tài sản</th>
                                                                    <th>Tiền cọc</th>
                                                                    <th>Ghi chú</th>
                                                                </tr>
                                                            </thead>
                                                        </table>


                                                    </div>

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
                                    <h4 class="modal-title" id="myModalLabel16">Cập nhật trạng thái tài sản</h4>
                                </div>
                                <div class="modal-body" style="margin:0;">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">

                                        <form class="form-validate" enctype="multipart/form-data" id="formbaohong">
                                            <div class="row mt-1">
                                                <input type="hidden" name="sl_mat_hientai" id="sl_mat_hientai">
                                                <input type="hidden" name="id_baohong" id="id_baohong">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="name">Tình trạng</label>
                                                        <select name="status" id="status" class="form-control select2">
                                                            <option data-color="#FF9F43" value="3">Báo hỏng</option>
                                                            <option data-color="#EA5455" value="4">Báo mất</option>
                                                            <option data-color="#00CFE8" value="1">Khả dụng</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                    <button type="button" onclick="alertBroken()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---END modal BÁO MẤT HỎNG-->
                    <!---modal cấp phát tài sản-->
                    <div class="modal modal-slide-in new-user-modal fade" id="modalIssue" tabindex="-1">

                        <div class="modal-dialog">

                            <form class="add-new-user modal-content pt-0" id="IssueForm">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                <input type="hidden" name="idAsset" id="idAsset" />
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Cấp phát</h5>
                                </div>

                                <div class="modal-body flex-grow-1">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="nhan_vien">Nhân viên</label>
                                                <select name="nhan_vien" id="nhan_vien" class="select2 form-control"></select>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="asset_issue">Tài sản</label>
                                                <select name="asset_issue" id="asset_issue" class="select2 form-control"></select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="dat_coc">Đặt cọc</label>
                                                <input id="dat_coc" type="text" class="form-control format_number" name="dat_coc" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="dateIssue">Ngày cấp</label>
                                                <input id="dateIssue" type="text" class="form-control flatpickr-basic" name="dateIssue" />
                                            </div>
                                            <div class="form-group">
                                                <label for="descIssue">Ghi chú</label>
                                                <textarea id="descIssue" class="form-control" name="descIssue"></textarea>
                                            </div>
                                            <button type="submit" id="btn_add_issue" class="btn btn-primary mr-1 data-submit">Cấp phát</button>
                                            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!---END modal cap phat-->


                    <!--end modal-->
                    <div class="modal modal-slide-in new-user-modal fade" id="modalRecall">

                        <div class="modal-dialog">

                            <form class="add-new-user modal-content pt-0" id="dg_th">
                                <input type="hidden" name="id_cp" id="id_cp">
                                <input type="hidden" name="id_ts" id="id_ts">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>

                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Thu hồi sản phẩm</h5>
                                </div>

                                <div class="modal-body flex-grow-1">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="fullname">Nhân viên</label>
                                                <select name="nhan_vien_th" id="nhan_vien_th" class="select2-data-array  form-control"></select>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="dien_thoai">Tài sản</label>
                                                <select name="tai_san_th" id="tai_san_th" name="tai_san_th" class="select2-data-array  form-control"></select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="tra_coc_th">Trả cọc</label>
                                                <input id="tra_coc_th" type="text" class="form-control format_number" name="tra_coc_th" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="ngay_gio_th">Ngày trả</label>
                                                <input id="ngay_gio_th" type="text" class="form-control flatpickr-basic" name="ngay_gio_th" />
                                            </div>
                                            <div class="form-group">
                                                <label for="ghi_chu_th">Ghi chú</label>
                                                <textarea id="ghi_chu_th" class="form-control" name="ghi_chu_th"></textarea>
                                            </div>
                                            <button type="button" id="btn_add_th" onclick="saveth()" class="btn btn-primary mr-1 data-submit" >Thu hồi</button>
                                            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                    <!--end modal-->


                </div>
            </section>
        </div>
    </div>
</div>
<script>
    var funAdd = <?=$this->funAdd?>,
        funIssue = <?=$this->funIssue?>,
        funRecall = <?=$this->funRecall?>,
        funEdit = <?=$this->funEdit?>,
        funDel = <?=$this->funDel?>;
     console.log(funAdd,funIssue,funRecall,funEdit,funDel);
</script>
<script src="<?= HOME ?>/js/asset.js"></script>