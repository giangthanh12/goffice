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
                   
                    <div class="d-flex justify-content-between align-items-center mx-50 row pt-2 ">
                      <h2>   
                      Hợp đồng lao động  <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Quản lý toàn bộ thông tin hợp đồng lao động của từng nhân sự trong doanh nghiệp" data-trigger="click" >
                        </h2>
                    </div>
                  
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
                                                        <input id="name" data-msg-required="Yêu cầu chọn tên hợp đồng" name="name" type="text" class="form-control" required />
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="type" >Loại hợp đồng</label>
                                                        <select id="type" required data-msg-required="Yêu cầu chọn loại hợp đồng" class="form-control select2" name="type">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="staffId">Nhân viên</label>
                                                        <select id="staffId" data-msg-required="Yêu cầu chọn nhân viên" class="select2 form-control" name="staffId" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="departmentId">Phòng ban</label>
                                                        <select id="departmentId" data-msg-required="Yêu cầu chọn phòng ban" class="select2 form-control" name="departmentId" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="position">Vị trí</label>
                                                        <select id="position" data-msg-required="Yêu cầu vị trí" class="select2 form-control" name="position" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="branchId">Chi nhánh</label>
                                                        <select id="branchId" data-msg-required="Yêu cầu chọn chi nhánh" class="select2 form-control" class="form-control" name="branchId" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="workPlaceId">Địa điểm làm việc</label>
                                                        <select id="workPlaceId" data-msg-required="Yêu cầu chọn địa điểm làm việc" class="select2 form-control" class="form-control" name="workPlaceId" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="insuranceSalary">Phân ca</label>
                                                        <select id="shiftId" data-msg-required="Yêu cầu chọn phân ca" class="select2 form-control" name="shiftId" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="basicSalary">Lương cơ bản</label>
                                                        <input id="basicSalary" data-msg-required="Yêu cầu nhập lương cơ bản" type="text" class="form-control format_number" name="basicSalary" onkeyup="this.value=Comma(this.value)" required/>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="salaryPercentage">Tỉ lệ lương (%)</label>
                                                        <input id="salaryPercentage" data-msg-required="Yêu cầu nhập tỉ lệ lương" type="text" class="form-control" name="salaryPercentage" value="100" required/>
                                                    </div>

                                                    <div class="col-md-4 form-group">
                                                        <label for="allowance">Phụ cấp</label>
                                                        <input id="allowance" required type="text" data-msg-required="Yêu cầu nhập phụ cấp" class="form-control format_number" name="allowance" onkeyup="this.value=Comma(this.value)" />
                                                    </div>

                                                    <div class="col-md-4 form-group">
                                                        <label for="startDate">Ngày bắt đầu</label>
                                                        <input type="text" id="startDate" data-msg-required="Yêu cầu nhập ngày bắt đầu" name="startDate" class="form-control flatpickr-basic" placeholder="" required/>
                                                    </div>

                                                    <div class="col-md-4 form-group">
                                                        <label for="stopDate">Ngày kết thúc</label>
                                                        <input type="text" required data-msg-required="Yêu cầu nhập ngày kết thúc" id="stopDate"  name="stopDate" class="form-control flatpickr-basic" placeholder="" />
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="status">Tình trạng</label>
                                                        <select id="status" class="select2 form-control" name="status">
                                                            <option value="1">Đang thực hiện</option>
                                                            <option value="2">Đã kết thúc</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="description">Ghi chú</label>
                                                        <input type="text" id="description" name="description" type="text" class="form-control " />
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="submit"  class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1" onclick="save()" id="btnUpdate">Cập nhật</button>
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
