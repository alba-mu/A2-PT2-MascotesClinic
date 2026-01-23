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
        
        if (empty($owners)) {
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
        $owner=$this->fetchOwnerFromRequest(true);

        $this->view->display("view/form/OwnerFormSearchPets.php", $owner);
    }

    // carrega el formulari de modificar per id propietari
    public function formModify() {
        $this->view->display("view/form/OwnerFormModify.php");
    }  

    // executa l'acció de modificar propietari    
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

    
    

    // executa l'acció de buscar propietari per id de propietari
    public function searchById() {
        $owner=$this->fetchOwnerFromRequest(false);
            
        $this->view->display("view/form/OwnerFormModify.php", $owner);
    }

    // valida l'id rebut i retorna l'Owner amb o sense mascotes
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

    // mostra la pàgina d'inici
    public function showHome() {
        $this->view->display();
    }

}
