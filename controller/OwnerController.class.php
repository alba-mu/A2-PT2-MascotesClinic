<?php
/**
 * File: OwnerController.class.php
 * Description: Controller for owner-related operations. Handles request routing and coordinates between
 * model (OwnerModel) and view (OwnerView). Manages form validation, database operations, and view rendering.
 */

require_once "view/OwnerView.class.php";
require_once "model/OwnerModel.class.php";
require_once "model/Owner.class.php";
require_once "util/OwnerMessage.class.php";
require_once "util/OwnerFormValidation.class.php";

/**
 * OwnerController - Controller for Owner Entity
 * Manages owner CRUD operations, form validation, and view rendering
 * Implements MVC pattern for owner-related functionality
 */
class OwnerController {

    private $view;
    private $model;

    public function __construct() {
        $this->view=new OwnerView();
        $this->model=new OwnerModel();
    }

    /**
     * Main request processor - routes requests to appropriate action methods
     * Handles both POST (form actions) and GET (menu options) requests
     * Initializes session arrays for info and error messages
     * 
     * @return void
     */
    public function processRequest() {
        
        $request=NULL;
        $_SESSION['info']=array();
        $_SESSION['error']=array();
        
        // Get action from POST request
        if (filter_has_var(INPUT_POST, 'action')) {
            $request=filter_has_var(INPUT_POST, 'action')?filter_input(INPUT_POST, 'action'):NULL;
        }
        // Get menu option from GET request
        else {
            $request=filter_has_var(INPUT_GET, 'option')?filter_input(INPUT_GET, 'option'):NULL;
        }
        
        switch ($request) {
            case "list_all":
                $this->listAll();
                break;
            case "form_search":
                $this->formListPets();
                break;
            case "list_pets":
                $this->listPets();
                break;
            case "form_modify":
                $this->formModify();
                break;
            case "modify":
                $this->modify();
                break;
            case "search":
                $this->searchById();
                break;
            default:
                $this->view->display();
        }
    }

    /**
     * Displays list of all owners from the database
     * Sets error message if no owners found
     * 
     * @return void
     */
    public function listAll() {
        $owners=$this->model->listAll();
        
        if (empty($owners)) {
            $_SESSION['error']=OwnerMessage::ERR_FORM['not_found'];
        }
        
        $this->view->display("view/form/OwnerList.php", $owners);
    }

    /**
     * Displays the search form for finding pets by owner ID
     * 
     * @return void
     */
    public function formListPets() {
        $this->view->display("view/form/OwnerFormSearchPets.php");
    }  


    /**
     * Executes action to search and display pets for a specific owner
     * Validates owner ID and retrieves associated pets
     * 
     * @return void
     */
    public function listPets() {
        $owner=$this->fetchOwnerFromRequest(true);

        $this->view->display("view/form/OwnerFormSearchPets.php", $owner);
    }

    /**
     * Displays the owner modification form (search + edit panel)
     * Allows user to enter owner ID to load their data
     * 
     * @return void
     */
    public function formModify() {
        $this->view->display("view/form/OwnerFormModify.php");
    }  

    /**
     * Executes action to save modified owner data
     * Validates email and mobile fields, updates database, reloads owner data
     * Sets success or error messages based on operation result
     * 
     * @return void
     */
    public function modify() {
        // Validar email y móvil, pero también obtener el ID del campo oculto
        $ownerInput=OwnerFormValidation::checkData(array_merge(OwnerFormValidation::MODIFY_FIELDS, array('id_hidden')));

        if (!empty($_SESSION['error'])) {
            $this->view->display("view/form/OwnerFormModify.php", $ownerInput);
            return;
        }

        $modified=$this->model->modify($ownerInput);

        if ($modified) {
            $_SESSION['info'][]=OwnerMessage::INF_FORM['update'];
        } else {
            $_SESSION['error'][]=OwnerMessage::ERR_DAO['update'];
        }

        // Recuperar todo el objeto para mostrar los datos actualizados
        $owner=$this->model->getOwnerById($ownerInput->getId(), false);

        $this->view->display("view/form/OwnerFormModify.php", $owner);  
    }

    
    

    /**
     * Executes action to search and display owner by ID
     * Used by modification form to load owner data for editing
     * 
     * @return void
     */
    public function searchById() {
        $owner=$this->fetchOwnerFromRequest(false);
            
        $this->view->display("view/form/OwnerFormModify.php", $owner);
    }

    /**
     * Private helper method to validate owner ID and fetch owner from database
     * Used by both search and list pets actions to avoid code duplication
     * Sets error message if owner not found
     * 
     * @param bool $withPets Whether to include associated pets in result
     * @return Owner|null Owner object if found and valid, NULL otherwise
     */
    private function fetchOwnerFromRequest(bool $withPets=false) {
        $ownerInput=OwnerFormValidation::checkData(OwnerFormValidation::SEARCH_FIELDS);

        if (!empty($_SESSION['error'])) {
            return NULL;
        }

        $owner=$this->model->getOwnerById($ownerInput->getId(), $withPets);

        if (is_null($owner)) {
            $_SESSION['error'][]=OwnerMessage::ERR_FORM['not_found'];
        }

        return $owner;
    }

    // shows home page
    public function showHome() {
        $this->view->display();
    }

}
