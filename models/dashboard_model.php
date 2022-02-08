<?php
class dashboard_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getdata(){
        $data = array();
        $nguoinhan = $_SESSION['user']['nhan_vien'];
        $query = $this->db->query("SELECT tieu_de,
            (SELECT name FROM nhanvien WHERE id=nguoi_gui) AS nguoigui
            FROM events WHERE tinh_trang IN (1,2) AND nguoi_nhan=$nguoinhan ORDER BY ngay_gio DESC LIMIT 1 ");
        if ($query) {
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $data['thongbao'] = isset($temp[0])?$temp[0]:array();
            $query = $this->db->query("SELECT COUNT(1) AS total
                FROM events WHERE tinh_trang IN (1,2) AND nguoi_nhan=$nguoinhan ");
            if ($query) {
                $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                $data['tinmoi'] = $temp[0]['total'];
            } else {
                $data['tinmoi'] = 0;
            }
        }
        return $data;
    }

    function activeuser(){
        $id = $_SESSION['user']['id'];
        $query = $this->db->query("UPDATE users SET active=1 WHERE id=$id ");
        return $query;
    }

    function getactive($users){
        $result = array();
        $currentId = $_SESSION['user']['staffId'];
        $query = $this->db->query("SELECT id,name,avatar FROM staffs WHERE id IN ($users) AND id!=$currentId");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function deactiveuser(){
        $id = $_SESSION['user']['id'];
        $query = $this->db->query("UPDATE users SET active=0 WHERE id=$id ");
        return $query;
    }

    function thayanh($file,$id){
        if ($file=='')
            return false;
        else {
            $data = ['hinh_anh'=>$file];
            $query = $this->update("nhanvien", $data, " id=$id ");
            return $query;
        }
    }

    function them($data){
        $query = $this->insert("nhanvien", $data);
        return $query;
    }

    function xoa($id){
        $query = $this->update("nhanvien", ['tinh_trang'=>0], " id=$id ");
        return $query;
    }

    function thoiviec($id){
        $query = $this->update("nhanvien", ['tinh_trang'=>6], " id=$id ");
        return $query;
    }

    function reportProfitLoss()
    {
        $year = date('Y');
        $result = array();
        $arrProfit = [];
        $arrLoss = [];
        for($month = 1; $month <= 12; $month++) {
            if($month < 10) 
                $month = '0'.$month;
            $yearMonth = $year.'-'.$month;
            $where = " WHERE status = 1 AND dateTime LIKE '$yearMonth%' ";
            $query = $this->db->query("SELECT IFNULL(SUM(asset),0) AS profit
            FROM ledger $where AND type = 1");
            $profit = $query->fetchAll(PDO::FETCH_ASSOC);
            array_push($arrProfit, ROUND($profit[0]['profit']/1000000,2));
            $query = $this->db->query("SELECT IFNULL(SUM(asset),0) AS loss
            FROM ledger $where AND type = 2");
            $loss = $query->fetchAll(PDO::FETCH_ASSOC);
            array_push($arrLoss, ROUND($loss[0]['loss']/1000000,2));
        }
        $result['arrProfit'] = $arrProfit;
        $result['arrLoss'] = $arrLoss;
        return $result;
    }

    function reportCashFlow()
    {
        $year = date('Y');
        $result = array();
        $arrExpectedProfit = [];
        $arrExpectedLoss = [0,0,0,0,0,0,0,0,0,0,0,0];
        for($month = 1; $month <= 12; $month++) {
            if($month < 10) 
                $month = '0'.$month;
            $yearMonth = $year.'-'.$month;
            $where = " WHERE status = 1 AND signatureDate LIKE '$yearMonth%' ";
            $query = $this->db->query("SELECT quantity,discount,vat,
            (SELECT price FROM products WHERE id=a.productId) AS productPrice,
            (SELECT vat FROM products WHERE id=a.productId) AS productVAT
            FROM contracts a $where");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if(count($temp)>0) {
                $expectedProfit = 0;
                foreach($temp as $item) {
                    if($item['productVAT']>0)
                        $productVAT = $item['productVAT']/100;
                    else 
                        $productVAT = 1;
                    if($item['vat']>0)
                        $contractVAT = $item['vat']/100;
                    else 
                        $contractVAT = 1;
                    $expectedProfit += (($item['productPrice']*$item['quantity'])*$productVAT - $item['discount'])*$contractVAT;
                }
                array_push($arrExpectedProfit, ROUND($expectedProfit/1000000,2));
            } else {
                array_push($arrExpectedProfit, 0);
            }
        }
        $result['arrExpectedProfit'] = $arrExpectedProfit;
        $result['arrExpectedLoss'] = $arrExpectedLoss;
        return $result;
    }

    function reportCustomer()
    {
        $month = date('m');
        $year = date('Y');
        $result = array();
        $arrNewCustomer = [];
        $arrMonth = [];
        $now = $year.'-'.$month;
        $where = " WHERE status = 1 AND createDate LIKE '$now%' ";
        $query = $this->db->query("SELECT COUNT(id) AS newCustomer
        FROM customers $where");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $newCustomer = $temp[0]['newCustomer'];
        if(strlen($newCustomer)>=4 && strlen($newCustomer)<7) {
            $newCustomer = ROUND($temp[0]['newCustomer']/1000,2).'k';
        } 
        if(strlen($newCustomer)>=7) {
            $newCustomer = ROUND($temp[0]['newCustomer']/1000000,2).'k';
        } 
        $result['newCustomer'] = $newCustomer;
        
        for($i = 0; $i < 7; $i++) {
            $month = date("M",strtotime("-$i month"));
            $yearMonth = date("Y-m",strtotime("-$i month"));
            $where = " WHERE status = 1 AND createDate LIKE '$yearMonth%' ";
            $query = $this->db->query("SELECT COUNT(id) AS newCustomer
            FROM customers $where ");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            array_push($arrNewCustomer, $temp[0]['newCustomer']);
            array_push($arrMonth, $month);
        }
        $result['arrNewCustomer'] = array_reverse($arrNewCustomer);
        $result['arrMonth'] = array_reverse($arrMonth);
        return $result;
    }

    function reportData()
    {
        $month = date('m');
        $year = date('Y');
        $result = array();
        $arrData = [];
        $now = $year.'-'.$month;

        $query1 = $this->db->query("SELECT COUNT(id) AS changeData
        FROM data WHERE status = 11 AND creteDate LIKE '$now%'");
        $temp1 = $query1->fetchAll(PDO::FETCH_ASSOC);
        $changeData = $temp1[0]['changeData'];
        $result['changeData'] = $temp1[0]['changeData'];

        $query2 = $this->db->query("SELECT COUNT(id) AS totalData
        FROM data WHERE status > 0 AND creteDate LIKE '$now%'");
        $temp2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        $totalData = $temp2[0]['totalData'];
        if($changeData>0) {
            $changeData = ($changeData/$totalData)*100;
        } else {
            $changeData = 0;
        }

        array_push($arrData, $changeData);
        $noChangeData = 100-$changeData;
        array_push($arrData, $noChangeData);
        $result['arrData'] = $arrData;
        return $result;
    }
}
?>
