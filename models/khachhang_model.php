<?php
class Khachhang_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function listObj(){
        $nhanvien = $_SESSION['user']['staffId'];
        $query = $this->db->query("SELECT * FROM customers WHERE status > 0 AND staffInCharge = $nhanvien AND classify IN (1,3) ORDER BY id DESC ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function get_data_combo(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS text FROM customers WHERE status > 0 ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addObj($data)
    {
        $query = $this->insert("customers",$data);
        return $query;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM customers WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function loaddichvu($id) {
        $result['data'] = array();
        $query = $this->db->query("SELECT *,
            (SELECT name FROM dichvu WHERE id = a.dich_vu) as dich_vu,
            DATE_FORMAT(ngay_bd,'%d/%m/%Y') as ngay_bd,
            DATE_FORMAT(ngay_kt,'%d/%m/%Y') as ngay_kt
            FROM donhang a WHERE khach_hang = $id AND tinh_trang > 0");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if($temp)
            $result['data'] = $temp;
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("customers",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("customers",$data,"id = $id");
        return $query;
    }

    function checkdt($dienthoai)
    {
        if ($dienthoai != '') {
            $dieukien = " WHERE status > 0 AND phoneNumber='$dienthoai'";
            $query = $this->db->query("SELECT COUNT(id) AS total FROM customers $dieukien ");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($row[0]['total'] > 0)
                return false;
            else {
                $query = $this->db->query("SELECT COUNT(id) AS total FROM data WHERE tinh_trang > 0 AND dien_thoai = '$dienthoai' ");
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                if ($row[0]['total'] > 0) {
                    return false;
                }
                return true;
            }
        } else
            return true;
    }

    function checkeditdt($dienthoai,$id)
    {
        if ($dienthoai != '') {
            $dieukien = " WHERE status > 0 AND id != $id AND phoneNumber='$dienthoai'";
            $query = $this->db->query("SELECT COUNT(id) AS total FROM customers $dieukien ");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($row[0]['total'] > 0)
                return false;
            else {
                $query = $this->db->query("SELECT COUNT(id) AS total FROM customers $dieukien ");
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                if ($row[0]['total'] > 0) {
                    return false;
                }
                return true;
            }
        } else
            return true;
    }
}
?>