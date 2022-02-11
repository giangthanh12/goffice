<?php
class system_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listInfo(){
        $query = $this->db->query("SELECT * FROM system WHERE tinh_trang = 1");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getInfo($id){
        $result = array();
        $query = $this->db->query("SELECT *
                FROM system WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function addInfo($data)
    {
        $query = $this->insert("system",$data);
        return $query;
    }

   function updateInfo($id,$data) {
      $result = $this->update('system',$data,"id = $id");
      return $result;
   }

   function delInfo($id,$data)
    {
        $query = $this->update("system",$data,"id = $id");
        return $query;
    }

   function saveLogo($data) {
    $result = $this->update('system',$data,"id = 7");
    return $result;
 }
}
?>
