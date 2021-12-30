<?php

class function_menu_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }
    function listObj() {
    
        $result = array();
        $dieukien = " WHERE active=1 ";
        $query = $this->db->query("SELECT COUNT(1) AS dem FROM g_functions $dieukien AND parentId = 0");
      
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp[0]['dem']==0) { return $result; } 
        
       
        $query = $this->db->query("SELECT id,name, icon, parentId, sortOrder,
             (SELECT name FROM g_menus WHERE id = a.menuid) as menu,
            IF(active=1,'Đã kích hoạt','Chưa kích hoạt') AS active  FROM g_functions a $dieukien");
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
     
       $result = $this->insert('g_functions', $data);
       return $result;
      
    }

    function delObj($id,$data) {
        $query = $this->update("g_functions", ['active'=>0], "id = $id");
        return $query;
    }

    function getFunctionById($id) {
        $result = array();
        $dieukien = "  WHERE menuid = $id AND active = 1 ";
        $query = $this->db->query("SELECT COUNT(1) AS dem FROM g_functions $dieukien AND parentid = 0 ");
      
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp[0]['dem']==0) { return $result; } 
      
        $query = $this->db->query("SELECT id, parentId, name AS text FROM g_functions $dieukien");
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


    function getdata($id){
        $result = array();
        $dieukien = "  WHERE id = $id ";
        $query = $this->db->query("SELECT *
             
                FROM g_functions $dieukien");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }
    function updateObj($id,$data) {
        $query = $this->update("g_functions",$data,"id = $id");
        return $query;
    }

   
}
