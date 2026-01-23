<?php
/**
 * File: Pet.class.php
 * Description: Entity class representing a pet with properties for id, name, and owner identifier.
 * Used to store pet information associated with an owner.
 */

class Pet {
    private $id;
    private $nom;
    private $propietari_id;
    private $owner; // Owner object (optional)
    private $history; // array of PetHistory objects (optional)

    /**
     * Constructor for Pet class
     * 
     * @param int|null $id Pet identifier
     * @param string|null $nom Pet name
     * @param int|null $propietari_id Owner identifier (foreign key)
     */
    public function __construct($id=NULL, $nom=NULL, $propietari_id=NULL) {
        $this->id=$id;
        $this->nom=$nom;
        $this->propietari_id=$propietari_id;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id=$id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom=$nom;
    }

    public function getPropietariId() {
        return $this->propietari_id;
    }

    public function setPropietariId($propietari_id) {
        $this->propietari_id=$propietari_id;
    }

    public function getOwner() {
        return $this->owner;
    }

    public function setOwner($owner) {
        $this->owner=$owner;
    }

    public function getHistory() {
        return $this->history;
    }

    public function setHistory($history) {
        $this->history=$history;
    }
}
