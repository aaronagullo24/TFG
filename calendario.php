<?php
session_start();
include_once "conectar.php";
$conexion = conectar();

$sql = "SELECT * FROM calendarios";
$consulta = $conexion->prepare($sql);
$consulta->execute();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel='stylesheet' href="fullcalendar/fullcalendar.css" />
    <script src="fullcalendar/lib/jquery.min.js"></script>
    <script src="fullcalendar/lib/moment.min.js"></script>
    <script src="fullcalendar/fullcalendar.js"></script>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                events: [
                    <?php
                    while ($calendario = $consulta->fetch(PDO::FETCH_OBJ)) {
                    ?> {

                            id: "<?php echo $calendario->id ?>",
                            title: "<?php echo $calendario->title ?>",
                            start: "<?php echo $calendario->start ?>",
                            end: "<?php echo $calendario->end ?>",
                            url: "<?php echo $calendario->url ?>",
                            color: " <?php echo $calendario->color ?>",
                            editable: "<?php echo $calendario->editable ?>"

                        },
                    <?php
                    }
                    ?>
                ]
            })
        });
    </script>

</head>

<body>
    Fullcalendar
    <div id="calendar">

    </div>


</body>

</html>