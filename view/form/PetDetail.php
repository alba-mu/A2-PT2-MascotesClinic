<div id="content" class="container-fluid mt-4">
    <div class="container mb-4">
        <!-- Formulario de búsqueda (arriba, full width) -->
        <form method="post" action="">
            <div class="row">
                <div class="col-12">
                    <fieldset class="border-0 rounded-3 p-4 shadow-sm panel-search">
                        <legend class="float-none w-auto px-3 py-2 rounded-2 text-white fw-bold legend-orange">
                            <i class="bi bi-search me-2"></i>Cercar mascota
                        </legend>

                        <div class="row align-items-end">
                            <div class="col-sm-9">
                                <label for="idField" class="form-label label-white fw-semibold">
                                    <i class="bi bi-hash me-1"></i>Id Mascota <span class="text-warning">*</span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control border-0 shadow-sm input-search"
                                    id="idField"
                                    placeholder="Introdueix l'ID de la mascota"
                                    name="id"
                                    value="<?php if (isset($content) && $content != NULL) { echo $content->getId(); } ?>"
                                />
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" name="action" value="detail" class="btn btn-clinic-search btn-sm-lg w-100 shadow fw-semibold">
                                    <i class="bi bi-search me-2"></i>Cercar
                                </button>
                            </div>
                        </div>
                        
                        <p class="text-white-50-custom fst-italic small mt-3 mb-0">* Camp obligatori</p>
                    </fieldset>
                </div>
            </div>
        </form>

        <?php if (isset($content) && $content != NULL): ?>
            <!-- Información de mascota y propietario (lado a lado) -->
            <div class="row g-4 mb-4">
                <!-- Información básica de la mascota -->
                <div class="col-12 col-lg-6">
                    <fieldset class="border-0 rounded-3 p-4 shadow-sm panel-light h-100">
                        <legend class="float-none w-auto px-3 py-2 rounded-2 text-white fw-bold legend-primary">
                            <i class="bi bi-heart-fill me-2"></i>Informació de la mascota
                        </legend>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-1 text-muted small"><i class="bi bi-hash me-1"></i>ID</p>
                                    <p class="mb-0 fw-bold fs-5" style="color: #469387;"><?php echo $content->getId(); ?></p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-1 text-muted small"><i class="bi bi-tag-fill me-1"></i>Nom</p>
                                    <p class="mb-0 fw-bold fs-5"><?php echo $content->getNom(); ?></p>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <!-- Información del propietario -->
                <div class="col-12 col-lg-6">
                    <?php if ($content->getOwner() != NULL): 
                        $owner = $content->getOwner();
                    ?>
                    <fieldset class="border-0 rounded-3 p-4 shadow-sm panel-light h-100">
                        <legend class="float-none w-auto px-3 py-2 rounded-2 text-white fw-bold legend-accent">
                            <i class="bi bi-person-fill me-2"></i>Informació del propietari
                        </legend>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-1 text-muted small"><i class="bi bi-hash me-1"></i>ID</p>
                                    <p class="mb-0 fw-semibold"><?php echo $owner->getId(); ?></p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-1 text-muted small"><i class="bi bi-person me-1"></i>Nom</p>
                                    <p class="mb-0 fw-semibold"><?php echo $owner->getNom(); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-1 text-muted small"><i class="bi bi-envelope me-1"></i>Email</p>
                                    <p class="mb-0 fw-semibold"><?php echo $owner->getEmail(); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-1 text-muted small"><i class="bi bi-phone me-1"></i>Mòbil</p>
                                    <p class="mb-0 fw-semibold"><?php echo $owner->getMovil(); ?></p>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <?php else: ?>
                    <fieldset class="border-0 rounded-3 p-4 shadow-sm panel-light h-100">
                        <legend class="float-none w-auto px-3 py-2 rounded-2 text-white fw-bold legend-accent">
                            <i class="bi bi-person-fill me-2"></i>Informació del propietari
                        </legend>
                        <div class="alert-clinic-info">
                            <i class="bi bi-info-circle me-2"></i>No hi ha informació del propietari.
                        </div>
                    </fieldset>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Historial médico (abajo, full width) -->
            <div class="row">
                <div class="col-12">
                    <fieldset class="border-0 rounded-3 p-4 shadow-sm panel-light">
                        <legend class="float-none w-auto px-3 py-2 rounded-2 text-white fw-bold legend-orange">
                            <i class="bi bi-clipboard2-pulse-fill me-2"></i>Historial mèdic
                        </legend>
                        
                        <?php 
                        $history = $content->getHistory();
                        if (!empty($history)): 
                        ?>
                            <div class="table-responsive">
                                <table class="table-clinic">
                                    <thead>
                                        <tr>
                                            <th class="py-3"><i class="bi bi-hash me-1"></i>ID</th>
                                            <th class="py-3"><i class="bi bi-calendar3 me-1"></i>Data</th>
                                            <th class="py-3"><i class="bi bi-file-medical me-1"></i>Motiu Visita</th>
                                            <th class="py-3"><i class="bi bi-journal-text me-1"></i>Descripció</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($history as $entry): ?>
                                        <tr>
                                            <td class="py-3 fw-semibold" style="color: #469387;"><?php echo $entry->getId(); ?></td>
                                            <td class="py-3"><?php echo $entry->getData(); ?></td>
                                            <td class="py-3"><?php echo $entry->getMotiuVisita(); ?></td>
                                            <td class="py-3"><?php echo $entry->getDescripcio(); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert-clinic-info">
                                <i class="bi bi-info-circle me-2"></i>No hi ha entrades d'historial per aquesta mascota.
                            </div>
                        <?php endif; ?>
                    </fieldset>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>