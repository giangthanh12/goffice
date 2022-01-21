<?php
class contracttype_model extends model{
    function __construct(){
        parent::__construct();
    }


    function listObj(){
        $where = " WHERE status > 0 ";
        $query = $this->db->query("SELECT *
            FROM contracttype a $where ORDER BY id DESC ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getdata($id){
        $where = " WHERE status > 0 AND id=$id ";
        $query = $this->db->query("SELECT *
            FROM contracttype a $where ");
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        return $row[0];
    }

    function addObj($data)
    {
        $query = $this->insert("contracttype",$data);
        return $query;
    }


    function updateObj($id, $data)
    {
        $query = $this->update("contracttype",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("contracttype",$data,"id = $id");
        return $query;
    }

}
?>