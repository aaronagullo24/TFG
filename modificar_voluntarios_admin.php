<?php
session_start();
if (!isset($_SESSION['administrador'])) {
    header("Location: login.php");
}
include_once "conectar.php";
include_once "cabecera.php";
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
    <script src="js/editar_pefil_voluntario_admin.js"></script>
    <script src="js/mi_libreriaAjax.js"></script>
    <script src="js/AjaxCode.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body style="background-color: #4FD53C;">

    <?php
    administrador($administrador);


    $id_voluntario = $_POST['voluntario'];

    $sql = "SELECT * FROM voluntario WHERE Numero_socio=:Numero_socio";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([":Numero_socio" => $id_voluntario]);
    $voluntario = $consulta->fetch(PDO::FETCH_OBJ);
    ?>
    <div class="container">
        <br>

        <hr>

        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Modificar Voluntarios</h4>

                <form>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input id="Nombre" name="Nombre" class="form-control" placeholder="Nombre completo" type="text" value="<?php echo $voluntario->Nombre ?>">
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
                        <select class="form-control" id="titulacion">
                            <option selected=""> <?php echo $voluntario->Titulacion ?></option>
                            <option>Gerontología. </option>
                            <option>Neurología. </option>
                            <option>Enfermería. </option>
                            <option>Fisioterapia. </option>
                            <option>Cuidado y asistencia al adulto. </option>
                            <option>Educación social. </option>
                            <option>Trabajo social. </option>
                            <option>Nutrición y dietética. </option>
                            <option>Educación para adultos. </option>
                            <option>Otros... </option>
                            <option>Ninguno </option>

                        </select>
                        <div id="Titulacion"></div>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control" id="password" placeholder="Create password" type="password" value="<?php echo $voluntario->Password ?>">
                        <div id="Password"></div>
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <textarea id="descripcion" rows="3" cols="50"><?php echo $voluntario->descripcion ?></textarea>
                        <div id="descripcion1"></div>
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <textarea id="experiencia" rows="3" cols="50"><?php echo $voluntario->experiencia ?></textarea>
                        <div id="experiencia1"></div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" id="boton"> Ediatr </button>
                    </div>
                </form>
            </article>
        </div>
    </div>
</body>

</html>