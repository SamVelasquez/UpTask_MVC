<?php

namespace Controllers;

use Model\Proyectos;
use MVC\Router;

class DashboardController {

    public static function index(Router $router){

        session_start();
        isAuth();


        $router->render('dashboard/index', [
            'titulo' => 'Proyectos',
         
        
        ]);  
    }

    public static function crear_proyecto(Router $router){

        session_start();
        isAuth();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $proyecto = new Proyectos($_POST);

            //validacion
            $alertas = $proyecto -> validarProyecto();
            
            if(empty($alertas)){
                //guardar proyecto

                
            }
        }

        $router->render('dashboard/crear-proyecto', [
            'titulo' => 'Crear Proyecto',
            'alertas' => $alertas
        
        ]);  
    }
    
    public static function perfil(Router $router){

        session_start();
        isAuth();


        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil',
         
        
        ]);  
    }
}