<?php
class asset extends Controller{
    static private $funAdd = 0, $funEdit = 0, $funDel = 0, $funRecall = 0, $funIssue = 0;
    function __construct(){
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('asset');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('asset');
      
        foreach ($funcs as $item) {
            if ($item['function'] == 'add')
                self::$funAdd = 1;
            if ($item['function'] == 'loadIssue')
            self::$funIssue = 1;
            if ($item['function'] == 'loadRecall')
            self::$funRecall = 1;
            if ($item['function'] == 'edit')
                self::$funEdit = 1;
            if ($item['function'] == 'del')
                self::$funDel = 1;
        }
    }

    function index(){
     
        require "layouts/header.php";
        $this->view->funAdd = self::$funAdd;
        $this->view->funIssue = self::$funIssue;
        $this->view->funRecall = self::$funRecall;
        $this->view->funEdit = self::$funEdit;
        $this->view->funDel = self::$funDel;
        $this->view->render("asset/index");
        require "layouts/footer.php";
    }

    function listdata()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }
    // load hisIssue
    function loadListHisIssue() {
        $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $data = $this->model->loadListHisIssue($id);
        echo json_encode($data);
    }
    function loadListHisRecall() {
        $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $data = $this->model->loadListHisRecall($id);
        echo json_encode($data);
    }
    function loaddata()
    {
        $id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function add(){
        if(self::$funAdd == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $data = array(
            'name' => $_REQUEST['name'],
            'code' => $_REQUEST['code'],
            'so_luong' => 1,
            'sl_tonkho' => 1,
            'don_vi' => $_REQUEST['don_vi'],
            'nhom_ts' => $_REQUEST['nhom_ts'],
            'so_tien' => $_REQUEST['so_tien'],
            'khau_hao' => $_REQUEST['khau_hao'],
            'bao_hanh' => $_REQUEST['bao_hanh'],
            'ngay_gio' => date("Y-m-d",strtotime($_REQUEST['ngay_gio'])),
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
        if(self::$funEdit == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['id'];
        $data = array(
            'name' => $_REQUEST['name_add'],
            'code' => $_REQUEST['code_add'],
            'don_vi' => $_REQUEST['don_vi_add'],
            'nhom_ts' => $_REQUEST['nhom_ts_add'],
            'so_tien' => $_REQUEST['so_tien_add'],
            'ngay_gio' =>date("Y-m-d",strtotime($_REQUEST['ngay_gio_add'])),
            'khau_hao' => $_REQUEST['khau_hao_add'],
            'bao_hanh' => $_REQUEST['bao_hanh_add']
        );
        $data_info = array(
            'nha_cungcap' => $_REQUEST['nha_cungcap'],
            'dia_chi' => $_REQUEST['dia_chi'],
            'sdt' => $_REQUEST['sdt'],
            'ghi_chu' => $_REQUEST['ghi_chu'],
        );
        
        $this->model->updateObj_info($id, $data_info);
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
        if(self::$funDel == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['id'];
        $data = ['tinh_trang'=>0];
        if($this->model->delObj($id,$data)){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Không thể xoá tài sản đang được cấp phát";
            $jsonObj['success'] = false;
        } 
   
        echo json_encode($jsonObj);
    }

    function nhomtaisan()
    {
        $json = $this->model->getnhomts();
        echo json_encode($json);
    }
    function don_vi()
    {
        $json = $this->model->don_vi();
        echo json_encode($json);
    }

    function changeImage()
    {
        $id = $_REQUEST['id_taisan'];
        $filename = $_FILES['hinhanh']['name'];
    
        $hinhanh = '';
        if ($filename!='') {
            $dir = ROOT_DIR . '/uploads/taisan/';
            $file = functions::uploadfile('hinhanh', $dir, $id);
            if ($file!='')
                $hinhanh = URLFILE.'/uploads/taisan/'.$file;
        }
      
        if ($this->model->changeImage($hinhanh,$id)) {
            $jsonObj['filename'] = $hinhanh;
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công".$file;
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database $id";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }



    function alertBroken()
    {
        $id = $_REQUEST['id_baohong'];
       
        $data = array(
            'tinh_trang'=>$_REQUEST['status']
        );
        if($this->model->alertBroken($id,$data)){
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Không thể xoá tài sản đang được cấp phát";
            $jsonObj['success'] = false;
        } 
        echo json_encode($jsonObj);
    }
    function getStaff()
    {
        $json = $this->model->getStaff();
        echo json_encode($json);
    }
    function getAsset()
    {
        $json = $this->model->getAsset();
        echo json_encode($json);
    }
    function saveIssue() {
        if(self::$funIssue == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $data = array(
            'name'=>'CP-'.time(),
            'tai_san' => $_REQUEST['idAsset'],
            'nhan_vien' => $_REQUEST['nhan_vien'],
            'so_luong' => 1,
            'ngay_gio' =>date("Y-m-d",strtotime($_REQUEST['dateIssue'])),
            'dat_coc' => $_REQUEST['dat_coc'],
            'ghi_chu' => $_REQUEST['descIssue'],
            'tinh_trang' => 1
        );
       
        if($this->model->addIssue($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
   
        echo json_encode($jsonObj);
    }

    function saveRecall() {
        if(self::$funRecall == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $data = array(
            'cap_phat' => $_REQUEST['id_cp'],
            'tai_san' => $_REQUEST['id_ts'],
            'so_luong' => 1,
            'ngay_gio' =>date("Y-m-d",strtotime($_REQUEST['ngay_gio_th'])),
            'tra_coc' => $_REQUEST['tra_coc_th'],
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
 
        echo json_encode($jsonObj);
    }
    function getAssetIssue() {
        $id=isset($_REQUEST['id'])?$_REQUEST['id']:0;

        $json = $this->model->getAssetIssue($id);
        echo json_encode($json);
    }
}
?>