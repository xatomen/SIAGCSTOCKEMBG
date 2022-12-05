<?php include("../../template/cabecera.php");?>
<?php

$txtIDProveedor=(isset($_POST['txtIDProveedor']))?$_POST['txtIDProveedor']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtDireccion=(isset($_POST['txtDireccion']))?$_POST['txtDireccion']:"";
$txtInformacion=(isset($_POST['txtInformacion']))?$_POST['txtInformacion']:"";
$txtHorario=(isset($_POST['txtHorario']))?$_POST['txtHorario']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../../config/bd.php");

switch($accion){

    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO proveedor (NOMBRE, DIRECCION, INFORMACION, HORARIO) VALUES (:NOMBRE, :DIRECCION, :INFORMACION, :HORARIO);");
        $sentenciaSQL->bindParam(':NOMBRE',$txtNombre);
        $sentenciaSQL->bindParam(':DIRECCION',$txtDireccion);
        $sentenciaSQL->bindParam(':INFORMACION',$txtInformacion);
        $sentenciaSQL->bindParam(':HORARIO',$txtHorario);
        $sentenciaSQL->execute();
        echo "Presionado botón agregar";
    break;


    case "AgregarCorreo":
        $sentenciaSQL = $conexion->prepare("INSERT INTO correo_proveedor (COD_PROVEEDOR, CORREO) VALUES (:COD_PROVEEDOR, :CORREO);");
        $sentenciaSQL->bindParam(':COD_PROVEEDOR',$txtIDProveedor);
        $sentenciaSQL->bindParam(':CORREO', $txtCorreo);
        echo "Presionado botón agregar";
    break;

    case "AgregarTelefono":
        $sentenciaSQL = $conexion->prepare("INSERT INTO telefono_proveedor (COD_PROVEEDOR, COD_TIPO_FONO, NUMERO_TELEFONO) VALUES (:COD_PROVEEDOR, :COD_TIPO_FONO, :NUMERO_TELEFONO);");
        $sentenciaSQL->bindParam(':COD_PROVEEDOR',$txtIDProveedor);
        $sentenciaSQL->bindParam(':COD_TIPO_FONO', $txtTipoFono);
        $sentenciaSQL->bindParam(':NUMERO_TELEFONO', $txtNumeroTelefono);
        echo "Presionado botón agregar";
    break;

    
    case "Modificar":
        // echo "Presionado botón modificar";
        // $sentenciaSQL= $conexion->prepare("UPDATE categoria_insumo SET CATEGORIA_INSUMO=:CATEGORIA_INSUMO WHERE COD_CATEGORIA_INSUMO=:COD_CATEGORIA_INSUMO");
        // $sentenciaSQL->bindParam(':CATEGORIA_INSUMO',$txtCategoria);
        // $sentenciaSQL->bindParam(':COD_CATEGORIA_INSUMO',$txtID);
        // $sentenciaSQL->execute();

    break;

    case "Cancelar":
        // echo "Presionado botón cancelar";
        header("Location:stock.php");
    break;

    case "Seleccionar":
        // echo "Presionado botón seleccionar";
        // $sentenciaSQL= $conexion->prepare("SELECT * FROM categoria_insumo WHERE COD_CATEGORIA_INSUMO=:COD_CATEGORIA_INSUMO");
        // $sentenciaSQL->bindParam(':COD_CATEGORIA_INSUMO',$txtID);
        // $sentenciaSQL->execute();
        // $Categoria=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        // // $txtID = $Categoria['COD_CATEGORIA_INSUMO'];
        // $txtCategoria = $Categoria['CATEGORIA_INSUMO'];
    break;

    case "Borrar":
        // echo "Presionado botón borrar";
        // $sentenciaSQL= $conexion->prepare("DELETE FROM categoria_insumo WHERE COD_CATEGORIA_INSUMO=:COD_CATEGORIA_INSUMO");
        // $sentenciaSQL->bindParam(':COD_CATEGORIA_INSUMO',$txtID);
        // $sentenciaSQL->execute();    
    break;
}

$sentenciaSQL= $conexion->prepare("SELECT * FROM proveedor, correo_proveedor, telefono_proveedor, tipo_fono");
$sentenciaSQL->execute();
$listaProveedores=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container">
        <h1 class="text">Mantener Proveedores</h1>
    </div>

    <div class="col-md-5">
        Proveedor
        <div class="card">
            <div class="card-header">
                Proveedor
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                <div class = "form-group">
                        <label for="txtIDProveedor">ID Proveedor:</label>
                        <input type="text" class="form-control" value="<?php echo $txtIDProveedor ?>" name="txtIDProveedor" id="txtIDProveedor" placeholder="ID Proveedor">
                    </div>
                    
                    <div class = "form-group">
                        <label for="txtNombre">Nombre:</label>
                        <input type="text" class="form-control" value ="<?php echo $txtNombre ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
                    </div>
                    
                    <div class = "form-group">
                        <label for="txtDireccion">Direccion:</label>
                        <input type="text" class="form-control" value ="<?php echo $txtDireccion ?>" name="txtDireccion" id="txtDireccion" placeholder="Dirección">
                    </div>

                    <div class = "form-group">
                        <label for="txtInformacion">Información:</label>
                        <input type="text" class="form-control" value ="<?php echo $txtInformacion ?>" name="txtInformacion" id="txtInformacion" placeholder="Informació">
                    </div>

                    <div class = "form-group">
                        <label for="txtHorario">Horario:</label>
                        <input type="text" class="form-control" value ="<?php echo $txtHorario ?>" name="txtHorario" id="txtHorario" placeholder="Horario">
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
        Se muestran los proveedores
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Proveedor</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Información</th>
                    <th>Horario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaProveedores as $proveedor){ ?>
                <tr>
                    <td><?php echo $proveedor['COD_PROVEEDOR']?></td>
                    <td><?php echo $proveedor['NOMBRE']?></td>
                    <td><?php echo $proveedor['DIRECCIÓN']?></td>
                    <td><?php echo $proveedor['INFORMACIÓN']?></td>
                    <td><?php echo $proveedor['HORARIO']?></td>

                    <td>
                        Seleccionar | Borrar
                        <form method="POST">
                            <input type="hidden" name="txtIDProveedor" id="txtIDProveedor" value="<?php echo $proveedor['COD_PROVEEDOR']?>">
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