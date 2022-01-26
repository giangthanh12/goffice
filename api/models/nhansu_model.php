<?php
class Nhansu_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getData()
    {
        $result = array();
        $query = $this->db->query("SELECT id,name,
            IFNULL((SELECT name FROM position WHERE id=(SELECT position FROM laborcontract WHERE staffId = a.id ORDER BY id DESC LIMIT 1)),'') AS position,
            IF(avatar='',CONCAT('" . HOME . "','/layouts/useravatar.png'),CONCAT('" . URLFILE . "/uploads/nhanvien/',avatar)) AS avatar,status
            FROM staffs a WHERE status IN (1,2,3,4,5) ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    function detailStaff($staffId) {
        $result = array();
        $query = $this->db->query("SELECT id, name, email, gender,birthDay,address,phoneNumber,
            IFNULL((SELECT name FROM position WHERE id=(SELECT position FROM laborcontract WHERE staffId=a.id ORDER BY id DESC LIMIT 1)),'') AS position,
            IFNULL((SELECT name FROM province WHERE id=a.province),'') AS provinceName,residence,idCard,idDate,
            IFNULL((SELECT name FROM province WHERE id=a.idAddress),'') AS idAddress,taxCode,
            IF(maritalStatus=1,'Đã kết hôn','Chưa kết hôn') AS maritalStatus,
            IFNULL((SELECT name FROM national WHERE id=a.nationalId),'') AS nationality,description,vssId,
            IF(avatar='',CONCAT('" . HOME . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/uploads/nhanvien/',avatar)) AS avatar,status
            FROM staffs a WHERE id=$staffId ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $key => $item) {
                $gender = $item['gender'];
                if($gender == 1) {
                    $result[$key]['gender'] = 'Nam';
                } else if ($gender == 2) {
                    $result[$key]['gender'] = 'Nữ';
                } else {
                    $result[$key]['gender'] = 'Khác';
                }
            }
            return $result;
        }else{
            return 0;
        }
    }

    function filterStaff($positionId) {
        $result = array();
        $dieukien = "";
        if ($positionId != '')
            $dieukien .= " WHERE (SELECT position FROM laborcontract WHERE staffId = a.id ORDER BY id DESC LIMIT 1) = $positionId ";
        $query = $this->db->query("SELECT id,name,
        IFNULL((SELECT name FROM position WHERE id=(SELECT position FROM laborcontract WHERE staffId = a.id ORDER BY id DESC LIMIT 1)),'') AS position,
        IF(avatar='',CONCAT('" . HOME . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/uploads/nhanvien/',avatar)) AS avatar,status
        FROM staffs a $dieukien ORDER BY id DESC ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    // function getnhanvien(){
    //     $nhanvien = array();
    //     $query = $this->db->query("SELECT id, name, email, dien_thoai, 'Hanoi' AS chinhanh, 'Kinh doanh' AS phongban, tinh_trang, hinh_anh
    //         FROM nhanvien WHERE tinh_trang IN (1,2,3,4) ORDER BY id DESC ");
    //     if ($query)
    //         $nhanvien['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $nhanvien;
    // }

    // function updateStaff()
    // {
    //     $result = array();
    //     $query = $this->db->query("SELECT id,avatar
    //         FROM staffs");
    //     if($query) {
    //         $result = $query->fetchAll(PDO::FETCH_ASSOC);
    //         foreach($result as $item) {
    //             $avatar = $item['avatar'];
    //             $str = str_replace( 'https://velo.vn/goffice/users/gemstech', '', $avatar );
    //             $id = $item['id'];
    //             // echo $str.'-'.$id.'</br>';
    //             $this->update("staffs", ['avatar' => $str], "id=$id");
    //         }
    //         return 1;
    //     } else {
    //         return 0;
    //     }
    // }

    function getProfile($staffid){
        $result = array();
        $query = $this->db->query("SELECT id, name, email, gender,IF(birthDay='0000-00-00','1970-01-01',birthDay) AS birthDay,address,phoneNumber,province,
            IFNULL((SELECT name FROM province WHERE id=province),'') AS provinceName,residence,idCard,IF(idDate='0000-00-00','1970-01-01',idDate) AS idDate,
            idAddress,taxCode,maritalStatus,IFNULL((SELECT name FROM national WHERE id=nationalId),'') AS nationality,description,vssId,
            IF(avatar='',CONCAT('" . HOME . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/uploads/nhanvien/',avatar)) AS avatar
            FROM staffs WHERE id=$staffid ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return 0;
        }
    }

    function updateProfile($id, $data){
        if($this->update("staffs", $data, "id=$id")) {
            return 1;
        } else {
            return 0;
        }
    }

    function checkEmail($id, $email)
    {
        $query = $this->db->query("SELECT COUNT(1) AS total
        FROM staffs WHERE id!=$id AND email LIKE '$email' AND status=1 ");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $total = $result[0]['total'];
            if($total == 0) 
                return 1;
            else 
                return 0;
        }
    }

    function checkId($id)
    {
        $query = $this->db->query("SELECT COUNT(1) AS total
        FROM staffs WHERE id=$id");
        if ($query) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $total = $result[0]['total'];
            if($total == 0) 
                return 0;
            else 
                return 1;
        }
    }

//     function getdata($id){
//         $result = array();
//         $query = $this->db->query("SELECT *,
//           IF(hinh_anh='','".URLFILE."/uploads/useravatar.png',hinh_anh) AS hinh_anh
//           FROM nhanvien WHERE id=$id");
//         $temp = $query->fetchAll(PDO::FETCH_ASSOC);
//         $result['nhanvien'] = $temp[0];
      
//         $query2 = $this->db->query("SELECT * FROM users WHERE nhan_vien = $id AND 1 ");
//         $temp = $query2->fetchAll(PDO::FETCH_ASSOC);
//         if(isset($temp[0]))
//             $result['account'] = $temp[0];
//         else
//             $result['account'] = 0;

//         $query3 = $this->db->query("SELECT * FROM nhanvien_info WHERE nhanvien_id = $id");
//         $temp = $query3->fetchAll(PDO::FETCH_ASSOC);
//         if(isset($temp[0]))
//             $result['nhanvien_info'] = $temp[0];
//         else
//             $result['nhanvien_info'] = 0;
        
//         return $result;
//     }


//     function updateinfo($data,$id){
//         $query = $this->update("nhanvien", $data, " id=$id ");
//         return $query;
//     }

//     function uploadAvatar($file,$id){
//         if ($file=='')
//             return false;
//         else {
//             $data = ['avatar'=>$file];
//             $query = $this->update("nhanvien", $data, " id=$id ");
//             return $query;
//         }
//     }

//     function them($data){
//         $query = $this->insert("nhanvien", $data);
//         return $query;
//     }

//     function xoa($id){
//         $query = $this->update("nhanvien", ['tinh_trang'=>0], " id=$id ");
//         return $query;
//     }

//     function thoiviec($id){
//         $query = $this->update("nhanvien", ['tinh_trang'=>6], " id=$id ");
//         return $query;
//     }

//     function thanhpho(){
//         $result = array();
//         $query = $this->db->query("SELECT id, name AS `text` FROM thanhpho WHERE tinh_trang=1");
//         if ($query)
//             $result = $query->fetchAll(PDO::FETCH_ASSOC);
//         return $result;
//     }

// /*== Get account by ID nhan_vien ===== */
//     function getAccountbyId($id){
//         $result = array();
//         $query = $this->db->query("SELECT * FROM users WHERE nhan_vien = $id");
//         if ($query)
//             $result = $query->fetchAll(PDO::FETCH_ASSOC);
//         return $result;
//     }

//     function check_email($email){
//         $result = array();
//         $query = $this->db->query("SELECT id FROM users WHERE email = '$email'");
//         $temp = $query->fetchAll(PDO::FETCH_ASSOC);
//         if(isset($temp[0]))
//         $result = $temp[0];
//         else
//             $result = 0;
//         return $result;
//     }
//     function check_email_edit($id,$email){
//         $result = array();
//         $get_user = $this->db->query("SELECT email FROM users WHERE id = $id");
//         $fetch = $get_user->fetchAll(PDO::FETCH_ASSOC);
//         $email_old = $fetch[0]['email'];
//         $query = $this->db->query("SELECT id FROM users WHERE email = '$email' AND email <> '$email_old'");
//         $temp = $query->fetchAll(PDO::FETCH_ASSOC);
//         if(isset($temp[0]))
//         $result = $temp[0];
//         else
//             $result = 0;
//         return $result;
//     }

//     function them_users($data){
//         $query = $this->insert("users", $data);
//         return $query;
//     }
//     function update_users($data,$id){
//         $query = $this->update("users", $data, " id=$id ");
//         return $query;
//     }

//  /** Social  nhanvien_info*/       
//     function getNhanvienInfoId($id){
//         $result = array();
//         $query = $this->db->query("SELECT * FROM nhanvien_info WHERE nhanvien_id = $id");
//         if ($query)
//             $result = $query->fetchAll(PDO::FETCH_ASSOC);
//         return $result;
//     }
//     function them_nhanvien_info($data){
//         $query = $this->insert("nhanvien_info", $data);
//         return $query;
//     }
//     function update_nhanvien_info($data,$id){
//         $query = $this->update("nhanvien_info", $data, " nhanvien_id=$id ");
//         return $query;
//     }

}
