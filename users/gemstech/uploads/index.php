<link rel="stylesheet" type="text/css" href="<?= URL ?>/template/app-assets/css/pages/app-chat.min.css">
<link rel="stylesheet" type="text/css" href="<?= URL ?>/template/app-assets/css/pages/app-chat-list.min.css">
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
            <div class="sidebar"><!-- Admin user profile area -->
                <div class="chat-profile-sidebar">
                    <header class="chat-profile-header">
                        <span class="close-icon">
                          <i data-feather="x"></i>
                        </span>
                        <!-- User Information -->
                        <div class="header-profile-sidebar">
                            <div class="avatar box-shadow-1 avatar-xl avatar-border">
                                <img src="<?= URL ?>/template/app-assets/images/portrait/small/avatar-s-11.jpg"
                                     alt="user_avatar"/>
                                <span class="avatar-status-online avatar-status-xl"></span>
                            </div>
                            <h4 class="chat-user-name">John Doe</h4>
                            <span class="user-post">Admin</span>
                        </div>
                        <!--/ User Information -->
                    </header>
                    <!-- User Details start -->
                    <div class="profile-sidebar-area">
                        <h6 class="section-label mb-1">About</h6>
                        <div class="about-user">
      <textarea
              data-length="120"
              class="form-control char-textarea"
              id="textarea-counter"
              rows="5"
              placeholder="About User"
      >
                        Dessert chocolate cake lemon drops jujubes. Biscuit cupcake ice cream bear claw brownie brownie marshmallow.</textarea
      >
                            <small class="counter-value float-right"><span class="char-count">108</span> / 120 </small>
                        </div>
                        <!-- To set user status -->
                        <h6 class="section-label mb-1 mt-3">Status</h6>
                        <ul class="list-unstyled user-status">
                            <li class="pb-1">
                                <div class="custom-control custom-control-success custom-radio">
                                    <input
                                            type="radio"
                                            id="activeStatusRadio"
                                            name="userStatus"
                                            class="custom-control-input"
                                            value="online"
                                            checked
                                    />
                                    <label class="custom-control-label ml-25" for="activeStatusRadio">Active</label>
                                </div>
                            </li>
                            <li class="pb-1">
                                <div class="custom-control custom-control-danger custom-radio">
                                    <input type="radio" id="dndStatusRadio" name="userStatus"
                                           class="custom-control-input" value="busy"/>
                                    <label class="custom-control-label ml-25" for="dndStatusRadio">Do Not
                                        Disturb</label>
                                </div>
                            </li>
                            <li class="pb-1">
                                <div class="custom-control custom-control-warning custom-radio">
                                    <input type="radio" id="awayStatusRadio" name="userStatus"
                                           class="custom-control-input" value="away"/>
                                    <label class="custom-control-label ml-25" for="awayStatusRadio">Away</label>
                                </div>
                            </li>
                            <li class="pb-1">
                                <div class="custom-control custom-control-secondary custom-radio">
                                    <input type="radio" id="offlineStatusRadio" name="userStatus"
                                           class="custom-control-input" value="offline"/>
                                    <label class="custom-control-label ml-25" for="offlineStatusRadio">Offline</label>
                                </div>
                            </li>
                        </ul>
                        <!--/ To set user status -->
                    </div>
                    <!-- User Details end -->
                </div>
                <!--/ Admin user profile area -->

                <!-- Chat Sidebar area -->
                <div class="sidebar-content">
  <span class="sidebar-close-icon">
    <i data-feather="x"></i>
  </span>
                    <!-- Sidebar header start -->
                    <div class="chat-fixed-search">
                        <div class="d-flex align-items-center w-100">
                            <div class="sidebar-profile-toggle">
                                <div class="avatar avatar-border">
                                    <img
                                            src="<?= URL ?>/template/app-assets/images/portrait/small/avatar-s-11.jpg"
                                            alt="user_avatar"
                                            height="42"
                                            width="42"
                                    />
                                    <span class="avatar-status-online"></span>
                                </div>
                            </div>
                            <div class="input-group input-group-merge ml-1 w-100">
                                <div class="input-group-prepend">
                                    <span class="input-group-text round"><i data-feather="search"
                                                                            class="text-muted"></i></span>
                                </div>
                                <input
                                        type="text"
                                        class="form-control round"
                                        id="chat-search"
                                        placeholder="Search or start a new chat"
                                        aria-label="Search..."
                                        aria-describedby="chat-search"
                                />
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar header end -->

                    <!-- Sidebar Users start -->
                    <div id="users-list" class="chat-user-list-wrapper list-group">
                        <h4 class="chat-list-title">Chats</h4>
                            <ul class="chat-users-list chat-list media-list" id="ListsItemChat">

                            </ul>
                        <h4 class="chat-list-title">Contacts</h4>
                        <ul class="chat-users-list contact-list media-list" id="ListContacts">
                            <?php
                            foreach ($this->nhanvien as $nhanvien) {
                                ?>
                                <li value="<?= $nhanvien['id'] ?>" id="Contact_<?= $nhanvien['id'] ?>">
                                <span class="avatar"><img
                                            src="<?= $nhanvien['hinh_anh'] != '' ? $nhanvien['hinh_anh'] : URL . '/template/images/default_avatar.png' ?>"
                                            height="42"
                                            width="42"
                                            alt="Generic placeholder image"/>
                                </span>
                                    <div class="chat-info">
                                        <h5 class="mb-0"><?= $nhanvien['name'] ?></h5>
                                        <p class="card-text text-truncate">

                                        </p>
                                    </div>
                                </li>
                            <?php } ?>
                            <li class="no-results">
                                <h6 class="mb-0">No Contacts Found</h6>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar Users end -->
                </div>
                <!--/ Chat Sidebar area -->

            </div>
        </div>
        <div class="content-right">
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="body-content-overlay"></div>
                    <!-- Main chat area -->
                    <section class="chat-app-window">
                        <!-- To load Conversation -->
                        <div class="start-chat-area">
                            <div class="mb-1 start-chat-icon">
                                <i data-feather="message-square"></i>
                            </div>
                            <h4 class="sidebar-toggle start-chat-text">Chọn nhân viên để bắt đầu</h4>
                        </div>
                        <!--/ To load Conversation -->

                        <!-- Active Chat -->
                        <div class="active-chat d-none">
                            <!-- Chat Header -->
                            <div class="chat-navbar">
                                <header class="chat-header">
                                    <div class="d-flex align-items-center" id="userProfile">
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <button
                                                    class="btn-icon btn btn-transparent hide-arrow btn-sm dropdown-toggle"
                                                    type="button"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i data-feather="more-vertical" id="chat-header-actions"
                                                   class="font-medium-2"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                 aria-labelledby="chat-header-actions">
                                                <a class="dropdown-item" href="javascript:void(0);">Mute
                                                    Notifications</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Report</a>
                                            </div>
                                        </div>
                                    </div>
                                </header>
                            </div>
                            <!--/ Chat Header -->

                            <!-- User Chat messages -->
                            <div class="user-chats" id="boxchat">
                                <div class="chats" id="chatdiv">
                                </div>
                            </div>
                            <!-- User Chat messages -->

                            <!-- Submit Chat form -->
                            <form class="chat-app-form" action="javascript:void(0);" id="fmSendChat">
                                <div class="input-group input-group-merge mr-1 form-send-message">
                                    <!--                                    <div class="input-group-prepend">-->
                                    <!--                                        <span class="speech-to-text input-group-text"><i data-feather="mic"-->
                                    <!--                                                                                         class="cursor-pointer"></i></span>-->
                                    <!--                                    </div>-->
                                    <input type="text" class="form-control message" name="messenger" id="messenger"
                                           placeholder="Type your message or use speech to text"/>
                                    <!--                                    <div class="input-group-append">-->
                                    <!--                                      <span class="input-group-text">-->
                                    <!--                                        <label for="attach-doc" class="attachment-icon mb-0">-->
                                    <!--                                          <i data-feather="image" class="cursor-pointer lighten-2 text-secondary"></i>-->
                                    <!--                                          <input type="file" id="attach-doc" hidden/> </label-->
                                    <!--                                        ></span>-->
                                    <!--                                    </div>-->
                                </div>
                                <button type="submit" class="btn btn-primary send">
                                    <i data-feather="send" class="d-lg-none"></i>
                                    <span class="d-none d-lg-block">Send</span>
                                </button>
                            </form>
                            <!--/ Submit Chat form -->
                        </div>
                        <!--/ Active Chat -->
                    </section>
                    <!--/ Main chat area -->

                    <!-- User Chat profile right area -->
                    <div class="user-profile-sidebar">
                        <header class="user-profile-header">
                            <span class="close-icon">
                              <i data-feather="x"></i>
                            </span>
                            <!-- User Profile image with name -->
                            <div class="header-profile-sidebar">
                                <div class="avatar box-shadow-1 avatar-border avatar-xl">
                                    <img src="<?= URL ?>/template/app-assets/images/portrait/small/avatar-s-7.jpg"
                                         alt="user_avatar" height="70" width="70"/>
                                    <span class="avatar-status-busy avatar-status-lg"></span>
                                </div>
                                <h4 class="chat-user-name">Kristopher Candy</h4>
                                <span class="user-post">UI/UX Designer 👩🏻‍💻</span>
                            </div>
                            <!--/ User Profile image with name -->
                        </header>
                        <div class="user-profile-sidebar-area">
                            <!-- About User -->
                            <h6 class="section-label mb-1">About</h6>
                            <p>Toffee caramels jelly-o tart gummi bears cake I love ice cream lollipop.</p>
                            <!-- About User -->
                            <!-- User's personal information -->
                            <div class="personal-info">
                                <h6 class="section-label mb-1 mt-3">Personal Information</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-1">
                                        <i data-feather="mail" class="font-medium-2 mr-50"></i>
                                        <span class="align-middle">kristycandy@email.com</span>
                                    </li>
                                    <li class="mb-1">
                                        <i data-feather="phone-call" class="font-medium-2 mr-50"></i>
                                        <span class="align-middle">+1(123) 456 - 7890</span>
                                    </li>
                                    <li>
                                        <i data-feather="clock" class="font-medium-2 mr-50"></i>
                                        <span class="align-middle">Mon - Fri 10AM - 8PM</span>
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
                                        <span class="align-middle">Add Tag</span>
                                    </li>
                                    <li class="cursor-pointer mb-1">
                                        <i data-feather="star" class="font-medium-2 mr-50"></i>
                                        <span class="align-middle">Important Contact</span>
                                    </li>
                                    <li class="cursor-pointer mb-1">
                                        <i data-feather="image" class="font-medium-2 mr-50"></i>
                                        <span class="align-middle">Shared Media</span>
                                    </li>
                                    <li class="cursor-pointer mb-1">
                                        <i data-feather="trash" class="font-medium-2 mr-50"></i>
                                        <span class="align-middle">Delete Contact</span>
                                    </li>
                                    <li class="cursor-pointer">
                                        <i data-feather="slash" class="font-medium-2 mr-50"></i>
                                        <span class="align-middle">Block Contact</span>
                                    </li>
                                </ul>
                            </div>
                            <!--/ User's Links -->
                        </div>
                    </div>
                    <!--/ User Chat profile right area -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
<script>
    var UserId = '<?=$_SESSION['user']['nhan_vien']?>';
</script>
