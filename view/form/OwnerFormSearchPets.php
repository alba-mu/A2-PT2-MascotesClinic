<div id="content" class="container mt-4">
    <form method="post" action="">
        <fieldset class="border rounded p-4">
            <legend class="float-none w-auto px-2 fs-3">Buscador de mascotes registrades per Id de propietari</legend>

            <div class="mb-3">
                <label for="idField" class="form-label fw-bold">Id <span class="text-danger">*</span></label>
                <input
                    type="text"
                    class="form-control"
                    id="idField"
                    placeholder="Id"
                    name="id"
                    value="<?php if (isset($content)) { echo $content->getId(); } ?>"
                />
            </div>

            

            <p class="text-danger fst-italic">* Required fields</p>

            <button type="submit" name="action" value="list_pets" class="btn btn-primary me-2">
                Search
            </button>

        </fieldset>
    </form>

    <div>
        <?php
            if (isset($content)) {
                echo <<<EOT
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Id</th>
                                    <th>Nom</th>
                                </tr>
                            </thead>
                            <tbody>
                EOT;
                foreach ($content->getPetsList() as $pet) {
                    echo <<<EOT
                                <tr>
                                    <td>{$pet->getId()}</td>
                                    <td>{$pet->getNom()}</td>
                                </tr>
                EOT;
                }
                echo <<<EOT
                            </tbody>
                        </table>
                    </div>
                EOT;
            }
        ?>
    </div>
</div>