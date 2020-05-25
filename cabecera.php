<?php

function administrador($administrador){
    ?>
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">

    <div class="navbar-header">

        <a class="navbar-brand" href="inicio_administrador.php">
            <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap"> Administrador
            <?php
            echo $administrador->nombre;
            ?>
            </p> </a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Desplegar navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Crear
                </a>
                <ul class="dropdown-menu">
                    <li><a href="crear_voluntario.php">Crear Voluntario</a></li>
                    <li><a href="crear_dependiente.php">Crear Dependiente</a></li>
                    <li><a href="crear_pareja.php">Crear Pareja</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Modificar
                </a>
                <ul class="dropdown-menu">
                    <li><a href="modificar_voluntario.php">Modificar Voluntario</a></li>
                    <li><a href="modificar_dependiente.php">Modificar Dependiente</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav">
            <li><a href="chat_admin.php">Chat</a></li>
        </ul>
        <ul class="nav navbar-nav">
            <li><a href="parejas.php">Parejas</a></li>
        </ul>

        <ul class="nav navbar-nav">
            <li><a href="calendario_admin.php">Calendario</a></li>
        </ul>
    </div>
    <div class="d-flex flex-row justify-content-center">

        <a href="cerrar_sesion_admin.php" class="btn btn-outline-danger">Cerrar sesion</a>
    </div>
    </div>
</nav>
<?php
}