<?php

session_start();

// Check if the user is authenticated
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    http_response_code(200); // Return 200 OK if authenticated
    exit;
} else {
    http_response_code(302); // Return 401 Unauthorized if not authenticated
    header('Location: /connect.php');
    exit;
}

?>