<?php
class Garage
{
  private $_razonSocial;
  private $_precioPorHora;
  private $_autos;

  public function __construct(string $razonSocial = "", float $precioPorHora = 0)
  {
    $this->_razonSocial = $razonSocial;
    $this->_precioPorHora = $precioPorHora;
    $this->_autos = [];
  }

  public function __get($name)
  {
    return $this->name;
  }

  public function __set($name, $value)
  {
    $this->name = $value;
  }

  public function MostrarGarage()
  {
    $infoGarage = "<br>";
    $index = 0;

    $infoGarage .= "<b>Razón social:</b> {$this->_razonSocial}</br>";
    $infoGarage .= "<b>Precio por hora:</b> $ {$this->_precioPorHora}</br>";

    $infoGarage .= "<b>Autos en el Garage:</b></br>";

    foreach ($this->_autos as $key) {
        $infoGarage .= "</br><b>Auto Nº {$index}:</b>";
        $infoGarage .= Auto::MostrarAuto($key);
        $index++;
    }

    $infoGarage .= "</hr>";
    echo $infoGarage;
  }

  public function Equals(Auto $auto)
  {
    $returnValue = false;
    if(in_array($auto, $this->_autos))
    {
      $returnValue = true;
    }
    return $returnValue;
  }

  public function Add(Auto $auto)
  {
    $returnValue = "El auto ya está dentro de este garage!</br>";
    if(!in_array($auto, $this->_autos))
    {
      $this->_autos[] = $auto;
      $returnValue = "Auto agregado!</br>";
    }
    return $returnValue;
  }

  public function Remove(Auto $auto)
  {
    $returnValue = "El auto es null.</br>";
    if($auto !== null)
    {
      $returnValue = "El auto no está dentro de este garage!</br>";
      $key = array_search($auto, $this->_autos);
      if($key)
      {
        unset($this->_autos[$key]);
        $returnValue = "Auto eliminado del garage!</br>";
      }
    }
    return $returnValue;
  }
}
?>