<!-- <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-kanban.css"> -->
<script src="<?= HOME ?>/js/menu.js"></script>

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
                                    <th>Tên menu</th>
                                    <th>Link</th>
                                    <th>Icon</th>
                                 
                                    <th>Tình trạng</th>
                                    <th>Thao tác</th>
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
                                                    <div class="col-md-6 col-md-6 form-group">
                                                    <label for="link">name</label>
                                                        <input id="name" name="name" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6 col-md-6 form-group">
                                                        <label for="tinh_trang">Tình trạng</label>
                                                        <select id="tinh_trang" class="form-control" name="tinh_trang">
                                                            <option value="0">Chọn tình trạng</option>
                                                            <option value="1">Đang kích hoạt</option>
                                                     
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="link">Link</label>
                                                        <input id="link" name="link" type="text" class="form-control" />
                                                    </div>
                                                   
                                                    <div class="col-md-6 form-group">
                                                    <label for="icon">Icon</label>
                                                        <input id="icon" name="icon" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="parentId">Cha</label>
                                                        <select id="parentId" class="form-control" name="parentId">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="sortOrder">Sắp xếp</label>
                                                        <input id="sortOrder" name="sortOrder" type="text" class="form-control" />
                                                    </div>

                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="button" onclick="savekh()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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
