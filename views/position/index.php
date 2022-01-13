<script src="<?= HOME ?>/js/position.js"></script>
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
                                    <th>Tên vị trí</th>
<!--                                    <th>Phòng ban</th>-->
<!--                                    <th></th>-->
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
                                                    <label for="name">Tên gọi</label>
                                                    <input type="text" class="form-control" id="name" placeholder="Nhập tên phòng ban" name="name" />
                                                </div>

                                                <div class="form-group">
                                                    <label for="departmentId">Phòng ban</label>
                                                    <select id="departmentId" class="select2 form-control" name="departmentId">
                                                    </select>
                                                </div>

                                                <!-- <div class="form-group">
                                                    <label for="ghi_chu">Ghi chú</label>
                                                    <textarea id="ghi_chu" name="ghi_chu" type="text" class="form-control " /></textarea>
                                                </div> -->

                                                <div class="d-flex flex-sm-row flex-column mt-2">
                                                    <button type="button" onclick="savevt()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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