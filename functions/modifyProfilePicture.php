<?php
session_start();
require_once('serverUrl.php');

$url = $serverUrl . 'upload';

if (isset($_POST['author']) && $_FILES['photo']) {
} else {
    exit("data validation error"); 
}
if ($_POST['author'] != $_SESSION["nickName"]) {
    exit("user validation error");
}

$file = $_FILES['photo']['tmp_name'];
$cfile = new CURLFile($file,'image/png',$_POST['author']. '.jpg');
$imgdata = array('photo' => $cfile);

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux i686; rv:6.0) Gecko/20100101 Firefox/6.0Mozilla/4.0 (compatible;)");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);


curl_setopt($ch, CURLOPT_POSTFIELDS, $imgdata);

$result = curl_exec($ch);
curl_close($ch);

$currentUrl = $_POST['currentUrl'];
header('Location: ' . $currentUrl);