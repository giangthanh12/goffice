<?php
class classifyledger_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT * FROM classifyledger
         WHERE status > 0 ORDER BY id DESC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM classifyledger WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        if($id > 0) {
            $result = $this->update('classifyledger', $data, "id = $id");
        }
        else {
            $result = $this->insert('classifyledger', $data);
        }
        return $result;
    }

    function delObj($id,$data)
    {
        $query = $this->update("classifyledger",$data,"id = $id");
        
        return $query;
    }
}
?>