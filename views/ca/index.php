
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
                <div class="d-flex justify-content-between align-items-center mx-50 row pt-2 ">
                    <h2 class="content-header-title float-left mb-2" id="title_module">
                       Ca làm việc <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Quản lý các ca làm việc trực thuộc của doanh nghiệp" data-trigger="click" >
                    </h2>
                    </div>
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
                                    <h4 class="modal-title" id="myModalLabel16"></h4><img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="left" data-original-title="Quản lý thời gian làm việc trong tuần của từng bộ phận/phòng ban trong doanh nghiệp" data-trigger="click" >
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
                                                            <input id="t2_in" onchange="changeTime($('#t2_in'), $('#t2_out'))" name="t2_in" type="text" class="form-control flatpicker" />
                                                            <input id="t2_out" name="t2_out" type="text" class="form-control flatpicker" />
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Thứ 3</label>
                                                            <input id="t3_in" name="t3_in" onchange="changeTime($('#t3_in'), $('#t3_out'))" type="text" class="form-control flatpicker" />
                                                            <input id="t3_out" name="t3_out" type="text" class="form-control flatpicker" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Thứ 4</label>
                                                            <input id="t4_in" name="t4_in" onchange="changeTime($('#t4_in'), $('#t4_out'))" type="text" class="form-control flatpicker" />
                                                            <input id="t4_out" name="t4_out" type="text" class="form-control flatpicker" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Thứ 5</label>
                                                            <input id="t5_in" name="t5_in" onchange="changeTime($('#t5_in'), $('#t5_out'))" type="text" class="form-control flatpicker" />
                                                            <input id="t5_out" name="t5_out" type="text" class="form-control flatpicker" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Thứ 6</label>
                                                            <input id="t6_in" name="t6_in" onchange="changeTime($('#t6_in'), $('#t6_out'))"  type="text" class="form-control flatpicker" />
                                                            <input id="t6_out" name="t6_out" type="text" class="form-control flatpicker" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Thứ 7</label>
                                                            <input id="t7_in" name="t7_in" onchange="changeTime($('#t7_in'), $('#t7_out'))" type="text" class="form-control flatpicker" />
                                                            <input id="t7_out" name="t7_out" type="text" class="form-control flatpicker" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Chủ nhật</label>
                                                            <input id="cn_in" onchange="changeTime($('#cn_in'), $('#cn_out'))" name="cn_in" type="text" class="form-control flatpicker" />
                                                            <input id="cn_out" name="cn_out" type="text" class="form-control flatpicker" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Nghỉ trưa</label>
                                                            <input id="lunStart" name="lunStart" type="text" class="form-control flatpicker" />
                                                            <input id="lunInterval" placeholder="Thời lượng nghỉ" name="lunInterval" type="number" class="form-control" />
                                                        </div>
                                                    </div>
                                                  

                            
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="submit"  class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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