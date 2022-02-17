<?php
class interview extends Controller
{
    static private $funAdd = 0, $funEdit = 0, $funDel = 0;
    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('interview');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('interview');

        foreach ($funcs as $item) {
            if ($item['function'] == 'add')
                self::$funAdd = 1;
            if ($item['function'] == 'edit')
                self::$funEdit = 1;
            if ($item['function'] == 'del')
                self::$funDel = 1;
        }
    }
    function index()
    {
        require "layouts/header.php";
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $this->view->funDel = self::$funDel;
        $this->view->render("interview/index");
        require "layouts/footer.php";
    }

    function getRecruitmentCamp()
    {
        $jsonObj = $this->model->getRecruitmentCamp();
        echo json_encode($jsonObj);
    }

    function getCandidate()
    {
        $campId = $_REQUEST['campId'];
        $jsonObj = $this->model->getCandidate($campId);
        echo json_encode($jsonObj);
    }

    function getStaff()
    {
        $jsonObj = $this->model->getStaff();
        echo json_encode($jsonObj);
    }

    function updateInterview()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $campId = isset($_REQUEST['campId']) ? $_REQUEST['campId'] : '';
        $canId = isset($_REQUEST['canId']) ? $_REQUEST['canId'] : '';
        $dateTime = isset($_REQUEST['dateTime']) ? date('Y-m-d H:i', strtotime($_REQUEST['dateTime'])) : '';
        $interviewerIds = isset($_REQUEST['interviewerIds']) ? implode(',', $_REQUEST['interviewerIds']) : '';
        $result = isset($_REQUEST['result']) ? $_REQUEST['result'] : '';
        $note = isset($_REQUEST['note']) ? $_REQUEST['note'] : '';
        $data = array(
            'campId' => $campId,
            'applicantId' => $canId,
            'dateTime' => $dateTime,
            'interviewerIds' => $interviewerIds,
            'result' => $result,
            'note' => $note,
            'status' => 1
        );
        if (self::$funAdd == 1 && empty($id)) {
            if ($this->model->addInterview($data)) {
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                $jsonObj['success'] = false;
            }
        } else if (self::$funEdit == 1 && !empty($id) && $id > 0) {
            if ($this->model->updateInterview($id, $data)) {
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                $jsonObj['success'] = false;
            }
        } else {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function getListInterview()
    {
        $nhanvien = (isset($_REQUEST['nhanvien']) && $_REQUEST['nhanvien'] != '') ? $_REQUEST['nhanvien'] : '';
        $thang = (isset($_REQUEST['thang']) && ($_REQUEST['thang'] != '')) ? $_REQUEST['thang'] : date("m");
        $nam = (isset($_REQUEST['nam']) && ($_REQUEST['nam'] != '')) ? $_REQUEST['nam'] : date("Y");
        $data = $this->model->getListInterview($thang, $nam, $nhanvien);
        if ($data) {
            $jsonObj['success'] = true;
            $jsonObj['data'] = $data;
        } else {
            $jsonObj['success'] = false;
            $jsonObj['msg'] = "Lỗi truy xuất database";
        }
        echo json_encode($jsonObj);
    }

    function getCanCv()
    {
        $canId = $_REQUEST['canId'];
        $data = $this->model->getCanCv($canId);
        if ($data) {
            $jsonObj['success'] = true;
            $jsonObj['data'] = $data[0]['cv'];
        } else {
            $jsonObj['success'] = false;
            $jsonObj['msg'] = "Lấy dữ liệu không thành công!";
        }
        echo json_encode($jsonObj);
    }

    function del()
    {
        if (self::$funDel == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['id'];
        $data = ['status' => 0];
        if ($this->model->delObj($id, $data)) {
            $data = $this->model->checkCalendar($id, 0);
            if (count($data) > 0) {
                foreach ($data as $item) {
                    $this->model->updateCalendar($item['id'], ['status' => 0]);
                }
            }
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
}
