<?php

include './Auto.php';

$autoOne = new Auto(array('_marca' => 'Ford', '_color' => 'Rojo'));
$autoTwo = new Auto(array('_marca' => 'Ford', '_color' => 'Azul'));
$autoThree = new Auto(array('_marca' => 'Toyota', '_color' => 'Verde', '_precio' => 200000));
$autoFour = new Auto(array('_marca' => 'Toyota', '_color' => 'Verde', '_precio' => 270000));
$autoFive = new Auto(array('_marca' => 'Nissan', '_color' => 'Negro', '_precio' => 350000, '_fecha' => new DateTime("now")));

$autoThree->AgregarImpuestos(1500);
$autoFour->AgregarImpuestos(1500);
$autoFive->AgregarImpuestos(1500);

echo Auto::Add($autoOne, $autoTwo);

echo "<p><b>¿El Auto 1 es igual al auto 2?: </b>", $autoOne->Equals($autoTwo), "</p>";
echo "<p><b>¿El Auto 1 es igual al auto 5?: </b>", $autoOne->Equals($autoFive), "</p>";

echo "<p><b>Auto 1: </b>", Auto::MostrarAuto($autoOne), "</p>";
echo "<p><b>Auto 3: </b>", Auto::MostrarAuto($autoThree), "</p>";
echo "<p><b>Auto 5: </b>", Auto::MostrarAuto($autoFive), "</p>";
?>
