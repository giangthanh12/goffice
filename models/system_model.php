<?php
class system_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function getInfo(){
        $query = $this->db->query("SELECT * FROM system WHERE tinh_trang = 1");
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

   function updateInfo($id,$data) {
      $result = $this->update('system',$data,"id = $id");
      return $result;
   }
}
?>
