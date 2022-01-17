<?php

class ticket extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }

    function add()
    {
        $name = $_REQUEST['name'];
        $nguonticket = $_REQUEST['nguon_ticket'];
        $ngaygio = $_REQUEST['ngay_gio'];
        $dienthoai = $_REQUEST['dien_thoai'];
        $phanmem = $_REQUEST['phan_mem'];
        $noidung = $_REQUEST['noi_dung'];
        $tinhtrang =1;
        $data = ['name'=>$name,
                'nguon_ticket'=>$nguonticket,
                'ngay_gio'=>$ngaygio,
                'dien_thoai'=>$dienthoai,
                'phan_mem'=>$phanmem,
                'noi_dung'=>$noidung,
                'tinh_trang'=>$tinhtrang
            ];
        if($this->model->addObj($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['succes'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['succes'] = false;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $nguonticket = $_REQUEST['nguon_ticket'];
        $ngaygio = $_REQUEST['ngay_gio'];
        $dienthoai = $_REQUEST['dien_thoai'];
        $phanmem = $_REQUEST['phan_mem'];
        $noidung = $_REQUEST['noi_dung'];
        $tinhtrang = $_REQUEST['tinh_trang'];
        $data = ['name'=>$name,
                'nguon_ticket'=>$nguonticket,
                'ngay_gio'=>$ngaygio,
                'dien_thoai'=>$dienthoai,
                'phan_mem'=>$phanmem,
                'noi_dung'=>$noidung,
                'tinh_trang'=>$tinhtrang
            ];
        if($this->model->updateObj($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['succes'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['succes'] = false;
        }
        echo json_encode($jsonObj);
    }

    function del()
    {
        $id = $_REQUEST['id'];
        $data = ['tinh_trang'=>0];
        if($this->model->delObj($id,$data)){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['succes'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['succes'] = false;
        } 
        echo json_encode($jsonObj);
    }
}

?>
