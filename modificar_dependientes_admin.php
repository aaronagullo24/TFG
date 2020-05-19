<?php
session_start();
if (!isset($_SESSION['administrador'])) {
    header("Location: login.php");
}
include_once "conectar.php";
$conexion = conectar();
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
    <script src="js/buscar.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/AjaxCode.js"></script>
    <script src="js/mi_libreriaAjax.js"></script>
    <script src="js/editar_dependiente_admin.js"></script>
</head>

<body style="background-color: aquamarine;">

    <!-- menú de navegación -->
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">

        <div class="navbar-header">

            <a class="navbar-brand" href="inicio_administrador.php">
                <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap"> Administrador
                <?php
                echo $administrador->nombre;
                ?>
                </p> </a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Desplegar navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Crear
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="crear_voluntario.php">Crear Voluntario</a></li>
                        <li><a href="crear_dependiente.php">Crear Dependiente</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Modificar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="modificar_voluntario.php">Modificar Voluntario</a></li>
                        <li><a href="modificar_dependiente.php">Modificar Dependiente</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="#">Chat</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="#">Parejas</a></li>
            </ul>
        </div>
        <div class="d-flex flex-row justify-content-center">

            <a href="login.php" class="btn btn-outline-danger">Cerrar sesion</a>
        </div>
        </div>
    </nav>
    <?php
    $id_dependientes = $_REQUEST['dependiente'];

    $sql = "SELECT * FROM dependiente WHERE Numero_socio=:Numero_socio";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([':Numero_socio' => $id_dependientes]);
    $dependiente = $consulta->fetch(PDO::FETCH_OBJ);
    ?>
    <div class="container">

        <hr>
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 800px;">
                <h4 class="card-title mt-3 text-center">Modificar Usuario: <?= $dependiente->Nombre ?></h4>

                <form>
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Nombre </label>
                        </div>
                        <input id="Nombre" name="Nombre" class="form-control input-lg" aria-describedby="inputGroup-sizing-lg" placeholder="Nombre completo" type="text" value="<?php echo $dependiente->Nombre ?>">

                        <div id="nombre"></div>
                    </div>
                    <br>

                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Correo Electronico: </label>
                        </div>
                        <input name="correo" id="correo" class="form-control" placeholder="Correo Electronico" type="email" value="<?php echo $dependiente->Correo ?>" disabled>
                        <div id="Correo"></div>
                    </div>
                    <br>
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Password </label>
                        </div>
                        <input class="form-control" id="password" placeholder="Create password" type="password" value="<?php echo $dependiente->Password ?>">
                        <div id="Password"></div>
                    </div>
                    <br>

                    <div class="input-group mb-8">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Provincia en la que vive: </label>
                        </div>

                        <select name="provinciaList" id="provinciaList" onChange="return provinciaListOnChange()" class="custom-select">
                            <option><?php echo $dependiente->Provincia ?></option>
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
                    </div>
                    <div class="input-group mb-8">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Localidad en la que vive: </label>
                        </div>
                        <select name="localidadList" id="localidadList" class="form-control">
                            <option><?php echo $dependiente->Localidad ?></option>
                        </select> <span id="advice"> </span>
                        <div id="localidad"></div>
                    </div>
                    <br>


                    <div class="form-group">
                        <label for="start">Fecha de nacimiento:</label>

                        <input type="date" id="fecha_nacimiento" name="trip-start" value="<?php echo $dependiente->Fecha_nacimiento ?>">
                    </div>



                    <br>
                    <div class="form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <textarea class="form-control" rows="3" id="dependencia"><?php echo $dependiente->Necesidad ?></textarea>

                        <div id="fecha"></div>

                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" id="boton"> Guardar Cambios </button>
                    </div>
                    <div id="alta"></div>

                </form>
            </article>
        </div>

    </div>
</body>

</html>