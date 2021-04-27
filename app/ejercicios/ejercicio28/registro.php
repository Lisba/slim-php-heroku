<?php
include_once "./Usuario.php";
include_once "./BD.php";

date_default_timezone_set("America/Argentina/Buenos_Aires");
$nuevoUsuario = NULL;

if(isset($_POST["nombre"]) &&
  isset($_POST["apellido"]) &&
  isset($_POST["clave"]) &&
  isset($_POST["mail"]) &&
  isset($_POST["localidad"]))
{
  $nuevoUsuario = new Usuario(NULL, $_POST["nombre"], $_POST["apellido"], $_POST["clave"], $_POST["mail"], $_POST["localidad"]);
  echo Usuario::AltaUsuarioBD($nuevoUsuario);
}
else
{
  echo "No se pudo mostrar el usuario, verifique los campos enviados.";
}
?>