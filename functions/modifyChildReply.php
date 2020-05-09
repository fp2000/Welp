<?php
session_start();
require_once('serverUrl.php');

if (isset($_POST['modifyChildReplyText']) && isset($_POST['modifyChildReplyId']) && 
    isset($_POST['modifyChildReplyAuthor']) && isset($_POST['modifyChildReplyChildReplyId']) && 
    isset($_POST['postId']) ) {
} else {
    exit("data validation error"); 
}
if ($_SESSION["nickName"] != $_POST['modifyChildReplyAuthor']) {
    exit("user validation error");
}
$postId = $_POST['postId'];
$replyId = $_POST['modifyChildReplyId'];
$url = $serverUrl . 'reply/child/' . $replyId;

$data = array(
    'text'     => $_POST['modifyChildReplyText'],
    'childReplyId' => $_POST['modifyChildReplyChildReplyId'],
);

print_r($data);
print $url;


$ch = curl_init($url);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);
header("Location: ../singlePost.php?postId=$postId");