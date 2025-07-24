<?php
// Router pour le serveur PHP intégré
$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

// Servir les fichiers statiques directement
if (file_exists(__DIR__ . $path) && is_file(__DIR__ . $path)) {
    return false; // Laisser le serveur servir le fichier
}

// Rediriger tout vers index.php
$_SERVER['REQUEST_URI'] = $uri;
include_once 'index.php';
?>