<!-- http://www.redecodifica.com/crear-un-reporte-en-pdf-con-php-mysql-bootstrap-tcpdf/ -->
<?php
	date_default_timezone_set('America/Monterrey');
	include '../conexion.php';

	function truncar($numero, $digitos)
	{
	    $truncar = 10**$digitos;
	    return intval($numero * $truncar) / $truncar;
	}

	$venta = $_GET['venta'];

	if(empty($venta)){
		header("location: ../carrito.php");
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Factura</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin ="anonymous">
</head>
<body>
	<div class="container p-2 border">
		<div class="row align-items-center mt-2" style="text-align: center;">
			<div class="col-md-3">
				<img width="80%" src="src/facturacion_logo.png">
			</div>
			<div class="col-md-6">
				<h3 class="border-bottom">Sistema de Facturación Electrónica</h3 class="border-bottom">
				<span><b>SIFEL S.A. de C.V.</b></span>
				<br/><span>Av. Siempre Viva 742. Monterrey, Nuevo León.</span>
				<br/><span>Tel: 81 11 860 118</span>
			</div>
			<div class="col-md-3">
				<img width="20%" src="src/sat_logo.gif">
			</div>
		</div>
		<div class="row mt-5 pr-5 pl-5">
			<div class="col-md-4">
				<span>No. Factura: <b>FC-<?=$venta;?></b></span><br/>
				<span>Fecha: <b><?php echo date("d/m/Y");?></b></span><br/>
				<span>NIT: <b>123-456789-000</b></span>
			</div>
		</div>
		<div class="row mt-5 pr-5 pl-5">
			<div class="col-md-6 border bg-light">
				<span><b>Concepto</b></span>
			</div>
			<div class="col-md-3 border bg-light" style="text-align: center;">
				<span><b>Cantidad - Prec. Unit.</b></span>
			</div>
			<div class="col-md-3 border bg-light" style="text-align: center;">
				<span><b>Subtotal</b></span>
			</div>
		</div>
		<?php 
			$query = mysqli_query($con, "SELECT * FROM detalle_ventas WHERE id_venta = $venta");

			if(mysqli_num_rows($query) == 0){
				header("location: ../carrito.php");
				exit;
			}
		?>
		<div id="articulos">
			<?php

			$aux_con = mysqli_connect("localhost","root","","timsax10_modulo_inventario") or die("Error: ".mysqli_error($aux_con));

			$subtotal = 0.0;

			while ($row = mysqli_fetch_array($query)) {

				$producto = mysqli_query($aux_con, "SELECT * FROM productos WHERE id_productos = ".$row['id_productos']);

				$row_producto = mysqli_fetch_array($producto);

				echo '<div class="row pr-5 pl-5">
								<div class="col-md-6 border" style="text-align: center !important;">
									'.$row_producto['Descripcion'].'
								</div>
								<div class="col-md-3 border" style="text-align: center !important;">
									'.$row['cantidad'].' x $ '.$row['precio_unitario'].'
								</div>
								<div class="col-md-3 border" style="text-align: center !important;">
									$ '.$row['precio_total'].'
								</div>
							 </div>';

				$subtotal += $row['precio_total'];

			}

		mysqli_close($aux_con);
			?>
		</div>
		<div class="row pr-5 pl-5 justify-content-end" style="align-items: center !important; margin-top: 100px !important;">
			<div class="col-md-8">
				<div class="row justify-content-center">
					<div class="col-md-3 border-top mt-5" style="text-align: center;">
						<span class=""> Firma </span>
					</div>
				</div>
			</div>
			<div class="col-md-2" style="text-align: right;">
				<span>Subtotal: </span><br/>
				<span>IVA <small>16%:</small> </span><br/>
				<b><span class="h4">Total: </span></b>
			</div>
			<div class="col-md-2">
				<span>$ <?=truncar($subtotal, 2);?></span><br/>
				<span>$ <?=truncar(($subtotal*0.16), 2);?></span><br/>
				<b><span class="h4">$ <?=truncar(($subtotal*1.16), 2);?></span></b>
			</div>
		</div>
	</div>
</body>
</html>