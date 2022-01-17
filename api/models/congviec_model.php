<?php
class congviec_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function get_data($nhanvien){
        $query = $this->db->query("SELECT id, name AS title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
            (SELECT count(1) FROM congviecfiles WHERE congviec_id=a.id) AS attachments,
            (SELECT count(1) FROM comment WHERE cong_viec=a.id) AS comments,
            label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
            (SELECT hinh_anh FROM nhanvien WHERE id=nguoi_giao) AS assigned,
            (SELECT name FROM nhanvien WHERE id=nguoi_giao) AS members,
            (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
            (SELECT name FROM nhanvien WHERE id=nhan_vien) AS nhanvien
            FROM congviec a WHERE tinh_trang=1 AND nhan_vien=$nhanvien ORDER BY id DESC ");
        $viecmoi = $query->fetchAll(PDO::FETCH_ASSOC);
        $query = $this->db->query("SELECT id, name AS title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
            (SELECT count(1) FROM congviecfiles WHERE congviec_id=a.id) AS attachments,
            (SELECT count(1) FROM comment WHERE cong_viec=a.id) AS comments,
            label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
            (SELECT hinh_anh FROM nhanvien WHERE id=nguoi_giao) AS assigned,
            (SELECT name FROM nhanvien WHERE id=nguoi_giao) AS members,
            (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
            (SELECT name FROM nhanvien WHERE id=nhan_vien) AS nhanvien
            FROM congviec a WHERE tinh_trang=2 AND nhan_vien=$nhanvien ORDER BY id DESC ");
        $danglam = $query->fetchAll(PDO::FETCH_ASSOC);
        $query = $this->db->query("SELECT id, name AS title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
            (SELECT count(1) FROM congviecfiles WHERE congviec_id=a.id) AS attachments,
            (SELECT count(1) FROM comment WHERE cong_viec=a.id) AS comments,
            label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
            (SELECT hinh_anh FROM nhanvien WHERE id=nguoi_giao) AS assigned,
            (SELECT name FROM nhanvien WHERE id=nguoi_giao) AS members,
            (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
            (SELECT name FROM nhanvien WHERE id=nhan_vien) AS nhanvien
            FROM congviec a WHERE tinh_trang=3 AND nhan_vien=$nhanvien ORDER BY id DESC ");
        $deadline = $query->fetchAll(PDO::FETCH_ASSOC);
        $query = $this->db->query("SELECT id, name AS title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
            (SELECT count(1) FROM congviecfiles WHERE congviec_id=a.id) AS attachments,
            (SELECT count(1) FROM comment WHERE cong_viec=a.id) AS comments,
            label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
            (SELECT hinh_anh FROM nhanvien WHERE id=nguoi_giao) AS assigned,
            (SELECT name FROM nhanvien WHERE id=nguoi_giao) AS members,
            (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
            (SELECT name FROM nhanvien WHERE id=nhan_vien) AS nhanvien
            FROM congviec a WHERE tinh_trang=4 AND nhan_vien=$nhanvien ORDER BY id DESC ");
        $daxong = $query->fetchAll(PDO::FETCH_ASSOC);
        $query = $this->db->query("SELECT id, name AS title, DATE_FORMAT(deadline, '%e %b, %Y') AS `due-date`,
            (SELECT count(1) FROM congviecfiles WHERE congviec_id=a.id) AS attachments,
            (SELECT count(1) FROM comment WHERE cong_viec=a.id) AS comments,
            label AS `badge-text`, IF(label='Now','danger',IF(label='Priority','warning',IF(label='Deadline','info','success'))) AS badge,
            (SELECT hinh_anh FROM nhanvien WHERE id=nguoi_giao) AS assigned,
            (SELECT name FROM nhanvien WHERE id=nguoi_giao) AS members,
            (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
            (SELECT name FROM nhanvien WHERE id=nhan_vien) AS nhanvien
            FROM congviec a WHERE tinh_trang=6 AND nhan_vien=$nhanvien ORDER BY id DESC ");
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
              FROM nhanvien WHERE tinh_trang IN (1,2,3,4) ORDER BY name ASC");
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
            (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS avatar
            FROM congviec WHERE id=$id");
        if ($query) {
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            $query = $this->db->query("SELECT ngay_gio, noi_dung,
               (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
               (SELECT name FROM nhanvien WHERE id=nhan_vien) AS nhanvien
               FROM comment WHERE cong_viec=$id ORDER BY ngay_gio DESC ");
            $comment = array();
            if ($query)
                $comment = $query->fetchAll(PDO::FETCH_ASSOC);
            $comtext = '';
            foreach ($comment AS $row)
                $comtext .= '<div class="media mb-1"><div class="avatar bg-light-success my-0 ml-0 mr-50"><img src="'.$row['hinhanh'].'" alt="Avatar" height="32" /></div><div class="media-body"><p class="mb-0"><span class="font-weight-bold">'.$row['nhanvien'].'</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small class="text-muted">'.$row['ngay_gio'].'</small></p><p>'.$row['noi_dung'].'</p></div></div>';
            $result = ['data'=>$data[0], 'comment'=>$comtext];
        }
        return $result;
    }

    function capnhat($id, $data, $file, $comment) {
        if ($id==0) {
            $data['tinh_trang']=1;
            $data['ngay_giao']=date('Y-m-d');
            $data['updated']=date('Y-m-d');
            $data['nguoi_giao']=$_SESSION['user']['nhan_vien'];
            $query = $this->insert("congviec", $data);
            $id = $this->db->lastInsertId();
        }
        else
            $query = $this->update("congviec", $data, " id=$id ");
        if ($comment!='<p></p>') {
            $row = ['nhan_vien'=>$_SESSION['user']['nhan_vien'], 'cong_viec'=>$id, 'ngay_gio'=>date('Y-m-d H:i:s'),'noi_dung'=>$comment, 'tinh_trang'=>1];
            $query = $this->insert("comment", $row);
        }
        return $query;
    }

    function move($id, $data){
        $query = $this->update("congviec", $data, " id=$id ");
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
        $data = array('tinh_trang'=>0);
        $query = $this->update("congviec", $data, " id=$id ");
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
