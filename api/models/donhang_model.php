<?php
class Donhang_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT * ,FORMAT(tien_sau_ck,0) AS tien_sau_ck,FORMAT(thanh_toan,0) AS thanh_toan,
        IFNULL((SELECT ten_day_du FROM khachhang WHERE khach_hang = khachhang.id AND tinh_trang > 0), '-') AS khach_hang , 
        IFNULL((SELECT name FROM nhanvien WHERE nhan_vien = nhanvien.id AND tinh_trang > 0), '-') AS nhan_vien  
         FROM donhang WHERE tinh_trang > 0");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function addObj($data)
    {
        $data_bg['ngay'] = $data['ngay'];
        $data_bg['khach_hang'] = $data['khach_hang'];
        $data_bg['nhan_vien'] = $data['nhan_vien'];
        $data_bg['tien_truoc_ck'] = str_replace( ',', '', $data['tien_truoc_ck']);
        $data_bg['chiet_khau'] = str_replace( ',', '', $data['chiet_khau']);
        $data_bg['tien_sau_ck'] = str_replace( ',', '', $data['tien_sau_ck']);
        $data_bg['noi_dung'] = $data['noi_dung'];
        $data_bg['dinh_kem'] = $data['dinh_kem'];
        $data_bg['tinh_trang'] = $data['tinh_trang'];
        $query = $this->insert("donhang",$data_bg);

        if($query){
            $query = $this->db->query("SELECT id FROM donhang order by id desc limit 1");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $id = $temp[0]['id'];
         
            for($i=0;$i < count($data['id_child']);$i++){
                $child['don_hang'] = $id;
                $child['dich_vu'] = $data['id_child'][$i];
                $child['so_luong'] = $data['so_luong_child'][$i];
                $child['don_gia'] = str_replace( ',', '', $data['dongia_child'][$i]);
                $child['loai'] = $data['loai_child'][$i];
                $child['thue_vat'] = $data['thuevat_child'][$i];
                $child['tu_ngay'] = $data['ngays_child'][$i];
                $child['den_ngay'] = $data['ngaye_child'][$i];
                $child['tien_thue'] = str_replace( ',', '', $data['tienthue_child'][$i]);
                $child['chiet_khau_tm'] = str_replace( ',', '', $data['chietkhau_child'][$i]);
                $child['thanh_tien'] = str_replace( ',', '', $data['thanhtien_child'][$i]);
                $child['tinh_trang'] = 1;
                $this->insert("donhangsub",$child);
            }
        }


        return $query;
    }

   

    function getdata($id){
        $result = array();
        $query_bg = $this->db->query("SELECT * ,FORMAT(tien_sau_ck,0) AS tien_sau_ck,
        FORMAT(chiet_khau,0) AS chiet_khau,
        FORMAT(tien_truoc_ck,0) AS tien_truoc_ck
         FROM donhang WHERE id = $id");
        $temp_bg = $query_bg->fetchAll(PDO::FETCH_ASSOC);
        $result['donhang'] = $temp_bg[0];

        $query_bgs = $this->db->query("SELECT * ,IF(loai=0,(SELECT name FROM dichvu WHERE id = donhangsub.dich_vu),(SELECT name FROM sanpham WHERE id = donhangsub.dich_vu)) AS name
        
         FROM donhangsub WHERE don_hang = $id");
        $temp_bgs = $query_bgs->fetchAll(PDO::FETCH_ASSOC);
        $result['donhangsub'] = $temp_bgs;
        return $result;
    }




    function updateObj($id, $data)
    {
        
        $data_bg['ngay'] = $data['ngay'];
        $data_bg['khach_hang'] = $data['khach_hang'];
        $data_bg['nhan_vien'] = $data['nhan_vien'];
        $data_bg['tien_truoc_ck'] = str_replace( ',', '', $data['tien_truoc_ck']);
        $data_bg['chiet_khau'] = str_replace( ',', '', $data['chiet_khau']);
        $data_bg['tien_sau_ck'] = str_replace( ',', '', $data['tien_sau_ck']);
        $data_bg['noi_dung'] = $data['noi_dung'];
        $data_bg['tinh_trang'] = $data['tinh_trang'];
        if($data['dinh_kem'] != ''){
            $data_bg['dinh_kem'] = $data['dinh_kem'];
        }
        $query = $this->update("donhang",$data_bg,"id = $id");

        if($query){
            //xoa het baogia sub 
            $query = $this->delete("donhangsub","don_hang = $id");
            for($i=0;$i < count($data['id_child']);$i++){
                $child['don_hang'] = $id;
                $child['dich_vu'] = $data['id_child'][$i];
                $child['so_luong'] = $data['so_luong_child'][$i];
                $child['don_gia'] = str_replace( ',', '', $data['dongia_child'][$i]);
                $child['loai'] = $data['loai_child'][$i];
                $child['thue_vat'] = $data['thuevat_child'][$i];
                $child['tien_thue'] = str_replace( ',', '', $data['tienthue_child'][$i]);
				$child['tu_ngay'] = $data['ngays_child'][$i];
                $child['den_ngay'] = $data['ngaye_child'][$i];
                $child['chiet_khau_tm'] = str_replace( ',', '', $data['chietkhau_child'][$i]);
                $child['thanh_tien'] = str_replace( ',', '', $data['thanhtien_child'][$i]);
                $child['tinh_trang'] = 1;
                $this->insert("donhangsub",$child);
            }
        }
        return $query;
    }


    function delObj($id,$data)
    {
        $query = $this->update("donhang",$data,"id = $id");
        $query = $this->update("donhangsub",$data,"don_hang = $id");
        return $query;
    }
    function update_status_bg($id)
    {
        $data = ['tinh_trang' => 4];
        $query = $this->update("baogia",$data,"id = $id");
        return $query;
    }

    function get_files($id)
    {
        $query =  $this->db->query("SELECT dinh_kem FROM donhang WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function xoafile($id,$data)
    {
        $query = $this->update("donhang",$data,"id = $id");
        return $query;
    }
  

    function nhanvien(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM nhanvien WHERE tinh_trang > 0");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function khachhang(){
        $result = array();
        $query = $this->db->query("SELECT id, ten_day_du AS `text` FROM khachhang WHERE tinh_trang > 0");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function dichvu(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM dichvu WHERE tinh_trang > 0");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function sanpham(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM sanpham WHERE tinh_trang > 0");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function taikhoan(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM taikhoan WHERE tinh_trang > 0");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    

    function getdata_dichvu($id){
        $result = array();
        $query = $this->db->query("SELECT *,FORMAT(don_gia,0) AS don_gia, FORMAT(thue_vat,0) AS thue_vat 
        FROM dichvu WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }
    
    function getdata_sanpham($id){
        $result = array();
        $query = $this->db->query("SELECT *,FORMAT(don_gia,0) AS don_gia, FORMAT(thue_vat,0) AS thue_vat 
        FROM sanpham WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function lichsuchamsoc($id){
        
        $query = $this->db->query("SELECT * , 
        IFNULL((SELECT name FROM nhanvien WHERE nhan_vien = nhanvien.id AND tinh_trang > 0), '-') AS nhan_vien,
        IFNULL((SELECT hinh_anh FROM nhanvien WHERE nhan_vien = nhanvien.id AND tinh_trang > 0), '-') AS hinh_anh,
        IFNULL((SELECT name FROM tinhtrang_chamsocbaogia WHERE status = tinhtrang_chamsocbaogia.id), '-') AS status   
        FROM baogia_chamsoc WHERE bao_gia = $id ORDER BY ngay_gio DESC");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function add_chamsoc($data){
        $query = $this->insert("baogia_chamsoc",$data);
        return $query;
    }



    function add_thanhtoan($data)
    {   
        //cập nhật lại thanh toán của đơn hàng
        $data['so_tien'] = str_replace( ',', '', $data['so_tien']);
        $id_donhang = $data['don_hang'];
        $so_tien = $data['so_tien'];
        
        //get thong tin don hang
        $query2 = $this->db->query("SELECT * FROM donhang WHERE id = $id_donhang");
        $temp2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        $tien_sau_ck = $temp2[0]['tien_sau_ck'];
        $thanhtoan_db = $temp2[0]['thanh_toan'];
       

        $tien_payy = $so_tien + $thanhtoan_db;
        $so_no = $tien_sau_ck - $tien_payy;
        $data_pay = [
            'thanh_toan' => $tien_payy,
            'so_no' => $so_no,
        ];
        if($so_no == 0 ){
            $data_pay['tinh_trang_tt'] = 2;
            $data_pay['tinh_trang'] = 2;
        }else{
            $data_pay['tinh_trang_tt'] = 1;
            $data_pay['tinh_trang'] = 1;
        }
        $this->update("donhang",$data_pay,"id = $id_donhang");

        
        //Lưu vào sổ cái
        $ngaygio = $data['ngay_gio'];
        $taikhoan = $data['tai_khoan'];
 
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

    function lichsuthanhtoan($id){
        $query = $this->db->query("SELECT * , FORMAT(so_tien,0) AS so_tien,
        IFNULL((SELECT name FROM nhanvien WHERE nhan_vien = nhanvien.id AND tinh_trang > 0), '-') AS nhan_vien ,
        IFNULL((SELECT name FROM taikhoan WHERE tai_khoan = taikhoan.id AND tinh_trang > 0), '-') AS tai_khoan 
        FROM socai WHERE don_hang = $id AND tinh_trang > 0 ORDER BY ngay_gio DESC");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    
    function xoathanhtoan($id,$data)
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
    
    function update_donhang($id){
        $query = $this->db->query("SELECT don_hang,so_tien FROM socai WHERE id = $id");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $donhang = $result[0]['don_hang'];
        $sotien = $result[0]['so_tien'];

        $query = $this->db->query("SELECT thanh_toan,tien_sau_ck FROM donhang WHERE id = $donhang AND tinh_trang > 0");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $thanhtoan_db = $temp[0]['thanh_toan'];
        $tien_sau_ck = $temp[0]['tien_sau_ck'];

        $tien_payy = $thanhtoan_db - $sotien;
        $so_no = $tien_sau_ck - $tien_payy;
        $data_pay = [
            'thanh_toan' => $tien_payy,
            'so_no' => $so_no,
        ];
        if($so_no == 0 ){
            $data_pay['tinh_trang_tt'] = 2;
            $data_pay['tinh_trang'] = 2;
        }else{
            $data_pay['tinh_trang_tt'] = 1;
            $data_pay['tinh_trang'] = 1;
        }
        $this->update("donhang",$data_pay,"id = $donhang");
        return $donhang;
    }

    function loaddata_thanhtoan($id){
        $query=$this->db->query("SELECT * ,FORMAT(so_tien,0) AS so_tien  FROM socai WHERE id = $id");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result[0];
    }
    function update_thanhtoan($id,$data){
        $query=$this->db->query("SELECT so_tien,don_hang  FROM socai WHERE id = $id");
        $socai = $query->fetchAll(PDO::FETCH_ASSOC);
        $data['so_tien'] = str_replace( ',', '', $data['so_tien']);
        $donhang =$socai[0]['don_hang'];

        //update tren don hang
        $query = $this->db->query("SELECT thanh_toan,tien_sau_ck FROM donhang WHERE id = $donhang AND tinh_trang > 0");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $thanhtoan_db = $temp[0]['thanh_toan'];
        $tien_sau_ck = $temp[0]['tien_sau_ck'];

        $tien_socai_old =$socai[0]['so_tien'];
        $tien_new =$data['so_tien'];
        $sotien = $tien_new - $tien_socai_old ;

        $tien_payy = $thanhtoan_db + $sotien;
        $so_no = $tien_sau_ck - $tien_payy;
        $data_pay = [
            'thanh_toan' => $tien_payy,
            'so_no' => $so_no,
        ];
        if($so_no == 0 ){
            $data_pay['tinh_trang_tt'] = 2;
            $data_pay['tinh_trang'] = 2;
        }else{
            $data_pay['tinh_trang_tt'] = 1;
            $data_pay['tinh_trang'] = 1;
        }
        $this->update("donhang",$data_pay,"id = $donhang");
        
        //update tren so cai
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


    }
    
    
}
?>