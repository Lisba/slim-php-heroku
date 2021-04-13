<?php
class Usuario
{
  public $id;
  public $nombre;
  public $clave;
  public $email;
  public $fechaRegistro;

  public function __construct($nombre, $clave, $email)
  {
    $this->id = mt_rand(1,10000);
    $this->nombre = $nombre;
    $this->clave = $clave;
    $this->email = $email;
    $this->fechaRegistro = date('F j, Y, g:i a');
  }

  public function __get($name)
  {
      return $this->$name;
  }

  public function __set($name, $value)
  {
      $this->$name = $value;
  }

  static function LeerJson(String $nombreDelArchivo = NULL)
  {
    try
    {
      $returnValue = "Información no disponible. Revise el archivo que desea consultar!";
      if($nombreDelArchivo !== NULL)
      {
        if(!file_exists($nombreDelArchivo))
        {
          $nuevoArchivo = fopen($nombreDelArchivo, "w");
          fclose($nuevoArchivo);
          return [];
        }
        $archivo = fopen($nombreDelArchivo, "r");
        $size = filesize($nombreDelArchivo);
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

  static function GuardarEnJson(Array $arrayObjectToSave = NULL, String $nombreArchivo = '')
  {
    $estado = "No se pudo efectuar el registro! Falta el nombre del archivo o el objeto es NULL!";
    if($arrayObjectToSave !== NULL && !empty($nombreArchivo))
    {
      $archivoJson = fopen($nombreArchivo, "w");
      fwrite($archivoJson, json_encode($arrayObjectToSave, JSON_PRETTY_PRINT));
      fclose($archivoJson);
      $estado = "Datos registrados con éxito en {$nombreArchivo}";
    }
    return $estado;
  }

  static function AltaUsuario(Usuario $usuario, String $nombreDelArchivo = NULL)
  {
    $estado = "No se pudo efectuar el registro por falta de datos en el objeto!";
    $dataDelArchivo = [];
    if(isset($usuario->nombre) && isset($usuario->clave) && isset($usuario->email) && isset($usuario->fechaRegistro) && isset($usuario->id) && $nombreDelArchivo !== NULL)
    {
      $dataDelArchivo = self::LeerJson($nombreDelArchivo);
      array_push($dataDelArchivo, $usuario);
      $estado = self::GuardarEnJson($dataDelArchivo, $nombreDelArchivo);
    }
    return $estado;
  }
}
?>