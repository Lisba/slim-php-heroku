<?php
class Usuario
{
  private $nombre;
  private $clave;
  private $email;

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
}
?>