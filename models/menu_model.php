<?php

class menu_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }
    function listObj() {
    
        $result = array();
        $dieukien = " WHERE active=1 ";
        $query = $this->db->query("SELECT COUNT(1) AS dem FROM g_menus $dieukien AND parentId = 0");
      
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp[0]['dem']==0) { return $result; } 
        
       
        $query = $this->db->query("SELECT id,name, link, icon, parentId, sortOrder,
     
            IF(active=1,'Đã kích hoạt','Chưa kích hoạt') AS active  FROM g_menus $dieukien");
            if($query) {
                $temp = $query->fetchAll(PDO::FETCH_ASSOC);
             
                if (sizeof($temp)>0)
                {
                   $result=functions::dequy($temp,0,0);
                   return $result;
                }
            }
             
             return $result;
                
    }
    function get_data_combo(){
        $result = array();
        $dieukien = " WHERE active=1 ";
        $query = $this->db->query("SELECT COUNT(1) AS dem FROM g_menus $dieukien AND parentId = 0");
      
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp[0]['dem']==0) { return $result; } 
        $query = $this->db->query("SELECT id, parentId, name AS text FROM g_menus $dieukien");
        if($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
         
            if (sizeof($temp)>0)
            {
               $result=functions::dequy($temp,0,0);
               return $result;
            }
        }
         
         return $result;
    }
    function addObj($data) {
     
       $result = $this->insert('g_menus', $data);
       return $result;
      
    }

    function delObj($id,$data) {
        $query = $this->update("g_menus", ['active'=>0], "id = $id");
        return $query;
    }
    function getdata($id){
        $result = array();
        $dieukien = "  WHERE id = $id ";
        $query = $this->db->query("SELECT *
             
                FROM g_menus $dieukien");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }
    function updateObj($id,$data) {
        $query = $this->update("g_menus",$data,"id = $id");
        return $query;
    }

   
}
