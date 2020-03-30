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
    <script src="js/comprobar_form_dependientes.js"></script>
    <script src="js/mi_libreriaAjax.js"></script>

</head>

<body style="background-color: aquamarine;">

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

    <div class="container">
       
        <hr>
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 800px;">
                <h4 class="card-title mt-3 text-center">Registro Dependientes</h4>

                <form>
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input id="Nombre" name="Nombre" class="form-control input-lg" aria-describedby="inputGroup-sizing-lg" placeholder="Nombre completo" type="text">

                        <div id="nombre"></div>
                    </div>
                    <br>

                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="correo" id="correo" class="form-control" placeholder="Correo Electronico" type="email">
                        <div id="Correo"></div>
                    </div>
                    <br>
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control" id="password" placeholder="Create password" type="password">
                        <div id="Password"></div>
                    </div>
                    <br>

                    <div class="input-group mb-8">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Provincia en la que vive: </label>
                        </div>

                        <select name="provinciaList" id="provinciaList" onChange="return provinciaListOnChange()" class="custom-select">
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
                        <div id="provincia"></div>

                        <br>
                        <br>
                    </div>
                    <div class="input-group mb-8">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Localidad en la que vive: </label>
                        </div>
                        <select name="localidadList" id="localidadList" class="form-control">
                            <option>Seleccione antes una provincia</option>
                        </select> <span id="advice"> </span>
                        <div id="localidad"></div>
                    </div>
                    <br>


                    <div class="form-group">
                        <label for="start">Fecha de nacimiento:</label>

                        <input type="date" id="start" name="trip-start" value="2018-07-22" min="2018-01-01" max="2018-12-31">
                    </div>



                    <br>
                    <div class="form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <textarea class="form-control" rows="3" id="dependencia" placeholder="Escriba brevemente sus necesidad y patologias"></textarea>

                        <div id="fecha"></div>

                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" id="boton"> Crear cuenta </button>
                    </div>
                    <div id="alta"></div>

                </form>
            </article>
        </div>

    </div>





</body>

</html>