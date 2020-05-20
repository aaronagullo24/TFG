<?php

function dependiente($dependiente)
{
    include_once "conectar.php";
    $conexion = conectar();
    $sql1 = "SELECT * FROM parejas WHERE id_dependientes=:id_dependientes;";
    $consulta1 = $conexion->prepare($sql1);
    $consulta1->execute([":id_dependientes" => $dependiente->Numero_socio]);
    $id = $consulta1->fetch(PDO::FETCH_OBJ);

    $sql = "SELECT * FROM chat WHERE id=:id_voluntario AND Leido IS NULL;";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([":id_voluntario" => $id->id_voluntario]);

?>
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="inicio_dependientes.php">
            <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap">
            <?php
            echo $dependiente->Nombre;
            ?> </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="navbar-nav mr-auto ml-auto text-center">
                <a class="nav-item nav-link " href="solicitar_dependientes.php">Solicitar</a>
                <a class="nav-item nav-link" href="ver_perfil_dependientes.php">Perfil</a>
                <a class="nav-item nav-link " href="calendario_dependiente.php">Calendario</a>
                <?php
                if ($consulta->rowCount() == 0) {
                ?>
                    <a class="nav-item nav-link " href="chat_voluntario.php">Chat</a>
                <?php
                } else {
                ?>
                    <a class="nav-item nav-link " href="chat_voluntario.php">chat</a>
                    <h6><span class="badge badge-secondary text-success"><?php echo $consulta->rowCount() ?></span></h6>
                <?php
                }
                ?>
                <a class="nav-item nav-link " href="perfil_pareja_dependiente.php">Perfil del Voluntario</a>
                <a class="nav-item nav-link text-danger" href="emergencia_dependientes.php">Emergencias</a>
            </div>
            <div class="d-flex flex-row justify-content-center">

                <a href="cerrar_session_dependiente.php" class="btn btn-outline-danger">Cerrar sesion</a>
            </div>
        </div>
    </nav>
<?php
}

function voluntario($nombre)
{
?>
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
                <a class="nav-item nav-link " href="calendario_voluntario.php">Calendario</a>
                <a class="nav-item nav-link " href="chat_dependiente.php">Chat</a>
                <a class="nav-item nav-link " href="perfil_dependiente.php">Perfil dependiente</a>

            </div>
            <div class="d-flex flex-row justify-content-center">

                <a href="cerrar_session_voluntario.php" class="btn btn-outline-danger">Cerrar sesion</a>
            </div>
        </div>
    </nav>
<?php
}
