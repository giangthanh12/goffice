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
                        Tổng hợp <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng điểm danh" data-trigger="click" >
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
                        <button type="button" class="btn btn-icon btn-outline-primary waves-effect"
                                style="margin-top:10px" title="Tìm kiếm" onclick="search()">Tìm kiếm
                        </button>
                        <button type="button" class="dt-button btn btn-primary mt-50 ml-1" style="margin-top:10px" title="Xuất bảng lương" onclick="exportexcel()">Xuất excel
                        </button>
                    </div>
                    <div class="d-flex align-items-center mx-50 row">
                        <?php if($this->funAdd == 1) { ?>
                        <button type="button" class="dt-button btn btn-primary mt-50 ml-1" style="margin-top:10px"
                                title="Lập bảng" onclick="add()">Lập bảng
                        </button>
                        <?php } ?>
                        <?php if($this->funEdit == 1) { ?>
                        <button type="button" class="dt-button btn btn-danger mt-50 ml-1" style="margin-top:10px"
                                title="Lập bảng" onclick="update()">Chấm công tay
                        </button>
                        <?php } ?>

                       
                    </div>
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                            <tr id="tb-timesheets">
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="modal fade text-left" id="updateinfo"  role="dialog"
         aria-labelledby="myModalLabel16" aria-hidden="true">
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
                                <div class="col-12">
                                    <label for="email-icon">Nhân viên</label>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <select class="select2 form-control" id="staffId"
                                                    name="staffId" placeholder="Nhân viên" required>
                                                <option value="">--Chọn nhân viên--</option>
                                                <option value="0">--Tất cả--</option>
                                                <?php
                                                foreach ($this->employee AS $item) {
                                                    if ($item['avatar']!='')
                                                        $avatar = URLFILE.'/uploads/nhanvien/'.$item['avatar'];
                                                    else
                                                        $avatar = HOME.'/layouts/useravatar.png';
                                                    echo '<option data-img="'.$avatar.'" value="'.$item['id'].'">'.$item['name'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="startDate">Từ ngày</label>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                data-feather='calendar'></i></span>
                                                </div>
                                                    <input type="text" class="form-control work-due-date" id="startDate"
                                                       name="startDate" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="endDate">Đến ngày</label>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                data-feather='calendar'></i></span>
                                                </div>
                                                <input type="text" class="form-control work-due-date" id="endDate"
                                                       name="endDate" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="work">Ngày công</label>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i data-feather='bookmark'></i>
                                                    </span>
                                                </div>
                                                <input type="number" class="form-control" id="work"
                                                       name="work" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-sm-row flex-column mt-2">
                                    <button type="button" onclick="save()"
                                            class="btn btn-add btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">
                                        Cập nhật
                                    </button>
                                    <!--                                                    <button type="button" onclick="saveGroupRole()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>-->
                                    <button type="reset" class="btn btn-outline-secondary"
                                            data-dismiss="modal">Bỏ qua
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
<script>
    let month = "<?= date('m') ?>";
    let year = "<?= date('Y') ?>";
</script>
<script src="<?= HOME ?>/js/timesheets.js"></script>