<?php

class Ungvien extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function combo() 
    {
        $jsonObj = $this->model->get_data_combo();
        echo json_encode($jsonObj);
    }

    function thanhpho() {
        $data = $this->model->thanhpho();
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
        $gioi_tinh = isset($_REQUEST["gioi_tinh"]) ? $_REQUEST["gioi_tinh"] : 0;
        $tt_hon_nhan = isset($_REQUEST["tt_hon_nhan"]) ? $_REQUEST["tt_hon_nhan"] : 0;
        $ten_day_du = isset($_REQUEST["ten_day_du"]) ? $_REQUEST["ten_day_du"] : '';
        $quoc_tich = isset($_REQUEST["quoc_tich"]) ? $_REQUEST["quoc_tich"] : '';
        $dan_toc = isset($_REQUEST["dan_toc"]) ? $_REQUEST["dan_toc"] : '';
        $ton_giao = isset($_REQUEST["ton_giao"]) ? $_REQUEST["ton_giao"] : '';
        $ngay_sinh = isset($_REQUEST["ngay_sinh"]) ? $_REQUEST["ngay_sinh"] : '';
        $noi_sinh = isset($_REQUEST["noi_sinh"]) ? $_REQUEST["noi_sinh"] : 0;
        $nguyen_quan = isset($_REQUEST["nguyen_quan"]) ? $_REQUEST["nguyen_quan"] : 0;
        $luong_chinh_thuc = isset($_REQUEST["luong_chinh_thuc"]) ? $_REQUEST["luong_chinh_thuc"] : 0;
        $luong_thu_viec = isset($_REQUEST["luong_thu_viec"]) ? $_REQUEST["luong_thu_viec"] : 0;
        $ghi_chu = isset($_REQUEST["ghi_chu"]) ? $_REQUEST["ghi_chu"] : '';
        $nguon = isset($_REQUEST["nguon"]) ? $_REQUEST["nguon"] : 0;
        $chien_dich = isset($_REQUEST["chien_dich"]) ? $_REQUEST["chien_dich"] : 0;
        $cmnd = isset($_REQUEST["cmnd"]) ? $_REQUEST["cmnd"] : '';
        $ngay_cap = isset($_REQUEST["ngay_cap"]) ? $_REQUEST["ngay_cap"] : '';
        $noi_cap = isset($_REQUEST["noi_cap"]) ? $_REQUEST["noi_cap"] : 0;
        $thuong_tru = isset($_REQUEST["thuong_tru"]) ? $_REQUEST["thuong_tru"] : '';
        $cho_o_hien_nay = isset($_REQUEST["cho_o_hien_nay"]) ? $_REQUEST["cho_o_hien_nay"] : '';
        $dien_thoai = isset($_REQUEST["dien_thoai"]) ? $_REQUEST["dien_thoai"] : '';
        $email = isset($_REQUEST["email"]) ? $_REQUEST["email"] : '';
        $data = [
            'gioi_tinh' => $gioi_tinh,
            'tt_hon_nhan' => $tt_hon_nhan,
            'ten_day_du' => $ten_day_du,
            'quoc_tich' => $quoc_tich,
            'dan_toc' => $dan_toc,
            'ton_giao' => $ton_giao,
            'ngay_sinh' => $ngay_sinh,
            'noi_sinh' => $noi_sinh,
            'nguyen_quan' => $nguyen_quan,
            'luong_chinh_thuc' => $luong_chinh_thuc,
            'luong_thu_viec' => $luong_thu_viec,
            'ghi_chu' => $ghi_chu,
            'nguon' => $nguon,
            'chien_dich' => $chien_dich,
            'cmnd' => $cmnd,
            'ngay_cap' => $ngay_cap,
            'noi_cap' => $noi_cap,
            'thuong_tru' => $thuong_tru,
            'cho_o_hien_nay' => $cho_o_hien_nay,
            'dien_thoai' => $dien_thoai,
            'email' => $email
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
        $tendaydu = isset($_REQUEST['ten_day_du']) ? $_REQUEST['ten_day_du'] : '';
        $dienthoai = isset($_REQUEST['dien_thoai']) ? $_REQUEST['dien_thoai'] : '';
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $vitri = isset($_REQUEST['vi_tri']) ? $_REQUEST['vi_tri'] : '';
        $ghichu = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';
        $gioitinh = isset($_REQUEST['gioi_tinh']) ? $_REQUEST['gioi_tinh'] : 0;
        $ngaysinh = isset($_REQUEST['ngay_sinh']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_sinh']))) : '';
        $tinhtrang = 1;
        $data = [
            'ten_day_du' => $tendaydu,
            'dien_thoai' => $dienthoai,
            'email' => $email,
            'vi_tri' => $vitri,
            'gioi_tinh' => $gioitinh,
            'ngay_sinh' => $ngaysinh,
            'ghi_chu' => $ghichu,
            'tinh_trang' => $tinhtrang
        ];
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
