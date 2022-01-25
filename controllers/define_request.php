<?php

class define_request extends Controller
{
    static private $funcs;
    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('define_request');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        self::$funcs = $model->getFunctions('define_request');
    }

    function index()
    {
        $this->view->funs  = self::$funcs;
        require "layouts/header.php";
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

        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $object = isset($_REQUEST['object']) ? $_REQUEST['object'] : '';
        $data = array(
            'name' => $name,
            'status' => 1
        );
        $this->model->addObj($data);
        $lastId = $this->model->getLastId();

        //object
        if (isset($_REQUEST['object']) && !empty($object)) {
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

    function update()
    {
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
                    $processor='';
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
                        $processor='';
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
    








        // if ($name != '') {
        //     $listId = '';
        //     for ($j = 0; $j < count($id); $j++) {
        //         $stepId = $id[$j];
        //         $listId .= $stepId . ",";
        //     }
        //     $listId = rtrim($listId, ",");

        //     if ($this->model->delsteps($listId, $defineId)) {
        //         for ($i = 0; $i < count($name); $i++) {
        //             $stepId = $id[$i];
        //             $ok = $this->model->checkStep($defineId, $stepId);
        //             $listProcessors = '';
        //             $processors = $processor[$i];
        //             var_dump($processors);
        //             for ($k = 0; $k < count($processors); $k++) {
        //                 $listProcessors .= $processors[$k] . ",";
        //             }
        //             $listProcessors = rtrim($listProcessors, ",");
        //             if ($ok == 1) {
        //                 $data = array(
        //                     'name' => $name[$i],
        //                     'sortorder' => $sortorder[$i],
        //                     'reviewerId' => $reviewer[$i],
        //                     'processors' => $listProcessors
        //                 );
        //                 if ($this->model->updatestep($stepId, $data)) {
        //                     $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
        //                     $jsonObj['success'] = true;
        //                 } else {
        //                     $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
        //                     $jsonObj['success'] = false;
        //                     echo json_encode($jsonObj);
        //                     return false;
        //                 }
        //             } else {
        //                 $data = array(
        //                     'name' => $name[$i],
        //                     'defineId' => $defineId,
        //                     'sortorder' => $sortorder[$i],
        //                     'reviewerId' => $reviewer[$i],
        //                     'processors' => $listProcessors,
        //                     'status' => 1
        //                 );
        //                 if ($this->model->addstep($data)) {
        //                     $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
        //                     $jsonObj['success'] = true;
        //                 } else {
        //                     $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
        //                     $jsonObj['success'] = false;
        //                     echo json_encode($jsonObj);
        //                     return false;
        //                 }
        //             }
        //         }
        //     } else {
        //         $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
        //         $jsonObj['success'] = false;
        //     }
        // } else {
        //     if ($this->model->delAllSteps($defineId)) {
        //         $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
        //         $jsonObj['success'] = true;
        //     } else {
        //         $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
        //         $jsonObj['success'] = false;
        //     }
        // }

        // echo json_encode($jsonObj);
    }

    // function addstep(){
    //     $idprocess = isset($_REQUEST['iddefine']) ? $_REQUEST['iddefine'] : '';
    //     $name = isset($_REQUEST['ten_buoc']) ? $_REQUEST['ten_buoc'] : '';
    //     $sortorder = isset($_REQUEST['thu_tu']) ? $_REQUEST['thu_tu'] : '';
    //     $reviewer = isset($_REQUEST['tham_chieu']) ? $_REQUEST['tham_chieu'] : '';
    //     $processor = isset($_REQUEST['xu_ly']) ? $_REQUEST['xu_ly'] : '';

    //     $data = array(
    //         'defineId' => $idprocess,
    //         'name' => $name,
    //         'sortorder' => $sortorder,
    //         'reviewerId' => $reviewer,
    //         'processors' => $processor,
    //         'status' => 1
    //     );

    //     if($this->model->addstep($data)){
    //         $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
    //         $jsonObj['success'] = false;
    //     }

    //     echo json_encode($jsonObj);
    // }

    function del()
    {
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
