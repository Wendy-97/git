<?php

	header("Content-Type: application/json");

	function truncar($numero, $digitos)
	{
	    $truncar = 10**$digitos;
	    return intval($numero * $truncar) / $truncar;
	}

	include '../conexion.php';
	$data = $_POST['lista'];
	$total = truncar($_POST['total'], 2);
	$subtotal = truncar($_POST['subtotal'], 2);

	date_default_timezone_set('America/Monterrey');

	//Obtenemos datetime del sistema
	$date = date('Y-m-d H:i:s');

	$venta = 0;

	$total_insert = mysqli_query($con, "INSERT INTO ventas (fecha, total, subtotal) VALUES ('".$date."', ".$total.", ".$subtotal.")") or die("Error: ".mysqli_error($con));

	$select_venta = mysqli_query($con, "SELECT * FROM ventas WHERE fecha = '$date' AND total = $total");

	$venta_id = mysqli_fetch_array($select_venta);

	$venta = $venta_id['id'];

	for($i=0; $i<count($data); $i++){

			$id_producto = mysqli_query($con, "SELECT * FROM productos WHERE codigo = ".$data[$i]['codigo']) or die("Error: ".mysqli_error($con));

			$id = mysqli_fetch_array($id_producto);


			$query = "INSERT INTO detalle_ventas (id_venta, id_producto, cantidad, precio_unitario, precio_total) VALUES (".$venta.", ".$id['id']." , ".$data[$i]['cantidad'].", ".$data[$i]['precio'].", ".($data[$i]['precio']*$data[$i]['cantidad']).")";

			$detalle_venta_insert = mysqli_query($con, $query) or die("Error: ".mysqli_error($con));

			$json = new stdClass();


			if($detalle_venta_insert){
				$json->estatus = 'ok';
				$json->venta = $venta;
			}else{
				$json->estatus = 'no ok';
			}

	}

	echo json_encode($json);


?>