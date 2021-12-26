<?php
class Nhansu_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function getnhanvien(){
        $nhanvien = array();
        $query = $this->db->query("SELECT id, name, email, phoneNumber,  status, 
            IF(avatar='',CONCAT('".URLFILE."','/uploads/useravatar.png'),CONCAT('".URLFILE."/',avatar)) AS avatar,
            IFNULL((SELECT name FROM branch WHERE branch.id=(SELECT branch FROM laborcontract
        WHERE laborcontract.staffId=staffs.id LIMIT 1)),'') AS branch, 
            IFNULL((SELECT name FROM department WHERE department.id=(SELECT department FROM laborcontract
        WHERE laborcontract.staffId=staffs.id LIMIT 1)),'') AS department
            FROM staffs WHERE status IN (1,2,3,4) ORDER BY id DESC ");
        if ($query)
            $nhanvien['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $nhanvien;
    }

    function getdata($id){
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

    function updateinfo($data,$id){
        $query = $this->update("staffs", $data, " id=$id ");
        return $query;
    }

    function thayanh($file,$id){
        if ($file=='')
            return false;
        else {
            $data = ['avatar'=>$file];
            $query = $this->update("staffs", $data, " id=$id ");
            return $query;
        }
    }

    function them($data){
        $query = $this->insert("staffs", $data);
        return $query;
    }

    function xoa($id){
        $query = $this->update("staffs", ['status'=>0], " id=$id ");
        return $query;
    }

    function thoiviec($id){
        $query = $this->update("staffs", ['status'=>6], " id=$id ");
        return $query;
    }

    function province(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM province WHERE status=1");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

/*== Get account by ID nhan_vien ===== */
    function getAccountbyId($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM users WHERE staffId = $id");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function checkUsername($username,$id){
        $query = $this->db->query("SELECT COUNT(id) as total FROM users WHERE username = '$username' AND id!=$id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        return $temp[0]['total'];
    }

    function them_users($data){
        $query = $this->insert("users", $data);
        return $query;
    }
    function update_users($data,$id){
        $query = $this->update("users", $data, " id=$id ");
        return $query;
    }

 /** Social  nhanvien_info*/       
    function getNhanvienInfoId($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM staffinfo WHERE staffId = $id");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function them_nhanvien_info($data){
        $query = $this->insert("staffinfo", $data);
        return $query;
    }
    function update_nhanvien_info($data,$id){
        $query = $this->update("staffinfo", $data, " staffId=$id ");
        return $query;
    }

}
?>
