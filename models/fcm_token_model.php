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
                $result[] = array('fcm_token' => $temp[0]['token'], 'inboxId' => $inboxIds[$key]);
            }
        }
        return $result;
    }
}
