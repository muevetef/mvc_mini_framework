<?php

/**
 * App Class Core
 * Crear las URL y cargar el contoller correspondiente
 */
class Core
{   
    private $currentController = 'Pages';
    private $currentMethod = 'index';
    private $params = [];
    public function __construct()
    {
        
        $url = $this->getUrl();
        //print_r($url);

        //Mirar en controllers segun el primer valor de URL
        if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
            //Si existe establecemos el controller
            $this->currentController = ucwords($url[0]);
        }
        
        //Require del controlador
        require_once '../app/controllers/'.$this->currentController.'.php';

        //Instanciar la classe del controlador correspondiente
        // $Pages = new Pages();
        // $Posts = new Posts();
        $this->currentController = new $this->currentController();

    }


    private function getUrl(){
        $url = [$this->currentController];
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/',$url);
            
        }
        return $url;
    }
}
