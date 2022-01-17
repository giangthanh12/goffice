<?php
class dexuattd_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_data_combo()
    {
        $result = array();
        $query = $this->db->query("SELECT id,name,
            (SELECT name FROM vitri WHERE id = a.vi_tri) AS vi_tri, 
            IF(han_tuyen != '' AND han_tuyen != '0000-00-00',DATE_FORMAT(han_tuyen,'%d/%m/%Y'),'Tuyển đến khi đủ') as han_tuyen
            -- CONCAT(name,'<br/>Vị trí: ',vitri,'<br/>Hạn tuyển: ',hantuyen) AS text 
        FROM dexuattd a WHERE tinh_trang = 2 ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function listObj($draw, $keyword, $offset, $rows)
    {
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS total FROM dexuattd WHERE name LIKE '%$keyword%' AND tinh_trang > 0");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT *,
            (SELECT name FROM nhanvien WHERE id = a.nguoi_tao) AS nguoi_tao,
            (SELECT name FROM phongban WHERE id = a.phong_ban) AS phong_ban,
            (SELECT name FROM vitri WHERE id = a.vi_tri) AS vi_tri,
            IF(han_tuyen != '' AND han_tuyen != '0000-00-00',DATE_FORMAT(han_tuyen,'%d/%m/%Y'),'Tuyển đến khi đủ') as han_tuyen
            FROM dexuattd a WHERE tinh_trang > 0 AND name LIKE '%$keyword%' ORDER BY id DESC LIMIT $offset, $rows");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        $result['draw'] = intval($draw);
        $result['recordsTotal'] = $row[0]['total'];
        $result['recordsFiltered'] = $row[0]['total'];

        return $result;
    }

    function addObj($data){
        $query = $this->insert("dexuattd", $data);
        return $query;
    }

    function getDetail($id){
        $result = array();
        $query = $this->db->query("SELECT *,
            FORMAT(min_luong,0) AS min_luong,
            FORMAT(max_luong,0) AS max_luong,
            (SELECT name FROM chinhanh WHERE id = a.chi_nhanh) AS chi_nhanh,
            (SELECT name FROM phongban WHERE id = a.phong_ban) AS phong_ban,
            (SELECT name FROM vitri WHERE id = a.vi_tri) AS vi_tri,
            IF(han_tuyen != '' AND han_tuyen != '0000-00-00',DATE_FORMAT(han_tuyen,'%d/%m/%Y'),'Tuyển đến khi đủ') as han_tuyen
            FROM dexuattd a WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function getData($id){
        $result = array();
        $query = $this->db->query("SELECT *,
            FORMAT(min_luong,0) AS min_luong,
            FORMAT(max_luong,0) AS max_luong,
            DATE_FORMAT(han_tuyen,'%d/%m/%Y') as han_tuyen
            FROM dexuattd WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id,$data){
        $query = $this->update("dexuattd", $data ,"id=$id");
        return $query;
    }

}
