<?php
require_once('serverUrl.php');

if (isset($_POST['modifyPostTitle']) && isset($_POST['modifyPostText']) && 
    isset($_POST['author']) && isset($_POST['postAuthor']) && 
    isset($_POST['postId'])) {
} else {
    exit("data validation error"); 
}
if ($_POST['author'] != $_POST['postAuthor']) {
    exit("user validation error");
}

$postId = $_POST['postId'];
$url = $serverUrl . 'post/' . $postId;

$content = "";
if (isset($_POST['modifyPostContent'])){
    $content = $_POST['modifyPostContent'];
}

$data = array(
    'title'     => $_POST['modifyPostTitle'],
    'text'      => $_POST['modifyPostText'],    
    'content'   => $content,    
);
print_r($data) ;

$ch = curl_init($url);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);
header("Location: ../singlePost.php?postId=$postId");