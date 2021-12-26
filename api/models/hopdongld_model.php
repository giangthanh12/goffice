<?php
class hopdongld_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function listObj(){
        $query = $this->db->query("SELECT *,
            (SELECT name FROM loaihopdong WHERE id = a.loai) as loaihd,
            (SELECT name FROM nhanvien WHERE id = a.nhan_vien) as nhanvien,
            (SELECT name FROM phongban WHERE id = a.phong_ban) as phongban,
            (SELECT name FROM chinhanh WHERE id = a.chi_nhanh) as chinhanh,
            (SELECT name FROM vitri WHERE id = a.vi_tri) as vitri
            FROM hopdongld a WHERE tinh_trang > 0 ORDER BY ngay_di_lam DESC ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_data_combo(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS text FROM hopdongld WHERE tinh_trang > 0 ");
        $result['items'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addObj($data)
    {
        $query = $this->insert("hopdongld",$data);
        return $query;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT *,
                FORMAT(luong_co_ban,0) AS luong_co_ban,
                FORMAT(luong_bao_hiem,0) AS luong_bao_hiem,
                FORMAT(phu_cap,0) AS phu_cap,
                DATE_FORMAT(ngay_di_lam,'%d/%m/%Y') as ngay_di_lam,
                DATE_FORMAT(ngay_ket_thuc,'%d/%m/%Y') as ngay_ket_thuc
                FROM hopdongld WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("hopdongld",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("hopdongld",$data,"id = $id");
        return $query;
    }

    
}
?>