<?php
class Thongtincongty_model extends Model{
    function __construst(){
        parent::__construst();
    }


    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM thongtincongty WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("thongtincongty",$data,"id = $id");
        return $query;
    }

    function thayanh($file,$id){
        if ($file=='')
            return false;
        else {
            $data = ['logo'=>$file];
            $query = $this->update("thongtincongty", $data, " id=0 ");
            return $query;
        }
    }


    
}
?>