<?php
include_once "./Venta.php";

$nuevaVenta = NULL;
$pathJson = "./ventas.json";

if(isset($_POST["codigoBarra"]) &&
   isset($_POST["id"]) &&
   isset($_POST["cantidad"]))
{
  $nuevaVenta = new Venta($_POST["codigoBarra"],
                          intval($_POST["id"]),
                          intval($_POST["cantidad"]),
                        );

  echo Venta::AltaVenta($nuevaVenta, $pathJson);
}
else
{
  echo "No se pudo efectuar la venta, verifique los campos enviados.";
}
?>