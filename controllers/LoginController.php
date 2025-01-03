<?php

namespace Controllers;

use Classes\Correo;
use Model\Usuario;
use MVC\Router;

class LoginController {

    public static function login(Router $router){

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $auth = new Usuario($_POST);

            $alertas = $auth -> validarLogin();

            if(empty($alertas)){
                //verificar que el usuario exista

                $usuario = Usuario::where('email' , $auth -> email);

                if(!$usuario || !$usuario-> confirmado){
                    Usuario::setAlerta('error' , 'El usuario no existe o No esta confirmado');
                }else{
                    //usuario existe

                    //autenticar usuario
                    if(password_verify($_POST[ 'password'] , $usuario -> password )){

                        //INICIA SESION
                        session_start();
                        $_SESSION['id'] = $usuario -> id;
                        $_SESSION['nombre'] = $usuario -> nombre;
                        $_SESSION['email'] = $usuario -> nombre;
                        $_SESSION['login'] = true;

                        //redirecion

                        header('Location: /dashboard');

                    }else{
                        Usuario::setAlerta('error' , 'Password incorrecto');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();
        //mostrar la vista
        $router->render('auth/login', [   
            'titulo' => 'Iniciar Sesion',
            'alertas' => $alertas
        ]);  
    }

    public static function crear(Router $router){

        //objeto vacio
        $usuario = new Usuario();
        $alertas =[]; //inicializa vacio

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

         
            $usuario -> sincronizar($_POST);

            $alertas = $usuario -> validarNuevaCuenta();


            if (empty($alertas)){

                //busca el usuario
                $existeUsuario = Usuario::where('email', $usuario-> email);

                if($existeUsuario){
                    Usuario::setAlerta('error' , 'EL usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                }else{
                    //hehaser password
                    $usuario -> hashPassword();

                    //eliminar password2
                    unset ($usuario -> password2);
                    
                    //generar token
                    $usuario -> crearToken();
                    //enviar correo de validar cuenta

                    $email = new Correo($usuario -> email , $usuario->nombre , $usuario-> token );

                    $email -> enviarConfirmacion();

                    //guardar db
                     $resultado = $usuario->guardar();

                    //crear nuevo usuario
                    if ($resultado) {
                    header('Location: /mensaje');
                    }
                }
            }
          
        }
        $alertas = Usuario::getAlertas();
        //mostrar la vista
        $router->render('auth/crear', [
            'titulo' => 'crear Sesion',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);  
    }
    public static function olvide(Router $router){

        //arreglo
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario -> validarEmail();

            if (empty($alertas)){
                //buscamos el correo
                $usuario = Usuario::where('email' , $usuario->email);

                if($usuario && $usuario->confirmado ){

                    //GENERAR nuevo token
                    $usuario -> crearToken();

                    //eliminar password2
                    unset ($usuario -> password2);

                    //email de recuperar cuenta
                    $email = new Correo($usuario -> email , $usuario->nombre , $usuario-> token );

                    $email -> recuperarCuenta();

                    //guardar
                    $usuario -> guardar();

                    //alerta

                    Usuario::setAlerta('exito', 'Hemos enviado las Intrucciones a tu email');
                  
                }else{
                    Usuario::setAlerta('error', 'EL Email que Ingreso no esta registrado o no esta confrimado');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        //mostrar la vista
        $router->render('auth/olvide', [
            'titulo' => 'Reestablece La Contraseña',
            'alertas' => $alertas
        ]);  
    }

    public static function reestablecer(Router $router){
        //arreglo
        $alertas = [];
        $mostrar = true;

        //leer el token de la url
        $token = s ($_GET['token']);

        //si no existe la variable token redirecionamos
        if(!$token) header('Location: /');

        //encontrar al usuario con el token

        $usuario= Usuario::where('token' , $token);
        
        if (empty($usuario)){

            Usuario::setAlerta('error', 'Token no Valido');
            $mostrar = false;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //estancia de usuario
            $usuario -> sincronizar($_POST);

            //password iguales
            $alertas = $usuario -> comprobarPassword();

            if(empty($alertas)){

                $usuario-> hashPassword();

                //ELIMINAMOS PASSWORD 2
                unset($usuario -> password2);
    
                $usuario -> token = '';
            
                //guardamos cambios
                $resultado = $usuario -> guardar();
    
                if($resultado){
                    header('Location: /');
                }
                         
            }
        }
        
        $alertas = Usuario::getAlertas();
       
        //mostrar la vista
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablece La Contraseña',
            'alertas' => $alertas,
            'mostrar' => $mostrar
        ]);     
    }

    public static function mensaje(Router $router){


        //mostrar la vista
        $router->render('auth/mensaje', [
            'titulo' => 'Mensaje'
        
        ]);  
    }

    public static function confirmar(Router $router){

        //leer el token de la url
        $token = s ($_GET['token']);

        //si no existe la variable token redirecionamos
        if(!$token) header('Location: /');

        //encontrar al usuario con el token

        $usuario= Usuario::where('token' , $token);

       // debuguear($usuario);

        if (empty($usuario)){
            Usuario::setAlerta('error', 'Token no Valido');
        }else{
            $usuario -> confirmado = 1;
            $usuario -> token = '';
            //quitamospassword 2
            unset($usuario-> password2);

            //guardamos cambios
            $usuario->guardar();
            //confirmar la cuenta
            Usuario::setAlerta('exito' , 'Correo Validado');
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar-cuenta', [
            'titulo' => 'confirmar',
            'alertas' => $alertas
        
        ]);  
    }


    public static function logout(){
        
        session_start();
        $_SESSION = [] ; //limpiar sesion
        header('Location: /');
        
    }
}