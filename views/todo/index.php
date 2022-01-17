<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-todo.css">
<div class="app-content content todo-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-area-wrapper container-xxl p-0">
        <div class="sidebar-left">
            <div class="sidebar">
                <div class="sidebar-content todo-sidebar">
                    <div class="todo-app-menu">
                        <?php
                        if ($this->funAdd == 1) {

                            ?>
                            <div class="add-task">
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                        data-target="#new-task-modal">
                                    Thêm công việc
                                </button>
                            </div>
                            <?php
                        } ?>
                        <div class="sidebar-menu-list">
                            <div class="list-group list-group-filters">
                                <a href="javascript:void(0)" onclick="listMyTask()"
                                   class="list-group-item list-group-item-action active">
                                    <i data-feather="mail" class="font-medium-3 mr-50"></i>
                                    <span class="align-middle"> Công việc của tôi</span>
                                </a>
                                <a href="javascript:void(0)" onclick="listDeadline()"
                                   class="list-group-item list-group-item-action">
                                    <i data-feather="star" class="font-medium-3 mr-50"></i> <span class="align-middle">Trễ hạn</span>
                                </a>
                                <a href="javascript:void(0)" onclick="listStatus(6)"
                                   class="list-group-item list-group-item-action">
                                    <i data-feather="check" class="font-medium-3 mr-50"></i> <span class="align-middle">Đã hoàn thành</span>
                                </a>
                                <a href="javascript:void(0)" onclick="listStatus(0)"
                                   class="list-group-item list-group-item-action d-none">
                                    <i data-feather="trash" class="font-medium-3 mr-50"></i> <span class="align-middle">Đã xóa</span>
                                </a>
                            </div>
                            <div class="mt-3 px-2 d-flex justify-content-between">
                                <h6 class="section-label mb-1">Việc theo dự án</h6>
                                <!--                                <i data-feather="plus" class="cursor-pointer"></i>-->
                            </div>
                            <div class="list-group list-group-labels" id="list_project">
                                <input type="hidden" id="projectId"/>
                                <a href="javascript:void(0)" onclick="listTaskPro(-1)"
                                   class="list-group-item list-group-item-action d-flex align-items-center">
                                    <span class="bullet bullet-sm mr-1" style="background: #00ff00"></span>Toàn bộ</a>
                                <a href="javascript:void(0)" onclick="listTaskPro(0)"
                                   class="list-group-item list-group-item-action d-flex align-items-center">
                                    <span class="bullet bullet-sm mr-1" style="background: #0c0c0c"></span>Công việc cá
                                    nhân</a>
                                <?php
                                foreach ($this->project as $item)
                                    echo '
                                      <a href="javascript:void(0)" onclick="listTaskPro(' . $item['id'] . ')" class="list-group-item list-group-item-action d-flex align-items-center">
                                          <span class="bullet bullet-sm mr-1" style="background: ' . $item['color'] . '"></span>' . $item['name'] . '</a>
                                      ';
                                ?>
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
                                    <input type="text" class="form-control" id="todo-search" placeholder="Tìm kiếm công việc"
                                           aria-label="Search..." aria-describedby="todo-search"/>
                                </div>
                            </div>
                            <div class="dropdown">
                                <!-- <input type="hidden" id="assigneeId" /> -->
                                <select class="select2 form-control" id="task-assigned-list"
                                        onchange="listOtherTask(this.value)">
                                    <?php
                                    foreach ($this->employee as $item) {
                                        if ($item['avatar'] != '')
                                            $avatar = URLFILE . '/uploads/nhanvien/' . $item['avatar'];
                                        else
                                            $avatar = HOME . '/layouts/useravatar.png';
                                        echo '<option data-img="' . $avatar . '" value="' . $item['id'] . '" >' . $item['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- Todo search ends -->

                        <!-- Todo List starts -->
                        <div class="todo-task-list-wrapper list-group" id="my-task-list">
                            <ul class="todo-task-list media-list" id="todo-task-list">
                                <?php
                                foreach ($this->list as $item) {
                                    if ($item['avatar'] != '')
                                        $avatar = URLFILE . '/uploads/nhanvien/' . $item['avatar'];
                                    else
                                        $avatar = HOME . '/layouts/useravatar.png';
                                    $checked = ($item['status'] == 4) ? 'checked="true"' : '';
                                    $dnone = (($item['status'] == 6) || ($item['status'] == 0)) ? 'd-none' : '';
                                    echo '
                                    <li class="todo-item">
                                        <div class="todo-title-wrapper">
                                            <div class="todo-title-area">
                                                <span class="taskId d-none">' . $item['id'] . '</span>
                                                <i data-feather="more-vertical" class="drag-icon"></i>
                                                <div class="title-wrapper">
                                                    <div class="custom-control custom-checkbox ' . $dnone . '">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck' . $item['id'] . '" ' . $checked . '/>
                                                        <label class="custom-control-label" for="customCheck' . $item['id'] . '"></label>
                                                    </div>
                                                    <span class="todo-title">' . $item['title'] . '</span>
                                                </div>
                                            </div>
                                            <div class="todo-item-action">
                                                <div class="badge-wrapper mr-1">
                                                   <div class="badge" data-id="' . $item['label'] . '" style="width: 100px; margin-right: 0.5rem; background-color: rgb(247, 244, 244); color: ' . $item['labelColor'] . '">' . $item['labelText'] . '</div>
                                                </div>
                                                <small class="text-nowrap text-muted mr-1">' . date("d/m/Y", strtotime($item['deadline'])) . '</small>
                                                <div class="avatar" data-id="' . $item['assigneeId'] . '">
                                                    <img onerror="this.src=\'' . HOME . '/layouts/useravatar.png\'" src="' . $avatar . '" alt="user-avatar" height="32" width="32" />
                                                </div>
                                                <span class="taskDescription d-none">' . $item['description'] . '</span>
                                                <span class="taskProject d-none">' . $item['projectId'] . '</span>
                                                <span class="taskStatus d-none">' . $item['status'] . '</span>
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
                    </div>

                    <!-- Right Sidebar starts -->
                    <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-task-modal">
                        <div class="modal-dialog sidebar-lg">
                            <div class="modal-content p-0">
                                <form id="form-modal-todo" class="todo-modal needs-validation" novalidate
                                      onsubmit="return false">
                                    <div class="modal-header align-items-center mb-1">
                                        <h5 class="modal-title">Thêm công việc</h5>
                                        <div class="todo-item-action d-flex align-items-center justify-content-between ml-auto">
                                            <!-- <span class="todo-item-favorite cursor-pointer mr-75"><i data-feather="star" class="font-medium-2"></i></span> -->
                                            <button type="button" class="close font-large-1 font-weight-normal py-0"
                                                    data-dismiss="modal" aria-label="Close">
                                                ×
                                            </button>
                                        </div>
                                    </div>
                                    <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                        <div class="action-tags">
                                            <div class="form-group">
                                                <input type="hidden" id="taskId" name="taskId"/>
                                                <label for="todoTitleAdd" class="form-label">Công việc</label>
                                                <input type="text" id="todoTitleAdd" name="todoTitleAdd"
                                                       class="new-todo-item-title form-control" placeholder="Tên công việc"/>
                                            </div>
                                            <div class="form-group position-relative">
                                                <label for="task-assigned" class="form-label d-block">Thuộc dự án/nhóm
                                                    công việc</label>
                                                <select class="select2 form-control" id="onProject" name="onProject">
                                                    <option value="0" selected>Công việc cá nhân</option>
                                                    <?php
                                                    foreach ($this->project as $item)
                                                        echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group position-relative">
                                                <label for="task-assigned" class="form-label d-block">Người thực
                                                    hiện</label>
                                                <select class="select2 form-control" id="task-assigned"
                                                        name="task-assigned">
                                                    <?php
                                                    foreach ($this->employee as $item) {
                                                        if ($item['avatar'] != '')
                                                            $avatar = URLFILE . '/uploads/nhanvien/' . $item['avatar'];
                                                        else
                                                            $avatar = HOME . '/layouts/useravatar.png';
                                                        echo '<option data-img="' . $avatar . '" value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="task-due-date" class="form-label">Hạn hoàn thành</label>
                                                <input type="text" class="form-control task-due-date" id="task-due-date"
                                                       name="task-due-date"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="task-tag" class="form-label d-block">Nhãn</label>
                                                <!-- <select class="form-control task-tag" id="task-tag" name="task-tag" multiple="multiple"> -->
                                                <select class="form-control task-tag" id="task-tag" name="task-tag">
                                                    <?php foreach ($this->tag as $item)
                                                        echo '<option data-color="' . $item['color'] . '" value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Yêu cầu</label>
                                                <div id="task-desc" class="border-bottom-0"
                                                     data-placeholder="Mô tả chi tiết công việc"></div>
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
                                        </div>
                                        <div class="form-group my-1">
                                            <?php
                                            if ($this->funAdd) {
                                                ?>
                                                <button type="submit" class="btn btn-primary d-none add-todo-item mr-1">
                                                    Thêm
                                                </button>
                                            <?php } ?>
                                            <?php
                                            if ($this->funEdit) {
                                                ?>
                                                <button type="button"
                                                        class="btn btn-primary d-none update-btn update-todo-item mr-1">
                                                    Cập nhật
                                                </button>
                                            <?php }
                                            if ($this->funDel) { ?>
                                                <button type="button" onclick="deleteTask()"
                                                        class="btn btn-outline-danger update-btn d-none">
                                                    Xóa
                                                </button>
                                            <?php } ?>
                                            <button type="button" class="btn btn-outline-secondary cancel-todo-item"
                                                    data-dismiss="modal">
                                                Hủy
                                            </button>
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
<script type="text/javascript">
    var funAdd = <?=$this->funAdd?>,
        funEdit = <?=$this->funEdit?>,
        funDel = <?=$this->funDel?>,
        staffId = '<?=$_SESSION['user']['staffId']?>',
        today = '<?= date('d/m/Y') ?>',
        proId = -1,
        taskStatus = '', deadline = 'false';
</script>
<script src="<?= HOME ?>/js/todo.js"></script>
