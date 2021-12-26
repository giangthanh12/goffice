<?php
class grouptask_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function checkName($id, $name)
    {
        if ($id > 0) {
            $query = $this->db->query("SELECT COUNT(1) AS total
            FROM grouptasks WHERE name LIKE '$name' AND id != $id AND status > 0");
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
            FROM grouptasks WHERE name LIKE '$name' AND status > 0");
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
        $query = $this->db->query("SELECT *
            FROM grouptasks WHERE status > 0 ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    function getGroupTask($groupId)
    {
        $result = array();
        $query = $this->db->query("SELECT *
            FROM grouptasks WHERE status>0 AND id=$groupId ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    function addGroupTask($data)
    {
        if ($this->insert("grouptasks", $data))
            return $this->db->lastInsertId();
        else
            return 0;
    }

    function updateGroupTask($id, $data)
    {
        if ($this->update("grouptasks", $data, "id=$id")) {
            return 1;
        } else {
            return 0;
        }
    }

}
