<?php
class onleave_Model extends Model{
    function __construst(){
        parent::__construst();
    }
    
    function get_data() {
            $query = $this->db->query("SELECT *,
            (SELECT name FROM staffs WHERE id = a.staffId) AS staffName
            FROM onleave a");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            return $row;
    }

    function getList($status, $page)
    {
        $data = array();
        $rows=15;
        $offset = ($page-1)*$rows;

        if ($status == '')
            $dieukien = " WHERE status IN (0,1,2) ";
        else
            $dieukien = " WHERE status=$status ";
        $query = $this->db->query("SELECT *,
            (SELECT avatar FROM staffs WHERE id = a.staffId) as avatar,
            (SELECT name FROM staffs WHERE id = a.staffId) as staffName
            FROM onleave a $dieukien ORDER BY id DESC LIMIT $offset,$rows");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getStaff() {
        $query = $this->db->query("SELECT id, name, avatar FROM staffs");
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }


    function updateOnleave($id,$data) {
        if($id > 0) {
           $result = $this->update('onleave', $data, "id = $id");
        }
        else {
            $result = $this->insert('onleave', $data);
        }
        return $result;
    }

    function getRequestById($id) {
        $result['data'] = array();
        $where = " WHERE id = $id ";
        $query = $this->db->query("SELECT id, staffId, description, type, status, 
        DATE_FORMAT(date, '%d-%m-%Y') AS date,
        (SELECT name FROM staffs WHERE id = a.staffId) AS staffName,
        (SELECT status FROM staffs WHERE id = a.staffId) AS staffType
        FROM onleave a $where");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($result[0]))
            $result = $result[0];
        return $result;
    }

    function delObj($id){
        $data = array('status'=>0);
        $query = $this->update("onleave", $data, " id=$id ");
        return $query;
    }

    function getDay($staffId){
        $result['data'] = array();
        $where = " WHERE staffId = $staffId ";
        $query = $this->db->query("SELECT id, onLeaveOwn, year, status,
        (SELECT count(id) FROM onleave WHERE staffId = $staffId AND status = 2) AS onLeaveUsed 
        FROM staffonleave $where");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($result[0]))
            $result = $result[0];
        return $result;
    }

}
?>
