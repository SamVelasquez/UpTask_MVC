<?php

namespace Model;

class Proyectos extends ActiveRecord{
    protected static $tabla = 'proyectos';
    protected static $columnasDB = ['id' , 'proyecto_nombre' , 'url' , 'propietario_id' ];

    public function __construct($args =  [])
    {
        $this -> id = $args ['id'] ?? null;
        $this -> proyecto = $args ['proyecto_nombre'] ?? '';
        $this -> url = $args ['url'] ?? null;
        $this -> propietario_id = $args ['propietario_id'] ?? null;

    }

    public function validarProyecto(){
        if(!$this -> proyecto){
            self::$alertas['error'][] = 'El nombre del proyecto es obligatorio';
        }
        return self::$alertas;
    }
}