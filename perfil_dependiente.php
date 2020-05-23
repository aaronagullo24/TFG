<?php
include_once "conectar.php";
$conexion = conectar();
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}
include_once "funciones.php";
$voluntario = $_SESSION['usuario'];
$nombre = $voluntario->Nombre;

$sql = "SELECT * FROM dependiente WHERE voluntario=:voluntario;";
$consulta = $conexion->prepare($sql);
$consulta->execute([":voluntario" => $voluntario->Numero_socio]);
$dependiente = $consulta->fetch(PDO::FETCH_OBJ);
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

<body style="background-color: #4FD53C;">

    <?php
    voluntario($voluntario);
    ?>
    <?php
    $sql = "SELECT * FROM parejas WHERE id_voluntario=:id_voluntario";
    $consulta = $conexion->prepare($sql);
    $consulta->execute(["id_voluntario" => $voluntario->Numero_socio]);
    $consulta_dependientes = $consulta->fetch(PDO::FETCH_OBJ);

    if ($consulta->rowCount() == 0) {
    ?>
        <div class="alert alert-success mt-3 text-center">Podra ver el perfil de su dependiente cuando tenga uno a su cargo</div>
    <?php
    } else {
    ?>
        <div class="container">
            <br>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                Eliminar Pareja
            </button>
            <hr>

            <div class="card bg-light">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Perfil de <?php echo $dependiente->Nombre ?></h4>

                    <form>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>

                            <input id="Nombre" name="Nombre" class="form-control input-lg" aria-describedby="inputGroup-sizing-lg" placeholder="Nombre completo" type="text" value="<?php echo $dependiente->Nombre ?>" disabled>

                            <div id="nombre"></div>
                        </div>
                        <br>

                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="correo" id="correo" class="form-control" placeholder="Correo Electronico" type="email" value="<?php echo $dependiente->Correo ?>" disabled>
                            <div id="Correo"></div>
                        </div>
                        <br>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input class="form-control" id="password" placeholder="Create password" type="password" value="<?php echo $dependiente->Password ?>" disabled>
                            <div id="Password"></div>
                        </div>
                        <br>

                        <div class="input-group mb-8">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Provincia en la que vive: </label>
                            </div>

                            <select name="provinciaList" id="provinciaList" class="custom-select" disabled>
                                <option><?php echo $dependiente->Provincia ?></option>

                            </select>
                            <div id="provincia"></div>

                            <br>
                            <br>
                        </div>
                        <div class="input-group mb-8">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Localidad en la que vive: </label>
                            </div>
                            <select name="localidadList" id="localidadList" class="form-control" disabled>
                                <option><?php echo $dependiente->Localidad ?></option>
                            </select> <span id="advice"> </span>
                            <div id="localidad"></div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="start">Fecha de nacimiento:</label>

                            <input type="date" id="fecha_nacimiento" name="trip-start" value="<?php echo $dependiente->Fecha_nacimiento ?>" disabled>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <textarea class="form-control" rows="3" id="dependencia" placeholder="<?php echo $dependiente->Necesidad ?>" disabled></textarea>

                            <div id="fecha"></div>

                        </div>
                    </form>
                </article>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">¿Esta seguro que desea eliminar a su pareja?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Si elimina a su voluntario este ya no sera su pareja y tendra que ponerse en contacto con otro
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form action="eliminar_pareja_voluntario.php">
                                <input type="hidden" id="voluntario" name="voluntario" value="<?php echo $voluntario->Numero_socio ?>">
                                <input type="hidden" id="dependiente" name="dependiente" value="<?php echo $dependiente->Numero_socio ?>">
                                <input type="submit" class="btn btn-danger" value="ELIMINAR">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
            <script src="js/bootstrap.min.js"></script>
        </div>
    <? } ?>