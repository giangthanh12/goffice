<?php
class accountsettings_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getData($id)
    {
        $result = array();
        $query = $this->db->query("SELECT email as username,nhan_vien,
            (SELECT hinh_anh FROM nhanvien WHERE id = a.nhan_vien) as hinh_anh,
            (SELECT name FROM nhanvien WHERE id = a.nhan_vien) as name,
            (SELECT email FROM nhanvien WHERE id = a.nhan_vien) as email,
            (SELECT dien_thoai FROM nhanvien WHERE id = a.nhan_vien) as dien_thoai,
            (SELECT DATE_FORMAT(ngay_sinh,'%d/%m/%Y') AS ngay_sinh FROM nhanvien WHERE id = a.nhan_vien) as ngay_sinh,
            (SELECT cmnd FROM nhanvien WHERE id = a.nhan_vien) as cmnd,
            (SELECT DATE_FORMAT(ngay_cap,'%d/%m/%Y') AS ngay_cap FROM nhanvien WHERE id = a.nhan_vien) as ngay_cap,
            (SELECT noi_cap FROM nhanvien WHERE id = a.nhan_vien) as noi_cap,
            (SELECT que_quan FROM nhanvien WHERE id = a.nhan_vien) as que_quan,
            (SELECT dia_chi FROM nhanvien WHERE id = a.nhan_vien) as dia_chi,
            (SELECT ghi_chu FROM nhanvien WHERE id = a.nhan_vien) as ghi_chu,
            (SELECT twitter FROM nhanvien_info WHERE nhanvien_id = a.nhan_vien) as twitter,
            (SELECT facebook FROM nhanvien_info WHERE nhanvien_id = a.nhan_vien) as facebook,
            (SELECT instagram FROM nhanvien_info WHERE nhanvien_id = a.nhan_vien) as instagram,
            (SELECT zalo FROM nhanvien_info WHERE nhanvien_id = a.nhan_vien) as zalo,
            (SELECT wechat FROM nhanvien_info WHERE nhanvien_id = a.nhan_vien) as wechat,
            (SELECT linkein FROM nhanvien_info WHERE nhanvien_id = a.nhan_vien) as linkedin
            FROM users a WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->db->query("SELECT nhan_vien FROM users WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp)
            $id = $temp[0]['nhan_vien'];
        $query = $this->update("nhanvien", $data, "id=$id");
        return $query;
    }

    function updateSocial($id, $data)
    {
        $query = $this->db->query("SELECT nhan_vien FROM users WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp)
            $uid = $temp[0]['nhan_vien'];
        $query = $this->db->query("SELECT id FROM nhanvien_info WHERE nhanvien_id = $uid");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp){
            $id = $temp[0]['id'];
            $query = $this->update("nhanvien_info", $data, "id=$id");
        } else {
            $data['nhanvien_id'] = $uid;
            $query = $this->insert("nhanvien_info", $data);
        }
        return $query;
    }

    function thayanh($file, $id)
    {
        if ($file == '')
            return false;
        else {
            $query = $this->db->query("SELECT nhan_vien FROM users a WHERE id = $id");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($temp)
                $id = $temp[0]['nhan_vien'];
            $data = ['hinh_anh' => $file];
            $query = $this->db->query("SELECT * FROM nhanvien WHERE id = $id");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($temp){
                $query = $this->update("nhanvien", $data, " id=$id ");
            } else {
                $query = $this->insert("nhanvien", $data);
            }
            return $query;
        }
    }

    function getPass($id){
        $query = $this->db->query("SELECT mat_khau FROM users WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp)
            $id = $temp[0]['mat_khau'];
        return $id;
    }

    function changePass($id, $data){
        $query = $this->update("users", $data, "id=$id");
        return $query;
    }
}
