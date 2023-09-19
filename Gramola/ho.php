<?php 
$playlist = file_get_contents("./playlist.json");
$Cancion = json_decode($playlist, true);
print_r($Cancion);
$nombreplaylist1 = $Cancion["playlist"]["nombre"];
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 
</body>
</html>