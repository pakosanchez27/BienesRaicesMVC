<?php 

define('TEMPLETE_URL', __DIR__ . "/templetes");
define('FUNCIONES_URL', __DIR__ ."funciones.php");
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/public/imagenes/');



function incluirTemplete($nombre, $inicio = false){

    include TEMPLETE_URL . "/${nombre}.php";
}

function incluirFooter($nombre){

    include TEMPLETE_URL . "/${nombre}.php";
}

function estaAutenticado()  {
    session_start();


    if(!$_SESSION['login']) {
        header('Location: /');
    }
   
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo"</pre>";
    exit;
}

function s($html){
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de contenido

function validarTipocontenido($tipo){
    $tipos = ['vendedor', 'propiedad']; 

    return in_array($tipo, $tipos);
}

function mostrarNotificacion($codigo){
    $mensaje = '';

    switch($codigo){
        case 1: 
            $mensaje = ' Creado correctamente'; 
            break;
        case 2: 
            $mensaje = ' Actualizado correctamente'; 
            break;   
        case 3: 
            $mensaje = ' Eliminado correctamente'; 
            break;   
        default:
        $mensaje = false; 
        break;
    }
    return $mensaje;
}

function ValidarORedireccionar(string $url){
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: "${url}"');
    }

    return $id;
}