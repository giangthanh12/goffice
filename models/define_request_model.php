<?php

class define_request_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function listObj()
    {
        $dieukien = " WHERE status = 1 ";
        $query = $this->db->query("SELECT * FROM definerequests $dieukien ORDER BY id DESC ");
        if ($query) {
            $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    function addObj($data)
    {
        $query = $this->insert("definerequests", $data);
        return $query;
    }

    function checkStep($defineId, $stepId)
    {
        if ($stepId > 0) {
            $query = $this->db->query("SELECT COUNT(id) as total  FROM requeststeps WHERE status = 1 AND defineId = $defineId AND id = $stepId");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($temp[0]['total'] > 0) {
                return 1;
            }
        } else {
            return 0;
        }
    }

    function checkObject($id, $ObjId)
    {
        if ($ObjId > 0) {
            $query = $this->db->query("SELECT COUNT(id) as total  FROM requestobjects WHERE status = 1 AND defineId = $id AND id = $ObjId");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($temp[0]['total'] > 0) {
                return 1;
            }
        } else {
            return 0;
        }
    }


    function addstep($data)
    {
        $query = $this->insert("requeststeps", $data);
        return $query;
    }
    function updatestep($id, $data)
    {
        $query = $this->update("requeststeps", $data, "id = $id");
        return $query;
    }

    function getLastId()
    {
        $result   = array();
        $dieukien = " WHERE status = 1 ORDER BY id DESC LIMIT 1 ";
        $query           = $this->db->query("SELECT id FROM definerequests $dieukien ");
        if ($query)
            $result  = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result[0]['id'];
    }

    function addObject($dataObject)
    {
        $query = $this->insert("requestobjects", $dataObject);
        return $query;
    }

    function getdata($id)
    {
        $result = array();
        $dieukien = "  WHERE id = $id ";
        $query = $this->db->query("SELECT * FROM definerequests $dieukien ORDER BY id DESC");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result['data'] = $temp[0];

        $query = $this->db->query("SELECT * FROM requestobjects WHERE defineId = $id AND status = 1 ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result['object'] = $temp;

        $query = $this->db->query("SELECT * FROM requeststeps WHERE defineId = $id AND status = 1 ORDER BY sortorder ASC ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result['step'] = $temp;
        return $result;
    }

    function getstep($id)
    {
        $result = array();
        $dieukien = "  WHERE id = $id ";
        $query = $this->db->query("SELECT * FROM requeststeps $dieukien ORDER BY id DESC");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("definerequests", $data, "id = $id");
        return $query;
    }

    function updateObject($ObjId, $dataObject)
    {
        $query = $this->update("requestobjects", $dataObject, "id = $ObjId");
        return $query;
    }


    function delObj($id, $data)
    {
        $query = $this->update("definerequests", $data, "id = $id");
        return $query;
    }

    function delObjects($listId, $id)
    {
        if ($listId != '') {
            $query = $this->db->query("SELECT id FROM requestobjects WHERE defineId = $id AND status = 1 AND id NOT IN ($listId)");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if (count($temp) > 0) {
                foreach ($temp as $item) {
                    $idobj = $item['id'];
                    $this->update("requestobjects", ['status' => 0], "id = $idobj");
                }
            }
        }
        return true;
    }

    function delObject($id)
    {
        $query = $this->update("requestobjects", ['status' => 0], "defineId = $id");
        return $query;
    }

    function delstep($id, $data)
    {
        $query = $this->update("requeststeps", $data, "id = $id");
        return $query;
    }

    function delsteps($listId, $defineId)
    {
        if ($listId != '') {
            $query = $this->db->query("SELECT id FROM requeststeps WHERE defineId = $defineId AND status = 1 AND id NOT IN ($listId)");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if (count($temp) > 0) {
                foreach ($temp as $item) {
                    $id = $item['id'];
                    $this->update("requeststeps", ['status' => 0], "id = $id");
                }
            }
        }
        return true;
    }

    function delAllSteps($defineId)
    {
        $query = $this->db->query("SELECT id FROM requeststeps WHERE defineId = $defineId AND status = 1");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($temp) > 0) {
            foreach ($temp as $item) {
                $stepId = $item['id'];
                $this->update("requeststeps", ['status' => 0], "id = $stepId");
            }
        }
        return true;
    }
}
