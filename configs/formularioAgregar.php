<?php
include "funciones.php"; //archivo para la conexion de base de datos 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Agregar Producto</title>
</head>
<body bgcolor="SILVER">
	<CENTER>
		<form action="Agregar.php" method="POST">
			<label><h2>Registro Producto</h2></label>
			
		    Codigo <input type ="text"name="codigo" placeholder="Ingrese el codigo a agregar"><br>
			Nombre Producto <input type ="text"name="nombre_producto"placeholder="Ingrese el nombre del producto"><br>
			Id Categoria <input type ="text"name="id_categoria" placeholder="Ingrese la id categoria"><br>
			Precio <input type ="text"name="precio_uni"placeholder="Ingrese el precio a modificar"><br>
			Cantidad <input type ="text"name="cantidad" placeholder="Ingrese la cantidad"><br>
			Descripcion <input type ="text"name="descripcion" placeholder="Ingrese la descripcion"><br>
			Id Usuario <input type="text" name="id_usuario"placeholder="Ingrese el usuario"><br>
			<input type="submit" value="Agregar">
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