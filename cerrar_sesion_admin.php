<?php
session_start();
$usuario=$_SESSION['administrador'] ;
unset($_SESSION['administrador']);
session_destroy();
header("Location: login_admin.php");