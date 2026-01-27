<div id="content" class="container-fluid mt-4">
    <div class="container mb-4">
        <!-- Formulario único para añadir entrada al historial -->
        <form method="post" action="">
            <fieldset class="border-0 rounded-3 p-4 shadow-sm panel-light">
                <legend class="float-none w-auto px-3 py-2 rounded-2 text-white fw-bold legend-orange">
                    <i class="bi bi-plus-circle me-2"></i>Afegir entrada a l'historial
                </legend>

                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="mascota_id" class="form-label fw-semibold">
                            <i class="bi bi-hash me-1"></i>Id Mascota <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control border-0 shadow-sm" 
                            id="mascota_id" 
                            name="mascota_id" 
                            placeholder="Ex: 101" 
                            value="<?php echo isset($content) && $content != NULL ? $content->getId() : '' ; ?>"
                            required
                        />
                    </div>
                    <div class="col-md-3">
                        <label for="data" class="form-label fw-semibold">
                            <i class="bi bi-calendar3 me-1"></i>Data <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="date" 
                            class="form-control border-0 shadow-sm" 
                            id="data" 
                            name="data" 
                            required
                        />
                    </div>
                    <div class="col-md-3">
                        <label for="motiu" class="form-label fw-semibold">
                            <i class="bi bi-file-medical me-1"></i>Motiu Visita <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control border-0 shadow-sm" 
                            id="motiu" 
                            name="motiu_visita" 
                            placeholder="Ex: Revisió, Vacuna, etc." 
                            required
                        />
                    </div>
                    <div class="col-md-3">
                        <label for="descripcio" class="form-label fw-semibold">
                            <i class="bi bi-journal-text me-1"></i>Descripció <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control border-0 shadow-sm" 
                            id="descripcio" 
                            name="descripcio" 
                            placeholder="Descripció de la visita" 
                            required
                        />
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" name="action" value="add_history" class="btn btn-clinic-primary shadow fw-semibold">
                        Afegir entrada
                    </button>
                    <p class="text-muted small mt-3 mb-0">* Tots els camps són obligatoris</p>
                </div>
            </fieldset>
        </form>
    </div>
</div>
