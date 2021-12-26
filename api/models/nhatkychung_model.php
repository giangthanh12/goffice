<?php
class nhatkychung_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function getlist(){
        $nhanvien = array();
        $query = $this->db->query("SELECT *, IF(ngay_chung_tu='0000-00-00','',DATE_FORMAT(ngay_chung_tu,'%d/%m/%Y')) AS ngay,
            IF(no=0,'',no) AS no, IF(co=0,'',co) AS co,
            (SELECT name FROM mataikhoan WHERE ma_tai_khoan=tai_khoan) AS taikhoan,
            (SELECT name FROM khachhang WHERE id=khach_hang) AS khachhang
            FROM nhatkychung WHERE tinh_trang=1 ORDER BY ngay_chung_tu DESC ");
        if ($query)
            $nhanvien['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $nhanvien;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT *,
          IF(hinh_anh='','".URLFILE."/uploads/useravatar.png',hinh_anh) AS hinh_anh
          FROM nhanvien WHERE id=$id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateinfo($data,$id){
        $query = $this->update("nhanvien", $data, " id=$id ");
        return $query;
    }

    function thayanh($file,$id){
        if ($file=='')
            return false;
        else {
            $data = ['hinh_anh'=>$file];
            $query = $this->update("nhanvien", $data, " id=$id ");
            return $query;
        }
    }

    function them($data){
        $query = $this->insert("nhanvien", $data);
        return $query;
    }

    function xoa($id){
        $query = $this->update("nhanvien", ['tinh_trang'=>0], " id=$id ");
        return $query;
    }

    function thoiviec($id){
        $query = $this->update("nhanvien", ['tinh_trang'=>6], " id=$id ");
        return $query;
    }

    function thanhpho(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM thanhpho WHERE tinh_trang=1");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>
