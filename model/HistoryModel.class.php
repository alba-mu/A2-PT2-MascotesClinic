<?php
/**
 * File: HistoryModel.class.php
 * Description: Business logic layer for history operations. Acts as intermediary between controller and database layer.
 * Provides methods for managing pet medical history.
 */

require_once "model/persist/HistoryDbDAO.class.php";

/**
 * HistoryModel - Business Logic Layer
 * Manages history-related operations and delegates database operations to HistoryDbDAO
 */
class HistoryModel {

    private $dataHistory;

    public function __construct() {        
        // Database
        $this->dataHistory = HistoryDbDAO::getInstance();
    }

    /**
     * Insert a new history entry
     * @param PetHistory $history History object to insert
     * @return bool TRUE or FALSE
     */
    public function insert(PetHistory $history): bool {
        return $this->dataHistory->insert($history);
    }

    /**
     * Get all history entries for a pet
     * @param int $petId Pet identifier
     * @return array Array of PetHistory objects or empty array
     */
    public function getByPetId($petId): array {
        return $this->dataHistory->findByPetId($petId);
    }

    /**
     * Update an existing history entry
     * @param PetHistory $history History object with updated data
     * @return bool TRUE or FALSE
     */
    public function update(PetHistory $history): bool {
        return $this->dataHistory->update($history);
    }

    /**
     * Delete a history entry
     * @param int $id History entry identifier
     * @return bool TRUE or FALSE
     */
    public function delete($id): bool {
        return $this->dataHistory->delete($id);
    }

    /**
     * Get a single history entry by ID
     * @param int $id History entry identifier
     * @return PetHistory|null History object or NULL
     */
    public function getById($id) {
        return $this->dataHistory->findById($id);
    }

}
