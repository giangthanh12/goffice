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
                        <!-- <div class="col-md-4 bm_phanloai"></div> -->
                    </div>
                </div>
                <!-- users filter end -->
                <!-- list section start -->
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th>Ngày cập nhật</th>
                                    <th>Tên biểu mẫu</th>
                                    <th>Phân loại</th>
                                    <th>Người nhập</th>
                                    <!-- <th>Tải về</th> -->
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
                                                <div class="form-group">
                                                    <label for="name">Tên biểu mẫu</label>
                                                    <input id="name" type="text" class="form-control" name="name" />
                                                </div>

                                                <div class="form-group">
                                                    <label for="phan_loai">Phân loại</label>
                                                    <select id="phan_loai" class=" form-control" name="phan_loai">
                                                        <option value="">Chọn phân loại biểu mẫu</option>
                                                        <option value="1">Hợp đồng</option>
                                                        <option value="2">Báo giá</option>
                                                        <option value="3">Đề nghị tạm ứng</option>
                                                        <option value="4">Đề nghị thanh toán</option>
                                                        <option value="5">Yêu cầu tuyển dụng</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="file">File upload</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="file" name="file">
                                                        <label class="custom-file-label" for="file">Chọn file</label>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-sm-row flex-column mt-2">
                                                    <button type="button" onclick="savebm()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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
<script src="<?= HOME ?>/js/bieumau.js"></script>