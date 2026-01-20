<?php
require_once "view/OwnerView.class.php";
require_once "model/OwnerModel.class.php";
require_once "model/Owner.class.php";
require_once "util/OwnerMessage.class.php";
require_once "util/OwnerFormValidation.class.php";

class OwnerController {

    private $view;
    private $model;

    public function __construct() {
        // carrega la vista
        $this->view=new OwnerView();

        // carrega el model de dades
        $this->model=new OwnerModel();
    }

    // carrega la vista segons l'opció o executa una acció específica
    public function processRequest() {
        
        $request=NULL;
        $_SESSION['info']=array();
        $_SESSION['error']=array();
        
        // recupera l'acció d'un formulari
        if (filter_has_var(INPUT_POST, 'action')) {
            $request=filter_has_var(INPUT_POST, 'action')?filter_input(INPUT_POST, 'action'):NULL;
        }
        // recupera l'opció d'un menú
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

    // executa l'acció de mostrar tots els propietaris
    public function listAll() {
        $owners=$this->model->listAll();
        
        if (!empty($owners)) {
            $_SESSION['info']=OwnerMessage::INF_FORM['found'];
        }
        else {
            $_SESSION['error']=OwnerMessage::ERR_FORM['not_found'];
        }
        
        $this->view->display("view/form/OwnerList.php", $owners);
    }

    // carga el formulario de buscar mascotes per Id de propietari
    public function formListPets() {
        $this->view->display("view/form/OwnerFormSearchPets.php");
    }  


    // executa l'acció de buscar mascotes por id de propietari
    public function listPets() {
        $id=trim(filter_input(INPUT_POST, 'id'));

        $result=NULL;
        if (!empty($id)) {
            $result=$this->model->listPets($id);            
            if (!empty($result)) { 
                $_SESSION['info']="Data found"; 
            }
            else {
                $_SESSION['error']=OwnerMessage::ERR_FORM['not_found'];
            }
            
            $this->view->display("view/form/OwnerListPets.php", $result);
        }
        else {
            $_SESSION['error']=OwnerMessage::ERR_FORM['invalid_id'];
            
            $this->view->display("view/form/OwnerFormSearchPets.php", $result);
        }
    }

    // carrega el formulari de modificar per id propietari
    public function formModify() {
        $this->view->display("view/form/OwnerFormModify.php");
    }  

    // executa l'acció de modificar propietari    
    public function modify() {
        // TODO   
    }

    
    

    // executa l'acció de buscar propietari per id de propietari
    public function searchById() {
        $ownerValid=OwnerFormValidation::checkData(OwnerFormValidation::SEARCH_FIELDS);
        
        if (empty($_SESSION['error'])) {
            $owner=$this->model->searchById($ownerValid->getId());

            if (!is_null($owner)) { // is NULL or Owner object?
                $_SESSION['info']=OwnerMessage::INF_FORM['found'];
                $ownerValid=$owner;
            }
            else {
                $_SESSION['error']=OwnerMessage::ERR_FORM['not_found'];
            }
        }
            
        $this->view->display("view/form/OwnerSearchPets.php", $ownerValid);
    }    

    // mostra la pàgina d'inici
    public function showHome() {
        $this->view->display();
    }

}
