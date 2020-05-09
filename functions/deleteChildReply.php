<?php
session_start();
require_once('serverUrl.php');

if (isset($_POST['deleteChildReplyAuthor']) &&
    isset($_POST['deleteChildReplyChildReplyId']) && 
    isset($_POST['postId'])) {
} else {
    exit("data validation error"); 
}
if ($_SESSION["nickName"] != $_POST['deleteChildReplyAuthor']) {
    exit("user validation error");
}

$postId = $_POST['postId'];
$replyId = $_POST['deleteChildReplyChildReplyId'];
$url = $serverUrl . 'reply/child/' . $replyId;


$data = array(
    'childReplyId'     => $_POST['deleteChildReplyChildReplyId'],
);

$ch = curl_init($url);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);
header("Location: ../singlePost.php?postId=$postId");