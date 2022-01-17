<?php
class vitri_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_data_combo($phongban){
        $result = array();
        $dieukien = " WHERE tinh_trang > 0 ";
        if($phongban != 0){
            $dieukien .= " AND phong_ban = $phongban ";
        }
        $query = $this->db->query("SELECT id, name AS text FROM vitri $dieukien");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function listObj(){
        $query = $this->db->query("SELECT *,
            (SELECT name FROM phongban WHERE id = a.phong_ban) AS phongban
            FROM vitri a WHERE tinh_trang > 0 ORDER BY id DESC ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addObj($data)
    {
        $query = $this->insert("vitri",$data);
        return $query;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT *
                FROM vitri WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("vitri",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("vitri",$data,"id = $id");
        return $query;
    }

}
?>