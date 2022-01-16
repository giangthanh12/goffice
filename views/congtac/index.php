<script src="<?= HOME ?>/js/congtac.js"></script>
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
                        <table class="user-list-table table" id="contract-table">
                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th>Tên nhân viên</th>
                                    <th>Vị trí</th>
                                    <th>Phòng ban</th>
                                    <th>Chi nhánh</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form class="form-validate" enctype="multipart/form-data" id="fm">
                            <div class="form-group row">
                                <input type="hidden" name="id" id="historyId">
                                <div class="col-12">
                                    <div id="history"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-left" id="large1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel8"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form class="form-validate" enctype="multipart/form-data" id="fm">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="fname-icon">Tên hợp đồng</label>
                                    <div class="input-group input-group-merge">

                                        <input type="text" id="name" class="form-control" required name="name"
                                            placeholder="Tên hợp đồng" />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="fname-icon">Loại hợp đồng</label>
                                    <div class="input-group input-group-merge">
                                        <select class="form-control" id="type" name="type" placeholder="Loại hợp đồng">
                                            <option value="" disable>--Chọn Loại hợp đồng--</option>
                                            <option value="1">Hợp đồng Thử việc</option>
                                            <option value="2">Hợp đồng Chính thức</option>
                                            <option value="3">Hợp đồng Thời vụ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="fname-icon">Phòng ban</label>
                                    <div class="input-group input-group-merge">
                                        <select class="form-control" id="departmentId" name="department"
                                            placeholder="Phòng ban">
                                            <option value="">--Chọn Phòng ban--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="fname-icon">Vị trí</label>
                                    <div class="input-group input-group-merge">
                                        <select class="form-control" id="positionId" name="position"
                                            placeholder="Vị trí">
                                            <option value="">--Chọn Vị trí--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="fname-icon">Chi nhánh</label>
                                    <div class="input-group input-group-merge">
                                        <select class="form-control" id="branchId" name="branch"
                                            placeholder="Chi nhánh">
                                            <option value="">--Chọn Chi nhánh--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="fname-icon">Nơi làm việc</label>
                                    <div class="input-group input-group-merge">
                                        <select class="form-control" id="workplaceId" name="workplace"
                                            placeholder="Nơi làm việc" disable>
                                            <option value="">--Chọn Nơi làm việc--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="fname-icon">Mức lương</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="salary"></i></span>
                                        </div>
                                        <input type="text" id="salary" class="form-control" required name="salary"
                                            placeholder="Mức lương" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="fname-icon">Phụ cấp</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="allowance"></i></span>
                                        </div>
                                        <input type="text" id="allowance" class="form-control" required name="allowance"
                                            placeholder="Phụ cấp" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="fname-icon">Mức bảo hiểm</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="insurance"></i></span>
                                        </div>
                                        <input type="text" id="insurance" class="form-control" required name="insurance"
                                            placeholder="Bảo hiểm" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="fname-icon">Phần trăm Lương (%)</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="percentage"></i></span>
                                        </div>
                                        <input type="number" id="percentage" class="form-control" required
                                            name="percentage" min="10" max="100" placeholder="Phần trăm Lương" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="fname-icon">Ngày bắt đầu</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="startDate"></i></span>
                                        </div>
                                        <input type="date" id="startDate" class="form-control task-due-date" required
                                            name="startDate" placeholder="Ngày bắt đầu" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="fname-icon">Ngày kết thúc</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="stopDate"></i></span>
                                        </div>
                                        <input type="date" id="stopDate" class="form-control task-due-date" required
                                            name="stopDate" placeholder="Ngày kết thúc" />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="fname-icon">Mô tả nội dung hợp đồng</label>
                                    <div class="input-group input-group-merge">
                                        <textarea name="description" id="description" cols="100" rows="8"
                                            style="resize: none;"></textarea>
                                    </div>
                                </div>

                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="staffId" id="staffId">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="update()" class="btn btn-add btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">
                    Cập nhật
                </button>
                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua
                </button>
            </div>
        </div>
    </div>
</div>