<?php include("../../template/cabecera.php");?>

<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtIDCategoria=(isset($_POST['txtIDCategoria']))?$_POST['txtIDCategoria']:"";
$txtCategoria=(isset($_POST['txtCategoria']))?$_POST['txtCategoria']:"";
$txtStock=(isset($_POST['txtStock']))?$_POST['txtStock']:"";
$txtInsumo=(isset($_POST['txtInsumo']))?$_POST['txtInsumo']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../../config/bd.php");

switch($accion){

    case "Agregar":
        $sentenciaSQL= $conexion->prepare("UPDATE insumo SET STOCK=STOCK+1 WHERE ID_INSUMO=$txtID");
        $sentenciaSQL->execute();
        echo "Presionado botón agregar";
        
    break;

    case "Quitar":
        // echo "Presionado botón modificar";
        $sentenciaSQL= $conexion->prepare("UPDATE insumo SET STOCK=STOCK-1 WHERE ID_INSUMO=$txtID");
        $sentenciaSQL->execute();

    break;

    case "BuscarInsumo":
        $sentenciaSQL3= $conexion->prepare("SELECT * FROM insumo WHERE NOMBRE LIKE '%$txtInsumo%';");
        $sentenciaSQL3->execute();
    break;

    case "BuscarCategoria":
        $sentenciaSQL4= $conexion->prepare("SELECT * FROM categoria_insumo WHERE CATEGORIA_INSUMO LIKE '%$txtCategoria%';");
        $sentenciaSQL4->execute();
        $Categoria=$sentenciaSQL4->fetch(PDO::FETCH_LAZY);
        $txtIDCategoria = $Categoria['COD_CATEGORIA_INSUMO'];
        $txtCategoria = $Categoria['CATEGORIA_INSUMO'];
    break;

}

$sentenciaSQL= $conexion->prepare("SELECT * FROM insumo");
$sentenciaSQL->execute();
$listaInsumos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL2= $conexion->prepare("SELECT * FROM categoria_insumo");
$sentenciaSQL2->execute();
$listaCategorias=$sentenciaSQL2->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL3= $conexion->prepare("SELECT * FROM insumo WHERE NOMBRE LIKE '%$txtInsumo%' AND ('$txtInsumo'<>'') ");
$sentenciaSQL3->execute();
$listaInsumos2=$sentenciaSQL3->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL4= $conexion->prepare("SELECT * FROM categoria_insumo WHERE CATEGORIA_INSUMO LIKE '%$txtCategoria%' AND ('txtCategoria'<>'')");
$sentenciaSQL4->execute();
$listaCategorias2=$sentenciaSQL4->fetchAll(PDO::FETCH_ASSOC);

?>

    

    <div class="container">
            <h1 class="text">Buscar stock específico</h1>
    </div>

    <div class="col-md-2">
        Buscar por ID
        <div class="card">
            <div class="card-header">
                Buscador
            </div>

            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class = "form-group">
                        <label for="txtID">ID:</label>
                        <input type="text" class="form-control" value="<?php echo $txtID ?>" name="txtID" id="txtID" placeholder="ID">
                    </div>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" value="Buscar" class="btn btn-success">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-10">
        Stock por ID
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Categoría</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaInsumos as $insumo) {
                    if ($insumo['ID_INSUMO'] == $txtID) { ?>
                <tr>
                    <td><?php echo $insumo['ID_INSUMO'] ?></td>
                    <td><?php echo $insumo['COD_CATEGORIA_INSUMO'] ?></td>
                    <td><?php foreach($listaCategorias as $categoria){if($categoria['COD_CATEGORIA_INSUMO']==$insumo['COD_CATEGORIA_INSUMO']){echo $categoria['CATEGORIA_INSUMO'];}} ?></td>
                    <td><?php echo $insumo['STOCK'] ?></td>
                    <td><?php echo $insumo['NOMBRE'] ?></td>
                    <td> Añadir 1 | Quitar 1

                        <form method="POST">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $insumo['ID_INSUMO'] ?>">
                            <input type="submit" name="accion" value="Agregar" class="btn btn-primary">
                            <input type="submit" name="accion" value="Quitar" class="btn btn-danger">
                        </form>

                    </td>
                </tr>
                <?php }
                } ?>
            </tbody>
        </table> 
    </div>

    <div class="col-md-2">
        Buscar por nombre de insumo
        <div class="card">
            <div class="card-header">
                Buscador
            </div>

            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class = "form-group">
                        <label for="txtInsumo">Nombre:</label>
                        <input type="text" class="form-control" value="<?php echo $txtInsumo ?>" name="txtInsumo" id="txtInsumo" placeholder="Nombre">
                    </div>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" value="BuscarInsumo" class="btn btn-success">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-10">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaInsumos2 as $insumo2) {
                     ?>
                <tr>
                    <td><?php echo $insumo2['ID_INSUMO'] ?></td>
                    <td><?php echo $insumo2['COD_CATEGORIA_INSUMO'] ?></td>
                    <td><?php echo $insumo2['STOCK'] ?></td>
                    <td><?php echo $insumo2['NOMBRE'] ?></td>
                    <td> Añadir 1 | Quitar 1

                        <form method="POST">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $insumo['ID_INSUMO'] ?>">
                            <input type="submit" name="accion" value="Agregar" class="btn btn-primary">
                            <input type="submit" name="accion" value="Quitar" class="btn btn-danger">
                        </form>

                    </td>
                </tr>
                <?php }
                 ?>
            </tbody>
        </table> 
    </div>

    <div class="container">
            <h1 class="text">Mostrar insumos por categoría</h1>
    </div>

    <div class="col-md-2">
        Buscar por ID de Categoría
        <div class="card">
            <div class="card-header">
                Buscador
            </div>

            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class = "form-group">
                        <label for="txtIDCategoria">ID Categoría:</label>
                        <input type="text" class="form-control" value="<?php echo $txtIDCategoria ?>" name="txtIDCategoria" id="txtIDCategoria" placeholder="ID">
                    </div>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" value="Buscar" class="btn btn-success">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-10">
        Stock por categoría </br>
        -
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Categoría</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaInsumos as $insumo) {
                    if ($insumo['COD_CATEGORIA_INSUMO'] == $txtIDCategoria) { ?>
                <tr>
                    <td><?php echo $insumo['ID_INSUMO'] ?></td>
                    <td><?php echo $insumo['COD_CATEGORIA_INSUMO'] ?></td>
                    <td><?php foreach($listaCategorias as $categoria){if($categoria['COD_CATEGORIA_INSUMO']==$insumo['COD_CATEGORIA_INSUMO']){echo $categoria['CATEGORIA_INSUMO'];}} ?></td>
                    <td><?php echo $insumo['STOCK'] ?></td>
                    <td><?php echo $insumo['NOMBRE'] ?></td>
                    <td> Añadir 1 | Quitar 1

                        <form method="POST">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $insumo['ID_INSUMO'] ?>">
                            <input type="submit" name="accion" value="Agregar" class="btn btn-primary">
                            <input type="submit" name="accion" value="Quitar" class="btn btn-danger">
                        </form>

                    </td>
                </tr>
                <?php }
                } ?>
            </tbody>
        </table> 
    </div>

    <div class="col-md-2">
        Buscar por nombre de Categoría
        <div class="card">
            <div class="card-header">
                Buscador
            </div>

            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class = "form-group">
                        <label for="txtCategoria">Nombre Categoría:</label>
                        <input type="text" class="form-control" value="<?php echo $txtCategoria ?>" name="txtCategoria" id="txtCategoria" placeholder="Nombre">
                    </div>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" value="BuscarCategoria" class="btn btn-success">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-10">
        Stock por categoría </br>
        -
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Categoría</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaInsumos as $insumo) {
                    if ($insumo['COD_CATEGORIA_INSUMO'] == $txtIDCategoria) { ?>
                <tr>
                    <td><?php echo $insumo['ID_INSUMO'] ?></td>
                    <td><?php echo $insumo['COD_CATEGORIA_INSUMO'] ?></td>
                    <td><?php foreach($listaCategorias2 as $categoria){if($categoria['COD_CATEGORIA_INSUMO']==$insumo['COD_CATEGORIA_INSUMO']){echo $categoria['CATEGORIA_INSUMO'];}} ?></td>
                    <td><?php echo $insumo['STOCK'] ?></td>
                    <td><?php echo $insumo['NOMBRE'] ?></td>
                    <td> Añadir 1 | Quitar 1

                        <form method="POST">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $insumo['ID_INSUMO'] ?>">
                            <input type="submit" name="accion" value="Agregar" class="btn btn-primary">
                            <input type="submit" name="accion" value="Quitar" class="btn btn-danger">
                        </form>

                    </td>
                </tr>
                <?php }
                } ?>
            </tbody>
        </table> 
    </div>


    <div class="container">
            <h1 class="text">Mostrar stock disponible</h1>
    </div>

    <div class="col-md-10">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Categoría</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaInsumos as $insumo){ ?>
                <tr>
                    <td><?php echo $insumo['ID_INSUMO']?></td>
                    <td><?php echo $insumo['COD_CATEGORIA_INSUMO']?></td>
                    <td><?php foreach($listaCategorias as $categoria){if($categoria['COD_CATEGORIA_INSUMO']==$insumo['COD_CATEGORIA_INSUMO']){echo $categoria['CATEGORIA_INSUMO'];}} ?></td>
                    <td><?php echo $insumo['STOCK']?></td>
                    <td><?php echo $insumo['NOMBRE']?></td>
                    <td> Añadir 1 | Quitar 1

                        <form method="POST">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $insumo['ID_INSUMO']?>">
                            <input type="submit" name="accion" value="Agregar" class="btn btn-primary">
                            <input type="submit" name="accion" value="Quitar" class="btn btn-danger">

                        </form>

                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table> 
    </div>

<?php include("../../template/pie.php");?>