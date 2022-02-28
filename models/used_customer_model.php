<?php
class used_customer_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getStaff()
    {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM staffs where status > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getNational()
    {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM national");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function delTransaction($id, $data) {
        $result = $this->update('transaction', $data, "id = $id");
        return $result;
    }
    function getTransaction($id) {
        $result = array();
        $query = $this->db->query("SELECT *,DATE_FORMAT(dateTime,'%d-%m-%Y %H:%i') as date FROM transaction WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }
    function getPosition()
    {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM position WHERE status > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getProvince()
    {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM province WHERE status > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getProduct() {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM products WHERE status > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function get_data_combo()
    {
        $result = array();
        $query = $this->db->query("SELECT id, name AS text FROM customers WHERE status > 0 ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function addTransaction($id,$data) {
        if($id > 0) {
            $result = $this->update("transaction", $data, "id = $id");
        }
        else {
            $result = $this->insert("transaction", $data);
        }
        return $result;
    }
    function loadContact($id)
    {
        $query = $this->db->query("SELECT *,(SELECT name from position where id = a.position) AS positionName FROM contact a WHERE status = 1 AND customerId = $id  ORDER BY id DESC ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function loadTransaction($id)
    {
        $query = $this->db->query("SELECT *,
            DATE_FORMAT(dateTime,'%d-%m-%Y %H:%i') as date,
            (SELECT name from products where id = transaction.productId) AS productName FROM transaction WHERE status = 1 AND customerId = $id  ORDER BY id DESC ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function addObj($data)
    {
        $result = $this->insert("customers", $data);
        return $result;
    }
    function listObj()
    {
        $query = $this->db->query("SELECT * FROM customers WHERE status > 0  ORDER BY fullName ASC ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function loadProductUsed($id) {
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(dateTime,'%d-%m-%Y %H:%i') as date,
        (SELECT name from products where id = transaction.productId) AS productName, 
        (SELECT type from products where id = transaction.productId) AS productType, 
        (SELECT supplier from products where id = transaction.productId) AS productSupplier, 
        (SELECT vat from products where id = transaction.productId) AS productVat, 
        (SELECT price from products where id = transaction.productId) AS productprice
        FROM transaction WHERE status = 1 AND customerId = $id GROUP BY productId  ORDER BY id DESC ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getdata($id)
    {
        $result = array();
        $query = $this->db->query("SELECT * FROM customers WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }
    function updateObj($id, $data)
    {
        $result = $this->update('customers', $data, "id = $id");
        return $result;
    }
    function delObj($id, $data)
    {
        $result = $this->update('customers', $data, "id = $id");
        return $result;
    }
    function checkPhone($idCustomer, $phone)
    {
        if ($idCustomer == 0) {
            $query = $this->db->query("SELECT COUNT(id) AS total FROM customers WHERE phoneNumber=$phone AND status > 0  ");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($temp[0]['total'] > 0) {
                return false;
            } else {
                return true;
            }
        } else {
            $query = $this->db->query("SELECT phoneNumber FROM customers WHERE status > 0 AND id = $idCustomer ");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($temp[0]['phoneNumber'] == $phone) {
                return true;
            } else {
                $query = $this->db->query("SELECT COUNT(id) AS total FROM customers WHERE phoneNumber=$phone AND status > 0");
                $temp = $query->fetchAll(PDO::FETCH_ASSOC);

                if ($temp[0]['total'] > 0) {
                    return false;
                } else {
                    return true;
                }
            }
        }
    }
}
