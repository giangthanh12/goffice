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
                <h2 class="content-header-title float-left mb-0" id="title_module">
                        Bảng lương <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng điểm danh" data-trigger="click" >
                    </h2>
                    <div class="d-flex align-items-center mx-50 row pt-2">
                        <div class="col-md-2 data_nhanvien form-group">
                            <label for="month">Tháng</label>
                            <select id="month" class="select2 form-control" name="month"></select>
                        </div>

                        <div class="col-md-2 data_nhanvien form-group">
                            <label for="year">Năm</label>
                            <select id="year" class="select2 form-control" name="year"></select>
                        </div>
                        <button type="button" class="btn btn-icon btn-outline-primary waves-effect" style="margin-top:10px" title="Tìm kiếm" onclick="search()">Tìm kiếm
                        </button>
                    </div>
                    <div class=" d-flex align-items-center mx-50 row">
                        <?php
                        if ($this->funAdd == 1) {
                        ?>
                            <button type="button" class="dt-button btn btn-primary mt-50 ml-1" style="margin-top:10px" title="Lập bảng" onclick="add()">Lập bảng lương
                            </button>
                        <?php }
                        if ($this->funCheck == 1) { ?>
                            <button type="button" class="dt-button btn btn-danger mt-50 ml-1" style="margin-top:10px" title="Duyệt bảng lương" onclick="checkAll()">Duyệt bảng lương
                            </button>
                        <?php } ?>

                        <button type="button" class="dt-button btn btn-primary mt-50 ml-1" style="margin-top:10px" title="Xuất bảng lương" onclick="exportexcel()">Xuất excel
                        </button>
                    </div>
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th>Nhân viên</th>
                                    <th style="text-align: center">Công chuẩn</th>
                                    <th style="text-align: right">Lương HĐ</th>
                                    <th style="text-align: center">Ngày công</th>
                                    <th style="text-align: right">Lương t/g</th>
                                    <th style="text-align: right">Phụ cấp</th>
                                    <th style="text-align: right">Thưởng DS</th>
                                    <th style="text-align: right">Thưởng lễ</th>
                                    <th style="text-align: right">Thưởng khác</th>
                                    <th style="text-align: right">Tổng cộng</th>
                                    <th style="text-align: right">Bảo hiểm</th>
                                    <th style="text-align: right">Tạm ứng</th>
                                    <th style="text-align: right">Thực lĩnh</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                    <th colspan="12" ></th>
                                    <th colspan="2"  id="total"></th>
                                </tr>
                            </tfoot> -->
                        </table>
                        <div id="total2" style="font-weight:bold; margin-top: -28px; padding-right: 20px;"></div>
                    </div>
                         
                    <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modal-title"></h4>
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" enctype="multipart/form-data" id="fm">
                                                <div class="form-group">
                                                    <label for="staffName">Họ tên</label>
                                                    <input id="staffName" type="text" class="form-control" name="staffName" readonly />
                                                </div>

                                                <div class="form-group">
                                                    <label for="revenueBonus">Thưởng doanh số</label>
                                                    <input id="revenueBonus" type="text" class="form-control format_number" name="revenueBonus" onkeyup="this.value=Comma(this.value)" />
                                                </div>

                                                <div class="form-group">
                                                    <label for="tetBonus">Thưởng lễ tết</label>
                                                    <input id="tetBonus" type="text" class="form-control format_number" name="tetBonus" onkeyup="this.value=Comma(this.value)" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="otherBonus">Thưởng khác</label>
                                                    <input id="otherBonus" type="text" class="form-control format_number" name="otherBonus" onkeyup="this.value=Comma(this.value)" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="insurance">Bảo hiểm</label>
                                                    <input id="insurance" type="text" class="form-control format_number" name="insurance" onkeyup="this.value=Comma(this.value)" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="advance">Tạm ứng</label>
                                                    <input id="advance" type="text" class="form-control format_number" name="advance" onkeyup="this.value=Comma(this.value)" />
                                                </div>
                                                <div class="d-flex flex-sm-row flex-column mt-2">
                                                    <button type="button" onclick="saveupdate()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật
                                                    </button>
                                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua
                                                    </button>
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
<script>
    let funCheck = <?= $this->funCheck ?>;
    let funAdd = <?= $this->funAdd ?>;
    let funEdit = <?= $this->funEdit ?>;
    let month = "<?= date('m') ?>";
    let year = "<?= date('Y') ?>";
</script>
<script src="<?= HOME ?>/js/payrolls.js"></script>