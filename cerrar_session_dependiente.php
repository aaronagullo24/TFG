<?php
session_start();
$usuario=$_SESSION['dependiente'] ;
unset($_SESSION['dependiente']);
session_destroy();
header("Location: login.php");