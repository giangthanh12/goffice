<?php
class Phanloai_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_data_combo(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS text FROM phanloai WHERE tinh_trang = 1");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>