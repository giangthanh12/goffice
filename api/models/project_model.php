<?php
class project_model extends Model{
    function __construct(){
        parent::__construct();
    }

    function checkName($id, $name)
    {
        if ($id > 0) {
            $query = $this->db->query("SELECT COUNT(1) AS total
            FROM projects WHERE name LIKE '$name' AND id != $id AND status > 0");
            if ($query) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $total = $result[0]['total'];
                if ($total > 0)
                    return 0;
                else
                    return 1;
            }
        } else {
            $query = $this->db->query("SELECT COUNT(1) AS total
            FROM projects WHERE name LIKE '$name' AND status > 0");
            if ($query) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $total = $result[0]['total'];
                if ($total > 0)
                    return 0;
                else
                    return 1;
            }
        }
    }

    function getData()
    {
        $result = array();
        $query = $this->db->query("SELECT *,
            IF(image='',CONCAT('".URLFILE."','/uploads/nofile.png'),CONCAT('".URLFILE."/',image)) AS image
            FROM projects WHERE status > 0 ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    function getProject($projectId)
    {
        $result = array();
        $query = $this->db->query("SELECT *,
            IF(image='',CONCAT('".URLFILE."','/uploads/nofile.png'),CONCAT('".URLFILE."/',image)) AS image
            FROM projects WHERE status > 0 AND id=$projectId ORDER BY id DESC ");
        if($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    function addProject($data)
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

}
?>