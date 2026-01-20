<div id="info" class="container mt-2">
    <?php
        if (is_array($_SESSION['info']) == TRUE) {
            foreach ($_SESSION['info'] as $info) {
                echo "<p class='alert alert-info'>$info</p>";
            }
        }
        else {
            echo "<p class='alert alert-info'>{$_SESSION['info']}</p>";          
        }
    ?>
</div>

<div id="error" class="container mt-2">
    <?php
        if (is_array($_SESSION['error']) == TRUE) {
            foreach ($_SESSION['error'] as $error) {
                echo "<p class='alert alert-danger'>$error</p>";
            }
        }
        else {
            echo "<p class='alert alert-danger'>{$_SESSION['error']}</p>";            
        }
    ?>
</div>
