<?php

    class MySQLUtils
    {        
        //Cette méthode retourne une connexion à MySQL.
        public static function loginMySQL()
        {
            //Se connecter à la BD avec PDO
            if (!$link = new PDO('mysql:host=' . Globals::DB_HOST . ';dbname=' . Globals::DB_NAME, Globals::USERNAME, Globals::PASSWORD)) {
                //Indiquer à l'utilisateur qu'on arrive pas à se connecter
                echo 'Could not connect to mysql';
                exit;
            }
            
            return $link;
        }
    }
?>
