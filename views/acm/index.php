<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <!-- users filter start -->
                <div class="card">
                    <div class="d-flex justify-content-between align-items-center mx-50 row pt-2 pb-2">
                        <div class="col-md-4 taikhoan_filter"></div>
                        <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip"
                            data-toggle="tooltip" data-placement="right"
                            data-original-title="Là chức năng quản lý các loại tài khoản ngân hàng, đơn vị tiền tệ của một doanh nghiệp "
                            data-trigger="click">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mx-50 row pt-2 pb-2"
                        id="showAccountBalance">

                    </div>
                </div>

        </div>


        <!-- list section start -->
        <div class="card" id="acmTable">
            <div class="card-datatable table-responsive pt-0">
                <table class="user-list-table table">
                    <thead class="thead-light">
                        <tr>
                            <!-- <th></th> -->
                            <th>Ngày giờ</th>
                            <th>Chủ tài khoản</th>
                            <th>Diễn giải</th>
                            <th>Số tiền</th>
                            <th>Hình thức</th>
                            <th>Loại</th>
                            <th></th>
                            <th></th>
                            
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel16" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
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
                                    <form class="form-validate" enctype="multipart/form-data" id="dg">
                                        <div class="row mt-1">
                                            <input type="hidden" id="id" name="id">
                                            <input type="hidden" id="action" name="action">

                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-group">
                                                    <label for="dateTime">Thời gian</label>
                                                    <input type="text" id="dateTime" name="dateTime"
                                                        class="form-control " placeholder="Chọn thời gian">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-group">
                                                    <label for="content">Diễn giải</label>
                                                    <input id="content" type="text" class="form-control"
                                                        name="content" />
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-group">
                                                    <label for="customer">Khách hàng</label>
                                                    <select name="customer" id="customer"
                                                        class="select2 form-control"></select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-group">
                                                    <label for="account">Tài khoản</label>
                                                    <select name="account" id="account" required
                                                        class="select2 form-control"></select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-group">
                                                    <label for="classify">Phân loại hoạch toán</label>
                                                    <select name="classify" id="classify" class="form-control select2">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-group">
                                                    <label for="hach_toan">Hạch toán</label>
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="1">Doanh thu</option>
                                                        <option value="2">Chi phí</option>
                                                        <option value="3">Nội bộ</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="contract">Hợp đồng</label>
                                                    <select id="contract" name="contract" class="form-control select2">

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="authorized">Nhân viên</label>
                                                    <select name="authorized" id="authorized" class="form-control">

                                                    </select>

                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="asset">Số tiền</label>
                                                    <input id="asset" type="text" class="form-control" name="asset" />

                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="note">Ghi chú</label>
                                                    <textarea id="note" name="note" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                <button type="submit" id="btn_add"
                                                    class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                <button type="reset" class="btn btn-outline-secondary"
                                                    data-dismiss="modal">Bỏ qua</button>
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
<script src="<?= HOME ?>/js/acm.js"></script>