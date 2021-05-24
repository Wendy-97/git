<?php
include "configs/funciones.php";
session_start();
  unset($_SESSION['usuario']); //vaciando las variables 
   	$_SESSION['logeado'] =false;

session_destroy(); //destruyendo la sesion 
if(isset($_SESSION['logeado'])&& $_SESSION['logeado']==true){
}else{
	echo"Iniciar Sesion para acceder a este contenido<br>";
	header("location:login.php"); //redirige a la pagina de login
exit;
}


?>
