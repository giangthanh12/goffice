<?php
class chinhanh_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_data_combo(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS text FROM branch WHERE status > 0 ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function listObj(){
        $query = $this->db->query("SELECT *
            FROM branch WHERE status > 0 ORDER BY id DESC ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addObj($data)
    {
        $query = $this->insert("branch",$data);
        return $query;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT *
                FROM branch WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("branch",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("branch",$data,"id = $id");
        return $query;
    }

}
?>