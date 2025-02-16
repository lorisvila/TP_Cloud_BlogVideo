<?php
    session_unset();
    session_destroy();

    // Redirect or confirm session termination
    header("Location: /");
    exit;
?>
