<link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/pages/dashboard-ecommerce.css">
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="dashboard-ecommerce">
                <div class="row match-height">
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="card card-congratulation-medal">
                            <div class="card-body">
                                <h5 id="nguoigui"></h5>
                                <p class="card-text font-small-3" id="noidung"></p>
                                <h6 class="mb-75 mt-2 pt-50">
                                    <span>Bạn có <span id="tinmoi" style="color:red"></span> tin nhắn chưa đọc!</span>
                                </h6>
                                <a href="inbox" type="button" class="btn btn-primary">Xem tất cả</a>
                                <!-- <img src="styles/app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic" /> -->
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Card -->
                    <div class="col-xl-8 col-md-6 col-12">
                        <div class="card card-statistics">
                            <div class="card-header">
                                <h4 class="card-title">Báo cáo thống kê</h4>
                                <div class="d-flex align-items-center">
                                    <p class="card-text font-small-2 mr-25 mb-0">Tháng 9</p>
                                </div>
                            </div>
                            <div class="card-body statistics-body">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="media">
                                            <div class="avatar bg-light-primary mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="trending-up" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0">230k</h4>
                                                <p class="card-text font-small-3 mb-0">Đơn hàng</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="media">
                                            <div class="avatar bg-light-info mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="user" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0">8.549k</h4>
                                                <p class="card-text font-small-3 mb-0">Khách hàng</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12">
                                        <div class="media">
                                            <div class="avatar bg-light-success mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0">$9745</h4>
                                                <p class="card-text font-small-3 mb-0">Doanh số</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                        <div class="media">
                                            <div class="avatar bg-light-danger mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="box" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0">70%</h4>
                                                <p class="card-text font-small-3 mb-0">Mục tiêu</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Statistics Card -->
                </div>

                <div class="row match-height">
                    <div class="col-lg-4 col-12">
                        <div class="row match-height">
                            <!-- Bar Chart - Orders -->
                            <div class="col-lg-6 col-md-3 col-6">
                                <div class="card">
                                    <div class="card-body pb-50">
                                        <h6>Khách hàng gia hạn</h6>
                                        <h2 class="font-weight-bolder mb-1">99%</h2>
                                        <div id="statistics-order-chart"></div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Bar Chart - Orders -->

                            <!-- Line Chart - Profit -->
                            <div class="col-lg-6 col-md-3 col-6">
                                <div class="card card-tiny-line-stats">
                                    <div class="card-body pb-50">
                                        <h6>Khách hàng mới</h6>
                                        <h2 class="font-weight-bolder mb-1">6,24k</h2>
                                        <div id="statistics-profit-chart"></div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Line Chart - Profit -->

                            <!-- Earnings Card -->
                            <div class="col-lg-12 col-md-6 col-12">
                                <div class="card earnings-card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <h4 class="card-title mb-1">Tỷ lệ chuyển đổi</h4>
                                                <div class="font-small-2">This Month</div>
                                                <h5 class="mb-1">$4055.56</h5>
                                                <p class="card-text text-muted font-small-2">
                                                    <span class="font-weight-bolder">68.2%</span><span> more earnings than last month.</span>
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <div id="earnings-chart"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Earnings Card -->
                        </div>
                    </div>

                    <!-- Revenue Report Card -->
                    <div class="col-lg-8 col-12">
                        <div class="card card-revenue-budget">
                            <div class="row mx-0">
                                <div class="col-md-8 col-12 revenue-report-wrapper">
                                    <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                        <h4 class="card-title mb-50 mb-sm-0">Profit/Loss</h4>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center mr-2">
                                                <span class="bullet bullet-primary font-small-3 mr-50 cursor-pointer"></span>
                                                <span>Doanh thu</span>
                                            </div>
                                            <div class="d-flex align-items-center ml-75">
                                                <span class="bullet bullet-warning font-small-3 mr-50 cursor-pointer"></span>
                                                <span>Chi phí</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="revenue-report-chart"></div>
                                </div>
                                <div class="col-md-4 col-12 budget-wrapper">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            9/2021
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);">8/2021</a>
                                            <a class="dropdown-item" href="javascript:void(0);">7/2021</a>
                                            <a class="dropdown-item" href="javascript:void(0);">6/2021</a>
                                        </div>
                                    </div>
                                    <h2 class="mb-25">$25,852</h2>
                                    <div class="d-flex justify-content-center">
                                        <span class="font-weight-bolder mr-25">Mục tiêu:</span>
                                        <span>56,800</span>
                                    </div>
                                    <div id="budget-chart"></div>
                                    <button type="button" class="btn btn-primary">Xem chi tiết</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Revenue Report Card -->
                </div>

                <div class="row match-height">
                    <!-- Company Table Card -->
                    <div class="col-lg-8 col-12">
                        <div class="card card-company-table">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Khách hàng</th>
                                                <th>SP/dịch vụ</th>
                                                <th>Revenue</th>
                                                <th>NV Sale</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                <img src="<?=HOME?>/styles/app-assets/images/icons/toolbox.svg" alt="Toolbar svg" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bolder">Rolatex</div>
                                                            <div class="font-small-2 text-muted">Hà nội</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-primary mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="monitor" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span>Web</span>
                                                    </div>
                                                </td>
                                                <td>3,500,000</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="font-weight-bolder mr-1">Lâm Thơ</span>
                                                        <i data-feather="trending-down" class="text-danger font-medium-1"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                <img src="<?=HOME?>/styles/app-assets/images/icons/parachute.svg" alt="Parachute svg" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bolder">OTC Thái Bình</div>
                                                            <div class="font-small-2 text-muted">Thái Bình</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-success mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="coffee" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span>Phần mềm bán hàng</span>
                                                    </div>
                                                </td>
                                                <td>18,000,000</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="font-weight-bolder mr-1">Nguyễn Ngọc Quỳnh</span>
                                                        <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                <img src="<?=HOME?>/styles/app-assets/images/icons/brush.svg" alt="Brush svg" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bolder">Zipcar</div>
                                                            <div class="font-small-2 text-muted">davcilse@is.gov</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-warning mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="watch" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span>Fashion</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">162</span>
                                                        <span class="font-small-2 text-muted">in 5 days</span>
                                                    </div>
                                                </td>
                                                <td>$522.29</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="font-weight-bolder mr-1">62%</span>
                                                        <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                <img src="<?=HOME?>/styles/app-assets/images/icons/star.svg" alt="Star svg" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bolder">Owning</div>
                                                            <div class="font-small-2 text-muted">us@cuhil.gov</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-primary mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="monitor" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span>Technology</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">214</span>
                                                        <span class="font-small-2 text-muted">in 24 hours</span>
                                                    </div>
                                                </td>
                                                <td>$291.01</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="font-weight-bolder mr-1">88%</span>
                                                        <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                <img src="<?=HOME?>/styles/app-assets/images/icons/book.svg" alt="Book svg" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bolder">Cafés</div>
                                                            <div class="font-small-2 text-muted">pudais@jife.com</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-success mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="coffee" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span>Grocery</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">208</span>
                                                        <span class="font-small-2 text-muted">in 1 week</span>
                                                    </div>
                                                </td>
                                                <td>$783.93</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="font-weight-bolder mr-1">16%</span>
                                                        <i data-feather="trending-down" class="text-danger font-medium-1"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                <img src="<?=HOME?>/styles/app-assets/images/icons/rocket.svg" alt="Rocket svg" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bolder">Kmart</div>
                                                            <div class="font-small-2 text-muted">bipri@cawiw.com</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-warning mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="watch" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span>Fashion</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">990</span>
                                                        <span class="font-small-2 text-muted">in 1 month</span>
                                                    </div>
                                                </td>
                                                <td>$780.05</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="font-weight-bolder mr-1">78%</span>
                                                        <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                <img src="<?=HOME?>/styles/app-assets/images/icons/speaker.svg" alt="Speaker svg" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bolder">Payers</div>
                                                            <div class="font-small-2 text-muted">luk@izug.io</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-warning mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="watch" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span>Fashion</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span class="font-weight-bolder mb-25">12.9k</span>
                                                        <span class="font-small-2 text-muted">in 12 hours</span>
                                                    </div>
                                                </td>
                                                <td>$531.49</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="font-weight-bolder mr-1">42%</span>
                                                        <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                    </div>
                                                </td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Company Table Card -->

                    <!-- Developer Meetup Card -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card card-developer-meetup">
                            <div class="meetup-img-wrapper rounded-top text-center">
                                <img src="<?=HOME?>/styles/app-assets/images/illustration/email.svg" alt="Meeting Pic" height="170" />
                            </div>
                            <div class="card-body">
                                <div class="meetup-header d-flex align-items-center">
                                    <div class="meetup-day">
                                        <h6 class="mb-0">THU</h6>
                                        <h3 class="mb-0">24</h3>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="card-title mb-25">Lịch làm việc</h4>
                                        <p class="card-text mb-0">Lịch hẹn khách hàng</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="avatar bg-light-primary rounded mr-1">
                                        <div class="avatar-content">
                                            <i data-feather="calendar" class="avatar-icon font-medium-3"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mb-0">Sat, May 25, 2020</h6>
                                        <small>10:AM to 6:PM</small>
                                    </div>
                                </div>
                                <div class="media mt-2">
                                    <div class="avatar bg-light-primary rounded mr-1">
                                        <div class="avatar-content">
                                            <i data-feather="map-pin" class="avatar-icon font-medium-3"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mb-0">Central Park</h6>
                                        <small>Manhattan, New york City</small>
                                    </div>
                                </div>
                                <div class="avatar-group">
                                    <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Billy Hopkins" class="avatar pull-up">
                                        <img src="<?=HOME?>/styles/app-assets/images/portrait/small/avatar-s-9.jpg" alt="Avatar" width="33" height="33" />
                                    </div>
                                    <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Amy Carson" class="avatar pull-up">
                                        <img src="<?=HOME?>/styles/app-assets/images/portrait/small/avatar-s-6.jpg" alt="Avatar" width="33" height="33" />
                                    </div>
                                    <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Brandon Miles" class="avatar pull-up">
                                        <img src="<?=HOME?>/styles/app-assets/images/portrait/small/avatar-s-8.jpg" alt="Avatar" width="33" height="33" />
                                    </div>
                                    <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Daisy Weber" class="avatar pull-up">
                                        <img src="<?=HOME?>/styles/app-assets/images/portrait/small/avatar-s-20.jpg" alt="Avatar" width="33" height="33" />
                                    </div>
                                    <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Jenny Looper" class="avatar pull-up">
                                        <img src="<?=HOME?>/styles/app-assets/images/portrait/small/avatar-s-20.jpg" alt="Avatar" width="33" height="33" />
                                    </div>
                                    <h6 class="align-self-center cursor-pointer ml-50 mb-0">+42</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Developer Meetup Card -->

                    <!-- Browser States Card -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card card-browser-states">
                            <div class="card-header">
                                <div>
                                    <h4 class="card-title">Nhân sự đang online</h4>
                                    <p class="card-text font-small-2">VP Hà Nội</p>
                                </div>
                                <div class="dropdown chart-dropdown">
                                    <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-toggle="dropdown"></i>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);">VP Hà Nội</a>
                                        <a class="dropdown-item" href="javascript:void(0);">VP TP Hồ Chí Minh</a>
                                        <a class="dropdown-item" href="javascript:void(0);">VP Đà Nẵng</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="browser-states">
                                    <div class="media">
                                        <img src="<?=HOME?>/styles/app-assets/images/portrait/small/avatar-s-15.jpg" class="rounded mr-1" height="30" alt="Google Chrome" />
                                        <h6 class="align-self-center mb-0">Nguyễn Thế Quỳnh</h6>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="font-weight-bold text-body-heading mr-1">54.4%</div>
                                        <div id="browser-state-chart-primary"></div>
                                    </div>
                                </div>
                                <div class="browser-states">
                                    <div class="media">
                                        <img class="rounded mr-1"  src="<?=HOME?>/styles/app-assets/images/portrait/small/avatar-s-9.jpg" alt="Avatar" width="33" height="33" />
                                        <h6 class="align-self-center mb-0">Lâm Tâm Thơ</h6>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="font-weight-bold text-body-heading mr-1">6.1%</div>
                                        <div id="browser-state-chart-warning"></div>
                                    </div>
                                </div>
                                <div class="browser-states">
                                    <div class="media">
                                        <img class="rounded mr-1" src="<?=HOME?>/styles/app-assets/images/portrait/small/avatar-s-8.jpg" alt="Avatar" width="33" height="33" />
                                        <h6 class="align-self-center mb-0">Nguyễn Thị Trang</h6>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="font-weight-bold text-body-heading mr-1">14.6%</div>
                                        <div id="browser-state-chart-secondary"></div>
                                    </div>
                                </div>
                                <div class="browser-states">
                                    <div class="media">
                                        <img class="rounded mr-1" src="<?=HOME?>/styles/app-assets/images/portrait/small/avatar-s-20.jpg" alt="Avatar" width="33" height="33" />
                                        <h6 class="align-self-center mb-0">Dương Hữu Phả</h6>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="font-weight-bold text-body-heading mr-1">4.2%</div>
                                        <div id="browser-state-chart-info"></div>
                                    </div>
                                </div>
                                <div class="browser-states">
                                    <div class="media">
                                        <img src="<?=HOME?>/styles/app-assets/images/portrait/small/avatar-s-6.jpg" alt="Avatar" width="33" height="33" />
                                        <h6 class="align-self-center mb-0">Vũ Ngọc Quỳnh</h6>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="font-weight-bold text-body-heading mr-1">8.4%</div>
                                        <div id="browser-state-chart-danger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Browser States Card -->

                    <!-- Goal Overview Card -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">KPI Cá nhân</h4>
                                <i data-feather="help-circle" class="font-medium-3 text-muted cursor-pointer"></i>
                            </div>
                            <div class="card-body p-0">
                                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                                <div class="row border-top text-center mx-0">
                                    <div class="col-6 border-right py-1">
                                        <p class="card-text text-muted mb-0">Hoàn thành</p>
                                        <h3 class="font-weight-bolder mb-0">786,617</h3>
                                    </div>
                                    <div class="col-6 py-1">
                                        <p class="card-text text-muted mb-0">Đang thực hiện</p>
                                        <h3 class="font-weight-bolder mb-0">13,561</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Goal Overview Card -->

                    <!-- Transaction Card -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card card-transaction">
                            <div class="card-header">
                                <h4 class="card-title">Quản lý công việc</h4>
                                <div class="dropdown chart-dropdown">
                                    <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-toggle="dropdown"></i>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);">Dự án G-office</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Dự án VELO Edu</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Dự án Nam Dương</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="transaction-item">
                                    <div class="media">
                                        <div class="avatar bg-light-primary rounded">
                                            <div class="avatar-content">
                                                <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="transaction-title">Module báo cáo</h6>
                                            <small>Dự án VELO Edu</small>
                                        </div>
                                    </div>
                                    <div class="font-weight-bolder text-danger">Trễ deadline</div>
                                </div>
                                <div class="transaction-item">
                                    <div class="media">
                                        <div class="avatar bg-light-success rounded">
                                            <div class="avatar-content">
                                                <i data-feather="check" class="avatar-icon font-medium-3"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="transaction-title">Module Chatbox</h6>
                                            <small>Dự án G-Office</small>
                                        </div>
                                    </div>
                                    <div class="font-weight-bolder text-success">Hoàn thành</div>
                                </div>
                                <div class="transaction-item">
                                    <div class="media">
                                        <div class="avatar bg-light-danger rounded">
                                            <div class="avatar-content">
                                                <i data-feather="dollar-sign" class="avatar-icon font-medium-3"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="transaction-title">Module CRM</h6>
                                            <small>Dự án Rolatex</small>
                                        </div>
                                    </div>
                                    <div class="font-weight-bolder text-success">Hoàn thành</div>
                                </div>
                                <div class="transaction-item">
                                    <div class="media">
                                        <div class="avatar bg-light-warning rounded">
                                            <div class="avatar-content">
                                                <i data-feather="credit-card" class="avatar-icon font-medium-3"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="transaction-title">Báo giá Bluesea</h6>
                                            <small>Hỗ trợ khách hàng</small>
                                        </div>
                                    </div>
                                    <div class="font-weight-bolder text-danger">Trễ deadline</div>
                                </div>
                                <div class="transaction-item">
                                    <div class="media">
                                        <div class="avatar bg-light-info rounded">
                                            <div class="avatar-content">
                                                <i data-feather="trending-up" class="avatar-icon font-medium-3"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="transaction-title">Thu công nợ</h6>
                                            <small>Dự án Nam Dương</small>
                                        </div>
                                    </div>
                                    <div class="font-weight-bolder text-success">Hoàn thành</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Transaction Card -->
                </div>
            </section>
            <!-- Dashboard Ecommerce ends -->

        </div>
    </div>
</div>
<!-- END: Content-->
<script src="<?=HOME?>/styles/app-assets/vendors/js/charts/apexcharts.min.js"></script>
<script src="<?=HOME?>/styles/app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
<script src="<?=HOME?>/js/dashboard.js"></script>
