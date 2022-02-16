<?php
class interview_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getRecruitmentCamp()
    {
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

    function getCandidate($campId)
    {
        $result = array();
        $query = $this->db->query("SELECT canId as id,
        IFNULL((SELECT fullName FROM applicants  WHERE id = a.canId and status = 1), 'null') AS `text` FROM sortlist a WHERE status = 1 AND campId = $campId HAVING text != 'null'");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getStaff()
    {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM staffs WHERE status > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addInterview($data)
    {
        $result = false;
        $HrIds = $this->getHrId();
        $this->insert("interview", $data);
        $interviewId = $this->db->lastInsertId();
        $campId = $data['campId'];
        $query = $this->db->query("SELECT title FROM recruitmentcamp WHERE id=$campId");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $campTitle = $temp[0]['title'];
        $listInteviewerIds = explode(',', $data['interviewerIds']);
        foreach ($listInteviewerIds as $item) {
            $calendar = [
                'title' => "Lịch phỏng vấn cho chiến dịch: " . $campTitle,
                'staffId' => $item,
                'objectType' => 2,
                'startDate' => $data['dateTime'],
                'endDate' => $data['dateTime'],
                'description' => $data['note'],
                'status' => 1,
                'objectId' => $interviewId
            ];
            $this->insert("calendars", $calendar);
        }
        foreach ($HrIds as $hr) {
            $calendarId = $this->checkCalendar($interviewId, $hr['staffId']);
            if ($calendarId != 0) {
                $calendar = [
                    'title' => "Lịch phỏng vấn cho chiến dịch: " . $campTitle,
                    'startDate' => $data['dateTime'],
                    'endDate' => $data['dateTime'],
                    'description' => $data['note'],
                ];
                $this->update("calendars", $calendar, "id=$calendarId");
            } else {
                $calendar = [
                    'title' => "Lịch phỏng vấn cho chiến dịch: " . $campTitle,
                    'staffId' => $hr['staffId'],
                    'objectType' => 2,
                    'startDate' => $data['dateTime'],
                    'endDate' => $data['dateTime'],
                    'description' => $data['note'],
                    'status' => 1,
                    'objectId' => $interviewId
                ];
                $this->insert("calendars", $calendar);
            }
        }
        $result = true;

        return $result;
    }

    function updateInterview($id, $data)
    {
        $result = false;
        $HrIds = $this->getHrId();
        $campId = $data['campId'];
        $query = $this->db->query("SELECT title FROM recruitmentcamp WHERE id=$campId");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $campTitle = $temp[0]['title'];
        $listInteviewerIds = explode(',', $data['interviewerIds']);
        $listInterview = '';
        // Update calendar HR
        foreach ($HrIds as $hr) {
            $calendarId = $this->checkCalendar($id, $hr['staffId']);
            if ($calendarId != 0) {
                $calendar = [
                    'title' => "Lịch phỏng vấn cho chiến dịch: " . $campTitle,
                    'startDate' => $data['dateTime'],
                    'endDate' => $data['dateTime'],
                    'description' => $data['note'],
                ];
                $this->update("calendars", $calendar, "id=$calendarId");
            } else {
                $calendar = [
                    'title' => "Lịch phỏng vấn cho chiến dịch: " . $campTitle,
                    'staffId' => $hr['staffId'],
                    'objectType' => 2,
                    'startDate' => $data['dateTime'],
                    'endDate' => $data['dateTime'],
                    'description' => $data['note'],
                    'status' => 1,
                    'objectId' => $id
                ];
                $this->insert("calendars", $calendar);
            }
            $listInterview .= $hr['staffId'] . ',';
        }
        // Update calendar interviewers
        foreach ($listInteviewerIds as $item) {
            $calendarId = $this->checkCalendar($id, $item);
            if ($calendarId != 0) {
                $calendar = [
                    'title' => "Lịch phỏng vấn cho chiến dịch: " . $campTitle,
                    'startDate' => $data['dateTime'],
                    'endDate' => $data['dateTime'],
                    'description' => $data['note'],
                ];
                $this->update("calendars", $calendar, "id=$calendarId");
            } else {
                $calendar = [
                    'title' => "Lịch phỏng vấn cho chiến dịch: " . $campTitle,
                    'staffId' => $item,
                    'objectType' => 2,
                    'startDate' => $data['dateTime'],
                    'endDate' => $data['dateTime'],
                    'description' => $data['note'],
                    'status' => 1,
                    'objectId' => $id
                ];
                $this->insert("calendars", $calendar);
            }
            $listInterview .= $item . ',';
        }
        // Delete calendar interviewers
        $listInterview = rtrim($listInterview,',');
        $listCalDel = $this->checkNoCalendar($listInterview, $id);
        if ($listCalDel != 0) {
            foreach ($listCalDel as $item) {
                $this->updateCalendar($item['id'], ['status' => 0]);
            }
        }
        $this->update("interview", $data, " id = $id ");
        $result = true;
        return $result;
    }

    function getListInterview($thang, $nam, $nhanvien)
    {
        $thangnam = $nam . '-' . $thang;
        // $today = date('Y-m-d');
        $dieukien = " WHERE status=1 AND result !=5 AND dateTime LIKE '$thangnam%' ";

        $query = $this->db->query("SELECT *,
        DATE_FORMAT(dateTime,'%d-%m-%Y') as date,
        (SELECT fullName FROM applicants  WHERE id = a.applicantId) AS fullName,
        DATE_FORMAT(dateTime,'%H:%i') as time FROM interview a $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($nhanvien != '') {
            $arraytemp = array();
            foreach ($temp as $value) {
                if (strlen(strstr($value['interviewerIds'], ',')) < 0) {
                    if ($value['interviewerIds'] == $nhanvien)
                        $arraytemp[] = $value;
                } else {
                    if (in_array($nhanvien, explode(',', $value['interviewerIds'])))
                        $arraytemp[] = $value;
                }
            }
            return $arraytemp;
        }
        return $temp;
    }

    function delObj($id, $data)
    {
        $result = $this->update('interview', $data, "id = $id");
        return $result;
    }

    function checkNoCalendar($interviewId, $objectId)
    {
        $query = $this->db->query("SELECT id FROM calendars WHERE objectId = $objectId AND staffId NOT IN ($interviewId) AND objectType=2 AND status = 1");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($data) > 0)
            return $data;
        else
            return 0;
    }

    function checkCalendar($objectId, $staffId)
    {
        if ($staffId == 0) {
            $query = $this->db->query("SELECT id FROM calendars WHERE objectId=$objectId AND objectType=2");
            if ($query)
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } else {
            $query = $this->db->query("SELECT id FROM calendars WHERE objectId=$objectId AND staffId=$staffId AND objectType=2");
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            if (count($data) > 0) {
                return $data[0]['id'];
            } else
                return 0;
        }
    }

    function getHrId()
    {
        $query = $this->db->query("SELECT staffId FROM laborcontract WHERE position = 9 AND status = 1");
        if ($query)
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function updateCalendar($calendarId, $data)
    {
        $query = $this->update("calendars", $data, " id=$calendarId ");
        return $query;
    }
}
