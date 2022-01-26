<!-- <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-kanban.css"> -->
<script>
    var funAdd = <?=$this->funAdd?>,
        funEdit = <?=$this->funEdit?>,
        funDel = <?=$this->funDel?>;
</script>
<script src="<?= HOME ?>/js/laborcontracts.js"></script>

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
                                    <th>Tên hợp đồng</th>
                                    <th>Loại hợp đồng</th>
                                    <th>Nhân viên</th>
                                    <th>Tình trạng</th>
                                    <th></th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="add-contract" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                                                <div class="row mt-1">
                                                    <div class="col-md-4 form-group">
                                                        <label for="name">Tên hợp đồng</label>
                                                        <input id="name" name="name" type="text" class="form-control" required />
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="type">Loại hợp đồng</label>
                                                        <select id="type" class="form-control" name="type" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="staffId">Nhân viên</label>
                                                        <select id="staffId" class="select2 form-control" name="staffId" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="departmentId">Phòng ban</label>
                                                        <select id="departmentId" class="form-control" name="departmentId" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="position">Vị trí</label>
                                                        <select id="position" class="form-control" name="position" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="branchId">Chi nhánh</label>
                                                        <select id="branchId" class="form-control" name="branchId" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="insuranceSalary">Địa điểm làm việc</label>
                                                        <select id="workPlaceId" class="form-control" name="workPlaceId" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="insuranceSalary">Phân ca</label>
                                                        <select id="shiftId" class="form-control" name="shiftId" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="basicSalary">Lương cơ bản</label>
                                                        <input id="basicSalary" type="text" class="form-control format_number" name="basicSalary" onkeyup="this.value=Comma(this.value)" required/>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="salaryPercentage">Tỉ lệ lương (%)</label>
                                                        <input id="salaryPercentage" type="text" class="form-control" name="salaryPercentage" value="100" required/>
                                                    </div>

                                                    <div class="col-md-4 form-group">
                                                        <label for="allowance">Phụ cấp</label>
                                                        <input id="allowance" type="text" class="form-control format_number" name="allowance" onkeyup="this.value=Comma(this.value)" />
                                                    </div>

                                                    <div class="col-md-4 form-group">
                                                        <label for="startDate">Ngày bắt đầu</label>
                                                        <input type="text" id="startDate" name="startDate" class="form-control flatpickr-basic" placeholder="" required/>
                                                    </div>

                                                    <div class="col-md-4 form-group">
                                                        <label for="stopDate">Ngày kết thúc</label>
                                                        <input type="text" id="stopDate" name="stopDate" class="form-control flatpickr-basic" placeholder="" />
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="status">Tình trạng</label>
                                                        <select id="status" class="select2 form-control" name="status">
                                                            <option value="">Chọn tình trạng</option>
                                                            <option value="1">Đang thực hiện</option>
                                                            <option value="2">Đã kết thúc</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="description">Ghi chú</label>
                                                        <input type="text" id="description" name="description" type="text" class="form-control " />
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="button" onclick="save()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1" id="btnUpdate">Cập nhật</button>
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
                </div>
            </section>
        </div>
    </div>
</div>
