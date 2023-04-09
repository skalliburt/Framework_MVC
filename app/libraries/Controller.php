<?php

//clase principal de los controladores (plantillas)
//Craga las vistas y los modelos

class Controller{

    //Carga el modelo
    public function model($model){
        //busca la carpeta modelo
        require_once '../app/models/'.$model.'.php';
        return new $model();
    }

    //Carga la vista
    public function view($view, $data=[]){
        if(file_exists('../app/views/'.$view.'.php')){
            require_once '../app/views/'.$view.'.php';
        }else{
            die('No existe la vista');
        }
    }
}
