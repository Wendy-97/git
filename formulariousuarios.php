<?php
include "configs/funciones.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro Usuarios</title>
	<link rel="stylesheet" href="css/estilouser.css"/>
</head>
<body>
    <center>
    	<div class="contact-form">
      	<form action="usuariosagregados.php" method="POST">
      		<label><h2>Formulario Usuaios</h2></label>
      		Nombre Usuario<input type="text" name="usuario" placeholder="Ingrese el nombre de usuario"><br>
      		Contraseña<input type="text" name="contrasenia" placeholder="Ingrese la contraseña"><br>
      		Email<input type="text" name="email" placeholder="Ingrese el email"><br>
      		Direccion<input type="text" name="direccion" placeholder="Ingrese la direccion"><br>
      		telefono<input type="text" name="telefono" placeholder="Ingrese el telefono"><br>
      		municipio<input type="text" name="municipio" placeholder="Ingrese el municipio"><br>
      		Colonia<input type="text" name="colonia" placeholder="Ingrese la colonia"><br>
      		<input type="submit" name="submit" value="Guardar">

      	</form>
      		<?php 
		   
		    if(isset($_GET['status'])){ //Verificar que la variable tenga contenido que no sea nulo 
		        $status=$_GET['status'];
		        echo '<span>'.$status.'</span>';
		    } 
		   
			?>	
		</div>
    </center>

</body>
</html>