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

$sentenciaSQL= $conexion->prepare("SELECT * FROM proveedor");
$sentenciaSQL->execute();
$listaProveedores=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL2= $conexion->prepare("SELECT * FROM correo_proveedor");
$sentenciaSQL2->execute();
$listaCorreos=$sentenciaSQL2->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL3= $conexion->prepare("SELECT * FROM telefono_proveedor");
$sentenciaSQL3->execute();
$listaTelefonos=$sentenciaSQL3->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL5= $conexion->prepare("SELECT * FROM tipo_fono");
$sentenciaSQL5->execute();
$listaTipoFono=$sentenciaSQL5->fetchAll(PDO::FETCH_ASSOC);

?>

    <div class="container">
        <h1 class="text">Mostrar Información Proveedores</h1>
    </div>

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
                    <th>Correos</th>
                    <th>Teléfonos</th>
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
                        <div class="col-md-50">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID Correo</th>
                                        <th>ID Proveedor</th>
                                        <th>Correo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($listaCorreos as $correos){ if($correos['COD_PROVEEDOR']==$proveedores['COD_PROVEEDOR']){ ?>
                                    <tr>
                                        <td><?php echo $correos['COD_CORREO_PROVEEDOR']?></td>
                                        <td><?php echo $correos['COD_PROVEEDOR']?></td>
                                        <td><?php echo $correos['CORREO']?></td>
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table> 
                        </div>
                    </td>
                    <td>
                        <div class="col-md-50">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID Telefono</th>
                                        <th>ID Proveedor</th>
                                        <th>ID Tipo Fono</th>
                                        <th>Tipo Fono</th>
                                        <th>Teléfono</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($listaTelefonos as $telefonos){ if($telefonos['COD_PROVEEDOR']==$proveedores['COD_PROVEEDOR']){ ?>
                                    <tr>
                                        <td><?php echo $telefonos['COD_TELEFONO']?></td>
                                        <td><?php echo $telefonos['COD_PROVEEDOR']?></td>
                                        <td><?php echo $telefonos['COD_TIPO_FONO']?></td>
                                        <td><?php foreach($listaTipoFono as $tipoFono){if($telefonos['COD_TIPO_FONO']==$tipoFono['COD_TIPO_FONO']){echo $tipoFono['TIPO_FONO'];}} ?></td>
                                        <td><?php echo $telefonos['NUMERO_TELEFONO']?></td>
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table> 
                        </div>
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
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaCorreos as $correos){ ?>
                <tr>
                    <td><?php echo $correos['COD_CORREO_PROVEEDOR']?></td>
                    <td><?php echo $correos['COD_PROVEEDOR']?></td>
                    <td><?php echo $correos['CORREO']?></td>
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
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaTelefonos as $telefonos){ ?>
                
                <tr>
                    <td><?php echo $telefonos['COD_TELEFONO']?></td>
                    <td><?php echo $telefonos['COD_PROVEEDOR']?></td>
                    <td><?php foreach($listaTipoFono as $tipoFono){if($telefonos['COD_TIPO_FONO']==$tipoFono['COD_TIPO_FONO']){echo $tipoFono['TIPO_FONO'];}} ?></td>
                    <!-- <td><?php echo $telefonos['COD_TIPO_FONO']?></td> -->
                    <td><?php echo $telefonos['NUMERO_TELEFONO']?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table> 
    </div>


<?php include("../../template/pie.php");?>