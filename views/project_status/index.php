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
                    <div class="d-flex justify-content-between align-items-center mx-50 row pt-2 pb-2">
                    <h2 class="content-header-title float-left mb-0" id="title_module" style="border-right-width: 0px;">
                        Tình trạng dự án    <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Là chức năng thiết lập và quản lý nhiều trạng thái khác nhau của một dự án" data-trigger="click" >
                    </h2>
                    </div>
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Trạng thái dự án</th>
                                    <th>Mã màu</th>
                                    <th>Trạng thái</th>
                                    <?php
                                    if ($this->funEdit == 1 && $this->funDel == 1) {
                                    ?>
                                        <th>Thao tác</th>
                                    <?php
                                    } 
                                    ?>
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
                                            <form class="form-validate" enctype="multipart/form-data" id="dg">
                                                <div class="row mt-1">
                                                    <div class="col-md-12 form-group">
                                                    <label for="link">Status project</label>
                                                        <input id="name" name="name" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label for="color">Mã màu</label>
                                                        <input id="color" name="color" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-12  form-group">
                                                        <label for="status">Tình trạng</label>
                                                        <select id="status" class="form-control" name="status">
                                                            <option value="1">Chưa kích hoạt</option>
                                                            <option value="2">Đang kích hoạt</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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
    var userFuns = JSON.parse('<?=json_encode($this->funs)?>');
    var funEdit = <?=$this->funEdit?>,
    funDel = <?=$this->funDel?>;
</script>
<script src="<?= HOME ?>/js/project_status.js"></script>