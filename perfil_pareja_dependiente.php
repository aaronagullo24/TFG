<?php
session_start();
include_once "conectar.php";
$conexion = conectar();
if (!isset($_SESSION['dependiente'])) {
    header("Location: login.php");
}
include_once("funciones.php");
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

<body style="background-color: #4FD53C;">

    <?php
    dependiente($dependiente);
    ?>

    <?php
    $sql = "SELECT * FROM parejas WHERE id_dependientes=:id_dependientes";
    $consulta = $conexion->prepare($sql);
    $consulta->execute(["id_dependientes" => $dependiente->Numero_socio]);
    $consulta_dependientes = $consulta->fetch(PDO::FETCH_OBJ);

    if ($consulta->rowCount() == 0) {
    ?>

        <div class="alert alert-success mt-3 text-center">
            Esta funcion se habilitara cuando tenga un voluntario
        </div>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <form action="eliminar_pareja_dependiente.php">
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
    <?php } ?>
</body>