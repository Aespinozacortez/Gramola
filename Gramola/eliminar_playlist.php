<?php
session_start();

if(isset($_SESSION["playlistfilename"])) {
    $json = $_SESSION["playlistfilename"];

    if (file_exists($json)) {
        // Intentar borrar el archivo
        if (unlink($json)) {
            header("Location: Gramola.php");
        }
    } 
}
?>