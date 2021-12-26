<?php
class Tainguyen_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getFetObj($nhanvienid, $draw, $keyword, $offset, $rows)
    {
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM resource WHERE name LIKE '%$keyword%'
                                    AND (nguoi_tao = $nhanvienid OR FIND_IN_SET($nhanvienid, nhan_vien))");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, name, chu_so_huu, nha_cung_cap, link, ten_dang_nhap, mat_khau, ghi_chu, phan_loai, nguoi_tao, 
                                (SELECT khachhang.name FROM khachhang WHERE khachhang.id = chu_so_huu) AS chusohuu, 
                                (SELECT nhacungcap.name FROM nhacungcap WHERE nhacungcap.id = nha_cung_cap) AS nhacungcap,
                                (SELECT phanloai.name FROM phanloai WHERE phanloai.id = phan_loai) AS phanloai, 
                                (SELECT nhanvien.name FROM nhanvien WHERE nhanvien.id = nguoi_tao) AS nguoitao 
                                FROM resource WHERE tinh_trang = 1 AND name LIKE '%$keyword%' AND (nguoi_tao = $nhanvienid OR FIND_IN_SET($nhanvienid, nhan_vien)) ORDER BY id DESC LIMIT $offset, $rows");
        $result['draw'] = intval($draw);
        $result['recordsTotal'] = $row[0]['Total'];
        $result['recordsFiltered'] = $row[0]['Total'];
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getFetObjApi($nhanvienid, $keyword, $offset, $rows)
    {
        $result = array();
        $query = $this->db->query("SELECT id, name, chu_so_huu, nha_cung_cap, link, ten_dang_nhap, mat_khau, ghi_chu, phan_loai, nguoi_tao, 
                                (SELECT khachhang.name FROM khachhang WHERE khachhang.id = chu_so_huu) AS chusohuu, 
                                (SELECT nhacungcap.name FROM nhacungcap WHERE nhacungcap.id = nha_cung_cap) AS nhacungcap,
                                (SELECT phanloai.name FROM phanloai WHERE phanloai.id = phan_loai) AS phanloai, 
                                (SELECT nhanvien.name FROM nhanvien WHERE nhanvien.id = nguoi_tao) AS nguoitao 
                                FROM resource WHERE tinh_trang = 1 AND name LIKE '%$keyword%' AND (nguoi_tao = $nhanvienid OR FIND_IN_SET($nhanvienid, nhan_vien)) ORDER BY id DESC LIMIT $offset, $rows");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function get_detail_tainguyen($id)
    {
        $result = array();
        $query = $this->db->query("SELECT id, name, chu_so_huu, nha_cung_cap, link, ten_dang_nhap, mat_khau, ghi_chu,
                                    phan_loai, nguoi_tao, nhan_vien, 
                                    (SELECT khachhang.name FROM khachhang WHERE khachhang.id = chu_so_huu) AS chusohuu, 
                                    (SELECT nhacungcap.name FROM nhacungcap WHERE nhacungcap.id = nha_cung_cap) AS nhacungcap,
                                    (SELECT phanloai.name FROM phanloai WHERE phanloai.id = phan_loai) AS phanloai, 
                                    (SELECT nhanvien.name FROM nhanvien WHERE nhanvien.id = nguoi_tao) AS nguoitao 
                                    FROM resource WHERE id = $id");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getnhanvien($id)
    {
        $result = array();
        $query = $this->db->query("SELECT nhan_vien
                                    FROM resource WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if($temp)
            $result = $temp[0]['nhan_vien'];
        return $result;
    }

    function getnhanvienApi($id)
    {
        $result = [];
        $query = $this->db->query("SELECT nhan_vien
                                    FROM resource WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if($temp)
            $result = $temp[0]['nhan_vien'];
        if($result){
            $result = explode(',',$result);
        }
        return $result;
    }

    function addObj($data)
    {
        $query = $this->insert("resource", $data);
        return $query;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("resource", $data, "id = $id");
        return $query;
    }

    function chiase($data, $id)
    {
        $result = $this->update("resource", $data, " id=$id ");
        return $result;
    }

    function delObj($id)
    {
        $query = $this->update("resource",['tinh_trang' => 0] ,"id = $id");
        return $query;
    }
}
