<?php
class inbox_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function getdata($type){
        $temp = array();
        $user = $_SESSION['user']['nhan_vien'];
        if ($type=='sent')
            $dieukien = " WHERE tinh_trang>0 AND nguoi_gui=$user GROUP BY tieu_de ";
        elseif ($type=='trash')
            $dieukien = " WHERE tinh_trang=0 GROUP BY tieu_de ";
        else
            $dieukien = " WHERE tinh_trang>0 AND nguoi_nhan LIKE '%$user%' ";
        $query = $this->db->query("SELECT id,tieu_de,nguoi_gui, nguoi_nhan, ngay_gio, link, SUBSTRING(noi_dung,1,128) AS noidung, tinh_trang,
            (SELECT name FROM nhanvien WHERE id=nguoi_gui) AS nguoigui,
            IFNULL((SELECT hinh_anh FROM nhanvien WHERE id=nguoi_gui),'xxx') AS hinhanh
            FROM events $dieukien ORDER BY ngay_gio DESC ");
        if ($query)
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        return $temp;
    }

    function unread(){ // dung cho notification
        $result = 0;
        $nguoinhan = $_SESSION['user']['nhan_vien'];
        $query = $this->db->query("SELECT COUNT(1) AS total FROM events WHERE tinh_trang IN (1,2) AND nguoi_nhan=$nguoinhan ");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = isset($temp[0])?$temp[0]['total']:0;
        }
        return $result;
    }

    function getsentitem(){
        $temp = array();
        $nguoigui = $_SESSION['user']['nhan_vien'];
        $data = '<ul class="email-media-list">';
        $query = $this->db->query("SELECT id,tieu_de,nguoi_gui, nguoi_nhan, ngay_gio, link, SUBSTRING(noi_dung,1,128) AS noidung, tinh_trang,
            (SELECT name FROM nhanvien WHERE id=nguoi_gui) AS nguoigui,
            IFNULL((SELECT hinh_anh FROM nhanvien WHERE id=nguoi_gui),'xxx') AS hinhanh
            FROM events WHERE tinh_trang>0 AND nguoi_gui=$nguoigui GROUP BY tieu_de ORDER BY ngay_gio DESC ");
        if ($query)
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        return $temp;
    }

    function checkmail(){ // dung cho notification
        $result = array();
        $nguoinhan = '"'.$_SESSION['user']['nhan_vien'].'"';
        $dieukien = " WHERE tinh_trang=1 AND nguoi_nhan LIKE '%$nguoinhan%' ";

        $query = $this->db->query("SELECT id, tieu_de, noi_dung, ngay_gio, link,
            (SELECT name FROM nhanvien WHERE id=nguoi_gui) AS nguoigui,
            (SELECT hinh_anh FROM nhanvien WHERE id=nguoi_gui) AS hinhanh
            FROM events $dieukien ORDER BY ngay_gio DESC LIMIT 1 ");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = isset($temp[0])?$temp[0]:array();
        }
        return $result;
    }

    function markunread($ids) {
        $query = $this->update("events", ['tinh_trang'=>2], " id IN ($ids) ");
        return $query;
    }

    function add($data){
        $receiver = '';
        $data['nguoi_gui'] = $_SESSION['user']['nhan_vien'];
        $data['ngay_gio'] = date('Y-m-d H:i:s');
        $data['link'] = 'inbox';
        $nguoinhan = json_decode($data['nguoi_nhan']);
        if (in_array(0, $nguoinhan)) {
            $query = $this->db->query("SELECT id FROM nhanvien WHERE tinh_trang IN (1,2,3,4) ");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($temp AS $item)
                if ($receiver=='')
                    $receiver = $item['id'];
                else
                    $receiver .= ','.$item['id'];
        } else {
            $receiver = str_replace('[','',str_replace(']','',str_replace('"','',$data['nguoi_nhan'])));
        }
        $query = $this->insert("events", $data);
        if ($query)
            return $receiver;
        else
            return '';
    }

    function xoa($ids){
        $query = $this->update("events", ['tinh_trang'=>0], " id IN ($ids) ");
        return $query;
    }


    function get_detail($id){
        $result = array();
        $query = $this->db->query("SELECT *,
            (SELECT name FROM nhanvien WHERE id=nguoi_gui) AS nguoigui,
            IFNULL((SELECT hinh_anh FROM nhanvien WHERE id=nguoi_gui),'xxx') AS hinhanh
            FROM events WHERE id=$id ");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $query = $this->update("events", ['tinh_trang'=>3], " id=$id ");
            $result = $temp[0];
        }
        return $result;
    }

    function nhanvien(){
        $result = array();
        $query = $this->db->query("SELECT id, name, hinh_anh FROM nhanvien WHERE tinh_trang>0 AND tinh_trang<7");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>
