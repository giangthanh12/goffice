<?php
class listusers_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function getAllData(){
        $nhanvien = array();
        $query = $this->db->query("SELECT *,
            (SELECT name FROM staffs WHERE id=staffId) as staffName,
            (SELECT name FROM grouproles WHERE id=groupId) as groupName,
            (SELECT avatar FROM staffs WHERE id=staffId) as avatar
            FROM users WHERE status > 0 ORDER BY id DESC ");
        if ($query)
            $nhanvien['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $nhanvien;
    }

    function getDataById($id){
        $result = array();
        $query = $this->db->query("SELECT *,
          IF(avatar='',CONCAT('".URLFILE."','/uploads/useravatar.png'),CONCAT('".URLFILE."/',avatar)) AS hinh_anh
          FROM staffs WHERE id=$id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result['nhanvien'] = $temp[0];

        $query2 = $this->db->query("SELECT * FROM users WHERE staffId = $id AND 1 ");
        $temp = $query2->fetchAll(PDO::FETCH_ASSOC);
        if(isset($temp[0]))
            $result['account'] = $temp[0];
        else
            $result['account'] = 0;

        $query3 = $this->db->query("SELECT * FROM staffinfo WHERE staffId = $id");
        $temp = $query3->fetchAll(PDO::FETCH_ASSOC);
        if(isset($temp[0]))
            $result['nhanvien_info'] = $temp[0];
        else
            $result['nhanvien_info'] = 0;

        return $result;
    }

    function updateObj($data,$id){
        $query = $this->update("users", $data, " id=$id ");
        return $query;
    }

    function addObj($data){
        $query = $this->insert("users", $data);
        return $query;
    }

    function delObj($id){
        $query = $this->update("users", ['status'=>0], " id=$id ");
        return $query;
    }

}
?>
