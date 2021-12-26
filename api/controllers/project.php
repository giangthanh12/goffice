<?php
class project extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function listProjects()
    {
        $json = $this->model->getData();
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi lấy dữ liệu";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
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

    function getProject()
    {
        $projectId = isset($_REQUEST['projectId']) ? $_REQUEST['projectId'] : '';
        if ($projectId == '') {
            $jsonObj['message'] = "Chưa nhập projectId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->getProject($projectId);
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

    function addProject()
    {
        if (isset($_FILES['image'])) {
            $filename = $_FILES['image']['name'];
            $fname = explode('.', $filename);
            if ($filename != '') {
                $dir = ROOT_DIR . '/uploads/project/';
                $file = functions::uploadfile('image', $dir, $fname[0]);
                if ($file != '')
                    $image =  'uploads/project/' . $file;
                $data['image'] = $image;
            }
        }
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        if ($name == '') {
            $jsonObj['message'] = "Chưa nhập tên dự án";
            $jsonObj['code'] = 401;
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->checkName(0, $name);
            if ($json == 0) {
                $jsonObj['message'] = "Tên dự án đã tồn tại";
                $jsonObj['code'] = 401;
                http_response_code(401);
                echo json_encode($jsonObj);
                return false;
            }
            $data['name'] = $name;
        }
        if (isset($_REQUEST['createDate']))
            $data['createDate'] = $_REQUEST['createDate'];
        if (isset($_REQUEST['deadline']))
            $data['deadline'] = $_REQUEST['deadline'];
        if (isset($_REQUEST['assignerId']))
            $data['assignerId'] = $_REQUEST['assignerId'];
        if (isset($_REQUEST['assigneeId']))
            $data['assigneeId'] = $_REQUEST['assigneeId'];
        if (isset($_REQUEST['description']))
            $data['description'] = $_REQUEST['description'];
        if (isset($_REQUEST['note']))
            $data['note'] = $_REQUEST['note'];
        if (isset($_REQUEST['level']))
            $data['level'] = $_REQUEST['level'];
        if (isset($_REQUEST['status']))
            $data['status'] = $_REQUEST['status'];
        $json = $this->model->addProject($data);
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            http_response_code(402);
            echo json_encode($jsonObj);
        } else {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
            $json = $this->model->getProject($json);
            $jsonObj['data'] = $json;
            http_response_code(200);
            echo json_encode($jsonObj);
        }
    }

    function updateProject()
    {
        $projectId = isset($_REQUEST['projectId']) ? $_REQUEST['projectId'] : '';
        if ($projectId == '') {
            $jsonObj['message'] = "Chưa nhập projectId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        }
        if (isset($_FILES['image'])) {
            $filename = $_FILES['image']['name'];
            $fname = explode('.', $filename);
            if ($filename != '') {
                $dir = ROOT_DIR . '/uploads/project/';
                $file = functions::uploadfile('image', $dir, $fname[0]);
                if ($file != '')
                    $image =  'uploads/project/' . $file;
                $data['image'] = $image;
            }
        }
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        if ($name == '') {
            $jsonObj['message'] = "Chưa nhập tên dự án";
            $jsonObj['code'] = 401;
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->checkName($projectId, $name);
            if ($json == 0) {
                $jsonObj['message'] = "Tên dự án đã tồn tại";
                $jsonObj['code'] = 401;
                http_response_code(401);
                echo json_encode($jsonObj);
                return false;
            }
            $data['name'] = $name;
        }
        if (isset($_REQUEST['createDate']))
            $data['createDate'] = $_REQUEST['createDate'];
        if (isset($_REQUEST['deadline']))
            $data['deadline'] = $_REQUEST['deadline'];
        if (isset($_REQUEST['assignerId']))
            $data['assignerId'] = $_REQUEST['assignerId'];
        if (isset($_REQUEST['assigneeId']))
            $data['assigneeId'] = $_REQUEST['assigneeId'];
        if (isset($_REQUEST['description']))
            $data['description'] = $_REQUEST['description'];
        if (isset($_REQUEST['note']))
            $data['note'] = $_REQUEST['note'];
        if (isset($_REQUEST['level']))
            $data['level'] = $_REQUEST['level'];
        if (isset($_REQUEST['status']))
            $data['status'] = $_REQUEST['status'];
        $json = $this->model->updateProject($projectId, $data);
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            http_response_code(402);
            echo json_encode($jsonObj);
        } else {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
            $json = $this->model->getProject($projectId);
            $jsonObj['data'] = $json;
            http_response_code(200);
            echo json_encode($jsonObj);
        }
    }

    function deleteProject()
    {
        $projectId = isset($_REQUEST['projectId']) ? $_REQUEST['projectId'] : '';
        if ($projectId == '') {
            $jsonObj['message'] = "Chưa nhập projectId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        }
        $data = ['status' => 0];
        $json = $this->model->updateProject($projectId, $data);
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            http_response_code(402);
            echo json_encode($jsonObj);
        } else {
            $jsonObj['message'] = "Câp nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
            $json = [];
            $jsonObj['data'] = $json;
            http_response_code(200);
            echo json_encode($jsonObj);
        }
    }
}
