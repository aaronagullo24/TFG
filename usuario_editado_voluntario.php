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
</head>

<body style="background-color: #4FD53C;">

<?php
    voluntario($voluntario);
    ?>
    <br>
    <br>
    <div class="alert alert-success text-center">¡USUARIO EDITADO CORRECTAMENTE!</div>
</body>

</html>