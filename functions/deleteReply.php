<?php
require_once('serverUrl.php');

if (isset($_POST['deleteReplyId']) && 
    isset($_POST['deleteReplyAuthor']) && isset($_POST['author']) && 
    isset($_POST['postId'])) {
} else {
    exit("data validation error"); 
}
if ($_POST['author'] != $_POST['deleteReplyAuthor']) {
    exit("user validation error");
}

$postId = $_POST['postId'];
$replyId = $_POST['deleteReplyId'];
$url = $serverUrl . 'reply/' . $replyId;


$data = array();

$ch = curl_init($url);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);
header("Location: ../singlePost.php?postId=$postId");