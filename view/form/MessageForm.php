<?php
/**
 * File: MessageForm.php
 * Description: Displays success and error messages from session variables.
 * Shows styled alert boxes for user feedback on operations.
 */
?>
<div id="info" class="container mt-3">
    <?php
        if (!empty($_SESSION['info'])) {
            if (is_array($_SESSION['info'])) {
                foreach ($_SESSION['info'] as $info) {
                    echo "<div class='alert border-0 shadow-sm d-flex align-items-center alert-clinic-success'>
                            <i class='bi bi-check-circle-fill me-3' style='font-size: 1.5rem;'></i>
                            <span class='fw-semibold'>$info</span>
                          </div>";
                }
            } else {
                echo "<div class='alert border-0 shadow-sm d-flex align-items-center alert-clinic-success'>
                        <i class='bi bi-check-circle-fill me-3' style='font-size: 1.5rem;'></i>
                        <span class='fw-semibold'>{$_SESSION['info']}</span>
                      </div>";
            }
        }
    ?>
</div>

<div id="error" class="container mt-2">
    <?php
        if (!empty($_SESSION['error'])) {
            if (is_array($_SESSION['error'])) {
                foreach ($_SESSION['error'] as $error) {
                    echo "<div class='alert border-0 shadow-sm d-flex align-items-center alert-clinic-error'>
                            <i class='bi bi-exclamation-triangle-fill me-3' style='font-size: 1.5rem;'></i>
                            <span class='fw-semibold'>$error</span>
                          </div>";
                }
            } else {
                echo "<div class='alert border-0 shadow-sm d-flex align-items-center alert-clinic-error'>
                        <i class='bi bi-exclamation-triangle-fill me-3' style='font-size: 1.5rem;'></i>
                        <span class='fw-semibold'>{$_SESSION['error']}</span>
                      </div>";
            }
        }
    ?>
</div>
