<?php
class customer_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function listCustomers()
    {
        $result = array();
        $query = $this->db->query("SELECT id,type,
        IF(type=1, 'Cá nhân', 'Tổ chức') AS customerTypeName,
        shortName,fullName,address,phoneNumber,email,website,field,businessName,businessAddress,businessPlace,taxCode,authorized,representative,
        (SELECT name FROM province WHERE id=a.provinceId) AS province,
        (SELECT name FROM national WHERE id=a.nationalId) AS nationality,
        IFNULL((SELECT SUM(taxMoney) FROM contracts WHERE customerId=a.id AND status>0),0) AS totalSales,rank,field,classify,note,
        (SELECT name FROM staffs WHERE id=a.staffId) AS staffName,
        (SELECT name FROM staffs WHERE id=a.staffInCharge) AS staffInCharge,
        (SELECT name FROM province WHERE id=a.provinceId) AS province,
        (SELECT name FROM national WHERE id=a.nationalId) AS nationality,status
            FROM customers a WHERE status > 0 ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    function detailCustomer($customerId)
    {
        $result = array();
        $query = $this->db->query("SELECT id,type,
            IF(type=1, 'Cá nhân', 'Tổ chức') AS customerTypeName,
            shortName,fullName,address,phoneNumber,email,website,field,businessName,businessAddress,businessPlace,taxCode,authorized,representative,
            (SELECT name FROM province WHERE id=a.provinceId) AS province,
            (SELECT name FROM national WHERE id=a.nationalId) AS nationality,
            IFNULL((SELECT SUM(taxMoney) FROM contracts WHERE customerId=a.id AND status>0),0) AS totalSales,rank,field,classify,note,
            (SELECT name FROM staffs WHERE id=a.staffId) AS staffName,
            (SELECT name FROM staffs WHERE id=a.staffInCharge) AS staffInCharge,
            (SELECT name FROM province WHERE id=a.provinceId) AS province,
            (SELECT name FROM national WHERE id=a.nationalId) AS nationality,status
            FROM customers a WHERE status > 0 AND id=$customerId ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    function listCustomerCares($customerId)
    {
        $result = array();
        $query = $this->db->query("SELECT *
            FROM customercares WHERE status > 0 AND customerId=$customerId ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }
}
