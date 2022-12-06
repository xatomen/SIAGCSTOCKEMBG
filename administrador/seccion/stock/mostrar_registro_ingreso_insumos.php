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

switch($accion){

    case "AgregarCabecera":
        $sentenciaSQL = $conexion->prepare("INSERT INTO provee (COD_PROVEE, COD_PROVEEDOR, FECHA) VALUES (:COD_PROVEE, :COD_PROVEEDOR, :FECHA);");
        $sentenciaSQL->bindParam(':COD_PROVEE',$txtIDProvee);
        $sentenciaSQL->bindParam(':COD_PROVEEDOR', $txtIDProveedor);
        $sentenciaSQL->bindParam(':FECHA', $dateFecha);
        $sentenciaSQL->execute();
        echo "Presionado botón agregar";
    break;

    case "ModificarCabecera":
        $sentenciaSQL= $conexion->prepare("UPDATE provee SET COD_PROVEE=:COD_PROVEE, COD_PROVEEDOR=:COD_PROVEEDOR, FECHA=:FECHA WHERE COD_PROVEE=:COD_PROVEE");
        $sentenciaSQL->bindParam(':COD_PROVEE',$txtIDProvee);
        $sentenciaSQL->bindParam(':COD_PROVEEDOR',$txtIDProveedor);
        $sentenciaSQL->bindParam(':FECHA', $dateFecha);
        $sentenciaSQL->execute();

    break;

    case "SeleccionarCabecera":
        $sentenciaSQL= $conexion->prepare("SELECT * FROM provee WHERE COD_PROVEE=:COD_PROVEE");
        $sentenciaSQL->bindParam(':COD_PROVEE',$txtIDProvee);
        $sentenciaSQL->execute();
        $Provee=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtIDProvee = $Provee['COD_PROVEE'];
        $txtIDProveedor = $Provee['COD_PROVEEDOR'];
        $dateFecha = $Provee['FECHA'];
    break;

    case "BorrarCabecera":
        $sentenciaSQL= $conexion->prepare("DELETE FROM provee WHERE COD_PROVEE=:COD_PROVEE");
        $sentenciaSQL->bindParam(':COD_PROVEE',$txtIDProvee);
        $sentenciaSQL->execute();    
    break;

    case "Cancelar":
        header("Location:stock.php");
    break;



    case "AgregarRegistro":
        $sentenciaSQL2 = $conexion->prepare("INSERT INTO registro_provee (COD_REG_PROVEE, COD_PROVEE, ID_INSUMO, CANTIDAD, PRECIO, FECHA_VENCIMIENTO) VALUES (:COD_REG_PROVEE, :COD_PROVEE, :ID_INSUMO, :CANTIDAD, :PRECIO, :FECHA_VENCIMIENTO);");
        $sentenciaSQL2->bindParam(':COD_REG_PROVEE',$txtIDRegProvee);
        $sentenciaSQL2->bindParam(':COD_PROVEE', $txtIDProvee);
        $sentenciaSQL2->bindParam(':ID_INSUMO',$txtIDInsumo);
        $sentenciaSQL2->bindParam(':CANTIDAD', $txtCantidad);
        $sentenciaSQL2->bindParam(':PRECIO', $txtPrecio);
        $sentenciaSQL2->bindParam(':FECHA_VENCIMIENTO', $dateFechaVencimiento);
        $sentenciaSQL2->execute();
        echo "Presionado botón agregar";
    break;

    case "ModificarRegistro":
        $sentenciaSQL2= $conexion->prepare("UPDATE registro_provee SET COD_PROVEE=:COD_PROVEE, ID_INSUMO=:ID_INSUMO, CANTIDAD=:CANTIDAD, PRECIO=:PRECIO, FECHA_VENCIMIENTO=:FECHA_VENCIMIENTO WHERE COD_REG_PROVEE=:COD_REG_PROVEE");
        $sentenciaSQL2->bindParam(':COD_REG_PROVEE',$txtIDRegProvee);
        $sentenciaSQL2->bindParam(':COD_PROVEE', $txtIDProvee);
        $sentenciaSQL2->bindParam(':ID_INSUMO',$txtIDInsumo);
        $sentenciaSQL2->bindParam(':CANTIDAD', $txtCantidad);
        $sentenciaSQL2->bindParam(':PRECIO', $txtPrecio);
        $sentenciaSQL2->bindParam(':FECHA_VENCIMIENTO', $dateFechaVencimiento);
        $sentenciaSQL2->execute();

    break;

    case "SeleccionarRegistro":
        $sentenciaSQL2= $conexion->prepare("SELECT * FROM registro_provee WHERE COD_REG_PROVEE=:COD_REG_PROVEE");
        $sentenciaSQL2->bindParam(':COD_REG_PROVEE',$txtIDRegProvee);
        $sentenciaSQL2->execute();
        $RegProvee=$sentenciaSQL2->fetch(PDO::FETCH_LAZY);

        $txtIDRegProvee = $RegProvee['COD_REG_PROVEE'];
        $txtIDProvee = $RegProvee['COD_PROVEE'];
        $txtIDInsumo = $RegProvee['ID_INSUMO'];
        $txtCantidad = $RegProvee['CANTIDAD'];
        $txtPrecio = $RegProvee['PRECIO'];
        $dateFechaVencimiento = $RegProvee['FECHA_VENCIMIENTO'];
    break;

    case "BorrarRegistro":
        $sentenciaSQL2= $conexion->prepare("DELETE FROM registro_provee WHERE COD_REG_PROVEE=:COD_REG_PROVEE");
        $sentenciaSQL2->bindParam(':COD_REG_PROVEE',$txtIDRegProvee);
        $sentenciaSQL2->execute();    
    break;

    case "Cancelar":
        header("Location:stock.php");
    break;

}



$sentenciaSQL= $conexion->prepare("SELECT * FROM provee");
$sentenciaSQL->execute();
$listaProvee=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL2= $conexion->prepare("SELECT * FROM registro_provee");
$sentenciaSQL2->execute();
$listaRegistroProvee=$sentenciaSQL2->fetchAll(PDO::FETCH_ASSOC);

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



<?php include("../../template/pie.php");?>