<?php

class Pages extends Controller{
    
    public function __construct(){
        //Se accede al modelo
        $this->articleModel = $this->model('Article');
        
    }

    public function index(){

        $articulos = $this->articleModel->obtenerArticulos();


        $data = [
            'tittle' => 'pasando parametros',
            'articulos' => $articulos
        ];
        $this->view('pages/home', $data);
    }

    public function article(){
        //$this->view('pages/article');
    }

    public function other($id){
        //echo 'metodo';
        echo $id;
    }

    
    
}