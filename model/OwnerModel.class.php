<?php
require_once "model/persist/OwnerDbDAO.class.php";

class OwnerModel {

    private $dataOwner;

    public function __construct() {        
        // Database
        $this->dataOwner=OwnerDbDAO::getInstance();
    }


    /**
     * update an owner
     * @param $owner Owner object to update
     * @return TRUE or FALSE
     */
    public function modify($owner):bool {
        $modified=$this->dataOwner->modify($owner);
        
        if ($modified==FALSE) {
            $_SESSION['update']=OwnerMessage::ERR_DAO['update'];
        }

        return $modified;
    }


    /**
     * list all owners
     * @param void
     * @return array of Owner objects or array void
     */    
    public function listAll():array {
        $owners=$this->dataOwner->listAll();
        
        return $owners;
    }

    /**
    * select an owner by Id
    * @param $id string Owner Id
    * @param $withPets bool include pets list
    * @return Owner object or NULL
    */
    public function getOwnerById($id, bool $withPets=false) {
        return $this->dataOwner->findById($id, $withPets);
    }

    /**
    * select an owner by Id
    * @param $id string Owner Id
    * @return Owner object or NULL
    */
    public function searchById($id) {
        return $this->getOwnerById($id, false);
    }    

}
