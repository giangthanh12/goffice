<?php
class Model {
    function __construct() {
		$this->db = new Database();
	}
    
    // them moi du lieu
    function insert($table, $array){
        $cols = array();
        $bind = array();
        foreach($array as $key => $value){
            $cols[] = $key;
            $bind[] = "'".$value."'";
        }
        $query = $this->db->query("INSERT INTO ".$table." (".implode(",", $cols).") VALUES (".implode(",", $bind).")");
        return $query;
    }
    
    // cap nhat du lieu
    function update($table, $array, $where){
        $set = array();
        foreach($array as $key => $value){
            $set[] = $key." = '".$value."'";
        }
        $query = $this->db->query("UPDATE ".$table." SET ".implode(",", $set)." WHERE ".$where);
        return $query;
    }
    
    // xoa du lieu
    function delete($table, $where = ''){
        if($where == ''){
            $query = $this->db->query("DELETE FROM ".$table);
        }else{
            $query = $this->db->query("DELETE FROM ".$table." WHERE ".$where);
        }
        return $query;
    }
 ////////////////////////////////// cac ham phu khac /////////////////////////////////////////////
    function check_token($token){
        $query = $this->db->query("SELECT COUNT(id) AS total FROM users WHERE token = '$token'");
        $row = $query->fetchAll();
        return $row[0]['total'];
    }
 /////////////////////////////////// end cac ham phu khac /////////////////////////////////////////
//  send mail
    function sendmail($from, $tolist, $cclist, $bcc, $subject, $noidung, $textpart)
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
}
?>