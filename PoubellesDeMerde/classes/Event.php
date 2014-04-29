<?php

require_once(__DIR__ . '/../utils/MySQLUtils.php');

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
                "SELECT * FROM " . Globals::EVENEMENT_TABLE . " WHERE id = ?"
        );
        $statement->execute(array($id));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        loadFromArray($result[0]);
    }

    private function loadFromArray($info) {
        foreach ($info as $key => $value) {
            $this->{$key} = $value;
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
                "SELECT utilisateur_id, commentaire, date FROM " . Globals::COMMENTAIRE_TABLE . " WHERE evenement_id = ?"
        );
        $statement->execute(array($this->id));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $comments = array();
        foreach ($result as $comment) {
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
                "SELECT id,
    categorie,
    titre,
    debut,
    fin,
    horaire,
    cout,
    description,
    renseignement,
    tel1,
    tel2,
    courriel,
    url,
    nomlieu,
    complement_lieu,
    adresse,
    tel_lieu,
    nom_arrondissement FROM " . Globals::EVENEMENT_TABLE . " group by description"
        );
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        // Instanciate Event objects from retrieved ID's
        $events = array();
        foreach ($result as $event) {
            $events[] = new Event($event);
        }

        return $events;
    }

    public function getId() {
        return $this->id;
    }

    public function getCategorie() {
        return $this->categorie;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDebut() {
        return $this->debut;
    }

    public function getFin() {
        return $this->fin;
    }

    public function getHoraire() {
        return $this->horaire;
    }

    public function getCout() {
        return $this->cout;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getRenseignement() {
        return $this->renseignement;
    }

    public function getTel1() {
        return $this->tel1;
    }

    public function getTel2() {
        return $this->tel2;
    }

    public function getCourriel() {
        return $this->courriel;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getNomlieu() {
        return $this->nomlieu;
    }

    public function getComplement_lieu() {
        return $this->complement_lieu;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getTel_lieu() {
        return $this->tel_lieu;
    }

    public function getNom_arrondissement() {
        return $this->nom_arrondissement;
    }

    public function getTwitter_hashtag() {
        return $this->twitter_hashtag;
    }

}

?>
