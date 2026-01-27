<?php
/**
 * File: PetDbDAO.class.php
 * Description: Data Access Object (DAO) for Pet entity. Handles all database operations related to pets.
 * Implements Singleton pattern to ensure single database connection instance.
 * Supports CRUD operations for pets.
 */

require_once "model/persist/ConnectDb.class.php";
require_once "model/Pet.class.php";
require_once "model/Owner.class.php";
require_once "model/PetHistory.class.php";
require_once "model/persist/HistoryDbDAO.class.php";

/**
 * PetDbDAO - Data Access Object
 * Singleton pattern implementation for database operations on pets
 */
class PetDbDAO {

    private static $instance = NULL;
    private $connect;

    public function __construct() {
        $this->connect = (new ConnectDb())->getConnection();
    }

    public static function getInstance(): PetDbDAO {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Updates pet information in the database
     * 
     * @param Pet $pet Pet object with updated data
     * @return bool TRUE if update successful, FALSE otherwise
     */
    public function modify($pet): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "No s'ha pogut connectar amb la base de dades";
            return FALSE;
        };

        try {
            $sql = <<<SQL
                UPDATE mascotes SET nom=:nom,propietari_id=:propietari_id
                        WHERE ID=:id;
            SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":nom", $pet->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(":propietari_id", $pet->getPropietariId(), PDO::PARAM_INT);
            $stmt->bindValue(":id", $pet->getId(), PDO::PARAM_INT);

            $stmt->execute();

            if ($stmt->rowCount()) {
                return TRUE;
            } else {
                return FALSE;
            }

        } catch (PDOException $e) {
            return FALSE;
        }
    }

    /**
     * Retrieves all pets from the database
     * 
     * @return array Array of Pet objects, empty array if none found
     */
    public function listAll(): array {
        $result = array();

        if ($this->connect == NULL) {
            $_SESSION['error'] = "No s'ha pogut connectar amb la base de dades";
            return $result;
        };

        try {
            $sql = <<<SQL
                SELECT id,nom,propietari_id FROM mascotes;
            SQL;

            $result = $this->connect->query($sql);

            $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Pet');

            return $result->fetchAll();
        } catch (PDOException $e) {
            return $result;
        }

        return $result;
    }

    public function searchById($id) {
        return $this->findById($id, false);
    }

    /**
     * Finds a pet by ID. If $withRelations is true, attaches owner and history.
     *
     * @param int $id Pet identifier
     * @param bool $withRelations Include owner and history data
     * @return Pet|null Pet object if found, NULL otherwise
     */
    public function findById($id, bool $withRelations=false) {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "No s'ha pogut connectar amb la base de dades";
            return NULL;
        }

        $pet = $this->fetchPet($id);
        if ($pet && $withRelations) {
            $owner = $this->fetchOwnerById($pet->getPropietariId());
            if ($owner) {
                $pet->setOwner($owner);
            }
            $pet->setHistory($this->fetchHistory($id));
        }

        return $pet;
    }



    /**
     * Private method to fetch a single pet
     */
    private function fetchPet($id) {
        try {
            $sql = <<<SQL
                SELECT id, nom, propietari_id FROM mascotes WHERE id=:id;
            SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Pet');
                return $stmt->fetch();
            }
            return NULL;
        } catch (PDOException $e) {
            return NULL;
        }
    }

    /**
     * Private method to fetch owner data by ID
     */
    private function fetchOwnerById($id) {
        try {
            $sql = <<<SQL
                SELECT id, nom, email, movil FROM propietaris WHERE id=:id;
            SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Owner');
                return $stmt->fetch();
            }
            return NULL;
        } catch (PDOException $e) {
            return NULL;
        }
    }

    /**
     * Private method to fetch history entries for a pet
     * Delegates to HistoryDbDAO
     */
    private function fetchHistory($petId): array {
        $historyDAO = HistoryDbDAO::getInstance();
        return $historyDAO->findByPetId($petId);
    }

}
