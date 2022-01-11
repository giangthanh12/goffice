<?php
class staff_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function getStaff(){
        $nhanvien = array();
        $query = $this->db->query("SELECT id, name, email, phoneNumber, 
            IF(avatar='',CONCAT('".URLFILE."','/uploads/useravatar.png'),CONCAT('".URLFILE."/',avatar)) AS avatar
            FROM staffs WHERE status = 1 ORDER BY id DESC");
        if ($query)
            $data['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT *, IF(avatar='',CONCAT('".URLFILE."','/uploads/useravatar.png'),CONCAT('".URLFILE."/',avatar)) AS avatar, 
        DATE_FORMAT(birthDay,'%d/%m/%Y') as birthDay,
        DATE_FORMAT(idDate,'%d/%m/%Y') as idDate
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

    function loadRecord($id) {
        $data = array();
        $query = $this->db->query("SELECT *,
         DATE_FORMAT(startDate,'%d/%m/%Y') as startDate,
         DATE_FORMAT(stopDate,'%d/%m/%Y') as stopDate,
         (SELECT name FROM laborcontract WHERE id = a.contractId) as nameContract,
         (SELECT name FROM department WHERE id = a.departmentId) as department
         FROM records a WHERE staffId = $id AND status = 1 ORDER BY id DESC");
        $data['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getProvince() {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM province WHERE status = 1");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function updateinfo($data,$id){
        $query = $this->update("staffs", $data, " id=$id ");
        return $query;
    }

    function changeImage($file,$id){
        if ($file=='')
            return false;
        else {
            $data = ['avatar'=>$file];
            $query = $this->update("staffs", $data, " id=$id ");
            return $query;
        }
    }

    function add($data){
        $query = $this->insert("staffs", $data);
        return $query;
    }

    function del($id){
        $query = $this->update("staffs", ['status'=>2], " id=$id ");
        return $query;
    }

 

   
  



  




  

}
?>
