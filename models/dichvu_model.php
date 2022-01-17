<?php
class Dichvu_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT * ,FORMAT(don_gia,0) AS don_gia,FORMAT(thue_vat,0) AS thue_vat,
        IFNULL((SELECT name FROM loaidichvu WHERE phan_loai = loaidichvu.id AND tinh_trang > 0), '-') AS phan_loai 
         FROM dichvu WHERE tinh_trang > 0");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function addObj($data)
    {
        $data['don_gia'] = str_replace( ',', '', $data['don_gia']);
        $data['gia_von'] = str_replace( ',', '', $data['gia_von']);
        $data['thue_vat'] = str_replace( ',', '', $data['thue_vat']);
        $query = $this->insert("dichvu",$data);
        return $query;
    }

   

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM dichvu WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }


    function updateObj($id, $data)
    {
        $data['don_gia'] = str_replace( ',', '', $data['don_gia']);
        $data['gia_von'] = str_replace( ',', '', $data['gia_von']);
        $data['thue_vat'] = str_replace( ',', '', $data['thue_vat']);
        $query = $this->update("dichvu",$data,"id = $id");
        return $query;
    }


    function delObj($id,$data)
    {
        $query = $this->update("dichvu",$data,"id = $id");
        return $query;
    }
  

    function phanloai(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM loaidichvu");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function nhacungcap(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM nhacungcap");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function don_vi_tinh(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM donvitinh");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    
}
?>