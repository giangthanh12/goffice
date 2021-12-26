<?php
class Doitac_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT * FROM khachhang WHERE tinh_trang > 0 AND phan_loai IN (2,3) ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // function get_data_combo(){
    //     $result = array();
    //     $query = $this->db->query("SELECT id, name AS text FROM khachhang");
    //     $result['items'] = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }

    function addObj($data)
    {
        $query = $this->insert("khachhang",$data);
        return $query;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM khachhang WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("khachhang",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("khachhang",$data,"id = $id");
        return $query;
    }

    
}
?>