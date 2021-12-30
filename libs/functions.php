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
			if($value['parentId'] == $parentid) {
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

    public static function sendmail($from, $tolist, $cclist, $bcc, $subject, $noidung,$textpart)
    {
        $mailjetApiKey = '2af6c853730029edd01747dfb4a82947';
        $mailjetApiSecret = '045cdbb126cc83131834e072d226bdb0';
        $messageData = ['Messages' => [[
            'From' => $from,
            'To' => $tolist,
            "Cc" => $cclist,
            "Bcc" => $bcc,
            'Subject' => $subject,
            'TextPart' => $textpart,
            'HTMLPart' => $noidung
            ]]
        ];
        $jsonData = json_encode($messageData);
        $ch = curl_init('https://api.mailjet.com/v3.1/send');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_USERPWD, "{$mailjetApiKey}:{$mailjetApiSecret}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json','Content-Length: ' . strlen($jsonData)]);
        $response = curl_exec($ch);
        return $response;
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
?>
