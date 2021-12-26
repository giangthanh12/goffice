<?php

class chatbox_model extends model
{
    function __construct()
    {
        parent::__construct();

    }

    function nhanvien()
    {
        $temp = array();
        $UserId = $_SESSION['user']['nhan_vien'];
        $listnv = $this->getListNV();
        $dieukienthem = "";
        if ($listnv != '')
            $dieukienthem = "AND id NOT IN ($listnv)";
        $query = $this->db->query("SELECT id, name, hinh_anh,
        (SELECT dien_thoai FROM lienhenv WHERE nhan_vien=id AND tinh_trang=1 LIMIT 1) as dien_thoai 
        FROM nhanvien WHERE tinh_trang IN (1,2,3,4) AND id!=$UserId $dieukienthem");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        // array_push($temp,array('id'=>0,'name'=>'Tất cả','dien_thoai'=>''));
        return $temp;
    }

    function listUsersChats($userReceiveId,$updateOnline)
    {
        $listnv = $this->getListNV();
        $UserId = $_SESSION['user']['nhan_vien'];
        $time = time();
        $this->db->query("UPDATE IGNORE nhanvien SET online=$time WHERE id=$UserId");
        $result = [];
        if($updateOnline!=1) {
            if ($listnv != '') {
                $query = $this->db->query("SELECT id, name, hinh_anh,online,
            (SELECT time FROM lastchat WHERE receiveType=1 AND receiverId IN (a.id,$UserId) 
            AND senderId IN (a.id,$UserId) ORDER BY time desc LIMIT 1) as lastHour,
            (SELECT dien_thoai FROM lienhenv WHERE nhan_vien=id AND tinh_trang=1 LIMIT 1) as dien_thoai 
            FROM nhanvien a WHERE tinh_trang IN (1,2,3,4) AND id IN ($listnv) ORDER BY lastHour DESC");
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
            }
            $time2 = time() - 3;
            foreach ($result as $key => $item) {
                $result[$key]['lastHour'] = date("h:i A", $item['lastHour']);
                $result[$key]['hinh_anh'] = ($item['hinh_anh'] != '') ? $item['hinh_anh'] : URL . '/template/images/default_avatar.png';
                $result[$key]['isactive'] = ($userReceiveId == $item['id']) ? 'class="active"' : '';
                $receiverId = $item['id'];
                $query = $this->db->query("SELECT message,totalUnread,senderId,receiverId FROM lastchat WHERE receiveType=1 AND receiverId IN ($receiverId,$UserId) 
            AND senderId IN ($receiverId,$UserId) ORDER BY time desc LIMIT 1");
                $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                if ($temp) {
                    $result[$key]['lastmessenger'] = $temp[0]['message'];
                    if ($temp[0]['senderId'] == $receiverId && $temp[0]['receiverId'] == $UserId)
                        $result[$key]['totalUnread'] = $temp[0]['totalUnread'];
                    else
                        $result[$key]['totalUnread'] = 0;
                } else {
                    $result[$key]['lastmessenger'] = '';
                    $result[$key]['totalUnread'] = 0;
                }
                if ($item['online'] > $time2)
                    $result[$key]['online'] = "online";
                else
                    $result[$key]['online'] = "offline";

            }
        }
        return $result;
    }

    function getListNV()
    {
        $temp = array();
        $UserId = $_SESSION['user']['nhan_vien'];
        $listSenderId = '';
        $query = $this->db->query("SELECT senderId FROM `lastchat` WHERE receiverId=$UserId AND tinh_trang>0 GROUP BY senderId ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($temp as $item) {
            $listSenderId .= $item['senderId'] . ",";
        }
        $listSenderId = rtrim($listSenderId, ",");
        $listReceiverId = "";
        $dieukienthem = "";
        if ($listSenderId != '')
            $dieukienthem = " AND receiverId NOT IN ($listSenderId) ";
        $query = $this->db->query("SELECT receiverId FROM `lastchat` WHERE senderId=$UserId $dieukienthem AND tinh_trang>0 GROUP BY receiverId ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($temp as $item) {
            $listReceiverId .= $item['receiverId'] . ",";
        }
        $listReceiverId = rtrim($listReceiverId, ",");
        $listnv = $listSenderId . "," . $listReceiverId;
        $listnv = rtrim($listnv, ",");
        $listnv = ltrim($listnv, ",");
        return $listnv;
    }

    function getUserInfo($id)
    {
        $temp = array();
        $query = $this->db->query("SELECT id, name, hinh_anh
        FROM nhanvien WHERE tinh_trang IN (1,2,3,4) AND id=$id ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        // array_push($temp,array('id'=>0,'name'=>'Tất cả','dien_thoai'=>''));
        if ($temp)
            return $temp[0];
        else
            return [];
    }

    function getMessengerNewest($newest, $userReceiveId)
    {
        $UserId = $_SESSION['user']['nhan_vien'];
        $this->db->query("UPDATE IGNORE lastchat SET totalUnread=0 WHERE receiveType=1 AND receiverId=$UserId AND senderId=$userReceiveId");
        if ($newest == 0) {
            $sql = "(SELECT *,(SELECT hinh_anh FROM nhanvien WHERE id=$UserId) as senderImg,
            (SELECT hinh_anh FROM nhanvien WHERE id=$userReceiveId) as receiverImg 
            FROM chat WHERE receiveType=1 AND ((receiverId=$userReceiveId AND senderId=$UserId) 
            OR (receiverId=$UserId AND senderId=$userReceiveId)) ORDER BY Id desc LIMIT 0,15) ORDER BY Id";
        } else {
            $sql = "(SELECT *,(SELECT hinh_anh FROM nhanvien WHERE id=$UserId) as senderImg,
            (SELECT hinh_anh FROM nhanvien WHERE id=$userReceiveId) as receiverImg
            FROM chat WHERE receiveType=1 AND ((receiverId=$userReceiveId AND senderId=$UserId)
            OR (receiverId=$UserId AND senderId=$userReceiveId)) AND Id > $newest  ORDER BY Id desc LIMIT 0,8) ORDER BY Id";
        }
        $query = $this->db->query($sql);
        $temp['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        $temp['sql'] = $sql;
        return $temp;
    }

    function getMessengerFirst($first, $userReceiveId)
    {
        $UserId = $_SESSION['user']['nhan_vien'];
        $sql = "(SELECT *,(SELECT hinh_anh FROM nhanvien WHERE id=$UserId) as senderImg,
            (SELECT hinh_anh FROM nhanvien WHERE id=$userReceiveId) as receiverImg 
            FROM chat WHERE Id < $first AND receiveType=1 AND ((receiverId=$userReceiveId AND senderId=$UserId)
            OR (receiverId=$UserId AND senderId=$userReceiveId)) ORDER BY Id desc LIMIT 0,8) ORDER BY Id";
        $query = $this->db->query($sql);
        $temp['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        $temp['sql'] = $sql;
        return $temp;
    }

    function addObj($data)
    {
        $ok = $this->insert("chat", $data);
        if ($ok) {
            $userReceiveId = $data['receiverId'];
            $userSendId = $_SESSION['user']['nhan_vien'];
            $sql = "SELECT Id,totalUnread FROM lastchat WHERE  receiveType=1 AND receiverId=$userReceiveId
            AND senderId=$userSendId";
            $query = $this->db->query($sql);
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($temp) {
                $id = $temp[0]['Id'];
                $data['totalUnread'] = $temp[0]['totalUnread'] + 1;
                $this->update("lastchat", $data, "id=$id");
            } else {
                $data['totalUnread'] = 1;
                $this->insert("lastchat", $data);
            }
        }
    }

//    function InsertBanGhi()
//    {
//        $sql = "INSERT INTO `chat` (`Id`, `receiveType`, `receiverId`, `senderId`, `name`, `message`, `time`, `ip`, `tinh_trang`) VALUES (NULL, '1', '6', '11', 'Nguyễn Thế Quỳnh', '123123', '1629899275', '::1', '2'), (NULL, '1', '11', '6', 'Phùng Quốc Thiệp', '3123123', '1629899298', '::1', '2'), (NULL, '1', '6', '11', 'Nguyễn Thế Quỳnh', '123123', '1629899382', '::1', '2'), (NULL, '1', '6', '11', 'Nguyễn Thế Quỳnh', '45435345', '1629899415', '::1', '2'), (NULL, '1', '6', '11', 'Nguyễn Thế Quỳnh', '5435435', '1629899438', '::1', '2'), (NULL, '1', '6', '11', 'Nguyễn Thế Quỳnh', '434534543986', '1629899449', '::1', '2'), (NULL, '1', '6', '11', 'Nguyễn Thế Quỳnh', '34324', '1629899554', '::1', '2'), (NULL, '1', '11', '6', 'Phùng Quốc Thiệp', '5345345', '1629899563', '::1', '2'), (NULL, '1', '11', '6', 'Phùng Quốc Thiệp', '6456546546', '1629899565', '::1', '2'), (NULL, '1', '11', '6', 'Phùng Quốc Thiệp', '', '1629899565', '::1', '2'), (NULL, '1', '11', '6', 'Phùng Quốc Thiệp', '6456546', '1629899567', '::1', '2'), (NULL, '1', '6', '11', 'Nguyễn Thế Quỳnh', '', '1629899581', '::1', '2'), (NULL, '1', '11', '6', 'Phùng Quốc Thiệp', '4343', '1629899619', '::1', '2'), (NULL, '1', '6', '11', 'Nguyễn Thế Quỳnh', '123123', '1629899696', '::1', '2'), (NULL, '1', '6', '11', 'Nguyễn Thế Quỳnh', '123123435', '1629899883', '::1', '2'), (NULL, '1', '11', '6', 'Phùng Quốc Thiệp', '4324324', '1629899941', '::1', '2'), (NULL, '1', '6', '11', 'Nguyễn Thế Quỳnh', '5435345345123123', '1629900017', '127.0.0.1', '2'), (NULL, '1', '6', '11', 'Nguyễn Thế Quỳnh', '534543543534567567tghdfjlghxfjlkfdg', '1629900069', '127.0.0.1', '2'), (NULL, '1', '6', '11', 'Nguyễn Thế Quỳnh', 'fndkjlghsvnlrhslrnhtv', '1629900393', '127.0.0.1', '2'), (NULL, '1', '11', '6', 'Phùng Quốc Thiệp', 'Nguyễn Thế Quỳnh nghe lệnh', '1629900428', '::1', '2'), (NULL, '1', '6', '11', 'Nguyễn Thế Quỳnh', 'Dạ em nghe rồi anh', '1629900446', '127.0.0.1', '2'), (NULL, '1', '11', '6', 'Phùng Quốc Thiệp', 'Hãy làm những gì bạn muốn', '1629900458', '::1', '2');";
//        $this->db->query($sql);
//    }
}

?>
