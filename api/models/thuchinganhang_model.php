<?php
class Thuchinganhang_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT *, 
            DATE_FORMAT(ngay_gio,'%d/%m/%Y %h:%i %p') AS ngay_gio_fomart ,
            FORMAT(so_tien,0) AS sotien_format,
            FORMAT(so_du,0) AS sodu_format,
            IFNULL((SELECT name FROM khachhang WHERE id = socai.khach_hang AND tinh_trang > 0), 'No Name') AS name_kh,
            IFNULL((SELECT name FROM taikhoan WHERE id = socai.tai_khoan AND tinh_trang > 0), 'No Name') AS name_tk
            FROM 
            socai WHERE tinh_trang > 0 AND tai_khoan > 0 order by ngay_gio desc");
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
        $ngaygio = $data['ngay_gio'];
        $taikhoan = $data['tai_khoan'];
        $data['so_tien'] = str_replace( ',', '', $data['so_tien']);
        $query = $this->insert("socai",$data);

        if($query){
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $query2 = $this->db->query("SELECT so_du FROM socai WHERE  tinh_trang > 0
            AND tai_khoan = $taikhoan AND ngay_gio < '$ngaygio'
            order by ngay_gio desc limit 1");
            $temp2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $soducuoi = 0;
            if(count($temp2) > 0){
                $soducuoi = $temp2[0]['so_du'];
            }
            $query = $this->db->query("SELECT id,so_tien,loai,so_du FROM socai WHERE  tinh_trang > 0
            AND tai_khoan = $taikhoan AND ngay_gio >= '$ngaygio'
             order by ngay_gio asc");
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($rows as $item){
                if ($item['loai'] == 0) {
                    $sodu = $soducuoi + $item['so_tien'];
                }
                else{
                    $sodu = $soducuoi - $item['so_tien'];
                }
                $id = $item['id'];
                $this->update("socai",['so_du' => $sodu],"id = $id");
                $soducuoi = $sodu;
            }
        }
        return $query;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM socai WHERE id = $id AND tai_khoan > 0");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        
        $data['so_tien'] = str_replace( ',', '', $data['so_tien']);
        $ngaygio = $data['ngay_gio'];
        $taikhoan = $data['tai_khoan'];
        $query = $this->update("socai",$data,"id = $id");
        if($query){
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $query2 = $this->db->query("SELECT so_du FROM socai WHERE  tinh_trang > 0
            AND tai_khoan = $taikhoan AND ngay_gio < '$ngaygio'
            order by ngay_gio desc limit 1");
            $temp2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $soducuoi = 0;
            if(count($temp2) > 0){
                $soducuoi = $temp2[0]['so_du'];
            }
            $query = $this->db->query("SELECT id,so_tien,loai,so_du FROM socai WHERE  tinh_trang > 0
            AND tai_khoan =  $taikhoan AND ngay_gio >= '$ngaygio'
             order by ngay_gio asc");
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($rows as $item){
                if ($item['loai'] == 0) {
                    $sodu = $soducuoi + $item['so_tien'];
                }
                else{
                    $sodu = $soducuoi - $item['so_tien'];
                }
                $id = $item['id'];
                $this->update("socai",['so_du' => $sodu],"id = $id");
                $soducuoi = $sodu;
            }
        }
        
        return $query;
    }

    function updateChotsodu()
    {
        $get_taikhoan = $this->db->query("SELECT id FROM taikhoan WHERE  tinh_trang > 0 AND id > 0");
        $arr_tk = $get_taikhoan->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($arr_tk as $row_tk){
            $id_taikhoan = $row_tk['id'];
            $query2 = $this->db->query("SELECT so_du,ngay_gio,so_tien FROM socai WHERE  tinh_trang > 0
            AND tai_khoan = $id_taikhoan order by ngay_gio asc limit 1");
            $temp2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $soducuoi = 0;
            $ngaygio = "1970-01-01 00:00:00";
            if(count($temp2) > 0){
                $ngaygio = $temp2[0]['ngay_gio'];
            }
            $query = $this->db->query("SELECT id,so_tien,loai,so_du FROM socai WHERE  tinh_trang > 0
            AND tai_khoan = $id_taikhoan order by ngay_gio asc");
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($rows as $item){
                if ($item['loai'] == 0) {
                    $sodu = $soducuoi + $item['so_tien'];
                }
                else{
                    $sodu = $soducuoi - $item['so_tien'];
                }
                $id = $item['id'];
                $query = $this->update("socai",['so_du' => $sodu],"id = $id");
                $soducuoi = $sodu;
            }
        }

        return $query;
    }




    function delObj($id,$data)
    {
        $query = $this->update("socai",$data,"id = $id");
        if($query){
            
            $query5 = $this->db->query("SELECT ngay_gio,tai_khoan FROM socai WHERE  id = $id");
            $temp = $query5->fetchAll(PDO::FETCH_ASSOC);
            $ngaygio = $temp[0]['ngay_gio'];
            $taikhoan = $temp[0]['tai_khoan'];

            $query2 = $this->db->query("SELECT so_du FROM socai WHERE  tinh_trang > 0
            AND tai_khoan =  $taikhoan AND ngay_gio < '$ngaygio'
            order by ngay_gio desc limit 1");
            $temp2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $soducuoi = 0;
            if(count($temp2) > 0){
                $soducuoi = $temp2[0]['so_du'];
            }
            $query = $this->db->query("SELECT id,so_tien,loai,so_du FROM socai WHERE  tinh_trang > 0
            AND tai_khoan =  $taikhoan AND ngay_gio >= '$ngaygio'
             order by ngay_gio asc");
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($rows as $item){
                if ($item['loai'] == 0) {
                    $sodu = $soducuoi + $item['so_tien'];
                }
                else{
                    $sodu = $soducuoi - $item['so_tien'];
                }
                $id = $item['id'];
                $this->update("socai",['so_du' => $sodu],"id = $id");
                $soducuoi = $sodu;
            }
        }
        return $query;
    }


    function khachhang(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM khachhang WHERE tinh_trang > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    function taikhoan(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM taikhoan WHERE tinh_trang > 0 AND id > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    function nhanvien(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM nhanvien WHERE tinh_trang > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    



    
}
?>