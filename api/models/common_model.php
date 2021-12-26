<?php
class Common_Model extends Model {
    function __construct(){
        parent::__construct();
    }

    function thanhpho(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM thanhpho WHERE tinh_trang=1");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function linhvuc()
    {
        $result = array();
        $dieukien = " WHERE tinh_trang = 1";
        $query = $this->db->query("SELECT id, name AS text FROM linhvuc $dieukien ");
        if($query){
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    function nhanvien()
    {
        $result = array();
        $query = $this->db->query("SELECT id, name AS text, dien_thoai FROM nhanvien WHERE tinh_trang IN (1,2,3,4) ");
        if($query){
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    function loaikh()
    {
        $temp = array();
        $query = $this->db->query("SELECT id, name AS text FROM loaikh WHERE tinh_trang = 1 ");
        if($query){
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $temp;
    }

    function tinhtrangdata()
    {
        $temp = array();
        $query = $this->db->query("SELECT id, name AS text FROM tinhtrangdata WHERE tinh_trang = 1 ");
        if($query){
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $temp;
    }

    function phanloaidata()
    {
        $temp = array();
        $query = $this->db->query("SELECT id, name AS text FROM phanloaidata WHERE tinh_trang = 1 ");
        if($query){
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $temp;
    }
    
    function mangdata()
    {
        $temp = array();
        $query = $this->db->query("SELECT id, name AS text FROM mangdata WHERE tinh_trang = 1 ");
        if($query){
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $temp;
    }

    function tinhtranglienhe()
    {
        $temp = array();
        $query = $this->db->query("SELECT id, name AS text FROM tinhtranglienhe WHERE tinh_trang = 1 ");
        if($query){
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $temp;
    }

    function tinhtrangkh()
    {
        $temp = array();
        $query = $this->db->query("SELECT id, name AS text FROM tinhtrangkh WHERE tinh_trang = 1 ");
        if($query){
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $temp;
    }

    function nhacungcap()
    {
        $temp = array();
        $query = $this->db->query("SELECT id, name AS text FROM nhacungcap WHERE tinh_trang = 1 ");
        if($query){
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $temp;
    }
}

?>