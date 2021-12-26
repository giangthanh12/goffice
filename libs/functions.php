<?php
class functions {
    public static function uploadfile ($filename,$dir,$name) {
        if ($_FILES[$filename]["size"] > 5000000)  // gioi han kich thuoc file 5M
            return false;
        // elseif(getimagesize($_FILES[$filename]["tmp_name"]) == false) // kiểm tra xem có phải là file ảnh ko?
        //     return false;
        else {
            $imageFileType = strtolower(pathinfo(basename($_FILES[$filename]["name"]),PATHINFO_EXTENSION));
            $newfile=$name.'.'.$imageFileType;
            $target = $dir.$newfile;
            $i=1;
            while (file_exists($target)) {
                $newfile=$name.'.'.$i.'.'.$imageFileType;
                $target = $dir.$newfile;
                $i++;
            }
            if (move_uploaded_file($_FILES[$filename]["tmp_name"], $target))
                return $newfile;
            else
                return false;
        }
    }

    public static function upfiles ($filename,$filesize,$filetemp, $dir) {
        if ($filesize > 5000000)  // gioi han kich thuoc file 5M
            return '';
        else {
            $imageFileType = strtolower(pathinfo(basename($filename),PATHINFO_EXTENSION));
            $name = functions::convertname($filename);
            $newfile=$name.'.'.$imageFileType;
            $target = $dir.$newfile;
            $i=1;
            while (file_exists($target)) {
                $newfile=$name.'.'.$i.'.'.$imageFileType;
                $target = $dir.$newfile;
                $i++;
            }
            if (move_uploaded_file($filetemp, $target))
                return $name;
            else
                return '';
        }
    }

    public static function convertname($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = str_replace(" ","-",$str);
        $str = str_replace("!","-",$str);
        $str = str_replace("@","-",$str);
        $str = str_replace("#","-",$str);
        $str = str_replace("$","-",$str);
        $str = str_replace("%","-",$str);
        $str = str_replace("&","-",$str);
        $str = str_replace("&amp;","-",$str);
        $str = str_replace("*","-",$str);
        $str = str_replace("?","-",$str);
        $str = str_replace(";","-",$str);
        $str = str_replace(":","-",$str);
        $str = str_replace(",","-",$str);
        $str = str_replace(".","-",$str);
        $str = str_replace("\"","-",$str);
        $str = str_replace('“',"-",$str);
        $str = str_replace('”',"-",$str);
        $str = str_replace('"',"-",$str);
        $str = str_replace("(","-",$str);
        $str = str_replace(")","-",$str);
        $str = str_replace("{","-",$str);
        $str = str_replace("}","-",$str);
        $str = str_replace("[","-",$str);
        $str = str_replace("]","-",$str);
        $str = str_replace("/","-",$str);
        $str = str_replace("----","-",$str);
        $str = str_replace("---","-",$str);
        $str = str_replace("--","-",$str);
        $str = rtrim(strtolower($str),'-');
        return $str;
    }

	public static function dequy($menu,$parentid,$level) {
		if (!isset($ketqua)) $ketqua=array();
		global $ketqua;
		$level=($parentid==0)?0:$level+1;
		foreach($menu as $value) {
			$value['level']=$level;
			if($value['cha'] == $parentid) {
				$ketqua[]=$value;
				functions::dequy($menu,$value['id'],$level);
			}
		}
		return $ketqua;
	}

  public static function convertDate($text) { //convert 31/12/2019 thang 2019-12-31
		if ($text != '') {
			list ( $date, $month, $year ) = explode ( "/", $text );
			$text = $year . '-' . $month . '-' . $date;
		}
		return $text;
	}

  public static function hihi($text) { //convert 31/12/2019 13:16:00 thành 2019-12-31 13:16:00
    if ($text != '') {
       $text = explode(' ', $text);
        $text= functions::convertDate($text[0]).' '.$text[1];
    }
    return $text;
  }

  public static function convert_number_to_words($number){
        $donvi=" đồng ";
        $tiente=array("nganty" => " nghìn tỷ ","ty" => " tỷ ","trieu" => " triệu ","ngan" =>" nghìn ","tram" => " trăm ");
        $num_f=$nombre_format_francais = number_format($number, 2, ',', ' ');
        $vitri=strpos($num_f,',');
        $num_cut=substr($num_f,0,$vitri);
        $mang=explode(" ",$num_cut);
        $sophantu=count($mang);
        switch($sophantu){
            case '5':
                    $nganty=functions::doc3so($mang[0]);
                    $text=$nganty;
                    $ty=functions::doc3so($mang[1]);
                    $trieu=functions::doc3so($mang[2]);
                    $ngan=functions::doc3so($mang[3]);
                    $tram=functions::doc3so($mang[4]);
                    if((int)$mang[1]!=0){
                        $text.=$tiente['ngan'];
                        $text.=$ty.$tiente['ty'];
                    }
                    else{
                        $text.=$tiente['nganty'];
                    }
                    if((int)$mang[2]!=0)
                        $text.=$trieu.$tiente['trieu'];
                    if((int)$mang[3]!=0)
                        $text.=$ngan.$tiente['ngan'];
                    if((int)$mang[4]!=0)
                        $text.=$tram;
                    $text.=$donvi;
                    return $text;


            break;
            case '4':
                    $ty=functions::doc3so($mang[0]);
                    $text=$ty.$tiente['ty'];
                    $trieu=functions::doc3so($mang[1]);
                    $ngan=functions::doc3so($mang[2]);
                    $tram=functions::doc3so($mang[3]);
                    if((int)$mang[1]!=0)
                        $text.=$trieu.$tiente['trieu'];
                    if((int)$mang[2]!=0)
                        $text.=$ngan.$tiente['ngan'];
                    if((int)$mang[3]!=0)
                        $text.=$tram;
                    $text.=$donvi;
                    return $text;


            break;
            case '3':
                    $trieu=functions::doc3so($mang[0]);
                    $text=$trieu.$tiente['trieu'];
                    $ngan=functions::doc3so($mang[1]);
                    $tram=functions::doc3so($mang[2]);
                    if((int)$mang[1]!=0)
                        $text.=$ngan.$tiente['ngan'];
                    if((int)$mang[2]!=0)
                        $text.=$tram;
                    $text.=$donvi;
                    return $text;
            break;
            case '2':
                    $ngan=functions::doc3so($mang[0]);
                    $text=$ngan.$tiente['ngan'];
                    $tram=functions::doc3so($mang[1]);
                    if((int)$mang[1]!=0)
                        $text.=$tram;
                    $text.=$donvi;
                    return $text;

            break;
            case '1':
                    $tram=functions::doc3so($mang[0]);
                    $text=$tram.$donvi;
                    return $text;

            break;
            default:
                return "Xin lỗi số quá lớn không thể đổi được";
            break;
        }
  }

  public static function doc3so($so){
        $achu = array ( " không "," một "," hai "," ba "," bốn "," năm "," sáu "," bảy "," tám "," chín " );
        $aso = array ( "0","1","2","3","4","5","6","7","8","9" );
        $kq = "";
        $tram = floor($so/100); // Hàng trăm
        $chuc = floor(($so/10)%10); // Hàng chục
        $donvi = floor(($so%10)); // Hàng đơn vị
        if($tram==0 && $chuc==0 && $donvi==0) $kq = "";
        if($tram!=0){
            $kq .= $achu[$tram] . " trăm ";
            if (($chuc == 0) && ($donvi != 0)) $kq .= " lẻ ";
        }
        if (($chuc != 0) && ($chuc != 1)){
            $kq .= $achu[$chuc] . " mươi";
            if (($chuc == 0) && ($donvi != 0)) $kq .= " linh ";
        }
        if ($chuc == 1) $kq .= " mười ";
        switch ($donvi){
        case 1:
            if (($chuc != 0) && ($chuc != 1)){
                $kq .= " mốt ";
            }
            else{
                $kq .= $achu[$donvi];
            }
            break;
        case 5:
            if ($chuc == 0){
                $kq .= $achu[$donvi];
            }
            else{
                $kq .= " lăm ";
            }
            break;
        default:
            if ($donvi != 0){
                   $kq .= $achu[$donvi];
            }
            break;
        }
        if($kq=="")
            $kq=0;
        return $kq;
    }

  // public static function workingday($month,$year,$hours) { // tinh so ngay lam viec thong thang
  //   $type = CAL_GREGORIAN;
  //   $day_count = cal_days_in_month($type, $month, $year);
  //   $workday=0;
  //   $workhours=0;
  //   for ($i = 1; $i <= $day_count; $i++) {
  //       // if ($i<10) $i = '0'.$i;
  //       $date = $year.'-'.$month.'-'.$i; //format date
  //       $get_name = date('l', strtotime($date)); //get week day
  //       $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars
  //       if ($day_name == 'Sun')
  //           $workhours = $workhours + $hours[1];
  //       elseif ($day_name == 'Mon')
  //           $workhours = $workhours + $hours[2];
  //       elseif ($day_name == 'Tue')
  //           $workhours = $workhours + $hours[3];
  //       elseif ($day_name == 'Wed')
  //           $workhours = $workhours + $hours[4];
  //       elseif ($day_name == 'Thu')
  //           $workhours = $workhours + $hours[5];
  //       elseif ($day_name == 'Fri')
  //           $workhours = $workhours + $hours[6];
  //       elseif ($day_name == 'Sat')
  //           $workhours = $workhours + $hours[7];
  //   }
  //   $workday = ROUND($workhours/8,1);
  //   return $workday;
  // }



}
?>
