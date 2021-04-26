<?php
class Producto
{
  public $codigoBarra;
  public $nombre;
  public $tipo;
  public $stock;
  public $precio;

  public function __construct($codigoBarra, $nombre, $tipo, $stock, $precio, $id = NULL)
  {
    $this->codigoBarra = $codigoBarra;
    $this->nombre = $nombre;
    $this->tipo = $tipo;
    $this->stock = $stock;
    $this->precio = $precio;
    $this->id = $id ? $id : mt_rand(1, 10000);
  }

  public function __get($name)
  {
      return $this->$name;
  }

  public function __set($name, $value)
  {
      $this->$name = $value;
  }

  public function ObjectCheck()
  {
    $returnValue = true;
    foreach($this as $key => $value)
    {
      if(!isset($key))
      {
        $returnValue = false;
      }
    }
    return $returnValue;
  }

  public static function LeerJson(String $pathDelArchivo = NULL)
  {
    try
    {
      $returnValue = "Información no disponible. Revise el archivo que desea consultar!";
      if($pathDelArchivo !== NULL)
      {
        if(!file_exists($pathDelArchivo))
        {
          $nuevoArchivo = fopen($pathDelArchivo, "w");
          fclose($nuevoArchivo);
          return [];
        }
        $archivo = fopen($pathDelArchivo, "r");
        $size = filesize($pathDelArchivo);
        $data = '{}';
        if ($size > 0) {
          $data = fread($archivo, $size);
        }
        fclose($archivo);
        $returnValue = json_decode($data);
      }
      return $returnValue;
    }
    catch (\Throwable $e)
    {
      echo $e->getMessage();
    }
  }

  public static function GuardarEnJson(Array $arrayObjectToSave = NULL, String $pathDelArchivo = '')
  {
    $estado = "No se pudo efectuar el registro! Falta el nombre del archivo o el array es NULL!";
    if($arrayObjectToSave !== NULL && !empty($pathDelArchivo))
    {
      $archivoJson = fopen($pathDelArchivo, "w");
      fwrite($archivoJson, json_encode($arrayObjectToSave, JSON_PRETTY_PRINT));
      fclose($archivoJson);
      $estado = "Datos registrados con éxito en {$pathDelArchivo}";
    }
    return $estado;
  }

  public static function verificarObjectoEnArray(Array $array, Object $object, string $keyToCompare)
  {
    $returnValue = NULL;
    $index = 0;
    foreach($array as $objectIntoArray) {
      if($object->{$keyToCompare} == $objectIntoArray->{$keyToCompare})
      {
        $returnValue = $index;
        break;
      }
      $index++;
    }
    return $returnValue;
  }

  public static function AltaProducto(Producto $producto, String $nombreDelArchivo = NULL)
  {
    $estado = "";
    $dataDelArchivo = [];
    if($producto->ObjectCheck($producto))
    {
      $dataDelArchivo = self::LeerJson($nombreDelArchivo);
      $index = self::verificarObjectoEnArray($dataDelArchivo, $producto, 'codigoBarra');
      if($index !== NULL)
      {
        $dataDelArchivo[$index]->stock += $producto->stock;
        $estado = "Actualizado";
      }
      else
      {
        array_push($dataDelArchivo, $producto);
        $estado = "Ingresado";
      }

      if(!str_contains(self::GuardarEnJson($dataDelArchivo, $nombreDelArchivo), "Datos registrados con éxito" ))
      {
        $estado = "No se pudo hacer";
      }
    }
    return $estado;
  }

  public static function ObtenerListado(string $listado = NULL)
  {
    $returnValue = "Información no disponible. Revise los parámetros de su consulta!";
    if($listado !== NULL)
    {
      $users = [];
      $fileData = self::LeerJson("{$listado}.json");
      foreach($fileData as $value)
      {
        $users[] = new Usuario($value->id, $value->nombre, $value->apellido, $value->clave, $value->email, $value->fechaRegistro);
      }
      $returnValue = self::ListarUsuarios($users);
    }
    return $returnValue;
  }

  public static function ListarUsuarios(Array $usuarios = NULL)
  {
    $returnValue = "";
    if($usuarios !== NULL)
    {
      $returnValue = "<ul>";
      foreach($usuarios as $value)
      {
        $path = self::$pathUsuariosFotos;
        $returnValue .= "<li>{$value->apellido}, {$value->nombre}, <img src='{$path}{$value->nombre}-{$value->email}.jpg' width='50' height='50' />";
      }
      $returnValue .= "</ul>";
    }
    return $returnValue;
  }
}
?>