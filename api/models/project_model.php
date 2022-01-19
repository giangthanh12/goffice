<?php
class project_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function listProjectStatus()
    {
        $result = array();
        $query = $this->db->query("SELECT *
        FROM projectstatus WHERE status > 0 ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    function listProjectLevels()
    {
        $result = array();
        $query = $this->db->query("SELECT *
        FROM projectlevels WHERE status > 0 ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    function checkName($id, $name)
    {
        $dieukien = " WHERE name LIKE '$name' AND status > 0 ";
        if ($id > 0) {
            $dieukien .= " AND id != $id ";
        }
        $query = $this->db->query("SELECT COUNT(1) AS total
            FROM projects $dieukien ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $total = $result[0]['total'];
            if ($total > 0)
                return 0;
            else
                return 1;
        }
    }

    // function getData()
    // {
    //     $result = array();
    //     $query = $this->db->query("SELECT *,
    //         IF(image='',CONCAT('" . URLFILE . "','/uploads/nofile.png'),CONCAT('" . URLFILE . "/',image)) AS image
    //         FROM projects WHERE status > 0 ORDER BY id DESC ");
    //     if ($query) {
    //         $result = $query->fetchAll(PDO::FETCH_ASSOC);
    //         return $result;
    //     } else {
    //         return 0;
    //     }
    // }

    function detailProject($projectId)
    {
        $result = array();
        $query = $this->db->query("SELECT *,
            IF(image='',CONCAT('" . URLFILE . "','/uploads/nofile.png'),CONCAT('" . URLFILE . "/',image)) AS image
            FROM projects WHERE status > 0 AND id=$projectId ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $item) {
                $managerId = $item['managerId'];
                    $result[$key]['manager'] = array();
                    if($managerId>0) {
                        $query = $this->db->query("SELECT id,name,email,
                        IF(avatar='',CONCAT('" . URLFILE . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/',avatar)) AS avatar
                        FROM staffs WHERE id= $managerId");
                        if($query) {
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
                        if($query) {
                            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                            array_push($result[$key]['member'], $temp[0]);
                        }
                    }
            }
            return $result;
        } else {
            return 0;
        }
    }

    function createProject($data)
    {
        if ($this->insert("projects", $data))
            return $this->db->lastInsertId();
        else
            return 0;
    }

    function updateProject($id, $data)
    {
        if ($this->update("projects", $data, "id=$id")) {
            return 1;
        } else {
            return 0;
        }
    }

    function updateProjectTasks($id, $data)
    {
        if ($this->update("tasks", $data, "projectId=$id")) {
            return 1;
        } else {
            return 0;
        }
    }
}
