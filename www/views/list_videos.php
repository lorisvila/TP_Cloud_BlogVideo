<?php
$sql = "SELECT * FROM videos";
$result = $conn->query($sql);
?>
<style>
    #videos-container {
        display: flex;
        flex-flow: row wrap;
        gap: 1em;
    }
    .video-card {
        max-width: 20em;
    }
</style>
<div id="videos-container">
    <?php if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { ?>
            <div class="card video-card text-center mb-3">
                <div class="card-header">
                    <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo htmlspecialchars($row['comment']); ?></p>
                    <img src="https://img.youtube.com/vi/<?php echo htmlspecialchars($row['video_id']); ?>/default.jpg"
                         class="card-img-top" alt="Video Thumbnail">
                </div>
                <div class="card-footer">
                    <a href="/view_video?v=<?php echo htmlspecialchars($row['video_id']); ?>" class="btn btn-primary"
                       target="_self">Voir la video</a>
                </div>
            </div>
        <?php }
    } else {
        echo "<p>Aucune vidéo trouvée.</p>";
    } ?>
</div>

