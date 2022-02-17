<?php
class todo_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getList($nhanvien, $catid)
    {
        if ($catid == 2) {
            $today = date('Y-m-d');
            $dieukien = " WHERE status>0 AND assigneeId=$nhanvien AND ((endDate>deadline) OR (endDate='0000-00-00' AND deadline<'$today')) ";
            // $query = $this->db->query("SELECT id, title, label, assigneeId, description, deadline,status,
            //     (SELECT avatar FROM staffs WHERE id=a.assigneeId) AS avatar, projectId,
            //     (SELECT name FROM tasklabels WHERE id=a.label) AS labelText,
            //     (SELECT COUNT(1) FROM commenttasks WHERE taskId=a.id) AS comment
            //     FROM tasks a $dieukien ORDER BY id DESC ");
        } elseif ($catid == 3) {
            $dieukien = " WHERE assigneeId=$nhanvien AND status=6 ";
            // $query = $this->db->query("SELECT id, title, label, assigneeId, description, deadline,status,
            //     (SELECT avatar FROM staffs WHERE id=a.assignerId) AS avatar, projectId,
            //     (SELECT name FROM tasklabels WHERE id=a.label) AS labelText,
            //     (SELECT COUNT(1) FROM commenttasks WHERE taskId=a.id) AS comment
            //     FROM tasks a $dieukien ORDER BY id DESC ");
        } elseif ($catid == 4)
            $dieukien = " WHERE assigneeId=$nhanvien AND status=0 ";
        // $query = $this->db->query("SELECT id, title, label, assigneeId, description, deadline,status,
        //     (SELECT avatar FROM staffs WHERE id=a.assignerId) AS avatar, projectId,
        //     (SELECT name FROM tasklabels WHERE id=a.label) AS labelText,
        //     (SELECT COUNT(1) FROM commenttasks WHERE taskId=a.id) AS comment
        //     FROM tasks a $dieukien ORDER BY id DESC ");
        else {
            $dieukien = " WHERE assigneeId=$nhanvien AND status IN (1,2,3,4,5) ";
        }
        $query = $this->db->query("SELECT id, title, label, assigneeId, description, deadline, status,
            DATE_FORMAT(deadline,'%d-%m-%Y') AS deadlineFormat,
            (SELECT avatar FROM staffs WHERE id=a.assigneeId) AS avatar, projectId,
            (SELECT name FROM tasklabels WHERE id=a.label) AS labelText,
            (SELECT COUNT(1) FROM commenttasks WHERE taskId=a.id) AS comment,
            If((SELECT COUNT(1) FROM calendars WHERE status=1 AND objectId=a.id AND objectType=3)>0,1,0) AS addCalendar
            FROM tasks a $dieukien ORDER BY id DESC ");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
        //     if ($project>0) {
        //         $dieukien .= " AND projectId=$project ";
        //         $query = $this->db->query("SELECT id, title, label, assigneeId, description, deadline,status,
        //             (SELECT avatar FROM staffs WHERE id=a.assigneeId) AS avatar, projectId,
        //             (SELECT name FROM tasklabels WHERE id=a.label) AS labelText,
        //             (SELECT color FROM tasklabels WHERE id=a.label) AS labelColor,
        //             (SELECT COUNT(1) FROM commenttasks WHERE taskId=a.id) AS comment
        //             FROM tasks a $dieukien ORDER BY id DESC ");
        //     }
    }

    function getProject()
    {
        $employee = '"' . $_SESSION['user']['staffId'] . '"';
        $dieukien = " WHERE status>0 AND memberId LIKE '%$employee%' ";
        $query = $this->db->query("SELECT id, name FROM projects $dieukien ORDER BY id DESC ");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getLabel()
    {
        $query = $this->db->query("SELECT * FROM tasklabels WHERE status=1 ");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getEmployee()
    {
        $result = array();
        $query = $this->db->query("SELECT id, name, avatar
              FROM staffs WHERE status IN (1,2,3,4) ORDER BY name ASC");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function capnhat($id, $data)
    {
        if ($id == 0) {
            $data['status'] = 1;
            $data['assignmentDate'] = date('Y-m-d');
            $data['updated'] = date('Y-m-d');
            $data['assignerId'] = $_SESSION['user']['staffId'];
            $query = $this->insert("tasks", $data);
        } else {
            $query = $this->update("tasks", $data, " id=$id ");
        }
        return $query;
    }

    function checkOut($id, $status)
    {
        if ($status == 6)
            $data = ['status' => $status, 'endDate' => date('Y-m-d')];
        else
            $data['status'] = $status;
        $query = $this->update("tasks", $data, " id=$id ");
        return $query;
    }

    function getTask($taskId)
    {
        $data = array();
        $query = $this->db->query("SELECT *
            FROM tasks WHERE id=$taskId ");
        if ($query)
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data[0];
    }

    function checkCalendar($taskId)
    {
        $query = $this->db->query("SELECT id FROM calendars WHERE objectId=$taskId AND objectType=3");
        if ($query)
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data[0];
    }

    function checkStaffCalendar($taskId, $staffId)
    {
        $data = array();
        $data['calendarId'] = 0;
        $query = $this->db->query("SELECT id FROM calendars WHERE staffId = $staffId AND objectId=$taskId AND objectType=3");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($result)>0) {
            $data['calendarId'] = $result[0]['id'];
        }
        $query = $this->db->query("SELECT id FROM calendars WHERE staffId != $staffId AND objectId=$taskId AND objectType=3");
        if ($query)
            $data['calDel'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function updateCalendar($calendarId, $taskData)
    {
        $query = $this->update("calendars", $taskData, " id=$calendarId ");
        return $query;
    }

    function addCalendar($taskData)
    {
        $query = $this->insert("calendars", $taskData);
        return $query;
    }

    //
    //
    // function comment($id){
    //     $data = array();
    //     $query = $this->db->query("SELECT dateTime, content,
    //        (SELECT avatar FROM staffs WHERE id=staffId) AS hinhanh,
    //        (SELECT name FROM staffs WHERE id=staffId) AS nhanvien
    //        FROM commenttasks WHERE taskId=$id ORDER BY dateTime DESC ");
    //     if ($query)
    //        $data = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $data;
    // }
    //
    // function addcomment($id,$comment){
    //     $commentor = $_SESSION['user']['staffId'];
    //     $receiver = [];
    //     $query = $this->db->query("SELECT assignerId, assigneeId FROM tasks WHERE id=$id  ");
    //     $temp = $query->fetchAll(PDO::FETCH_ASSOC);
    //     if ($temp[0]['assigneeId']!=$commentor)
    //         array_push($receiver,$temp[0]['assigneeId']);
    //     if ($temp[0]['assignerId']!=$commentor)
    //         array_push($receiver,$temp[0]['assignerId']);
    //     $sendto = json_encode($receiver);
    //     $ngaygio = date('Y-m-d H:i:s');
    //     $data = ['staffId'=>$commentor, 'taskId'=>$id, 'dateTime'=>$ngaygio, 'content'=>$comment,'sendTo'=>$sendto, 'status'=>1];
    //     $query = $this->insert("commenttasks", $data);
    //     $return = array('query'=>$query, 'receiver'=>$receiver);
    //     return $return;
    // }
    //
    // function completed($id){
    //     $query = $this->db->query("UPDATE tasks SET status = IF(status=4,2,4) WHERE id = $id ");
    //     return $query;
    // }
    // //
    // // function addObj($data){
    // //     $query = $this->insert("chatbox", $data);
    // //     return $query;
    // // }
    // //
    // function delObj($id){
    //     $data = array('status'=>0);
    //     $query = $this->update("tasks", $data, " id=$id ");
    //     return $query;
    // }
    //
    // function checkcomm(){ // dung cho notification
    //     $result = array();
    //     $nguoinhan = '"'.$_SESSION['user']['staffId'].'"';
    //     $query = $this->db->query("SELECT id,
    //         CONCAT((SELECT title FROM tasks WHERE id=taskId), SUBSTRING(content,1, 32)) AS tieu_de,
    //         (SELECT name FROM staffs WHERE id=staffId) AS nguoigui,
    //         (SELECT avatar FROM staffs WHERE id=staffId) AS hinhanh
    //         FROM commenttasks WHERE status=1 AND sendTo LIKE '%$nguoinhan%' ORDER BY dateTime DESC LIMIT 1 ");
    //     if ($query) {
    //         $temp = $query->fetchAll(PDO::FETCH_ASSOC);
    //         $result = isset($temp[0])?$temp[0]:array();
    //     }
    //     return $result;
    // }

    //
    // function add_tin_chua_doc($data){
    //     $query = $this->insert("chatbox_read", $data);
    //     return $query;
    // }
    //
    // function update_tin_chua_doc($code, $nhanvienid, $data){
    //     $query = $this->update("chatbox_read", $data, "code = '$code' AND nhan_vien = $nhanvienid");
    //     return $query;
    // }
    //
    // function check_exit_into_read($code, $nhanvienid){
    //     $query = $this->db->query("SELECT * FROM chatbox_read WHERE code = '$code' AND nhan_vien = $nhanvienid");
    //     return $query->fetchAll();
    // }
    //
    // function get_total_tin_nhan_chua_doc($nhanvienid){
    //     $query = $this->db->query("SELECT SUM(tin_chua_doc) AS Total FROM chatbox_read WHERE nhan_vien = $nhanvienid");
    //     $row = $query->fetchAll();
    //     return $row[0]['Total'];
    // }
}
