<?php
class inbox_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function getList($start,$num_per_page,$type){
        $temp = array();
        $user = '"'.$_SESSION['user']['staffId'].'"';
        if ($type=='sent') {
            $dieukien = " WHERE status>0 AND senderId=$user";
            $query = $this->db->query("SELECT id,title,senderId, receiverId, dateTime, link,
                SUBSTRING(content,1,128) AS subContent, status,
                (SELECT name FROM staffs WHERE id=senderId) AS senderName,
                (SELECT avatar FROM staffs WHERE id=senderId) AS avatar
                FROM events $dieukien ORDER BY dateTime DESC LIMIT $start, $num_per_page ");
        } elseif ($type=='trash') {
            $dieukien = " WHERE status=0 AND (receiverId LIKE '%$user%' OR senderId=$user) ";
            $query = $this->db->query("SELECT id,title,senderId, receiverId, dateTime, link,
                SUBSTRING(content,1,128) AS subContent, status,
                (SELECT name FROM staffs WHERE id=senderId) AS senderName,
                (SELECT avatar FROM staffs WHERE id=senderId) AS avatar
                FROM events $dieukien ORDER BY dateTime DESC LIMIT $start, $num_per_page ");
        } else {
            $dieukien = " WHERE status>0 AND receiverId LIKE '%$user%' ";
            $query = $this->db->query("SELECT id,title,senderId, receiverId, dateTime, link,
                SUBSTRING(content,1,128) AS subContent, status,
                (SELECT name FROM staffs WHERE id=senderId) AS senderName,
                (SELECT avatar FROM staffs WHERE id=senderId) AS avatar
                FROM events $dieukien ORDER BY dateTime DESC LIMIT $start, $num_per_page ");
        }
        if ($query)
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        return $temp;
    }







    function getCount(){
        $return = array();
        $user = '"'.$_SESSION['user']['staffId'].'"';
        $dieukien = " WHERE status>0 AND receiverId LIKE '%$user%' ";
        $query = $this->db->query("SELECT COUNT(1) AS total FROM events $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $return['inbox'] = $temp[0]['total'];
        $dieukien = " WHERE status>0 AND senderId=$user ";
        $query = $this->db->query("SELECT COUNT(1) AS total FROM events $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $return['sent'] = $temp[0]['total'];

        $dieukien = " WHERE status in (1,2) AND receiverId LIKE '%$user%' ";
        $query = $this->db->query("SELECT COUNT(1) AS total FROM events $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $return['notseen'] = $temp[0]['total'];

        $dieukien = " WHERE status=0 AND (receiverId LIKE '%$user%' or senderId=$user) ";
        $query = $this->db->query("SELECT COUNT(1) AS total FROM events $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $return['trash'] = $temp[0]['total'];
        return $return;
    }
    function getAvatar($idStaff) {
        $avatar = '';
        $query = $this->db->query("SELECT avatar FROM staffs where status > 0 and status < 7 and id = $idStaff");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($temp[0]['avatar'])) 
        $avatar = $temp[0]['avatar'];
        return $avatar;
    }
    function deleteMsg($ids,$type){
        if($type == 'trash') {
            $query = $this->update("events", ['status'=>-1], " id IN ($ids) ");
        }
        else {
            $query = $this->update("events", ['status'=>0], " id IN ($ids) ");
        }
        return $query;
    }

    function loadMsg($id,$type){
        $result = array();
        $query = $this->db->query("SELECT *,
            (SELECT name FROM staffs WHERE id=senderId) AS senderName,
            (SELECT avatar FROM staffs WHERE id=senderId) AS avatar
            FROM events WHERE id=$id ");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if($type != 'trash') {
                $query = $this->update("events", ['status'=>3], " id=$id ");
            }
            
            $result = $temp[0];
        }
        return $result;
    }

    function getEmployee(){
        $result = array();
        $query = $this->db->query("SELECT id, name, avatar
              FROM staffs WHERE status IN (1,2,3,4) ORDER BY name ASC");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function add($data){  // gửi thông báo
        $query = $this->insert("events", $data);
        return $query;
    }

    function getAll(){
        $result = '';
        $query = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM staffs WHERE status>0 AND status<7");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = $temp[0]['ids'];
            // $temp = explode(',',$result);
            // $result = json_encode($temp);
        }
        return $result;
    }

    function getIdStaff() {
        $result = [];
        $query = $this->db->query("SELECT id FROM staffs WHERE status>0 AND status<7");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($temp as $item) {
                $result[] = $item['id'];
            }
        }
        
        return $result;
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








}
?>
