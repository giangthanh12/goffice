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
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(birthday,'%d/%m/%Y') AS ngaysinh,
        DATE_FORMAT(idDate,'%d/%m/%Y') AS ngaycap
        FROM staffs WHERE id=$id");
//        $query = $this->db->query("SELECT username,staffId,
//            (SELECT hinh_anh FROM nhanvien WHERE id = a.nhan_vien) as hinh_anh,
//            (SELECT name FROM nhanvien WHERE id = a.nhan_vien) as name,
//            (SELECT email FROM nhanvien WHERE id = a.nhan_vien) as email,
//            (SELECT dien_thoai FROM nhanvien WHERE id = a.nhan_vien) as dien_thoai,
//            (SELECT DATE_FORMAT(ngay_sinh,'%d/%m/%Y') AS ngay_sinh FROM nhanvien WHERE id = a.nhan_vien) as ngay_sinh,
//            (SELECT cmnd FROM nhanvien WHERE id = a.nhan_vien) as cmnd,
//            (SELECT DATE_FORMAT(ngay_cap,'%d/%m/%Y') AS ngay_cap FROM nhanvien WHERE id = a.nhan_vien) as ngay_cap,
//            (SELECT noi_cap FROM nhanvien WHERE id = a.nhan_vien) as noi_cap,
//            (SELECT que_quan FROM nhanvien WHERE id = a.nhan_vien) as que_quan,
//            (SELECT dia_chi FROM nhanvien WHERE id = a.nhan_vien) as dia_chi,
//            (SELECT ghi_chu FROM nhanvien WHERE id = a.nhan_vien) as ghi_chu,
//            (SELECT twitter FROM staffinfo WHERE nhanvien_id = a.nhan_vien) as twitter,
//            (SELECT facebook FROM staffinfo WHERE nhanvien_id = a.nhan_vien) as facebook,
//            (SELECT instagram FROM staffinfo WHERE nhanvien_id = a.nhan_vien) as instagram,
//            (SELECT zalo FROM staffinfo WHERE nhanvien_id = a.nhan_vien) as zalo,
//            (SELECT wechat FROM staffinfo WHERE nhanvien_id = a.nhan_vien) as wechat,
//            (SELECT linkein FROM staffinfo WHERE nhanvien_id = a.nhan_vien) as linkedin
//            FROM users a WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result['staffInfo'] = $temp[0];
        $query = $this->db->query("SELECT * FROM staffinfo WHERE staffId=$id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($temp[0]))
            $result['social'] = $temp[0];
        else
            $result['social'] = [];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("staffs", $data, "id=$id");
        return $query;
    }

    function updateSocial($id, $data)
    {
        $query = $this->db->query("SELECT id FROM staffinfo WHERE staffId = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp) {
            $idinfo = $temp[0]['id'];
            $query = $this->update("staffinfo", $data, "id=$idinfo");
        } else {
            $data['staffId'] = $id;
            $query = $this->insert("staffinfo", $data);
        }
        return $query;
    }

    function thayanh($file, $id)
    {
        if ($file == '')
            return false;
        else {
            $data = ['avatar' => $file];
            $query = $this->db->query("SELECT * FROM staffs WHERE id = $id");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($temp) {
                $query = $this->update("staffs", $data, " id=$id ");
            } else {
                $query = $this->insert("staffs", $data);
            }
            return $query;
        }
    }

    function getPass($id)
    {
        $query = $this->db->query("SELECT password FROM users WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp)
            $id = $temp[0]['password'];
        return $id;
    }

    function changePass($id, $data)
    {
        $query = $this->update("users", $data, "id=$id");
        return $query;
    }
}
