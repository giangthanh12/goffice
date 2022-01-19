<?php
class Common_Model extends Model {
    function __construct(){
        parent::__construct();
    }

    function thanhpho(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM province WHERE status=1");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getListStaff(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text`
              FROM staffs WHERE status IN (1,2,3,4,5,6) ORDER BY name ASC");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = $temp;
        }
        return $result;
    }

    function getTypeContracts(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text`
              FROM contracttype WHERE status > 0 ORDER BY id ASC");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = $temp;
        }
        return $result;
    }

    function getDepartments(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text`
              FROM department WHERE status > 0 ORDER BY id ASC");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = $temp;
        }
        return $result;
    }

    function getPositions(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text`
              FROM position WHERE status > 0 ORDER BY id ASC");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = $temp;
        }
        return $result;
    }

    function getBranchs(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text`
              FROM branch WHERE status > 0 ORDER BY id ASC");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = $temp;
        }
        return $result;
    }

    function getShifts(){
        $result = array();
        $query = $this->db->query("SELECT id, shift AS `text`
              FROM shift WHERE status > 0 ORDER BY id ASC");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = $temp;
        }
        return $result;
    }

    function getWorkPlaces(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text`
              FROM workplaces WHERE status > 0 ORDER BY id ASC");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = $temp;
        }
        return $result;
    }


    function getListGroup(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text`
              FROM grouproles WHERE status >0 ORDER BY id ASC");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = $temp;
        }
        return $result;
    }

    function linhvuc()
    {
        $result = array();
        $dieukien = " WHERE tinh_trang = 1";
        $query = $this->db->query("SELECT id, name AS text FROM linhvuc $dieukien ");
        if($query){
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    function nhanvien()
    {
        $result = array();
        $query = $this->db->query("SELECT id, name AS text, phoneNumber FROM staffs WHERE status IN (1,2,3,4) ");
        if($query){
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    function datasource()
    {
        $temp = array();
        $query = $this->db->query("SELECT id, name AS text FROM datasource WHERE status = 1 ");
        if($query){
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $temp;
    }

    function datatype()
    {
        $temp = array();
        $query = $this->db->query("SELECT id, name AS text FROM datatype WHERE status = 1 ");
        if($query){
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $temp;
    }

    function datastatus()
    {
        $temp = array();
        $query = $this->db->query("SELECT id, name AS text FROM datastatus WHERE status = 1 ");
        if($query){
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $temp;
    }

    function tinhtranglienhe()
    {
        $temp = array();
        $query = $this->db->query("SELECT id, name AS text FROM tinhtranglienhe WHERE tinh_trang = 1 ");
        if($query){
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $temp;
    }

    function tinhtrangkh()
    {
        $temp = array();
        $query = $this->db->query("SELECT id, name AS text FROM tinhtrangkh WHERE tinh_trang = 1 ");
        if($query){
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $temp;
    }

    function nhacungcap()
    {
        $temp = array();
        $query = $this->db->query("SELECT id, name AS text FROM nhacungcap WHERE tinh_trang = 1 ");
        if($query){
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $temp;
    }
}

?>