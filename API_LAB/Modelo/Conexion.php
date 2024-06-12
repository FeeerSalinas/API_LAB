<?php
//credenciales para la conexion a la base de datos mysql
class Conexion{
    private $host = "localhost";
    private $user = "root";
    private $pass = "1234";
    private $db = "lab3_pdm";
    private $conBD;
//constructor
    public function __construct()
    {
        $cadenaConexion = "mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8";
        try{
            $this->conBD = new PDO($cadenaConexion, $this->user, $this->pass);
            $this->conBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //la conexion fue correcta
        }
        catch(Exception $e){
            $this->conBD="Error de conexion";
            http_response_code(404);
            $json=array();
            $json["Estado"]="Error";
            $json["Mensaje"]=$e->getMessage();
            $json["data"]=[];
            echo json_encode($json);
            exit;
        }
    }

    public function getConexion(){
        return $this->conBD;
    }

}
?>