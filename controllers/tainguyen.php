<?php
class Tainguyen extends Controller
{
    static private $funAdd = 0, $funShare = 0, $funEdit = 0, $funDel = 0;
    // private $_Data;
    function __construct()
    {
        parent::__construct();
        // $this->_Data = new Model();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('tainguyen');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('tainguyen');
      
        foreach ($funcs as $item) {
            if ($item['function'] == 'add')
                self::$funAdd = 1;
            if ($item['function'] == 'edit')
                self::$funEdit = 1;
            if ($item['function'] == 'share')
            self::$funShare = 1;
            if ($item['function'] == 'del')
                self::$funDel = 1;
        }
    }
    function index(){
        require "layouts/header.php";
        $this->view->funAdd = self::$funAdd;
        $this->view->funShare = self::$funShare;
        $this->view->funEdit = self::$funEdit;
        $this->view->funDel = self::$funDel;
        $this->view->render("tainguyen/index");
        require "layouts/footer.php";
    }

    function formedit(){
        if (self::$funEdit == 0) {
            header("Location:".HOME);
            return false;
        }
        require "layouts/header.php";
        $this->view->render("tainguyen/formedit");
        require "layouts/footer.php";
    }

    function formadd(){
        if (self::$funAdd == 0) {
            header("Location:".HOME);
            return false;
        }
        require "layouts/header.php";
        $this->view->render("tainguyen/formadd");
        require "layouts/footer.php";
    }

    function json()
    {
        $nhanvienid = isset($_REQUEST['nhanvienid'])?$_REQUEST['nhanvienid']:$_SESSION['user']['staffId'];
        $rows = isset($_REQUEST['length']) ? $_REQUEST['length'] : 30;
        $offset = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
        $draw = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : 1;
        $keyword = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $jsonObj = $this->model->getFetObj($nhanvienid, $draw, $keyword, $offset, $rows);
        echo json_encode($jsonObj);
    }

    function getnhanvien()
    {
        $id = $_REQUEST['id'];
        $json = $this->model->getnhanvien($id);
        echo json_encode($json);
    }

    function detail_resource()
    {
        $id = $_REQUEST['id'];
        $json = $this->model->get_detail_tainguyen($id);
        echo json_encode($json);
    }

    function combo()
    {
        $json = $this->model->get_data_combo();
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
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $chusohuu = isset($_REQUEST['chu_so_huu']) ? $_REQUEST['chu_so_huu'] : '';
        $nhacungcap = isset($_REQUEST['nha_cung_cap']) ? $_REQUEST['nha_cung_cap'] : '';
        $phanloai = isset($_REQUEST['phan_loai']) ? $_REQUEST['phan_loai'] : '';
        $link = isset($_REQUEST['link']) ? $_REQUEST['link'] : '';
        $tendangnhap = isset($_REQUEST['ten_dang_nhap']) ? $_REQUEST['ten_dang_nhap'] : '';
        $matkhau = isset($_REQUEST['mat_khau']) ? $_REQUEST['mat_khau'] : '';
        $ghichu = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';
        $nguoitao = $_SESSION['user']['staffId'];
        $data = array(
            'name' => $name, 'owner' => $chusohuu, 'supplier' => $nhacungcap, 'classify' => $phanloai,
            'link' => $link, "username" => $tendangnhap, 'password' => $matkhau, 'note' => $ghichu,
            'createdDate' => date("Y-m-d H:i:s"), 'creatorId' => $nguoitao, 'status' => 1
        );
        $temp = $this->model->addObj($data);
        if ($temp) {
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
        if (self::$funEdit == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['id'];
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $chusohuu = isset($_REQUEST['owner']) ? $_REQUEST['owner'] : 0;
        $nhacungcap = isset($_REQUEST['supplier']) ? $_REQUEST['supplier'] : 0;
        $phanloai = isset($_REQUEST['classify']) ? $_REQUEST['classify'] : 0;
        $link = isset($_REQUEST['link']) ? $_REQUEST['link'] : '';
        $tendangnhap = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
        $ghichu = isset($_REQUEST['note']) ? $_REQUEST['note'] : '';
        if ($_REQUEST['password'] != ''){
            $matkhau = $_REQUEST['password'];
            $data = array(
                'name' => $name, 'owner' => $chusohuu, 'supplier' => $nhacungcap, 'classify' => $phanloai,
                'link' => $link, "username" => $tendangnhap, 'password' => $matkhau, 'note' => $ghichu,
                'createdDate' => date("Y-m-d H:i:s")
            );
        } else {
            $data = array(
                'name' => $name, 'owner' => $chusohuu, 'supplier' => $nhacungcap, 'classify' => $phanloai,
                'link' => $link, "username" => $tendangnhap,'note' => $ghichu,
                'createdDate' => date("Y-m-d H:i:s")
            );
        }
        
        $temp = $this->model->updateObj($id, $data);
        if ($temp) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function chiase()
    {
        if (self::$funShare == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['id'];
        $nhanvien = $_REQUEST['nhanvien'];
        $data = ['staffId' => $nhanvien];
        if ($this->model->chiase($data,$id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function del()
    {
        if (self::$funDel == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['id'];
        $temp = $this->model->delObj($id);
        if ($temp) {
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            // $this->view->jsonObj = json_encode($jsonObj);
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            // $this->view->jsonObj = json_encode($jsonObj);
        }
        echo json_encode($jsonObj);
        // $this->view->render("tainguyen/del");
    }
}
