<?php
session_start(); // Iniciar la sesión

// Verificar si la variable de sesión "nombre" está definida
if (isset($_SESSION["nombre"])) {
    $nombre = $_SESSION["nombre"];
}

if (isset($_SESSION["playlistname"])) {
    $playlistname = $_SESSION["playlistname"];
}

if (isset($_SESSION["time"])) {
    $time = $_SESSION["time"];
}
if (isset($_SESSION['nombrePlaylists'])) {
    // Recupera los nombres de las playlists desde la variable de sesión
    $playlistNombres = $_SESSION['nombrePlaylists'];

}

// Supongamos que aquí obtienes el nombre de usuario actual
$usuario = $nombre;

// Supongamos que aquí obtienes la última playlist escuchada con fecha y hora
$ultimaPlaylist = $playlistname;
$fechaHora = $time;



if (isset($_COOKIE['playlist_counters'])) { //playlist
    $playlistCountersJSON = $_COOKIE['playlist_counters'];
    
    // Decodificar el JSON almacenado en la cookie de contador de playlist
    $playlistCounters = json_decode($playlistCountersJSON, true);
    
    // Utilizar el array $playlistCounters según sea necesario
}

// Tu array de números
arsort($playlistCounters); // Ordena el array de contadores en orden descendente
// Asegúrate de que $playlistNombres esté inicializado correctamente antes de usarlo

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Usuario</title>
</head>
<body>
    <h1>Información Técnica del Usuario</h1>
    <p>Nombre de Usuario: <?php echo $usuario; ?></p>
    <p>Última Playlist Escuchada: <?php echo $ultimaPlaylist; ?></p>
    <p>Fecha y Hora de la Última Escucha: <?php echo $fechaHora; ?></p>

    <h2>Reproducciones:</h2>
    <p><?php echo "Playlists ordenadas por reproducciones: ".'<br>';

foreach ($playlistCounters as $posicion => $contador) {
    if (isset($playlistNombres[$posicion])) {
        echo $playlistNombres[$posicion] . '<br>';
    }
}
?>
</p>
</body>
</html>