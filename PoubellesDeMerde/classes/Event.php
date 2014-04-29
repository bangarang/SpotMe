<?php
require_once('MySQLUtils.php');

class Event {
    private $id;
    private $categorie;
    private $titre;
    private $debut;
    private $fin;
    private $horaire;
    private $cout;
    private $description;
    private $renseignement;
    private $tel1;
    private $tel2;
    private $courriel;
    private $url;
    private $nomlieu;
    private $complement_lieu;
    private $adresse;
    private $tel_lieu;
    private $nom_arrondissement;
    private $twitter_hashtag;
    
    /**
     * Event constructor, argument needs to either be an array containing all 
     * event information or a single id from which to load the event from.
     */
    public function __construct() {
        $arg = func_get_arg(0);
        if (is_array($arg)) {
            $this->loadFromArray($arg);        
        } else {
            $this->loadFromId($arg);
        }
    }
    
    private function loadFromId($id) {
        $connection = MySQLUtils::loginMySQL();
        $statement = $connection->prepare(
            "SELECT * FROM spot_evenement WHERE id = ?"
        );
        $statement->execute(array($id));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        loadFromArray($result[0]);
    }
    
    private function loadFromArray($info) {
        foreach($info as $key => $value) {
            if (isset($key)) {
                $this->{$key} = $value;
            }
        }
    }
    
    /**
     * Returns an array containing all comments related to this event.
     * Each comment is an array containing keys: 
     * 'utilisateur_id', 
     * 'commentaire', 
     * 'date', 
     * 
     * @return array all comments related to this event
     */
    public function getAllComments() {
        $connection = MySQLUtils::loginMySQL();
        $statement = $connection->prepare(
            "SELECT utilisateur_id, commentaire, date FROM spot_commentaire WHERE evenement_id = ?"
        );
        $statement->execute(array($this->id));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $comments = array();
        foreach($result as $comment) {
            $comments[] = $comment;
        }
        
        return $comments;
    }
    
    
    
    /**
     * Returns an array containing all events from the database.
     * 
     * @return \Event array of Event objects
     */
    public static function getAllEvents() {
        // Fetches all event ID's
        $connection = MySQLUtils::loginMySQL();
        $statement = $connection->prepare(
            "SELECT * FROM spot_evenement"
        );
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        // Instanciate Event objects from retrieved ID's
        $events = array();
        foreach($result as $event) {
            $events[] = new Event(array_values($event));
        }
        
        return $events;
    }
}
?>
