<?php
include "configs/configs.php";
include "configs/funciones.php";
//session_start();

if(isset($_SESSION['logeado'])&& $_SESSION['logeado']==true){
}else{
	echo"Iniciar Sesion para acceder a este contenido<br>";
	header("location:login.php"); //redirige a la pagina de login
exit;
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Tienda Online</title>
	<link rel="stylesheet" href="css/estilo.css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body bgcolor="SILVER">
     <?php
    
     
     $sentencia="select * from productos";
     $resultado= mysqli_query($con,$sentencia);
   // var_dump($resultado);
    // exit;
     ?>
     <div>
     	<table>
     		<thead>
     			<tr>
     				<th>id_productos</th>
     				<th>codigo</th>
     				<th>nombre_producto</th>
     				<th>id_categoria</th>
     				<th>precio_uni</th>
     				<th>cantidad</th>
     				<th>descripcion</th>
     				<th>id_usuario</th>
     				<th><a href="./configs/formularioAgregar.php">Nuevo</a></th>
     			</tr>
     		</thead>
     		<tbody>
     		<?php while($filas=mysqli_fetch_assoc($resultado)){?>  

     	<tr>
     		<td><?php echo $filas['id_productos'] ?></td>
     		<td><?php echo $filas['codigo']?></td>
     		<td><?php echo $filas['nombre_producto']?></td>
     		<td><?php echo $filas['id_categoria']?></td>
     		<td><?php echo $filas['precio_uni']?></td>
     		<td><?php echo $filas['cantidad']?></td>
     		<td><?php echo $filas['descripcion']?></td>
     		<td><?php echo $filas['id_usuario']?></td>
     		<td>
     		
     	    <a href="./configs/formulario.php">Editar</a>
     		<a href="./configs/eliminar.php?id_producto=<?php echo $filas['id_productos'];?>">Eliminar</a>
     		
     		
            <?php
            if(isset($_GET['status'])){ //Verificar que la variable tenga contenido que no sea nulo
               $status=$_GET['status'];
               echo $status;
             } 
         ?>
        

     		</td>
     	</tr>
     	<?php } ?>
     </tbody>
    
     </div>
    
	<div class="header">
		Tienda Online
	</div>
		<div class="menu">
			<a href="Index.php">Principal</a>
			<a href="?p=productos">Productos</a>
			<a href="?p=carrito">Carrito</a>
     		<a href="p=categorias">Categorias</a>
</div>
    <div class="cuerpo">
    	<?php
       if(isset($_GET['p'])){

    	$p=$_GET['p'];
    	if(@file_exists("".$p.".php")){
    	include "".$p.".php";
    	}else{
    	echo "<i>No se ha encontrado el modulo <b>".$p."</b> <a href='./'>Regresar</a></i>";
    	}

    }
     
    	?>

	</div>
	<div class="footer">

	</div>
    <?php
   
     $sentencia="select * from productos";
     $resultado= mysqli_query($con,$sentencia);
     while($filas=mysqli_fetch_assoc($resultado)){
     ?> 
       <link rel="stylesheet" href="css/estiloproducto.css"/>
	<div class="Producto">
         <center>
         	<img class="imagen-produ"src="./producto/<?php echo $filas['imagen'];?>"><br>
         	<pre><span class="name-produ"><?php echo $filas['nombre_producto'];?></span><pre>
            <br><span class="precio-produ">Precio:<?php echo $filas['precio_uni'];?></span><br>
         	<a href="./detalles.php?id_productos=<?php echo $filas['id_productos'];?>">ver</a>
         	<button class="boton agregar" onclick="javascript:agregar_carro(<?=$filas['id_productos']?>)"><i class="fas fa-cart-plus"></i></button>
         	  </center>
	</div>
	<?php
   }
	?>
	
	<script type="text/javascript">

		function agregar_carro(id_producto){
			var cant = prompt("¿Que cantidad desea agregar?",1);
			if (cant.length>0){
				window.location="cart.php?idproducto="+id_producto+"&cant="+cant;
			}
		}

	</script>

	<script type="text/javascript">
		
		function alert($var){
		    alert("<?=$var?>");
        }
    </script>
	

</body>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
</html>