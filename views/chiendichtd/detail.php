<!-- <style>
#table_sp { max-height: 300px; overflow-y: scroll }
</style> -->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Thông tin chiến dịch</h2>
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
                            <a class="nav-link active" id="tab-1" data-toggle="tab" href="#tab1" aria-controls="tab1" role="tab" aria-selected="true"><i data-feather="home"></i> Thông tin chung</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-2" data-toggle="tab" href="#tab2" aria-controls="tab2" role="tab" aria-selected="false"><i data-feather="tool"></i> Ứng viên</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-3" data-toggle="tab" href="#tab3" aria-controls="tab3" role="tab" aria-selected="false"><i data-feather="tool"></i> Lịch phỏng vấn</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-4" data-toggle="tab" href="#tab4" aria-controls="tab4" role="tab" aria-selected="false"><i data-feather="tool"></i> Báo cáo</a>
                        </li>
                        <!-- <i data-feather='settings'></i> -->
                        <div class="btn-group align-items-center">
                            <div class="btn-group">
                                <a class="btn dropdown-toggle hide-arrow" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather='refresh-cw'></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="javascript:void(0);">Thực hiện</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Hoàn thành</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Hủy</a>
                                </div>
                            </div>
                            <a class="btn-sm" onclick="ngansach()"><i data-feather='credit-card'></i></i></a>
                            <!-- <a class="btn-sm" onclick="hoanduyet()"><i data-feather='corner-up-left'></i></a>
                            <a class="btn-sm" onclick="duyet()"><i data-feather='check-square'></i></a>
                            <div class="btn-group">
                                <a class="btn dropdown-toggle hide-arrow" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather='more-vertical'></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <a href="javascript:void(0)" class="dropdown-item" onclick="edit_cdtd()">
                                        <i data-feather='file-text'></i>
                                        Sửa</a>
                                    <a href="javascript:void(0)" class="dropdown-item delete-record" onclick="del()">
                                        <i data-feather='trash-2'></i>
                                        Xóa</a>
                                </div>
                            </div> -->
                        </div>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1" aria-spanledby="tab-1" role="tabpanel">
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
                                                        <span>Tên chiến dịch</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="name"></span>
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
                                                        <span>Thời gian</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="thoi_gian"></span>
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
                                                        <span>Chi phí dự kiến</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="chi_phi_du_kien"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Còn lại</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="con_lai"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Chi phí thực tế</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="chi_phi_thuc_te"></span>
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

                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <span>Người phụ trách</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="nguoi_phu_trach"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h4 class="mt-2">
                                        <i data-feather="map-pin" class="font-medium-4 mr-25"></i>
                                        <span class="align-middle">Thông tin vị trí tuyển</span>
                                    </h4>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
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
                                                        <span>Mức lương</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="muc_luong"></span>
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
                                                        <span>Mẫu đánh giá</span>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <span class="font-weight-bold text-primary" id="mau_danh_gia"></span>
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
                                        <span class="align-middle">Cổng tuyển dụng</span>
                                    </h4>
                                </div>
                                <div class="col-12">
                                    <h4 class="mt-2">
                                        <i data-feather="map-pin" class="font-medium-4 mr-25"></i>
                                        <span class="align-middle">Thảo luận</span>
                                    </h4>
                                </div>
                            </section>
                        </div>

                        <div class="tab-pane" id="tab2" aria-spanledby="tab-2" role="tabpanel">
                            <section id="basic-horizontal-layouts">
                                Ứng viên
                            </section>
                        </div>

                        <div class="tab-pane" id="tab3" aria-spanledby="tab-3" role="tabpanel">
                            <section id="basic-horizontal-layouts">
                                Lịch phỏng vấn
                            </section>
                        </div>
                        <div class="tab-pane" id="tab4" aria-spanledby="tab-4" role="tabpanel">
                            <section id="basic-horizontal-layouts">
                                Báo cáo
                            </section>
                        </div>
                        <!-- </form> -->

                    </div>
                </div>

                <div class="modal fade text-left" id="ngansach" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modal-title4">Thêm ngân sách</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- <form id="fm-chiadata" class="row">
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
                                </form> -->
                                <table>
                                    <thead>
                                        <th style="width:250px">Nguồn ứng viên</th>
                                        <th style="width:100px">Tổng CV</th>
                                        <th style="width:190px">Chi phí dự kiến</th>
                                        <th style="width:190px">Bình quân</th>
                                        <th></th>
                                    </thead>
                                    <tbody id="table_sp" >
                                        <tr>
                                            <td class="pr-1"><input type="text" class="form-control input format_number" value="Ngân sách dự kiến" readonly></td>
                                            <td class="pr-1"><input type="text" class="form-control input format_number" value="" readonly></td>
                                            <td class="pr-1"><input type="text" class="form-control input format_number" value="" id="chi_phi_du_kien" readonly></td>
                                            <td class="pr-1"><input type="text" class="form-control input format_number" value="Chi phí bình quân" readonly></td>
                                        </tr>
                                        <tr class="pt-1">
                                            <td class="pr-1">
                                                <select name="nguon_uv[]" class="form-control nguonuv">
                                                </select>
                                            </td>
                                            <td class="pr-1"><input type="text" name="tong_cv" id="tong_cv" class="form-control input format_number" value="0" readonly></td>
                                            <td class="pr-1"><input type="text" name="chi_phi[]" class="form-control input format_number chiphi" value=""></td>
                                            <td class="pr-1"><input type="text" name="binh_quan" class="form-control input format_number" value="0"readonly></td>
                                            <td><i class="fas fa-trash-alt remove-button"></td>
                                        </tr>

                                    </tbody>
                                    <tfoot>
                                        <td class="pr-1"><i data-feather='plus-circle' onclick="addngansach()"></i><span class="float-right">Tổng thực tế</span></td>
                                        <td class="pr-1"><input type="text" name="tongcv" id="nguonuv" class="form-control input format_number" id="totalcv" value="0" readonly></td>
                                        <td class="pr-1"><input type="text" name="chi_phi_thuc_te" class="form-control input format_number" value="0" id="tongchiphi" readonly></td>
                                        <td class="pr-1"><input type="text" class="form-control input format_number" value="0" id="tongbinhquan" readonly ></td>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-dismiss="modal" onclick="saveduyet()">Cập nhật</button>
                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<script src="<?= HOME ?>/js/chiendichtd/detail.js"></script>