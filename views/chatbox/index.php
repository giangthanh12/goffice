<link rel="stylesheet" type="text/css" href="styles/app-assets/css/pages/app-chat.min.css">
<link rel="stylesheet" type="text/css" href="styles/app-assets/css/pages/app-chat-list.min.css">
<style>
    @charset "utf-8";
    /* Background color of every second message */
    .even {
        background-color:rgba(0, 0, 0, 0.03);
    }
    /* Class for one message */
    .message {

    }
    /* Font weight of Name in chat */
    .nickname {
        font-weight:600;
    }
    /* Position of smileys on click */
    .smileys {
        position: absolute;
        padding: 5px;
        margin-bottom: 10px;
        border: 1px solid transparent;
        border-radius: 2px;
    }
    .date-time {
        color: #777;
        float: right;
        font-size: x-small;
        margin-right: 10px;
    }
    .pop-inner {
        max-height: 100px;
        border-bottom-right-radius: 12px;
        border-top-right-radius: 12px;
        border-bottom-left-radius: 12px;
        border-top-left-radius: 12px;
    }
    .logo-center {
        height: 50px;
        position: absolute;
        left: 0;
        right: 0;
        margin-left: auto;
        margin-right: auto;
    }
    .centere {
        width: 50%;
        margin: 0 auto;
    }

    *{
        margin:0;
        padding:0;
    }
</style>
<audio id='bgAudio'>
    <source src='template/mp3/boom.mp3' type='audio/mpeg'>
</audio>
<!-- BEGIN: Content-->
<div class="app-content content chat-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-area-wrapper container-xxl p-0">
        <div class="sidebar-left">
            <div class="sidebar">
                <div class="chat-profile-sidebar">
                    <header class="chat-profile-header">
                    <span class="close-icon">
                        <i data-feather="x"></i>
                    </span>
                        <div class="header-profile-sidebar">
                            <div class="avatar box-shadow-1 avatar-xl avatar-border">
                                <img src="" alt="user_avatar" id="user_avatar_profile"/>
                                <span class="avatar-status-online avatar-status-xl"></span>
                            </div>
                            <h4 class="chat-user-name" id="fullname_chatbox">John Doe</h4>
                            <span class="user-post">online</span>
                        </div>
                    </header>
                    <div class="profile-sidebar-area">
                        <h6 class="section-label mb-1 mt-3">Status</h6>
                        <ul class="list-unstyled user-status">
                            <li class="pb-1">
                                <div class="custom-control custom-control-success custom-radio">
                                    <input type="radio" id="activeStatusRadio" name="userStatus"
                                           class="custom-control-input" value="online" checked />
                                    <label class="custom-control-label ml-25" for="activeStatusRadio">Active</label>
                                </div>
                            </li>
                            <li class="pb-1">
                                <div class="custom-control custom-control-danger custom-radio">
                                    <input type="radio" id="dndStatusRadio" name="userStatus" class="custom-control-input"
                                           value="busy" />
                                    <label class="custom-control-label ml-25" for="dndStatusRadio">Do Not Disturb</label>
                                </div>
                            </li>
                            <li class="pb-1">
                                <div class="custom-control custom-control-warning custom-radio">
                                    <input type="radio" id="awayStatusRadio" name="userStatus" class="custom-control-input"
                                           value="away" />
                                    <label class="custom-control-label ml-25" for="awayStatusRadio">Away</label>
                                </div>
                            </li>
                            <li class="pb-1">
                                <div class="custom-control custom-control-secondary custom-radio">
                                    <input type="radio" id="offlineStatusRadio" name="userStatus"
                                           class="custom-control-input" value="offline" />
                                    <label class="custom-control-label ml-25" for="offlineStatusRadio">Offline</label>
                                </div>
                            </li>
                        </ul>
                        <div class="more-options">
                            <h6 class="section-label mb-1 mt-3">Options</h6>
                            <ul class="list-unstyled">
                                <li class="cursor-pointer mb-1" onclick="create_group()">
                                    <i data-feather="tag" class="font-medium-2 mr-50"></i>
                                    <span class="align-middle">Tạo nhóm chat</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="sidebar-content">
                <span class="sidebar-close-icon">
                    <i data-feather="x"></i>
                </span>
                    <div class="chat-fixed-search">
                        <div class="d-flex align-items-center w-100">
                            <div class="sidebar-profile-toggle">
                                <div class="avatar avatar-border">
                                    <img src="" alt="user_avatar" id="user_avatar"
                                         height="42" width="42" />
                                    <span class="avatar-status-online"></span>
                                </div>
                            </div>
                            <div class="input-group input-group-merge ml-1 w-100">
                                <div class="input-group-prepend">
                                <span class="input-group-text round"><i data-feather="search"
                                                                        class="text-muted"></i></span>
                                </div>
                                <input type="text" class="form-control round" id="chat-search"
                                       placeholder="Search or start a new chat" aria-label="Search..."
                                       aria-describedby="chat-search" />
                            </div>
                        </div>
                    </div>
                    <div id="users-list" class="chat-user-list-wrapper list-group">
                        <h4 class="chat-list-title">Chats</h4>
                        <ul class="chat-users-list chat-list media-list" id="list_chatbox"></ul>
<!--                        <h4 class="chat-list-title">Contacts</h4>-->
                        <ul class="chat-users-list contact-list media-list" id="list_contact"></ul>
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
                    <section class="chat-app-window">
                        <div class="start-chat-area">
                            <div class="mb-1 start-chat-icon">
                                <i data-feather="message-square"></i>
                            </div>
                            <h4 class="sidebar-toggle start-chat-text">Start Conversation</h4>
                        </div>
                        <div class="active-chat d-none">
                            <div class="chat-navbar">
                                <header class="chat-header">
                                    <div class="d-flex align-items-center">
                                        <div class="sidebar-toggle d-block d-lg-none mr-1">
                                            <i data-feather="menu" class="font-medium-5"></i>
                                        </div>
                                        <div class="avatar avatar-border user-profile-toggle m-0 mr-1">
                                            <img id="img_chat"  alt="avatar" height="36" width="36" />
                                            <span class="avatar-status-online"></span>
                                        </div>
                                        <h6 class="mb-0" id="name_chat"></h6>
                                    </div>
                                </header>
                            </div>
                            <div class="user-chats" id="boxchat">
                                <div class="chats" id="chat_content"></div>
                            </div>
                            <form class="chat-app-form" action="javascript:void(0);" onsubmit="enterChat()" id="chat_form">
                                <input id="id_enemy" name="id_enemy" type="hidden"/>
                                <input id="chat_code" name="chat_code" type="hidden" value="0"/>
                                <div class="input-group input-group-merge mr-1 form-send-message">
                                    <input type="text" class="form-control message" placeholder="Nhập nội dung tin nhắn"
                                           name="msg_chat" id="msg_chat"/>
                                </div>
                                <button type="button" class="btn btn-primary send" onclick="enterChat()">
                                    <i data-feather="send" class="d-lg-none"></i>
                                    <span class="d-none d-lg-block">Gửi</span>
                                </button>
                            </form>
                        </div>
                    </section>
                    <div class="user-profile-sidebar">
                        <header class="user-profile-header">
                        <span class="close-icon">
                            <i data-feather="x"></i>
                        </span>
                            <!-- User Profile image with name -->
                            <div class="header-profile-sidebar">
                                <div class="avatar box-shadow-1 avatar-border avatar-xl">
                                    <img src="" alt="user_avatar" id="user_avatar_receiver"
                                         height="70" width="70" />
                                    <span class="avatar-status-online avatar-status-lg"></span>
                                </div>
                                <h4 class="chat-user-name" id="chat-user-name">Kristopher Candy</h4>
                                <span class="user-post" id="user-post">UI/UX Designer</span>
                            </div>
                            <!--/ User Profile image with name -->
                        </header>
                        <div class="user-profile-sidebar-area">
                            <!-- About User -->
                            <h6 class="section-label mb-1">About</h6>
                            <p id="user-about">Ghi chú</p>
                            <!-- About User -->
                            <!-- User's personal information -->
                            <div class="personal-info">
                                <h6 class="section-label mb-1 mt-3">Personal Information</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-1">
                                        <i data-feather="mail" class="font-medium-2 mr-50"></i>
                                        <span class="align-middle" id="user-email">Email</span>
                                    </li>
                                    <li class="mb-1">
                                        <i data-feather="phone-call" class="font-medium-2 mr-50"></i>
                                        <span class="align-middle" id="user-phone">Điện thoại</span>
                                    </li>
                                    <li>
                                        <i data-feather="clock" class="font-medium-2 mr-50"></i>
                                        <span class="align-middle" id="user-work-hour">Mon - Sat 08:30AM - 18:00PM</span>
                                    </li>
                                </ul>
                            </div>
                            <!--/ User's personal information -->

                            <!-- User's Links -->
                            <div class="more-options">
                                <h6 class="section-label mb-1 mt-3">Options</h6>
                                <ul class="list-unstyled">
                                    <li class="cursor-pointer mb-1">
                                        <i data-feather="tag" class="font-medium-2 mr-50"></i>
                                        <span class="align-middle" id="modal-create-group">Tạo nhóm chung</span>
                                    </li>
<!--                                    <li class="cursor-pointer mb-1">-->
<!--                                        <i data-feather="star" class="font-medium-2 mr-50"></i>-->
<!--                                        <span class="align-middle">Important Contact</span>-->
<!--                                    </li>-->
<!--                                    <li class="cursor-pointer mb-1">-->
<!--                                        <i data-feather="image" class="font-medium-2 mr-50"></i>-->
<!--                                        <span class="align-middle">Shared Media</span>-->
<!--                                    </li>-->
<!--                                    <li class="cursor-pointer mb-1">-->
<!--                                        <i data-feather="trash" class="font-medium-2 mr-50"></i>-->
<!--                                        <span class="align-middle">Delete Contact</span>-->
<!--                                    </li>-->
<!--                                    <li class="cursor-pointer">-->
<!--                                        <i data-feather="slash" class="font-medium-2 mr-50"></i>-->
<!--                                        <span class="align-middle">Block Contact</span>-->
<!--                                    </li>-->
                                </ul>
                            </div>
                            <!--/ User's Links -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-slide-in fade"  id="group_modal">
            <div class="modal-dialog sidebar-lg">
                <form class="modal-content" id="fm-group-chat">
                    <div class="modal-header mb-1">
                        <h5 class="modal-title" id="exampleModalLabel">Tạo nhóm chat</h5>
                    </div>
                    <div class="modal-body flex-grow-1">
                        <div class="form-group">
                            <label class="form-label" for="name">Tên nhóm</label>
                            <input type="text" id="title_group" name="title_group"
                                   class="new-todo-item-title form-control" placeholder="Tên nhóm"
                                   required=""/>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Thành viên</label>
                            <select class="form-control task-tag" id="list_users" name="list_users[]"
                                    multiple="multiple" required="">
                            </select>
                        </div>
                        <button type="button" id="btn_edit" class="btn btn-outline-primary" onclick="save_group()">
                            Cập nhật
                        </button>
                        <button type="button" id="rsModal" class="btn btn-outline-secondary" data-dismiss="modal">
                            Đóng
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
<script src="js/chatbox.js"></script>
<script>
    var UserId = '<?=$_SESSION['user']['nhan_vien']?>';
</script>
