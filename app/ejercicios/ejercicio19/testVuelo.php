<?php

include_once './Pasajero.php';
include_once './Vuelo.php';

$v1 = new Vuelo("Air-Kombat",1000,2);
$v2 = new Vuelo("Air-Visa",2000,2);

$p1 = new Pasajero("Rodi","Maggie","12448571",true);
$p2 = new Pasajero("Rodi","Maggie","12448571",true); //Repetido
$p3 = new Pasajero("Ketchup","Ash","98765432",false);
$p4 = new Pasajero("Blade","Sonya","77777777",true);
$p5 = new Pasajero("En gel","Alcohol","1111111",false);

// echo $p1->GetInfoPasajero();
// echo $p2->GetInfoPasajero();
// echo $p3->GetInfoPasajero();
// echo $p4->GetInfoPasajero();
// //Pasajero::MostrarPasajero($p1);
// echo "Son iguales (Equals): " . $p1->Equals($p1,$p2);

echo "<hr>";
echo "<br>";
//echo $v1->getInfoVuelo();
//echo $v1->MostrarVuelo();

echo $v1->AgregarPasajero($p1);
//echo $v1->AgregarPasajero($p1); //Repetido
//echo $v1->AgregarPasajero($p2); //Repetido (Idem p1)
echo $v1->AgregarPasajero($p3);
echo $v1->AgregarPasajero($p4); //Se superó la cantidad máxima de pasajeros.
echo $v1->AgregarPasajero($p5); //Se superó la cantidad máxima de pasajeros.

echo $v1->getInfoVuelo();


echo "<hr>";
echo $v1->Remove($p3);
echo $v1->Remove($p5); //El pasajero no está en el vuelo.
echo $v1->getInfoVuelo();

echo "Count de pasajeros: ${$v1->GetCountPasajeros()}";


echo "<hr>";
echo "<br>";
echo "<br>";
$v1->AgregarPasajero($p4);
$v1->AgregarPasajero($p5);

$v2->AgregarPasajero($p3);
$v2->AgregarPasajero($p5);

echo $v1->Add($v1,$v2);
?>