<?php include("../template/cabecera.php");?>

<?php

$txtUsuario=(isset($_POST['txtUsuario']))?$_POST['txtUsuario']:"";
$txtContrasenia=(isset($_POST['txtContrasenia']))?$_POST['txtContrasenia']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/bd.php");

switch($accion){

    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO credenciales (usuario, contrasenia) VALUES (:usuario, :contrasenia);");
        $sentenciaSQL->bindParam(':usuario',$txtUsuario);
        $sentenciaSQL->bindParam(':contrasenia', $txtContrasenia);
        $sentenciaSQL->execute();
        echo "Presionado botón agregar";
    break;

    case "Modificar":
        // echo "Presionado botón modificar";
        $sentenciaSQL= $conexion->prepare("UPDATE credenciales SET usuario=:usuario, contrasenia=:contrasenia WHERE usuario=:usuario");
        $sentenciaSQL->bindParam(':usuario',$txtUsuario);
        $sentenciaSQL->bindParam(':contrasenia',$txtContrasenia);
        $sentenciaSQL->execute();

    break;

    case "Cancelar":
        // echo "Presionado botón cancelar";
        header("Location:stock.php");
    break;

    case "Seleccionar":
        // echo "Presionado botón seleccionar";
        $sentenciaSQL= $conexion->prepare("SELECT * FROM credenciales WHERE usuario=:usuario");
        $sentenciaSQL->bindParam(':usuario',$txtUsuario);
        $sentenciaSQL->execute();
        $Credencial=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtUsuario = $Credencial['usuario'];
        $txtContrasenia = $Credencial['contrasenia'];
    break;

    case "Borrar":
        // echo "Presionado botón borrar";
        $sentenciaSQL= $conexion->prepare("DELETE FROM credenciales WHERE usuario=:usuario");
        $sentenciaSQL->bindParam(':usuario',$txtUsuario);
        $sentenciaSQL->execute();    
    break;
}

$sentenciaSQL= $conexion->prepare("SELECT * FROM credenciales");
$sentenciaSQL->execute();
$listaCredenciales=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

    <div class="container">
            <h1 class="text">Credenciales</h1>
    </div>

    <div class="col-md-5">
        Modificar Credenciales
        <div class="card">
            <div class="card-header">
                Credenciales
            </div>

            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class = "form-group">
                        <label for="txtUsuario">Usuario:</label>
                        <input type="text" class="form-control" value="<?php echo $txtUsuario ?>" name="txtUsuario" id="txtUsuario" placeholder="Usuario">
                    </div>
                    
                    <div class = "form-group">
                        <label for="txtContrasenia">Contraseña:</label>
                        <input type="text" class="form-control" value ="<?php echo $txtContrasenia ?>" name="txtContrasenia" id="txtContrasenia" placeholder="Contraseña">
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
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaCredenciales as $credencial){ ?>
                <tr>
                    <td><?php echo $credencial['usuario']?></td>
                    <td><?php echo $credencial['contrasenia']?></td>
                    <td>
                        Seleccionar | Borrar
                        <form method="POST">
                            <input type="hidden" name="txtUsuario" id="txtUsuario" value="<?php echo $credencial['usuario']?>">
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger">

                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table> 
    </div>

<?php include("../template/pie.php");?>