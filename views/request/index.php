<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-todo.css">
<!-- BEGIN: Content-->
<div class="app-content content todo-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="float-left mb-0">
                        Quản lý yêu cầu <img src="<?= HOME ?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng ..." data-trigger="click">
                    </h2>
                    <div class="breadcrumb-wrapper d-none">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= HOME ?>">Trang chủ</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <a class="btn-icon btn btn-primary btn-round btn-sm" href="<?= HOME ?>/request/kanbanview" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="align-center"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-area-wrapper container-xxl p-0">
        <div class="sidebar-left">
            <div class="sidebar">
                <div class="sidebar-content todo-sidebar">
                    <div class="todo-app-menu">
                        <div class="add-task">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#new-task-modal">
                                Tạo yêu cầu
                            </button>
                        </div>
                        <div class="sidebar-menu-list">
                            <div class="list-group list-group-filters">
                                <a href="javascript:void(0)" onclick="chooseStatus(1)" class="list-group-item list-group-item-action ">
                                    <i data-feather="play" class="font-medium-3 mr-50"></i>
                                    <span class="align-middle">Đang duyệt</span>
                                </a>
                                <a href="javascript:void(0)" onclick="chooseStatus(2)" class="list-group-item list-group-item-action">
                                    <i data-feather="check" class="font-medium-3 mr-50"></i> <span class="align-middle">Hoàn thành</span>
                                </a>
                                <a href="javascript:void(0)" onclick="chooseStatus(3)" class="list-group-item list-group-item-action">
                                    <i data-feather="x" class="font-medium-3 mr-50"></i> <span class="align-middle">Từ chối</span>
                                </a>
                            </div>
                            <div class="mt-3 px-2 d-flex justify-content-between">
                                <h6 class="section-label mb-1">Đề xuất/Yêu cầu</h6>
                                <!--                                <i data-feather="plus" class="cursor-pointer"></i>-->
                            </div>
                            <div class="list-group list-group-labels">
                                <?php
                                foreach ($this->requestDefines as $define) {
                                ?>
                                    <a href="javascript:void(0)" onclick="chooseRequest(<?= $define['id'] ?>)" class="list-group-item chooseRequest-item list-group-item-action d-flex align-items-center">
                                        <span class="bullet bullet-sm bullet-primary mr-1"></span><?= $define['name'] ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="content-right">
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="body-content-overlay"></div>
                    <div class="todo-app-list">
                        <!-- Todo search starts -->
                        <div class="app-fixed-search d-flex align-items-center">
                            <div class="sidebar-toggle d-block d-lg-none ml-1">
                                <i data-feather="menu" class="font-medium-5"></i>
                            </div>
                            <div class="d-flex align-content-center justify-content-between w-100">
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="todo-search" placeholder="Tìm kiếm" aria-label="Search..." aria-describedby="todo-search" />
                                </div>
                            </div>
                            <div class="dropdown d-none">
                                <a href="javascript:void(0);" class="dropdown-toggle hide-arrow mr-1" id="todoActions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="more-vertical" class="font-medium-2 text-body"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="todoActions">
                                    <a class="dropdown-item sort-asc" href="javascript:void(0)">Sort A - Z</a>
                                    <a class="dropdown-item sort-desc" href="javascript:void(0)">Sort Z - A</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Sort Assignee</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Sort Due Date</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Sort Today</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Sort 1 Week</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Sort 1 Month</a>
                                </div>
                            </div>
                        </div>
                        <!-- Todo search ends -->

                        <!-- Todo List starts -->
                        <div class="todo-task-list-wrapper list-group">
                            <ul class="todo-task-list media-list" id="todo-task-list">
                                <li class="todo-item">
                                    <div class="todo-title-wrapper">
                                        <div class="todo-title-area">
                                            <i data-feather="more-vertical" class="drag-icon"></i>
                                            <div class="title-wrapper">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1" />
                                                    <label class="custom-control-label" for="customCheck1"></label>
                                                </div>
                                                <span class="todo-title">Fix Responsiveness for new structure 💻</span>
                                            </div>
                                        </div>
                                        <div class="todo-item-action">
                                            <div class="badge-wrapper mr-1">
                                                <div class="badge badge-pill badge-light-primary">Team</div>
                                            </div>
                                            <small class="text-nowrap text-muted mr-1">Aug 08</small>
                                            <div class="avatar">
                                                <img src="../../../app-assets/images/portrait/small/avatar-s-4.jpg" alt="user-avatar" height="32" width="32" />
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="todo-item completed">
                                    <div class="todo-title-wrapper">
                                        <div class="todo-title-area">
                                            <i data-feather="more-vertical" class="drag-icon"></i>
                                            <div class="title-wrapper">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck4" checked />
                                                    <label class="custom-control-label" for="customCheck4"></label>
                                                </div>
                                                <span class="todo-title">Skype Tommy for project status & report</span>
                                            </div>
                                        </div>
                                        <div class="todo-item-action">
                                            <div class="badge-wrapper mr-1">
                                                <div class="badge badge-pill badge-light-danger">High</div>
                                            </div>
                                            <small class="text-nowrap text-muted mr-1">Aug 18</small>
                                            <div class="avatar">
                                                <img src="../../../app-assets/images/portrait/small/avatar-s-8.jpg" alt="user-avatar" height="32" width="32" />
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="no-results">
                                <h5>Không có bản ghi nào</h5>
                            </div>
                        </div>
                        <!-- Todo List ends -->
                    </div>

                    <!-- Right Sidebar starts -->
                    <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-task-modal">
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
                                        <div class="tab-pane tab-pane-update fade show active" id="tab-update" role="tabpanel">
                                            <form id="fmInfo">
                                                <input type="hidden" name="requestId" id="requestId" value="">
                                                <input type="hidden" name="stepId" id="stepId" value="">

                                                <div class="form-group">
                                                    <label class="form-label" for="department">Yêu cầu<span style="color:red;">*</span></label>
                                                    <select class="form-control" id="defineId" name="defineId" required>
                                                        <!-- <option value="">&nbsp;</option> -->
                                                        <?php
                                                        foreach ($this->requestDefines as $item) {
                                                        ?>
                                                            <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="title">Tiêu đề<span style="color:red;">*</span></label>
                                                    <input type="text" id="title" name="title" class="form-control" required />
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="dateTime">Ngày tạo</label>
                                                    <input type="text" id="dateTime" name="dateTime" class="form-control task-due-date" required />
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="department">Phòng ban</label>
                                                    <select class="select2 select2-label form-control" id="department" name="department">
                                                        <!-- <option value="">&nbsp;</option> -->
                                                        <?php
                                                        foreach ($this->departments as $item) {
                                                        ?>
                                                            <option data-color="badge-light-success" value="<?= $item['id'] ?>"><?= $item['text'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <!-- <div class="form-group" id="processorLabel">
                                                <label class="form-label">Người duyệt</label>
                                                <ul class="pl-0" id="processor"></ul>
                                            </div>
                                            <div class="form-group d-none" id="refuserLabel">
                                                <label class="form-label">Người từ chối</label>
                                                <ul class="pl-0" id="refuser"></ul>
                                            </div> -->
                                                <div class="form-group">
                                                    <label class="form-label" for="staffId">Người tạo</label>
                                                    <select class="select2 select2-label form-control" id="staffId" name="staffId" required>
                                                        <!-- <option value="">&nbsp;</option> -->
                                                        <?php
                                                        foreach ($this->staffs as $item) {
                                                        ?>
                                                            <option data-avatar="<?= $item['avatar'] ?>" value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane tab-pane-activity pb-1 fade" id="tab-activity" role="tabpanel">
                                            <form id="fmProperties">
                                                <div class="form-group">
                                                    <label class="form-label" for="property_1">Tên thuộc tính</label>
                                                    <input type="text" id="property_1" name="property_1" class="form-control" placeholder="Tên thuộc tính" />
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane tab-pane-comments pb-1 fade" id="tab-comments" role="tabpanel">
                                            <div class="media mb-1">
                                                <!-- <div class="avatar bg-light-success my-0 ml-0 mr-50">
                                                <span class="avatar-content">HJ</span>
                                            </div>
                                            <div class="media-body">
                                                <p class="mb-0"><span class="font-weight-bold">Jordan</span> Left the board.</p>
                                                <small class="text-muted">Today 11:00 AM</small>
                                            </div> -->

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
                    <!-- Right Sidebar ends -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN: Page JS-->
<script>
    var funEdit = '<?= $this->funEdit ?>',
        funApprove = '<?= $this->funApprove ?>',
        funRefuse = '<?= $this->funRefuse ?>',
        funDel = '<?= $this->funDel ?>',
        funAdd = '<?= $this->funAdd ?>';
</script>
<script src="<?= HOME ?>/js/request-list.js"></script>
<style>
    .colorDefine {
        color: rgb(115, 103, 240);
    }
</style>