<?php

class request extends Controller
{
    function __construct()
    {
        parent::__construct();

    }

    function index()
    {
        require "layouts/header.php";
        $this->view->departments = $this->model->getDepartments();
        $this->view->staffs = $this->model->getStaffs();
        $this->view->requests = $this->model->getRequestDefines();
        $this->view->render("request/index");
        require "layouts/footer.php";
    }

    function getAllRequests()
    {
        $defineId = isset($_REQUEST['defineId']) ? $_REQUEST['defineId'] : 0;
        $process = $this->model->getAllStep($defineId);

        foreach ($process as $key => $item) {
            $jsonObj[]['id'] = 'step-'.$item['id'];
            $jsonObj[$key]['title'] = $item['name'];
            $tempItems = $this->model->getALlRequestSteps($item['id']);
            $jsonObj[$key]['item'] = [];
            foreach ($tempItems as $itemStep) {
                $temp["stepId"] = $item['id'];
                $temp["id"] = $itemStep['id'];
                $temp["note"] = $itemStep['title'];
                $temp["badge-title"] = $itemStep['departmentName'];
                $temp["badge"] = '';
                $temp["dateTime"] = $itemStep['dateTime'];
                $temp["staffId"] = $itemStep['staffId'];
                $temp["staffAvatar"] = $itemStep['staffAvatar'];
                $temp["staffName"] = $itemStep['staffName'];
                $temp["processors"] = $item['processors'];
                $temp["refusers"] = '';
                $temp["departmentId"] = $itemStep['departmentId'];
                array_push($jsonObj[$key]['item'], $temp);
            }
        }
        $processKey = count($process);
        $jsonObj[$processKey + 1]['id'] = 'success';
        $jsonObj[$processKey + 1]['title'] = 'Hoàn thành';
        $tempItems = $this->model->getALlRequests($defineId, 2);
        $jsonObj[$processKey + 1]['item'] = [];
        foreach ($tempItems as $item) {
            $temp["stepId"] = 'success';
            $temp["id"] = $item['id'];
            $temp["note"] = $item['title'];
            $temp["badge-title"] = $item['departmentName'];
            $temp["badge"] = '';
            $temp["dateTime"] = $item['dateTime'];
            $temp["staffId"] = $item['staffId'];
            $temp["staffAvatar"] = $item['staffAvatar'];
            $temp["staffAvatar"] = $item['staffAvatar'];
            $temp["staffName"] = $item['staffName'];
            $temp["processors"] = $item['processors'];
            $temp["refusers"] = '';
            $temp["departmentId"] = $item['departmentId'];
            array_push($jsonObj[$processKey + 1]['item'], $temp);
        }

        $jsonObj[$processKey + 2]['id'] = 'refuse';
        $jsonObj[$processKey + 2]['title'] = 'Từ chối';
        $tempItems = $this->model->getALlRequests($defineId, 3);
        $jsonObj[$processKey + 2]['item'] = [];
        foreach ($tempItems as $item) {
            $temp["stepId"] = 'refuse';
            $temp["id"] = $item['id'];
            $temp["note"] = $item['title'];
            $temp["badge-title"] = $item['departmentName'];
            $temp["badge"] = '';
            $temp["dateTime"] = $item['dateTime'];
            $temp["staffId"] = $item['staffId'];
            $temp["staffAvatar"] = $item['staffAvatar'];
            $temp["staffAvatar"] = $item['staffAvatar'];
            $temp["staffName"] = $item['staffName'];
            $temp["processors"] = $item['processors'];
            $temp["refusers"] = $item['refusers'];
            $temp["departmentId"] = $item['departmentId'];
            array_push($jsonObj[$processKey + 2]['item'], $temp);
        }
        $jsonObjNew = [];
        foreach ($jsonObj as $item){
            $jsonObjNew[]=$item;
        }
        echo json_encode($jsonObjNew);
    }

    function addRequest()
    {
        $defineId = isset($_REQUEST['defineId']) ? $_REQUEST['defineId'] : 0;
        $process = $this->model->getAllStep($defineId);
        $data['defineId'] = $defineId;
        $jsonObj = [];
        if (count($process) == 0) {
            $jsonObj['code'] = 401;
            $jsonObj['message'] = "Yêu cầu hiện tại chưa có tiến trình xử lý!";
            echo json_encode($jsonObj);
            return false;
        }
        $title = $_REQUEST['title'];
        if ($title == '') {
            $jsonObj['code'] = 402;
            $jsonObj['message'] = "Bạn chưa nhập tiêu đề!";
            echo json_encode($jsonObj);
            return false;
        }
        $data['title'] = $title;
        $dateTime = $_REQUEST['dateTime'];
        if ($dateTime == '') {
            $jsonObj['code'] = 402;
            $jsonObj['message'] = "Bạn chưa nhập ngày tạo!";
            echo json_encode($jsonObj);
            return false;
        }
        $dateTime = functions::convertDate($dateTime);
        $data['dateTime'] = $dateTime;
        $data['departmentId'] = $_REQUEST['department'];
        $staffId = $_REQUEST['staffId'];
        if ($staffId <= 0) {
            $jsonObj['code'] = 402;
            $jsonObj['message'] = "Bạn chưa chọn nhân viên!";
            echo json_encode($jsonObj);
            return false;
        }
        $data['staffId'] = $staffId;
        $data['status'] = 1;
        $requestId = $this->model->addRequest($data);
        if ($requestId > 0) {
            $stepId = $this->model->getStep($defineId, $requestId);
            if ($stepId > 0) {
                $dataStep = ['requestId' => $requestId, 'stepId' => $stepId, 'staffId' => 0, 'status' => 1];
                $this->model->addStep($dataStep);
            }
            $jsonObj['code'] = 200;
            $jsonObj['message'] = "Tạo yêu cầu thành công!";
            $jsonObj['data']['requestId'] = $requestId;
        } else {
            $jsonObj['code'] = 400;
            $jsonObj['message'] = "Tạo yêu cầu thất bại!";
        }
        echo json_encode($jsonObj);
    }

    function editRequest()
    {
        $jsonObj = [];
        $data = [];
        $requestId = $_REQUEST['id'];
        $title = $_REQUEST['title'];
        if ($title == '') {
            $jsonObj['code'] = 402;
            $jsonObj['message'] = "Bạn chưa nhập tiêu đề!";
            echo json_encode($jsonObj);
            return false;
        }
        $data['title'] = $title;
        $dateTime = $_REQUEST['dateTime'];
        if ($dateTime == '') {
            $jsonObj['code'] = 402;
            $jsonObj['message'] = "Bạn chưa nhập ngày tạo!";
            echo json_encode($jsonObj);
            return false;
        }
        $dateTime = functions::convertDate($dateTime);
        $data['dateTime'] = $dateTime;
        $data['departmentId'] = $_REQUEST['department'];
        $staffId = $_REQUEST['staffId'];
        if ($staffId <= 0) {
            $jsonObj['code'] = 402;
            $jsonObj['message'] = "Bạn chưa chọn nhân viên!";
            echo json_encode($jsonObj);
            return false;
        }
        $data['staffId'] = $staffId;
        $data['status'] = 1;
        $ok = $this->model->updateRequest($requestId, $data);
        if ($ok) {
            $jsonObj['code'] = 200;
            $jsonObj['message'] = "Cập nhật yêu cầu thành công!";
            $jsonObj['data']['requestId'] = $requestId;
        } else {
            $jsonObj['code'] = 400;
            $jsonObj['message'] = "Cập nhật yêu cầu thất bại!";
        }
        echo json_encode($jsonObj);
    }

    function saveProperties()
    {
        $defineId = isset($_REQUEST['defineId']) ? $_REQUEST['defineId'] : 0;
        if ($defineId <= 0)
            return false;
        $requestId = isset($_REQUEST['requestId']) ? $_REQUEST['requestId'] : 0;
        $properties = $this->model->getProperties($defineId, $requestId);
        $checkAdd = 0;
        $data = [];
        foreach ($properties as $item) {
            $propertyValue = isset($_REQUEST['property_' . $item['id']]) ? $_REQUEST['property_' . $item['id']] : '';
            $dataPro['requestId'] = $requestId;
            $dataPro['objectId'] = $item['id'];
            $dataPro['value'] = $propertyValue;
            $propertyId = $this->model->getSubrequestId($requestId, $item['id']);
            if ($propertyId > 0) {
                $ok = $this->model->updateProperty($propertyId, $dataPro);
            } else {
                $dataPro['status'] = 1;
                $ok = $this->model->addProperty($dataPro);
            }
            if ($ok)
                $checkAdd++;
            $data[] = $dataPro;
        }
        if ($checkAdd > 0) {
            $jsonObj['code'] = 200;
            $jsonObj['message'] = "Tạo thuộc tính thành công!" . json_encode($data);
        } else {
            $jsonObj['code'] = 400;
            $jsonObj['message'] = "Tạo thuộc tính thất bại!";
        }
        echo json_encode($jsonObj);
    }

    function approve()
    {
        $requestId = isset($_REQUEST['requestId']) ? $_REQUEST['requestId'] : 0;
        if ($requestId <= 0)
            return false;
        $stepId = isset($_REQUEST['stepId']) ? $_REQUEST['stepId'] : 0;
        if ($stepId <= 0)
            return false;
        $defineId = isset($_REQUEST['defineId']) ? $_REQUEST['defineId'] : 0;
        $staffId = $_SESSION['user']['staffId'];
        $dataProcess = ['status' => 2, 'staffId' => $staffId];
        $this->model->updateProcess($requestId, $stepId, 1, $dataProcess);
        $stepId = $this->model->getStep($defineId, $requestId);
        if ($stepId > 0) {
            $dataProcessNew = ['requestId' => $requestId, 'stepId' => $stepId, 'staffId' => 0, 'status' => 1];
            $checkApprove = $this->model->addStep($dataProcessNew);
        } else {
            $dataRequest = ['status' => 2];
            $checkApprove = $this->model->updateRequest($requestId, $dataRequest);
        }
        if ($checkApprove) {
            $jsonObj['code'] = 200;
            $jsonObj['message'] = "Duyệt yêu cầu thành công!";
        } else {
            $jsonObj['code'] = 400;
            $jsonObj['message'] = "Duyệt yêu cầu thất bại!";
        }
        echo json_encode($jsonObj);
    }

    function refuse()
    {
        $requestId = isset($_REQUEST['requestId']) ? $_REQUEST['requestId'] : 0;
        if ($requestId <= 0)
            return false;
        $stepId = isset($_REQUEST['stepId']) ? $_REQUEST['stepId'] : 0;
        if ($stepId <= 0)
            return false;
        $staffId = $_SESSION['user']['staffId'];
        $dataProcess = ['status' => 3, 'staffId' => $staffId];
        $this->model->updateProcess($requestId, $stepId, 1, $dataProcess);
        $dataRequest = ['status' => 3];
        $checkDenny = $this->model->updateRequest($requestId, $dataRequest);
        if ($checkDenny) {
            $jsonObj['code'] = 200;
            $jsonObj['message'] = "Từ chối yêu cầu thành công!";
        } else {
            $jsonObj['code'] = 400;
            $jsonObj['message'] = "Từ chôi yêu cầu thất bại!";
        }
        echo json_encode($jsonObj);
    }

    function getProcessors()
    {
        $staffIds = isset($_REQUEST['staffIds']) ? $_REQUEST['staffIds'] : '';
        if ($staffIds != '') {
            $staffIds = explode(",", $staffIds);
            foreach ($staffIds as $item) {
                $jsonObj[] = $this->model->getProcessors($item);
            }

            echo json_encode($jsonObj);
        } else
            echo '';

    }

    function getProperties()
    {
        $defineId = isset($_REQUEST['defineId']) ? $_REQUEST['defineId'] : 0;
        $requestId = isset($_REQUEST['requestId']) ? $_REQUEST['requestId'] : 0;
        $jsonObj = [];
        if ($defineId > 0) {
            $jsonObj = $this->model->getProperties($defineId, $requestId);
        }
        echo json_encode($jsonObj);
    }
}

?>
