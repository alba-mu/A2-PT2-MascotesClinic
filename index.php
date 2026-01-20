<?php
    session_start();

    $host = $_SERVER['HTTP_HOST']; // localhost
    $path = rtrim(dirname($_SERVER['PHP_SELF']), "/"); 
    $base = "http://" . $host . $path . "/";
    
    define("PATH_IMG", $base . "view/img/");
    define("PATH_JS", $base . "view/js/");
    
    require_once "controller/MainController.class.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mascotes Clinic</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
        <script src="<?=PATH_JS?>general-fn.js"></script>
    </head>
    <body>
        <div id="page">
            <header class="navbar navbar-expand-xl navbar-light bg-light">
                <a href="http://www.ies-provensana.com"><img src="<?=PATH_IMG?>proven.jpg" alt="proven.jpg" class="img" style="height:75px;"></a>
                <h4>Institut Provençana</h4>
            </header>
            <?php
                $controlMain=new MainController();
                $controlMain->processRequest();
            ?>
        </div>
    </body>
</html>