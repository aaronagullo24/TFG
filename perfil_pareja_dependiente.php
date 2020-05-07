<?php
session_start();
include_once "conectar.php";
$conexion = conectar();
if (!isset($_SESSION['dependiente'])) {
    header("Location: login.php");
}
$dependiente = $_SESSION['dependiente'];
$nombre = $dependiente->Nombre;


$sql = "SELECT * FROM parejas WHERE id_dependientes=:id_dependientes;";
$consulta = $conexion->prepare($sql);
$consulta->execute([":id_dependientes" => $dependiente->Numero_socio]);
$id_voluntario = $consulta->fetch(PDO::FETCH_OBJ);

$sql1 = "SELECT * FROM voluntario WHERE Numero_socio=:Numero_socio;";
$consulta1 = $conexion->prepare($sql1);
$consulta1->execute([":Numero_socio" => $id_voluntario->id_voluntario]);
$voluntario = $consulta1->fetch(PDO::FETCH_OBJ);

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
</head>

<body style="background-color: aquamarine;">

    <!-- menú de navegación -->
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="inicio_dependientes
        .php">
            <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap">
            <?php
            echo $nombre;
            ?>
            </p> </a>
        <div class="collapse navbar-collapse " id="navbarTogglerDemo01">
            <div class="navbar-nav mr-auto ml-auto text-center">
                <a class="nav-item nav-link " href="solicitar_dependientes.php" mark>Solicitar</a>
                <a class="nav-item nav-link" href="ver_perfil_dependientes.php">Perfil</a>
                <a class="nav-item nav-link " href="calendario_dependiente.php">Calendario</a>
                <a class="nav-item nav-link " href="chat_voluntario.php">Chat</a>
                <a class="nav-item nav-link " href="perfil_pareja_dependiente.php">Perfil del Voluntario</a>
                <a class="nav-item nav-link text-danger" href="emergencia_dependientes.php">Emergencias</a>
                
            </div>
            <div class="d-flex flex-row justify-content-center">

                <a href="login.php" class="btn btn-outline-danger">Cerrar sesion</a>
            </div>
        </div>
    </nav>


    <div class="container">
        <br>

        <hr>

        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Perfil de su voluntario <?php echo $voluntario->Nombre ?></h4>

                <form>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input id="Nombre" name="Nombre" class="form-control" type="text" value="<?php echo $voluntario->Nombre ?>" disabled>
                        <div id="nombre"></div>
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="correo" id="correo" class="form-control" placeholder="Correo Electronico" type="email" value="<?php echo $voluntario->Correo ?>" disabled>
                        <div id="Correo"></div>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" id="titulacion" disabled>
                            <option selected=""> <?php echo $voluntario->Titulacion ?></option>


                        </select>
                        <div id="Titulacion"></div>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control" id="password" placeholder="Create password" type="password" value="<?php echo $voluntario->Password ?>" disabled>
                        <div id="Password"></div>
                    </div>


                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control" id="descripcion" type="text" value="<?php echo $voluntario->descripcion ?>" disabled>
                        <div id="Password"></div>
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control" id="experiencia" type="text" value="<?php echo $voluntario->experiencia ?>" disabled>
                        <div id="Password"></div>
                    </div>

                </form>
            </article>
        </div>

    </div>
</body>