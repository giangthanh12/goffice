<?php

class document_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function listObj()
    {
        $dieukien = " WHERE status > 0 ";
        $query = $this->db->query("SELECT *,
            DATE_FORMAT(dateTime,'%d/%m/%Y') as Date,
            (SELECT name FROM staffs WHERE id = staffId) as staffName
            FROM document  $dieukien ORDER BY Date DESC ");
            if($query){
                $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
         }
    }

    // function get_data_combo()
    // {
    //     $result = array();
    //     $query = $this->db->query("SELECT id, name AS text FROM document WHERE status = 1 ");
    //     $result['items'] = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }

    function addObj($data)
    {
        $query = $this->insert("document", $data);
        return $query;
    }

    // function addRecord($data){

    //     $query = $this->insert("records", $data);
    // }

    function getdata($id)
    {
        $result = array();
        $dieukien = "  WHERE id = $id ";
        $query = $this->db->query("SELECT *,
                 DATE_FORMAT(dateTime,'%d/%m/%Y') as Date
                FROM document $dieukien ORDER BY id DESC");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("document", $data, "id = $id");
        return $query;
    }

    function delObj($id, $data)
    {
        $query = $this->update("document", $data, "id = $id");
        return $query;
    }


}

?>