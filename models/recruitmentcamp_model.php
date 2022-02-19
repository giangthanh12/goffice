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
            (SELECT status FROM applicants WHERE id = a.canId) AS status
            FROM sortlist a WHERE status = 1 AND campId = $id ORDER BY ID DESC");
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
    function delCandidate($id, $data) {
        $result = $this->update('sortlist', $data, "id = $id");
        return $result;
    }

    
}
