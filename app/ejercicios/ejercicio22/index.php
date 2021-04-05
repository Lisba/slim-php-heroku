<?php
include_once "./Usuario.php";
include_once "./Login.php";

$email = $_POST["email"];
$clave = $_POST["clave"];

$usuarioNoVerificado = new Login($email, $clave);
echo $usuarioNoVerificado->VerificarUsuario();
?>