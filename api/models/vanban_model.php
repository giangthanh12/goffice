<?php
class Vanban_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFolders($id,$search){
        $result = array();
        $dieukien = " WHERE tinh_trang = 1 ";
        if($search != ''){
            $dieukien .= " AND name LIKE '%$search%' ";
        }
        $query = $this->db->query("SELECT id, name, folder, 
            IF(create_date!='',DATE_FORMAT(create_date,'%d/%m/%Y'),'') as create_date  
            FROM folders $dieukien AND parentid = $id
                                    ORDER BY thu_tu ASC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getFiles($id,$search){
        $result = array();
         $dieukien = " WHERE tinh_trang = 1 ";
        if($search != ''){
            $dieukien .= " AND filename LIKE '%$search%' ";
        }
        $query = $this->db->query("SELECT id,filename,link,size,folder,
            IF(ngay!='',DATE_FORMAT(ngay,'%d/%m/%Y'),'') as ngay,
            (SELECT name FROM nhanvien WHERE id = a.nhan_vien) as nhanvien
            FROM vanban a $dieukien AND folder = $id ORDER BY ngay DESC");

        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getFolder($id){
        $result = array();
        $query = $this->db->query("SELECT name,folder,parentid FROM folders WHERE tinh_trang=1 AND id=$id ");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getFile($id){
        $result = array();
        $query = $this->db->query("SELECT id,filename,link,size,folder,
            IF(ngay!='',DATE_FORMAT(ngay,'%d/%m/%Y'),'') as ngay,
            (SELECT name FROM nhanvien WHERE id = a.nhan_vien) as nhanvien
            FROM vanban a WHERE tinh_trang = 1 AND id = $id");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT name
                FROM folders WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function addFolder($data)
    {
        $this->insert("folders", $data);
        $fid = $this->db->lastInsertId();
        $uid = $_SESSION['user']['id'];
        $qr = $this->db->query("SELECT thu_muc FROM users WHERE id=$uid ");
        $row = $qr->fetchAll(PDO::FETCH_ASSOC);
        $thumuc = $row[0]['thu_muc'];
        if($thumuc=='')
            $thumuc=$fid;
        else
            $thumuc.=','.$fid;
        $data = array('thu_muc'=>$thumuc);
        $this->update("user", $data, "id = $uid");
        return $fid;
    }

    function addObj($data){
        $query = $this->insert("vanban", $data);
        return $query;
    }

    function updateFolder($id, $data)
    {
        $query = $this->update("folders",$data,"id = $id");
        return $query;
    }

    function updateFile($id, $data)
    {
        $query = $this->update("vanban",$data,"id = $id");
        return $query;
    }

    function uploadFile($data)
    {
        $query = $this->insert("vanban", $data);
        return $query;
    }

    function getFolderParent($id)
    {
        $result = array();
        $query = $this->db->query("SELECT * FROM folders WHERE tinh_trang > 0 AND id = $id ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp) {
            $id = $temp[0]['parentid'];
            $result[0] = $temp[0];
            $i=1;
            while ($id > 0) {
                $query = $this->db->query("SELECT * FROM folders WHERE tinh_trang>0 AND id = $id");
                $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                $id = $temp[0]['parentid'];
                $result[$i] = $temp[0];
                $i++;
            }
        }
        return $result;
    }
}
?>