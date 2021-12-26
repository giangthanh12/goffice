<?php
class Data_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function listAll()
    {
        $result = array();
        $result['data'] = [];
        $dieukien = " WHERE tinh_trang > 0 AND tinh_trang != 6 ";

        $query = $this->db->query("SELECT *
            FROM data $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp) {
            $result['data'] = $temp;
        }
        return $result;
    }

    function listObj($keyword, $nhanvien, $tungay, $denngay, $offset, $rows)
    {
        $result = array();
        $result['data'] = [];
        $result['total'] = 0;
    
        $dieukien = " WHERE tinh_trang > 0 AND tinh_trang != 6 AND tinh_trang != 9 ";
        if ($keyword != '') {
            $dieukien .= " AND (ho_ten LIKE '%$keyword%' OR dien_thoai LIKE '%$keyword%') ";
        }
        if ($nhanvien > 0 && $nhanvien!=1 && $nhanvien!=2) {
            $dieukien .= " AND nhan_vien = $nhanvien ";
        }
        if ($tungay != '') {
            $dieukien .= " AND ngay_nhap >= '$tungay' ";
        }
        if ($denngay != '') {
            $dieukien .= " AND ngay_nhap <= '$denngay' ";
        }
        $query = $this->db->query("SELECT id FROM data $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($temp) {
            $result['total'] = count($temp);
        }

        $query = $this->db->query("SELECT *,
            DATE_FORMAT(ngay_nhap,'%d/%m/%Y') as ngaynhap,
            IF(ngay_chia!='',DATE_FORMAT(ngay_chia,'%d/%m/%Y'),'') as ngaychia,
            IF(ngay_sinh!='',DATE_FORMAT(ngay_sinh,'%d/%m/%Y'),'') as ngaysinh,
            (SELECT name FROM nhanvien WHERE id = nguoi_nhap) as nguoinhap,
            (SELECT name FROM loaikh WHERE id=phan_loai) as loaikh,
            (SELECT name FROM nhanvien WHERE id = nhan_vien) as nhanvien
            FROM data $dieukien ORDER BY ngay_nhap DESC LIMIT $offset,$rows ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp) {
            $result['data'] = $temp;
        }
        return $result;
    }

    function listObjApi($keyword, $offset, $rows)
    {
        $result = array();
        $result['data'] = [];
        $dieukien = " WHERE tinh_trang > 0 AND tinh_trang != 6 AND tinh_trang != 9 ";
        if ($keyword != '') {
            $dieukien .= " AND ho_ten LIKE '%$keyword%' OR dien_thoai LIKE '%$keyword%' ";
        }

        $query = $this->db->query("SELECT *,
            DATE_FORMAT(ngay_nhap,'%d/%m/%Y') as ngaynhap,
            IF(ngay_chia!='',DATE_FORMAT(ngay_chia,'%d/%m/%Y'),'') as ngaychia,
            IF(ngay_sinh!='',DATE_FORMAT(ngay_sinh,'%d/%m/%Y'),'') as ngaysinh,
            (SELECT name FROM nhanvien WHERE id = nguoi_nhap) as nguoinhap,
            (SELECT name FROM loaikh WHERE id=phan_loai) as loaikh,
            (SELECT name FROM nhanvien WHERE id = nhan_vien) as nhanvien
            FROM data $dieukien ORDER BY ngay_nhap DESC LIMIT $offset,$rows  ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp) {
            $result['data'] = $temp;
        }
        return $result;
    }

    function addObj($data)
    {
        $query = $this->insert("data", $data);
        return $query;
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
        if ($temp)
            $result['histories'] = $temp;
        return $result;
    }

    function getHistory($id)
    {
        $result = array();
        $query = $this->db->query("SELECT *,
            (SELECT email FROM users WHERE id = a.nhan_vien) AS username,
            (SELECT hinh_anh FROM nhanvien WHERE id = a.nhan_vien) AS avatar
            FROM lichsu_data a WHERE tinh_trang = 1 AND id_data = $id ORDER BY ngay_gio ASC");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp)
            $result = $temp;
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("data", $data, "id = $id");
        return $query;
    }

    function chiadata($nhanvien, $data)
    {
        $ok = false;
        $rows = explode(',', $data);
        foreach ($rows as $row) {
            $id = $row;
            $query = $this->db->query("SELECT tinh_trang FROM data WHERE id = $id");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $tinhtrang = $temp[0]['tinh_trang'];
            if ($tinhtrang == 1 || $tinhtrang == '') {
                $update = ['tinh_trang' => 2, 'nhan_vien' => $nhanvien, 'ngay_chia' => date('Y-m-d')];
            } else {
                $update = ['nhan_vien' => $nhanvien, 'ngay_chia' => date('Y-m-d')];
            }
            $ok = $this->update("data", $update, " id=$id ");
        }
        return $ok;
    }

    function movetolead($data)
    {
        $ok = false;
        $rows = explode(',', $data);
        foreach ($rows as $row) {
            $id = $row;
            $update = ['tinh_trang' => 6];
            $ok = $this->update("data", $update, "id=$id");
        }
        return $ok;
    }

    function checkdt($dienthoai)
    {
        if ($dienthoai != '') {
            $dieukien = " WHERE tinh_trang > 0 AND dien_thoai='$dienthoai'";
            $query = $this->db->query("SELECT COUNT(id) AS total FROM data $dieukien ");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($row[0]['total'] > 0)
                return false;
            else {
                $query = $this->db->query("SELECT COUNT(id) AS total FROM khachhang WHERE tinh_trang > 0 AND dien_thoai = '$dienthoai' ");
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                if ($row[0]['total'] > 0)
                    return false;
                else
                    return true;
            }
        } else
            return true;
    }

    function checkeditdt($dienthoai, $id)
    {
        if ($dienthoai != '') {
            $dieukien = " WHERE tinh_trang > 0 AND id != $id AND dien_thoai='$dienthoai'";
            $query = $this->db->query("SELECT COUNT(id) AS total FROM data $dieukien ");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($row[0]['total'] > 0)
                return false;
            else {
                $query = $this->db->query("SELECT COUNT(id) AS total FROM khachhang WHERE tinh_trang > 0 AND dien_thoai = '$dienthoai' ");
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                if ($row[0]['total'] > 0) {
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
}
