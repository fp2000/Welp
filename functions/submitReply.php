<?php
require_once('serverUrl.php');

if (isset($_POST['text']) && isset($_POST['postId']) && 
    isset($_POST['nickName'])) {
} else {
    exit("data validation error"); 
}


$url = $serverUrl . 'reply/';

$ch = curl_init($url);
$postId = $_POST['postId'];
$replyId = uniqid(uwuR);
echo 'submiting your reply with id: ' . $replyId;
$data = array(
    'text'       => $_POST['text'],
    'nickName'   => $_POST['nickName'],
    'replyId'    => $replyId,
    'postId'     => $postId,
    'reply'      => array()
);
print_r($data);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);


header("Location: ../singlePost.php?postId=$postId");