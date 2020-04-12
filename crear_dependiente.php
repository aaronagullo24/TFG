<?php
session_start();
if (!isset($_SESSION['administrador'])) {
    header("Location: login.php");
}
$administrador = $_SESSION['administrador'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Oldver</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/AjaxCode.js"></script>
    <script src="js/crear_dependiente.js"></script>
    <script src="js/mi_libreriaAjax.js"></script>
</head>

<body style="background-color: aquamarine;">

    <!-- menú de navegación -->
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="inicio_administrador.php.php">
            <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap"> Administrador
            <?php
            echo $administrador->nombre;
            ?>
            </p> </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="navbar-nav mr-auto ml-auto text-center">
                <a class="nav-item nav-link " href="crear_dependiente.php">Crear Dendiente</a>
                <a class="nav-item nav-link " href="crear_voluntario.php">Crear Voluntario</a>
                <a class="nav-item nav-link" href="">Modificar Usuario</a>
                <a class="nav-item nav-link " href="">Modificar Chat</a>
                <a class="nav-item nav-link " href="">Modificar Parejas</a>
            </div>
            <div class="d-flex flex-row justify-content-center">

                <a href="login.php" class="btn btn-outline-danger">Cerrar sesion</a>
            </div>
        </div>
    </nav>

    <div class="container">

        <hr>
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 800px;">
                <h4 class="card-title mt-3 text-center">Crear Dependientes</h4>

                <form>
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input id="Nombre" name="Nombre" class="form-control input-lg" aria-describedby="inputGroup-sizing-lg" placeholder="Nombre completo" type="text">

                        <div id="nombre"></div>
                    </div>
                    <br>

                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="correo" id="correo" class="form-control" placeholder="Correo Electronico" type="email">
                        <div id="Correo"></div>
                    </div>
                    <br>
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control" id="password" placeholder="Create password" type="password">
                        <div id="Password"></div>
                    </div>
                    <br>

                    <div class="input-group mb-8">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Provincia en la que vive: </label>
                        </div>

                        <select name="provinciaList" id="provinciaList" onChange="return provinciaListOnChange()" class="custom-select">
                            <option>Seleccione su provincia...</option>
                            <?php
                            $xml = simplexml_load_file('provinciasypoblaciones.xml');
                            $result = $xml->xpath("/lista/provincia/nombre | /lista/provincia/@id");
                            for ($i = 0; $i < count($result); $i += 2) {
                                $e = $i + 1;
                                $provincia = UTF8_DECODE($result[$e]);
                                echo ("<option value='$result[$i]'>$provincia</option>");
                            }
                            ?>
                        </select>
                        <div id="provincia"></div>

                        <br>
                        <br>
                    </div>
                    <div class="input-group mb-8">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Localidad en la que vive: </label>
                        </div>
                        <select name="localidadList" id="localidadList" class="form-control">
                            <option>Seleccione antes una provincia</option>
                        </select> <span id="advice"> </span>
                        <div id="localidad"></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="start">Fecha de nacimiento:</label>

                        <input type="date" id="fecha_nacimiento" name="trip-start">
                    </div>

                    <br>
                    <div class="form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <textarea class="form-control" rows="3" id="dependencia" placeholder="Escriba brevemente sus necesidad y patologias"></textarea>

                        <div id="fecha"></div>

                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" id="boton"> Crear cuenta </button>
                    </div>
                    <div id="alta"></div>

                </form>
            </article>
        </div>

    </div>
</body>

</html>