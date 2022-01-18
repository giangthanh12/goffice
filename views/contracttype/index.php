<script src="<?= HOME ?>/js/contracttype.js"></script>
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
                                <th>Tên</th>
                                <th>Ghi chú</th>
                                <th>...</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="dgAccesspoint" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16"></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" enctype="multipart/form-data" id="fm">
                                                <div class="form-group">
                                                    <label for="name">Tên</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i data-feather='archive'></i>
                                                            </span>
                                                        </div>
                                                        <input
                                                                type="text"
                                                                id="name"
                                                                class="form-control"
                                                                name="name"
                                                                placeholder="Tên loại hợp đồng"
                                                                required
                                                        />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Ghi chú</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i data-feather='bookmark'></i>
                                                            </span>
                                                        </div>
                                                        <input
                                                                type="text"
                                                                id="note"
                                                                class="form-control"
                                                                name="note"
                                                                placeholder="Ghi chú"
                                                        />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="save()"
                                            class="btn btn-add btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">
                                        Cập nhật
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>