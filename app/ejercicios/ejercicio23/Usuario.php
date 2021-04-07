<?php
class Usuario
{
  public $id;
  public $nombre;
  public $clave;
  public $email;
  public $fechaRegistro;
  public static $idGlobal = 1;
  public static $pathUsuariosJson = "./usuarios.json";

  public function __construct($nombre, $clave, $email)
  {
    $this->id = self::$idGlobal;
    $this->nombre = $nombre;
    $this->clave = $clave;
    $this->email = $email;
    $this->fechaRegistro = new DateTime("now");
    self::$idGlobal++;
  }

  public function __get($name)
  {
      return $this->$name;
  }

  public function __set($name, $value)
  {
      $this->$name = $value;
  }

  static function GuardarEnJson(Object $objectToSave, String $nombreArchivo)
  {
    $estado = "No se pudo efectuar el registro! Falta el nombre del archivo o el objeto es NULL!";
    if($objectToSave !== NULL && !empty($nombreArchivo))
    {
      $archivoJson = fopen($nombreArchivo, "a");
      fwrite($archivoJson, json_encode($objectToSave, JSON_PRETTY_PRINT).",");
      fclose($archivoJson);
      $estado = "Datos registrados con éxito en {$nombreArchivo}";
    }
    return $estado;
  }

  static function AltaUsuario(Usuario $usuario)
  {
    $estado = "No se pudo efectuar el registro por falta de datos en el objeto!";
    if(isset($usuario->nombre) && isset($usuario->clave) && isset($usuario->email) && isset($usuario->fechaRegistro) && isset($usuario->id))
    {
      $estado = self::GuardarEnJson($usuario, self::$pathUsuariosJson);
    }
    return $estado;
  }
}
?>