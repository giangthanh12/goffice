<?php
class Taisanbaohanh_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT *,
        IFNULL((SELECT name FROM taisan WHERE tai_san = taisan.id AND tinh_trang > 0), 'No Name') AS name_taisan 
         FROM taisan_baohanh WHERE tinh_trang > 0 order by ngay_gio desc");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    function list_lichsu($id){
        $query = $this->db->query("SELECT *,
        IFNULL((SELECT name FROM taisan WHERE tai_san = taisan.id AND tinh_trang > 0), 'No Name') AS name_taisan 
         FROM taisan_baohanhls WHERE bao_hanh = $id order by ngay_gio desc");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function addObj($data)
    {
        $query = $this->insert("taisan_baohanh",$data);
        if($query){
            //lay id baohanh vua them vao
            $query_bh = $this->db->query("SELECT id FROM taisan_baohanh order by id desc limit 1");
            $temp = $query_bh->fetchAll(PDO::FETCH_ASSOC);
            $data1 = [
                'bao_hanh' =>  $temp[0]['id'],
                'tai_san' =>  $data['tai_san'],
                'so_luong' =>  $data['so_luong'],
                'ngay_gio' =>  $data['ngay_gio'],
                'ghi_chu' =>  $data['ghi_chu'],
                'status' =>  1,
            ];
            $this->insert("taisan_baohanhls",$data1);
            // cap nhat so luong BH trong taisan
            $id_ts = $data['tai_san'];
            $query_ts = $this->db->query("SELECT sl_baohanh FROM taisan WHERE id = $id_ts");
            $temp_ts = $query_ts->fetchAll(PDO::FETCH_ASSOC);
            $sl_bh_cu = $temp_ts[0]['sl_baohanh'];
            $data_ts['sl_baohanh'] = $sl_bh_cu + $data['so_luong'];
            $this->update("taisan",$data_ts,"id = $id_ts");

            

        }
        return $query;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM taisan_baohanh WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        //lay so luong bao hanh cu
        $query_bh = $this->db->query("SELECT so_luong FROM taisan_baohanh WHERE id = $id");
        $temp = $query_bh->fetchAll(PDO::FETCH_ASSOC);
        $sl_bh_old = $temp[0]['so_luong'];
        $so_chenh = $data['so_luong'] - $sl_bh_old;
        
        // cap nhat so luong BH trong taisan
        $id_ts = $data['tai_san'];
        $query_ts = $this->db->query("SELECT sl_baohanh FROM taisan WHERE id = $id_ts");
        $temp_ts = $query_ts->fetchAll(PDO::FETCH_ASSOC);
        $sl_bh_cu = $temp_ts[0]['sl_baohanh'];
        $data_ts['sl_baohanh'] = $sl_bh_cu + $so_chenh;
        $this->update("taisan",$data_ts,"id = $id_ts");

        $query = $this->update("taisan_baohanh",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        //lay id taisan
        $query_bh = $this->db->query("SELECT tai_san FROM taisan_baohanh WHERE id = $id");
        $temp = $query_bh->fetchAll(PDO::FETCH_ASSOC);
        $id_ts = $temp[0]['tai_san'];
        $data_ts['sl_baohanh'] = 0;
        $this->update("taisan",$data_ts,"id = $id_ts");

        $query=$this->update("taisan_baohanh",$data,"id = $id");
        return $query;
        
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

    function get_sl($id){
        $result = array();
        $query = $this->db->query("SELECT so_luong FROM taisan WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function get_slbh($id){
        $result = array();
        $query = $this->db->query("SELECT so_luong,sl_lay FROM taisan_baohanh WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }


    function add_thuhoi($data)
    {
        $id_bh = $data['bao_hanh'];
        $id_ts = $data['tai_san'];
        $query = $this->insert("taisan_baohanhls",$data);

        if($query){
            $query_bh = $this->db->query("SELECT so_luong,sl_lay FROM taisan_baohanh WHERE id = $id_bh");
            $temp_bh = $query_bh->fetchAll(PDO::FETCH_ASSOC);
            $sl_bh_old = $temp_bh[0]['so_luong'];
            $sl_lay_old = $temp_bh[0]['sl_lay'];
            $sl_lay_new = $sl_lay_old + $data['so_luong'];
            $data_bh['sl_lay'] = $sl_lay_new;

            if($sl_lay_new == $sl_bh_old){
                $data_bh['tinh_trang'] = 0;
                $data_ts['sl_baohanh'] = 0;
                $this->update("taisan",$data_ts,"id = $id_ts");
            }

            
            $this->update("taisan_baohanh",$data_bh,"id = $id_bh");
        }

        return $query;
    }

    
}
?>