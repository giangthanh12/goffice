<?php
class grouptask extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function listGroupsTask()
    {
        $json = $this->model->getData();
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi lấy dữ liệu";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            http_response_code(402);
            echo json_encode($jsonObj);
            return false;
        } else {
            $jsonObj['message'] = "Lấy dữ liệu thành công";
            $jsonObj['code'] = 200;
            $jsonObj['data'] = $json;
            http_response_code(200);
            echo json_encode($jsonObj);
            return true;
        }
        echo json_encode($json);
    }

    function getGroupTask()
    {
        $groupId = isset($_REQUEST['groupId']) ? $_REQUEST['groupId'] : '';
        if ($groupId == '') {
            $jsonObj['message'] = "Chưa nhập groupId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->getGroupTask($groupId);
            if ($json == 0) {
                $jsonObj['message'] = "Lỗi lấy dữ liệu";
                $jsonObj['code'] = 402;
                $jsonObj['data'] = [];
                http_response_code(402);
                echo json_encode($jsonObj);
                return false;
            } else {
                $jsonObj['message'] = "Lấy dữ liệu thành công";
                $jsonObj['code'] = 200;
                $jsonObj['data'] = $json;
                http_response_code(200);
                echo json_encode($jsonObj);
                return true;
            }
            echo json_encode($json);
        }
    }

    function addGroupTask()
    {
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        if ($name == '') {
            $jsonObj['message'] = "Chưa nhập tên nhóm công việc";
            $jsonObj['code'] = 401;
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->checkName(0, $name);
            if ($json == 0) {
                $jsonObj['message'] = "Tên nhóm công việc đã tồn tại";
                $jsonObj['code'] = 401;
                http_response_code(401);
                echo json_encode($jsonObj);
                return false;
            }
            $data['name'] = $name;
        }
        if (isset($_REQUEST['projectId']))
            $data['projectId'] = $_REQUEST['projectId'];
        $data['status'] = 1;
        $json = $this->model->addGroupTask($data);
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            http_response_code(402);
            echo json_encode($jsonObj);
        } else {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
            $json = $this->model->getGroupTask($json);
            $jsonObj['data'] = $json;
            http_response_code(200);
            echo json_encode($jsonObj);
        }
    }

    function updateGroupTask()
    {
        $groupId = isset($_REQUEST['groupId']) ? $_REQUEST['groupId'] : '';
        if($groupId == '') {
            $jsonObj['message'] = "Chưa nhập groupId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } 
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        if ($name == '') {
            $jsonObj['message'] = "Chưa nhập tên nhóm công việc";
            $jsonObj['code'] = 401;
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->checkName($groupId, $name);
            if ($json == 0) {
                $jsonObj['message'] = "Tên nhóm công việc đã tồn tại";
                $jsonObj['code'] = 401;
                http_response_code(401);
                echo json_encode($jsonObj);
                return false;
            }
            $data['name'] = $name;
        }
        if (isset($_REQUEST['projectId']))
            $data['projectId'] = $_REQUEST['projectId'];

        $json = $this->model->updateGroupTask($groupId, $data);
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            http_response_code(402);
            echo json_encode($jsonObj);
        } else {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
            $json = $this->model->getGroupTask($groupId);
            $jsonObj['data'] = $json;
            http_response_code(200);
            echo json_encode($jsonObj);
        }
    }

    function deleteGroupTask()
    {
        $groupId = isset($_REQUEST['groupId']) ? $_REQUEST['groupId'] : '';
        if($groupId == '') {
            $jsonObj['message'] = "Chưa nhập groupId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } 
        $data = ['status'=>0];
        $json = $this->model->updateGroupTask($groupId, $data);
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            http_response_code(402);
            echo json_encode($jsonObj);
        } else {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
            $json = [];
            $jsonObj['data'] = $json;
            http_response_code(200);
            echo json_encode($jsonObj);
        }
    }
}
