<?php
class loaihd_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_data_combo(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS text FROM loaihopdong WHERE tinh_trang > 0 ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
?>