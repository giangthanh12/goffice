<?php
class Data extends Controller{
    function __construct()
    {
        parent:: __construct();
    }

    function list()
    {
      
        $keyword = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        // Order
        // $keyword = isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '';

        $offset = isset($_REQUEST['start']) ?$_REQUEST['start']: 0;
        $rows = isset($_REQUEST['length']) ?$_REQUEST['length']: 10;
        $result = $this->model->listObj($keyword, $offset, $rows);
        $totalData = $result['total'];
        $data['data'] = $result['data'];
        $data['draw'] = intval(isset($_REQUEST['draw']) ?$_REQUEST['draw']: 1);
        $data['recordsTotal'] = $totalData;
        $data['recordsFiltered'] = $totalData;
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
        $data = $_REQUEST['data'];
        $data['nguoi_nhap'] = $_SESSION['user']['nhan_vien'];
        $data['ngay_nhap'] = date('Y-m-d');
        $data['tinh_trang'] = 1;
        if($data['giao_cho']){
            $data['tinh_trang'] = 2;
            $data['ngay_giao'] = date('Y-m-d');
        }
        if ($this->model->addObj($data)) {
            $jsonObj['id'] = $this->model->addObj($data);
            
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $data = $_REQUEST['data'];
        if($this->model->updateObj($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function addnhatky()
    {
        $iddata = $_REQUEST['iddata'];
        $ghichu = $_REQUEST['ghi_chu'];
        $data = ['id_data' => $iddata,
            'nhan_vien' => $_SESSION['user']['nhan_vien'],
            'ngay_gio' => date('Y-m-d H:i:s'),
            'ghi_chu' => $ghichu,
            'tinh_trang' => 1];
        if ($this->model->addnhatky($data)) {
            $jsonObj['msg'] = "Cập nhật nhật ký thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
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
}

?>