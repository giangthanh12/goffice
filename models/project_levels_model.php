<?php
class project_levels_Model extends Model{
    function __construst(){
        parent::__construst();
    }
    function listObj() {
        $condition = " WHERE status > 0 ";
        $query = $this->db->query("SELECT * FROM projectlevels $condition ORDER BY id DESC");
            if($query) {
                $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }        
    }
    
    function addObj($data) {
     
       $result = $this->insert('projectlevels', $data);
       return $result;
      
    }

    function delObj($id,$data) {
        $query = $this->update("projectlevels", ['status'=>0], "id = $id");
        return $query;
    }
    function getdata($id){
        $result = array();
        $condition = "  WHERE id = $id ";
        $query = $this->db->query("SELECT * FROM projectlevels $condition");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }
    function updateObj($id,$data) {
        $query = $this->update("projectlevels",$data,"id = $id");
        return $query;
    }
}
?>