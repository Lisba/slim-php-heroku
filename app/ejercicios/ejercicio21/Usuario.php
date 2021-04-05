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

  static function ObtenerListado($listado)
  {
    $returnValue = "Información no disponible. Revise los parámetros de su consulta!";
    if($listado !== NULL && $listado === "usuarios")
    {
      $users = [];
      $index = 0;
      $archivo = fopen("usuarios.csv", "r");
      while(!feof($archivo))
      {
        $fileLine = fgetcsv($archivo);
        $users[] = new Usuario($fileLine[0], $fileLine[1], $fileLine[2]);
        $index++;
      }
      fclose($archivo);
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