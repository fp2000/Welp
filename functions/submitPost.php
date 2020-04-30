<?php

require_once('serverUrl.php');
$url = $serverUrl . 'post/';


$ch = curl_init($url);
$postId = uniqid(uwu);
echo 'submiting your post with id: ' . $postId;
$data = array(
    'title'     => $_POST['title'],
    'text'      => $_POST['text'],
    'author'    => $_POST['author'],
    'userId'    => $_POST['userId'],
    'topic'     => $_POST['topic'],
    'postId'    => $postId,
    'likes'     => array()
);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);

header("Location: ../singlePost.php?postId=$postId");