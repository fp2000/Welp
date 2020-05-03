<?php
require_once('serverUrl.php');

if (isset($_POST['firstName']) && isset($_POST['lastName']) && 
    isset($_POST['nickName']) && isset($_POST['password1']) && 
    isset($_POST['password2']) && isset($_POST['email']) && 
    isset($_POST['birthDate'])) {
    if (strcmp($_POST['password1'], $_POST['password2']) !== 0) {
        exit("data validation error"); 
    }
} else {
    exit("data validation error"); 
}

$url = $serverUrl . 'user/';
echo $url;

$ch = curl_init($url);
$userId = uniqid(uwu);
$nickName = $_POST['nickName'];
$pass =  crypt($_POST['password1'], '$6$');
$data = array(
    'firstName'     => $_POST['firstName'],
    'lastName'      => $_POST['lastName'],
    'nickName'      => $nickName,
    'birthDate'     => $_POST['birthDate'],
    'userId'        => $userId,
    'password'      => $pass,
    'email'         => $_POST['email'],
);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);

header("Location: ../accountConfirmation.php?nickName=$nickName");