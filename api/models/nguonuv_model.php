<?php
class nguonuv_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_data_combo(){
        $result = array();
        $dieukien = " WHERE tinh_trang > 0 ";
        $query = $this->db->query("SELECT id, name AS text FROM nguonuv $dieukien");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
?>