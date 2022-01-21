<?php
class asset_issue_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(ngay_gio,'%d-%m-%Y') AS ngay_gio,
        IFNULL((SELECT name FROM taisan WHERE tai_san = taisan.id  ), 'No Name') AS nameAsset,
        (SELECT code FROM taisan WHERE tai_san = taisan.id  ) AS code,
        IFNULL((SELECT name FROM staffs WHERE nhan_vien = staffs.id ), 'No Name') AS nameStaff 
        FROM taisan_capphat WHERE tinh_trang > 0 order by id desc");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(ngay_gio,'%d-%m-%Y') AS ngay_gio FROM taisan_capphat WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }
    function getAsset(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM taisan");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getAllAsset(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM taisan");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getStaff(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM staffs");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>