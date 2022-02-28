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
                        <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng quản lý các phòng ban trong doanh nghiệp, công ty" data-trigger="click" >
                    </div>
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th>Tên gọi</th>
                                    <th>Mô tả</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal" role="document">
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
                                            <form class="form-validate" enctype="multipart/form-data" id="fm">
                                                <!-- <div class="row mt-1"> -->
                                                <div class="form-group">
                                                    <label for="name">Tên phòng ban</label>
                                                    <input type="text" class="form-control" id="name" placeholder="Nhập tên phòng ban" name="name" required />
                                                </div>

                                                <div class="form-group">
                                                    <label for="position">Vị trí phòng ban</label>
                                                    <select class="select2 form-control" multiple="multiple" data-msg-required="Bạn chưa chọn vị trí phòng ban" required id="position"
                                                    name="position[]"></select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="ghi_chu">Ghi chú</label>
                                                    <textarea id="description" name="description" type="text" class="form-control " /></textarea>
                                                </div>
                                                <div class="d-flex flex-sm-row flex-column mt-2">
                                                    <button type="button" onclick="savepb()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                </div>
                                                <!-- </div> -->
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
<script src="<?= HOME ?>/js/phongban.js"></script>