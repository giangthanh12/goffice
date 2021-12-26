<?php
class vanban extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("vanban/index");
        require "layouts/footer.php";
    }

    function loadfolders() 
    {
        $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : '';
        $folder = (isset($_REQUEST['folder']) && $_REQUEST['folder'] != '') ? $_REQUEST['folder'] : 0;
        $json = $this->model->getFolders($folder,$search);
        echo json_encode($json);
    }

    function loadfiles()
    {
        $search = isset($_REQUEST['search']) ? functions::convertname($_REQUEST['search']) : '';
        $folder = (isset($_REQUEST['folder']) && $_REQUEST['folder'] != '') ? $_REQUEST['folder'] : 0;
        $json = $this->model->getFiles($folder,$search);
        echo json_encode($json);
    }

    function loadfolder()
    {
        $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $data = $this->model->getFolder($id);
        $json['name'] = $data[0]['name'];
        echo json_encode($json);
    }

    function loadfile()
    {
        $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $data = $this->model->getFile($id);
        $json = $data[0];
        if (file_exists(ROOT_DIR . $data[0]['link'] )) {
            $json['link'] = URLFILE . $data[0]['link'];
        } else {
            $json['link'] = $data[0]['link'];
        }
        echo json_encode($json);
    }

    function addfolder()
    {
        $parentId = $_REQUEST['parentId'];
        $title_folder = isset($_REQUEST['title_folder']) ? $_REQUEST['title_folder'] : '';
        $folder = str_replace('-', '', functions::convertname($title_folder));
        $rootdir = ROOT_DIR . '/uploads/vanban/';
        if ($parentId == 0) {
            $rootdir .= $folder;
        } else {
            $parentId1 = $parentId;
            $thumuc = array();
            $i = 1;
            do {
                $f = $this->model->getFolder($parentId1);
                $thumuc[$i] = $f[0]['folder'];
                $parentId1 = $f[0]['parentid'];
                $i++;
            } while ($parentId1 > 0);
            $temp = count($thumuc);
            for ($i = 0; $i < $temp; $i++)
                $rootdir .= $thumuc[$temp - $i] . '/';
        }
        $index = 0;
        do {
            if ($index > 0) {
                $folder1 = $folder . $index;
                if ($parentId == 0)
                    $rootdir1 = $rootdir . $index;
                else
                    $rootdir1 = $rootdir . $folder1;
                $title_folder1 = $title_folder . $index;
            } else {
                $folder1 = $folder;
                if ($parentId == 0)
                    $rootdir1 = $rootdir;
                else
                    $rootdir1 = $rootdir . $folder1;
                $title_folder1 = $title_folder;
            }
            $index++;
        } while (is_dir($rootdir1));
        $data = array(
            'name' => $title_folder1,
            'folder' => $folder1,
            'parentid' => $parentId,
            'create_date' => date('Y-m-d'),
            'tinh_trang' => 1
        );
        if (mkdir($rootdir1 . '/', 0755, true)) {
            $fid = $this->model->addFolder($data);
            if ($fid) {
                $jsonObj['fid'] = $parentId;
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Lỗi cập nhật database";
                $jsonObj['success'] = false;
            }
        } else {
            $jsonObj['msg'] = "Lỗi khi tạo thư mục" . $rootdir1;
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function updatefolder()
    {
        $id = $_REQUEST['id'];
        $title_folder = isset($_REQUEST['title_folder']) ? $_REQUEST['title_folder'] : '';
        $data = array(
            'create_date' => date('Y-m-d'),
            'name' => $title_folder
        );
        if($this->model->updateFolder($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        
        echo json_encode($jsonObj);
    }

    function delfolder()
    {
        $id = $_REQUEST['id'];
        $data = [
            'tinh_trang' => 0
        ];
        if($this->model->updateFolder($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        
        echo json_encode($jsonObj);
    }

    function delfile()
    {
        $id = $_REQUEST['id'];
        $data = [
            'tinh_trang' => 0
        ];
        if($this->model->updateFile($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        
        echo json_encode($jsonObj);
    }

    function uploadfiles()
    {
        $fid = $_REQUEST['fid'];
        $userid = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : (isset($_REQUEST['nhan_vien']) ? $_REQUEST['nhan_vien'] : 0);
        $link = '';
        $folders = $this->model->getFolderParent($fid);
        for ($i=count($folders);$i--;$i>=0){
            $link .= '/'.$folders[$i]['folder'];
        }

        $filename = $_FILES['file']['name'];
        $fname = explode('.',$filename);
        $file = '';
        // $icon = '';
        // $type = '';
        $size = 0;
        if ($filename != '') {
            // $type = $fname[1];
            $size = $_FILES['file']['size'];
            if (file_exists(ROOT_DIR . '/uploads/vanban/' . $link . '/' . $filename )) {
                $file = URLFILE . '/uploads/vanban/' . $link . '/' . $filename;
            } else {
                $dir = ROOT_DIR . '/uploads/vanban/' . $link . '/';
                $file = functions::uploadfile('file', $dir, $fname[0]);
                if ($file != '')
                    $file = URLFILE . '/uploads/vanban/' . $link . '/' . $file;
            }
            // if($fname[1] == 'doc' || $fname[1] == 'docx'){
            //     $icon = 'doc.png';
            // } else if($fname[1] == 'pdf') {
            //     $icon = 'pdf.png';
            // } else if($fname[1] == 'jpg') {
            //     $icon = 'jpg.png';
            // } else if($fname[1] == 'png') {
            //     $icon = 'jpg.png';
            // } else if($fname[1] == 'txt') {
            //     $icon = 'txt.png';
            // } else if($fname[1] == 'xls') {
            //     $icon = 'xls.png';
            // } else {
            //     $icon = 'unknown.png';
            // }
        }
        $data = [
            'ngay' => date('Y-m-d'),
            'folder' => $fid,
            'link' => $link.'/',
            'filename' => $filename,
            // 'icon' => $icon,
            // 'type' => $type,
            'size' => $size,
            'nhan_vien' => $userid,
            'tinh_trang' => 1
        ];
        if ($this->model->uploadFile($data)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function getfolderparent()
    {
        $folder = isset($_REQUEST['folder']) ? $_REQUEST['folder'] : 0;
        $data = $this->model->getFolderParent($folder);
        if($data){
            $jsonObj = array_reverse($data);
        }
        echo json_encode($jsonObj);
    }
}
?>