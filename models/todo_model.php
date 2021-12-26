<?php
class todo_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function get_data($nhanvien){
        $dieukien = " WHERE status>0 AND assigneeId=$nhanvien ";
        $query = $this->db->query("SELECT id, title, label, DATE_FORMAT(deadline, '%e %b, %Y') AS deadline, status,
            (SELECT avatar FROM staffs WHERE id=a.assignerId) AS avatar,
            (SELECT name FROM staffs WHERE id=a.assignerId) AS nguoigiao,
            (SELECT COUNT(1) FROM commenttasks WHERE taskId=a.id) AS comment
            FROM tasks a $dieukien ORDER BY id DESC ");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function get_nhanvien($id){
        $result = array();
        $query = $this->db->query("SELECT id, name, IF(avatar='','".HOME."/styles/default-avatar.jpg',avatar) AS hinh_anh,
              IF(id=$id,'true','false') AS selected
              FROM staffs WHERE status IN (1,2,3,4) ORDER BY name ASC");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($temp AS $key=>$val)
                if ($val['id']==$id)
                    $temp[$key]['selected']=true;
            $result = $temp;
        }
        return $result;
    }

    function getitem($id){
        $result = array();
        $query = $this->db->query("SELECT *,
            (SELECT avatar FROM staffs WHERE id=assigneeId) AS avatar
            FROM tasks WHERE id=$id");
        if ($query) {
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            // $query = $this->db->query("SELECT ngay_gio, noi_dung,
            //    (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
            //    (SELECT name FROM nhanvien WHERE id=nhan_vien) AS nhanvien
            //    FROM comment WHERE cong_viec=$id ORDER BY ngay_gio DESC ");
            // $comment = array();
            // if ($query)
            //     $comment = $query->fetchAll(PDO::FETCH_ASSOC);
            // $comtext = '';
            // foreach ($comment AS $row)
            //     $comtext .= '<div class="media mb-1"><div class="avatar bg-light-success my-0 ml-0 mr-50"><img src="'.$row['hinhanh'].'" alt="Avatar" height="32" /></div><div class="media-body"><p class="mb-0"><span class="font-weight-bold">'.$row['nhanvien'].'</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small class="text-muted">'.$row['ngay_gio'].'</small></p><p>'.$row['noi_dung'].'</p></div></div>';
            $result = $data[0];
        }
        return $result;
    }

    function capnhat($id, $data, $file, $comment,$deadline) {
        if ($id==0) {
            $data['status'] = 1;
            $data['assignmentDate'] = date('Y-m-d');
            $data['updated'] = date('Y-m-d');
            $data['assignerId'] = $_SESSION['user']['nhan_vien'];
            $data['description'] = $comment;
            $data['deadline'] = $deadline;
            $query = $this->insert("tasks", $data);
        }
        else {
            $query = $this->update("tasks", $data, " id=$id ");
            // if($comment!='') {
            //     $row = ['nhan_vien'=>$_SESSION['user']['nhan_vien'], 'cong_viec'=>$id, 'ngay_gio'=>date('Y-m-d H:i:s'),'noi_dung'=>$comment, 'tinh_trang'=>1];
            //     $query = $this->insert("comment", $row);
            // }
        }
        return $query;
    }

    function comment($id){
        $data = array();
        $query = $this->db->query("SELECT dateTime, content,
           (SELECT avatar FROM staffs WHERE id=staffId) AS hinhanh,
           (SELECT name FROM staffs WHERE id=staffId) AS nhanvien
           FROM commenttasks WHERE taskId=$id ORDER BY dateTime DESC ");
        if ($query)
           $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function addcomment($id,$comment){
        $commentor = $_SESSION['user']['staffId'];
        $receiver = [];
        $query = $this->db->query("SELECT assignerId, assigneeId FROM tasks WHERE id=$id  ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp[0]['assigneeId']!=$commentor)
            array_push($receiver,$temp[0]['assigneeId']);
        if ($temp[0]['assignerId']!=$commentor)
            array_push($receiver,$temp[0]['assignerId']);
        $sendto = json_encode($receiver);
        $ngaygio = date('Y-m-d H:i:s');
        $data = ['staffId'=>$commentor, 'taskId'=>$id, 'dateTime'=>$ngaygio, 'content'=>$comment,'sendTo'=>$sendto, 'status'=>1];
        $query = $this->insert("commenttasks", $data);
        $return = array('query'=>$query, 'receiver'=>$receiver);
        return $return;
    }

    function completed($id){
        $query = $this->db->query("UPDATE tasks SET status = IF(status=4,2,4) WHERE id = $id ");
        return $query;
    }
    //
    // function addObj($data){
    //     $query = $this->insert("chatbox", $data);
    //     return $query;
    // }
    //
    function delObj($id){
        $data = array('status'=>0);
        $query = $this->update("tasks", $data, " id=$id ");
        return $query;
    }

    function checkcomm(){ // dung cho notification
        $result = array();
        $nguoinhan = '"'.$_SESSION['user']['staffId'].'"';
        $query = $this->db->query("SELECT id,
            CONCAT((SELECT title FROM tasks WHERE id=taskId), SUBSTRING(content,1, 32)) AS tieu_de,
            (SELECT name FROM staffs WHERE id=staffId) AS nguoigui,
            (SELECT avatar FROM staffs WHERE id=staffId) AS hinhanh
            FROM commenttasks WHERE status=1 AND sendTo LIKE '%$nguoinhan%' ORDER BY dateTime DESC LIMIT 1 ");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = isset($temp[0])?$temp[0]:array();
        }
        return $result;
    }

    //
    // function add_tin_chua_doc($data){
    //     $query = $this->insert("chatbox_read", $data);
    //     return $query;
    // }
    //
    // function update_tin_chua_doc($code, $nhanvienid, $data){
    //     $query = $this->update("chatbox_read", $data, "code = '$code' AND nhan_vien = $nhanvienid");
    //     return $query;
    // }
    //
    // function check_exit_into_read($code, $nhanvienid){
    //     $query = $this->db->query("SELECT * FROM chatbox_read WHERE code = '$code' AND nhan_vien = $nhanvienid");
    //     return $query->fetchAll();
    // }
    //
    // function get_total_tin_nhan_chua_doc($nhanvienid){
    //     $query = $this->db->query("SELECT SUM(tin_chua_doc) AS Total FROM chatbox_read WHERE nhan_vien = $nhanvienid");
    //     $row = $query->fetchAll();
    //     return $row[0]['Total'];
    // }
}
?>
