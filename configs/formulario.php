<?php
include "funciones.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Formulario Productos</title>
	<link rel="stylesheet" href="css/estilo.css"/>
</head>
<body bgcolor="SILVER">

	
	<CENTER>
		<form action="modificar.php" method="POST">
			<label><h2>Modificar Producto</h2></label>
			Id Producto <input type ="text"name="id_productos" placeholder="Ingrese el id a modificar"><br>
			Codigo <input type ="text"name="codigo" placeholder="Ingrese el codigo a modificar"><br>
			Nombre Producto <input type ="text"name="nombre_producto"placeholder="Ingrese el nombre del producto"><br>
			Id Categoria <input type ="text"name="id_categoria" placeholder="Ingrese la id categoria"><br>
			Precio <input type ="text"name="precio_uni"placeholder="Ingrese el precio a modificar"><br>
			Cantidad <input type ="text"name="cantidad" placeholder="Ingrese la cantidad"><br>
			Descripcion <input type ="text"name="descripcion" placeholder="Ingrese la descripcion"><br>
			Id Usuario <input type="text" name="id_usuario"placeholder="Ingrese el usuario"><br>
			<input type="submit" value="Modificar">
		</form>
		</CENTER>
	<span> <!--Etiqueta de Mostrar texto -->
	<?php 
   
    if(isset($_GET['status'])){ //Verificar que la variable tenga contenido que no sea nulo
        $status=$_GET['status'];
        echo $status;
    } 
   
	?>	
	</span>

</body>
</html>