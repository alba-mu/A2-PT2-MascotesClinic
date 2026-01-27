<?php
/**
 * File: PetModel.class.php
 * Description: Business logic layer for pet operations. Acts as intermediary between controller and database layer.
 * Provides methods for querying and modifying pet data.
 */

require_once "model/persist/PetDbDAO.class.php";
/**
 * PetModel - Business Logic Layer
 * Manages pet-related operations and delegates database operations to PetDbDAO
 */
class PetModel {

    private $dataPet;

    public function __construct() {        
        // Database
        $this->dataPet=PetDbDAO::getInstance();
    }


    /**
     * update a pet
     * @param $pet Pet object to update
     * @return TRUE or FALSE
     */
    public function modify($pet):bool {
        $modified=$this->dataPet->modify($pet);
        
        if ($modified==FALSE) {
            $_SESSION['update']=PetMessage::ERR_DAO['update'];
        }

        return $modified;
    }


    /**
     * list all pets
     * @param void
     * @return array of Pet objects or array void
     */    
    public function listAll():array {
        $pets=$this->dataPet->listAll();
        
        return $pets;
    }

    /**
    * select a pet by Id
    * @param $id string Pet Id
    * @param $withPets bool include pets list
    * @return Pet object or NULL
    */
    public function getPetById($id, bool $withRelations=false) {
        return $this->dataPet->findById($id, $withRelations);
    }

    /**
    * select a pet by Id
    * @param $id string Pet Id
    * @return Pet object or NULL
    */
    public function searchById($id) {
        return $this->getPetById($id, false);
    }    

    /**
     * Retrieves pet with owner and history
     */
    public function getPetDetail($id) {
        return $this->dataPet->findById($id, true);
    }



}
