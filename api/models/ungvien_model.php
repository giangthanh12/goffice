<?php
class Ungvien_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_data_combo()
    {
        $result = array();
        $query = $this->db->query("SELECT id,ten_day_du AS text FROM ungvien WHERE tinh_trang > 0 ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function thanhpho(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM thanhpho WHERE tinh_trang=1");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function listObj(){
        $ungvien = array();
        $query = $this->db->query("SELECT *,
            IF(hinh_anh='','".URLFILE."/uploads/useravatar.png',hinh_anh) AS hinh_anh,
            DATE_FORMAT(ngay_sinh,'%d/%m/%Y') as ngay_sinh
            FROM ungvien WHERE tinh_trang > 0 ORDER BY id DESC ");
        if ($query)
            $ungvien['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $ungvien;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT *,
            DATE_FORMAT(ngay_sinh,'%d/%m/%Y') AS ngay_sinh,
            IF(hinh_anh='','".URLFILE."/uploads/useravatar.png',hinh_anh) AS hinh_anh
            FROM ungvien WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($data,$id){
        $query = $this->update("ungvien", $data, " id=$id ");
        return $query;
    }

    function thayanh($file,$id){
        if ($file=='')
            return false;
        else {
            $data = ['hinh_anh'=>$file];
            $query = $this->update("ungvien", $data, " id=$id ");
            return $query;
        }
    }

    function addObj($data){
        $query = $this->insert("ungvien", $data);
        return $query;
    }

    function delObj($id){
        $query = $this->update("ungvien", ['tinh_trang'=>0], " id=$id ");
        return $query;
    }

    // Thông tin gia đình
    function getMembers($id)
    {
        $result = array();
        $query = $this->db->query("SELECT *
            FROM thongtinuv WHERE ung_vien = $id AND tinh_trang = 1");
        if ($query)
            $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getMember($id){
        $result = array();
        $query = $this->db->query("SELECT *
            FROM thongtinuv WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function addMember($data){
        $query = $this->insert("thongtinuv", $data);
        return $query;
    }

    function updateMember($data,$id){
        $query = $this->update("thongtinuv", $data, "id=$id");
        return $query;
    }

    function delMember($id){
        $query = $this->update("thongtinuv", ['tinh_trang'=>0], " id=$id ");
        return $query;
    }

    // Thông tin học vấn
    function getListHV($id)
    {
        $result = array();
        $query = $this->db->query("SELECT *,
            DATE_FORMAT(ngay_bat_dau,'%d/%m/%Y') as ngay_bat_dau,
            DATE_FORMAT(ngay_ket_thuc,'%d/%m/%Y') as ngay_ket_thuc
            FROM hocvanuv WHERE ung_vien = $id AND tinh_trang = 1");
        if ($query)
            $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getHV($id){
        $result = array();
        $query = $this->db->query("SELECT *
            FROM hocvanuv WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function addHV($data){
        $query = $this->insert("hocvanuv", $data);
        return $query;
    }

    function updateHV($data,$id){
        $query = $this->update("hocvanuv", $data, "id=$id");
        return $query;
    }

    function delHV($id){
        $query = $this->update("hocvanuv", ['tinh_trang'=>0], " id=$id ");
        return $query;
    }

    // Thông tin kinh nghiệm
    function getListKN($id)
    {
        $result = array();
        $query = $this->db->query("SELECT *,
            DATE_FORMAT(ngay_bat_dau,'%d/%m/%Y') as ngay_bat_dau,
            DATE_FORMAT(ngay_ket_thuc,'%d/%m/%Y') as ngay_ket_thuc
            FROM kinhnghiemuv WHERE ung_vien = $id AND tinh_trang = 1");
        if ($query)
            $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getKN($id){
        $result = array();
        $query = $this->db->query("SELECT *
            FROM kinhnghiemuv WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function addKN($data){
        $query = $this->insert("kinhnghiemuv", $data);
        return $query;
    }

    function updateKN($data,$id){
        $query = $this->update("kinhnghiemuv", $data, "id=$id");
        return $query;
    }

    function delKN($id){
        $query = $this->update("kinhnghiemuv", ['tinh_trang'=>0], " id=$id ");
        return $query;
    }
}
?>
