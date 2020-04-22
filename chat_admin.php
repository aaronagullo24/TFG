<?php
session_start();
if (!isset($_SESSION['administrador'])) {
    header("Location: login.php");
}
$administrador = $_SESSION['administrador'];
include_once "conectar.php";
include_once "cabecera.php";

$conexion = conectar();
unset($_SESSION['id_dependiente']);
unset($_SESSION['id_voluntario']);
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
    <script src="js/buscar.js"></script>

</head>

<body style="background-color: aquamarine;">
    <?php
    administrador($administrador);
    ?>
    <input class="form-control col-md-3 light-table-filter" data-table="order-table" type="text" placeholder="buscar..">
    <br>
    <br>
    <?php
    if (isset($_REQUEST['vaciado'])) {
    ?>
        <div class="alert alert-success">Vaciado con exito</div>

    <?php
        unset($_REQUEST['vaciado']);
    }
    ?>
    <table class="table table-hover order-table" id="tabla">
        <thead class="thead-dark">
            <tr>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Nombre Voluntario</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Id del Voluntario</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Nombre Dependiente</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Id del dependiente</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">Interactuar</th>
                <th style="width:180px; background-color: #5DACCD; color:#fff">vaciar Chat</th>
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

                        <form action="ver_chat_admin.php" method="post">
                            <input type="hidden" name="voluntario" value="<?php echo $voluntario->Numero_socio ?>">
                            <input type="hidden" name="dependiente" value="<?php echo $dependiente->Numero_socio ?>">
                            <input type="submit" class="btn btn-success" value="Interactuar">
                        </form>
                    </td>

                    <td>

                        <form action="vaciar_chat.php" method="post">
                            <input type="hidden" name="voluntario" value="<?php echo $voluntario->Numero_socio ?>">
                            <input type="hidden" name="dependiente" value="<?php echo $dependiente->Numero_socio ?>">
                            <input type="submit" class="btn btn-danger" value="Vaciar Chat">
                        </form>
                    </td>

                <?php } ?>
                </tr>
        </tbody>
    </table>
</body>

</html>