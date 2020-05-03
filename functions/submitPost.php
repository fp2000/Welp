<?php
require_once('serverUrl.php');

if (isset($_POST['title']) && isset($_POST['text']) && 
    isset($_POST['author']) && isset($_POST['userId']) && 
    isset($_POST['topic'])) {
} else {
    exit("data validation error"); 
}


$url = $serverUrl . 'post/';

$postId = uniqid(uwu);

echo 'submiting your post with id: ' . $postId;

$media = "";
if (isset($_POST['content'])){
    $media = $_POST['content'];
}

$data = array(
    'title'     => $_POST['title'],
    'text'      => $_POST['text'],
    'author'    => $_POST['author'],
    'userId'    => $_POST['userId'],
    'topic'     => $_POST['topic'],
    'postId'    => $postId,
    'media'     => $media,
    'likes'     => array()
);
$ch = curl_init($url);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);

header("Location: ../singlePost.php?postId=$postId");