<?php
class Banggiadichvu_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT * ,FORMAT(so_tien,0) AS so_tien,
        IFNULL((SELECT name FROM dichvu WHERE dich_vu = dichvu.id AND tinh_trang > 0), '-') AS dich_vu 
         FROM banggia_dichvu WHERE tinh_trang > 0");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function addObj($data)
    {
        $data['so_tien'] = str_replace( ',', '', $data['so_tien']);
        $query = $this->insert("banggia_dichvu",$data);
        return $query;
    }

   

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM banggia_dichvu WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }


    function updateObj($id, $data)
    {
        $data['so_tien'] = str_replace( ',', '', $data['so_tien']);
        $query = $this->update("banggia_dichvu",$data,"id = $id");
        return $query;
    }


    function delObj($id,$data)
    {
        $query = $this->update("banggia_dichvu",$data,"id = $id");
        return $query;
    }
  

    function dichvu(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM dichvu");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    
}
?>