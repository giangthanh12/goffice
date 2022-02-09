<?php
class asset_recall_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT *,
        IFNULL((SELECT name FROM taisan WHERE id = taisan_thuhoi.tai_san ), 'No Name') AS name_taisan ,
        (SELECT code FROM taisan WHERE id = taisan_thuhoi.tai_san ) AS code,
        (SELECT name FROM taisan_capphat WHERE id = taisan_thuhoi.cap_phat ) AS nameIssue,
        DATE_FORMAT(ngay_gio,'%d-%m-%Y') as ngay_gio 
         FROM taisan_thuhoi WHERE tinh_trang > 0 order by ngay_gio desc");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }



    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(ngay_gio,'%d-%m-%Y') as ngay_gio FROM taisan_thuhoi WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

   

    

    function taisan(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM taisan");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function capphat(){
        $result = array();
        $query = $this->db->query("SELECT id, code AS `text` FROM taisan");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }






    
}
?>