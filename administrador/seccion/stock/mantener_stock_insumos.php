<?php include("../../template/cabecera.php");?>
<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtIDCategoria=(isset($_POST['txtIDCategoria']))?$_POST['txtIDCategoria']:"";
$txtStock=(isset($_POST['txtStock']))?$_POST['txtStock']:"";
$txtInsumo=(isset($_POST['txtInsumo']))?$_POST['txtInsumo']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../../config/bd.php");

switch($accion){

    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO insumo (ID_INSUMO, COD_CATEGORIA_INSUMO, STOCK, NOMBRE) VALUES (:ID_INSUMO, $txtIDCategoria, :STOCK, :NOMBRE);");
        $sentenciaSQL->bindParam(':ID_INSUMO',$txtID);
        // $sentenciaSQL->bindParam(':COD_CATEGORIA_INSUMO',$txtIDCategoria);
        $sentenciaSQL->bindParam(':STOCK', $txtStock);
        $sentenciaSQL->bindParam(':NOMBRE', $txtInsumo);
        $sentenciaSQL->execute();
        echo "Presionado botón agregar";
    break;

    case "Modificar":
        // echo "Presionado botón modificar";
        $sentenciaSQL= $conexion->prepare("UPDATE insumo SET COD_CATEGORIA_INSUMO=$txtIDCategoria, STOCK=$txtStock, NOMBRE=:NOMBRE WHERE ID_INSUMO=$txtID");
        // $sentenciaSQL->bindParam(':ID_INSUMO',$txtID);
        // $sentenciaSQL->bindParam(':COD_CATEGORIA_INSUMO',$txtIDCategoria);
        // $sentenciaSQL->bindParam(':STOCK', $txtStock);
        $sentenciaSQL->bindParam(':NOMBRE', $txtInsumo);
        $sentenciaSQL->execute();

    break;

    case "Cancelar":
        // echo "Presionado botón cancelar";
        header("Location:stock.php");
    break;

    case "Seleccionar":
        // echo "Presionado botón seleccionar";
        $sentenciaSQL= $conexion->prepare("SELECT * FROM insumo WHERE ID_INSUMO=:ID_INSUMO");
        $sentenciaSQL->bindParam(':ID_INSUMO',$txtID);
        $sentenciaSQL->execute();
        $Insumo=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtID = $Insumo['ID_INSUMO'];
        $txtIDCategoria = $Insumo['COD_CATEGORIA_INSUMO'];
        $txtStock = $Insumo['STOCK'];
        $txtInsumo = $Insumo['NOMBRE'];
    break;

    case "Borrar":
        // echo "Presionado botón borrar";
        $sentenciaSQL= $conexion->prepare("DELETE FROM insumo WHERE ID_INSUMO=:ID_INSUMO");
        $sentenciaSQL->bindParam(':ID_INSUMO',$txtID);
        $sentenciaSQL->execute();    
    break;
}

$sentenciaSQL= $conexion->prepare("SELECT * FROM insumo");
$sentenciaSQL->execute();
$listaInsumos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

    <div class="container">
            <h1 class="text">Stock</h1>
    </div>

    <div class="col-md-5">
        Modificar Insumos
        <div class="card">
            <div class="card-header">
                Insumos
            </div>

            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class = "form-group">
                        <label for="txtID">ID:</label>
                        <input type="text" class="form-control" value="<?php echo $txtID ?>" name="txtID" id="txtID" placeholder="ID">
                    </div>
                    
                    <div class = "form-group">
                        <label for="txtIDCategoría">Categoría:</label>
                        <input type="text" class="form-control" value ="<?php echo $txtIDCategoria ?>" name="txtIDCategoria" id="txtIDCategoria" placeholder="ID Categoría">
                    </div>

                    <div class = "form-group">
                        <label for="txtStock">Stock:</label>
                        <input type="text" class="form-control" value ="<?php echo $txtStock ?>" name="txtStock" id="txtStock" placeholder="Stock">
                    </div>

                    <div class = "form-group">
                        <label for="txtInsumo">Nombre:</label>
                        <input type="text" class="form-control" value ="<?php echo $txtInsumo ?>" name="txtInsumo" id="txtInsumo" placeholder="Nombre insumo">
                    </div>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
                        <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
                        <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaInsumos as $insumo){ ?>
                <tr>
                    <td><?php echo $insumo['ID_INSUMO']?></td>
                    <td><?php echo $insumo['COD_CATEGORIA_INSUMO']?></td>
                    <td><?php echo $insumo['STOCK']?></td>
                    <td><?php echo $insumo['NOMBRE']?></td>
                    <td>
                        Seleccionar | Borrar
                        <form method="POST">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $insumo['ID_INSUMO']?>">
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger">

                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table> 
    </div>


<?php include("../../template/pie.php");?>