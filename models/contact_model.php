<?php
class contact_Model extends Model{
    function __construst(){
        parent::__construst();
    }
    function listObj() {
        $condition = " WHERE status = 1 ";
        $query = $this->db->query("SELECT * FROM contact $condition ORDER BY id DESC");
            if($query) {
                $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }        
    }
    function getCustomer() {
        $result = array();
        $query = $this->db->query("SELECT id, fullName AS `text` FROM customer WHERE status = 1");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function addObj($data) {
     
       $result = $this->insert('contact', $data);
       return $result;
      
    }

    function delObj($id,$data) {
        $query = $this->update("contact", $data, "id = $id");
        return $query;
    }
    function getdata($id){
        $result = array();
        $condition = "  WHERE id = $id ";
        $query = $this->db->query("SELECT * FROM contact $condition");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }
    function updateObj($id,$data) {
        $query = $this->update("contact",$data,"id = $id");
        return $query;
    }
}
?>
