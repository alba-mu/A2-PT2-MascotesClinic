<?php
require_once "controller/OwnerController.class.php";
require_once "controller/PetController.class.php";

class MainController {

    // carga la vista segons l'opció
    public function processRequest() {

        $request=NULL;
        // recupera l'opció del menú
        if (filter_has_var(INPUT_GET, 'menu')) {
            $request=filter_input(INPUT_GET, 'menu');
        }

        $controlLogin=NULL;
        switch ($request) {
            // propietaris
            case "owner":
                $controlOwner=new OwnerController();
                $controlOwner->processRequest();
                break;

            // pet
            case "pet":
                $controlPet=new PetController();
                $controlPet->processRequest();
                break;
                
            default:
                // TODO: pàgina d'inici
                break;
        }

    }
    
}
