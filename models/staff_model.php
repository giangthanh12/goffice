<?php
class staff_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function getStaff(){
        $nhanvien = array();
        $query = $this->db->query("SELECT id, name, staffCode, email, phoneNumber, status,accesspoints,avatar
            FROM staffs WHERE status IN (1,2,3,4,5,6) ORDER BY id DESC");
        if ($query)
            $data['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function updateStatusContract($id) {
        $query = $this->db->query("SELECT id FROM laborcontract WHERE status IN (1,2) AND staffId = $id");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        if($data != []) {
            foreach ($data as $item) {
                $idContract = $item['id'];
                $query = $this->update('laborcontract',array('status'=>2),"id = $idContract");
            }
        }
        return $query;
    }
    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(birthDay,'%d/%m/%Y') as birthDay,
        DATE_FORMAT(idDate,'%d/%m/%Y') as idDate,
        (SELECT branchId FROM laborcontract WHERE staffId = a.id ORDER BY id DESC LIMIT 1) AS branchId
        FROM staffs a WHERE id=$id");

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
            $result['staff_info'] = $temp[0];
        else
            $result['staff_info'] = 0;
        
        return $result;
    }
    function addContract($data) {
        $query = $this->insert("laborcontract", $data);
        if ($query)
            return $this->db->lastInsertId();
        else
            return 0;
    }
    function loaddataContract($id) {
        $result = array();
        $dieukien = "  WHERE id = $id ";
        $query = $this->db->query("SELECT *,
                FORMAT(basicSalary,0) AS luong_co_ban,
                FORMAT(insuranceSalary,0) AS luong_bao_hiem,
                FORMAT(allowance,0) AS phu_cap,
                 IF(startDate!='0000-00-00',DATE_FORMAT(startDate,'%d/%m/%Y'),'') as startDateCv,
            IF(stopDate!='0000-00-00',DATE_FORMAT(stopDate,'%d/%m/%Y'),'') as stopDateCv
                FROM laborcontract $dieukien ORDER BY id DESC");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }
    function updateContract($id, $data) {
        $query = $this->update("laborcontract", $data, "id = $id");
        return $query;
    }

    function loadRecord($id) {
        $data = array();
        $query = $this->db->query("SELECT *,
         DATE_FORMAT(startDate,'%d/%m/%Y') as startDate,
         DATE_FORMAT(stopDate,'%d/%m/%Y') as stopDate,
         (SELECT name FROM department WHERE id = a.departmentId) as department
         FROM laborcontract a WHERE staffId = $id AND status > 0 ORDER BY id DESC");
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
    function getNational() {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM national WHERE status = 1");
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
        $query = $this->update("staffs", ['status'=>0], " id=$id ");
        return $query;
    }
    function delContract($id){
        $query = $this->update("laborcontract", ['status'=>0], " id=$id ");
        return $query;
    }
    function updateInfoStaff($data,$id){
        $query = $this->db->query("SELECT COUNT(1) AS dem FROM staffinfo WHERE staffId=$id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp[0]['dem']==0) {
            $data['staffId'] = $id;
            $query = $this->insert("staffinfo", $data);
            return $query;
        } 
        $query = $this->update("staffinfo", $data, " staffId=$id ");
        return $query;
    }

    function getAccessPoints()
    {
        $query = $this->db->query("SELECT id,name as text
          FROM accesspoints WHERE status > 0");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        return $temp;
    }
}
?>
