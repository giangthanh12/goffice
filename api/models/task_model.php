<?php
class task_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function listTaskLabels()
    {
        $result = array();
        $query = $this->db->query("SELECT *
        FROM tasklabels WHERE status > 0 ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    function listTaskStatus()
    {
        $result = array();
        $query = $this->db->query("SELECT *
        FROM taskstatus WHERE status > 0 ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    function reportTask()
    {
        $result = array();
        $resultMonth = array();
        $year = date('Y');
        for ($month = 1; $month <= 12; $month++) {
            $resultMonth['month'] = $month;
            if ($month < 10) {
                $month = '0' . $month;
            }
            $yearMonth = "$year-$month";
            $query = $this->db->query("SELECT count(id) AS total
            FROM tasks WHERE status > 0 AND assignmentDate LIKE '$yearMonth%' ");
            if ($query) {
                $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                $resultMonth['totalCreated'] = $temp[0]['total'];
            }
            $query = $this->db->query("SELECT count(id) AS total
            FROM tasks WHERE status = 4 AND assignmentDate LIKE '$yearMonth%' ");
            if ($query) {
                $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                $resultMonth['totalCompleted'] = $temp[0]['total'];
            }
            $query = $this->db->query("SELECT count(id) AS total
            FROM tasks WHERE status = 2 AND assignmentDate LIKE '$yearMonth%' ");
            if ($query) {
                $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                $resultMonth['totalDoing'] = $temp[0]['total'];
            }
            $query = $this->db->query("SELECT count(id) AS total
            FROM tasks WHERE status = 3 AND assignmentDate LIKE '$yearMonth%' ");
            if ($query) {
                $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                $resultMonth['totalDeadline'] = $temp[0]['total'];
            }
            array_push($result, $resultMonth);
        }
        return $result;
    }

    // function getData($staffId)
    // {
    //     $result = array();
    //     $query = $this->db->query("SELECT *,
    //     IF(image='',CONCAT('" . URLFILE . "','/uploads/nofile.png'),CONCAT('" . URLFILE . "/',image)) AS image,
    //     (SELECT name FROM tasklabels WHERE id=a.label) AS labelName,
    //     (SELECT color FROM tasklabels WHERE id=a.label) AS labelColor,
    //     (SELECT name FROM taskstatus WHERE id=a.status) AS statusName,
    //     (SELECT color FROM taskstatus WHERE id=a.status) AS statusColor
    //     FROM tasks a WHERE status > 0 AND assigneeId=$staffId ORDER BY id DESC ");
    //     if ($query) {
    //         $result = $query->fetchAll(PDO::FETCH_ASSOC);
    //         return $result;
    //     } else {
    //         return 0;
    //     }
    // }

    function listStaffProjects($staffId)
    {
        $result = array();
        $listProjects = '';
        $query = $this->db->query("SELECT id 
        FROM projects a WHERE status>0 AND (managerId=$staffId OR managerId LIKE '%$staffId%') AND (SELECT COUNT(id) FROM tasks WHERE status>0 AND projectId=a.id)=0 ");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($temp as $item) {
                $listProjects .= $item['id'] . ',';
            }
        }
        $query = $this->db->query("SELECT projectId 
        FROM tasks a WHERE status>0 AND (assigneeId=$staffId OR assignerId=$staffId) 
        AND (SELECT id FROM projects WHERE id=a.projectId AND status > 0)>0 
        GROUP BY projectId ");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($temp as $item) {
                $listProjects .= $item['projectId'] . ',';
            }
        }
        $listProjects = rtrim($listProjects, ",");
        if ($listProjects != '0') {
            $query = $this->db->query("SELECT *, 
            IF(image='',CONCAT('" . URLFILE . "','/uploads/nofile.png'),CONCAT('" . URLFILE . "/',image)) AS image 
            FROM projects WHERE id IN ($listProjects) ORDER BY createDate DESC ");
            if ($query) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $key => $item) {
                    $managerId = $item['managerId'];
                    $result[$key]['manager'] = array();
                    if ($managerId > 0) {
                        $query = $this->db->query("SELECT id,name,email,
                        IF(avatar='',CONCAT('" . URLFILE . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/',avatar)) AS avatar
                        FROM staffs WHERE id= $managerId");
                        if ($query) {
                            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                            $result[$key]['manager'] = $temp[0];
                        }
                    }

                    $listMember = explode(",", $item['memberId']);
                    $result[$key]['member'] = array();
                    foreach ($listMember as $memberId) {
                        $query = $this->db->query("SELECT id,name,email,
                        IF(avatar='',CONCAT('" . URLFILE . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/',avatar)) AS avatar
                        FROM staffs WHERE id= $memberId ");
                        if ($query) {
                            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                            array_push($result[$key]['member'], $temp[0]);
                        }
                    }
                }
                return $result;
            }
        } else {
            return 0;
        }
    }

    function listProjectTasks($projectId)
    {
        $result = array();
        $query = $this->db->query("SELECT *,
        IF(image='',CONCAT('" . URLFILE . "','/uploads/nofile.png'),CONCAT('" . URLFILE . "/',image)) AS image,
        IFNULL((SELECT name FROM tasklabels WHERE id=a.label),'') AS labelName,
        IFNULL((SELECT color FROM tasklabels WHERE id=a.label),'') AS labelColor,
        IFNULL((SELECT name FROM taskstatus WHERE id=a.status),'') AS statusName,
        IFNULL((SELECT color FROM taskstatus WHERE id=a.status),'') AS statusColor
        FROM tasks a WHERE status > 0 AND projectId=$projectId ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $item) {
                $assignerId = $item['assignerId'];
                $result[$key]['assigner'] = array();
                if ($assignerId > 0) {
                    $query = $this->db->query("SELECT id,name,email,
                    IF(avatar='',CONCAT('" . URLFILE . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/',avatar)) AS avatar
                    FROM staffs WHERE id= $assignerId ");
                    if ($query) {
                        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                        $result[$key]['assigner'] = $temp[0];
                    }
                }
                $assigneeId = $item['assigneeId'];
                $result[$key]['assignee'] = array();
                if ($assigneeId > 0) {
                    $query = $this->db->query("SELECT id,name,email,
                    IF(avatar='',CONCAT('" . URLFILE . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/',avatar)) AS avatar
                    FROM staffs WHERE id= $assigneeId ");
                    if ($query) {
                        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                        $result[$key]['assignee'] = $temp[0];
                    }
                }
            }
            return $result;
        } else {
            return 0;
        }
    }

    function listPersonalTasks($staffId)
    {
        $result = array();
        $query = $this->db->query("SELECT *,
        IF(image='',CONCAT('" . URLFILE . "','/uploads/nofile.png'),CONCAT('" . URLFILE . "/',image)) AS image,
        IFNULL((SELECT name FROM tasklabels WHERE id=a.label),'') AS labelName,
        IFNULL((SELECT color FROM tasklabels WHERE id=a.label),'') AS labelColor,
        IFNULL((SELECT name FROM taskstatus WHERE id=a.status),'') AS statusName,
        IFNULL((SELECT color FROM taskstatus WHERE id=a.status),'') AS statusColor
        FROM tasks a WHERE status > 0 AND (assigneeId=$staffId OR assignerId=$staffId) AND projectId = 0 ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $item) {
                $assignerId = $item['assignerId'];
                $result[$key]['assigner'] = array();
                if ($assignerId > 0) {
                    $query = $this->db->query("SELECT id,name,email,
                    IF(avatar='',CONCAT('" . URLFILE . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/',avatar)) AS avatar
                    FROM staffs WHERE id= $assignerId ");
                    if ($query) {
                        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                        $result[$key]['assigner'] = $temp[0];
                    }
                }
                $assigneeId = $item['assigneeId'];
                $result[$key]['assignee'] = array();
                if ($assigneeId > 0) {
                    $query = $this->db->query("SELECT id,name,email,
                    IF(avatar='',CONCAT('" . URLFILE . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/',avatar)) AS avatar
                    FROM staffs WHERE id= $assigneeId ");
                    if ($query) {
                        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                        $result[$key]['assignee'] = $temp[0];
                    }
                }
            }
            return $result;
        } else {
            return 0;
        }
    }

    function detailTask($taskId)
    {
        $result = array();
        $query = $this->db->query("SELECT *,
            IF(image='',CONCAT('" . URLFILE . "','/uploads/nofile.png'),CONCAT('" . URLFILE . "/',image)) AS image,
            IFNULL((SELECT name FROM tasklabels WHERE id=a.label),'') AS labelName,
            IFNULL((SELECT color FROM tasklabels WHERE id=a.label),'') AS labelColor,
            IFNULL((SELECT name FROM taskstatus WHERE id=a.status),'') AS statusName,
            IFNULL((SELECT color FROM taskstatus WHERE id=a.status),'') AS statusColor
            FROM tasks a WHERE status>0 AND id=$taskId");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $assignerId = $result[0]['assignerId'];
            $result[0]['assigner'] = array();
            if ($assignerId > 0) {
                $query = $this->db->query("SELECT id,name,email,
                IF(avatar='',CONCAT('" . URLFILE . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/',avatar)) AS avatar
                FROM staffs WHERE id= $assignerId ");
                if ($query) {
                    $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                    $result[0]['assigner'] = $temp[0];
                }
            }

            $assigneeId = $result[0]['assigneeId'];
            $result[0]['assignee'] = array();
            if ($assigneeId > 0) {
                $query = $this->db->query("SELECT id,name,email,
            IF(avatar='',CONCAT('" . URLFILE . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/',avatar)) AS avatar
            FROM staffs WHERE id= $assigneeId ");
                if ($query) {
                    $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                    $result[0]['assignee'] = $temp[0];
                }
            }
            return $result;
        } else {
            return 0;
        }
    }

    function listTaskComments($taskId)
    {
        $result = array();
        $query = $this->db->query("SELECT *
            FROM commenttasks WHERE status>0 AND taskId=$taskId ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $item) {
                $staffId = $item['staffId'];
                $result[0]['staff'] = array();
                if ($staffId > 0) {
                    $query = $this->db->query("SELECT id,name,email,
                    IF(avatar='',CONCAT('" . URLFILE . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/',avatar)) AS avatar
                    FROM staffs WHERE id= $staffId ");
                    if ($query) {
                        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                        $result[$key]['staff'] = $temp[0];
                    }
                }
            }
            return $result;
        } else {
            return 0;
        }
    }

    function detailTaskComment($commentId)
    {
        $result = array();
        $query = $this->db->query("SELECT *
            FROM commenttasks WHERE status>0 AND id=$commentId");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    function createTaskComment($data)
    {
        if ($this->insert("commenttasks", $data))
            return $this->db->lastInsertId();
        else
            return 0;
    }

    function listTaskFiles($taskId)
    {
        $result = array();
        $query = $this->db->query("SELECT *,
            IF(linkToFile='',CONCAT('" . URLFILE . "','/uploads/nofile.png'),CONCAT('" . URLFILE . "/',linkToFile)) AS linkToFile
            FROM taskfiles WHERE status>0 AND taskId=$taskId ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    function createTaskFile($data)
    {
        if ($this->insert("taskfiles", $data))
            return $this->db->lastInsertId();
        else
            return 0;
    }

    function detailTaskFile($fileId)
    {
        $result = array();
        $query = $this->db->query("SELECT *,
            IF(linkToFile='',CONCAT('" . URLFILE . "','/uploads/nofile.png'),CONCAT('" . URLFILE . "/',linkToFile)) AS linkToFile
            FROM taskfiles WHERE status>0 AND id=$fileId");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    // function getTaskSubs($taskId)
    // {
    //     $result = array();
    //     $query = $this->db->query("SELECT *
    //         FROM tasksubs WHERE status>0 AND taskId=$taskId ORDER BY id DESC ");
    //     if ($query) {
    //         $result = $query->fetchAll(PDO::FETCH_ASSOC);
    //         return $result;
    //     } else {
    //         return 0;
    //     }
    // }

    // function addTaskSub($data)
    // {
    //     if ($this->insert("tasksubs", $data))
    //         return $this->db->lastInsertId();
    //     else
    //         return 0;
    // }

    function filterTask($staffId, $projectId, $statusId)
    {
        $result = array();
        $dieukien = " WHERE (assigneeId=$staffId OR assignerId=$staffId) AND projectId=$projectId ";
        if ($statusId != '')
            $dieukien .= " AND status=$statusId ";
        else
            $dieukien .= " AND status>0 ";
        $query = $this->db->query("SELECT *,
            IF(image='',CONCAT('" . URLFILE . "','/uploads/nofile.png'),CONCAT('" . URLFILE . "/',image)) AS image,
            IFNULL((SELECT name FROM tasklabels WHERE id=a.label),'') AS labelName,
            IFNULL((SELECT color FROM tasklabels WHERE id=a.label),'') AS labelColor,
            IFNULL((SELECT name FROM taskstatus WHERE id=a.status),'') AS statusName,
            IFNULL((SELECT color FROM taskstatus WHERE id=a.status),'') AS statusColor
            FROM tasks a $dieukien ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $item) {
                $assignerId = $item['assignerId'];
                $result[$key]['assigner'] = array();
                if ($assignerId > 0) {
                    $query = $this->db->query("SELECT id,name,email,
                    IF(avatar='',CONCAT('" . URLFILE . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/',avatar)) AS avatar
                    FROM staffs WHERE id= $assignerId ");
                    if ($query) {
                        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                        $result[$key]['assigner'] = $temp[0];
                    }
                }
                $assigneeId = $item['assigneeId'];
                $result[$key]['assignee'] = array();
                if ($assigneeId > 0) {
                    $query = $this->db->query("SELECT id,name,email,
                    IF(avatar='',CONCAT('" . URLFILE . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/',avatar)) AS avatar
                    FROM staffs WHERE id= $assigneeId ");
                    if ($query) {
                        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                        $result[$key]['assignee'] = $temp[0];
                    }
                }
            }
            return $result;
        } else {
            return 0;
        }
    }

    function createTask($data)
    {
        if ($this->insert("tasks", $data))
            return $this->db->lastInsertId();
        else
            return 0;
    }

    function updateTask($id, $data)
    {
        if ($this->update("tasks", $data, "id=$id")) {
            return 1;
        } else {
            return 0;
        }
    }

    // function get_data($nhanvien){
    //     $query = $this->db->query("SELECT id, name AS title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
    //         (SELECT count(1) FROM tasksfiles WHERE tasks_id=a.id) AS attachments,
    //         (SELECT count(1) FROM commenttask WHERE cong_viec=a.id) AS commenttasks,
    //         label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
    //         (SELECT hinh_anh FROM nhanvien WHERE id=nguoi_giao) AS assigned,
    //         (SELECT name FROM nhanvien WHERE id=nguoi_giao) AS members,
    //         (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
    //         (SELECT name FROM nhanvien WHERE id=nhan_vien) AS nhanvien
    //         FROM tasks a WHERE tinh_trang=1 AND nhan_vien=$nhanvien ORDER BY id DESC ");
    //     $viecmoi = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $query = $this->db->query("SELECT id, name AS title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
    //         (SELECT count(1) FROM tasksfiles WHERE tasks_id=a.id) AS attachments,
    //         (SELECT count(1) FROM commenttask WHERE cong_viec=a.id) AS commenttasks,
    //         label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
    //         (SELECT hinh_anh FROM nhanvien WHERE id=nguoi_giao) AS assigned,
    //         (SELECT name FROM nhanvien WHERE id=nguoi_giao) AS members,
    //         (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
    //         (SELECT name FROM nhanvien WHERE id=nhan_vien) AS nhanvien
    //         FROM tasks a WHERE tinh_trang=2 AND nhan_vien=$nhanvien ORDER BY id DESC ");
    //     $danglam = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $query = $this->db->query("SELECT id, name AS title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
    //         (SELECT count(1) FROM tasksfiles WHERE tasks_id=a.id) AS attachments,
    //         (SELECT count(1) FROM commenttask WHERE cong_viec=a.id) AS commenttasks,
    //         label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
    //         (SELECT hinh_anh FROM nhanvien WHERE id=nguoi_giao) AS assigned,
    //         (SELECT name FROM nhanvien WHERE id=nguoi_giao) AS members,
    //         (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
    //         (SELECT name FROM nhanvien WHERE id=nhan_vien) AS nhanvien
    //         FROM tasks a WHERE tinh_trang=3 AND nhan_vien=$nhanvien ORDER BY id DESC ");
    //     $deadline = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $query = $this->db->query("SELECT id, name AS title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
    //         (SELECT count(1) FROM tasksfiles WHERE tasks_id=a.id) AS attachments,
    //         (SELECT count(1) FROM commenttask WHERE cong_viec=a.id) AS commenttasks,
    //         label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
    //         (SELECT hinh_anh FROM nhanvien WHERE id=nguoi_giao) AS assigned,
    //         (SELECT name FROM nhanvien WHERE id=nguoi_giao) AS members,
    //         (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
    //         (SELECT name FROM nhanvien WHERE id=nhan_vien) AS nhanvien
    //         FROM tasks a WHERE tinh_trang=4 AND nhan_vien=$nhanvien ORDER BY id DESC ");
    //     $daxong = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $query = $this->db->query("SELECT id, name AS title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
    //         (SELECT count(1) FROM tasksfiles WHERE tasks_id=a.id) AS attachments,
    //         (SELECT count(1) FROM commenttask WHERE cong_viec=a.id) AS commenttasks,
    //         label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
    //         (SELECT hinh_anh FROM nhanvien WHERE id=nguoi_giao) AS assigned,
    //         (SELECT name FROM nhanvien WHERE id=nguoi_giao) AS members,
    //         (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
    //         (SELECT name FROM nhanvien WHERE id=nhan_vien) AS nhanvien
    //         FROM tasks a WHERE tinh_trang=6 AND nhan_vien=$nhanvien ORDER BY id DESC ");
    //     $hoanthanh = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $data = [
    //         array("id"=>"1","title"=>"Việc mới","item"=>$viecmoi),
    //         array("id"=>"2","title"=>"Đang làm","item"=>$danglam),
    //         array("id"=>"3","title"=>"Trễ deadline","item"=>$deadline),
    //         array("id"=>"4","title"=>"Đã xong","item"=>$daxong),
    //         array("id"=>"6","title"=>"Hoàn thành","item"=>$hoanthanh),
    //         // array("id"=>"60","title"=>"Thùng rác","item"=>array(0=>array('id'=>0, 'badge-text'=>'Xóa bỏ', 'badge'=>'danger')))
    //     ];
    //     return $data;
    //     // $query = $this->db->query("SELECT id, name AS title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
    //     //     (SELECT count(1) FROM tasksfiles WHERE tasks_id=a.id) AS attachments,
    //     //     (SELECT count(1) FROM taskssub WHERE tasks_id=a.id) AS commenttasks,
    //     //     label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
    //     //     (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS assigned,
    //     //     (SELECT name FROM nhanvien WHERE id=nhan_vien) AS members,
    //     //     (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
    //     //     (SELECT name FROM nhanvien WHERE id=nhan_vien) AS nhanvien
    //     //     FROM tasks a WHERE tinh_trang IN (1,2,4) AND nguoi_giao=$nhanvien AND nhan_vien!=$nhanvien ORDER BY id DESC ");
    //     // $dagiao = $query->fetchAll(PDO::FETCH_ASSOC);
    // }

    // function get_nhanvien($id){
    //     $result = array();
    //     $query = $this->db->query("SELECT id, name AS `text`
    //           FROM nhanvien WHERE tinh_trang IN (1,2,3,4) ORDER BY name ASC");
    //     if ($query) {
    //         $temp = $query->fetchAll(PDO::FETCH_ASSOC);
    //         foreach ($temp AS $key=>$val)
    //             if ($val['id']==$id)
    //                 $temp[$key]['selected']=true;
    //         $result = $temp;
    //     }
    //     return $result;
    // }

    // function getitem($id){
    //     $result = array();
    //     $query = $this->db->query("SELECT *,
    //         (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS avatar
    //         FROM tasks WHERE id=$id");
    //     if ($query) {
    //         $data = $query->fetchAll(PDO::FETCH_ASSOC);
    //         $query = $this->db->query("SELECT ngay_gio, noi_dung,
    //            (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
    //            (SELECT name FROM nhanvien WHERE id=nhan_vien) AS nhanvien
    //            FROM commenttask WHERE cong_viec=$id ORDER BY ngay_gio DESC ");
    //         $commenttask = array();
    //         if ($query)
    //             $commenttask = $query->fetchAll(PDO::FETCH_ASSOC);
    //         $comtext = '';
    //         foreach ($commenttask AS $row)
    //             $comtext .= '<div class="media mb-1"><div class="avatar bg-light-success my-0 ml-0 mr-50"><img src="'.$row['hinhanh'].'" alt="Avatar" height="32" /></div><div class="media-body"><p class="mb-0"><span class="font-weight-bold">'.$row['nhanvien'].'</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small class="text-muted">'.$row['ngay_gio'].'</small></p><p>'.$row['noi_dung'].'</p></div></div>';
    //         $result = ['data'=>$data[0], 'commenttask'=>$comtext];
    //     }
    //     return $result;
    // }

    // function capnhat($id, $data, $file, $commenttask) {
    //     if ($id==0) {
    //         $data['tinh_trang']=1;
    //         $data['ngay_giao']=date('Y-m-d');
    //         $data['updated']=date('Y-m-d');
    //         $data['nguoi_giao']=$_SESSION['user']['nhan_vien'];
    //         $query = $this->insert("tasks", $data);
    //         $id = $this->db->lastInsertId();
    //     }
    //     else
    //         $query = $this->update("tasks", $data, " id=$id ");
    //     if ($commenttask!='<p></p>') {
    //         $row = ['nhan_vien'=>$_SESSION['user']['nhan_vien'], 'cong_viec'=>$id, 'ngay_gio'=>date('Y-m-d H:i:s'),'noi_dung'=>$commenttask, 'tinh_trang'=>1];
    //         $query = $this->insert("commenttask", $row);
    //     }
    //     return $query;
    // }

    // function move($id, $data){
    //     $query = $this->update("tasks", $data, " id=$id ");
    //     return $query;
    // }
    // //
    // // function get_info_detail_nhanvien($id){
    // //     $query = $this->db->query("SELECT * FROM nhanvien WHERE id = $id");
    // //     return $query->fetchAll();
    // // }
    // //
    // // function get_chatbox_via_code($code){
    // //     $query = $this->db->query("SELECT * FROM chatbox WHERE code = '$code'");
    // //     return $query->fetchAll();
    // // }
    // //
    // // function addObj($data){
    // //     $query = $this->insert("chatbox", $data);
    // //     return $query;
    // // }
    // //
    // function delObj($id){
    //     $data = array('tinh_trang'=>0);
    //     $query = $this->update("tasks", $data, " id=$id ");
    //     return $query;
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
