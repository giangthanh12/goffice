<?php
class fcm_token_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getFcmToken($receiverId, $inboxIds)
    {
        $result = [];
        foreach ($receiverId as $key => $item) {
            $query = $this->db->query("SELECT token,count(id) as total
            FROM fcm_tokens WHERE staffId=$item AND active=1");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($temp[0]['total'] > 0) {
                $query = $this->db->query("SELECT token,count(id) as total
                FROM users WHERE staffId=$item AND status=1");
                if ($temp[0]['total'] > 0) {
                    $user = $query->fetchAll(PDO::FETCH_ASSOC);
                    $user_token = $user[0]['token'];
                    $result[] = array('fcm_token' => $temp[0]['token'], 'inboxId' => $inboxIds[$key], 'user_token' => $user_token);
                }
            }
        }
        return $result;
    }
}
