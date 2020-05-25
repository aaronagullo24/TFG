<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}
include_once "conectar.php";
include_once "funciones.php";
$conexion = conectar();
$voluntario = $_SESSION['usuario'];
$nombre = $voluntario->Nombre;
?>

<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Oldver</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</head>

<body style="background-color: #4FD53C;">

    <?php
    voluntario($voluntario);

    $sql = "SELECT * FROM voluntario WHERE Correo=:Correo";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([":Correo" => $voluntario->Correo]);
    $voluntario_consulta = $consulta->fetch(PDO::FETCH_OBJ);
    
    ?>

    <div class="container">
        <br>

        <hr>

        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Mi perfil</h4>

                <form>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input id="Nombre" name="Nombre" class="form-control" type="text" value="<?php echo $voluntario_consulta->Nombre ?>" disabled>
                        <div id="nombre"></div>
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="correo" id="correo" class="form-control" placeholder="Correo Electronico" type="email" value="<?php echo $voluntario_consulta->Correo ?>" disabled>
                        <div id="Correo"></div>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" id="titulacion" disabled>
                            <option selected=""> <?php echo $voluntario_consulta->Titulacion ?></option>


                        </select>
                        <div id="Titulacion"></div>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control" id="password" placeholder="Create password" type="password" value="<?php echo $voluntario_consulta->Password ?>" disabled>
                        <div id="Password"></div>
                    </div>


                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control" id="descripcion" type="text" value="<?php echo $voluntario_consulta->descripcion ?>" disabled>
                        <div id="Password"></div>
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control" id="experiencia" type="text" value="<?php echo $voluntario_consulta->experiencia ?>" disabled>
                        <div id="Password"></div>
                    </div>


                    <div class="form-group">
                        <a href="editar_perfil_voluntario.php" type="button" class="btn btn-success">Editar perfil</a>
                    </div>

                </form>
            </article>
        </div>

    </div>
</body>

</html>