<?php
class Lead_Model extends Model{
    function __construct()
    {
        parent::__construct();
    }

    function movetokh($data)
    {
        $query = $this->insert("khachhang",$data);
        return $query;
    }

    function listObj($keyword, $nhanvien, $tungay, $denngay)
    {
        $result = array();
        
        $dieukien = " WHERE tinh_trang IN (6) ";
        if($keyword != ''){
            $dieukien .= " AND (ho_ten LIKE '%$keyword%' OR dien_thoai LIKE '%$keyword%') ";
        }
        if($nhanvien > 0) {
            $dieukien .= " AND nhan_vien = $nhanvien ";
        }
        if($tungay != '') {
            $dieukien .= " AND ngay_nhap >= '$tungay' ";
        }
        if($denngay != '') {
            $dieukien .= " AND ngay_nhap <= '$denngay' ";
        }
        $query = $this->db->query("SELECT *,
            DATE_FORMAT(ngay_nhap,'%d/%m/%Y') as ngaynhap,
            IF(ngay_chia!='',DATE_FORMAT(ngay_chia,'%d/%m/%Y'),'') as ngaychia,
            IF(ngay_sinh!='',DATE_FORMAT(ngay_sinh,'%d/%m/%Y'),'') as ngaysinh,
            (SELECT name FROM nhanvien WHERE id = nguoi_nhap) as nguoinhap,
            (SELECT name FROM loaikh WHERE id=phan_loai) as loaikh,
            (SELECT name FROM nhanvien WHERE id = nhan_vien) as nhanvien
            FROM data $dieukien ORDER BY ngay_nhap DESC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
       
        return $result; 
    }

    function getData($id)
    {
        $result = [];
        $result['data'] = array();
        $result['histories'] = array();
        $query = $this->db->query("SELECT * FROM data WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result['data'] = $temp[0];
        $query = $this->db->query("SELECT *,
            (SELECT hinh_anh FROM nhanvien WHERE id = a.nhan_vien) AS hinhanh,
            (SELECT name FROM nhanvien WHERE id = a.nhan_vien) AS username 
            FROM lichsu_data a WHERE tinh_trang = 1 AND id_data = $id ORDER BY ngay_gio DESC");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if($temp)
            $result['histories'] = $temp;
        return $result;
    }

    function loaddata($id){
        $result = array();
        $result['data'] = array();
        $query = $this->db->query("SELECT * FROM data WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if($temp)
            $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("data",$data,"id = $id");
        return $query;
    }

    function checkdt($dienthoai)
    {
        if ($dienthoai != '') {
            $dieukien = " WHERE tinh_trang > 0 AND dien_thoai='$dienthoai'";
            $query = $this->db->query("SELECT COUNT(id) AS total,tinh_trang,id FROM data $dieukien ");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($row[0]['total'] > 0){
                $query = $this->db->query("SELECT COUNT(id) AS total FROM khachhang WHERE tinh_trang > 0 AND dien_thoai = '$dienthoai' ");
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                if ($row[0]['total'] == 0)
                    return $row[0];
            } else
                return false;
        } else
            return false;
    }

    function checkeditdt($dienthoai,$id)
    {
        if ($dienthoai != '') {
            $dieukien = " WHERE tinh_trang > 0 AND id != $id AND dien_thoai='$dienthoai'";
            $query = $this->db->query("SELECT COUNT(id) AS total,tinh_trang,id FROM data $dieukien ");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($row[0]['total'] > 0){
                return false;
            } else {
                $query = $this->db->query("SELECT COUNT(id) AS total FROM khachhang WHERE tinh_trang > 0 AND dien_thoai = '$dienthoai' ");
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                if($row[0]['total'] > 0){
                    return false;
                }
                return true;
            } 
        } else
            return true;
    }

    function addnhatky($data)
    {
        $query = $this->insert('lichsu_data', $data);
        return $query;
    }

    function addObj($data)
    {
        $query = $this->insert("data", $data);
        return $query;
    }
}

?>