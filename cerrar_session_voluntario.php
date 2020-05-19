<?php
session_start();
$usuario=$_SESSION['usuario'] ;
unset($_SESSION['usuario']);
session_destroy();
header("Location: login.php");