<!DOCTYPE html>

<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">

  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">

    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">

    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">

    <meta name="author" content="PIXINVENT">

    <base href="<?=URL?>/" />

    <title>G-Office Phần mềm quản lý văn phòng toàn diện</title>

    <link rel="apple-touch-icon" href="<?=HOME?>/layouts/favicon.png">

    <link rel="shortcut icon" type="image/x-icon" href="<?=HOME?>/layouts/favicon.png">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">



    <!-- Common CSS-->

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/vendors/css/vendors.min.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/vendors/css/extensions/toastr.min.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/plugins/extensions/ext-component-toastr.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/vendors/css/forms/select/select2.min.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/plugins/forms/form-validation.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/bootstrap-extended.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/colors.min.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/components.min.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/themes/dark-layout.min.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/themes/bordered-layout.min.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/themes/semi-dark-layout.min.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/core/menu/menu-types/vertical-menu.min.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/assets/css/style.css">

    <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/fonts/font-awesome/css/font-awesome.min.css">


    <!-- Commons JS -->

    <script src="<?=HOME?>/styles/app-assets/vendors/js/vendors.min.js"></script>

    <script src="<?=HOME?>/js/lib.js"></script>

    <!-- <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css"> -->

    <!-- <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/plugins/forms/form-validation.css"> -->

    <!-- <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/vendors/css/charts/apexcharts.css"> -->

    <!-- <link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/plugins/charts/chart-apex.css"> -->

    <script>

        let baseApi = '<?=URLAPI;?>';

        let baseHome = '<?=HOME?>';

        let now = '<?=date('Y-m-d H:i:s')?>';

    </script>



  </head>

  <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

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

          <ul class="nav navbar-nav bookmark-icons">

            <li class="nav-item d-none d-lg-block">

              <a class="nav-link" href="app-email.html" data-toggle="tooltip" data-placement="top" title="Email">

                <i class="ficon" data-feather="mail"></i>

              </a>

            </li>

            <li class="nav-item d-none d-lg-block">

              <a class="nav-link" href="chatbox" data-toggle="tooltip" data-placement="top" title="Chat">

                <i class="ficon" data-feather="message-square"></i>

              </a>

            </li>

            <li class="nav-item d-none d-lg-block">

              <a class="nav-link" href="app-calendar.html" data-toggle="tooltip" data-placement="top" title="Calendar">

                <i class="ficon" data-feather="calendar"></i>

              </a>

            </li>

            <li class="nav-item d-none d-lg-block">

              <a class="nav-link" href="app-todo.html" data-toggle="tooltip" data-placement="top" title="Todo">

                <i class="ficon" data-feather="check-square"></i>

              </a>

            </li>

          </ul>

          <ul class="nav navbar-nav">

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

          </ul>

        </div>

        <ul class="nav navbar-nav align-items-center ml-auto">

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

          <li class="nav-item nav-search">

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

          </li>

          <li class="nav-item dropdown dropdown-cart mr-25">

            <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">

              <i class="ficon" data-feather="shopping-cart"></i>

              <span class="badge badge-pill badge-primary badge-up cart-item-count">6</span>

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

          </li>

          <li class="nav-item dropdown dropdown-notification mr-25">

            <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">

              <i class="ficon" data-feather="bell"></i>

              <span class="badge badge-pill badge-danger badge-up">5</span>

            </a>

            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">

              <li class="dropdown-menu-header">

                <div class="dropdown-header d-flex">

                  <h4 class="notification-title mb-0 mr-auto">Notifications</h4>

                  <div class="badge badge-pill badge-light-primary">6 New</div>

                </div>

              </li>

              <li class="scrollable-container media-list">

                <a class="d-flex" href="javascript:void(0)">

                  <div class="media d-flex align-items-start">

                    <div class="media-left">

                      <div class="avatar">

                        <img src="styles/app-assets/images/portrait/small/avatar-s-15.jpg" alt="avatar" width="32" height="32">

                      </div>

                    </div>

                    <div class="media-body">

                      <p class="media-heading">

                        <span class="font-weight-bolder">Congratulation Sam 🎉</span>winner!

                      </p>

                      <small class="notification-text"> Won the monthly best seller badge.</small>

                    </div>

                  </div>

                </a>

                <a class="d-flex" href="javascript:void(0)">

                  <div class="media d-flex align-items-start">

                    <div class="media-left">

                      <div class="avatar">

                        <img src="styles/app-assets/images/portrait/small/avatar-s-3.jpg" alt="avatar" width="32" height="32">

                      </div>

                    </div>

                    <div class="media-body">

                      <p class="media-heading">

                        <span class="font-weight-bolder">New message</span>&nbsp;received

                      </p>

                      <small class="notification-text"> You have 10 unread messages</small>

                    </div>

                  </div>

                </a>

                <a class="d-flex" href="javascript:void(0)">

                  <div class="media d-flex align-items-start">

                    <div class="media-left">

                      <div class="avatar bg-light-danger">

                        <div class="avatar-content">MD</div>

                      </div>

                    </div>

                    <div class="media-body">

                      <p class="media-heading">

                        <span class="font-weight-bolder">Revised Order 👋</span>&nbsp;checkout

                      </p>

                      <small class="notification-text"> MD Inc. order updated</small>

                    </div>

                  </div>

                </a>

                <div class="media d-flex align-items-center">

                  <h6 class="font-weight-bolder mr-auto mb-0">System Notifications</h6>

                  <div class="custom-control custom-control-primary custom-switch">

                    <input class="custom-control-input" id="systemNotification" type="checkbox" checked="">

                    <label class="custom-control-label" for="systemNotification"></label>

                  </div>

                </div>

                <a class="d-flex" href="javascript:void(0)">

                  <div class="media d-flex align-items-start">

                    <div class="media-left">

                      <div class="avatar bg-light-danger">

                        <div class="avatar-content">

                          <i class="avatar-icon" data-feather="x"></i>

                        </div>

                      </div>

                    </div>

                    <div class="media-body">

                      <p class="media-heading">

                        <span class="font-weight-bolder">Server down</span>&nbsp;registered

                      </p>

                      <small class="notification-text"> USA Server is down due to hight CPU usage</small>

                    </div>

                  </div>

                </a>

                <a class="d-flex" href="javascript:void(0)">

                  <div class="media d-flex align-items-start">

                    <div class="media-left">

                      <div class="avatar bg-light-success">

                        <div class="avatar-content">

                          <i class="avatar-icon" data-feather="check"></i>

                        </div>

                      </div>

                    </div>

                    <div class="media-body">

                      <p class="media-heading">

                        <span class="font-weight-bolder">Sales report</span>&nbsp;generated

                      </p>

                      <small class="notification-text"> Last month sales report generated</small>

                    </div>

                  </div>

                </a>

                <a class="d-flex" href="javascript:void(0)">

                  <div class="media d-flex align-items-start">

                    <div class="media-left">

                      <div class="avatar bg-light-warning">

                        <div class="avatar-content">

                          <i class="avatar-icon" data-feather="alert-triangle"></i>

                        </div>

                      </div>

                    </div>

                    <div class="media-body">

                      <p class="media-heading">

                        <span class="font-weight-bolder">High memory</span>&nbsp;usage

                      </p>

                      <small class="notification-text"> BLR Server using high memory</small>

                    </div>

                  </div>

                </a>

              </li>

              <li class="dropdown-menu-footer">

                <a class="btn btn-primary btn-block" href="javascript:void(0)">Read all notifications</a>

              </li>

            </ul>

          </li>

          <li class="nav-item dropdown dropdown-user">

            <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

              <div class="user-nav d-sm-flex d-none">

                <span class="user-name font-weight-bolder"><?=$_SESSION['user']['hoten']?></span>

                <span class="user-status"><?=$_SESSION['user']['email']?></span>

              </div>

              <span class="avatar">

                <img class="round" src="<?=$_SESSION['user']['hinhanh']?>" alt="avatar" height="40" width="40">

                <span class="avatar-status-online"></span>

              </span>

            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">

              <a class="dropdown-item" href="page-profile.html">

                <i class="mr-50" data-feather="user"></i> Profile </a>

              <a class="dropdown-item" href="app-email.html">

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

                <i class="mr-50" data-feather="help-circle"></i> FAQ </a>

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

    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">

      <div class="navbar-header">

        <ul class="nav navbar-nav flex-row">

          <li class="nav-item mr-auto">

            <a class="navbar-brand" href="<?=HOME?>">

              <div class="brand-logo" id="minlogo">

                  <!-- <img src="layouts/favicon.png" height="24" /> -->

              </div>

              <!-- <h2 class="brand-text">G-OFFICEx</h2> -->

              <img src="<?=HOME?>/layouts/g-office-logo.png" height="30" alt="logo">

            </a>

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

              <i data-feather="home"></i>

              <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span>

              <!-- <span class="badge badge-light-warning badge-pill ml-auto mr-1">2</span>

            </a>

            <!-- <ul class="menu-content"><li><a class="d-flex align-items-center" href="dashboard-analytics.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">Analytics</span></a></li><li class="active"><a class="d-flex align-items-center" href="dashboard-ecommerce.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="eCommerce">eCommerce</span></a></li></ul> -->

          </li>

          <li class=" navigation-header">

            <span data-i18n="Apps &amp; Pages">Truy cập nhanh</span>

            <i data-feather="more-horizontal"></i>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="chatbox">

              <i data-feather="message-square"></i>

              <span class="menu-title text-truncate" data-i18n="Chat">Chat nội bộ</span>

            </a>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="ticket">

              <i data-feather="mail"></i>

              <span class="menu-title text-truncate" data-i18n="Email">Ticket</span>

            </a>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="congviec">

              <i data-feather="check-square"></i>

              <span class="menu-title text-truncate" data-i18n="Todo">Công việc</span>

            </a>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="calendar">

              <i data-feather="calendar"></i>

              <span class="menu-title text-truncate" data-i18n="Calendar">Lịch làm việc</span>

            </a>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="#">

              <i data-feather="file-text"></i>

              <span class="menu-title text-truncate" data-i18n="Invoice">Báo cáo</span>

            </a>

            <ul class="menu-content">

              <li>

                <a class="d-flex align-items-center" href="app-invoice-list.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="List">Công việc</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="app-invoice-preview.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Preview">Doanh thu</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="app-invoice-edit.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Edit">KPI</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="app-invoice-add.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Add">Chấm công & Lương</span>

                </a>

              </li>

            </ul>

          </li>

          <li class=" navigation-header">

            <span data-i18n="Apps &amp; Pages">PLATFORM</span>

            <i data-feather="more-horizontal"></i>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="khachhang">

              <i data-feather="grid"></i>

              <span class="menu-title text-truncate" data-i18n="Kanban">Khách hàng</span>

            </a>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="nhacungcap">

              <i data-feather='users'></i>

              <span class="menu-title text-truncate" data-i18n="Doitac">Nhà cung cấp</span>

            </a>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="app-file-manager.html">

              <i data-feather="save"></i>

              <span class="menu-title text-truncate" data-i18n="File Manager">Tài nguyên số</span>

            </a>

            <ul class="menu-content">

              <li>

                <a class="d-flex align-items-center" href="page-auth-login-v1.html" target="_blank">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="LoginV1">Văn bản chung</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="page-auth-login-v2.html" target="_blank">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="LoginV2">Mẫu biểu</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="tainguyen">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="RegisterV1">Tài nguyên số</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="page-auth-register-v2.html" target="_blank">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="RegisterV2">Phòng kinh doanh</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="page-auth-forgot-password-v1.html" target="_blank">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="ForgotPasswordV1">Marketing</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="page-auth-forgot-password-v2.html" target="_blank">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="ForgotPasswordV2">Phòng kỹ thuật</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="page-auth-reset-password-v1.html" target="_blank">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="ResetPasswordV1">Hành chính nhân sự</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="page-auth-reset-password-v2.html" target="_blank">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="ResetPasswordV2">Ban giám đốc</span>

                </a>

              </li>

            </ul>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="#">

              <i data-feather="shopping-cart"></i>

              <span class="menu-title text-truncate" data-i18n="eCommerce">Sản phẩm</span>

            </a>

            <ul class="menu-content">

              <li>

                <a class="d-flex align-items-center" href="app-ecommerce-shop.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Shop">Hàng hóa</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="app-ecommerce-details.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Details">Phân loại hàng hóa</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="app-ecommerce-wishlist.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Wish List">Đơn vị tính</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="app-ecommerce-checkout.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Checkout">Chính sách giá</span>

                </a>

              </li>

            </ul>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="#">

              <i data-feather="copy"></i>

              <span class="menu-title text-truncate" data-i18n="Form Elements">Dịch vụ</span>

            </a>

            <ul class="menu-content">

              <li>

                <a class="d-flex align-items-center" href="form-input.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Input">Gói dịch vụ</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="form-input-groups.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Input Groups">Phân loại dịch vụ</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="form-input-mask.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Input Mask">Bảng giá dịch vụ</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="form-textarea.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Textarea">Phiếu thu tiền</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="form-checkbox.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Checkbox">Gia hạn dịch vụ</span>

                </a>

              </li>

              <!-- <li><a class="d-flex align-items-center" href="form-radio.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Radio">Radio</span></a></li><li><a class="d-flex align-items-center" href="form-switch.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Switch">Switch</span></a></li><li><a class="d-flex align-items-center" href="form-select.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Select">Select</span></a></li><li><a class="d-flex align-items-center" href="form-number-input.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Number Input">Number Input</span></a></li><li><a class="d-flex align-items-center" href="form-file-uploader.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="File Uploader">File Uploader</span></a></li><li><a class="d-flex align-items-center" href="form-quill-editor.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Quill Editor">Quill Editor</span></a></li><li><a class="d-flex align-items-center" href="form-date-time-picker.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Date &amp; Time Picker">Date &amp; Time Picker</span></a></li> -->

            </ul>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="#">

              <i data-feather="user"></i>

              <span class="menu-title text-truncate" data-i18n="User">Nhân sự</span>

            </a>

            <ul class="menu-content">

              <li>

                <a class="d-flex align-items-center" href="nhansu">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="List">Nhân sự</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="app-user-view.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="View">Phòng ban</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="app-user-edit.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Edit">Chi nhánh</span>

                </a>

              </li>

            </ul>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="#">

              <i data-feather="file-text"></i>

              <span class="menu-title text-truncate" data-i18n="Pages">Cài đặt</span>

            </a>

            <ul class="menu-content">

              <li>

                <a class="d-flex align-items-center" href="#">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Authentication">Thông tin công ty</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="page-account-settings.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Account Settings">Giờ làm việc</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="page-profile.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Profile">Quy trình sale</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="page-faq.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="FAQ">Quy trình công việc</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="page-knowledge-base.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Knowledge Base">Quy trình tạm ứng</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="page-pricing.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Pricing">Quy trình thanh toán</span>

                </a>

              </li>

              <!-- <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Blog">Blog</span></a><ul class="menu-content"><li><a class="d-flex align-items-center" href="page-blog-list.html"><span class="menu-item text-truncate" data-i18n="List">List</span></a></li><li><a class="d-flex align-items-center" href="page-blog-detail.html"><span class="menu-item text-truncate" data-i18n="Detail">Detail</span></a></li><li><a class="d-flex align-items-center" href="page-blog-edit.html"><span class="menu-item text-truncate" data-i18n="Edit">Edit</span></a></li></ul></li><li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Mail Template">Mail Template</span></a><ul class="menu-content"><li><a class="d-flex align-items-center" href="https://pixinvent.com/demo/vuexy-mail-template/mail-welcome.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Welcome">Welcome</span></a></li><li><a class="d-flex align-items-center" href="https://pixinvent.com/demo/vuexy-mail-template/mail-reset-password.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Reset Password">Reset Password</span></a></li><li><a class="d-flex align-items-center" href="https://pixinvent.com/demo/vuexy-mail-template/mail-verify-email.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Verify Email">Verify Email</span></a></li><li><a class="d-flex align-items-center" href="https://pixinvent.com/demo/vuexy-mail-template/mail-deactivate-account.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Deactivate Account">Deactivate Account</span></a></li><li><a class="d-flex align-items-center" href="https://pixinvent.com/demo/vuexy-mail-template/mail-invoice.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Invoice">Invoice</span></a></li><li><a class="d-flex align-items-center" href="https://pixinvent.com/demo/vuexy-mail-template/mail-promotional.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Promotional">Promotional</span></a></li></ul></li><li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Miscellaneous">Miscellaneous</span></a><ul class="menu-content"><li><a class="d-flex align-items-center" href="page-misc-coming-soon.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Coming Soon">Coming Soon</span></a></li><li><a class="d-flex align-items-center" href="page-misc-not-authorized.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Not Authorized">Not Authorized</span></a></li><li><a class="d-flex align-items-center" href="page-misc-under-maintenance.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Maintenance">Maintenance</span></a></li><li><a class="d-flex align-items-center" href="page-misc-error.html" target="_blank"><span class="menu-item text-truncate" data-i18n="Error">Error</span></a></li></ul></li> -->

            </ul>

          </li>

          <li class=" navigation-header">

            <span data-i18n="User Interface">Extensions</span>

            <i data-feather="more-horizontal"></i>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="ui-typography.html">

              <i data-feather="type"></i>

              <span class="menu-title text-truncate" data-i18n="Typography">Quản lý kho</span>

            </a>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="ui-colors.html">

              <i data-feather="droplet"></i>

              <span class="menu-title text-truncate" data-i18n="Colors">Quản lý hợp đồng</span>

            </a>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="ui-feather.html">

              <i data-feather="eye"></i>

              <span class="menu-title text-truncate" data-i18n="Feather">Quản lý dòng tiền</span>

            </a>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="#">

              <i data-feather="credit-card"></i>

              <span class="menu-title text-truncate" data-i18n="Card">CRM</span>

              <span class="badge badge-light-success badge-pill ml-auto mr-1">New</span>

            </a>

            <ul class="menu-content">

              <li>

                <a class="d-flex align-items-center" href="data">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Data">Data</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="lead">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Lead">Lead</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="card-statistics.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Statistics">Báo cáo thống kê</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="card-analytics.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Analytics">Telesale</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="card-actions.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Card Actions">Remarketing</span>

                </a>

              </li>

            </ul>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="#">

              <i data-feather="briefcase"></i>

              <span class="menu-title text-truncate" data-i18n="Components">Quản lý Marketing</span>

            </a>

            <ul class="menu-content">

              <li>

                <a class="d-flex align-items-center" href="component-alerts.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Alerts">Chiến dịch</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="component-avatar.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Avatar">Kênh</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="component-badges.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Badges">Báo cáo thống kê</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="component-breadcrumbs.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Breadcrumbs">Chatbot</span>

                </a>

              </li>

              <!-- <li><a class="d-flex align-items-center" href="component-buttons.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Buttons">Buttons</span></a></li><li><a class="d-flex align-items-center" href="component-carousel.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Carousel">Carousel</span></a></li><li><a class="d-flex align-items-center" href="component-collapse.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapse">Collapse</span></a></li><li><a class="d-flex align-items-center" href="component-divider.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Divider">Divider</span></a></li><li><a class="d-flex align-items-center" href="component-dropdowns.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Dropdowns">Dropdowns</span></a></li><li><a class="d-flex align-items-center" href="component-list-group.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List Group">List Group</span></a></li><li><a class="d-flex align-items-center" href="component-media-objects.html"><i data-feather="circle"></i><span class="menu-item">Media Objects</span></a></li><li><a class="d-flex align-items-center" href="component-modals.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Modals">Modals</span></a></li><li><a class="d-flex align-items-center" href="component-navs-component.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Navs Component">Navs Component</span></a></li><li><a class="d-flex align-items-center" href="component-pagination.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Pagination">Pagination</span></a></li><li><a class="d-flex align-items-center" href="component-pill-badges.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Pill Badges">Pill Badges</span></a></li><li><a class="d-flex align-items-center" href="component-pills-component.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Pills Component">Pills Component</span></a></li><li><a class="d-flex align-items-center" href="component-popovers.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Popovers">Popovers</span></a></li><li><a class="d-flex align-items-center" href="component-progress.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Progress">Progress</span></a></li><li><a class="d-flex align-items-center" href="component-spinner.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Spinner">Spinner</span></a></li><li><a class="d-flex align-items-center" href="component-tabs-component.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Tabs Component">Tabs Component</span></a></li><li><a class="d-flex align-items-center" href="component-timeline.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Timeline">Timeline</span></a></li><li><a class="d-flex align-items-center" href="component-bs-toast.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Toasts">Toasts</span></a></li><li><a class="d-flex align-items-center" href="component-tooltips.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Tooltips">Tooltips</span></a></li> -->

            </ul>

          </li>

          <!-- <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="box"></i><span class="menu-title text-truncate" data-i18n="Extensions">Extensions</span></a><ul class="menu-content"><li><a class="d-flex align-items-center" href="ext-component-sweet-alerts.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Sweet Alert">Sweet Alert</span></a></li><li><a class="d-flex align-items-center" href="ext-component-blockui.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Block UI">BlockUI</span></a></li><li><a class="d-flex align-items-center" href="ext-component-toastr.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Toastr">Toastr</span></a></li><li><a class="d-flex align-items-center" href="ext-component-sliders.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Sliders">Sliders</span></a></li><li><a class="d-flex align-items-center" href="ext-component-drag-drop.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Drag &amp; Drop">Drag &amp; Drop</span></a></li><li><a class="d-flex align-items-center" href="ext-component-tour.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Tour">Tour</span></a></li><li><a class="d-flex align-items-center" href="ext-component-clipboard.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Clipboard">Clipboard</span></a></li><li><a class="d-flex align-items-center" href="ext-component-media-player.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Media player">Media Player</span></a></li><li><a class="d-flex align-items-center" href="ext-component-context-menu.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Context Menu">Context Menu</span></a></li><li><a class="d-flex align-items-center" href="ext-component-swiper.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="swiper">Swiper</span></a></li><li><a class="d-flex align-items-center" href="ext-component-tree.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Tree">Tree</span></a></li><li><a class="d-flex align-items-center" href="ext-component-ratings.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Ratings">Ratings</span></a></li><li><a class="d-flex align-items-center" href="ext-component-i18n.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="l18n">l18n</span></a></li></ul></li> -->

          <!-- <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="layout"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Page Layouts</span></a><ul class="menu-content"><li><a class="d-flex align-items-center" href="layout-collapsed-menu.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Collapsed Menu</span></a></li><li><a class="d-flex align-items-center" href="layout-full.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Layout Full</span></a></li><li><a class="d-flex align-items-center" href="layout-without-menu.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Without Menu">Without Menu</span></a></li><li><a class="d-flex align-items-center" href="layout-empty.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Empty">Layout Empty</span></a></li><li><a class="d-flex align-items-center" href="layout-blank.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Blank">Layout Blank</span></a></li></ul></li> -->

          <li class=" navigation-header">

            <span data-i18n="Forms &amp; Tables">Kế toán doanh nghiệp</span>

            <i data-feather="more-horizontal"></i>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="nhatkychung">

              <i data-feather="box"></i>

              <span class="menu-title text-truncate" data-i18n="Form Layout">Nhật ký chứng từ</span>

            </a>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="form-wizard.html">

              <i data-feather="package"></i>

              <span class="menu-title text-truncate" data-i18n="Form Wizard">Lưu trữ chứng từ</span>

            </a>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="form-validation.html">

              <i data-feather="check-circle"></i>

              <span class="menu-title text-truncate" data-i18n="Form Validation">Báo cáo thuế GTGT</span>

            </a>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="form-repeater.html">

              <i data-feather="rotate-cw"></i>

              <span class="menu-title text-truncate" data-i18n="Form Repeater">Báo cáo quyết toán</span>

            </a>

          </li>

          <!-- <li class=" nav-item"><a class="d-flex align-items-center" href="table-bootstrap.html"><i data-feather="server"></i><span class="menu-title text-truncate" data-i18n="Table">Table</span></a></li> -->

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="#">

              <i data-feather="grid"></i>

              <span class="menu-title text-truncate" data-i18n="Datatable">Sổ sách kế toán</span>

            </a>

            <ul class="menu-content">
              <li>

                <a class="d-flex align-items-center" href="table-datatable-basic.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Basic">Sổ tiền mặt</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="table-datatable-advanced.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Advanced">Sổ ngân hàng</span>

                </a>

              </li>

            </ul>

          </li>

          <!-- <li class=" nav-item"><a class="d-flex align-items-center" href="table-ag-grid.html"><i data-feather="grid"></i><span class="menu-title text-truncate" data-i18n="ag-grid">agGrid Table</span></a></li> -->

          <li class=" navigation-header">

            <span data-i18n="Charts &amp; Maps">Quản lý điều hành</span>

            <i data-feather="more-horizontal"></i>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="#">

              <i data-feather="pie-chart"></i>

              <span class="menu-title text-truncate" data-i18n="Charts">Biểu đồ</span>

              <span class="badge badge-light-danger badge-pill ml-auto mr-2">2</span>

            </a>

            <ul class="menu-content">

              <li>

                <a class="d-flex align-items-center" href="chart-apex.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Apex">Doanh thu</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="chart-chartjs.html">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Chartjs">Kế hoạch</span>

                </a>

              </li>

            </ul>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="maps-leaflet.html">

              <i data-feather="map"></i>

              <span class="menu-title text-truncate" data-i18n="Leaflet Maps">Thông tin báo cáo</span>

            </a>

          </li>

          <li class=" navigation-header">

            <span data-i18n="Misc">Quản lý nhân sự</span>

            <i data-feather="more-horizontal"></i>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="#">

              <i data-feather="menu"></i>

              <span class="menu-title text-truncate" data-i18n="Menu Levels">Tuyển dụng</span>

            </a>

            <ul class="menu-content">

              <li>

                <a class="d-flex align-items-center" href="#">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Second Level">Hồ sơ ứng viên</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="#">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Second Level">Lịch phỏng vấn</span>

                </a>

              </li>

            </ul>

          </li>

          <li class="disabled nav-item">

            <a class="d-flex align-items-center" href="#">

              <i data-feather="eye-off"></i>

              <span class="menu-title text-truncate" data-i18n="Disabled Menu">Đánh giá KPI</span>

            </a>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="#" target="_blank">

              <i data-feather="folder"></i>

              <span class="menu-title text-truncate" data-i18n="Documentation">Hợp đồng lao động</span>

            </a>

            <ul class="menu-content">

              <li>

                <a class="d-flex align-items-center" href="#">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Third Level">Danh sách nhân viên</span>

                </a>

              </li>

              <li>

                <a class="d-flex align-items-center" href="#">

                  <i data-feather="circle"></i>

                  <span class="menu-item text-truncate" data-i18n="Third Level">Hợp đồng lao động</span>

                </a>

              </li>

            </ul>

          </li>

          <li class=" nav-item">

            <a class="d-flex align-items-center" href="https://pixinvent.ticksy.com/" target="_blank">

              <i data-feather="life-buoy"></i>

              <span class="menu-title text-truncate" data-i18n="Raise Support">Bảo hiểm xã hội</span>

            </a>

          </li>

        </ul>

      </div>

    </div>

    <!-- END: Main Menu-->

