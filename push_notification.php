<?php
$item = $_REQUEST['item'];
$title = $_REQUEST['title'];
$body = $_REQUEST['body'];
define('API_ACCESS_KEY', 'AAAAhvTgZQQ:APA91bFl7i1Ctp7aXma6CTwGEYY7dU1t2Bdni2e8PeurScHCI0b6XHw0wHppJV9zroO4skW3K7O8T5cEKxzK4h278Z83DZaf2zXLnsajn5p_JmbeaxImKfVbd3dc-I9uoyh6vQkvCZqN');

$data = array(
    "to" => $item['fcm_token'],
    "notification" => array(
        "title" => $title, 
        "body" => "Bạn có thông báo mới"
    ),
    "data" => array(
        // "title" => $title, 
        // "body" => $body,
        // "title" => $title, 
        // "body" => $body,
        "inboxId" => $item['inboxId'],
        "link" => "inbox"
    )
);
$data_string = json_encode($data);

echo "Json Data : " . $data_string;

$headers = array(
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

$result = curl_exec($ch);

curl_close($ch);

// echo "<p>&nbsp;</p>";
// echo "The Result : " . $result;
