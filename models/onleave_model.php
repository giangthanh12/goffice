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
    // function getLevelProject(){
    //     $result = array();
    //     $query = $this->db->query("SELECT id,color, concat('<span style=\"color:',color,';\">',name,'<span>') AS text FROM projectlevels WHERE status = 2");
    //     $result = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }
    // function getStatusProject(){
    //     $result = array();
    //     $query = $this->db->query("SELECT id,color, name AS text FROM projectstatus WHERE status = 2");
    //     $result = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }

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
        DATE_FORMAT(fromDate, '%d-%m-%Y') AS fromDate,
        DATE_FORMAT(toDate, '%d-%m-%Y') AS toDate,
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

    function getDay($id){
        $result['data'] = array();
        $where = " WHERE staffId = $id ";
        $query = $this->db->query("SELECT id, onLeaveOwn, year, status,
        (SELECT count(id) FROM onleave WHERE staffId = $id AND status = 2) AS onLeaveUsed 
        FROM staffonleave $where");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($result[0]))
            $result = $result[0];
        return $result;
    }

    // function filterLevel($filter, $status) {
  
    //     $condition = "WHERE status > 0";
    //     if(!empty($status))
    //     {
    //         $condition = " WHERE status = $status ";
    //     } 
    //     if(!empty($filter)) {
    //         $condition.= " AND level in ($filter) ";
    //     }
    //     $query = $this->db->query("SELECT id, image, name, level,process,
    //         DATE_FORMAT(deadline,'%d-%m-%Y') as deadline,
    //         (SELECT avatar FROM staffs WHERE id=a.managerId) AS avatar,
    //        (SELECT name FROM projectlevels WHERE id=a.level) AS nameLevel,
    //        (SELECT color FROM projectlevels WHERE id=a.level) AS colorLevel,
    //        (SELECT color FROM projectstatus WHERE id=a.status) AS colorStatus
    //         FROM projects a $condition ORDER BY id DESC ");
    //         $data = $query->fetchAll(PDO::FETCH_ASSOC);
    //         return $data;
    // }
}
?>
