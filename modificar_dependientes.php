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
    <br>
    <?php
    function esBoraable($id, $conexion)
    {
        $sql = "SELECT * FROM parejas WHERE id_dependientes=:id_dependientes;";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([":id_dependientes" => $id]);
        if ($consulta->rowCount() < 1) {
            return true;
        } else {
            return false;
        }
    }

    $sql = "SELECT * FROM dependiente";
    $consulta = $conexion->prepare($sql);
    $consulta->execute();


    ?>
    <input class="form-control col-md-3 light-table-filter" data-table="order-table" type="text" placeholder="buscar..">
    <br>
    <br>
    <table class="table table-hover order-table" id="tabla">
        <thead class="thead-dark">
            <tr>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Numero de Socio</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Nombre</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Titulacion</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Modificar</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            while ($voluntario = $consulta->fetch(PDO::FETCH_OBJ)) {

            ?>

                <tr>
                    <td><?php echo $voluntario->Numero_socio ?></td>
                    <td><?php echo $voluntario->Nombre ?></td>
                    <td><?php echo $voluntario->Titulacion ?></td>
                    <td>

                        <form action="modificar_dependientes_admin.php" method="post">
                            <input type="hidden" id="dependiente" name="dependiente" value="<?php echo $voluntario->Numero_socio ?>">
                            <input type="submit" class="btn btn-success" value="Modificar">
                        </form>
                    </td>

                    <td>
                        <?php
                        if (esBoraable($voluntario->Numero_socio, $conexion) == true) {
                        ?>
                            <form action="eliminar_dependiente.php" method="post">
                                <input type="hidden" id="dependiente" name="dependiente" value="<?php echo $voluntario->Numero_socio ?>">
                                <input type="submit" class="btn btn-danger" value="Eliminar">
                            </form>
                        <?php
                        } else {
                        ?>
                            <div class="alert alert-warning alert-dismissable"> 
                                El dependiente tiene a un dependiente a su cargo, debes deshacer la pareja
                            </div>
                        <?php
                        }
                        ?>
                    </td>
                <?php } ?>



                </tr>
        </tbody>
    </table>

</body>

</html>
<?php