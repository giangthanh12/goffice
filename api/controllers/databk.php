<?php
class Data extends Controller{
    function __construct()
    {
        parent:: __construct();
    }

    function listAll()
    {
        $result = $this->model->listAll();
        echo json_encode($result);
    }

    function list()
    {
      
        $keyword = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : (isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '');
        // Order
        // $keyword = isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '';

        // $offset = isset($_REQUEST['start']) ? $_REQUEST['start']: 0;
        $rows = isset($_REQUEST['length']) ? $_REQUEST['length']: 30;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page']: 1;
        $offset = ($page - 1) * $rows;
        $result = $this->model->listObj($keyword, $offset, $rows);
        $totalData = $result['total'];
        
        $data['data'] = $result['data'];
        $data['pages'] = ceil($totalData/$rows);
        $data['draw'] = intval(isset($_REQUEST['draw']) ?$_REQUEST['draw']: 1);
        $data['recordsTotal'] = $totalData;
        $data['recordsFiltered'] = count($result['data']);
        echo json_encode($data);
    }

    function listApi()
    {
      
        $keyword =  isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '';
        // Order
        // $keyword = isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '';

        // $offset = isset($_REQUEST['start']) ? $_REQUEST['start']: 0;
        $rows = isset($_REQUEST['length']) ? $_REQUEST['length']: 30;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page']: 1;
        $offset = ($page - 1) * $rows;
        $result = $this->model->listObjApi($keyword, $offset, $rows);
        // $totalData = $result['total'];
        
        // $data['data'] = $result['data'];
        // $data['pages'] = ceil($totalData/$rows);
        // $data['draw'] = intval(isset($_REQUEST['draw']) ?$_REQUEST['draw']: 1);
        // $data['recordsTotal'] = $totalData;
        // $data['recordsFiltered'] = count($result['data']);
        echo json_encode($result);
    }

    function loaddata()
    {
        $id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function add()
    {
        // $data = $_REQUEST['data'];
        $data['ho_ten'] = isset($_REQUEST['ho_ten']) ? $_REQUEST['ho_ten'] : '';
        $data['dien_thoai'] = isset($_REQUEST['dien_thoai']) ? $_REQUEST['dien_thoai'] : '';
        $data['dia_chi'] = isset($_REQUEST['dia_chi']) ? $_REQUEST['dia_chi'] : '';
        $data['email'] = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $data['phan_loai'] = isset($_REQUEST['phan_loai']) ? $_REQUEST['phan_loai'] : 0;
        $data['ghi_chu'] = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';

        $data['nguoi_nhap'] = $_SESSION['user']['nhan_vien'];
        $data['ngay_nhap'] = date('Y-m-d');
        $data['tinh_trang'] = 1;
        if ($this->model->addObj($data)) {
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
        $data['ho_ten'] = isset($_REQUEST['ho_ten']) ? $_REQUEST['ho_ten'] : '';
        $data['dien_thoai'] = isset($_REQUEST['dien_thoai']) ? $_REQUEST['dien_thoai'] : '';
        $data['dia_chi'] = isset($_REQUEST['dia_chi']) ? $_REQUEST['dia_chi'] : '';
        $data['email'] = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $data['phan_loai'] = isset($_REQUEST['phan_loai']) ? $_REQUEST['phan_loai'] : 0;
        $data['ghi_chu'] = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';
        $data['nhan_vien'] = isset($_REQUEST['nhan_vien']) ? $_REQUEST['nhan_vien'] : 0;
        $data['tinh_trang'] = isset($_REQUEST['tinh_trang']) ? $_REQUEST['tinh_trang'] : 1;
        if($this->model->updateObj($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function chiadata()
    {
        $data = $_REQUEST['data'];
        $nhanvien = $_REQUEST['nhanvien'];
        if ($this->model->chiadata($nhanvien,$data)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
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
        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
            if($this->model->updateObj($id)){
                $jsonObj['msg'] = "Xóa dữ liệu thành công";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Xóa dữ liệu không thành công";
                $jsonObj['success'] = false;
            } 
        }else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        } 
        echo json_encode($jsonObj);
    }
}
