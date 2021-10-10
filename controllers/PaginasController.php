<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', []);
    }
    public static function anuncios(Router $router)
    {
        $propiedades = Propiedad::get(10);
        $router->render('paginas/anuncios', [
            'propiedades' => $propiedades
        ]);
    }
    public static function anuncio(Router $router)
    {
        $id = ValidarORedireccionar('/');
        $propiedad = Propiedad::find($id);


        $router->render('paginas/anuncio', [

            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router)
    {

        $router->render('paginas/blog', []);
    }

    public static function entrada(Router $router)
    {

        $router->render('paginas/entrada', []);
    }

    public static function contacto(Router $router)
    {
        $mensaje = null; 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];

            //crear una intancia de PHPmailer
            $mail = new PHPMailer();
            //configurar SMTP 
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'f68ffd4e7b6136';
            $mail->Password = '2bca6a04c92e00';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configurar el contenido del email 

            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';


            // Habilitar html

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contenido

            $contenido = '<html';
            $contenido .= '<p> Tienes un nuevo mensaje </p>';
            $contenido .= '<p> Nombre: ' . $respuestas['nombre'] . '</p>';
           
            // Enviar de forma condicional
            if($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p> Eligio se contactado por telefono: </p>';
                $contenido .= '<p> Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p> Fecha: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p> Hora: ' . $respuestas['hora'] . '</p>';
            }else{
                $contenido .= '<p> Eligio se contactado por email </p>';
                $contenido .= '<p> Email: ' . $respuestas['email'] . '</p>';
            }
        
         
            $contenido .= '<p> Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p> Vende o Compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p> Precio o Presupuesto: $' . $respuestas['precio'] . '</p>';
           
           
            $contenido .= '</html>';


            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es un texto alternativo sin HTML';
            // Enviar el email

            if ($mail->send()) {
                $mensaje ="mensaje Enviado Correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar...";
            }
        }
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
