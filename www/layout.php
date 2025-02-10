<html>
    <head>
        <link rel="stylesheet" href="/bootstrap-5/css/bootstrap.min.css">
        <link rel="stylesheet" href="/style.css">
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <div id="mainContainer">
            <div id="nav" class="pageZone" style="display: flex; flex-flow: row nowrap; justify-content: flex-start; align-items: flex-end; gap: 1em">
                <h1>Loris's Blog - <?php echo $title; ?></h1>
            </div>
            <div id="sideBar" class="card pageZone">
                <div class="card-header">
                    Menu
                </div>
                <div class="card-body" style="display: flex; flex-flow: column nowrap; gap: 1em; justify-content: center; align-items: center; min-width: 10em">
                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                        <a href="/" class="btn btn-primary">Accueil</a>
                        <a href="/list_videos" class="btn btn-primary">Liste vidéos</a>
                        <a href="/add_video" class="btn btn-secondary">Ajouter vidéo</a>
                    </div>
                    <?php
                    // Check if the user is authenticated
                    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true):
                        ?>
                        <form method="POST" action="/disconnect" style="padding: 0; margin: 0">
                            <button type="submit" class="btn btn-danger">Disconnect</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            <div id="content" class="pageZone">
                <?php include($childView); ?>
            </div>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="/bootstrap-5/js/bootstrap.min.js"></script>
</html>
<?php
    $conn->close();
?>