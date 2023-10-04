<?php
session_start(); 

if (isset($_SESSION["playlistfilename"])) {
    $json = $_SESSION["playlistfilename"];
} else {
    header("Location: formulario.php"); // Si no está configurado, redirecciona al formulario para añadir el nombre del archivo JSON.
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    
    // Crear un array para la nueva playlist
    $playlist = array(
        "playlist" => array(
            "nombre" => $nombre,
            "canciones" => array()
        )
    );
    
    // Convertir la playlist a formato JSON y guardarla en un archivo
    $jsonPlaylist = json_encode($playlist, JSON_PRETTY_PRINT);
    file_put_contents("Playlists/{$nombre}.json", $jsonPlaylist);
    
    // Redirigir a la página de la lista de reproducción o a otra página de tu elección
    header("Location: Gramola.php");
    exit();
}
?>