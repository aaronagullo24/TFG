<?php
session_start();
if (!isset($_SESSION['administrador'])) {
    header("Location: login.php");
}
$administrador = $_SESSION['administrador'];

include_once "cabecera.php";
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
    <?php
    administrador($administrador);
    if (isset($_REQUEST['bien'])) {
    ?>
        <div class="alert alert-success">Pareja creada con exito</div>
    <?php
    }
    ?>

    <form method="POST" action="crear_pareja2.php">
        <div class="container">
            <div class="form-group">
                <label for="Dependiente">Dependientes</label>
                <select class="form-control form-control-lg" id="dependientes" name="dependientes">
                    <?php
                    $sql = "SELECT * FROM dependiente WHERE voluntario IS NULL";
                    $consulta = $conexion->prepare($sql);
                    $consulta->execute();

                    while ($dependiente = $consulta->fetch(PDO::FETCH_OBJ)) {
                    ?>
                        <option value="<?php echo $dependiente->Numero_socio ?>"><?php echo $dependiente->Nombre . " - " . $dependiente->Numero_socio ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="voluntario">Voluntarios</label>
                <select class="form-control form-control-lg" id="voluntarios" name="voluntarios">
                    <?php
                    $sql2 = " SELECT voluntario,voluntario.Numero_socio,voluntario.Nombre FROM voluntario 
                    left JOIN dependiente ON voluntario.Numero_socio = dependiente.voluntario";
                    $c = $conexion->prepare($sql2);
                    $c->execute();

                    //var_dump($pareja);
                    while ($pareja = $c->fetch(PDO::FETCH_OBJ)) {
                        if ($pareja->voluntario == NULL) {
                    ?>
                            <option value="<?php echo $pareja->Numero_socio ?>"><?php echo $pareja->Nombre . " - " . $pareja->Numero_socio ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <input type="submit" class="btn btn-primary btn-lg btn-block" value="CREAR" name="boton" id="boton">
        </div>
    </form>


</body>

</html>


<?php
if (isset($_REQUEST['boton'])) {
    echo "entra";
    $dependiente = $_REQUEST['dependientes'];
    $voluntario = $_REQUEST['voluntarios'];
}
