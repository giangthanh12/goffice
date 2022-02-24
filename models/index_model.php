<?php

class index_model extends Model
{
    function __construst()
    {
        parent::__construst();
    }

    function checkIp()
    {
        $check = 0;
        $ipLogin = $_SERVER['REMOTE_ADDR'];
        $ipPoint = $_SESSION['user']['accesspoints'];
        if ($ipPoint != '') {
            $query = $this->db->query("SELECT ip FROM accesspoints WHERE id IN ($ipPoint)");
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $item) {
                if ($item['ip'] == $ipLogin)
                    $check = 2;
            }
        } else {
            $check = 1;
        }
        return $check;
    }

    function checkInWifi()  // chấm công khi login
    {
        $ok = false;
        $today = date("Y-m-d");
        $staffId = $_SESSION['user']['staffId'];
        if ($this->checkChamCong()) {
            $data = array('staffId' => $staffId, 'date' => $today, 'checkInTime' => date("H:i:s"), 'status' => 1);
            $ok = $this->insert("timekeeping", $data);
            if($ok)
            $ok = $data;
        }
        return $ok;
    }

    function checkout($nhanvien)
    {
        $ok = false;
        $today = date("Y-m-d");
        $where = " staffId = $nhanvien AND date = '$today' ";
        $data = ['checkOutTime' => date("H:i:s")];
        $ok = $this->update("timekeeping", $data, $where);
        return $ok;
    }

    function checkOutBtn()
    {
        $ok = false;
        $today = date("Y-m-d");
        $staffId = $_SESSION['user']['staffId'];
        $array = ['staffId'=>$staffId, 'date'=>$today];
        $where = " staffId=$staffId AND date = '$today' ";
        $data = ['checkOutTime' => date("H:i:s")];
        $ok = $this->update("timekeeping", $data, $where);
        if($ok)
        $ok = array_merge($array, $data);
        return $ok;
    }
}

?>