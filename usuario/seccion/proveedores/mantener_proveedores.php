<?php include("../../template/cabecera.php");?>
<?php

$txtIDProveedor=(isset($_POST['txtIDProveedor']))?$_POST['txtIDProveedor']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtDireccion=(isset($_POST['txtDireccion']))?$_POST['txtDireccion']:"";
$txtInformacion=(isset($_POST['txtInformacion']))?$_POST['txtInformacion']:"";
$txtHorario=(isset($_POST['txtHorario']))?$_POST['txtHorario']:"";

$txtIDCorreo=(isset($_POST['txtIDCorreo']))?$_POST['txtIDCorreo']:"";
$txtIDTelefono=(isset($_POST['txtIDTelefono']))?$_POST['txtIDTelefono']:"";

$txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
$txtIDTipoFono=(isset($_POST['txtIDTipoFono']))?$_POST['txtIDTipoFono']:"";
$txtTelefono=(isset($_POST['txtTelefono']))?$_POST['txtTelefono']:"";


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

    case "Modificar":
        echo "Presionado botón modificar";
        $sentenciaSQL= $conexion->prepare("UPDATE proveedor SET NOMBRE=:NOMBRE, DIRECCION=:DIRECCION, INFORMACION=:INFORMACION, HORARIO=:HORARIO WHERE COD_PROVEEDOR=:COD_PROVEEDOR");
        $sentenciaSQL->bindParam(':COD_PROVEEDOR',$txtIDProveedor);
        $sentenciaSQL->bindParam(':NOMBRE',$txtNombre);
        $sentenciaSQL->bindParam(':DIRECCION',$txtDireccion);
        $sentenciaSQL->bindParam(':INFORMACION',$txtInformacion);
        $sentenciaSQL->bindParam(':HORARIO',$txtHorario);
        $sentenciaSQL->execute();

    break;

    case "Seleccionar":
        // echo "Presionado botón seleccionar";
        $sentenciaSQL= $conexion->prepare("SELECT * FROM proveedor WHERE COD_PROVEEDOR=:COD_PROVEEDOR");
        $sentenciaSQL->bindParam(':COD_PROVEEDOR',$txtIDProveedor);
        $sentenciaSQL->execute();
        $Proveedor=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtIDProveedor = $Proveedor['COD_PROVEEDOR'];
        $txtNombre = $Proveedor['NOMBRE'];
        $txtDireccion = $Proveedor['DIRECCION'];
        $txtInformacion = $Proveedor['INFORMACION'];
        $txtHorario = $Proveedor['HORARIO'];
    break;

    case "Borrar":
        // echo "Presionado botón borrar";
        $sentenciaSQL= $conexion->prepare("DELETE FROM proveedor WHERE COD_PROVEEDOR=:COD_PROVEEDOR");
        $sentenciaSQL->bindParam(':COD_PROVEEDOR',$txtIDProveedor);
        $sentenciaSQL->execute();    
    break;



    case "AgregarCorreo":
        $sentenciaSQL2 = $conexion->prepare("INSERT INTO correo_proveedor (COD_PROVEEDOR, CORREO) VALUES (:COD_PROVEEDOR, :CORREO);");
        $sentenciaSQL2->bindParam(':COD_PROVEEDOR',$txtIDProveedor);
        $sentenciaSQL2->bindParam(':CORREO', $txtCorreo);
        $sentenciaSQL2->execute();
        echo "Presionado botón agregar correo";
    break;

    case "ModificarCorreo":
        $sentenciaSQL2 = $conexion->prepare("UPDATE correo_proveedor SET COD_PROVEEDOR=:COD_PROVEEDOR, CORREO=:CORREO WHERE COD_CORREO_PROVEEDOR=:COD_CORREO_PROVEEDOR;");
        $sentenciaSQL2->bindParam(':COD_CORREO_PROVEEDOR',$txtIDCorreo);
        $sentenciaSQL2->bindParam(':COD_PROVEEDOR',$txtIDProveedor);
        $sentenciaSQL2->bindParam(':CORREO', $txtCorreo);
        $sentenciaSQL2->execute();   
        echo "Presionado botón agregar";
    break;

    case "SeleccionarCorreo":
        $sentenciaSQL2= $conexion->prepare("SELECT * FROM correo_proveedor WHERE COD_CORREO_PROVEEDOR=:COD_CORREO_PROVEEDOR");
        $sentenciaSQL2->bindParam(':COD_CORREO_PROVEEDOR',$txtIDCorreo);
        $sentenciaSQL2->execute();
        $Correo=$sentenciaSQL2->fetch(PDO::FETCH_LAZY);
        $txtIDCorreo = $Correo['COD_CORREO_PROVEEDOR'];
        $txtIDProveedor = $Correo['COD_PROVEEDOR'];
        $txtCorreo = $Correo['CORREO'];
    break;

    case "BorrarCorreo":
        $sentenciaSQL2= $conexion->prepare("DELETE FROM correo_proveedor WHERE COD_CORREO_PROVEEDOR=:COD_CORREO_PROVEEDOR");
        $sentenciaSQL2->bindParam(':COD_CORREO_PROVEEDOR',$txtIDCorreo);
        $sentenciaSQL2->execute();   
        echo "Presionado botón agregar";
    break;

    case "AgregarTelefono":
        $sentenciaSQL3 = $conexion->prepare("INSERT INTO telefono_proveedor (COD_PROVEEDOR, COD_TIPO_FONO, NUMERO_TELEFONO) VALUES (:COD_PROVEEDOR, :COD_TIPO_FONO, :NUMERO_TELEFONO);");
        $sentenciaSQL3->bindParam(':COD_PROVEEDOR',$txtIDProveedor);
        $sentenciaSQL3->bindParam(':COD_TIPO_FONO', $txtIDTipoFono);
        $sentenciaSQL3->bindParam(':NUMERO_TELEFONO', $txtTelefono);
        $sentenciaSQL3->execute();   
        echo "Presionado botón agregar telefono";
    break;

    case "ModificarTelefono":
        $sentenciaSQL3 = $conexion->prepare("UPDATE telefono_proveedor SET COD_PROVEEDOR=:COD_PROVEEDOR, COD_TIPO_FONO=:COD_TIPO_FONO, NUMERO_TELEFONO=:NUMERO_TELEFONO WHERE COD_TELEFONO=:COD_TELEFONO;");
        $sentenciaSQL3->bindParam(':COD_TELEFONO',$txtIDTelefono);
        $sentenciaSQL3->bindParam(':COD_PROVEEDOR',$txtIDProveedor);
        $sentenciaSQL3->bindParam(':COD_TIPO_FONO', $txtIDTipoFono);
        $sentenciaSQL3->bindParam(':NUMERO_TELEFONO', $txtTelefono);
        $sentenciaSQL3->execute();   
        echo "Presionado botón agregar";
    break;

    case "SeleccionarTelefono":
        $sentenciaSQL3= $conexion->prepare("SELECT * FROM telefono_proveedor WHERE COD_TELEFONO=:COD_TELEFONO");
        $sentenciaSQL3->bindParam(':COD_TELEFONO',$txtIDTelefono);
        $sentenciaSQL3->execute();
        $Telefono=$sentenciaSQL3->fetch(PDO::FETCH_LAZY);
        $txtIDTelefono = $Telefono['COD_TELEFONO'];
        $txtIDProveedor = $Telefono['COD_PROVEEDOR'];
        $txtIDTipoFono = $Telefono['COD_TIPO_FONO'];
        $txtTelefono = $Telefono['NUMERO_TELEFONO'];
    break;

    case "BorrarTelefono":
        $sentenciaSQL3= $conexion->prepare("DELETE FROM telefono_proveedor WHERE COD_TELEFONO=:COD_TELEFONO");
        $sentenciaSQL3->bindParam(':COD_TELEFONO',$txtIDTelefono);
        $sentenciaSQL3->execute();   
        echo "Presionado botón agregar";
    break;

    case "Cancelar":
        // echo "Presionado botón cancelar";
        header("Location:mantener_proveedores.php");
    break;

}

$sentenciaSQL= $conexion->prepare("SELECT * FROM proveedor");
$sentenciaSQL->execute();
$listaProveedores=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL2= $conexion->prepare("SELECT * FROM correo_proveedor");
$sentenciaSQL2->execute();
$listaCorreos=$sentenciaSQL2->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL3= $conexion->prepare("SELECT * FROM telefono_proveedor");
$sentenciaSQL3->execute();
$listaTelefonos=$sentenciaSQL3->fetchAll(PDO::FETCH_ASSOC);

?>

    <div class="container">
        <h1 class="text">Mantener Proveedores</h1>
    </div>

    <div class="col-md-4">
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
                        <label for="txtInformacion">Información:</label>
                        <input type="text" class="form-control" value ="<?php echo $txtInformacion ?>" name="txtInformacion" id="txtInformacion" placeholder="Información">
                    </div>

                    <div class = "form-group">
                        <label for="txtDireccion">Direccion:</label>
                        <input type="text" class="form-control" value ="<?php echo $txtDireccion ?>" name="txtDireccion" id="txtDireccion" placeholder="Dirección">
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
    
    <!-- <div class="container">
        <h1 class="text">Mantener Proveedores</h1>
    </div> -->

    <div class="col-md-4">
        Correo Proveedor
        <div class="card">
            <div class="card-header">
                Proveedor
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                
                    <div class = "form-group">
                        <label for="txtIDCorreo">ID Correo:</label>
                        <input type="text" class="form-control" value="<?php echo $txtIDCorreo ?>" name="txtIDCorreo" id="txtIDCorreo" placeholder="ID Correo">
                    </div>
                
                    <div class = "form-group">
                        <label for="txtIDProveedor">ID Proveedor:</label>
                        <input type="text" class="form-control" value="<?php echo $txtIDProveedor ?>" name="txtIDProveedor" id="txtIDProveedor" placeholder="ID Proveedor">
                    </div>
                    
                    <div class = "form-group">
                        <label for="txtCorreo">Correo:</label>
                        <input type="text" class="form-control" value ="<?php echo $txtCorreo ?>" name="txtCorreo" id="txtCorreo" placeholder="Correo">
                    </div>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" value="AgregarCorreo" class="btn btn-success">Agregar</button>
                        <button type="submit" name="accion" value="ModificarCorreo" class="btn btn-warning">Modificar</button>
                        <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        Teléfono Proveedor
        <div class="card">
            <div class="card-header">
                Proveedor
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class = "form-group">
                        <label for="txtIDTelefono">ID Telefono:</label>
                        <input type="text" class="form-control" value="<?php echo $txtIDTelefono ?>" name="txtIDTelefono" id="txtIDTelefono" placeholder="ID Telefono">
                    </div>
                
                    <div class = "form-group">
                        <label for="txtIDProveedor">ID Proveedor:</label>
                        <input type="text" class="form-control" value="<?php echo $txtIDProveedor ?>" name="txtIDProveedor" id="txtIDProveedor" placeholder="ID Proveedor">
                    </div>
                    
                    <div class = "form-group">
                        <label for="txtIDTipoFono">Tipo Fono:</label>
                        <input type="text" class="form-control" value ="<?php echo $txtIDTipoFono ?>" name="txtIDTipoFono" id="txtIDTipoFono" placeholder="Tipo Fono">
                    </div>
                    
                    <div class = "form-group">
                        <label for="txtTelefono">Teléfono Proveedor:</label>
                        <input type="text" class="form-control" value ="<?php echo $txtTelefono ?>" name="txtTelefono" id="txtTelefono" placeholder="Teléfono">
                    </div>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" value="AgregarTelefono" class="btn btn-success">Agregar</button>
                        <button type="submit" name="accion" value="ModificarTelefono" class="btn btn-warning">Modificar</button>
                        <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</br>

    <div class="col-md-50">
        Se muestran los proveedores
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Proveedor</th>
                    <th>Nombre</th>
                    <th>Información</th>
                    <th>Dirección</th>
                    <th>Horario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaProveedores as $proveedores){ ?>
                <tr>
                    <td><?php echo $proveedores['COD_PROVEEDOR']?></td>
                    <td><?php echo $proveedores['NOMBRE']?></td>
                    <td><?php echo $proveedores['INFORMACION']?></td>
                    <td><?php echo $proveedores['DIRECCION']?></td>
                    <td><?php echo $proveedores['HORARIO']?></td>

                    <td>
                        Seleccionar | Borrar
                        <form method="POST">
                            <input type="hidden" name="txtIDProveedor" id="txtIDProveedor" value="<?php echo $proveedores['COD_PROVEEDOR']?>">
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger">

                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table> 
    </div>

    <div class="col-md-50">
        Se muestran los correos
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Correo</th>
                    <th>ID Proveedor</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaCorreos as $correos){ ?>
                <tr>
                    <td><?php echo $correos['COD_CORREO_PROVEEDOR']?></td>
                    <td><?php echo $correos['COD_PROVEEDOR']?></td>
                    <td><?php echo $correos['CORREO']?></td>

                    <td>
                        Seleccionar | Borrar
                        <form method="POST">
                            <input type="hidden" name="txtIDCorreo" id="txtIDCorreo" value="<?php echo $correos['COD_CORREO_PROVEEDOR']?>">
                            <input type="submit" name="accion" value="SeleccionarCorreo" class="btn btn-primary">
                            <input type="submit" name="accion" value="BorrarCorreo" class="btn btn-danger">

                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table> 
    </div>

    <div class="col-md-50">
        Se muestran los telefonos
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Telefono</th>
                    <th>ID Proveedor</th>
                    <th>ID Tipo Fono</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaTelefonos as $telefonos){ ?>
                <tr>
                    <td><?php echo $telefonos['COD_TELEFONO']?></td>
                    <td><?php echo $telefonos['COD_PROVEEDOR']?></td>
                    <td><?php echo $telefonos['COD_TIPO_FONO']?></td>
                    <td><?php echo $telefonos['NUMERO_TELEFONO']?></td>

                    <td>
                        Seleccionar | Borrar
                        <form method="POST">
                            <input type="hidden" name="txtIDTelefono" id="txtIDTelefono" value="<?php echo $telefonos['COD_TELEFONO']?>">
                            <input type="submit" name="accion" value="SeleccionarTelefono" class="btn btn-primary">
                            <input type="submit" name="accion" value="BorrarTelefono" class="btn btn-danger">

                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table> 
    </div>


<?php include("../../template/pie.php");?>