<?php

class OwnerFormValidation {

    const MODIFY_FIELDS = array('email','movil');
    const SEARCH_FIELDS = array('id');
    
    const NUMERIC = "/[^0-9]/";
    const EMAIL = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    const MOBILE = "/^[0-9]{9}$/";
    
    public static function checkData($fields) {
        $id=NULL;
        $email=NULL;
        $movil=NULL;
        
        foreach ($fields as $field) {
            switch ($field) {
                case 'id':
                    $id=trim(filter_input(INPUT_POST, 'id'));
                    $idValid=!preg_match(self::NUMERIC, $id);
                    if ($id === '') {
                        array_push($_SESSION['error'], OwnerMessage::ERR_FORM['empty_id']);
                    }
                    else if ($idValid == FALSE) {
                        array_push($_SESSION['error'], OwnerMessage::ERR_FORM['invalid_id']);
                    }
                    break;
                case 'id_hidden':
                    // Obtener ID del campo oculto cuando se guarda
                    $id=trim(filter_input(INPUT_POST, 'id_hidden'));
                    if ($id === '') {
                        array_push($_SESSION['error'], 'ID del propietari no disponible');
                    }
                    break;
                case 'email':
                    $email=trim(filter_input(INPUT_POST, 'email'));
                    $emailValid=preg_match(self::EMAIL, $email);
                    if (empty($email)) {
                        array_push($_SESSION['error'], OwnerMessage::ERR_FORM['empty_email']);
                    }
                    else if ($emailValid == FALSE) {
                        array_push($_SESSION['error'], OwnerMessage::ERR_FORM['invalid_email']);
                    }
                    break;
                case 'movil':
                    $movil=trim(filter_input(INPUT_POST, 'movil'));
                    $movilValid=preg_match(self::MOBILE, $movil);
                    if (empty($movil)) {    
                        array_push($_SESSION['error'], OwnerMessage::ERR_FORM['empty_movil']);
                    }
                    else if ($movilValid == FALSE) {
                        array_push($_SESSION['error'], OwnerMessage::ERR_FORM['invalid_movil']);
                    }
                    break;
            }
        }
        
        // only id/email/movil are collected; name stays null to avoid misaligned fields
        $owner=new Owner($id, NULL, $email, $movil);
        
        return $owner;
    }
    
}
