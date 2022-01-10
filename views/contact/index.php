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
                                    <th>Họ tên</th>
                                    <th>Điện thoại</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="updateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16"></h4>
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" enctype="multipart/form-data" id="dg">
                                                <div class="row mt-1">
                                                    <div class="col-md-6 form-group">
                                                    <label for="link">Tên liên lạc</label>
                                                        <input id="name" name="name" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="customerId">Khách hàng</label>
                                                        <select id="customerId" class="select2 form-control" name="customerId">
                                                         
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="phoneNumber">Số điện thoại</label>
                                                        <input id="phoneNumber" name="phoneNumber" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="email">Email</label>
                                                        <input id="email" name="email" type="email" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="facebook">Facebook(nếu có)</label>
                                                        <input id="facebook" name="facebook" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="zalo">Zalo(nếu có)</label>
                                                        <input id="zalo" name="zalo" type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6  form-group">
                                                        <label for="status">Tình trạng</label>
                                                        <select id="status" class="form-control" name="status">
                                                            <option value="1">Khả dụng</option>
                                                            <option value="2">Ẩn</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="note">Chú thích</label>
                                                       <textarea name="note" class="form-control" id="note" cols="30" rows="5"></textarea>
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
<script>
    var userFuns = JSON.parse('<?=json_encode($this->funs)?>');
    console.log(userFuns);
</script>
<script src="<?= HOME ?>/js/contact.js"></script>