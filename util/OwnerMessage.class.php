<?php
/**
 * File: OwnerMessage.class.php
 * Description: Message constants container for form validation and database operation feedback.
 * Provides multilingual (Catalan) messages for success and error notifications to be displayed to users.
 */

class OwnerMessage {

    const INF_FORM =
        array(
            'insert' => 'Dades inserides correctament',
            'update' => 'Dades actualitzades correctament',
            'delete' => 'Dades eliminades correctament',
            'found'  => 'Dades trobades',
            '' => ''
        );
    
    const ERR_FORM =
        array(
            'empty_id'      => 'L\'Id és obligatori',
            'empty_nom'    => 'El nom és obligatori',
            'empty_movil'    => 'El mòbil és obligatori',
            'empty_email'    => 'L\'email és obligatori',
            'invalid_id'    => 'L\'Id ha de ser un valor vàlid',
            'invalid_nom'  => 'El nom ha de ser un valor vàlid',
            'invalid_movil'  => 'El mòbil ha de ser un valor vàlid',
            'invalid_email'  => 'L\'email ha de ser un valor vàlid',
            'not_exists_id' => 'L\'Id no existeix',
            'not_found'     => 'No s\'han trobat dades',
            '' => ''
        );

    const ERR_DAO =
        array(
            'insert' => 'Error en inserir les dades',
            'update' => 'Error en actualitzar les dades',
            'delete' => 'Error en eliminar les dades',
            '' => ''
        );
    
}
