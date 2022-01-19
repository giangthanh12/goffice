<?php
class chiendichtd_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function listObj($draw, $keyword, $offset, $rows)
    {
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS total FROM chiendichtd WHERE name LIKE '%$keyword%' AND tinh_trang > 0");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT *,
            DATE_FORMAT(ngay_bat_dau,'%d/%m/%Y') as ngay_bat_dau,
            DATE_FORMAT(ngay_ket_thuc,'%d/%m/%Y') as ngay_ket_thuc,
            CONCAT('CD-',id) AS ma_cd,
            (SELECT name FROM vitri WHERE id = a.vi_tri) AS vi_tri,
            (SELECT name FROM nhanvien WHERE id = a.nguoi_tao) AS nguoi_tao
            FROM chiendichtd a WHERE tinh_trang > 0 AND name LIKE '%$keyword%' ORDER BY id DESC LIMIT $offset, $rows");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        $result['draw'] = intval($draw);
        $result['recordsTotal'] = $row[0]['total'];
        $result['recordsFiltered'] = $row[0]['total'];

        return $result;
    }

    function addObj($data)
    {
        $query = $this->insert("chiendichtd", $data);
        return $query;
    }

    function getDetail($id)
    {
        $result = array();
        $query = $this->db->query("SELECT *,
            FORMAT(chi_phi_du_kien,0) AS chi_phi_du_kien,
            FORMAT(chi_phi_thuc_te,0) AS chi_phi_thuc_te,
            FORMAT(min_luong,0) AS min_luong,
            FORMAT(max_luong,0) AS max_luong,
            DATE_FORMAT(ngay_bat_dau,'%d/%m/%Y') AS ngay_bat_dau,
            DATE_FORMAT(ngay_ket_thuc,'%d/%m/%Y') AS ngay_ket_thuc,
            (SELECT name FROM chinhanh WHERE id = a.chi_nhanh) AS chi_nhanh,
            (SELECT name FROM phongban WHERE id = a.phong_ban) AS phong_ban,
            (SELECT name FROM vitri WHERE id = a.vi_tri) AS vi_tri,
            IF(han_tuyen != '' AND han_tuyen != '0000-00-00',DATE_FORMAT(han_tuyen,'%d/%m/%Y'),'Tuyển đến khi đủ') as han_tuyen
            FROM chiendichtd a WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        $listnpt = $temp[0]['nguoi_phu_trach'];
        $listnpt = explode(',', $listnpt);
        $nguoiphutrach = '';
        foreach ($listnpt as $item) {
            $query = $this->db->query("SELECT name
                FROM nhanvien WHERE id = $item");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($temp) {
                $nhanvien = $temp[0]['name'];
                $nguoiphutrach .= $nhanvien . ', ';
            }
        }
        $nguoiphutrach = rtrim($nguoiphutrach, ", ");
        $result['nguoi_phu_trach'] = $nguoiphutrach;
        return $result;
    }

    function getData($id)
    {
        $result = array();
        $query = $this->db->query("SELECT *,
            FORMAT(min_luong,0) AS min_luong,
            FORMAT(max_luong,0) AS max_luong,
            FORMAT(max_luong,0) AS chi_phi_du_kien,
            DATE_FORMAT(ngay_bat_dau,'%d/%m/%Y') as ngay_bat_dau,
            DATE_FORMAT(ngay_ket_thuc,'%d/%m/%Y') as ngay_ket_thuc,
            DATE_FORMAT(han_tuyen,'%d/%m/%Y') as han_tuyen
            FROM chiendichtd WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("chiendichtd", $data, "id=$id");
        return $query;
    }

    function addUVCD($id, $ungvien)
    {
        $dem = 0;
        $ungvien = explode(',', $ungvien);
        $ungvien = array_unique($ungvien);
        for ($i = 0; $i < count($ungvien); $i++) {
            $ungvien = $ungvien[$i];
            $data = [
                'chien_dich' => $id,
                'ung_vien' => $ungvien[$i],
                'tinh_trang' => 1
            ];
            $this->insert("uvchiendich", $data);
            $dem++;
        }
        return $dem;
    }
}
