<?php
    $pets=array();
    $petToEdit=NULL;

    if (isset($content)) {
        if (is_array($content) && array_key_exists('pets', $content)) {
            $pets=$content['pets'];
            if (array_key_exists('pet', $content)) {
                $petToEdit=$content['pet'];
            }
        } else {
            $pets=$content;
        }
    }
    $hasPet=!is_null($petToEdit);
?>

<div id="content" class="container-fluid mt-4">
    <div class="container">
        <div class="row g-4">
            <div class="col-12 col-lg-7">
                <fieldset class="border-0 rounded-3 p-4 shadow-sm panel-primary h-100">
                    <legend class="float-none w-auto px-3 py-2 mb-4 rounded-2 text-white fw-bold legend-large">
                        <i class="bi bi-heart-fill me-2"></i>Llistat de mascotes
                    </legend>

                    <?php
                        if (!empty($pets)) {
                            echo <<<EOT
                                <div class="table-responsive">
                                    <table class="table-clinic">
                                        <thead>
                                            <tr>
                                                <th class="py-3"><i class="bi bi-hash me-1"></i>Id</th>
                                                <th class="py-3"><i class="bi bi-tag-fill me-1"></i>Nom</th>
                                                <th class="py-3"><i class="bi bi-person-badge me-1"></i>Propietari</th>
                                                <th class="py-3 text-center"><i class="bi bi-gear-fill me-1"></i>Accions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
EOT;
                            foreach ($pets as $pet) {
                                echo <<<EOT
                                            <tr>
                                                <td class="py-3 fw-semibold icon-primary">{$pet->getId()}</td>
                                                <td class="py-3">{$pet->getNom()}</td>
                                                <td class="py-3"><span class="badge rounded-pill badge-clinic-email">{$pet->getPropietariId()}</span></td>
                                                <td class="py-3 text-center">
                                                    <a href="?menu=pet&option=form_modify&id={$pet->getId()}" class="btn btn-sm btn-clinic-primary" title="Modificar mascota">
                                                        <i class="bi bi-pencil-square me-1"></i>Modificar
                                                    </a>
                                                </td>
                                            </tr>
EOT;
                            }
                            echo <<<EOT
                                        </tbody>
                                    </table>
                                </div>
EOT;
                        } else {
                                echo '<div class="alert border-0 shadow-sm text-center alert-clinic-info">
                                    <i class="bi bi-info-circle me-2 info-icon"></i>
                                    <p class="mb-0">No hi ha mascotes registrades.</p>
                                  </div>';
                        }
                    ?>
                </fieldset>
            </div>

            <div class="col-12 col-lg-5">
                <form method="post" action="">
                    <fieldset class="border-0 rounded-3 p-4 shadow-sm panel-light h-100">
                        <legend class="float-none w-auto px-3 py-2 mb-4 rounded-2 text-white fw-bold legend-primary">
                            <i class="bi bi-pencil-square me-2"></i>Editar mascota
                        </legend>

                        <input type="hidden" name="action" value="modify" />
                        <input type="hidden" name="id" value="<?php echo $hasPet ? $petToEdit->getId() : ''; ?>" />

                        <div class="mb-3">
                            <label for="petIdField" class="form-label fw-semibold label-primary">
                                <i class="bi bi-hash me-1"></i>Id
                            </label>
                            <input
                                type="text"
                                class="form-control border-2 bg-light input-readonly"
                                id="petIdField"
                                name="id_display"
                                value="<?php echo $hasPet ? $petToEdit->getId() : '-'; ?>"
                                readonly
                            />
                        </div>

                        <div class="mb-3">
                            <label for="petNameField" class="form-label fw-semibold label-primary">
                                <i class="bi bi-tag-fill me-1"></i>Nom <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                class="form-control border-2 shadow-sm <?php echo $hasPet ? 'input-editable' : 'input-readonly'; ?>"
                                id="petNameField"
                                placeholder="Nom de la mascota"
                                name="nom"
                                value="<?php echo $hasPet ? $petToEdit->getNom() : ''; ?>"
                                <?php if (!$hasPet) { echo 'disabled'; } ?>
                            />
                        </div>

                        <div class="mb-4">
                            <label for="ownerField" class="form-label fw-semibold label-primary">
                                <i class="bi bi-person-badge me-1"></i>Id propietari <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                class="form-control border-2 shadow-sm <?php echo $hasPet ? 'input-editable' : 'input-readonly'; ?>"
                                id="ownerField"
                                placeholder="Ex: 1"
                                name="owner_id"
                                value="<?php echo $hasPet ? $petToEdit->getPropietariId() : ''; ?>"
                                <?php if (!$hasPet) { echo 'disabled'; } ?>
                            />
                        </div>

                        <p class="text-danger fst-italic small mb-3"><i class="bi bi-info-circle me-1"></i>* Camps obligatoris</p>

                        <button type="submit" class="btn btn-clinic-primary btn-lg w-100 shadow fw-semibold" <?php if (!$hasPet) { echo 'disabled'; } ?>>
                            <i class="bi bi-check-circle me-2"></i>Guardar canvis
                        </button>

                        <?php if (!$hasPet) { echo '<p class="text-muted fst-italic small mt-3 mb-0">Seleccioneu una mascota per editar-la.</p>'; } ?>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>