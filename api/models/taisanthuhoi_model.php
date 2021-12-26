<?php
class Taisanthuhoi_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT *,
        IFNULL((SELECT name FROM taisan WHERE tai_san = taisan.id AND tinh_trang > 0), 'No Name') AS name_taisan ,
        IFNULL((SELECT name FROM taisan_capphat WHERE cap_phat = taisan_capphat.id AND tinh_trang > 0), 'No Name') AS name_cp 
         FROM taisan_thuhoi WHERE tinh_trang > 0 order by ngay_gio desc");
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
        $query = $this->db->query("SELECT * FROM taisan_thuhoi WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $id_cp = $data['cap_phat'];
        $id_ts = $data['tai_san'];
        $data['tra_coc'] = str_replace( ',', '', $data['tra_coc']);
        
        //get sl_th_old
        $query_slth = $this->db->query("SELECT so_luong FROM taisan_thuhoi WHERE id = $id");
        $temp_slth = $query_slth->fetchAll(PDO::FETCH_ASSOC);
        $sl_th_old = $temp_slth[0]['so_luong'];
        $so_chenh = $sl_th_old - $data['so_luong'];

        //get sl_cp_old
        $query_slcp = $this->db->query("SELECT so_luong FROM taisan_capphat WHERE id = $id_cp");
        $temp_slcp = $query_slcp->fetchAll(PDO::FETCH_ASSOC);
        $data_cp['so_luong'] = $temp_slcp[0]['so_luong'] + $so_chenh;
        $this->update("taisan_capphat",$data_cp,"id = $id_cp");

        //get sl_ts_old
        $query_slts = $this->db->query("SELECT sl_tonkho FROM taisan WHERE id = $id_ts");
        $temp_slts = $query_slts->fetchAll(PDO::FETCH_ASSOC);
        $sl_ts_old = $temp_slts[0]['sl_tonkho'];
        $data_ts['sl_tonkho'] = $sl_ts_old - $so_chenh;
        $this->update("taisan",$data_ts,"id = $id_ts");
            

        $query = $this->update("taisan_thuhoi",$data,"id = $id");



        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("taisan_thuhoi",$data,"id = $id");
        if($query){
            //lay thong tin thu hoi
            $query_tsth = $this->db->query("SELECT tai_san,so_luong,cap_phat FROM taisan_thuhoi WHERE id = $id");
            $temp_tsth = $query_tsth->fetchAll(PDO::FETCH_ASSOC);
            $id_ts = $temp_tsth[0]['tai_san'];
            $id_cp = $temp_tsth[0]['cap_phat'];
            $so_luong = $temp_tsth[0]['so_luong'];

            //get so_luong of cap_phat
            $query_tscp = $this->db->query("SELECT so_luong FROM taisan_capphat WHERE id = $id_cp");
            $temp_tscp = $query_tscp->fetchAll(PDO::FETCH_ASSOC);
            $data_cp['so_luong'] = $temp_tscp[0]['so_luong'] + $so_luong;
            $data_cp['tinh_trang'] = 1;
            $this->update("taisan_capphat",$data_cp,"id = $id_cp");

            //get so_luong of tai_san
            $query_ts = $this->db->query("SELECT sl_tonkho FROM taisan WHERE id = $id_ts");
            $temp_ts = $query_ts->fetchAll(PDO::FETCH_ASSOC);
            $data_ts['sl_tonkho'] = $temp_ts[0]['sl_tonkho'] - $so_luong;
            $this->update("taisan",$data_ts,"id = $id_ts");
        }
        return $query;
    }

    function taisan(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM taisan");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function capphat(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM taisan_capphat");
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




    
}
?>