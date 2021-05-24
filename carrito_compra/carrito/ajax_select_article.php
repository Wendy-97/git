<?php
	include '../conexion.php';
	header("Content-Type: application/json");

	$articulo = mysqli_real_escape_string($con, $_POST['articulo']);

	$select = mysqli_query($con, "SELECT * FROM productos WHERE codigo = '".$articulo."' AND cantidad != 0") or die("Error: ".mysqli_error($con));
	
	$existe = mysqli_num_rows($select);

	$row = mysqli_fetch_array($select) or die("Error: ".mysqli_error($con));

	$json = new stdClass();

	if($existe != 0){
		$json->codigo = $row['codigo'];
		$json->articulo = $row['nombre_producto'];
		$json->precio = $row['precio_uni'];
		$json->cantidad = $row['cantidad'];

		echo json_encode($json);
	}

?>
