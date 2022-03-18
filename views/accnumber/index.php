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
                    <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng quản lý các loại tài khoản ngân hàng, đơn vị tiền tệ của một doanh nghiệp " data-trigger="click" >
                    </div>
                </div>
                

                <!-- list section start -->
                <div class="card" id="acmTable"> 
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <!-- <th></th> -->
                                    <th>ID</th>
                                    <th>Tên tài khoản</th>
                                    <th>Số tài khoản</th>
                                    <th>Loại</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
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
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Tên tài khoản<span style="color:red;">(*)</span></label>
                                                            <input type="text" name="name" id="name" class="form-control " >
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="account">Số tài khoản<span style="color:red;">(*)</span></label>
                                                            <input id="account" type="text" class="form-control" name="account" />
                                                        </div>
                                                    </div>
                                                   <div class="col-lg-3 col-md-6">
                                                        <div class="form-group">
                                                            <label for="type">Loại giao dịch</label>
                                                            <select name="type" id="type" class="form-control">
                                                                <option value="111">Tiền mặt</option>
                                                                <option value="112">Ngân hàng</option>
                                                              
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="submit" id="btn_add" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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
<script src="<?= HOME ?>/js/accnumber.js"></script>