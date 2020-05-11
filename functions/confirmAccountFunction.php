<?php

require_once('serverUrl.php');
$url = $serverUrl . 'user/confirmation/';

$ch = curl_init($url);
$userId = $_GET['id'];
$data = array(
    'userId' => $userId
);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

$result = curl_exec($ch);
curl_close($ch);

header("Location: ../accountActivated.php");