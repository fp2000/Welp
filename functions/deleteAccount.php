<?php

session_start();
require_once('serverUrl.php');

if (isset($_POST['nickName'])) {
} else {
    exit("data validation error"); 
}
if ($_POST['nickName'] != $_SESSION["nickName"]) {
    exit("user validation error");
}
$nickName = $_SESSION["nickName"];  
$url = $serverUrl . 'user/delete/' . $nickName;


$data = array();

$ch = curl_init($url);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);

session_destroy();
header("Location: ../index.php");