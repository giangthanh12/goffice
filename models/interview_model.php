<?php
class interview_Model extends Model{
    function __construst(){
        parent::__construst();
    }
    function getRecruitmentCamp() {
        $result = array();
        $query = $this->db->query("SELECT id, title AS `text` FROM recruitmentcamp WHERE status = 1");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // function getCandidate($campId) {
    //     $result = array();
    //     $query = $this->db->query("SELECT canId as id,
    //     (SELECT fullName FROM applicants  WHERE id = a.canId and status = 2) AS `text` FROM sortlist a WHERE status = 1 AND campId = $campId");
    //     if ($query)
    //         $result = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }

    function getCandidate($campId) {
        $result = array();
        $query = $this->db->query("SELECT canId as id,
        IFNULL((SELECT fullName FROM applicants  WHERE id = a.canId and status = 1), 'null') AS `text` FROM sortlist a WHERE status = 1 AND campId = $campId HAVING text != 'null'");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getStaff() {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM staffs WHERE status = 1");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function updateInterview($id,$data) {
        if(!empty($id) && $id > 0) {
            $result = $this->update("interview",$data, " id = $id ");
        }
        else {
            $result = $this->insert("interview",$data);
        }
        return $result;
    }
    function getListInterview($thang,$nam,$nhanvien) {
        $thangnam = $nam . '-' . $thang;
        // $today = date('Y-m-d');
        $dieukien = " WHERE status=1 AND result !=5 AND dateTime LIKE '$thangnam%' ";
        if(!empty($nhanvien)) {
            $dieukien .= "  AND interviewerIds LIKE '%$nhanvien%' ";
        }
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(dateTime,'%d-%m-%Y') as date,
        (SELECT fullName FROM applicants  WHERE id = a.applicantId) AS fullName,
        DATE_FORMAT(dateTime,'%H:%i') as time FROM interview a $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        return $temp;
    }
    function delObj($id, $data) {
        $result = $this->update('interview', $data, "id = $id");
        return $result;
    }
}
?>
