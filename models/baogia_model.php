<?php
class Baogia_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT * ,FORMAT(tien_sau_ck,0) AS tien_sau_ck,
        IFNULL((SELECT ten_day_du FROM khachhang WHERE khach_hang = khachhang.id AND tinh_trang > 0), '-') AS khach_hang ,
        IFNULL((SELECT name FROM nhanvien WHERE nhan_vien = nhanvien.id AND tinh_trang > 0), '-') AS nhan_vien
         FROM baogia  WHERE tinh_trang>0 order by ngay DESC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function send()
    {
        // if ($id==0) {
        //     $query = $this->insert("quotation",$data);
        //     if ($query) {
        //         $id = $this->db->lastInsertId();
        //         foreach ($items AS $item) {
        //             $sub['quotationId'] = $id;
        //             $sub['goods'] = $item['product'];
        //             $sub['description'] =  $item['noteProduct'];
        //             $sub['price'] = str_replace(',','',$item['price']);
        //             $sub['unit'] = $item['unit'];
        //             $sub['quantity'] = $item['qty'];
        //             $sub['reduce'] = str_replace(',','',$item['discount']);
        //             $sub['discount'] = $item['chietkhau'];
        //             $sub['vat'] = $item['vat'];
        //             $sub['status'] = 1;
        //             $query = $this->insert("subquotation",$sub);
        //         }
        //     }
        // } else {
        //     $query = $this->update("quotation",$data,"id=$id");
        //     if ($query) {
        //         $query =  $this->db->query("UPDATE subquotation SET status=0 WHERE quotationIdid = $id");
        //         foreach ($items AS $item) {
        //             $sub['quotationId'] = $id;
        //             $sub['goods'] = $item['product'];
        //             $sub['description'] =  $item['noteProduct'];
        //             $sub['price'] = str_replace(',','',$item['price']);
        //             $sub['unit'] = $item['unit'];
        //             $sub['quantity'] = $item['qty'];
        //             $sub['reduce'] = str_replace(',','',$item['discount']);
        //             $sub['discount'] = $item['chietkhau'];
        //             $sub['vat'] = $item['vat'];
        //             $sub['status'] = 1;
        //             $query = $this->insert("subquotation",$sub);
        //         }
        //     }
        // }
        // $id = 1;
        // if($id>0) {
            $from = ['Email' => 'info@gemstech.com.vn', 'Name' => 'G-office'];
            $tolist = [['Email' => 'hai@vdata.com.vn', 'Name' => 'Khách hàng']];
            $subject = 'Báo giá gửi quý khách hàng';
            $textpart = 'Báo giá gửi từ hệ thống G-office';
            $noidung = 'Báo giá gửi từ hệ thống G-office';
            $result = $this->sendmail($from, $tolist, [], [], $subject, $noidung, $textpart);
        // }
        return $result;
    }

    function saveQuote($id,$data,$items){
        if ($id==0) {
            $query = $this->insert("quotation",$data);
            if ($query) {
                $id = $this->db->lastInsertId();
                foreach ($items AS $item) {
                    $sub['quotationId'] = $id;
                    $sub['goods'] = $item['product'];
                    $sub['description'] =  $item['noteProduct'];
                    $sub['price'] = str_replace(',','',$item['price']);
                    $sub['unit'] = $item['unit'];
                    $sub['quantity'] = $item['qty'];
                    $sub['reduce'] = str_replace(',','',$item['discount']);
                    $sub['discount'] = $item['chietkhau'];
                    $sub['vat'] = $item['vat'];
                    $sub['status'] = 1;
                    $query = $this->insert("subquotation",$sub);
                }
            }
        } else {
            $query = $this->update("quotation",$data,"id=$id");
            if ($query) {
                $query =  $this->db->query("UPDATE subquotation SET status=0 WHERE quotationIdid = $id");
                foreach ($items AS $item) {
                    $sub['quotationId'] = $id;
                    $sub['goods'] = $item['product'];
                    $sub['description'] =  $item['noteProduct'];
                    $sub['price'] = str_replace(',','',$item['price']);
                    $sub['unit'] = $item['unit'];
                    $sub['quantity'] = $item['qty'];
                    $sub['reduce'] = str_replace(',','',$item['discount']);
                    $sub['discount'] = $item['chietkhau'];
                    $sub['vat'] = $item['vat'];
                    $sub['status'] = 1;
                    $query = $this->insert("subquotation",$sub);
                }
            }
        }
        return $id;
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
        $query = $this->update("baogia",$data_bg,"id = $id");
        if($query){
            //xoa het baogia sub
            $query = $this->delete("baogiasub","bao_gia = $id");
            for($i=0;$i < count($data['id_child']);$i++){
                $child['bao_gia'] = $id;
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
                $this->insert("baogiasub",$child);
            }
        }
        return $query;
    }


    function delObj($id,$data)
    {
        $query = $this->update("baogia",$data,"id = $id");
        $query = $this->update("baogiasub",$data,"bao_gia = $id");
        return $query;
    }

    function get_files($id)
    {
        $query =  $this->db->query("SELECT dinh_kem FROM baogia WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function xoafile($id,$data)
    {
        $query = $this->update("baogia",$data,"id = $id");
        return $query;
    }

    function nhanvien(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM nhanvien WHERE tinh_trang > 0");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getCustomer($keyword){
        $result = array();
        $query = $this->db->query("SELECT id, shortName AS `text` FROM customer  WHERE status>0 AND shortName LIKE '%$keyword%' ORDER BY id DESC ");
        if ($query)
            $result['results'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getProduct(){
        $result = array();
        $query = $this->db->query("SELECT id, name FROM products WHERE status>0 ");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getProductDetail($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM products WHERE id=$id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($temp[0]))
            $result = $temp[0];
        return $result;
    }

    function newCustomer($data,$contact,$phone,$email){
        $query = $this->insert("customer",$data);
        if ($query) {
            $id = $this->db->lastInsertId();
            $contact = ['name'=>$contact, 'customerId'=>$id, 'phoneNumber'=>$phone, 'email'=>$email,'status'=>1];
            $query = $this->insert("contact",$contact);
        }
        return $query;
    }
    function sanpham(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM sanpham WHERE tinh_trang > 0");
        if ($query)
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function status_cskh(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM tinhtrang_chamsocbaogia WHERE tinh_trang > 0");
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
        IFNULL((SELECT name FROM nhanvien WHERE nhan_vien = nhanvien.id AND tinh_trang > 0), 'Nhân viên') AS nhan_vien,
        IFNULL((SELECT hinh_anh FROM nhanvien WHERE nhan_vien = nhanvien.id AND tinh_trang > 0), 'https://velo.vn/goffice/users/gemstech/uploads/useravatar.png') AS hinh_anh,
        IFNULL((SELECT name FROM tinhtrang_chamsocbaogia WHERE status = tinhtrang_chamsocbaogia.id), '-') AS status
        FROM baogia_chamsoc WHERE bao_gia = $id ORDER BY ngay_gio DESC");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function add_chamsoc($data){
        $query = $this->insert("baogia_chamsoc",$data);
        return $query;
    }

    function load_id_lead($id){
        $query = $this->db->query("SELECT *  FROM data WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }
    function load_id_kh($id){
        $query = $this->db->query("SELECT *  FROM khachhang WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }
    function update_lead($id, $data)
    {
        $query = $this->update("data",$data,"id = $id");
        return $query;
    }
    function update_kh($id, $data)
    {
        $query = $this->update("khachhang",$data,"id = $id");
        return $query;
    }
    function movetokh($data)
    {
        $query = $this->insert("khachhang",$data);
        if($query){
            $query2 = $this->db->query("SELECT id FROM khachhang order by id desc limit 1");
            $temp = $query2->fetchAll(PDO::FETCH_ASSOC);
            $result = $temp[0];
            return $result;
        }
    }



}
?>
