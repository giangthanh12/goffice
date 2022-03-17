<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">        
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2>Data <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng quản lý thông tin cá nhân và tình trạng của toàn bộ data khách hàng đang quan tâm đến SP/DV mà doanh nghiệp tìm kiếm được  " data-trigger="click" ></h2>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- users list start -->            
            <section class="app-user-list">
                <!-- users filter start -->
                <div class="card">
                    <div class="d-flex align-items-center mx-50 row pt-2 pb-2">
                        <div class="col-md-3 data_nhanvien form-group hidden">
                            <label for="staffId">Phụ trách</label>
                            <select id="staffId" name="staffId" class="form-control">
                            </select>
                        </div>

                        <div class="col-md-3 data_nhanvien form-group">
                            <label for="tungay">Từ ngày</label>
                            <input type="text" id="tungay" name="tungay" class="form-control flatpickr-basic" placeholder="Từ ngày" onchange="changeStart()" />
                        </div>

                        <div class="col-md-3 data_nhanvien form-group">
                            <label for="denngay">Đến ngày</label>
                            <input type="text" id="denngay" name="denngay" class="form-control flatpickr-basic" placeholder="Đến ngày" />
                        </div>
                        <button type="button" class="btn btn-icon btn-outline-primary waves-effect" style="margin-top:10px" title="Tìm kiếm" onclick="search()">Tìm kiếm</button>
                    </div>
                    <!-- users filter end -->
                    <!-- list section start -->
                    <div class="card">
                        <div class="card-header border-bottom p-1">
                            <div class="head-label">
                                <!-- <h6 class="mb-0">DataTable with Buttons</h6> -->
                            </div>
                            <div class="dt-buttons ml-1 text-right">
                                <?php if($this->funCall == 1) { ?>
                               <button class="dt-button add-new btn btn-danger mt-50" onclick="showcall()" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                    <span>Gọi điện</span>
                                </button>
                                <?php } ?>
                                <?php if($this->funAdd == 1) { ?>
                                <button class="dt-button add-new btn btn-primary mt-50" onclick="showadd()" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                    <span>Thêm mới</span>
                                </button>
                                <?php } ?>
                                <?php if($this->funShare == 1) { ?>
                                <button class="dt-button btn btn-primary mt-50" onclick="chiadata()" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                    <span>Chia data</span>
                                </button>
                                <?php } ?>
                                <!-- <button class="dt-button btn btn-primary mt-50" onclick="movetolead()" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                    <span>Chuyển sang lead</span>
                                </button> -->
                                <?php if($this->funImport == 1) { ?>
                                <button class="dt-button btn btn-primary mt-50" onclick="nhapexcel()" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                    <span>Nhập excel</span>
                                </button>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="card-datatable table-responsive pt-0">
                            <table class="user-list-table table">
                                <thead class="thead-light">
                                    <tr>
                                    <th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
                                        <th>Họ tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Phân loại</th>
                                        <th>Ngày chia</th>
                                        <th>Phụ trách</th>
                                        <th>Tình trạng</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="modal modal-slide-in new-user-modal fade" id="addnew">
                            <div class="modal-dialog">
                                <form class="add-new-user modal-content pt-0" id="frm-add">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                    <div class="modal-header mb-1">
                                        <h5 class="modal-title" id="exampleModalLabel">Thêm data mới</h5>
                                    </div>
                                    <div class="modal-body flex-grow-1">
                                        <div class="form-group">
                                            <label for="name">Khách hàng</label>
                                            <input id="name" type="text" class="form-control" name="name" placeholder="Tên khách hàng" />
                                        </div>
                                        <div class="form-group">
                                            <label for="phoneNumber">Điện thoại</label>
                                            <input id="phoneNumber" name="phoneNumber" type="number" class="form-control" placeholder="Số điện thoại" />
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Địa chỉ</label>
                                            <input id="address" type="text" class="form-control" name="address" placeholder="Địa chỉ" />
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input id="email" type="text" class="form-control" name="email" placeholder="Địa chỉ email" />
                                        </div>
                                        <div class="form-group">
                                            <label for="sourceId">Nguồn khách hàng</label>
                                            <select id="sourceId" class="select2 form-control phan-loai" name="sourceId">
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="note">Ghi chú</label>
                                            <textarea id="note" name="note" rows="3" class="form-control" placeholder="Ghi chú"></textarea>
                                        </div>
                                        <button type="button" onclick="saveadd()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="modal modal-slide-in update-item-sidebar fade" id="updateinfo">
                            <div class="modal-dialog sidebar-lg">
                                <div class="modal-content p-0">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                    <div class="modal-header mb-1">
                                        <h5 class="modal-title">Thông tin data</h5>
                                    </div>
                                    <div class="modal-body flex-grow-1">
                                        <ul class="nav nav-tabs tabs-line">
                                            <li class="nav-item">
                                                <a class="nav-link nav-link-update active" data-toggle="tab" href="#tab-update" id="tab-1">
                                                    <i data-feather="edit"></i>
                                                    <span class="align-middle">Cập nhật</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link nav-link-activity" data-toggle="tab" href="#tab-activity">
                                                    <i data-feather='file-text'></i>
                                                    <span class="align-middle">Nhật ký</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content mt-2">
                                            <div class="tab-pane tab-pane-update fade show active" id="tab-update" role="tabpanel">
                                                <form class="update-item-form" id="frm-edit">
                                                    <div class="form-group">
                                                        <label for="ename">Khách hàng</label>
                                                        <input id="ename" type="text" class="form-control" name="name" placeholder="Tên khách hàng" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ephoneNumber">Điện thoại</label>
                                                        <input id="ephoneNumber" name="phoneNumber" type="number" class="form-control" placeholder="Số điện thoại" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eemail">Email</label>
                                                        <input id="eemail" type="text" class="form-control" name="email" placeholder="Địa chỉ email" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eaddress">Địa chỉ</label>
                                                        <input id="eaddress" type="text" class="form-control" name="address" placeholder="Địa chỉ"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="esourceId">Nguồn khách hàng</label>
                                                        <select id="esourceId" class="select2 form-control phan-loai" name="sourceId"></select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="econnectorName">Tên Công ty</label>
                                                        <input id="econnectorName" type="text" class="form-control" name="connectorName" placeholder="Tên công ty" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="etaxCode">Mã số thuế</label>
                                                        <input id="etaxCode" type="number" class="form-control" name="etaxCode" placeholder="Mã số thuế" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="etype">Lĩnh vực hoạt động</label>
                                                        <select class="form-control select2" name="type" id="etype">
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
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="estaffId">Phụ trách</label>
                                                        <select id="estaffId" class="select2 form-control" name="staffId"></select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="enote">Ghi chú</label>
                                                        <textarea id="enote" name="note" rows="3" class="form-control" placeholder="Ghi chú"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="estatus">Tình trạng</label>
                                                        <select id="estatus" class="select2 form-control" name="status"></select>
                                                    </div>
                                                    <div class="d-flex flex-wrap mb-2">
                                                        <button type="button" onclick="saveedit()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                        <button type="reset" class="btn btn-outline-secondary mr-sm-1" data-dismiss="modal">Bỏ qua</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane tab-pane-activity pb-1 fade" id="tab-activity" role="tabpanel">

                                                <form id="frm-report">
                                                    <label>Nội dung</label>
                                                    <div class="form-group">
                                                        <textarea type="text" class="form-control" name="description" id="description"></textarea>
                                                    </div>
                                                    <div class="d-flex flex-wrap mb-2">
                                                        <button type="button" onclick="savenhatky()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Thêm nhật ký</button>
                                                    </div>
                                                </form>
                                                <div id="listnhatky" style="position: relative;height: 450px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modal-title2"></h4>
                                    </div>
                                    <div class="modal-body" id="bodyedit">
                                        <input type="hidden" id="id" name="id" />
                                        <div class="card">
                                            <div class="card-body">
                                                <form class="form-validate" enctype="multipart/form-data" id="dg">
                                                    <div class="row mt-1">
                                                        <div class="col-lg-8" style="border-right: 2px solid gray;">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="hoten">Khách hàng</label>
                                                                        <input id="hoten" type="text" class="form-control" name="hoten" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="dienthoai">Điện thoại</label>
                                                                        <input id="dienthoai" name="dienthoai" type="text" class="form-control" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="data_email">Email</label>
                                                                        <input id="data_email" type="text" class="form-control" name="data_email" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="diachi">Địa chỉ</label>
                                                                        <input id="diachi" type="text" class="form-control" name="diachi" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="phanloai">Loại khách hàng</label>
                                                                        <select id="phanloai" class="select2 form-control" name="phanloai"></select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="phutrach">Phụ trách</label>
                                                                        <select id="phutrach" class="select2 form-control" name="phutrach"></select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="ghichu">Ghi chú</label>
                                                                        <input id="ghichu" name="ghichu" type="text" class="form-control" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="tinhtrang">Tình trạng</label>
                                                                        <select id="tinhtrang" class="select2 form-control" name="tinhtrang"></select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div id="listnhatky" style="position: relative;height: 420px;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                            <button type="button" onclick="saveedit()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                            <button type="reset" class="btn btn-outline-secondary mr-sm-1" data-dismiss="modal">Bỏ qua</button>
                                                            <button type="button" id class="btn btn-outline-secondary" data-toggle="modal" data-target="#addnhatky">Thêm nhật ký</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- <div class="modal fade text-left" id="addnhatky" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modal-title3">Ghi nhật ký</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form onsubmit="return false;">
                                        <div class="modal-body">
                                            <label>Nội dung</label>
                                            <div class="form-group">
                                                <input id="iddata" name="iddata" type="hidden">
                                                <input type="text" class="form-control" name="noidung" id="noidung" />
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" onclick="savenhatky()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                            <button type="reset" class="btn btn-outline-secondary mr-sm-1" data-dismiss="modal">Bỏ qua</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> -->

                        <div class="modal fade text-left" id="chiadata" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modal-title4"></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="fm-chiadata">
                                            <div class="form-group">
                                                <label for="chiacho">Phụ trách</label>
                                                <select id="chiacho" class="select2 form-control" name="chiacho" required></select>
                                            </div>
                                            <input id="data" name="data" type="hidden">
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-dismiss="modal" onclick="savechia()">Xác nhận</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade text-left" id="nhapexcel" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modal-title5">Nhập data từ excel</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="frm-nhapexcel">
                                            <div class="form-group">
                                                <label class="form-label mr-4" for="file">Tải file mẫu</label>
                                                <a target="_blank" href="<?= URLFILE ?>/uploads/data.xlsx" style="color: blue;">Tải xuống <i class="fas fa-download"></i></a>

                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="file">File upload</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="file" name="file">
                                                    <label class="custom-file-label" for="file">Chọn file</label>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="phutrach">Phụ trách (để trống nếu chọn chính mình)</label>
                                                <select id="phutrach_import" class="select2 form-control" name="phutrach_import"></select>
                                            </div>

                                            <div class="form-group">
                                                <label for="phan_loai_import">Nguồn khách hàng</label>
                                                <select id="phan_loai_import" class="select2 form-control phan-loai" name="phan_loai_import">
                                                </select>
                                            </div> -->

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary waves-effect waves-float waves-light" onclick="savenhap()">Xác nhận</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade text-left" id="add-lead" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modal-title4">Tạo cơ hội</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="frm-add-lead">
                                            <div class="form-group">
                                                <label for="leadName">Tên cơ hội</label>
                                                <input id="leadName" class="form-control" name="leadName" />
                                            </div>
                                            <div class="form-group">
                                                <label for="descriptionLead">Mô tả cơ hội</label>
                                                <textarea id="descriptionLead" class="form-control" rows="3" name="descriptionLead" ></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="opportunity">Cơ hội</label>
                                                <select id="opportunity" class="select2 form-control" name="opportunity">
                                                    <option value="1">Nhỏ</option>
                                                    <option value="2">Trung bình</option>
                                                    <option value="3">Lớn</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary waves-effect waves-float waves-light" onclick="saveAddLead()">Xác nhận</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="modal fade text-left" id="showcall" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modal-title4">Gọi điện</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="call_number">Nhập số điện thoại</label>
                                            <input id="call_number" type="text" class="form-control" name="call_number" required />
                                        </div>
                                        <input id="data" name="data" type="hidden">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-dismiss="modal" onclick="call($('#call_number').val())">Xác nhận</button>
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
        funCall = <?=$this->funCall?>,
        funShare = <?=$this->funShare?>,
        funImport = <?=$this->funImport?>,
        funCreateChange = <?=$this->funCreateChange?>,
        funEdit = <?=$this->funEdit?>,
        funDel = <?=$this->funDel?>;
    //  console.log(funCall,funAdd,funShare,funCreateChange,funImport,funEdit,funDel);
    let username = '<?php echo $_SESSION['user']['username'] ?>';
    let hinhanh = '<?php echo URLFILE.'/uploads/nhanvien/'.$_SESSION['user']['avatar'] ?>';
</script>
<script src="<?= HOME ?>/js/data.js"></script>