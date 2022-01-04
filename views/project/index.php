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
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#new-task-modal">
                                    Thêm dự án
                                </button>
                            </div>
                            <div class="list-group list-group-filters">
                               
                              
                            </div>

                            <div class=" px-2 d-flex justify-content-between">
                                <h5 class="section-label mb-1">
                                    <span class="align-middle">Lọc</span>
                                </h5>
                            </div>
                            <div class="list-group list-group-labels" style="padding: 0 21px;">
                                
                              
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
                                                <label for="todoTitleAdd" class="form-label">Tên dự án</label>
                                                <input type="text"  id="name" name="name" class="new-todo-item-title form-control" placeholder="Title" />
                                                <input type="hidden" id="id" name="id">
                                            </div>

                                            <div class="form-group position-relative">
                                                <label for="task-assigned" class="form-label d-block">Giao cho</label>
                                                <select class="select2 form-control" id="task-assigned" name="task-assigned"></select>
                                            </div>
                                            <div class="form-group">
                                                <label for="process" class="form-label">Tiến độ(%)</label>
                                                <input type="text"  id="process" name="process" class="process form-control" />
                                               
                                            </div>

                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="level">Cấp độ</label>
                                                    <select id="level" class="form-control form-control-lg" name="level">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="task-due-date" class="form-label">Deadline</label>
                                                <input type="text" class="form-control task-due-date" id="task-due-date" name="task-due-date" />
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Mô tả dự án</label>
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
                                        <div class="form-group position-relative">
                                            <label for="status" class="form-label d-block">Trạng thái</label>
                                            
                                            <select class="form-control form-control-lg" id="status" name="status">
                                            
                                            </select>
                                        </div>
                                        <div class="form-group my-1">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                            <button type="button" class="btn btn-outline-secondary" id="btn_boqua" data-dismiss="modal">Bỏ qua</button>
                                            <button type="button" class="btn btn-danger update-btn d-none" data-dismiss="modal" onclick="del()">Xóa</button>
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
<script src="<?= HOME ?>/js/project.js"></script>