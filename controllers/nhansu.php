<?php

class Nhansu extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("nhansu/index");
        require "layouts/footer.php";
    }

    function getData()
    {
        $data = $this->model->getnhanvien();
        echo json_encode($data);
    }

    function loaddata()
    {
        $id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function updateinfo()
    {
        $data = $_REQUEST['data'];
        $id = $_REQUEST['id'];
        if ($this->model->updateinfo($data,$id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function thayanh()
    {
        $id = $_REQUEST['myid'];
        $filename = $_FILES['hinhanh']['name'];
        $hinhanh = '';
        if ($filename!='') {
            $dir = ROOT_DIR . '/uploads/nhanvien/';
            $file = functions::uploadfile('hinhanh', $dir, $id);
            if ($file!='')
                $hinhanh = 'uploads/nhanvien/'.$file;
        }
        if ($this->model->thayanh($hinhanh,$id)) {
            $jsonObj['filename'] = URLFILE."/".$hinhanh;
            if($id == $_SESSION['user']['staffId'])
                $_SESSION['user']['avatar'] = URLFILE."/".$hinhanh;
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function them()
    {
        $data = $_REQUEST['data'];
        if ($this->model->them($data)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function xoa()
    {
        $id = $_REQUEST['id'];
        if ($this->model->xoa($id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi xóa dữ liệu".$id;
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function thoiviec()
    {
        $id = $_REQUEST['id'];
        if ($this->model->thoiviec($id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database".$id;
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function province() {
        $data = $this->model->province();
        echo json_encode($data);
    }

    /*== check nhan_vien đã có users */
    function checkUsername() {
        $username = $_REQUEST['username'];
        $id = $_REQUEST['id'];
        if ($this->model->checkUsername($username,$id)>0){
            $jsonObj['msg'] = "Email đã tồn tại";
            $jsonObj['success'] = false;
        }
        else {
            $jsonObj['msg'] = "Email hợp lệ";
            $jsonObj['success'] = true;
        }
        echo json_encode($jsonObj);
    }

    function add_users()
    {
        $post = $_REQUEST['data'];
        $data['staffId'] = $post['nhan_vien'];
        $data['username'] = $post['username'];
        $data['usernameMd5'] = md5($post['username']);
        $pass =  md5($post['password']);
        $data['password'] = md5($pass);
        $data['status'] = 1 ;


        if ($this->model->them_users($data)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function update_users(){
        $post = $_REQUEST['data'];
        $id = $post['id_user'];
        $data['username'] = $post['username'];
        $data['usernameMd5'] = md5($post['username']);

        if($post['password'] != "" ){
            $data['password'] = md5(md5($post['password']));
        }

        $data['sipPass'] = $post['sip_pass'];
        $data['status'] = $post['tinh_trang'];
        $data['extNum'] = $post['ext_num'];

        if ($this->model->update_users($data,$id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }


    function add_nhanvien_info()
    {
        $post = $_REQUEST['data'];
        $data['staffId'] = $post['nhanvien_id'];
        $data['twitter'] = $post['twitter'];
        $data['facebook'] = $post['facebook'];
        $data['instagram'] = $post['instagram'];
        $data['zalo'] = $post['zalo'];
        $data['wechat'] = $post['wechat'];
        $data['linkein'] = $post['linkein'];

        if ($this->model->them_nhanvien_info($data)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function update_nhanvien_info(){
        $post = $_REQUEST['data'];

        $nhanvien_id = $post['nhanvien_id'];
        $data['twitter'] = $post['twitter'];
        $data['facebook'] = $post['facebook'];
        $data['instagram'] = $post['instagram'];
        $data['zalo'] = $post['zalo'];
        $data['wechat'] = $post['wechat'];
        $data['linkein'] = $post['linkein'];

        if ($this->model->update_nhanvien_info($data,$nhanvien_id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }


}

?>
