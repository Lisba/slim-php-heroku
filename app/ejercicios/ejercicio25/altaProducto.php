<?php
include_once "./Producto.php";

$nuevoProducto = NULL;
$pathJson = "./productos.json";

if(isset($_POST["codigoBarra"]) && 
   isset($_POST["nombre"]) && 
   isset($_POST["tipo"]) && 
   isset($_POST["stock"]) && 
   isset($_POST["precio"]))
{
  $nuevoProducto = new Producto($_POST["codigoBarra"],
                                $_POST["nombre"],
                                $_POST["tipo"],
                                round(intval($_POST["stock"]), 2),
                                floatval($_POST["precio"])
                              );

  echo Producto::AltaProducto($nuevoProducto, $pathJson);
}
else
{
  echo "No se pudo dar de alta el producto, verifique los campos enviados.";
}
?>