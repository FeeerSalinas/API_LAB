<?php
require_once("Conexion.php");
//creando la extension de la conexion de la base de datos
class JugadoresModel extends Conexion {
    private $conexion;
//creando el constructor de la clase
    public function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->getConexion();
    }

    // Método para insertar un jugador
    public function insertarJugador($nombres, $apellidos, $fechaNacimiento, $genero, $posicion, $idEquipo) {
        try {
            $sql = "INSERT INTO jugadores (nombres, apellidos, fechaNacimiento, genero, posicion, idEquipo) VALUES (?, ?, ?, ?, ?, ?)";
            $arregloParametros = array($nombres, $apellidos, $fechaNacimiento, $genero, $posicion, $idEquipo);
            $insert = $this->conexion->prepare($sql);
            $ResultadoInsert = $insert->execute($arregloParametros);
            return $ResultadoInsert;
        } catch (Exception $e) {
            return false;
        }
    }

    // Método para ver todos los jugadores
    public function verJugadores() {
        $sql = "SELECT * FROM jugadores ORDER BY idJugadores ASC";
        $execute = $this->conexion->query($sql);
        $resultado = $execute->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // Método para recuperar un jugador específico por nombre
    public function recuperarJugador($nombres) {
        $sql = "SELECT * FROM jugadores WHERE nombres=?";
        $arregloParametros = array($nombres);
        $query = $this->conexion->prepare($sql);
        $query->execute($arregloParametros);
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
}
?>
