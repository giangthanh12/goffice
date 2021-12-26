<?php
class congviec_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function get_data($nhanvien){
        $query = $this->db->query("SELECT id, title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
            (SELECT count(1) FROM taskfiles WHERE taskId=a.id) AS attachments,
            (SELECT count(1) FROM commenttasks WHERE taskId=a.id) AS comments,
            label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
            (SELECT avatar FROM staffs WHERE id=assignerId) AS assigned,
            (SELECT name FROM staffs WHERE id=assignerId) AS members,
            (SELECT avatar FROM staffs WHERE id=assigneeId) AS hinhanh,
            (SELECT name FROM staffs WHERE id=assigneeId) AS nhanvien
            FROM tasks a WHERE status=1 AND assigneeId=$nhanvien ORDER BY id DESC ");
        $viecmoi = $query->fetchAll(PDO::FETCH_ASSOC);
        $query = $this->db->query("SELECT id, title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
            (SELECT count(1) FROM taskfiles WHERE taskId=a.id) AS attachments,
            (SELECT count(1) FROM commenttasks WHERE taskId=a.id) AS comments,
            label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
            (SELECT avatar FROM staffs WHERE id=assignerId) AS assigned,
            (SELECT name FROM staffs WHERE id=assignerId) AS members,
            (SELECT avatar FROM staffs WHERE id=assigneeId) AS hinhanh,
            (SELECT name FROM staffs WHERE id=assigneeId) AS nhanvien
            FROM tasks a WHERE status=2 AND assigneeId=$nhanvien ORDER BY id DESC ");
        $danglam = $query->fetchAll(PDO::FETCH_ASSOC);
        $query = $this->db->query("SELECT id, title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
            (SELECT count(1) FROM taskfiles WHERE taskId=a.id) AS attachments,
            (SELECT count(1) FROM commenttasks WHERE taskId=a.id) AS comments,
            label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
            (SELECT avatar FROM staffs WHERE id=assignerId) AS assigned,
            (SELECT name FROM staffs WHERE id=assignerId) AS members,
            (SELECT avatar FROM staffs WHERE id=assigneeId) AS hinhanh,
            (SELECT name FROM staffs WHERE id=assigneeId) AS nhanvien
            FROM tasks a WHERE status=3 AND assigneeId=$nhanvien ORDER BY id DESC ");
        $deadline = $query->fetchAll(PDO::FETCH_ASSOC);
        $query = $this->db->query("SELECT id, title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
            (SELECT count(1) FROM taskfiles WHERE taskId=a.id) AS attachments,
            (SELECT count(1) FROM commenttasks WHERE taskId=a.id) AS comments,
            label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
            (SELECT avatar FROM staffs WHERE id=assignerId) AS assigned,
            (SELECT name FROM staffs WHERE id=assignerId) AS members,
            (SELECT avatar FROM staffs WHERE id=assigneeId) AS hinhanh,
            (SELECT name FROM staffs WHERE id=assigneeId) AS nhanvien
            FROM tasks a WHERE status=4 AND assigneeId=$nhanvien ORDER BY id DESC ");
        $daxong = $query->fetchAll(PDO::FETCH_ASSOC);
        $query = $this->db->query("SELECT id, title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
            (SELECT count(1) FROM taskfiles WHERE taskId=a.id) AS attachments,
            (SELECT count(1) FROM commenttasks WHERE taskId=a.id) AS comments,
            label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
            (SELECT avatar FROM staffs WHERE id=assignerId) AS assigned,
            (SELECT name FROM staffs WHERE id=assignerId) AS members,
            (SELECT avatar FROM staffs WHERE id=assigneeId) AS hinhanh,
            (SELECT name FROM staffs WHERE id=assigneeId) AS nhanvien
            FROM tasks a WHERE status=6 AND assigneeId=$nhanvien ORDER BY id DESC ");
        $hoanthanh = $query->fetchAll(PDO::FETCH_ASSOC);
        $data = [
            array("id"=>"1","title"=>"Việc mới","item"=>$viecmoi),
            array("id"=>"2","title"=>"Đang làm","item"=>$danglam),
            array("id"=>"3","title"=>"Trễ deadline","item"=>$deadline),
            array("id"=>"4","title"=>"Đã xong","item"=>$daxong),
            array("id"=>"6","title"=>"Hoàn thành","item"=>$hoanthanh),
            // array("id"=>"60","title"=>"Thùng rác","item"=>array(0=>array('id'=>0, 'badge-text'=>'Xóa bỏ', 'badge'=>'danger')))
        ];
        return $data;
        // $query = $this->db->query("SELECT id, name AS title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
        //     (SELECT count(1) FROM congviecfiles WHERE congviec_id=a.id) AS attachments,
        //     (SELECT count(1) FROM congviecsub WHERE congviec_id=a.id) AS comments,
        //     label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
        //     (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS assigned,
        //     (SELECT name FROM nhanvien WHERE id=nhan_vien) AS members,
        //     (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
        //     (SELECT name FROM nhanvien WHERE id=nhan_vien) AS nhanvien
        //     FROM congviec a WHERE tinh_trang IN (1,2,4) AND nguoi_giao=$nhanvien AND nhan_vien!=$nhanvien ORDER BY id DESC ");
        // $dagiao = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_nhanvien($id){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text`
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
            $query = $this->db->query("SELECT dateTime, content,
               (SELECT avatar FROM staffs WHERE id=staffId) AS hinhanh,
               (SELECT name FROM staffs WHERE id=staffId) AS nhanvien
               FROM commenttasks WHERE taskId=$id ORDER BY dateTime DESC ");
            $comment = array();
            if ($query)
                $comment = $query->fetchAll(PDO::FETCH_ASSOC);
            $comtext = '';
            foreach ($comment AS $row)
                $comtext .= '<div class="media mb-1"><div class="avatar bg-light-success my-0 ml-0 mr-50"><img src="'.$row['hinhanh'].'" alt="Avatar" height="32" /></div><div class="media-body"><p class="mb-0"><span class="font-weight-bold">'.$row['nhanvien'].'</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small class="text-muted">'.$row['dateTime'].'</small></p><p>'.$row['content'].'</p></div></div>';
            $result = ['data'=>$data[0], 'comment'=>$comtext];
        }
        return $result;
    }

    function capnhat($id, $data, $file, $comment) {
        if ($id==0) {
            $data['status']=1;
            $data['assignmentDate']=date('Y-m-d');
            $data['updated']=date('Y-m-d');
            $data['assignerId']=$_SESSION['user']['staffId'];
            $query = $this->insert("tasks", $data);
            $id = $this->db->lastInsertId();
        }
        else
            $query = $this->update("tasks", $data, " id=$id ");
        if ($comment!='<br>') {
            $row = ['staffId'=>$_SESSION['user']['staffId'], 'taskId'=>$id, 'dateTime'=>date('Y-m-d H:i:s'),'content'=>$comment, 'status'=>1];
            $query = $this->insert("commenttasks", $row);
        }
        return $query;
    }

    function move($id, $data){
        $query = $this->update("tasks", $data, " id=$id ");
        return $query;
    }
    //
    // function get_info_detail_nhanvien($id){
    //     $query = $this->db->query("SELECT * FROM nhanvien WHERE id = $id");
    //     return $query->fetchAll();
    // }
    //
    // function get_chatbox_via_code($code){
    //     $query = $this->db->query("SELECT * FROM chatbox WHERE code = '$code'");
    //     return $query->fetchAll();
    // }
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
