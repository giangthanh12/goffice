<?php

class Model
{
    function __construct()
    {
        $this->db = new Database();
    }

    // them moi du lieu
    function insert($table, $array)
    {
        $cols = array();
        $bind = array();
        foreach ($array as $key => $value) {
            $cols[] = $key;
            $value = str_replace("'","\'",$value);
            $bind[] = "'" . $value . "'";
        }
        $query = $this->db->query("INSERT INTO " . $table . " (" . implode(",", $cols) . ") VALUES (" . implode(",", $bind) . ")");
        return $query;
    }

    // cap nhat du lieu
    function update($table, $array, $where)
    {
        $set = array();
        foreach ($array as $key => $value) {
            $value = str_replace("'","\'",$value);
            $set[] = $key . " = '" . $value . "'";
        }
        $query = $this->db->query("UPDATE " . $table . " SET " . implode(",", $set) . " WHERE " . $where);
        return $query;
    }

    // xoa du lieu
    function delete($table, $where = '')
    {
        if ($where == '') {
            $query = $this->db->query("DELETE FROM " . $table);
        } else {
            $query = $this->db->query("DELETE FROM " . $table . " WHERE " . $where);
        }
        return $query;
    }

    ////////////////////////////////// cac ham phu khac /////////////////////////////////////////////
    function check_token($token)
    {
        $query = $this->db->query("SELECT COUNT(id) AS total FROM users WHERE token = '$token'");
        $row = $query->fetchAll();
        return $row[0]['total'];
    }

    /////////////////////////////////// end cac ham phu khac /////////////////////////////////////////
    function sendmail($from, $tolist, $cclist, $bcc, $subject, $noidung, $textpart)
    {
        $mailjetApiKey = '2af6c853730029edd01747dfb4a82947';
        $mailjetApiSecret = '045cdbb126cc83131834e072d226bdb0';
        $messageData = [
            'Messages' => [[
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
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Content-Length: ' . strlen($jsonData)]);
        $response = curl_exec($ch);
        return $response;
    }

    function getMenus($parentId, $type)
    { $classUser = $_SESSION['user']['classify'];
        $userId = $_SESSION['user']['id'];
        $groupId = $_SESSION['user']['groupId'];
        $taxcode = $_SESSION['folder'];
            if($taxcode == 'gemstech') {
               
            $menus = [];
            if ($classUser == 1) {
                $dieukien = " WHERE active = 1 AND parentId=$parentId AND type=$type ";
                $query = $this->db->query("SELECT id,link,icon,name FROM g_menus $dieukien ORDER BY sortOrder");
                $menus = $query->fetchAll();
            } else {
                $listMenu = '';
                $query = $this->db->query("SELECT menuIds FROM grouproles WHERE id=$groupId AND status=1");
                $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                if (isset($temp[0]['menuIds']) && $temp[0]['menuIds'] != '')
                    $listMenu = $temp[0]['menuIds'];
                $query = $this->db->query("SELECT menuIds FROM userroles WHERE userId=$userId AND status=1");
                $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                if (isset($temp[0]['menuIds']) && $temp[0]['menuIds'] != '') {
                    if ($listMenu != '')
                        $listMenu .= ',' . $temp[0]['menuIds'];
                    else
                        $listMenu = $temp[0]['menuIds'];
                }

                $dieukien = " WHERE active = 1 AND parentId=$parentId AND type=$type ";
                if ($listMenu != '') {
                    $dieukien .= " AND id IN ($listMenu) ";
                    $query = $this->db->query("SELECT id,link,icon,name FROM g_menus $dieukien ORDER BY sortOrder");
                    $menus = $query->fetchAll();
                }
            }
            return $menus;
        }
        else {
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://velo.vn/customers/customer_functions/getPackets?token=e594864995037d740cadc97edd181702',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('taxCode' => $taxcode),
            CURLOPT_HTTPHEADER => array(
                'Cookie: PHPSESSID=6mumjsl1rup8dl54nj9tol88rn'
            ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
           
            $response = json_decode($response);
            $menuIds = $response->data;
            $menus = [];
            if(empty($menuIds)) {
                $where = " and id in (0) ";
            }
            else {
                if($parentId == 0) {
                    $where = " and id in ($menuIds) ";
                }
                else {
                    $where = '';
                }
            }
            
            

            if ($classUser == 1) {
                $dieukien = " WHERE active = 1 AND parentId=$parentId AND type=$type $where";
                $query = $this->db->query("SELECT id,link,icon,name FROM g_menus $dieukien ORDER BY sortOrder");
                $menus = $query->fetchAll();
                
            } else {
                $listMenu = '';
                $query = $this->db->query("SELECT menuIds FROM grouproles WHERE id=$groupId AND status=1");
                $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                if (isset($temp[0]['menuIds']) && $temp[0]['menuIds'] != '')
                    $listMenu = $temp[0]['menuIds'];
                $query = $this->db->query("SELECT menuIds FROM userroles WHERE userId=$userId AND status=1");
                $temp = $query->fetchAll(PDO::FETCH_ASSOC);
                if (isset($temp[0]['menuIds']) && $temp[0]['menuIds'] != '') {
                    if ($listMenu != '')
                        $listMenu .= ',' . $temp[0]['menuIds'];
                    else
                        $listMenu = $temp[0]['menuIds'];
                }

                $dieukien = " WHERE active = 1 AND parentId=$parentId AND type=$type ";
                if ($listMenu != '') {
                    $dieukien .= " AND id IN ($listMenu) ";
                    $query = $this->db->query("SELECT id,link,icon,name FROM g_menus $dieukien ORDER BY sortOrder");
                    $menus = $query->fetchAll();
                }
            }
            return $menus;
        }
    }

    function getFunctions($menuLink)
    {
        $classUser = $_SESSION['user']['classify'];
        $userId = $_SESSION['user']['id'];
        $groupId = $_SESSION['user']['groupId'];
        $functions = [];
        if ($classUser == 1) {
            $dieukien = " WHERE active = 1 AND menuId=(SELECT id FROM g_menus WHERE link='$menuLink' AND type<3 LIMIT 1) ";
            $query = $this->db->query("SELECT id,function,icon,name,type,color FROM g_functions $dieukien ORDER BY sortOrder");
            $functions = $query->fetchAll();
        } else {
            $listFuns = '';
            $query = $this->db->query("SELECT functionIds FROM grouproles WHERE id=$groupId AND status=1");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if (isset($temp[0]['functionIds']) && $temp[0]['functionIds'] != '')
                $listFuns = $temp[0]['functionIds'];
            $query = $this->db->query("SELECT functionIds FROM userroles WHERE userId=$userId AND status=1");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if (isset($temp[0]['functionIds']) && $temp[0]['functionIds'] != '') {
                if ($listFuns != '')
                    $listFuns .= ',' . $temp[0]['functionIds'];
                else
                    $listFuns = $temp[0]['functionIds'];
            }
            $dieukien = " WHERE active = 1 AND menuId=(SELECT id FROM g_menus WHERE link='$menuLink' AND type<3 and active = 1 LIMIT 1 ) ";
            if ($listFuns != '') {
                $dieukien .= " AND id IN ($listFuns) ";
                $query = $this->db->query("SELECT id,function,icon,name,type,color FROM g_functions $dieukien ORDER BY sortOrder");
                $functions = $query->fetchAll();
            }

        }
        return $functions;
    }

    function checkMenuRole($link)
    {
        if ($_SESSION['user']['classify'] == 1)
            return true;
        $dieukien = " WHERE active = 1 AND link='$link' AND type < 3 ";
        $userId = $_SESSION['user']['id'];
        $groupId = $_SESSION['user']['groupId'];
        $query = $this->db->query("SELECT id FROM g_menus $dieukien ORDER BY sortOrder");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($temp[0]['id'])) {
            $menuId = $temp[0]['id'];
            $listMenu = '';
            $query = $this->db->query("SELECT menuIds FROM grouproles WHERE id=$groupId AND status=1");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if (isset($temp[0]['menuIds']) && $temp[0]['menuIds'] != '')
                $listMenu = $temp[0]['menuIds']; // lấy danh sách menuid của user
            $query = $this->db->query("SELECT menuIds FROM userroles WHERE userId=$userId AND status=1");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if (isset($temp[0]['menuIds']) && $temp[0]['menuIds'] != '') {
                if ($listMenu != '')
                    $listMenu .= ',' . $temp[0]['menuIds'];
                else
                    $listMenu = $temp[0]['menuIds'];
            }
            if ($listMenu != '') {
                $listMenu = explode(",", $listMenu);
                if (in_array($menuId, $listMenu))
                    return true;
            } else
                return false;
        } else
            return false;
    }

    function checkChamCong()
    {
        $today = date("Y-m-d");
        $staffId = $_SESSION['user']['staffId'];
        $query = $this->db->query("SELECT COUNT(id) AS total FROM timekeeping WHERE staffId=$staffId AND date='$today'");
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($row[0]['total'] == 0) {
            return true;
        } else
            return false;
    }
    function getNotification() {
    
        $staffId = $_SESSION['user']['staffId'];
        $query = $this->db->query("SELECT id,title,content,
        (SELECT avatar FROM staffs where  id = events.senderId) as avatar
         FROM events where receiverId LIKE '%$staffId%' AND status in (1,2)  ORDER BY id DESC");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($temp)) return $temp;
        return [];
    }
    function getLogo(){
        $query = $this->db->query("SELECT * FROM system WHERE tinh_trang = 1 AND id = 7 OR id = 8");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
