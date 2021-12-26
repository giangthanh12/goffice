<?php
class Bhxhlichsu_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT * ,FORMAT(so_tien,0) AS so_tien,FORMAT(muc_dong,0) AS muc_dong,
        IFNULL((SELECT name FROM nhanvien WHERE nhan_vien = nhanvien.id AND tinh_trang > 0), 'No Name') AS nhan_vien ,
        IFNULL((SELECT ma_bhxh FROM bhxh WHERE bhxh = bhxh.id), '-') AS ma_bhxh 
         FROM bhxh_lichsu WHERE tinh_trang > 0 order by ngay_gio desc");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function addObj($data)
    {
        $id_bhxh = $data['bhxh'];
        //select bhxh
        $query = $this->db->query("SELECT * FROM bhxh WHERE id = $id_bhxh");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $data['nhan_vien'] = $temp[0]['nhan_vien'];
        $data['muc_dong'] = $temp[0]['muc_dong'];
        $data['nld_dong'] = $temp[0]['nld_dong'];
        $data['cty_dong'] = $temp[0]['cty_dong'];
        $data['so_tien'] = $temp[0]['muc_dong'] * $temp[0]['nld_dong']/100 ;
        $query = $this->insert("bhxh_lichsu",$data);
        return $query;
    }

    function addAll($data)
    {
        //select bhxh
        $query = $this->db->query("SELECT * FROM bhxh WHERE tinh_trang > 0 AND bao_giam = 0");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($temp as $row){
            $data['nhan_vien'] = $row['nhan_vien'];
            $data['bhxh'] = $row['id'];
            $data['muc_dong'] = $row['muc_dong'];
            $data['nld_dong'] = $row['nld_dong'];
            $data['cty_dong'] = $row['cty_dong'];
            $data['so_tien'] = $row['muc_dong'] * $row['nld_dong']/100 ;
            $query2 = $this->insert("bhxh_lichsu",$data);
        }
        return $query2;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM bhxh_lichsu WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }


    function updateObj($id, $data)
    {
        $id_bhxh = $data['bhxh'];
        //select bhxh
        $query = $this->db->query("SELECT * FROM bhxh WHERE id = $id_bhxh");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $data['nhan_vien'] = $temp[0]['nhan_vien'];
        $data['muc_dong'] = $temp[0]['muc_dong'];
        $data['nld_dong'] = $temp[0]['nld_dong'];
        $data['cty_dong'] = $temp[0]['cty_dong'];
        $data['so_tien'] = $temp[0]['muc_dong'] * $temp[0]['nld_dong']/100 ;
        $query = $this->update("bhxh_lichsu",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("bhxh_lichsu",$data,"id = $id");
        return $query;
    }

    function nhanvien(){
        $result = array();
        $query = $this->db->query("SELECT id,ma_bhxh,
        IFNULL((SELECT name FROM nhanvien WHERE nhan_vien = nhanvien.id), 'No Name') AS text 
         FROM bhxh WHERE tinh_trang > 0");
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

    function getbhxh($id){
        $query = $this->db->query("SELECT * FROM bhxh WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    

    
}
?>