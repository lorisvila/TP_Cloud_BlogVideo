<?php

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Prepare the SQL statement with ? placeholders
$sql = "SELECT COUNT(*) FROM AdminUsers WHERE user = ? AND password = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}

// Bind parameters to the placeholders
$stmt->bind_param('ss', $username, $password);

// Execute the prepared statement
$stmt->execute();

// Bind the result to a variable
$stmt->bind_result($count);
$stmt->fetch();

// Close the statement
$stmt->close();

if ($count >= 1) {
    // Handle the case where at least one matching record exists
    $_SESSION['authenticated'] = true;
    echo 'Vous êtes bien connecté !';
    echo '<button type="button" class="btn btn-success" onclick="location.href = \'/\'">Continuer</button>';
    exit;
} else {
    echo 'Invalid credentials<br>';
    echo '<button type="button" class="btn btn-danger" onclick="location.href = \'/\'">Recommencer</button>';
}
