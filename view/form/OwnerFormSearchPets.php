<div id="content" class="container-fluid mt-4">
    <div class="container">
        <form method="post" action="">
            <div class="row g-4">
                <!-- Sección de búsqueda por ID (izquierda) -->
                <div class="col-12 col-md-5 col-lg-4">
                    <fieldset class="border-0 rounded-3 p-4 h-100 shadow-sm panel-search">
                        <legend class="float-none w-auto px-3 py-2 mb-3 rounded-2 text-white fw-bold legend-orange">
                            <i class="bi bi-search me-2"></i>Buscar propietari
                        </legend>

                        <div class="mb-3">
                            <label for="idField" class="form-label label-white fw-semibold">
                                <i class="bi bi-person-badge me-1"></i>Id <span class="text-warning">*</span>
                            </label>
                            <input
                                type="text"
                                class="form-control form-control-lg border-0 shadow-sm input-search"
                                id="idField"
                                placeholder="Introdueix l'ID"
                                name="id"
                                value="<?php if (isset($content) && $content != NULL) { echo $content->getId(); } ?>"
                            />
                        </div>

                        <button type="submit" name="action" value="list_pets" class="btn btn-clinic-search btn-lg w-100 shadow fw-semibold">
                            <i class="bi bi-search me-2"></i>Buscar
                        </button>
                        
                        <p class="text-white-50-custom fst-italic small mt-3 mb-0">* Camp obligatori</p>
                    </fieldset>
                </div>

                <!-- Sección de mascotas (derecha) -->
                <div class="col-12 col-md-7 col-lg-8">
                    <fieldset class="border-0 rounded-3 p-4 shadow-sm panel-light">
                        <legend class="float-none w-auto px-3 py-2 mb-4 rounded-2 text-white fw-bold legend-primary">
                            <i class="bi bi-heart-fill me-2"></i>Mascotes del propietari
                        </legend>

                        <?php
                            if (isset($content) && $content != NULL && !empty($content->getPetsList())) {
                                echo <<<EOT
                                    <div class="table-responsive">
                                        <table class="table-clinic">
                                            <thead>
                                                <tr>
                                                    <th class="py-3"><i class="bi bi-hash me-1"></i>Id</th>
                                                    <th class="py-3"><i class="bi bi-tag-fill me-1"></i>Nom</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                EOT;
                                foreach ($content->getPetsList() as $pet) {
                                    echo <<<EOT
                                                <tr>
                                                    <td class="py-3 fw-semibold" style="color: #469387;">{$pet->getId()}</td>
                                                    <td class="py-3">{$pet->getNom()}</td>
                                                </tr>
                                    EOT;
                                }
                                echo <<<EOT
                                            </tbody>
                                        </table>
                                    </div>
                                EOT;
                            } else if (isset($content) && $content != NULL) {
                                echo '<div class="alert-clinic-info">
                                        <i class="bi bi-info-circle me-2"></i>No hi ha mascotes registrades per aquest propietari.
                                      </div>';
                            } else {
                                echo '<div class="text-center py-5 text-muted">
                                        <i class="bi bi-arrow-left-circle icon-light-blue"></i>
                                        <p class="mt-3">Introdueix un ID per veure les mascotes</p>
                                      </div>';
                            }
                        ?>
                    </fieldset>
                </div>
            </div>
        </form>
    </div>
</div>