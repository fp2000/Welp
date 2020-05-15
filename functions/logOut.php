<?php
session_start();
session_destroy();
if (isset($_POST["currentUrl"])){
    $currentUrl = $_POST["currentUrl"];
    header('Location: ' . $currentUrl);
}
else {
    header('Location: ../index.php');
}