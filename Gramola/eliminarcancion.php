<?php
session_start();

if(isset($_SESSION["playlistfilename"]) && isset($_SESSION["playlistId"])) {
    $json = $_SESSION["playlistfilename"];
    $playlistId = $_SESSION["playlistId"];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cancion_index"])) {
        $cancionIndex = $_POST["cancion_index"];
    // Leer la lista de reproducción existente desde el archivo JSON
    $playlistData = json_decode(file_get_contents($json), true);

    // Obtener el array de canciones de la lista de reproducción
    $canciones = &$playlistData['playlist']['canciones'];

    // Verificar si el índice de la canción es válido
    if ($cancionIndex >= 0 && $cancionIndex < count($canciones)) {
        // Eliminar la canción del array
        array_splice($canciones, $cancionIndex, 1);

        // Convertir el array actualizado a formato JSON
        $jsonContent = json_encode($playlistData, JSON_PRETTY_PRINT);

        // Guardar el JSON actualizado en el archivo de la lista de reproducción
        file_put_contents($json, $jsonContent);
        
    }
    header("Location: Gramola.php?playlist_id=" . $playlistId); // redirecciona a la playlist seleccionada
    exit();
    } 
}
?>