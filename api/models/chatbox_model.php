<?php

class Chatbox_Model extends Model
{
    function __construst()
    {
        parent::__construst();
    }

    function get_list_all_nhanvien($nhanvienid, $listnv)
    {
        $result = array();
        $dieukien = " WHERE id != $nhanvienid AND tinh_trang IN (1,2,3,4) ";
        if ($listnv != '')
            $dieukien .= " AND id NOT IN ($listnv) ";
        $query = $this->db->query("SELECT id, name, hinh_anh, (SELECT token FROM users 
                                    WHERE users.nhan_vien = nhanvien.id ORDER BY id DESC LIMIT 1) AS online FROM nhanvien $dieukien
                                     ORDER BY name ASC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_list_chatbox($nhanvienid)
    {
        $result = array();
        $query = $this->db->query("SELECT id, name, receiver_id, create_at, type, sender_id,
                                    (SELECT message FROM subchat WHERE chat_box_id=chatbox.id AND status = 1 ORDER BY id DESC LIMIT 1) AS tin_nhan_cuoi,
                                    (SELECT datetime FROM subchat WHERE chat_box_id=chatbox.id AND status = 1 ORDER BY id DESC LIMIT 1) AS lastdate,
                                    IF(type = 0, IF(sender_id=$nhanvienid, (SELECT nhanvien.name FROM nhanvien 
                                    WHERE nhanvien.id = receiver_id), (SELECT nhanvien.name FROM nhanvien 
                                    WHERE nhanvien.id = sender_id)), name) AS group_name,
                                    IF(type = 0, (SELECT token FROM users WHERE users.nhan_vien = chatbox.receiver_id),
                                    null) AS online, IF(type = 0, 
                                    IF(sender_id = $nhanvienid,(SELECT hinh_anh FROM nhanvien WHERE nhanvien.id = receiver_id),(SELECT hinh_anh FROM nhanvien WHERE nhanvien.id = sender_id)), null) AS hinh_anh,
                                    IF(sender_id = $nhanvienid,(SELECT token FROM users WHERE users.nhan_vien = receiver_id ORDER BY id DESC LIMIT 1 ),(SELECT token FROM users WHERE users.nhan_vien = sender_id ORDER BY id DESC LIMIT 1)) AS online,
                                    IFNULL((SELECT total_unread FROM chat_unread  WHERE chat_unread.chat_box_id = chatbox.id AND chat_unread.receiver_id = $nhanvienid),0) AS chuadoc 
                                    FROM chatbox 
                                    WHERE (sender_id = $nhanvienid OR FIND_IN_SET($nhanvienid, receiver_id)) 
                                    ORDER BY lastdate DESC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_content_chatbox($chatboxid, $offset, $rows)
    {
        $query = $this->db->query("(SELECT *,
        unix_timestamp(datetime) as time,
        (SELECT hinh_anh FROM nhanvien WHERE id=sender_id) as hinhanh,
        (SELECT name FROM nhanvien WHERE id=sender_id) as name
        FROM subchat WHERE chat_box_id=$chatboxid AND status = 1 
        ORDER BY id DESC LIMIT $offset,$rows) ORDER BY id");
        return $query->fetchAll();
    }

    function get_content_chatbox_via_code($code)
    {

        $query = $this->db->query("SELECT * FROM chatbox WHERE code = '$code'");
        return $query->fetchAll();
    }

    function get_info_detail_nhanvien($id)
    {
        $query = $this->db->query("SELECT * FROM nhanvien WHERE id = $id");
        return $query->fetchAll();
    }

    function get_chatbox_via_code($code)
    {

        $query = $this->db->query("SELECT * FROM chatbox WHERE code = '$code'");
        return $query->fetchAll();
    }

    function addObj($data)
    {

        $query = $this->insert("chatbox", $data);
        if ($query)
            return $this->db->lastInsertId();
        else
            return 0;
    }

    function updateObj($id, $data)
    {

        $query = $this->update("chatbox", $data, "id = $id");
        return $query;
    }

    function addTinNhan($data)
    {
        $query = $this->insert("subchat", $data);
        if ($query)
            return $this->db->lastInsertId();
        else
            return 0;
    }

    function addUnread($data)
    {
        $query = $this->insert("chat_unread", $data);
        if ($query)
            return $this->db->lastInsertId();
        else
            return 0;
    }

    function checkUnread($chatboxid, $receiverid)
    {
        $result = array();
        $query = $this->db->query("SELECT COUNT(1) as total FROM chat_unread WHERE chat_box_id=$chatboxid AND receiver_id=$receiverid");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['total'];
    }

    function updateUnRead($chatboxid, $senderid)
    {
        return $this->db->query("UPDATE IGNORE chat_unread SET total_unread=total_unread+1 WHERE chat_box_id=$chatboxid AND receiver_id!=$senderid");
    }

    function update_tin_chua_doc($chatboxid, $receiverid, $data)
    {
        return $this->update("chat_unread", $data, "chat_box_id=$chatboxid AND receiver_id=$receiverid");
    }


    function get_data_combo()
    {
        $result = array();
        $query = $this->db->query("SELECT id, name AS text FROM nhanvien");
        $result['items'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_info_detail($id)
    {
        $query = $this->db->query("SELECT * FROM nhanvien WHERE id = $id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function getUnreadMessage($nhanvien)
    {
        $query = $this->db->query("SELECT chat_box_id,receiver_id,total_unread,
       (SELECT id FROM subchat WHERE subchat.chat_box_id=a.chat_box_id ORDER BY datetime DESC LIMIT 1) AS id,
        (SELECT message FROM subchat WHERE subchat.chat_box_id=a.chat_box_id ORDER BY datetime DESC LIMIT 1) AS message,
        (SELECT hinh_anh FROM nhanvien WHERE id=(SELECT sender_id FROM subchat 
        WHERE subchat.chat_box_id=a.chat_box_id ORDER BY datetime DESC LIMIT 1)) AS hinhanh
        FROM chat_unread a WHERE receiver_id = $nhanvien AND total_unread>0 ORDER BY id DESC LIMIT 1");
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($row[0]) {
            return $row[0];
        } else
            return [];

    }
    function getReceiverInfo($nhanvien){
        $query = $this->db->query("SELECT name,gioi_tinh,hinh_anh,email,dien_thoai,cmnd,
        DATE_FORMAT('%d/%m/%Y',ngay_sinh) AS ngaysinh,ghi_chu,
        (SELECT name FROM phongban WHERE id=(SELECT phong_ban FROM hopdongld WHERE nhan_vien=$nhanvien AND tinh_trang=1 ORDER BY ngay_di_lam DESC LIMIT 1)) AS phongban
        FROM nhanvien  WHERE id = $nhanvien ");
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($row[0]) {
            return $row[0];
        } else
            return [];
    }
}

?>