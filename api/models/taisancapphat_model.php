<?php
class Taisancapphat_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT *,
        IFNULL((SELECT name FROM taisan WHERE tai_san = taisan.id AND tinh_trang > 0), 'No Name') AS name_taisan ,
        IFNULL((SELECT name FROM nhanvien WHERE nhan_vien = nhanvien.id AND tinh_trang > 0), 'No Name') AS nhan_vien 
         FROM taisan_capphat WHERE tinh_trang > 0 order by ngay_gio desc");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function addObj($data)
    {
        $id = $data['tai_san'];
        $data['dat_coc'] = str_replace( ',', '', $data['dat_coc']);
        $query = $this->insert("taisan_capphat",$data);
        if($query){
            //lay so luong ton kho cu
            $query1 = $this->db->query("SELECT sl_tonkho FROM taisan WHERE id = $id");
            $temp = $query1->fetchAll(PDO::FETCH_ASSOC);
            $data1['sl_tonkho'] = $temp[0]['sl_tonkho'] - $data['so_luong'];
            $query = $this->update("taisan",$data1,"id = $id");
        }
        return $query;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM taisan_capphat WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        //get so luong cu
        $query_cu = $this->db->query("SELECT so_luong FROM taisan_capphat WHERE id = $id");
        $temp_cu = $query_cu->fetchAll(PDO::FETCH_ASSOC);

        $id_taisan = $data['tai_san'];
        $data['dat_coc'] = str_replace( ',', '', $data['dat_coc']);
        $query = $this->update("taisan_capphat",$data,"id = $id");

        if($query){
            //lay so luong ton kho cu
            $query1 = $this->db->query("SELECT sl_tonkho FROM taisan WHERE id = $id_taisan");
            $temp = $query1->fetchAll(PDO::FETCH_ASSOC);
            $data1['sl_tonkho'] = $temp[0]['sl_tonkho'] - ($data['so_luong'] - $temp_cu[0]['so_luong']);
            $query = $this->update("taisan",$data1,"id = $id_taisan");
        }



        return $query;
    }

    function delObj($id,$data)
    {
        //tim trong thu hoi co ko
        $query_thuhoi = $this->db->query("SELECT cap_phat FROM taisan_thuhoi WHERE cap_phat = $id and tinh_trang > 0");
        $temp_cu = $query_thuhoi->fetchAll(PDO::FETCH_ASSOC);
        if(count($temp_cu) > 0){
            return false;
        }
        else{
            $query_tscp = $this->db->query("SELECT tai_san,so_luong FROM taisan_capphat WHERE id = $id");
            $temp_tscp = $query_tscp->fetchAll(PDO::FETCH_ASSOC);
            $id_taisan = $temp_tscp[0]['tai_san'];
            $sl_cp = $temp_tscp[0]['so_luong'];

            //get so ton cua ts
            $query_ts = $this->db->query("SELECT sl_tonkho FROM taisan WHERE id = $id_taisan");
            $temp_ts = $query_ts->fetchAll(PDO::FETCH_ASSOC);
            $sl_tk = $temp_ts[0]['sl_tonkho'];
            $data1['sl_tonkho'] = $sl_tk + $sl_cp;
            $query = $this->update("taisan",$data1,"id = $id_taisan");
            $this->update("taisan_capphat",$data,"id = $id");
            return $query;
        }  
    }

    function taisan(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM taisan");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function nhanvien(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM nhanvien");
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
            $query_cp = $this->db->query("SELECT so_luong FROM taisan_capphat WHERE id = $id_cp");
            $temp_cp = $query_cp->fetchAll(PDO::FETCH_ASSOC);
            $sl_cp_old = $temp_cp[0]['so_luong'];
            $sl_cp_new = $sl_cp_old - $data['so_luong'];
            $data_cp['so_luong'] = $sl_cp_new;
            if($sl_cp_new == 0){
                $data_cp['tinh_trang'] = 0;
            }
            $this->update("taisan_capphat",$data_cp,"id = $id_cp");

            $query_ts = $this->db->query("SELECT sl_tonkho FROM taisan WHERE id = $id_ts");
            $temp_ts = $query_ts->fetchAll(PDO::FETCH_ASSOC);
            $sl_ts_old = $temp_ts[0]['sl_tonkho'];
            $sl_ts_new = $sl_ts_old + $data['so_luong'];
            $data_ts['sl_tonkho'] =  $sl_ts_new;
            $this->update("taisan",$data_ts,"id = $id_ts");
        }


        
        return $query;
    }

    
}
?>