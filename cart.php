<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Carrito de Compras</h1>
    <form action="cart.php" method="post">
        <label for="package">Paquete:</label>
        <input type="text" id="package" name="package" required>
        <input type="submit" value="Agregar al Carrito">
    </form>

    <h2>Carrito de Compras</h2>
    <?php
    session_start();

    // Agregar un paquete al carrito
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['package'])) {
        $package = htmlspecialchars($_POST['package']);
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][] = $package;
    }

    // Mostrar los paquetes en el carrito
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        echo "<ul>";
        foreach ($_SESSION['cart'] as $item) {
            echo "<li>$item</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>El carrito está vacío.</p>";
    }
    ?>
</body>
</html>
