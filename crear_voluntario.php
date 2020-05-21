<?php
session_start();
if (!isset($_SESSION['administrador'])) {
    header("Location: login.php");
}
$administrador = $_SESSION['administrador'];
include_once "cabecera.php";
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
    <script src="js/AjaxCode.js"></script>
    <script src="js/admin_voluntario.js"></script>
    <script src="js/mi_libreriaAjax.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body style="background-color: #4FD53C;">

    <!-- menú de navegación -->
    <?php
    administrador($administrador);
    ?>
    <div class="container">
        <br>

        <hr>

        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-2 text-center">Crear Voluntarios</h4>

                <form>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input id="Nombre" name="Nombre" class="form-control" placeholder="Nombre completo" type="text">
                        <div id="nombre"></div>
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="correo" id="correo" class="form-control" placeholder="Correo Electronico" type="email">
                        <div id="Correo"></div>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" id="titulacion">
                            <option selected=""> Seleccione si posee algun titulo...</option>
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
                        <input class="form-control" id="password" placeholder="Create password" type="password">
                        <div id="Password"></div>
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <textarea id="descripcion" name="descripcion" rows="3" cols="50" placeholder="Introduzca una breve descripcion del voluntario para que le conozca el dependiente"></textarea>
                        <div id="descripcion1"></div>
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <textarea id="experiencia" name="experiencia" rows="3" cols="50" placeholder="Introduzca que tipo de experiencia que tiene,si tiene..."></textarea>
                        <div id="experiencia1"></div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" id="boton"> Crear cuenta </button>
                    </div>

                </form>
            </article>
        </div>

    </div>

</body>

</html>