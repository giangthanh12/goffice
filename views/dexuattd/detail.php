<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Thông tin đề xuất</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Data</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="homeIcon-tab" data-toggle="tab" href="#homeIcon" aria-controls="home" role="tab" aria-selected="true"><i data-feather="home"></i> Thông tin chung</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profileIcon-tab" data-toggle="tab" href="#profileIcon" aria-controls="profile" role="tab" aria-selected="false"><i data-feather="tool"></i> Đính kèm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="quytrinh-tab" data-toggle="tab" href="#quytrinhIcon" aria-controls="quytrinh" role="tab" aria-selected="false"><i data-feather="tool"></i> Quy trình duyệt</a>
                        </li>
                        <!-- <i data-feather='settings'></i> -->
                        <div class="btn-group align-items-center">
                            <a class="btn-sm" onclick="hoanduyet()"><i data-feather='corner-up-left'></i></a>
                            <a class="btn-sm" onclick="duyet()"><i data-feather='check-square'></i></a>
                            <a class="btn dropdown-toggle hide-arrow" data-toggle="dropdown">
                                <i data-feather='more-vertical'></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item" onclick="edit_dxtd()">
                                    <i data-feather='file-text'></i>
                                    Sửa</a>
                                <a href="javascript:void(0)" class="dropdown-item delete-record" onclick="del()">
                                    <i data-feather='trash-2'></i>
                                    Xóa</a>
                            </div>
                        </div>
                    </ul>
                    <div class="tab-content">
                        <!-- <input type="hidden" id="id" name="id" /> -->
                        <div class="tab-pane active" id="homeIcon" aria-spanledby="homeIcon-tab" role="tabpanel">
                            <section id="basic-horizontal-layouts">
                                <!-- <form class="form form-horizontal" id="data-info"> -->
                                <div class="col-12">
                                    <h4 class="mt-2">
                                        <i data-feather="map-pin" class="font-medium-4 mr-25"></i>
                                        <span class="align-middle">Thông tin chung</span>
                                    </h4>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Tên đề xuất</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="name"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Vị trí</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="vi_tri"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Phòng ban</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="phong_ban"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Chi nhánh</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="chi_nhanh"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Hình thức làm việc</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="hinh_thuc"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Số lượng</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="so_luong"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Ứng tuyển</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="ung_tuyen"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Mức lương</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="muc_luong">1 - 2</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Trúng tuyển</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="trung_tuyen"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Hạn tuyển</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="han_tuyen"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Trạng thái</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="trang_thai"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Lý do tuyển</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="ly_do"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Chiến dịch</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="chien_dich"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Mô tả công việc</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="mo_ta"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h4 class="mt-2">
                                        <i data-feather="map-pin" class="font-medium-4 mr-25"></i>
                                        <span class="align-middle">Yêu cầu ứng viên</span>
                                    </h4>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Giới tính</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="gioi_tinh"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Độ tuổi</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="do_tuoi"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Chiều cao</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="chieu_cao"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Cân nặng</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="can_nang"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Trình độ</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="trinh_do"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Chuyên ngành</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="chuyen_nganh"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Kinh nghiệm</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="kinh_nghiem"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h4 class="mt-2">
                                        <i data-feather="map-pin" class="font-medium-4 mr-25"></i>
                                        <span class="align-middle">Thảo luận</span>
                                    </h4>
                                </div>
                            </section>
                        </div>

                        <div class="tab-pane" id="profileIcon" aria-spanledby="profileIcon-tab" role="tabpanel">
                            <section id="basic-horizontal-layouts">
                                Đính kèm
                            </section>
                        </div>

                        <div class="tab-pane" id="quytrinhIcon" aria-spanledby="quytrinhIcon-tab" role="tabpanel">
                            <section id="basic-horizontal-layouts">
                                Quy trình
                            </section>
                        </div>
                        <!-- </form> -->

                    </div>
                </div>

                <div class="modal fade text-left" id="duyetdx" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modal-title4">Duyệt đề xuất tuyển dụng</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="fm-chiadata" class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="soluong">Số lượng</label>
                                        <input type="text" id="soluong" class="form-control" name="so_luong" />
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <label for="hantuyen">Hạn tuyển</label>
                                        <input type="text" id="hantuyen" class="form-control flatpickr-basic" placeholder="DD/MM/YYYY" name="han_tuyen" />
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="notime" onchange="noTime()">
                                            <label class="form-check-label" for="notime">Tuyển đến khi đủ</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="minluong">Mức lương (từ)</label>
                                        <input type="text" id="minluong" class="form-control format_number" name="min_luong" />
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="maxluong">Mức lương (đến)</label>
                                        <input type="text" id="maxluong" class="form-control format_number" name="max_luong" />
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="mota">Mô tả công việc</label>
                                        <textarea class="form-control" id="mota" name="mota" row="5"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-dismiss="modal" onclick="saveduyet()">Duyệt</button>
                                <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-dismiss="modal" onclick="noduyet()">Không duyệt</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<script src="<?= HOME ?>/js/dexuattd/detail.js"></script>