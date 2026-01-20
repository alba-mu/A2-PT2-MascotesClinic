<?php

class OwnerMessage {

    const INF_FORM =
        array(
            'insert' => 'Data inserted successfully',
            'update' => 'Data updated successfully',
            'delete' => 'Data deleted successfully',
            'found'  => 'Data found',
            '' => ''
        );
    
    const ERR_FORM =
        array(
            'empty_id'      => 'Id must be filled',
            'empty_nom'    => 'Name must be filled',
            'empty_movil'    => 'Mobile must be filled',
            'empty_email'    => 'Email must be filled',
            'invalid_id'    => 'Id must be valid values',
            'invalid_nom'  => 'Name must be valid values',
            'invalid_movil'  => 'Mobile must be valid values',
            'invalid_email'  => 'Email must be valid values',
            'not_exists_id' => 'Id not exists',
            'not_found'     => 'No data found',
            '' => ''
        );

    const ERR_DAO =
        array(
            'insert' => 'Error inserting data',
            'update' => 'Error updating data',
            'delete' => 'Error deleting data',
            '' => ''
        );
    
}
