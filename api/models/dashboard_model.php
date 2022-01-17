<?php
class dashboard_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function getdata(){
        $data = array();
        $nguoinhan = $_SESSION['user']['nhan_vien'];
        $query = $this->db->query("SELECT tieu_de,
            (SELECT name FROM nhanvien WHERE id=nguoi_gui) AS nguoigui
            FROM events WHERE tinh_trang IN (1,2) AND nguoi_nhan=$nguoinhan ORDER BY ngay_gio DESC LIMIT 1 ");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $data['thongbao'] = isset($temp[0])?$temp[0]:array();
            $query = $this->db->query("SELECT COUNT(1) AS total
                FROM events WHERE tinh_trang IN (1,2) AND nguoi_nhan=$nguoinhan ");
            if ($query) {
                $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                $data['tinmoi'] = $temp[0]['total'];
            } else {
                $data['tinmoi'] = 0;
            }
        }
        return $data;
    }

    function activeuser(){
        $id = $_SESSION['user']['id'];
        $query = $this->db->query("UPDATE users SET active=1 WHERE id=$id ");
        return $query;
    }

    function getactive($users){
        $result = array();
        $query = $this->db->query("SELECT id,name,hinh_anh FROM nhanvien WHERE id IN ($users) ");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }




    function deactiveuser(){
        $id = $_SESSION['user']['id'];
        $query = $this->db->query("UPDATE users SET active=0 WHERE id=$id ");
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


}
?>
