<?php
class interview_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function listInterviews()
    {
        $result = array();
        $query = $this->db->query("SELECT campId,
            IFNULL((SELECT title FROM recruitmentCamp WHERE id=a.campId),'') AS recruitmentCamp,applicantId,
            IFNULL((SELECT fullName FROM applicants WHERE id=a.applicantId),'') AS applicant,dateTime,round,result,status,interviewerIds
            FROM interview a WHERE status > 0 ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $item) {
                $interviewerIds = explode(",", $item['interviewerIds']);
                $result[$key]['interviewers'] = array();
                foreach ($interviewerIds as $item) {
                    $query = $this->db->query("SELECT id,name,email,
                    IF(avatar='',CONCAT('" . URLFILE . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/',avatar)) AS avatar
                    FROM staffs WHERE id= $item ");
                    if ($query) {
                        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                        array_push($result[$key]['interviewers'], $temp[0]);
                    }
                }
            }
            return $result;
        } else {
            return 0;
        }
    }

    function detailInterview($interviewId)
    {
        $result = array();
        $query = $this->db->query("SELECT campId,
            IFNULL((SELECT title FROM recruitmentCamp WHERE id=a.campId),'') AS recruitmentCamp,applicantId,
            IFNULL((SELECT fullName FROM applicants WHERE id=a.applicantId),'') AS applicant,dateTime,round,result,status,interviewerIds
            FROM interview a WHERE status > 0 AND id=$interviewId ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $interviewerIds = explode(",", $result[0]['interviewerIds']);
            $result[0]['interviewers'] = array();
            foreach ($interviewerIds as $item) {
                $query = $this->db->query("SELECT id,name,email,
                    IF(avatar='',CONCAT('" . URLFILE . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/',avatar)) AS avatar
                    FROM staffs WHERE id= $item ");
                if ($query) {
                    $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                    array_push($result[0]['interviewers'], $temp[0]);
                }
            }
            return $result;
        } else {
            return 0;
        }
    }
}
