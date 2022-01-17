<?php
class tamung_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_data_combo($phongban){
        $result = array();
        $dieukien = " WHERE tinh_trang > 0 ";
        if($phongban != 0){
            $dieukien .= " AND phong_ban = $phongban ";
        }
        $query = $this->db->query("SELECT id, name AS text FROM denghi $dieukien ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT *,
                FORMAT(so_tien,0) AS so_tien,
                DATE_FORMAT(ngay,'%d/%m/%Y') as ngay
                FROM denghi WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function listObj()
    {
        $result = array();
        $dieukien = " WHERE tinh_trang>0 ORDER BY id DESC ";
        $query = $this->db->query("SELECT *,
           IF(ngay='0000-00-00','',DATE_FORMAT(ngay, '%d/%m/%Y')) AS ngaygio,
           IF(tinh_trang=1,'Tạo mới',IF(tinh_trang=2,'Đã duyệt','Từ chối')) as tinhtrang,
           (SELECT name FROM nhanvien WHERE id=nguoi_duyet) as nguoiduyet,
           (SELECT name FROM nhanvien WHERE id=nhan_vien) as nhanvien
           FROM denghi $dieukien ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // function listObjApi()
    // {
    //     $result = array();
    //     $dieukien = " WHERE tinh_trang > 0  ";
    //     $query = $this->db->query("SELECT *,
    //        IF(ngay='0000-00-00','',DATE_FORMAT(ngay, '%d/%m/%Y')) AS ngaygio,
    //        IF(tinh_trang=1,'Tạo mới',IF(tinh_trang=2,'Đã duyệt','Từ chối')) as tinhtrang,
    //        (SELECT name FROM nhanvien WHERE id=nguoi_duyet) as nguoiduyet,
    //        (SELECT name FROM nhanvien WHERE id=nhan_vien) as nhanvien
    //        FROM denghi $dieukien ");
    //     $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }

    function addObj($data)
    {
        $query = $this->insert("denghi", $data);
        if($query){
            $event = array('name'=>'Đề nghị tạm ứng/TT '.number_format($data['so_tien']).' '.$data['noi_dung'],
                'nguoi_gui'=>$data['nhan_vien'], 'nguoi_nhan'=>'6',
                'ngay_gio'=>date("Y-m-d H:i:s"), 'tinh_trang'=>1);
            $this->insert("events", $event);
            $event = array('name'=>'Đề nghị tạm ứng/TT '.number_format($data['so_tien']).' '.$data['noi_dung'],
                'nguoi_gui'=>$data['nhan_vien'], 'nguoi_nhan'=>'7',
                'link'=>URL.'/denghi',
                'ngay_gio'=>date("Y-m-d H:i:s"), 'tinh_trang'=>1);
            $this->insert("events", $event);
        }
        return $query;
    }

    function updateObj($id, $data, $nguoisua)
    {
        $query = $this->update("denghi", $data, "id=$id");
        if($query){
            $nhatky = array(
                'ngay_gio' => date("Y-m-d H:i:s"),
                'user' => $nguoisua,
                'doi_tuong' => 'Tạm ứng/TT',
                'action' => 'Sửa phiếu tạm ứng id:' . $id
            );
            $query = $this->insert("nhatky", $nhatky);
        }
        
        return $query;
    }

    function duyetphieu($id, $data, $nguoisua)
    {
        $query = $this->update("denghi", $data, "id=$id");
        $nhatky = array(
            'ngay_gio' => date("Y-m-d H:i:s"),
            'user' => $nguoisua,
            'doi_tuong' => 'Tạm ứng/TT',
            'action' => 'Duyệt/từ chối phiếu tạm ứng id:' . $id
        );
        $query = $this->insert("nhatky", $nhatky);
        return $query;
    }

    function updateBL($id) 
    {
        $query = $this->db->query("SELECT so_tien,nhan_vien FROM denghi WHERE id = $id ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if($temp) {
            $sotien = $temp[0]['so_tien'];
            $nhanvien = $temp[0]['nhan_vien'];
        }

        $thang = date('m');
        $nam = date('Y');
        $query = $this->db->query("SELECT id,tam_ung FROM bangluong WHERE nhan_vien = $nhanvien AND thang = $thang AND nam = $nam ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if($temp) {
            $id = $temp[0]['id'];
            $tamungmoi = $temp[0]['tam_ung'] + $sotien;
            $query = $this->update("bangluong", ['tam_ung' => $tamungmoi], "id=$id");
        } 
        return $query;
    }

    function delObj($id, $data, $nguoisua)
    {
        $query = $this->update("denghi", $data, "id = $id");
        if($query){
            $nhatky = array(
                'ngay_gio' => date("Y-m-d H:i:s"),
                'user' => $nguoisua,
                'doi_tuong' => 'Tạm ứng',
                'action' => 'Xóa phiếu tạm ứng:' . $id
            );
            $query = $this->insert("nhatky", $nhatky);
        }
        return $query;
    }

}
