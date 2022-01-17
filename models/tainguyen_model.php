<?php
class Tainguyen_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getFetObj($nhanvienid, $draw, $keyword, $offset, $rows)
    {
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM resource WHERE name LIKE '%$keyword%'
                                    AND (creatorId = $nhanvienid OR FIND_IN_SET($nhanvienid, staffId))");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, name, owner, supplier, link, username, password, note, classify, creatorId, 
                                (SELECT customers.name FROM customers WHERE customers.id = owner) AS chusohuu, 
                                (SELECT customers.name FROM customers WHERE customers.id = supplier) AS nhacungcap,
                                (SELECT classify.name FROM classify WHERE classify.id = classify) AS phanloai, 
                                (SELECT staffs.name FROM staffs WHERE staffs.id = creatorId) AS nguoitao 
                                FROM resource WHERE status = 1 AND name LIKE '%$keyword%' AND (creatorId = $nhanvienid OR FIND_IN_SET($nhanvienid, staffId)) ORDER BY id DESC LIMIT $offset, $rows");
        $result['draw'] = intval($draw);
        $result['recordsTotal'] = $row[0]['Total'];
        $result['recordsFiltered'] = $row[0]['Total'];
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_detail_tainguyen($id)
    {
        $result = array();
        $query = $this->db->query("SELECT id, name, owner, supplier, link, username, password, note, classify, creatorId, 
                                (SELECT customers.name FROM customers WHERE customers.id = owner) AS chusohuu, 
                                (SELECT customers.name FROM customers WHERE customers.id = supplier) AS nhacungcap,
                                (SELECT classify.name FROM classify WHERE classify.id = classify) AS phanloai, 
                                (SELECT staffs.name FROM staffs WHERE staffs.id = creatorId) AS nguoitao 
                                    FROM resource WHERE id = $id");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getnhanvien($id)
    {
        $result = array();
        $query = $this->db->query("SELECT staffId
                                    FROM resource WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if($temp)
            $result = $temp[0]['staffId'];
        return $result;
    }


    function addObj($data)
    {
        $query = $this->insert("resource", $data);
        return $query;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("resource", $data, "id = $id");
        return $query;
    }

    function chiase($data, $id)
    {
        $result = $this->update("resource", $data, " id=$id ");
        return $result;
    }

    function delObj($id)
    {
        $query = $this->update("resource",['status' => 0] ,"id = $id");
        return $query;
    }
}
