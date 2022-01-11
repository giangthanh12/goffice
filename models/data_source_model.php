<?php
class data_source_model extends Model{
    function __construct(){
        parent::__construct();
    }

    function listObj(){
        $query = $this->db->query("SELECT *
            FROM datasource a WHERE status > 0 ORDER BY id DESC ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addObj($data)
    {
        $query = $this->insert("datasource",$data);
        return $query;
    }

    function getData($id){
        $result = array();
        $query = $this->db->query("SELECT *
                FROM datasource WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("datasource",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("datasource",$data,"id = $id");
        return $query;
    }

}
?>