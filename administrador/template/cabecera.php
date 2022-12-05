<?php
  session_start();
  if(!isset($_SESSION['usuario'])){
    header("Location:../index.php");
  }
  else {
    if ($_SESSION['usuario'] == "ok") {
      $nombreUsuario = $_SESSION["nombreUsuario"];
      
    }
  }
?>

<?php $url="http://".$_SERVER['HTTP_HOST']."/SIAGCSTOCKEMBG"?>
<!doctype html>
<html lang="en">
  <head>
    <title>Inicio - SIA GC STOCK EMBG</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $url;?>/css/style.css">    
  </head>
  <body>

    <?php $url="http://".$_SERVER['HTTP_HOST']."/SIAGCSTOCKEMBG"?>

    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="<?php echo $url;?>/administrador/inicio.php"><img src="<?php echo $url;?>/src/logo.jpg" style='width:100px; height:100px'></a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/inicio.php"><H2>Inicio</H2></a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/stock.php"><H2>Stock</H2></a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/proveedores.php"><H2>Proveedores</H2></a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/credenciales.php"><H2>Gestionar credenciales</H2></a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/cerrar.php"><H2>Cerrar sesión</H2></a>
        </div>
    </nav>

    <!-- <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown button
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
        </div>
    </div> -->

    <div class="container">
      <div class="row">