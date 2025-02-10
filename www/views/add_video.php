<?php
?>

<style>
    #form-container {
        padding: 1em;
    }
</style>

<form action="/add_video_POST" method="POST" id="form-container">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Titre de la vidéo</label>
        <input type="text" class="form-control" id="videoTitle" name="videoTitle">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">ID Vidéo</label>
        <input type="text" size="11" class="form-control" id="videoId" name="videoId">
        <div id="emailHelp" class="form-text">Id de la vidéo youtube : https://www.youtube.com/watch?v=<b>GZJbGZRfnAM</b>&t=15s</div>
    </div>
    <div class="mb-3 form-floating">
        <textarea class="form-control" placeholder="Laisse une commentaire sur cette vidéo" id="videoComment" name="videoComment"></textarea>
        <label for="floatingTextarea">Commentaire</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
