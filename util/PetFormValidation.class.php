<?php
/**
 * File: PetFormValidation.class.php
 * Description: Form validation utility class for pet and history entry forms.
 * Validates pet data (ID, name, owner ID) and history entry data (date, reason, description).
 * Uses regex patterns to ensure data integrity before database operations.
 */
require_once "util/PetMessage.class.php";
require_once "model/Pet.class.php";
require_once "model/PetHistory.class.php";

/**
 * PetFormValidation - Validation Utilities
 * Provides static methods for validating pet and history form inputs
 * Stores validation errors in $_SESSION['error'] array
 */
class PetFormValidation {

    const MODIFY_FIELDS = array('id', 'nom', 'owner_id');
    const HISTORY_FIELDS = array('pet_id', 'data', 'motiu', 'descripcio');

    const NUMERIC = "/[^0-9]/";
    const NAME = "/^[A-Za-zÀ-ÿ0-9 '´`-]{1,150}$/";
    const DATE = "/^\\d{4}-\\d{2}-\\d{2}$/";

    /**
     * Validates pet modification form data
     * Checks ID, name, and owner ID fields
     * 
     * @return Pet Validated Pet object with form data
     */
    public static function validatePet(): Pet {
        $id = trim(filter_input(INPUT_POST, 'id'));
        $nom = trim(filter_input(INPUT_POST, 'nom'));
        $ownerId = trim(filter_input(INPUT_POST, 'owner_id'));

        if ($id === '' || preg_match(self::NUMERIC, $id)) {
            $_SESSION['error'][] = PetMessage::ERR_FORM['invalid_id'];
        }

        if (empty($nom)) {
            $_SESSION['error'][] = PetMessage::ERR_FORM['empty_nom'];
        } elseif (!preg_match(self::NAME, $nom)) {
            $_SESSION['error'][] = PetMessage::ERR_FORM['invalid_nom'];
        }

        if ($ownerId === '' || preg_match(self::NUMERIC, $ownerId)) {
            $_SESSION['error'][] = PetMessage::ERR_FORM['invalid_owner'];
        }

        return new Pet($id, $nom, $ownerId);
    }

    /**
     * Validates history entry form data
     * Checks pet ID, date, reason, and description fields
     * 
     * @return PetHistory Validated PetHistory object with form data
     */
    public static function validateHistory(): PetHistory {
        $petId = trim(filter_input(INPUT_POST, 'pet_id'));
        $date = trim(filter_input(INPUT_POST, 'data'));
        $motiu = trim(filter_input(INPUT_POST, 'motiu'));
        $descripcio = trim(filter_input(INPUT_POST, 'descripcio'));

        if ($petId === '' || preg_match(self::NUMERIC, $petId)) {
            $_SESSION['error'][] = PetMessage::ERR_FORM['invalid_id'];
        }

        if (empty($date)) {
            $_SESSION['error'][] = PetMessage::ERR_FORM['empty_date'];
        } elseif (!preg_match(self::DATE, $date)) {
            $_SESSION['error'][] = PetMessage::ERR_FORM['invalid_date'];
        }

        if (empty($motiu)) {
            $_SESSION['error'][] = PetMessage::ERR_FORM['empty_motiu'];
        }

        $history = new PetHistory(NULL, $date, $motiu, $descripcio, $petId);
        return $history;
    }
}
