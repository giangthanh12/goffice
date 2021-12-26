<?php
class inbox_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function getdata($type){
        $temp = array();
        $user = $_SESSION['user']['staffId'];
        if ($type=='sent')
            $dieukien = " WHERE status>0 AND senderId=$user GROUP BY title ";
        elseif ($type=='trash')
            $dieukien = " WHERE status=0 GROUP BY title ";
        else
            $dieukien = " WHERE status>0 AND receiverId LIKE '%$user%' ";
        $query = $this->db->query("SELECT id,title,senderId, receiverId, dateTime, link, SUBSTRING(content,1,128) AS subContent, status,
            (SELECT name FROM staffs WHERE id=senderId) AS senderName,
            IFNULL((SELECT avatar FROM staffs WHERE id=senderId),'xxx') AS avatar
            FROM events $dieukien ORDER BY dateTime DESC ");
        if ($query)
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        return $temp;
    }

    function unread(){ // dung cho notification
        $result = 0;
        $nguoinhan = $_SESSION['user']['staffId'];
        $query = $this->db->query("SELECT COUNT(1) AS total FROM events WHERE status IN (1,2) AND receiverId=$nguoinhan ");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = isset($temp[0])?$temp[0]['total']:0;
        }
        return $result;
    }

    function getsentitem(){
        $temp = array();
        $senderName = $_SESSION['user']['staffId'];
        $data = '<ul class="email-media-list">';
        $query = $this->db->query("SELECT id,title,senderId, receiverId, date, link, SUBSTRING(content,1,128) AS subContent, status,
            (SELECT name FROM staffs WHERE id=senderId) AS senderName,
            IFNULL((SELECT avatar FROM staffs WHERE id=senderId),'xxx') AS avatar
            FROM events WHERE status>0 AND senderId=$senderName GROUP BY title ORDER BY date DESC ");
        if ($query)
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        return $temp;
    }

    function checkmail(){ // dung cho notification
        $result = array();
        $nguoinhan = '"'.$_SESSION['user']['staffId'].'"';
        $dieukien = " WHERE status=1 AND receiverId LIKE '%$nguoinhan%' ";

        $query = $this->db->query("SELECT id, title, content, date, link,
            (SELECT name FROM staffs WHERE id=senderId) AS senderName,
            (SELECT avatar FROM staffs WHERE id=senderId) AS avatar
            FROM events $dieukien ORDER BY date DESC LIMIT 1 ");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = isset($temp[0])?$temp[0]:array();
        }
        return $result;
    }

    function markunread($ids) {
        $query = $this->update("events", ['status'=>2], " id IN ($ids) ");
        return $query;
    }

    function add($data){
        $receiver = '';
        $data['senderId'] = $_SESSION['user']['staffId'];
        $data['date'] = date('Y-m-d H:i:s');
        $data['link'] = 'inbox';
        $nguoinhan = json_decode($data['receiverId']);
        if (in_array(0, $nguoinhan)) {
            $query = $this->db->query("SELECT id FROM staffs WHERE status IN (1,2,3,4) ");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($temp AS $item)
                if ($receiver=='')
                    $receiver = $item['id'];
                else
                    $receiver .= ','.$item['id'];
        } else {
            $receiver = str_replace('[','',str_replace(']','',str_replace('"','',$data['receiverId'])));
        }
        $query = $this->insert("events", $data);
        if ($query)
            return $receiver;
        else
            return '';
    }

    function xoa($ids){
        $query = $this->update("events", ['status'=>0], " id IN ($ids) ");
        return $query;
    }


    function get_detail($id){
        $result = array();
        $query = $this->db->query("SELECT *,
            (SELECT name FROM staffs WHERE id=senderId) AS senderName,
            IFNULL((SELECT avatar FROM staffs WHERE id=senderId),'xxx') AS avatar
            FROM events WHERE id=$id ");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $query = $this->update("events", ['status'=>3], " id=$id ");
            $result = $temp[0];
        }
        return $result;
    }

    function nhanvien(){
        $result = array();
        $query = $this->db->query("SELECT id, name, avatar FROM staffs WHERE status>0 AND status<7");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>
