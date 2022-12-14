
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
                       Địa điểm làm việc <img src="<?=HOME?>/layouts/tooltip.png" style="margin: 0 15px" width="25px" id="current_ip" data-toggle="tooltip" data-placement="right" data-original-title="Quản lý toàn bộ vị trí văn phòng, địa điểm làm việc của doanh nghiệp" data-trigger="click" >
                    </h2>
                    </div> 
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th>Tên gọi</th>
                                    <th>Chi nhánh</th>
                                    <th>Địa chỉ</th>
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
                                                    <label for="name">Tên gọi<span style="color:red;">*</span></label>
                                                    <input type="text" class="form-control" id="name" placeholder="Nhập tên nơi làm việc" name="name" required/>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Chi nhánh<span style="color:red;">*</span></label>
                                                    <!-- <input type="text" class="form-control" id="name" placeholder="Nhập tên Chi nhánh" name="name" /> -->
                                                    <select id="branch" name="branch" placeholder="Chi nhánh" class="select2 form-control" required>
                                                        <option value="">Chọn chi nhánh</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="accesspointIds">Điểm truy cập wifi<span style="color:red;">*</span></label>
                                                    <div class="form-group">
                                                    <select class="select2 form-control" multiple="multiple" data-msg-required="Bạn chưa chọn điểm truy cập wifi" required id="accesspointIds"
                                                    name="accesspointIds[]"></select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="dia_chi">Địa chỉ</label>
                                                    <textarea id="dia_chi" name="dia_chi" type="text" class="form-control "></textarea>
                                                </div>

                                                <div class="d-flex flex-sm-row flex-column mt-2">
                                                    <button type="button" onclick="save()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
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
<script src="<?= HOME ?>/js/workspaces.js"></script>