<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Define routes and their corresponding files
    $routes = [
        // GET routes
        '/' => [
            'file' => 'views/home.php',
            'title' => 'Accueil',
            'method' => 'GET'
        ],
        '/list_videos' => [
            'file' => 'views/list_videos.php',
            'title' => 'Liste des videos',
            'method' => 'GET'
        ],
        '/add_video' => [
            'file' => 'views/add_video.php',
            'title' => 'Ajout vidéo',
            'method' => 'GET',
            'auth' => True
        ],
        '/view_video' => [
            'file' => 'views/view_video.php',
            'title' => 'Visualisation video',
            'method' => 'GET'
        ],
        '/add_video_POST' => [
            'file' => 'scripts/videos/add_video.php',
            'title' => 'Ajout vidéo',
            'method' => 'POST',
            'auth' => True
        ],
        '/connect' => [
            'file' => 'views/connect.php',
            'title' => 'Connexion',
            'method' => 'GET'
        ],
        '/disconnect' => [
            'file' => 'scripts/auth/disconnect.php',
            'title' => 'Déconnexion',
            'method' => 'POST',
            'skipLayout' => True,
        ],
        '/send_connect' => [
            'file' => 'scripts/auth/send_connect.php',
            'title' => 'Connexion',
            'method' => 'POST'
        ]
    ];

    // Get the current path and method
    $request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $request_method = $_SERVER['REQUEST_METHOD'];

    $servername = "db";
    $username = "phpServer";
    $password = "paT[zEc7WmNvhPrE";
    $db = "web";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Route handling
    if (!array_key_exists($request_uri, $routes)){
        // Serve 404 page for undefined routes
        http_response_code(404);
        $title = $routes['/']['title'];
        $childView = $routes['/']['file'];
        echo "<h1 style='text-align: center; color: purple'>404 - Page introuvable</h1><br>";
        include('layout.php');
    } elseif (strtoupper($request_method) !== $routes[$request_uri]['method']) {
        // Serve 405 page for incorrect method
        http_response_code(405);
        $title = $routes['/']['title'];
        $childView = $routes['/']['file'];
        echo "<h1 style='text-align: center; color: purple'>405 - Mauvaise méthode</h1><br>";
        include('layout.php');
    } elseif ((!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] === false)
        && isset($routes[$request_uri]['auth'])) {
        // Check if the user is authenticated
        http_response_code(302); // Return 401 Unauthorized if not authenticated
        header('Location: /connect');
        exit;
    } elseif (isset($routes[$request_uri]['skipLayout'])) {
        include($routes[$request_uri]['file']);
    } else {
        $title = $routes[$request_uri]['title'];
        $childView = $routes[$request_uri]['file'];
        include('layout.php');
    }
?>

