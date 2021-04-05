<?php
include_once "./Usuario.php";

$listado = $_GET["listado"];

echo Usuario::ObtenerListado($listado);
?>