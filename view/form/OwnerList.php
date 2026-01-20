<div id="content" class="container mt-4">
    <fieldset class="border rounded p-4">
        <legend class="float-none w-auto px-2 fs-3">Llistat de propietaris</legend>

        <?php
            if (isset($content)) {
                echo <<<EOT
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Id</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Mòvil</th>
                                </tr>
                            </thead>
                            <tbody>
EOT;
                foreach ($content as $owner) {
                    echo <<<EOT
                                <tr>
                                    <td>{$owner->getId()}</td>
                                    <td>{$owner->getNom()}</td>
                                    <td>{$owner->getEmail()}</td>
                                    <td>{$owner->getMovil()}</td>
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
    </fieldset>
</div>