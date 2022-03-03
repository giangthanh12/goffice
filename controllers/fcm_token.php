<?php
class fcm_token extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function getFcmToken()
    {
        $receiverId = $_REQUEST['receiverId'];
        $inboxIds = $_REQUEST['inboxIds'];
        $data = $this->model->getFcmToken($receiverId, $inboxIds);
        $jsonObj['success'] = true;
        $jsonObj['data'] = $data;
        echo json_encode($jsonObj);
    }
}
