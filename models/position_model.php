<?php
class position_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_data_combo($phongban){
        $result = array();
        $dieukien = " WHERE status > 0 ";
        if($phongban != 0){
            $dieukien .= " AND department = $phongban ";
        }
        $query = $this->db->query("SELECT id, name AS text FROM position $dieukien ORDER BY id DESC");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function listObj(){
        $query = $this->db->query("SELECT *
            FROM position a WHERE status > 0 ORDER BY id DESC ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addObj($data)
    {
        $query = $this->insert("position",$data);
        return $query;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT *
                FROM position WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("position",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("position",$data,"id = $id");
        return $query;
    }

}
?>