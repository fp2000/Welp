<?php
session_start();
$url = "http://localhost:3000/auth";
$pass =  crypt($_POST['password'], '$6$');
$nickName = $_POST['nickName'];
$currentUrl = $_POST['currentUrl'];
$data = array(
    'nickName' => $nickName,
    'password' => $pass,
);
$payload = json_encode($data);

$ch = curl_init($url);
$headr = array();
$headr[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0";
$headr[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
$headr[] = "Accept-Language: en-US,en;q=0.5";
$headr[] = "Connection: keep-alive";
$headr[] = "Upgrade-Insecure-Requests: 1";

curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($payload))
);

$res = curl_exec($ch);
curl_close($ch);
$userParams = json_decode($res);

if ($userParams->nickName == $nickName){
    echo ('Login OK');
    $_SESSION["nickName"]=$userParams->nickName;
    $_SESSION["firstName"]=$userParams->firstName;
    $_SESSION["userId"]=$userParams->userId;
    header('Location: ' . $currentUrl);
    
} elseif ($res == 'incorrectPassword'){
    echo ('te equivocaste en la contraseña uwu');    
} elseif ($res == 'userNotFound'){
    echo ('no se encontro el usuario uwu');
} elseif ($res == 'invalidInput'){
    echo ('kk uwu');
} else {

}
?>