<?php
include "configs/funciones.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="css/master.css"/>
</head>
<body>
	<?php
    if(isset($_POST['submit'])){

    	
//obtenemos los valores del formulario
$usuario=$_POST['usuario']; //Capturamos en una variable los datos enviados en el formulario por el metodo POST
$contrasenia=$_POST['contrasenia']; //Capturamos en una variable los datos enviados en el formulario por el metodo POST
//$contrasenia=hash('sha512',$contrasenia);

 //SELECT *FROM tablaUsuarios cuando el usuario este en la base de datos y la contrasenia este e la base 
$sentencia='SELECT * FROM usuarios WHERE usuario=\''.$usuario.'\' and contrasenia=\''.$contrasenia.'\'';


//Realizamos la consulta a la base de datos a la tabla de usuarios
$resultado=mysqli_query($con,$sentencia); 

$filas=mysqli_num_rows($resultado);
if($filas>0){  //Verificamos que haya un resultado en nuestra consulta
   session_start();
   	$_SESSION['usuario'] =$usuario;
   	$_SESSION['logeado'] =true;


   header("Location: index.php?status=Usuario Correcto Bienvenido!".$_SESSION['usuario']);
    
}else{
    echo "Error en la autenticacion";
	}
mysqli_free_result($resultado);


 }
	?>
	<center>
		<div class="login-box">
   			<form  method="POST" action="<?=$_SERVER['PHP_SELF'];?>"> <!---Es para redireccionar a la misma pagina --->
   				<img class="avatar"src="img/login.png" alt="Logo de entrada">
   				<label><h2>Iniciar Sesion</h2></label>
   				<p>Nombre de usuario: </p>
   				<input style="border-radius: 10px;"type="text" name="usuario" placeholder="Ingrese su nombre"><br>
   				<p>Contraseña: </p>
   				<input style="border-radius: 10px;"type="text" name="contrasenia" placeholder="Ingrese su contraseña"><br>
   				<input type="submit" name="submit" value="Iniciar Sesion">
   				<a href="formulariousuarios.php">Registro Usuarios</a>
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
