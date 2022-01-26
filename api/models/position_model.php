<?php
class position_model extends Model{
    function __construct(){
        parent::__construct();
    }

    function listPositions(){
        $query = $this->db->query("SELECT *
            FROM position a WHERE status > 0 ORDER BY id DESC ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
?>