<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-todo.css">
<div class="app-content content todo-application">
    <div class="content-overlay"></div>
    <div class="content-header row">
        <div class="content-header-left container-xxl">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-2" id="title_module">
                        Công việc <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng giao việc và quản lý các đầu công việc khác nhau của từng nhân sự trong doanh nghiệp " data-trigger="click" >
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="header-navbar-shadow"></div>
    <div class="content-area-wrapper container-xxl p-0">
        <div class="sidebar-left">
            <div class="sidebar">
                <div class="sidebar-content todo-sidebar">
                    <div class="todo-app-menu">
                        <div class="add-task">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#new-task-modal">
                                Giao việc
                            </button>
                        </div>
                        <div class="sidebar-menu-list">
                            <div class="list-group list-group-filters">
                                <input type="hidden" id="catId" value="1">
                                <a href="javascript:void(0)" onclick="listMyTask(1)" class="list-group-item list-group-item-action active">
                                    <i data-feather="mail" class="font-medium-3 mr-50"></i>
                                    <span class="align-middle"> Việc đang làm</span>
                                </a>
                                <a href="javascript:void(0)" onclick="listMyTask(2)" class="list-group-item list-group-item-action">
                                    <i data-feather="star" class="font-medium-3 mr-50"></i> <span class="align-middle">Trễ deadline</span>
                                </a>
                                <a href="javascript:void(0)" onclick="listMyTask(3)" class="list-group-item list-group-item-action">
                                    <i data-feather="check" class="font-medium-3 mr-50"></i> <span class="align-middle">Đã hoàn thành</span>
                                </a>
                                <a href="javascript:void(0)" onclick="listMyTask(4)" class="list-group-item list-group-item-action">
                                    <i data-feather="trash" class="font-medium-3 mr-50"></i> <span class="align-middle">Đã xóa</span>
                                </a>
                            </div>
                            <!-- <div class="mt-3 px-2 d-flex justify-content-between">
                                <h6 class="section-label mb-1">Việc theo dự án</h6>
                                <i data-feather="plus" class="cursor-pointer"></i>
                            </div>
                            <div class="list-group list-group-labels">
                                <input type="hidden" id="projectId" />
                                <?php
                                // foreach ($this->project AS $item)
                                //     echo '
                                //     <a href="javascript:void(0)" onclick="listTaskPro('.$item['id'].')" class="list-group-item list-group-item-action d-flex align-items-center">
                                //         <span class="bullet bullet-sm bullet-primary mr-1"></span>'.$item['name'].'</a>
                                //     ';
                                ?>
                            </div> -->
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
                                    <input type="text" class="form-control" id="todo-search" placeholder="Tìm kiếm..." aria-label="Search..." aria-describedby="todo-search" />
                                </div>
                            </div>
                            <div class="dropdown">
                                <!-- <input type="hidden" id="assigneeId" /> -->
                                <select class="select2 form-control" id="task-assigned-list" onchange="listOtherTask(this.value)">
                                    <?php
                                    foreach ($this->employee as $item) {
                                        if ($item['avatar'] != '')
                                            $avatar = HOME . '/users/gemstech/uploads/nhanvien/' . $item['avatar'];
                                        else
                                            $avatar = HOME . '/users/gemstech/uploads/useravatar.png';
                                        echo '<option data-img="' . $avatar . '" value="' . $item['id'] . '">' . $item['text'] . '</option>';
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
                                        $avatar = HOME . '/users/gemstech/uploads/nhanvien/' . $item['avatar'];
                                    else
                                        $avatar = HOME . '/users/gemstech/uploads/useravatar.png';
                                    $checked = ($item['status'] == 4) ? 'checked="true"' : '';
                                    $dnone = (($item['status'] == 6) || ($item['status'] == 0)) ? 'd-none' : '';
                                    $color = 'primary';
                                    if ($item['label'] == 2) $color = 'info';
                                    elseif ($item['label'] == 3) $color = 'success';
                                    $addCalendar = '';
                                    if($item['addCalendar'] != 0) $addCalendar = 'checked';
                                    echo '
                                    <li class="todo-items">
                                        <div class="todo-title-wrapper todo-item pb-2">
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
                                                    <div class="badge badge-pill badge-light-' . $color . '" data-id="' . $item['label'] . '">' . $item['labelText'] . '</div>
                                                </div>
                                                <small class="text-nowrap text-muted mr-1">' . $item['deadlineFormat'] . '</small>
                                                <small class="d-none text-muted mr-1" id="deadline">' . $item['deadline'] . '</small>
                                                <div class="avatar" data-id="' . $item['assigneeId'] . '">
                                                    <img src="' . $avatar . '" ' . 'onerror=' . "this.src='https://velo.vn/goffice-test/layouts/useravatar.png'" . ' alt="user-avatar" height="32" width="32" />
                                                </div>
                                                <span class="taskDescription d-none">' . $item['description'] . '</span>
                                                <span class="taskProject d-none">' . $item['projectId'] . '</span>
                                                <span class="statusProject d-none">' . $item['status'] . '</span>
                                                
                                            </div>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input add-to-calendar" id="item-'.$item['id'].'"  data-id="'.$item['id'].'" '. $addCalendar .' />
                                            <label class="custom-control-label" for="item-'.$item['id'].'">Thêm vào lịch</label>
                                        </div>
                                    </li>
                                    ';
                                }
                                ?>
                            </ul>
                            <div class="no-results">
                                <h5>Không có kết quả tìm kiếm</h5>
                            </div>
                        </div>
                    </div>

                    <!-- Right Sidebar starts -->
                    <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-task-modal">
                        <div class="modal-dialog sidebar-lg">
                            <div class="modal-content p-0">
                                <form id="form-modal-todo" class="todo-modal needs-validation" novalidate onsubmit="return false">
                                    <div class="modal-header align-items-center mb-1">
                                        <h5 class="modal-title">Giao việc</h5>
                                        <div class="todo-item-action d-flex align-items-center justify-content-between ml-auto">
                                            <!-- <span class="todo-item-favorite cursor-pointer mr-75"><i data-feather="star" class="font-medium-2"></i></span> -->
                                            <button type="button" class="close font-large-1 font-weight-normal py-0" data-dismiss="modal" aria-label="Close">
                                                ×
                                            </button>
                                        </div>
                                    </div>
                                    <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                        <div class="action-tags">
                                            <div class="form-group">
                                                <input type="hidden" id="taskId" name="taskId" />
                                                <label for="todoTitleAdd" class="form-label">Tên công việc<span style="color:red;">*</span></label>
                                                <input type="text" id="todoTitleAdd" name="todoTitleAdd" class="new-todo-item-title form-control" />
                                            </div>
                                            <div class="form-group position-relative">
                                                <label for="task-assigned" class="form-label d-block">Thuộc dự án/nhóm công việc</label>
                                                <select class="select2 form-control" id="onProject" name="onProject">
                                                    <?php
                                                    foreach ($this->project as $item)
                                                        echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group position-relative">
                                                <label for="task-assigned" class="form-label d-block">Người thực hiện<span style="color:red;">*</span></label>
                                                <select class="select2 form-control" id="task-assigned" name="task-assigned">
                                                  
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="task-due-date" class="form-label">Hạn hoàn thành</label>
                                                <input type="text" class="form-control task-due-date" id="task-due-date" name="task-due-date" />
                                            </div>
                                            <div class="form-group">
                                                <label for="task-tag" class="form-label d-block">Nhãn</label>
                                                <!-- <select class="form-control task-tag" id="task-tag" name="task-tag" multiple="multiple"> -->
                                                <select class="form-control task-tag" id="task-tag" name="task-tag">
                                                    <?php foreach ($this->tag as $item)
                                                        echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Yêu cầu</label>
                                                <div id="task-desc" class="border-bottom-0" data-placeholder="Mô tả chi tiết công việc"></div>
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
                                            <button type="submit" class="btn btn-primary d-none add-todo-item mr-1">Thêm</button>
                                            <button type="button" class="btn btn-outline-secondary cancel-todo-item" data-dismiss="modal">
                                                Đóng
                                            </button>
                                            <button type="button" class="btn btn-primary d-none update-btn update-todo-item">Cập nhật</button>
                                            <button type="button" onclick="deleteTask()" class="btn btn-outline-danger update-btn d-none" data-dismiss="modal">Xóa</button>
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
<script src="<?= HOME ?>/js/todo.js"></script>