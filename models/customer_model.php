<?php
class customer_Model extends Model{
    function __construst(){
        parent::__construst();
    }

        function getStaff() {
            $result = array();
            $query = $this->db->query("SELECT id, name AS `text` FROM staffs");
            if ($query)
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        function getNational() {
            $result = array();
            $query = $this->db->query("SELECT id, name AS `text` FROM national");
            if ($query)
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        function getProvince() {
            $result = array();
            $query = $this->db->query("SELECT id, name AS `text` FROM province WHERE status > 0");
            if ($query)
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        function loadContact($id) {
            $query = $this->db->query("SELECT * FROM contact WHERE status = 1 AND customerId = $id  ORDER BY id DESC ");
            $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        function loadTransaction($id) {
            $query = $this->db->query("SELECT *,
            DATE_FORMAT(dateTime,'%d-%m-%Y %H:%i') as date FROM transaction WHERE status = 1 AND customerId = $id  ORDER BY id DESC ");
            $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        function addObj($data) {
           $result = $this->insert("customer",$data);
           return $result;
        }
        function listObj() {
            $query = $this->db->query("SELECT * FROM customer WHERE status = 1  ORDER BY id DESC ");
            $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } 
        function getdata($id) {
            $result = array();
            $query = $this->db->query("SELECT * FROM customer WHERE id = $id");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = $temp[0];
            return $result;
        }
        function updateObj($id, $data) {
            $result = $this->update('customer', $data, "id = $id");
            return $result;
        }
        function delObj($id, $data) {
            $result = $this->update('customer', $data, "id = $id");
            return $result;
        }
}
?>
