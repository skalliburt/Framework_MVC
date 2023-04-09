<?php


class Core{
    /**
     * mapear la url ingresada al navegador
     * 0- Controlador
     * 1- Metodo
     * 2- parametro
     * ejemplo: localhost/controlador(articulos)/metodo(actualizar)/parametro(2)/
     */

    protected $currentController = 'Pages'; //Pages Linux (case sensitive->solucionar)
    protected $currentMethod = 'index';
    protected $parameters = [];

    
    public function __construct(){
        //print_r($this->getUrl());
        $url = $this->getUrl();
        


        //BUSCAR EL CONTROLADOR
		if(isset($url[0])){
			if(file_exists('../app/controller/'.ucwords($url[0]).'.php')){
            //si existe se asigna como controlador por defecto
            $this->currentController = ucwords($url[0]);
            
            //se reemplaza el valor actual de currenController por el valor asignado
            unset($url[0]);
            
			}
		}
        
        //Llamada del controlador
        require_once "../app/controller/".$this->currentController.".php";
        $this->currentController = new $this->currentController;



        //LLAMADA DE LOS METODOS
        
        if(isset($url[1])){
            
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
            
        }
        
        //echo $this->currentMethod;

        //OBTENER LOS PARAMETROS
        $this->parameters = $url ? array_values($url): [];

        //Callback de los parametros
        call_user_func_array([$this->currentController, $this->currentMethod], $this->parameters);

    }

    public function getUrl(){
        //echo $_GET['url'];
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}