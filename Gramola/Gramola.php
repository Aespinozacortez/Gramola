<?php
$playlists = [];

foreach (glob("Playlists/*.json") as $file) {
    $playlistData = json_decode(file_get_contents($file), true);
    if ($playlistData) {
        $playlists[] = $playlistData;
    }
}
session_start(); // Iniciar la sesión

// Verificar si la variable de sesión "nombre" está definida
if (isset($_SESSION["nombre"])) {
    $nombre = $_SESSION["nombre"];
   
} else {
    header("Location: formulario.php");
    exit();
}
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
            <?php
            foreach ($playlists as $index => $playlist) {
                echo '<li><a href="Gramola.php?playlist_id=' . $index . '">' . $playlist['playlist']['nombre'] . '</a></li>';
            }
            ?>
            </ul>
            <?php
            if(isset($_GET['playlist_id'])) {
                $playlistId = $_GET['playlist_id'];
                if(isset($playlistId) && isset($playlists[$playlistId])) {
                    $selectedPlaylist = $playlists[$playlistId];
                    $playlistFileName = glob("*.json")[$playlistId];        //lee todos los ficheros y lo pone en esa variable
                    $_SESSION["playlistfilename"] = $playlistFileName;
                }}
            ?>
            </ul>
        </div>
    </nav>
    <aside>
        <div id="nombre">
            <p><?php echo "Bienvenido, $nombre!";?></p>
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
