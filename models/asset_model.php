<?php
class asset_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT *,
                IFNULL((SELECT name FROM taisan_nhom WHERE id = taisan.nhom_ts AND tinh_trang > 0), 'No Name') AS name_nhomts,
                (SELECT id FROM taisan_capphat WHERE tai_san = taisan.id AND tinh_trang > 0 ORDER BY id DESC LIMIT 1) AS id_capphat  
                FROM taisan WHERE tinh_trang > 0 ORDER BY id DESC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function loadListHisIssue($id){
        $result['data'] = array();
        $query = $this->db->query("SELECT *,
                IFNULL((SELECT name FROM taisan WHERE id = taisan_capphat.tai_san AND tinh_trang > 0), 'No Name') AS nameAsset,
                (SELECT name FROM staffs WHERE id = taisan_capphat.nhan_vien AND status = 1) AS nameStaff,  
                (SELECT code FROM taisan WHERE id = taisan_capphat.tai_san AND tinh_trang > 0) AS code,
                DATE_FORMAT(ngay_gio,'%d-%m-%Y') as ngay_gio
                FROM taisan_capphat WHERE tinh_trang > 0 AND tai_san = $id ORDER BY id DESC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function loadListHisRecall($id){
        $result['data'] = array();
        $query = $this->db->query("SELECT *,
                IFNULL((SELECT name FROM taisan WHERE id = taisan_thuhoi.tai_san AND tinh_trang > 0), 'No Name') AS nameAsset,
                (SELECT code FROM taisan WHERE id = taisan_thuhoi.tai_san AND tinh_trang > 0) AS code,
                DATE_FORMAT(ngay_gio,'%d-%m-%Y') as ngay_gio
                FROM taisan_thuhoi WHERE tinh_trang > 0 AND tai_san = $id ORDER BY id DESC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
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

        $query2 = $this->db->query("SELECT *,
        DATE_FORMAT(ngay_gio,'%d-%m-%Y') as ngay_gio FROM taisan WHERE id = $id");
        $temp2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        $result['taisan'] = $temp2[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        //lay ra so luong cu
        $query1 = $this->db->query("SELECT so_luong,sl_tonkho FROM taisan WHERE id = $id");
        $temp = $query1->fetchAll(PDO::FETCH_ASSOC);

        // $sl_chenh = $data['so_luong'] - $temp[0]['so_luong'];
        // $data['sl_tonkho'] = $temp[0]['sl_tonkho'] + $sl_chenh;
        $data['so_tien'] = str_replace( ',', '', $data['so_tien']);
        $query = $this->update("taisan",$data,"id = $id");
        return $query;
    }
    function getAsset(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM taisan WHERE tinh_trang = 1 or tinh_trang = 2");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
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

    function addIssue($data)
    {
        $id = $data['tai_san'];
        $data['dat_coc'] = str_replace( ',', '', $data['dat_coc']);
        $query = $this->insert("taisan_capphat",$data);
        if($query){
            $data1['tinh_trang'] = 2;
            $query = $this->update("taisan",$data1,"id = $id");
        }
        return $query;
    }
    function getAssetIssue($id){
        $result = array();
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(ngay_gio,'%d-%m-%Y') AS ngay_gio FROM taisan_capphat WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
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

    function changeImage($file,$id){
        if ($file=='')
            return false;
        else {
            $data = ['hinh_anh'=>$file];
            $query = $this->update("taisan_info", $data, "tai_san = $id");
            return $query;
        }
    }

    function getStaff(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM staffs WHERE status = 1");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function alertBroken($id, $data)
    {
        $query = $this->update("taisan",$data,"id = $id");
        return $query;
    }
    function add_thuhoi($data)
    {
        $id_cp = $data['cap_phat'];
        $id_ts = $data['tai_san'];
        $data['tra_coc'] = str_replace( ',', '', $data['tra_coc']);
        $query = $this->insert("taisan_thuhoi",$data);
        if($query){
            $data_cp['tinh_trang'] = 2;
            $this->update("taisan_capphat",$data_cp,"id = $id_cp");
            $data_ts['tinh_trang'] =  1;
            $this->update("taisan",$data_ts,"id = $id_ts");
        }


        
        return $query;
    }
    
}
?>