<?php
class Auto
{
  private $_color;
  private $_precio;
  private $_marca;
  private $_fecha;

  public function __construct($params = array()) {
    foreach ($params as $key => $value) {
      $this->{$key} = $value;
    }
  }

  public function __get($name)
  {
      return $this->$name;
  }

  public function __set($name, $value)
  {
      echo "Estableciendo atributo '$name' a '$value' <br>";
      $this->$name = $value;
  }

  public function AgregarImpuestos(float $amount)
  {
    $this->_precio += $amount;
  }

  public function Equals(Auto $autoToCompare)
  {
    if($this->_marca === $autoToCompare->_marca)
    {
      return "True <br>";
    }
    else
    {
      return "False <br>";
    }
  }

  public static function MostrarAuto(Auto $auto) {
    $infoAuto = "<br>";

    forEach($auto as $key => $value){
      if($auto->_fecha != null && $key === '_fecha')
      {
        $infoAuto .= "Fecha: {$auto->_fecha->format("Y-m-d")} </br>";
      }
      else if($auto->$key != null)
      {
        $keyFormated = ucfirst(substr($key, 1));
        $infoAuto .= "{$keyFormated}: {$auto->$key} <br>";
      }
    }
    return $infoAuto;
  }

  public static function Add(Auto $auto1, Auto $auto2) {
    $returnValue = 'Los objetos no son de la misma marca o del mismo color.';

    if($auto1->_marca === $auto2->_marca && $auto1->_color === $auto2->_color){
      $returnValue = $auto1->_precio + $auto2->_precio;
    }
    return $returnValue;
  }
}
?>