<?php
/**
 * File: PetController.class.php
 * Description: Controller for pet-related operations. Handles request routing and coordinates between
 * model (PetModel) and view (PetView). Manages form validation, database operations, and view rendering.
 */

require_once "view/PetView.class.php";
require_once "model/PetModel.class.php";
require_once "model/Pet.class.php";
require_once "util/PetMessage.class.php";
require_once "util/PetFormValidation.class.php";

/**
 * PetController - Controller for Pet Entity
 * Manages pet CRUD operations, form validation, and view rendering
 * Implements MVC pattern for pet-related functionality
 */
class PetController {
    private $view;
    private $model;

    public function __construct() {
        $this->view=new PetView();
        $this->model=new PetModel();
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
            case "form_modify":
                $this->formModify();
                break;
            case "modify":
                $this->modify();
                break;
            case "search":
                $this->searchById();
                break;
            case "detail":
                $this->showDetail();
                break;
            case "add_history":
                $this->addHistory();
                break;
            default:
                $this->view->display();
        }
    }

    /**
     * Displays list of all pets from the database
     * Sets error message if no pets found
     * 
     * @return void
     */
    public function listAll() {
        $pets=$this->model->listAll();
        if (empty($pets)) {
            $_SESSION['error'][]=PetMessage::ERR_FORM['not_found'];
        }
        $data=array('pets'=>$pets, 'pet'=>NULL);
        $this->view->display("view/form/PetList.php", $data);
    }

    /**
     * Loads modify form, optionally with pet data if id (GET) is provided
     */
    public function formModify() {
        $pet=NULL;
        if (filter_has_var(INPUT_GET, 'id')) {
            $id=filter_input(INPUT_GET, 'id');
            $pet=$this->model->getPetById($id, false);
            if (is_null($pet)) {
                $_SESSION['error'][]=PetMessage::ERR_FORM['not_found'];
            }
        }
        $pets=$this->model->listAll();
        if (empty($pets)) {
            $_SESSION['error'][]=PetMessage::ERR_FORM['not_found'];
        }
        $data=array('pets'=>$pets, 'pet'=>$pet);
        $this->view->display("view/form/PetList.php", $data);
    }

    /**
     * Saves pet modifications
     */
    public function modify() {
        $petInput=PetFormValidation::validatePet();

        if (!empty($_SESSION['error'])) {
            $pets=$this->model->listAll();
            $data=array('pets'=>$pets, 'pet'=>$petInput);
            $this->view->display("view/form/PetList.php", $data);
            return;
        }

        $modified=$this->model->modify($petInput);

        if ($modified) {
            $_SESSION['info'][]=PetMessage::INF_FORM['update'];
        } else {
            $_SESSION['error'][]=PetMessage::ERR_DAO['update'];
        }

        $pets=$this->model->listAll();
        $pet=$this->model->getPetById($petInput->getId(), false);
        $data=array('pets'=>$pets, 'pet'=>$pet);
        $this->view->display("view/form/PetList.php", $data);
    }

    /**
     * Shows pet detail with owner and history
     */
    public function showDetail() {
        $pet=$this->fetchPetFromRequest(true);
        $this->view->display("view/form/PetDetail.php", $pet);
    }

    /**
     * Adds history entry for a pet
     */
    public function addHistory() {
        $history=PetFormValidation::validateHistory();

        if (!empty($_SESSION['error'])) {
            $pet=$this->model->getPetDetail($history->getMascotaId());
            $this->view->display("view/form/PetDetail.php", $pet);
            return;
        }

        $inserted=$this->model->addHistory($history);
        if ($inserted) {
            $_SESSION['info'][]=PetMessage::INF_FORM['insert'];
        } else {
            $_SESSION['error'][]=PetMessage::ERR_DAO['insert'];
        }

        $pet=$this->model->getPetDetail($history->getMascotaId());
        $this->view->display("view/form/PetDetail.php", $pet);
    }

    /**
     * Searches pet by id and loads modify form
     */
    public function searchById() {
        $pet=$this->fetchPetFromRequest(false);
        $pets=$this->model->listAll();
        $data=array('pets'=>$pets, 'pet'=>$pet);
        $this->view->display("view/form/PetList.php", $data);
    }

    private function fetchPetFromRequest(bool $withRelations=false) {
        $id=NULL;
        if (filter_has_var(INPUT_POST, 'id')) {
            $id=trim(filter_input(INPUT_POST, 'id'));
        } elseif (filter_has_var(INPUT_GET, 'id')) {
            $id=trim(filter_input(INPUT_GET, 'id'));
        }

        if ($id === '' || is_null($id) || preg_match(PetFormValidation::NUMERIC, $id)) {
            $_SESSION['error'][]=PetMessage::ERR_FORM['invalid_id'];
            return NULL;
        }

        $pet=$this->model->getPetById($id, $withRelations);
        if (is_null($pet)) {
            $_SESSION['error'][]=PetMessage::ERR_FORM['not_found'];
        }
        return $pet;
    }

    // shows home page
    public function showHome() {
        $this->view->display("view/HomePage.php");
    }

}
