<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>pedidos</title>
    <link rel="stylesheet" href="style1.css">
</head>

    <body>
            <div class="form-container">
                <a href="pedidos.php"
			   class="nd">
				<img src="img/back-arrow.PNG" 
				     width="32">
			</a>
                <form action="php/login_usuario_be.php" method="POST">
                <h3>Hacé tu pedido</h3> 
                <h2></h2>
                <input type="text"      name="nombre" required placeholder="Nombre completo">
                <h2></h2>
                <input type="text"      name="numero" required placeholder="Cantidad a pedir">
                <h2>Fecha:</h2>
                <input type="date"      name="fecha" required placeholder="Fecha">
                <h2>Desde las:</h2>
                <input type="time"      name="hora" required placeholder="Hora">
                <h2>Hasta las:</h2>
                <input type="time"      name="hora" required placeholder="Hora">
                <input type="submit"    name="sumbit" value="Enviar pedido" class="form-btn">
                <p><a href="pedidos.php">Pedido de libros</a></p>
            </form>
            </div>