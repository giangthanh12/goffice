
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
               
                <!-- users filter end -->
                <!-- list section start -->
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <!-- <th></th> -->
                                    <th>Tên ca</th>
                                    <th>Thứ 2</th>
                                    <th>Thứ 3</th>
                                    <th>Thứ 4</th>
                                    <th>Thứ 5</th>
                                    <th>Thứ 6</th>
                                    <th>Thứ 7</th>
                                    <th>Chủ nhật</th>
                                    <th>Nghỉ trưa</th>
                                    <th>Thời lượng</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
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
                                            <form class="form-validate thoigian_lamviec" enctype="multipart/form-data" id="dg">
                                                <div class="row mt-1">
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Tên </label>
                                                            <input id="ca" name="ca" type="text" class="form-control" />
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <h4 class="mb-1"><span class="align-middle">Giờ làm việc</span></h4>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Thứ 2</label>
                                                            <input id="t2_in" name="t2_in" type="text" class="form-control flatpicker" />
                                                            <input id="t2_out" name="t2_out" type="text" class="form-control flatpicker" />
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Thứ 3</label>
                                                            <input id="t3_in" name="t3_in" type="text" class="form-control flatpicker" />
                                                            <input id="t3_out" name="t3_out" type="text" class="form-control flatpicker" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Thứ 4</label>
                                                            <input id="t4_in" name="t4_in" type="text" class="form-control flatpicker" />
                                                            <input id="t4_out" name="t4_out" type="text" class="form-control flatpicker" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Thứ 5</label>
                                                            <input id="t5_in" name="t5_in" type="text" class="form-control flatpicker" />
                                                            <input id="t5_out" name="t5_out" type="text" class="form-control flatpicker" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Thứ 6</label>
                                                            <input id="t6_in" name="t6_in" type="text" class="form-control flatpicker" />
                                                            <input id="t6_out" name="t6_out" type="text" class="form-control flatpicker" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Thứ 7</label>
                                                            <input id="t7_in" name="t7_in" type="text" class="form-control flatpicker" />
                                                            <input id="t7_out" name="t7_out" type="text" class="form-control flatpicker" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Chủ nhật</label>
                                                            <input id="cn_in" name="cn_in" type="text" class="form-control flatpicker" />
                                                            <input id="cn_out" name="cn_out" type="text" class="form-control flatpicker" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Nghỉ trưa</label>
                                                            <input id="lunStart" name="lunStart" type="text" class="form-control flatpicker" />
                                                            <input id="lunInterval" name="lunInterval" type="number" class="form-control" />
                                                        </div>
                                                    </div>
                                                  

                            
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="button" onclick="savetk()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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
<script src="<?= HOME ?>/js/ca.js"></script>