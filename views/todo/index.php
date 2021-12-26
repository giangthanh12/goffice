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
                            <div class="list-group list-group-filters">
                                <div class="form-group position-relative" style="margin-top:20px">
                                    <select class="select2 form-control" id="nhanvien" name="task-assigned"></select>
                                </div>
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action active">
                                    <i data-feather="mail" class="font-medium-3 mr-50"></i>
                                    <span class="align-middle"> My Task</span>
                                </a>
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                    <i data-feather="star" class="font-medium-3 mr-50"></i> <span class="align-middle">Important</span>
                                </a>
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                    <i data-feather="check" class="font-medium-3 mr-50"></i> <span class="align-middle">Completed</span>
                                </a>
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                    <i data-feather="trash" class="font-medium-3 mr-50"></i> <span class="align-middle">Deleted</span>
                                </a>
                            </div>
                            <div class="add-task">
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#new-task-modal">
                                    Giao việc
                                </button>
                            </div>
                            <div class=" px-2 d-flex justify-content-between">
                                <h6 class="section-label mb-1">Ghi chú</h6>
                                <i data-feather="plus" class="cursor-pointer"></i>
                            </div>
                            <div class="list-group list-group-labels">
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <span class="bullet bullet-sm bullet-danger mr-1"></span>Cần gấp
                                </a>
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <span class="bullet bullet-sm bullet-warning mr-1"></span>Ưu tiên
                                </a>
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <span class="bullet bullet-sm bullet-primary mr-1"></span>Trễ deadline
                                </a>
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <span class="bullet bullet-sm bullet-success mr-1"></span>Đang làm
                                </a>
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <span class="bullet bullet-sm bullet-info mr-1"></span>Kế hoạch
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
                                        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="todo-search" placeholder="Search task" aria-label="Search..." aria-describedby="todo-search" />
                                </div>
                            </div>
                            <div class="dropdown">
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
                                <form id="form-modal-todo" class="todo-modal needs-validation" novalidate onsubmit="return false">
                                    <div class="modal-header align-items-center mb-1">
                                        <h5 class="modal-title">Add Task</h5>
                                        <div class="todo-item-action d-flex align-items-center justify-content-between ml-auto">
                                            <span class="todo-item-favorite cursor-pointer mr-75"><i data-feather="star" class="font-medium-2"></i></span>
                                            <button type="button" class="close font-large-1 font-weight-normal py-0" data-dismiss="modal" aria-label="Close">
                                                ×
                                            </button>
                                        </div>
                                    </div>
                                    <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                        <div class="action-tags">
                                            <div class="form-group">
                                                <label for="todoTitleAdd" class="form-label">Công việc</label>
                                                <input type="text" id="todoTitleAdd" name="todoTitleAdd" class="new-todo-item-title form-control" placeholder="Title" />
                                                <input type="hidden" id="id" name="id">
                                            </div>
                                            <div class="form-group position-relative">
                                                <label for="task-assigned" class="form-label d-block">Giao cho</label>
                                                <select class="select2 form-control" id="task-assigned" name="task-assigned"></select>
                                            </div>
                                            <div class="form-group">
                                                <label for="task-due-date" class="form-label">Deadline</label>
                                                <input type="text" class="form-control task-due-date" id="task-due-date" name="task-due-date" />
                                            </div>
                                            <div class="form-group">
                                                <!-- <label for="task-tag" class="form-label d-block">Gắn nhãn</label> -->
                                                <!-- <select class="form-control task-tag" id="task-tag" name="task-tag" multiple="multiple">
                                                    <option value="Team">Team</option>
                                                    <option value="Low">Low</option>
                                                    <option value="Medium">Medium</option>
                                                    <option value="High">High</option>
                                                    <option value="Update">Update</option>
                                                </select> -->
                                                <div class="demo-inline-spacing">
                                                    <div class="custom-control custom-radio custom-control-info">
                                                        <input type="radio" id="customRadio1" name="customRadio" value="1" class="custom-control-input" checked="">
                                                        <label class="custom-control-label text-info" for="customRadio1">Bình thường</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-warning">
                                                        <input type="radio" id="customRadio2" name="customRadio" value="2" class="custom-control-input">
                                                        <label class="custom-control-label text-warning" for="customRadio2">Ưu tiên</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-danger">
                                                        <input type="radio" id="customRadio3" name="customRadio" value="3"class="custom-control-input"  >
                                                        <label class="custom-control-label text-danger" for="customRadio3">Cần gấp</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="attachments">File đính kèm</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="attachments" />
                                                    <label class="custom-file-label" for="attachments">Chọn file</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Yêu cầu/comment</label>
                                                <div id="task-desc" class="border-bottom-0" data-placeholder="Yêu cầu công việc/góp ý"></div>
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
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                            <button type="button" class="btn btn-outline-secondary" id="btn_boqua" data-dismiss="modal">Bỏ qua</button>
                                            <button type="button" class="btn btn-danger update-btn d-none" data-dismiss="modal" onclick="xoa()">Xóa</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Right Sidebar ends -->
                    <div class="modal modal-slide-in sidebar-comment-modal fade" id="comment-modal">
                        <div class="modal-dialog sidebar-lg">
                            <div class="modal-content p-0">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title">Comment</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="tab-content mt-2">
                                        <!-- <div class="tab-pane tab-pane-activity pb-1 fade" id="tab-activity" role="tabpanel"> -->
                                        <div class="form-group">
                                            <!-- <label class="form-label">Yêu cầu/comment</label> -->
                                            <div id="task-comm" class="border-bottom-0" data-placeholder="Comment"></div>
                                            <div class="d-flex justify-content-end comm-toolbar border-top-0">
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
                                            <div class="d-flex flex-wrap">
                                                <button class="btn btn-primary mr-1" data-dismiss="modal" id="update" onclick="adcomment()">Cập nhật</button>
                                                <button class="btn btn-outline-info" data-dismiss="modal" id="xoa">Bỏ qua</button>
                                            </div>
                                        </div>
                                        <div class="form-group" id="list-comment"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=HOME?>/js/todo.js"></script>
