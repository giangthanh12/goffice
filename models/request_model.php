<?php

class request_model extends Model
{
    function __construst()
    {
        parent::__construst();
    }


    function getALlRequestSteps($stepId, $defineId)
    {
        $data = array();
        $query = $this->db->query("SELECT requestId FROM requestprocesses WHERE stepId=$stepId AND status IN (1,3)");
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        $listRequest = "";
        foreach ($rows as $item) {
            $listRequest .= $item['requestId'] . ",";
        }
        if ($listRequest != '') {
            $staffId = $_SESSION['user']['staffId'];
            if ($_SESSION['user']['classify'] == 1) {
                $view = 1;
            } else {
                $qr = $this->db->query("SELECT processors,reviewerId FROM requeststeps WHERE defineId=$defineId AND status > 0");
                $temp = $qr->fetchAll(PDO::FETCH_ASSOC);
                $view = 2;
                foreach ($temp as $item) {
                    if ($item['reviewerId'] == $staffId) {
                        $view = 1;
                        break;
                    }
                    if ($item['processors'] != '') {
                        $processors = explode(",", $item['processors']);
                        if (in_array($staffId, $processors)) {
                            $view = 1;
                            break;
                        }
                    }
                }
            }

            $listRequest = rtrim($listRequest, ",");
            $where = " WHERE status IN (1,3) AND id IN ($listRequest) AND (staffId=$staffId OR $view=1)";
            $query = $this->db->query("SELECT id, title,staffId,departmentId,
            DATE_FORMAT(dateTime,'%d/%m/%Y') as dateTime,
            (SELECT name FROM staffs WHERE id=a.staffId) as staffName,
            (SELECT avatar FROM staffs WHERE id=a.staffId) as staffAvatar,
            (SELECT name FROM department WHERE id=a.departmentId) as departmentName,
            (SELECT GROUP_CONCAT(staffId separator ',') FROM requestprocesses WHERE requestId=a.id AND status=2) as processors,
            (SELECT GROUP_CONCAT(staffId separator ',') FROM requestprocesses WHERE requestId=a.id AND status=3) as refusers,
            (SELECT status FROM requestprocesses WHERE requestId=a.id AND stepId=$stepId AND status>0 LIMIT 1) as stepStatus
            FROM requests a $where ");
            if ($query)
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    function getDetailRequest($requestId) {
        $data = array();
        $where = " WHERE status >0 AND requestId=$requestId ";
        $query = $this->db->query("SELECT *
            FROM subrequests $where ");
        if ($query)
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
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
        $staffId = $_SESSION['user']['staffId'];
        if ($_SESSION['user']['classify'] == 1) {
            $view = 1;
        } else {
            $qr = $this->db->query("SELECT processors,reviewerId FROM requeststeps WHERE defineId=$defineId AND status > 0");
            $temp = $qr->fetchAll(PDO::FETCH_ASSOC);
            $view = 2;
            foreach ($temp as $item) {
                if ($item['reviewerId'] == $staffId) {
                    $view = 1;
                    break;
                }
                if ($item['processors'] != '') {
                    $processors = explode(",", $item['processors']);
                    if (in_array($staffId, $processors)) {
                        $view = 1;
                        break;
                    }
                }
            }
        }
        $data = array();
        $where = " WHERE status = $status AND defineId=$defineId AND (staffId=$staffId OR $view=1)";
        $query = $this->db->query("SELECT id, title,staffId,departmentId,status,
            DATE_FORMAT(dateTime,'%d/%m/%Y') as dateTime,
           (SELECT name FROM staffs WHERE id=a.staffId) as staffName,
           (SELECT avatar FROM staffs WHERE id=a.staffId) as staffAvatar,
            (SELECT name FROM department WHERE id=a.departmentId) as departmentName,
           (SELECT GROUP_CONCAT(staffId separator ',') FROM requestprocesses WHERE requestId=a.id AND status=2) as processors,
           (SELECT GROUP_CONCAT(staffId separator ',') FROM requestprocesses WHERE requestId=a.id AND status=3) as refusers 
            FROM requests a $where ");
        if ($query)
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getALlRequestLists($defineId, $status, $staffId)
    {
        $listDefineIds = [];
        $qr = $this->db->query("SELECT processors,reviewerId,defineId FROM requeststeps WHERE status > 0");
        $temp = $qr->fetchAll(PDO::FETCH_ASSOC);
        foreach ($temp as $item) {
            if (in_array($item['defineId'], $listDefineIds))
                continue;
            else {
                if ($item['reviewerId'] == $staffId) {
                    $listDefineIds[] = $item['defineId'];
                }
                if ($item['processors'] != '') {
                    $processors = explode(",", $item['processors']);
                    if (in_array($staffId, $processors)) {
                        $listDefineIds[] = $item['defineId'];
                    }
                }
            }
        }
        $data = array();
        if($status>0)
            $where = " WHERE status = $status";
        else
            $where = " WHERE status > 0 ";
        if(count($listDefineIds)>0){
            
            $listDefineIds = implode(",",$listDefineIds);
            
            $where.=" AND (staffId=$staffId OR defineId IN ($listDefineIds)) ";
        }else{
            $where.=" AND staffId=$staffId ";
        }
        if($defineId > 0)
        $where.=" AND defineId=$defineId ";
        $query = $this->db->query("SELECT id, title,staffId,departmentId,status,dateTime,defineId,
            DATE_FORMAT(dateTime,'%d/%m/%Y') as dateTimeCV,
           (SELECT name FROM staffs WHERE id=a.staffId) as staffName,
           (SELECT avatar FROM staffs WHERE id=a.staffId) as staffAvatar,
            (SELECT name FROM department WHERE id=a.departmentId) as departmentName
            FROM requests a $where ORDER BY dateTime DESC");
        if ($query){
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $key=>$item){
                $requestId = $item['id'];
                $qr = $this->db->query("SELECT *,
                (SELECT name FROM requeststeps WHERE id=a.stepId) as stepName,
                (SELECT name FROM staffs WHERE id=a.staffId) as staffName
                /*(SELECT avatar FROM staffs WHERE id=a.staffId) as staffAvatar*/
                FROM requestprocesses a WHERE status > 0 AND requestId=$requestId 
                ORDER BY (SELECT sortorder FROM requeststeps WHERE id=a.stepId)");
                $data[$key]['processors']=$qr->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $data;
    }

    function getRequestProcess($requestId)
    {
        $where = " WHERE status > 1 AND requestId = $requestId";
        $query = $this->db->query("SELECT id,status,note,
            (SELECT name FROM requeststeps WHERE id=a.stepId) AS stepName,
            (SELECT avatar FROM staffs WHERE id=a.stepId) AS avatar,
            (SELECT name FROM staffs WHERE id=a.staffId) AS staffName,
            (SELECT name FROM requeststeps WHERE id=a.stepId) AS stepName,
            (SELECT phoneNumber FROM staffs WHERE id=a.staffId) AS phoneNumber
            FROM requestprocesses a $where ");
        return $query->fetchAll(PDO::FETCH_ASSOC);

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

    function getProcessors($staffId)
    {
        $where = " WHERE status IN (1,2,3,4) AND id =$staffId";
        $query = $this->db->query("SELECT id, name,avatar
            FROM staffs a $where ");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($data[0]))
            return $data[0];
        else
            return [];
    }

    function getStaffs()
    {
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

    function getStep($defineId, $requestId)
    {
        $where = " WHERE status >0 AND defineId=$defineId 
        AND id NOT IN (SELECT stepId FROM requestprocesses WHERE requestId=$requestId AND status>0) ";
        // lấy những step không nằm trong 
        $query = $this->db->query("SELECT id
            FROM requeststeps a $where ORDER BY sortorder ASC LIMIT 1");
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

    function checkRequestCreator($requestId)
    {
        if ($_SESSION['user']['classify'] == 1)
            return 1;
        $staffId = $_SESSION['user']['staffId'];
        $where = " WHERE status > 0 AND id=$requestId AND staffId=$staffId ";
        $query = $this->db->query("SELECT COUNT(id) AS total
            FROM requests a $where ");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data[0]['total'];
    }

    function checkProcessorStep($stepId)
    {
        if ($_SESSION['user']['classify'] == 1)
            return 1;
        $staffId = $_SESSION['user']['staffId'];
        $where = " WHERE status > 0 AND id=$stepId ";
        $query = $this->db->query("SELECT processors
            FROM requeststeps a $where ");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($data[0]['processors']) && $data[0]['processors'] != '') {
            $processors = explode(",", $data[0]['processors']);
            if (in_array($staffId, $processors))
                return 1;
            else
                return 0;
        } else
            return 0;
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
        return $this->update("requests", $data, "id=$id AND status=1");
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

    function updateProcess($requestId, $stepId, $status, $data)
    {
        return $this->update("requestprocesses", $data, "requestId=$requestId AND stepId=$stepId AND status=$status");
    }
}

?>
