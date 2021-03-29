<?php

include_once "./Auto.php";
include_once "./Garage.php";

$garage = new Garage("Mi Garage", 200);
$autoOne = new Auto(array('_marca' => 'Nissan', '_color' => 'Negro', '_precio' => 350000, '_fecha' => new DateTime("now")));
$autoTwo = new Auto(array('_marca' => 'Toyota', '_color' => 'Blanco', '_precio' => 500000));
$autoThree = new Auto(array('_marca' => 'Ford', '_color' => 'Azul'));

echo "<h2>Prueba de métodos 'Add' y 'MostrarGarage':</h2>";
echo $garage->Add($autoOne);
echo $garage->Add($autoOne);
echo $garage->Add($autoTwo);
echo $garage->Add($autoThree);
echo $garage->MostrarGarage();
echo "<h2>Prueba del método 'Remove':</h2>";
echo $garage->Remove($autoTwo);
echo $garage->Remove($autoTwo);
echo $garage->MostrarGarage();
echo $garage->Add($autoTwo);
echo $garage->MostrarGarage();
?>