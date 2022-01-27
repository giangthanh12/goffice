<?php
class baocaodoanhthu extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->doanhso = $this->model->totalDoanhso();
        $this->view->thucthu = $this->model->totalThucthu();
        $this->view->thucchi = $this->model->totalThucchi();
        $this->view->render("baocaodoanhthu/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }

    // function combo(){
    //     $json = $this->model->get_data_combo();
    //     $this->view->jsonObj = json_encode($json);
    //     $this->view->render("khachhang/combo");
    // }

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
        $data = array(
            'ca' => $ca,
            't2_in' => $t2_in,
            't2_out' => $t2_out,
            't3_in' => $t3_in,
            't3_out' => $t3_out,
            't4_in' => $t4_in,
            't4_out' => $t4_out,
            't5_in' => $t5_in,
            't5_out' => $t5_out,
            't6_in' => $t6_in,
            't6_out' => $t6_out,
            't7_in' => $t7_in,
            't7_out' => $t7_out,
            'cn_in' => $cn_in,
            'cn_out' => $cn_out,
            'tinh_trang' => 1
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

        $data = array(
            'ca' => $ca,
            't2_in' => $t2_in,
            't2_out' => $t2_out,
            't3_in' => $t3_in,
            't3_out' => $t3_out,
            't4_in' => $t4_in,
            't4_out' => $t4_out,
            't5_in' => $t5_in,
            't5_out' => $t5_out,
            't6_in' => $t6_in,
            't6_out' => $t6_out,
            't7_in' => $t7_in,
            't7_out' => $t7_out,
            'cn_in' => $cn_in,
            'cn_out' => $cn_out,
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
        $data = ['tinh_trang'=>0];
        if($this->model->delObj($id,$data)){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        } 
        echo json_encode($jsonObj);
    }


    function doanhso_namnay(){
        $year = isset($_REQUEST['year'])?$_REQUEST['year']:date('Y');
        $json['socai'] = $this->model->socai_namnay();
        $json['donhang'] = $this->model->donhang_namnay();
        $json['data_bd'] = $this->model->getbieudo($year);
        echo json_encode($json);
    }

    function loc(){
        $time_s = $_REQUEST['time_s'];
        $time_e = $_REQUEST['time_e'];
        $json['socai'] = $this->model->socai_loc($time_s,$time_e);
        // $json['donhang'] = $this->model->donhang_loc($time_s,$time_e);
      
        
        echo json_encode($json);
    }
    function loc_socai(){
        $time_s = $_REQUEST['time_s'];
        $time_e = $_REQUEST['time_e'];
        $json= $this->model->listLoc($time_s,$time_e);
        echo json_encode($json);
    }


}
?>