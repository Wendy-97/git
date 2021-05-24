<?php
include "funciones.php"; //achivo para la conexion 
$id_productos=$_GET['id_producto'];

if(isset($_GET['id_producto'])){ //Verificar que la variable tenga contenido que no sea nulo
        $id_producto=$_GET['id_producto'];
     //   echo $id_producto;
$sentencia='DELETE from productos WHERE id_productos='.$id_productos.'';
$resultado= mysqli_query($con,$sentencia);
}
if($resultado){
     header("Location:../index.php?status=Eliminado correctamente"); //location nos redirecciona al index
  
  }
  else{
  	header("Location:../index.php?status=No se logro eliminar"); //location nos redirecciona al index
  }


?>
