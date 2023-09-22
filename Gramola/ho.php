<?php
$jsonFiles = glob('Playlists/*.json');          
$playlists = [];                        //variable para guardar la info
foreach ($jsonFiles as $file) {                     //recorremos todos los ficheros json
    $jsonContent = file_get_contents($file);                //guardamos el contenido en la variable
    $jsonData = json_decode($jsonContent, true);
    $playlistName = $jsonData['playlist']['nombre'];        //guardamos el nombre de la playlist en la variable
    $playlists[] = $playlistName;                           //guardamos los nombres con otra variable en formato array
    $canciones = $jsonData['playlist']['canciones'];        //acceder a las canciones
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
                <?php foreach ($playlists as $playlist): ?>
                    <li><a href=""class="playlist-link"><?php echo $playlist; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>
    <aside>
        <div id="Cancion">
            <img src="img/thecalling.jpg" alt="">
            <div id="info">
                <p id="titulo">Institut Cendrassos</p>
                <p id="autor">Alejandro Espinoza</p>
            </div>
        </div>
    </aside>
    <footer>
        <div id="infoimg">
            <img src="img/Cendrassos.png" alt="">
            <div id="texto">
                <p id="titulo">Institut Cendrassos</p>
                <p id="autor">Alejandro Espinoza</p>
            </div>
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
        var datosDesdePHP = <?php echo json_encode($cancionPlay1); ?>;
    <script src="./app.js"></script>
</body>
</html>
