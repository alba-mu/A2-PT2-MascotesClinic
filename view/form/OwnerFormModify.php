<div id="content" class="container mt-4">
    <form method="post" action="">
        <fieldset class="border rounded p-4">
            <legend class="float-none w-auto px-2 fs-3">Modificar dades de propietari</legend>

            <div class="mb-3">
                <label for="idField" class="form-label fw-bold">Id <span class="text-danger">*</span></label>
                <input
                    type="text"
                    class="form-control"
                    id="idField"
                    placeholder="Id"
                    name="id"
                    value="<?php if (isset($content)) { echo $content->getId(); } ?>"
                    <?php if (isset($content)) { echo "readonly"; } ?>
                />
            </div>

            <div class="mb-3">
                <label for="nameField" class="form-label fw-bold">Nom <span class="text-danger"></span></label>
                <input
                    type="text"
                    class="form-control"
                    id="nameField"
                    placeholder="Nom"
                    name="name"
                    value="<?php if (isset($content)) { echo $content->getName(); } ?>"
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
                    value="<?php if (isset($content)) { echo $content->getEmail(); } ?>"
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
                    value="<?php if (isset($content)) { echo $content->getMovil(); } ?>"
                />
            </div>

            <p class="text-danger fst-italic">* Camps obligatoris</p>

            <button type="submit" name="action" value="modify" class="btn btn-primary me-2">
                Guardar canvis
            </button>
        </fieldset>
    </form>
</div>
