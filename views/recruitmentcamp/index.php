
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            
        </div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <!-- users filter start -->
                
                <!-- users filter end -->
                <!-- list section start -->
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Người tạo</th>
                                    <th>Tên chiến dịch</th>
                                    <th>Vị trí</th>
                                    <th>Phòng ban</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Số lượng</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade text-left" id="addinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
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
                                                <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="title">Tên chương trình</label>
                                                                    <input id="title" type="text" class="form-control" name="title" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="inChargeId">Người phụ trách chương trình</label>
                                                                    <select id="inChargeId" class="select2 form-control" name="inChargeId">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="followerId">Thành viên khác</label>
                                                                    <select id="followerId" multiple="multiple" required data-msg-required="Yêu cầu chọn thành viên" class="select2 form-control" name="followerId[]">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="estimateCost">Chi phí ước tính</label>
                                                                    <input id="estimateCost" type="text" class="form-control format_number" name="estimateCost" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="startDate">Ngày bắt đầu</label>
                                                                    <input id="startDate" type="text" class="form-control flatpickr-basic" name="startDate" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="endDate">Ngày kết thúc</label>
                                                                    <input id="endDate" type="text" class="form-control" name="endDate" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="department">Phòng ban</label>
                                                                    <select id="department" class="select2 form-control" name="department">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="branch">Chi nhánh tuyển dụng</label>
                                                                    <select id="branch" class="select2 form-control" name="branch">
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="position">Vị trí tuyển dụng</label>
                                                                    <select id="position" class="select2 form-control" name="position">
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="workOn">Hình thức làm việc</label>
                                                                    <select id="workOn" class="form-control" name="workOn">
                                                                        <option value="1">Fulltime</option>
                                                                        <option value="2">Parttime</option>
                                                                        <option value="3">Freelancer</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="minSalary">Lương/phụ cấp tối thiểu</label>
                                                                    <input id="minSalary" name="minSalary" type="text" class="form-control format_number" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="maxSalary">Lương/phụ cấp tối đa</label>
                                                                    <input id="maxSalary" type="text" class="form-control format_number" name="maxSalary" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="quantity">Số lượng tuyển dụng</label>
                                                                    <input id="quantity" type="text" class="form-control" name="quantity" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="minAge">Độ tuổi tối thiểu</label>
                                                                    <input id="minAge" type="text" class="form-control" name="minAge" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="maxAge">Độ tuổi tối đa</label>
                                                                    <input id="maxAge" type="text" class="form-control" name="maxAge" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="educationLevel">Trình độ học vấn</label>
                                                                    <select id="educationLevel" class="form-control" name="educationLevel">
                                                                        <option value="1">THCS</option>
                                                                        <option value="2">THPT</option>
                                                                        <option value="3">CĐ/ĐH</option>
                                                                        <option value="4">Nghề</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="professional">Trình độ chuyên môn</label>
                                                                    <input id="professional" type="text" class="form-control" name="professional" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="yearOfExperience">Số năm kinh nghiệm</label>
                                                                    <input id="yearOfExperience" type="text" class="form-control" name="yearOfExperience" />
                                                                </div>
                                                            </div>
                                                            <!--
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="status">Trạng thái</label>
                                                                    <select id="status" class="select2 form-control" name="status">
                                                                        <option value="1">Khả dụng</option>
                                                                        <option value="2">Ẩn</option>
                                                                    </select>
                                                                </div>
                                                            </div> -->
                                                              <div class="col-lg-4 col-md-6">
                                                            
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="file1">File upload</label>
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input" id="file1" name="file1">
                                                                            <label class="custom-file-label" for="file1">Chọn file</label>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="description">Mô tả chương trình</label>
                                                                    <textarea  id="description"  name="description" class="form-control"></textarea>
                                                                </div>
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

                    <div class="modal fade text-left" id="updateinfo" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16"></h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="id" name="id" />
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="nav nav-pills" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center active" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                                        <i data-feather="info"></i><span class="d-none d-sm-block">Thông tin chiến dịch</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link d-flex align-items-center " id="information-tab" data-toggle="tab" href="#candidateList" aria-controls="information" role="tab" aria-selected="false">
                                                        <i data-feather="info"></i><span class="d-none d-sm-block">Danh sách ứng viên</span>
                                                    </a>
                                                </li>
                                              
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="information" aria-labelledby="information-tab" role="tabpanel">
                                                    <form class="form-validate" enctype="multipart/form-data" id="dg1">
                                                        <div class="row mt-1">
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="title1">Tên chương trình</label>
                                                                    <input id="title1" type="text" class="form-control" name="title1" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="inChargeId1">Người phụ trách chương trình</label>
                                                                    <select id="inChargeId1" class="select2 form-control" name="inChargeId1">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="followerId1">Thành viên khác</label>
                                                                    <select class="form-control select2" required data-msg-required="Yêu cầu chọn thành viên" multiple="multiple" id="followerId1" name="followerId1[]"></select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="estimateCost1">Chi phí ước tính</label>
                                                                    <input id="estimateCost1" type="text" class="form-control format_number" name="estimateCost1" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="startDate1">Ngày bắt đầu</label>
                                                                    <input id="startDate1" type="text" class="form-control flatpickr-basic" name="startDate1" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="endDate1">Ngày kết thúc</label>
                                                                    <input id="endDate1" type="text" class="form-control flatpickr-basic" name="endDate1" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="department1">Phòng ban</label>
                                                                    <select id="department1" class="select2 form-control " name="department1">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="branch1">Chi nhánh tuyển dụng</label>
                                                                    <select id="branch1" class="select2 form-control" name="branch1">
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="position1">Vị trí tuyển dụng</label>
                                                                    <select id="position1" class="select2 form-control" name="position1">
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="workOn1">Hình thức làm việc</label>
                                                                    <select id="workOn1" class="form-control" name="workOn1">
                                                                        <option value="1">Fulltime</option>
                                                                        <option value="2">Parttime</option>
                                                                        <option value="3">Freelancer</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="minSalary1">Lương/phụ cấp tối thiểu</label>
                                                                    <input id="minSalary1" name="minSalary1" type="text" class="form-control format_number" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="maxSalary1">Lương/phụ cấp tối đa</label>
                                                                    <input id="maxSalary1" type="text" class="form-control format_number" name="maxSalary1" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="quantity1">Số lượng tuyển dụng</label>
                                                                    <input id="quantity1" type="text"  class="form-control" name="quantity1" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="minAge1">Độ tuổi tối thiểu</label>
                                                                    <input id="minAge1" type="text" class="form-control" name="minAge1" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="maxAge1">Độ tuổi tối đa</label>
                                                                    <input id="maxAge1" type="text" class="form-control" name="maxAge1" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="educationLevel1">Hình thức làm việc</label>
                                                                    <select id="educationLevel1" class="form-control" name="educationLevel1">
                                                                        <option value="1">THCS</option>
                                                                        <option value="2">THPT</option>
                                                                        <option value="3">CĐ/ĐH</option>
                                                                        <option value="4">Nghề</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="professional1">Trình độ chuyên môn</label>
                                                                    <input id="professional1" type="text" class="form-control" name="professional1" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="yearOfExperience1">Số năm kinh nghiệm</label>
                                                                    <input id="yearOfExperience1" type="text" class="form-control" name="yearOfExperience1" />
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="status1">Trạng thái</label>
                                                                    <select id="status1" class="select2 form-control" name="status1">
                                                                        <option value="1">Khả dụng</option>
                                                                        <option value="2">Ẩn</option>
                                                                    </select>
                                                                </div>
                                                            </div> -->
                                                            <div class="col-lg-4 col-md-6">
                                                            
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="file2">File upload</label>
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input" id="file2" name="file2">
                                                                            <label class="custom-file-label" for="file2">Chọn file</label>
                                                                        </div>
                                                                        <div id="viewfile"></div>
                                                                    </div>
                                                            </div>
                                                     
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="description1">Mô tả chương trình</label>
                                                                    <textarea  id="description1"  name="description1" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- listCandidate -->
                                                <div class="tab-pane card" id="candidateList" width="100%" aria-labelledby="candidateList-tab" role="tabpanel">
                                                    <div class="table-responsive border rounded mt-1">
                                                        <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                            <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                            <span class="align-middle">Chi tiết</span>
                                                       
                                                        </h6>
                                                        <table class="table asset-candidate-list-table" id="asset-issue-list-table">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Tên ứng viên</th>
                                                                    <th>Giới tính</th>
                                                                    <th>Email</th>
                                                                    <th>Số điện thoại</th>
                                                                    <th>Trạng thái</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>

                                                <!-- end Listcandidate -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

<!-- Thêm lịch phỏng vấn -->
<div class="modal modal-slide-in event-sidebar fade" id="add-new-calendar">
                    <div class="modal-dialog sidebar-lg">
                        <div class="modal-content p-0">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                            <div class="modal-header mb-1">
                                <h5 class="modal-title-calendar">Thêm lịch phỏng vấn cho ứng viên</h5>
                            </div>
                            <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                <form id="interviewForm" class="event-form needs-validation" data-ajax="false" novalidate="novalidate">
                                    <input type="hidden" name="applicantId" id="applicantId">  
                                    <input type="hidden" name="campId" id="campId">      
                                
                                    <div class="form-group">
                                        <label for="dateTime" class="form-label">Lịch phỏng vấn</label>
                                        <input type="text" class="form-control flatpickr-basic" id="dateTime" name="dateTime"
                                               placeholder="DD-MM-YYYY" required="true" >
                                    </div>
                                    <div class="form-group">
                                        <label for="dateTime" class="form-label">Giờ phỏng vấn</label>
                                        <input type="text" class="form-control" id="timeInterview" name="timeInterview"
                                                required="true" >
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="interviewerIds" class="form-label">Người phỏng vấn</label>
                                        <select name="interviewerIds[]" id="interviewerIds" required data-msg-required="Yêu cầu chọn người phỏng vấn" multiple="multiple" class="form-control select2"></select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="round" class="form-label">Vòng phỏng vấn</label>
                                        <input type="number" min="1" class="form-control" id="round" name="round"
                                                required="true" >
                                    </div> -->
                                    <div class="form-group">
                                        <label for="round" class="form-label">Kết quả phỏng vấn</label>
                                        <select required data-msg-required="Yêu cầu chọn trạng thái" class="select2 select-label form-control w-100" id="result" name="result">
                                            <option data-label="#FF9F43" value="1">Hẹn phỏng vấn</option>
                                            <option data-label="#28C76F" value="2">Đạt</option>
                                            <option data-label="#EA5455" value="3">Không đạt</option>
                                            <option data-label="#E83E8C" value="4">Từ chối</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Ghi chú</label>
                                        <textarea name="noteCalendar" id="noteCalendar"
                                         class="form-control"></textarea>
                                    </div>
                                    <div class="form-group d-flex">
                                       <button type="submit" id = "updateInterview"
                                               class="btn btn-primary add-event-btn mr-1 waves-effect waves-float waves-light">
                                       Thêm
                                       </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



  <!---modal BÁO MẤT HỎNG-->
  <div class="modal modal-slide-in new-user-modal fade" id="modalCandidate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16">Thêm ứng viên vào chiến dịch</h4>
                                </div>
                                <div class="modal-body" style="margin:0;">
                                    <!-- <input type="hidden" id="id" name="id" /> -->
                                    <div class="card">

                                            <form class="form-validate" enctype="multipart/form-data" id="formCandidate">
                                               <input type="hidden" name="camId" id="camId" />
                                            <div class="row mt-1">
                                       
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="name">Ứng viên</label>
                                                            <select  id="canId" name="canId[]" multiple="multiple" class="form-control select2">
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                        <button type="button" onclick="addCandidate()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                    </div>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade text-left" id="nhapexcel" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modal-title1">Nhập khách hàng từ excel</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="fm-nhapexcel">
                                        <div class="form-group">
                                            <label class="form-label mr-4" for="file">Tải file mẫu</label>
                                            <a target="_blank" href="<?= URLFILE ?>/uploads/customer.xlsx" style="color: blue;">Tải xuống <i class="fas fa-download"></i></a>

                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="file">File upload</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file" name="file">
                                                <label class="custom-file-label" for="file">Chọn file</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="staffId2">Nhân viên chăm sóc</label>
                                            <select id="staffId2" class="select2 form-control" name="staffId2"></select>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-dismiss="modal" onclick="savenhap()">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--moda dbao gia -->

                    <div class="modal fade text-left" id="modal_baogia" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16"></h4>
                                </div>

                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="information" aria-labelledby="information-tab" role="tabpanel">
                                                    <!-- users edit Info form start -->
                                                    <form class="form-validate" enctype="multipart/form-data" id="dg_bg">
                                                        <input type="hidden" id="id_bg" name="id_bg" />

                                                        <div class="row mt-1">
                                                            <div class="col-12">
                                                                <h4 class="mb-1">
                                                                    <i data-feather="user" class="font-medium-4 mr-25"></i>
                                                                    <span class="align-middle">Thông tin</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="hoten">Thời gian</label>
                                                                    <input id="ngay" type="text" class="form-control ngay_gio" name="ngay" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-2">
                                                                <div class="form-group">
                                                                    <label for="hoten">Khách hàng</label>
                                                                    <select name="khach_hang_bg" id="khach_hang_bg" class="select2-data-array form-control" onchange="check_form();"></select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-2">
                                                                <div class="form-group">
                                                                    <label for="hoten">Nhân viên</label>
                                                                    <select name="nhan_vien_bg" id="nhan_vien_bg" class="select2-data-array form-control" onchange="check_form();"></select>
                                                                </div>
                                                            </div>


                                                            <div class="col-lg-3 col-md-2">
                                                                <div class="form-group">
                                                                    <label for="hoten">Tình trạng</label>
                                                                    <select name="tinh_trang_bg" id="tinh_trang_bg" class="form-control">
                                                                        <option value="1">Mới tạo</option>
                                                                        <option value="2">Đang chờ</option>
                                                                        <option value="3">Đã chốt</option>
                                                                        <option value="4">Hợp đồng</option>
                                                                        <option value="5">Hủy</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <h4 class="mb-1">
                                                                    <i data-feather="menu" class="font-medium-4 mr-25"></i>
                                                                    <span class="align-middle">Thông tin sản phẩm, dịch vụ</span>
                                                                </h4>
                                                            </div>

                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="tinh_trang">Chọn dịch vụ</label>
                                                                    <select name="dich_vu" id="dich_vu" class="select2-data-array form-control dich_vu" onchange="load_dichvu();"></select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="tinh_trang">Chọn sản phẩm</label>
                                                                    <select name="san_pham" id="san_pham" class="select2-data-array form-control" onchange="load_sanpham();"></select>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <input type="hidden" name="stt" id="stt" value="0">
                                                                <table class="table dataTable no-footer">
                                                                    <thead>
                                                                        <th> Tên dịch vụ, sản phẩm </th>
                                                                        <th> Giá bán </th>
                                                                        <th> Số lượng </th>
                                                                        <th> Chiết khấu </th>
                                                                        <th> Thuế VAT </th>
                                                                        <th> Tiền thuế </th>
                                                                        <th> Thời hạn </th>
                                                                        <th> Thành tiền </th>
                                                                        <th> </th>
                                                                    </thead>
                                                                    <tbody id="table_sp">

                                                                    </tbody>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td colspan="5"></td>
                                                                            <td colspan="1" class="text-right">Tổng đơn</td>
                                                                            <td colspan="2"><input type="text" class="form-control format_number" id="tong_donhang" readonly name="tong_donhang"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="5"></td>
                                                                            <td colspan="1" class="text-right">Chiết khấu</td>
                                                                            <td colspan="2"><input type="text" class="form-control format_number" value="0" id="chiet_khau" name="chiet_khau" onkeyup="tong_thanh_toan()"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="5"></td>
                                                                            <td colspan="1" class="text-right"><b>Tổng thanh toán</b></td>
                                                                            <td colspan="2"><input type="text" class="form-control format_number" readonly value="0" id="thanh_toan" name="thanh_toan"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>


                                                            <div class="col-12">
                                                                <h4 class="mb-1 mt-2">
                                                                    <i data-feather="menu" class="font-medium-4 mr-25"></i>
                                                                    <span class="align-middle">Thông tin thêm</span>
                                                                </h4>
                                                            </div>

                                                            <div class="col-lg-3 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="diachi">Files</label>
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="file" name="file">
                                                                        <label class="custom-file-label" for="file">Chọn file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <!-- <div id="viewfile"></div> -->
                                                                </div>
                                                            </div>


                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="ngaycap">Ghi chú</label>
                                                                    <textarea id="ghi_chu_bg" name="ghi_chu_bg" class="form-control"></textarea>
                                                                </div>
                                                            </div>



                                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                                <button type="button" onclick="savetk()" class="btn btn-add btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Bỏ qua</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- users edit Info form ends -->
                                                </div>
                                                <!-- Social Tab ends -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!--end modal add/edit bao gia-->
                </div>
            </section>
        </div>
    </div>
</div>
<script>
    var funAdd = <?=$this->funAdd?>,
        funEdit = <?=$this->funEdit?>,
        funDel = <?=$this->funDel?>;
        console.log(funAdd, funEdit, funDel);
     
</script>
<script src="<?= HOME ?>/js/recruitmentcamp.js"></script>