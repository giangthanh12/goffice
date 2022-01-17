<?php
class Bhxh_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT * ,FORMAT(muc_dong,0) AS muc_dong,
        IFNULL((SELECT name FROM nhanvien WHERE nhan_vien = nhanvien.id AND tinh_trang > 0), 'No Name') AS nhan_vien ,
        IFNULL((SELECT name FROM thanhpho WHERE thanh_pho = thanhpho.id), '-') AS thanh_pho 
         FROM bhxh WHERE tinh_trang > 0");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function listbaogiam(){
        $query = $this->db->query("SELECT * ,
        IFNULL((SELECT name FROM nhanvien WHERE nhan_vien = nhanvien.id AND tinh_trang > 0), 'No Name') AS nhan_vien 
         FROM bhxh_baogiam WHERE tinh_trang > 0");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addObj($data)
    {
        $data['muc_dong'] = str_replace( ',', '', $data['muc_dong']);
        $query = $this->insert("bhxh",$data);
        return $query;
    }

    function baogiam($data)
    {
        $id_bhxh = $data['bhxh'];
        //tim xem da bao giam lan nao chua
        $query = $this->db->query("SELECT id FROM bhxh_baogiam WHERE bhxh = $id_bhxh");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if(count($temp) > 0){
            $data_bg = [
                'ngay_gio' => $data['ngay_gio'],
                'ghi_chu' => $data['ghi_chu'],
                'tinh_trang' => 1,
            ];
            $this->update("bhxh_baogiam",$data_bg,"bhxh = $id_bhxh");
            $data_bh['tinh_trang'] = 0;
            $this->update("bhxh",$data_bh,"id = $id_bhxh");
        }else{
            $query = $this->insert("bhxh_baogiam",$data);
            $data_bh['tinh_trang'] = 0;
            $this->update("bhxh",$data_bh,"id = $id_bhxh");
        }
        return $query;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM bhxh WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }
    function loaddata_bg($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM bhxh_baogiam WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $data['muc_dong'] = str_replace( ',', '', $data['muc_dong']);
        $query = $this->update("bhxh",$data,"id = $id");
        return $query;
    }
    function update_bg($id, $data)
    {
        $query = $this->update("bhxh_baogiam",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("bhxh",$data,"id = $id");
        return $query;
    }
    function del_bg($id,$data)
    {
        $query = $this->update("bhxh_baogiam",$data,"id = $id");
        //lay id bhxh
        $query_bg = $this->db->query("SELECT bhxh FROM bhxh_baogiam WHERE id = $id");
        $temp = $query_bg->fetchAll(PDO::FETCH_ASSOC);
        $id_bh = $temp[0]['bhxh'];
        $data_bh['tinh_trang'] = 1;
        $this->update("bhxh",$data_bh,"id = $id_bh");
        return $query;
    }

    function nhanvien(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM nhanvien");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function thanhpho(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM thanhpho");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    
}
?>