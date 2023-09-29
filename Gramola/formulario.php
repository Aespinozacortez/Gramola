<?php
session_start(); // Iniciar la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre del formulario
    $nombre = $_POST["nombre"];

    // Guardar el nombre en la sesión
    $_SESSION["nombre"] = $nombre;

    // Redirigir a otra página o mostrar un mensaje de éxito
    header("Location: Gramola.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Sesión</title>
</head>
<body>
    <h1>Guardar Sesión con Nombre</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <button type="submit">Guardar Sesión</button>
    </form>

    <?php
    // Mostrar el nombre almacenado en la sesión si está presente
    if (isset($_SESSION["nombre"])) {
        echo "<h2>¡Hola, " . $_SESSION["nombre"] . "!</h2>";
    }
    ?>
</body>
</html>