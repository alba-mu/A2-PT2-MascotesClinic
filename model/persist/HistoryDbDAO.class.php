<?php
/**
 * File: HistoryDbDAO.class.php
 * Description: Data Access Object (DAO) for History entity. Handles all database operations related to pet history.
 * Implements Singleton pattern to ensure single database connection instance.
 * Supports CRUD operations for history entries.
 */

require_once "model/persist/ConnectDb.class.php";
require_once "model/PetHistory.class.php";

/**
 * HistoryDbDAO - Data Access Object
 * Singleton pattern implementation for database operations on pet history
 */
class HistoryDbDAO {

    private static $instance = NULL;
    private $connect;

    public function __construct() {
        $this->connect = (new ConnectDb())->getConnection();
    }

    public static function getInstance(): HistoryDbDAO {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Inserts a new history entry for a pet
     * 
     * @param PetHistory $history History object to insert
     * @return bool TRUE if insert successful, FALSE otherwise
     */
    public function insert(PetHistory $history): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "No s'ha pogut connectar amb la base de dades";
            return FALSE;
        }

        try {
            $sql = <<<SQL
                INSERT INTO historial (data, motiu_visita, descripcio, mascota_id)
                VALUES (:data, :motiu, :descripcio, :pet_id);
            SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":data", $history->getData(), PDO::PARAM_STR);
            $stmt->bindValue(":motiu", $history->getMotiuVisita(), PDO::PARAM_STR);
            $stmt->bindValue(":descripcio", $history->getDescripcio(), PDO::PARAM_STR);
            $stmt->bindValue(":pet_id", $history->getMascotaId(), PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            return FALSE;
        }
    }

    /**
     * Retrieves all history entries for a specific pet
     * 
     * @param int $petId Pet identifier
     * @return array Array of PetHistory objects, empty array if none found
     */
    public function findByPetId($petId): array {
        $history = array();

        if ($this->connect == NULL) {
            $_SESSION['error'] = "No s'ha pogut connectar amb la base de dades";
            return $history;
        }

        try {
            $sql = <<<SQL
                SELECT id, data, motiu_visita, descripcio, mascota_id
                FROM historial
                WHERE mascota_id = :petId
                ORDER BY data DESC, id DESC;
            SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":petId", $petId, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'PetHistory');
            $history = $stmt->fetchAll();
        } catch (PDOException $e) {
            return $history;
        }

        return $history;
    }

    /**
     * Updates an existing history entry
     * 
     * @param PetHistory $history History object with updated data
     * @return bool TRUE if update successful, FALSE otherwise
     */
    public function update(PetHistory $history): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "No s'ha pogut connectar amb la base de dades";
            return FALSE;
        }

        try {
            $sql = <<<SQL
                UPDATE historial 
                SET data = :data, 
                    motiu_visita = :motiu, 
                    descripcio = :descripcio
                WHERE id = :id;
            SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":data", $history->getData(), PDO::PARAM_STR);
            $stmt->bindValue(":motiu", $history->getMotiuVisita(), PDO::PARAM_STR);
            $stmt->bindValue(":descripcio", $history->getDescripcio(), PDO::PARAM_STR);
            $stmt->bindValue(":id", $history->getId(), PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return FALSE;
        }
    }

    /**
     * Deletes a history entry by ID
     * 
     * @param int $id History entry identifier
     * @return bool TRUE if delete successful, FALSE otherwise
     */
    public function delete($id): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "No s'ha pogut connectar amb la base de dades";
            return FALSE;
        }

        try {
            $sql = <<<SQL
                DELETE FROM historial WHERE id = :id;
            SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return FALSE;
        }
    }

    /**
     * Finds a single history entry by ID
     * 
     * @param int $id History entry identifier
     * @return PetHistory|null History object if found, NULL otherwise
     */
    public function findById($id) {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "No s'ha pogut connectar amb la base de dades";
            return NULL;
        }

        try {
            $sql = <<<SQL
                SELECT id, data, motiu_visita, descripcio, mascota_id
                FROM historial
                WHERE id = :id;
            SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'PetHistory');
                return $stmt->fetch();
            }
            return NULL;
        } catch (PDOException $e) {
            return NULL;
        }
    }

}
