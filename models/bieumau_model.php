<?php
class bieumau_model extends Model{
    function __construct(){
        parent::__construct();
    }

    function listObj()
    {
        $result   = array();
        $query = $this->db->query("SELECT *,
            IF(updated='0000-00-00 00:00:00','',DATE_FORMAT(updated, '%d/%m/%Y')) AS ngaycapnhat,
            (SELECT name FROM staffs WHERE id = a.staffId) AS nguoinhap
            FROM form a WHERE status > 0 ORDER BY updated DESC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // function listDel(){
    //     $query = $this->db->query("SELECT * FROM form WHERE tinh_trang = 0 ");
    //     $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }

    function get_data_combo()
    {
        $result = array();
        $query = $this->db->query("SELECT id, name AS text FROM form WHERE status > 0 ");
        $result['items'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addObj($data)
    {
        $query = $this->insert("form",$data);
        return $query;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM form WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("form",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("form",$data,"id = $id");
        return $query;
    }


}
?>