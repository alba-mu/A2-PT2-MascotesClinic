<?php
/**
 * File: Owner.class.php
 * Description: Entity class representing a pet owner with properties for id, name, email, and mobile number.
 * Includes methods for managing pets associated with the owner.
 */

class Owner {
    
    private $id;
    private $nom;
    private $email;
    private $movil; 
    private $petsList; // array of Pet objects

    /**
     * Constructor for Owner class
     * 
     * @param int|null $id Owner identifier
     * @param string|null $nom Owner name
     * @param string|null $email Owner email address
     * @param string|null $movil Owner mobile phone number
     */
    public function __construct($id=NULL, $nom=NULL, $email=NULL, $movil=NULL) {
        $this->id=$id;
        $this->nom=$nom;
        $this->email=$email;
        $this->movil=$movil;
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

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email=$email;
    }

    public function getMovil() {
        return $this->movil;
    }

    public function setMovil($movil) {
        $this->movil=$movil;
    }

    public function getPetsList() {
        return $this->petsList;
    }

    public function setPetsList($petsList) {
        $this->petsList=$petsList;
    }

    public function __toString() {
        return sprintf("%s;%s;%s;%s\n", $this->id, $this->nom, $this->email, $this->movil); // array of Pet objects is excluded
    }

}