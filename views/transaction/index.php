<!-- <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-kanban.css"> -->
<script src="<?= HOME ?>/js/transaction.js"></script>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <!-- list section start -->
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tên hợp đồng</th>
                                    <th>Khách hàng</th>
                                    <th>Số tiền giao dịch</th>
                                    <th>Thời gian giao dịch</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16"></h4>
                                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button> -->
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" id="dg">
                                                <div class="row mt-1">
                                                    <div class="col-md-6 col-md-6 form-group">
                                                        <label for="name">Tên hợp đồng</label>
                                                        <input id="name" name="name" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6 col-md-6 form-group">
                                                        <label for="customerId">Khách hàng</label>
                                                        <select id="customerId" class="select2 form-control" name="customerId">
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-md-6 form-group">
                                                        <label for="performerId">Nhân viên thực hiện</label>
                                                        <select id="performerId" class="select2 form-control" name="performerId">
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="asset">Số tiền giao dịch</label>
                                                        <input id="asset" name="asset" type="text" class="form-control format_number" />
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="date">Thời gian giao dịch</label>
                                                        <input type="text" id="date" name="date" class="form-control flatpickr-basic" placeholder="DD/MM/YYYY" />
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="type">Loại hợp đồng</label>
                                                        <select id="type" class="form-control select2" name="loai">
                                                            <option value="1">Đơn hàng</option>
                                                            <option value="2">Hợp đồng</option>
                                                            <option value="3">Thanh toán</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="status">Trạng thái</label>
                                                        <select id="status" class="form-control" name="status">
                                                            <option value="1">Khả dụng</option>
                                                            <option value="2">Ẩn</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group" style="margin-bottom: 60px;">
                                                        <label class="form-label">Mô tả</label>
                                                        <div id="task-desc" class="border-bottom-0" data-placeholder=""></div>
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
                                                    <br>
                                                    <br>
                                                   

                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="submit"  class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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
            </section>
        </div>
    </div>
</div>
