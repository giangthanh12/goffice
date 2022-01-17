<?php
class System_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function check_in($username, $password){
        $query = $this->db->query("SELECT id, email, nhan_vien, nhom,token,
          (SELECT name FROM nhanvien WHERE id=nhan_vien) AS hoten,
          (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
        (SELECT ip FROM chinhanh WHERE chinhanh.id=(SELECT chi_nhanh FROM hopdongld
        WHERE hopdongld.nhan_vien=users.nhan_vien LIMIT 1)) AS ip
          FROM users WHERE tinh_trang=1 AND name = '$username' AND mat_khau = '$password'");
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($row[0]))
            return $row[0];
        else
            return [];
    }

    function check_in_token($token){
        $query = $this->db->query("SELECT id, email, nhan_vien, nhom,token,
          (SELECT name FROM nhanvien WHERE id=nhan_vien) AS hoten,
          (SELECT hinh_anh FROM nhanvien WHERE id=nhan_vien) AS hinhanh,
        (SELECT ip FROM chinhanh WHERE chinhanh.id=(SELECT chi_nhanh FROM hopdongld
        WHERE hopdongld.nhan_vien=users.nhan_vien LIMIT 1)) AS ip
          FROM users WHERE tinh_trang=1 AND token='$token'");
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($row[0]))
            return $row[0];
        else
            return [];
    }

    function update_token($username, $password, $token){
        $query = $this->update("users", ['token'=>$token], "name = '$username' AND mat_khau = '$password' ");
        return $query;
    }

    function update_deadline(){
        $today = date('Y-m-d',strtotime('+ 2 day'));
        $query = $this->update("congviec", ['tinh_trang'=>3,'label'=>'Deadline'], " tinh_trang IN (1,2) AND deadline<'$today' ");
        return $query;
    }

    function logout($token){
        $id = $_SESSION['user']['id'];
        if($token!='') {
            $query = $this->update("users", ['token' => ''], "id = $id ");
            return $query;
        }
        return true;
    }
}
?>
