<!-- BEGIN: Content-->
<div class="app-content content kanban-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="float-left mb-0">Đề xuất/Yêu cầu</h2>
                        <div class="breadcrumb-wrapper d-none">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=HOME?>">Trang chủ</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    <div class="dropdown">
                        <a class="btn-icon btn btn-primary btn-round btn-sm" href="<?=HOME?>/request" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="grid"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Kanban starts -->
            <div class="row">
                <div class="pt-1 pb-1 col-md-3">
                        <select class="select2 select2-label form-control" id="defineId" name="defineId">
                            <option value="">&nbsp;</option>
                            <?php
                            foreach ($this->requests as $key=>$item) {
                                if($key==0)
                                    $selected = "selected";
                                else
                                    $selected = "";
                                ?>
                                <option data-color="badge-light-success"
                                        value="<?= $item['id'] ?>" <?=$selected?> ><?= $item['name'] ?></option>
                            <?php } ?>
                        </select>
                </div>
                <div class="d-flex mx-25 row pt-1 pb-1">
                    <div class="position-relative mx-75">
                        <button type="button" class="btn btn-primary <?=$this->funAdd!=1?'d-none':''?>" id="addNewButon">Tạo yêu cầu</button>
                    </div>
                </div>
            </div>
            <section class="app-kanban-wrapper">
                <!--                <div class="row">-->
                <!--                    <div class="col-12">-->
                <!--                        <form class="add-new-board">-->
                <!--                            <label class="add-new-btn mb-2" for="add-new-board-input">-->
                <!--                                <i class="align-middle" data-feather="plus"></i>-->
                <!--                                <span class="align-middle">Add new</span>-->
                <!--                            </label>-->
                <!--                            <input type="text" class="form-control add-new-board-input mb-50" placeholder="Add Board Title" id="add-new-board-input" required />-->
                <!--                            <div class="form-group add-new-board-input">-->
                <!--                                <button class="btn btn-primary btn-sm mr-75">Add</button>-->
                <!--                                <button type="button" class="btn btn-outline-secondary btn-sm cancel-add-new">Cancel</button>-->
                <!--                            </div>-->
                <!--                        </form>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!-- Kanban content starts -->
                <div class="kanban-wrapper"></div>
                <!-- Kanban content ends -->
                <!-- Kanban Sidebar starts -->
                <div class="modal modal-slide-in update-item-sidebar fade">
                    <div class="modal-dialog sidebar-lg">
                        <div class="modal-content p-0">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                            <div class="modal-header mb-1">
                                <h5 class="modal-title" id="modalTitle">Tạo yêu cầu</h5>
                            </div>
                            <div class="modal-body flex-grow-1">
                                <ul class="nav nav-tabs tabs-line">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-update active" data-toggle="tab" href="#tab-update">
                                            <i data-feather="edit"></i>
                                            <span class="align-middle">Thông tin</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-activity" data-toggle="tab" href="#tab-activity">
                                            <i data-feather="activity"></i>
                                            <span class="align-middle">Chi tiết</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-comments" data-toggle="tab" href="#tab-comments">
                                            <i data-feather="message-square"></i>
                                            <span class="align-middle">Phản hồi</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-2">
                                    <div class="tab-pane tab-pane-update fade show active" id="tab-update"
                                         role="tabpanel">
                                        <form id="fmInfo">
                                            <div class="form-group">
                                                <label class="form-label" for="title">Tiêu đề</label>
                                                <input type="text" id="title" name="title" class="form-control"
                                                       placeholder="Enter Title" required/>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="dateTime">Ngày tạo</label>
                                                <input type="text" id="dateTime" name="dateTime" class="form-control" readonly required/>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="department">Phòng ban</label>
                                                <select class="select2 select2-label form-control" id="department"
                                                        name="department">
                                                    <option value="">&nbsp;</option>
                                                    <?php
                                                    foreach ($this->departments as $item) {
                                                        ?>
                                                        <option data-color="badge-light-success"
                                                                value="<?= $item['id'] ?>"><?= $item['text'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group" id="processorLabel">
                                                <label class="form-label">Người duyệt</label>
                                                <ul class="pl-0" id="processor"></ul>
                                            </div>
                                            <div class="form-group d-none" id="refuserLabel">
                                                <label class="form-label">Người từ chối</label>
                                                <ul class="pl-0" id="refuser"></ul>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="staffId">Người tạo</label>
                                                <select class="select2 select2-label form-control" id="staffId"
                                                        name="staffId" required>
                                                    <option value="">&nbsp;</option>
                                                    <?php
                                                    foreach ($this->staffs as $item) {
                                                        ?>
                                                        <option data-avatar="<?= $item['avatar'] ?>"
                                                                value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane tab-pane-activity pb-1 fade" id="tab-activity" role="tabpanel">
                                        <form id="fmProperties">
                                            <div class="form-group">
                                                <label class="form-label" for="property_1">Tên thuộc tính</label>
                                                <input type="text" id="property_1" name="property_1"
                                                       class="form-control" placeholder="Tên thuộc tính"/>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane tab-pane-comments pb-1 fade" id="tab-comments" role="tabpanel">
                                        <div class="media mb-1">
                                        <section class="basic-timeline" style="width:100%;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="timeline" id="timelineComment">
                             
                                    </ul>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <div class="d-flex flex-wrap">
                                        <button class="btn btn-primary mr-1" style="margin-bottom: 15px;" id="btnUpdate">Cập nhật
                                        </button>
                                        <button type="button" class="btn btn-success mr-1 d-none " style="margin-bottom: 15px;" id="btnApprove" onclick="">Duyệt
                                        </button>
                                        <button type="button" class="btn btn-outline-danger d-none" style="margin-bottom: 15px;" id="btnRefuse">Từ chối
                                        </button>
                                        <button type="button" class="btn btn-danger mr-1 d-none" style="margin-bottom: 15px;" id="btnDel">Xóa
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Kanban Sidebar ends -->
            </section>
            <!-- Kanban ends -->

        </div>
    </div>
</div>
<!-- END: Content-->
<script>
    var funEdit = '<?=$this->funEdit?>',
        funApprove = '<?=$this->funApprove?>',
        funRefuse = '<?=$this->funRefuse?>',
        funDel = '<?=$this->funDel?>',
        funAdd = '<?=$this->funAdd?>';
</script>
<script src="<?= HOME ?>/js/request-kanban.js"></script>