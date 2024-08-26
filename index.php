<?php

// inicio de sesion en php con opciones de seguridad configuradas 
session_start([ // Inicia una sesion o reanuda una sesion
    'cookie_secure' => true, // La cookie de la sesion se envia solo atravez de https como capa adicional de seguridad 
    'cookie_httponly' => true, // La cookie de la sesion solo es accesible atravez de https
    'use_strict_mode' => true, // Solo acepta identificadores de sesion generados por el servidor
    'gc_maxlifetime' => 1800, // 30 minutos
]);

// Regenera el ID de la sesión para prevenir ataques de fijación de sesión
session_regenerate_id(true); // Regenera la sesion cada vez que se inicia secion nuevamente

// Sanitizar datos con la finalidad de evitar ataque atravez del formulario 
function sanitize_input($data) { // Función para sanitizar los datos de entrada
    $data = trim($data); // Elimina espacios en blanco al principio y al final
    $data = stripslashes($data); // Elimina las barras de escape
    $data = htmlspecialchars($data); // Convierte caracteres especiales en entidades HTML
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verifica si se ha enviado el formulario mediante el método POST
    $hotelName = sanitize_input($_POST["hotelName"]); // Sanitiza los datos de entrada del formulario
    $city = sanitize_input($_POST["city"]); // Sanitiza los datos de entrada del formulario
    $country = sanitize_input($_POST["country"]); // Sanitiza los datos de entrada del formulario
    $travelDate = sanitize_input($_POST["travelDate"]); // Sanitiza los datos de entrada del formulario
    $tripDuration = sanitize_input($_POST["tripDuration"]); // Sanitiza los datos de entrada del formulario
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <h1>Agencia de viajes La mas Feliz</h1> <!-- Titulo de la pagina -->
    <meta charset="UTF-8"> <!-- Establece la codificación de caracteres a UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista para dispositivos móviles -->
    <link rel="stylesheet" href="styles.css"> <!-- Enlaza la hoja de estilos CSS -->
    <title>Agencia de Viajes</title> <!-- Título de la página que aparecerá en la pestaña del navegador -->
    
    <script>
        // Función para mostrar una notificación en la pantalla
        function showNotification(message) {
            const notification = document.createElement('div'); // Crea un nuevo elemento div para la notificación
            notification.className = 'notification'; // Asigna una clase CSS para el estilo de la notificación
            notification.innerText = message; // Establece el texto de la notificación
            document.body.appendChild(notification); // Añade la notificación al cuerpo del documento
            setTimeout(() => {
                notification.remove(); // Elimina la notificación después de 10 segundos
            }, 10000);
        }
    </script>

</head>

<body>
    <div class="search-container"> <!-- Contenedor para la búsqueda de viajes -->
        <input type="text" id="destination" placeholder="Destino"> <!-- Campo de texto para ingresar el destino -->
        <input type="date" id="travel-date"> <!-- Campo de fecha para seleccionar la fecha de viaje -->
        <button id="search-button" onclick="search()">Buscar</button> <!-- Botón para realizar la búsqueda -->
    </div>
    <div id="results-container"> <!-- Contenedor donde se mostrarán los resultados de la búsqueda -->
        <!-- Los resultados de la búsqueda se mostrarán aquí -->
    </div>
    
    <a href="carrito.php">Carrito de Compras</a> <!-- Hipervinculo que redirecciona al usuarioa a carrito.php -->
    
    <script src="scripts.js"></script> <!-- Enlaza el archivo de JavaScript externo en este caso a scripts.js -->
    
    <form action="recuperacion_de_datos.php" method="post"> <!-- Formulario para buscar hoteles -->
        <label for="hotelName">Nombre del Hotel:</label>
        <input type="text" id="hotelName" name="hotelName" required><br> <!-- Campo para ingresar el nombre del hotel -->

        <label for="city">Ciudad:</label>
        <input type="text" id="city" name="city" required><br> <!-- Campo para ingresar la ciudad -->

        <label for="country">País:</label>
        <input type="text" id="country" name="country" required><br> <!-- Campo para ingresar el país -->

        <label for="travelDate">Fecha de Viaje:</label>
        <input type="date" id="travelDate" name="travelDate" required><br> <!-- Campo para seleccionar la fecha de viaje -->

        <label for="tripDuration">Duración del Viaje (días):</label>
        <input type="number" id="tripDuration" name="tripDuration" required><br> <!-- Campo para ingresar la duración del viaje en días -->

        <input type="submit" value="Buscar"> <!-- Botón para enviar el formulario -->
    </form>
    
    <?php
    $offerMessage = "¡Que no te lo cuenten ofertas especiales, reserva ya!";
    echo "<script>
        window.onload = function() {
            showNotification('$offerMessage');
        };
    </script>";
    ?>

</body>
</html>
