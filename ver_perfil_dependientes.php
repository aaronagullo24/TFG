<?php
session_start();
if (!isset($_SESSION['dependiente'])) {
    header("Location: login.php");
}
include_once "funciones.php";
include_once "conectar.php";
$conexion = conectar();
$dependiente = $_SESSION['dependiente'];
$nombre = $dependiente->Nombre;
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
    dependiente($nombre);

    $sql = "SELECT * FROM dependiente WHERE Correo=:Correo";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([":Correo" => $dependiente->Correo]);
    $dependiente_consulta = $consulta->fetch(PDO::FETCH_OBJ);
    ?>

    <div class="container">

        <hr>

        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Perfil de <?php echo $dependiente_consulta->Nombre ?></h4>

                <form>
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>

                        <input id="Nombre" name="Nombre" class="form-control input-lg" aria-describedby="inputGroup-sizing-lg" placeholder="Nombre completo" type="text" value="<?php echo $dependiente_consulta->Nombre ?>" disabled>

                        <div id="nombre"></div>
                    </div>
                    <br>

                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="correo" id="correo" class="form-control" placeholder="Correo Electronico" type="email" value="<?php echo $dependiente_consulta->Correo ?>" disabled>
                        <div id="Correo"></div>
                    </div>
                    <br>
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control" id="password" placeholder="Create password" type="password" value="<?php echo $dependiente_consulta->Password ?>" disabled>
                        <div id="Password"></div>
                    </div>
                    <br>

                    <div class="input-group mb-8">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Provincia: </label>
                        </div>

                        <select name="provinciaList" id="provinciaList" class="custom-select" disabled>
                            <option><?php echo $dependiente_consulta->Provincia ?></option>

                        </select>
                        <div id="provincia"></div>

                        <br>
                        <br>
                    </div>
                    <div class="input-group mb-8">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Localidad: </label>
                        </div>
                        <select name="localidadList" id="localidadList" class="form-control" disabled>
                            <option><?php echo $dependiente_consulta->Localidad ?></option>
                        </select> <span id="advice"> </span>
                        <div id="localidad"></div>
                    </div>
                    <br>


                    <div class="form-group">
                        <label for="start">Fecha de nacimiento:</label>

                        <input type="date" id="fecha_nacimiento" name="trip-start" value="<?php echo $dependiente_consulta->Fecha_nacimiento ?>" disabled>
                    </div>



                    <br>
                    <div class="form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <textarea class="form-control" rows="3" id="dependencia" placeholder="<?php echo $dependiente_consulta->Necesidad ?>" disabled></textarea>

                        <div id="fecha"></div>

                    </div>


                    <div class="form-group">
                        <a href="editar_perfil_dependiente.php" type="button" class="btn btn-success">Editar Perfil</a>
                    </div>
                    <div id="alta"></div>
                </form>
            </article>
        </div>

    </div>





</body>

</html>