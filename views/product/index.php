<!-- <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-kanban.css"> -->


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
                                    <th>Tên dịch vụ</th>
                                    <th>Nhà cung cấp</th>
                                    <th>Thuế (VAT)</th>
                                    <th>Giá thành</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16">Thêm sản phẩm mới</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" id="dg">
                                                <div class="row mt-1">
                                                    <div class="col-md-12 form-group">
                                                        <label for="name">Tên dịch vụ</label>
                                                        <input id="name" name="name" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for="supplier">Nhà cung cấp</label>
                                                        <input id="supplier" name="supplier" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for="unit">Đơn vị tính</label>
                                                        <input id="unit" name="unit" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for="vat">Thuế(VAT)</label>
                                                        <input id="vat" name="vat" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for="price">Giá thành</label>
                                                        <input type="text" id="price" name="price" class="format_number form-control"  />
                                                    </div>
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
<script src="<?= HOME ?>/js/product.js"></script>