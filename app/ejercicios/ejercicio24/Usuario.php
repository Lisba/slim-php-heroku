<?php
class Usuario
{
  public $id;
  public $nombre;
  public $apellido;
  public $clave;
  public $email;
  public $fechaRegistro;
  public static $pathUsuariosJson = "./usuarios.json";
  public static $pathUsuariosFotos = "./usuario/fotos/";

  public function __construct($id, $nombre, $apellido, $clave, $email)
  {
    $this->id = $id ? $id : mt_rand(1, 10000);
    $this->nombre = $nombre;
    $this->apellido = $apellido;
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

  static function GuardarEnJson(Object $objectToSave, String $nombreArchivo)
  {
    $estado = "No se pudo efectuar el registro! Falta el nombre del archivo o el objeto es NULL!";
    if($objectToSave !== NULL && !empty($nombreArchivo))
    {
      $archivoJson = fopen($nombreArchivo, "a");
      fwrite($archivoJson, json_encode($objectToSave, JSON_PRETTY_PRINT));
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

  static function LeerJson(String $nombreDelArchivo = NULL)
  {
    $returnValue = "Información no disponible. Revise el archivo que desea consultar!";
    $dataDecoded = [];
    if($nombreDelArchivo !== NULL)
    {
      $archivo = fopen($nombreDelArchivo, "r");
      $size = filesize($nombreDelArchivo);
      if ($size > 0) {
        $data = fread($archivo, $size);
      } else {
        $data = '{}';
      }
      fclose($archivo);
      $dataDecoded = json_decode($data);
      $returnValue = $dataDecoded;
    }
    return $returnValue;
  }

  static function ObtenerListado(string $listado = NULL)
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

  static function ListarUsuarios(Array $usuarios = NULL)
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