<?php
/**
 * File: PetHistory.class.php
 * Description: Entity class representing a medical history entry for a pet.
 */
class PetHistory {
    private $id;
    private $data;
    private $motiu_visita;
    private $descripcio;
    private $mascota_id;

    public function __construct($id=NULL, $data=NULL, $motiu_visita=NULL, $descripcio=NULL, $mascota_id=NULL) {
        $this->id=$id;
        $this->data=$data;
        $this->motiu_visita=$motiu_visita;
        $this->descripcio=$descripcio;
        $this->mascota_id=$mascota_id;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id=$id; }

    public function getData() { return $this->data; }
    public function setData($data) { $this->data=$data; }

    public function getMotiuVisita() { return $this->motiu_visita; }
    public function setMotiuVisita($motiu_visita) { $this->motiu_visita=$motiu_visita; }

    public function getDescripcio() { return $this->descripcio; }
    public function setDescripcio($descripcio) { $this->descripcio=$descripcio; }

    public function getMascotaId() { return $this->mascota_id; }
    public function setMascotaId($mascota_id) { $this->mascota_id=$mascota_id; }
}
