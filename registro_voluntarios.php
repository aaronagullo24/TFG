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
    <script src="js/AjaxCode.js"></script>
    <script src="js/comprobar_form_voluntarios.js"></script>
    <script src="js/mi_libreriaAjax.js"></script>
</head>

<body style="background-color: aquamarine;" >

    <!-- menú de navegación -->
    <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index.html">
            <img src="resources/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Bootstrap">
            Oldver </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="navbar-nav mr-auto ml-auto text-center">
                <a class="nav-item nav-link " href="index.html">Inicio</a>
                <a class="nav-item nav-link" href="nosotros.html">Nosotros</a>
                <a class="nav-item nav-link " href="servicio.html">Servicios</a>
                <a class="nav-item nav-link" href="contactar.html">Contacto</a>
            </div>
            <div class="d-flex flex-row justify-content-center">
                <a href="elejis_tipo_usuario.html" class="btn btn-outline-primary mr-2">Nuevo Usuario</a>
                <a href="#" class="btn btn-outline-danger">Entrar</a>
            </div>
        </div>
    </nav>

    <form id="form">

        <div class="form-group">
            <label for="full_name_id" class="control-label">DNI</label>
            <input type="text" class="form-control" id="DNI" name="DNI" placeholder="12345678D">
            <div id="dni"></div>
        </div>

        <div class="form-group">
            <label for="street1_id" class="control-label">Nombre</label>
            <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre apellido1 apellido2">
            <div id="nombre"></div>
        </div>
        <div class="form-group">
            <label for="city_id" class="control-label">Nick</label>
            <input type="text" class="form-control" id="Nick" name="Nick" placeholder="Nos servira para identificarnos en la aplicacion">
            <div id="nick"></div>
        </div>

        <div class="form-group">
            <label for="street2_id" class="control-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <div id="Password"></div>
        </div>


        <div class="form-group">
            <label for="city_id" class="control-label">Titulacion</label>
            <input type="text" class="form-control" id="titulacion" name="titulacion" placeholder="Titulos que tienes en posesion">
            <div id="Titulacion"></div>
        </div>



        <div class="form-group">

            <label for="provincia" class="control-label">Seleccione su provincia:</label>
            <br>
            <select name="provinciaList" id="provinciaList" onChange="return provinciaListOnChange()" class="form-control">
                <option>Seleccione su provincia...</option>
                <?php
                $xml = simplexml_load_file('provinciasypoblaciones.xml');
                $result = $xml->xpath("/lista/provincia/nombre | /lista/provincia/@id");
                for ($i = 0; $i < count($result); $i += 2) {
                    $e = $i + 1;
                    $provincia = UTF8_DECODE($result[$e]);
                    echo ("<option value='$result[$i]'>$provincia</option>");
                }
                ?>
            </select>

            <br>

            <label for="localidad" class="control-label">Seleccione su localidad:</label> <br>
            <select name="localidadList" id="localidadList" class="form-control">
                <option>Seleccione antes una provincia</option>
            </select> <span id="advice"> </span>
        </div>

        <div class="form-group">
            <label for="zip_id" class="control-label">Direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion">
        </div>

        <div class="form-group">
            <label for="zip_id" class="control-label">Edad</label>
            <input type="number" class="form-control" id="edad" name="edad">
            <div id="Edad"></div>
        </div>

        <div class="form-group">
            <label for="zip_id" class="control-label">Correo Electronico</label>
            <input type="email" class="form-control" id="correo" name="correo">

            <div id="Correo"></div>
        </div>

    
        <div class="form-group">
            <button type="submit" class="btn btn-primary" id="boton">REGISTRARSE</button>
        </div>


</body>

</html>