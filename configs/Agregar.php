<?php
include "funciones.php"; //archivo para la conexion a la base de datos
 $codigo=$_POST['codigo']; //Capturamos en una variable los datos enviados al formulario por el metodo POST
 $nombre_producto=$_POST['nombre_producto'];
 $id_categoria=$_POST['id_categoria'];
 $precio_uni=$_POST['precio_uni'];
 $cantidad=$_POST['cantidad'];
 $descripcion=$_POST['descripcion'];
 $id_usuario=$_POST['id_usuario'];

 //var_dump($codigo.' '.$nombre_producto.' '.$id_categoria.' '.$precio_uni.' '.$cantidad.' '.$descripcion.' '.$id_usuario); exit;

//INSERTAR INSERT INTO Nombretabla
 $sentencia='INSERT INTO productos(codigo, nombre_producto, id_categoria, precio_uni, cantidad, descripcion, id_usuario) VALUES ('.$codigo.',\''.$nombre_producto.'\','.$id_categoria.','.$precio_uni.','.$cantidad.',\''.$descripcion.'\','.$id_usuario.')';

 //var_dump($sentencia);

 $resultado= mysqli_query($con,$sentencia);

 //var_dump(mysqli_error($con));exit;

  if($resultado){
     header("Location:formularioAgregar.php?status=Agregado correctamente"); //location nos redirecciona al formulario
  
  }
  else{
  	header("Location:formularioAgregar.php?status=No se puede agregar");
  }

 
  ?>