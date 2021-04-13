<?php
include_once "./Usuario.php";

date_default_timezone_set("America/Argentina/Buenos_Aires");
$nuevoUsuario = NULL;
$pathUsuariosJson = "./usuarios.json";

if(isset($_POST["usuario"]) && isset($_POST["clave"]) && isset($_POST["email"]) && isset($_FILES["archivo"]))
{
  $nuevoUsuario = new Usuario($_POST["usuario"], $_POST["clave"], $_POST["email"]);
  $destino = "./usuario/fotos/{$_POST["usuario"]}-{$_POST["email"]}.".pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
  move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino);
  echo Usuario::AltaUsuario($nuevoUsuario, $pathUsuariosJson);
}
else
{
  echo "No se pudo mostrar el usuario, verifique los campos enviados.";
}
?>