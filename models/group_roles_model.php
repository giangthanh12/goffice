<?php
class group_roles_model extends Model{
    function __construct(){
        parent::__construct();
    }

    function listObj(){
        $query = $this->db->query("SELECT *
        FROM grouproles WHERE status > 0");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getGroupRole($id){
        $result = array();
        $query = $this->db->query("SELECT *
          FROM grouproles WHERE id=$id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function addGroupRole($data){
        $query = $this->insert("grouproles", $data);
        return $query;
    }

    function updateGroupRole($id, $data){
        $query = $this->update("grouproles", $data, " id=$id ");
        return $query;
    }

}
?>