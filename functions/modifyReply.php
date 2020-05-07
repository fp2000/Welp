<?php
require_once('serverUrl.php');

if (isset($_POST['modifyReplyText']) && isset($_POST['modifyReplyId']) && 
    isset($_POST['modifyReplyAuthor']) && isset($_POST['author']) && 
    isset($_POST['postId'])) {
} else {
    exit("data validation error"); 
}
if ($_POST['author'] != $_POST['modifyReplyAuthor']) {
    exit("user validation error");
}
$postId = $_POST['postId'];
$replyId = $_POST['modifyReplyId'];
$url = $serverUrl . 'reply/' . $replyId;

$data = array(
    'text'     => $_POST['modifyReplyText'],  
);

$ch = curl_init($url);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);
header("Location: ../singlePost.php?postId=$postId");