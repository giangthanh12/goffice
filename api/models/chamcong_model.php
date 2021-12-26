<?php

class chamcong_model extends Model
{
    function __construst()
    {
        parent::__construst();
    }

    function checkinWifi($nhanvien)  // chấm công khi login
    {
        $ok = 0;
        $today = date("Y-m-d");
        $query = $this->db->query("SELECT * FROM timekeeping WHERE staffId=$nhanvien AND date='$today'  ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($temp[0]['id'])) {
            if ($temp[0]['checkInTime'] == '00:00:00') { // giờ vào chưa cập nhật
                $id = $temp[0]['id'];
                $ca = $this->ca($nhanvien, $today);
                if (count($ca) > 0) {
                    $data = array('checkInTime' => date("H:i:s"), 'shiftCheckIn' => $ca['vao'], 'shiftCheckOut' => $ca['ra']);
                    if ($this->update("timekeeping", $data, "id = $id"))
                        $ok = 1;
                }
            } else {
                $ok = 2;
            }
        } else {
            $ca = $this->ca($nhanvien, $today);
            if (count($ca) > 0) {
                $data = array('staffId' => $nhanvien, 'date' => $today, 'checkInTime' => date("H:i:s"),
                    'shiftCheckIn' => $ca['vao'], 'shiftCheckOut' => $ca['ra']);
                if ($this->insert("timekeeping", $data))
                    $ok = 1;
            }
        }
        return $ok;
    }

    function ca($nhanvien, $date)
    { // Lấy giờ vào ra chuẩn theo ca
        $ca = array();
        $query = $this->db->query("SELECT * FROM shift WHERE id=(SELECT shift FROM laborcontract WHERE staffId=$nhanvien AND status=1 LIMIT 1) ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $get_name = date('l', strtotime($date)); //get week day
        $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars
        if (isset($temp[0])) {
            if ($day_name == 'Sun') {
                $ca['vao'] = $temp[0]['sunIn'];
                $ca['ra'] = $temp[0]['sunOut'];
            } elseif ($day_name == 'Mon') {
                $ca['vao'] = $temp[0]['monIn'];
                $ca['ra'] = $temp[0]['moOut'];
            } elseif ($day_name == 'Tue') {
                $ca['vao'] = $temp[0]['tueIn'];
                $ca['ra'] = $temp[0]['tueOut'];
            } elseif ($day_name == 'Wed') {
                $ca['vao'] = $temp[0]['wedIn'];
                $ca['ra'] = $temp[0]['wedOut'];
            } elseif ($day_name == 'Thu') {
                $ca['vao'] = $temp[0]['thuIn'];
                $ca['ra'] = $temp[0]['thuOut'];
            } elseif ($day_name == 'Fri') {
                $ca['vao'] = $temp[0]['friIn'];
                $ca['ra'] = $temp[0]['friOut'];
            } elseif ($day_name == 'Sat') {
                $ca['vao'] = $temp[0]['satIn'];
                $ca['ra'] = $temp[0]['satOut'];
            }
            return $ca;
        } else
            return [];
    }

    function getCong($nhanvien, $thang, $nam)
    {
        $rows = array();
        $query = $this->db->query("SELECT COUNT(1) AS total FROM nhanvien WHERE id=$nhanvien");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp[0]['total'] == 1) {
            $thangnam = $nam . '-' . $thang;
            $dieukien = " WHERE nhan_vien=$nhanvien AND ngay LIKE '$thangnam%' AND ca_vao>0 AND ca_ra>0 ";
            $query = $this->db->query("SELECT * FROM timekeeping $dieukien  ");
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $key => $item) {
                //  $id = $item['id'];
                $checkin = 0;
                $checkout = 0;
                $giovao = $item['gio_vao'];
                $giora = $item['gio_ra'];
                $cavao = $item['ca_vao'];
                $cara = $item['ca_ra'];
                //echo GIORA;
                if (strtotime($giovao) <= strtotime($cavao)) // Chấm công ca sáng
                    $checkin = 1;
                else
                    $checkin = 2;
                if (strtotime($giora) >= strtotime($cara)) // Chấm công ca sáng
                    $checkout = 1;
                else
                    $checkout = 3;
                $rows[$key]['checkin'] = $checkin;
                $rows[$key]['checkout'] = $checkout;
//                $data = array('status' => 1, 'sang' => $sang, 'chieu' => $chieu);
//                $ok = $this->update("timekeeping", $data, " id=$id ");
            }
        }
        return $rows;
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

    function suagio($id, $data)
    {
        $query = false;
        $ngay = $data['ngay'];
        $nhanvien = $data['nhan_vien'];
        $ca = $this->ca($nhanvien, $ngay);
        if (count($ca) > 0) {
            $data['ca_vao'] = $ca['vao'];
            $data['ca_ra'] = $ca['ra'];
            if ($id > 0) {
                $query = $this->update("timekeeping", $data, "id = $id");
            } else {
                $query = $this->insert("timekeeping", $data);
            }
        }
        return $query;
    }

    function checkdate($date, $nhanvien)
    {
        $query = $this->db->query("SELECT COUNT(1) AS total FROM timekeeping WHERE nhan_vien=$nhanvien AND ngay='$date'");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        return $temp[0]['total'];
    }

    function chamcongtay($id, $data)
    {
        $query = false;
//        if ($apdung==1) {
//            $nhanvien = $data['nhan_vien'];
//            $ca = $this->ca($nhanvien,$ngay);
//            $data['ca_vao'] = $ca['vao'];
//            $data['ca_ra'] = $ca['ra'];
//            $query    = $this->db->query("SELECT id FROM timekeeping WHERE nhan_vien=$nhanvien AND ngay='$ngay' ");
//            $temp     = $query->fetchAll(PDO::FETCH_ASSOC);
//            if (isset($temp[0]['id'])) {
//                $id = $temp[0]['id'];
        $query = $this->update("timekeeping", $data, "id = $id");
//            } else {
//                $query = $this->insert("timekeeping", $data);
//            }
//        }
//        if ($apdung==2) {
//            $dieukien = " WHERE status IN (1,2,3) AND van_phong>0 AND ca>0 ";
//            $query = $this->db->query("SELECT id FROM nhanvien $dieukien ");
//            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
//            foreach ($temp AS $item) {
//                $nhanvien = $item['id'];
//                $data['nhan_vien'] = $nhanvien;
//                $ca = $this->ca($nhanvien,$ngay);
//                $data['ca_vao'] = $ca['vao'];
//                $data['ca_ra'] = $ca['ra'];
//                $query    = $this->db->query("SELECT id FROM timekeeping WHERE nhan_vien=$nhanvien AND ngay='$ngay' ");
//                $temp     = $query->fetchAll(PDO::FETCH_ASSOC);
//                if (isset($temp[0]['id'])) {
//                    $id = $temp[0]['id'];
//                    $query    = $this->update("timekeeping", $data, "id = $id");
//                } else {
//                    $query = $this->insert("timekeeping", $data);
//                }
//            }
//        }
        return $query;
    }
}

?>