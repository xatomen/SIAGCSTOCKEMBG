<?php
    session_start();

    if($_POST){
        if($_POST){
            if($_POST['usuario']=="administrador" && $_POST['contrasenia']=="sistema1234"){ //Verificamos inicio de sesión
                $_SESSION['usuario'] = "ok";
                $_SESSION['nombreUsuario'] = "Administrador";
                header('Location:inicio.php');
            }
        }
        else {
            $mensaje = "Usuario y/o contraseña incorrectos";
        }
    }
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
                        <class ><h2>Sistema de credenciales (Administrador)</h2></class>
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
                                <input type="text" class="form-control" name="usuario" placeholder="RUT (123456789)">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contraseña:</label>
                                <input type="password" class="form-control" name="contrasenia" placeholder="Contraseña">
                            </div>
                            <button type="submit" class="btn btn-primary">Ingresar al sistema</button>
                            <a name="IS" id="IS" class="btn btn-primary" href="../index.php" role="button">Volver al inicio</a>
                        </form>
                        
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
  </body>
</html>