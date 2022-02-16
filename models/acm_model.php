<?php
class acm_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT id, type, classify, content,dateTime,action,
            DATE_FORMAT(dateTime,'%d/%m/%Y') AS dateTimeNew,
             asset,     
                   
            IFNULL((SELECT name FROM accnumber WHERE id = a.accnumber AND status > 0), 'No Name') AS accName,
            IFNULL((SELECT sum(asset) from ledger WHERE status > 0 AND action = 1 AND accnumber =2), 0)-
        IFNULL((SELECT sum(asset) from ledger WHERE status > 0 AND action = 2 AND accnumber =2), 0) as tk1,
        IFNULL((SELECT sum(asset) from ledger WHERE status > 0 AND action = 1 AND accnumber =3), 0) - 
        IFNULL((SELECT sum(asset) from ledger WHERE status > 0 AND action = 2 AND accnumber =3), 0) as tk2
            FROM 
            ledger a WHERE status > 0 AND accnumber > 0 order by dateTime desc");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getSodutk($accountId) {
        $query = $this->db->query("SELECT
        IFNULL((SELECT sum(asset) from ledger WHERE status > 0 AND action = 1 AND accnumber =$accountId), 0)-
        IFNULL((SELECT sum(asset) from ledger WHERE status > 0 AND action = 2 AND accnumber =$accountId), 0) as tk1
        FROM   ledger  WHERE status > 0 AND accnumber > 0 order by dateTime desc");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if($result == []) {
            return 0;
        }

        return $result[0]['tk1'];
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM ledger WHERE id = $id AND accnumber > 0");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        if($id > 0) {
            $data['asset'] = str_replace( ',', '', $data['asset']);
            $result = $this->update('ledger', $data, "id = $id");
        }
        else {
            $data['asset'] = str_replace( ',', '', $data['asset']);
            $result = $this->insert('ledger', $data);
        }
        return $result;
    }

    function getClassify($type) {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM classifyledger WHERE type = $type AND status = 1");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function delObj($id,$data)
    {
        $query = $this->update("ledger",$data,"id = $id");
        
        return $query;
    }


    function khachhang(){
        $result = array();
        $query = $this->db->query("SELECT id, fullName AS `text` FROM customers WHERE status = 1");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    function taikhoan(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM accnumber WHERE status > 0 AND id > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function contract(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM contracts WHERE status = 1");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    function nhanvien(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM staffs WHERE status IN (1,2,3,4,5)");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    



    
}
?>