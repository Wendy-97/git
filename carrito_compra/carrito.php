<?php
	include 'conexion.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Carrito de Compras</title>

		<!-- JQuery -->
		<script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
		<!--<script src="carrito/src/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="carrito/src/bootstrap.min.css">-->

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin ="anonymous">

	</head>
	<body>
		<script>

			var lista = new Array();
			var subtotal;
			var total;

			function cantidad(codigo){

				for(var i=0; i<lista.length; i++){
					if(lista[i].codigo == codigo){
						lista[i].cantidad = parseInt($('#cantidad_'+codigo).val(), 10);
					}
				}

				subtotal = 0.0;

				for(var i=0; i<lista.length; i++){
					subtotal += (lista[i].precio)*(lista[i].cantidad);
				}

				total = (subtotal*1.16);
				iva = (subtotal*.16);
				console.log(subtotal.toFixed(2));

				$('#subtotal').empty();
				$('#subtotal').text("$"+subtotal.toFixed(2));
				$('#total').empty();
				$('#total').text("$"+total.toFixed(2));
				$('#iva').empty();
				$('#iva').text("$"+iva.toFixed(2)+" 16%");

				console.log(lista);
			}

			function borrar(codigo){

				var contador = 0;
				var flag = true;

				for(var i=0; i<lista.length; i++){
					if(lista[i].codigo == codigo){
						flag = true;
						break;
					}
					contador++;
				}

				console.log(contador);
				lista.splice(contador, 1);

				$('#'+codigo).remove();

				console.log("Se borró y actualizó:");
				console.log(lista);

				subtotal = 0.0;

				for(var i=0; i<lista.length; i++){
					subtotal += (lista[i].precio)*(lista[i].cantidad);
				}

				console.log(subtotal.toFixed(2));

				total = (subtotal*1.16);
				iva = (subtotal*.16);

				$('#subtotal').empty();
				$('#subtotal').text("$"+subtotal.toFixed(2));

				$('#total').empty();
				$('#total').text("$"+total.toFixed(2));

				$('#iva').empty();
				$('#iva').text("$"+iva.toFixed(2)+" 16%");

				console.log(lista);

			}

			function buscar_articulo(){
				var codigo = $('#code').val();
				var flag = false;
				
				//console.log(codigo);

				for(var e in lista){
                        if(lista[e].codigo == codigo){
                        	flag = true;
                        	break;
                        }

                     };

				if(flag == false){

					$.ajax({
						url: "carrito/ajax_select_article.php",
						data: {articulo: codigo},
						type: "POST",
						dataType:'json',
					}).done(function(respuesta){
						console.log(respuesta.codigo + " " + respuesta.articulo + " " + respuesta.precio);
						var precio = parseFloat((Math.random() * (1 - 100) + 100).toFixed(2), 10);
						lista.push({
							codigo: respuesta.codigo,
							articulo: respuesta.articulo,
							precio: respuesta.precio,
							cantidad: 0,
						});

						$('#no-list').remove();

						$('#listado').append('<div id="'+respuesta.codigo+'" class="row border"><div class="col-md-2" style="text-align: center;">'+ respuesta.codigo + '</div><div class="col-md-5">'+ respuesta.articulo +'</div><div class="col-md-2" style="text-align: center;">$'+ respuesta.precio +'</div><div class="col-md-3"><div class="row"> <div class="col-md-6" style="text-align: center;"><input type="number" style="width: 80px" name="cantidad" value="0" min="0" max="'+respuesta.cantidad+'" id="cantidad_'+respuesta.codigo+'" onchange="javascript:cantidad('+respuesta.codigo+');"/></div><div class="col-md-6" style="text-align: center;"><a href="#" onclick="javascript:borrar('+respuesta.codigo+');"><i class="fas fa-trash"></i></button></div></div>');

					});
				}	

				console.log(lista);
			}

			function sell(){

				for(var i=0; i<lista.length; i++){
					if(lista[i].cantidad == 0){
						lista.splice(i, 1);
					}
				}

				subtotal = 0.0;

				for(var i=0; i<lista.length; i++){
					subtotal += (lista[i].precio)*(lista[i].cantidad);
				}

				total = (subtotal*1.16);
				iva = (subtotal*.16);

				console.log(lista);

				for(var i=0; i<lista.length; i++){
					console.log(lista[i].cantidad+" de "+lista[i].articulo+" con "+lista[i].precio+" c/u");
				}
					console.log("subtotal: "+subtotal);
					console.log("total: "+total);

				$.ajax({
						url: "carrito/ajax_insert_venta.php",
						data: {subtotal: subtotal, total: total, lista: lista},
						type: "POST",
						dataType:'json',
					}).done(function(respuesta){
						console.log("entro a proceso de factura");
						console.log(respuesta.estatus + " " + respuesta.venta);
						if(respuesta.estatus == "ok"){
							console.log("entro a proceso de factura");

							window.location.href='carrito/factura.php?venta='+respuesta.venta+'';
							/*$.ajax({
									url: "carrito/ajax_generar_factura.php",
									data: {venta: respuesta.venta},
									type: "POST",
								}).done(function(estatus){
									console.log(estatus);
								});*/
							console.log(respuesta.venta);
						}
					});

			}

		</script>
		<div class="container">
			<div class="row mt-5 mb-3">
				<div class="col-md-3">
					<input type="text" class="form-control" name="code" id="code" placeholder="Código de artículo" autocomplete="off"/>
				</div>
				<div class="col-md-1">
					<input type="button" class="btn btn-primary" id="buscar" value="Buscar" onclick="javascript:buscar_articulo();" />
				</div>
			</div>
			<!-- Listado de artículos --> 

			<div class="row">
				<div class="col-md-9">
					<div id="listado">
						<div class="row bg-light " style="text-align: center;">
							<div class="col-md-2 border p-1"><b>Código</b></div>
							<div class="col-md-5 border p-1"><b>Artículo</b></div>
							<div class="col-md-2 border p-1"><b>Precio</b></div>
							<div class="col-md-3 border p-1"><b>Cantidad</b></div>
						</div>
						<div class="row border justify-content-center p-3" id="no-list">
							<span>Sin artículos seleccionados</span>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="row ml-6 mt-3">
						<div class="col-md-6" style="text-align: right;">
							<span class="">Subtotal:</span>
						</div>
						<div class="col-md-6"><span id="subtotal">$0.0</span></div>
					</div>
					<div class="row ml-6">
						<div class="col-md-6" style="text-align: right;">
							<span class="">IVA:</span>
						</div>
						<div class="col-md-6"><span id="iva">$0.0 16%</span></div>
					</div>
					<div class="row ml-6">
						<div class="col-md-6" style="text-align: right;">
							<span class="">Total:</span>
						</div>
						<div class="col-md-6"><b><span id="total">$0.0</span></b></div>
					</div>
					<div class="row ml-2 mt-4">
						<div class="col-md-12">
							<input type="button" class="btn btn-success btn-block" id="comprar" value="Comprar" onclick="javascript:sell();">
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
