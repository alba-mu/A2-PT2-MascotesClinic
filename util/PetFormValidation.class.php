<?php
/**
 * File: PetFormValidation.class.php
 * Description: Validation utilities for pet forms and history entries.
 */
require_once "util/PetMessage.class.php";
require_once "model/Pet.class.php";
require_once "model/PetHistory.class.php";

class PetFormValidation {

    const MODIFY_FIELDS = array('id', 'nom', 'owner_id');
    const HISTORY_FIELDS = array('pet_id', 'data', 'motiu', 'descripcio');

    const NUMERIC = "/[^0-9]/";
    const NAME = "/^[A-Za-zÀ-ÿ0-9 '´`-]{1,150}$/";
    const DATE = "/^\\d{4}-\\d{2}-\\d{2}$/";

    /**
     * Validate pet modification data
     * @return Pet Validated Pet object
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
     * Validate history entry data
     * @return PetHistory Validated PetHistory object
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
