<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-file-manager.css">
<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/file-uploaders/dropzone.min.css">
<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/plugins/forms/form-file-uploader.css">


<div class="app-content content file-manager-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-area-wrapper container-xxl p-0">
        <div class="sidebar-left">
            <div class="sidebar">
                <div class="sidebar-file-manager">
                    <div class="sidebar-inner">
                        <div class="dropdown dropdown-actions">
                            <button class="btn btn-primary add-file-btn text-center btn-block" type="button" id="addNewFile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <span class="align-middle">Thêm mới</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="addNewFile">
                                <div class="dropdown-item" onclick="addfolder()">
                                    <div class="mb-0">
                                        <i data-feather="folder" class="mr-25"></i>
                                        <span class="align-middle">Thư mục</span>
                                    </div>
                                </div>
                                <div class="dropdown-item" onclick="uploadfiles()">
                                    <div class="mb-0" for="file-upload">
                                        <i data-feather="upload-cloud" class="mr-25"></i>
                                        <span class="align-middle">Tải file</span>
                                    </div>
                                </div>
                                <!-- <div class="dropdown-item">
                                    <div for="folder-upload" class="mb-0">
                                        <i data-feather="upload-cloud" class="mr-25"></i>
                                        <span class="align-middle">Tải tệp</span>
                                        <input type="file" id="folder-upload" webkitdirectory mozdirectory hidden />
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="sidebar-list">
                            <div class="list-group">
                                <!--<div class="my-drive"></div>-->
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action active">
                                    <i data-feather="star" class="mr-50 font-medium-3"></i>
                                    <span class="align-middle">Quan trọng</span>
                                </a>
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                    <i data-feather="clock" class="mr-50 font-medium-3"></i>
                                    <span class="align-middle">Gần đây</span>
                                </a>
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                    <i data-feather="trash" class="mr-50 font-medium-3"></i>
                                    <span class="align-middle">Tệp đã xóa</span>
                                </a>
                            </div>
                            <div class="list-group list-group-labels">
                                <h6 class="section-label px-2 mb-1">Nhãn</h6>
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                    <i data-feather="file-text" class="mr-50 font-medium-3"></i>
                                    <span class="align-middle">Văn bản</span>
                                </a>
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                    <i data-feather="image" class="mr-50 font-medium-3"></i>
                                    <span class="align-middle">Hình ảnh</span>
                                </a>
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                    <i data-feather="video" class="mr-50 font-medium-3"></i>
                                    <span class="align-middle">Videos</span>
                                </a>
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                    <i data-feather="music" class="mr-50 font-medium-3"></i>
                                    <span class="align-middle">Âm thanh</span>
                                </a>
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                    <i data-feather="layers" class="mr-50 font-medium-3"></i>
                                    <span class="align-middle">Lưu trữ</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-right">
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row"></div>
                <div class="content-body">
                    <div class="body-content-overlay"></div>
                    <div class="file-manager-main-content">
                        <div class="file-manager-content-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="sidebar-toggle d-block d-xl-none float-left align-middle ml-1">
                                    <i data-feather="menu" class="font-medium-5"></i>
                                </div>
                                <div class="input-group input-group-merge shadow-none m-0 flex-grow-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0">
                                            <i data-feather="search"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="search" class="form-control files-filter border-0 bg-transparent" placeholder="Tìm kiếm" />
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="btn-group btn-group-toggle view-toggle ml-50" data-toggle="buttons">
                                    <label class="btn btn-outline-primary p-50 btn-sm active">
                                        <input type="radio" name="view-btn-radio" data-view="grid" checked />
                                        <i data-feather="grid"></i>
                                    </label>
                                    <label class="btn btn-outline-primary p-50 btn-sm">
                                        <input type="radio" name="view-btn-radio" data-view="list" />
                                        <i data-feather="list"></i>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb pl-2" id="breadcrumb-folder">
                                </ol>
                            </nav>
                        </div>

                        <div class="file-manager-content-body " style="padding-bottom: 21px;">
                            <div class="view-container" id="folder">

                            </div>
                            <div class="view-container" id="file">

                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="new-folder-modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content" id="vanban-fm">
                                <input id="parentId" name="parentId" type="hidden" value="0" />
                                <div class="modal-header">
                                    <h5 class="modal-title">Tên folfer</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" class="form-control" value="New folder" placeholder="Untitled folder" name="title_folder" id="title_folder" required="" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary mr-1" data-dismiss="modal" onclick="savefolder()">Cập nhật</button>
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Hủy bỏ</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade" id="uploadfiles">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <!-- Dropzone section start -->
                                <section id="dropzone-examples">
                                    <!-- multi file upload starts -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Multiple Files Upload</h4>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        Theo mặc định, dropzone là một trình tải lên nhiều tệp. Người dùng có thể
                                                        nhấp vào khu vực dropzone và chọn nhiều tệp hoặc chỉ thả tất cả các tệp đã
                                                        chọn vào khu vực dropzone. Ví dụ này là cách thiết lập cơ bản nhất cho
                                                        dropzone.
                                                    </p>
                                                    <form action="<?= URLAPI ?>/vanban/uploadfiles" class="dropzone dropzone-area" id="dpz-multiple-files">
                                                        <input type="hidden" name="fid" id="fid">
                                                        <div class="dz-message">Thả tệp vào đây hoặc nhấp để tải lên.</div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- multi file upload ends -->
                                </section>
                                <!-- Dropzone section end -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- File Info Sidebar Starts-->
            <div class="modal modal-slide-in fade show" id="app-file-manager-info-sidebar">
                <div class="modal-dialog sidebar-lg">
                    <div class="modal-content p-0">
                        <div class="modal-header d-flex align-items-center justify-content-between mb-1 p-2">
                            <h5 class="modal-title">menu.js</h5>
                            <div>
                                <i data-feather="trash" class="cursor-pointer mr-50" data-dismiss="modal"></i>
                                <i data-feather="x" class="cursor-pointer" data-dismiss="modal"></i>
                            </div>
                        </div>
                        <div class="modal-body flex-grow-1 pb-sm-0 pb-1">
                            <ul class="nav nav-tabs tabs-line" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#details-tab" role="tab" aria-controls="details-tab" aria-selected="true">
                                        <i data-feather="file"></i>
                                        <span class="align-middle ml-25">Details</span>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#activity-tab" role="tab" aria-controls="activity-tab" aria-selected="true">
                                        <i data-feather="activity"></i>
                                        <span class="align-middle ml-25">Activity</span>
                                    </a>
                                </li> -->
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="details-tab" role="tabpanel" aria-labelledby="details-tab">
                                    <div class="d-flex flex-column justify-content-center align-items-center py-5">
                                        <img src="<?= HOME ?>/styles/app-assets/images/icons/js.png" alt="file-icon" height="64" id="icon" />
                                        <p class="mb-0 mt-1">54kb</p>
                                    </div>
                                    <h6 class="file-manager-title my-2">Settings</h6>
                                    <ul class="list-unstyled">
                                        <li class="d-flex justify-content-between align-items-center mb-1">
                                            <span>File Sharing</span>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="sharing" />
                                                <label class="custom-control-label" for="sharing"></label>
                                            </div>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center mb-1">
                                            <span>Synchronization</span>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" checked id="sync" />
                                                <label class="custom-control-label" for="sync"></label>
                                            </div>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center mb-1">
                                            <span>Backup</span>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="backup" />
                                                <label class="custom-control-label" for="backup"></label>
                                            </div>
                                        </li>
                                    </ul>
                                    <hr class="my-2" />
                                    <h6 class="file-manager-title my-2">Info</h6>
                                    <ul class="list-unstyled">
                                        <li class="d-flex justify-content-between align-items-center">
                                            <p>Type</p>
                                            <p class="font-weight-bold" id="type">JS</p>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <p>Size</p>
                                            <p class="font-weight-bold" id="size">54kb</p>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <p>Location</p>
                                            <p class="font-weight-bold" id="location">Files > Documents</p>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center">
                                            <p>Owner</p>
                                            <p class="font-weight-bold" id="nhanvien">Sheldon Cooper</p>
                                        </li>
                                        <!-- <li class="d-flex justify-content-between align-items-center">
                                            <p>Modified</p>
                                            <p class="font-weight-bold">12th Aug, 2020</p>
                                        </li> -->

                                        <li class="d-flex justify-content-between align-items-center">
                                            <p>Created</p>
                                            <p class="font-weight-bold" id="ngay">01 Oct, 2019</p>
                                        </li>
                                    </ul>
                                </div>
                                <!-- <div class="tab-pane fade" id="activity-tab" role="tabpanel" aria-labelledby="activity-tab">
                                    <h6 class="file-manager-title my-2">Today</h6>
                                    <div class="media align-items-center mb-2">
                                        <div class="avatar avatar-sm mr-50">
                                            <img src="../../../app-assets/images/avatars/5-small.png" alt="avatar" width="28" />
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0">
                                                <span class="font-weight-bold">Mae</span>
                                                shared the file with
                                                <span class="font-weight-bold">Howard</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-sm bg-light-primary mr-50">
                                            <span class="avatar-content">SC</span>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0">
                                                <span class="font-weight-bold">Sheldon</span>
                                                updated the file
                                            </p>
                                        </div>
                                    </div>
                                    <h6 class="file-manager-title mt-3 mb-2">Yesterday</h6>
                                    <div class="media align-items-center mb-2">
                                        <div class="avatar avatar-sm bg-light-success mr-50">
                                            <span class="avatar-content">LH</span>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0">
                                                <span class="font-weight-bold">Leonard</span>
                                                renamed this file to
                                                <span class="font-weight-bold">menu.js</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-sm mr-50">
                                            <img src="../../../app-assets/images/portrait/small/avatar-s-1.jpg" alt="Avatar" width="28" />
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0">
                                                <span class="font-weight-bold">You</span>
                                                shared this file with Leonard
                                            </p>
                                        </div>
                                    </div>
                                    <h6 class="file-manager-title mt-3 mb-2">3 days ago</h6>
                                    <div class="media">
                                        <div class="avatar avatar-sm mr-50">
                                            <img src="../../../app-assets/images/portrait/small/avatar-s-1.jpg" alt="Avatar" width="28" />
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-50">
                                                <span class="font-weight-bold">You</span>
                                                uploaded this file
                                            </p>
                                            <img src="../../../app-assets/images/icons/js.png" alt="Avatar" class="mr-50" height="24" />
                                            <span class="font-weight-bold">app.js</span>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- File Info Sidebar Ends -->
            <!-- Folder Dropdown Starts-->
            <div class="dropdown-menu dropdown-menu-right folder-dropdown" id="folder-dropdown">
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#new-folder-modal">
                    <i data-feather="edit" class="align-middle mr-50"></i>
                    <span class="align-middle">Rename</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" onclick="delfolder()">
                    <i data-feather="trash" class="align-middle mr-50"></i>
                    <span class="align-middle">Delete</span>
                </a>
            </div>
            <!-- /Folder Dropdown Ends -->
            <!-- File Dropdown Starts-->
            <div class="dropdown-menu dropdown-menu-right file-dropdown" id="file-dropdown">
                <!-- <a class="dropdown-item" href="javascript:void(0);">
                    <i data-feather="eye" class="align-middle mr-50"></i>
                    <span class="align-middle">Preview</span>
                </a>
                <a class="dropdown-item" href="javascript:void(0);">
                    <i data-feather="user-plus" class="align-middle mr-50"></i>
                    <span class="align-middle">Share</span>
                </a>
                <a class="dropdown-item" href="javascript:void(0);">
                    <i data-feather="copy" class="align-middle mr-50"></i>
                    <span class="align-middle">Make a copy</span>
                </a> -->
                <!-- <div class="dropdown-divider"></div> -->
                <!-- <a class="dropdown-item" href="javascript:void(0);">
                    <i data-feather="edit" class="align-middle mr-50"></i>
                    <span class="align-middle">Rename</span>
                </a> -->
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#app-file-manager-info-sidebar">
                    <i data-feather="info" class="align-middle mr-50"></i>
                    <span class="align-middle">Info</span>
                </a>
                <a class="dropdown-item" href="javascript:void(0);" onclick="downloadfile()">
                    <i data-feather="download" class="align-middle mr-50"></i>
                    <span class="align-middle">Download</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" onclick="delfile()">
                    <i data-feather="trash" class="align-middle mr-50"></i>
                    <span class="align-middle">Delete</span>
                </a>
                <!-- <a class="dropdown-item" href="javascript:void(0);">
                    <i data-feather="alert-circle" class="align-middle mr-50"></i>
                    <span class="align-middle">Report</span>
                </a> -->
            </div>
            <!-- /File Dropdown Ends -->

            <div class="ps__rail-x" style="left: 0px; bottom: -583px;">
                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 583px; height: 205px; right: 0px;">
                <div class="ps__thumb-y" tabindex="0" style="top: 126px; height: 44px;"></div>
            </div>
        </div>
    </div>
</div>
<script src="<?= HOME ?>/styles/app-assets/vendors/js/file-uploaders/dropzone.min.js"></script>
<script src="<?= HOME ?>/js/vanban.js"></script>
<!-- <script src="<?= HOME ?>/js/vanban/upload.js"></script> -->
<!-- <script src="<?= HOME ?>/styles/app-assets/js/scripts/pages/app-file-manager.js"></script> -->