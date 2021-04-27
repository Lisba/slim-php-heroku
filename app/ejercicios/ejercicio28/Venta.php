<?php
class Venta
{
  public $id;
  public $codigoBarra;
  public $idUsuario;
  public $cantidad;

  public function __construct($codigoBarra, $idUsuario, $cantidad)
  {
    $this->id = mt_rand(1, 10000);
    $this->codigoBarra = $codigoBarra;
    $this->idUsuario = $idUsuario;
    $this->cantidad = $cantidad;
  }

  public function __get($name)
  {
      return $this->$name;
  }

  public function __set($name, $value)
  {
      $this->$name = $value;
  }

  public static function LeerJson(String $nombreDelArchivo = NULL)
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

  public static function GuardarEnJson(Array $arrayObjectToSave = NULL, String $nombreArchivo = '')
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

  public static function AltaVenta(Venta $venta, String $nombreDelArchivo = NULL)
  {
    $estado = "No se pudo efectuar el registro por falta de datos en el objeto!";
    $dataDelArchivo = [];
    if(isset($venta->id) && isset($venta->codigoBarra) && isset($venta->idUsuario) && isset($venta->cantidad) && $nombreDelArchivo !== NULL)
    {
      if(self::VerificarUsuario($venta->idUsuario, "./usuarios.json"))
      {
        $cantidadProducto = self::VerificarProductoYStock($venta->codigoBarra, "./productos.json");
        if($cantidadProducto >= $venta->cantidad)
        {
          $dataDelArchivo = self::LeerJson($nombreDelArchivo);
          array_push($dataDelArchivo, $venta);
          $estado = self::GuardarEnJson($dataDelArchivo, $nombreDelArchivo);
          $estado = "Venta realizada!";
        }
        else
        {
          $estado = "No se pudo efectuar el registro, producto inexistente o sin stock.";

        }
      }
      else
      {
        $estado = "No se pudo efectuar el registro, usuario inexistente.";
      }
    }
    return $estado;
  }

  public static function VerificarUsuario(Int $idUsuario, String $nombreDelArchivo)
  {
    $returnValue = false;
    $dataDelArchivo = self::LeerJson($nombreDelArchivo);
    foreach($dataDelArchivo as $usuario)
    {
      if($idUsuario === $usuario->id)
      {
        $returnValue = true;
      }
    }
    return $returnValue;
  }

  public static function VerificarProductoYStock(String $codigoBarra, String $nombreDelArchivo)
  {
    $returnValue = -1;
    $dataDelArchivo = self::LeerJson($nombreDelArchivo);
    foreach($dataDelArchivo as $producto)
    {
      if($codigoBarra === $producto->codigoBarra && $producto->stock > 0)
      {
        $returnValue = $producto->stock;
      }
    }
    return $returnValue;
  }

  public static function ObtenerListadoBD()
  {
    $consultaSQL = "SELECT * FROM venta";
    $instanciaBD = BD::GetInstanciaBD();
    $objetoPDOStatement = $instanciaBD->GetConsulta($consultaSQL);
    $instanciaBD->EjecutarConsultaAssocArrayParams($objetoPDOStatement);
    // $resultado = $objetoPDOStatement->fetchall();
    $resultado = [];
    while($fila = $objetoPDOStatement->fetch(PDO::FETCH_ASSOC))
    {
      $resultado[] = $fila;
    }
    return self::ListarVentasBD($resultado);
  }

  public static function ListarVentasBD(Array $ventas = NULL)
  {
    $returnValue = "";
    if($ventas !== NULL)
    {
      $returnValue = "<ul>";
      $returnValue = "<li>id, id_producto, id_usuario, cantidad, fecha_de_venta</li>";
      foreach($ventas as $venta)
      {
        $returnValue .= "<li>{$venta['id']}, {$venta['id_producto']}, {$venta['id_usuario']}, {$venta['cantidad']}, {$venta['fecha_de_venta']}</li>";
      }
      $returnValue .= "</li>";
    }
    return $returnValue;
  }
}
?>