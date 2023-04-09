<?php

//Configuracion de conexion a la bd 
class Database{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $name = DB_NAME;
    
    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){

        $dsn = 'mysql:host='.$this->host.';dbname='.$this->name;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try{
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
            $this->dbh->exec('set  names utf8');
        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //Recibe la sentencia SQL
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }
    // vincula sentencia determinando el tipo de valor CON BIND
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                break;
                default:
                    $type = PDO::PARAM_STR;
                break;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    //Ejecuta la consulta
    public function execute(){
        return $this->stmt->execute();
    }
    //Obtener los registros de la consulta
    public function records(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    //Obtener un solo de la consulta
    public function record(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    //Obtener cantidad de filas con el metodo rowCount
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}