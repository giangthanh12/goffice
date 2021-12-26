<?php
class Baocaodoanhthu_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $year = date("Y"); 

        $query = $this->db->query("SELECT * ,DATE_FORMAT(ngay_gio,'%d/%m/%Y %h:%i %p') AS ngay_gio ,
        FORMAT(so_tien,0) AS so_tien,FORMAT(so_du,0) AS so_du,
        IFNULL((SELECT name FROM nhanvien WHERE id = socai.nhan_vien AND tinh_trang > 0), 'No Name') AS nhan_vien ,
        IFNULL((SELECT name FROM taikhoan WHERE id = socai.tai_khoan AND tinh_trang > 0), '-') AS tai_khoan 
        FROM socai WHERE  tinh_trang > 0 AND ngay_gio LIKE '%$year%' order by ngay_gio desc");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }



    function addObj($data)
    {
        $query = $this->insert("ca",$data);
        return $query;
    }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM ca WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("ca",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("ca",$data,"id = $id");
        return $query;
    }

    function socai_namnay(){
        $year = date("Y");
        $query_socai = $this->db->query("SELECT so_tien,loai FROM socai WHERE tinh_trang > 0 AND ngay_gio LIKE '%$year%'");
        $result = $query_socai->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    function donhang_namnay(){
        $year = date("Y");
        $query_donhang = $this->db->query("SELECT so_tien,tien_no FROM donhang WHERE tinh_trang > 0 AND ngay LIKE '%$year%'");
        $result = $query_donhang->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    function getbieudo($year){
        $j = 0;
        for($i = 1; $i <= 12;$i++){
            if($i < 10){$i = '0'.$i;}
            $time = $year.'-'.$i;
            $query_socai = $this->db->query("SELECT SUM(IF(loai=0,so_tien,0)) AS thu,SUM(IF(loai=1,so_tien,0))*-1 AS chi FROM socai WHERE tinh_trang > 0 AND ngay_gio LIKE '%$time%'");
            $temp = $query_socai->fetchAll(PDO::FETCH_ASSOC);
            $data['thu'][$j] = round($temp[0]['thu']/1000000, 2);
            $data['chi'][$j] = round($temp[0]['chi']/1000000, 2);
            $j++;
        }
        return $data;

    }


    function socai_loc($time_s,$time_e){
        $query_socai = $this->db->query("SELECT so_tien,loai FROM socai WHERE tinh_trang > 0 AND ngay_gio BETWEEN '$time_s' AND '$time_e'");
        $result = $query_socai->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    function donhang_loc($time_s,$time_e){
        $query_donhang = $this->db->query("SELECT so_tien,tien_no FROM donhang WHERE tinh_trang > 0 AND ngay BETWEEN '$time_s' AND '$time_e'");
        $result = $query_donhang->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }


    function listLoc($time_s,$time_e){
        $query = $this->db->query("SELECT * ,DATE_FORMAT(ngay_gio,'%d/%m/%Y %h:%i %p') AS ngay_gio ,
        FORMAT(so_tien,0) AS so_tien,FORMAT(so_du,0) AS so_du,
        IFNULL((SELECT name FROM nhanvien WHERE id = socai.nhan_vien AND tinh_trang > 0), 'No Name') AS nhan_vien ,
        IFNULL((SELECT name FROM taikhoan WHERE id = socai.tai_khoan AND tinh_trang > 0), '-') AS tai_khoan 
        FROM socai WHERE  tinh_trang > 0 AND ngay_gio BETWEEN '$time_s' AND '$time_e' order by ngay_gio desc");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    
}
?>