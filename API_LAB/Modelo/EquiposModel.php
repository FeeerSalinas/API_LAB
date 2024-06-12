<?php
require_once("Conexion.php");

class EquiposModel extends Conexion{
    private $conexion;
//creando constructor de la clase
    public function __construct()
    {
        $this->conexion=new Conexion();
        $this->conexion=$this->conexion->getConexion();
    }
//funcion para insertar en la base
    public function insertarEquipo($nombreEqui, $institu, $departa, $munici, $direccio, $telefo){
        try{
            $sql="INSERT INTO equipos(nombreEquipo,institucion,departamento,municipio,direccion,telefono) VALUES (?,?,?,?,?,?)";
            $arregloParametros=array($nombreEqui, $institu, $departa, $munici, $direccio, $telefo);
            $insert = $this->conexion->prepare($sql);
            $ResultadoInsert=$insert->execute($arregloParametros);
            return $ResultadoInsert;
        }
        catch(Exception $e){
            $resultadoInsert = 0;
            return $ResultadoInsert;
        }
    }


    //funcion para ver los equipos

    public function verEquipos(){
        $sql = "SELECT * FROM equipos ORDER BY idEquipo ASC";
        $execute=$this->conexion->query($sql);
        $resultado=$execute->fetchall(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function recuperarEquipo($nombreEqui){
        $sql = "SELECT * FROM equipos WHERE nombreEquipo=?";
        $arregloParametros = array($nombreEqui);
        $query=$this->conexion->prepare($sql);
        $query->execute($arregloParametros);
        $resultado=$query->fetchall(PDO::FETCH_ASSOC);
        return $resultado;
    }


}


?>