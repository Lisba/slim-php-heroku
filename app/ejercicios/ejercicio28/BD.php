<?php
class BD {
  private static $instanciaBD;
  private $objetoPDO;

  private function __construct() {
    try
    {
      $this->objetoPDO = new PDO('mysql:host=localhost;dbname=TP_01_SQL;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      $this->objetoPDO->exec("SET CHARACTER SET utf8");
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  }

  public static function GetInstanciaBD()
  {
    if(!isset(self::$instanciaBD))
    {
      self::$instanciaBD = new BD();
    }
    return self::$instanciaBD;
  }

  public function GetConsulta(String $ConsultaSql)
  {
    return $this->objetoPDO->prepare($ConsultaSql);
  }

  // ejemplo: array(':id'=> $id,':anio'=> $anio)
  public function EjecutarConsultaAssocArrayParams(Object $consultaPreparada, Array $arrayParams = NULL)
  {
    if($arrayParams === NULL)
    {
      return $consultaPreparada->execute();
    }
    return $consultaPreparada->execute($arrayParams);
  }

  public function CerrarConexionBD()
  {
    return $this->objetoPDO = NULL;
  }

  public function __clone()
  {
    trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
  }
}
?>