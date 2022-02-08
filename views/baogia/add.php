<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-invoice.css">
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="invoice-add-wrapper">
                <div class="row invoice-add">
                    <div class="col-xl-9 col-md-8 col-12">
                        <div class="card invoice-preview-card">
                            <form id="fmPrint" method="post" action="baogia/printout">
                            <div class="card-body invoice-padding pb-0">
                                <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                    <div>
                                        <div class="logo-wrapper">
                                            <!-- <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                                <defs>
                                                    <linearGradient id="invoice-linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                                        <stop stop-color="#000000" offset="0%"></stop>
                                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                                    </linearGradient>
                                                    <linearGradient id="invoice-linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                                    </linearGradient>
                                                </defs>
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g transform="translate(-400.000000, -178.000000)">
                                                        <g transform="translate(400.000000, 178.000000)">
                                                            <path class="text-primary" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill: currentColor"></path>
                                                            <path d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#invoice-linearGradient-1)" opacity="0.2"></path>
                                                            <polygon fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                                            <polygon fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                                            <polygon fill="url(#invoice-linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg> -->
                                            <h3 class="text-primary invoice-logo"><img src="https://gemstech.com.vn/uploads/home/logo-2.png" height="40"/></h3>
                                        </div>
                                        <p class="card-text mb-25">Số 2, Vương Thừa Vũ</p>
                                        <p class="card-text mb-25">Quận Thanh Xuân, Tp Hà Nội</p>
                                        <p class="card-text mb-0">034 678 8118</p>
                                    </div>
                                    <div class="invoice-number-date mt-md-0 mt-2">
                                        <!-- <div class="d-flex align-items-center justify-content-md-end mb-1">
                                            <h4 class="invoice-title">Số báo giá</h4>
                                            <div class="input-group input-group-merge invoice-edit-input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i data-feather="hash"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control invoice-edit-input" placeholder="53634" />
                                            </div>
                                        </div> -->
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="title">Số báo giá:</span>
                                            <input type="text" id="quoteNum" name="quoteNum"class="form-control invoice-edit-input" placeholder="auto" readonly value="0"/>
                                        </div>
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="title">Ngày:</span>
                                            <input type="text" id="date" name="date" class="form-control invoice-edit-input date-picker"  />
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="title">Ngày hết hạn:</span>
                                            <input type="text" id="validDate"  name="validDate" class="form-control invoice-edit-input due-date-picker" />
                                        </div>
                                        <input type="hidden" id="itemsPrint" name="itemsPrint">
                                        <input type="hidden" id="notePrint" name="notePrint">
                                        <input type="hidden" id="cusPrint" name="cusPrint">
                                    </div>
                                </div>
                            </div>
                            <hr class="invoice-spacing" />

                            <!-- Address and Contact starts -->
                            <div class="card-body invoice-padding pt-0">
                                <div class="row row-bill-to invoice-spacing">
                                    <div class="col-xl-8 mb-lg-1 col-bill-to pl-0">
                                        <h6 class="invoice-to-title">Khách hàng:</h6>
                                        <div class="invoice-customer">
                                            <select class="invoiceto form-control"></select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 pr-0 mt-xl-0 mt-2">
                                        <h6 class="mb-2">Quy định thanh toán:</h6>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="pr-1">Phương thức:</td>
                                                    <td><strong>Chuyển khoản</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Tài khoản:</td>
                                                    <td>100919811</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Ngân hàng:</td>
                                                    <td>Techcombank
                                                </tr>
                                                    <!-- <td class="pr-1">IBAN:</td>
                                                    <td>ETD95476213874685</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">SWIFT code:</td>
                                                    <td>BR91905</td> -->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Address and Contact ends -->
                            <div class="card-body invoice-padding">
                                <h3>Chọn sản phẩm/dịch vụ</h3>
                            </div>
                            <!-- Product Details starts -->
                        </form>
                            <div class="card-body invoice-padding invoice-product-details">
                                <form class="source-item" id="items" >
                                    <div data-repeater-list="group-a">
                                        <div class="repeater-wrapper" data-repeater-item="">
                                            <div class="row">
                                                <div class="col-12 d-flex product-details-border position-relative pr-0">
                                                    <div class="row w-100 pr-lg-0 pr-1 py-2">
                                                        <div class="col-lg-5 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                                                            <p class="card-text col-title mb-md-50 mb-0">Tên hàng hóa/dịch vụ</p>
                                                            <select class="form-control item-details" name="product">
                                                                <option value="">Chọn sản phẩm/dịch vụ</option>
                                                                <?php
                                                                foreach ($this->product AS $item) {
                                                                    echo '<option value="'.$item['id'].'">'.$item['name'].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <textarea class="form-control mt-2" rows="1" name="noteProduct"></textarea>
                                                            <input type="hidden" class="productName" name="productName">
                                                        </div>
                                                        <div class="col-lg-3 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Đơn giá</p>
                                                            <input type="text" name="price" class="price form-control col-lg-8" style="display:inline-block" placeholder="đơn giá" />
                                                            &nbsp;<span class="unit"></span><input type="hidden" name="unit" class="unitprice" />
                                                            <div class="mt-2">
                                                                <span>Giảm giá:</span>
                                                                <input type="text" name="discount" class="discount form-control" value="0" placeholder="giảm giá trực tiếp" />
                                                                <!-- <span class="discount">0%</span> -->
                                                                <!-- <span class="tax-1 ml-50" data-toggle="tooltip" data-placement="top" title="Chiết khấu">0%</span>
                                                                <span class="tax-2 ml-50" data-toggle="tooltip" data-placement="top" title="Thuế">0%</span> -->
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0 ">Số lượng</p>
                                                            <input type="text" name="qty" class="qty form-control quantity" value="1" />
                                                            <div class="mt-2">
                                                                <span>Chiết khấu (%):</span>
                                                                <input type="text" name="chietkhau" class="chietkhau form-control" value="0" placeholder="Chiết khấu %" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                                                            <p class="card-text col-title mb-md-50 mb-0 ">Thành tiền</p>
                                                            <!-- <p class="card-text mb-0">$24.00</p> -->
                                                            <input type="text" name="thanhtien" class="thanhtien form-control amount" readonly />
                                                            <div class="mt-2">
                                                                <span>Thuế GTGT (%):</span>
                                                                <input type="text" name="vat" class="vat form-control" value="0" placeholder="Thuế GTGT %" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center justify-content-between border-left invoice-product-actions py-50 px-25">
                                                        <i data-feather="x" class="cursor-pointer font-medium-3" data-repeater-delete></i>
                                                        <div class="dropdown">
                                                            <!-- <i class="cursor-pointer more-options-dropdown mr-0" data-feather="settings" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            </i> -->
                                                            <!-- <div class="dropdown-menu dropdown-menu-right item-options-menu p-50" aria-labelledby="dropdownMenuButton">
                                                                <div class="form-group">
                                                                    <label for="discount-input" class="form-label">Giảm giá</label>
                                                                    <input type="number" class="form-control" id="discount-input" />
                                                                </div>
                                                                <div class="form-row mt-50">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="tax-1-input" class="form-label">Chiết khấu %</label>
                                                                        <select name="tax-1-input" id="tax-1-input" class="form-control tax-select">
                                                                            <option value="0%" selected>0%</option>
                                                                            <option value="1%">5%</option>
                                                                            <option value="10%">10%</option>
                                                                            <option value="18%">15%</option>
                                                                            <option value="40%">20%</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="tax-2-input" class="form-label">Thuế</label>
                                                                        <select name="tax-2-input" id="tax-2-input" class="form-control tax-select">
                                                                            <option value="0%" selected>0%</option>
                                                                            <option value="1%">5%</option>
                                                                            <option value="10%">10%</option>
                                                                            <option value="18%">15%</option>
                                                                            <option value="40%">20%</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-divider my-1"></div>
                                                                <div class="d-flex justify-content-between">
                                                                    <button type="button" class="btn btn-outline-primary btn-apply-changes">Apply</button>
                                                                    <button type="button" class="btn btn-outline-secondary">Cancel</button>
                                                                </div>
                                                            </div> -->
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
                                                <span class="align-middle">Thêm sản phẩm/dịch vụ</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Product Details ends -->
                            <!-- Invoice Total starts -->
                            <div class="card-body invoice-padding">
                                <div class="row invoice-sales-total-wrapper ">
                                    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                        <div class="d-flex align-items-center mb-1">
                                            Người lập báo giá: &nbsp;
                                            <b><?=$_SESSION['user']['staffName']?></b>
                                            <!-- <label for="salesperson" class="form-label">Nhân viên sale:</label>
                                            <input type="text" class="form-control ml-50" id="salesperson" placeholder="" readonly /> -->
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                        <div class="invoice-total-wrapper" style="max-width:80%">
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Tổng tiền hàng:</p>
                                                <p class="invoice-total-amount" id="invoiceTotal">0</p>
                                            </div>
                                            <!-- <div class="invoice-total-item">
                                                <p class="invoice-total-title">Tổng giảm giá:</p>
                                                <p class="invoice-total-amount" id="discountTotal">0</p>
                                            </div>
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Tổng giá đã giảm:</p>
                                                <p class="invoice-total-amount" id="finalTotal">0</p>
                                            </div> -->
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Thuế GTGT:</p>
                                                <p class="invoice-total-amount" id="taxTotal">0</p>
                                            </div>
                                            <hr class="my-50" />
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Tổng thanh toán:</p>
                                                <p class="invoice-total-amount" id="totalAmount">0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Total ends -->
                            <hr class="invoice-spacing mt-0" />
                            <div class="card-body invoice-padding py-0">
                                <!-- Invoice Note starts -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-2">
                                            <label for="note" class="form-label font-weight-bold">Ghi chú báo giá:</label>
                                            <textarea class="form-control" rows="2" id="note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- Invoice Note ends -->
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Add Left ends -->

                    <!-- Invoice Add Right starts -->
                    <div class="col-xl-3 col-md-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <button class="btn btn-primary btn-block mb-75" id="btnSend">Gửi báo giá</button>
                                <button id="btnPrint"class="btn btn-outline-primary btn-block mb-75" target="_blank">In báo giá</button>
                                <button type="button" id="btnSave" class="btn btn-outline-primary btn-block">Ghi nháp</button>
                                <button class="btn btn-primary btn-block mb-75" >Lập báo giá mới</button>
                                <a href="baogia" class="btn btn-outline-primary btn-block mb-75">Danh sách báo giá</a>
                                <a href="lead_temp" class="btn btn-outline-primary btn-block mb-75">Cơ hội kinh doanh</a>
                            </div>
                        </div>
                        <!-- <div class="mt-2">
                            <p class="mb-50">Accept payments via</p>
                            <select class="form-control">
                                <option value="Bank Account">Bank Account</option>
                                <option value="Paypal">Paypal</option>
                                <option value="UPI Transfer">UPI Transfer</option>
                            </select>
                            <div class="invoice-terms mt-1">
                                <div class="d-flex justify-content-between">
                                    <label class="invoice-terms-title mb-0" for="paymentTerms">Payment Terms</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" checked id="paymentTerms" />
                                        <label class="custom-control-label" for="paymentTerms"></label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between py-1">
                                    <label class="invoice-terms-title mb-0" for="clientNotes">Client Notes</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" checked id="clientNotes" />
                                        <label class="custom-control-label" for="clientNotes"></label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <label class="invoice-terms-title mb-0" for="paymentStub">Payment Stub</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="paymentStub" />
                                        <label class="custom-control-label" for="paymentStub"></label>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <!-- Invoice Add Right ends -->
                </div>

                <!-- Add New Customer Sidebar -->
                <div class="modal modal-slide-in fade" id="add-new-customer-sidebar" aria-hidden="true">
                    <div class="modal-dialog sidebar-lg">
                        <div class="modal-content p-0">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                            <div class="modal-header mb-1">
                                <h5 class="modal-title">
                                    <span class="align-middle">Khách hàng mới</span>
                                </h5>
                            </div>
                            <div class="modal-body flex-grow-1">
                                <form id="newCus">
                                    <div class="form-group">
                                        <label for="customer-name" class="form-label">Tên khách hàng</label>
                                        <input type="text" class="form-control" id="customer-name" placeholder="Tên viết tắt" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="customer-address" class="form-label">Địa chỉ</label>
                                        <textarea class="form-control" id="customer-address" cols="2" rows="2" placeholder="Địa chỉ văn phòng"></textarea>
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="customer-country" class="form-label">Thành phố</label>
                                        <select class="form-control" id="customer-country" name="customer-country">
                                            <option label="Chọn tỉnh/thành phố"></option>
                                            <option value="1">Hà Nội</option>
                                            <option value="2">Tp Hồ Chí Minh</option>
                                            <option value="3">Đà Nẵng</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="customer-name" class="form-label">Người liên hệ</label>
                                        <input type="text" class="form-control" id="customerContact" placeholder="Người nhận báo giá" />
                                    </div>
                                    <div class="form-group">
                                        <label for="customer-contact" class="form-label">Điện thoại</label>
                                        <input type="number" class="form-control" id="customerPhone" placeholder="09x xxx xxxx" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="customer-email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="customer-email" placeholder="example@domain.com" required />
                                    </div>
                                    <div class="form-group d-flex flex-wrap mt-2">
                                        <button type="submit" class="btn btn-primary mr-1" >Thêm</button>
                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script src="<?=HOME?>/styles/app-assets/vendors/js/ui/jquery.sticky.js"></script>
<script src="<?=HOME?>/styles/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
<script src="<?=HOME?>/js/bgadd.js"></script>