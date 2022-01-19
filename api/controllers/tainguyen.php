<?php
class Tainguyen extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function json()
    {
        $nhanvienid = isset($_REQUEST['nhanvienid']) ? $_REQUEST['nhanvienid'] : $_SESSION['user']['nhan_vien'];
        $rows = isset($_REQUEST['length']) ? $_REQUEST['length'] : 30;
        $offset = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
        $draw = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : 1;
        $keyword = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $jsonObj = $this->model->getFetObj($nhanvienid, $draw, $keyword, $offset, $rows);
        echo json_encode($jsonObj);
    }

    function listApi()
    {
        $nhanvienid = isset($_REQUEST['nhanvienid']) ? $_REQUEST['nhanvienid'] : $_SESSION['user']['nhan_vien'];
        $keyword =  isset($_REQUEST['search']) ? $_REQUEST['search'] : '';
        $rows = isset($_REQUEST['length']) ? $_REQUEST['length']: 30;
        $page = (isset($_REQUEST['page']) && ($_REQUEST['page'] != '')) ? $_REQUEST['page'] : 1;
        $offset = ($page - 1) * $rows;
        // $result = $this->model->listObjApi($keyword, $offset, $rows);
        
        // $nhanvienid = isset($_REQUEST['nhanvienid']) ? $_REQUEST['nhanvienid'] : 0;
        // $rows = isset($_REQUEST['length']) ? $_REQUEST['length'] : 30;
        // $offset = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
        // $keyword = isset($_REQUEST['search']) ? $_REQUEST['search'] : '';
        $jsonObj = $this->model->getFetObjApi($nhanvienid, $keyword, $offset, $rows);
        echo json_encode($jsonObj);
    }

    function getnhanvien()
    {
        $id = $_REQUEST['id'];
        $json = $this->model->getnhanvien($id);
        echo json_encode($json);
    }

    function getnhanvienApi()
    {
        $id = $_REQUEST['id'];
        $json = $this->model->getnhanvienApi($id);
        echo json_encode($json);
    }

    function detail_resource()
    {
        $id = $_REQUEST['id'];
        $json = $this->model->get_detail_tainguyen($id);
        echo json_encode($json);
    }

    function add()
    {
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $chusohuu = isset($_REQUEST['chu_so_huu']) ? $_REQUEST['chu_so_huu'] : '';
        $nhacungcap = isset($_REQUEST['nha_cung_cap']) ? $_REQUEST['nha_cung_cap'] : '';
        $phanloai = isset($_REQUEST['phan_loai']) ? $_REQUEST['phan_loai'] : '';
        $link = isset($_REQUEST['link']) ? $_REQUEST['link'] : '';
        $tendangnhap = isset($_REQUEST['ten_dang_nhap']) ? $_REQUEST['ten_dang_nhap'] : '';
        $matkhau = isset($_REQUEST['mat_khau']) ? $_REQUEST['mat_khau'] : '';
        $ghichu = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';
        $nguoitao = isset($_REQUEST['nguoi_tao']) ? $_REQUEST['nguoi_tao'] : $_SESSION['user']['nhan_vien'];;
        $data = array(
            'name' => $name, 'chu_so_huu' => $chusohuu, 'nha_cung_cap' => $nhacungcap, 'phan_loai' => $phanloai,
            'link' => $link, "ten_dang_nhap" => $tendangnhap, 'mat_khau' => $matkhau, 'ghi_chu' => $ghichu,
            'ngay_tao' => date("Y-m-d H:i:s"), 'nguoi_tao' => $nguoitao, 'tinh_trang' => 1
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
        $id = $_REQUEST['id'];
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $chusohuu = isset($_REQUEST['chu_so_huu']) ? $_REQUEST['chu_so_huu'] : 0;
        $nhacungcap = isset($_REQUEST['nha_cung_cap']) ? $_REQUEST['nha_cung_cap'] : 0;
        $phanloai = isset($_REQUEST['phan_loai']) ? $_REQUEST['phan_loai'] : 0;
        $link = isset($_REQUEST['link']) ? $_REQUEST['link'] : '';
        $tendangnhap = isset($_REQUEST['ten_dang_nhap']) ? $_REQUEST['ten_dang_nhap'] : '';
        $ghichu = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';
        if ($_REQUEST['mat_khau'] != ''){
            $matkhau = $_REQUEST['mat_khau'];
            $data = array(
                'name' => $name, 'chu_so_huu' => $chusohuu, 'nha_cung_cap' => $nhacungcap, 'phan_loai' => $phanloai,
                'link' => $link, "ten_dang_nhap" => $tendangnhap, 'mat_khau' => $matkhau, 'ghi_chu' => $ghichu,
                'ngay_tao' => date("Y-m-d H:i:s")
            );
        } else {
            $data = array(
                'name' => $name, 'chu_so_huu' => $chusohuu, 'nha_cung_cap' => $nhacungcap, 'phan_loai' => $phanloai,
                'link' => $link, "ten_dang_nhap" => $tendangnhap, 'ghi_chu' => $ghichu,
                'ngay_tao' => date("Y-m-d H:i:s")
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
        $id = $_REQUEST['id'];
        $nhanvien = $_REQUEST['nhanvien'];
        $data = ['nhan_vien' => $nhanvien];
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
