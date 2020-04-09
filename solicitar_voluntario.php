<?php
include_once "conectar.php";
$conexion = conectar();
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}
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
    <script src="js/mi_libreriaAjax.js"></script>
    <script src="js/AjaxCode.js"></script>
    <script src="js/buscar.js"></script>
</head>

<body style="background-color: aquamarine;">

    <!-- menú de navegación -->
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="ver_perfil_voluntario.php">
            <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap">
            <?php
            echo $nombre;
            ?> </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="navbar-nav mr-auto ml-auto text-center">
                <a class="nav-item nav-link " href="solicitar_voluntario.php">Solicitar</a>
                <a class="nav-item nav-link" href="ver_perfil_voluntario.php">Perfil</a>
                <a class="nav-item nav-link " href="calendario.php">Calendario</a>

            </div>
            <div class="d-flex flex-row justify-content-center">

                <a href="login.php" class="btn btn-outline-danger">Cerrar sesion</a>
            </div>
        </div>
    </nav>

    <section class="container my-0 py-4">
        <h3 class="text-uppercase text-center mb-4">Oldver</h3>
        <p class="lead text-center mb-5">Aqui puedes enviar peticiones a nuestros mayores para que puedas ayudarles,
            todos estaran encantados de tenerte </p>

    </section>
    <?php
    $sql = "SELECT * FROM parejas WHERE id_voluntario=:id_voluntario";
    $consulta = $conexion->prepare($sql);
    $consulta->execute(["id_voluntario" => $voluntario->Numero_socio]);
    $consulta_dependientes = $consulta->fetch(PDO::FETCH_OBJ);

    if ($consulta->rowCount() != 0) {
    ?>
        <div class="alert alert-success">¡usted ya una persona a la que cuidar, MUCHAS GRACIAS!</div>
    <?php
    } else {

 ?>

    <input class="form-control col-md-3 light-table-filter" data-table="order-table" type="text" placeholder="buscar..">
    <br>
    <table class="table table-hover order-table" id="tabla">
        <thead class="thead-dark">
            <tr>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Nombre</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Provincia</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Localidad</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Necesidad</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Contactar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $sql = "SELECT * FROM dependiente where voluntario IS NULL";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();


            while ($dependiente = $consulta->fetch(PDO::FETCH_OBJ)) {
            ?>

                <tr>

                    <td><?php echo $dependiente->Nombre ?></td>
                    <td><?php echo $dependiente->Provincia ?></td>
                    <td><?php echo $dependiente->Localidad ?></td>
                    <td><?php echo $dependiente->Necesidad ?></td>
                    <td>
                        <?php

                        $sql1 = "SELECT * FROM solicitudes where voluntario=:voluntario and dependiente=:dependiente";
                        $consulta2 = $conexion->prepare($sql1);
                        $consulta2->execute([":voluntario" => $voluntario->Numero_socio, ":dependiente" => $dependiente->Numero_socio]);
                        $dependiente1 = $consulta2->fetch(PDO::FETCH_OBJ);

                        if ($consulta2->rowCount() != 0) {
                            echo "Ya tiene una solicitud";
                        } else {

                        ?>
                            <form action="boton_solicitud_voluntario.php" method="post">
                                <input type="hidden" name="dependiente" value="<?php echo $dependiente->Numero_socio ?>">
                                <input type="submit" class="btn btn-primary" value="Enviar Solicitud">
                            </form>
                        <?php } ?>
                    </td>

                </tr>

            <?php } ?>
            
        </tbody>
    </table>
    <?php } ?>
</body>
</html>