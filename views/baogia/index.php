<link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-invoice-list.css">
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="invoice-list-wrapper">
                <div class="card">
                    <div class="card-datatable table-responsive">
                        <table class="invoice-list-table table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <!-- <th><i data-feather="trending-up"></i></th> -->
                                    <th>Tình trạng</th>
                                    <th>Khách hàng</th>
                                    <th>Số tiền</th>
                                    <th class="text-truncate">Ngày gửi</th>
                                    <th>Nhân viên</th>
                                    <th>Invoice Status</th>
                                    <th class="cell-fit">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<div class="modal fade text-left" id="emailList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Gửi mail</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label>Chọn email người nhận</label>
                        <select class="form-control " id="selectEmail"></select>
                        <br><br>
                        <button type="button" class="btn btn-primary" id="btnSend" >Gửi</button>
                    </div>
                    <div class="col-md-6 mb-1">
                        <label>Danh sách email (cách bởi dấu phẩy)</label>
                        <textarea class="form-control" id="emails" rows="3" placeholder="Mailing list"></textarea>
                        <input type="hidden" id="quoteId" name="quoteId">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sizing Options -->
<!-- <div class="row">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Select2 Size Options</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="card-text">
                            For different sizes of select2, Use classes like
                            <code>.select2-size-sm</code> &amp;
                            <code>.select2-size-lg</code> for Small &amp; Large &amp; Multi Selects
                            respectively.
                        </p>
                    </div>
                    <div class="col-12">
                        <label>Large</label>
                        <div class="form-group">
                            <select class="select2-size-lg form-control" id="large-select">
                                <option value="square">Square</option>
                                <option value="rectangle">Rectangle</option>
                                <option value="rombo">Rombo</option>
                                <option value="romboid">Romboid</option>
                                <option value="trapeze">Trapeze</option>
                                <option value="traible">Triangle</option>
                                <option value="polygon">Polygon</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>Default</label>
                        <div class="form-group">
                            <select class="select2 form-control" id="default-select">
                                <option value="square">Square</option>
                                <option value="rectangle">Rectangle</option>
                                <option value="rombo">Rombo</option>
                                <option value="romboid">Romboid</option>
                                <option value="trapeze">Trapeze</option>
                                <option value="traible">Triangle</option>
                                <option value="polygon">Polygon</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>Small</label>
                        <div class="form-group">
                            <select class="select2-size-sm form-control" id="small-select">
                                <option value="square">Square</option>
                                <option value="rectangle">Rectangle</option>
                                <option value="rombo">Rombo</option>
                                <option value="romboid">Romboid</option>
                                <option value="trapeze">Trapeze</option>
                                <option value="traible">Triangle</option>
                                <option value="polygon">Polygon</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Select2 Multi Select Size Options</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="card-text">
                            For different sizes of select2, Use classes like
                            <code>.select2-size-sm</code> &amp;
                            <code>.select2-size-lg</code> for Small &amp; Large &amp; Selects
                            respectively.
                        </p>
                    </div>
                    <div class="col-12">
                        <label>Large</label>
                        <div class="form-group">
                            <select class="select2-size-lg form-control" multiple="multiple"
                            id="large-select-multi">
                            <option value="square" selected>Square</option>
                            <option value="rectangle">Rectangle</option>
                            <option value="rombo">Rombo</option>
                            <option value="romboid">Romboid</option>
                            <option value="trapeze">Trapeze</option>
                            <option value="traible">Triangle</option>
                            <option value="polygon">Polygon</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <label>Default</label>
                    <div class="form-group">
                        <select class="select2 form-control" multiple="multiple"
                        id="default-select-multi">
                        <option value="square">Square</option>
                        <option value="rectangle">Rectangle</option>
                        <option value="rombo">Rombo</option>
                        <option value="romboid">Romboid</option>
                        <option value="trapeze">Trapeze</option>
                        <option value="traible">Triangle</option>
                        <option value="polygon" selected>Polygon</option>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <label>Small</label>
                <div class="form-group">
                    <select class="select2-size-sm form-control" multiple="multiple"
                    id="small-select-multi">
                    <option value="square">Square</option>
                    <option value="rectangle">Rectangle</option>
                    <option value="rombo" selected>Rombo</option>
                    <option value="romboid">Romboid</option>
                    <option value="trapeze">Trapeze</option>
                    <option value="traible">Triangle</option>
                    <option value="polygon">Polygon</option>
                </select>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</section>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
            </div>
        </div>
    </div>
</div> -->

<script src="<?=HOME?>/styles/app-assets/vendors/js/extensions/moment.min.js"></script>
<script src="<?=HOME?>/js/baogia.js"></script>
