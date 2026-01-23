<?php
/**
 * File: MainController.class.php
 * Description: Main entry point controller that routes requests to appropriate sub-controllers.
 * Handles menu navigation and delegates to OwnerController for owner-related operations.
 */

require_once "controller/OwnerController.class.php";
//require_once "controller/PetController.class.php";

/**
 * MainController - Primary Request Router
 * Routes menu requests to appropriate controllers (Owner, Pet, etc.)
 */
class MainController {

    /**
     * Processes incoming requests and routes to appropriate controller
     * Retrieves menu selection from GET parameter and delegates to corresponding controller
     * Default route displays home page through OwnerController
     * 
     * @return void
     */
    public function processRequest() {

        $request=NULL;
        if (filter_has_var(INPUT_GET, 'menu')) {
            $request=filter_input(INPUT_GET, 'menu');
        }

        $controlLogin=NULL;
        switch ($request) {
            case "owner":
                $controlOwner=new OwnerController();
                $controlOwner->processRequest();
                break;

            //case "pet":
            //    $controlPet=new PetController();
            //    $controlPet->processRequest();
            //    break;

            default:
                $controlOwner=new OwnerController();
                $controlOwner->showHome();
                break;
        }

    }
    
}
