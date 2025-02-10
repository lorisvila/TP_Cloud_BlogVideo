<?php

function youtubeVideoExists($videoId) {
    // Construct the oEmbed API URL
    $oEmbedUrl = "https://www.youtube.com/oembed?url=https://www.youtube.com/watch?v=" . $videoId . "&format=json";

    // Initialize cURL
    $ch = curl_init($oEmbedUrl);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the result instead of outputting it
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification (optional)

    // Execute the cURL request
    $response = curl_exec($ch);

    // Get the HTTP status code
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Close cURL
    curl_close($ch);

    // Return true if the video exists (status code 200), false otherwise
    return ($httpCode == 200);
}

// Retrieve and sanitize form data
$videoTitle = $_POST['videoTitle'];
$videoId = $_POST['videoId'];
$videoComment = $_POST['videoComment'];

// Validate input (e.g., check if fields are not empty)
if (empty($videoTitle) || empty($videoId) || empty($videoComment)) {
    echo "<h1 style='text-align: center; color: purple'>Il manque des paramètres</h1><br>";
    exit;
}

// Check if the video exists
if (!youtubeVideoExists($videoId)) {
    echo "<h1 style='text-align: center; color: purple'>The YouTube video with ID '$videoId' does not exist.</h1><br>";
    exit;
}

// Prepare and execute the SQL query to insert data into the `videos` table
$sql = "INSERT INTO videos (id, title, video_id, comment) VALUES (NULL, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Check if the prepared statement was successful
if ($stmt === false) {
    echo "<h1 style='text-align: center; color: purple'>Erreur lors de la préparation de la requête</h1><br>";
    echo $conn->error;
    exit;
}

// Bind parameters to the statement
$stmt->bind_param("sss", $videoTitle, $videoId, $videoComment);

// Execute the statement
if ($stmt->execute()) {
    echo "<h1 style='text-align: center; color: darkgreen'>Vidéo ajouté avec succès 👍</h1><br>";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement
$stmt->close();