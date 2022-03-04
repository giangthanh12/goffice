<?php
class ca extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("ca/index");
        require "layouts/footer.php";
    }

    function listdata()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }

    function loaddata()
    {
        $id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function add()
    {
        
        $ca = $_REQUEST['ca'];
        $t2_in = $_REQUEST['t2_in'];
        $t2_out = $_REQUEST['t2_out'];
        $t3_in = $_REQUEST['t3_in'];
        $t3_out = $_REQUEST['t3_out'];
        $t4_in = $_REQUEST['t4_in'];
        $t4_out = $_REQUEST['t4_out'];
        $t5_in = $_REQUEST['t5_in'];
        $t5_out = $_REQUEST['t5_out'];
        $t6_in = $_REQUEST['t6_in'];
        $t6_out = $_REQUEST['t6_out'];
        $t7_in = $_REQUEST['t7_in'];
        $t7_out = $_REQUEST['t7_out'];
        $cn_in = $_REQUEST['cn_in'];
        $cn_out = $_REQUEST['cn_out'];
        $lunStart = $_REQUEST['lunStart'];
        $lunInterval = $_REQUEST['lunInterval'];
        $data = array(
            'shift' => $ca,
            'monIn' => $t2_in,
            'monOut' => $t2_out,
            'tueIn' => $t3_in,
            'tueOut' => $t3_out,
            'wedIn' => $t4_in,
            'wedOut' => $t4_out,
            'thuIn' => $t5_in,
            'thuOut' => $t5_out,
            'friIn' => $t6_in,
            'friOut' => $t6_out,
            'satIn' => $t7_in,
            'satOut' => $t7_out,
            'sunIn' => $cn_in,
            'sunOut' => $cn_out,
            'lunStart'=>$lunStart,
            'lunInterval'=>$lunInterval,
            'status' => 1
        );
        if($this->model->addObj($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $ca = $_REQUEST['ca'];
        $t2_in = $_REQUEST['t2_in'];
        $t2_out = $_REQUEST['t2_out'];
        $t3_in = $_REQUEST['t3_in'];
        $t3_out = $_REQUEST['t3_out'];
        $t4_in = $_REQUEST['t4_in'];
        $t4_out = $_REQUEST['t4_out'];
        $t5_in = $_REQUEST['t5_in'];
        $t5_out = $_REQUEST['t5_out'];
        $t6_in = $_REQUEST['t6_in'];
        $t6_out = $_REQUEST['t6_out'];
        $t7_in = $_REQUEST['t7_in'];
        $t7_out = $_REQUEST['t7_out'];
        $cn_in = $_REQUEST['cn_in'];
        $cn_out = $_REQUEST['cn_out'];
        $lunStart = $_REQUEST['lunStart'];
        $lunInterval = $_REQUEST['lunInterval'];
        $data = array(
            'shift' => $ca,
            'monIn' => $t2_in,
            'monOut' => $t2_out,
            'tueIn' => $t3_in,
            'tueOut' => $t3_out,
            'wedIn' => $t4_in,
            'wedOut' => $t4_out,
            'thuIn' => $t5_in,
            'thuOut' => $t5_out,
            'friIn' => $t6_in,
            'friOut' => $t6_out,
            'satIn' => $t7_in,
            'satOut' => $t7_out,
            'sunIn' => $cn_in,
            'sunOut' => $cn_out,
            'lunStart'=>$lunStart,
            'lunInterval'=>$lunInterval
        );
        if($this->model->updateObj($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function del()
    {
        $id = $_REQUEST['id'];
        $data = ['status'=>0];
        if($this->model->delObj($id,$data)){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        } 
        echo json_encode($jsonObj);
    }
}
?>