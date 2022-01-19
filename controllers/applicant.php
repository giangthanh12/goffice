<?php

class applicant extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("applicant/index");
        require "layouts/footer.php";
    }

    function getProvince() {
        $data = $this->model->getProvince();
        echo json_encode($data);
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }

    function loaddata()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }
    function update()
    {
        $id = $_REQUEST['id'];
        $filename = $_FILES['file1']['name'];
        $fname = explode('.',$filename);
        
        $file = '';
        if ($filename != '') {
            $dir = ROOT_DIR . '/uploads/ungvien/';
            $file = functions::uploadfile('file1', $dir, $fname[0]);
            if ($file != '')
                $file = 'uploads/ungvien/' . $file;
        }
        $gender1 = isset($_REQUEST["gender1"]) ? $_REQUEST["gender1"] : 0;
        $maritalStatus = isset($_REQUEST["tthonnhan"]) ? $_REQUEST["tthonnhan"] : 0;
        $fullName = isset($_REQUEST["hoten"]) ? $_REQUEST["hoten"] : '';
        $nationality = isset($_REQUEST["quoctich"]) ? $_REQUEST["quoctich"] : '';
        $ngaysinh = isset($_REQUEST["ngaysinh"]) ? date('Y-m-d',strtotime($_REQUEST["ngaysinh"])) : '';
        $noisinh = isset($_REQUEST["noisinh"]) ? $_REQUEST["noisinh"] : '';
        $residence = isset($_REQUEST["residence"]) ? $_REQUEST["residence"] : '';
        $salary = isset($_REQUEST["salary"]) ? $_REQUEST["salary"] : 0;
        $source = isset($_REQUEST["nguon"]) ? $_REQUEST["nguon"] : 0;
        $introduce = isset($_REQUEST["introduce"]) ? $_REQUEST["introduce"] : 0;
        $position = isset($_REQUEST["position1"]) ? $_REQUEST["position1"] : 0;
        $note = isset($_REQUEST["note1"]) ? $_REQUEST["note1"] : '';
        $idNumber = isset($_REQUEST["idNumber"]) ? $_REQUEST["idNumber"] : 0;
        $idDate = isset($_REQUEST["idDate"]) ? date('Y-m-d',strtotime($_REQUEST["idDate"])) : 0;
        $idPlace = isset($_REQUEST["idPlace"]) ? $_REQUEST["idPlace"] : '';
        $address = isset($_REQUEST["address"]) ? $_REQUEST["address"] : '';
        $email = isset($_REQUEST["e_mail"]) ? $_REQUEST["e_mail"] : '';
        $phoneNumber = isset($_REQUEST["phoneNumber1"]) ? $_REQUEST["phoneNumber1"] : '';
        $data = [
            'gender' => $gender1,
            'maritalStatus' => $maritalStatus,
            'fullName' => $fullName,
            'nationality' => $nationality,
            'dob' => $ngaysinh,
            'pob' => $noisinh,
            'residence' => $residence,
            'salary' => $salary,
            'note' => $note,
            'introduce'=>$introduce,
            'position' => $position,
            'source' => $source,
            'idNumber' => $idNumber,
            'idDate' => $idDate,
            'idPlace' => $idPlace,
            'address' => $address,
            'phoneNumber' => $phoneNumber,
            'email' => $email,
            'cv'=>$file
        ];
      
        if ($this->model->updateObj($data,$id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    // for(){
    //     $id =$item['id'];
    //     if(isset($_REQUEST['ten_day_du_'.$id])){

    //     } else {
            
    //     } 
    //     $new = $_REQUEST['new'];
    //     for($i = 1; $i <= $new; $i++ ){
    //         ten_day_dau_a1
    //         ten_day_dau_a2
    //         ten_day_dau_a3
    //         if(isset($_REQUEST['ten_day_du_a'.$i])){

    //         }
    //     }
    // }

    function thayanh()
    {
        $id = $_REQUEST['myid'];
        $filename = $_FILES['hinhanh']['name'];
        $hinhanh = '';
        if ($filename!='') {
            $dir = ROOT_DIR . '/uploads/ungvien/';
            $file = functions::uploadfile('hinhanh', $dir, $id);
            if ($file!='')
                $hinhanh = URLFILE.'/uploads/ungvien/'.$file;
        }
        if ($this->model->thayanh($hinhanh,$id)) {
            $jsonObj['filename'] = $hinhanh;
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công".$file;
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function add()
    {
        $fullName = isset($_REQUEST['fullName']) ? $_REQUEST['fullName'] : '';
        $gender = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : '';
        $dob = isset($_REQUEST['dob']) ? date('Y-m-d',strtotime($_REQUEST['dob'])) : '';
        $phoneNumber = isset($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : '';
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $position = isset($_REQUEST['position']) ? $_REQUEST['position'] : '';
        $note = isset($_REQUEST['note']) ? $_REQUEST['note'] : '';
        $tinhtrang = 1;
        $data = [
            'fullName' => $fullName,
            'phoneNumber' => $phoneNumber,
            'email' => $email,
            'gender' => $gender,
            'dob' => $dob,
            'position' => $position,
            'note'=>$note,
            'status' => $tinhtrang ];
        if ($this->model->addObj($data)) {
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
        if ($this->model->delObj($id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi xóa dữ liệu".$id;
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    // Thông tin gia đình
    function loadmembers()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getMembers($id);
        echo json_encode($json);
    }

    function loadmember()
    {
        $id = $_REQUEST['id'];
        $json = $this->model->getMember($id);
        echo json_encode($json);
    }

    function addmember()
    {
        $ungvien = $_REQUEST['ung_vien'];
        $tendaydu = isset($_REQUEST['ten_day_du']) ? $_REQUEST['ten_day_du'] : '';
        $ngaysinh = isset($_REQUEST['ngay_sinh']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_sinh']))) : '';
        $nghenghiep = isset($_REQUEST['nghe_nghiep']) ? $_REQUEST['nghe_nghiep'] : '';
        $dienthoai = isset($_REQUEST['dien_thoai']) ? $_REQUEST['dien_thoai'] : '';
        $diachi = isset($_REQUEST['dia_chi']) ? $_REQUEST['dia_chi'] : '';
        $moiquanhe = isset($_REQUEST['moi_quan_he']) ? $_REQUEST['moi_quan_he'] : '';
        $tinhtrang = 1;
        $data = [
            'ung_vien' => $ungvien,
            'ten_day_du' => $tendaydu,
            'ngay_sinh' => $ngaysinh,
            'nghe_nghiep' => $nghenghiep,
            'dien_thoai' => $dienthoai,
            'dia_chi' => $diachi,
            'moi_quan_he' => $moiquanhe,
            'tinh_trang' => $tinhtrang
        ];
        if ($this->model->addMember($data)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function updatemember()
    {
        $id = $_REQUEST['id'];
        $tendaydu = isset($_REQUEST['ten_day_du']) ? $_REQUEST['ten_day_du'] : '';
        $ngaysinh = isset($_REQUEST['ngay_sinh']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_sinh']))) : '';
        $nghenghiep = isset($_REQUEST['nghe_nghiep']) ? $_REQUEST['nghe_nghiep'] : '';
        $dienthoai = isset($_REQUEST['dien_thoai']) ? $_REQUEST['dien_thoai'] : '';
        $diachi = isset($_REQUEST['dia_chi']) ? $_REQUEST['dia_chi'] : '';
        $moiquanhe = isset($_REQUEST['moi_quan_he']) ? $_REQUEST['moi_quan_he'] : '';
        $data = [
            'ten_day_du' => $tendaydu,
            'ngay_sinh' => $ngaysinh,
            'nghe_nghiep' => $nghenghiep,
            'dien_thoai' => $dienthoai,
            'dia_chi' => $diachi,
            'moi_quan_he' => $moiquanhe
        ];
        if ($this->model->updateMember($data,$id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function delmember()
    {
        $id = $_REQUEST['id'];
        if ($this->model->delMember($id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi xóa dữ liệu".$id;
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    // Thông tin học vấn
    function loadlisthv()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getListHV($id);
        echo json_encode($json);
    }

    function loadhv()
    {
        $id = $_REQUEST['id'];
        $json = $this->model->getHV($id);
        echo json_encode($json);
    }

    function addhv()
    {
        $ungvien = $_REQUEST['ung_vien'];
        $ngaybatdau = isset($_REQUEST['ngay_bat_dau']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_bat_dau']))) : '';
        $ngayketthuc = isset($_REQUEST['ngay_ket_thuc']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_ket_thuc']))) : '';
        $noidaotao = isset($_REQUEST['noi_dao_tao']) ? $_REQUEST['noi_dao_tao'] : '';
        $chuyennganh = isset($_REQUEST['chuyen_nganh']) ? $_REQUEST['chuyen_nganh'] : '';
        $hinhthuc = isset($_REQUEST['hinh_thuc']) ? $_REQUEST['hinh_thuc'] : '';
        $bangcap = isset($_REQUEST['bang_cap']) ? $_REQUEST['bang_cap'] : '';
        $tinhtrang = 1;
        $data = [
            'ung_vien' => $ungvien,
            'ngay_bat_dau' => $ngaybatdau,
            'ngay_ket_thuc' => $ngayketthuc,
            'noi_dao_tao' => $noidaotao,
            'chuyen_nganh' => $chuyennganh,
            'hinh_thuc' => $hinhthuc,
            'bang_cap' => $bangcap,
            'tinh_trang' => $tinhtrang
        ];
        if ($this->model->addHV($data)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function updatehv()
    {
        $id = $_REQUEST['id'];
        $ngaybatdau = isset($_REQUEST['ngay_bat_dau']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_bat_dau']))) : '';
        $ngayketthuc = isset($_REQUEST['ngay_ket_thuc']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_ket_thuc']))) : '';
        $noidaotao = isset($_REQUEST['noi_dao_tao']) ? $_REQUEST['noi_dao_tao'] : '';
        $chuyennganh = isset($_REQUEST['chuyen_nganh']) ? $_REQUEST['chuyen_nganh'] : '';
        $hinhthuc = isset($_REQUEST['hinh_thuc']) ? $_REQUEST['hinh_thuc'] : '';
        $bangcap = isset($_REQUEST['bang_cap']) ? $_REQUEST['bang_cap'] : '';
        $data = [
            'ngay_bat_dau' => $ngaybatdau,
            'ngay_ket_thuc' => $ngayketthuc,
            'noi_dao_tao' => $noidaotao,
            'chuyen_nganh' => $chuyennganh,
            'hinh_thuc' => $hinhthuc,
            'bang_cap' => $bangcap,
        ];
        if ($this->model->updateHV($data,$id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function delhv()
    {
        $id = $_REQUEST['id'];
        if ($this->model->delHV($id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi xóa dữ liệu".$id;
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    // Thông tin kinh nghiệm
    function loadlistkn()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getListKN($id);
        echo json_encode($json);
    }

    function loadkn()
    {
        $id = $_REQUEST['id'];
        $json = $this->model->getKN($id);
        echo json_encode($json);
    }

    function addkn()
    {
        $ungvien = $_REQUEST['ung_vien'];
        $ngaybatdau = isset($_REQUEST['ngay_bat_dau']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_bat_dau']))) : '';
        $ngayketthuc = isset($_REQUEST['ngay_ket_thuc']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_ket_thuc']))) : '';
        $congty = isset($_REQUEST['cong_ty']) ? $_REQUEST['cong_ty'] : '';
        $vitri = isset($_REQUEST['vi_tri']) ? $_REQUEST['vi_tri'] : '';
        $nguoithamchieu = isset($_REQUEST['nguoi_tham_chieu']) ? $_REQUEST['nguoi_tham_chieu'] : '';
        $dienthoai = isset($_REQUEST['dien_thoai']) ? $_REQUEST['dien_thoai'] : '';
        $ghichu = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';
        $duan = isset($_REQUEST['du_an']) ? $_REQUEST['du_an'] : '';
        $tinhtrang = 1;
        $data = [
            'ung_vien' => $ungvien,
            'ngay_bat_dau' => $ngaybatdau,
            'ngay_ket_thuc' => $ngayketthuc,
            'cong_ty' => $congty,
            'vi_tri' => $vitri,
            'nguoi_tham_chieu' => $nguoithamchieu,
            'dien_thoai' => $dienthoai,
            'ghi_chu' => $ghichu,
            'du_an' => $duan,
            'tinh_trang' => $tinhtrang
        ];
        if ($this->model->addKN($data)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function updatekn()
    {
        $id = $_REQUEST['id'];
        $ngaybatdau = isset($_REQUEST['ngay_bat_dau']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_bat_dau']))) : '';
        $ngayketthuc = isset($_REQUEST['ngay_ket_thuc']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_ket_thuc']))) : '';
        $congty = isset($_REQUEST['cong_ty']) ? $_REQUEST['cong_ty'] : '';
        $vitri = isset($_REQUEST['vi_tri']) ? $_REQUEST['vi_tri'] : '';
        $nguoithamchieu = isset($_REQUEST['nguoi_tham_chieu']) ? $_REQUEST['nguoi_tham_chieu'] : '';
        $dienthoai = isset($_REQUEST['dien_thoai']) ? $_REQUEST['dien_thoai'] : '';
        $ghichu = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';
        $duan = isset($_REQUEST['du_an']) ? $_REQUEST['du_an'] : '';
        $data = [
            'ngay_bat_dau' => $ngaybatdau,
            'ngay_ket_thuc' => $ngayketthuc,
            'cong_ty' => $congty,
            'vi_tri' => $vitri,
            'nguoi_tham_chieu' => $nguoithamchieu,
            'dien_thoai' => $dienthoai,
            'ghi_chu' => $ghichu,
            'du_an' => $duan
        ];
        if ($this->model->updateKN($data,$id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function delkn()
    {
        $id = $_REQUEST['id'];
        if ($this->model->delKN($id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi xóa dữ liệu".$id;
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

}

?>
