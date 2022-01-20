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
                        <div class="col-md-4 taisan_filter"></div>
                        <div class="col-md-4 nhanvien_filter"></div>
                    </div>
                </div>
                <!-- users filter end -->
                <!-- list section start -->
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Ứng viên</th>
                                    <th>Giới tính</th>
                                    <th>Ngày phỏng vấn</th>
                                    <th>Chiến dịch</th>
                                    <th>Số điện thoại</th>
                                    <th>Kết quả</th>
                                    <th ></th>
                                </tr>
                            </thead>
                        </table>
                    </div>


                    <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16"></h4>

                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" enctype="multipart/form-data" id="dg">
                                                <input type="hidden" name="applicantId" id="applicantId" />
                                                <div class="row mt-1">
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Tên hợp đồng</label>
                                                            <input id="name" type="text" class="form-control" name="name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="type">Loại hợp đồng</label>
                                                            <select id="type" class="select2 form-control" name="type">
                                                                <option value="1">Hợp đồng thử việc</option>
                                                                <option value="2">Hợp đồng chính thức</option>
                                                                <option value="3">Hợp đồng thời vụ</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="startDate">Ngày bắt đầu hợp đồng</label>
                                                            <input id="startDate" type="text" class="form-control ngay_gio" name="startDate" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="stopDate">Ngày hết hạn hợp đồng</label>
                                                            <input id="stopDate" type="text" class="form-control ngay_gio" name="stopDate" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="basicSalary">Lương cơ bản</label>
                                                            <input id="basicSalary" type="text" class="form-control" name="basicSalary" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="insuranceSalary">Lương phụ cấp</label>
                                                            <input id="insuranceSalary" type="text" class="form-control" name="insuranceSalary" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="salaryPercentage">Phần trămLương</label>
                                                            <input id="salaryPercentage" type="text" class="form-control" name="salaryPercentage" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="allowance">Trợ cấp</label>
                                                            <input id="allowance" type="text" class="form-control" name="allowance" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="position">Vị trí</label>
                                                            <select id="position" class="select2 form-control" name="position">
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="branchId">Phòng ban</label>
                                                            <select id="branchId" class="select2 form-control" name="branchId">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="departmentId">Chi nhánh</label>
                                                            <select id="departmentId" class="select2 form-control" name="departmentId">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="description">Mô tả</label>
                                                            <textarea name="description" class="form-control" id="description" cols="" rows=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="submit" onclic class="btn btn-primary btn-add-customer mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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

<script src="<?= HOME ?>/js/interview_result.js"></script>