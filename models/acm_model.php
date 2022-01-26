<?php
class acm_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT id, type, classify, content,
            DATE_FORMAT(dateTime,'%d/%m/%Y %h:%i %p') AS dateTime ,
            FORMAT(asset,0) AS asset,            
            IFNULL((SELECT name FROM accnumber WHERE id = a.accnumber AND status > 0), 'No Name') AS accName
            FROM 
            ledger a WHERE status > 0 AND accnumber > 0 order by dateTime desc");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // function get_data_combo(){
    //     $result = array();
    //     $query = $this->db->query("SELECT id, name AS text FROM khachhang");
    //     $result['items'] = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }

    // function addObj($data)
    // {
        
    //     $data['asset'] = str_replace( ',', '', $data['asset']);
    //     $query = $this->insert("ledger",$data);

        
    //     return $query;
    // }

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

    // function update($id, $data) {
    //     if($id > 0) {
    //         $data['asset'] = str_replace( ',', '', $data['asset']);
    //         $result = $this->update('ledger', $data, "id = $id");
    //     }
    //     else {
    //         $data['asset'] = str_replace( ',', '', $data['asset']);
    //         $result = $this->insert('ledger', $data);
    //     }
    //     return $result;
    // }

    function delObj($id,$data)
    {
        $query = $this->update("ledger",$data,"id = $id");
        
        return $query;
    }


    function khachhang(){
        $result = array();
        $query = $this->db->query("SELECT id, fullName AS `text` FROM customer WHERE status = 1");
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
        $query = $this->db->query("SELECT id, name AS `text` FROM staffs WHERE status = 1");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    



    
}
?>