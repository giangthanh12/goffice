<?php

class timekeeping_model extends Model
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


    function getTimekeeping($nhanvien, $month, $yeah)
    {
        $rows = array();
        $date = $yeah . '-' . $month;
        $dieukien = " WHERE staffId=$nhanvien AND date LIKE '$date%' ";
        $query = $this->db->query("SELECT *
                FROM timekeeping $dieukien ORDER BY date");
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    function checkout()
    {
        $ok = false;
        $today = date("Y-m-d");
        $staffId = $_SESSION['user']['staffId'];
        $where = " staffId=$staffId AND date = '$today' ";
        $data = ['checkOutTime' => date("H:i:s")];
        $ok = $this->update("timekeeping", $data, $where);
        return $ok;
    }

    function manualTimekeeping($id, $data)
    {
        $query = false;
        if ($id > 0) {
            $query = $this->update("timekeeping", $data, "id = $id");
        } else {
            $query = $this->insert("timekeeping", $data);
        }
        return $query;
    }

    function checkdate($date, $staffId)
    {
        $query = $this->db->query("SELECT COUNT(1) AS total FROM timekeeping WHERE staffId=$staffId AND date='$date'");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        return $temp[0]['total'];
    }
}

?>