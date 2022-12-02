<?php include("../template/cabecera.php");?>
<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtCategoria=(isset($_POST['txtCategoria']))?$_POST['txtCategoria']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/bd.php");

switch($accion){

    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO categoria_insumo (CATEGORIA_INSUMO) VALUES (:CATEGORIA_INSUMO);");
        $sentenciaSQL->bindParam(':CATEGORIA_INSUMO',$txtCategoria);
        $sentenciaSQL->execute();
        echo "Presionado botón agregar";
    break;

    case "Modificar":
        echo "Presionado botón modificar";
    break;

    case "Cancelar":
        echo "Presionado botón cancelar";
    break;

}

$sentenciaSQL= $conexion->prepare("SELECT * FROM categoria_insumo");
$sentenciaSQL->execute();
$listaCategorias=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>


    <div class="container">
            <h1 class="text">Stock</h1>
    </div>

    <div class="col-md-5">
        Formulario de gestionar stock
        <div class="card">
            <div class="card-header">
                Categorías
            </div>

            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class = "form-group">
                        <label for="txtID">ID:</label>
                        <input type="text" class="form-control" name="txtID" id="txtID" placeholder="ID">
                    </div>
                    
                    <div class = "form-group">
                        <label for="txtID">Categoría:</label>
                        <input type="text" class="form-control" name="txtCategoria" id="txtCategoria" placeholder="Nombre categoría">
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
                    <td>Seleccionar | Borrar</td>
                </tr>
                <?php } ?>
            </tbody>
        </table> 
    </div>

<?php include("../template/pie.php");?>