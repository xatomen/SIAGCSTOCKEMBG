<?php include("../../template/cabecera.php");?>
<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtCategoria=(isset($_POST['txtCategoria']))?$_POST['txtCategoria']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../../config/bd.php");

switch($accion){

    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO categoria_insumo (CATEGORIA_INSUMO) VALUES (:CATEGORIA_INSUMO);");
        $sentenciaSQL->bindParam(':CATEGORIA_INSUMO',$txtCategoria);
        $sentenciaSQL->execute();
        echo "Presionado botón agregar";
    break;

    case "Modificar":
        // echo "Presionado botón modificar";
        $sentenciaSQL= $conexion->prepare("UPDATE categoria_insumo SET CATEGORIA_INSUMO=:CATEGORIA_INSUMO WHERE COD_CATEGORIA_INSUMO=:COD_CATEGORIA_INSUMO");
        $sentenciaSQL->bindParam(':CATEGORIA_INSUMO',$txtCategoria);
        $sentenciaSQL->bindParam(':COD_CATEGORIA_INSUMO',$txtID);
        $sentenciaSQL->execute();

    break;

    case "Cancelar":
        // echo "Presionado botón cancelar";
        header("Location:stock.php");
    break;

    case "Seleccionar":
        // echo "Presionado botón seleccionar";
        $sentenciaSQL= $conexion->prepare("SELECT * FROM categoria_insumo WHERE COD_CATEGORIA_INSUMO=:COD_CATEGORIA_INSUMO");
        $sentenciaSQL->bindParam(':COD_CATEGORIA_INSUMO',$txtID);
        $sentenciaSQL->execute();
        $Categoria=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        // $txtID = $Categoria['COD_CATEGORIA_INSUMO'];
        $txtCategoria = $Categoria['CATEGORIA_INSUMO'];
    break;

    case "Borrar":
        // echo "Presionado botón borrar";
        $sentenciaSQL= $conexion->prepare("DELETE FROM categoria_insumo WHERE COD_CATEGORIA_INSUMO=:COD_CATEGORIA_INSUMO");
        $sentenciaSQL->bindParam(':COD_CATEGORIA_INSUMO',$txtID);
        $sentenciaSQL->execute();    
    break;
}

$sentenciaSQL= $conexion->prepare("SELECT * FROM categoria_insumo");
$sentenciaSQL->execute();
$listaCategorias=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

    <div class="container">
            <h1 class="text">Categorías</h1>
    </div>

    <div class="col-md-5">
        Modificar categorías
        <div class="card">
            <div class="card-header">
                Categorías
            </div>

            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class = "form-group">
                        <label for="txtID">ID:</label>
                        <input type="text" class="form-control" value="<?php echo $txtID ?>" name="txtID" id="txtID" placeholder="ID">
                    </div>
                    
                    <div class = "form-group">
                        <label for="txtID">Categoría:</label>
                        <input type="text" class="form-control" value ="<?php echo $txtCategoria ?>" name="txtCategoria" id="txtCategoria" placeholder="Nombre categoría">
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
        Se muestran las categorías
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaCategorias as $categoria_insumo){ ?>
                <tr>
                    <td><?php echo $categoria_insumo['COD_CATEGORIA_INSUMO']?></td>
                    <td><?php echo $categoria_insumo['CATEGORIA_INSUMO']?></td>
                    <td>
                        Seleccionar | Borrar
                        <form method="POST">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $categoria_insumo['COD_CATEGORIA_INSUMO']?>">
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