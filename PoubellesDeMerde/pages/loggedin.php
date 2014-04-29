<?php
    require_once __DIR__ . "/../utils/SessionUtils.php";
    
    SessionUtils::sessionStart();
    SessionUtils::checkSessionExpired();            
?>
<p>
    <a href="logout.php">logout bordel de merde</a>
</p>
