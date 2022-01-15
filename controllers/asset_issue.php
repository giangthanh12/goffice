<?php
class asset_issue extends Controller{
    static protected $funcs;
    function __construct(){
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('asset_issue');
        if ($checkMenuRole == false)
        header('location:' . HOME);
        self::$funcs = $model->getFunctions('asset_issue'); 
    }

    function index(){
        $this->view->funs  = self::$funcs;
        require "layouts/header.php";
        $this->view->render("asset_issue/index");
        require "layouts/footer.php";
    }

    function list()
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
        if(functions::checkFuns(self::$funcs,'add')) {
        $data = array(
            'name' => 'CP-'.time(),
            'tai_san' => $_REQUEST['tai_san'],
            'nhan_vien' => $_REQUEST['nhan_vien'],
            'so_luong' => 1,
            'ngay_gio' =>date("Y-m-d",strtotime($_REQUEST['ngay_gio'])),
            'dat_coc' => $_REQUEST['dat_coc'],
            'ghi_chu' => $_REQUEST['ghi_chu'],
            'tinh_trang' => 1
        );
        if($this->model->addObj($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
       
    }
    else {
        $jsonObj['msg'] = 'Không có quyền truy cập';
        $jsonObj['success'] = false;
    }
    echo json_encode($jsonObj);
    }

    function update()
    {
        if(functions::checkFuns(self::$funcs,'loaddata')) {    
      $id = $_REQUEST['id'];
       $data = array(
            'nhan_vien' => $_REQUEST['nhan_vien'],
            'ngay_gio' => date("Y-m-d",strtotime($_REQUEST['ngay_gio'])),
            'dat_coc' => $_REQUEST['dat_coc'],
            'ghi_chu' => $_REQUEST['ghi_chu'],
        );
        if($this->model->updateObj($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
       
    }
    else {
        $jsonObj['msg'] = 'Không có quyền truy cập';
        $jsonObj['success'] = false;
    }
    echo json_encode($jsonObj);
    }

    function del()
    {
        if(functions::checkFuns(self::$funcs,'del')) {
        $id = $_REQUEST['id'];
        $data = ['tinh_trang'=>0];
        if($this->model->delObj($id,$data)){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Thu hồi hết tài sản trước khi xoá";
            $jsonObj['success'] = false;
        } 
    } else {
        $jsonObj['msg'] = 'Không có quyền truy cập';
        $jsonObj['success'] = false;
    }
        echo json_encode($jsonObj);
    }

    function getAsset()
    {
        $json = $this->model->getAsset();
        echo json_encode($json);
    }
    function getAllAsset()
    {
        $json = $this->model->getAllAsset();
        echo json_encode($json);
    }
    function getStaff()
    {
        $json = $this->model->getStaff();
        echo json_encode($json);
    }

    function get_sltonkho()
    {
        $id = $_REQUEST['id'];
        $json = $this->model->get_sltonkho($id);
        echo json_encode($json);
    }
    
    function get_slcp()
    {
        $id = $_REQUEST['id'];
        $json = $this->model->get_slcp($id);
        echo json_encode($json);
    }



    function recoverAsset()
    {
        if(functions::checkFuns(self::$funcs,'loadRecallAsset')) {
        $data = array(
            'cap_phat' => $_REQUEST['id_cp'],
            'tai_san' => $_REQUEST['id_tsth'],
            'so_luong' => 1,
            'ngay_gio' =>date("Y-m-d",strtotime($_REQUEST['ngay_gio_th'])),
            'tra_coc' => $_REQUEST['tra_coc'],
            'ghi_chu' => $_REQUEST['ghi_chu_th'],
            'tinh_trang' => 1
        );
        if($this->model->add_thuhoi($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
    } else
    {
        $jsonObj['msg'] = 'Không có quyền truy cập';
        $jsonObj['success'] = false;
    }
        echo json_encode($jsonObj);
    }
    


}
?>