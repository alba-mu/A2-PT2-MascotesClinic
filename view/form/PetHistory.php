<?php
/**
 * File: PetHistory.php
 * Description: Form to add a new medical history entry for a pet.
 * Collects visit date, reason, and detailed description of the medical visit.
 */
?>
<div id="content" class="container-fluid mt-4">
    <div class="container mb-4">
        <form method="post" action="">
            <fieldset class="border-0 rounded-3 p-4 shadow-sm panel-light h-100">
                <legend class="float-none w-auto px-3 py-2 mb-4 rounded-2 text-white fw-bold legend-primary">
                    <i class="bi bi-plus-circle me-2"></i>Afegir entrada a l'historial
                </legend>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="pet_id" class="form-label fw-semibold label-primary">
                            <i class="bi bi-hash me-1"></i>Id Mascota <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control border-2 shadow-sm input-standard 
                            id="pet_id" 
                            name="pet_id" 
                            placeholder="Ex: 101" 
                            value="<?php 
                                if (isset($content)) {
                                    // If it is a PetHistory object (validation error)
                                    if (is_object($content) && method_exists($content, 'getMascotaId')) {
                                        echo $content->getMascotaId();
                                    }
                                    // If it is a Pet object (with relations)
                                    elseif (is_object($content) && method_exists($content, 'getId')) {
                                        echo $content->getId();
                                    }
                                }
                            ?>"
                            required
                        />
                    </div>
                    <div class="col-md-6">
                        <label for="data" class="form-label fw-semibold label-primary">
                            <i class="bi bi-calendar3 me-1"></i>Data de la visita <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="date" 
                            class="form-control border-2 shadow-sm input-standard " 
                            id="data" 
                            name="data" 
                            value="<?php 
                                if (isset($content) && is_object($content) && method_exists($content, 'getData')) {
                                    echo $content->getData();
                                }
                            ?>"
                            required
                        />
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <label for="motiu" class="form-label fw-semibold label-primary">
                            <i class="bi bi-file-medical me-1"></i>Motiu de la visita <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control border-2 shadow-sm input-standard " 
                            id="motiu" 
                            name="motiu" 
                            placeholder="Ex: Revisió, Vacuna, Tractament, etc." 
                            value="<?php 
                                if (isset($content) && is_object($content) && method_exists($content, 'getMotiuVisita')) {
                                    echo htmlspecialchars($content->getMotiuVisita());
                                }
                            ?>"
                            required
                        />
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <label for="descripcio" class="form-label fw-semibold label-primary">
                            <i class="bi bi-journal-text me-1"></i>Descripció de la visita <span class="text-danger">*</span>
                        </label>
                        <textarea 
                            class="form-control border-2 shadow-sm input-standard " 
                            id="descripcio" 
                            name="descripcio" 
                            placeholder="Introduïu una descripció detallada de la visita, diagnòstic, tractament aplicat, etc."
                            rows="5"
                            required
                        ><?php 
                            if (isset($content) && is_object($content) && method_exists($content, 'getDescripcio')) {
                                echo htmlspecialchars($content->getDescripcio());
                            }
                        ?></textarea>
                        <small class="text-muted d-block mt-2">
                            <i class="bi bi-info-circle me-1"></i>Podeu afegir detalls addicionals sobre la visita
                        </small>
                    </div>
                </div>

                <p class="text-danger fst-italic small mb-3"><i class="bi bi-info-circle me-1"></i>* Camps obligatoris</p>

                <button type="submit" name="action" value="add_history" class="btn btn-clinic-primary btn-lg w-100 shadow fw-semibold">
                    <i class="bi bi-check-circle me-2"></i>Afegir entrada al historial
                </button>
            </fieldset>
        </form>
    </div>
</div>
