<?php

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id' , 'nombre' , 'email' , 'password' , 
    'token' , 'confirmado'];

    public function __construct($args =  [])
    {
        $this -> id = $args ['id'] ?? null;
        $this -> nombre = $args ['nombre'] ?? '';
        $this -> email = $args ['email'] ?? null;
        $this -> password = $args ['password'] ?? null;
        $this -> token = $args ['token'] ?? null;
        $this -> confirmado = $args ['confirmado'] ?? 0;
        $this -> password2 = $args ['password2'] ?? null;
    }

    public function validarNuevaCuenta(){
        if(!$this -> nombre ) {
            self::$alertas['error'][] = 'Debe rellenar el campo Nombre';

        }
        if(!$this -> email ) {
            self::$alertas['error'][] = 'Debe rellenar el campo Email';

        }
        if(!$this -> password ) {
            self::$alertas['error'][] = 'Debe Colocar una Contraseña';

        }
        if(  strlen (!$this -> password ) >=  6  ){
            self::$alertas['error'][] = 'Debe Contener almenos 6 caracteres';

        }
        
        if(!preg_match( "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{3,}$/", $this -> password ) ){
            self::$alertas['error'][] = 'La contraseña debe tener al menos un caracter especial, un número y una letra';
        }

        if(!$this -> email ) {
            self::$alertas['error'][] = 'Debe rellenar el campo Email';

        }
        if( $this -> password !==  $this -> password2) {
            self::$alertas['error'][] = 'Las Contraseñas no coinciden';
        }


        return self::$alertas;
    }
    
    public function hashPassword(){
        $this -> password = password_hash($this -> password , PASSWORD_BCRYPT);
    }
    public function crearToken(){
        $this -> token = md5(uniqid()); //retorna 32caracteres
    }
    public function validarEmail(){

        if(!$this -> email ) {
            self::$alertas['error'][] = 'Debe rellenar el campo Email';

        }
        //validar que sea email
        if( !filter_var($this->email , FILTER_VALIDATE_EMAIL) ) {
            self::$alertas['error'][] = 'Debe colocar un Email valido';

        }
        return self::$alertas;
    }
    public function comprobarPassword()
    {
        if(  strlen (!$this -> password ) >=  6  ){
            self::$alertas['error'][] = 'Debe Contener almenos 6 caracteres';

        }
        
        if(!preg_match( "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{3,}$/", $this -> password ) ){
            self::$alertas['error'][] = 'La contraseña debe tener al menos un caracter especial, un número y una letra';
        }
        
        if( $this -> password !==  $this -> password2) {
            self::$alertas['error'][] = 'Las Contraseñas no coinciden';
        }


        return self::$alertas;
    }
    //login de usuario
    public function validarLogin(){
        if(!$this -> email ) {
            self::$alertas['error'][] = 'Debe rellenar el campo Email';

        }
        if(!$this -> password ) {
            self::$alertas['error'][] = 'Debe Colocar una Contraseña';

        }
        if( !filter_var($this->email , FILTER_VALIDATE_EMAIL) ) {
            self::$alertas['error'][] = 'Debe colocar un Email valido';

        }
        return self::$alertas;
    }
}