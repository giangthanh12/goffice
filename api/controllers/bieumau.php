<?php
class bieumau extends Controller
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

    function phanloai()
    {
        $jsonObj = '[{"id":"1","text":"Hợp đồng"},
                {"id":"2","text":"Báo giá"},
                {"id":"3","text":"Đề nghị tạm ứng"},
                {"id":"4","text":"Đề nghị thanh toán"},
                {"id":"5","text":"Yêu cầu tuyển dụng"}]';
        echo json_encode($jsonObj);
    }

    function loaddata()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function add()
    {
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $phanloai = isset($_REQUEST['phan_loai']) ? $_REQUEST['phan_loai'] : 0;
        $userid = isset($_REQUEST['nhan_vien']) ? $_REQUEST['nhan_vien'] : $_SESSION['user']['staffId'];
        $filename = $_FILES['file']['name'];
        $fname = explode('.',$filename);
        $file = '';
        if ($filename != '') {
            if (file_exists(ROOT_DIR . '/uploads/bieumau/' . $filename )) {
                $file = URLFILE . '/uploads/bieumau/' . $filename;
            } else {
                $dir = ROOT_DIR . '/uploads/bieumau/';
                $file = functions::uploadfile('file', $dir, $fname[0]);
                if ($file != '')
                    $file = URLFILE . '/uploads/bieumau/' . $file;
            }
        }
        $data = array(
            'name' => $name,
            'dateTime' => date('Y-m-d'),
            'updated' => date('Y-m-d'),
            'staffId' => $userid,
            'classify' => $phanloai,
            'filename' => $file,
            'status' => 1
        );
        if ($this->model->addObj($data)) {
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $phanloai = isset($_REQUEST['phan_loai']) ? $_REQUEST['phan_loai'] : 0;
        $filename = $_FILES['file']['name'];
        $file = '';
        if ($filename != '') {
            if (file_exists(ROOT_DIR . '/uploads/bieumau/' . $filename )) {
                $file = URLFILE . '/uploads/bieumau/' . $filename;
            } else {
                $dir = ROOT_DIR . '/uploads/bieumau/';
                $file = functions::uploadfile('file', $dir, $filename);
                if ($file != '')
                    $file = URLFILE . '/uploads/bieumau/' . $file;
            }
            
            $data = array(
                'name' => $name,
                'updated' => date('Y-m-d'),
                'classify' => $phanloai,
                'filename' => $file
            );
        } else {
            $data = array(
                'name' => $name,
                'updated' => date('Y-m-d'),
                'classify' => $phanloai
            );
        }
        
        if ($this->model->updateObj($id, $data)) {
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }

        echo json_encode($jsonObj);
    }

    function del()
    {
        $id = $_REQUEST['id'];
        $data = ['status' => 0];
        if ($this->model->delObj($id, $data)) {
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
}
