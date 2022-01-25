<?php

class staff extends Controller
{
    static private $funAdd = 0, $funEdit = 0, $funDel = 0;
    private $funcs;

    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('staff');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('staff');
      
        foreach ($funcs as $item) {
            if ($item['function'] == 'add')
                self::$funAdd = 1;
            if ($item['function'] == 'edit')
                self::$funEdit = 1;
            if ($item['function'] == 'del')
                self::$funDel = 1;
        }
      
    }
    function index()
    {
     
        require "layouts/header.php";
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $this->view->funDel = self::$funDel;
        $this->view->render("staff/index");
        require "layouts/footer.php";

    }
    function getData()
    {
        $data = $this->model->getStaff();
        echo json_encode($data);
    }
    function loadRecord() {
        $id = $_REQUEST['id'];
        $data = $this->model->loadRecord($id);
        echo json_encode($data);
    }
   
    function loaddata()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }
    function getProvince() {
        $jsonObj = $this->model->getProvince();
        echo json_encode($jsonObj);
    }
    function getNational() {
        $jsonObj = $this->model->getNational();
        echo json_encode($jsonObj);
    }
    function updateinfo()
    {
        if (self::$funEdit == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $data = $_REQUEST['data'];
        $data['birthDay'] = date("Y-m-d",strtotime(str_replace('/', '-',$data['birthDay'] )));
        $data['idDate'] = date("Y-m-d",strtotime(str_replace('/', '-',$data['idDate'] )));
        $temp = isset($data['accesspoints'])?$data['accesspoints']:[];
        $accessPoint = '';
        if(count($temp)>0)
            $accessPoint = implode(",",$temp);
        $data['accesspoints']=$accessPoint;
        $id = $_REQUEST['id'];
        if ($this->model->updateinfo($data, $id)) {
            if($_SESSION['user']['staffId']==$id) {
                $_SESSION['user']['staffName'] = $data['name'];
                $_SESSION['user']['accesspoints'] = $data['accesspoints'];
            }
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function accessPoints(){
        $json = $this->model->getAccessPoints();
        echo json_encode($json);
    }

    function changeImage()
    {
        if (self::$funEdit == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['myid'];
        $filename = $_FILES['hinhanh']['name'];
  
        $avatar = '';
        if ($filename != '') {
            $dir = ROOT_DIR. '/uploads/nhanvien/';
            $file = functions::uploadfile('hinhanh', $dir, $id);
            if ($file != '')
                $avatar = $file;
        }
       
        if ($this->model->changeImage($avatar, $id)) {
            $jsonObj['filename'] = $avatar;
            if ($id == $_SESSION['user']['staffId'])
                $_SESSION['user']['avatar'] = $avatar;
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function add()
    {
        if (self::$funAdd == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
            $data = $_REQUEST['data'];
            $data['birthday'] = date("Y-m-d",strtotime(str_replace('/', '-',$data['birthday'] )));
          
            if ($this->model->add($data)) {
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Lỗi khi cập nhật database";
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
        if ($this->model->del($id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi xóa dữ liệu" . $id;
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
            $jsonObj['msg'] = "Lỗi khi cập nhật database" . $id;
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
    function province()
    {
        $data = $this->model->province();
        echo json_encode($data);
    }
    /*== check nhan_vien đã có users */
    function checkUsername()
    {
        $username = $_REQUEST['username'];
        $id = $_REQUEST['id'];
        if ($this->model->checkUsername($username, $id) > 0) {
            $jsonObj['msg'] = "Email đã tồn tại";
            $jsonObj['success'] = false;
        } else {
            $jsonObj['msg'] = "Email hợp lệ";
            $jsonObj['success'] = true;
        }
        echo json_encode($jsonObj);
    }
    function add_nhanvien_info()
    {
        if (self::$funEdit == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
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

    function updateInfoStaff()
    {
        if (self::$funEdit == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $post = $_REQUEST['data'];
        $staffId = $post['staffId'];
        $data['twitter'] = $post['twitter'];
        $data['facebook'] = $post['facebook'];
        $data['instagram'] = $post['instagram'];
        $data['zalo'] = $post['zalo'];
        $data['wechat'] = $post['wechat'];
        $data['linkein'] = $post['linkein'];

        if ($this->model->updateInfoStaff($data, $staffId)) {
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
