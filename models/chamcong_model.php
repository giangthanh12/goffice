<?php

class chamcong_model extends Model
{
    function __construst()
    {
        parent::__construst();
    }

    function chamcong($nhanvien)  // chấm công khi login
    {
        $ok = false;
        $today = date("Y-m-d");
        $query = $this->db->query("SELECT * FROM timekeeping WHERE staffId=$nhanvien AND date='$today'  ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($temp[0]['id'])) {
            if ($temp[0]['checkInTime'] == '00:00:00') { // giờ vào chưa cập nhật
                $id = $temp[0]['id'];
                $ca = $this->ca($nhanvien, $today);
                if (count($ca) > 0) {
                    $data = array('checkInTime' => date("H:i:s"), 'shiftCheckIn' => $ca['in'], 'shiftCheckOut' => $ca['out']);
                    $ok = $this->update("timekeeping", $data, "id = $id");
                }
            }
        } else {
            $ca = $this->ca($nhanvien, $today);
            if (count($ca) > 0) {
                $data = array('staffId' => $nhanvien, 'date' => $today, 'checkInTime' => date("H:i:s"),
                    'shiftCheckIn' => $ca['in'], 'shiftCheckOut' => $ca['out']);
                $ok = $this->insert("timekeeping", $data);
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
            return $ca;
        } else
            return [];
    }

    function getCong($nhanvien, $thang, $nam)
    {
        $rows = array();
        $query = $this->db->query("SELECT COUNT(1) AS total FROM staffs WHERE id=$nhanvien");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp[0]['total'] == 1) {
            $thangnam = $nam . '-' . $thang;
            $today = date('Y-m-d');
            $dieukien = " WHERE status=0 AND staffId=$nhanvien AND date<'$today' AND date LIKE '$thangnam%' AND checkInTime>0 AND checkOutTime>0 ";
            $query = $this->db->query("SELECT * FROM timekeeping $dieukien  ");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($temp as $item) {
                $id = $item['id'];
                $sang = $item['morning'];
                $chieu = $item['afternoon'];
                $giovao = $item['checkInTime'];
                $giora = $item['checkOutTime'];
                $cavao = $item['shiftCheckIn'];
                $cara = $item['shiftCheckOut'];
                //echo GIORA;
                if (($cavao == GIOVAO) && ($cara == NGHITRUA)) // Chấm công ca sáng
                    if ($sang == 0)
                        if (($giovao < GIOVAO) && ($giora > NGHITRUA))
                            $sang = 1;
                        elseif (($giovao > MUONSANG) || ($giora < SOMSANG))
                            $sang = 10; //nghỉ không báo
                        else
                            $sang = 11; //đi muộn hoặc về sớm
                if (($cavao == GIOCHIEU) && ($cara == GIORA)) // Chấm công ca chiều
                    if ($chieu == 0)
                        if (($giovao < GIOCHIEU) && ($giora > GIORA))
                            $chieu = 1;
                        elseif (($giovao > MUONCHIEU) || ($giora < SOMCHIEU))
                            $chieu = 10; //nghỉ không báo
                        else
                            $chieu = 11; //đi muộn hoặc về sớm
                if (($cavao == GIOVAO) && ($cara == GIORA)) {// Chấm công $fulltime
                    if ($sang == 0)
                        if (($giovao < GIOVAO) && ($giora > NGHITRUA))
                            $sang = 1;
                        elseif (($giovao > MUONSANG) || ($giora < SOMSANG))
                            $sang = 10; //nghỉ không báo
                        else
                            $sang = 11; //đi muộn hoặc về sớm
                    if ($chieu == 0)
                        if (($giovao < GIOCHIEU) && ($giora > GIORA))
                            $chieu = 1;
                        elseif (($giovao > MUONCHIEU) || ($giora < SOMCHIEU))
                            $chieu = 10; //nghỉ không báo
                        else
                            $chieu = 11; //đi muộn hoặc về sớm
                }
                $data = array('status' => 1, 'morning' => $sang, 'afternoon' => $chieu);
                $ok = $this->update("timekeeping", $data, " id=$id ");
            }
            $dieukien = " WHERE staffId=$nhanvien AND date LIKE '$thangnam%' ";
            $query = $this->db->query("SELECT *, IFNULL((SELECT name FROM cong WHERE id=morning),'') AS kyhieusang,
                IFNULL((SELECT name FROM cong WHERE id=afternoon),'') AS kyhieuchieu
                FROM timekeeping $dieukien ORDER BY date");
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
//            for ($i=1;$i<=$endmonth;$i++) {
//                $temp[$i] = $i;
//                foreach ($rows AS $key=>$row) {
//                    $ngay = (int) substr($row['ngay'], -2);
//                    $giovao = ($row['gio_vao']=='00:00:00')?' ':$row['gio_vao'].' vào';
//                    $giora = ($row['gio_ra']=='00:00:00')?' ':$row['gio_ra'].' ra';
//                    // $duyet = ($row['tinh_trang']==1)?'&#9733;':'&#9734;';
//                    $duyet = ($row['tinh_trang']==1)?'':'(*)';
//                    if ($ngay == $i)
//                        $temp[$i]= '<div style="font-weight:bold;">'.$i.'</div>
//                          <div style="color:#1a75ba; font-weight:bold; padding:2px">'.$giovao.'</div>
//                          <div style="color:#1a75ba; font-weight:bold; padding:2px">'.$giora.'</div>
//                          <div style="color:red;font-weight:bold;">'.$row['sang'].$row['chieu'].' '.$duyet.'</div>';
//                }
//            }
//            $bangchamcong=array();
//            for ($i=0;$i<6;$i++) {
//                if ($i==0)
//                    for ($j=$firstday;$j<8;$j++)
//                        $bangchamcong[$i][$j]=isset($temp[$j-$firstday+1])?$temp[$j-$firstday+1]:'';
//                elseif ($i<5)
//                    for ($j=1;$j<8;$j++)
//                        $bangchamcong[$i][$j]=isset($temp[$j+7*$i-$firstday+1])?$temp[$j+7*$i-$firstday+1]:'';
//                else
//                    for ($j=1;$j<=$lastday;$j++)
//                        $bangchamcong[$i][$j]=isset($temp[$j+7*$i-$firstday+1])?$temp[$j+7*$i-$firstday+1]:'';
//            }
            //  $data['footer'] = array(0=>array('1'=>'X: đủ công, P: phép','2'=>'C: công tác, L: nghỉ lễ','3'=>'T: tết, B: nghỉ bù','4'=>'V: nghỉ có lương','5'=>'K: nghỉ không lương','6'=>'O: ốm, -: không báo','7'=>'M: muộn sớm, Q: quên chấm'));
        }
        return $rows;
    }

    function checkout($nhanvien, $ipvanphong)
    {
        $ok = false;
        $iplogin = $_SERVER["REMOTE_ADDR"];
        if ($ipvanphong == $iplogin) {
            $today = date("Y-m-d");
            $where = " staffId = $nhanvien AND date = '$today' ";
            $data = ['checkOutTime' => date("H:i:s")];
            $ok = $this->update("timekeeping", $data, $where);
        }
        return $ok;
    }

    function chamcongtay($id, $data)
    {
        $query =false;
        $ngay = $data['date'];
        $nhanvien = $data['staffId'];
        $ca = $this->ca($nhanvien, $ngay);
        if (count($ca) > 0) {
            $data['shiftCheckIn'] = $ca['in'];
            $data['shiftCheckOut'] = $ca['out'];
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
        $query = $this->db->query("SELECT COUNT(1) AS total FROM timekeeping WHERE staffId=$nhanvien AND date='$date'");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        return $temp[0]['total'];
    }
}

?>