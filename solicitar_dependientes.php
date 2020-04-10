<?php
include_once "conectar.php";
$conexion = conectar();
session_start();
if (!isset($_SESSION['dependiente'])) {
    header("Location: login.php");
}
$dependiente = $_SESSION['dependiente'];
$nombre = $dependiente->Nombre;
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
</head>

<body style="background-color: aquamarine;">

    <!-- menú de navegación -->
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="inicio_dependientes.php">
            <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap">
            <?php
            echo $nombre;
            ?>
            </p> </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="navbar-nav mr-auto ml-auto text-center">
                <a class="nav-item nav-link " href="solicitar_dependientes.php">Solicitar</a>
                <a class="nav-item nav-link" href="ver_perfil_dependientes.php">Perfil</a>
                <a class="nav-item nav-link " href="calendario.php">Calendario</a>
                <a class="nav-item nav-link " href="su_voluntario.php">Voluntario</a>
            </div>
            <div class="d-flex flex-row justify-content-center">

                <a href="login.php" class="btn btn-outline-danger">Cerrar sesion</a>
            </div>
        </div>
    </nav>

    <section class="container my-0 py-4">
        <h3 class="text-uppercase text-center mb-4">Oldver</h3>
        <p class="lead text-center mb-5">Aqui puedes ver todos los dependientes que desean ayudarle con sus problemas </p>

    </section>
    <?php
    $sql = "SELECT * FROM parejas WHERE id_dependientes=:id_dependientes";
    $consulta = $conexion->prepare($sql);
    $consulta->execute(["id_dependientes" => $dependiente->Numero_socio]);
    $consulta_dependientes = $consulta->fetch(PDO::FETCH_OBJ);

    if ($consulta->rowCount() == 1) {
    ?>
        <div class="alert alert-success">¡usted ya tiene un voluntario asignado,ENHORABUENA!</div>
    <?php
    } else {
    ?>
        <input class="form-control col-md-3 light-table-filter" data-table="order-table" type="text" placeholder="buscar..">
        <br>
        <table class="table table-hover order-table" id="tabla">
            <thead class="thead-dark">
                <tr>
                    <th style="width:180px; background-color: #5DACCD; color:#fff">Nombre</th>
                    <th style="width:180px; background-color: #5DACCD; color:#fff">Titulacion</th>
                    <th style="width:180px; background-color: #5DACCD; color:#fff">Aceptar</th>
                    <th style="width:180px; background-color: #5DACCD; color:#fff">Denegar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $Numero_dependiente = $dependiente->Numero_socio;

                $sql = "SELECT * FROM solicitudes where dependiente=:dependiente";
                $consulta = $conexion->prepare($sql);
                $consulta->execute([":dependiente" => $Numero_dependiente]);



                while ($dependiente_consulta = $consulta->fetch(PDO::FETCH_OBJ)) {

                    $sql1 = "SELECT * FROM voluntario where Numero_socio=:Numero_socio";
                    $consulta2 = $conexion->prepare($sql1);
                    $consulta2->execute([":Numero_socio" => $dependiente_consulta->voluntario]);
                    $voluntario = $consulta2->fetch(PDO::FETCH_OBJ);
                ?>

                    <tr>

                        <td><?php echo $voluntario->Nombre ?></td>
                        <td><?php echo $voluntario->Titulacion ?></td>
                        <td>

                            <form action="aceptar_solicitud.php" method="post">
                                <input type="hidden" name="voluntario" value="<?php echo $voluntario->Numero_socio ?>">
                                <input type="hidden" name="dependiente" value="<?php echo $dependiente->Numero_socio ?>">
                                <input type="submit" class="btn btn-success" value="Aceptar Solicitud">
                            </form>
                        </td>

                        <td>
                            <form action="eliminar_solicitud.php" method="post">
                                <input type="hidden" name="voluntario" value="<?php echo $voluntario->Numero_socio ?>">
                                <input type="hidden" name="dependiente" value="<?php echo $dependiente->Numero_socio ?>">
                                <input type="submit" class="btn btn-danger" value="Denegar Solicitud">
                            </form>
                        </td>
                    <?php } ?>
                    </tr>
            </tbody>
        </table>
    <?php } ?>
</body>

</html>
<?php
