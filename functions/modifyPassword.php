<?php

session_start();
require_once('serverUrl.php');

if (isset($_POST['nickName'])  && 
    isset($_POST['password1']) && isset($_POST['password2'])) {
} else {
    exit("data validation error"); 
}
if ($_POST['nickName'] != $_SESSION["nickName"]) {
    exit("user validation error");
}
if ($_POST['password1'] != $_POST['password2']) {
    exit("passwordValidationError");
}

$nickName = $_POST['nickName'];
$url = $serverUrl . 'user/modifyPassword/' . $nickName;
$pass =  crypt($_POST['password1'], '$6$');

$data = array(
    'password'      => $pass,    
);

$ch = curl_init($url);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);

header("Location: ../accountSettings.php?nickName=$nickName");