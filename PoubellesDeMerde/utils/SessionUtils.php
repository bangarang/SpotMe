<?php
    require_once "Globals.php";

    class SessionUtils
    {
        public static function sessionStart()
        {
            if(session_status() != PHP_SESSION_ACTIVE)
            {
                session_start(); 
            }
        }
        
        
        public static function checkSessionExpired()
        {
            if( isset($_SESSION['LAST_REQUEST']) &&
            (time() - $_SESSION['LAST_REQUEST'] > Globals::SESSION_TIMEOUT) ) {
                session_unset();
                session_destroy();
                header('location:' . __DIR__ . '/../index.php');
                exit();
            }
 
            $_SESSION['LAST_REQUEST'] = time();
        }
    }
?>
