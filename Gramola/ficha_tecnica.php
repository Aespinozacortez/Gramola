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

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Tecnica</title>
    <link rel="stylesheet" href="cs/color.css">
</head>
<body>
    <div id="ficha">
        
    
        <h1 id="titulof">Información Técnica del Usuario</h1>
        <p id="titulof">Nombre de Usuario: <?php echo $usuario; ?></p>
        <p id="titulof">Última Playlist Escuchada: <?php echo $ultimaPlaylist; ?></p>
        <p id="titulof">Fecha y Hora de la Última Playlist Escuchada: <?php echo $fechaHora; ?></p>

        <h2 id="titulof">Reproducciones:</h2>
        <p id="titulof"><?php echo "Playlists ordenadas por reproducciones: ".'<br>';

        foreach ($playlistCounters as $posicion => $contador) {
            if (isset($playlistNombres[$posicion])) {
                echo $playlistNombres[$posicion] . '<br>';
            }
        }
        ?>
        </p>
    </div>
</body>
</html>