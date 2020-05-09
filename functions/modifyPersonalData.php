<?php
session_start();
require_once('serverUrl.php');

if (isset($_POST['profileNameModal']) && isset($_POST['profileLastNameModal']) && 
    isset($_POST['nickName']) && 
    isset($_POST['currentUrl'])) {
} else {
    exit("data validation error"); 
}
if ($_POST['nickName'] != $_SESSION["nickName"]) {
    exit("user validation error");
}

$nickName = $_POST['nickName'];
$url = $serverUrl . 'user/personalData/' . $nickName;


$data = array(
    'firstName'     => $_POST['profileNameModal'],
    'lastName'      => $_POST['profileLastNameModal'],    
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

header("Location: ../accountSettings.php?nickName=$nickName");