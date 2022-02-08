<?php

class define_request extends Controller
{
    static private $funAdd = 0, $funEdit = 0, $funDel = 0;
    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('define_request');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('define_request');

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
        $this->view->render("define_request/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }



    function loadstep()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getstep($id);
        echo json_encode($json);
    }

    function loaddata()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function add()
    {
        if (self::$funAdd == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }

        $name = isset($_REQUEST['name1']) ? $_REQUEST['name1'] : '';
        $object = isset($_REQUEST['object1']) ? $_REQUEST['object1'] : '';
        // $sortorder = isset($_REQUEST['thu_tu']) ? $_REQUEST['thu_tu'] : '';
        // $reviewer = isset($_REQUEST['tham_chieu']) ? $_REQUEST['tham_chieu'] : '';
        // $processor = isset($_REQUEST['xu_ly']) ? $_REQUEST['xu_ly'] : [];

        $data = array(
            'name' => $name,
            'status' => 1
        );
        $this->model->addObj($data);
        $lastId = $this->model->getLastId();

        //object
        if (isset($_REQUEST['object1']) && !empty($object)) {
            try {
                foreach ($object as $item) {
                    $dataObject = [
                        'name' => $item,
                        'defineId' => $lastId,
                        'status' => 1
                    ];
                    $this->model->addObject($dataObject);
                }
                $jsonObj['msg'] = 'Cập nhật thành công';
                $jsonObj['success'] = true;
            } catch (\Throwable $th) {
                $jsonObj['msg'] = 'Cập nhật không thành công';
                $jsonObj['success'] = false;
            }
        } else {
            $jsonObj['msg'] = 'Cập nhật không thành công';
            $jsonObj['success'] = false;
        }

        echo json_encode($jsonObj);
    }
    function addstep()
    {
        $lastId = $this->model->getLastId();
        $ndata = [];
        $arrStep = isset($_REQUEST['stepArr']) ? $_REQUEST['stepArr'] : '';
        if ($arrStep != '') {
            $arrStep = json_decode($arrStep);
            for ($n = 0; $n < count($arrStep); $n++) {
                $namestep = isset($_REQUEST['n_ten_buoc' . $arrStep[$n]]) ? $_REQUEST['n_ten_buoc' . $arrStep[$n]] : '';
                $sortorder = $_REQUEST['n_thu_tu' . $arrStep[$n]];
                $reviewer = isset($_REQUEST['n_tham_chieu' . $arrStep[$n]]) ? $_REQUEST['n_tham_chieu' . $arrStep[$n]] : '';
                $ntemp = isset($_REQUEST['n_xu_ly' . $arrStep[$n]]) ? $_REQUEST['n_xu_ly' . $arrStep[$n]] : [];
                if (count($ntemp) > 0)
                    $processor = implode(",", $ntemp);
                else
                    $processor = '';
                $ndata['name'] = $namestep;
                $ndata['defineId'] = $lastId;
                $ndata['sortorder'] = $sortorder;
                $ndata['reviewerId'] = $reviewer;
                $ndata['processors'] = $processor;
                $ndata['status'] = 1;
                if ($this->model->addstep($ndata)) {
                    $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                    $jsonObj['success'] = true;
                } else {
                    $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                    $jsonObj['success'] = false;
                }
            }
        }

        echo json_encode($jsonObj);
    }

    function update()
    {
        if (self::$funAdd == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['id'];
        $idobj = $_REQUEST['Oid'];
        $name = isset($_REQUEST['name1']) ? $_REQUEST['name1'] : '';
        $object = isset($_REQUEST['object1']) ? $_REQUEST['object1'] : '';


        $listId = '';
        for ($j = 0; $j < count($object); $j++) {
            $listId .= $idobj[$j] . ",";
        }
        $listId = rtrim($listId, ",");

        if ($this->model->delObjects($listId, $id)) {
            $dataDefine = array(
                'name' => $name,
            );
            $this->model->updateObj($id, $dataDefine);
            for ($i = 0; $i < count($object); $i++) {
                $ObjId = $idobj[$i];
                $ok = $this->model->checkObject($id, $ObjId);
                if ($ok == 1) {
                    $dataObject = array(
                        'name' => $object[$i],
                    );
                    if ($this->model->updateObject($ObjId, $dataObject)) {
                        $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                        $jsonObj['success'] = true;
                    } else {
                        $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                        $jsonObj['success'] = false;
                    }
                } else {
                    $dataObject = array(
                        'name' => $object[$i],
                        'status' => 1,
                        'defineId' => $id
                    );
                    if ($this->model->addObject($dataObject)) {
                        $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                        $jsonObj['success'] = true;
                    } else {
                        $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                        $jsonObj['success'] = false;
                    }
                }
            }
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }



        echo json_encode($jsonObj);
    }

    function updatestep()
    {
        if (self::$funAdd == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = isset($_REQUEST['stid']) ? $_REQUEST['stid'] : '';
        $defineId = isset($_REQUEST['defineId']) ? $_REQUEST['defineId'] : '';
        $listStepId = $stepIds = isset($_REQUEST['stepIds']) ? $_REQUEST['stepIds'] : '';

        $data = [];
        $ndata = [];
        $jsonObj['msg'] = 'Bạn chưa thêm bước thực hiện!';
        $jsonObj['success'] = true;
        if ($stepIds != '') {

            $stepIds = explode(",", $stepIds);

            for ($i = 0; $i < count($stepIds); $i++) {

                $name = isset($_REQUEST['ten_buoc' . $stepIds[$i]]) ? $_REQUEST['ten_buoc' . $stepIds[$i]] : '';
                $sortorder = isset($_REQUEST['thu_tu' . $stepIds[$i]]) ? $_REQUEST['thu_tu' . $stepIds[$i]] : '';
                $reviewer = isset($_REQUEST['tham_chieu' . $stepIds[$i]]) ? $_REQUEST['tham_chieu' . $stepIds[$i]] : '';
                $temp = isset($_REQUEST['xu_ly' . $stepIds[$i]]) ? $_REQUEST['xu_ly' . $stepIds[$i]] : [];
                if (count($temp) > 0)
                    $processor = implode(",", $temp);
                else
                    $processor = '';
                $data['name'] = $name;
                $data['sortorder'] = $sortorder;
                $data['reviewerId'] = $reviewer;
                $data['processors'] = $processor;
                if ($this->model->updatestep($stepIds[$i], $data)) {
                    $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                    $jsonObj['success'] = true;
                } else {
                    $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                    $jsonObj['success'] = false;
                    echo json_encode($jsonObj);
                    return false;
                }
            }
            if ($this->model->delsteps($listStepId, $defineId)) {
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                $jsonObj['success'] = false;
                echo json_encode($jsonObj);
                return false;
            }
        }
        $arrStep = isset($_REQUEST['stepArr']) ? $_REQUEST['stepArr'] : '';
        if ($arrStep != '') {
            $arrStep = json_decode($arrStep);
            for ($j = 0; $j < count($arrStep); $j++) {
                $name = isset($_REQUEST['n_ten_buoc' . $arrStep[$j]]) ? $_REQUEST['n_ten_buoc' . $arrStep[$j]] : '';
                $sortorder = $_REQUEST['n_thu_tu' . $arrStep[$j]];
                $reviewer = isset($_REQUEST['n_tham_chieu' . $arrStep[$j]]) ? $_REQUEST['n_tham_chieu' . $arrStep[$j]] : '';
                $ntemp = isset($_REQUEST['n_xu_ly' . $arrStep[$j]]) ? $_REQUEST['n_xu_ly' . $arrStep[$j]] : [];
                if (count($ntemp) > 0)
                    $processor = implode(",", $ntemp);
                else
                    $processor = '';
                $ndata['name'] = $name;
                $ndata['defineId'] = $defineId;
                $ndata['sortorder'] = $sortorder;
                $ndata['reviewerId'] = $reviewer;
                $ndata['processors'] = $processor;
                $ndata['status'] = 1;
                if ($this->model->addstep($ndata)) {
                    $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                    $jsonObj['success'] = true;
                } else {
                    $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                    $jsonObj['success'] = false;
                    echo json_encode($jsonObj);
                    return false;
                }
            }
        }

        echo json_encode($jsonObj);
    }

    function del()
    {
        if (self::$funAdd == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['id'];
        $data = ['status' => 0];
        if ($this->model->delObj($id, $data)) {
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        }

        echo json_encode($jsonObj);
    }

    function delstep()
    {
        if (self::$funAdd == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['id'];
        $data = ['status' => 0];
        if ($this->model->delstep($id, $data)) {
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
}
