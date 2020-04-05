<?php
$url = 'http://localhost:3000/reply/child/';


$ch = curl_init($url);

$postId = $_POST['postId'];
$childReplyId = uniqid(CR);
echo 'submiting your reply with id: ' . $childReplyId;
$data = array(
    'text'          => $_POST['text'],
    'nickName'      => $_POST['nickName'],
    'childReplyId'  => $childReplyId,
    'replyId'       => $_POST['replyId']
);
print_r($data);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);


//header("Location: ../singlePost.php?postId=$postId");