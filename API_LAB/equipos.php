<?php
require_once("./Controlador/EquiposController.php");

$ObjEquiposcontroller = new EquiposController();

//echo "Metodo HTTP: ".$_SERVER['REQUEST_METHOD'];

switch($_SERVER['REQUEST_METHOD']){
    case 'POST':
        /*
        Endpoint: equipos.php
        Parametros: nombreEqui, institu, departa, munici, direccio, telefo
        Metodo: POST
        */
        if((isset($_POST['nombreEquipo']) and $_POST['nombreEquipo'] != null) and (isset($_POST['institucion']) and $_POST['institucion'] != null) and (isset($_POST['municipio']) and $_POST['municipio'] != null) and (isset($_POST['direccion']) and $_POST['direccion'] != null) and (isset($_POST['telefono']) and $_POST['telefono'] != null)){
            $ObjEquiposcontroller->insertarEquipo($_POST['nombreEquipo'],$_POST['institucion'],$_POST['departamento'],$_POST['municipio'],$_POST['direccion'], $_POST['telefono']);
        }
        else{
            http_response_code(202);
            $json["Estado"]="Error";
            $json["Mensaje"]="No se puede guardar, todos los datos del equipo son obligatorios";
            $json["data"]=[];
            echo json_encode($json);
        }
        break;
    case 'GET':
        /*
        Endpoint: equipos.php
        Parametros: nombreEquipo o ninguno
        */

        if(isset($_GET['nombreEquipo']) and $_GET['nombreEquipo'] != null){
            //metodo para recuperar un solo equipo
            $ObjEquiposcontroller->getEquipo($_GET['nombreEquipo']);
        }
        else{
            //metodo para recuperar a todos los equipos
            $ObjEquiposcontroller->verEquipos();
        }

        break;
}

?>