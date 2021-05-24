<?php
include "configs/funciones.php"; //archivo para la conexion a la base de datos
$usuario=$_POST['usuario'];   //Capturamos en una variable los datos enviados al formulario metodo POST
$contrasenia=$_POST['contrasenia'];
$email=$_POST['email'];
$direccion=$_POST['direccion'];
$telefono=$_POST['telefono'];
$municipio=$_POST['municipio'];
$colonia=$_POST['colonia'];

//INSERT INTO Nombretabla usuarios 
$sentencia='INSERT INTO usuarios(usuario,contrasenia,email,direccion,telefono,municipio,colonia)VALUES(\''.$usuario.'\',\''.$contrasenia.'\',\''.$email.'\',\''.$direccion.'\',\''.$telefono.'\',\''.$municipio.'\',\''.$colonia.'\')';


 $resultado= mysqli_query($con,$sentencia);

  if($resultado){
     header("Location:formulariousuarios.php?status=Agregado correctamente"); //location nos redirecciona al formulario Usuarios
  
  }
  else{
  	header("Location:formulariousuarios.phpstatus=No se puede agregar");
  }




?>
