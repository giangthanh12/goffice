<?php

class request extends Controller
{
    static private $funAdd=0,$funEdit=0,$funApprove=0,$funRefuse=0,$funDel=0;
    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('request');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('request');
        foreach ($funcs as $item) {
            if ($item['function'] == 'add')
                self::$funAdd = 1;
            if ($item['function'] == 'edit')
                self::$funEdit = 1;
            if ($item['function'] == 'del')
                self::$funDel = 1;
            if ($item['function'] == 'approve')
                self::$funApprove = 1;
            if ($item['function'] == 'refuse')
                self::$funRefuse = 1;
        }

    }

    function index()
    {
        require "layouts/header.php";
        $this->view->departments = $this->model->getDepartments();
        $this->view->staffs = $this->model->getStaffs();
        $this->view->requestDefines = $this->model->getRequestDefines();
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $this->view->funDel = self::$funDel;
        $this->view->funApprove = self::$funApprove;
        $this->view->funRefuse = self::$funRefuse;
        $this->view->render("request/index");
        require "layouts/footer.php";
    }

    function kanbanview()
    {
        require "layouts/header.php";
        $this->view->departments = $this->model->getDepartments();
        $this->view->staffs = $this->model->getStaffs();
        $this->view->requests = $this->model->getRequestDefines();
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $this->view->funDel = self::$funDel;
        $this->view->funApprove = self::$funApprove;
        $this->view->funRefuse = self::$funRefuse;
        $this->view->render("request/kanban");
        require "layouts/footer.php";
    }

    function getListRequests(){
        $defineId = isset($_REQUEST['defineId']) ? $_REQUEST['defineId'] : 0;
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : 0;
        $staffId = $_SESSION['user']['staffId'];
        $jsonObj = $this->model->getALlRequestLists($defineId,$status,$staffId);
        echo json_encode($jsonObj);
    }

    function getDetailRequest() {
        $requestId = $_GET['requestId'];
        $detailRequest = $this->model->getDetailRequest($requestId);
        if(count($detailRequest) < 0) {
            $jsonObj['code'] = 401;
            $jsonObj['message'] = "Kh??ng l???y ???????c d??? li???u";
            echo json_encode($jsonObj);
            return false;
        }
        $jsonObj['code'] = 200;
        $jsonObj['message'] = "T???o y??u c???u th??nh c??ng!";
        $jsonObj['data'] = $detailRequest;
        echo json_encode($jsonObj);
    }

    function getAllRequests()
    {
        $defineId = isset($_REQUEST['defineId']) ? $_REQUEST['defineId'] : 0;
        $process = $this->model->getAllStep($defineId);
        foreach ($process as $key => $item) {
            $jsonObj[]['id'] = 'step-' . $item['id'];
            $jsonObj[$key]['title'] = $item['name'];
            $tempItems = $this->model->getALlRequestSteps($item['id'],$defineId);
            $jsonObj[$key]['item'] = [];
            foreach ($tempItems as $itemStep) {
                $temp["stepId"] = $item['id'];
                $temp["stepName"] = $item['name'];
                $temp["id"] = $itemStep['id'];
                $temp["note"] = $itemStep['title'];
                $temp["badge-title"] = $itemStep['departmentName'];
                $temp["badge"] = '';
                $temp["dateTime"] = $itemStep['dateTime'];
                $temp["staffId"] = $itemStep['staffId'];
                $temp["staffAvatar"] = $itemStep['staffAvatar'];
                $temp["staffName"] = $itemStep['staffName'];
                $temp["processors"] = $itemStep['processors'];
                $temp["refusers"] = $itemStep['refusers'];
                $temp["process"] = $item['processors'];
                $temp["departmentId"] = $itemStep['departmentId'];
                $temp["status"] = $itemStep['stepStatus'];
                array_push($jsonObj[$key]['item'], $temp);
            }
        }
        $processKey = count($process);
        $jsonObj[$processKey + 1]['id'] = 'success';
        $jsonObj[$processKey + 1]['title'] = 'Ho??n th??nh';
        $tempItems = $this->model->getALlRequests($defineId, 2);
        $jsonObj[$processKey + 1]['item'] = [];
        foreach ($tempItems as $item) {
            $temp["stepId"] = 'success';
            $temp["stepName"] = 'Ho??n th??nh';
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
            $temp["process"] = '';
            $temp["refusers"] = '';
            $temp["departmentId"] = $item['departmentId'];
            $temp["status"] = 2;
            array_push($jsonObj[$processKey + 1]['item'], $temp);
        }

//        $jsonObj[$processKey + 2]['id'] = 'refuse';
//        $jsonObj[$processKey + 2]['title'] = 'T??? ch???i';
//        $tempItems = $this->model->getALlRequests($defineId, 3);
//        $jsonObj[$processKey + 2]['item'] = [];
//        foreach ($tempItems as $item) {
//            $temp["stepId"] = 'refuse';
//            $temp["id"] = $item['id'];
//            $temp["stepName"] = 'T??? ch???i';
//            $temp["note"] = $item['title'];
//            $temp["badge-title"] = $item['departmentName'];
//            $temp["badge"] = '';
//            $temp["dateTime"] = $item['dateTime'];
//            $temp["staffId"] = $item['staffId'];
//            $temp["staffAvatar"] = $item['staffAvatar'];
//            $temp["staffAvatar"] = $item['staffAvatar'];
//            $temp["staffName"] = $item['staffName'];
//            $temp["processors"] = $item['processors'];
//            $temp["refusers"] = $item['refusers'];
//            $temp["departmentId"] = $item['departmentId'];
//            $temp["status"] = 3;
//            array_push($jsonObj[$processKey + 2]['item'], $temp);
//        }
        $jsonObjNew = [];
        foreach ($jsonObj as $item) {
            $jsonObjNew[] = $item;
        }
        echo json_encode($jsonObjNew);
    }

    function getComments(){
        $requestId = $_REQUEST['requestId'];
        $jsonObj = $this->model->getRequestProcess($requestId);
        echo json_encode($jsonObj);
    }


    function addRequest()
    {
        if(self::$funAdd!=1)
            return false;
        $defineId = !empty($_REQUEST['defineId']) ? $_REQUEST['defineId'] : 0;
        // check xem c?? ?????i t?????ng trong y??u c???u
        

        $process = $this->model->getAllStep($defineId);
        $data['defineId'] = $defineId;
        $jsonObj = [];
        // kh??ng c?? b?????c th???c hi???n y??u c???u tr??? v??? l???i
        if (count($process) == 0) {
            
            $jsonObj['code'] = 401;
            $jsonObj['message'] = "Y??u c???u hi???n t???i ch??a c?? ti???n tr??nh x??? l??!";
            echo json_encode($jsonObj);
            return false;
        }
     
        //check l???i validate form
        $title = $_REQUEST['title'];
        if ($title == '') {
            $jsonObj['code'] = 402;
            $jsonObj['message'] = "B???n ch??a nh???p ti??u ?????!";
            echo json_encode($jsonObj);
            return false;
        }
        $data['title'] = $title;
        $dateTime = $_REQUEST['dateTime'];
        if ($dateTime == '') {
            $jsonObj['code'] = 402;
            $jsonObj['message'] = "B???n ch??a nh???p ng??y t???o!";
            echo json_encode($jsonObj);
            return false;
        }
        // $dateTime
        $dateTime = functions::convertDate($dateTime);
        $data['dateTime'] = $dateTime;
        $data['departmentId'] = $_REQUEST['department'];
        $staffId = $_REQUEST['staffId'];
        if ($staffId <= 0) {
            $jsonObj['code'] = 402;
            $jsonObj['message'] = "B???n ch??a ch???n nh??n vi??n!";
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
            $jsonObj['message'] = "T???o y??u c???u th??nh c??ng!";
            $jsonObj['data']['requestId'] = $requestId;
        } else {
            $jsonObj['code'] = 400;
            $jsonObj['message'] = "T???o y??u c???u th???t b???i!";
        }
        
        if($this->model->countObject($defineId)) {
            $jsonObj['countObject'] = true;
        }else{
            $jsonObj['countObject'] = false;
        }
        echo json_encode($jsonObj);
    }

    function editRequest()
    {
        if(self::$funEdit!=1)
            return false;
        $jsonObj = [];
        $data = [];
        $requestId = $_REQUEST['id'];
        $checkCreator = $this->model->checkRequestCreator($requestId);
        if ($checkCreator <= 0) {
            $jsonObj['code'] = 401;
            $jsonObj['message'] = "B???n kh??ng th??? s???a y??u c???u c???a ng?????i kh??c!";
            echo json_encode($jsonObj);
            return false;
        }
        $title = $_REQUEST['title'];
        if ($title == '') {
            $jsonObj['code'] = 402;
            $jsonObj['message'] = "B???n ch??a nh???p ti??u ?????!";
            echo json_encode($jsonObj);
            return false;
        }
        $data['title'] = $title;
        $dateTime = $_REQUEST['dateTime'];
        if ($dateTime == '') {
            $jsonObj['code'] = 402;
            $jsonObj['message'] = "B???n ch??a nh???p ng??y t???o!";
            echo json_encode($jsonObj);
            return false;
        }
        $dateTime = functions::convertDate($dateTime);
        $data['dateTime'] = $dateTime;
        $data['departmentId'] = $_REQUEST['department'];
        $staffId = $_REQUEST['staffId'];
        if ($staffId <= 0) {
            $jsonObj['code'] = 402;
            $jsonObj['message'] = "B???n ch??a ch???n nh??n vi??n!";
            echo json_encode($jsonObj);
            return false;
        }
        $data['staffId'] = $staffId;
        $data['status'] = 1;
        $ok = $this->model->updateRequest($requestId, $data);
        if ($ok) {
            $jsonObj['code'] = 200;
            $jsonObj['message'] = "C???p nh???t y??u c???u th??nh c??ng! ";
            $jsonObj['data']['requestId'] = $requestId;
        } else {
            $jsonObj['code'] = 400;
            $jsonObj['message'] = "C???p nh???t y??u c???u th???t b???i!";
        }
        echo json_encode($jsonObj);
    }

    function saveProperties()
    {
        if(self::$funAdd!=1 || self::$funEdit!=1)
            return false;
        $defineId = isset($_REQUEST['defineId']) ? $_REQUEST['defineId'] : 0;
        if ($defineId <= 0)
            return false;
        $requestId = isset($_REQUEST['requestId']) ? $_REQUEST['requestId'] : 0;
        $properties = $this->model->getProperties($defineId, $requestId);
        $checkAdd = 0;
        $data = [];
        foreach ($properties as $item) {
            $propertyValue = isset($_REQUEST['property_' . $item['id']]) ? $_REQUEST['property_' . $item['id']] : '';
            // if($propertyValue != ''){
                $dataPro['requestId'] = $requestId;
                $dataPro['objectId'] = $item['id'];
                $dataPro['value'] = $propertyValue;
            // }else{
            //     $dataPro['requestId'] = $requestId;
            //     $dataPro['objectId'] = '';
            //     $dataPro['value'] = $propertyValue;
            // }
           
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
            $jsonObj['message'] = "T???o thu???c t??nh th??nh c??ng!" . json_encode($data);
        } else {
            $jsonObj['code'] = 400;
            $jsonObj['message'] = "T???o thu???c t??nh th???t b???i!";
        }
        echo json_encode($jsonObj);
    }

    function approve()
    {

        if(self::$funApprove!=1)
            return false;
        $requestId = isset($_REQUEST['requestId']) ? $_REQUEST['requestId'] : 0;
        if ($requestId <= 0)
            return false;
        $stepId = isset($_REQUEST['stepId']) ? $_REQUEST['stepId'] : 0;
        if ($stepId <= 0)
            return false;
        // kiem tra quyen duoc duyet
        $checkProcess = $this->model->checkProcessorStep($stepId);
        if ($checkProcess <= 0) {
            $jsonObj['code'] = 401;
            $jsonObj['message'] = "B???n kh??ng c?? quy???n duy???t y??u c???u n??y!";
            echo json_encode($jsonObj);
            return false;
        }

        $defineId = isset($_REQUEST['defineId']) ? $_REQUEST['defineId'] : 0;
        $staffId = $_SESSION['user']['staffId'];
        $note = $_REQUEST['note'];
        $dataProcess = ['status' => 2, 'staffId' => $staffId,'note'=>$note];
        // status = 2 duy???t step
        $this->model->updateProcess($requestId, $stepId, 1, $dataProcess);


        $nextStepId = $this->model->getStep($defineId, $requestId);
        if ($nextStepId > 0) {
            $dataProcessNew = ['requestId' => $requestId, 'stepId' => $nextStepId, 'staffId' => 0, 'status' => 1];
            $checkApprove = $this->model->addStep($dataProcessNew);
        } else {
            //n??u h???t b?????c s??? chuy???n sang tr???ng th??i ho??n th??nh status = 2
            $dataRequest = ['status' => 2];
            $checkApprove = $this->model->updateRequest($requestId, $dataRequest);
        }
        if ($checkApprove) {
            $jsonObj['code'] = 200;
            $jsonObj['message'] = "Duy???t y??u c???u th??nh c??ng!";
        } else {
            $jsonObj['code'] = 400;
            $jsonObj['message'] = "Duy???t y??u c???u th???t b???i!";
        }
        echo json_encode($jsonObj);
    }

    function refuse()
    {
        if(self::$funRefuse!=1)
            return false;
        $requestId = isset($_REQUEST['requestId']) ? $_REQUEST['requestId'] : 0;
        if ($requestId <= 0)
            return false;
        $stepId = isset($_REQUEST['stepId']) ? $_REQUEST['stepId'] : 0;
        if ($stepId <= 0)
            return false;
        $checkProcess = $this->model->checkProcessorStep($stepId);
        if ($checkProcess <= 0) {
            $jsonObj['code'] = 401;
            $jsonObj['message'] = "B???n kh??ng c?? quy???n t??? ch???i y??u c???u n??y!";
            echo json_encode($jsonObj);
            return false;
        }
        $staffId = $_SESSION['user']['staffId'];
        $note = $_REQUEST['note'];
        $dataProcess = ['status' => 3, 'staffId' => $staffId,'note'=>$note];
        $this->model->updateProcess($requestId, $stepId, 1, $dataProcess);
        $dataRequest = ['status' => 3];
        $checkDenny = $this->model->updateRequest($requestId, $dataRequest);
        if ($checkDenny) {
            $jsonObj['code'] = 200;
            $jsonObj['message'] = "T??? ch???i y??u c???u th??nh c??ng!";
        } else {
            $jsonObj['code'] = 400;
            $jsonObj['message'] = "T??? ch??i y??u c???u th???t b???i!";
        }
        echo json_encode($jsonObj);
    }

    function del(){
        if(self::$funDel!=1)
            return false;
        $requestId = isset($_REQUEST['requestId']) ? $_REQUEST['requestId'] : 0;
        if ($requestId <= 0)
            return false;
        $checkCreator = $this->model->checkRequestCreator($requestId);
        if ($checkCreator <= 0) {
            $jsonObj['code'] = 401;
            $jsonObj['message'] = "B???n kh??ng th??? x??a y??u c???u c???a ng?????i kh??c!";
            echo json_encode($jsonObj);
            return false;
        }
        $dataRequest = ['status' => 0];
        $checkDel = $this->model->updateRequest($requestId, $dataRequest);
        if ($checkDel) {
            $jsonObj['code'] = 200;
            $jsonObj['message'] = "X??a y??u c???u th??nh c??ng!";
        } else {
            $jsonObj['code'] = 400;
            $jsonObj['message'] = "X??a y??u c???u th???t b???i!";
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
