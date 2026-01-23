<?php
/**
 * File: PetMessage.class.php
 * Description: Message constants for pet-related operations and validation feedback.
 */
class PetMessage {

    const INF_FORM = array(
        'insert' => 'Dades inserides correctament',
        'update' => 'Dades actualitzades correctament',
        'delete' => 'Dades eliminades correctament',
        'found'  => 'Dades trobades',
        '' => ''
    );

    const ERR_FORM = array(
        'empty_id'       => 'L\'Id és obligatori',
        'invalid_id'     => 'L\'Id ha de ser un valor vàlid',
        'empty_nom'      => 'El nom és obligatori',
        'invalid_nom'    => 'El nom ha de ser un valor vàlid',
        'empty_owner'    => 'El propietari és obligatori',
        'invalid_owner'  => 'El propietari ha de ser un valor vàlid',
        'empty_date'     => 'La data és obligatòria',
        'invalid_date'   => 'La data ha de tenir format YYYY-MM-DD',
        'empty_motiu'    => 'El motiu és obligatori',
        'not_found'      => 'No s\'han trobat dades',
        '' => ''
    );

    const ERR_DAO = array(
        'insert' => 'Error en inserir les dades',
        'update' => 'Error en actualitzar les dades',
        'delete' => 'Error en eliminar les dades',
        '' => ''
    );
}
