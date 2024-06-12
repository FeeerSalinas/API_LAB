<?php
require_once("./Controlador/JugadoresController.php");
//instanciando un objeto del tipo controldor de jugadores
$ObjJugadoresController = new JugadoresController();

switch($_SERVER['REQUEST_METHOD']){
    case 'POST':
        /*
        Endpoint: jugadores.php
        Parametros: nombres, apellidos, fechaNacimiento, genero, posicion, idEquipo
        Metodo: POST
        */
        if (isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['fechaNacimiento']) && isset($_POST['genero']) && isset($_POST['posicion']) && isset($_POST['idEquipo'])) {
            $ObjJugadoresController->insertarJugador($_POST['nombres'], $_POST['apellidos'], $_POST['fechaNacimiento'], $_POST['genero'], $_POST['posicion'], $_POST['idEquipo']);
        } else {
            http_response_code(400);
            $json["Estado"] = "Error";
            $json["Mensaje"] = "Todos los campos son obligatorios";
            $json["data"] = [];
            echo json_encode($json);
        }
        break;

    case 'GET':
        /*
        Endpoint: jugadores.php
        Parametros: nombres o ninguno
        */
        if (isset($_GET['nombres'])) {
            // Método para recuperar un solo jugador
            $ObjJugadoresController->getJugador($_GET['nombres']);
        } else {
            // Método para recuperar a todos los jugadores
            $ObjJugadoresController->verJugadores();
        }
        break;

    default:
        http_response_code(405);
        $json["Estado"] = "Error";
        $json["Mensaje"] = "Método no permitido";
        echo json_encode($json);
        break;
}
?>
