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
        $query = $this->db->query("SELECT * FROM chamcong WHERE nhan_vien=$nhanvien AND ngay='$today'  ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($temp[0]['id'])) {
            if ($temp[0]['gio_vao'] == '00:00:00') { // giờ vào chưa cập nhật
                $id = $temp[0]['id'];
                $ca = $this->ca($nhanvien, $today);
                if (count($ca) > 0) {
                    $data = array('gio_vao' => date("H:i:s"), 'ca_vao' => $ca['vao'], 'ca_ra' => $ca['ra']);
                    $ok = $this->update("chamcong", $data, "id = $id");
                }
            }
        } else {
            $ca = $this->ca($nhanvien, $today);
            if (count($ca) > 0) {
                $data = array('nhan_vien' => $nhanvien, 'ngay' => $today, 'gio_vao' => date("H:i:s"),
                    'ca_vao' => $ca['vao'], 'ca_ra' => $ca['ra']);
                $ok = $this->insert("chamcong", $data);
            }
        }
        return $ok;
    }

    function ca($nhanvien, $date)
    { // Lấy giờ vào ra chuẩn theo ca
        $ca = array();
        $query = $this->db->query("SELECT * FROM ca WHERE id=(SELECT ca FROM hopdongld WHERE nhan_vien=$nhanvien AND tinh_trang=1 LIMIT 1) ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $get_name = date('l', strtotime($date)); //get week day
        $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars
        if (isset($temp[0])) {
            if ($day_name == 'Sun') {
                $ca['vao'] = $temp[0]['cn_in'];
                $ca['ra'] = $temp[0]['cn_out'];
            } elseif ($day_name == 'Mon') {
                $ca['vao'] = $temp[0]['t2_in'];
                $ca['ra'] = $temp[0]['t2_out'];
            } elseif ($day_name == 'Tue') {
                $ca['vao'] = $temp[0]['t3_in'];
                $ca['ra'] = $temp[0]['t3_out'];
            } elseif ($day_name == 'Wed') {
                $ca['vao'] = $temp[0]['t4_in'];
                $ca['ra'] = $temp[0]['t4_out'];
            } elseif ($day_name == 'Thu') {
                $ca['vao'] = $temp[0]['t5_in'];
                $ca['ra'] = $temp[0]['t5_out'];
            } elseif ($day_name == 'Fri') {
                $ca['vao'] = $temp[0]['t6_in'];
                $ca['ra'] = $temp[0]['t6_out'];
            } elseif ($day_name == 'Sat') {
                $ca['vao'] = $temp[0]['t7_in'];
                $ca['ra'] = $temp[0]['t7_out'];
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
            $today = date('Y-m-d');
            $dieukien = " WHERE tinh_trang=0 AND nhan_vien=$nhanvien AND ngay<'$today' AND ngay LIKE '$thangnam%' AND ca_vao>0 AND ca_ra>0 ";
            $query = $this->db->query("SELECT * FROM chamcong $dieukien  ");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($temp as $item) {
                $id = $item['id'];
                $sang = $item['sang'];
                $chieu = $item['chieu'];
                $giovao = $item['gio_vao'];
                $giora = $item['gio_ra'];
                $cavao = $item['ca_vao'];
                $cara = $item['ca_ra'];
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
                $data = array('tinh_trang' => 1, 'sang' => $sang, 'chieu' => $chieu);
                $ok = $this->update("chamcong", $data, " id=$id ");
            }
            $dieukien = " WHERE nhan_vien=$nhanvien AND ngay LIKE '$thangnam%' ";
            $query = $this->db->query("SELECT *, IFNULL((SELECT name FROM cong WHERE id=sang),'') AS kyhieusang,
                IFNULL((SELECT name FROM cong WHERE id=chieu),'') AS kyhieuchieu
                FROM chamcong $dieukien ORDER BY ngay");
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
            $where = " nhan_vien = $nhanvien AND ngay = '$today' ";
            $data = ['gio_ra' => date("H:i:s")];
            $ok = $this->update("chamcong", $data, $where);
        }
        return $ok;
    }

    function chamcongtay($id, $data)
    {
        $query =false;
        $ngay = $data['ngay'];
        $nhanvien = $data['nhan_vien'];
        $ca = $this->ca($nhanvien, $ngay);
        if (count($ca) > 0) {
            $data['ca_vao'] = $ca['vao'];
            $data['ca_ra'] = $ca['ra'];
            if ($id > 0) {
                $query = $this->update("chamcong", $data, "id = $id");
            } else {
                $query = $this->insert("chamcong", $data);
            }
        }
        return $query;
    }

    function checkdate($date, $nhanvien)
    {
        $query = $this->db->query("SELECT COUNT(1) AS total FROM chamcong WHERE nhan_vien=$nhanvien AND ngay='$date'");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        return $temp[0]['total'];
    }
}

?>