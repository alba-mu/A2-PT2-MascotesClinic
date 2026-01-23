<?php
/**
 * File: OwnerDbDAO.class.php
 * Description: Data Access Object (DAO) for Owner entity. Handles all database operations related to owners.
 * Implements Singleton pattern to ensure single database connection instance.
 * Supports CRUD operations for owners and retrieves associated pets.
 */

require_once "model/persist/ConnectDb.class.php";
require_once "model/Pet.class.php";

/**
 * OwnerDbDAO - Data Access Object
 * Singleton pattern implementation for database operations on owners and pets
 */
class OwnerDbDAO {

    private static $instance = NULL;
    private $connect;

    public function __construct() {
        $this->connect = (new ConnectDb())->getConnection();
    }

    public static function getInstance(): OwnerDbDAO {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Updates owner information in the database
     * 
     * @param Owner $owner Owner object with updated data
     * @return bool TRUE if update successful, FALSE otherwise
     */
    public function modify($owner): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "No s'ha pogut connectar amb la base de dades";
            return FALSE;
        };

        try {
            $sql = <<<SQL
                UPDATE propietaris SET email=:email,movil=:movil
                        WHERE ID=:id;
            SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":email", $owner->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":movil", $owner->getMovil(), PDO::PARAM_STR);
            $stmt->bindValue(":id", $owner->getId(), PDO::PARAM_INT);

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
     * Retrieves all owners from the database
     * 
     * @return array Array of Owner objects, empty array if none found
     */
    public function listAll(): array {
        $result = array();

        if ($this->connect == NULL) {
            $_SESSION['error'] = "No s'ha pogut connectar amb la base de dades";
            return $result;
        };

        try {
            $sql = <<<SQL
                SELECT id,nom,email,movil FROM propietaris;
            SQL;

            $result = $this->connect->query($sql);

            $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Owner');

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
     * Finds an owner by ID with optional pet list retrieval
     * 
     * @param int $id Owner identifier
     * @param bool $withPets If true, includes associated pets in the result
     * @return Owner|null Owner object if found, NULL otherwise
     */
    public function findById($id, bool $withPets=false) {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "No s'ha pogut connectar amb la base de dades";
            return NULL;
        }

        $owner = $this->fetchOwner($id);
        if ($owner && $withPets) {
            $owner->setPetsList($this->fetchPets($id));
        }

        return $owner;
    }

    /**
     * Private method to fetch a single owner from the database
     * 
     * @param int $id Owner identifier
     * @return Owner|null Owner object if found, NULL otherwise
     */
    private function fetchOwner($id) {
        try {
            $sql = <<<SQL
                SELECT id,nom,email,movil FROM propietaris WHERE id=:id;
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
     * Private method to fetch all pets belonging to an owner
     * 
     * @param int $ownerId Owner identifier
     * @return array Array of Pet objects associated with the owner
     */
    private function fetchPets($ownerId): array {
        $pets = array();
        try {
            $sql = <<<SQL
                SELECT id, nom, propietari_id FROM mascotes WHERE propietari_id=:ownerId;
            SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":ownerId", $ownerId, PDO::PARAM_INT);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Pet');
            $pets = $stmt->fetchAll();
        } catch (PDOException $e) {
            return $pets;
        }

        return $pets;
    }

}
