<?php
require_once("./Modelo/JugadoresModel.php");
header('Content-Type: application/json');

class JugadoresController {
    private $ObjJugadoresModel;

    public function __construct() {
        $this->ObjJugadoresModel = new JugadoresModel();
    }

    // Método para insertar un jugador
    public function insertarJugador($nombres, $apellidos, $fechaNacimiento, $genero, $posicion, $idEquipo) {
        $resultadoInsert = $this->ObjJugadoresModel->insertarJugador($nombres, $apellidos, $fechaNacimiento, $genero, $posicion, $idEquipo);
        $json = array();
        if ($resultadoInsert) {
            http_response_code(201);
            $json["Estado"] = "Exito";
            $json["Mensaje"] = "Jugador $nombres registrado con éxito";
            $json["data"] = [];
        } else {
            http_response_code(202);
            $json["Estado"] = "Error";
            $json["Mensaje"] = "No se pudo insertar el jugador $nombres";
            $json["data"] = [];
        }
        echo json_encode($json);
    }

    // Método para ver todos los jugadores
    public function verJugadores() {
        $ListaJugadores = $this->ObjJugadoresModel->verJugadores();
        $json = array();
        if ($ListaJugadores != null) {
            http_response_code(200);
            $json["Estado"] = "Exito";
            $json["Mensaje"] = "Jugadores recuperados";
            $json["data"] = $ListaJugadores;
        } else {
            http_response_code(404);
            $json["Estado"] = "Error";
            $json["Mensaje"] = "No hay jugadores";
            $json["data"] = [];
        }
        echo json_encode($json);
    }

    // Método para ver un solo jugador
    public function getJugador($nombres) {
        $DatosRecuperados = $this->ObjJugadoresModel->recuperarJugador($nombres);
        $json = array();
        if ($DatosRecuperados != false) {
            http_response_code(200);
            $json["Estado"] = "Exito";
            $json["Mensaje"] = "Jugador $nombres recuperado";
            $json["data"] = $DatosRecuperados;
        } else {
            http_response_code(404);
            $json["Estado"] = "Error";
            $json["Mensaje"] = "Jugador $nombres no encontrado";
            $json["data"] = [];
        }
        echo json_encode($json);
    }
}
?>
