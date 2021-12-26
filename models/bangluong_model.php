<?php

class bangluong_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function listObj($thang, $nam, $nhanvien)
    {
        $result = array();
        //update bang luong
        $dieukien = " WHERE status = 1 AND branch > 0 AND shift > 0 GROUP BY staffId ";
        $query = $this->db->query("SELECT staffId FROM laborcontract $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $listnv = '';
        foreach ($temp as $hopdong) {
            $id = $hopdong['staffId'];
            $listnv .= $id . ",";
        }
        $listnv = rtrim($listnv, ",");
        if ($listnv != '') {
            $dieukien = " WHERE thang='$thang' AND nam='$nam' AND nhan_vien IN ($listnv) ";
            $query = $this->db->query("SELECT nhan_vien,
                (SELECT shift FROM laborcontract WHERE staffId=bangluong.nhan_vien ORDER BY id DESC LIMIT 1) AS ca 
                FROM bangluong $dieukien ");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($temp as $item) {
                $nhanvien = $item['nhan_vien'];
                if ($item['ca'] == 1)
                    $this->db->query("UPDATE IGNORE bangluong SET cham_cong = ngay_cong_chuan WHERE nhan_vien = $nhanvien AND thang = '$thang' AND nam = '$nam'");
                else {
                    $cong = $this->demcong($thang, $nam, $nhanvien);
                    $data = array('cham_cong' => $cong);
                    $this->update("bangluong", $data, "nhan_vien = $nhanvien AND thang = '$thang' AND nam = '$nam'");
                }
            }
        }
        if (!in_array($_SESSION['user']['staffId'], [1, 7, 8, 11, 27]))
            $dieukien .= " AND tinh_trang=1 AND nhan_vien = " . $_SESSION['user']['staffId'];
        $query = $this->db->query("SELECT *,
            (SELECT name FROM staffs WHERE id=nhan_vien) AS nhan_vien,
            (SELECT status FROM staffs WHERE id=nhan_vien) AS tinhtrang
            FROM bangluong $dieukien ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result['data'] as $key => $row) {
            if ($row['tinhtrang'] < 3)
                $row['kpi'] = 100;

            $result['data'][$key]['luong_kpi'] = ROUND(($row['luong'] * $row['kpi'] / 100));
            $result['data'][$key]['luong_tg'] = ROUND(($result['data'][$key]['luong_kpi'] / $row['ngay_cong_chuan']) * $row['cham_cong']);
            $result['data'][$key]['tong'] = $result['data'][$key]['luong_tg'] + $row['phu_cap'] + $row['thuong_ds'] + $row['thuong_lt'] + $row['thuong_khac'];
            $result['data'][$key]['thuc_linh'] = $result['data'][$key]['tong'] - ($row['phat'] + $row['bao_hiem'] + $row['tam_ung']);

            $result['data'][$key]['luong'] = number_format($row['luong']);
            $result['data'][$key]['phu_cap'] = number_format($row['phu_cap']);
            $result['data'][$key]['bao_hiem'] = number_format($row['bao_hiem']);
            $result['data'][$key]['tam_ung'] = number_format($row['tam_ung']);
            $result['data'][$key]['thuong_ds'] = number_format($row['thuong_ds']);
            $result['data'][$key]['thuong_lt'] = number_format($row['thuong_lt']);
            $result['data'][$key]['thuong_khac'] = number_format($row['thuong_khac']);
            $result['data'][$key]['luong_kpi'] = number_format($result['data'][$key]['luong_kpi']);
            $result['data'][$key]['luong_tg'] = number_format($result['data'][$key]['luong_tg']);
            $result['data'][$key]['tong'] = number_format($result['data'][$key]['tong']);
            $result['data'][$key]['thuc_linh'] = number_format($result['data'][$key]['thuc_linh']);
        }
        return $result;
    }

    function demcong($thang, $nam, $nhanvien)
    {
        $thangnam = $nam . '-' . $thang;
        $dieukien = " WHERE status=1 AND staffId=$nhanvien AND date LIKE '$thangnam%' AND morning NOT IN (0,8,9,10) ";
        $query = $this->db->query("SELECT COUNT(1) AS total FROM timekeeping $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $cong = $temp[0]['total'];
        $dieukien = " WHERE status=1 AND staffId=$nhanvien AND date LIKE '$thangnam%' AND afternoon NOT IN (0,8,9,10) ";
        $query = $this->db->query("SELECT COUNT(1) AS total FROM timekeeping $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $cong = $cong + $temp[0]['total'];
        $cong = $cong / 2;
        return $cong;
    }

    function lapbangluong($thang, $nam)
    {
        $ok = false;
        $thangnam = $nam . '-' . $thang;
        $this->db->query("DELETE FROM bangluong WHERE nam = $nam AND thang = $thang AND tinh_trang=0");
        $dieukien = " WHERE status = 1 AND branch > 0 AND shift > 0 GROUP BY staffId ";
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(startDate,'%Y-%m') as ngaydilam 
        FROM laborcontract $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($temp as $hopdong) {
            $id = $hopdong['staffId'];
            if ($id == 0)
                continue;
            $kpi = 100;
            $baohiem = 0;
            $tamung = 0;
            $query = $this->db->query("SELECT so_tien FROM bhxh_lichsu WHERE nhan_vien = $id AND tinh_trang = 1 AND ngay_gio LIKE '$thangnam%' ");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($temp) {
                $baohiem = $temp[0]['so_tien'];
            }
            $query = $this->db->query("SELECT SUM(so_tien) AS tam_ung FROM denghi WHERE nhan_vien = $id AND tinh_trang = 2 AND ngay LIKE '$thangnam%' ");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($temp) {
                $tamung = $temp[0]['tam_ung'];
            }

            $dieukien = " WHERE thang = '$thang' AND nam = '$nam' AND nhan_vien=$id ";
            $query = $this->db->query("SELECT COUNT(1) AS total FROM bangluong $dieukien ");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($row[0]['total'] == 0) {
                $congchuan = $this->workingday($thang, $nam, $id);
                if ($hopdong['salaryPercentage'] <= 0)
                    $tyleluong = 100;
                $data = array(
                    'nhan_vien' => $id,
                    'thang' => $thang,
                    'nam' => $nam,
                    'luong' => $hopdong['basicSalary'] * $tyleluong / 100,
                    'phu_cap' => $hopdong['allowance'],
                    'ngay_cong_chuan' => $congchuan,
                    'kpi' => $kpi,
                    'bao_hiem' => $baohiem,
                    'tam_ung' => $tamung,
                    'tinh_trang' => 0
                );
                $ok = $this->insert("bangluong", $data);
            }
        }
        return $ok;
    }

    function workingday($month, $year, $nhanvien)
    { // tinh so ngay lam viec trong thang theo nhân viên
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
        $query = $this->update("bangluong", $data, "id=$id");
        return $query;
    }

    function duyet($thang, $nam)
    {
        $query = $this->db->query("UPDATE bangluong SET tinh_trang=1 WHERE nam='$nam' AND thang='$thang' ");
        return $query;
    }

    function checkduyet($thang, $nam)
    {
        $query = $this->db->query("SELECT COUNT(id) AS total FROM bangluong WHERE tinh_trang=1 AND nam='$nam' AND thang='$thang' ");
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($row[0]['total'] > 0)
            return false;
        else
            return true;
    }
}
