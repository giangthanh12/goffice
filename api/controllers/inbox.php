<?php
class inbox extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $type = isset($_REQUEST['type'])?$_REQUEST['type']:'inbox';
        $data = $this->model->getdata($type);
        echo json_encode($data);
    }

    function unread()
    {
        $data = $this->model->unread();
        echo $data;
    }

    function sent()
    {
        $data = $this->model->getsentitem();
        echo json_encode($data);
    }

    function send()
    {
        //
        $nguoinhan = $_REQUEST['nguoinhan'];
        $tieude = $_REQUEST['tieude'];
        $noidung = $_REQUEST['noidung'];
        $data = array('tieu_de'=>$tieude, 'noi_dung'=>$noidung, 'nguoi_nhan'=>$nguoinhan, 'tinh_trang'=>1);
        $files = $_FILES['files'];
        if($_FILES['files']['name'][0]!='') {
            $dir = ROOT_DIR . '/uploads/dinhkem/';
            $filenames = '';
            for($i=0;$i<count($_FILES['files']['name']);$i++) {
                $fname = functions::upfiles($_FILES['files']['name'][$i], $_FILES['files']['size'][$i], $_FILES['files']['tmp_name'][$i], $dir);
                if ($fname!='')
                    if($filenames=='')
                        $filenames = $fname;
                    else
                        $filenames .= ','.$fname;
            }
            $data['dinh_kem']=$filenames;
        }
        $receiver = $this->model->add($data);
        if ($receiver!='') {
            $jsonObj['msg'] = "Đã gửi thông báo";
            $jsonObj['success'] = true;
            $jsonObj['receiver'] = $receiver;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function checkmail() // dùng cho notification
    {
        $data = $this->model->checkmail();
        echo json_encode($data);
    }

    function markunread()
    {
        $ids = $_REQUEST['ids'];
        if ($this->model->markunread($ids)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database".$id;
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
    //
    // function thayanh()
    // {
    //     $id = $_REQUEST['myid'];
    //     $filename = $_FILES['hinhanh']['name'];
    //     $hinhanh = '';
    //     if ($filename!='') {
    //         $dir = ROOT_DIR . '/uploads/nhanvien/';
    //         $file = functions::uploadfile('hinhanh', $dir, $id);
    //         if ($file!='')
    //             $hinhanh = URLFILE.'/uploads/nhanvien/'.$file;
    //     }
    //     if ($this->model->thayanh($hinhanh,$id)) {
    //         $jsonObj['filename'] = $hinhanh;
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công".$file;
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

    function xoa()
    {
        $ids = $_REQUEST['ids'];
        if ($this->model->xoa($ids)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi xóa dữ liệu".$ids;
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function get_detail()
    {
        $id = $_REQUEST['id'];
        $data = $this->model->get_detail($id);
        echo json_encode($data);
    }

    function nhanvien() { // nap du lieu vao select2 de chon nguoi nhan, cc, bcc
        $data = $this->model->nhanvien();
        echo json_encode($data);
    }

}

?>
