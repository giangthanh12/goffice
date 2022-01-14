<?php
class asset_issue_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(ngay_gio,'%d-%m-%Y') AS ngay_gio,
        IFNULL((SELECT name FROM taisan WHERE tai_san = taisan.id AND tinh_trang > 0), 'No Name') AS nameAsset,
        IFNULL((SELECT name FROM staffs WHERE nhan_vien = staffs.id AND status = 1), 'No Name') AS nameStaff 
         FROM taisan_capphat WHERE tinh_trang > 0 order by id desc");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function addObj($data)
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

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(ngay_gio,'%d-%m-%Y') AS ngay_gio FROM taisan_capphat WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $data['dat_coc'] = str_replace( ',', '', $data['dat_coc']);
        $query = $this->update("taisan_capphat",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        //tim trong thu hoi co ko
        // $query_thuhoi = $this->db->query("SELECT cap_phat FROM taisan_thuhoi WHERE cap_phat = $id and tinh_trang > 0");
        // $temp_cu = $query_thuhoi->fetchAll(PDO::FETCH_ASSOC);
        // if(count($temp_cu) > 0){
        //     // return false;
        // }
        // else{
            $query_tscp = $this->db->query("SELECT tai_san,so_luong FROM taisan_capphat WHERE id = $id");
            $temp_tscp = $query_tscp->fetchAll(PDO::FETCH_ASSOC);
            $id_taisan = $temp_tscp[0]['tai_san'];
            $data1['tinh_trang'] = 1;
            $query = $this->update("taisan",$data1,"id = $id_taisan");
        // }  
        $query = $this->update("taisan_capphat",$data,"id = $id");
        return $query;
    }

    function getAsset(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM taisan WHERE tinh_trang = 1");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getAllAsset(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM taisan WHERE tinh_trang = 2");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getStaff(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM staffs WHERE status = 1");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_sltonkho($id){
        $result = array();
        $query = $this->db->query("SELECT sl_tonkho FROM taisan WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function get_slcp($id){
        $result = array();
        $query = $this->db->query("SELECT so_luong FROM taisan_capphat WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
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