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
                    <div class="d-flex justify-content-between align-items-center mx-50 row pt-2 ">
                    <h2 class="content-header-title float-left mb-2" id="title_module">
                       Sản phẩm <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng quản lý các thông tin cơ bản về sản phẩm / dịch vụ của doanh nghiệp" data-trigger="click" >
                    </h2>
                    </div>
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
                    <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLongTitle"></h4>
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" id="dg">
                                                <div class="row mt-1">
                                                    <div class="col-md-12 form-group">
                                                        <label for="name">Tên dịch vụ<span style="color:red;">*</span></label>
                                                        <input id="name" name="name" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for="supplier">Nhà cung cấp</label>
                                                        <input id="supplier" name="supplier" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for="type">Loại</label>
                                                      <select id="type" name="type" class="form-control">
                                                          <option value="1">Sản phẩm</option>
                                                          <option value="2">Dịch vụ</option>
                                                      </select>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for="unit">Đơn vị tính<span style="color:red;">*</span></label>
                                                        <input id="unit" name="unit" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for="vat">Thuế(VAT)<span style="color:red;">*</span></label>
                                                        <input id="vat" name="vat" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for="price">Giá thành<span style="color:red;">*</span></label>
                                                        <input type="text" id="price" name="price" class="format_number form-control"  />
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="submit" id="btn_product" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1"></button>
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
<script>
    var funAdd = <?=$this->funAdd?>,
        funEdit = <?=$this->funEdit?>,
        funDel = <?=$this->funDel?>;
     
</script>
<script src="<?= HOME ?>/js/product.js"></script>