<?php
require_once __DIR__ . '/../facebook/facebook.php';
require_once __DIR__ . '/../utils/Globals.php';

$facebook = new Facebook(array(
    'appId' => Globals::FB_APP_ID,
    'secret' => Globals::FB_APP_SECRET
));
session_start();
$_SESSION = array();
session_unset();
session_destroy();
$facebook->destroySession();
header("location:../index.php");
exit;
?>
