<?php

class index_model extends Model
{
    function __construst()
    {
        parent::__construst();
    }

    function checkIp()
    {
        $check = false;
        $ipLogin = $_SERVER['REMOTE_ADDR'];
        $ipPoint = $_SESSION['user']['accesspoints'];
        $query = $this->db->query("SELECT ip FROM accesspoints WHERE id IN ($ipPoint)");
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $item) {
            if ($item['ip'] == $ipLogin)
                return true;
        }
        return $check;
    }

    function checkInWifi()  // chấm công khi login
    {
        $ok = false;
        $today = date("Y-m-d");
        $staffId = $_SESSION['user']['staffId'];
        if ($this->checkChamCong()) {
            $data = array('staffId' => $staffId, 'date' => $today, 'checkInTime' => date("H:i:s"),'status'=>1);
            $ok = $this->insert("timekeeping", $data);
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
}

?>