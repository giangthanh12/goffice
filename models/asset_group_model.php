<?php
class asset_group_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT * FROM taisan_nhom WHERE tinh_trang > 0");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function addObj($data)
    {
        $query = $this->insert("taisan_nhom",$data);
        return $query;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM taisan_nhom WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("taisan_nhom",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("taisan_nhom",$data,"id = $id");
        return $query;
    }

    
}
?>