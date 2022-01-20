<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-todo.css">
<div class="app-content content todo-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-area-wrapper container-xxl p-0">
        <div class="sidebar-left">
            <div class="sidebar">
                <div class="sidebar-content todo-sidebar">
                    <div class="todo-app-menu">
                        <div class="sidebar-menu-list">
                            <div class="add-task">
                                <?php if(functions::checkFuns($this->funs,'add')) { ?>
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                    data-target="#new-task-modal">
                                    Tạo đơn nghỉ phép
                                </button>
                                <?php } ?>
                            </div>
                            <div class="list-group list-group-filters">
                                <a href="javascript:void(0)" onclick="loadTaskList(1)"
                                    class="list-group-item list-group-item-action active">
                                    <i data-feather="mail" class="font-medium-3 mr-50"></i>
                                    <span class="align-middle">Đang chờ duyệt</span>
                                </a>
                                <a href="javascript:void(0)" onclick="loadTaskList(2)"
                                    class="list-group-item list-group-item-action">
                                    <i data-feather="check" class="font-medium-3 mr-50"></i> <span
                                        class="align-middle">Đã duyệt</span>
                                </a>
                                <a href="javascript:void(0)" onclick="loadTaskList(0)"
                                    class="list-group-item list-group-item-action">
                                    <i data-feather="alert-circle" class="font-medium-3 mr-50"></i> <span
                                        class="align-middle">Từ chối</span>
                                </a>
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
                                        <span class="input-group-text"><i data-feather="search"
                                                class="text-muted"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="todo-search" placeholder="Tìm kiếm"
                                        aria-label="Search..." aria-describedby="todo-search" />
                                </div>
                            </div>

                        </div>
                        <!-- Todo search ends -->

                        <!-- Todo List starts -->
                        <div class="todo-task-list-wrapper list-group">
                            <ul class="todo-task-list media-list" id="todo-task-list">
                                <?php
                                foreach ($this->list as $item) {
                                    $color = '';
                                    if ($item['avatar'] != '')
                                        $avatar = URLFILE . '/' . $item['avatar'];
                                    else
                                        $avatar = HOME . '/layouts/useravatar.png';

                                    if ($item['status'] == 1) {
                                        $item['status'] = "Đang chờ duyệt";
                                        $color = '#7367F0';
                                    } else if ($item['status'] == 2) {
                                        $item['status'] = "Đã duyệt";
                                        $color = '#28C76F';
                                    } else if ($item['status'] == 0 ) {
                                        $item['status'] = "Từ chối";
                                        $color = '#FF4500';
                                    }
                                    echo '
                                    <li class="todo-item" data-id="' . $item['id'] . '">
                                        <div class="todo-title-wrapper">                                            
                                            <div class="todo-title-area">
                                                <span><img style="border-radius: 50%;" onerror=this.src="https://velo.vn/goffice-test/layouts/useravatar.png" src="' . $avatar . '" height="32" width="32"/></span>
                                                <span class="taskId d-none" name="id" >' . $item['id'] . '</span>
                                                <i data-feather="more-vertical" class="drag-icon"></i>
                                                <div class="title-wrapper">
                                                    <span class="todo-title" data-staff="' . $item['staffId'] . '">' . $item['staffName'] . '</span>
                                                </div>
                                            </div>
                                            <div class="todo-item-action">
                                                <span class="taskStatus d-none">' . $item['type'] . '</span>
                                                <span class="taskDescription" style="padding-right:2rem;">' . $item['description'] . '</span>
                                                <div class="badge-wrapper mr-1">
                                                   <div class="badge" style="width: 120px; margin-right: 0.5rem; background-color: rgb(247, 244, 244); color: ' . $color . '">' . $item['status'] . '</div>
                                                </div>
                                                <small class="text-nowrap text-muted mr-1">' . date("d/m/Y", strtotime($item['fromDate'])) . '</small>
                                            </div>            
                                        </div>
                                    </li>
                                    ';
                                }
                                ?>
                            </ul>
                            <div class="no-results">
                                <h5>No Items Found</h5>
                            </div>
                        </div>
                        <!-- Todo List ends -->
                    </div>

                    <!-- Right Sidebar starts -->
                    <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-task-modal">
                        <div class="modal-dialog sidebar-lg">
                            <div class="modal-content p-0">
                                <form id="form-modal-todo" class="todo-modal needs-validation" novalidate
                                    onsubmit="return false">
                                    <div class="modal-header align-items-center mb-1">
                                        <h5 class="modal-title">Tạo đơn xin nghỉ phép</h5>
                                        <div
                                            class="todo-item-action d-flex align-items-center justify-content-between ml-auto">
                                            <button type="button" class="close font-large-1 font-weight-normal py-0"
                                                data-dismiss="modal" aria-label="Close">
                                                ×
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                        <div class="action-tags">
                                            <div class="form-group">
                                                <label for="staffId">Tên nhân viên</label>
                                                <select class="select2 form-control" id="staffId" name="staffId">
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="type">Loại đơn</label>
                                                <select class="select2 form-control" id="type" name="type">
                                                    <option value="1">Nghỉ phép</option>
                                                    <option value="2">Công tác</option>
                                                    <option value="3">Nghỉ khác</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Lý do xin nghỉ phép</label>
                                                <div id="task-desc" class="border-bottom-0" data-placeholder=""></div>
                                                <div class="d-flex justify-content-end desc-toolbar border-top-0">
                                                    <span class="ql-formats mr-0">
                                                        <button class="ql-bold"></button>
                                                        <button class="ql-italic"></button>
                                                        <button class="ql-underline"></button>
                                                        <button class="ql-align"></button>
                                                        <button class="ql-link"></button>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="task-due-date" class="form-label">Ngày nghỉ</label>
                                                <input type="date" class="form-control task-due-date" id="task-due-date"
                                                    name="task-due-date" />
                                            </div>

                                            <div class="form-group">
                                                <label for="shift">Ca làm</label>
                                                <select class="select2 form-control" id="shift" name="shift">
                                                    <option value="1">Ca Sáng</option>
                                                    <option value="2">Ca Chiều</option>
                                                    <option value="3">Cả ngày</option>
                                                </select>
                                            </div>

                                            <div class="row" id="onLeave">
                                                <div class="col">
                                                    <label for="onLeaveOwn">Số ngày được nghỉ</label>
                                                    <input type="text" id="onLeaveOwn" name="onLeaveOwn" class="form-control" placeholder="Số ngày được nghỉe" disabled>
                                                </div>
                                                <div class="col">
                                                    <label for="onLeaveUsed">Số ngày đã nghỉ</label>
                                                    <input type="text" id="onLeaveUsed" name="onLeaveUsed" class="form-control" placeholder="Số ngày đã nghỉ" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group my-1">
                                                <button type="submit" style="display:none;" id="updateProject"
                                                    class="btn btn-primary">Duyệt</button>
                                                <?php if(functions::checkFuns($this->funs, 'del')) { ?>
                                                <button type="button" class="btn btn-danger update-btn d-none"
                                                    data-dismiss="modal" id="delProject" onclick="del()">Từ chối</button>
                                                <?php } ?>
                                                <button type="button" class="btn btn-outline-secondary" id="btn_boqua"
                                                    data-dismiss="modal">Bỏ qua</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Right Sidebar ends -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var userFuns = JSON.parse('<?=json_encode($this->funs)?>');
console.log(userFuns);
</script>

<script src="<?= HOME ?>/js/onleave.js"></script>s