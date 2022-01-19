<?php
class interview extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index(){
        require "layouts/header.php";
        $this->view->render("interview/index");
        require "layouts/footer.php";
    }
    function getRecruitmentCamp() {
        $jsonObj = $this->model->getRecruitmentCamp();
        echo json_encode($jsonObj);
    }
    function getCandidate() {
        $campId = $_REQUEST['campId'];
        $jsonObj = $this->model->getCandidate($campId);
        echo json_encode($jsonObj);
    }

    function getStaff() {
        $jsonObj = $this->model->getStaff();
        echo json_encode($jsonObj);
    }
    function updateInterview() {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $campId = isset($_REQUEST['campId']) ? $_REQUEST['campId'] : '';
        $canId = isset($_REQUEST['canId']) ? $_REQUEST['canId'] : '';
        $dateTime = isset($_REQUEST['dateTime']) ? date('Y-m-d H:i',strtotime($_REQUEST['dateTime'])) : '';
        $interviewerIds = isset($_REQUEST['interviewerIds']) ? implode(',',$_REQUEST['interviewerIds']) : '';
        $result = isset($_REQUEST['result']) ? $_REQUEST['result'] : '';
        $round = isset($_REQUEST['round']) ? $_REQUEST['round'] : '';
        $note = isset($_REQUEST['note']) ? $_REQUEST['note'] : '';
        $data = array(
            'campId' => $campId,
            'applicantId' => $canId,
            'dateTime' => $dateTime,
            'interviewerIds' => $interviewerIds,
            'result' => $result,
            'round' => $round,
            'note' => $note,
            'status'=>1
        );
            if ($this->model->updateInterview($id,$data)) {
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                $jsonObj['success'] = false;
            }
        
        echo json_encode($jsonObj);


    }
    function getListInterview() {
        $nhanvien = $_REQUEST['nhanvien'];
        $thang = (isset($_REQUEST['thang']) && ($_REQUEST['thang'] != '')) ? $_REQUEST['thang'] : date("m");
        $nam = (isset($_REQUEST['nam']) && ($_REQUEST['nam'] != '')) ? $_REQUEST['nam'] : date("Y");
        $data = $this->model->getListInterview($thang, $nam,$nhanvien);
        if ($data) {
            $jsonObj['success'] = true;
            $jsonObj['data'] = $data;
        } else {
            $jsonObj['success'] = false;
            $jsonObj['msg'] = "Lỗi truy xuất database";
        }
        echo json_encode($jsonObj);
    }

    function del()
    {
        $id = $_REQUEST['id'];
        $data = ['status' => 2];
        if ($this->model->delObj($id, $data)) {
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
}
