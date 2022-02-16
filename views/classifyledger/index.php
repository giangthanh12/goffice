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
                    </div>
                </div>
                

                <!-- list section start -->
                <div class="card" id="acmTable"> 
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                 
                                    <th>ID</th>
                                    <th>Tên hoạch toán</th>
                                    <th>Loại</th>
                                    <th>Ghi chú</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                    <div class="modal-dialog" role="document">
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
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">Tên hoạch toán</label>
                                                            <input type="text" id="name" name="name" class="form-control " placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label for="type">Loại</label>
                                                            <select name="type" id="type" class="form-control">
                                                                <option value="1">Thu</option>
                                                                <option value="2">Chi</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="form-group">
                                                            <label for="note">Ghi chú</label>
                                                            <textarea name="note" id="note" class="form-control"></textarea>
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
<script src="<?= HOME ?>/js/classifyLedger.js"></script>