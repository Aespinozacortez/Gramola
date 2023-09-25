<?php
$jsonFiles = glob('Playlists/*.json');          
$playlists = [];                        
$cancionesPorPlaylist = [];     
foreach ($jsonFiles as $file) {                     //recorremos todos los ficheros json
    $jsonContent = file_get_contents($file);                //guardamos el contenido en la variable
    $jsonData = json_decode($jsonContent, true);
    $playlistName = $jsonData['playlist']['nombre'];        //guardamos el nombre de la playlist en la variable
    $playlists[] = $playlistName;                           // variable para generar un bucle y asi mostrar los nombres de la PLAYLIST
    $cancionesPorPlaylist[$playlistName] = $jsonData['playlist']['canciones']; //Se guardan las canciones por el nombre de cada PLAYLIST
}
    $playlistsData = json_encode($playlists);
    $cancionesData = json_encode($cancionesPorPlaylist);
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
                <?php foreach ($playlists as $playlist): ?>
                    <li><a href=""class="playlist-link"><?php echo $playlist; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>
    <aside>
        <div id="Canciones">
            <audio id="audioPlayer" controls style="display: none;">
            </audio>
        </div>
    </aside>
    <footer>
        <div id="infoimg">
        </div>
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
            <div id="repetir">
                <img src="img/repetir.png" alt="">
            </div>
        </div> 
    </footer>
    <script>
        var playlistsData = <?php echo $playlistsData; ?>;
        var cancionesData = <?php echo $cancionesData; ?>;
    </script>
    <script src="./app.js"></script>
</body>
</html>
