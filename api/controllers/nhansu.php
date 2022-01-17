<?php

class Nhansu extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    // function updateStaff()
    // {
    //     $json = $this->model->updateStaff();
    //     if($json != 0){
    //         $jsonObj['message'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['code'] = 200;
    //         $jsonObj['data'] = $json;
    //         echo json_encode($jsonObj);
    //     } else {
    //         $jsonObj['message'] = "Cập nhật dữ liệu không thành công";
    //         $jsonObj['code'] = 400;
    //         $jsonObj['data'] = $json;
    //         echo json_encode($jsonObj);
    //     }
    // }
    
    function profile()
    {
        $jsonObj = [];
        $id = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : 0;
        if ($id == 0) {
            $jsonObj['message'] = "Bạn chưa nhập id nhân viên";
            $jsonObj['code'] = 401;
            echo json_encode($jsonObj);
            return false;
        }
        $json = $this->model->getProfile($id);
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi API";
            $jsonObj['code'] = 402;
            echo json_encode($jsonObj);
            return false;
        }
        if(count($json)==0){
            $jsonObj['message'] = "Nhân viên không tồn tại";
            $jsonObj['code'] = 403;
            echo json_encode($jsonObj);
            return false;
        }
        $jsonObj['message'] = "Cập nhật dữ liệu thành công";
        $jsonObj['code'] = 200;
        $jsonObj['data'] = $json;
        echo json_encode($jsonObj);
    }

    function updateProfile()
    {
        $id = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : 0;
        if ($id == 0) {
            $jsonObj['message'] = "Chưa nhập staffId";
            $jsonObj['code'] = 401;
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->checkId($id);
            if ($json == 0) {
                $jsonObj['message'] = "Nhân viên không tồn tại trong hệ thống";
                $jsonObj['code'] = 401;
                http_response_code(401);
                echo json_encode($jsonObj);
                return false;
            }
        }
        $data = [];
        if(isset($_REQUEST['name']))
            $data['name'] = $_REQUEST['name'];
        if(isset($_REQUEST['email'])) {
            $email = $_REQUEST['email'];
            if($email != '') {
                $json = $this->model->checkEmail($id, $email);
                if ($json == 0) {
                    $jsonObj['message'] = "Email đã tồn tại trong hệ thống";
                    $jsonObj['code'] = 401;
                    http_response_code(401);
                    echo json_encode($jsonObj);
                    return false;
                } 
            }
        }
        if(isset($_REQUEST['gender']))
            $data['gender'] = $_REQUEST['gender'];
        if(isset($_REQUEST['birthDay']))
            $data['birthDay'] = $_REQUEST['birthDay'];
        if(isset($_REQUEST['address']))
            $data['address'] = $_REQUEST['address'];
        if(isset($_REQUEST['email']))
            $data['phoneNumber'] = $_REQUEST['phoneNumber'];
        if(isset($_REQUEST['province']))
            $data['province'] = $_REQUEST['province'];
        if(isset($_REQUEST['residence']))
            $data['residence'] = $_REQUEST['residence'];
        if(isset($_REQUEST['idCard']))
            $data['idCard'] = $_REQUEST['idCard'];
        if(isset($_REQUEST['idDate']))
            $data['idDate'] = $_REQUEST['idDate'];
        if(isset($_REQUEST['idAddress']))
            $data['idAddress'] = $_REQUEST['idAddress'];
        if(isset($_REQUEST['taxCode']))
            $data['taxCode'] = $_REQUEST['taxCode'];
        if(isset($_REQUEST['maritalStatus']))
            $data['maritalStatus'] = $_REQUEST['maritalStatus'];
        if(isset($_REQUEST['nationality']))
            $data['nationality'] = $_REQUEST['nationality'];
        if(isset($_REQUEST['description']))
            $data['description'] = $_REQUEST['description'];
        if(isset($_REQUEST['vssId']))
            $data['vssId'] = $_REQUEST['vssId'];

        $avatar = '';
        $data['avatar'] = $avatar;
        if(isset($_FILES['avatar'])) {
            $filename = $_FILES['avatar']['name'];
            if ($filename != '') {
                $dir = ROOT_DIR . '/uploads/nhanvien/';
                $file = functions::uploadfile('avatar', $dir, $id);
                if ($file != '')
                    $avatar =  'uploads/nhanvien/' . $file;
                $data['avatar'] = $avatar;
            }
        }
       
            
        $json = $this->model->updateProfile($id, $data);
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
            $jsonObj['code'] = 402;
            http_response_code(402);
            echo json_encode($jsonObj);
        } else {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
            $data = $this->model->getProfile($id);
            $jsonObj['data'] = $data;
            http_response_code(200);
            echo json_encode($jsonObj);
        }
    }

    // function updateinfo()
    // {
    //     $data = $_REQUEST['data'];
    //     $id = $_REQUEST['id'];
    //     if ($this->model->updateinfo($data, $id)) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

    // function uploadAvatar()
    // {
    //     $id = $_REQUEST['staffId'];
    //     $filename = $_FILES['avatar']['name'];
    //     $hinhanh = '';
    //     if ($filename != '') {
    //         $dir = ROOT_DIR . '/uploads/nhanvien/';
    //         $file = functions::uploadfile('hinhanh', $dir, $id);
    //         if ($file != '')
    //             $hinhanh = URLFILE . '/uploads/nhanvien/' . $file;
    //     }
    //     if ($this->model->uploadAvatar($hinhanh, $id)) {
    //         $jsonObj['data']['fileName'] = $hinhanh;
    //         $jsonObj['message'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['code'] = 200;
    //     } else {
    //         $jsonObj['message'] = "Lỗi khi cập nhật database";
    //         $jsonObj['code'] = 400;
    //     }
    //     echo json_encode($jsonObj);
    // }

    // function them()
    // {
    //     $data = $_REQUEST['data'];
    //     if ($this->model->them($data)) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

    // function xoa()
    // {
    //     $id = $_REQUEST['id'];
    //     if ($this->model->xoa($id)) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi xóa dữ liệu" . $id;
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

    // function thoiviec()
    // {
    //     $id = $_REQUEST['id'];
    //     if ($this->model->thoiviec($id)) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database" . $id;
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

    // function thanhpho()
    // {
    //     $data = $this->model->thanhpho();
    //     echo json_encode($data);
    // }

    // /*== check nhan_vien đã có users */
    // function check_email()
    // {
    //     $email = $_REQUEST['email'];

    //     if ($this->model->check_email($email) <> 0) {
    //         $jsonObj['msg'] = "Email đã tồn tại";
    //         $jsonObj['success'] = false;
    //     } else {
    //         $jsonObj['msg'] = "Email hợp lệ";
    //         $jsonObj['success'] = true;
    //     }
    //     echo json_encode($jsonObj);
    // }

    // function check_email_edit()
    // {
    //     $email = $_REQUEST['email'];
    //     $id = $_REQUEST['id'];
    //     if ($this->model->check_email_edit($id, $email) <> 0) {
    //         $jsonObj['msg'] = "Email đã tồn tại";
    //         $jsonObj['success'] = false;
    //     } else {
    //         $jsonObj['msg'] = "Email hợp lệ";
    //         $jsonObj['success'] = true;
    //     }
    //     echo json_encode($jsonObj);
    // }

    // function add_users()
    // {
    //     $post = $_REQUEST['data'];
    //     $data['nhan_vien'] = $post['nhan_vien'];
    //     $data['email'] = $post['email'];
    //     $data['name'] = md5($post['email']);
    //     $pass = md5($post['password']);
    //     $data['mat_khau'] = md5($pass);
    //     $data['tinh_trang'] = 1;


    //     if ($this->model->them_users($data)) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

    // function update_users()
    // {
    //     $post = $_REQUEST['data'];
    //     $id = $post['id_user'];
    //     $data['name'] = md5($post['email']);
    //     $data['email'] = $post['email'];

    //     if ($post['password'] != "") {
    //         $data['mat_khau'] = md5(md5($post['password']));
    //     }

    //     $data['sip_pass'] = $post['sip_pass'];
    //     $data['tinh_trang'] = $post['tinh_trang'];
    //     $data['ext_num'] = $post['ext_num'];

    //     if ($this->model->update_users($data, $id)) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }


    // function add_nhanvien_info()
    // {
    //     $post = $_REQUEST['data'];
    //     $data['nhanvien_id'] = $post['nhanvien_id'];
    //     $data['twitter'] = $post['twitter'];
    //     $data['facebook'] = $post['facebook'];
    //     $data['instagram'] = $post['instagram'];
    //     $data['zalo'] = $post['zalo'];
    //     $data['wechat'] = $post['wechat'];
    //     $data['linkein'] = $post['linkein'];

    //     if ($this->model->them_nhanvien_info($data)) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

    // function update_nhanvien_info()
    // {
    //     $post = $_REQUEST['data'];

    //     $nhanvien_id = $post['nhanvien_id'];
    //     $data['twitter'] = $post['twitter'];
    //     $data['facebook'] = $post['facebook'];
    //     $data['instagram'] = $post['instagram'];
    //     $data['zalo'] = $post['zalo'];
    //     $data['wechat'] = $post['wechat'];
    //     $data['linkein'] = $post['linkein'];

    //     if ($this->model->update_nhanvien_info($data, $nhanvien_id)) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }


}
