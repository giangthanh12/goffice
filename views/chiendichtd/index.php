<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0" id="title_module" style="border-right-width: 0px;">
                            Chiến dịch tuyển dụng
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="datatables-basic table" id="list_chiendichtd">
                                <thead>
                                    <tr>
                                        <th>Người tạo</th>
                                        <th>Mã chiến dịch</th>
                                        <th>Tên chiến dịch</th>
                                        <th>Trạng thái</th>
                                        <th>Vị trí</th>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th>Số lượng</th>
                                        <th>Tổng CV</th>
                                        <th>Trúng tuyển</th>
                                        <th>Còn lại</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal modal-slide-in fade" id="modals-slide-in">
                    <div class="modal-dialog sidebar-sm">
                        <form class="modal-content" id="fm">
                            <div class="modal-header mb-1">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                            </div>
                            <div class="modal-body flex-grow-1">
                                <div class="form-group">
                                    <label class="form-label" for="name">Tên tài nguyên</label><br />
                                    <span class="font-weight-bold text-primary" id="tentainguyen">Hosting congtybonmua.com</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="name">Chủ sở hữu</label><br />
                                    <span class="font-weight-bold text-primary" id="chusohuu">Công ty TNHH Đầu Tư Phát triển Nông Nghiệp Bốn Mù<a href="mailto:"></a></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="name">Phân loại</label><br />
                                    <span class="font-weight-bold text-primary" id="phanloai">Hosting</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="name">Nhà cung cấp</label><br />
                                    <span class="font-weight-bold text-primary" id="nhacungcap">Gemstech</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="name">Tên đăng nhập</label><br />
                                    <span class="font-weight-bold text-primary" id="tendangnhap">ctbonmua</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="name">Mật khẩu</label><br />
                                    <span class="font-weight-bold text-primary" id="matkhau">abcd1234</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="name">Người tạo</label><br />
                                    <span class="font-weight-bold text-primary" id="nguoitao">Nguyễn Thế Quỳnh</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="name">Đường dẫn</label><br />
                                    <span class="font-weight-bold text-primary" id="duongdan">http://congtybonmua.com:2222</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="name">Ghi chú</label><br />
                                    <span class="font-weight-bold text-primary" id="ghichu">User: ctbonmua_db; Pass: abcd1234</span>
                                </div>
                                <button type="button" id="rsModal" class="btn btn-outline-secondary" data-dismiss="modal">
                                    Đóng
                                </button>
                                <button type="button" id="btn_edit" class="btn btn-outline-primary">
                                    Chỉnh sửa
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal fade text-left" id="sharetainguyen" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modal-title"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="fm-sharetainguyen">
                                    <div class="form-group">
                                        <label for="chiase">Chia sẻ cho</label>
                                        <select id="chiase" class="js-example-basic-multiple" name="nhanvien[]" multiple="multiple" required>
                                        </select>
                                    </div>
                                    <input id="id" name="id" type="hidden">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-dismiss="modal" onclick="saveshare()">Accept</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script src="<?= HOME ?>/js/chiendichtd/index.js"></script>