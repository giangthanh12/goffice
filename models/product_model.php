<?php
class product_Model extends Model{
        function __construst(){
            parent::__construst();
        }
        function getCustomer(){
            $result = array();
            $query = $this->db->query("SELECT id, fullName AS text FROM customers WHERE status = 1");
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        function getStaff() {
            $query = $this->db->query("SELECT id, name as text FROM staffs");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        function loadContact($id) {
            $query = $this->db->query("SELECT * FROM contact WHERE status = 1 AND customerId = $id  ORDER BY id DESC ");
            $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        function addObj($data) {
           $result = $this->insert("products",$data);
           return $result;
        }
        function listObj() {
            $query = $this->db->query("SELECT *
            FROM products  WHERE status = 1  ORDER BY id DESC ");
            $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } 
        function getdata($id) {
            $result = array();
            $query = $this->db->query("SELECT *
            FROM products WHERE id = $id");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = $temp[0];
            return $result;
        }
        function updateObj($id, $data) {
            $result = $this->update('products', $data, "id = $id");
            return $result;
        }
        function delObj($id, $data) {
            $result = $this->update('products', $data, "id = $id");
            return $result;
        }
}
?>
