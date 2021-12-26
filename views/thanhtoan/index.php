<script src="<?= HOME ?>/js/thanhtoan.js"></script>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <!-- list section start -->
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th>Ngày</th>
                                    <th>Nhân viên</th>
                                    <th>Số tiền</th>
                                    <th>Nội dung</th>
                                    <th>Tình trạng</th>
                                    <th>Người duyệt</th>
                                    <th style="width: 100px">Link file</th>
                                    <th></th>
                                    <th></th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal" role="document">
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
                                                <input type="hidden" name="tinh_trang" id="tinh_trang">
                                                <div class="form-group">
                                                    <label for="ngay">Ngày</label>
                                                    <input type="text" id="ngay" name="ngay" class="form-control flatpickr-basic" placeholder="DD/MM/YYYY" />
                                                </div>

                                                <div class="form-group">
                                                    <label for="so_tien">Số tiền</label>
                                                    <input type="text" class="form-control format_number" id="so_tien" name="so_tien" />
                                                </div>

                                                <div class="form-group">
                                                    <label for="nhan_vien">Nhân viên</label>
                                                    <select id="nhan_vien" class="select2 form-control" name="nhan_vien">
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="noi_dung">Nội dung</label>
                                                    <textarea id="noi_dung" name="noi_dung" type="text" class="form-control " /></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="file">File upload</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="file" name="file">
                                                        <label class="custom-file-label" for="file">Chọn file</label>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-sm-row flex-column mt-2">
                                                    <button type="button" onclick="savetu()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                </div>
                                            </form>

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