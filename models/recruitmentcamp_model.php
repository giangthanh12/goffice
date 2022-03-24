<?php
class recruitmentcamp_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function listObj()
    {
        $result = array();
        $query = $this->db->query("SELECT *,
            DATE_FORMAT(startDate,'%d/%m/%Y') as startDate,
            DATE_FORMAT(stopDate,'%d/%m/%Y') as stopDate,
            (SELECT name FROM department WHERE id = a.department) AS department,
            (SELECT name FROM position WHERE id = a.position) AS position,
            (SELECT name FROM staffs WHERE id = a.creatorId) AS creator
            FROM recruitmentcamp a WHERE status = 1 ORDER BY ID DESC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function addObj($data){
        $query = $this->insert("recruitmentcamp", $data);
        return $query;
    }
    function addSortlist($data) {
        $query = $this->insert("sortlist", $data);
        return $query;
    }
    function addInterview($data) {
      $result =  $this->insert("interview",$data);
      return $result;
    }
    function getListCandidate($id) {
        $result = array();
        $query = $this->db->query("SELECT *,
            (SELECT fullName FROM applicants WHERE id = a.canId) AS fullName,
            (SELECT gender FROM applicants WHERE id = a.canId) AS gender,
            (SELECT email FROM applicants WHERE id = a.canId) AS email,
            (SELECT phoneNumber FROM applicants WHERE id = a.canId) AS phoneNumber,
            (SELECT cv FROM applicants WHERE id = a.canId) AS cv,
            (SELECT status FROM applicants WHERE id = a.canId) AS status
            FROM sortlist a WHERE status = 1 AND campId = $id ORDER BY ID DESC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getInterviewResult($id) {
        $result = array();
        $query = $this->db->query("SELECT *,
        (SELECT fullName FROM applicants  WHERE id = a.applicantId) AS fullName,
        (SELECT gender FROM applicants  WHERE id = a.applicantId) AS gender,
        (SELECT email FROM applicants  WHERE id = a.applicantId) AS email,
        DATE_FORMAT(dateTime,'%d-%m-%Y') as dateTime,
        (SELECT title FROM recruitmentcamp  WHERE id = a.campId) AS title,
        (SELECT phoneNumber FROM applicants  WHERE id = a.applicantId) AS phoneNumber
         FROM interview a WHERE result in (2,3,4,5) AND status = 1 AND campId = $id ORDER BY id DESC ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getRecruimentResult($id) {
        $result = array();
        $query = $this->db->query("SELECT id,title,quantity, 
        (SELECT name FROM department WHERE STATUS = 1 AND id = recruitmentcamp.department) AS department, 
        (SELECT name FROM position WHERE STATUS = 1 AND id = recruitmentcamp.position) AS position, 
        (SELECT COUNT(1) FROM interview WHERE STATUS = 1 AND campId = recruitmentcamp.id) AS countInterview, 
        (SELECT COUNT(1) FROM interview WHERE STATUS = 1 AND campId = recruitmentcamp.id AND result in (2,5)) AS countqualified, 
        (SELECT COUNT(1) FROM interview WHERE STATUS = 1 AND campId = recruitmentcamp.id AND result = 5) AS countReceived 
        FROM recruitmentcamp WHERE STATUS = 1 AND id = $id ORDER BY id DESC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getStaff() {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM staffs WHERE status > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getCandidate($id) {
        $query = $this->db->query("SELECT canId FROM sortlist WHERE status = 1 AND campId = $id");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $canId = [];
        if(!empty($result)) {
            foreach($result as $item) {
                $canId[] = $item['canId'];
            }
            $canId = implode(',',$canId);
            $where = " AND id NOT IN ($canId) ";
        }
        else {
            $where = "";
        }
        $result = array();
        $query = $this->db->query("SELECT id, fullName AS `text` FROM applicants WHERE status = 1 $where ");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getDepartment() {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM department WHERE status > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getBranch() {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM branch WHERE status > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getPosition() {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM position WHERE status > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getworkPlace() {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM workplaces WHERE status > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getShift() {
        $result = array();
        $query = $this->db->query("SELECT id, shift AS `text` FROM shift WHERE status > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function insertStaffGetId($applicantId) {
 
        $query = $this->db->query("SELECT fullName, phoneNumber, email, gender, dob 
         FROM applicants WHERE status = 1 AND id = $applicantId");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $data = [];
        if($result) {
            $result = $result[0];
            $data = array(
                'name'=>$result['fullName'],
                'phoneNumber'=>$result['phoneNumber'],
                'email'=>$result['email'],
                'gender'=>$result['gender'],
                'birthDay'=>$result['dob'],
                'status'=>1
            );
        }
        else {
            return -1;
        } 
      if(!empty($data))
      $id =  $this->insertGetId("staffs",$data);
      return $id;
    }
    function signContract($data,$id,$applicantId) {
        $result =  $this->insert("laborcontract",$data);
        if($result) {
            $result =  $this->update("interview",['result'=>5]," id = $id");
            $result =  $this->update("applicants",['status'=>2]," id = $applicantId");
            // xử lý sortlist update status = 2 khi đã kí hợp đồng khi lấy được campid và canid trên interview
            // $result =  $this->update("sortlist",['status'=>2]," canId = $applicantId AND ");
        }
        return $result;
    }

    function checkqty($id) {
        $query = $this->db->query("SELECT COUNT(1) as rowNumber, quantity, 
        (SELECT COUNT(1) FROM interview WHERE STATUS = 1 AND campId = recruitmentcamp.id AND result = 5) AS countReceived 
        FROM recruitmentcamp WHERE status > 0 AND id=$id HAVING countReceived < quantity");
         $result = $query->fetchAll(PDO::FETCH_ASSOC);
         if($result[0]['rowNumber'] > 0) return true;
         return false;
    }

    function insertGetId($table, $array){
        $cols = array();
        $bind = array();
        foreach($array as $key => $value){
            $cols[] = $key;
            $bind[] = "'".$value."'";
        }
        $this->db->query("INSERT INTO ".$table." (".implode(",", $cols).") VALUES (".implode(",", $bind).")");
        $last_id = $this->db->lastInsertId();
        return $last_id;
    }
    

    function getData($id){
        $result = array();
        $query = $this->db->query("SELECT *,
            DATE_FORMAT(startDate,'%d-%m-%Y') as startDate,
            DATE_FORMAT(stopDate,'%d-%m-%Y') as endDate
            FROM recruitmentcamp WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id,$data){
        $query = $this->update("recruitmentcamp", $data ,"id=$id");
        return $query;
    }
    function delObj($id, $data) {
        $result = $this->update('recruitmentcamp', $data, "id = $id");
        return $result;
    }

    function changeSt($id, $data) {
        $result = $this->update('sortlist', $data, "id = $id");
        return $result;
    }

    function delCandidate($id, $data) {
        $result = $this->update('sortlist', $data, "id = $id");
        return $result;
    }

    
}
