<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Correo {
    //declarar parametros

    public $email;
    public $nombre;
    public $token;

    //constructor
    public function __construct($email, $nombre , $token )
    {
        $this -> email = $email;
        $this -> nombre = $nombre;
        $this -> token = $token;
    }
    
    public function enviarConfirmacion(){

        //objeto email
        $mail = new PHPMailer();
        $mail -> isSMTP();
        $mail-> Host = $_ENV['EMAIL_HOST'];
        $mail-> SMTPAuth = true;
        $mail-> Port = $_ENV['EMAIL_PORT'];
        $mail-> Username = $_ENV['EMAIL_USER'];
        $mail-> Password = $_ENV['EMAIL_PASS'];

        $mail -> setFrom('cuentas@uptask.com');//dominio
        $mail -> addAddress('cuentas@uptask.com', 'Uptask.com');
        $mail -> Subject = 'confirma tu cuenta';
        //set html
        $mail ->isHTML(TRUE);
        $mail -> CharSet = 'UTF-8';

        //contenido correo

        $contenido ="<html>";
        $contenido .= "<p><strong> Hola" . $this -> nombre . "</strong> Has creado tu cuenta 
                    en Uptask Solo debes confirmarlo presionando el siguiente enlace </p> ";
        $contenido .= "<p>Presionando Aqui: <a href='" . $_ENV['SERVER_HOST'] . "/confirmar-cuenta?token="
        . $this -> token . "' >Confirmar Cuenta</a></p>";
        $contenido .="<p>Si tu no solicitaste esta cuenta puedes ignorar el mensaje";
        $contenido .= "</html>";

        $mail -> Body = $contenido;

        $mail -> send();
    }  
    
    public function recuperarCuenta(){
        //objeto email
        $mail = new PHPMailer();
        $mail -> isSMTP();
        $mail-> Host = $_ENV['EMAIL_HOST'];
        $mail-> SMTPAuth = true;
        $mail-> Port = $_ENV['EMAIL_PORT'];
        $mail-> Username = $_ENV['EMAIL_USER'];
        $mail-> Password = $_ENV['EMAIL_PASS'];

        $mail -> setFrom('cuentas@uptask.com');//dominio
        $mail -> addAddress('cuentas@uptask.com', 'Uptask.com');
        $mail -> Subject = 'Recuperar Cuenta';
        //set html
        $mail ->isHTML(TRUE);
        $mail -> CharSet = 'UTF-8';

        //contenido correo

        $contenido ="<html>";
        $contenido .= "<p><strong> Hola" . $this -> nombre . "</strong> Has Solicitado
                    Recuperacion de cuennta , solo debes confirmarlo presionando el siguiente enlace </p> ";
        $contenido .= "<p>Presionando Aqui: <a href='" . $_ENV['SERVER_HOST'] . "/reestablecer?token="
        . $this -> token . "' >Recuperar Cuenta</a></p>";
        $contenido .="<p>Si tu no solicitaste esta cuenta puedes ignorar el mensaje";
        $contenido .= "</html>";

        $mail -> Body = $contenido;

        $mail -> send();
    }
}