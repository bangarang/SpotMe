<?php
    require_once __DIR__ . "/../utils/SessionUtils.php";
    require_once __DIR__ . "/../classes/Event.php";
    
    SessionUtils::sessionStart();
    SessionUtils::checkSessionExpired();            
?>
<!--
<p>
    <a href="../handlers/logoutHandler.php">logout bordel de merde</a>
</p>
-->

<?php 
    $events = Event::getAllEvents();            
?>
<table>
    <?php
    foreach ($events as $event)
    {
        ?>
            <!-- Event title -->
            <tr class="eventTitle">
                <td>
                    <?php echo $event->getTitre(); ?>
                </td>
            </tr>

            <!-- Event description -->
            <tr class="eventDescription">
                <td>
                    <?php echo $event->getDescription(); ?>
                </td>                        
            </tr>

            <tr class="eventMiscellaneous">
                <td>Prix : <?php echo $event->getCout()?></td>
                <td>Adresse : <?php echo $event->getAdresse()?></td>
                <td></td>
                <td></td>
            </tr>
        <?php
    }
    ?>
</table>
