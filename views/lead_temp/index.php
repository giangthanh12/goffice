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
                        Cơ hội <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng quản lý thông tin cá nhân, tình trạng và lịch sự chăm sóc của những khách hàng quan tâm đến SP/DV của doanh nghiệp   " data-trigger="click" >
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
                        <input type="text" class="form-control task-due-date" id="fromDate" name="fromDate" placeholder="Từ ngày" onchange="changeStart()" />
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="task-due-date" class="form-label">Đến ngày</label>
                        <input type="text" class="form-control task-due-date" id="toDate" name="toDate" placeholder="Đến ngày" />
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="lead-btn col-lg-2">
                        <label for="task-due-date" class="form-label">&nbsp;</label>
                        <button class="form-control btn-primary" role="button" onclick="leadSearch()">Tìm kiếm</button>
                    </div>
                    <div class="col-lg-2 d-none">
                        <label for="task-due-date" class="form-label">&nbsp;</label>
                        <button class="form-control btn-primary" role="button">Nhập từ excel</button>
                    </div>
                    <div class="col-lg-2 d-none">
                        <label for="task-due-date" class="form-label">&nbsp;</label>
                        <button class="form-control btn-primary" role="button" onclick="leadQuote()">Báo giá</button>
                    </div>
                    <div class="col-lg-2 d-none">
                        <label for="task-due-date" class="form-label">&nbsp;</label>
                        <button class="form-control btn-primary" role="button">Đơn hàng</button>
                    </div>
                    <div class="col-lg-2 d-none">
                        <label for="task-due-date" class="form-label">&nbsp;</label>
                        <button class="form-control btn-primary" role="button">Hợp đồng</button>
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
                                    <?php if ($this->funAdd == 1) { ?>
                                        <i class='bx bx-plus-circle bx-md' onclick="showModalLead()"></i>
                                        <!-- <i class='bx bx-filter-alt bx-md'></i> -->
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <ul class="chat-users-list chat-list media-list" id="list-lead">
                            <?php
                            $lead = $this->lead;
                            $i = 1;
                            foreach ($lead as $item) {
                            ?>
                                <li id="list<?= $i ?>" data-id="<?= $item['id'] ?>" data-dateTime="<?= $item['dateTime'] ?>" data-customer="<?= $item['customerId'] ?>" data-status="<?= $item['status'] ?>" data-leadname="<?= $item['name'] ?>" data-leaddes="<?= $item['description'] ?>" class="sidebar-list">
                                    <div class="chat-info flex-grow-1">
                                        <div class="customer-name">
                                            <label><?php echo $item['name'] ?></label>
                                        </div>
                                        <div class="customer-info">
                                            <label><?php echo $item['dateTime'] ?></label>
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
                                                <span class="updateLead" onclick="loadData(<?= $item['id'] ?>)">Cập nhật</span>
                                                <?php if ($this->funDel == 1) { ?>
                                                    <span class="deleteLead" onclick="deleteLead(<?= $item['id'] ?>)">Xóa</span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="btn-statement">
                                            <br>
                                            <?php
                                            if ($item['status'] == 1)
                                                echo '<button class="btn-statement-orange">Đang chăm sóc</button>';
                                            elseif ($item['status'] == 2)
                                                echo '<button class="btn-statement-yellow">Đã báo giá</button>';
                                            elseif ($item['status'] == 3)
                                                echo '<button class="btn-statement-blue">Đã lên đơn hàng</button>';
                                            elseif ($item['status'] == 4)
                                                echo '<button class="btn-statement-green">Đã chốt</button>';
                                            else
                                                echo '<button class="btn-statement-red">Hủy</button>';
                                            ?>
                                        </div>
                                    </div>
                                </li>
                            <?php $i++;
                            } ?>
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
                        <!-- <div class="start-chat-area d-none">
                            <div class="mb-1 start-chat-icon">
                                <i data-feather="message-square"></i>
                            </div>
                            <h4 class="sidebar-toggle start-chat-text">Thông tin chi tiết</h4>
                        </div> -->
                        <!--/ To load Conversation -->
                        <!-- Active Chat -->
                        <div class="active-chat">
                            <!-- User Chat messages -->
                            <div class="user-chats">
                                <div class="chats">
                                    <div class="row customer-item">
                                        <div class="content-right-detail col-lg-6">
                                            <label>Thông tin khách hàng</label>
                                        </div>
                                        <div class="content-right-icon col-lg-6">
                                            <!-- <i class='bx bx-trash-alt bx-sm'></i> -->
                                            <!-- <i class='bx bx-pencil bx-sm'></i> -->
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
                                            <!-- <div class="row">
                                                <div class="col-lg-5">
                                                    <p>Ngày tạo:</p>
                                                </div>
                                                <div class="col-lg-7">
                                                    <p id="dateTime"></p>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="takecare-item">
                                    <div class="row">
                                        <div class="takecare-history col-lg-8 col-md-8">
                                            <label>Lịch sử chăm sóc</label>
                                        </div>
                                        <?php if ($this->funtakecare == 1) { ?>
                                            <div class="float-right col-lg-3 col-md-3" style="padding-top:15px;">
                                                <i class='bx bx-plus-circle bx-md float-right' onclick="showModalTakeCare()"></i>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <hr style="border-top: 1px solid black; margin:1rem;">
                                    <div class="takecare-history-detail" id="history" style="height: 787px; overflow: scroll;">
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

    <!-- modal add takecare history -->
    <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-takecare-modal">
        <div class="modal-dialog sidebar-lg">
            <div class="modal-content p-0">
                <form id="form-modal-todo" class="todo-modal needs-validation">
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
                                        <button class="ql-align" value="center"></button>
                                        <button class="ql-align" value="right"></button>
                                        <button class="ql-align" value="justify"></button>
                                        <button class="ql-link"></button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="todoTitleAdd" class="form-label">Link ghi âm</label>
                                <input type="text" id="linkRecord" name="linkRecord" class="new-todo-item-title form-control" placeholder="Link ghi âm" />
                                <input type="hidden" id="id" name="id">
                            </div>
                        </div>
                        <div class="form-group my-1">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <button type="button" class="btn btn-outline-secondary" id="btn_boqua" data-dismiss="modal">Bỏ qua</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal add new lead -->
    <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-lead-modal">
        <div class="modal-dialog sidebar-lg">
            <div class="modal-content p-0">
                <form class="form-validate" enctype="multipart/form-data" id="fmLead">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    <div class="modal-header align-items-center mb-1">
                        <h5 class="modal-title">Thêm cơ hội kinh doanh</h5>
                    </div>
                    <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                        <div class="action-tags">
                            <div class="form-group">
                                <label for="leadName" class="form-label">Tên cơ hội<span style="color:red;">*</span></label>
                                <input type="text" id="leadName" name="leadName" class="new-todo-item-title form-control" placeholder="Tên cơ hội" />
                                <input type="hidden" id="id" name="id">
                            </div>
                            <!-- <div class="form-group">
                                <label for="leadDesc" class="form-label">Mô tả cơ hội</label>
                                <textarea id="leadDesc" name="leadDesc" class="new-todo-item-title form-control" rows="3" placeholder="Mô tả cơ hội" ></textarea>
                            </div> -->
                            <div class="form-group">
                                <label class="form-label">Mô tả cơ hội</label>
                                <div id="leadDesc" name="leadDesc" class="border-bottom-0" data-placeholder="Mô tả cơ hội" required></div>
                                <div class="d-flex justify-content-end desc-toolbar-2 border-top-0">
                                    <span class="ql-formats mr-0">
                                        <button class="ql-bold"></button>
                                        <button class="ql-italic"></button>
                                        <button class="ql-underline"></button>
                                        <button class="ql-align"></button>
                                        <button class="ql-align" value="center"></button>
                                        <button class="ql-align" value="right"></button>
                                        <button class="ql-align" value="justify"></button>
                                        <button class="ql-link"></button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group position-relative">
                                <label for="task-assigned" class="form-label d-block">Khách hàng<span style="color:red;">*</span></label>
                                <select class="select2 form-control" id="leadCustomer" name="leadCustomer" required onchange="changeCustomer()">
                                    <option value="-1">Khách hàng mới</option>
                                    <?php
                                    foreach ($this->customer as $item) {
                                        echo '<option value="' . $item['id'] . '">' . $item['fullName'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="d-none" id="new-customer">
                                <div class="form-group">
                                    <label for="customerName" class="form-label">Tên khách hàng</label>
                                    <input type="text" id="customerName" name="customerName" class="new-todo-item-title form-control" placeholder="Tên khách hàng" required />
                                </div>
                                <div class="form-group">
                                    <label for="customerPhone" class="form-label">Số điện thoại</label>
                                    <input type="text" id="customerPhone" name="customerPhone" class="new-todo-item-title form-control" placeholder="Số điện thoại" required />
                                </div>
                                <div class="form-group">
                                    <label for="customerEmail" class="form-label">Email</label>
                                    <input type="text" id="customerEmail" name="customerEmail" class="new-todo-item-title form-control" placeholder="Địa chỉ email" required />
                                </div>
                            </div>
                            <div class="form-group position-relative">
                                <label for="opportunity" class="form-label d-block">Đánh giá cơ hội</label>
                                <select class="select2 form-control" id="opportunity" name="opportunity">
                                    <option value="1">Quan tâm</option>
                                    <option value="2">Có nhu cầu</option>
                                    <option value="3">Có ngân sách</option>
                                    <option value="4">Có khả năng chốt</option>
                                    <option value="5">Có thể chốt trong tháng</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group my-1">
                            <button type="button" class="btn btn-primary" id="btn-add-lead" onclick="saveLead()">Cập nhật</button>
                            <button type="button" class="btn btn-outline-secondary" id="btn_boqua" data-dismiss="modal">Bỏ qua</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal update lead -->
    <div class="modal modal-slide-in update-item-sidebar fade" id="updateLead">
        <div class="modal-dialog sidebar-lg">
            <div class="modal-content p-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title">Cập nhật thông tin cơ hội</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="tab-content mt-2">
                        <div class="tab-pane tab-pane-update fade show active" id="tab-update" role="tabpanel">
                            <form class="update-item-form" id="fmEdit">
                                <div class="form-group">
                                    <label for="todoTitleAdd" class="form-label">Tên cơ hội</label>
                                    <input type="text" id="leadNameUpdate" name="leadNameUpdate" class="new-todo-item-title form-control" placeholder="Tên cơ hội" required />
                                    <input type="hidden" id="leadIdUpdate" name="leadIdUpdate">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Mô tả cơ hội</label>
                                    <div id="leadDescUpdate" class="border-bottom-0"></div>
                                    <div class="d-flex justify-content-end desc-toolbar-3 border-top-0">
                                        <span class="ql-formats mr-0">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-align"></button>
                                            <button class="ql-link"></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group position-relative">
                                    <label for="task-assigned" class="form-label d-block">Khách hàng</label>
                                    <select class="select2" id="leadCustomerUpdate" name="leadCustomerUpdate" required>
                                        <option value="">-- Chọn khách hàng --</option>
                                        <?php
                                        foreach ($this->customer as $item) {
                                            echo '<option value="' . $item['id'] . '">' . $item['fullName'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group position-relative">
                                    <label for="opportunity" class="form-label d-block">Đánh giá cơ hội</label>
                                    <select class="select2" id="opportunityUpdate" name="opportunityUpdate">
                                        <option value="1">Quan tâm</option>
                                        <option value="2">Có nhu cầu</option>
                                        <option value="3">Có ngân sách</option>
                                        <option value="4">Có khả năng chốt</option>
                                        <option value="5">Có thể chốt trong tháng</option>
                                    </select>
                                </div>
                                <div class="form-group position-relative">
                                    <label for="status" class="form-label d-block">Tình trạng</label>
                                    <select class="select2 form-control" id="statusUpdate" name="statusUpdate">
                                        <option value="1">Đang chăm sóc</option>
                                        <option value="2">Đã báo giá</option>
                                        <option value="3">Đã lên đơn hàng</option>
                                        <option value="4">Đã chốt</option>
                                        <option value="5">Hủy</option>
                                    </select>
                                </div>
                                <div class="d-flex flex-wrap mb-2">
                                    <?php if ($this->funEdit == 1) { ?>
                                        <button type="button" onclick="updateLead()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                    <?php } ?>
                                    <button type="reset" class="btn btn-outline-secondary mr-sm-1" data-dismiss="modal">Bỏ qua</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal add lead quote -->
    <div class="modal fade text-left" id="add-quote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Báo giá</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <input type="hidden" id="id" name="id" /> -->
                    <div class="card">
                        <div class="card-body">
                            <form class="form-validate" enctype="multipart/form-data" id="dg">
                                <div class="row mt-1">
                                    <div class="col-md-4 form-group">
                                        <label for="name">Nhân viên phụ trách</label>
                                        <input id="staffQuote" name="staffQuote" type="text" class="form-control" readonly />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="type">Khách hàng</label>
                                        <input id="customerQuote" name="customerQuote" type="text" class="form-control" readonly />
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="name">Ngày báo giá</label>
                                        <input id="dateQuote" name="dateQuote" type="text" class="form-control" readonly />
                                    </div>
                                    <!-- Product Details starts -->
                                    <div class="card-body invoice-padding invoice-product-details">
                                        <form class="source-item">
                                            <div data-repeater-list="group-a">
                                                <div class="repeater-wrapper" data-repeater-item>
                                                    <div class="row">
                                                        <div class="col-12 d-flex product-details-border position-relative pr-0">
                                                            <div class="row w-100 pr-lg-0 pr-1 py-2">
                                                                <div class="col-lg-5 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                                                                    <p class="card-text col-title mb-md-50 mb-0">Item</p>
                                                                    <select class="form-control item-details">
                                                                        <option value="App Design">App Design</option>
                                                                        <option value="App Customization" selected>App Customization</option>
                                                                        <option value="ABC Template">ABC Template</option>
                                                                        <option value="App Development">App Development</option>
                                                                    </select>
                                                                    <textarea class="form-control mt-2" rows="1">Customization & Bug Fixes</textarea>
                                                                </div>
                                                                <div class="col-lg-3 col-12 my-lg-0 my-2">
                                                                    <p class="card-text col-title mb-md-2 mb-0">Cost</p>
                                                                    <input type="number" class="form-control" value="24" placeholder="24" />
                                                                    <div class="mt-2">
                                                                        <span>Discount:</span>
                                                                        <span class="discount">0%</span>
                                                                        <span class="tax-1 ml-50" data-toggle="tooltip" data-placement="top" title="Tax 1">0%</span>
                                                                        <span class="tax-2 ml-50" data-toggle="tooltip" data-placement="top" title="Tax 2">0%</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                                    <p class="card-text col-title mb-md-2 mb-0">Qty</p>
                                                                    <input type="number" class="form-control" value="1" placeholder="1" />
                                                                </div>
                                                                <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                                                                    <p class="card-text col-title mb-md-50 mb-0">Price</p>
                                                                    <p class="card-text mb-0">$24.00</p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column align-items-center justify-content-between border-left invoice-product-actions py-50 px-25">
                                                                <i data-feather="x" class="cursor-pointer font-medium-3" data-repeater-delete></i>
                                                                <div class="dropdown">
                                                                    <i class="cursor-pointer more-options-dropdown mr-0" data-feather="settings" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    </i>
                                                                    <div class="dropdown-menu dropdown-menu-right item-options-menu p-1" aria-labelledby="dropdownMenuButton">
                                                                        <div class="form-group">
                                                                            <label for="discount-input" class="form-label">Discount(%)</label>
                                                                            <input type="number" class="form-control" id="discount-input" />
                                                                        </div>
                                                                        <div class="form-row mt-50">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="tax-1-input" class="form-label">Tax 1</label>
                                                                                <select name="tax-1-input" id="tax-1-input" class="form-control tax-select">
                                                                                    <option value="0%" selected>0%</option>
                                                                                    <option value="1%">1%</option>
                                                                                    <option value="10%">10%</option>
                                                                                    <option value="18%">18%</option>
                                                                                    <option value="40%">40%</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="tax-2-input" class="form-label">Tax 2</label>
                                                                                <select name="tax-2-input" id="tax-2-input" class="form-control tax-select">
                                                                                    <option value="0%" selected>0%</option>
                                                                                    <option value="1%">1%</option>
                                                                                    <option value="10%">10%</option>
                                                                                    <option value="18%">18%</option>
                                                                                    <option value="40%">40%</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="dropdown-divider my-1"></div>
                                                                        <div class="d-flex justify-content-between">
                                                                            <button type="button" class="btn btn-outline-primary btn-apply-changes">Apply</button>
                                                                            <button type="button" class="btn btn-outline-secondary">Cancel</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-12 px-0">
                                                    <button type="button" class="btn btn-primary btn-sm btn-add-new" data-repeater-create>
                                                        <i data-feather="plus" class="mr-25"></i>
                                                        <span class="align-middle">Add Item</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Product Details ends -->

                                    <!-- Invoice Total starts -->
                                    <div class="card-body invoice-padding">
                                        <div class="row invoice-sales-total-wrapper">
                                            <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                                <div class="d-flex align-items-center mb-1">
                                                    <label for="salesperson" class="form-label">Salesperson:</label>
                                                    <input type="text" class="form-control ml-50" id="salesperson" placeholder="Edward Crowley" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                                <div class="invoice-total-wrapper">
                                                    <div class="invoice-total-item">
                                                        <p class="invoice-total-title">Subtotal:</p>
                                                        <p class="invoice-total-amount">$1800</p>
                                                    </div>
                                                    <div class="invoice-total-item">
                                                        <p class="invoice-total-title">Discount:</p>
                                                        <p class="invoice-total-amount">$28</p>
                                                    </div>
                                                    <div class="invoice-total-item">
                                                        <p class="invoice-total-title">Tax:</p>
                                                        <p class="invoice-total-amount">21%</p>
                                                    </div>
                                                    <hr class="my-50" />
                                                    <div class="invoice-total-item">
                                                        <p class="invoice-total-title">Total:</p>
                                                        <p class="invoice-total-amount">$1690</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Invoice Total ends -->
                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                        <button type="button" onclick="saveQuote()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1" id="btnUpdate">Cập nhật</button>
                                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                    </div>
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
var funEdit = <?=$this->funEdit?>;
</script>
<script src="<?= HOME ?>/js/lead_temp.js"></script>