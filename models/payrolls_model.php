<?php

class payrolls_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function listObj($month, $year, $staffId, $funCheck)
    {
        $result = array();
        if ($funCheck == 0) {
            $where = " WHERE month='$month' AND year='$year' AND a.staffId=$staffId AND status=2 ";
        } else {
            $where = " WHERE month='$month' AND year='$year' AND status>0 ";
            if ($staffId > 0)
                $where .= " AND staffId=$staffId";
        }
        $query = $this->db->query("SELECT *,
                IFNULL((SELECT name FROM staffs WHERE id=a.staffId and status in (1,2,3,4,5)), 'noName') as staffName, 
                -- (SELECT name FROM staffs WHERE id=a.staffId) as staffName,
                (SELECT avatar FROM staffs WHERE id=a.staffId and status in (1,2,3,4,5) ) as avatar
                FROM payrolls a $where having staffName != 'noName'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function addObj($month, $year)
    {
        $ok = false;
        $where = " WHERE status > 0 AND year='$year' AND month='$month' ";
        $query = $this->db->query("SELECT staffId, year,month,workMonth,totalWorkDate
        FROM timesheets $where ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($temp as $workSheet) {
            $staffId = $workSheet['staffId'];
            $data = [];
            $data['staffId'] = $staffId;
            $data['year'] = $year;
            $data['month'] = $month;
            $data['wokingDays'] = $workSheet['workMonth'];
            $data['totalWorkDays'] = $workSheet['totalWorkDate'];
            $where = " WHERE status = 1 AND staffId=$staffId ";
            $query = $this->db->query("SELECT basicSalary,allowance,salaryPercentage FROM laborcontract $where ORDER BY startDate DESC");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if (!isset($temp[0]['basicSalary']) || $temp[0]['basicSalary'] <= 0)
                continue;
            $salaryPercentage = 100;
            if ($temp[0]['salaryPercentage'] > 0 && $temp[0]['salaryPercentage'] < 100)
                $salaryPercentage = $temp[0]['salaryPercentage'];
            $data['basicSalary'] = ($temp[0]['basicSalary'] * $salaryPercentage) / 100;
            $data['allowance'] = $temp[0]['allowance'];
            $where = " WHERE month = '$month' AND year = '$year' AND staffId=$staffId ";
            $query = $this->db->query("SELECT id FROM payrolls $where ");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            if (isset($row[0]['id'])) {
                $payRollId = $row[0]['id'];
                $ok = $this->update("payrolls", $data, "id=$payRollId AND status=1");
            } else {
                $data['status'] = 1;
                $ok = $this->insert("payrolls", $data);
            }
        }
        return $ok;
    }

    function workingday($month, $year, $nhanvien)
    { // tinh so ngay lam viec trong month theo nhân viên
        $query = $this->db->query("SELECT * FROM shift WHERE id=(SELECT shift FROM laborcontract WHERE staffId=$nhanvien ORDER BY id DESC LIMIT 1) ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        // echo (strtotime($temp[0]['t7_out']) - strtotime($temp[0]['t7_in']))/3600;
        $hours[1] = (strtotime($temp[0]['sunOut']) - strtotime($temp[0]['sunIn'])) / 3600;
        if ($hours[1] > 4) $hours[1] = $hours[1] - $temp[0]['lunInterval'];
        $hours[2] = (strtotime($temp[0]['monOut']) - strtotime($temp[0]['monIn'])) / 3600;
        if ($hours[2] > 4) $hours[2] = $hours[2] - $temp[0]['lunInterval'];
        $hours[3] = (strtotime($temp[0]['tueOut']) - strtotime($temp[0]['tueIn'])) / 3600;
        if ($hours[3] > 4) $hours[3] = $hours[3] - $temp[0]['lunInterval'];
        $hours[4] = (strtotime($temp[0]['wedOut']) - strtotime($temp[0]['wedIn'])) / 3600;
        if ($hours[4] > 4) $hours[4] = $hours[4] - $temp[0]['lunInterval'];
        $hours[5] = (strtotime($temp[0]['thuOut']) - strtotime($temp[0]['thuIn'])) / 3600;
        if ($hours[5] > 4) $hours[5] = $hours[5] - $temp[0]['lunInterval'];
        $hours[6] = (strtotime($temp[0]['friOut']) - strtotime($temp[0]['friIn'])) / 3600;
        if ($hours[6] > 4) $hours[6] = $hours[6] - $temp[0]['lunInterval'];
        $hours[7] = (strtotime($temp[0]['satOut']) - strtotime($temp[0]['satIn'])) / 3600;
        if ($hours[7] > 4) $hours[7] = $hours[7] - $temp[0]['lunInterval'];
        //$type = CAL_GREGORIAN;
        //$day_count = cal_days_in_month(0, $month, $year);
        $day_count = date('t', mktime(0, 0, 0, $month, 1, $year));
        $workday = 0;
        $workhours = 0;
        for ($i = 1; $i <= $day_count; $i++) {
            // if ($i<10) $i = '0'.$i;
            $date = $year . '-' . $month . '-' . $i; //format date
            $get_name = date('l', strtotime($date)); //get week day
            $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars
            if ($day_name == 'Sun')
                $workhours = $workhours + $hours[1];
            else
                if ($day_name == 'Mon')
                    $workhours = $workhours + $hours[2];
                elseif ($day_name == 'Tue')
                    $workhours = $workhours + $hours[3];
                elseif ($day_name == 'Wed')
                    $workhours = $workhours + $hours[4];
                elseif ($day_name == 'Thu')
                    $workhours = $workhours + $hours[5];
                else
                    if ($day_name == 'Fri')
                        $workhours = $workhours + $hours[6];
                    else
                        if ($day_name == 'Sat')
                            $workhours = $workhours + $hours[7];
        }
        // echo $workhours;
        $workday = ROUND($workhours / 8, 1);
        return $workday;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("payrolls", $data, "id=$id");
        return $query;
    }

    function checkPayRolls($month, $year)
    {
        $query = $this->db->query("UPDATE payrolls SET status=2 WHERE year='$year' AND month='$month' ");
        return $query;
    }
}
