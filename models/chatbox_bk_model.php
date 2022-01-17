<?php
class Chatbox_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function get_list_all_nhanvien($nhanvienid,$listnv){
        $result = array();
        $dieukien = " WHERE id != $nhanvienid AND tinh_trang IN (1,2,3,4) ";
        if($listnv!='')
            $dieukien.=" AND id NOT IN ($listnv) ";
        $query = $this->db->query("SELECT id, name, hinh_anh, (SELECT token FROM users 
                                    WHERE users.nhan_vien = nhanvien.id ORDER BY id DESC LIMIT 1) AS online FROM nhanvien $dieukien
                                     ORDER BY name ASC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_list_chatbox($nhanvienid){
        $result = array();
        $dbchat = DB_CHAT;
        $query = $this->db->query("SELECT id, name, code, nhan_vien, file, create_at, chat_group, tin_nhan_cuoi,nguoi_tao,
                                    IF(chat_group = 0, IF($nhanvienid = nguoi_tao, (SELECT nhanvien.name FROM nhanvien 
                                    WHERE nhanvien.id = nhan_vien), (SELECT nhanvien.name FROM nhanvien 
                                    WHERE nhanvien.id = nguoi_tao)), name) AS group_name,
                                    IF(chat_group = 0, (SELECT token FROM users WHERE users.nhan_vien = $dbchat.chatbox.nhan_vien),
                                    null) AS online, IF(chat_group = 0, 
                                    IF(nguoi_tao = $nhanvienid,(SELECT hinh_anh FROM nhanvien WHERE nhanvien.id = nhan_vien),(SELECT hinh_anh FROM nhanvien WHERE nhanvien.id = nguoi_tao)), null) AS hinh_anh, 
                                    (SELECT tin_chua_doc FROM $dbchat.chatbox_read  WHERE $dbchat.chatbox_read.code = $dbchat.chatbox.code AND nhan_vien = $nhanvienid) AS chuadoc 
                                    FROM $dbchat.chatbox 
                                    WHERE (nguoi_tao = $nhanvienid OR FIND_IN_SET($nhanvienid, nhan_vien)) 
                                    ORDER BY create_at DESC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_content_chatbox($nhanvienid, $idenemy){
        $dbchat = DB_CHAT;
        $query = $this->db->query("SELECT * FROM $dbchat.chatbox WHERE (nguoi_tao = $nhanvienid OR nguoi_tao = $idenemy)  
                                    AND (nhan_vien = '$idenemy' OR nhan_vien = $nhanvienid) AND chat_group = 0");
        return $query->fetchAll();
    }

    function get_content_chatbox_via_code($code){
        $dbchat = DB_CHAT;
        $query = $this->db->query("SELECT * FROM $dbchat.chatbox WHERE code = '$code'");
        return $query->fetchAll();
    }

    function get_info_detail_nhanvien($id){
        $query = $this->db->query("SELECT * FROM nhanvien WHERE id = $id");
        return $query->fetchAll();
    }

    function get_chatbox_via_code($code){
        $dbchat = DB_CHAT;
        $query = $this->db->query("SELECT * FROM $dbchat.chatbox WHERE code = '$code'");
        return $query->fetchAll();
    }

    function addObj($data){
        $dbchat = DB_CHAT;
        $query = $this->insert("$dbchat.chatbox", $data);
        return $query;
    }

    function updateObj($code, $data){
        $dbchat = DB_CHAT;
        $query = $this->update("$dbchat.chatbox", $data, "code = '$code'");
        return $query;
    }

    function add_tin_chua_doc($data){
        $dbchat = DB_CHAT;
        $query = $this->insert("$dbchat.chatbox_read", $data);
        return $query;
    }

    function update_tin_chua_doc($code, $nhanvienid, $data){
        $dbchat = DB_CHAT;
        $query = $this->update("$dbchat.chatbox_read", $data, "code = '$code' AND nhan_vien = $nhanvienid");
        return $query;
    }

    function check_exit_into_read($code, $nhanvienid){
        $dbchat = DB_CHAT;
        $query = $this->db->query("SELECT * FROM $dbchat.chatbox_read WHERE code = '$code' AND nhan_vien = $nhanvienid");
        return $query->fetchAll();
    }

    function get_total_tin_nhan_chua_doc($nhanvienid){
        $dbchat = DB_CHAT;
        $query = $this->db->query("SELECT SUM(tin_chua_doc) AS Total FROM $dbchat.chatbox_read WHERE nhan_vien = $nhanvienid");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function get_data_combo(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS text FROM nhanvien");
        $result['items'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function get_info_detail($id){
        $query = $this->db->query("SELECT * FROM nhanvien WHERE id = $id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>