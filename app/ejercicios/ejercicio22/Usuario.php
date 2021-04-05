<?php
class Usuario
{
  private $nombre;
  private $clave;
  private $email;

  public function __construct($nombre, $clave, $email)
  {
    $this->nombre = $nombre;
    $this->clave = $clave;
    $this->email = $email;
  }

  public function __get($name)
  {
      return $this->$name;
  }

  public function __set($name, $value)
  {
      $this->$name = $value;
  }

  static function ValidarUsuario(Usuario $usuario)
  {
    $estado = "No se pudo efectuar el registro!";
    if(isset($usuario->nombre) && isset($usuario->clave) && isset($usuario->email))
    {
      $miArchivo = fopen("usuarios.csv", "a");
      fwrite($miArchivo, "$usuario->nombre, $usuario->clave, $usuario->email\n");
      fclose($miArchivo);
      $estado = "Datos registrados con éxito!";
    }
    return $estado;
  }

  static function LeerArchivo(String $nombreDelArchivo)
  {
    $returnValue = "Información no disponible. Revise el archivo que desea consultar!";
    if($nombreDelArchivo !== NULL)
    {
      $data = [];
      $archivo = fopen($nombreDelArchivo, "r");
      while(!feof($archivo))
      {
        $data[] = fgetcsv($archivo);
      }
      fclose($archivo);
      $returnValue = $data;
    }
    return $returnValue;
  }

  static function ObtenerListado($listado)
  {
    $returnValue = "Información no disponible. Revise los parámetros de su consulta!";
    if($listado !== NULL && $listado === "usuarios")
    {
      $users = [];
      $fileData = Usuario::LeerArchivo("usuarios.csv");
      foreach($fileData as $value)
      {
        $users[] = new Usuario($value[0], $value[1], $value[2]);
      }
      $returnValue = Usuario::ListarUsuarios($users);
    }
    return $returnValue;
  }

  static function ListarUsuarios(Array $usuarios)
  {
    $returnValue = "";
    if($usuarios !== NULL)
    {
      $returnValue = "<ul>";
      foreach($usuarios as $value)
      {
        $returnValue .= "<li>{$value->nombre}";
        $returnValue .= "<ul>";
        $returnValue .= "<li>Nombre: {$value->nombre}</li>";
        $returnValue .= "<li>Clave: {$value->clave}</li>";
        $returnValue .= "<li>Email: {$value->email}</li>";
        $returnValue .= "</ul>";
        $returnValue .= "</li>";
      }
      $returnValue .= "</ul>";
    }
    return $returnValue;
  }
}
?>