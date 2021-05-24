<?php

function generar_pdf($id){

	$venta = $id;
	
	include '../conexion.php';
	require_once('./src/tcpdf/tcpdf.php');
	date_default_timezone_set('America/Monterrey');

	$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Brandon Daniel Castillo - @branddcast');
	$pdf->SetTitle("Factura de venta: ".$venta);
 
	$pdf->setPrintHeader(false); 
	$pdf->setPrintFooter(false);
	$pdf->SetMargins(20, 20, 20, false); 
	$pdf->SetAutoPageBreak(true, 20); 
	$pdf->SetFont('Helvetica', '', 10);
	$pdf->addPage();

	$content = '<!DOCTYPE html>
<html>
<head>
	<title>Factura</title>
	<style type="text/css">
		.container{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}
		.p-2{padding:.5rem!important}
		.border{border:1px solid #dee2e6!important}
		.row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}
		.align-items-center{-ms-flex-align:center!important;align-items:center!important}
		.mt-2,.my-2{margin-top:.5rem!important}
		.col-md-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}
		.col,.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-auto,.col-lg,.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-lg-auto,.col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-auto,.col-sm,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-sm-auto,.col-xl,.col-xl-1,.col-xl-10,.col-xl-11,.col-xl-12,.col-xl-2,.col-xl-3,.col-xl-4,.col-xl-5,.col-xl-6,.col-xl-7,.col-xl-8,.col-xl-9,.col-xl-auto{position:relative;width:100%;min-height:1px;padding-right:15px;padding-left:15px}
		.col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
		.border-bottom{border-bottom:1px solid #dee2e6!important}
		.mt-5,.my-5{margin-top:3rem!important}
		.pr-5,.px-5{padding-right:3rem!important}
		.pl-5,.px-5{padding-left:3rem!important}
		.col-md-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}
		.bg-light{background-color:#f8f9fa!important}
		.justify-content-end{-ms-flex-pack:end!important;justify-content:flex-end!important}
		.justify-content-center{-ms-flex-pack:center!important;justify-content:center!important}
		.mt-4,.my-4{margin-top:1.5rem!important}
		.border-top{border-top:1px solid #dee2e6!important}
		.col-md-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}
		.col-md-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}
	</style>
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
		</div>';

	$query = mysqli_query($con, "SELECT * FROM detalle_ventas WHERE id_venta = $venta");

	$content .= '<div class="row mt-5 pr-5 pl-5">
			<div class="col-md-4">
				<span>No. Factura: <b>FC-'.$venta.'</b></span><br/>
				<span>Fecha: <b>'.date("l, jS \of F Y").'</b></span><br/>
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
		<div id="articulos">';

		$subtotal = 0.0;

		while ($row = mysqli_fetch_array($query)) {

			$producto = mysqli_query($con, "SELECT * FROM productos WHERE id_productos = ".$row['id_productos']);

			$row_producto = mysqli_fetch_array($producto);

			$content .= '<div class="row mt-5 pr-5 pl-5">
							<div class="col-md-6 border">
								'.$row_producto['Descripcion'].'
							</div>
							<div class="col-md-3 border">
								'.$row['cantidad'].' x '.$row['precio_unitario'].'
							</div>
							<div class="col-md-3 border">
								'.$row['precio_total'].'
							</div>
						 </div>';

			$subtotal += $row['precio_total'];

		}

		mysqli_close($con);

		$content .= '</div>
		<div class="row mt-5 pr-5 pl-5 justify-content-end" style="align-items: center !important;">
			<div class="col-md-9">
				<div class="row justify-content-center">
					<div class="col-md-3 border-top mt-4" style="text-align: center;">
						<span class=""> Firma </span>
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<span>Subtotal: </span><br/>
				<span>IVA <small>16%:</small></span><br/>
				<span>Total: </span>
			</div>
			<div class="col-md-2">
				<span>$ '.$subtotal.'</span><br/>
				<span>$ '.($subtotal*0.16).'</span><br/>
				<span>$ '.($subtotal*1.16).'</span>
			</div>
		</div>
		</div>
</body>
</html>';

	$pdf->writeHTML($content, true, 0, true, 0);
 
	$pdf->lastPage();
	$pdf->output('Factura_FC-'.$venta.'.pdf', 'I');

}

generar_pdf($_GET['venta']);
?>