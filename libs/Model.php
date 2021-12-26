<?php
class Model {
    function __construct() {
		$this->db = new Database();
	}
    
    // them moi du lieu
    function insert($table, $array){
        $cols = array();
        $bind = array();
        foreach($array as $key => $value){
            $cols[] = $key;
            $bind[] = "'".$value."'";
        }
        $query = $this->db->query("INSERT INTO ".$table." (".implode(",", $cols).") VALUES (".implode(",", $bind).")");
        return $query;
    }
    
    // cap nhat du lieu
    function update($table, $array, $where){
        $set = array();
        foreach($array as $key => $value){
            $set[] = $key." = '".$value."'";
        }
        $query = $this->db->query("UPDATE ".$table." SET ".implode(",", $set)." WHERE ".$where);
        return $query;
    }
    
    // xoa du lieu
    function delete($table, $where = ''){
        if($where == ''){
            $query = $this->db->query("DELETE FROM ".$table);
        }else{
            $query = $this->db->query("DELETE FROM ".$table." WHERE ".$where);
        }
        return $query;
    }
 ////////////////////////////////// cac ham phu khac /////////////////////////////////////////////
    function check_token($token){
        $query = $this->db->query("SELECT COUNT(id) AS total FROM users WHERE token = '$token'");
        $row = $query->fetchAll();
        return $row[0]['total'];
    }
 /////////////////////////////////// end cac ham phu khac /////////////////////////////////////////
}
?>