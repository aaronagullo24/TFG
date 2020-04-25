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

</head>

<body>
    Fullcalendar
    <div id="calendar">

    </div>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
            })

        });
    </script>
</body>

</html>