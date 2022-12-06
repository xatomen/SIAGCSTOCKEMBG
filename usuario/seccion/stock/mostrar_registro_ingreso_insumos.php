<?php include("../../template/cabecera.php");?>

<?php

$txtIDProvee=(isset($_POST['txtIDProvee']))?$_POST['txtIDProvee']:"";
$txtIDProveedor=(isset($_POST['txtIDProveedor']))?$_POST['txtIDProveedor']:"";
$dateFecha=(isset($_POST['dateFecha']))?$_POST['dateFecha']:"";

$txtIDRegProvee=(isset($_POST['txtIDRegProvee']))?$_POST['txtIDRegProvee']:"";
// $txtIDProvee=(isset($_POST['txtIDProvee']))?$_POST['txtIDProvee']:"";
$txtIDInsumo=(isset($_POST['txtIDInsumo']))?$_POST['txtIDInsumo']:"";
$txtCantidad=(isset($_POST['txtCantidad']))?$_POST['txtCantidad']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$dateFechaVencimiento=(isset($_POST['dateFechaVencimiento']))?$_POST['dateFechaVencimiento']:"";


$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../../config/bd.php");

$sentenciaSQL= $conexion->prepare("SELECT * FROM provee");
$sentenciaSQL->execute();
$listaProvee=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL2= $conexion->prepare("SELECT * FROM registro_provee");
$sentenciaSQL2->execute();
$listaRegistroProvee=$sentenciaSQL2->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL3= $conexion->prepare("SELECT * FROM registro_provee ORDER BY CANTIDAD DESC");
$sentenciaSQL3->execute();
$listaRegistroProvee2=$sentenciaSQL3->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL4= $conexion->prepare("SELECT * FROM registro_provee ORDER BY CANTIDAD ASC");
$sentenciaSQL4->execute();
$listaRegistroProvee3=$sentenciaSQL4->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL5= $conexion->prepare("SELECT * FROM registro_provee ORDER BY FECHA_VENCIMIENTO ASC");
$sentenciaSQL5->execute();
$listaRegistroProvee4=$sentenciaSQL5->fetchAll(PDO::FETCH_ASSOC);

?>


    <div class="container">
            <h1 class="text">Registro de Ingreso de Insumos</h1>
    </div>

    </br>

    <div class="col-md-30">
        Se muestran la cabecera del registro
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Provee</th>
                    <th>ID Proveedor</th>
                    <th>Fecha</th>
                    <th>Contenido</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaProvee as $cabecera){ ?>
                <tr>
                    <td><?php echo $cabecera['COD_PROVEE']?></td>
                    <td><?php echo $cabecera['COD_PROVEEDOR']?></td>
                    <td><?php echo $cabecera['FECHA']?></td>
                    <td>
                        <div class="col-md-7">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID Registro</th>
                                        <th>ID Provee</th>
                                        <th>ID Insumo</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Fecha Vencimiento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($listaRegistroProvee as $registro){ if($registro['COD_PROVEE']==$cabecera['COD_PROVEE']){ ?>
                                    <tr>
                                    <td><?php echo $registro['COD_REG_PROVEE']?></td>
                                    <td><?php echo $registro['COD_PROVEE']?></td>
                                    <td><?php echo $registro['ID_INSUMO']?></td>
                                    <td><?php echo $registro['CANTIDAD']?></td>
                                    <td><?php echo $registro['PRECIO']?></td>
                                    <td><?php echo $registro['FECHA_VENCIMIENTO']?></td>
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


    <div class="container">
            <h1 class="text">Insumos más y menos demandados</h1>
    </div>

    </br>

    <div class="col-md-35">
        Mayor a menor
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>ID Registro</th>
                    <th>ID Provee</th>
                    <th>ID Insumo</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Fecha Vencimiento</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaRegistroProvee2 as $registro2){ ?>
                <tr>
                    <td><?php echo $registro2['COD_REG_PROVEE']?></td>
                    <td><?php echo $registro2['COD_PROVEE']?></td>
                    <td><?php echo $registro2['ID_INSUMO']?></td>
                    <td><?php echo $registro2['CANTIDAD']?></td>
                    <td><?php echo $registro2['PRECIO']?></td>
                    <td><?php echo $registro2['FECHA_VENCIMIENTO']?></td>
                    </tr>
                    <?php } ?>
                </tbody>
        </table> 
    </div>

    <div class="col-md-35">
        Menor a mayor
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>ID Registro</th>
                    <th>ID Provee</th>
                    <th>ID Insumo</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Fecha Vencimiento</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaRegistroProvee3 as $registro3){ ?>
                <tr>
                    <td><?php echo $registro3['COD_REG_PROVEE']?></td>
                    <td><?php echo $registro3['COD_PROVEE']?></td>
                    <td><?php echo $registro3['ID_INSUMO']?></td>
                    <td><?php echo $registro3['CANTIDAD']?></td>
                    <td><?php echo $registro3['PRECIO']?></td>
                    <td><?php echo $registro3['FECHA_VENCIMIENTO']?></td>
                    </tr>
                    <?php } ?>
                </tbody>
        </table> 
    </div>

    <div class="container">
            <h1 class="text">Fechas de vencimiento</h1>
    </div>

    </br>

    <div class="col-md-35">
        Mayor a menor
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>ID Registro</th>
                    <th>ID Provee</th>
                    <th>ID Insumo</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Fecha Vencimiento</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaRegistroProvee4 as $registro3){ ?>
                <tr>
                    <td><?php echo $registro3['COD_REG_PROVEE']?></td>
                    <td><?php echo $registro3['COD_PROVEE']?></td>
                    <td><?php echo $registro3['ID_INSUMO']?></td>
                    <td><?php echo $registro3['CANTIDAD']?></td>
                    <td><?php echo $registro3['PRECIO']?></td>
                    <td><?php echo $registro3['FECHA_VENCIMIENTO']?></td>
                    </tr>
                    <?php } ?>
                </tbody>
        </table> 
    </div>

<?php include("../../template/pie.php");?>