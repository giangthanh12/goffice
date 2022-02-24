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
                        <div class="col-md-4 kh_tinhtrang"></div>
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
                                    <th>Tên nhóm tài sản</th>
                                    <th>Ghi chú</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="modal modal-slide-in new-user-modal fade" id="updateinfo">

                        <div class="modal-dialog">

                            <form class="add-new-user modal-content pt-0" id="dg">

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>

                                <div class="modal-header mb-1">

                                    <h5 class="modal-title" id="exampleModalLabel">Thêm nhóm tài sản mới</h5>
                                </div>
                                <div class="modal-body flex-grow-1">

                                    <div class="form-group">

                                        <label class="form-label" for="name">Tên nhóm</label>

                                        <input type="text" class="form-control dt-full-name" id="name" name="name" />

                                    </div>

                                    <div class="form-group">

                                        <label class="form-label" for="dien_thoai">Mô tả</label>

                                        <textarea name="ghi_chu" id="ghi_chu" class="form-control"></textarea>

                                    </div>

                                    <button type="submit" class="btn btn-primary mr-1 data-submit">Lưu</button>

                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>

                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script src="<?= HOME ?>/js/asset_group.js"></script>