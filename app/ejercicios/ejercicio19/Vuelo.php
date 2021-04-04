<?php
class Vuelo
{
  private $_fecha;
  private $_empresa;
  private $_precio;
  private $_listaDePasajeros;
  private $_cantMaxima;

  public function __construct(string $empresa = "", float $precio = 0, int $cantMax = 0)
  {
    $this->_fecha = new DateTime();
    $this->_empresa = $empresa;
    $this->_precio = $precio;
    $this->_cantMaxima = $cantMax;
    $this->_listaDePasajeros = [];
  }

  public function getInfoVuelo()
  {
    $infoVuelo = "";
    $i = 0;

    $infoVuelo .= "INFO VUELO:</br>";
    $infoVuelo .= "Fecha: {$this->_fecha->format("Y-m-d")}</br>";
    $infoVuelo .= "Empresa: {$this->_empresa}</br>";
    $infoVuelo .= "Precio: {$this->_precio}</br>";
    $infoVuelo .= "Cantidad máxima de pasajeros: {$this->_cantMaxima}</br>";

    foreach ($this->_listaDePasajeros as $key) {
        $infoVuelo .= "</br>Pasajero nº {$i}:</br>";
        $infoVuelo .= $key->GetInfoPasajero();
        $i++;
    }

    return $infoVuelo;
  }

  public function AgregarPasajero(Pasajero $p)
  {
    $msg = "";
    $countPasajeros = count($this->_listaDePasajeros);

    if($p !== null)
    {
        if($countPasajeros < $this->_cantMaxima)
        {
            if($countPasajeros === 0)
            {
                array_push($this->_listaDePasajeros,$p);
                $msg .= "</br>Pasajero agregado con éxito!</br></br>";

            }
            else if($countPasajeros !== 0)
            {
                foreach ($this->_listaDePasajeros as $key)
                {
                    if($p->Equals($p,$key))
                    {
                        $msg .= "El pasajero ya se encuentra en la lista. </br>";
                        break;
                    }
                    else
                    {
                        array_push($this->_listaDePasajeros,$p);
                        $msg .= "</br>Pasajero agregado con éxito!</br></br>";
                        break;
                    }
                }
            }
        }
        else
        {
            $msg .= "Se superó la cantidad máxima de pasajeros.</br></br>";
        }
    }
    else
    {
        $msg .= "El pasajero es null.</br>";
    }
    return $msg;
  }

  public function MostrarVuelo()
  {
    return $this->getInfoVuelo();
  }

  public function Add(Vuelo $v1 = null, Vuelo $v2 = null)
  {
    $totalV1 = 0;
    $totalV2 = 0;
    $sumVuelos = 0;

    if($v1 !== null && $v2 !== null)
    {
        foreach ($v1->_listaDePasajeros as $key)
        {
            if($key->GetEsPlus())
            {
                //aplico un descuento del 20%
                $totalV1 += ($v1->_precio - ($v1->_precio * (20/100)));
            }
            else
            {
                $totalV1 += $v1->_precio;
            }
        }
        foreach ($v2->_listaDePasajeros as $key)
        {
            if($key->GetEsPlus())
            {
                //aplico un descuento del 20%
                $totalV2 += ($v2->_precio - ($v2->_precio * (20/100)));
            }
            else
            {
                $totalV2 += $v2->_precio;
            }
        }

        $sumVuelos = $totalV1 + $totalV2;
    }
    return "Total suma de vuelos: $ " . $sumVuelos;
  }

  public function Remove(Pasajero $p)
  {
    $infoRemove = "";

    if($p !== null)
    {
        if(in_array($p,$this->_listaDePasajeros))
        {
            foreach ($this->_listaDePasajeros as $key => $value)
            {
                if($this->_listaDePasajeros[$key] === $p)
                {
                    unset($this->_listaDePasajeros[$key]);
                    $infoRemove .= "</br>Pasajero eliminado con éxito! </br></br>";
                    break;
                }
            }
        }
        else
        {
            $infoRemove .= "El pasajero no está en el vuelo.</br></br>";
        }
    }
    else
    {
        $infoRemove .= "El pasajero es null. </br></br>";
    }
    return $infoRemove;
  }

  public function GetCountPasajeros()
  {
    return count($this->_listaDePasajeros);
  }
}
?>