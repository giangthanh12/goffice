<?php
class bangchamcong_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function list($thang, $nam)
    {
        $result   = array();
        $dieukien = " WHERE thang = $thang AND nam = $nam ";
        $query           = $this->db->query("SELECT COUNT(*) AS total FROM bangchamcong $dieukien ");
        $row             = $query->fetchAll(PDO::FETCH_ASSOC);
        $result['total'] = $row[0]['total'];
        $query           = $this->db->query("SELECT *,
            (ngay_01+ngay_02+ngay_03+ngay_04+ngay_05+ngay_06+ngay_07+ngay_08+
            ngay_09+ngay_10+ngay_11+ngay_12+ngay_13+ngay_14+ngay_15+ngay_16+
            ngay_17+ngay_18+ngay_19+ngay_20+ngay_21+ngay_22+ngay_23+ngay_24+
            ngay_25+ngay_26+ngay_27+ngay_28+ngay_29+ngay_30+ngay_31) AS tong,
            (SELECT name FROM nhanvien WHERE id = nhan_vien) AS nhanvien
         FROM bangchamcong $dieukien ");
        $result['data']  = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function listObj($thang, $nam)
    {
        $result   = array();
        // cập nhật bảng tổng hợp chấm công
        $query = $this->db->query("SELECT id,nhan_vien FROM bangchamcong WHERE thang = '$thang' AND nam = '$nam' ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $thangnam = $nam . '-' . $thang;
        foreach ($temp as $item) {
            $id = $item['id'];
            $nhanvien = $item['nhan_vien'];
            $query = $this->db->query("SELECT * FROM timekeeping WHERE status=1 AND date LIKE '$thangnam%' AND staffId=$nhanvien ");
            $chamcong = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($chamcong as $cong) {
                $chamcong = 0;
                $dd = date("d", strtotime($cong['date']));
                if (in_array($cong['morning'], [1, 2, 3, 4, 5, 6, 7, 11, 12]))
                    $chamcong = $chamcong + 0.5;
                if (in_array($cong['afternoon'], [1, 2, 3, 4, 5, 6, 7, 11, 12]))
                    $chamcong = $chamcong + 0.5;
                $data = array('ngay_' . $dd => $chamcong);
                $ok = $this->update("bangchamcong", $data, " id=$id ");
            }
        }

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
            $query = $this->db->query("SELECT *,
            (ngay_01+ngay_02+ngay_03+ngay_04+ngay_05+ngay_06+ngay_07+ngay_08+
            ngay_09+ngay_10+ngay_11+ngay_12+ngay_13+ngay_14+ngay_15+ngay_16+
            ngay_17+ngay_18+ngay_19+ngay_20+ngay_21+ngay_22+ngay_23+ngay_24+
            ngay_25+ngay_26+ngay_27+ngay_28+ngay_29+ngay_30+ngay_31) AS ngay_cong,
            (SELECT name FROM staffs WHERE id=nhan_vien) AS nhanvien
            FROM bangchamcong a 
            WHERE thang = '$thang' 
            AND nam = '$nam' 
            AND nhan_vien IN ($listnv)  
            AND (SELECT status FROM staffs WHERE id=a.nhan_vien) IN (1,2,3)");
            $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result['data'] as $key => $item) {
                $nhanvien = $item['nhan_vien'];
                $congchuan = $this->workingday($thang, $nam, $nhanvien);
                $result['data'][$key]['cong_chuan'] = $congchuan;
            }
        }

        return $result;
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

    function addObj($thang, $nam) // tạo bảng chấm công hoặc thêm nhân viên mới
    {
        $ok   = false;
        $dieukien = " WHERE tinh_trang = 1 AND chi_nhanh > 0 AND ca > 0  GROUP BY nhan_vien ";
        $query = $this->db->query("SELECT nhan_vien FROM hopdongld $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($temp as $hopdong) {
            $id = $hopdong['nhan_vien'];
            $dieukien = " WHERE nhan_vien = $id ORDER BY id DESC LIMIT 1 ";
            $query = $this->db->query("SELECT tinh_trang FROM hopdongld $dieukien ");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($row[0]['tinh_trang'] == 1) {
                $dieukien = " WHERE thang = '$thang' AND nam = '$nam' AND nhan_vien = $id ";
                $query = $this->db->query("SELECT COUNT(1) AS total FROM bangchamcong $dieukien ");
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                if ($row[0]['total'] == 0) {
                    $data = array('nhan_vien' => $id, 'thang' => $thang, 'nam' => $nam);
                    $ok = $this->insert("bangchamcong", $data);
                }
            }
        }
        return $ok;
    }
}
