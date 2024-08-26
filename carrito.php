<?php
session_start(); // Inicia una sesión o reanuda la sesión actual

// Agregar un paquete al carrito
if (isset($_POST['add_to_carrito'])) { // Verifica si se ha enviado el formulario para agregar un paquete al carrito
    $package = $_POST['package']; // Obtiene el valor del paquete seleccionado del formulario
    if (!isset($_SESSION['carrito'])) { // Verifica si no existe la variable de sesión 'carrito'
        $_SESSION['carrito'] = array(); // Inicializa 'carrito' como un array vacío
    }
    if (!isset($_SESSION['carrito'][$package])) { // Verifica si el paquete seleccionado no está en el carrito
        $_SESSION['carrito'][$package] = 0; // Inicializa la cantidad del paquete seleccionado a 0
    }
    $_SESSION['carrito'][$package]++; // Incrementa la cantidad del paquete seleccionado en el carrito
}

// Mostrar el carrito
function displayCarrito() {
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) { // Verifica si el carrito existe y no está vacío
        echo "<h2>Carrito de Compras</h2><ul>"; // Muestra el título del carrito y abre una lista
        foreach ($_SESSION['carrito'] as $package => $quantity) { // Itera a través de cada paquete en el carrito
            echo "<li>Paquete: $package - Cantidad: $quantity</li>"; // Muestra cada paquete y su cantidad en una lista
        }
        echo "</ul>"; // Cierra la lista
    } else {
        echo "<p>Tu carrito está vacío.</p>"; // Muestra un mensaje indicando que el carrito está vacío
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Establece la codificación de caracteres a UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista para dispositivos móviles -->
    <title>Carrito de Compras</title> <!-- Título de la página -->
    <link rel="stylesheet" href="styles.css"> <!-- Enlace a la hoja de estilos CSS -->
</head>
<body>
    <h1>Selecciona tus Paquetes</h1> <!-- Título principal de la página -->
    <form action="" method="post"> <!-- Formulario que envía datos por método POST -->
        <select name="package"> <!-- Menú desplegable para seleccionar un paquete -->
            <option value="Balmaceda">Balmaceda</option> <!-- Opción Balmaceda -->
            <option value="Puerto Natales">Puerto Natales</option> <!-- Opción Puerto Natales -->
            <option value="Punta Arenas">Punta Arenas</option> <!-- Opción Punta Arenas -->
        </select>
        <button type="submit" name="add_to_carrito">Agregar al Carrito</button> <!-- Botón para enviar el formulario -->
    </form>

    <?php displayCarrito(); ?> <!-- Llama a la función para mostrar el carrito -->

</body>
</html>
