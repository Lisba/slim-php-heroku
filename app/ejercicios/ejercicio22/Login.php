<?php
class Login
{
  private $email;
  private $clave;

  public function __construct($email, $clave)
  {
    $this->email = $email;
    $this->clave = $clave;
  }

  public function VerificarUsuario()
  {
    $returnValue = "Usuario no registrado";
    $datosDelArchivo = Usuario::LeerArchivo("usuarios.csv");
    foreach($datosDelArchivo as $value)
    {
      if($this->email === $value[2])
      {
        $returnValue = "Error en los datos";
        if($this->clave === $value[1])
        {
          $returnValue = "Verificado";
        }
      }
    }
    return $returnValue;
  }
}
?>