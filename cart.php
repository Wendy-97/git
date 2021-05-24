<?php
include "configs/funciones.php";
if(isset($_GET['idproducto'])){
$idproducto=$_GET['idproducto'];
$cant=$_GET['cant'];

//VERIFICO QUE SEA MENOR O IGUAL AL PEDIDO DEL STOCK
$maxStock='2';
if($cant>$maxStock){
	echo "La cantidad es superior de lo que hay en la tienda";
}else{
	//ACTUALIZO LA BD CON LOS DATOS NUEVOS
	$Suma='UPDATE productos SET cant=(cant-'.$cant.') WHERE idproducto='.$idproducto.'';
	$resultado=mysqli_query($con,$Suma);
}
}
//var_dump($idproducto);
//var_dump($cant);
//exit;


$sentencia='INSERT INTO detalle_ticket(idproducto,cant) VALUES ('.$idproducto.','.$cant.')';
$resultado=mysqli_query($con,$sentencia);

$Suma_produ=mysqli_fetch_array($Suma);
 $cant=$Suma_produ['cant'];
 $precio_uni=$resultado['precio_uni'];
 $precio_total=$cant*$precio_uni;
	?>	
?>