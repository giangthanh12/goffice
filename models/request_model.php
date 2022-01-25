<?php

class request_model extends Model
{
    function __construst()
    {
        parent::__construst();
    }


    function getALlRequestSteps($stepId)
    {
        $data = array();
        $query = $this->db->query("SELECT requestId FROM requestprocesses WHERE stepId=$stepId AND status=1");
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        $listRequest = "";
        foreach ($rows as $item) {
            $listRequest .= $item['requestId'] . ",";
        }
        if ($listRequest != '') {
            $listRequest = rtrim($listRequest, ",");
            $where = " WHERE status = 1 AND id IN ($listRequest) ";
            $query = $this->db->query("SELECT id, title,staffId,departmentId,
            DATE_FORMAT(dateTime,'%d/%m/%Y') as dateTime,
            (SELECT name FROM staffs WHERE id=a.staffId) as staffName,
            (SELECT avatar FROM staffs WHERE id=a.staffId) as staffAvatar,
            (SELECT name FROM department WHERE id=a.departmentId) as departmentName
            FROM requests a $where ");
            if ($query)
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    function getAllStep($defineId)
    {
        $data = array();
        $where = " WHERE status >0 AND defineId=$defineId ";
        $query = $this->db->query("SELECT id,name,reviewerId,processors
            FROM requeststeps a $where ");
        if ($query)
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getALlRequests($defineId, $status)
    {
        $data = array();
        $where = " WHERE status = $status AND defineId=$defineId ";
        $query = $this->db->query("SELECT id, title,staffId,departmentId,
        DATE_FORMAT(dateTime,'%d/%m/%Y') as dateTime,
       (SELECT name FROM staffs WHERE id=a.staffId) as staffName,
       (SELECT avatar FROM staffs WHERE id=a.staffId) as staffAvatar,
        (SELECT name FROM department WHERE id=a.departmentId) as departmentName
            FROM requests a $where ");
        if ($query)
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getDepartments()
    {
        $data = array();
        $where = " WHERE status = 1 ";
        $query = $this->db->query("SELECT id, name as text
            FROM department a $where ");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getStaffs($staffIds)
    {
        if ($staffIds != '')
            $where = " WHERE status IN (1,2,3,4) AND id IN ($staffIds)";
        else
            $where = " WHERE status IN (1,2,3,4)";
        $query = $this->db->query("SELECT id, name,avatar
            FROM staffs a $where ");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getProperties($defineId, $requestId)
    {
        $where = " WHERE status >0 AND defineId=$defineId";
        $query = $this->db->query("SELECT *,
            IFNULL((SELECT value FROM subrequests WHERE status=1 AND requestId=$requestId AND objectId=a.id LIMIT 1),'') AS value 
            FROM requestobjects a $where ");


        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getRequestDefines()
    {
        $where = " WHERE status >0 ";
        $query = $this->db->query("SELECT *
            FROM definerequests a $where ");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getSubrequestId($requestId, $objectId)
    {
        $where = " WHERE status >0 AND objectId=$objectId AND requestId=$requestId ";
        $query = $this->db->query("SELECT id
            FROM subrequests a $where ");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($data[0]['id']))
            return $data[0]['id'];
        else
            return 0;
    }

    function getStep($defineId, $id)
    {
        $where = " WHERE status >0 AND defineId=$defineId AND id!=$id ORDER BY sortorder ASC";
        $query = $this->db->query("SELECT id
            FROM requeststeps a $where LIMIT 1");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($data[0]['id']))
            return $data[0]['id'];
        else
            return 0;
    }

    function checkRequestProcess($requestId, $stepId)
    {
        $where = " WHERE status >0 AND requestId=$requestId AND stepId=$stepId ";
        $query = $this->db->query("SELECT COUNT(id) AS total
            FROM requestprocesses a $where ");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data[0]['total'];
    }

    function addRequest($data)
    {
        $ok = $this->insert("requests", $data);
        if ($ok)
            return $this->db->lastInsertId();
        else
            return 0;
    }

    function updateRequest($id, $data)
    {
        return $this->update("requests", $data, "id=$id");
    }

    function updateProperty($id, $data)
    {
        return $this->update("subrequests", $data, "id=$id");
    }

    function addProperty($data)
    {
        return $this->insert("subrequests", $data);
    }

    function addStep($data)
    {
        return $this->insert("requestprocesses", $data);
    }
}

?>
