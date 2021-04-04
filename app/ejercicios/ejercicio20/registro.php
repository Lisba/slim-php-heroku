<?php
include_once "./Usuario.php";

$nuevoUsuario = new Usuario();

$nuevoUsuario->nombre = $_POST["usuario"];
$nuevoUsuario->clave = $_POST["clave"];
$nuevoUsuario->email = $_POST["email"];

echo Usuario::ValidarUsuario($nuevoUsuario);
?>