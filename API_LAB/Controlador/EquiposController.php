<?php
require_once("./Modelo/EquiposModel.php");
header('Content.type: application/json');

class EquiposController{
    private $ObjEquiposModel;

    public function __construct()
    {
        $this->ObjEquiposModel = new EquiposModel();
    }

    //metodo para insertar equipos

    public function insertarEquipo($nombreEqui, $institu, $departa, $munici, $direccio, $telefo){
        $resultadoInsert=$this->ObjEquiposModel->insertarEquipo($nombreEqui, $institu, $departa, $munici, $direccio, $telefo);
        $json=array();
        if($resultadoInsert==true){
           
            http_response_code(201);
            $json["Estado"]="Exito";
            $json["Mensaje"]="Equipo $nombreEqui registrado con exito";
            $json["data"]=[];
            echo json_encode($json);
        }
        else{
            http_response_code(202);
            $json["Estado"]="Error";
            $json["Mensaje"]="No se pudo insertar el equipo $nombreEqui equipo ya existe";
            $json["data"]=[];
            echo json_encode($json);
        }
    }


    //metodo para ver todos los equipos
    public function verEquipos(){
        $ListaEquipos = $this->ObjEquiposModel->verEquipos();
        $json=array();
        if($ListaEquipos!=null){
            http_response_code(200);
            $json["Estado"]="Exito";
            $json["Mensaje"]="Equipos recuperados";
            $json["data"]=$ListaEquipos;
            echo json_encode($json);
        }
        else{
            http_response_code(404);
            $json["Estado"]="Error";
            $json["Mensaje"]="No hay equipos";
            $json["data"]=$ListaEquipos;
            echo json_encode($json);
        }
    }

    //metodo para ver un solo empleado

    public function getEquipo($nombreEqui){
        $DatosRecuperados=$this->ObjEquiposModel->recuperarEquipo($nombreEqui);
        $json=array();
        if($DatosRecuperados!=false){
            http_response_code(200);
            $json["Estado"]="Exito";
            $json["Mensaje"]="Equipo $nombreEqui recuperado";
            $json["data"]=$DatosRecuperados;
            echo json_encode($json);
        }
        else{
            http_response_code(404);
            $json["Estado"]="Error";
            $json["Mensaje"]="Equipo $nombreEqui no encontrado";
            $json["data"]=[];
            echo json_encode($json);
        }
    }

}

?>