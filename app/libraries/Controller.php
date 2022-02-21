<?php

/**
 * Base Controller
 * Carga los modelos y las vistas
 */
class Controller
{

    //Carga el modelo
    public function model($model)
    {
        if (file_exists('../app/models/' . $model . '.php')) {
            require_once '../app/models/' . $model . '.php';
        }else{
            die('El modelo no existe');
        }
        
        return new $model();
    }

    //Cargar la vista
    public function view($view, $data = [])
    {

        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('La vista no existe');
        }
    }
}
