<div id="content" class="container mt-4">
    <form method="post" action="">
        <fieldset class="border rounded p-4">
            <legend class="float-none w-auto px-2 fs-3">Modificar dades de propietari</legend>

            <!-- Sección de búsqueda por ID -->
            <div class="mb-4 pb-3 border-bottom">
                <h5 class="mb-3">Buscar propietari</h5>
                <div class="mb-3">
                    <label for="searchIdField" class="form-label fw-bold">Id <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        class="form-control"
                        id="searchIdField"
                        placeholder="Introdueix l'ID del propietari"
                        name="id"
                        value="<?php if (isset($content) && $content != NULL) { echo $content->getId(); } ?>"
                    />
                </div>
                <button type="submit" name="action" value="search" class="btn btn-secondary me-2">
                    Buscar
                </button>
            </div>

            <!-- Sección de modificación de datos -->
            <div class="mb-4">
                <h5 class="mb-3">Dades del propietari</h5>

                <!-- Campo ID oculto para enviar en el formulario de guardar -->
                <input type="hidden" name="id_hidden" value="<?php if (isset($content) && $content != NULL) { echo $content->getId(); } ?>" />

                <div class="mb-3">
                    <label for="idField" class="form-label fw-bold">Id</label>
                    <input
                        type="text"
                        class="form-control"
                        id="idField"
                        name="id_display"
                        value="<?php if (isset($content) && $content != NULL) { echo $content->getId(); } else { echo '-'; } ?>"
                        readonly
                    />
                </div>

                <div class="mb-3">
                    <label for="nomField" class="form-label fw-bold">Nom</label>
                    <input
                        type="text"
                        class="form-control"
                        id="nomField"
                        name="nom"
                        value="<?php if (isset($content) && $content != NULL) { echo $content->getNom(); } else { echo '-'; } ?>"
                        readonly
                    />
                </div>

                <div class="mb-3">
                    <label for="emailField" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                    <input
                        type="email"
                        class="form-control"
                        id="emailField"
                        placeholder="Email"
                        name="email"
                        value="<?php if (isset($content) && $content != NULL) { echo $content->getEmail(); } ?>"
                        <?php if (!isset($content) || $content == NULL) { echo 'disabled'; } ?>
                    />
                </div>

                <div class="mb-3">
                    <label for="movilField" class="form-label fw-bold">Mòbil <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        class="form-control"
                        id="movilField"
                        placeholder="999999999"
                        name="movil"
                        value="<?php if (isset($content) && $content != NULL) { echo $content->getMovil(); } ?>"
                        <?php if (!isset($content) || $content == NULL) { echo 'disabled'; } ?>
                    />
                </div>

                <p class="text-danger fst-italic">* Camps obligatoris</p>

                <button type="submit" name="action" value="modify" class="btn btn-primary me-2" <?php if (!isset($content) || $content == NULL) { echo 'disabled'; } ?>>
                    Guardar canvis
                </button>
            </div>
        </fieldset>
    </form>
</div>
