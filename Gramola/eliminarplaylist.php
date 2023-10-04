<?php
session_start();

if(isset($_SESSION["playlistfilename"]) && isset($_SESSION["playlistId"])) {
    $json = $_SESSION["playlistfilename"];
    $playlistId = $_SESSION["playlistId"];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["playlist_index"])) {
        $playlistindex = $_POST["playlist_index"];
    // Leer la lista de reproducción existente desde el archivo JSON
    $playlistData = json_decode(file_get_contents($json), true);

    $playlists = &$playlistData['playlists'];

    // Verificar si el índice de la canción es válido
    if ($playlistindex >= 0 && $playlistindex < count($playlists)) {
        // Eliminar la canción del array
        array_splice($playlists, $playlistindex, 1);

        // Convertir el array actualizado a formato JSON
        $jsonContent = json_encode($playlistData, JSON_PRETTY_PRINT);

        // Guardar el JSON actualizado en el archivo de la lista de reproducción
        file_put_contents($json, $jsonContent);
        
    }
    header("Location: Gramola.php"); // rederige a la playlist seleccionada 
    exit();
    } 
}
?>