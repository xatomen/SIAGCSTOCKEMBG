<?php
    session_start();

    include("./config/bd.php");

    $sentenciaSQL= $conexion->prepare("SELECT * FROM credenciales");
    $sentenciaSQL->execute();
    $listaCredenciales=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

    foreach ($listaCredenciales as $credencial)

    // $username = $_POST['usuario'];
    // $contrasenia = $_POST['contrasenia'];


    if($_POST){
        if($_POST){
            if($_POST['usuario']<>$credencial['usuario'] && $_POST['contrasenia']<>$credencial['contrasenia']){ //Verificamos inicio de sesión
                
            }
            else{
                $_SESSION['usuario'] = "ok";
                $_SESSION['nombreUsuario'] = "usuario";
                header('Location:inicio.php');
            }
            
        }
        else {
            $mensaje = "Usuario y/o contraseña incorrectos";
            echo $mensaje;
        }
    }

    $username = "";
    $contrasenia = "";


?>
<!doctype html>
<html lang="en">
  <head>
    <title>Sistema de login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">  
</head>
  <body>
    <div class="container">
        <div class="row">

            <div class="col-md-4"></div>
            
            <div class="col-md-4">
                <br/><br/><br/>
                <div class="card">
                    <div class="card-header" style="text-align: center">
                        <img src="../src/logo.jpg" style="width: 100px; height: 100px;">
                        <class ><h2>Sistema de credenciales (Usuario)</h2></class>
                    </div>
                    <div class="card-body">
                        <?php if(isset($mensaje)){ ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $mensaje; ?>
                            </div>
                        <?php } ?>
                        <form method="POST">
                            <div class = "form-group">
                                <label for="exampleInputEmail1">Usuario</label>
                                <input type="text" class="form-control" name="usuario" placeholder="12345678-9">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contraseña:</label>
                                <input type="password" class="form-control" name="contrasenia" placeholder="Contraseña">
                            </div>
                            <button type="submit" class="btn btn-primary">Ingresar al sistema</button>
                        </form>
                        
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
  </body>
</html>