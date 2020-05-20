<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}
include_once "funciones.php";
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
    <script src="js/editar_perfil_voluntario.js"></script>
    <script src="js/mi_libreriaAjax.js"></script>
    <script src="js/AjaxCode.js"></script>
</head>

<body style="background-color: #4FD53C;">

    <?php
    voluntario($voluntario);
    ?>

    <div class="container">
        <br>

        <hr>

        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Perfil de <?php echo $nombre ?></h4>

                <form>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input id="Nombre" name="Nombre" class="form-control" type="text" value="<?php echo $nombre ?>">
                        <div id="nombre"></div>
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="correo" id="correo" class="form-control" placeholder="Correo Electronico" type="email" value="<?php echo $voluntario->Correo ?>" disabled>
                        <div id="Correo"></div>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" id="titulacion">
                            <option selected=""> <?php echo $voluntario->Titulacion ?></option>
                            <option>Gerontología. </option>
                            <option>Neurología. </option>
                            <option>Enfermería. </option>
                            <option>Fisioterapia. </option>
                            <option>Cuidado y asistencia al adulto. </option>
                            <option>Educación social. </option>
                            <option>Trabajo social. </option>
                            <option>Nutrición y dietética. </option>
                            <option>Educación para adultos. </option>
                            <option>Otros... </option>
                            <option>Ninguno </option>

                        </select>
                        <div id="Titulacion"></div>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control" id="password" placeholder="Create password" type="password" value="<?php echo $voluntario->Password ?>">
                        <div id="Password"></div>
                    </div>


                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <textarea id="descripcion" rows="3" cols="50"><?php echo $voluntario->descripcion ?></textarea>
                        <div id="descripcion1"></div>
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <textarea id="experiencia" rows="3" cols="50"><?php echo $voluntario->experiencia ?></textarea>
                        <div id="experiencia1"></div>
                    </div>

                    <div class="form-group">
                        <a href="editar_perfil_voluntario.php" type="button" class="btn btn-success" id="boton">Guardar Cambios</a>
                    </div>

                </form>
            </article>
        </div>

    </div>





</body>

</html>