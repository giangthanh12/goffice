<?php
class Baocaochiphi_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj() {
        $where = " WHERE status > 0 AND type IN (2,3) ORDER BY id DESC ";
        $query = $this->db->query("SELECT id, type, content, note,
        FORMAT(asset,0) AS asset,
        DATE_FORMAT(dateTime,'%d/%m/%Y') AS dateTimeNew,
        IFNULL((SELECT name FROM classifyledger WHERE id = a.classify), 'Định khoản') AS classifyName,
        IFNULL((SELECT name FROM staffs WHERE id = a.staffId), 'Tên nhân viên') AS staffName,
        IFNULL((SELECT fullName FROM customer WHERE id = a.customerId), 'Tên khách hàng') AS customerName,
        IFNULL((SELECT name FROM contracts WHERE id = a.contractId), 'Tên hợp đồng')AS contractName
        FROM ledger a $where");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // function getChiphi() {
    //     $where = " WHERE status > 0 AND classify = 2 ORDER BY id DESC ";
    //     $query = $this->db->query("SELECT id,  asset, type, content, note,
    //     date(dateTime) AS dateTime,
    //     IFNULL((SELECT name FROM staffs WHERE id = a.staffId), 'Tên nhân viên') AS staffName,
    //     IFNULL((SELECT fullName FROM customer WHERE id = a.customerId), 'Tên khách hàng')  AS customerName,
    //     IFNULL((SELECT name FROM contracts WHERE id = a.contractId), 'Tên hợp đồng')AS contractName
    //     FROM ledger a $where");
    //     $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }
    
    function totalDoanhso() {
        $result = array();
        $year = date("Y");
        $query = $this->db->query("SELECT
            (FORMAT((SELECT SUM(asset) FROM ledger WHERE status > 0 AND type = 1 AND dateTime LIKE '%$year%' Limit 1) - 
                (SELECT SUM(asset) FROM ledger WHERE status > 0 AND type = 2 AND dateTime LIKE '%$year%' Limit 1),0)
            ) AS doanhThu FROM ledger WHERE status > 0 AND dateTime LIKE '%$year%' LIMIT 1 "); 
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function totalThucthu() {
        $result = array();
        $year = date("Y");
        $query = $this->db->query("SELECT FORMAT(SUM(asset),0) AS thucThu FROM ledger WHERE status > 0 AND dateTime LIKE '%$year%' AND type = 1 LIMIT 1");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function totalThucChi() {
        $result = array();
        $year = date("Y");
        $query = $this->db->query("SELECT FORMAT(SUM(asset),0) AS thucChi FROM ledger WHERE status > 0 AND dateTime LIKE '%$year%' AND type = 2 Limit 1");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    // function addObj($data)
    // {
    //     $query = $this->insert("ca",$data);
    //     return $query;
    // }

    // function getdata($id){
    //     $result = array();
    //     $query = $this->db->query("SELECT * FROM ca WHERE id = $id");
    //     $temp = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $result = $temp[0];
    //     return $result;
    // }

    // function updateObj($id, $data)
    // {
    //     $query = $this->update("ca",$data,"id = $id");
    //     return $query;
    // }

    // function delObj($id,$data)
    // {
    //     $query = $this->update("ca",$data,"id = $id");
    //     return $query;
    // }

    // function socai_namnay(){
    //     $year = date("Y");
    //     $query_socai = $this->db->query("SELECT so_tien,loai FROM socai WHERE tinh_trang > 0 AND ngay_gio LIKE '%$year%'");
    //     $result = $query_socai->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;

    // }
    // function donhang_namnay(){
    //     $year = date("Y");
    //     $query_donhang = $this->db->query("SELECT so_tien,tien_no FROM donhang WHERE tinh_trang > 0 AND ngay LIKE '%$year%'");
    //     $result = $query_donhang->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;

    // }

    // function getbieudo($year){
    //     $j = 0;
    //     for($i = 1; $i <= 12;$i++){
    //         if($i < 10){$i = '0'.$i;}
    //         $time = $year.'-'.$i;
    //         $query_socai = $this->db->query("SELECT SUM(IF(loai=0,so_tien,0)) AS thu,SUM(IF(loai=1,so_tien,0))*-1 AS chi FROM socai WHERE tinh_trang > 0 AND ngay_gio LIKE '%$time%'");
    //         $temp = $query_socai->fetchAll(PDO::FETCH_ASSOC);
    //         $data['thu'][$j] = round($temp[0]['thu']/1000000, 2);
    //         $data['chi'][$j] = round($temp[0]['chi']/1000000, 2);
    //         $j++;
    //     }
    //     return $data;

    // }


    // function socai_loc($time_s,$time_e){
    //     $query_socai = $this->db->query("SELECT asset,classify FROM ledger WHERE status > 0 AND dateTime BETWEEN '$time_s' AND '$time_e'");
    //     $result = $query_socai->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;

    // }
    // function donhang_loc($time_s,$time_e){
    //     $query_donhang = $this->db->query("SELECT  FROM donhang WHERE status > 0 AND ngay BETWEEN '$time_s' AND '$time_e'");
    //     $result = $query_donhang->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }


    // function listLoc($time_s,$time_e){
    //     $query = $this->db->query("SELECT * ,
    //     DATE_FORMAT(dateTime,'%d/%m/%Y') AS dateTimeNew,
    //     IFNULL((SELECT name FROM staffs WHERE id = a.staffId), 'Tên nhân viên') AS staffName,
    //     IFNULL((SELECT fullName FROM customer WHERE id = a.customerId), 'Tên khách hàng') AS customerName,
    //     IFNULL((SELECT name FROM contracts WHERE id = a.contractId), 'Tên hợp đồng')AS contractName
    //     FROM ledger a WHERE status > 0 AND dateTime BETWEEN '$time_s' AND '$time_e' order by dateTime desc");
    //     $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }

    
}
?>