<?php
session_start();
if (!isset($_SESSION['administrador'])) {
    header("Location: login.php");
}
$administrador = $_SESSION['administrador'];
include_once "conectar.php";

$conexion = conectar();
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
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body style="background-color: aquamarine;">
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">

        <div class="navbar-header">

            <a class="navbar-brand" href="inicio_administrador.php.php">
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

    <table class="table table-hover order-table" id="tabla">
            <thead class="thead-dark">
                <tr>
                    <th style="width:180px; background-color: #5DACCD; color:#fff">Nombre Voluntario</th>
                    <th style="width:180px; background-color: #5DACCD; color:#fff">Id del Voluntario</th>
                    <th style="width:180px; background-color: #5DACCD; color:#fff">Nombre Dependiente</th>
                    <th style="width:180px; background-color: #5DACCD; color:#fff">Id del dependiente</th>
                    <th style="width:180px; background-color: #5DACCD; color:#fff">Interactuar</th>
                </tr>
            </thead>
            <tbody>
                <?php
               

                $sql = "SELECT * FROM parejas";
                $consulta = $conexion->prepare($sql);
                $consulta->execute();



                while ($parejas = $consulta->fetch(PDO::FETCH_OBJ)) {

                    $sql1 = "SELECT * FROM voluntario where Numero_socio=:Numero_socio";
                    $consulta2 = $conexion->prepare($sql1);
                    $consulta2->execute([":Numero_socio" => $parejas->id_voluntario]);
                    $voluntario = $consulta2->fetch(PDO::FETCH_OBJ);

                    $sql2 = "SELECT * FROM dependiente where Numero_socio=:Numero_socio";
                    $consulta3 = $conexion->prepare($sql2);
                    $consulta3->execute([":Numero_socio" => $parejas->id_dependientes]);
                    $dependiente = $consulta3->fetch(PDO::FETCH_OBJ);
                ?>

                    <tr>

                        <td><?php echo $voluntario->Nombre ?></td>
                        <td><?php echo $voluntario->Numero_socio ?></td>
                        <td><?php echo $dependiente->Nombre ?></td>
                        <td><?php echo $dependiente->Numero_socio ?></td>
                        <td>

                            <form action="aceptar_solicitud.php" method="post">
                                <input type="hidden" name="voluntario" value="<?php echo $voluntario->Numero_socio ?>">
                                <input type="hidden" name="dependiente" value="<?php echo $dependiente->Numero_socio ?>">
                                <input type="submit" class="btn btn-success" value="Interactuar">
                            </form>
                        </td>

                    <?php } ?>
                    </tr>
            </tbody>
        </table>
 