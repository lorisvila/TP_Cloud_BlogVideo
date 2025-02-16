<?php
// Check if a URL is submitted via GET request
if (isset($_GET['v'])) {
    $videoId = $_GET['v'];

    if ($videoId) {

        // If the video ID is valid, generate the embed code
        $embedUrl = "https://www.youtube.com/embed/" . $videoId;
        $embedCode = '<div class="embed-responsive embed-responsive-16by9">
                        <iframe style="width: 30em; height: 20em" class="embed-responsive-item" src="' . $embedUrl . '" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen></iframe>
                      </div>';

        // Prepare the SQL query
        $stmt = $conn->prepare("SELECT * FROM videos WHERE video_id = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind the parameter and execute the query
        $stmt->bind_param("s", $videoId); // "s" indicates the parameter is a string
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the video details
        $video = $result->fetch_assoc();

    } else {
        // If the video ID is invalid, show an error message
        echo "<h1 style='text-align: center; color: purple'>Invalid YouTube video URL. 
               Please make sure the URL contains a valid video ID.</h1><br>";
        exit;
    }
} else {
    // If no URL is submitted, show a form to enter a YouTube URL
    echo "<h1 style='text-align: center; color: purple'>Il manque l'id de la video dans la requête</h1><br>";
    exit;
}
?>


<div class="card">
    <div class="card-img-top">
        <?php if(isset($embedCode)) {echo $embedCode;};?>
    </div>
    <div class="card-body" style="max-width: 30em">
        <h5 class="card-title"><?php if(isset($video)) {echo $video['title'];};?></h5>
        <p class="card-text">Commentaire : <br><i><?php if(isset($video)) {echo $video['comment'];};?></i></p>
    </div>
</div>