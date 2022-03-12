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
                <h2 class="content-header-title float-left mb-0" id="title_module" style="border-right-width: 0px;">
                       Cài đặt yêu cầu <img src="<?= HOME ?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng ..." data-trigger="click">
                    </h2>
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Yêu cầu</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="modal fade text-left" id="info-contract" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" aria-labelledby="information-tab" role="document" id="infomation" style="max-width: 1000px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16"></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <ul class="nav nav-pills" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                            <i data-feather="info"></i><span class="d-none d-sm-block">Thông tin yêu cầu</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" id="step-info" data-toggle="tab" href="#step" aria-controls="step" role="tab" aria-selected="true">
                                            <i data-feather="user"></i><span class="d-none d-sm-block">Các bước thực hiện</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="modal-body add">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="information" aria-labelledby="information-tab" role="tabpanel">
                                            <form class="form-validate" enctype="multipart/form-data" id="frm-1">
                                                <div class="row mt-1">
                                                    <div class="col-md-6 form-group">
                                                        <label for="name1">Yêu cầu<span style="color:red;">*</span></label>
                                                        <input id="name1" name="name1" type="text" class="form-control" />
                                                    </div>
                                                    <!-- <div class="col-md-6 form-group"></div> -->

                                                    <div class="col-md-6 form-group">
                                                        <div class="row form-group">
                                                            <div class="col col-md-3"><label for="object1" class=" form-control-label">Đối tượng</label></div>
                                                            <div class="col-12 col-md-9">
                                                                <button type="button" class="btn btn-primary" id="addobject1" onclick="addobjectbutton1()">
                                                                    + Thêm mới
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="sttobj1" value="0">
                                                        <div id="listobject1">
                                                        </div>
                                                    </div>


                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1" id="btnUpdate">Cập nhật</button>
                                                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="step" aria-labelledby="step-info" role="tabpane">
                                            <section class="form-control-repeater">
                                                <form class="invoice-repeater" enctype="multipart/form-data" id="frm-2">
                                                    <div class="row" style="margin-bottom: 20px" id="btnStep">
                                                        <div class="col-12">
                                                            <button class="btn btn-icon btn-primary" type="button" onclick="showStepButton()" data-repeater-create>
                                                                <i data-feather="plus" class="mr-25"></i>
                                                                <span>Thêm mới</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div data-repeater-list="invoice" id="stepList">

                                                    </div>
                                                    <div class="d-flex flex-sm-row flex-column mt-2">
                                                        <button type="submit" id="btnUpdate2" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                    </div>
                                                </form>
                                            </section>
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
<script>
    var funAdd = <?= $this->funAdd ?>,
        funEdit = <?= $this->funEdit ?>,
        funDel = <?= $this->funDel ?>;
</script>
<script src="<?= HOME ?>/js/define_request.js"></script>