<?php

class timesheets_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function listObj($month, $year)
    {
        $result = array();
        $dieukien = " WHERE month = $month AND year = $year AND status>0";
        $query = $this->db->query("SELECT COUNT(*) AS total FROM timesheets $dieukien ");
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $result['total'] = $row[0]['total'];
        $this->db->query("UPDATE timesheets SET totalWorkDate =(date_01+date_02+date_03+date_04+date_05+date_06+date_07+date_08+
            date_09+date_10+date_11+date_12+date_13+date_14+date_15+date_16+
            date_17+date_18+date_19+date_20+date_21+date_22+date_23+date_24+
            date_25+date_26+date_27+date_28+date_29+date_30+date_31)");
        $query = $this->db->query("SELECT *,
            (SELECT name FROM staffs WHERE id = staffId) AS staffName,
        (SELECT avatar FROM staffs WHERE id = staffId) AS avatar
         FROM timesheets $dieukien ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function workingday($month, $year, $shiftId)
    { // tinh so ngay lam viec trong month theo nhân viên
        $query = $this->db->query("SELECT * FROM shift WHERE id=$shiftId");
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
            $get_yeare = date('l', strtotime($date)); //get week day
            $day_yeare = substr($get_yeare, 0, 3); // Trim day yeare to 3 chars
            if ($day_yeare == 'Sun')
                $workhours = $workhours + $hours[1];
            else
                if ($day_yeare == 'Mon')
                    $workhours = $workhours + $hours[2];
                elseif ($day_yeare == 'Tue')
                    $workhours = $workhours + $hours[3];
                elseif ($day_yeare == 'Wed')
                    $workhours = $workhours + $hours[4];
                elseif ($day_yeare == 'Thu')
                    $workhours = $workhours + $hours[5];
                else
                    if ($day_yeare == 'Fri')
                        $workhours = $workhours + $hours[6];
                    else
                        if ($day_yeare == 'Sat')
                            $workhours = $workhours + $hours[7];
        }
        // echo $workhours;
        $workday = ROUND($workhours / 8, 1);
        return $workday;
    }

    function getShift($shiftId, $date)
    { // Lấy giờ vào ra chuẩn theo ca
        $ca = array();
        $query = $this->db->query("SELECT * FROM shift WHERE id=$shiftId");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $get_name = date('l', strtotime($date)); //get week day
        $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars
        if (isset($temp[0])) {
            $ca['lunInterval'] = $temp[0]['lunInterval'];
            if ($day_name == 'Sun') {
                $ca['in'] = $temp[0]['sunIn'];
                $ca['out'] = $temp[0]['sunOut'];
            } elseif ($day_name == 'Mon') {
                $ca['in'] = $temp[0]['monIn'];
                $ca['out'] = $temp[0]['monOut'];
            } elseif ($day_name == 'Tue') {
                $ca['in'] = $temp[0]['tueIn'];
                $ca['out'] = $temp[0]['tueOut'];
            } elseif ($day_name == 'Wed') {
                $ca['in'] = $temp[0]['wedIn'];
                $ca['out'] = $temp[0]['wedOut'];
            } elseif ($day_name == 'Thu') {
                $ca['in'] = $temp[0]['thuIn'];
                $ca['out'] = $temp[0]['thuOut'];
            } elseif ($day_name == 'Fri') {
                $ca['in'] = $temp[0]['friIn'];
                $ca['out'] = $temp[0]['friOut'];
            } elseif ($day_name == 'Sat') {
                $ca['in'] = $temp[0]['satIn'];
                $ca['out'] = $temp[0]['satOut'];
            }
            if($temp[0]['lunStart']!='00:00:00')
                $ca['lunStart'] = $temp[0]['lunStart'];
            else $ca['lunStart']=$ca['out'];
            return $ca;
        } else
            return [];
    }

    function getCong($thang, $nam)
    {
        $ok = false;
        $query = $this->db->query("SELECT staffId,shiftId FROM laborcontract WHERE status=1 AND shiftId>0 GROUP BY staffId ORDER BY startDate DESC ");
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        $dataCong = [];
        foreach ($rows as $key => $tempItem) {
            $shiftId = $tempItem['shiftId'];
            $staffId = $tempItem['staffId'];
            $thangnam = $nam . '-' . $thang;
            $today = date('Y-m-d');
            $dieukien = " WHERE status>0 AND staffId=$staffId AND date<'$today' AND date LIKE '$thangnam%' AND checkInTime>0 AND checkOutTime>0 ";
            $query = $this->db->query("SELECT * FROM timekeeping $dieukien  ");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $dataCong[$key]['staffId'] = $staffId;
            $dataCong[$key]['year'] = $nam;
            $dataCong[$key]['month'] = $thang;
            $totalWorkDate = 0;
            foreach ($temp as $item) {
                $date = $item['date'];
                $shift = $this->getShift($shiftId, $date);
                if (count($shift) == 0)
                    continue;
                $timeIn = strtotime($item['checkInTime']);
                $timeOut = strtotime($item['checkOutTime']);
                $shiftIn = strtotime($shift['in']);
                $shiftOut = strtotime($shift['out']);
                $lunInterval = $shift['lunInterval'];
                $lunStart = strtotime($shift['lunStart']);
                $muonsang = $shiftIn + 1800;
                $somsang = $lunStart - 1800;
                $giochieu = $lunStart + ($lunInterval * 3600);
                $somchieu = $giochieu - 1800;
                $muonchieu = $giochieu + 1800;
                $sang = 0;
                $chieu = 0;
//                echo $date;
//                  echo "<br>";
//                echo $shiftOut;
//                echo "<br>";
//                echo $giochieu;
//                echo "<br>";
                if (($shiftOut <= $giochieu)) // Chấm công ca sáng
                {
                    if (($timeIn < $shiftIn) && ($timeOut > $lunStart))
                        $sang = 0.5;
                    elseif (($timeIn > $muonsang) || ($timeOut < $somsang))
                        $sang = 0; //nghỉ không báo
                    else
                        $sang = 0.5; //đi muộn hoặc về sớm
                } elseif (($shiftIn > $lunStart))// Chấm công ca chiều
                {
                    if (($timeIn < $giochieu) && ($timeOut > $shiftOut))
                        $chieu = 0.5;
                    elseif (($timeIn > $muonchieu) || ($timeOut < $somchieu))
                        $chieu = 0; //nghỉ không báo
                    else
                        $chieu = 0.5; //đi muộn hoặc về sớm
                } elseif (($shiftIn <= $lunStart) && ($shiftOut >= $giochieu)) {// Chấm công $fulltime
                    {
                        if (($timeIn < $shiftIn) && ($timeOut > $lunStart))
                            $sang = 0.5;
                        elseif (($timeIn > $muonsang) || ($timeOut < $somsang))
                            $sang = 0; //nghỉ không báo
                        else
                            $sang = 0.5; //đi muộn hoặc về sớm
                        if (($timeIn < $giochieu) && ($timeOut > $shiftOut))
                            $chieu = 0.5;
                        elseif (($timeIn > $muonchieu) || ($timeOut < $somchieu))
                            $chieu = 0; //nghỉ không báo
                        else
                            $chieu = 0.5; //đi muộn hoặc về sớm
                    }
                }
                $arrDate = explode("-", $date);
                $date1 = $arrDate[2];
                $totalWorkDate += ($sang + $chieu);
                $dataCong[$key]['date_' . $date1] = $sang + $chieu;
            }
            //Công theo phép
            $dieukien = " WHERE status=2 AND staffId=$staffId AND date<='$today' AND date LIKE '$thangnam%' ";
            $query = $this->db->query("SELECT shift,date FROM onleave $dieukien  ");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($temp as $item) {
                $date = $item['date'];
                $sang = 0;
                $chieu = 0;
                if ($item['shift'] == 1)
                    $sang = 0.5;
                else if ($item['shift'] == 2)
                    $chieu = 0.5;
                else if ($item['shift'] == 3) {
                    $sang = 0.5;
                    $chieu = 0.5;
                }
                $arrDate = explode("-", $date);
                $date1 = $arrDate[2];
                $totalWorkDate += ($sang + $chieu);
                if (isset($dataCong[$key]['date_' . $date1]))
                    $dataCong[$key]['date_' . $date1] += $sang + $chieu;
                else
                    $dataCong[$key]['date_' . $date1] = $sang + $chieu;
            }
            $query = $this->db->query("SELECT id FROM timesheets WHERE status=1 AND staffId=$staffId AND year='$nam' AND month='$thang'");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            $workingDays = $this->workingday($thang, $nam, $shiftId);
            $dataCong[$key]['workMonth'] = $workingDays;
            $dataCong[$key]['totalWorkDate'] = $totalWorkDate;
            if (count($row) > 0) {
                $sheetId = $row[0]['id'];
                $ok = $this->update("timesheets", $dataCong[$key], "id=$sheetId");
            } else {
                $dataCong[$key]['status'] = 1;
                $ok = $this->insert("timesheets", $dataCong[$key]);
            }

        }

        return $dataCong;
    }

    function getEmployee()
    {
        $result = array();
        $query = $this->db->query("SELECT id, name, avatar
              FROM staffs WHERE status IN (1,2,3,4,5) ORDER BY name ASC");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function updateWork($staffIds, $data, $month, $year)
    {
        $ok = false;
        $where = " WHERE status=1 AND shiftId>0 ";
        if ($staffIds > 0)
            $where .= " AND staffId=$staffIds ";
        $query = $this->db->query("SELECT shiftId,staffId FROM laborcontract $where GROUP BY staffId ORDER BY startDate DESC ");
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $key => $tempItem) {
            $staffId = $tempItem['staffId'];
            $data['staffId'] = $staffId;
            $data['year'] = $year;
            $data['month'] = $month;
            $query = $this->db->query("SELECT id,(date_01+date_02+date_03+date_04+date_05+date_06+date_07+date_08+
            date_09+date_10+date_11+date_12+date_13+date_14+date_15+date_16+
            date_17+date_18+date_19+date_20+date_21+date_22+date_23+date_24+
            date_25+date_26+date_27+date_28+date_29+date_30+date_31) as totalWork FROM timesheets WHERE status=1 AND staffId=$staffId AND year='$year' AND month='$month'");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            $workingDays = $this->workingday($month, $year, $tempItem['shiftId']);
            $data['workMonth'] = $workingDays;
            if (count($row) > 0) {
                $sheetId = $row[0]['id'];
                $ok = $this->update("timesheets", $data, "id=$sheetId");
            } else {
                $dataCong[$key]['status'] = 1;
                $ok = $this->insert("timesheets", $data);
            }
        }
        return $ok;
    }
}
