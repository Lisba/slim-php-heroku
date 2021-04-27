<?php
include_once "./Usuario.php";
include_once "./Producto.php";
include_once "./Venta.php";
include_once "./BD.php";

if(isset($_GET["listado"]))
{
  switch($_GET["listado"])
  {
    case 'usuarios':
      echo Usuario::ObtenerListadoBD();
      break;
    case 'productos':
      echo Producto::ObtenerListadoBD();
      break;
    case 'ventas':
      echo Venta::ObtenerListadoBD();
      break;
    default:
      echo 'Solo se soportan 3 tipos de listados, usuarios, productos y ventas.';
  }
}
else
{
  echo "No se pudieron mostrar los datos, revise los campos!";
}

?>