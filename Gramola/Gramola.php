<?php
session_start(); // Iniciar la sesión
$playlists = [];
$playlistCounters = [];
foreach (glob("Playlists/*.json") as $file) {
    $playlistData = json_decode(file_get_contents($file), true);
    if ($playlistData) {
        $playlists[] = $playlistData;
    }
}

// Verificar si la variable de sesión "nombre" está definida
if (isset($_SESSION["nombre"])) {
    $nombre = $_SESSION["nombre"];
   
} else {
    header("Location: formulario.php");
    exit();
}

?>
<?php
if(isset($_GET['playlist_id'])) {
    $playlistId = $_GET['playlist_id'];
    if(isset($playlistId) && isset($playlists[$playlistId])) {
        $selectedPlaylist = $playlists[$playlistId];
        $_SESSION['playlistId'] = $playlistId;
        //
        $playlistFileName = glob("Playlists/*.json")[$playlistId]; //asi podemos saber a que archivo corresponde el id
        $_SESSION["playlistfilename"] = $playlistFileName;
        $_playlistname = $playlists[$playlistId]["playlist"]["nombre"];
        $_SESSION["playlistname"] = $_playlistname;
        $time = date("Y-m-d H:i:s");
        $_SESSION["time"] = $time;
        // Ahora $selectedPlaylist contiene el array asociado a la lista de reproducción seleccionada.        
    }}
    $playlistCounters = [];


    if(isset($_GET['playlist_id'])) {
        $playlistId = $_GET['playlist_id'];
    // Lee la cookie si existe
    if (isset($_COOKIE["playlist_counters"])) {
        $playlistCounters = json_decode($_COOKIE["playlist_counters"], true);
    }

    // Incrementa el contador de la playlist actual
    if (array_key_exists($playlistId, $playlistCounters)) {
        $playlistCounters[$playlistId]++;
    } else {
        // Si la playlist no existe en el array, inicializa el contador en 1
        $playlistCounters[$playlistId] = 1;
    }
}
    // Convierte el array a JSON y guarda la información en la cookie
    $playlistCountersJSON = json_encode($playlistCounters);
    setcookie("playlist_counters", $playlistCountersJSON, time() + 3600, "/"); // La cookie expirará en 1 hora (3600 segundos)
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gramola 2.0</title>
    <link rel="stylesheet" href="cs/color.css">
</head>
<body>
    <nav>
        <div id="playlist"> 
            <ul>
                <li>
                    <a href="crear_playlist.html" id="crearplaylist">Crear Playlist</a>
                </li>
                <li>
                    <a href="ficha_tecnica.php">Ficha Tecnica</a>
                </li>
            <?php
if (!isset($_SESSION['nombrePlaylists'])) {
    $_SESSION['nombrePlaylists'] = [] ;
}

foreach ($playlists as $index => $playlist) {
    $nombrePlaylist = $playlist['playlist']['nombre'];
    if (!in_array($nombrePlaylist, $_SESSION['nombrePlaylists'])) {
        $_SESSION['nombrePlaylists'][] = $nombrePlaylist; // Agrega el nombre de la playlist a la sesión
    }
    echo '<li><a href="Gramola.php?playlist_id=' . $index . '">' . $playlist['playlist']['nombre'] . '</a></li>';


    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $_SESSION['url'] = $url;
}
?>
<li>

</li>
        </div>
    </nav>
    <aside>
        <div id="nombre">
            <p><?php echo "Bienvenido, $nombre!";?></p>
        </div>
        <div id="formularios">
        <form action="eliminar_playlist.php" method="post" style="display:inline;">
            <input type="hidden" name="playlist_index" value="<?php echo $index; ?>">
            <button type="submit" id="eliminar">Eliminar Playlist</button>
        </form>
        <a href="subir_canciones.html"><input type="button" id="subircancion"value="Subir Canción"></a>
        <form action="subir_canciones.php" method="post" enctype="multipart/form-data">
        </div>
        <div id="Canciones">
            
            <audio id="audioPlayer">
            </audio>
           
        </div>
    </aside>
    <footer>
        <div id="infoimg">
        </div>
        <div id="container">
            <div id="Controles">
                <div id="aleatorio">
                    <img src="img/Aleatorio.png" alt="">
                </div>
                <div id="Anterior">
                    <img src="img/Anterior.png" alt="">
                </div>
                <div id="play">
                    <img id="imgchange" src="img/Play.png" alt="Botón de reproducción/pausa">
                </div>
            
                <div id="Siguiente">
                    <img src="img/Siguiente.png" alt="">
                </div>
                <div id="stop">
                    <img src="img/stop.png" alt="">
                </div>
            </div> 
            <div id="Time">
                    <span id="currentTime">0:00</span>
                    <progress id="progressBar" value="0" max="100"></progress>
                    <span id="duration">0:00</span>
            </div>
            
        </div>
        <div id="volumen1">
            <input type="range" id="volumen" min="0" max="1" step="0.01" value="0.5" />
            </div>
    </footer>
    <script>
        var musica =<?php echo json_encode($selectedPlaylist);?>
     </script>   
    <script src="./app.js"></script>
</body>
</html>