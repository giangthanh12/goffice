<script src="<?= HOME ?>/js/listusers.js"></script>
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
                                <th></th>
                                <th>Username</th>
                                <th>Tên nhân viên</th>
                                <th>Nhóm</th>
                                <th>...</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="updateinfo"  role="dialog"
                         aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16"></h4>
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="form-validate" enctype="multipart/form-data" id="fm">
                                                <div class="col-12">
                                                    <label for="fname-icon">Tên đăng nhập</label>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                                data-feather="user"></i></span>
                                                                </div>
                                                                <input type="text" id="username" class="form-control"
                                                                       
                                                                       name="username" placeholder="Username"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="email-icon">Nhân viên</label>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <select class="select2 form-control" id="staffId"
                                                                    name="staffId" placeholder="Nhân viên">
                                                                <option value="">--Chọn nhân viên--</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="contact-icon">Nhóm</label>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <select class="select2 form-control" id="groupId"
                                                                    name="groupId" placeholder="Nhóm">
                                                                <option value="">--Chọn nhóm--</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="password">Mật khẩu</label>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                                data-feather="lock"></i></span>
                                                                </div>
                                                                <input type="password" id="password"
                                                                       class="form-control" name="password"
                                                                       />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="fname-icon">Số máy nhánh</label>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                                data-feather="phone"></i></span>
                                                                </div>
                                                                <input type="text" id="extNum" class="form-control"
                                                                       
                                                                       name="extNum"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="password">Mật khẩu nhánh</label>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <div class="input-group input-group-merge">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                                data-feather="lock"></i></span>
                                                                </div>
                                                                <input type="password" id="sipPass"
                                                                       class="form-control" name="sipPass"
                                                                       />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-sm-row flex-column mt-2">
                                                    <button type="button" onclick="save()"
                                                            class="btn btn-add btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">
                                                        Cập nhật
                                                    </button>
                                                    <!--                                                    <button type="button" onclick="saveGroupRole()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>-->
                                                    <button type="reset" class="btn btn-outline-secondary"
                                                            data-dismiss="modal">Bỏ qua
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade text-left" id="setroles" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="title-2"></h4>
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <!-- <div class="card">
                                        <div class="card-body">-->
                                    <div class="col-12">
                                        <div class="table-responsive border rounded mt-1">
                                            <table class="table table-striped table-borderless">
                                                <thead class="thead-light" id="theadSetRoles">
                                                <tr>
                                                    <th>Chức năng</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody id="bodySetRoles">
                                                <tr>
                                                    <td>Admin</td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   id="admin-read"/>
                                                            <label class="custom-control-label"
                                                                   for="admin-read">Read</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   id="admin-write"/>
                                                            <label class="custom-control-label"
                                                                   for="admin-write">Write</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   id="admin-create"/>
                                                            <label class="custom-control-label" for="admin-create">Create</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   id="admin-delete"/>
                                                            <label class="custom-control-label" for="admin-delete">Delete</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                        <button type="button" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1"
                                                onclick="updateRoles(); return false;">Cập nhật
                                        </button>
                                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ
                                            qua
                                        </button>
                                    </div>

                                    <!-- </div>
                                </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>