<?php
class Data_Model extends Model{
    function __construct()
    {
        parent::__construct();
    }

    function listObj($keyword, $offset, $rows)
    {
        $result = array();
        $dieukien = " WHERE tinh_trang>0 ";
        if($keyword != ''){
            $dieukien .= " AND ho_ten LIKE '%$keyword%' ";
        } 
        $query = $this->db->query("SELECT * FROM data $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if($temp){
            $result['total'] = count($temp);
        }
        
        $query = $this->db->query("SELECT *,
            (SELECT name FROM nhanvien WHERE id = giao_cho) as giao_cho
            FROM data $dieukien LIMIT $offset,$rows ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
       
        return $result; 
    }
    

    function addObj($data)
    {
        $query = $this->insert("data",$data);
        if ($query)
            $id = $this->db->lastInsertId();
        else
            $id = 0;
        return $id;
    }

    function getdata($id){
        $result = [];
        $result['data'] = array();
        $query = $this->db->query("SELECT * FROM data WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result['data'] = $temp[0];
        $query = $this->db->query("SELECT *,(SELECT email FROM users WHERE id = a.nhan_vien) AS nhanvien FROM lichsu_data a WHERE tinh_trang = 1 AND id_data = $id ORDER BY ngay_gio ASC");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if($temp){
            $result['histories'] = $temp;
        } else {
            $result['histories'] = [];
        }
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("data",$data,"id = $id");
        return $query;
    }

    function addnhatky($data)
    {
        $query = $this->insert('lichsu_data', $data);
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("data",$data,"id = $id");
        return $query;
    }
}

?>