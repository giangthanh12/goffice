<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/lead_temp.css">
<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/lead_temp_list.css">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

<div class="app-content content chat-application">
    <div class="content-overlay"></div>
    <div class="content-header row">
        <div class="content-header-left container-xxl">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0" id="title_module">
                        Cơ hội
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="card container-xxl" style="margin-bottom: 0;border-radius: 0;border-top-left-radius: 0.428em;border-top-right-radius: 0.428em;">
        <div class="row lead-temp">
            <div class="col-lg-3">
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="task-due-date" class="form-label">Từ ngày</label>
                        <input type="text" class="form-control task-due-date" id="start-date" name="start-date" />
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="task-due-date" class="form-label">Đến ngày</label>
                        <input type="text" class="form-control task-due-date" id="end-date" name="end-date" />
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="lead-btn col-lg-2">
                        <label for="task-due-date" class="form-label"></label>
                        <button class="form-control btn-title-left" role="button">Tìm kiếm</button>
                    </div>
                    <div class="col-lg-2">
                        <label for="task-due-date" class="form-label"></label>
                        <button class="form-control btn-title-left" role="button">Nhập từ excel</button>
                    </div>
                    <div class="col-lg-2">
                        <label for="task-due-date" class="form-label"></label>
                        <button class="form-control btn-title-left" role="button">Báo giá</button>
                    </div>
                    <div class="col-lg-2">
                        <label for="task-due-date" class="form-label"></label>
                        <button class="form-control btn-title-left" role="button">Đơn hàng</button>
                    </div>
                    <div class="col-lg-2">
                        <label for="task-due-date" class="form-label"></label>
                        <button class="form-control btn-title-left" role="button">Hợp đồng</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="content-area-wrapper container-xxl p-0" style="min-height: 850px;">
        <div class="sidebar-left">
            <div class="sidebar">
                <!-- Chat Sidebar area -->
                <div class="sidebar-content" style="border-radius: 0;border-bottom-left-radius: 0.428em;border-bottom-right-radius: 0.428em;">
                    <!-- Sidebar Users start -->
                    <div id="users-list" class="chat-user-list-wrapper list-group" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-8">
                                <h4 class="chat-list-title container-xxl">Cơ hội</h4>
                            </div>
                            <div class="col-lg-4">
                                <div class="icon-sidebar-left">
                                    <i class='bx bx-plus-circle bx-md'></i>
                                    <!-- <i class='bx bx-filter-alt bx-md'></i> -->
                                </div>
                            </div>
                        </div>
                        <ul class="chat-users-list chat-list media-list" id="list-lead">
                            <?php
                            $lead = $this->lead;
                            foreach ($lead as $item) {
                            ?>
                                <li data-id="<?= $item['id'] ?>" data-customer="<?= $item['customerId'] ?>" data-status="<?= $item['status'] ?>" data-leadname="<?= $item['name'] ?>" data-leaddes="<?= $item['description'] ?>" class="sidebar-list">
                                    <div class="chat-info flex-grow-1">
                                        <div class="customer-name">
                                            <label><?php echo $item['name'] ?></label>
                                        </div>
                                        <div class="customer-info">
                                            <label><?php echo $item['fullName'] ?></label>
                                        </div>
                                        <div class="customer-info">
                                            <label><?php echo $item['description'] ?></label>
                                        </div>
                                    </div>
                                    <div class="chat-meta text-nowrap">
                                        <div class="float-right dropdown">
                                            <i class='bx bx-dots-vertical-rounded bx-md icon-dots'></i>
                                            <div class="dropdown-content">
                                                <a href="#">Edit</a>
                                                <a href="#">Delete</a>
                                            </div>
                                        </div>
                                        <div class="btn-statement">
                                            <br>
                                            <?php
                                            if ($item['status'] == 1) {
                                            ?>
                                                <button class="btn-statement-orange">Đang chăm sóc</button>
                                            <?php } ?>
                                            <?php
                                            if ($item['status'] == 2) {
                                            ?>
                                                <button class="btn-statement-blue">Đã gửi báo giá</button>
                                            <?php } ?>
                                            <?php
                                            if ($item['status'] == 3) {
                                            ?>
                                                <button class="btn-statement-green">Đã chốt đơn</button>
                                            <?php } ?>
                                            <?php
                                            if ($item['status'] == 4) {
                                            ?>
                                                <button class="btn-statement-red">Hủy</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- Sidebar Users end -->
                </div>
            </div>
        </div>
        <div class="content-right">
            <div class="content-wrapper container-xxl p-0">
                <div class="content-body">
                    <!-- Main chat area -->
                    <section class="chat-app-window">
                        <!-- To load Conversation -->
                        <div class="start-chat-area">
                            <div class="mb-1 start-chat-icon">
                                <i data-feather="message-square"></i>
                            </div>
                            <h4 class="sidebar-toggle start-chat-text">Thông tin chi tiết</h4>
                        </div>
                        <!--/ To load Conversation -->
                        <!-- Active Chat -->
                        <div class="active-chat d-none">
                            <!-- User Chat messages -->
                            <div class="user-chats">
                                <div class="chats">
                                    <div class="row customer-item">
                                        <div class="content-right-detail col-lg-6">
                                            <label>Thông tin khách hàng</label>
                                        </div>
                                        <div class="content-right-icon col-lg-6">
                                            <i class='bx bx-trash-alt bx-sm'></i>
                                            <div class="float-right">&nbsp;</div>
                                            <i class='bx bx-pencil bx-sm'></i>
                                        </div>
                                    </div>
                                    <hr style="border-top: 1px solid black; margin:1rem;">
                                    <div class="content-right-info row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <p>Khách hàng:</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <p id="fullName"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <p>Mã số thuế:</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <p id="taxCode"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <p>Địa chỉ:</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <p id="address"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <p>Loại khách hàng:</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <p id="type"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <p>Người phụ trách:</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <p id="staffName"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <p>Tình trạng:</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div id="status" class="btn-right-info">
                                                        <button class="btn-statement-green">Đã chốt đơn
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <p>Người đại diện:</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <p id="representative"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <p>Số điện thoại:</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <p id="phoneNumber"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <p>Email:</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <p id="email"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <p>Ngày tạo:</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <p id="dateTime"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="takecare-item">
                                    <div class="row">
                                        <div class="takecare-history col-lg-8 col-md-8">
                                            <label>Lịch sử chăm sóc</label>
                                        </div>
                                        <div class="float-right col-lg-3 col-md-3" style="padding-top:15px;">
                                            <i class='bx bx-plus-circle bx-md float-right' onclick="showModalTakeCare()"></i>
                                        </div>
                                    </div>
                                    <hr style="border-top: 1px solid black; margin:1rem;">
                                    <div class="takecare-history-detail" id="history">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Active Chat -->
                    </section>
                    <!--/ Main chat area -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-takecare-modal">
        <div class="modal-dialog sidebar-lg">
            <div class="modal-content p-0">
                <form id="form-modal-todo" class="todo-modal needs-validation" novalidate onsubmit="return false">
                    <div class="modal-header align-items-center mb-1">
                        <h5 class="modal-title">Thêm lịch sử chăm sóc</h5>
                        <div class="todo-item-action d-flex align-items-center justify-content-between ml-auto">
                            <button type="button" class="close font-large-1 font-weight-normal py-0" data-dismiss="modal" aria-label="Close">
                                ×
                            </button>
                        </div>
                    </div>
                    <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                        <div class="action-tags">
                            <div class="form-group">
                                <label class="form-label">Nội dung chăm sóc</label>
                                <div id="task-desc" class="border-bottom-0" data-placeholder="Nội dung chăm sóc"></div>
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
                            <!-- <div class="form-group position-relative">
                                <label for="staffId" class="form-label d-block">Người chăm sóc</label>
                                <select class="select2 form-control" id="staffId" name="staffId"></select>
                            </div> -->
                            <div class="form-group">
                                <label for="todoTitleAdd" class="form-label">Link ghi âm</label>
                                <input type="text" id="name" name="name" class="new-todo-item-title form-control" placeholder="Link ghi âm" />
                                <input type="hidden" id="id" name="id">
                            </div>
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
</div>
<script src="<?= HOME ?>/styles/app-assets/js/scripts/pages/lead-temp.js"></script>