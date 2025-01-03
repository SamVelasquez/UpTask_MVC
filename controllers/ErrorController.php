<?php

namespace Controllers;

use MVC\Router;

class ErrorController {
    public static function error(Router $router){



        //mostrar la vista
        $router->render('error/error', [


        ]);  
    }
}