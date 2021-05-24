<?php
include "funciones.php";//archivo para la conexión a la base de datos

 $id_productos=$_POST['id_productos']; //Capturamos en una variable los datos enviados al formulario con POST
 $codigo=$_POST['codigo'];
 $nombre_producto=$_POST['nombre_producto'];
 $id_categoria=$_POST['id_categoria'];
 $precio_uni=$_POST['precio_uni'];
 $cantidad=$_POST['cantidad'];
 $descripcion=$_POST['descripcion'];
 $id_usuario=$_POST['id_usuario'];
 

//UPDATE nombretabla SET y los campos que modificaremos , la operacion se guarda en la variable $sentencia 
 //concatenar lleva '.$variable' //doble comilla texto 
$sentencia='UPDATE productos SET codigo='.$codigo.', nombre_producto=\''.$nombre_producto.'\', id_categoria='.$id_categoria.', precio_uni='.$precio_uni.', cantidad='.$cantidad.', descripcion=\''.$descripcion.'\', id_usuario='.$id_usuario.' 
 WHERE id_productos='.$id_productos.'';
  $resultado= mysqli_query($con,$sentencia);
  if($resultado){
     header("Location:formulario.php?status=Modificado correctamente"); //location nos redirecciona al formulario
  
  }
  else{
  	header("Location:formulario.php?status=No se pudo realizar la modificacion");
  }

 
  ?>