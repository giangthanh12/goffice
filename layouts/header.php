<?php
$model = new model();
$notifications = $model->getNotification();
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <base href="<?= HOME ?>/" />
    <title>G-Office Phần mềm quản lý văn phòng toàn diện</title>
    <link rel="apple-touch-icon" href="<?= HOME ?>/layouts/favicon.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= HOME ?>/layouts/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- Common CSS-->
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/app-assets/vendors/css/jkanban/jkanban.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.0.1/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.2.1/css/fixedHeader.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/components.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/themes/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/themes/bordered-layout.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/themes/semi-dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/calendars/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/editors/quill/katex.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/editors/quill/monokai-sublime.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/editors/quill/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/plugins/forms/form-quill-editor.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/extensions/dragula.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/vendors/css/charts/apexcharts.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/plugins/charts/chart-apex.css"> -->
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-kanban.css">
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/assets/css/style.css">

    <!-- Commons JS -->
    <script>
        var activeurl = window.location.pathname;
        activeurl = activeurl.split("/");
        activeurl = activeurl[3];
        var baseUser = '<?= $_SESSION['user']['staffId']; ?>';
        var baseHome = '<?= HOME ?>';
        let baseUrlFile = '<?= URLFILE ?>';
        let now = '<?= date('Y-m-d H:i:s') ?>';
        let dateNowDMY = '<?= date('d/m/Y') ?>';
        var SipUsername = '<?= $_SESSION['user']['extNum']; ?>';
        var SipPassword = '<?= $_SESSION['user']['sipPass']; ?>';
        var taxCode = '<?= $_SESSION['folder']; ?>';
    </script>
    <!-- het thu vien -->
    <script src="<?= HOME ?>/styles/app-assets/vendors/js/vendors.min.js"></script>
    <script src="<?= HOME ?>/js/lib.js"></script>
    <!-- Thư viện webrtc -->
    <?php
    if (true) {
        echo '
           <link rel="stylesheet" type="text/css" href="' . HOME . '/webrtc/libs/phone.css" />
           <script type="text/javascript" src="' . HOME . '/webrtc/libs/js/sip-0.11.6.min.js"></script>
           <script type="text/javascript" src="' . HOME . '/webrtc/libs/js/fabric-2.4.6.min.js"></script>
           <script type="text/javascript" src="' . HOME . '/webrtc/libs/js/moment-with-locales-2.24.0.min.js"></script>
           <script type="text/javascript" src="' . HOME . '/webrtc/libs/phone.js"></script>
           ';
    }
    ?>
</head>


<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
    <div class="toast toast-basic hide position-fixed" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" style="bottom: 1rem; right: 1rem; z-index: 99999;height: 150px;width: 500px;">'
        <div class="toast-header" style="background-color: #7367F0;">
            <img src="" onerror="this.src='<?= HOME ?>/layouts/useravatar.png'" style="object-fit:cover;" id="avatarSent" t class="mr-1" alt="Toast image" height="18" width="25" />
            <strong class="mr-auto" id="title-alert" style="color: white;"></strong>
            <button type="button" class="ml-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" id="content-alert"></div>
    </div>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item">
                        <a class="nav-link menu-toggle" href="javascript:void(0);">
                            <i class="ficon" data-feather="menu"></i>
                        </a>
                    </li>
                </ul>
                <!-- <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Billy Hopkins" class="avatar pull-up">
                        <img src="<?= HOME ?>/styles/app-assets/images/portrait/small/avatar-s-9.jpg" alt="Avatar" width="33" height="33" /></div>
                    <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Amy Carson" class="avatar pull-up">
                        <img src="<?= HOME ?>/styles/app-assets/images/portrait/small/avatar-s-6.jpg" alt="Avatar" width="33" height="33" />
                    </div>
                    <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Brandon Miles" class="avatar pull-up">
                        <img src="<?= HOME ?>/styles/app-assets/images/portrait/small/avatar-s-8.jpg" alt="Avatar" width="33" height="33" />
                    </div>
                    <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Daisy Weber" class="avatar pull-up">
                        <img src="<?= HOME ?>/styles/app-assets/images/portrait/small/avatar-s-20.jpg" alt="Avatar" width="33" height="33" />
                    </div>
                    <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Jenny Looper" class="avatar pull-up">
                        <img src="<?= HOME ?>/styles/app-assets/images/portrait/small/avatar-s-20.jpg" alt="Avatar" width="33" height="33" />
                    </div>
                    <h6 class="align-self-center cursor-pointer ml-50 mb-0">+42</h6>
                </div> -->
                <ul class="nav navbar-nav bookmark-icons">

                    <li class="nav-item d-lg-block" id="checkIn">
                        <?php
                        if ($model->checkChamCong()) {
                        ?>
                            <button type="button" class="btn btn-warning m-0 p-75" onclick="checkIn()">
                                <i data-feather='check'></i>
                                <span>Chấm công</span>
                            </button>
                        <?php } ?>
                    </li>
                    <li class="nav-item d-lg-block" id="checkOut" >
                        <?php if($model->checkChamCong()) 
                            $class = "d-none";?>
                            
                          
                        <button onclick="<?= isset($page) && $page == 'timekeeping' ? false : 'checkout()' ?>" class="btn btn-success   btn-toggle-sidebar btn-block waves-effect waves-float <?= $class ?> waves-light" id="<?= isset($page) && $page == 'timekeeping' ? 'checkoutBtn' : 'btncheckout' ?>">
                            <span class="align-middle">Checkout</span>
                        </button>

                    </li>
                </ul>
                <div class="avatar-group" style="padding-left:5px;" id="online_users"></div>
                <!-- <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link bookmark-star">
                        <i class="ficon text-warning" data-feather="star"></i>
                    </a>
                    <div class="bookmark-input search-input">
                        <div class="bookmark-input-icon">
                            <i data-feather="search"></i>
                        </div>
                        <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
                        <ul class="search-list search-list-bookmark"></ul>
                    </div>
                </li>
            </ul> -->
            </div>
            <style>
                .bell {
                    animation: bellshake .5s cubic-bezier(.36, .07, .19, .97) both;
                    backface-visibility: hidden;
                    transform-origin: top right;
                }

                @keyframes bellshake {
                    0% {
                        transform: rotate(0);
                    }

                    15% {
                        transform: rotate(5deg);
                    }

                    30% {
                        transform: rotate(-5deg);
                    }

                    45% {
                        transform: rotate(4deg);
                    }

                    60% {
                        transform: rotate(-4deg);
                    }

                    75% {
                        transform: rotate(2deg);
                    }

                    85% {
                        transform: rotate(-2deg);
                    }

                    92% {
                        transform: rotate(1deg);
                    }

                    100% {
                        transform: rotate(0);
                    }
                }
            </style>
            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item dropdown dropdown-notification mr-25">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
                        <i class="ficon bell-icon" data-feather="bell"></i>
                        <div id="showNotifi">
                            <?php if (!empty($notifications)) { ?>
                                <span id="countNotifications" class="badge badge-pill badge-danger badge-up"><?= count($notifications) ?></span>

                            <?php } ?>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 mr-auto">Thông báo</h4>
                                <div id="countNotifications1" class="badge badge-pill badge-light-primary"><?= !empty($notifications) ? count($notifications) : '0' ?> tin</div>
                            </div>
                        </li>
                        <li class="scrollable-container media-list notification-items">
                            <?php foreach ($notifications as $item) { ?>
                                <a data-id="<?= $item['id'] ?>" class="d-flex notification-item<?= $item['id'] ?>" href="<?= HOME ?>/inbox">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left">
                                            <div class="avatar">
                                                <img onerror="this.src='<?= HOME ?>/layouts/useravatar.png'" src="<?php echo ROOT_DIR . '/uploads/nhanvien/' . $item['avatar'] ?>" alt="avatar" width="32" height="32">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p class="media-heading">
                                                <span class="font-weight-bolder"><?= $item['title'] ?></span>
                                            </p>
                                            <small class="notification-text">
                                                <?php
                                                $str = $item['content'];
                                                $arrayStr = explode(' ', $item['content']);
                                                if (count($arrayStr) > 7) {
                                                    $arrayStr = explode(' ', $item['content']);
                                                    $str = implode(' ', array_slice($arrayStr, 0, 7)) . '...';
                                                }
                                                echo $str;
                                                ?>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
                        </li>

                    </ul>
                </li>
                <!-- <li class="nav-item dropdown dropdown-language">
          <a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="flag-icon flag-icon-us"></i>
            <span class="selected-language">English</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
            <a class="dropdown-item" href="javascript:void(0);" data-language="en">
              <i class="flag-icon flag-icon-us"></i> English </a>
            <a class="dropdown-item" href="javascript:void(0);" data-language="fr">
              <i class="flag-icon flag-icon-fr"></i> French </a>
            <a class="dropdown-item" href="javascript:void(0);" data-language="de">
              <i class="flag-icon flag-icon-de"></i> German </a>
            <a class="dropdown-item" href="javascript:void(0);" data-language="pt">
              <i class="flag-icon flag-icon-pt"></i> Portuguese </a>
          </div>
        </li> -->
                <!-- <li class="nav-item d-none d-lg-block">
          <a class="nav-link nav-link-style">
            <i class="ficon" data-feather="moon"></i>
          </a>
        </li> -->
                <!-- <li class="nav-item nav-search">
                <a class="nav-link nav-link-search">
                    <i class="ficon" data-feather="search"></i>
                </a>
                <div class="search-input">
                    <div class="search-input-icon">
                        <i data-feather="search"></i>
                    </div>
                    <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">
                    <div class="search-input-close">
                        <i data-feather="x"></i>
                    </div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li> -->
                <!--            <li class="nav-item d-none d-lg-block">-->
                <!--                <a class="nav-link" href="inbox" data-toggle="tooltip" data-placement="top" title="Email">-->
                <!--                    <i class="ficon" data-feather="mail"></i>-->
                <!--                    <span class="badge badge-pill badge-info badge-up message-item-count">6</span>-->
                <!--                </a>-->
                <!--            </li>-->
                <!--            <li class="nav-item d-none d-lg-block">-->
                <!--                <a class="nav-link" href="chatbox" data-toggle="tooltip" data-placement="top" title="Chat">-->
                <!--                    <i class="ficon" data-feather="message-square"></i>-->
                <!--                    <span class="badge badge-pill badge-danger badge-up cart-item-count">6</span>-->
                <!--                </a>-->
                <!---->
                <!--            </li>-->
                <!--            <li class="nav-item d-none d-lg-block">-->
                <!--                <a class="nav-link" href="calendar" data-toggle="tooltip" data-placement="top" title="Calendar">-->
                <!--                    <i class="ficon" data-feather="calendar"></i>-->
                <!--                    <span class="badge badge-pill badge-info badge-up cart-item-count">6</span>-->
                <!--                </a>-->
                <!--            </li>-->
                <!--            <li class="nav-item d-none d-lg-block">-->
                <!--                <a class="nav-link" href="todo" data-toggle="tooltip" data-placement="top" title="Todo">-->
                <!--                    <i class="ficon" data-feather="check-square"></i>-->
                <!--                    <span class="badge badge-pill badge-info badge-up cart-item-count">6</span>-->
                <!--                </a>-->
                <!--            </li>-->
                <!-- <li class="nav-item dropdown dropdown-cart mr-25">
                <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
                    <i class="ficon" data-feather="shopping-cart"></i>
                    <span class="badge badge-pill badge-info badge-up cart-item-count">6</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">My Cart</h4>
                            <div class="badge badge-pill badge-light-primary">4 Items</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        <div class="media align-items-center">
                            <img class="d-block rounded mr-1" src="styles/app-assets/images/pages/eCommerce/1.png" alt="donuts" width="62">
                            <div class="media-body">
                                <i class="ficon cart-item-remove" data-feather="x"></i>
                                <div class="media-heading">
                                    <h6 class="cart-item-title">
                                        <a class="text-body" href="app-ecommerce-details.html"> Apple watch 5</a>
                                    </h6>
                                    <small class="cart-item-by">By Apple</small>
                                </div>
                                <div class="cart-item-qty">
                                    <div class="input-group">
                                        <input class="touchspin-cart" type="number" value="1">
                                    </div>
                                </div>
                                <h5 class="cart-item-price">$374.90</h5>
                            </div>
                        </div>
                        <div class="media align-items-center">
                            <img class="d-block rounded mr-1" src="styles/app-assets/images/pages/eCommerce/7.png" alt="donuts" width="62">
                            <div class="media-body">
                                <i class="ficon cart-item-remove" data-feather="x"></i>
                                <div class="media-heading">
                                    <h6 class="cart-item-title">
                                        <a class="text-body" href="app-ecommerce-details.html"> Google Home Mini</a>
                                    </h6>
                                    <small class="cart-item-by">By Google</small>
                                </div>
                                <div class="cart-item-qty">
                                    <div class="input-group">
                                        <input class="touchspin-cart" type="number" value="3">
                                    </div>
                                </div>
                                <h5 class="cart-item-price">$129.40</h5>
                            </div>
                        </div>
                        <div class="media align-items-center">
                            <img class="d-block rounded mr-1" src="styles/app-assets/images/pages/eCommerce/2.png" alt="donuts" width="62">
                            <div class="media-body">
                                <i class="ficon cart-item-remove" data-feather="x"></i>
                                <div class="media-heading">
                                    <h6 class="cart-item-title">
                                        <a class="text-body" href="app-ecommerce-details.html"> iPhone 11 Pro</a>
                                    </h6>
                                    <small class="cart-item-by">By Apple</small>
                                </div>
                                <div class="cart-item-qty">
                                    <div class="input-group">
                                        <input class="touchspin-cart" type="number" value="2">
                                    </div>
                                </div>
                                <h5 class="cart-item-price">$699.00</h5>
                            </div>
                        </div>
                        <div class="media align-items-center">
                            <img class="d-block rounded mr-1" src="styles/app-assets/images/pages/eCommerce/3.png" alt="donuts" width="62">
                            <div class="media-body">
                                <i class="ficon cart-item-remove" data-feather="x"></i>
                                <div class="media-heading">
                                    <h6 class="cart-item-title">
                                        <a class="text-body" href="app-ecommerce-details.html"> iMac Pro</a>
                                    </h6>
                                    <small class="cart-item-by">By Apple</small>
                                </div>
                                <div class="cart-item-qty">
                                    <div class="input-group">
                                        <input class="touchspin-cart" type="number" value="1">
                                    </div>
                                </div>
                                <h5 class="cart-item-price">$4,999.00</h5>
                            </div>
                        </div>
                        <div class="media align-items-center">
                            <img class="d-block rounded mr-1" src="styles/app-assets/images/pages/eCommerce/5.png" alt="donuts" width="62">
                            <div class="media-body">
                                <i class="ficon cart-item-remove" data-feather="x"></i>
                                <div class="media-heading">
                                    <h6 class="cart-item-title">
                                        <a class="text-body" href="app-ecommerce-details.html"> MacBook Pro</a>
                                    </h6>
                                    <small class="cart-item-by">By Apple</small>
                                </div>
                                <div class="cart-item-qty">
                                    <div class="input-group">
                                        <input class="touchspin-cart" type="number" value="1">
                                    </div>
                                </div>
                                <h5 class="cart-item-price">$2,999.00</h5>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown-menu-footer">
                        <div class="d-flex justify-content-between mb-1">
                            <h6 class="font-weight-bolder mb-0">Total:</h6>
                            <h6 class="text-primary font-weight-bolder mb-0">$10,999.00</h6>
                        </div>
                        <a class="btn btn-primary btn-block" href="app-ecommerce-checkout.html">Checkout</a>
                    </li>
                </ul>
            </li> -->
                <!--            <li class="nav-item dropdown dropdown-notification mr-25">-->
                <!--                <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">-->
                <!--                    <i class="ficon" data-feather="bell"></i>-->
                <!--                    <span class="badge badge-pill badge-danger badge-up">5</span>-->
                <!--                </a>-->
                <!--                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">-->
                <!--                    <li class="dropdown-menu-header">-->
                <!--                        <div class="dropdown-header d-flex">-->
                <!--                            <h4 class="notification-title mb-0 mr-auto">Notifications</h4>-->
                <!--                            <div class="badge badge-pill badge-light-primary">6 New</div>-->
                <!--                        </div>-->
                <!--                    </li>-->
                <!--                    <li class="scrollable-container media-list">-->
                <!--                        <a class="d-flex" href="javascript:void(0)">-->
                <!--                            <div class="media d-flex align-items-start">-->
                <!--                                <div class="media-left">-->
                <!--                                    <div class="avatar">-->
                <!--                                        <img src="styles/app-assets/images/portrait/small/avatar-s-15.jpg" alt="avatar"-->
                <!--                                             width="32" height="32">-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                                <div class="media-body">-->
                <!--                                    <p class="media-heading">-->
                <!--                                        <span class="font-weight-bolder">Congratulation Sam 🎉</span>winner!-->
                <!--                                    </p>-->
                <!--                                    <small class="notification-text"> Won the monthly best seller badge.</small>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </a>-->
                <!--                        <a class="d-flex" href="javascript:void(0)">-->
                <!--                            <a class="d-flex" href="javascript:void(0)">-->
                <!--                                <div class="media d-flex align-items-start">-->
                <!--                                    <div class="media-left">-->
                <!--                                        <div class="avatar">-->
                <!--                                            <img src="styles/app-assets/images/portrait/small/avatar-s-3.jpg"-->
                <!--                                                 alt="avatar" width="32" height="32">-->
                <!--                                        </div>-->
                <!--                                    </div>-->
                <!--                                    <div class="media-body">-->
                <!--                                        <p class="media-heading">-->
                <!--                                            <span class="font-weight-bolder">New message</span>&nbsp;received-->
                <!--                                        </p>-->
                <!--                                        <small class="notification-text"> You have 10 unread messages</small>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                            </a>-->
                <!--                            <a class="d-flex" href="javascript:void(0)">-->
                <!--                                <div class="media d-flex align-items-start">-->
                <!--                                    <div class="media-left">-->
                <!--                                        <div class="avatar bg-light-danger">-->
                <!--                                            <div class="avatar-content">MD</div>-->
                <!--                                        </div>-->
                <!--                                    </div>-->
                <!--                                    <div class="media-body">-->
                <!--                                        <p class="media-heading">-->
                <!--                                            <span class="font-weight-bolder">Revised Order 👋</span>&nbsp;checkout-->
                <!--                                        </p>-->
                <!--                                        <small class="notification-text"> MD Inc. order updated</small>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                            </a>-->
                <!--                            <div class="media d-flex align-items-center">-->
                <!--                                <h6 class="font-weight-bolder mr-auto mb-0">System Notifications</h6>-->
                <!--                                <div class="custom-control custom-control-primary custom-switch">-->
                <!--                                    <input class="custom-control-input" id="systemNotification" type="checkbox"-->
                <!--                                           checked="">-->
                <!--                                    <label class="custom-control-label" for="systemNotification"></label>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                            <a class="d-flex" href="javascript:void(0)">-->
                <!--                                <div class="media d-flex align-items-start">-->
                <!--                                    <div class="media-left">-->
                <!--                                        <div class="avatar bg-light-danger">-->
                <!--                                            <div class="avatar-content">-->
                <!--                                                <i class="avatar-icon" data-feather="x"></i>-->
                <!--                                            </div>-->
                <!--                                        </div>-->
                <!--                                    </div>-->
                <!--                                    <div class="media-body">-->
                <!--                                        <p class="media-heading">-->
                <!--                                            <span class="font-weight-bolder">Server down</span>&nbsp;registered-->
                <!--                                        </p>-->
                <!--                                        <small class="notification-text"> USA Server is down due to hight CPU-->
                <!--                                            usage</small>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                            </a>-->
                <!--                            <a class="d-flex" href="javascript:void(0)">-->
                <!--                                <div class="media d-flex align-items-start">-->
                <!--                                    <div class="media-left">-->
                <!--                                        <div class="avatar bg-light-success">-->
                <!--                                            <div class="avatar-content">-->
                <!--                                                <i class="avatar-icon" data-feather="check"></i>-->
                <!--                                            </div>-->
                <!--                                        </div>-->
                <!--                                    </div>-->
                <!--                                    <div class="media-body">-->
                <!--                                        <p class="media-heading">-->
                <!--                                            <span class="font-weight-bolder">Sales report</span>&nbsp;generated-->
                <!--                                        </p>-->
                <!--                                        <small class="notification-text"> Last month sales report generated</small>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                            </a>-->
                <!--                            <a class="d-flex" href="javascript:void(0)">-->
                <!--                                <div class="media d-flex align-items-start">-->
                <!--                                    <div class="media-left">-->
                <!--                                        <div class="avatar bg-light-warning">-->
                <!--                                            <div class="avatar-content">-->
                <!--                                                <i class="avatar-icon" data-feather="alert-triangle"></i>-->
                <!--                                            </div>-->
                <!--                                        </div>-->
                <!--                                    </div>-->
                <!--                                    <div class="media-body">-->
                <!--                                        <p class="media-heading">-->
                <!--                                            <span class="font-weight-bolder">High memory</span>&nbsp;usage-->
                <!--                                        </p>-->
                <!--                                        <small class="notification-text"> BLR Server using high memory</small>-->
                <!--                                    </div>-->
                <!--                                </div>-->
                <!--                            </a>-->
                <!--                    </li>-->
                <!--                    <li class="dropdown-menu-footer">-->
                <!--                        <a class="btn btn-primary btn-block" href="javascript:void(0)">Read all notifications</a>-->
                <!--                    </li>-->
                <!--                </ul>-->
                <!--            </li>-->
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name font-weight-bolder" id="hungsua1"><?= $_SESSION['user']['staffName'] ?></span>
                        </div>
                        <span class="avatar">
                            <img class="round" onerror="this.src='<?= HOME ?>/layouts/useravatar.png'" src="<?= URLFILE . '/uploads/nhanvien/' . $_SESSION['user']['avatar'] ?>" alt="avatar" height="40" width="40" id="hungsua2">
                            <span class="avatar-status-online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="accountsettings">
                            <i class="mr-50" data-feather="user"></i> Profile </a>
                        <!-- <a class="dropdown-item" href="app-email.html">
                            <i class="mr-50" data-feather="mail"></i> Inbox </a>
                        <a class="dropdown-item" href="app-todo.html">
                            <i class="mr-50" data-feather="check-square"></i> Task </a>
                        <a class="dropdown-item" href="app-chat.html">
                            <i class="mr-50" data-feather="message-square"></i> Chats </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="page-account-settings.html">
                            <i class="mr-50" data-feather="settings"></i> Settings </a>
                        <a class="dropdown-item" href="page-pricing.html">
                            <i class="mr-50" data-feather="credit-card"></i> Pricing </a>
                        <a class="dropdown-item" href="page-faq.html">
                            <i class="mr-50" data-feather="help-circle"></i> FAQ </a> -->
                        <a class="dropdown-item" href="javascript:void()" onclick="logout()">
                            <i class="mr-50" data-feather="power"></i> Logout </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <ul class="main-search-list-defaultlist d-none">
        <li class="d-flex align-items-center">
            <a href="javascript:void(0);">
                <h6 class="section-label mt-75 mb-0">Files</h6>
            </a>
        </li>
        <li class="auto-suggestion">
            <a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                <div class="d-flex">
                    <div class="mr-75">
                        <img src="styles/app-assets/images/icons/xls.png" alt="png" height="32">
                    </div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Two new item submitted</p>
                        <small class="text-muted">Marketing Manager</small>
                    </div>
                </div>
                <small class="search-data-size mr-50 text-muted">&apos;17kb</small>
            </a>
        </li>
        <li class="auto-suggestion">
            <a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                <div class="d-flex">
                    <div class="mr-75">
                        <img src="styles/app-assets/images/icons/jpg.png" alt="png" height="32">
                    </div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">52 JPG file Generated</p>
                        <small class="text-muted">FontEnd Developer</small>
                    </div>
                </div>
                <small class="search-data-size mr-50 text-muted">&apos;11kb</small>
            </a>
        </li>
        <li class="auto-suggestion">
            <a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                <div class="d-flex">
                    <div class="mr-75">
                        <img src="styles/app-assets/images/icons/pdf.png" alt="png" height="32">
                    </div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">25 PDF File Uploaded</p>
                        <small class="text-muted">Digital Marketing Manager</small>
                    </div>
                </div>
                <small class="search-data-size mr-50 text-muted">&apos;150kb</small>
            </a>
        </li>
        <li class="auto-suggestion">
            <a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                <div class="d-flex">
                    <div class="mr-75">
                        <img src="styles/app-assets/images/icons/doc.png" alt="png" height="32">
                    </div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Anna_Strong.doc</p>
                        <small class="text-muted">Web Designer</small>
                    </div>
                </div>
                <small class="search-data-size mr-50 text-muted">&apos;256kb</small>
            </a>
        </li>
        <li class="d-flex align-items-center">
            <a href="javascript:void(0);">
                <h6 class="section-label mt-75 mb-0">Members</h6>
            </a>
        </li>
        <li class="auto-suggestion">
            <a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-75">
                        <img src="styles/app-assets/images/portrait/small/avatar-s-8.jpg" alt="png" height="32">
                    </div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">John Doe</p>
                        <small class="text-muted">UI designer</small>
                    </div>
                </div>
            </a>
        </li>
        <li class="auto-suggestion">
            <a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-75">
                        <img src="styles/app-assets/images/portrait/small/avatar-s-1.jpg" alt="png" height="32">
                    </div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Michal Clark</p>
                        <small class="text-muted">FontEnd Developer</small>
                    </div>
                </div>
            </a>
        </li>
        <li class="auto-suggestion">
            <a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-75">
                        <img src="styles/app-assets/images/portrait/small/avatar-s-14.jpg" alt="png" height="32">
                    </div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Milena Gibson</p>
                        <small class="text-muted">Digital Marketing Manager</small>
                    </div>
                </div>
            </a>
        </li>
        <li class="auto-suggestion">
            <a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-75">
                        <img src="styles/app-assets/images/portrait/small/avatar-s-6.jpg" alt="png" height="32">
                    </div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Anna Strong</p>
                        <small class="text-muted">Web Designer</small>
                    </div>
                </div>
            </a>
        </li>
    </ul>
    <ul class="main-search-list-defaultlist-other-list d-none">
        <li class="auto-suggestion justify-content-between">
            <a class="d-flex align-items-center justify-content-between w-100 py-50">
                <div class="d-flex justify-content-start">
                    <span class="mr-75" data-feather="alert-circle"></span>
                    <span>No results found.</span>
                </div>
            </a>
        </li>
    </ul>
    <!-- END: Header-->
    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">

                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="<?= HOME ?>">

                        <!-- <h2 class="brand-text">G-OFFICEx</h2> -->
                        <?php
                        $logo = $model->getLogo();
                        foreach ($logo as $item) {
                        ?>
                            <?php
                            if ($item['id'] == 7) {
                            ?>
                                <div id="maxlogo">
                                    <img onerror="this.src='<?= HOME ?>/layouts/g-office-logo.png'" src="<?=  $item['value'] ?>" height="30" alt="logo">
                                </div>
                            <?php } else { ?>
                                <div class="brand-logo d-none" id="minlogo">
                                    <img onerror="this.src='<?= HOME ?>/layouts/favicon.png'" src="<?=  $item['value'] ?>" height="36" />
                                </div>
                            <?php
                            }
                            ?>
                    </a>
                <?php } ?>
                </li>

                <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse" onclick="togglelogo()">
                        <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                        <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                    </a>
                </li>

            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="">
                        <!-- <i data-feather="home"></i> -->
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.75 15C5.50684 15 6.19434 14.699 6.70044 14.2109L9.45972 15.5906C9.44556 15.7043 9.4375 15.8198 9.4375 15.9375C9.4375 17.4883 10.6992 18.75 12.25 18.75C13.8008 18.75 15.0625 17.4883 15.0625 15.9375C15.0625 15.5039 14.9636 15.0928 14.7876 14.7256L18.5381 10.9751C18.9053 11.1511 19.3164 11.25 19.75 11.25C21.3008 11.25 22.5625 9.98828 22.5625 8.4375C22.5625 8.14453 22.5173 7.86206 22.4338 7.59644L25.6921 5.15283C26.1384 5.45093 26.6741 5.625 27.25 5.625C28.8008 5.625 30.0625 4.36328 30.0625 2.8125C30.0625 1.26172 28.8008 0 27.25 0C25.6992 0 24.4375 1.26172 24.4375 2.8125C24.4375 3.10547 24.4827 3.38794 24.5662 3.65356L21.3079 6.09717C20.8616 5.79907 20.3259 5.625 19.75 5.625C18.1992 5.625 16.9375 6.88672 16.9375 8.4375C16.9375 8.87109 17.0364 9.28223 17.2124 9.64941L13.4619 13.3999C13.0947 13.2239 12.6836 13.125 12.25 13.125C11.4932 13.125 10.8057 13.426 10.2996 13.9141L7.54028 12.5344C7.55444 12.4207 7.5625 12.3052 7.5625 12.1875C7.5625 10.6367 6.30078 9.375 4.75 9.375C3.19922 9.375 1.9375 10.6367 1.9375 12.1875C1.9375 13.7383 3.19922 15 4.75 15ZM27.25 1.875C27.7668 1.875 28.1875 2.29565 28.1875 2.8125C28.1875 3.32935 27.7668 3.75 27.25 3.75C26.7332 3.75 26.3125 3.32935 26.3125 2.8125C26.3125 2.29565 26.7332 1.875 27.25 1.875ZM19.75 7.5C20.2668 7.5 20.6875 7.92065 20.6875 8.4375C20.6875 8.95435 20.2668 9.375 19.75 9.375C19.2332 9.375 18.8125 8.95435 18.8125 8.4375C18.8125 7.92065 19.2332 7.5 19.75 7.5ZM12.25 15C12.7668 15 13.1875 15.4207 13.1875 15.9375C13.1875 16.4543 12.7668 16.875 12.25 16.875C11.7332 16.875 11.3125 16.4543 11.3125 15.9375C11.3125 15.4207 11.7332 15 12.25 15ZM4.75 11.25C5.26685 11.25 5.6875 11.6707 5.6875 12.1875C5.6875 12.7043 5.26685 13.125 4.75 13.125C4.23315 13.125 3.8125 12.7043 3.8125 12.1875C3.8125 11.6707 4.23315 11.25 4.75 11.25Z" fill="black" />
                            <path d="M31.0625 30.125H30.0625V10.3125C30.0625 9.79468 29.6428 9.375 29.125 9.375H25.375C24.8572 9.375 24.4375 9.79468 24.4375 10.3125V30.125H22.5625V15.9375C22.5625 15.4197 22.1428 15 21.625 15H17.875C17.3572 15 16.9375 15.4197 16.9375 15.9375V30.125H15.0625V23.4375C15.0625 22.9197 14.6428 22.5 14.125 22.5H10.375C9.85718 22.5 9.4375 22.9197 9.4375 23.4375V30.125H7.5625V19.6875C7.5625 19.1697 7.14282 18.75 6.625 18.75H2.875C2.35718 18.75 1.9375 19.1697 1.9375 19.6875V30.125H0.9375C0.419678 30.125 0 30.5447 0 31.0625C0 31.5803 0.419678 32 0.9375 32H31.0625C31.5803 32 32 31.5803 32 31.0625C32 30.5447 31.5803 30.125 31.0625 30.125ZM26.3125 11.25H28.1875V30.125H26.3125V11.25ZM18.8125 16.875H20.6875V30.125H18.8125V16.875ZM11.3125 24.375H13.1875V30.125H11.3125V24.375ZM3.8125 20.625H5.6875V30.125H3.8125V20.625Z" fill="black" />
                        </svg>


                        <span class="menu-title text-truncate" data-i18n="Dashboards">INSIGHT</span>
                    </a>
                </li>
                <?php
                $url = isset($_GET['url']) ? $_GET['url'] : null;
                $url = rtrim($url, '/');
                $url = explode('/', $url);
                if ($_SESSION['user']['classify'] == 1) {
                ?>
                    <li class="navigation-header">
                        <span data-i18n="Admin">Admin</span>
                        <i data-feather="more-horizontal"></i>
                    </li>
                    <li class=" nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <!-- <i data-feather="user-define"></i> -->
                            <img class="mr-2" src="<?= HOME ?>/layouts/icon/admin.svg" width="20" height="20" alt="admin.svg" />
                            <span class="menu-title text-truncate" data-i18n="File Manager">Quản lý tài khoản</span>
                        </a>
                        <ul class="menu-content">
                            <li <?= ($url[0] == 'group_roles') ? 'class="active"' : '' ?>>
                                <a class="d-flex align-items-center" href="group_roles">
                                    <!-- <i data-feather="group-roles"></i> -->
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="16" height="16" rx="8" fill="black" />
                                    </svg>
                                    <span class="menu-item text-truncate" data-i18n="LoginV1">Nhóm quyền hạn</span>
                                </a>
                            </li>
                            <li <?= ($url[0] == 'listusers') ? 'class="active"' : '' ?>>
                                <a class="d-flex align-items-center" href="listusers">
                                    <!-- <i data-feather="list-users"></i> -->
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="16" height="16" rx="8" fill="black" />
                                    </svg>
                                    <span class="menu-item text-truncate" data-i18n="LoginV1">Danh sách tài khoản</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <!--            Truy cập nhanh-->
                <li class="navigation-header">
                    <span data-i18n="Truy cập nhanh">Truy cập nhanh</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                <?php
                $menus = $model->getMenus(0, 3);
                foreach ($menus as $parMenu) {
                    $hasSub = 0;
                    if ($parMenu['link'] == $url[0])
                        $active = 'active';
                    else
                        $active = '';
                    $parId = $parMenu['id'];
                    $subMenus = $model->getMenus($parId, 3);
                    $hasSub = count($subMenus);
                ?>
                    <li class="<?= $active ?> nav-item">
                        <a class="d-flex align-items-center" href="<?= $parMenu['link'] ?>">
                            <!-- <i class="<?= $parMenu['icon'] ?>"></i> -->
                            <img class="mr-2" src="<?= HOME ?>/layouts/icon/<?= $parMenu['icon'] ?>" width="20" height="20" alt="<?= $parMenu['icon'] ?>" />
                            <span class="menu-title text-truncate" data-i18n="<?= $parMenu['name'] ?>"><?= $parMenu['name'] ?></span>
                        </a>
                        <?php
                        if ($hasSub > 0) {
                        ?>
                            <ul class="menu-content">
                                <?php
                                foreach ($subMenus as $subMenu) {
                                    if ($subMenu['link'] == $url[0])
                                        $activeSub = 'class="active"';
                                    else
                                        $activeSub = '';
                                    $parId2 = $subMenu['id'];
                                    $subMenus2 = $model->getMenus($parId2, 3);
                                    $hasSub2 = count($subMenus2);
                                ?>
                                    <li <?= $activeSub ?>>
                                        <a class="d-flex align-items-center" href="<?= $subMenu['link'] ?>">
                                            <!-- <i class="<?= $subMenu['icon'] ?>"></i> -->
                                            <img class="mr-2" onerror="this.src=\''+baseHome+'/layouts/icon/sub-menu1.svg\'" src="<?= HOME ?>/layouts/icon/<?= $subMenu['icon'] ?>" width="11" height="11" alt="<?= $subMenu['icon'] ?>" />
                                            <span class="menu-item text-truncate" data-i18n="<?= $subMenu['name'] ?>"><?= $subMenu['name'] ?></span>
                                        </a>
                                        <?php
                                        if ($hasSub2 > 0) {
                                        ?>
                                            <ul class="menu-content">
                                                <?php
                                                foreach ($subMenus2 as $subMenu2) {
                                                    if ($subMenu2['link'] == $url[0])
                                                        $activeSub2 = 'class="active"';
                                                    else
                                                        $activeSub2 = '';
                                                ?>
                                                    <li <?= $activeSub2 ?>>
                                                        <a class="d-flex align-items-center" href="<?= $subMenu2['link'] ?>">
                                                            <!-- <i class="<?= $subMenu2['icon'] ?>"></i> -->
                                                            <img class="mr-2" onerror="this.src=\''+baseHome+'/layouts/icon/sub-menu2.svg\'" src="<?= HOME ?>/layouts/icon/<?= $subMenu2['icon'] ?>" width="11" height="11" alt="<?= $subMenu2['icon'] ?>" />
                                                            <span class="menu-item text-truncate" data-i18n="<?= $subMenu2['name'] ?>"><?= $subMenu2['name'] ?></span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
                <!--            Platform-->
                <li class="navigation-header">
                    <span data-i18n="Platform">Platform</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                <?php
                $model = new model();
                $menus = $model->getMenus(0, 1);
                foreach ($menus as $parMenu) {
                    $hasSub = 0;
                    if ($parMenu['link'] == $url[0])
                        $active = 'active';
                    else
                        $active = '';
                    $parId = $parMenu['id'];
                    $subMenus = $model->getMenus($parId, 1);
                    $hasSub = count($subMenus);
                ?>
                    <li class="<?= $active ?> nav-item">
                        <a class="d-flex align-items-center" href="<?= $parMenu['link'] ?>">
                            <!-- <i class="<?= $parMenu['icon'] ?>"></i> -->
                            <img class="mr-2" src="<?= HOME ?>/layouts/icon/<?= $parMenu['icon'] ?>" width="20" height="20" alt="<?= $parMenu['icon'] ?>" />
                            <span class="menu-title text-truncate" data-i18n="<?= $parMenu['name'] ?>"><?= $parMenu['name'] ?></span>
                        </a>
                        <?php
                        if ($hasSub > 0) {
                        ?>
                            <ul class="menu-content">
                                <?php
                                foreach ($subMenus as $subMenu) {
                                    if ($subMenu['link'] == $url[0])
                                        $activeSub = 'class="active"';
                                    else
                                        $activeSub = '';
                                    $parId2 = $subMenu['id'];
                                    $subMenus2 = $model->getMenus($parId2, 1);
                                    $hasSub2 = count($subMenus2);
                                ?>
                                    <li <?= $activeSub ?>>
                                        <a class="d-flex align-items-center" href="<?= $subMenu['link'] ?>">
                                            <!-- <i class="<?= $subMenu['icon'] ?>"></i> -->
                                            <img class="mr-2" onerror="this.src=\''+baseHome+'/layouts/icon/sub-menu1.svg\'" src="<?= HOME ?>/layouts/icon/<?= $subMenu['icon'] ?>" width="11" height="11" alt="<?= $subMenu['icon'] ?>" />
                                            <span class="menu-item text-truncate" data-i18n="<?= $subMenu['name'] ?>"><?= $subMenu['name'] ?></span>
                                        </a>
                                        <?php
                                        if ($hasSub2 > 0) {
                                        ?>
                                            <ul class="menu-content">
                                                <?php
                                                foreach ($subMenus2 as $subMenu2) {
                                                    if ($subMenu2['link'] == $url[0])
                                                        $activeSub2 = 'class="active"';
                                                    else
                                                        $activeSub2 = '';
                                                ?>
                                                    <li <?= $activeSub2 ?>>
                                                        <a class="d-flex align-items-center" href="<?= $subMenu2['link'] ?>">
                                                            <!-- <i class="<?= $subMenu2['icon'] ?>"></i> -->
                                                            <img class="mr-2" onerror="this.src=\''+baseHome+'/layouts/sub-menu2.svg\'" src="<?= HOME ?>/layouts/icon/<?= $subMenu2['icon'] ?>" width="11" height="11" alt="<?= $subMenu2['icon'] ?>" />
                                                            <span class="menu-item text-truncate" data-i18n="<?= $subMenu2['name'] ?>"><?= $subMenu2['name'] ?></span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="navbar-footer" style="padding-left: 25px; padding-top: 15px;">
            <div class="brand-logo d-none" id="minlogo-footer">
                <img src="layouts/favicon.png" height="26" />
            </div>
            <!-- <h2 class="brand-text">G-OFFICEx</h2> -->
            <div id="maxlogo-footer">
                <img src="layouts/g-office-logo.png" height="20" alt="logo">
            </div>
            <div id="qrcode-footer">
                 <img style="width:40%" src="<?= HOME ?>/layouts/qr1.jpg" alt="">
                 <img style="width:40%" src="<?= HOME ?>/layouts/qr2.jpg" alt="">
            </div>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- <div id="Phone"></div> -->
    <div class="modal fade text-left" id="dlg-call" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" value="">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Calling...</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span> -->
                    </button>
                </div>
                <div class="modal-body">
                    <div class="sidebar-left">
                        <img id="mess_avatar" src="https://velo.vn/goffice/layouts/useravatar.png" alt="Generic placeholder image" height="60" />
                        <br>
                        <h5 id="mess_sender">Khách hàng</h5>
                    </div>
                    <div class="content-right" style="width: calc(100vw - (100vw - 100%) - 100px); !Important">
                        <div class="mail-message">
                            <h5 id="mess_subject">Đang gọi...</h5>
                            <p class="mb-0 " id="calling_number">0903260271</p>
                        </div>
                    </div>
                    <!-- <div class="media-left pr-50">
                <div class="avatar">
                    <img id="mess_avatar" src="https://velo.vn/goffice/users/gemstech/uploads/nhanvien/7.3.png" alt="Generic placeholder image"  height="60"/>
                </div>
                </div> -->
                    <div class="media-body d-none" id="forcall">
                        <!-- <div class="mail-details">
                        <div class="mail-items">
                            <h5 class="mb-25" id="mess_sender">xxx</h5>
                            <span class="text-truncate mb-0" id="mess_subject">zzzz</span>
                        </div>
                        <div class="mail-meta-item">
                            <i data-feather="paperclip"></i>
                            <span class="mx-50 bullet bullet-warning bullet-sm"></span>
                            <span class="mail-date" id="mail-date"></span>
                        </div>
                    </div>
                    <div class="mail-message">
                        <p class="mb-0 " id="mess_body">zzzzzzzzzzzz</p>
                    </div>-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="xemchitiet" href="inbox" class="btn btn-info" onclick="endcall()">Kết thúc</button>
                    <!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button> -->
                </div>
            </div>
        </div>
    </div>