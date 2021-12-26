<?php
class Taisan_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT *,
                IFNULL((SELECT name FROM taisan_nhom WHERE id = taisan.nhom_ts AND tinh_trang > 0), 'No Name') AS name_nhomts 
                FROM taisan WHERE tinh_trang > 0");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // function get_data_combo(){
    //     $result = array();
    //     $query = $this->db->query("SELECT id, name AS text FROM khachhang");
    //     $result['items'] = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }

    function addObj($data)
    {
        $data['so_tien'] = str_replace( ',', '', $data['so_tien']);
        $query = $this->insert("taisan",$data);

        $query2 = $this->db->query("SELECT id FROM taisan ORDER BY id desc limit 1");
        $result = $query2->fetchAll(PDO::FETCH_ASSOC);
        $data_info['tai_san'] =  $result[0]['id'];
        $query = $this->insert("taisan_info",$data_info);
        return $query;
    }

    function getdata($id){
        $result = array();

        $query = $this->db->query("SELECT *,
          IF(hinh_anh='','".URLFILE."/uploads/useravatar.png',hinh_anh) AS hinh_anh
          FROM taisan_info WHERE tai_san=$id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result['taisan_info'] = $temp[0];

        $query2 = $this->db->query("SELECT * FROM taisan WHERE id = $id");
        $temp2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        $result['taisan'] = $temp2[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        //lay ra so luong cu
        $query1 = $this->db->query("SELECT so_luong,sl_tonkho FROM taisan WHERE id = $id");
        $temp = $query1->fetchAll(PDO::FETCH_ASSOC);

        $sl_chenh = $data['so_luong'] - $temp[0]['so_luong'];
        $data['sl_tonkho'] = $temp[0]['sl_tonkho'] + $sl_chenh;
        $data['so_tien'] = str_replace( ',', '', $data['so_tien']);
        $query = $this->update("taisan",$data,"id = $id");
        return $query;
    }

    function updateObj_info($id, $data)
    {
        $query = $this->update("taisan_info",$data,"tai_san = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        //check co trong cap phat ko
        $query_cp = $this->db->query("SELECT id FROM taisan_capphat WHERE tai_san = $id AND tinh_trang > 0");
        $temp_cp = $query_cp->fetchAll(PDO::FETCH_ASSOC);
        if(count($temp_cp) > 0){
            return false;
        }else{
            $query = $this->update("taisan",$data,"id = $id");
            return $query;
        } 
    }

    function getnhomts(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM taisan_nhom WHERE tinh_trang > 0");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function don_vi(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM donvidoluong");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function thayanh($file,$id){
        if ($file=='')
            return false;
        else {
            $data = ['hinh_anh'=>$file];
            $query = $this->update("taisan_info", $data, "tai_san = $id");
            return $query;
        }
    }



    function baohong($id, $data)
    {
        //lay ra so luong cu
        $query1 = $this->db->query("SELECT sl_mat,sl_honghoc,so_luong,sl_tonkho FROM taisan WHERE id = $id");
        $temp = $query1->fetchAll(PDO::FETCH_ASSOC);

        if($data['status'] == 0){
            $data1['sl_honghoc'] = $temp[0]['sl_honghoc'] + $data['so_luong_hong'];
        }else{
            $data1['sl_mat'] = $temp[0]['sl_mat'] + $data['so_luong_hong'];
            $data1['sl_tonkho'] = $temp[0]['sl_tonkho'] - $data['so_luong_hong'];
        }
        $query = $this->update("taisan",$data1,"id = $id");
        return $query;
    }
    
}
?>