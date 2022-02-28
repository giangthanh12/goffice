<?php
class applicant_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getProvince(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM province WHERE status=1");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function listObj($filter){
    $orderBy = $filter == 1 ? ' ORDER BY id DESC ' : ' ORDER BY fullName ASC ';
        $ungvien = array();
        $query = $this->db->query("SELECT *,
            IF(image='','".URLFILE."/uploads/useravatar.png',image) AS image,
            DATE_FORMAT(dob,'%d-%m-%Y') as dob
            FROM applicants WHERE status = 1 $orderBy");
        if ($query)
            $ungvien['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $ungvien;
    }
    function exportexcel() {
        
    }

    function getRecruitmentCamp($id) {
        $query = $this->db->query("SELECT campId FROM sortlist WHERE status = 1 AND canId = $id");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $campId = [];
        if(!empty($result)) {
            foreach($result as $item) {
                $campId[] = $item['campId'];
            }
            $campId = implode(',',$campId);
            $where = " AND id NOT IN ($campId) ";
        }
        else {
            $where = "";
        }
        $result = array();
        $query = $this->db->query("SELECT id, title AS `text` FROM recruitmentcamp WHERE status = 1 $where ");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function addSortlist($data) {
        $query = $this->insert("sortlist", $data);
        return $query;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT *,
            IF(image='','".URLFILE."/uploads/useravatar.png',image) AS image,
             DATE_FORMAT(dob,'%d-%m-%Y') as dob,
             DATE_FORMAT(idDate,'%d-%m-%Y') as idDate
            FROM applicants WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($data,$id){
        $query = $this->update("applicants", $data, " id=$id ");
        return $query;
    }

    function thayanh($file,$id){
        if ($file=='')
            return false;
        else {
            $data = ['image'=>$file];
            $query = $this->update("applicants", $data, " id=$id ");
            return $query;
        }
    }

    function addObj($data){
        $query = $this->insert("applicants", $data);
        return $query;
    }

    function delObj($id){
        $query = $this->update("applicants", ['status'=>0], " id=$id ");
        return $query;
    }

    // Thông tin gia đình
    function getMembers($id)
    {
        $result = array();
        $query = $this->db->query("SELECT *
            FROM thongtinuv WHERE ung_vien = $id AND tinh_trang = 1");
        if ($query)
            $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getMember($id){
        $result = array();
        $query = $this->db->query("SELECT *
            FROM thongtinuv WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function addMember($data){
        $query = $this->insert("thongtinuv", $data);
        return $query;
    }

    function updateMember($data,$id){
        $query = $this->update("thongtinuv", $data, "id=$id");
        return $query;
    }

    function delMember($id){
        $query = $this->update("thongtinuv", ['tinh_trang'=>0], " id=$id ");
        return $query;
    }

    // Thông tin học vấn
    function getListHV($id)
    {
        $result = array();
        $query = $this->db->query("SELECT *,
            DATE_FORMAT(ngay_bat_dau,'%d-%m-%Y') as ngay_bat_dau,
            DATE_FORMAT(ngay_ket_thuc,'%d-%m-%Y') as ngay_ket_thuc
            FROM hocvanuv WHERE ung_vien = $id AND tinh_trang = 1");
        if ($query)
            $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getHV($id){
        $result = array();
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(ngay_bat_dau,'%d-%m-%Y') as ngay_bat_dau,
        DATE_FORMAT(ngay_ket_thuc,'%d-%m-%Y') as ngay_ket_thuc
        FROM hocvanuv WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function addHV($data){
        $query = $this->insert("hocvanuv", $data);
        return $query;
    }

    function updateHV($data,$id){
        $query = $this->update("hocvanuv", $data, "id=$id");
        return $query;
    }

    function delHV($id){
        $query = $this->update("hocvanuv", ['tinh_trang'=>0], " id=$id ");
        return $query;
    }

    // Thông tin kinh nghiệm
    function getListKN($id)
    {
        $result = array();
        $query = $this->db->query("SELECT *,
            DATE_FORMAT(ngay_bat_dau,'%d-%m-%Y') as ngay_bat_dau,
            DATE_FORMAT(ngay_ket_thuc,'%d-%m-%Y') as ngay_ket_thuc
            FROM kinhnghiemuv WHERE ung_vien = $id AND tinh_trang = 1");
        if ($query)
            $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getKN($id){
        $result = array();
        $query = $this->db->query("SELECT *,
            DATE_FORMAT(ngay_bat_dau, '%d-%m-%Y') as ngay_bat_dau,
            DATE_FORMAT(ngay_ket_thuc, '%d-%m-%Y') as ngay_ket_thuc
            FROM kinhnghiemuv WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function addKN($data){
        $query = $this->insert("kinhnghiemuv", $data);
        return $query;
    }

    function updateKN($data,$id){
        $query = $this->update("kinhnghiemuv", $data, "id=$id");
        return $query;
    }

    function delKN($id){
        $query = $this->update("kinhnghiemuv", ['tinh_trang'=>0], " id=$id ");
        return $query;
    }

    function checkPhone($idApplicant, $phone) {
        if($idApplicant == 0) {
            $query = $this->db->query("SELECT COUNT(id) AS total FROM applicants WHERE phoneNumber=$phone AND status > 0  ");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($temp[0]['total'] > 0) {
                return false;
            } else {
                return true;
            }
        }
        else {
            $query = $this->db->query("SELECT phoneNumber FROM applicants WHERE status > 0 AND id = $idApplicant ");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if($temp[0]['phoneNumber'] == $phone) {
              return true;
            }
            else {
                $query = $this->db->query("SELECT COUNT(id) AS total FROM applicants WHERE phoneNumber=$phone AND status > 0");
                $temp = $query->fetchAll(PDO::FETCH_ASSOC);
             
                if ($temp[0]['total'] > 0) {
                    return false;
                } else {
                    return true;
                }
            }
          
        }
    }
}
?>
