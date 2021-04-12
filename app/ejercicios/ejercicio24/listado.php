<?php
include_once "./Usuario.php";

if(isset($_GET["listado"]))
{
  echo Usuario::ObtenerListado($_GET["listado"]);
}
else
{
  echo "No se pudieron mostrar los datos, revise los campos!";
}

?>